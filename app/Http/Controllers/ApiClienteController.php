<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiClienteController extends Controller
{
    private $apiUrl = 'http://localhost:81/server/api.php';
    public function index()
    {
        $response = Http::get("{$this->apiUrl}/?action=registros");

        if ($response->successful()) {
            // Decodifica la respuesta JSON
            $datosApi = $response->json();
            $clientesmodal = Http::get("{$this->apiUrl}/?action=clientes")->json()['data']['data'] ?? [];
            $paquetesmodal = Http::get("{$this->apiUrl}/?action=registros")->json()['data']['data'] ?? [];
            // Accedemos a ['data']['data'][0] para obtener el objeto del administrador.
            $adminData = Http::get("{$this->apiUrl}/?action=buscaradmin&id=3")->json();
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
            // Opcional: registrar error o mostrar un mensaje flash
        }

        // Devolver la vista y pasar los datos
        return view('dashboard', compact('clientes', 'clientesmodal', 'admin', 'paquetesmodal', 'estadisticas'));
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
        $dataType = $request; // 'clientes', 'paquetes', etc.
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
            $viewName = 'clientes';
        } elseif ($dataType == 'registros') {
            $viewName = 'paquetes';
        } elseif ($dataType == 'contratos') {
            $viewName = 'contratos';
        } else {
            $viewName = 'partials.tabla_vacia';
        }

        // Importante: Usamos render() para devolver solo el código HTML de la tabla
        return view($viewName, compact('clientes', 'dataType'))->render();
    }
}
