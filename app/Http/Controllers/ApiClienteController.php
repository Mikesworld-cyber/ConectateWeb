<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiClienteController extends Controller
{
    private $apiUrl = 'http://localhost/Api-PHP/server/api.php';
    //private $apiUrl = 'http://mysqltablas.atwebpages.com/myapi/api.php';
    public function index(){




        $response = Http::get("{$this->apiUrl}/?action=paquetes");



        if ($response->successful()) {
            // Decodifica la respuesta JSON
            $datosApi = $response->json();
            $clientesmodal = Http::get("{$this->apiUrl}/?action=clientes")->json()['data']['data'] ?? [];
            $paquetesmodal = Http::get("{$this->apiUrl}/?action=paquetes")->json()['data']['data'] ?? [];
            // Accedemos a ['data']['data'][0] para obtener el objeto del administrador.
            $adminData = Http::get("{$this->apiUrl}/?action=buscaradmin&id=1")->json();
            $promocionesmodal = Http::get("{$this->apiUrl}/?action=promociones")->json()['data']['data'] ?? [];
            
            $admin = $adminData['data']['data'][0] ?? []; // Usamos [0] para obtener el objeto del admin.
            // Si la API devuelve los clientes dentro de una clave 'data', úsala:
            $clientes = $datosApi['data']['data'] ?? [];
            $dashEstadisticas = Http::get("{$this->apiUrl}/?action=estadisticas")->json();
            $estadisticas = $dashEstadisticas['data']['data'] ?? [];
        } else {
            // Manejo de error si la API no respondes
            $clientes = [];
            $clientesmodal = [];
            $admin = [];
            $paquetesmodal = [];
            $promocionesmodal = [];
            $estadisticas = [
                'usuarios_activos' => 0,
                'num_paquetes' => 0,
                'num_contratos' => 0,
                'total_mes_actual' => 0,
                'num_promociones' => 0,
                'num_tickets' => 0,
            ];
            // Opcional: registrar error o mostrar un mensaje flash
        }

        // Devolver la vista y pasar los datos
        return view('dashboard', compact('clientes', 'clientesmodal', 'admin', 'paquetesmodal', 'estadisticas', 'promocionesmodal'));
    }

    public function contratos()
    {
        $response = Http::get("{$this->apiUrl}/?action=registros");

        if ($response->successful()) {
            // Decodifica la respuesta JSON
            $datosApi = $response->json();
            $clientes = $datosApi['data']['data'] ?? [];
        } else {
            // Manejo de error si la API no responde
            $clientes = [];
            // Opcional: registrar error o mostrar un mensaje flash
        }

        return view('contratos', compact('clientes'));
    }
    // 2. Método llamado por AJAX para obtener y devolver solo el HTML de la tabla
    public function getTablaData($request)
    {
        // LÓGICA: Obtener datos de ventas/compras de la DB o API
        $totalVentas = 1248; // Ejemplo de dato
        $totalCompras = 0;   // Ejemplo de dato

        // Estructura de datos requerida por Chart.js
        $datosChart = [
            'labels' => ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
            'ventas' => [500000, 750000, 850000, 650000, 700000, 800000, 600000, 50000, 0, 0, 0, 0], // Valores de ejemplo
            'compras' => [100000, 120000, 150000, 110000, 130000, 140000, 115000, 10000, 0, 0, 0, 0], // Valores de ejemplo
        ];



        $dataType = $request; // 'clientes', 'paquetes', etc.

        //$dataType = $request->input('tipo', 'clientes'); // 'clientes', 'paquetes', etc.
        $clientes = []; // Inicializamos la variable

        // Construye la URL de tu API (ej: .../api.php?action=listar&tipo=clientes)
        $response = Http::get("{$this->apiUrl}/?action={$dataType}");




        if ($response->successful()) {
            $datosApi = $response->json();

            // Accede a la estructura anidada de tu JSON: ['data']['data']
            $clientes = $datosApi['data']['data'] ?? [];
        }

        // Determina qué vista parcial cargar
        if ($dataType == 'clientes') {
            $viewName = 'clientes';
        } elseif ($dataType == 'paquetes') {
            $viewName = 'paquetes';
        } elseif ($dataType == 'contratos') {
            $viewName = 'contratos';
            $clientesmodal = Http::get("{$this->apiUrl}/?action=clientes")->json()['data']['data'] ?? [];
            $paquetesmodal = Http::get("{$this->apiUrl}/?action=paquetes")->json()['data']['data'] ?? [];
            // Accedemos a ['data']['data'][0] para obtener el objeto del administrador.
            $adminData = Http::get("{$this->apiUrl}/?action=buscaradmin&id=3")->json();
            $promocionesmodal = Http::get("{$this->apiUrl}/?action=promociones")->json()['data']['data'] ?? [];
            $admin = $adminData['data']['data'][0] ?? [];
            return view($viewName, compact('clientes', 'clientesmodal', 'admin', 'paquetesmodal', 'promocionesmodal'));
        } elseif ($dataType == 'promociones') {
            $viewName = 'promociones';
        }
        elseif($dataType=='ingresos'){
        $viewName='partials.ganancias_chart';
        }
           elseif($dataType=='ganancias'){
        $viewName='ganancias';
        
        
         } elseif ($dataType == 'pagos') {
            $infoPagos = Http::get("{$this->apiUrl}/?action=pagos")->json()['data']['pagos'] ?? [];
            
            $cli = Http::get("{$this->apiUrl}/?action=clientes")->json()['data']['data'] ?? [];
            $viewName = 'pagos';
            return view($viewName, compact('infoPagos', 'cli'));
        } 
                   elseif($dataType=='tickets'){
        $viewName='tickets';
        }
              elseif($dataType=='calendario'){
        $viewName='calendario';
        }
        else {
            $viewName = 'partials.ganancias_chart';
        }

        // Importante: Usamos render() para devolver solo el código HTML de la tabla
        return view($viewName, compact('clientes', 'dataType', 'totalVentas', 'totalCompras', 'datosChart'))->render();
    }
}
