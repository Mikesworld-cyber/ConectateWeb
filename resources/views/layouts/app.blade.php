<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conecta - @yield('title', 'WEB')</title>

   
    {{-- <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet"> --}}

 

    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>
<body class="bg-dark-blue text-white"> {{-- Usa una clase para el fondo oscuro --}}
    
    {{-- Incluimos el componente de la barra de navegación --}}
    <x-navbar /> 

    <main>
        @yield('content') {{-- Aquí se inyectará el contenido de home.blade.php --}}
    </main>

  
    <x-footer /> 

    {{-- Enlace a tu JavaScript personalizado --}}
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>