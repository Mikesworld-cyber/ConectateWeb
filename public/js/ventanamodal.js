document.addEventListener('DOMContentLoaded', function() {
    // 1. Obtener elementos
    const form = document.getElementById('formRegistroContratoO');
    const submitButton = document.getElementById('btn-confirmar-contrato0');
    const modalEl = document.getElementById('registroContratoModal0');
    
    // Asumimos que ya tienes la lógica de cálculo aquí...
    
    // 2. INTERCEPTAR el evento de envío del formulario
    form.addEventListener('submit', function(e) {
        e.preventDefault(); // 🛑 ESTO ES LO CRÍTICO: Detiene el envío síncrono

        // Recolectar datos
        const formData = new FormData(form);
        const url = '{{ route("contratos.store") }}'; // Usa la ruta con nombre

        // Deshabilitar botón para evitar doble clic
        submitButton.disabled = true;
        submitButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Procesando...';

        // 3. Petición AJAX (Usando Axios)
        axios.post(url, formData)
            .then(response => {
                // Éxito (Recibimos 200/OK del controlador de Laravel)
                
                // Cerrar el modal
                const modal = bootstrap.Modal.getInstance(modalEl); 
                modal.hide();

                // Mostrar mensaje de éxito (puedes usar SweetAlert o un toast)
                alert('✅ Contrato registrado con éxito: ' + response.data.message); 
                
                // Opcional: Recargar la página para actualizar la tabla
                window.location.reload(); 
            })
            .catch(error => {
                // Manejar errores (validación de Laravel, error 500 de la API, etc.)
                let message = 'Error desconocido al procesar la solicitud.';
                if (error.response && error.response.data.message) {
                    message = error.response.data.message;
                } else if (error.message) {
                    message = error.message;
                }
                alert('❌ Error al guardar: ' + message);
            })
            .finally(() => {
                // 4. Reactivar el botón
                submitButton.disabled = false;
                submitButton.innerHTML = '<i class="fas fa-save me-2"></i> Confirmar Contrato';
            });
    });
});