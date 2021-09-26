@props(['disabled' => false, 'class' => ''])


<div class="bg-white rounded-md">
    <div class=" py-0 flex justify-between items-center rounde-md rounded-md border relative {{ $class }}">
        <select {{ $disabled ? 'disabled' : '' }} style="padding-top: 0.68rem; padding-bottom:0.68rem; -webkit-appearance: none;"
            class=" flex-grow outline-none text-gray-600   px-2 leading-tight border border-white  " {{ $attributes->merge([$attributes]) }}>
            {{ $slot }}
        </select>
        <span class="absolute right-2">
            @if (isset($icon))
                {{ $icon }}
            @endif
        </span>
    </div>
</div>
