document.querySelector('#uploadForm').addEventListener('submit', async (e) => {
    e.preventDefault();

    const form = e.target;
    const formData = new FormData(form);
    const result = document.getElementById('resultado');
    const fileinputurl = document.getElementById('resulturl');

    result.innerHTML = "⏳ Subiendo imagen, por favor espera...";

    try {
        const res = await fetch(form.action, {
            method: "POST",
            body: formData
        });

        if (!res.ok) throw new Error("Error al subir la imagen");

        const data = await res.json();

        if (data.success) {
            result.innerHTML = `
                <a href="${data.url}" target="_blank">🖼️ Ver imagen</a><br><br>
                
            `;
            fileinputurl.value=data.url;
        } else {
            result.innerHTML = `❌ Error al subir la imagen.<br>${data.error ?? ''}`;
        }
    } catch (error) {
        console.error(error);
        result.innerHTML =error;
    }
});




   
function cambiarEstadoCliente(clienteId, estado){
    let api;
    const baseUrl = "http://localhost/Api-PHP/server/api.php/?action=estadopaquete";
    if(estado=='activo'){
           api = `${baseUrl}&id=${clienteId}&estado=inactivo`;
    }
    else{
        api = `${baseUrl}&id=${clienteId}&estado=activo`;
    }
 fetch(api, {
            method: "POST",
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    location.reload();
                }
            })
            .catch((error) => {
                console.error("Error:", error);
            })
            .finally(()=>{
                
                    
            });
}
