<x-layouts::app :title="__('Edit Admin')">
    <div class="flex flex-col gap-6 max-w-2xl mx-auto">
        <div>
            <flux:heading size="xl" level="1">{{ __('Edit Admin') }}</flux:heading>
            <flux:subheading>{{ __('Perbarui informasi akun administrator :name.', ['name' => $user->name]) }}</flux:subheading>
        </div>

        <flux:separator variant="subtle" />

        <flux:card>
            <form method="POST" action="{{ route('admin.users.update', $user) }}" class="flex flex-col gap-6">
                @csrf
                @method('PUT')

                <flux:input 
                    name="name" 
                    :label="__('Nama Lengkap')" 
                    :value="old('name', $user->name)"
                    required 
                    autofocus 
                    placeholder="Masukkan nama lengkap"
                />

                <flux:input 
                    name="email" 
                    type="email" 
                    :label="__('Alamat Email')" 
                    :value="old('email', $user->email)"
                    required 
                    placeholder="nama@email.com"
                />

                <flux:fieldset class="!mt-2">
                    <flux:legend>{{ __('Ganti Kata Sandi (Opsional)') }}</flux:legend>
                    <flux:text size="sm" class="mb-4">{{ __('Kosongkan jika tidak ingin mengubah kata sandi.') }}</flux:text>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <flux:input 
                            name="password" 
                            type="password" 
                            :label="__('Kata Sandi Baru')" 
                            viewable
                            placeholder="********"
                        />

                        <flux:input 
                            name="password_confirmation" 
                            type="password" 
                            :label="__('Konfirmasi Kata Sandi Baru')" 
                            placeholder="********"
                        />
                    </div>
                </flux:fieldset>

                <flux:select name="role" :label="__('Role')" required>
                    <flux:select.option value="admin" :selected="$user->role === 'admin'">{{ __('Admin') }}</flux:select.option>
                    <flux:select.option value="user" :selected="$user->role === 'user'">{{ __('User') }}</flux:select.option>
                </flux:select>

                <div class="flex gap-2 justify-end mt-4">
                    <flux:button :href="route('admin.users.index')" variant="ghost" wire:navigate>{{ __('Batal') }}</flux:button>
                    <flux:button type="submit" variant="primary">{{ __('Perbarui Admin') }}</flux:button>
                </div>
            </form>
        </flux:card>
    </div>
</x-layouts::app>
