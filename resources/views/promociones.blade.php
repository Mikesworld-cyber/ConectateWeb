@extends('layouts.admin')
@section('contenido')
<div class="mb-4">
    <h2 class="fs-2 fw-bold text-dark">Gestión de promociones</h2>
    <p class="text-secondary">Crea, modifica y monitorea las promociones de tus servicio.</p>
</div>

<div class="content-card">
    <div class="card-header-custom">
        <h3 class="card-title">Paquetes agregados</h3>
        <div class="card-actions">
            <button class="btn-card-action">
                <i class="fas fa-filter"></i> Filtrar
            </button>
            <button class="btn-card-action">
                <i class="fas fa-download"></i> Exportar
            </button>
        </div>
    </div>

    <div class="table-responsive p-3">
        <table class="modern-table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Fecha inicio</th>
                    <th>Fecha fin</th>
                    <th>Descuento</th>
                    <th>Condiciones</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($clientes as $cliente)
                <tr>
                    <td><strong>{{ $cliente['nombre'] }}</strong></td>
                    <td>{{ $cliente['fecha_inicio'] }}</td>
                    <td>{{ $cliente['fecha_fin'] }}</td>
                    <td><span class="badge-custom badge-active">{{ $cliente['descuento'] }}</span></td>
                    <td>{{ $cliente['condiciones'] }}</td>
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
                    <td colspan="7" class="text-center text-muted">No se encontraron paquetes de internet disponibles.</td>
                </tr>
                @endforelse

            </tbody>
        </table>
    </div>
</div>
@endsection