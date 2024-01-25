<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Warehouse Storage') }}
            </h2>

        </div>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <table class="w-full">
            <thead>
                <tr>
                    <th class="text-center border border-yellow-500 px-2 py-6 bg-yellow-500 text-white">Employee Name
                    </th>
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
                        <td class="text-center border border-yellow-500 px-2 py-6 font-semibold">
                            {{ $item->owner->name }}</td>
                        <td class="text-center border border-yellow-500 px-2 py-6">{{ $item->date }}</td>
                        <td class="text-center border border-yellow-500 px-2 py-6">
                            {{ $item->type == 'modif' ? 'Form Modif' : 'Form Repair' }}
                        </td>

                        <td class="text-center border border-yellow-500 px-2 py-6">
                            {{-- @dd($item->details->sum('amount')) --}}
                            {{ $item->type == 'modif' ? 'Got Modif ' . $item->link->amount : 'Got Repair ' . $item->details->sum('amount') }}
                        </td>
                        <td class="text-center border border-yellow-500 px-2 py-6"><a
                                class="hover:text-blue-500 hover:underline" href="{{ $item->type == 'modif' ? $item->link->link : $item->details[0]->link}}">Click
                                Here</a>
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
</x-app-layout>
