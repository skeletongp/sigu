@props(['disabled' => false, 'class' => ''])


<div class="bg-white dark:bg-gray-800 rounded-md">
    <div class=" py-0 flex justify-between items-center rounde-md rounded-md border relative {{ $class }}">
        <select {{ $disabled ? 'disabled' : '' }} style="padding-top: 0.68rem; padding-bottom:0.68rem; -webkit-appearance: none;"
            class=" flex-grow  text-gray-900 dark:text-gray-300   px-2 leading-tight  border-white dark:bg-gray-800 dark:border-gray-800  " {{ $attributes->merge([$attributes]) }}>
            {{ $slot }}
        </select>
        <span class="absolute right-2">
            @if (isset($icon))
                {{ $icon }}
            @endif
        </span>
    </div>
</div>
