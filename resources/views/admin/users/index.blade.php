<x-layouts::app :title="__('Manajemen Admin')">
    <div class="flex flex-col gap-6">
        {{-- Header --}}
        <div class="flex items-center justify-between">
            <div>
                <flux:heading size="xl" level="1">{{ __('Manajemen Admin') }}</flux:heading>
                <flux:subheading>{{ __('Kelola pengguna yang memiliki akses ke dashboard ini.') }}</flux:subheading>
            </div>
            <flux:button :href="route('admin.users.create')" variant="primary" icon="plus" wire:navigate>
                {{ __('Tambah Admin') }}
            </flux:button>
        </div>

        <flux:separator variant="subtle" />

        {{-- Success/Error Messages --}}
        @if(session('success'))
            <flux:callout variant="success" icon="check-circle" dismissible>
                {{ session('success') }}
            </flux:callout>
        @endif

        @if(session('error'))
            <flux:callout variant="danger" icon="exclamation-circle" dismissible>
                {{ session('error') }}
            </flux:callout>
        @endif

        {{-- Table --}}
        <div class="overflow-x-auto rounded-xl border border-neutral-200 dark:border-neutral-700">
            <table class="w-full text-left text-sm">
                <thead class="border-b border-neutral-200 bg-zinc-50 dark:border-neutral-700 dark:bg-zinc-900">
                    <tr>
                        <th class="px-4 py-3 font-medium text-zinc-600 dark:text-zinc-300">#</th>
                        <th class="px-4 py-3 font-medium text-zinc-600 dark:text-zinc-300">{{ __('Nama') }}</th>
                        <th class="px-4 py-3 font-medium text-zinc-600 dark:text-zinc-300">{{ __('Email') }}</th>
                        <th class="px-4 py-3 font-medium text-zinc-600 dark:text-zinc-300">{{ __('Role') }}</th>
                        <th class="px-4 py-3 font-medium text-zinc-600 dark:text-zinc-300">{{ __('Tanggal') }}</th>
                        <th class="px-4 py-3 font-medium text-zinc-600 dark:text-zinc-300 text-right">{{ __('Aksi') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">
                    @forelse($users as $user)
                        <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors">
                            <td class="px-4 py-3 text-zinc-500 dark:text-zinc-400">{{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}</td>
                            <td class="px-4 py-3 font-medium text-zinc-900 dark:text-zinc-100">{{ $user->name }}</td>
                            <td class="px-4 py-3 text-zinc-500 dark:text-zinc-400">{{ $user->email }}</td>
                            <td class="px-4 py-3">
                                <flux:badge :color="$user->role === 'admin' ? 'indigo' : 'zinc'" size="sm">
                                    {{ ucfirst($user->role) }}
                                </flux:badge>
                            </td>
                            <td class="px-4 py-3 text-zinc-500 dark:text-zinc-400">{{ $user->created_at->format('d M Y') }}</td>
                            <td class="px-4 py-3 text-right">
                                <div class="flex items-center justify-end gap-1">
                                    <flux:button :href="route('admin.users.edit', $user)" wire:navigate size="sm" icon="pencil-square" variant="ghost">
                                    </flux:button>
                                    
                                    @if($user->id !== auth()->id())
                                        <flux:modal.trigger :name="'delete-user-' . $user->id">
                                            <flux:button size="sm" icon="trash" variant="ghost" class="!text-red-500 hover:!text-red-700">
                                            </flux:button>
                                        </flux:modal.trigger>
                                    @endif
                                </div>

                                @if($user->id !== auth()->id())
                                    <flux:modal :name="'delete-user-' . $user->id" class="min-w-[22rem]">
                                        <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="space-y-6">
                                            @csrf
                                            @method('DELETE')

                                            <div>
                                                <flux:heading size="lg">{{ __('Hapus Admin?') }}</flux:heading>
                                                <flux:subheading>{{ __('Tindakan ini tidak dapat dibatalkan. Menghapus :name.', ['name' => $user->name]) }}</flux:subheading>
                                            </div>

                                            <div class="flex gap-2 justify-end">
                                                <flux:modal.close>
                                                    <flux:button variant="ghost">{{ __('Batal') }}</flux:button>
                                                </flux:modal.close>
                                                <flux:button type="submit" variant="danger">{{ __('Hapus Admin') }}</flux:button>
                                            </div>
                                        </form>
                                    </flux:modal>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-8 text-center text-zinc-500 dark:text-zinc-400">
                                {{ __('Belum ada pengguna.') }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div>
            {{ $users->links() }}
        </div>
    </div>
</x-layouts::app>
