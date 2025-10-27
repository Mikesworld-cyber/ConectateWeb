@extends('layouts.app') 

@section('title', 'Nuevo Contrato de Servicio')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white py-3" style="background-color: #0056b3 !important;">
                    <h3 class="mb-0 text-center">Registrar Nuevo Contrato de Servicio</h3>
                </div>
                
                <div class="card-body p-5">
                    
                    {{-- Formulario POST que envía los datos a la ruta 'contratos.store' --}}
                    <form method="POST" action="{{ route('contratos.store') }}">
                        @csrf 

                        <div class="row">
                            
                            {{-- SECCIÓN 1: DATOS DEL CONTRATANTE --}}
                            <h5 class="text-primary mb-3">1. Seleccionar Cliente y Administrador</h5>
                            <hr class="mb-4">

                            {{-- Campo: ID Usuario (Cliente) --}}
                            <div class="col-md-6 mb-4">
                                <label for="id_usuario" class="form-label fw-bold">Buscar Cliente (*)</label>
                                {{-- NOTA: Este Select debe ser reemplazado por un campo de búsqueda AJAX en producción --}}
                                <select class="form-select @error('id_usuario') is-invalid @enderror" id="id_usuario" name="id_usuario" required>
                                    <option value="">Buscar por Nombre o Correo...</option>
                                    @foreach ($usuarios as $usuario)
                                        <option value="{{ $usuario->id }}" {{ old('id_usuario') == $usuario->id ? 'selected' : '' }}>
                                            {{ $usuario->nombre_user }} ({{ $usuario->correo }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_usuario')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Campo: ID Administrador (Quien registra el contrato) --}}
                            <div class="col-md-6 mb-4">
                                <label for="id_administrador" class="form-label fw-bold">Administrador que Registra (*)</label>
                                <select class="form-select @error('id_administrador') is-invalid @enderror" id="id_administrador" name="id_administrador" required>
                                    <option value="">Seleccione Administrador</option>
                                    @foreach ($administradores as $admin)
                                        <option value="{{ $admin->id }}" {{ old('id_administrador') == $admin->id ? 'selected' : '' }}>
                                            {{ $admin->usuario }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_administrador')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- SECCIÓN 2: DETALLES DEL SERVICIO --}}
                            <h5 class="text-primary my-3">2. Paquete, Duración y Promoción</h5>
                            <hr class="mb-4">

                            {{-- Campo: Paquete de Internet --}}
                            <div class="col-md-6 mb-4">
                                <label for="id_paquete" class="form-label fw-bold">Seleccionar Paquete (*)</label>
                                <select class="form-select @error('id_paquete') is-invalid @enderror" id="id_paquete" name="id_paquete" required>
                                    <option value="">Seleccione un Plan</option>
                                    @foreach ($paquetes as $paquete)
                                        <option value="{{ $paquete->id }}" data-precio="{{ $paquete->precio }}" {{ old('id_paquete') == $paquete->id ? 'selected' : '' }}>
                                            {{ $paquete->nombre }} ({{ $paquete->velocidad_bajada }} - ${{ number_format($paquete->precio, 2) }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_paquete')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Campo: Duración --}}
                            <div class="col-md-3 mb-4">
                                <label for="duracion" class="form-label fw-bold">Duración (Meses)</label>
                                <input type="number" class="form-control @error('duracion') is-invalid @enderror" 
                                       id="duracion" name="duracion" value="{{ old('duracion', 12) }}" required min="1">
                                @error('duracion')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            {{-- Campo: Fecha de Cobro (Simulación de la fecha del mes) --}}
                            <div class="col-md-3 mb-4">
                                <label for="fecha_cobro" class="form-label fw-bold">Día de Cobro del Mes (*)</label>
                                <input type="number" class="form-control @error('fecha_cobro') is-invalid @enderror" 
                                       id="fecha_cobro" name="fecha_cobro" value="{{ old('fecha_cobro', 1) }}" required min="1" max="28">
                                @error('fecha_cobro')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Campo: Cláusulas/Notas --}}
                            <div class="col-12 mb-4">
                                <label for="clausulas" class="form-label fw-bold">Cláusulas / Notas Adicionales</label>
                                <textarea class="form-control" id="clausulas" name="clausulas" rows="3">{{ old('clausulas') }}</textarea>
                            </div>

                            {{-- Campo: Estado (Por defecto Activo) --}}
                            <div class="col-12 mb-4">
                                <input type="hidden" name="estado" value="activo">
                            </div>

                        </div>

                        {{-- Botón de Enviar --}}
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary btn-lg" style="background-color: #007bff; border-color: #007bff;">
                                <i class="fas fa-file-signature me-2"></i> Confirmar y Generar Contrato
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection