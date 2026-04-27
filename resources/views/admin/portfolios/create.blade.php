<x-layouts::app :title="__('Tambah Jurusan')">
    <div class="flex h-full w-full flex-1 flex-col gap-6 max-w-3xl">
        <div>
            <flux:heading size="xl">{{ __('Tambah Jurusan') }}</flux:heading>
            <flux:text class="mt-1">{{ __('Buat jurusan baru.') }}</flux:text>
        </div>

        <form method="POST" action="{{ route('admin.portfolios.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <flux:field>
                <flux:label>{{ __('Judul') }}</flux:label>
                <flux:input name="title" value="{{ old('title') }}" placeholder="Masukkan judul portfolio" required />
                @error('title') <flux:text class="!text-red-500 text-sm">{{ $message }}</flux:text> @enderror
            </flux:field>

            <flux:field>
                <flux:label>{{ __('Deskripsi Singkat') }}</flux:label>
                <flux:input name="short_desc" value="{{ old('short_desc') }}" placeholder="Deskripsi singkat proyek" required />
                @error('short_desc') <flux:text class="!text-red-500 text-sm">{{ $message }}</flux:text> @enderror
            </flux:field>

            <flux:field>
                <flux:label>{{ __('Detail Lengkap') }}</flux:label>
                <flux:textarea name="full_content" rows="8" placeholder="Tulis detail proyek..." required>{{ old('full_content') }}</flux:textarea>
                @error('full_content') <flux:text class="!text-red-500 text-sm">{{ $message }}</flux:text> @enderror
            </flux:field>

            <flux:field>
                <flux:label>{{ __('Tanggal Proyek') }}</flux:label>
                <flux:input type="date" name="project_date" value="{{ old('project_date') }}" required />
                @error('project_date') <flux:text class="!text-red-500 text-sm">{{ $message }}</flux:text> @enderror
            </flux:field>

            <flux:field>
                <flux:label>{{ __('Gambar Utama') }} (Thumbnail)</flux:label>
                <flux:input type="file" name="main_image" accept="image/*" />
                <flux:text class="text-xs">{{ __('Gunakan gambar rasio 16:9 untuk hasil terbaik.') }}</flux:text>
                @error('main_image') <flux:text class="!text-red-500 text-sm">{{ $message }}</flux:text> @enderror
            </flux:field>

            <flux:field>
                <flux:label>{{ __('Galeri Foto Tambahan') }}</flux:label>
                <flux:input type="file" name="images[]" accept="image/*" multiple />
                <flux:text class="text-xs">{{ __('Pilih beberapa foto untuk galeri detail.') }}</flux:text>
                @error('images.*') <flux:text class="!text-red-500 text-sm">{{ $message }}</flux:text> @enderror
            </flux:field>

            <div class="flex items-center gap-3">
                <flux:button type="submit" variant="primary">{{ __('Simpan') }}</flux:button>
                <flux:button href="{{ route('admin.portfolios.index') }}" wire:navigate variant="ghost">{{ __('Batal') }}</flux:button>
            </div>
        </form>
    </div>
</x-layouts::app>
