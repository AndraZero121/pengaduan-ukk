<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Pengaduan SMK Palapa</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-900 min-h-screen flex flex-col font-sans">
    <header class="bg-white border-b border-gray-100">
        <div class="max-w-5xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ route('landing') }}" class="flex items-center gap-2 font-bold text-gray-900">
                <div class="w-8 h-8 bg-indigo-600 rounded flex items-center justify-center text-white">
                    <i class="fa-solid fa-bullhorn text-xs"></i>
                </div>
                <span>SMK Palapa</span>
            </a>
            
            <nav class="flex gap-6 items-center">
                @auth
                    @can('siswa')
                        <a href="{{ route('home') }}" class="text-xs font-bold text-gray-600 hover:text-indigo-600">Buat Laporan</a>
                        <a href="{{ route('aspirasi.status') }}" class="text-xs font-bold text-gray-600 hover:text-indigo-600">Status</a>
                    @endcan
                    @can('admin')
                        <a href="{{ route('admin.aspirasi.index') }}" class="text-xs font-bold text-gray-600 hover:text-indigo-600">Admin</a>
                    @endcan
                    
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit" class="text-xs font-bold text-red-500 hover:text-red-700">Keluar</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-xs font-bold text-indigo-600 hover:text-indigo-800">Masuk</a>
                @endauth
            </nav>
        </div>
    </header>

    <main class="flex-grow max-w-5xl mx-auto w-full">
        @if (session('success'))
            <div class="mx-4 mt-6 p-3 bg-green-50 text-green-700 border border-green-100 rounded text-xs font-bold">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="bg-white border-t border-gray-100 py-8 mt-12 text-center text-[10px] font-bold text-gray-400 uppercase tracking-widest">
        &copy; {{ date('Y') }} SMK Palapa.
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
