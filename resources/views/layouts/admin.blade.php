<!DOCTYPE html>
<html lang="es" xml:lang="es" data-bs-theme="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Fuente Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&display=swap" rel="stylesheet">

    <!-- Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f6f7f8;
            color: #212529;
        }

        [data-bs-theme="dark"] {
            background-color: #101c22 !important;
            color: #dee2e6 !important;
        }

        /* Sidebar */
        aside {
            width: 16rem;
            background-color: rgba(246, 247, 248, 0.5);
        }

        [data-bs-theme="dark"] aside {
            background-color: rgba(16, 28, 34, 0.5);
        }

        .hover-bg:hover {
            background-color: rgba(17, 147, 212, 0.1);
        }

        [data-bs-theme="dark"] .hover-bg:hover {
            background-color: rgba(17, 147, 212, 0.2);
        }

        .bg-primary-soft {
            background-color: rgba(17, 147, 212, 0.1);
        }

        .bg-primary {
            background-color: #1193d4 !important;
        }

        .text-primary {
            color: #1193d4 !important;
        }


        /* .btn-primary {
            background-color: #1193d4 !important;
            border-color: #1193d4 !important;
        }

        .btn-primary:hover {
            background-color: #0f85c0 !important;
        } */

        table th,
        table td {
            vertical-align: middle !important;
        }
    </style>
</head>

<body class="min-vh-100 d-flex">

    <!-- Sidebar -->
    <x-aside />

    <!-- Main -->
    <main class="flex-grow-1 p-5">
        @yield(section: 'contenido')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/ventanamodal.js') }}"></script>
    <script src="{{ asset('js/upimage.js') }}"></script>
</body>

</html>