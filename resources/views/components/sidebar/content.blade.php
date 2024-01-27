<x-perfect-scrollbar as="nav" aria-label="main" class="flex flex-col flex-1 gap-4 px-3">

    @can('form-repair')
        <x-sidebar.link title="Form Repair" {{-- href="#" --}} href="{{ route('form-repair') }}" :isActive="request()->routeIs('form-repair')">
            <x-slot name="icon">
                {{-- <x-icons.dashboard class="flex-shrink-0 w-6 h-6" aria-hidden="true" /> --}}
                <x-heroicon-o-cog aria-hidden="true" class="w-5 h-5" />
            </x-slot>
        </x-sidebar.link>
    @endcan
    @can('form-modif')
        <x-sidebar.link title="Form Modif" {{-- href="#" --}} href="{{ route('form-modif') }}" :isActive="request()->routeIs('form-modif')">
            <x-slot name="icon">
                {{-- <x-icons.dashboard class="flex-shrink-0 w-6 h-6" aria-hidden="true" /> --}}
                <x-heroicon-o-link aria-hidden="true" class="w-5 h-5" />
            </x-slot>
        </x-sidebar.link>
    @endcan
    @can('stock-storage')
        <x-sidebar.link title="Stock Storage" {{-- href="#" --}} href="{{ route('stock-storage') }}" :isActive="request()->routeIs('stock-storage')||request()->routeIs('form-add-stock')">
            <x-slot name="icon">
                {{-- <x-icons.dashboard class="flex-shrink-0 w-6 h-6" aria-hidden="true" /> --}}
                <x-heroicon-o-cube aria-hidden="true" class="w-5 h-5" />

            </x-slot>
        </x-sidebar.link>
    @endcan
    @can('warehouse-storage')
        <x-sidebar.link title="Warehouse Storage" {{-- href="#" --}} href="{{ route('warehouse-storage') }}"
            :isActive="request()->routeIs('warehouse-storage') || request()->routeIs('form-add-stock-warehouse')">
            <x-slot name="icon">
                {{-- <x-icons.dashboard class="flex-shrink-0 w-6 h-6" aria-hidden="true" /> --}}
                <x-heroicon-o-archive aria-hidden="true" class="w-5 h-5" />
            </x-slot>
        </x-sidebar.link>
    @endcan

    @can('transaction')
        <x-sidebar.link title="Transaction" {{-- href="#" --}} href="{{ route('transaction') }}" :isActive="request()->routeIs('transaction')">
            <x-slot name="icon">
                <x-heroicon-o-document-text aria-hidden="true" class="w-5 h-5" />
                {{-- <x-heroicon-o-banknotes aria-hidden="true" class="w-5 h-5" /> --}}
            </x-slot>
        </x-sidebar.link>
    @endcan
    @can('information')
        <x-sidebar.link title="Information" {{-- href="#" --}} href="{{ route('information') }}" :isActive="request()->routeIs('information')">
            <x-slot name="icon">
                <x-heroicon-o-user aria-hidden="true" class="w-5 h-5" />
                
            </x-slot>
        </x-sidebar.link>
    @endcan
    @can('employee-list')
        <x-sidebar.link title="Employee List" {{-- href="#" --}} href="{{ route('employee-list') }}" :isActive="request()->routeIs('employee-list') || request()->routeIs('employee-edit') || request()->routeIs('employee-create')">
            <x-slot name="icon">
                {{-- <x-icons.dashboard class="flex-shrink-0 w-6 h-6" aria-hidden="true" /> --}}
                <x-heroicon-o-user-group aria-hidden="true" class="w-5 h-5" />

            </x-slot>
        </x-sidebar.link>
    @endcan

    {{-- <x-sidebar.dropdown
        title="Buttons"
        :active="Str::startsWith(request()->route()->uri(), 'buttons')"
    >
        <x-slot name="icon">
            <x-heroicon-o-view-grid class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>

        <x-sidebar.sublink
            title="Text button"
            href="{{ route('buttons.text') }}"
            :active="request()->routeIs('buttons.text')"
        />
        <x-sidebar.sublink
            title="Icon button"
            href="{{ route('buttons.icon') }}"
            :active="request()->routeIs('buttons.icon')"
        />
        <x-sidebar.sublink
            title="Text with icon"
            href="{{ route('buttons.text-icon') }}"
            :active="request()->routeIs('buttons.text-icon')"
        />
    </x-sidebar.dropdown> --}}
    {{-- 
    <div
        x-transition
        x-show="isSidebarOpen || isSidebarHovered"
        class="text-sm text-gray-500"
    >
        Dummy Links
    </div>

    @php
        $links = array_fill(0, 20, '');
    @endphp

    @foreach ($links as $index => $link)
        <x-sidebar.link title="Dummy link {{ $index + 1 }}" href="#" />
    @endforeach --}}

</x-perfect-scrollbar>
