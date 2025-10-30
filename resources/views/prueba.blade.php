@extends('layouts.admin')

@section('contenido')
<div class="container-fluid">

    <!-- Encabezado -->
    <div class="mb-4">
        <h2 class="fs-2 fw-bold text-dark">Gestión de Contratos</h2>
        <p class="text-secondary">Crea, modifica y monitorea los contratos de servicio.</p>
    </div>

    <!-- Crear Contrato -->
    <div class="bg-light bg-opacity-50 p-4 rounded mb-5">
        <h3 class="fs-5 fw-bold mb-4">Crear Nuevo Contrato</h3>
        <form class="row g-3 align-items-end">
            <div class="col-md-6 col-lg-3">
                <label for="cliente" class="form-label fw-medium">Cliente</label>
                <select id="cliente" class="form-select border border-secondary">
                    <option selected>Seleccionar Cliente</option>
                </select>
            </div>
            <div class="col-md-6 col-lg-3">
                <label for="paquete" class="form-label fw-medium">Paquete</label>
                <select id="paquete" class="form-select border border-secondary">
                    <option selected>Seleccionar Paquete</option>
                </select>
            </div>
            <div class="col-md-6 col-lg-3">
                <label for="promocion" class="form-label fw-medium">Promoción</label>
                <select id="promocion" class="form-select border border-secondary">
                    <option selected>Seleccionar Promoción</option>
                </select>
            </div>
            <div class="col-md-6 col-lg-3">
                <label for="duracion" class="form-label fw-medium">Duración (meses)</label>
                <input type="number" class="form-control border border-secondary" id="duracion" placeholder="12">
            </div>
            <div class="col-12">
                <button type="button" class="btn btn-primary fw-bold px-4 py-2 mt-2">Crear Contrato</button>
            </div>
        </form>
    </div>

    <!-- Contratos Activos -->
    <div class="mb-5">
        <h3 class="fs-5 fw-bold mb-3">Contratos Activos</h3>
        <div class="table-responsive bg-light bg-opacity-50 rounded p-3">
            <table class="table text-start align-middle mb-0">
                <thead class="border-bottom">
                    <tr>
                        <th>Cliente</th>
                        <th>Paquete</th>
                        <th>Inicio</th>
                        <th>Fin</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Cliente 1</td>
                        <td class="text-secondary">Paquete Básico</td>
                        <td class="text-secondary">01/01/2023</td>
                        <td class="text-secondary">31/12/2023</td>
                        <td><span class="badge bg-primary-soft text-primary fw-medium">Activo</span></td>
                        <td>
                            <button class="btn btn-link text-primary text-decoration-none p-0 me-2">Modificar</button>
                            <button class="btn btn-link text-primary text-decoration-none p-0">PDF</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Cliente 2</td>
                        <td class="text-secondary">Paquete Premium</td>
                        <td class="text-secondary">15/02/2023</td>
                        <td class="text-secondary">14/02/2024</td>
                        <td><span class="badge bg-primary-soft text-primary fw-medium">Activo</span></td>
                        <td>
                            <button class="btn btn-link text-primary text-decoration-none p-0 me-2">Modificar</button>
                            <button class="btn btn-link text-primary text-decoration-none p-0">PDF</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Contratos Inactivos -->
    <div class="mb-5">
        <h3 class="fs-5 fw-bold mb-3">Contratos Inactivos</h3>
        <div class="table-responsive bg-light bg-opacity-50 rounded p-3">
            <table class="table text-start align-middle mb-0">
                <thead class="border-bottom">
                    <tr>
                        <th>Cliente</th>
                        <th>Paquete</th>
                        <th>Inicio</th>
                        <th>Fin</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Cliente 4</td>
                        <td class="text-secondary">Paquete Básico</td>
                        <td class="text-secondary">01/01/2022</td>
                        <td class="text-secondary">31/12/2022</td>
                        <td><span class="badge bg-secondary-subtle text-secondary fw-medium">Inactivo</span></td>
                        <td>
                            <button class="btn btn-link text-primary text-decoration-none p-0 me-2">Modificar</button>
                            <button class="btn btn-link text-primary text-decoration-none p-0">PDF</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Contratos Próximos a Vencer -->
    <div>
        <h3 class="fs-5 fw-bold mb-3">Contratos Próximos a Vencer</h3>
        <div class="table-responsive bg-light bg-opacity-50 rounded p-3">
            <table class="table text-start align-middle mb-0">
                <thead class="border-bottom">
                    <tr>
                        <th>Cliente</th>
                        <th>Paquete</th>
                        <th>Inicio</th>
                        <th>Fin</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Cliente 6</td>
                        <td class="text-secondary">Paquete Intermedio</td>
                        <td class="text-secondary">01/10/2023</td>
                        <td class="text-secondary">30/09/2024</td>
                        <td><span class="badge bg-primary-soft text-primary fw-medium">Activo</span></td>
                        <td>
                            <button class="btn btn-link text-primary text-decoration-none p-0 me-2">Modificar</button>
                            <button class="btn btn-link text-primary text-decoration-none p-0">PDF</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection