{{-- <div x-data="mainState" :class="{ dark: isDarkMode }" x-on:resize.window="handleWindowResize" x-cloak> --}}
{{-- <x-app-layout> --}}
{{-- @livewireScripts --}}

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
                <th class="text-center border border-yellow-500 px-1 py-3 bg-yellow-500 text-white">Role</th>
                <th class="text-center border border-yellow-500 px-1 py-3 bg-yellow-500 text-white"
                    wire:click="setSortBy('email')">
                    <div class="flex flex-row gap-2 justify-between px-2">
                        <span>Username</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                        </svg>
                    </div>
                </th>
                <th class="text-center border border-yellow-500 px-1 py-3 bg-yellow-500 text-white"
                    wire:click="setSortBy('bank_account')">
                    <div class="flex flex-row gap-2 justify-between px-2">
                        <span>Bank Account</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                        </svg>
                    </div>
                </th>
                <th class="text-center border border-yellow-500 px-1 py-3 bg-yellow-500 text-white">Reimburse</th>
                <th class="text-center border border-yellow-500 px-1 py-3 bg-yellow-500 text-white">Salary</th>
                <th class="text-center border border-yellow-500 px-1 py-3 bg-yellow-500 text-white"
                    wire:click="setSortBy('last_login')">
                    <div class="flex flex-row gap-2 justify-between px-2">
                        <span>Last Login</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                        </svg>
                    </div>
                </th>
                {{-- <th class="text-center border border-yellow-500 px-1 py-3 bg-yellow-500 text-white">Stock</th> --}}
                <th class="text-center border border-yellow-500 px-1 py-3 bg-yellow-500 text-white w-32">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $item)
                <tr>
                    <td class="text-center border border-yellow-500 px-1 py-3 capitalize w-56">
                        {{ $item->name }}
                    </td>
                    <td class="text-center border border-yellow-500 px-1 py-3 w-24">
                        {{ implode(', ', $item->roles->map(fn($item) => $item->name)->toArray()) }}
                    </td>
                    <td class="text-center border border-yellow-500 px-1 py-3 w-32">
                        {{ $item->email }}
                    </td>
                    <td class="text-center border border-yellow-500 px-1 py-3 w-32">
                        {{ $item->bank_account }}
                    </td>
                    <td class="text-center border border-yellow-500 px-1 py-3">
                        <p>{{ $item->transactions->sum('reimburse') }}</p>
                        @if ($item->transactions->sum('reimburse') > 0)
                            <x-button
                                href="{{ route('employee-list-reimburse', ['user' => $item->id, 'amount' => $item->transactions->sum('reimburse')]) }}"
                                variant="purple" class="justify-center max-w-xs gap-2 my-2 text-sm">
                                <span>Reimburse</span>
                            </x-button>
                        @endif
                    </td>
                    <td class="text-center border border-yellow-500 px-1 py-3">
                        <p>{{ $item->transactions->sum('fee') }}</p>
                        @if ($item->transactions->sum('fee') > 0)
                            <x-button
                                href="{{ route('employee-list-bonus', ['user' => $item->id, 'amount' => $item->transactions->sum('fee')]) }}"
                                variant="purple" class="justify-center max-w-xs gap-2 my-2 text-sm">
                                <span>Bonus</span>
                            </x-button>
                        @endif
                    </td>
                    <td class="text-center border border-yellow-500 px-1 py-3 w-24">
                        {{ $item->last_login }}
                    </td>
                    <td class="text-center border border-yellow-500 p-1 capitalize">
                        <div class="flex flex-row">
                            @can('employee-edit')
                                <a href="{{ route('employee-edit', ['user' => $item->id]) }}" variant="purple"
                                    class="bg-yellow-500 p-1 w-8 h-8 mx-1 text-white rounded-md flex items-center justify-center">
                                    <x-heroicon-o-pencil aria-hidden="true" class="w-3 h-3" />
                                </a>
                            @endcan
                            <a href="{{ route('employee-stock', ['user' => $item->id]) }}" variant="purple"
                                class="bg-yellow-500 p-1 w-8 h-8 mx-1 text-white rounded-md flex items-center justify-center">
                                <x-heroicon-o-cube aria-hidden="true" class="w-3 h-3" />
                            </a>
                            <a href="{{ route('employee-transaction', ['user' => $item->id]) }}"
                                class="bg-yellow-500 p-1 w-8 h-8 mx-1 text-white rounded-md flex items-center justify-center">
                                <x-heroicon-o-document-text aria-hidden="true" class="w-3 h-3" />
                            </a>
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

    {{-- <table id="catTable" x-data="userData">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Role</th>

                </tr>
            </thead>
            <tbody>
                <template x-if="!users">
                    <tr>
                        <td colspan="4"><i>Loading...</i></td>
                    </tr>
                </template>
                <template x-for="user in users">
                    <tr>
                        <td x-text="user.name"></td>
                        <td>
                            <template x-for="role in user.roles ">
                                <span x-text="role.name"></span>
                            </template>
                        </td>

                    </tr>
                </template>
            </tbody>
        </table> --}}
</div>
{{-- </div> --}}

{{-- <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('userData', () => ({
                users: null,
                async init() {
                    let resp = await fetch(
                        "{{ route('api.users.index') }}");
                    let response = await resp.json();
                    this.users = response.data
                },
            }))
        });
    </script> --}}
{{-- </x-app-layout> --}}
