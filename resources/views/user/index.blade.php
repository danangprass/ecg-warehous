<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Employee List') }}
            </h2>
            @can('employee-add')
                <x-button href="{{ route('employee-create') }}" variant="purple" class="justify-center max-w-xs gap-2">
                    <span>Add User</span>
                </x-button>
            @endcan
        </div>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1 text-sm">
        <table class="w-full">
            <thead>
                <tr>
                    <th class="text-center border border-yellow-500 px-1 py-3 bg-yellow-500 text-white">Name</th>
                    <th class="text-center border border-yellow-500 px-1 py-3 bg-yellow-500 text-white">Role</th>
                    <th class="text-center border border-yellow-500 px-1 py-3 bg-yellow-500 text-white">Username</th>
                    <th class="text-center border border-yellow-500 px-1 py-3 bg-yellow-500 text-white">Bank Account
                    </th>
                    <th class="text-center border border-yellow-500 px-1 py-3 bg-yellow-500 text-white">Reimburse</th>
                    <th class="text-center border border-yellow-500 px-1 py-3 bg-yellow-500 text-white">Salary</th>
                    <th class="text-center border border-yellow-500 px-1 py-3 bg-yellow-500 text-white">Last Login</th>
                    {{-- <th class="text-center border border-yellow-500 px-1 py-3 bg-yellow-500 text-white">Stock</th> --}}
                    <th class="text-center border border-yellow-500 px-1 py-3 bg-yellow-500 text-white">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $item)
                    <tr>
                        <td class="text-center border border-yellow-500 px-1 py-3 capitalize">
                            {{ $item->type . ' ' . $item->name }}
                        </td>
                        <td class="text-center border border-yellow-500 px-1 py-3">
                            {{ implode(', ', $item->roles->map(fn($item) => $item->name)->toArray()) }}
                        </td>
                        <td class="text-center border border-yellow-500 px-1 py-3">
                            {{ $item->email }}
                        </td>
                        <td class="text-center border border-yellow-500 px-1 py-3">
                            {{ $item->bank_account }}
                        </td>
                        <td class="text-center border border-yellow-500 px-1 py-3">
                            <p>{{ $item->transactions->sum('reimburse') }}</p>
                            <x-button
                                href="{{ route('employee-list-reimburse', ['user' => $item->id, 'amount' => $item->transactions->sum('reimburse')]) }}"
                                variant="purple" class="justify-center max-w-xs gap-2 my-2">
                                <span>Reimburse</span>
                            </x-button>
                        </td>
                        <td class="text-center border border-yellow-500 px-1 py-3">
                            <p>{{ $item->transactions->sum('fee') }}</p>
                            <x-button
                                href="{{ route('employee-list-bonus', ['user' => $item->id, 'amount' => $item->transactions->sum('fee')]) }}"
                                variant="purple" class="justify-center max-w-xs gap-2 my-2">
                                <span>Bonus</span>
                            </x-button>
                        </td>
                        <td class="text-center border border-yellow-500 px-1 py-3">
                            {{ $item->last_login }}
                        </td>
                        <td class="text-center border border-yellow-500 px-1 py-3 capitalize">
                            <div class="grid grid-cols-1">
                                @can('employee-edit')
                                    <x-button href="{{ route('employee-edit', ['user' => $item->id]) }}" variant="purple"
                                        class="justify-center max-w-xs gap-2 my-2">
                                        <span>Edit</span>
                                    </x-button>
                                @endcan
                                <x-button href="{{ route('employee-stock', ['user' => $item->id]) }}" variant="purple"
                                    class="justify-center max-w-xs gap-2 my-2">
                                    <span>View Stock</span>
                                </x-button>
                                <x-button href="{{ route('employee-transaction', ['user' => $item->id]) }}"
                                    variant="purple" class="justify-center max-w-xs gap-2 my-2">
                                    <span>Transaction</span>
                                </x-button>
                            </div>
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
