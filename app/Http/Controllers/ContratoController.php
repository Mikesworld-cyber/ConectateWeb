<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ContratoController extends Controller
{
    // Muestra el formulario (GET)
    public function create()
    {
        // 1. Obtener datos para los selectores (deberían estar activos)
        $usuarios = Usuario::where('estado_cuenta', 'activo')->get(['id', 'nombre_user', 'correo']);
        $paquetes = PaqueteInternet::where('estado', 'activo')->get(['id', 'nombre', 'velocidad_bajada', 'precio']);
        // Para el administrador, puedes limitar a un usuario logueado o listar si hay varios:
        $administradores = Administrador::all(['id', 'usuario']);

        return view('contratos.create', compact('usuarios', 'paquetes', 'administradores'));
    }

    // Procesa el formulario (POST)
    public function store(Request $request)
    {
    
        // 1. VALIDACIÓN
        $request->validate([
            'id_usuario' => 'required|integer',
            'id_administrador'=> 'required|integer',
            'id_paquete' => 'required|integer',
            'duracion' => 'required|integer|min:1',
            'fecha_cobro' => 'required|integer|min:1|max:28',
            'clausulas'=>'required'
            // El monto total inicial es solo un campo informativo del frontend; el backend lo recalcula para seguridad.
        ]);

        // 2. RECALCULAR EL MONTO FINAL (SEGURIDAD)
        // **IMPORTANTE:** Aquí DEBES recalcular el monto total (monto_total_inicial) 
        // usando los IDs de paquete y promoción para asegurar que el cliente no manipuló el precio.
        // Por ahora, asumiremos que ya tienes la lógica de recalculo aquí.
        
        $montoRecalculado = $this->recalculateMonto($request); 

        // 3. PREPARAR DATOS PARA LA API EXTERNA
        $datosParaApi = [
            'action' => 'registrar_contrato', // La acción que tu API PHP espera
            'id_usuario' => $request->id_usuario,
            'id_administrador' => $request->id_administrador, // Campo oculto en el modal
            'id_paquete' => $request->id_paquete,
            'id_promocion' => $request->id_promocion ?? 0,
            'duracion' => $request->duracion,
            'fecha_cobro_dia' => $request->fecha_cobro,
            'clausulas' => $request->clausulas,
            'monto_total' => $montoRecalculado, // Usamos el monto recalculado
            // Puedes añadir headers de autenticación si tu API lo requiere
        ];

        // 4. ENVÍO A LA API EXTERNA
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiToken,
                'Accept' => 'application/json',
            ])->post($this->apiUrl, $datosParaApi);
            
            $apiResult = $response->json();

            if ($response->successful() && $apiResult['success'] === true) {
                // Éxito: La API guardó el registro
                return response()->json([
                    'success' => true, 
                    'message' => 'Contrato registrado con éxito en la API.',
                    'contrato_id' => $apiResult['contrato_id'] ?? null // Si la API devuelve el nuevo ID
                ]);
            } else {
                // Fallo de la API, pero la conexión es correcta
                return response()->json([
                    'success' => false, 
                    'message' => 'Error de la API: ' . ($apiResult['message'] ?? 'Error desconocido.')
                ], 400);
            }

        } catch (\Exception $e) {
            // Fallo en la conexión (servidor de la API caído)
            return response()->json([
                'success' => false, 
                'message' => 'Error de conexión con el servidor de la API.'
            ], 500);
        }
    }
}