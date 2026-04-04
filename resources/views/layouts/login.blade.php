<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>

    <!-- Tailwind CDN -->
   @vite(['resources/css/app.css','resources/js/app.js'])

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            900: '#0b3c5d',
                            800: '#123B52',
                            700: '#164B68',
                            600: '#1D5F80',
                        },
                        accent: {
                            500: '#F4B400',
                            600: '#E09E00',
                        }
                    }
                }
            }
        }
    </script>
<script src="{{ asset('sweetalert/sweetalert.js') }}"></script>
<link rel="stylesheet" href="{{ asset('sweetalert/sweetalert.css') }}">
    @php
    $bg = asset('images/bars1.webp');
    @endphp
</head>

<body class="relative min-h-screen flex items-center justify-center bg-cover bg-center"
    style="background-image: url('{{ $bg }}');">
    <!-- Dark Overlay -->
    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm"></div>

    <!-- Content -->
    <div class="relative z-10">
        @yield('content')
    </div>

</body>

</html>
