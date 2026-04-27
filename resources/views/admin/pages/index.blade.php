<x-layouts::app :title="__('Pages')">
    <div class="flex h-full w-full flex-1 flex-col gap-6">
        {{-- Header --}}
        <div class="flex items-center justify-between">
            <div>
                <flux:heading size="xl">{{ __('Pages') }}</flux:heading>
                <flux:text class="mt-1">{{ __('Kelola semua halaman website.') }}</flux:text>
            </div>
            <flux:button href="{{ route('admin.pages.create') }}" wire:navigate icon="plus" variant="primary">
                {{ __('Tambah Halaman') }}
            </flux:button>
        </div>

        {{-- Flash Message --}}
        @if(session('success'))
            <flux:callout variant="success" icon="check-circle" dismissible>
                {{ session('success') }}
            </flux:callout>
        @endif

        {{-- Table --}}
        <div class="overflow-x-auto rounded-xl border border-neutral-200 dark:border-neutral-700">
            <table class="w-full text-left text-sm">
                <thead class="border-b border-neutral-200 bg-zinc-50 dark:border-neutral-700 dark:bg-zinc-900">
                    <tr>
                        <th class="px-4 py-3 font-medium text-zinc-600 dark:text-zinc-300">#</th>
                        <th class="px-4 py-3 font-medium text-zinc-600 dark:text-zinc-300">{{ __('Judul') }}</th>
                        <th class="px-4 py-3 font-medium text-zinc-600 dark:text-zinc-300">{{ __('Slug') }}</th>
                        <th class="px-4 py-3 font-medium text-zinc-600 dark:text-zinc-300">{{ __('Dibuat Oleh') }}</th>
                        <th class="px-4 py-3 font-medium text-zinc-600 dark:text-zinc-300">{{ __('Tanggal') }}</th>
                        <th class="px-4 py-3 font-medium text-zinc-600 dark:text-zinc-300 text-right">{{ __('Aksi') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">
                    @forelse($pages as $page)
                        <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors">
                            <td class="px-4 py-3 text-zinc-500 dark:text-zinc-400">{{ $loop->iteration + ($pages->currentPage() - 1) * $pages->perPage() }}</td>
                            <td class="px-4 py-3 font-medium text-zinc-900 dark:text-zinc-100">{{ $page->title }}</td>
                            <td class="px-4 py-3 text-zinc-500 dark:text-zinc-400">{{ $page->slug }}</td>
                            <td class="px-4 py-3 text-zinc-500 dark:text-zinc-400">{{ $page->creator->name ?? '-' }}</td>
                            <td class="px-4 py-3 text-zinc-500 dark:text-zinc-400">{{ $page->created_at->format('d M Y') }}</td>
                            <td class="px-4 py-3 text-right">
                                <div class="flex items-center justify-end gap-1">
                                    <flux:button href="{{ route('admin.pages.edit', $page) }}" wire:navigate size="sm" icon="pencil-square" variant="ghost">
                                    </flux:button>
                                    <form method="POST" action="{{ route('admin.pages.destroy', $page) }}" onsubmit="return confirm('Yakin ingin menghapus halaman ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <flux:button type="submit" size="sm" icon="trash" variant="ghost" class="!text-red-500 hover:!text-red-700">
                                        </flux:button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-8 text-center text-zinc-500 dark:text-zinc-400">
                                {{ __('Belum ada halaman.') }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div>
            {{ $pages->links() }}
        </div>
    </div>
</x-layouts::app>
