@extends('layouts.admin')
@section('contenido')
<div class="mb-4">
    <h2 class="fs-2 fw-bold text-dark">Gestión de paquetes</h2>
    <p class="text-secondary">Crea, modifica y monitorea los paquetes de servicio.</p>
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
                    <th>Paquete</th>
                    <th>precio</th>
                    <th>tipo</th>
                    <th>detalles</th>
                    <th>Estado</th>
                    <th>velocidad_subida</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($clientes as $cliente)
                <tr>
                    <td><strong>{{ $cliente['nombre'] }}</strong></td>
                    <td>{{ $cliente['precio'] }}</td>
                    <td>{{ $cliente['tipo'] }}</td>
                    <td>{{ $cliente['detalles'] }}</td>
                    <td><span class="badge-custom badge-active">Activo</span></td>
                    <td>{{ $cliente['velocidad_subida'] }}</td>
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