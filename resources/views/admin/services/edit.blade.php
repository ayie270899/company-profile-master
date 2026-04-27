<x-layouts::app :title="__('Edit Layanan')">
    <div class="flex h-full w-full flex-1 flex-col gap-6 max-w-3xl">
        <div>
            <flux:heading size="xl">{{ __('Edit Layanan') }}</flux:heading>
            <flux:text class="mt-1">{{ __('Perbarui data layanan.') }}</flux:text>
        </div>

        @if(session('success'))
            <flux:callout variant="success" icon="check-circle" dismissible>
                {{ session('success') }}
            </flux:callout>
        @endif

        <form method="POST" action="{{ route('admin.services.update', $service) }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <flux:field>
                <flux:label>{{ __('Judul') }}</flux:label>
                <flux:input name="title" value="{{ old('title', $service->title) }}" placeholder="Masukkan judul layanan" required />
                @error('title') <flux:text class="!text-red-500 text-sm">{{ $message }}</flux:text> @enderror
            </flux:field>

            <flux:field>
                <flux:label>{{ __('Deskripsi Singkat') }}</flux:label>
                <flux:input name="short_desc" value="{{ old('short_desc', $service->short_desc) }}" placeholder="Deskripsi singkat layanan" required />
                @error('short_desc') <flux:text class="!text-red-500 text-sm">{{ $message }}</flux:text> @enderror
            </flux:field>

            <flux:field>
                <flux:label>{{ __('Deskripsi Lengkap') }}</flux:label>
                <flux:textarea name="description" rows="8" placeholder="Tulis deskripsi lengkap layanan..." required>{{ old('description', $service->description) }}</flux:textarea>
                @error('description') <flux:text class="!text-red-500 text-sm">{{ $message }}</flux:text> @enderror
            </flux:field>

            <flux:field>
                <flux:label>{{ __('Icon / Gambar') }}</flux:label>
                @if($service->icon_image)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $service->icon_image) }}" alt="Icon" class="h-16 w-16 rounded-lg border border-neutral-200 dark:border-neutral-700 object-cover">
                    </div>
                @endif
                <flux:input type="file" name="icon_image" accept="image/*" />
                <flux:text class="text-xs">{{ __('Kosongkan jika tidak ingin mengubah icon.') }}</flux:text>
                @error('icon_image') <flux:text class="!text-red-500 text-sm">{{ $message }}</flux:text> @enderror
            </flux:field>

            <div class="flex items-center gap-3">
                <flux:button type="submit" variant="primary">{{ __('Perbarui') }}</flux:button>
                <flux:button href="{{ route('admin.services.index') }}" wire:navigate variant="ghost">{{ __('Batal') }}</flux:button>
            </div>
        </form>
    </div>
</x-layouts::app>
