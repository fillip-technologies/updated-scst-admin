<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SC/ST Admin Panel</title>

    <!-- Tailwind CDN -->
    @vite(['resources/css/app.css','resources/js/app.js'])

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
<script src="{{ asset('sweetalert/sweetalert.js') }}"></script>
<script src="{{ asset('staticfils/jquery.js') }}"></script>
<link rel="stylesheet" href="{{ asset('sweetalert/sweetalert.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
 <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">

    <!-- jQuery (required) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

</head>

<body class="bg-gray-100 text-gray-800 antialiased">

    <div class="flex min-h-screen">

        <!-- SIDEBAR -->
        <aside class="w-[280px] bg-primary-900 fixed inset-y-0 left-0">
            @include('layouts.sidebar')
        </aside>

        <!-- MAIN WRAPPER -->
        <div class="flex-1 flex flex-col ml-[280px] min-h-screen">

            @include('layouts.topbar')

            <main class="flex-1 p-8 bg-gray-100">
                @yield('content')
            </main>

        </div>

    </div>

</body>

</html>
