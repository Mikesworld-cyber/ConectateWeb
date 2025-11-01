@extends('layouts.admin')

@section('contenido')
<div class="mb-4">
    <h2 class="fs-2 fw-bold text-dark">Gestión de Clientes</h2>
    <p class="text-secondary">Crea, modifica y monitorea los clientes existentes.</p>
</div>

<div class="content-card">
    <div class="card-header-custom">
        <h3 class="card-title">Clientes</h3>
        <div class="card-actions">
            <button class="btn-card-action">
                <i class="fas fa-filter"></i> Filtrar
            </button>
            <button class="btn-card-action">
                <i class="fas fa-download"></i> Exportar
            </button>
        </div>
    </div>

    <!-- ✅ ÚNICO CAMBIO: añadí overflow-x:auto al div -->
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
                    <td><span class="badge-custom badge-active">{{ $cliente['estado_cuenta'] }}</span></td>
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
                    <td colspan="7" class="text-center text-muted">No se encontraron clientes.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection