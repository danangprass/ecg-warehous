@props(['errors'])

@if ($errors->any())
    <div class="bg-red-50 dark:bg-red-900 p-4 rounded-lg" x-data="{ show: true }" x-init="setTimeout(() => show = false, 2000)" x-show="show"
        x-transition:enter="transition duration-1000 ease-out"
        x-transition:enter-start="translate-y-4 opacity-0 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="translate-y-0 opacity-100 sm:scale-100"
        x-transition:leave="transition duration-150 ease-in"
        x-transition:leave-start="translate-y-0 opacity-100 sm:scale-100"
        x-transition:leave-end="translate-y-4 opacity-0 sm:translate-y-0 sm:scale-95">

        <div {{ $attributes }}>
            <div class="font-medium text-red-600 dark:text-red-50">
                {{ __('Whoops! Something went wrong.') }}
            </div>

            <ul class="mt-3 list-disc list-inside text-sm text-red-600 dark:text-red-50">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
