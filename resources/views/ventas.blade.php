@extends('layouts.admin')

@section('contenido')
@php
    $metricas_ventas = [
        'total_mensual' => [
            'valor' => '+$8,500.00',
            'descripcion' => 'Ventas netas este mes',
            'icono' => 'fas fa-chart-line',
            'tendencia' => 'up', // 'up' o 'down'
        ],
        'nuevos_clientes' => [
            'valor' => '42',
            'descripcion' => 'Nuevas suscripciones',
            'icono' => 'fas fa-user-plus',
            'tendencia' => 'up',
        ],
        'cancelaciones' => [
            'valor' => '5',
            'descripcion' => 'Planes cancelados',
            'icono' => 'fas fa-user-minus',
            'tendencia' => 'down',
        ],
        'valor_promedio' => [
            'valor' => '$55.00',
            'descripcion' => 'Valor promedio del plan',
            'icono' => 'fas fa-dollar-sign',
            'tendencia' => 'up',
        ],
    ];

    $ventas_recientes = [
        [
            'cliente' => 'Sofía Ramírez',
            'plan' => 'Plan Mega Fibra 500',
            'monto' => 79.99,
            'fecha' => '2025-11-01',
            'estado' => 'Activa',
        ],
        [
            'cliente' => 'Jorge Mendoza',
            'plan' => 'Internet Básico 100',
            'monto' => 35.50,
            'fecha' => '2025-10-31',
            'estado' => 'Pendiente',
        ],
        [
            'cliente' => 'Ana Pérez',
            'plan' => 'Plan Empresarial',
            'monto' => 125.00,
            'fecha' => '2025-10-30',
            'estado' => 'Activa',
        ],
        [
            'cliente' => 'Carlos López',
            'plan' => 'Plan Giga Gamer',
            'monto' => 99.99,
            'fecha' => '2025-10-30',
            'estado' => 'Cancelada',
        ],
    ];
@endphp

<div class="mb-4">
    <h2 class="fs-2 fw-bold text-dark">Dashboard de Ventas 💰</h2>
    <p class="text-secondary">Monitorea el rendimiento, las suscripciones y el valor de los nuevos contratos de internet.</p>
</div>

<div class="row mb-5">
    @foreach ($metricas_ventas as $key => $metrica)
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card h-100 shadow-sm border-start-{{ $metrica['tendencia'] == 'up' ? 'success' : 'danger' }} p-3">
            <div class="d-flex align-items-center">
                <i class="{{ $metrica['icono'] }} fa-2x text-primary me-3"></i>
                <div>
                    <div class="text-secondary text-uppercase fw-bold small">{{ str_replace('_', ' ', $key) }}</div>
                    <div class="fs-4 fw-bold text-dark d-flex align-items-center">
                        {{ $metrica['valor'] }}
                        <small class="ms-2 badge bg-{{ $metrica['tendencia'] == 'up' ? 'success' : 'danger' }} bg-opacity-10 text-{{ $metrica['tendencia'] == 'up' ? 'success' : 'danger' }}">
                            <i class="fas fa-arrow-{{ $metrica['tendencia'] }}"></i>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

<div class="content-card">
    <div class="card-header-custom">
        <h3 class="card-title">Ventas Recientes (Últimos 7 Días)</h3>
        <div class="card-actions">
            <button class="btn btn-success" title="Registrar Nueva Venta">
                <i class="fas fa-handshake"></i> Registrar Venta
            </button>
            <button class="btn-card-action" title="Ver todos los reportes de ventas">
                <i class="fas fa-file-invoice-dollar"></i> Reportes
            </button>
        </div>
    </div>

    <div class="table-responsive p-3">
        <table class="modern-table">
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Plan Vendido</th>
                    <th>Monto del Contrato</th>
                    <th>Fecha de Venta</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($ventas_recientes as $venta)
                <tr>
                    <td><strong>{{ $venta['cliente'] }}</strong></td>
                    <td><span class="badge bg-info text-dark">{{ $venta['plan'] }}</span></td>
                    <td class="fw-bold text-success">${{ number_format($venta['monto'], 2) }}</td>
                    <td>{{ $venta['fecha'] }}</td>
                    <td>
                        @php
                            $badge_class = 'badge-secondary';
                            if ($venta['estado'] == 'Activa') {
                                $badge_class = 'badge-active';
                            } elseif ($venta['estado'] == 'Pendiente') {
                                $badge_class = 'badge-warning'; // Asumiendo que tienes un estilo para warning/pendiente
                            } elseif ($venta['estado'] == 'Cancelada') {
                                $badge_class = 'badge-inactive';
                            }
                        @endphp
                        <span class="badge-custom {{ $badge_class }}">{{ $venta['estado'] }}</span>
                    </td>
                    <td>
                        <button class="action-btn" title="Ver Detalles de Venta">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="action-btn edit" title="Modificar Contrato">
                            <i class="fas fa-edit"></i>
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">No se han registrado ventas en el periodo seleccionado.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection