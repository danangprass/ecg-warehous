<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Add User') }}
            </h2>
        </div>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <form action="{{ route('employee-store') }}" method="post">
            @csrf
            @method('POST')
            <div class="max-w-[50%]">
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                <!-- name -->
                <div class="space-y-2 py-2">
                    <x-form.label for="name" :value="__('Full Name')" />

                    <x-form.input-with-icon-wrapper>
                        <x-slot name="icon">
                            <x-heroicon-o-user aria-hidden="true" class="w-5 h-5" />
                        </x-slot>

                        <x-form.input withicon id="name" class="block w-full" type="text" name="name"
                            :value="old('name')" placeholder="{{ __('name') }}" required autofocus />
                    </x-form.input-with-icon-wrapper>
                </div>
              
                <!-- user name -->
                <div class="space-y-2 py-2">
                    <x-form.label for="email" :value="__('Username')" />

                    <x-form.input-with-icon-wrapper>
                        <x-slot name="icon">
                            <x-heroicon-o-user aria-hidden="true" class="w-5 h-5" />
                        </x-slot>

                        <x-form.input withicon id="email" class="block w-full" type="text" name="email"
                            :value="old('email')" placeholder="{{ __('Username') }}" required autofocus />
                    </x-form.input-with-icon-wrapper>
                </div>
               
                <!-- password -->
                <div class="space-y-2 py-2">
                    <x-form.label for="password" :value="__('Password')" />

                    <x-form.input-with-icon-wrapper>
                        <x-slot name="icon">
                            <x-heroicon-o-lock-closed aria-hidden="true" class="w-5 h-5" />
                        </x-slot>

                        <x-form.input withicon id="password" class="block w-full" type="password" name="password"
                            :value="old('password')" placeholder="{{ __('password') }}" required autofocus />
                    </x-form.input-with-icon-wrapper>
                </div>
              
                <!-- confirm passowd -->
                <div class="space-y-2 py-2">
                    <x-form.label for="role" :value="__('Confirm password')" />

                    <x-form.input-with-icon-wrapper>
                        <x-slot name="icon">
                            <x-heroicon-o-lock-closed aria-hidden="true" class="w-5 h-5" />
                        </x-slot>

                        <x-form.input withicon id="confirm-password" class="block w-full" type="password" name="confirm-password"
                            :value="old('confirm-password')" placeholder="{{ __('Confirm Password') }}" required autofocus />
                    </x-form.input-with-icon-wrapper>
                </div>
                
                <!-- Bank Account -->
                <div class="space-y-2 py-2">
                    <x-form.label for="role" :value="__('Bank Account')" />

                    <x-form.input-with-icon-wrapper>
                        <x-slot name="icon">
                            <x-heroicon-o-currency-dollar aria-hidden="true" class="w-5 h-5" />
                        </x-slot>

                        <x-form.input withicon id="bank_account" class="block w-full" type="text" name="bank_account"
                            :value="old('bank_account')" placeholder="{{ __('Bank Account') }}" required autofocus />
                    </x-form.input-with-icon-wrapper>
                </div>
                
                <!-- confirm role -->
                <div class="space-y-2 py-2">
                    <x-form.label for="role" :value="__('Role')" />

                        <select
                            class="block px-3 py-2 text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm w-full focus:outline-none focus:ring-primary-500 focus:border-primary-500"
                            name="role">
                            <option value="">
                                Select an option
                            </option>
                            @forelse ($roles as $role)
                                <option value="{{ $role->name }}">
                                    {{ $role->name }}
                                </option>
            
                            @empty
                                <option value="" disabled>
                                    No Data
                                </option>
                            @endforelse
                        </select>
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
