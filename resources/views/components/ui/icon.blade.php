@props([
    'name' => 'arrow-right',
])

<svg {{ $attributes->merge(['class' => 'size-5']) }} xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
    @switch($name)
        @case('search')
            <path d="m21 21-4.34-4.34"></path>
            <circle cx="11" cy="11" r="8"></circle>
            @break

        @case('arrow-right')
        @default
            <path d="M5 12h14"></path>
            <path d="m12 5 7 7-7 7"></path>
    @endswitch
</svg>
