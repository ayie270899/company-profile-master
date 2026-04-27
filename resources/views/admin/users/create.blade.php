<x-layouts::app :title="__('Tambah Admin')">
    <div class="flex flex-col gap-6 max-w-2xl mx-auto">
        <div>
            <flux:heading size="xl" level="1">{{ __('Tambah Admin Baru') }}</flux:heading>
            <flux:subheading>{{ __('Buat akun administrator baru untuk mengakses dashboard ini.') }}</flux:subheading>
        </div>

        <flux:separator variant="subtle" />

        <flux:card>
            <form method="POST" action="{{ route('admin.users.store') }}" class="flex flex-col gap-6">
                @csrf

                <flux:input 
                    name="name" 
                    :label="__('Nama Lengkap')" 
                    :value="old('name')"
                    required 
                    autofocus 
                    placeholder="Masukkan nama lengkap"
                />

                <flux:input 
                    name="email" 
                    type="email" 
                    :label="__('Alamat Email')" 
                    :value="old('email')"
                    required 
                    placeholder="nama@email.com"
                />

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <flux:input 
                        name="password" 
                        type="password" 
                        :label="__('Kata Sandi')" 
                        required 
                        viewable
                        placeholder="********"
                    />

                    <flux:input 
                        name="password_confirmation" 
                        type="password" 
                        :label="__('Konfirmasi Kata Sandi')" 
                        required 
                        placeholder="********"
                    />
                </div>

                <flux:select name="role" :label="__('Role')" required>
                    <flux:select.option value="admin" selected>{{ __('Admin') }}</flux:select.option>
                    <flux:select.option value="user">{{ __('User') }}</flux:select.option>
                </flux:select>

                <div class="flex gap-2 justify-end mt-4">
                    <flux:button :href="route('admin.users.index')" variant="ghost" wire:navigate>{{ __('Batal') }}</flux:button>
                    <flux:button type="submit" variant="primary">{{ __('Simpan Admin') }}</flux:button>
                </div>
            </form>
        </flux:card>
    </div>
</x-layouts::app>
