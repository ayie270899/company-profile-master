@php
    $stats = [
        ['label' => 'Total Halaman', 'count' => \App\Models\Page::count(), 'icon' => 'document-text', 'color' => 'text-orange-600', 'bg' => 'bg-orange-500/10', 'route' => 'admin.pages.index'],
        ['label' => 'Total Layanan', 'count' => \App\Models\Service::count(), 'icon' => 'wrench-screwdriver', 'color' => 'text-amber-600', 'bg' => 'bg-amber-500/10', 'route' => 'admin.services.index'],
        ['label' => 'Total Jurusan', 'count' => \App\Models\Portfolio::count(), 'icon' => 'academic-cap', 'color' => 'text-orange-500', 'bg' => 'bg-orange-400/10', 'route' => 'admin.portfolios.index'],
        ['label' => 'Pesan Masuk', 'count' => \App\Models\ContactMessage::count(), 'icon' => 'envelope', 'color' => 'text-emerald-600', 'bg' => 'bg-emerald-500/10', 'route' => 'admin.contact-messages.index'],
    ];
@endphp

<x-layouts::app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-6">
        <!-- Welcome Header -->
        <div class="flex flex-col gap-1">
            <flux:heading size="xl" level="1">Selamat Datang, {{ auth()->user()->name }}!</flux:heading>
            <flux:text>Berikut adalah ringkasan konten di website {{ config('app.name') }}.</flux:text>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($stats as $stat)
                <flux:card class="flex flex-col gap-4 p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div class="p-3 rounded-xl {{ $stat['bg'] }}">
                            <flux:icon :name="$stat['icon']" class="size-6 {{ $stat['color'] }}" />
                        </div>
                        <flux:button :href="route($stat['route'])" variant="ghost" size="sm" icon="arrow-right" wire:navigate />
                    </div>
                    <div>
                        <flux:heading size="lg" class="mb-1">{{ number_format($stat['count']) }}</flux:heading>
                        <flux:text font-size="sm" class="font-medium text-zinc-500 dark:text-zinc-400 capitalize">{{ $stat['label'] }}</flux:text>
                    </div>
                </flux:card>
            @endforeach
        </div>

        <!-- Secondary Section -->
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2 flex-1">
            <!-- Recent Activity Placeholder or Quick Actions -->
            <flux:card class="p-6">
                <flux:heading size="lg" class="mb-4">Tindakan Cepat</flux:heading>
                <div class="grid grid-cols-2 gap-4">
                    <flux:button :href="route('admin.pages.create')" icon="plus" variant="filled" class="justify-start">Halaman Baru</flux:button>
                    <flux:button :href="route('admin.services.create')" icon="plus" variant="filled" class="justify-start">Layanan Baru</flux:button>
                    <flux:button :href="route('admin.portfolios.create')" icon="plus" variant="filled" class="justify-start">Jurusan Baru</flux:button>
                    <flux:button :href="env('FRONTEND_URL', 'http://localhost:3000')" target="_blank" icon="eye" variant="filled" class="justify-start">Lihat Website</flux:button>
                </div>
            </flux:card>

            <!-- System Info or Recent Messages -->
            <flux:card class="p-6">
                <flux:heading size="lg" class="mb-4">Pesan Terbaru</flux:heading>
                @php $recentMessages = \App\Models\ContactMessage::latest()->take(3)->get(); @endphp
                <div class="space-y-4">
                    @forelse ($recentMessages as $msg)
                        <div class="flex items-start gap-4 p-3 rounded-lg hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors">
                            <div class="bg-zinc-100 dark:bg-zinc-800 p-2 rounded-lg shrink-0">
                                <flux:icon name="envelope" class="size-5 text-zinc-500" />
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex justify-between items-center mb-1">
                                    <flux:text font-size="sm" class="font-bold text-zinc-900 dark:text-white truncate">{{ $msg->name }}</flux:text>
                                    <flux:text font-size="xs" class="text-zinc-500">{{ $msg->created_at->diffForHumans() }}</flux:text>
                                </div>
                                <flux:text font-size="xs" class="line-clamp-1 italic text-zinc-500">"{{ $msg->subject }}"</flux:text>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-6 text-zinc-500">
                            Belum ada pesan masuk.
                        </div>
                    @endforelse
                    
                    @if ($recentMessages->count() > 0)
                        <div class="pt-2">
                             <flux:link :href="route('admin.contact-messages.index')" wire:navigate class="text-sm">Lihat semua pesan &rarr;</flux:link>
                        </div>
                    @endif
                </div>
            </flux:card>
        </div>
    </div>
</x-layouts::app>
