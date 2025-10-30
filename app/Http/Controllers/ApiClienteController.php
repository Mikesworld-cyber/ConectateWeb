<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiClienteController extends Controller
{
    private $apiUrl = 'http://localhost/Api-PHP/server/api.php';
    public function index(){




        $response = Http::get("{$this->apiUrl}/?action=registros");


         
        if ($response->successful()) {
            // Decodifica la respuesta JSON
            $datosApi = $response->json();
            $clientesmodal = Http::get("{$this->apiUrl}/?action=clientes")->json()['data']['data'] ?? [];
            $paquetesmodal = Http::get("{$this->apiUrl}/?action=registros")->json()['data']['data'] ?? [];
            // Accedemos a ['data']['data'][0] para obtener el objeto del administrador.
        $adminData = Http::get("{$this->apiUrl}/?action=buscaradmin&id=1")->json();
        $promocionesmodal= Http::get("{$this->apiUrl}/?action=promociones")->json()['data']['data'] ?? [];
        $admin = $adminData['data']['data'][0] ?? []; // Usamos [0] para obtener el objeto del admin.
            // Si la API devuelve los clientes dentro de una clave 'data', úsala:
            $clientes = $datosApi['data']['data'] ?? [];
        } else {
            // Manejo de error si la API no responde
            $clientes = [];
            $clientesmodal = [];
            $admin = [];
            $paquetesmodal=[];
            $promocionesmodal=[];
            // Opcional: registrar error o mostrar un mensaje flash
        }

        // Devolver la vista y pasar los datos
        return view('dashboard', compact('clientes', 'clientesmodal', 'admin','paquetesmodal', 'promocionesmodal'));
    }
    // 2. Método llamado por AJAX para obtener y devolver solo el HTML de la tabla
    public function getTablaData(Request $request)
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





        $dataType = $request->input('tipo', 'clientes'); // 'clientes', 'paquetes', etc.
        $clientes = []; // Inicializamos la variable

        // Construye la URL de tu API (ej: .../api.php?action=listar&tipo=clientes)
        $response = Http::get($this->apiUrl, [
            'action' => $dataType // Le dice a tu backend qué tabla jalar (clientes, paquetes)
        ]);

        if ($response->successful()) {
            $datosApi = $response->json();

            // Accede a la estructura anidada de tu JSON: ['data']['data']
            $clientes = $datosApi['data']['data'] ?? [];
        }

        // Determina qué vista parcial cargar
        if ($dataType == 'clientes') {
            $viewName = 'partials.tablaclientes';
        } elseif ($dataType == 'registros') {
             $viewName = 'partials.tablapaquetes';

        } elseif ($dataType == 'contratos'){
$viewName='partials.tablacontratos';
        }
        elseif($dataType=='ingresos'){
            $viewName='partials.ganancias_chart';
        }
        else {
             $viewName = 'partials.tabla_vacia';
        }

        // Importante: Usamos render() para devolver solo el código HTML de la tabla
        return view($viewName, compact('clientes', 'dataType','totalVentas', 'totalCompras', 'datosChart'))->render(); 
    }
}
