<div class="card shadow-sm border-0 analytics-card">
    <div class="card-body p-4">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="card-title mb-0 fw-bold text-dark-blue">
                Ventas Mensuales
            </h5>
            <div class="dropdown">
                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Año {{ date('Y') }}
                </button>
                <ul class="dropdown-menu">
                    {{-- Esto sería dinámico en un proyecto real --}}
                    <li><a class="dropdown-item" href="#">2024</a></li>
                    <li><a class="dropdown-item" href="#">2023</a></li>
                </ul>
            </div>
        </div>

        <div class="chart-container">
            {{-- Chart.js dibujará aquí --}}
            <canvas id="monthlySalesChart" height="520" background="blue"></canvas>
           
        </div>

        <div class="row text-center mt-4 pt-3 border-top">
            <div class="col-md-6 border-end">
                <p class="mb-1 fs-4 fw-bold text-primary" id="totalVentas">
                    {{ number_format($totalVentas ?? 0, 0, ',', '.') }}
                </p>
                <small class="text-muted">Total Ventas</small>
            </div>
            <div class="col-md-6">
                <p class="mb-1 fs-4 fw-bold text-secondary" id="totalCompras">
                    {{ number_format($totalCompras ?? 0, 0, ',', '.') }}
                </p>
                <small class="text-muted">Total Compras</small>
            </div>
        </div>
        
    </div>
</div>
   
 {{-- Aquí se incluyen los datos PHP para que Chart.js los lea --}}
<script>
    console.log("--- DEBUG: Script de Chart Inyectado ---");
    window.chartData = @json($datosChart ?? []);

    const ctx = document.getElementById('monthlySalesChart');


    if (!ctx) {
        // Si ves este error en la Consola, significa que el Canvas no está en el DOM.
        console.error("ERROR: El Canvas 'monthlySalesChart' es NULL. Falló la inyección.");
        return;
    }

    if (typeof drawMonthlySalesChart === 'function' && window.chartData) {
        drawMonthlySalesChart(window.chartData);
    }
</script>
