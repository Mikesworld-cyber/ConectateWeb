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
                        @foreach ($clientes_activos as $cliente)
                        <option value="{{ $cliente['id'] }}">{{ $cliente['nombre'] }}</option>
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
                    <td>{{ $pago['nombre'] }}</td>
                    <td class="fw-bold text-primary">${{ number_format($pago['monto_pago'], 2) }}</td>
                    <td>{{ $pago['metodo_pago'] }}</td>
                    <td><span class="badge bg-secondary text-white">{{ $pago['periodo'] }}</span></td>
                    <td>{{ $pago['fecha'] }}</td>
                    <td>
                        @php
                        $badge_class = ($pago['estado'] == 'Pagado') ? 'badge-active' : 'badge-inactive';
                        @endphp
                        <span class="badge-custom {{ $badge_class }}">{{ $pago['estado'] }}</span>
                    </td>
                    <td>
                        <button class="action-btn" title="Ver Comprobante">
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
@endsection