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
                <div class="card kpi-card p-4 shadow-sm" data-table="pagos">
                    <i class="bi bi-piggy-bank-fill fs-1 text-primary mb-2"></i>
                    <p class="text-secondary mb-1">Pagos del mes</p>
                    <h3 class="fw-bold">$ {{ $estadisticas['total_mes_actual'] }}</h3>
                </div>
            </div>
            <div class="col-12 cl-sm-6 col-lg-4">
                <div class="card kpi-card p-4 shadow-sm" data-table="promociones">
                    <i class="bi bi-credit-card-fill fs-1 text-primary mb-2"></i>
                    <p class="text-secondary mb-1">Promociones</p>
                    <h3 class="fw-bold">{{ $estadisticas['num_promociones'] }}</h3>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="card kpi-card p-4 shadow-sm" data-table="tickets">

                    <i class="bi bi-cone-striped fs-1 text-primary mb-2"></i>
                    <p class="text-secondary mb-1">Tickets del dia</p>
                    <h3 class="fw-bold">{{ $estadisticas['num_tickets'] }}</h3>
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


</div>














@endsection