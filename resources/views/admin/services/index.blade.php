<x-layouts::app :title="__('Services')">
    <div class="flex h-full w-full flex-1 flex-col gap-6">
        <div class="flex items-center justify-between">
            <div>
                <flux:heading size="xl">{{ __('Services') }}</flux:heading>
                <flux:text class="mt-1">{{ __('Kelola semua layanan perusahaan.') }}</flux:text>
            </div>
            <flux:button href="{{ route('admin.services.create') }}" wire:navigate icon="plus" variant="primary">
                {{ __('Tambah Layanan') }}
            </flux:button>
        </div>

        @if(session('success'))
            <flux:callout variant="success" icon="check-circle" dismissible>
                {{ session('success') }}
            </flux:callout>
        @endif

        <div class="overflow-x-auto rounded-xl border border-neutral-200 dark:border-neutral-700">
            <table class="w-full text-left text-sm">
                <thead class="border-b border-neutral-200 bg-zinc-50 dark:border-neutral-700 dark:bg-zinc-900">
                    <tr>
                        <th class="px-4 py-3 font-medium text-zinc-600 dark:text-zinc-300">#</th>
                        <th class="px-4 py-3 font-medium text-zinc-600 dark:text-zinc-300">{{ __('Icon') }}</th>
                        <th class="px-4 py-3 font-medium text-zinc-600 dark:text-zinc-300">{{ __('Judul') }}</th>
                        <th class="px-4 py-3 font-medium text-zinc-600 dark:text-zinc-300">{{ __('Deskripsi Singkat') }}</th>
                        <th class="px-4 py-3 font-medium text-zinc-600 dark:text-zinc-300">{{ __('Dibuat Oleh') }}</th>
                        <th class="px-4 py-3 font-medium text-zinc-600 dark:text-zinc-300 text-right">{{ __('Aksi') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">
                    @forelse($services as $service)
                        <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors">
                            <td class="px-4 py-3 text-zinc-500 dark:text-zinc-400">{{ $loop->iteration + ($services->currentPage() - 1) * $services->perPage() }}</td>
                            <td class="px-4 py-3">
                                @if($service->icon_image)
                                    <img src="{{ asset('storage/' . $service->icon_image) }}" alt="icon" class="h-8 w-8 rounded object-cover">
                                @else
                                    <div class="h-8 w-8 rounded bg-zinc-200 dark:bg-zinc-700 flex items-center justify-center">
                                        <flux:icon name="wrench-screwdriver" class="size-4 text-zinc-400" />
                                    </div>
                                @endif
                            </td>
                            <td class="px-4 py-3 font-medium text-zinc-900 dark:text-zinc-100">{{ $service->title }}</td>
                            <td class="px-4 py-3 text-zinc-500 dark:text-zinc-400">{{ Str::limit($service->short_desc, 50) }}</td>
                            <td class="px-4 py-3 text-zinc-500 dark:text-zinc-400">{{ $service->creator->name ?? '-' }}</td>
                            <td class="px-4 py-3 text-right">
                                <div class="flex items-center justify-end gap-1">
                                    <flux:button href="{{ route('admin.services.edit', $service) }}" wire:navigate size="sm" icon="pencil-square" variant="ghost">
                                    </flux:button>
                                    <form method="POST" action="{{ route('admin.services.destroy', $service) }}" onsubmit="return confirm('Yakin ingin menghapus layanan ini?')">
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
                                {{ __('Belum ada layanan.') }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div>{{ $services->links() }}</div>
    </div>
</x-layouts::app>
