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
                        <button type="button"
                class="btn btn-primary btn-sm"
                data-bs-toggle="modal"
                data-bs-target="#modalCrearPromocion">
                <i class="fas fa-plus"></i> Nueva Promocion
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



<div class="modal fade" id="modalCrearPromocion" tabindex="-1" aria-labelledby="modalCrearPromocionLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header text-white" style="background-color: #0056b3; border-bottom: 5px solid #007bff;">
                <h5 class="modal-title fs-5 fw-bold" id="modalCrearPaqueteLabel">
                    <i class="fas fa-plus-circle me-2"></i> Procion-images
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

       <div class="profile-picture">
      <h1 class="upload-icon">
        <i class="fa fa-plus fa-2x" aria-hidden="true"></i>
      </h1>
      <input
        class="file-uploader"
        type="file"
        onchange="upload()"
        accept="image/*"
      />
       </div>

<form action="{{ route('drive.upload') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="image" required>
    <button type="submit">Subir a Google Drive</button>
</form>



        </div>
    </div>
</div>
@endsection