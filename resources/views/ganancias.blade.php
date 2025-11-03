@extends('layouts.admin')

@section('contenido')
@php
    $metricas_financieras = [
        'ingreso_mensual' => [
            'valor' => '$15,870.00',
            'descripcion' => 'Ingreso Neto (Último Mes)',
            'icono' => 'fas fa-money-check-alt',
            'color' => 'success',
            'tendencia' => '+5.2%',
        ],
        'margen_beneficio' => [
            'valor' => '32.5%',
            'descripcion' => 'Margen de Beneficio Neto',
            'icono' => 'fas fa-percentage',
            'color' => 'primary',
            'tendencia' => '-1.1%',
        ],
        'costos_operacionales' => [
            'valor' => '$7,500.00',
            'descripcion' => 'Costos Operacionales Totales',
            'icono' => 'fas fa-hand-holding-usd',
            'color' => 'danger',
            'tendencia' => '+2.3%',
        ],
        'churrn_rate' => [
            'valor' => '1.8%',
            'descripcion' => 'Tasa de Abandono (Clientes)',
            'icono' => 'fas fa-minus-circle',
            'color' => 'info',
            'tendencia' => '-0.4%',
        ],
    ];
    
    // Datos simulados para gráficos (en un entorno real, usarías una librería como Chart.js o ApexCharts)
    $datos_ingresos = [12000, 13500, 14000, 15870, 15500]; // Últimos 5 meses
    $meses = ['Jun', 'Jul', 'Ago', 'Sep', 'Oct'];
@endphp

<div class="mb-4">
    <h2 class="fs-2 fw-bold text-dark">Finanzas y Rendimiento 📈</h2>
    <p class="text-secondary">Visualiza los indicadores clave de ingresos, costos y el estado financiero general de la empresa.</p>
</div>

<div class="row mb-5">
    @foreach ($metricas_financieras as $key => $metrica)
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card h-100 shadow-sm border-start-{{ $metrica['color'] }} p-3">
            <div class="d-flex align-items-center">
                <i class="{{ $metrica['icono'] }} fa-2x text-{{ $metrica['color'] }} me-3"></i>
                <div>
                    <div class="text-secondary text-uppercase fw-bold small">{{ $metrica['descripcion'] }}</div>
                    <div class="fs-4 fw-bold text-dark d-flex align-items-center">
                        {{ $metrica['valor'] }}
                        <small class="ms-2 badge bg-{{ Str::contains($metrica['tendencia'], '+') ? 'success' : 'danger' }} bg-opacity-10 text-dark">
                            {{ $metrica['tendencia'] }}
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
<div class="row">
    <div class="col-lg-8 mb-4">
        <div class="content-card h-100">
            <div class="card-header-custom">
                <h3 class="card-title">Tendencia de Ingresos Netos (Mensual)</h3>
                <button class="btn-card-action" title="Cambiar periodo">
                    <i class="fas fa-calendar-alt"></i> Últimos 6 Meses
                </button>
            </div>
            <div class="p-3">
                <div class="chart-container" style="height: 300px;">
                    <p class="text-center text-muted pt-5">
                        
                        
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 mb-4">
        <div class="content-card h-100 p-4 d-flex flex-column justify-content-center bg-light">
            <div class="text-center">
                <i class="fas fa-chart-pie fa-3x text-info mb-3"></i>
                <div class="text-secondary text-uppercase fw-bold small">ARPU (Ingreso Promedio por Usuario)</div>
                <div class="fs-1 fw-bold text-dark mb-2">$55.00</div>
                <p class="text-muted small">Métrica clave para medir la rentabilidad por cliente.</p>
                <button class="btn btn-sm btn-outline-info">Ver Detalle por Plan</button>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="content-card">
            <div class="card-header-custom">
                <h3 class="card-title">Detalle de Costos Operacionales Recientes</h3>
                <div class="card-actions">
                    <button class="btn-card-action">
                        <i class="fas fa-filter"></i> Categoría
                    </button>
                </div>
            </div>
            <div class="table-responsive p-3">
                <table class="modern-table">
                    <thead>
                        <tr>
                            <th>Concepto</th>
                            <th>Categoría</th>
                            <th>Monto</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Alquiler de Rack/Servidor</td>
                            <td>Infraestructura</td>
                            <td class="text-danger fw-bold">-$2,500.00</td>
                            <td>2025-11-01</td>
                            <td>Pagado</td>
                        </tr>
                        <tr>
                            <td>Salarios Equipo Técnico</td>
                            <td>Personal</td>
                            <td class="text-danger fw-bold">-$4,000.00</td>
                            <td>2025-10-30</td>
                            <td>Pagado</td>
                        </tr>
                        <tr>
                            <td>Licencias de Software NMS</td>
                            <td>Software</td>
                            <td class="text-danger fw-bold">-$500.00</td>
                            <td>2025-10-25</td>
                            <td>Pendiente</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection