<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Pengaduan SMK Palapa</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-900 min-h-screen flex flex-col font-sans">
    <header class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-slate-200/60">
        <div class="max-w-5xl mx-auto px-4 py-3 flex justify-between items-center">
            <a href="{{ route('landing') }}" class="flex items-center gap-2.5 group">
                <div class="w-9 h-9 bg-indigo-600 rounded-xl flex items-center justify-center text-white shadow-lg shadow-indigo-200 group-hover:scale-105 transition-transform">
                    <i class="fa-solid fa-bullhorn text-sm"></i>
                </div>
                <span class="font-bold text-slate-900 tracking-tight">SMK Palapa</span>
            </a>
            <!-- Navbar -->
            <nav class="flex gap-1 items-center">
                @auth
                    @can('siswa')
                        <a href="{{ route('home') }}" class="px-3 py-2 text-xs font-semibold text-slate-600 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors">Buat Laporan</a>
                        <a href="{{ route('aspirasi.status') }}" class="px-3 py-2 text-xs font-semibold text-slate-600 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors">Status</a>
                    @endcan
                    @can('admin')
                        <a href="{{ route('admin.aspirasi.index') }}" class="px-3 py-2 text-xs font-semibold {{ request()->routeIs('admin.aspirasi.*') ? 'text-indigo-600 bg-indigo-50' : 'text-slate-600 hover:text-indigo-600 hover:bg-indigo-50' }} rounded-lg transition-colors">Laporan</a>
                        <a href="{{ route('admin.kategori.index') }}" class="px-3 py-2 text-xs font-semibold {{ request()->routeIs('admin.kategori.*') ? 'text-indigo-600 bg-indigo-50' : 'text-slate-600 hover:text-indigo-600 hover:bg-indigo-50' }} rounded-lg transition-colors">Kategori</a>
                        <a href="{{ route('admin.siswa.index') }}" class="px-3 py-2 text-xs font-semibold {{ request()->routeIs('admin.siswa.*') ? 'text-indigo-600 bg-indigo-50' : 'text-slate-600 hover:text-indigo-600 hover:bg-indigo-50' }} rounded-lg transition-colors">Siswa</a>
                    @endcan
                    
                    <div class="h-4 w-px bg-slate-200 mx-2"></div>

                    <!-- User Dropdown -->
                    <div class="relative" x-data="{ open: false }" @click.away="open = false">
                        <button @click="open = !open" class="flex items-center gap-3 px-3 py-1.5 rounded-xl hover:bg-slate-50 transition-all outline-none group">
                            <div class="text-right hidden sm:block">
                                <p class="text-[11px] font-bold text-slate-900 leading-none">{{ auth()->user()->name }}</p>
                                <p class="text-[9px] font-medium text-slate-400 uppercase tracking-wider">{{ auth()->user()->role }}</p>
                            </div>
                            <div class="w-8 h-8 rounded-lg bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-xs border border-indigo-200 group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                                {{ substr(auth()->user()->name, 0, 1) }}
                            </div>
                            <i class="fa-solid fa-chevron-down text-[10px] text-slate-300 transition-transform" :class="open ? 'rotate-180' : ''"></i>
                        </button>

                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="absolute right-0 mt-2 w-48 bg-white border border-slate-100 rounded-2xl shadow-xl shadow-slate-200/50 py-2 z-50"
                             style="display: none;">
                            <div class="px-4 py-2 border-b border-slate-50 mb-1 sm:hidden">
                                <p class="text-xs font-bold text-slate-900">{{ auth()->user()->name }}</p>
                                <p class="text-[10px] text-slate-400">{{ auth()->user()->email }}</p>
                            </div>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit" class="w-full flex items-center gap-3 px-4 py-2 text-xs font-bold text-red-500 hover:bg-red-50 transition-colors">
                                    <i class="fa-solid fa-arrow-right-from-bracket text-sm"></i>
                                    Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="px-5 py-2 text-xs font-bold text-white bg-indigo-600 hover:bg-indigo-700 rounded-full shadow-lg shadow-indigo-100 transition-all active:scale-95">Masuk</a>
                @endauth
            </nav>
        </div>
    </header>
     <!-- Main/Isi -->
    <main class="flex-grow max-w-5xl mx-auto w-full">
        @if (session('success'))
            <div class="mx-4 mt-6 p-4 bg-emerald-50 text-emerald-700 border border-emerald-100 rounded-xl text-xs font-bold flex items-center gap-3">
                <i class="fa-solid fa-circle-check text-sm"></i>
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>
     <!-- Footer -->
    <footer class="py-8 mt-8 text-center">
        <div class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em]">
            &copy; {{ date('Y') }} SMK Palapa &bull; Sistem Pengaduan & Aspirasi
        </div>
    </footer>

    <!-- Image Modal -->
    <div id="imageModal" class="fixed inset-0 z-[100] hidden items-center justify-center bg-black/80 p-4 backdrop-blur-sm" onclick="closeImageModal()">
        <div class="relative max-w-4xl w-full">
            <button class="absolute -top-10 right-0 text-white text-2xl hover:text-gray-300">&times;</button>
            <img id="modalImage" src="" class="mx-auto max-h-[90vh] rounded-lg shadow-2xl object-contain">
        </div>
    </div>

    <script>
        // Membuat function open image modal
        function openImageModal(src) {
            const modal = document.getElementById('imageModal');
            const img = document.getElementById('modalImage');
            img.src = src;
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }
        // close modal
        function closeImageModal() {
            const modal = document.getElementById('imageModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = 'auto';
        }

        // Close on Escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeImageModal();
        });
    </script>

    @stack('scripts')
</body>
</html>
