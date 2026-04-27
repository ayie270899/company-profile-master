<x-layouts::app :title="__('Tambah Layanan')">
    <div class="flex h-full w-full flex-1 flex-col gap-6 max-w-3xl">
        <div>
            <flux:heading size="xl">{{ __('Tambah Layanan') }}</flux:heading>
            <flux:text class="mt-1">{{ __('Buat layanan baru untuk perusahaan.') }}</flux:text>
        </div>

        <form method="POST" action="{{ route('admin.services.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <flux:field>
                <flux:label>{{ __('Judul') }}</flux:label>
                <flux:input name="title" value="{{ old('title') }}" placeholder="Masukkan judul layanan" required />
                @error('title') <flux:text class="!text-red-500 text-sm">{{ $message }}</flux:text> @enderror
            </flux:field>

            <flux:field>
                <flux:label>{{ __('Deskripsi Singkat') }}</flux:label>
                <flux:input name="short_desc" value="{{ old('short_desc') }}" placeholder="Deskripsi singkat layanan" required />
                @error('short_desc') <flux:text class="!text-red-500 text-sm">{{ $message }}</flux:text> @enderror
            </flux:field>

            <flux:field>
                <flux:label>{{ __('Deskripsi Lengkap') }}</flux:label>
                <flux:textarea name="description" rows="8" placeholder="Tulis deskripsi lengkap layanan..." required>{{ old('description') }}</flux:textarea>
                @error('description') <flux:text class="!text-red-500 text-sm">{{ $message }}</flux:text> @enderror
            </flux:field>

            <flux:field>
                <flux:label>{{ __('Icon / Gambar') }}</flux:label>
                <flux:input type="file" name="icon_image" accept="image/*" />
                @error('icon_image') <flux:text class="!text-red-500 text-sm">{{ $message }}</flux:text> @enderror
            </flux:field>

            <div class="flex items-center gap-3">
                <flux:button type="submit" variant="primary">{{ __('Simpan') }}</flux:button>
                <flux:button href="{{ route('admin.services.index') }}" wire:navigate variant="ghost">{{ __('Batal') }}</flux:button>
            </div>
        </form>
    </div>
</x-layouts::app>
