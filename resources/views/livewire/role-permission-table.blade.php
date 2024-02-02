<x-slot name="header">
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <h2 class="text-xl font-semibold leading-tight">
            {{ __('Employee List') }}
        </h2>
        @can('role-add')
            <x-button href="{{ route('role-create') }}" variant="purple" class="justify-center max-w-xs gap-2">
                <span>Add Role</span>
            </x-button>
        @endcan
    </div>
</x-slot>

<div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1 text-sm">

    <div class="flex flex-row justify-between">
        <div class="space-y-2 py-2 w-1/3 float-right">
            <p>Page Number</p>
            <select name="" id="" wire:model.change='length'>
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
        </div>
        <div class="space-y-2 py-2 w-1/3 float-right">
            <p>Search</p>
            <input type="text" class="border-yellow-500 px-1 py-3 rounded-md w-full border-2" placeholder="Search"
                wire:model.live.debounce.300ms='search'>
        </div>
    </div>

    <table class="w-full">
        <thead>
            <tr>
                <th class="text-center border border-yellow-500 px-1 py-3 bg-yellow-500 text-white"
                    wire:click="setSortBy('name')">
                    <div class="flex flex-row gap-2 justify-between px-2">
                        <span>Name</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                        </svg>
                    </div>
                </th>
                <th class="text-center border border-yellow-500 px-1 py-3 bg-yellow-500 text-white"
                    wire:click="setSortBy('name')">
                    <span>Users</span>
                </th>
                <th class="text-center border border-yellow-500 px-1 py-3 bg-yellow-500 text-white w-32">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $item)
                <tr>
                    <td class="text-center border border-yellow-500 px-1 py-3 capitalize w-56">
                        {{ $item->name }}
                    </td>
                    <td class="text-center border border-yellow-500 px-1 py-3 capitalize w-56">
                        {{ implode(', ', $item->users->map(fn($q) => $q->name)->toArray()) }}
                    </td>
                    <td class="text-center border border-yellow-500 p-1 capitalize">
                        <div class="flex flex-row">
                            @can('role-edit')
                                <a href="{{ route('role-edit', ['role' => $item->id]) }}" variant="purple"
                                    class="bg-yellow-500 p-1 w-8 h-8 mx-1 text-white rounded-md flex items-center justify-center">
                                    <x-heroicon-o-pencil aria-hidden="true" class="w-3 h-3" />
                                </a>
                            @endcan

                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Data is empty</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="py-4">{{ $data->links() }}</div>
</div>
