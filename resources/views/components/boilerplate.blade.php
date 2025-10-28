<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ env('APP_NAME') }}</title>

    {{-- Vite will include the compiled Tailwind CSS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- toastr alert -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/favicon.png') }}" />

    <!-- AOS -->
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css" />
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

    <!-- For older browsers -->
    <link rel="shortcut icon" href="{{ asset('assets/favicon.png') }}" type="image/x-icon" />

    <!-- For Apple devices (iOS, iPadOS) -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/favicon.png') }}" />

    <!-- For Android/Windows tiles -->
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets/favicon.png') }}" />
    <link rel="icon" type="image/png" sizes="512x512" href="{{ asset('assets/favicon.png') }}" />

    <!-- Basic Meta -->
    <meta name="description"
        content="TradeSource360 is a multi-Traded owned Company focusing on improving the buying and selling of Agric products and mineral resource across Africa." />

    <!-- Open Graph (Facebook, LinkedIn, WhatsApp) -->
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="{{ env('APP_NAME') }}" />
    <meta property="og:title" content="Trade Source 360" />
    <meta property="og:description"
        content="Trade Source 360 is a multi-traded owned Company focused on improving the buying and selling of agricultural products and mineral resource across Africa" />
    <meta property="og:image" content="{{ asset('assets/logo.png') }}" />
    <meta property="og:image:alt" content="Trade Source 360 Logo" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="630" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:locale" content="en_US" />

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="Trade Source 360" />
    <meta name="twitter:description"
        content="Trade Source 360 is a multi-traded owned Company focused on improving the buying and selling of agricultural products and mineral resource across Africa" />
    <meta name="twitter:image" content="{{ asset('assets/logo.png') }}" />
    <meta name="twitter:image:alt" content="Trade Source 360 Logo" />

    <!-- Additional Meta for better SEO -->
    <meta name="author" content="Trade Source 360" />
    <meta name="robots" content="index, follow" />
    <link rel="canonical" href="{{ url()->current() }}" />

    <style>
        .sidebar-transition {
            transition: transform 0.3s ease-in-out;
        }

        .overlay-transition {
            transition: opacity 0.3s ease-in-out;
        }
    </style>

</head>

<body class="relative">

    {{ $slot }}

    <script>
        AOS.init({
            duration: 1000, // animation duration in ms
            once: false, // whether animation happens only once
        });
    </script>

    <!-- toastr alert -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        @if (session('success'))
            toastr.success("{{ session('success') }}");
        @endif

        @if (session('error'))
            toastr.error("{{ session('error') }}");
        @endif

        @if (session('warning'))
            toastr.warning("{{ session('warning') }}");
        @endif

        @if (session('info'))
            toastr.info("{{ session('info') }}");
        @endif
    </script>

</body>

</html>
