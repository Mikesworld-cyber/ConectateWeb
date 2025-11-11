@extends('layouts.admin')

@section('contenido')
@php
// Datos de clientes con posibles múltiples contratos
$clientes_activos = [
[
'id' => 101,
'nombre' => 'María Fernández',
'contratos' => [
['id' => 'C-101-H', 'plan' => 'Plan Fibra 200 (Casa)', 'monto_deuda' => 45.99],
['id' => 'C-101-N', 'plan' => 'Plan Empresarial (Negocio)', 'monto_deuda' => 89.99]
]
],
[
'id' => 102,
'nombre' => 'Pedro Gómez',
'contratos' => [
['id' => 'C-102-H', 'plan' => 'Plan Básico 50 (Único)', 'monto_deuda' => 29.99]
]
],
];

// Historial de pagos que ahora incluye el ID del contrato
$historial_pagos = [
[
'cliente' => 'María Fernández',
'contrato_id' => 'C-101-H', // Identificador clave
'plan' => 'Plan Fibra 200',
'monto' => 45.99,
'metodo' => 'Transferencia',
'fecha_pago' => '2025-10-28',
'periodo_cubierto' => 'Nov 2025',
'estado' => 'Pagado',
],
[
'cliente' => 'María Fernández',
'contrato_id' => 'C-101-N', // Pago del segundo contrato
'plan' => 'Plan Empresarial',
'monto' => 89.99,
'metodo' => 'Tarjeta Crédito',
'fecha_pago' => '2025-10-28',
'periodo_cubierto' => 'Nov 2025',
'estado' => 'Pagado',
],
[
'cliente' => 'Pedro Gómez',
'contrato_id' => 'C-102-H',
'plan' => 'Plan Básico 50',
'monto' => 29.99,
'metodo' => 'Efectivo',
'fecha_pago' => '2025-10-25',
'periodo_cubierto' => 'Nov 2025',
'estado' => 'Pagado',
],
];
@endphp

<div class="mb-4">
    <h2 class="fs-2 fw-bold text-dark">Gestión de Pagos y Facturación 💵</h2>
    <p class="text-secondary">Registra mensualidades, consulta el estado de cuenta y revisa el historial de pagos de los clientes.</p>
</div>


<div class="content-card mb-5">
    <div class="card-header-custom bg-primary text-white">
        <h3 class="card-title text-white">Registrar Nuevo Pago (Mensualidad)</h3>
    </div>
    <div class="p-4">
        <form>
            <div class="row g-3">
                <div class="col-md-3">
                    <label for="cliente_select" class="form-label fw-bold">Cliente</label>
                    <select id="cliente_select" class="form-control form-select" onchange="loadContratos(this.value)">
                        <option value="">-- Seleccione un cliente --</option>
                        @foreach ($cli as $cliente)
                        <option value="{{ $cliente['id'] }}">{{ $cliente['nombre_user'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="contrato_select" class="form-label fw-bold">Contrato/Servicio</label>
                    <select id="contrato_select" class="form-control form-select">
                        <option value="">-- Seleccione un contrato --</option>
                        {{-- <option value="C-101-H" data-monto="45.99">Fibra 200 (Casa) | $45.99 Deuda</option> --}}
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="monto_pago" class="form-label fw-bold">Monto ($)</label>
                    <input type="number" step="0.01" id="monto_pago" class="form-control" placeholder="Ej: 45.99">
                </div>
                <div class="col-md-2">
                    <label for="metodo_pago" class="form-label fw-bold">Método de Pago</label>
                    <select id="metodo_pago" class="form-control form-select">
                        <option>Transferencia</option>
                        <option>Tarjeta Crédito</option>
                        <option>Efectivo</option>
                        <option>Otro</option>
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-success w-100">
                        <i class="fas fa-check-circle"></i> Registrar
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>



<div class="content-card">
    <div class="card-header-custom">
        <h3 class="card-title">Historial de Pagos Recientes</h3>
        <div class="card-actions">
            <button class="btn btn-outline-primary" title="Buscar Historial por Cliente">
                <i class="fas fa-search"></i> Historial Cliente
            </button>
            <button class="btn-card-action" title="Filtrar por Fecha o Estado">
                <i class="fas fa-filter"></i> Filtrar
            </button>
            <button class="btn-card-action" title="Exportar reporte de pagos">
                <i class="fas fa-download"></i> Exportar
            </button>
        </div>
    </div>

    <div class="table-responsive p-3">
        <table class="modern-table">
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>ID Contrato</th>
                    <th>Plan</th>
                    <th>Monto Pagado</th>
                    <th>Método</th>
                    <th>Periodo Cubierto</th>
                    <th>Fecha de Pago</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($infoPagos as $pago)
                <tr>
                    <td><strong>{{ $pago['nombre_user'] }}</strong></td>
                    <td><span class="text-monospace text-muted">{{ $pago['id'] }}</span></td>
                    <td>Nombre va aqui</td>
                    <td class="fw-bold text-primary">${{ number_format($pago['monto_pago'], 2) }}</td>
                    <td>{{ $pago['metodo_pago'] }}</td>
                    <td><span class="badge bg-secondary text-white">Periodo Cubierto</span></td>
                    <td>{{ $pago['fecha'] }}</td>
                    <td>
                        @php
                        $badge_class = ($pago['estado'] == 'Pagado') ? 'badge-active' : 'badge-inactive';
                        @endphp
                        <span class="badge-custom {{ $badge_class }}">{{ $pago['estado'] }}</span>
                    </td>
                    <td>
                        <button class="action-btn" title="Ver Comprobante"   
                data-bs-toggle="modal" 
                data-bs-target="#modalResumenPago">
                            <i class="fas fa-receipt"></i>
                        </button>
                        <button class="action-btn edit" title="Corregir Pago">
                            <i class="fas fa-pen"></i>
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center text-muted">No se encontraron registros de pagos recientes.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>





<div class="modal fade" id="modalResumenPago" tabindex="-1" aria-labelledby="modalResumenPagoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            @php
                $pago_resumen = [
                    'id_pago' => 101,
                    'cliente' => 'Elena Ríos (ID: C-20230115)',
                    'fecha_pago' => '2025-11-02 14:35:12',
                    'monto_total' => 92.78,
                    'metodo' => 'Tarjeta de Crédito (Visa ****4567)',
                    'estado' => 'Pagado',
                    'periodo' => '01 Nov 2025 - 30 Nov 2025',
                    'admin_registro' => 'Sistema Automático (Stripe)',
                    'detalles_factura' => [
                        ['concepto' => 'Mensualidad Paquete Mega Fibra 500', 'monto' => 79.99],
                        ['concepto' => 'Cargo por Servicio Adicional (IP Fija)', 'monto' => 5.00],
                        ['concepto' => 'Descuento por Promoción (Nov)', 'monto' => -5.00],
                        ['concepto' => 'Impuesto (IVA 16%)', 'monto' => 12.79],
                    ],
                ];
                $estado_clase = ($pago_resumen['estado'] == 'Pagado') ? 'badge-active' : 'badge-inactive';
            @endphp

            <div class="modal-header text-white" style="background-color: #0056b3; border-bottom: 5px solid #007bff;">
                <h5 class="modal-title fs-5 fw-bold" id="modalResumenPagoLabel">
                    <i class="fas fa-receipt me-2"></i> Recibo de Pago #{{ $pago_resumen['id_pago'] }}
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body p-4">
                
                <h5 class="text-primary mb-3" style="color: #007bff !important;"><i class="fas fa-dollar-sign me-2"></i> 1. Resumen y Estado</h5>
                <hr class="mb-4">

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <p class="mb-1 text-secondary small text-uppercase fw-bold">Cliente / Contrato</p>
                        <p class="fs-6 fw-bold">{{ $pago_resumen['cliente'] }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="mb-1 text-secondary small text-uppercase fw-bold">Fecha y Hora de Pago</p>
                        <p class="fs-6 fw-bold">{{ date('d M Y, h:i A', strtotime($pago_resumen['fecha_pago'])) }}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <p class="mb-1 text-secondary small text-uppercase fw-bold">Periodo Cubierto</p>
                        <span class="badge bg-info text-dark fs-6">{{ $pago_resumen['periodo'] }}</span>
                    </div>
                    <div class="col-md-3 mb-3">
                        <p class="mb-1 text-secondary small text-uppercase fw-bold">Método de Pago</p>
                        <p class="fs-6 fw-bold">{{ $pago_resumen['metodo'] }}</p>
                    </div>
                    <div class="col-md-3 mb-3">
                        <p class="mb-1 text-secondary small text-uppercase fw-bold">Estado</p>
                        <span class="badge-custom {{ $estado_clase }} fs-6">{{ $pago_resumen['estado'] }}</span>
                    </div>
                </div>
                
                <h5 class="text-primary my-3" style="color: #007bff !important;"><i class="fas fa-list me-2"></i> 2. Desglose de Factura</h5>
                <hr class="mb-4">
                
                <div class="border rounded p-3 mb-4 shadow-sm">
                    <ul class="list-unstyled mb-0">
                        @foreach ($pago_resumen['detalles_factura'] as $item)
                        <li class="d-flex justify-content-between py-2 border-bottom {{ $item['monto'] < 0 ? 'text-danger' : 'text-dark' }}">
                            <span class="fw-normal">{{ $item['concepto'] }}</span>
                            <span class="fw-bold">${{ number_format(abs($item['monto']), 2) }}</span>
                        </li>
                        @endforeach
                    </ul>
                    
                    <div class="d-flex justify-content-between align-items-center mt-3 pt-3 border-top">
                        <span class="fw-bolder fs-5 text-dark">TOTAL PAGADO:</span>
                        <span class="fs-3 fw-bolder text-success">${{ number_format($pago_resumen['monto_total'], 2) }}</span>
                    </div>
                </div>

                <h5 class="text-primary my-3" style="color: #007bff !important;"><i class="fas fa-user-shield me-2"></i> 3. Trazabilidad</h5>
                <hr class="mb-4">
                <p class="mb-1 text-secondary small text-uppercase fw-bold">Registrado por:</p>
                <p class="text-dark">{{ $pago_resumen['admin_registro'] }}</p>

            </div>

            <div class="modal-footer d-flex justify-content-between">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-arrow-left me-1"></i> Cerrar
                </button>
                <button type="button" class="btn btn-info" title="Generar PDF del recibo">
                    <i class="fas fa-print me-1"></i> Imprimir Recibo
                </button>
            </div>

        </div>
    </div>
</div>
@endsection