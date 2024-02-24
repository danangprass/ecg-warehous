<x-slot name="header">
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <h2 class="text-xl font-semibold leading-tight">
            {{ __('Transaction List') }}
        </h2>
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
            @can('employee-list')
                <th class="text-center border border-yellow-500 px-2 py-6 bg-yellow-500 text-white">Employee Name
                </th>
            @endcan
            <th class="text-center border border-yellow-500 px-2 py-6 bg-yellow-500 text-white">Transaction Date
            </th>
            <th class="text-center border border-yellow-500 px-2 py-6 bg-yellow-500 text-white">Transaction Type
            </th>
            <th class="text-center border border-yellow-500 px-2 py-6 bg-yellow-500 text-white">Description
            </th>
            <th class="text-center border border-yellow-500 px-2 py-6 bg-yellow-500 text-white">Proof</th>
        </thead>
        <tbody>
            @forelse ($data as $item)
                <tr>
                    @can('employee-list')
                        <td class="text-center border border-yellow-500 px-2 py-6 font-semibold">
                            {{ $item->owner->name }}</td>
                    @endcan
                    <td class="text-center border border-yellow-500 px-2 py-6">{{ $item->created_at }}</td>
                    <td class="text-center border border-yellow-500 px-2 py-6">
                        @switch($item->type)
                            @case('modif')
                                Form Modif
                            @break

                            @case('reimburse')
                                Form Reimburse
                            @break

                            @case('bonus')
                                Form Bonus
                            @break

                            @case('repair')
                                Form Repair

                                @default
                            @endswitch
                        </td>

                        <td class="border border-yellow-500 px-2 py-6">
                            @switch($item->type)
                                @case('modif')
                                    {{ 'Got Modif - ' . $item->link->amount }}
                                @break

                                @case('reimburse')
                                    {{ 'Got Reimburse + ' . $item->reimburse }}
                                @break

                                @case('bonus')
                                    {{ 'Got Bonus + ' . $item->bonus * -1 }}
                                @break

                                @case('repair')
                                    <ul>
                                        @foreach ($item->details as $detail)
                                            @if ($detail->amount > 0)
                                                <li>{{ $detail->product->name . ' x ' . $detail->amount }}</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                @break

                                @default
                            @endswitch
                        </td>
                        <td class="text-center border border-yellow-500 px-2 py-6">
                            @switch($item->type)
                                @case('modif')
                                    <a class="hover:text-blue-500 hover:underline" href="{{ $item->link->link }}">
                                        Click Here
                                    </a>
                                @break

                                @case('repair')
                                    <a class="hover:text-blue-500 hover:underline" target="_blank"
                                        href="{{ $item->details[0]->link }}">
                                        Click Here
                                    </a>
                                @break

                                @default
                                    <a class="hover:text-blue-500 hover:underline" href="#">
                                        -
                                    </a>
                            @endswitch
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center border border-yellow-500 px-2 py-6">Data is empty</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="py-4">{{ $data->links() }}</div>
        </div>
