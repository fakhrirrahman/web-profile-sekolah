@props([
    'name' => 'arrow-right',
])

<svg {{ $attributes->merge(['class' => 'size-5']) }} xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
    @switch($name)
        @case('search')
            <path d="m21 21-4.34-4.34"></path>
            <circle cx="11" cy="11" r="8"></circle>
            @break

        @case('home')
            <path d="m3 11 9-8 9 8"></path>
            <path d="M5 10v10h14V10"></path>
            <path d="M9 20v-6h6v6"></path>
            @break

        @case('layout-dashboard')
            <rect width="7" height="9" x="3" y="3" rx="1"></rect>
            <rect width="7" height="5" x="14" y="3" rx="1"></rect>
            <rect width="7" height="9" x="14" y="12" rx="1"></rect>
            <rect width="7" height="5" x="3" y="16" rx="1"></rect>
            @break

        @case('newspaper')
            <path d="M4 22h16a2 2 0 0 0 2-2V4H2v16a2 2 0 0 0 2 2Z"></path>
            <path d="M7 8h10"></path>
            <path d="M7 12h10"></path>
            <path d="M7 16h6"></path>
            @break

        @case('image')
            <rect width="18" height="18" x="3" y="3" rx="2"></rect>
            <circle cx="9" cy="9" r="2"></circle>
            <path d="m21 15-3.1-3.1a2 2 0 0 0-2.8 0L6 21"></path>
            @break

        @case('calendar')
            <path d="M8 2v4"></path>
            <path d="M16 2v4"></path>
            <rect width="18" height="18" x="3" y="4" rx="2"></rect>
            <path d="M3 10h18"></path>
            @break

        @case('users')
            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
            <circle cx="9" cy="7" r="4"></circle>
            <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
            @break

        @case('settings')
            <path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.38a2 2 0 0 0-.73-2.73l-.15-.09a2 2 0 0 1-1-1.74v-.51a2 2 0 0 1 1-1.72l.15-.1a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2Z"></path>
            <circle cx="12" cy="12" r="3"></circle>
            @break

        @case('log-out')
            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
            <path d="m16 17 5-5-5-5"></path>
            <path d="M21 12H9"></path>
            @break

        @case('more-vertical')
            <circle cx="12" cy="12" r="1"></circle>
            <circle cx="12" cy="5" r="1"></circle>
            <circle cx="12" cy="19" r="1"></circle>
            @break

        @case('arrow-right')
        @default
            <path d="M5 12h14"></path>
            <path d="m12 5 7 7-7 7"></path>
    @endswitch
</svg>
