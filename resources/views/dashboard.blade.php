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
                    <h3 class="fw-bold">1,234</h3>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="card kpi-card p-4 shadow-sm" data-table="contratos">
                    <i class="bi bi-bar-chart-line-fill fs-1 text-primary mb-2"></i>
                    <p class="text-secondary mb-1">Contratos</p>
                    <h3 class="fw-bold">1,801</h3>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="card kpi-card p-4 shadow-sm">
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
                <div class="card kpi-card p-4 shadow-sm" data-table="registros">

                    <i class="bi bi-boxes fs-1 text-primary mb-2"></i>
                    <p class="text-secondary mb-1">Paquetes</p>
                    <h3 class="fw-bold">5</h3>
                </div>
            </div>

        </div>
    </section>

    <!-- RECENT CLIENTS TABLE -->
    <div class="content-card">
        <div id="table-container">
            <div class="text-center p-5 text-muted">Cargando la tabla...</div>
        </div>
    </div>





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














<div class="modal fade" id="registroContratoModal" tabindex="-1" aria-labelledby="registroContratoLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl"> {{-- Usamos modal-xl (extra grande) para dar espacio --}}
        <div class="modal-content">

            <div class="modal-header text-white" style="background-color: #0056b3; border-bottom: 5px solid #007bff;">
                <h5 class="modal-title fs-5 fw-bold" id="registroContratoLabel">
                    <i class="fas fa-file-signature me-2"></i> Registrar Nuevo Contrato de Servicio
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-4">

                {{-- ⬅️ INCLUIMOS LA ESTRUCTURA DEL FORMULARIO DE CONTRATOS AQUÍ ⬅️ --}}
                <form method="POST" action="#">
                    @csrf

                    <h5 class="text-primary mb-3" style="color: #007bff !important;">1. Datos del Cliente</h5>
                    <hr class="mb-4">

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="id_usuario" class="form-label fw-bold">Buscar Cliente (*)</label>
                            <select class="form-select @error('id_usuario') is-invalid @enderror" id="id_usuario" name="id_usuario" required>
                                <option value="">Buscar por Nombre o Correo...</option>
                                {{-- Los datos de $usuarios se pasan desde el controlador que renderiza el dashboard --}}
                                @isset($clientesmodal)
                                @foreach ($clientesmodal as $cliente)
                                <option value="{{ $cliente['id'] }}">{{ $cliente['nombre_user'] }} ({{ $cliente['nickname'] }})</option>
                                @endforeach
                                @endisset
                            </select>
                            @error('id_usuario') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="id_administrador" class="form-label fw-bold">Administrador (*)</label>
                            {{-- Usamos un campo oculto o solo mostramos el nombre --}}
                            @if (!empty($admin))
                            <input type="text" class="form-control" value="{{ $admin['nombres'] }} {{ $admin['apellidos'] }}" readonly>
                            {{-- Y si necesitas enviar el ID, usa un campo oculto: --}}
                            <input type="hidden" name="id_administrador" value="{{ $admin['id'] }}">
                            @else
                            <input type="text" class="form-control is-invalid" value="Administrador no encontrado" readonly>
                            @endif
                        </div>
                    </div>

                    <h5 class="text-primary my-3" style="color: #007bff !important;">2. Detalles del Paquete</h5>
                    <hr class="mb-4">

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="id_paquete" class="form-label fw-bold">Seleccionar Paquete (*)</label>
                            <select class="form-select @error('id_paquete') is-invalid @enderror" id="id_paquete" name="id_paquete" required>
                                @isset($paquetesmodal)
                                @foreach ($paquetesmodal as $paquete)
                                <option value="{{ $paquete['id'] }}">
                                    {{ $paquete['nombre'] }} ({{ $paquete['velocidad_bajada'] }} - ${{ number_format($paquete['precio'], 2) }})
                                </option>
                                @endforeach
                                @endisset
                            </select>
                            @error('id_paquete') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-3 mb-4">
                            <label for="duracion" class="form-label fw-bold">Duración (Meses)</label>
                            <input type="number" class="form-control" id="duracion" name="duracion" value="12" required min="1">
                        </div>

                        <div class="col-md-3 mb-4">
                            <label for="fecha_cobro" class="form-label fw-bold">Día de Cobro del Mes (*)</label>
                            <input type="number" class="form-control" id="fecha_cobro" name="fecha_cobro" value="1" required min="1" max="28">
                        </div>

                        <div class="col-12 mb-4">
                            <label for="clausulas" class="form-label fw-bold">Cláusulas / Notas</label>
                            <textarea class="form-control" id="clausulas" name="clausulas" rows="2"></textarea>
                        </div>
                    </div>

                    <div class="modal-footer d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" style="background-color: #007bff; border-color: #007bff;">
                            <i class="fas fa-doc me-2"></i> Generar doc
                        </button>
                        <button type="submit" class="btn btn-primary" style="background-color: #007bff; border-color: #007bff;">
                            <i class="fas fa-save me-2"></i> Confirmar Contrato
                        </button>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>

@endsection