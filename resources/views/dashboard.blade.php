@extends('layouts.admin')


@section('contenido')
<div class="container py-5">
    <h1 class="mb-4 fw-bold">Panel Principal</h1>

    <section class="mb-5">
        <h2 class="h5 mb-3 fw-semibold">Resumen</h2>
        <div class="row g-4">
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="card kpi-card p-4 shadow-sm" data-table="clientes">
                    <i class="bi bi-people-fill fs-1 text-primary mb-2"></i>
                    <p class="text-secondary mb-1">Clientes Activos</p>
                    <h3 class="fw-bold">{{ $estadisticas['usuarios_activos'] }}</h3>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="card kpi-card p-4 shadow-sm" data-table="contratos">
                    <i class="bi bi-bar-chart-line-fill fs-1 text-primary mb-2"></i>
                    <p class="text-secondary mb-1">Contratos</p>
                    <h3 class="fw-bold">{{ $estadisticas['num_contratos'] }}</h3>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="card kpi-card p-4 shadow-sm" data-table="ingresos">
                     <i class="bi bi-piggy-bank-fill fs-1 text-primary mb-2"></i>
                    <p class="text-secondary mb-1">Ingresos</p>
                    <h3 class="fw-bold">$250,000</h3>
                </div>
            </div>
            <div class="col-12 cl-sm-6 col-lg-4">
                <div class="card kpi-card p-4 shadow-sm">
                    <i class="bi bi-credit-card-fill fs-1 text-primary mb-2"></i>
                    <p class="text-secondary mb-1">Pagos Recibidos</p>
                    <h3 class="fw-bold">$200,000</h3>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="card kpi-card p-4 shadow-sm">

                    <i class="bi bi-cone-striped fs-1 text-primary mb-2"></i>
                    <p class="text-secondary mb-1">Configuraciones</p>
                    <h3 class="fw-bold">$250,000</h3>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="card kpi-card p-4 shadow-sm" data-table="paquetes">

                    <i class="bi bi-boxes fs-1 text-primary mb-2"></i>
                    <p class="text-secondary mb-1">Paquetes</p>
                    <h3 class="fw-bold">{{ $estadisticas['num_paquetes'] }}</h3>
                </div>
            </div>

        </div>
    </section>

    <!-- RECENT CLIENTS TABLE -->
    <!-- <div class="content-card">
        <div id="table-container">
            <div class="text-center p-5 text-muted">Cargando la tabla...</div>
        </div>
    </div> -->





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


</div>














@endsection