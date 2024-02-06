<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Form Edit Stock Warehouse') }}
            </h2>
        </div>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">

        <form action="{{ route('update-warehouse-storage') }}" method="post">
            @method('PUT')
            @csrf
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <div class="py-4">
                <div
                    class="grid grid-cols-5 gap-4 text-sm font-semibold leading-6 bg-stripes-fuchsia rounded-lg py-4">
                    @foreach ($products->where('type', '==', 'engine') as $item)
                        <div class="">
                            <div class="grid grid-cols-2 gap-4">
                                <div class="py-2 capitalize">{{ $item->name}}
                                    <input type="hidden" name="product[{{ $item->id }}][id]" value="{{ $item->id }}">
                                </div>
                                <div class="">
                                    <x-form.input id="amount" class="block w-full" type="number"
                                        name="product[{{ $item->id }}][amount]" :value="$item->amount ?? old('amount')" placeholder="0"
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
                                <div class="py-2 capitalize">{{ $item->name}}
                                    <input type="hidden" name="product[{{ $item->id }}][id]" value="{{ $item->id }}">
                                </div>
                                <div class="">
                                    <x-form.input id="amount" class="block w-full" type="number"
                                        name="product[{{ $item->id }}][amount]" :value="$item->amount ?? old('amount')" placeholder="0"
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
                                <div class="py-2 capitalize">{{ $item->name}}
                                    <input type="hidden" name="product[{{ $item->id }}][id]" value="{{ $item->id }}">
                                </div>
                                <div class="">
                                    <x-form.input id="amount" class="block w-full" type="number"
                                        name="product[{{ $item->id }}][amount]" :value="$item->amount ?? old('amount')" placeholder="0"
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
