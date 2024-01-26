<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Information') }}
            </h2>

        </div>
    </x-slot>

    @php
        list($firstName, $lastName) = explode(' ', $user->name, 2);
    @endphp
    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        {{-- <div class="flex items-center lg:w-3/5 mx-auto sm:flex-row flex-col"> --}}
        <div class="items-center object-center justify-center align-middle">
            <div class="flex items-center justify-center">
                <div class="p-6 overflow-hidden bg-white rounded-md  dark:bg-dark-eval-1">
                    <div class="items-center object-center justify-center align-middle">
                        <div
                            class="sm:w-32 sm:h-32 h-20 w-20 sm:mr-10 inline-flex items-center justify-center rounded-full bg-yellow-100 text-yellow-500 flex-shrink-0 mb-8">
                            <span class="text-5xl">{{ strtoupper(substr($firstName, 0, 1)) }}{{ strtoupper(substr($lastName, 0, 1)) }}</span>
                        </div>
                        <div class="flex-grow sm:text-left text-center mt-6 sm:mt-0">
                            <h2 class="text-gray-900 text-lg title-font mb-2 font-bold uppercase dark:text-white">{{ $user->name }}
                            </h2>
                            <p class="leading-relaxed text-base">
                                Bonus/Gaji: {{ $user->transactions->sum('fee') }}
                            </p>
                            <p class="leading-relaxed text-base">
                                Reimburse: {{ $user->transactions->sum('reimburse') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</x-app-layout>
