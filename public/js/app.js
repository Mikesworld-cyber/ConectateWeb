document.addEventListener('DOMContentLoaded', function() {
    const tableContainer = document.getElementById('table-container');
    const kpiCards = document.querySelectorAll('.kpi-card'); // Los <a> o <div class="kpi-card">

   



    // 4. Asigna el evento de clic a todos los KPIs
    kpiCards.forEach((card) => {
        card.addEventListener("click", function () {
            const dataType = this.getAttribute("data-table");
            window.location.href = "/dashboard/" + dataType; // Navega a la página correspondiente
            // Actualiza el estado visual 'active'
            // kpiCards.forEach((c) => c.classList.remove("active"));
            // this.classList.add("active");

            // // Carga la nueva tabla
            // loadTableData(dataType);
        });
    });

    // 5. Cargar la tabla por defecto al inicio (simulando clic en el primer KPI)
    const initialType = document.querySelector('.kpi-card.active')?.getAttribute('data-table') || 'clientes';




    const paqueteSelect = document.getElementById('id_paquete');
    const promocionSelect = document.getElementById('id_promocion');
    const instalacionInput = document.getElementById('costo_instalacion');

    const resumenPaquete = document.getElementById('resumen-paquete');
    const resumenInstalacion = document.getElementById('resumen-instalacion');
    const resumenDescuento = document.getElementById('resumen-descuento');
    const resumenTotal = document.getElementById('resumen-total');
    const totalInicialInput = document.getElementById('monto_total_inicial_input');

       
        const inputPrecio = document.getElementById('monto_mensual');

        paqueteSelect.addEventListener('change', function () {
            const precioSeleccionado = paqueteSelect.options[paqueteSelect.selectedIndex].getAttribute('data-precio');
            inputPrecio.value = precioSeleccionado;
        });


        const inputPromociones = document.getElementById('id_promocions');
        promocionSelect.addEventListener('change', function(){
            const precioSeleccionado = promocionSelect.options[promocionSelect.selectedIndex].getAttribute('value');
            inputPromociones.value = precioSeleccionado;
        });



    // Función principal de cálculo
    function calcularTotal() {

        // Obtener valores numéricos
        const precioPaqueteStr = paqueteSelect.options[paqueteSelect.selectedIndex].getAttribute('data-precio') || '0';
        const descuentoStr = promocionSelect.options[promocionSelect.selectedIndex].getAttribute('data-descuento') || '0';
        const costoInstalacion = parseFloat(instalacionInput.value) || 0;

        const precioPaquete = parseFloat(precioPaqueteStr);
        const descuentoPorcentaje = parseFloat(descuentoStr);
        
        // CÁLCULOS
        const subtotal = precioPaquete + costoInstalacion;
        const montoDescuento = (precioPaquete * descuentoPorcentaje) / 100;
        const totalPagar = subtotal - montoDescuento;

        // ACTUALIZAR RESUMEN EN LA VISTA
        resumenPaquete.textContent = `$${precioPaquete.toFixed(2)}`;
        resumenInstalacion.textContent = `$${costoInstalacion.toFixed(2)}`;
        resumenDescuento.textContent = `$${montoDescuento.toFixed(2)}`;
        resumenTotal.textContent = `$${totalPagar.toFixed(2)}`;
        
        // ACTUALIZAR CAMPO OCULTO PARA EL BACKEND
        totalInicialInput.value = totalPagar.toFixed(2);
    }

    // AÑADIR ESCUCHADORES DE EVENTOS
    paqueteSelect.addEventListener('change', calcularTotal);
    promocionSelect.addEventListener('change', calcularTotal);
    instalacionInput.addEventListener('input', calcularTotal);
    
    // Ejecutar el cálculo inicial
    calcularTotal();



    const fechaCobroInput = document.getElementById('fecha_cobro');
    const diaContratoOriginal = document.getElementById('dia_contrato_original').value;
 // 💡 FUNCIÓN PARA CALCULAR Y SUGERIR EL DÍA DE COBRO
    function sugerirDiaDeCobro() {
        // Obtenemos la fecha actual para simular el día de la firma
        const hoy = new Date();
        let diaSugerido = hoy.getDate(); // Sugerimos el mismo día

        // Opción 1: Si quieres sugerir el día 1 por política interna:
        // diaSugerido = 1; 

        // Opción 2: Si quieres evitar días después del 28 (por meses cortos)
        if (diaSugerido > 28) {
            diaSugerido = 28;
        }

        // Rellenar el campo con la sugerencia
        fechaCobroInput.value = diaSugerido;
        
        // El usuario todavía puede editar este campo si lo desea.
    }
    sugerirDiaDeCobro();





    // 1. CÓDIGO PARA CALCULAR MONTOS (el mismo que ya tienes)

    const selectPromocion = document.getElementById('id_promocion');
    const inputInstalacion = document.getElementById('costo_instalacion');
    const inputMontoMensual = document.getElementById('monto_mensual');
    

    const inputTotalInicial = document.getElementById('monto_total_inicial_input');

    function calcularMontos() {
        const precioPaquete = parseFloat(paqueteSelect.selectedOptions[0]?.dataset.precio || 0);
        const costoInstalacion = parseFloat(inputInstalacion.value) || 0;
        const descuentoPorcentaje = parseFloat(selectPromocion.selectedOptions[0]?.dataset.descuento || 0);
        
       
        const montoMensualConDescuento = precioPaquete ;
    

   
        inputMontoMensual.value = montoMensualConDescuento.toFixed(2);
        
    }

    if (paqueteSelect) paqueteSelect.addEventListener('change', calcularMontos);
   
    calcularMontos();


    // ... código de cálculos ...
    
    document.getElementById('formRegistroContrato').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const submitBtn = document.getElementById('btn-confirmar-contrato');
    const modalElement = document.getElementById('registroContratoModal');
    
    // Mostrar loading
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Procesando...';
    
    try {
        console.log('📤 Enviando datos a la API...');
        
        // Debug: mostrar todos los datos del formulario
        for (let [key, value] of formData.entries()) {
            console.log(`🔍 ${key}: ${value}`);
        }

        const response = await fetch(this.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });

        console.log('📥 Status de respuesta:', response.status);

        const data = await response.json();
        console.log('📄 Respuesta completa:', data);

        if (data.success) {
            console.log('✅ Éxito - cerrando modal...');
            // Éxito - cerrar modal y recargar
            const modal = bootstrap.Modal.getInstance(modalElement);
            if (modal) modal.hide();
            
            setTimeout(() => {
                window.location.reload();
            }, 1000);
        } else {
            // Mostrar más detalles del error
            console.error('❌ Error detallado:', data);
            throw new Error(data.message || `Error desconocido. Código: ${response.status}`);
        }
        
    } catch (error) {
        console.error('💥 Error completo:', error);
        alert('Error: ' + error.message + '\nRevisa la consola para más detalles.');
    } finally {
        submitBtn.disabled = false;
        submitBtn.innerHTML = '<i class="fas fa-save me-2"></i> Confirmar Contrato';
    }
});

    // 3. PREVENIR CUALQUIER ENVÍO TRADICIONAL DEL FORMULARIO
    document.getElementById('formRegistroContrato').addEventListener('submit', function(e) {
        e.preventDefault();
        e.stopPropagation();
        e.stopImmediatePropagation();
        console.log('🚫 Formulario bloqueado - usando método AJAX');
        return false;
    });

    // Prevenir Enter en todo el formulario
    document.getElementById('formRegistroContrato').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            console.log('🚫 Enter bloqueado');
            return false;
        }
    });


});


function drawMonthlySalesChart(data) {
    if (!data || data.length === 0) return;

    // Supongamos que data tiene la forma: { labels: [...], ventas: [...], compras: [...] }
    const ctx = document.getElementById('monthlySalesChart');
    if (!ctx) return;
    
    // Configuración de la gráfica de barras
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: data.labels, // Nombres de los meses (Ene, Feb, Mar...)
            datasets: [{
                label: 'Ventas',
                data: data.ventas, // Array de valores de ventas
                backgroundColor: 'rgba(0, 123, 255, 0.8)', // Azul fuerte para Ventas
                borderColor: 'rgba(0, 123, 255, 1)',
                borderWidth: 1,
                borderRadius: 4, // Bordes redondeados en las barras
                barThickness: 20 // Ancho de las barras
            },
            {
                label: 'Compras',
                data: data.compras, // Array de valores de compras (si los tienes)
                backgroundColor: 'rgba(255, 193, 7, 0.8)', // Amarillo/Naranja para Compras
                borderColor: 'rgba(255, 193, 7, 1)',
                borderWidth: 1,
                borderRadius: 4,
                barThickness: 20
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    // Formato de la escala Y (opcional)
                    // ticks: { callback: function(value) { return '$' + value.toLocaleString(); } } 
                },
                x: {
                    grid: { display: false } // Oculta las líneas verticales de la rejilla
                }
            },
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        usePointStyle: true, // Usa el punto de color para la leyenda
                        padding: 20
                    }
                },
                tooltip: { mode: 'index', intersect: false }
            }
        }








    });
}
