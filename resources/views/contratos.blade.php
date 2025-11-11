@extends('layouts.admin')

@section('contenido')
<label>
    <meter
    value="80"
    min="0"
    max="100"
    low="30"
    high="80"
    optimum="100"
    ></meter>
</label>
<div class="mb-4">
    <h2 class="fs-2 fw-bold text-dark">Gestión de Contratos</h2>
    <p class="text-secondary">Crea, modifica y monitorea los contratos de servicio.</p>
</div>

<div class="content-card">
    <div class="card-header-custom">
        <h3 class="card-title">Contratos</h3>
        <div class="card-actions">
            <button type="button"
                class="btn btn-primary btn-sm"
                data-bs-toggle="modal"
                data-bs-target="#registroContratoModal">
                <i class="fas fa-plus"></i> Nuevo Contrato
            </button>
            <button class="btn-card-action">
                <i class="fas fa-filter"></i> Filtrar
            </button>
            <button class="btn-card-action">
                <i class="fas fa-download"></i> Exportar
            </button>
        </div>
    </div>

    <div class="table-responsive p-3">
        <table class="modern-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>CLIENTE</th>
                    <th>ADMINISTRADOR</th>
                    <th>PAQUETE DE INTERNET</th>
                    <th>MENSUALIDAD</th>
                    <th>DURACIÓN / PROGRESO</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($clientes as $cliente)
                @php
                // Asegúrate de que las claves de tu API sean correctas (ej: duracion vs duracion_meses)
                $fechaInicio = \Carbon\Carbon::parse($cliente['fecha_contrato']);
                $duracionTotalMeses = $cliente['duracion_meses'] ?? 12; // Usamos 12 por defecto si falta

                // Fecha final del contrato
                $fechaFin = $fechaInicio->copy()->addMonths($duracionTotalMeses);

                // Días totales del contrato
                $diasTotales = $fechaInicio->diffInDays($fechaFin);

                // Días transcurridos hasta hoy
                $diasTranscurridos = $fechaInicio->diffInDays(now());

                // Calcular el porcentaje (mínimo 0, máximo 100)
                $progreso = min(100, max(0, ($diasTranscurridos / $diasTotales) * 100));

                // Determinar color y texto de la barra
                $colorClass = 'blue'; // Por defecto: Verde
                if ($progreso > 75) {
                $colorClass = 'bg-warning'; // Si está a punto de vencer (amarillo)
                }
                if ($progreso >= 100) {
                $colorClass = 'bg-danger'; // Vencido (rojo)
                }

                // Texto que se mostrará en la barra
                $progresoTexto = round($progreso) . '% completado';
                if ($progreso >= 100) {
                $progresoTexto = 'VENCIDO';
                }
                if ($cliente['estado_contrato'] === 'cancelado') {
                $progresoTexto = 'CANCELADO';
                $colorClass = 'bg-secondary';
                }
                @endphp


                <tr>
                    <td><strong>{{ $cliente['contrato_id'] }}</strong></td>
                    <td>{{ $cliente['cliente'] }}</td>
                    <td>{{ $cliente['administrador'] }}</td>
                    <td><span class="badge-custom badge-active">{{ $cliente['paquete_contratado'] }}</span></td>
                    <td>{{ $cliente['precio_mensual'] }}</td>
                    <td>
                        <div class="fw-bold mb-1">{{ $progresoTexto }}</div>
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar {{ $colorClass }}"
                                role="progressbar"
                                style="width: {{ $progreso }}%"
                                aria-valuenow="{{ round($progreso) }}"
                                aria-valuemin="0"
                                aria-valuemax="100">
                            </div>
                        </div>
                        <small class="text-muted">Finaliza: {{ $fechaFin->format('d M Y') }}</small>
                    </td>
                    <td>
                        <a href="{{ url('/generar-pdf/' . $cliente['contrato_id']) }}"
                            target="_blank"
                            class="btn btn-primary action-btn"
                            title="PDF">
                            <i class="bi bi-file-earmark-pdf-fill"></i> Exportar PDF
                        </a>
                        <button class="action-btn" title="Ver detalles">
                            <i class="fas fa-eye"></i>
                        </button>

                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">No se encontraron paquetes de internet disponibles.</td>
                </tr>
                <!-- <script>
                    // Convierte el array PHP a un objeto JSON válido para JavaScript
                    const clientes = @json($clientes);

                    // Ahora puedes usar el objeto 'clientes' en JavaScript
                    console.log(clientes);

                    // Si solo quieres mostrar el total de clientes, por ejemplo:
                </script> -->
                @endforelse

            </tbody>
        </table>
    </div>
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

                <form method="POST" id="formRegistroContrato" action="{{ route('contratos.store') }}">
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


                        <input type="hidden" id="monto_mensual" name="monto_mensual" value="">

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
                    {{-- 4. MÉTODO DE PAGO --}}

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="tipopago" class="form-label fw-bold">Método de Pago (*)</label>
                            <select class="form-select @error('tipopago') is-invalid @enderror" id="tipopago" name="tipopago" required>
                                <option value="">Seleccionar método...</option>
                                <option value="tarjeta">Tarjeta</option>
                                <option value="efectivo">Efectivo</option>
                                <option value="transferencia">Transferencia</option>
                            </select>
                            @error('tipopago') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

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

                        <input type="hidden" id="id_promocions" name="id_promocions" value="">

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

                        <button type="submit" class="btn btn-primary" style="background-color: #007bff; border-color: #007bff;" id="btn-confirmar-contrato">
                            <i class="fas fa-save me-2"></i> Confirmar Contrato
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection