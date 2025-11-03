@extends('layouts.admin')

@section('contenido')
@php
    $metricas_tickets = [
        'abiertos' => ['valor' => 12, 'descripcion' => 'Tickets pendientes de asignación', 'icono' => 'fas fa-envelope-open', 'clase' => 'warning'],
        'en_proceso' => ['valor' => 5, 'descripcion' => 'Tickets siendo atendidos', 'icono' => 'fas fa-sync-alt', 'clase' => 'info'],
        'cerrados_hoy' => ['valor' => 8, 'descripcion' => 'Tickets solucionados hoy', 'icono' => 'fas fa-check-circle', 'clase' => 'success'],
        'alta_prioridad' => ['valor' => 3, 'descripcion' => 'Tickets críticos (Internet caído)', 'icono' => 'fas fa-exclamation-triangle', 'clase' => 'danger'],
    ];

    $tickets_recientes = [
        [
            'id' => 'TKT-0045',
            'cliente' => 'Roberto Páez',
            'asunto' => 'Fallo total de servicio (Noche)',
            'prioridad' => 'Alta',
            'estado' => 'Abierto',
            'fecha_creacion' => '2025-11-01 19:30',
            'asignado_a' => 'Sin Asignar',
        ],
        [
            'id' => 'TKT-0044',
            'cliente' => 'Laura Solano',
            'asunto' => 'Velocidad muy lenta intermitente',
            'prioridad' => 'Media',
            'estado' => 'En Proceso',
            'fecha_creacion' => '2025-11-01 10:15',
            'asignado_a' => 'Técnico 1',
        ],
        [
            'id' => 'TKT-0043',
            'cliente' => 'Fidel Castro',
            'asunto' => 'Duda sobre facturación del mes',
            'prioridad' => 'Baja',
            'estado' => 'Cerrado',
            'fecha_creacion' => '2025-10-31 16:00',
            'asignado_a' => 'Agente 3',
        ],
    ];
@endphp

<div class="mb-4">
    <h2 class="fs-2 fw-bold text-dark">Mesa de Ayuda y Tickets 🚨</h2>
    <p class="text-secondary">Monitorea los reportes y gestiona las solicitudes de soporte técnico y servicio al cliente.</p>
</div>

<div class="row mb-5">
    @foreach ($metricas_tickets as $metrica)
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card h-100 shadow-sm border-start-{{ $metrica['clase'] }} p-3">
            <div class="d-flex align-items-center">
                <i class="{{ $metrica['icono'] }} fa-2x text-{{ $metrica['clase'] }} me-3"></i>
                <div>
                    <div class="text-secondary text-uppercase fw-bold small">{{ $metrica['descripcion'] }}</div>
                    <div class="fs-4 fw-bold text-dark">{{ $metrica['valor'] }}</div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

---

<div class="content-card">
    <div class="card-header-custom">
        <h3 class="card-title">Tickets Abiertos y Recientes</h3>
        <div class="card-actions">
            <button class="btn btn-primary" title="Crear Ticket a Nombre de Cliente">
                <i class="fas fa-plus-circle"></i> Crear Nuevo Ticket
            </button>
            <button class="btn-card-action" title="Buscar tickets específicos">
                <i class="fas fa-search"></i> Buscar
            </button>
            <button class="btn-card-action" title="Filtrar por Asignación, Prioridad o Estado">
                <i class="fas fa-filter"></i> Filtrar
            </button>
        </div>
    </div>

    <div class="table-responsive p-3">
        <table class="modern-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Asunto</th>
                    <th>Cliente</th>
                    <th>Prioridad</th>
                    <th>Estado</th>
                    <th>Asignado a</th>
                    <th>Creado en</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tickets_recientes as $ticket)
                <tr>
                    <td><span class="text-primary fw-bold">{{ $ticket['id'] }}</span></td>
                    <td>{{ $ticket['asunto'] }}</td>
                    <td><strong>{{ $ticket['cliente'] }}</strong></td>
                    <td>
                        @php
                            $p_class = match($ticket['prioridad']) {
                                'Alta' => 'badge-danger',
                                'Media' => 'badge-warning',
                                default => 'badge-info',
                            };
                        @endphp
                        <span class="badge-custom {{ $p_class }}">{{ $ticket['prioridad'] }}</span>
                    </td>
                    <td>
                        @php
                            $e_class = match($ticket['estado']) {
                                'Abierto' => 'badge-inactive', // Rojo/Naranja para que se resuelva rápido
                                'En Proceso' => 'badge-warning', // Amarillo
                                'Cerrado' => 'badge-active', // Verde
                                default => 'badge-secondary',
                            };
                        @endphp
                        <span class="badge-custom {{ $e_class }}">{{ $ticket['estado'] }}</span>
                    </td>
                    <td>{{ $ticket['asignado_a'] }}</td>
                    <td>{{ date('Y-m-d', strtotime($ticket['fecha_creacion'])) }}</td>
                    <td>
                        <button class="action-btn" title="Ver Detalles y Conversación">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="action-btn edit" title="Asignar o Editar">
                            <i class="fas fa-user-tag"></i>
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted">¡No hay tickets abiertos! Buen trabajo.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection