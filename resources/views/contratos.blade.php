@extends('layouts.admin')

@section('contenido')
<div class="mb-4">
    <h2 class="fs-2 fw-bold text-dark">Gestión de Contratos</h2>
    <p class="text-secondary">Crea, modifica y monitorea los contratos de servicio.</p>
</div>

<div class="content-card">
    <div class="card-header-custom">
        <h3 class="card-title">Contratos</h3>
        <div class="card-actions">
            <button type="button"
                class="btn btn-primary btn-sm"
                data-bs-toggle="modal"
                data-bs-target="#registroContratoModal">
                <i class="fas fa-plus"></i> Nuevo Contrato
            </button>
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
                    <th>ID</th>
                    <th>CLIENTE</th>
                    <th>CORREO</th>
                    <th>ADMINISTRADOR</th>
                    <th>PAQUETE DE INTERNET</th>
                    <th>FECHA DE CONTRATO</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($clientes as $cliente)
                <tr>
                    <td><strong>{{ $cliente['contrato_id'] }}</strong></td>
                    <td>{{ $cliente['cliente'] }}</td>
                    <td>{{ $cliente['correo_cliente'] }}</td>
                    <td>{{ $cliente['administrador'] }}</td>
                    <td><span class="badge-custom badge-active">{{ $cliente['paquete_contratado'] }}</span></td>
                    <td>{{ $cliente['fecha_contrato'] }}</td>
                    <td>
                        <button class="action-btn edit" title="Exportar">
                            <i class="bi bi-file-earmark-pdf-fill"></i>
                        </button>
                        <button class="action-btn" title="Ver detalles">
                            <i class="fas fa-eye"></i>
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