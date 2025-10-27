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
            
            // Si la API devuelve los clientes dentro de una clave 'data', úsala:
            $clientes = $datosApi['data']['data'] ?? []; 
        } else {
            // Manejo de error si la API no responde
            $clientes = [];
            // Opcional: registrar error o mostrar un mensaje flash
        }

        // Devolver la vista y pasar los datos
        return view('dashboard', compact('clientes'));
    }
    // 2. Método llamado por AJAX para obtener y devolver solo el HTML de la tabla
    public function getTablaData(Request $request)
    {
        $dataType = $request->input('tipo', 'clientes'); // 'clientes', 'paquetes', etc.
        $clientes = []; // Inicializamos la variable

        // Construye la URL de tu API (ej: .../api.php?action=listar&tipo=clientes)
        $response = Http::get($this->apiUrl, [
            'action' => $dataType// Le dice a tu backend qué tabla jalar (clientes, paquetes)
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
        else {
             $viewName = 'partials.tabla_vacia';
        }

        // Importante: Usamos render() para devolver solo el código HTML de la tabla
        return view($viewName, compact('clientes', 'dataType'))->render(); 
    }

}
