<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Contrato ID: {{ $contrato['contrato_id'] }}</title>
    <style>
        body { font-family: 'Arial', sans-serif; margin: 0; padding: 0; color: #333; }
        .document-header { text-align: center; margin-bottom: 30px; border-bottom: 3px solid #0056b3; padding-bottom: 10px; }
        .document-header h1 { color: #0056b3; font-size: 24px; margin: 0; }
        
        .section-title { color: #007bff; border-bottom: 1px solid #ccc; padding-bottom: 5px; margin-top: 20px; margin-bottom: 15px; font-size: 18px; }
        
        .data-block { margin-bottom: 15px; }
        .data-block label { font-weight: bold; display: block; color: #555; margin-bottom: 3px; font-size: 14px; }
        .data-block p { margin: 0; padding-left: 10px; font-size: 16px; border-left: 3px solid #f0f0f0; }

        .highlight-box { 
            border: 1px solid #007bff; 
            background-color: #e6f0ff; 
            padding: 15px; 
            margin-top: 20px; 
            text-align: center; 
        }
        /* ESTILOS PARA LA SECCIÓN QR */
.qr-section {
    border: 2px solid #28a745; 
    background-color: #f0fff0;
    padding: 20px;
    margin-top: 30px;
    overflow: hidden; /* Esto es como un 'clearfix' para contener los flotantes */
}
.qr-info { 
    width: 65%; 
    float: left; /* IZQUIERDA */
    text-align: left; 
}
.qr-image { 
    width: 30%; 
    float: right; /* DERECHA */
    text-align: center; 
}
.qr-image img {
    border: 1px solid #ccc;
    padding: 5px;
    max-width: 120px; 
}
    </style>
</head>
<body>
    <div style="padding: 40px;">

     <div class="document-header" style="text-align: left;">
    
    <div style="display: flex; justify-content: space-between; align-items: center;">
        
        <div style="width: 20%;">
            <img src="{{ public_path('images/Imagen1conectat.jpg') }}" style="
                    max-width: 100%; /* No dejar que la imagen exceda el 100% de su contenedor (25%) */
                    height: auto; 
                    width: 120px; /* Establece un ancho fijo en píxeles que sabes que se ve bien */
                    max-height: 50px; /* Establece una altura máxima para controlar el borde blanco */
                    display: block; /* Ayuda a controlar el espaciado vertical */
                 " alt="Logo de la Empresa">
        </div>

        <div style="width: 75%; text-align: right;">
            <h1>CONTRATO DE SERVICIO #{{ $contrato['contrato_id'] }}</h1>
            <p>Generado el: {{ now()->format('d/m/Y') }}</p>
        </div>

    </div>
    
    <div style="clear: both;"></div>

</div>

        <div class="section-title">Información del Cliente</div>
        <div style="display: flex; justify-content: space-between;">
            <div style="width: 48%; float: left;" class="data-block">
                <label>Nombre Completo</label>
                <p>{{ $contrato['cliente'] }}</p>
            </div>
            <div style="width: 48%; float: right;" class="data-block">
                <label>Correo Electrónico</label>
                <p>{{ $contrato['correo_cliente'] }}</p>
            </div>
        </div>
        <div style="clear: both;"></div>

        <div class="section-title">Detalles del Contrato</div>
        
        <div style="display: flex; justify-content: space-between;">
            <div style="width: 30%; float: left;" class="data-block">
                <label>Paquete Contratado</label>
                <p style="font-weight: bold;">{{ $contrato['paquete_contratado'] }}</p>
            </div>
            <div style="width: 30%; float: left;" class="data-block">
                <label>Duración</label>
                <p>{{ $contrato['duracion_meses'] }} Meses</p>
            </div>
            <div style="width: 30%; float: left;" class="data-block">
                <label>Estado</label>
                <p style="color: {{ $contrato['estado_contrato'] === 'activo' ? 'green' : 'red' }}; text-transform: uppercase;">
                    {{ $contrato['estado_contrato'] }}
                </p>
            </div>
        </div>
        <div style="clear: both;"></div>


        <div class="section-title">Fechas Clave</div>
        <div style="display: flex; justify-content: space-between;">
            <div style="width: 48%; float: left;" class="data-block">
                <label>Fecha de Inicio del Contrato</label>
                <p>{{ \Carbon\Carbon::parse($contrato['fecha_contrato'])->format('d M Y (H:i)') }}</p>
            </div>
            <div style="width: 48%; float: right;" class="data-block">
                <label>Próxima Fecha de Cobro</label>
                <p style="font-weight: bold; color: #cc0000;">{{ \Carbon\Carbon::parse($contrato['siguiente_fecha_cobro'])->format('d M Y') }}</p>
            </div>
        </div>
<div style="clear: both;"></div>
        <div class="section-title">Instrucciones de Pago</div>
        
<div class="qr-section">
    
    <div class="qr-info">
        <p style="font-size: 16px; font-weight: bold; color: #28a745;">PAGO FÁCIL POR TRANSFERENCIA BANCARIA</p>
        
        <div class="data-block" style="margin-top: 10px;">
            <label>Banco</label>
            <p>{{ $contrato['banco'] ?? 'BBVA Bancomer' }}</p>
        </div>
        <div class="data-block">
            <label>CLABE Interbancaria</label>
            <p style="font-weight: bold; color: #000;">{{ $contrato['clabe_interbancaria'] ?? '000000000000000000' }}</p>
        </div>
        <div class="data-block">
            <label>Beneficiario</label>
            <p>{{ $contrato['beneficiario'] ?? 'Tu Nombre de Empresa S.A.' }}</p>
        </div>
        
        <p style="font-size: 12px; margin-top: 15px;">**Importante:** Incluya el ID de Contrato ({{ $contrato['contrato_id'] }}) en la referencia.</p>
    </div>
    
    <div class="qr-image">
        <label style="color: #28a745; display: block; margin-bottom: 5px;">ESCANEA PARA PAGAR</label>
        
        <img src="{{ public_path('images/qrapp.png') }}" 
             alt="Código QR de Pago" 
             style="max-width: 120px; height: auto; border: 1px solid #ccc; padding: 5px;">
    </div>
    
    <div style="clear: both;"></div> </div>

<div class="highlight-box">
    <p><strong>Administrador Responsable:</strong> {{ $contrato['administrador'] }}</p>
    <p style="font-size: 12px; margin-top: 5px;">Este documento tiene validez legal. Guarda una copia para tus registros.</p>
</div>
    </div>
</body>
</html>