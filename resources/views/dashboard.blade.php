@extends('layouts.app')

@section('title', 'NetConnect Dashboard')

@section('content')
<div class="container py-5">
    <h1 class="mb-4 fw-bold">Panel Principal</h1>

    <section class="mb-5">
        <h2 class="h5 mb-3 fw-semibold">Resumen</h2>
        <div class="row g-4">
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="card p-4 shadow-sm">
                    <p class="text-secondary mb-1">Clientes Activos</p>
                    <h3 class="fw-bold">1,234</h3>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="card p-4 shadow-sm">
                    <p class="text-secondary mb-1">Clientes Inactivos</p>
                    <h3 class="fw-bold">567</h3>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="card p-4 shadow-sm">
                    <p class="text-secondary mb-1">Contratos</p>
                    <h3 class="fw-bold">1,801</h3>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="card p-4 shadow-sm">
                    <p class="text-secondary mb-1">Ingresos</p>
                    <h3 class="fw-bold">$250,000</h3>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="card p-4 shadow-sm">
                    <p class="text-secondary mb-1">Pagos Recibidos</p>
                    <h3 class="fw-bold">$200,000</h3>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="card p-4 shadow-sm">
                    <p class="text-secondary mb-1">Tickets Abiertos</p>
                    <h3 class="fw-bold">25</h3>
                </div>
            </div>
        </div>
    </section>

    <section class="mb-5">
        <h2 class="h5 mb-3 fw-semibold">Progreso</h2>

        <div class="card p-4 mb-3 shadow-sm">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <p class="mb-0">Pagos Recibidos</p>
                <strong class="text-primary-custom">100%</strong>
            </div>
            <div class="progress" style="height: 10px;">
                <div class="progress-bar" style="width: 100%"></div>
            </div>
        </div>

        <div class="card p-4 shadow-sm">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <p class="mb-0">Tickets Resueltos</p>
                <strong class="text-primary-custom">100%</strong>
            </div>
            <div class="progress" style="height: 10px;">
                <div class="progress-bar" style="width: 100%"></div>
            </div>
        </div>
    </section>

    <section>
        <h2 class="h5 mb-3 fw-semibold">Accesos Rápidos</h2>
        <div class="row g-3">
            <div class="col-6 col-md-3">
                <button class="btn w-100 py-3 fw-bold d-flex align-items-center justify-content-center">
                    <span class="material-symbols-outlined me-2"></span>
                    Ver Clientes
                </button>
            </div>
            <div class="col-6 col-md-3">
                <button class="btn btn-primary-custom w-100 py-3 fw-bold d-flex align-items-center justify-content-center">
                    <span class="material-symbols-outlined me-2"></span>
                    Ver Contratos
                </button>
            </div>
            <div class="col-6 col-md-3">
                <button class="btn btn-primary-custom w-100 py-3 fw-bold d-flex align-items-center justify-content-center">
                    <span class="material-symbols-outlined me-2"></span>
                    Ver Pagos
                </button>
            </div>
            <div class="col-6 col-md-3">
                <button class="btn btn-primary-custom w-100 py-3 fw-bold d-flex align-items-center justify-content-center">
                    <span class="material-symbols-outlined me-2"></span>
                    Ver Tickets
                </button>
            </div>
        </div>
    </section>
</div>
@endsection