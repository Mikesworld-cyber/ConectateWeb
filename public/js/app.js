

document.addEventListener('DOMContentLoaded', function() {
    const tableContainer = document.getElementById('table-container');
    const kpiCards = document.querySelectorAll('.kpi-card'); // Los <a> o <div class="kpi-card">

    function loadTableData(dataType) {
        // Usa la función route() de Laravel si la tienes configurada, si no, usa la URL directa
       // const url = `http://localhost/Api-PHP/server/api.php?action=${dataType}`;
          const url = `/api/get-table-data?tipo=${dataType}`;
        // 1. Muestra un spinner o estado de carga
        tableContainer.innerHTML = '<div class="text-center p-5"><div class="spinner-border text-primary" role="status"></div><p class="mt-2">Cargando datos de ' + dataType + '...</p></div>';

        // 2. Realiza la solicitud AJAX
        fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error('La API de Laravel falló al responder.');
                }
                return response.text(); // Espera el HTML que viene del controlador
            })
            .then(html => {
                // 3. Reemplaza el contenido del marcador de posición
                tableContainer.innerHTML = html;
            })
            .catch(error => {
                console.error("AJAX Error:", error);
                tableContainer.innerHTML = `<div class="alert alert-danger p-4" role="alert">
                                               Error: No se pudo cargar la tabla. Verifica la URL de tu API.
                                           </div>`;
            });
    }

    // 4. Asigna el evento de clic a todos los KPIs
    kpiCards.forEach(card => {
        card.addEventListener('click', function() {
            const dataType = this.getAttribute('data-table');
            
            // Actualiza el estado visual 'active'
            kpiCards.forEach(c => c.classList.remove('active'));
            this.classList.add('active');

            // Carga la nueva tabla
            loadTableData(dataType);
        });
    });

    // 5. Cargar la tabla por defecto al inicio (simulando clic en el primer KPI)
    const initialType = document.querySelector('.kpi-card.active')?.getAttribute('data-table') || 'clientes';
    loadTableData(initialType); 
});