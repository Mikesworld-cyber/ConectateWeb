@extends('layouts.admin')

@section('contenido')
@php
    $metricas_ciclos = [
        'ciclos_activos' => [
            'valor' => '5',
            'descripcion' => 'Días de Corte Distintos',
            'icono' => 'fas fa-calendar-day',
            'color' => 'primary',
        ],
        'clientes_proximo_corte' => [
            'valor' => '120',
            'descripcion' => 'Clientes en el Ciclo más Grande',
            'icono' => 'fas fa-users',
            'color' => 'info',
        ],
        'facturas_vencidas_7dias' => [
            'valor' => '45',
            'descripcion' => 'Pagos Pendientes (Próx. 7 días)',
            'icono' => 'fas fa-hourglass-half',
            'color' => 'warning',
        ],
        'corte_critico' => [
            'valor' => 'Día 7',
            'descripcion' => 'Próxima Fecha de Corte Masivo',
            'icono' => 'fas fa-bolt',
            'color' => 'danger',
        ],
    ];
    
    // Lista de eventos/ciclos que se mostrarán en la tabla
    $eventos_mes = [
        ['fecha' => '2025-11-01', 'dia_corte' => 'Día 1', 'tipo' => 'VENCIMIENTO', 'descripcion' => 'Vencimiento de Factura para 85 clientes.', 'clientes_afectados' => 85, 'estado' => 'Completado', 'color' => 'success'],
        ['fecha' => '2025-11-05', 'dia_corte' => 'Día 5', 'tipo' => 'VENCIMIENTO', 'descripcion' => 'Vencimiento de Factura para 120 clientes.', 'clientes_afectados' => 120, 'estado' => 'Activo', 'color' => 'warning'],
        ['fecha' => '2025-11-07', 'dia_corte' => 'Día 1', 'tipo' => 'CORTE', 'descripcion' => 'Corte de servicio para clientes del Ciclo Día 1 con 7 días de mora.', 'clientes_afectados' => 3, 'estado' => 'Pendiente', 'color' => 'danger'],
        ['fecha' => '2025-11-15', 'dia_corte' => 'Día 15', 'tipo' => 'VENCIMIENTO', 'descripcion' => 'Vencimiento de Factura para 55 clientes.', 'clientes_afectados' => 55, 'estado' => 'Programado', 'color' => 'primary'],
    ];
@endphp

<div class="mb-4">
    <h2 class="fs-2 fw-bold text-dark">Gestión de Calendario y Eventos de Cobranza 🗓️</h2>
    <p class="text-secondary">Monitorea los eventos críticos de facturación, vencimientos y cortes de servicio de forma tabular.</p>
</div>

<div class="row mb-5">
    @foreach ($metricas_ciclos as $key => $metrica)
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
        <h3 class="card-title">Eventos Programados del Mes</h3>
        <div class="card-actions">
            <button class="btn btn-primary" title="Crear un nuevo evento de calendario (Recordatorio, Tarea)">
                 <i class="fas fa-calendar-plus"></i> Crear Evento
            </button>
            <button class="btn-card-action" title="Filtrar eventos por tipo (Corte, Vencimiento)">
                <i class="fas fa-filter"></i> Filtrar
            </button>
            <button class="btn-card-action" title="Exportar la lista de eventos programados">
                <i class="fas fa-download"></i> Exportar
            </button>
        </div>
    </div>

    <div class="table-responsive p-3" style="overflow-x: auto;">
        <table class="modern-table">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Tipo de Evento</th>
                    <th>Ciclo (Día de Corte)</th>
                    <th>Descripción</th>
                    <th>Clientes Afectados</th>
                    <th>Estado de Ejecución</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($eventos_mes as $evento)
                <tr>
                    <td><strong>{{ date('d M Y', strtotime($evento['fecha'])) }}</strong></td>
                    <td>
                        <span class="badge bg-{{ $evento['color'] }} text-white">{{ $evento['tipo'] }}</span>
                    </td>
                    <td><span class="badge bg-secondary text-white">{{ $evento['dia_corte'] }}</span></td>
                    <td>{{ $evento['descripcion'] }}</td>
                    <td><i class="fas fa-users me-1"></i> {{ $evento['clientes_afectados'] }}</td>
                    <td>
                         @php
                            // Asignación de clases para el estado de ejecución
                            $clase_estado = match($evento['estado']) {
                                'Completado' => 'badge-active',
                                'Activo' => 'badge-warning',
                                'Pendiente' => 'badge-info',
                                default => 'badge-inactive',
                            };
                        @endphp
                        <span class="badge-custom {{ $clase_estado }}">{{ $evento['estado'] }}</span>
                    </td>
                    <td>
                        <button class="action-btn" title="Ver Clientes Afectados">
                            <i class="fas fa-search"></i>
                        </button>
                        <button class="action-btn edit" title="Editar Evento">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="action-btn delete" title="Eliminar Evento">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">No se encontraron eventos programados en el calendario.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection