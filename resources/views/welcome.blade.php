<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ridwan Alpha Test 1.0</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .glass {
            background: rgba(96, 204, 132, 0.15);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        body {
            background-image: url('https://images.unsplash.com/photo-1691861574843-447d93bac2b7?q=80&w=1931&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center bg-black/50 text-white font-sans">

    <div class="glass max-w-4xl w-full p-10 sm:p-12 rounded-3xl shadow-2xl">
        <div class="text-center space-y-3 mb-10">
            <img src="{{ asset('image/ibis_logo.png') }}" alt="Logo" class="w-30 h-30 mx-auto mb-4">
            <p class="text-lg text-white font-light">A modern booking system powered by <span class="text-green-200 font-medium">Laravel 12</span></p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <a href="/cari-booking"
               class="flex items-center justify-between bg-white/5 border border-white/10 hover:bg-white/10 transition-all duration-300 p-5 rounded-2xl shadow-xl hover:scale-[1.02]">
                <div>
                    <h3 class="text-xl font-semibold text-green-100">Cari Booking</h3>
                    <p class="text-sm text-white/60">Cek status dan detail booking Anda</p>
                </div>
                <svg class="w-7 h-7 text-green-300" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path d="M9 5l7 7-7 7"/>
                </svg>
            </a>

            <a href="/booking"
               class="flex items-center justify-between bg-white/5 border border-white/10 hover:bg-white/10 transition-all duration-300 p-5 rounded-2xl shadow-xl hover:scale-[1.02]">
                <div>
                    <h3 class="text-xl font-semibold text-green-100">Booking & Kelola</h3>
                    <p class="text-sm text-white/60">Buat dan kelola pemesanan</p>
                </div>
                <svg class="w-7 h-7 text-green-300" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path d="M9 5l7 7-7 7"/>
                </svg>
            </a>

            @if (Cookie::get('booking_code'))
            <a href="/edit-booking"
            class="flex items-center justify-between bg-white/5 border border-white/10 hover:bg-white/10 transition-all duration-300 p-5 rounded-2xl shadow-xl hover:scale-[1.02]">
             <div>
                 <h3 class="text-xl font-semibold text-green-100">Edit Booking</h3>
                 <p class="text-sm text-white/60">Ubah data booking yang sudah ada</p>
             </div>
             <svg class="w-7 h-7 text-green-300" fill="none" stroke="currentColor" stroke-width="2"
                  viewBox="0 0 24 24">
                 <path d="M9 5l7 7-7 7"/>
             </svg>
         </a>
            @else
            <a href="/booking"
            class="flex items-center justify-between bg-white/5 border border-white/10 hover:bg-white/10 transition-all duration-300 p-5 rounded-2xl shadow-xl hover:scale-[1.02]">
             <div>
                 <h3 class="text-xl font-semibold text-green-100">Edit Booking</h3>
                 <p class="text-sm text-red-500">Anda harus membuat reservasi terlebih dahulu</p>
             </div>
             <svg class="w-7 h-7 text-green-300" fill="none" stroke="currentColor" stroke-width="2"
                  viewBox="0 0 24 24">
                 <path d="M9 5l7 7-7 7"/>
             </svg>
         </a>
            @endif


            <a href="/admin"
               class="flex items-center justify-between bg-white/5 border border-white/10 hover:bg-white/10 transition-all duration-300 p-5 rounded-2xl shadow-xl hover:scale-[1.02]">
                <div>
                    <h3 class="text-xl font-semibold text-green-100">Admin Panel</h3>
                    <p class="text-sm text-white/60">Manajemen penuh data pengguna</p>
                </div>
                <svg class="w-7 h-7 text-green-300" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

        <div class="mt-10 text-sm text-white/60 text-center border-t border-white/10 pt-4">
            <p>&copy; {{ now()->year }} Ridwan Alpha Test • All rights reserved</p>
        </div>
    </div>

</body>
</html>
