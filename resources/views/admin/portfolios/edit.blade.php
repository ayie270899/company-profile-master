<x-layouts::app :title="__('Edit Jurusan')">
    <div class="flex h-full w-full flex-1 flex-col gap-6 max-w-3xl">
        <div>
            <flux:heading size="xl">{{ __('Edit Jurusan') }}</flux:heading>
            <flux:text class="mt-1">{{ __('Perbarui data jurusan.') }}</flux:text>
        </div>

        @if(session('success'))
            <flux:callout variant="success" icon="check-circle" dismissible>
                {{ session('success') }}
            </flux:callout>
        @endif

        <form method="POST" action="{{ route('admin.portfolios.update', $portfolio) }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <flux:field>
                <flux:label>{{ __('Judul') }}</flux:label>
                <flux:input name="title" value="{{ old('title', $portfolio->title) }}" placeholder="Masukkan judul portfolio" required />
                @error('title') <flux:text class="!text-red-500 text-sm">{{ $message }}</flux:text> @enderror
            </flux:field>

            <flux:field>
                <flux:label>{{ __('Deskripsi Singkat') }}</flux:label>
                <flux:input name="short_desc" value="{{ old('short_desc', $portfolio->short_desc) }}" placeholder="Deskripsi singkat proyek" required />
                @error('short_desc') <flux:text class="!text-red-500 text-sm">{{ $message }}</flux:text> @enderror
            </flux:field>

            <flux:field>
                <flux:label>{{ __('Detail Lengkap') }}</flux:label>
                <flux:textarea name="full_content" rows="8" placeholder="Tulis detail proyek..." required>{{ old('full_content', $portfolio->full_content) }}</flux:textarea>
                @error('full_content') <flux:text class="!text-red-500 text-sm">{{ $message }}</flux:text> @enderror
            </flux:field>

            <flux:field>
                <flux:label>{{ __('Tanggal Proyek') }}</flux:label>
                <flux:input type="date" name="project_date" value="{{ old('project_date', $portfolio->project_date->format('Y-m-d')) }}" required />
                @error('project_date') <flux:text class="!text-red-500 text-sm">{{ $message }}</flux:text> @enderror
            </flux:field>

            <flux:field>
                <flux:label>{{ __('Gambar Utama') }} (Thumbnail)</flux:label>
                @if($portfolio->main_image_url)
                    <div class="mb-3">
                        <img src="{{ asset('storage/' . $portfolio->main_image_url) }}" alt="Main image" class="h-40 w-auto rounded-lg object-cover border border-neutral-200 dark:border-neutral-700">
                    </div>
                @endif
                <flux:input type="file" name="main_image" accept="image/*" />
                <flux:text class="text-xs">{{ __('Bila diisi, akan menggantikan gambar utama yang lama.') }}</flux:text>
                @error('main_image') <flux:text class="!text-red-500 text-sm">{{ $message }}</flux:text> @enderror
            </flux:field>

            {{-- Existing Images --}}
            @if($portfolio->images->count() > 0)
                <div>
                    <flux:label class="mb-2">{{ __('Foto Galeri & Keterangan (Caption)') }}</flux:label>
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
                        @foreach($portfolio->images as $image)
                            <div class="group relative rounded-lg border border-neutral-200 dark:border-neutral-700 bg-slate-50 dark:bg-slate-800/50 flex flex-col">
                                <div class="relative overflow-hidden w-full rounded-t-lg">
                                    <img src="{{ asset('storage/' . $image->image_path) }}" alt="Portfolio image" class="h-28 w-full object-cover">
                                    <button type="submit" form="delete-img-{{ $image->id }}" class="absolute top-1 right-1 rounded-full bg-red-500/80 p-1 text-white opacity-0 group-hover:opacity-100 transition-opacity hover:bg-red-600">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                    </button>
                                </div>
                                <div class="p-2">
                                    <flux:input name="captions[{{ $image->id }}]" value="{{ old('captions.'.$image->id, $image->caption) }}" placeholder="Tulis caption gambar..." class="!text-xs" />
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <flux:field>
                <flux:label>{{ __('Tambah Galeri Foto Baru') }}</flux:label>
                <flux:input type="file" name="images[]" accept="image/*" multiple />
                <flux:text class="text-xs">{{ __('Pilih foto untuk galeri tambahan. Tidak menghapus yang lama.') }}</flux:text>
                @error('images.*') <flux:text class="!text-red-500 text-sm">{{ $message }}</flux:text> @enderror
            </flux:field>

            <div class="flex items-center gap-3">
                <flux:button type="submit" variant="primary">{{ __('Perbarui') }}</flux:button>
                <flux:button href="{{ route('admin.portfolios.index') }}" wire:navigate variant="ghost">{{ __('Batal') }}</flux:button>
            </div>
        </form>

        {{-- Hidden Forms for Deleting Individual Images --}}
        @foreach($portfolio->images as $image)
            <form id="delete-img-{{ $image->id }}" method="POST" action="{{ route('admin.portfolio-images.destroy', $image) }}" onsubmit="return confirm('Yakin ingin menghapus gambar ini?')" class="hidden">
                @csrf
                @method('DELETE')
            </form>
        @endforeach
    </div>
</x-layouts::app>
