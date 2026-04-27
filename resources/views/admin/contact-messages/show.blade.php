<x-layouts::app :title="__('Detail Pesan')">
    <div class="flex h-full w-full flex-1 flex-col gap-6 max-w-3xl">
        <div class="flex items-center justify-between">
            <div>
                <flux:heading size="xl">{{ __('Detail Pesan') }}</flux:heading>
                <flux:text class="mt-1">{{ __('Dari: ') . $contactMessage->name }}</flux:text>
            </div>
            <flux:button href="{{ route('admin.contact-messages.index') }}" wire:navigate icon="arrow-left" variant="ghost">
                {{ __('Kembali') }}
            </flux:button>
        </div>

        <div class="rounded-xl border border-neutral-200 dark:border-neutral-700 divide-y divide-neutral-200 dark:divide-neutral-700">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 p-5">
                <div>
                    <flux:text class="text-xs font-medium uppercase tracking-wider text-zinc-400">{{ __('Nama') }}</flux:text>
                    <p class="mt-1 text-sm font-medium text-zinc-900 dark:text-zinc-100">{{ $contactMessage->name }}</p>
                </div>
                <div>
                    <flux:text class="text-xs font-medium uppercase tracking-wider text-zinc-400">{{ __('Email') }}</flux:text>
                    <p class="mt-1 text-sm text-zinc-900 dark:text-zinc-100">
                        <a href="mailto:{{ $contactMessage->email }}" class="hover:underline text-blue-600 dark:text-blue-400">{{ $contactMessage->email }}</a>
                    </p>
                </div>
                <div>
                    <flux:text class="text-xs font-medium uppercase tracking-wider text-zinc-400">{{ __('Tanggal') }}</flux:text>
                    <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">{{ $contactMessage->created_at->format('d M Y, H:i') }}</p>
                </div>
            </div>

            <div class="p-5">
                <flux:text class="text-xs font-medium uppercase tracking-wider text-zinc-400">{{ __('Subjek') }}</flux:text>
                <p class="mt-1 text-sm font-semibold text-zinc-900 dark:text-zinc-100">{{ $contactMessage->subject }}</p>
            </div>

            <div class="p-5">
                <flux:text class="text-xs font-medium uppercase tracking-wider text-zinc-400">{{ __('Pesan') }}</flux:text>
                <div class="mt-2 text-sm text-zinc-700 dark:text-zinc-300 leading-relaxed whitespace-pre-wrap">{{ $contactMessage->message }}</div>
            </div>
        </div>

        <div>
            <form method="POST" action="{{ route('admin.contact-messages.destroy', $contactMessage) }}" onsubmit="return confirm('Yakin ingin menghapus pesan ini?')">
                @csrf
                @method('DELETE')
                <flux:button type="submit" icon="trash" variant="danger">{{ __('Hapus Pesan') }}</flux:button>
            </form>
        </div>
    </div>
</x-layouts::app>
