document.addEventListener('DOMContentLoaded', function() {
    // 1. Obtener elementos
    const form = document.getElementById('formRegistroContrato');
    const submitBtn = document.getElementById('btn-confirmar-contrato');
    const modalEl = document.getElementById('registroContratoModal');
    
    // Asumimos que ya tienes la lógica de cálculo aquí...
    // Manejar envío del formulario con AJAX
form.addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    
    
    // Mostrar loading
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Procesando...';
    
    fetch(this.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Mostrar mensaje de éxito
            alert('Contrato registrado exitosamente!');
            // Cerrar modal y recargar página
            $('#registroContratoModal').modal('hide');
            location.reload();
        } else {
            alert('Error: ' + data.message);
        }
    })
    .catch(error => {
        alert('Error de conexión: ' + error);
    })
    .finally(() => {
        // Restaurar botón
        submitBtn.disabled = false;
        submitBtn.innerHTML = '<i class="fas fa-save me-2"></i> Confirmar Contrato';
    });
});
    // 2. INTERCEPTAR el evento de envío del formulario

});