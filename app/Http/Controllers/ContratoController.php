<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ContratoController extends Controller
{
      private $apiUrl = 'http://localhost/Api-PHP/server/api.php';

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
            'id_promocion'=>'nullable|integer',
            'duracion' => 'required|integer|min:1',
            'fecha_cobro' => 'required|integer|min:1|max:28',
            'clausulas'=>'nullable|string',
            'tipopago'=>'required|string',
            'costo_instalacion'=>'required|numeric|min:0'
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
            'tipopago'=>$request->tipopago,
            'monto_total' => $montoRecalculado, // Usamos el monto recalculado
            // Puedes añadir headers de autenticación si tu API lo requiere
        ];

        // 4. ENVÍO A LA API EXTERNA
        try {
            $response = Http::post("{$this->apiUrl}/?action=registrar_contrato", $datosParaApi);
            
            $apiResult = $response->json();

            if ($response->successful() ) {
                // Éxito: La API guardó el registro
                return response()->json([
                    'success' => true, 
                    'message' => 'Contrato registrado con éxito en la API.',
                    'contrato_id' => $apiResult['contrato_id'] ?? null // Si la API devuelve el nuevo ID
                ], 200);
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
                'message' => 'Error de conexión con el servidor de la API.' .$e->getMessage()
            ], 500);
        }


      
    }
     private function recalculateMonto($request){
            // 2. OBTENER DATOS SEGUROS DESDE LA API (RE-CÁLCULO) 👈 AQUÍ CONSUMES LA API

        $costoInstalacion = (float) $request->costo_instalacion;
        $precioPaquete = 0.0;
        $descuentoPorcentaje = 0.0;

        // A. OBTENER PRECIO DEL PAQUETE
        $paqueteResponse = Http::get("{$this->apiUrl}?action=paquete&id={$request->id_paquete}");


        if ($paqueteResponse->successful() && isset($paqueteResponse->json()['data']['data'][0]['precio'])) {
            $precioPaquete = (float) $paqueteResponse->json()['data']['data'][0]['precio'];
        } else {
            // Manejo de error: No se pudo obtener el precio del paquete
            throw new Exception('Error al obtener el precio del paquete ID: ' . $request->id_paquete);
    
        }

        // B. OBTENER DESCUENTO DE LA PROMOCIÓN (si aplica)
        if ($request->filled('id_promocion') && $request->id_promocion != 0) {
            $promoResponse = Http::get("{$this->apiUrl}?action=promocion&id={$request->id_promocion}");

            if ($promoResponse->successful() && isset($promoResponse->json()['data']['data'][0]['descuento'])) {
                $descuentoPorcentaje = (float) $promoResponse->json()['data']['data'][0]['descuento'];
            }
            // Si la promo falla, el descuento queda en 0.0, que es seguro.
        }

        // 3. CÁLCULOS FINALES
        
        // Cálculo del descuento: se aplica solo al precio del paquete
        $montoDescuento = ($precioPaquete * $descuentoPorcentaje) / 100;
        
        $subtotal = $precioPaquete + $costoInstalacion;
        
        $montoTotalInicial = $subtotal - $montoDescuento;
        return $montoTotalInicial;
        }
}