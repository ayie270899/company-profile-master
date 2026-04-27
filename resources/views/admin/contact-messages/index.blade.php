<x-layouts::app :title="__('Pesan Masuk')">
    <div class="flex h-full w-full flex-1 flex-col gap-6">
        <div>
            <flux:heading size="xl">{{ __('Pesan Masuk') }}</flux:heading>
            <flux:text class="mt-1">{{ __('Daftar pesan dari form contact website.') }}</flux:text>
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
                        <th class="px-4 py-3 font-medium text-zinc-600 dark:text-zinc-300">{{ __('Nama') }}</th>
                        <th class="px-4 py-3 font-medium text-zinc-600 dark:text-zinc-300">{{ __('Email') }}</th>
                        <th class="px-4 py-3 font-medium text-zinc-600 dark:text-zinc-300">{{ __('Subjek') }}</th>
                        <th class="px-4 py-3 font-medium text-zinc-600 dark:text-zinc-300">{{ __('Tanggal') }}</th>
                        <th class="px-4 py-3 font-medium text-zinc-600 dark:text-zinc-300 text-right">{{ __('Aksi') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">
                    @forelse($messages as $message)
                        <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors">
                            <td class="px-4 py-3 text-zinc-500 dark:text-zinc-400">{{ $loop->iteration + ($messages->currentPage() - 1) * $messages->perPage() }}</td>
                            <td class="px-4 py-3 font-medium text-zinc-900 dark:text-zinc-100">{{ $message->name }}</td>
                            <td class="px-4 py-3 text-zinc-500 dark:text-zinc-400">{{ $message->email }}</td>
                            <td class="px-4 py-3 text-zinc-500 dark:text-zinc-400">{{ Str::limit($message->subject, 40) }}</td>
                            <td class="px-4 py-3 text-zinc-500 dark:text-zinc-400">{{ $message->created_at->format('d M Y H:i') }}</td>
                            <td class="px-4 py-3 text-right">
                                <div class="flex items-center justify-end gap-1">
                                    <flux:button href="{{ route('admin.contact-messages.show', $message) }}" wire:navigate size="sm" icon="eye" variant="ghost">
                                    </flux:button>
                                    <form method="POST" action="{{ route('admin.contact-messages.destroy', $message) }}" onsubmit="return confirm('Yakin ingin menghapus pesan ini?')">
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
                                {{ __('Belum ada pesan masuk.') }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div>{{ $messages->links() }}</div>
    </div>
</x-layouts::app>
