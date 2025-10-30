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

    <div class="table-responsive">
        <table class="modern-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>CLIENTE</th>
                    <th>CORREO</th>
                    

                    
                    <th>PAQUETE DE INTERNET</th>
                    <th>FECHA DE CONTRATO</th> 
                                                           {{-- COLUMNA MODIFICADA --}}
                    <th>DURACIÓN / PROGRESO</th> 
                    <th>ACCIONES</th>

                </tr>
            </thead>
            <tbody>
                @forelse ($clientes as $cliente)
                    {{-- 💡 Calculamos el progreso por cada contrato --}}
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
                        <td>{{ $cliente['correo_cliente'] }}</td>
                        
                       
                        
                        <td><span class="badge-custom badge-active">{{ $cliente['paquete_contratado'] }}</span></td>
                        <td>{{ $cliente['fecha_contrato'] }}</td>
                         {{-- CELDA DE PROGRESO --}}
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
                        {{-- Celdas de acciones --}}
                        <td>
                            <a href="{{ url('/generar-pdf/' . $cliente['contrato_id']) }}" 
                                target="_blank" 
                                class="action-btn edit" 
                                title="Exportar Contrato a PDF">
                                <i class="bi bi-file-earmark-pdf-fill"></i>
                            </a>
                            <button class="action-btn" title="Ver detalles">
                                <i class="fas fa-eye"></i>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">No se encontraron contratos disponibles.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
