<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Kegiatan Organisasi Mahasiswa' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="//unpkg.com/alpinejs" defer></script>
    @livewireStyles
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-50 to-blue-50 min-h-screen">
    <nav class="bg-white/80 backdrop-blur-md border-b border-gray-200/50 sticky top-0 z-50" x-data="{ mobileMenuOpen: false }">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <div class="w-8 h-8 bg-gradient-to-r from-blue-600 to-purple-600 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-users text-white text-sm"></i>
                        </div>
                        <span class="text-xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                            Organisasi Mahasiswa
                        </span>
                    </div>
                </div>
                <div class="hidden md:flex items-center space-x-1">
                    <a href="{{ route('kegiatan') }}" 
                       class="group flex items-center px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 
                              {{ request()->routeIs('kegiatan') 
                                 ? 'bg-blue-100 text-blue-700 shadow-sm' 
                                 : 'text-gray-600 hover:text-blue-700 hover:bg-blue-50' }}">
                        <i class="fas fa-calendar-alt mr-2 text-xs"></i>
                        Kegiatan
                    </a>
                    <a href="{{ route('anggota') }}" 
                       class="group flex items-center px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 
                              {{ request()->routeIs('anggota') 
                                 ? 'bg-blue-100 text-blue-700 shadow-sm' 
                                 : 'text-gray-600 hover:text-blue-700 hover:bg-blue-50' }}">
                        <i class="fas fa-user-friends mr-2 text-xs"></i>
                        Anggota
                    </a>
                    <a href="{{ route('laporan') }}" 
                       class="group flex items-center px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 
                              {{ request()->routeIs('laporan') 
                                 ? 'bg-blue-100 text-blue-700 shadow-sm' 
                                 : 'text-gray-600 hover:text-blue-700 hover:bg-blue-50' }}">
                        <i class="fas fa-chart-line mr-2 text-xs"></i>
                        Laporan
                    </a>
                </div>
                <div class="md:hidden flex items-center">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" 
                            class="p-2 rounded-lg text-gray-600 hover:text-blue-700 hover:bg-blue-50 transition-colors">
                        <i class="fas fa-bars" x-show="!mobileMenuOpen"></i>
                        <i class="fas fa-times" x-show="mobileMenuOpen" x-cloak></i>
                    </button>
                </div>
            </div>
        </div>
        <div x-show="mobileMenuOpen" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 transform -translate-y-2"
             x-transition:enter-end="opacity-100 transform translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 transform translate-y-0"
             x-transition:leave-end="opacity-0 transform -translate-y-2"
             class="md:hidden bg-white border-t border-gray-200"
             x-cloak>
            <div class="px-4 py-2 space-y-1">
                <a href="{{ route('kegiatan') }}" 
                   class="flex items-center px-3 py-2 rounded-lg text-sm font-medium 
                          {{ request()->routeIs('kegiatan') 
                             ? 'bg-blue-100 text-blue-700' 
                             : 'text-gray-600 hover:text-blue-700 hover:bg-blue-50' }}">
                    <i class="fas fa-calendar-alt mr-3 text-xs"></i>
                    Kegiatan
                </a>
                <a href="{{ route('anggota') }}" 
                   class="flex items-center px-3 py-2 rounded-lg text-sm font-medium 
                          {{ request()->routeIs('anggota') 
                             ? 'bg-blue-100 text-blue-700' 
                             : 'text-gray-600 hover:text-blue-700 hover:bg-blue-50' }}">
                    <i class="fas fa-user-friends mr-3 text-xs"></i>
                    Anggota
                </a>
                <a href="{{ route('laporan') }}" 
                   class="flex items-center px-3 py-2 rounded-lg text-sm font-medium 
                          {{ request()->routeIs('laporan') 
                             ? 'bg-blue-100 text-blue-700' 
                             : 'text-gray-600 hover:text-blue-700 hover:bg-blue-50' }}">
                    <i class="fas fa-chart-line mr-3 text-xs"></i>
                    Laporan
                </a>
            </div>
        </div>
    </nav>

    <main class="py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            {{ $slot }}
        </div>
    </main>

    <footer class="bg-white border-t border-gray-200 mt-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-8">
            <div class="text-center text-gray-600">
                <p class="text-sm">© {{ date('Y') }} Organisasi Mahasiswa. Semua hak dilindungi.</p>
            </div>
        </div>
    </footer>

    @livewireScripts
    
    <style>
        [x-cloak] { display: none !important; }
    </style>
</body>
</html>