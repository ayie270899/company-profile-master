<x-layouts::auth.card :title="__('Log in')">
    <style>
        body {
            background-color: rgb(248, 250, 252) !important; /* slate-50 */
        }
        .dark body {
            background-color: rgb(2, 6, 23) !important; /* slate-950 */
        }
        .premium-bg {
            position: fixed;
            inset: 0;
            z-index: -1;
            overflow: hidden;
            pointer-events: none;
        }
    </style>

    <div class="premium-bg">
        <div class="absolute top-1/4 -left-20 w-96 h-96 bg-orange-500/10 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-1/4 -right-20 w-96 h-96 bg-amber-500/10 rounded-full blur-3xl animate-pulse delay-700"></div>
    </div>

    <div class="flex flex-col gap-6">
        <div class="text-center">
            <flux:heading size="xl" level="1" class="mb-2">Selamat Datang</flux:heading>
            <flux:text size="sm">Masuk ke dashboard admin untuk mengelola konten.</flux:text>
        </div>

        <x-auth-session-status :status="session('status')" />

        <form method="POST" action="{{ route('login.store') }}" class="flex flex-col gap-6">
            @csrf

            <flux:input
                name="email"
                label="Alamat Email"
                type="email"
                :value="old('email')"
                required
                autofocus
                autocomplete="email"
                placeholder="nama@email.com"
            />

            <div class="relative">
                <flux:input
                    name="password"
                    label="Kata Sandi"
                    type="password"
                    required
                    autocomplete="current-password"
                    placeholder="********"
                    viewable
                />

                @if (Route::has('password.request'))
                    <flux:link class="absolute top-0 end-0 text-xs !text-orange-600" :href="route('password.request')" wire:navigate>
                        Lupa kata sandi?
                    </flux:link>
                @endif
            </div>

            <flux:checkbox name="remember" label="Ingat saya" :checked="old('remember')" />

            <flux:button variant="primary" type="submit" class="w-full !py-3 !bg-orange-600 hover:!bg-orange-700">
                Masuk Sekarang
            </flux:button>
        </form>

        <flux:separator />

        <div class="text-center">
            <flux:button variant="ghost" icon="arrow-left" href="{{ route('home') }}" size="sm" class="text-slate-500">
                Kembali ke Beranda
            </flux:button>
        </div>
    </div>
</x-layouts::auth.card>
