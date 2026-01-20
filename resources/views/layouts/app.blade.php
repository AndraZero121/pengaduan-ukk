<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Repschool - Pengaduan Sarana Sekolah</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-white text-slate-900" style="font-family: 'Space Grotesk', sans-serif;">
    <div class="relative">
        <header class="border-b border-slate-200 bg-white">
            <div class="mx-auto flex max-w-6xl flex-col gap-4 px-4 py-6 md:flex-row md:items-center md:justify-between">
                <div>
                    <div class="flex items-center gap-3">
                        <span class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-slate-200 bg-slate-900 text-white">
                            <i class="fa-solid fa-bullhorn"></i>
                        </span>
                        <div>
                            <p class="text-xl font-semibold tracking-tight">Repschool</p>
                            <p class="text-sm text-slate-600">Pengaduan Sarana Sekolah</p>
                        </div>
                    </div>
                </div>
                <nav class="flex flex-wrap items-center gap-3 text-sm font-medium text-slate-700">
                    <a class="rounded-full border border-slate-200 bg-white px-4 py-2 transition hover:border-slate-900 hover:text-slate-900" href="{{ route('home') }}">
                        <i class="fa-solid fa-pen-to-square mr-2"></i>Form Aspirasi
                    </a>
                    <a class="rounded-full border border-slate-200 bg-white px-4 py-2 transition hover:border-slate-900 hover:text-slate-900" href="{{ route('aspirasi.status') }}">
                        <i class="fa-solid fa-magnifying-glass mr-2"></i>Cek Status
                    </a>
                    @if (session()->has('admin_id'))
                        <a class="rounded-full border border-slate-200 bg-white px-4 py-2 transition hover:border-slate-900 hover:text-slate-900" href="{{ route('admin.aspirasi.index') }}">
                            <i class="fa-solid fa-gear mr-2"></i>Panel Admin
                        </a>
                        <form action="{{ route('admin.logout') }}" method="post">
                            @csrf
                            <button class="rounded-full border border-slate-200 bg-slate-900 px-4 py-2 text-white transition hover:bg-black" type="submit">
                                <i class="fa-solid fa-right-from-bracket mr-2"></i>Keluar
                            </button>
                        </form>
                    @else
                        <a class="rounded-full border border-slate-200 bg-slate-900 px-4 py-2 text-white transition hover:bg-black" href="{{ route('admin.login') }}">
                            <i class="fa-solid fa-right-to-bracket mr-2"></i>Admin Login
                        </a>
                    @endif
                </nav>
            </div>
        </header>

        <main class="mx-auto max-w-6xl px-4 pb-16 pt-10">
            @if (session('success'))
                <div class="mb-6 rounded-2xl border border-slate-200 bg-slate-50 px-5 py-4 text-slate-800 shadow-sm">
                    <i class="fa-solid fa-circle-check mr-2"></i>{{ session('success') }}
                </div>
            @endif

            @yield('content')
        </main>

        <footer class="border-t border-slate-200 bg-white py-6 text-center text-sm text-slate-500">
            Repschool &copy; {{ date('Y') }}. Sistem pengaduan sarana sekolah berbasis Laravel.
        </footer>
    </div>
</body>
</html>
