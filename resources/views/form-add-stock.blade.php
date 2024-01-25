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
                    {{-- <x-form.label for="link" :value="__('Link')" /> --}}

                    {{-- <x-form.input-with-icon-wrapper>
                    <x-slot name="icon">
                        <x-heroicon-o-link aria-hidden="true" class="w-5 h-5" />
                    </x-slot>

                    <x-form.input withicon id="link" class="block w-full" type="text" name="link"
                        :value="old('link')" placeholder="{{ __('link') }}" required autofocus />
                </x-form.input-with-icon-wrapper> --}}

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
                        @foreach ($products->where('type', '!=', 'extra') as $item)
                            <div class="">
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="py-2 capitalize">{{ $item->type . ' Part ' . $item->name }}
                                        <input type="hidden" name="product[{{ $item->id }}][id]"
                                            value="{{ $item->id }}">
                                    </div>
                                    <div class="">
                                        <x-form.input withicon id="amount" class="block w-full" type="text"
                                            name="product[{{ $item->id }}][amount]" :value="old('amount')"
                                            placeholder="{{ __('amount') }}" autofocus />
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
                                    <div class="py-2 capitalize">{{ $item->type . ' Part ' . $item->name }}
                                        <input type="hidden" name="product[{{ $item->id }}][id]"
                                            value="{{ $item->id }}">
                                    </div>
                                    <div class="">
                                        <x-form.input withicon id="amount" class="block w-full" type="text"
                                            name="product[{{ $item->id }}][amount]" :value="old('amount')"
                                            placeholder="{{ __('amount') }}" autofocus />
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
