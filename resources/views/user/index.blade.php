<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Employee List') }}
            </h2>
            <x-button href="{{ route('employee-create') }}" variant="purple" class="justify-center max-w-xs gap-2">
                <span>Add User</span>
            </x-button>
        </div>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <table class="w-full">
            <thead>
                <tr>
                    <th class="text-center border border-yellow-500 px-2 py-6 bg-yellow-500 text-white">Name</th>
                    <th class="text-center border border-yellow-500 px-2 py-6 bg-yellow-500 text-white">Role</th>
                    {{-- <th class="text-center border border-yellow-500 px-2 py-6 bg-yellow-500 text-white">Stock</th> --}}
                    <th class="text-center border border-yellow-500 px-2 py-6 bg-yellow-500 text-white">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $item)
                    <tr>
                        <td class="text-center border border-yellow-500 px-2 py-6 capitalize">
                            {{ $item->type . ' ' . $item->name }}
                        </td>
                        <td class="text-center border border-yellow-500 px-2 py-6">
                            {{ implode(', ', $item->roles->map(fn($item) => $item->name)->toArray()) }}</td>
                        {{-- <td class="text-center border border-yellow-500 px-2 py-6">
                            {{ $item->transactions->sum('amount') }}</td> --}}
                        {{-- <td class="text-center border border-yellow-500 px-2 py-6">Action</td> --}}
                        <td class="text-center border border-yellow-500 px-2 py-6 capitalize">
                            <x-button href="{{ route('employee-edit', ['user' => $item->id]) }}" variant="purple" class="justify-center max-w-xs gap-2">
                                <span>EDIT</span>
                            </x-button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Data is empty</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="py-4">{{ $data->links() }}</div>
    </div>
</x-app-layout>
