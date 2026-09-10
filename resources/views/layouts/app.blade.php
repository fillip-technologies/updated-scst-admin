<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SC/ST Admin Panel</title>

    <!-- Tailwind CDN -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <script src="{{ asset('sweetalert/sweetalert.js') }}"></script>
    <script src="{{ asset('staticfils/jquery.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('sweetalert/sweetalert.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

    <style>
        body {
            top: 0 !important;
        }

        .goog-te-banner-frame.skiptranslate {
            display: none !important;
        }

        iframe.goog-te-banner-frame {
            display: none !important;
        }

        .skiptranslate iframe {
            display: none !important;
        }
    </style>
    <script>
        document.addEventListener('change', async function(e) {

            if (e.target.type !== 'file') return;

            const file = e.target.files[0];
            if (!file) return;
            if (file.type === 'application/pdf') {

                const content = await file.text();

                const blockedPatterns = [
                    '<script',
                    'javascript:',
                    'onerror=',
                    'onload=',
                    'alert(',
                    '/JavaScript',
                    '/JS',
                    '/OpenAction',
                    '/Launch',
                    'app.alert'
                ];

                const found = blockedPatterns.some(pattern =>
                    content.toLowerCase().includes(pattern.toLowerCase())
                );

                if (found) {
                    alert('Malicious PDF detected. Upload blocked.');
                    e.target.value = '';
                    return false;
                }
            }
        });
    </script>

    <script>
        setInterval(function() {
            document.body.style.top = "0px";

            const frame = document.querySelector(".goog-te-banner-frame");
            if (frame) {
                frame.remove();
            }
        }, 500);
    </script>

     <script>
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'en',
                includedLanguages: 'en,hi',
                layout: google.translate.TranslateElement.InlineLayout.SIMPLE
            }, 'google_translate_element');
        }
    </script>
    <script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
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
