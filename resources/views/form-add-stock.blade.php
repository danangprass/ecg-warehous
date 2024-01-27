<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Form Add Stock') }}
            </h2>
        </div>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">

        <div class="py-4">
            <form action="{{ route('save-stock-storage') }}" method="post">
                @method('POST')
                @csrf
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                <div class="space-y-2 py-2 w-[50%]">
                    <Label> Select Employee</Label>
                    <select
                        class="block px-3 py-2 text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm w-96 focus:outline-none focus:ring-primary-500 focus:border-primary-500"
                        name="user_id">
                        <option value="">
                            Select an option
                        </option>
                        @forelse ($employees as $employee)
                            <option value="{{ $employee->id }}">
                                {{ $employee->name }}
                            </option>

                        @empty
                            <option value="" disabled>
                                No Data
                            </option>
                        @endforelse
                    </select>
                </div>

                <div class="py-4">
                    <div
                        class="grid grid-cols-5 gap-4 text-sm font-semibold leading-6 bg-stripes-fuchsia rounded-lg py-4">
                        @foreach ($products->where('type', '==', 'engine') as $item)
                        {{-- @dd($item->amount) --}}
                            <div class="">
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="py-2 capitalize">{{ $item->name}} {{ $item->amount ?? 0 }}
                                        <input type="hidden" name="product[{{ $item->id }}][id]" value="{{ $item->id }}">
                                        <input type="hidden" name="product[{{ $item->id }}][available_amount]"
                                            value="{{ $item->amount ?? 0 }}">
                                    </div>
                                    <div class="">
                                        <x-form.input id="amount" class="block w-full" type="number"
                                            name="product[{{ $item->id }}][amount]" :value="old('amount')" placeholder="0"
                                            autofocus />
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    <div
                        class="grid grid-cols-5 gap-4 text-sm font-semibold leading-6 bg-stripes-fuchsia rounded-lg py-4">
                        @foreach ($products->where('type', '==', 'body') as $item)
                            <div class="">
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="py-2 capitalize">{{ $item->name}} {{ $item->amount ?? 0 }}
                                        <input type="hidden" name="product[{{ $item->id }}][id]" value="{{ $item->id }}">
                                        <input type="hidden" name="product[{{ $item->id }}][available_amount]"
                                            value="{{ $item->amount ?? 0 }}">
                                    </div>
                                    <div class="">
                                        <x-form.input id="amount" class="block w-full" type="number"
                                            name="product[{{ $item->id }}][amount]" :value="old('amount')" placeholder="0"
                                            autofocus />
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    <hr>
                    <div
                        class="grid grid-cols-5 gap-4 text-sm font-semibold leading-6 bg-stripes-fuchsia rounded-lg py-4">
                        @foreach ($products->where('type', 'extra') as $item)
                            <div class="">
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="py-2 capitalize">{{ $item->name}} {{ $item->amount ?? 0 }}
                                        <input type="hidden" name="product[{{ $item->id }}][id]" value="{{ $item->id }}">
                                        <input type="hidden" name="product[{{ $item->id }}][available_amount]"
                                            value="{{ $item->amount ?? 0 }}">
                                    </div>
                                    <div class="">
                                        <x-form.input id="amount" class="block w-full" type="number"
                                            name="product[{{ $item->id }}][amount]" :value="old('amount')" placeholder="0"
                                            autofocus />
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
                <div class="flex items-center justify-center py-2 w-full">
                    <x-button class="gap-2 w-64">
                        <x-heroicon-o-inbox class="w-6 h-6" aria-hidden="true" />
                        <span>{{ __('Submit') }}</span>
                    </x-button>
                </div>
            </form>
        </div>

    </div>
</x-app-layout>
