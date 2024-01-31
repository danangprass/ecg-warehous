<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Transaction') }}
            </h2>

        </div>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <table class="w-full">
            <thead>
                <tr>
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
                </tr>
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
                            {{ $item->type == 'modif' ? 'Form Modif' : 'Form Repair' }}
                        </td>

                        <td class="text-center border border-yellow-500 px-2 py-6">

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

            {{-- <div class="py-4">{{ $data->links() }}</div> --}}
        </div>
    </x-app-layout>
