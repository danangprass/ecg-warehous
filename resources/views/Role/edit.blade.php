<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Edit Role') }}
            </h2>
        </div>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <form action="{{ route('role-update', ['role' => $role->id]) }}" method="post">
            @csrf
            @method('PATCH')
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
                            :value="$role->name ?? old('name')" placeholder="{{ __('name') }}" required autofocus />
                    </x-form.input-with-icon-wrapper>
                </div>


                <!-- Remember Me -->
                <div class="space-y-2 py-2">
                    <x-form.label for="name" :value="__('Permissions')" />
                    <ul class="ml-2 space-y-2">
                        @forelse ($permissions as $permission)
                            <li>
                                <label for="{{ $permission->name }}" class="inline-flex items-center">
                                    <input id="{{ $permission->name }}" type="checkbox"
                                        class="text-yellow-500 border-gray-300 rounded focus:border-yellow-300 focus:ring focus:ring-yellow-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1"
                                        name="permissions[{{ $permission->name }}]"
                                        @if ($role->hasPermissionTo($permission->name)) checked @endif>

                                    <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">
                                        {{ $permission->name }}
                                    </span>
                                </label>
                            </li>
                        @empty
                        @endforelse
                    </ul>
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
