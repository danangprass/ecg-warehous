<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Form Modif') }}
            </h2>
        </div>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        {{ __('Form Modif Page') }}
        <form action="{{ route('save-modif') }}" method="post">
            @csrf
            @method('POST')
            <div class="max-w-[50%]">

                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <!-- link -->
                <div class="space-y-2 py-2">
                    <x-form.label for="link" :value="__('Link')" />

                    <x-form.input-with-icon-wrapper>
                        <x-slot name="icon">
                            <x-heroicon-o-link aria-hidden="true" class="w-5 h-5" />
                        </x-slot>

                        <x-form.input withicon id="link" class="block w-full" type="text" name="link"
                            :value="old('link')" placeholder="{{ __('link') }}" required autofocus />
                    </x-form.input-with-icon-wrapper>
                </div>

                <!-- amount  -->
                <div class="space-y-2 py-2">
                    <x-form.label for="amount" :value="__('Amount')" />

                    <x-form.input-with-icon-wrapper>
                        <x-slot name="icon">
                            <x-heroicon-o-cog aria-hidden="true" class="w-5 h-5" />
                        </x-slot>

                        <x-form.input withicon id="amount" class="block w-full" type="text" name="amount"
                            :value="old('amount')" placeholder="{{ __('amount') }}" required autofocus />
                    </x-form.input-with-icon-wrapper>
                </div>

                <div class="py-2">
                    <x-button class="justify-center w-full gap-2" type="submit">
                        <x-heroicon-o-inbox class="w-6 h-6" aria-hidden="true" />

                        <span>{{ __('Submit') }}</span>
                    </x-button>
                </div>

            </div>
        </form>

    </div>
</x-app-layout>
