@extends('layouts.admin')

@section('contenido')
@php
$metricas_clientes = [
'clientes_totales' => [
'valor' => '1,250',
'descripcion' => 'Total de Cuentas Registradas',
'icono' => 'fas fa-users',
'color' => 'primary', // Color para el icono/borde
],
'clientes_activos' => [
'valor' => '1,180',
'descripcion' => 'Cuentas con Servicio Activo',
'icono' => 'fas fa-wifi',
'color' => 'success',
],
'clientes_nuevos_mes' => [
'valor' => '+42',
'descripcion' => 'Nuevos Clientes (Último Mes)',
'icono' => 'fas fa-user-plus',
'color' => 'info',
],
'clientes_morosos' => [
'valor' => '70',
'descripcion' => 'Cuentas con Factura Pendiente',
'icono' => 'fas fa-bell',
'color' => 'warning',
],
];
// Datos de la tabla (usando tus nombres de variables de ejemplo)

@endphp

<div class="mb-4">
    <h2 class="fs-2 fw-bold text-dark">Gestión de Clientes 🧑‍💻</h2>
    <p class="text-secondary">Crea, modifica y monitorea los clientes existentes y su estado de servicio.</p>
</div>

<div class="row mb-5">
    @foreach ($metricas_clientes as $key => $metrica)
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card h-100 shadow-sm border-start-{{ $metrica['color'] }} p-3">
            <div class="d-flex align-items-center">
                <i class="{{ $metrica['icono'] }} fa-2x text-{{ $metrica['color'] }} me-3"></i>
                <div>
                    <div class="text-secondary text-uppercase fw-bold small">{{ $metrica['descripcion'] }}</div>
                    <div class="fs-4 fw-bold text-dark">{{ $metrica['valor'] }}</div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
<div class="content-card">
    <div class="card-header-custom">
        <h3 class="card-title">Base de Clientes</h3>
        <div class="card-actions">
            <button class="btn btn-primary me-2" title="Registrar un Nuevo Cliente">
                <i class="fas fa-user-plus"></i> Nuevo Cliente
            </button>
            <button class="btn-card-action">
                <i class="fas fa-filter"></i> Filtrar
            </button>
            <button class="btn-card-action">
                <i class="fas fa-download"></i> Exportar
            </button>
        </div>
    </div>

    <div class="table-responsive p-3" style="overflow-x: auto;">
        <table class="modern-table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Telefono</th>
                    <th>Registro</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($clientes as $cliente)
                <tr>
                    <td><strong>{{ $cliente['nombre_user'] }}</strong></td>
                    <td>{{ $cliente['correo'] }}</td>
                    <td>{{ $cliente['telefono'] }}</td>
                    <td>{{ $cliente['fecha_registro'] }}</td>
                    <td>
                        @php
                        $badge_class = 'badge-secondary';
                        if ($cliente['estado_cuenta'] == 'Activo') {
                        $badge_class = 'badge-active';
                        } elseif ($cliente['estado_cuenta'] == 'Suspendido') {
                        $badge_class = 'badge-inactive';
                        }
                        @endphp
                        <span class="badge-custom {{ $badge_class }}">{{ $cliente['estado_cuenta'] }}</span>
                    </td>
                    <td>
                        <button class="action-btn edit" title="Editar">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="action-btn" title="Ver detalles">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="action-btn delete" title="Eliminar">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">No se encontraron clientes.</td>
                    <!-- <script>
                        // Convierte el array PHP a un objeto JSON válido para JavaScript
                        const clientes = @json($clientes);

                        // Ahora puedes usar el objeto 'clientes' en JavaScript
                        console.log(clientes);

                        // Si solo quieres mostrar el total de clientes, por ejemplo:
                        // alert('Tienes ' + clientes.length + ' clientes.');

                        // Si realmente quieres hacer un alert con la representación textual del objeto:
                        alert(JSON.stringify(clientes));
                    </script> -->
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection