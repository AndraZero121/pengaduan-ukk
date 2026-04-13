<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Pengaduan SMK Palapa</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
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
            
            <nav class="flex gap-1 items-center">
                @auth
                    @can('siswa')
                        <a href="{{ route('home') }}" class="px-3 py-2 text-xs font-semibold text-slate-600 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors">Buat Laporan</a>
                        <a href="{{ route('aspirasi.status') }}" class="px-3 py-2 text-xs font-semibold text-slate-600 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors">Status</a>
                    @endcan
                    @can('admin')
                        <a href="{{ route('admin.aspirasi.index') }}" class="px-3 py-2 text-xs font-semibold text-slate-600 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors">Admin Panel</a>
                    @endcan
                    
                    <div class="h-4 w-px bg-slate-200 mx-2"></div>

                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit" class="px-3 py-2 text-xs font-bold text-red-500 hover:bg-red-50 rounded-lg transition-colors">Keluar</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="px-5 py-2 text-xs font-bold text-white bg-indigo-600 hover:bg-indigo-700 rounded-full shadow-lg shadow-indigo-100 transition-all active:scale-95">Masuk</a>
                @endauth
            </nav>
        </div>
    </header>

    <main class="flex-grow max-w-5xl mx-auto w-full">
        @if (session('success'))
            <div class="mx-4 mt-6 p-4 bg-emerald-50 text-emerald-700 border border-emerald-100 rounded-xl text-xs font-bold flex items-center gap-3">
                <i class="fa-solid fa-circle-check text-sm"></i>
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>

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
        function openImageModal(src) {
            const modal = document.getElementById('imageModal');
            const img = document.getElementById('modalImage');
            img.src = src;
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

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
