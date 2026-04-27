<x-layouts::app :title="__('Tambah Halaman')">
    <div class="flex h-full w-full flex-1 flex-col gap-6 max-w-3xl">
        <div>
            <flux:heading size="xl">{{ __('Tambah Halaman') }}</flux:heading>
            <flux:text class="mt-1">{{ __('Buat halaman baru untuk website.') }}</flux:text>
        </div>

        <form method="POST" action="{{ route('admin.pages.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <flux:field>
                <flux:label>{{ __('Judul') }}</flux:label>
                <flux:input name="title" value="{{ old('title') }}" placeholder="Masukkan judul halaman" required />
                @error('title') <flux:text class="!text-red-500 text-sm">{{ $message }}</flux:text> @enderror
            </flux:field>

            <flux:field>
                <flux:label>{{ __('Konten') }}</flux:label>
                <flux:textarea name="content" rows="8" placeholder="Tulis konten halaman..." required>{{ old('content') }}</flux:textarea>
                @error('content') <flux:text class="!text-red-500 text-sm">{{ $message }}</flux:text> @enderror
            </flux:field>

            <flux:field>
                <flux:label>{{ __('Gambar Utama') }}</flux:label>
                <flux:input type="file" name="featured_image" accept="image/*" />
                @error('featured_image') <flux:text class="!text-red-500 text-sm">{{ $message }}</flux:text> @enderror
            </flux:field>

            <div class="flex items-center gap-3">
                <flux:button type="submit" variant="primary">{{ __('Simpan') }}</flux:button>
                <flux:button href="{{ route('admin.pages.index') }}" wire:navigate variant="ghost">{{ __('Batal') }}</flux:button>
            </div>
        </form>
    </div>
</x-layouts::app>
