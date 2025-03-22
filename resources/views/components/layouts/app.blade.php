<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Tamu</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <style>
        .glass {
            background: rgba(96, 204, 132, 0.25);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }
        .glass-dark {
            background: rgba(31, 105, 50, 0.35);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .glass-light {
            background: rgba(223, 246, 230, 0.5);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        body {
            background-image: url('https://source.unsplash.com/random/1920x1080/?nature,green');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
    </style>
</head>
<body class="min-h-screen font-sans bg-emerald-800">
    <!-- Navbar -->
    <nav class="glass-dark text-white p-4 fixed w-full top-0 z-50">
        <div class="container mx-auto flex justify-between items-center">
            <a href="/">
            <div class="flex items-center space-x-2">
                <span class="text-xl font-bold">Ibis Hotel</span>
            </div>
        </a>
            <div class="hidden md:flex items-center space-x-4">
                <span class="px-3 py-1 rounded-full glass-light text-green-800 text-sm font-medium">
                    Ridwan Alpha Test 1.0
                </span>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container mx-auto pt-24 pb-10 px-4">
        <!-- This is the single root element that contains your component -->
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="glass-dark text-white p-6 mt-10">
        <div class="container mx-auto">
            <div class="text-center">
                <p class="text-sm opacity-80">© 2025 Ibis Hotel Booking App - Ridwan Alpha Test 1.0</p>
            </div>
        </div>
    </footer>

    @livewireScripts
</body>
</html>
