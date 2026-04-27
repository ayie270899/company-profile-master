<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'SMK DWIGUNA') }} - Temukan Potensi Anda</title>

        <link rel="icon" href="/dwiguna.png?v=2" sizes="any">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body { font-family: 'Inter', sans-serif; }
            .glass {
                background: rgba(255, 255, 255, 0.7);
                backdrop-filter: blur(10px);
                -webkit-backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.3);
            }
            .dark .glass {
                background: rgba(17, 24, 39, 0.7);
                border: 1px solid rgba(255, 255, 255, 0.1);
            }
            .gradient-text {
                background: linear-gradient(135deg, #f97316 0%, #fbbf24 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }
        </style>
    </head>
    <body class="bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-slate-100 antialiased selection:bg-orange-500 selection:text-white">
        
        <!-- Navigation -->
        <nav class="fixed top-0 w-full z-50 glass">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 items-center">
                    <div class="flex items-center gap-2">
                        <a href="{{ route('home') }}" class="flex items-center gap-2 font-bold text-xl tracking-tight text-orange-600 dark:text-orange-400">
                            <img src="dwiguna.png" alt="Logo SMK Dwiguna" class="h-10 w-auto">
                            {{ config('app.name') }}
                        </a>
                    </div>
                    <div class="hidden md:flex items-center space-x-2 text-sm font-medium">
                        <flux:button variant="ghost" href="#home" class="!font-medium">Home</flux:button>
                        <flux:button variant="ghost" href="#services" class="!font-medium">Layanan</flux:button>
                        <flux:button variant="ghost" href="#portfolio" class="!font-medium">Portfolio</flux:button>
                        <flux:button variant="ghost" href="#about" class="!font-medium">Tentang</flux:button>
                        <flux:button variant="ghost" href="#contact" class="!font-medium">Kontak</flux:button>
                        <flux:separator orientation="vertical" class="h-6 mx-2" />
                        @if (Route::has('login'))
                            @auth
                                <flux:button variant="primary" href="{{ route('dashboard') }}" class="rounded-full px-6 !bg-orange-600 hover:!bg-orange-700">Dashboard</flux:button>
                            @else
                                <flux:button variant="ghost" href="{{ route('login') }}" class="text-orange-600 dark:text-orange-400">Log in</flux:button>
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section id="home" class="relative min-h-screen flex items-center pt-20 overflow-hidden">
            <div class="absolute inset-0 z-0">
                <div class="absolute top-1/4 -left-20 w-96 h-96 bg-orange-500/10 rounded-full blur-3xl animate-pulse"></div>
                <div class="absolute bottom-1/4 -right-20 w-96 h-96 bg-amber-500/10 rounded-full blur-3xl animate-pulse delay-700"></div>
            </div>
            
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <div class="space-y-8 animate-in fade-in slide-in-from-left-10 duration-1000">
                        <flux:heading size="3xl" level="1" class="tracking-tight leading-tight">
                            Selamat Datang <span class="gradient-text">di SMK DWIGUNA.</span> Temukan Potensi Anda
                        </flux:heading>
                        <flux:text size="lg" class="max-w-lg">
                            Temukan potensi diri Anda di bidang teknologi bersama SMK DWIGUNA Depok. Kami mendidik generasi unggul yang siap kerja.
                        </flux:text>
                        <div class="flex flex-wrap gap-4">
                            <flux:button variant="primary" size="base" href="#contact" class="px-8 py-6 rounded-2xl shadow-xl shadow-orange-500/30 !bg-orange-600 hover:!bg-orange-700">
                                Mulai Sekarang
                            </flux:button>
                            <flux:button variant="filled" size="base" href="#portfolio" class="px-8 py-6 rounded-2xl">
                                Lihat Jurusan
                            </flux:button>
                        </div>
                    </div>
                    <div class="hidden lg:block animate-in fade-in zoom-in duration-1000 delay-200">
                        <div class="relative group">
                            <div class="absolute -inset-1 bg-gradient-to-r from-orange-500 to-amber-500 rounded-3xl blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200"></div>
                            <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?q=80&w=2426&auto=format&fit=crop" 
                                 alt="Hero Image" 
                                 class="relative rounded-3xl shadow-2xl object-cover aspect-square">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Services Section -->
        <section id="services" class="py-24 bg-white dark:bg-slate-900/50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center space-y-4 mb-16">
                    <flux:heading size="sm" class="text-orange-600 dark:text-orange-400 font-semibold tracking-wider uppercase">Layanan Kami</flux:heading>
                    <flux:heading size="xl" level="2">Layanan Terbaik Untuk Siswa</flux:heading>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($services as $service)
                        <flux:card class="group !p-8 !rounded-3xl hover:!border-orange-500 transition-all duration-300 hover:shadow-2xl hover:shadow-orange-500/10">
                            <div class="w-14 h-14 bg-orange-100 dark:bg-orange-900/50 flex items-center justify-center rounded-2xl mb-6 group-hover:scale-110 transition-transform">
                                @if($service->icon_image)
                                    <img src="{{ Storage::url($service->icon_image) }}" alt="{{ $service->title }}" class="w-8 h-8 object-contain">
                                @else
                                    <flux:icon name="wrench-screwdriver" class="w-8 h-8 text-orange-600 dark:text-orange-400" />
                                @endif
                            </div>
                            <flux:heading size="lg" class="mb-3">{{ $service->title }}</flux:heading>
                            <flux:text class="line-clamp-3">
                                {{ $service->short_desc }}
                            </flux:text>
                        </flux:card>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Portfolio Section -->
        <section id="portfolio" class="py-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-4">
                    <div class="space-y-4">
                        <flux:heading size="sm" class="text-orange-600 dark:text-orange-400 font-semibold tracking-wider uppercase">Jurusan</flux:heading>
                        <flux:heading size="xl" level="2">Jurusan yang Tersedia</flux:heading>
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-8">
                    @foreach($portfolios as $portfolio)
                        <div class="group relative overflow-hidden rounded-3xl bg-slate-200 dark:bg-slate-800">
                            <img src="{{ $portfolio->images->first() ? Storage::url($portfolio->images->first()->image_path) : 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?q=80&w=2670&auto=format&fit=crop' }}" 
                                 alt="{{ $portfolio->title }}" 
                                 class="w-full aspect-video object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-slate-950/20 to-transparent flex flex-col justify-end p-8 transform translate-y-4 group-hover:translate-y-0 transition-transform">
                                <flux:text size="sm" class="!text-orange-400 font-medium mb-2">{{ \Carbon\Carbon::parse($portfolio->project_date)->format('M Y') }}</flux:text>
                                <flux:heading size="lg" class="!text-white mb-2">{{ $portfolio->title }}</flux:heading>
                                <flux:text size="sm" class="!text-slate-300 line-clamp-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                    {{ $portfolio->short_desc }}
                                </flux:text>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- About Us Section -->
        @if($aboutPage)
            <section id="about" class="py-24 bg-orange-600 text-white overflow-hidden relative">
                <div class="absolute top-0 right-0 -translate-y-1/2 translate-x-1/2 w-[600px] h-[600px] bg-white/10 rounded-full blur-3xl"></div>
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                    <div class="grid lg:grid-cols-2 gap-16 items-center">
                        <div class="space-y-8">
                            <flux:heading size="sm" class="!text-orange-200 font-semibold tracking-wider uppercase">Tentang Kami</flux:heading>
                            <flux:heading size="2xl" level="2" class="!text-white font-bold leading-tight">{{ $aboutPage->title }}</flux:heading>
                            <div class="text-orange-100 lg:text-lg leading-relaxed space-y-4">
                                {!! nl2br(e($aboutPage->content)) !!}
                            </div>
                        </div>
                        <div class="relative">
                            <div class="absolute -inset-4 bg-white/20 rounded-3xl blur animate-pulse"></div>
                            <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?q=80&w=2670&auto=format&fit=crop" 
                                 alt="About Us" 
                                 class="relative rounded-3xl shadow-2xl">
                        </div>
                    </div>
                </div>
            </section>
        @endif

        <!-- Contact Section -->
        <section id="contact" class="py-24 bg-white dark:bg-slate-950">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center space-y-4 mb-16">
                    <flux:heading size="sm" class="text-orange-600 dark:text-orange-400 font-semibold tracking-wider uppercase">Hubungi Kami</flux:heading>
                    <flux:heading size="xl" level="2">Mari Berdiskusi Bersama Kami</flux:heading>
                </div>

                <div class="grid lg:grid-cols-5 gap-12">
                    <div class="lg:col-span-2 space-y-8">
                        <div class="flex gap-6 items-start">
                            <div class="w-12 h-12 bg-orange-50 dark:bg-orange-900/30 flex items-center justify-center rounded-2xl shrink-0">
                                <flux:icon name="envelope" class="w-6 h-6 text-orange-600 dark:text-orange-400" />
                            </div>
                            <div>
                                <flux:heading size="lg" class="mb-1">Email</flux:heading>
                                <flux:text>ayie270899@gmail.com</flux:text>
                            </div>
                        </div>
                        <div class="flex gap-6 items-start">
                            <div class="w-12 h-12 bg-orange-50 dark:bg-orange-900/30 flex items-center justify-center rounded-2xl shrink-0">
                                <flux:icon name="map-pin" class="w-6 h-6 text-orange-600 dark:text-orange-400" />
                            </div>
                            <div>
                                <flux:heading size="lg" class="mb-1">Kantor</flux:heading>
                                <flux:text>Jl. Raya Citayam No. 123, Depok</flux:text>
                            </div>
                        </div>
                        <div class="flex gap-6 items-start">
                            <div class="w-12 h-12 bg-orange-50 dark:bg-orange-900/30 flex items-center justify-center rounded-2xl shrink-0">
                                <flux:icon name="phone" class="w-6 h-6 text-orange-600 dark:text-orange-400" />
                            </div>
                            <div>
                                <flux:heading size="lg" class="mb-1">WhatsApp</flux:heading>
                                <flux:text>0889-0111-5574</flux:text>
                            </div>
                        </div>
                    </div>

                    <div class="lg:col-span-3">
                        <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                            @csrf
                            <flux:card class="!p-8 !rounded-3xl shadow-xl">
                                @if(session('success'))
                                    <div class="p-4 bg-emerald-500/10 text-emerald-500 rounded-xl border border-emerald-500/20 mb-6">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                <div class="grid md:grid-cols-2 gap-6 mb-6">
                                    <flux:input name="name" label="Nama Lengkap" required placeholder="Masukkan nama Anda" />
                                    <flux:input name="email" type="email" label="Email" required placeholder="Masukkan email Anda" />
                                </div>
                                <flux:input name="subject" label="Subjek" required class="mb-6" placeholder="Subjek pesan" />
                                <flux:textarea name="message" label="Pesan" rows="4" required class="mb-6" placeholder="Tuliskan pesan Anda di sini..." />
                                
                                <flux:button type="submit" variant="primary" size="base" class="w-full !rounded-xl !py-4 !font-bold !bg-orange-600 hover:!bg-orange-700">
                                    Kirim Pesan
                                </flux:button>
                            </flux:card>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="py-12 border-t border-slate-200 dark:border-slate-800 text-center">
            <div class="max-w-7xl mx-auto px-4">
                <flux:text size="sm">&copy; {{ date('Y') }} {{ config('app.name', 'SMK DWIGUNA') }}. All rights reserved.</flux:text>
            </div>
        </footer>

        @fluxScripts
    </body>
</html>
