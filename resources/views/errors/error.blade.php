<!-- resources/views/errors/custom.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center px-4">

    <div class="max-w-2xl w-full bg-white shadow-2xl rounded-3xl overflow-hidden">

        <!-- Top Header -->
        <div class="bg-red-500 px-6 py-5">
            <h1 class="text-3xl font-bold text-white">
                ⚠ Something Went Wrong
            </h1>
        </div>

        <!-- Content -->
        <div class="p-6 space-y-5">

            <!-- Error Message -->
            <div class="bg-red-50 border border-red-200 rounded-xl p-4">
                <p class="text-sm text-gray-500 mb-1">Error Message</p>

                <p class="text-red-600 font-semibold break-words">
                    {{ $message }}
                </p>
            </div>

            <!-- File -->
            <div class="bg-gray-50 border rounded-xl p-4">
                <p class="text-sm text-gray-500 mb-1">File</p>

                <p class="text-gray-700 text-sm break-all">
                    {{ $file }}
                </p>
            </div>

            <!-- Line -->
            <div class="bg-gray-50 border rounded-xl p-4">
                <p class="text-sm text-gray-500 mb-1">Line Number</p>

                <p class="text-blue-600 font-bold text-lg">
                    {{ $line }}
                </p>
            </div>

            <!-- Buttons -->
            <div class="flex flex-wrap gap-3 pt-3">

                <button onclick="history.back()"
                    class="px-5 py-2.5 rounded-xl bg-gray-800 text-white hover:bg-black transition">
                    ← Go Back
                </button>

                <a href="{{ url('/') }}"
                    class="px-5 py-2.5 rounded-xl bg-blue-600 text-white hover:bg-blue-700 transition">
                    🏠 Home Page
                </a>

            </div>

        </div>

    </div>

</body>
</html>
