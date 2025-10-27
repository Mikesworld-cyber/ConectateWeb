<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
            'id_usuario' => 'required|exists:usuarios,id',
            'id_administrador' => 'required|exists:administradores,id',
            'id_paquete' => 'required|exists:paquetes_internet,id',
            'fecha_cobro' => 'required|integer|min:1|max:28',
            'duracion' => 'nullable|integer|min:1',
            'estado' => 'required|in:activo,inactivo',
            'clausulas' => 'nullable|string',
        ]);
        
        // 2. Lógica para guardar el Contrato
        
        // Necesitas ajustar la fecha de cobro al formato de tu base de datos (fecha_cobro TIMESTAMP)
        // Usaremos el día del cobro (ej. día 5) del siguiente mes como la primera fecha de cobro.
        $fechaCobro = now()->addMonth()->day($request->fecha_cobro);

        Contrato::create([
            'id_usuario' => $request->id_usuario,
            'id_administrador' => $request->id_administrador,
            'id_paquete' => $request->id_paquete,
            'fecha_cobro' => $fechaCobro, // Guardamos el TIMESTAMP
            'estado' => 'activo',
            'duracion' => $request->duracion,
            'clausulas' => $request->clausulas,
            // id_promocion se deja nulo por simplicidad
        ]);

        return redirect()->route('dashboard')->with('success', 'Contrato registrado con éxito!');
    }
}