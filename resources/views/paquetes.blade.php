@extends('layouts.admin')
@section('contenido')

@php
    $metricas_paquetes = [
        'paquetes_activos' => [
            'valor' => '8',
            'descripcion' => 'Planes Actualmente Ofertados',
            'icono' => 'fas fa-box-open',
            'color' => 'primary',
        ],
        'paquete_mas_vendido' => [
            'valor' => 'Mega Fibra 500',
            'descripcion' => 'Plan con más suscripciones',
            'icono' => 'fas fa-award',
            'color' => 'success',
        ],
        'velocidad_promedio' => [
            'valor' => '350 Mbps',
            'descripcion' => 'Velocidad Promedio Ofertada',
            'icono' => 'fas fa-tachometer-alt',
            'color' => 'info',
        ],
        'ingreso_potencial' => [
            'valor' => '$1,500.00',
            'descripcion' => 'Suma de Precios Mensuales de Planes',
            'icono' => 'fas fa-money-bill-wave',
            'color' => 'warning',
        ],
    ];


@endphp



<div class="mb-4">
    <h2 class="fs-2 fw-bold text-dark">Gestión de paquetes</h2>
    <p class="text-secondary">Crea, modifica y monitorea los paquetes de servicio.</p>
</div>

<div class="row mb-5">
    @foreach ($metricas_paquetes as $key => $metrica)
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
        <h3 class="card-title">Paquetes agregados</h3>
        <div class="card-actions">
                        <button type="button" 
                class="btn btn-primary btn-sm" 
                data-bs-toggle="modal" 
                data-bs-target="#modalCrearPaquete">
                <i class="fas fa-plus"></i> Nuevo Paquete
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

<div class="modal fade" id="modalCrearPaquete" tabindex="-1" aria-labelledby="modalCrearPaqueteLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
          
                 <div class="modal-header text-white" style="background-color: #0056b3; border-bottom: 5px solid #007bff;">
                <h5 class="modal-title fs-5 fw-bold" id="modalCrearPaqueteLabel">
                    <i class="fas fa-plus-circle me-2"></i> Crear Nuevo Paquete de Internet
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form action="#" method="POST">
                @csrf
                <div class="modal-body p-4">
                    
                    <p class="text-secondary mb-4">Completa la información del nuevo plan de servicio, incluyendo velocidades y precio.</p>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nombre" class="form-label fw-bold">Nombre del Paquete</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ej: Mega Fibra 500" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="precio" class="form-label fw-bold">Precio Mensual ($)</label>
                            <input type="number" step="0.01" class="form-control" id="precio" name="precio" placeholder="Ej: 79.99" required min="0">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="velocidad_bajada" class="form-label fw-bold">Velocidad de Bajada</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="velocidad_bajada" name="velocidad_bajada" placeholder="Ej: 500" required>
                                <span class="input-group-text">Mbps</span>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="velocidad_subida" class="form-label fw-bold">Velocidad de Subida</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="velocidad_subida" name="velocidad_subida" placeholder="Ej: 250" required>
                                <span class="input-group-text">Mbps</span>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="tipo" class="form-label fw-bold">Tipo de Servicio</label>
                            <select class="form-select" id="tipo" name="tipo" required>
                                <option value="" selected disabled>Selecciona un tipo</option>
                                <option value="Residencial">Residencial</option>
                                <option value="Comercial">Comercial / PYME</option>
                                <option value="Corporativo">Corporativo</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-9 mb-3">
                            <label for="detalles" class="form-label fw-bold">Detalles/Características del Plan</label>
                            <textarea class="form-control" id="detalles" name="detalles" rows="3" placeholder="Ej: Incluye IP fija, soporte 24/7..."></textarea>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="estado" class="form-label fw-bold">Estado</label>
                            <select class="form-select" id="estado" name="estado" required>
                                <option value="activo" selected>Activo</option>
                                <option value="inactivo">Inactivo</option>
                            </select>
                            <small class="form-text text-muted">Define la disponibilidad del plan.</small>
                        </div>
                    </div>

                </div>

                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i> Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Guardar Paquete
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection