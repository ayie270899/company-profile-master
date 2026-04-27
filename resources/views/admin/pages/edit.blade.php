<x-layouts::app :title="__('Edit Halaman')">
    <div class="flex h-full w-full flex-1 flex-col gap-6 max-w-3xl">
        <div>
            <flux:heading size="xl">{{ __('Edit Halaman') }}</flux:heading>
            <flux:text class="mt-1">{{ __('Perbarui data halaman.') }}</flux:text>
        </div>

        @if(session('success'))
            <flux:callout variant="success" icon="check-circle" dismissible>
                {{ session('success') }}
            </flux:callout>
        @endif

        <form method="POST" action="{{ route('admin.pages.update', $page) }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <flux:field>
                <flux:label>{{ __('Judul') }}</flux:label>
                <flux:input name="title" value="{{ old('title', $page->title) }}" placeholder="Masukkan judul halaman" required />
                @error('title') <flux:text class="!text-red-500 text-sm">{{ $message }}</flux:text> @enderror
            </flux:field>

            <flux:field>
                <flux:label>{{ __('Konten') }}</flux:label>
                <flux:textarea name="content" rows="8" placeholder="Tulis konten halaman..." required>{{ old('content', $page->content) }}</flux:textarea>
                @error('content') <flux:text class="!text-red-500 text-sm">{{ $message }}</flux:text> @enderror
            </flux:field>

            <flux:field>
                <flux:label>{{ __('Gambar Utama') }}</flux:label>
                @if($page->featured_image)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $page->featured_image) }}" alt="Featured Image" class="h-32 w-auto rounded-lg border border-neutral-200 dark:border-neutral-700 object-cover">
                    </div>
                @endif
                <flux:input type="file" name="featured_image" accept="image/*" />
                <flux:text class="text-xs">{{ __('Kosongkan jika tidak ingin mengubah gambar.') }}</flux:text>
                @error('featured_image') <flux:text class="!text-red-500 text-sm">{{ $message }}</flux:text> @enderror
            </flux:field>

            <div class="flex items-center gap-3">
                <flux:button type="submit" variant="primary">{{ __('Perbarui') }}</flux:button>
                <flux:button href="{{ route('admin.pages.index') }}" wire:navigate variant="ghost">{{ __('Batal') }}</flux:button>
            </div>
        </form>
    </div>
</x-layouts::app>
