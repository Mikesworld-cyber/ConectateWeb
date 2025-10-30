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
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header text-white" style="background-color: #0056b3; border-bottom: 5px solid #007bff;">
                <h5 class="modal-title fs-5 fw-bold" id="registroContratoLabel">
                    <i class="fas fa-file-signature me-2"></i> Registrar Nuevo Contrato de Servicio
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-4">
                
                <form method="POST" action="#">
                    @csrf

                    {{-- 1. DATOS DEL CLIENTE --}}
                    <h5 class="text-primary mb-3" style="color: #007bff !important;">1. Datos del Cliente</h5>
                    <hr class="mb-4">

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="id_usuario" class="form-label fw-bold">Buscar Cliente (*)</label>
                            {{-- ... (Contenido del SELECT de Cliente sin cambios) ... --}}
                            <select class="form-select @error('id_usuario') is-invalid @enderror" id="id_usuario" name="id_usuario" required>
                                <option value="">Buscar por Nombre o Correo...</option>
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
                            {{-- ... (Contenido de Administrador sin cambios) ... --}}
                            @if (!empty($admin))
                                <input type="text" class="form-control" value="{{ $admin['nombres'] }} {{ $admin['apellidos'] }}" readonly>
                                <input type="hidden" name="id_administrador" value="{{ $admin['id'] }}">
                            @else
                                <input type="text" class="form-control is-invalid" value="Administrador no encontrado" readonly>
                            @endif
                        </div>
                    </div>

                    {{-- 2. DETALLES DEL PAQUETE --}}
                    <h5 class="text-primary my-3" style="color: #007bff !important;">2. Detalles del Paquete</h5>
                    <hr class="mb-4">

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="id_paquete" class="form-label fw-bold">Seleccionar Paquete (*)</label>
                            {{-- Modificamos el SELECT para incluir el precio como data-attribute --}}
                            <select class="form-select @error('id_paquete') is-invalid @enderror" id="id_paquete" name="id_paquete" required>
                                <option value="" data-precio="0">Seleccione un paquete...</option>
                                @isset($paquetesmodal)
                                    @foreach ($paquetesmodal as $paquete)
                                        <option value="{{ $paquete['id'] }}" 
                                                data-precio="{{ $paquete['precio'] }}"> 
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
        {{-- Mantenemos el campo numérico para el DÍA del mes, pero le quitamos el 'required' inicial 
             y el 'value' fijo para que JS lo llene. --}}
        <input type="number" 
               class="form-control" 
               id="fecha_cobro" 
               name="fecha_cobro" 
               value="{{ date('d') }}" {{-- Valor inicial: el día actual --}}
               min="1" max="28">
        <small class="form-text text-muted">Se sugiere el mismo día del contrato o el día 1.</small>
    </div>

    {{-- AÑADIR CAMPO OCULTO para el día exacto de contrato (para referencia) --}}
    <input type="hidden" id="dia_contrato_original" value="{{ date('d') }}">

                        <div class="col-12 mb-4">
                            <label for="clausulas" class="form-label fw-bold">Cláusulas / Notas</label>
                            <textarea class="form-control" id="clausulas" name="clausulas" rows="2"></textarea>
                        </div>
                    </div>

                    {{-- 3. COSTOS Y PROMOCIONES (NUEVA SECCIÓN) --}}
                    <h5 class="text-primary my-3" style="color: #007bff !important;">3. Costos, Instalación y Promociones</h5>
                    <hr class="mb-4">

                    <div class="row">
                        {{-- Campo de Costo de Instalación --}}
                        <div class="col-md-4 mb-4">
                            <label for="costo_instalacion" class="form-label fw-bold">Costo de Instalación ($)</label>
                            <input type="number" step="0.01" class="form-control" id="costo_instalacion" name="costo_instalacion" value="500.00" min="0">
                        </div>
                        
                        {{-- Selección de Promociones --}}
                        <div class="col-md-4 mb-4">
                            <label for="id_promocion" class="form-label fw-bold">Aplicar Promoción</label>
                            {{-- Modificamos el SELECT para incluir el descuento como data-attribute --}}
                            <select class="form-select" id="id_promocion" name="id_promocion">
                                <option value="0" data-descuento="0">Sin Promoción</option>
                                @isset($promocionesmodal)
                                    @foreach ($promocionesmodal as $promo)
                                        <option value="{{ $promo['id'] }}" 
                                                data-descuento="{{ $promo['descuento'] }}">
                                            {{ $promo['nombre'] }} ({{ $promo['descuento'] }}% OFF)
                                        </option>
                                    @endforeach
                                @endisset
                            </select>
                        </div>
                        
                        {{-- Resumen de Costos (Mostrar Total) --}}
                        <div class="col-md-4 mb-4">
                            <label class="form-label fw-bold">Resumen de Pago Inicial</label>
                            <div class="p-3 border rounded" style="background-color: #f8f9fa;">
                                <p class="mb-1 d-flex justify-content-between">
                                    <span>Paquete (1er Mes):</span> 
                                    <span id="resumen-paquete">$0.00</span>
                                </p>
                                <p class="mb-1 d-flex justify-content-between">
                                    <span>Instalación:</span> 
                                    <span id="resumen-instalacion">$500.00</span>
                                </p>
                                <p class="mb-1 text-danger d-flex justify-content-between">
                                    <span>Descuento Promoción:</span> 
                                    <span id="resumen-descuento">$0.00</span>
                                </p>
                                <hr class="my-2">
                                <h5 class="d-flex justify-content-between text-success">
                                    <span>Total a Pagar:</span> 
                                    <span id="resumen-total">$500.00</span>
                                </h5>
                                {{-- Campo oculto para enviar el total al backend --}}
                                <input type="hidden" name="monto_total_inicial" id="monto_total_inicial_input" value="500.00">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        
                        {{-- Botón Generar Doc (usarás JS para obtener los datos y generar el PDF) --}}
                        <button type="button" class="btn btn-info" id="btn-generar-doc" style="background-color: #17a2b8; border-color: #17a2b8;">
                            <i class="fas fa-file-pdf me-2"></i> Generar Contrato PDF
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