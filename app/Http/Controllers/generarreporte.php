<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon; // Ya incluido en Laravel

class generarreporte extends Controller
{
    private $apiUrl = 'http://localhost/Api-PHP/server/api.php';
    //private $apiUrl = 'http://mysqltablas.atwebpages.com/myapi/api.php';
   public function showContrato($id)
    {
        $response = Http::get("{$this->apiUrl}?action=contrato&id={$id}");
       // 2. VERIFICAR LA RESPUESTA Y EXTRAER DATOS
        if ($response->successful() && isset($response->json()['data']['data'][0])) {
            // Extraer el primer (y único) contrato del array anidado
            $contratoApi = $response->json()['data']['data'][0];

            // NOTA: Aquí debes añadir los datos 'cliente', 'paquete_contratado', etc., 
            // que faltan en tu API, si son necesarios en la vista.
            
            // Usamos los datos REALES de la API
            $datosContrato = $contratoApi;

        } else {
            // Manejo de error si la API falla o no encuentra el contrato
            // Puedes redirigir a una página de error o generar un PDF de error
            return response('Error al obtener el contrato de la API. Código: ' . $response->status(), 500);
        }

        // 3. GENERAR EL PDF
        // Asegúrate de que tu vista se llama 'pdfs.contrato_individual' (no 'viewreport')
        $pdf = Pdf::loadView('viewreport', ['contrato' => $datosContrato]);

        // 4. DEVOLVER LA RESPUESTA
        $fechaActual = Carbon::now()->format('Ymd');
        $nombreArchivo = "Contrato_ID_{$id}_{$fechaActual}.pdf"; // Usamos la variable {$id}
        
        // Para previsualizar en el navegador:
        return $pdf->stream($nombreArchivo);
    }
    
    // --- FUNCIÓN DE SIMULACIÓN (Reemplazar con tu lógica de API) ---
    private function fetchContratoFromApi()
    {
        // Simulamos una BÚSQUEDA en una lista de prueba.
        $todosLosDatos = [
            [
                "contrato_id" => 1,
                "cliente" => "Ana López García",
                "correo_cliente" => "ana.lopez@email.com",
                "administrador" => "AdminGlobal",
                "paquete_contratado" => "Premium Gamer",
                "fecha_contrato" => "2025-10-12 02:08:19",
                "siguiente_fecha_cobro" => "2025-11-12 02:08:19",
                "estado_contrato" => "activo",
                "duracion_meses" => 12
            ],
            [
                "contrato_id" => 2,
                "cliente" => "Carlos Reyes Pérez",
                // ... otros datos
            ],
            // ... más contratos
        ];

        // Buscar el contrato por ID
        foreach ($todosLosDatos as $contrato) {
            if ($contrato['contrato_id'] == 1) {
                return $contrato; // Devuelve el objeto del contrato
            }
        }
        return null; // No encontrado
    }
}
