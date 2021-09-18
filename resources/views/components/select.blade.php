@props(['disabled' => false, 'class' => ''])


<div class="bg-white rounded-md">
    <div class=" py-1 flex justify-between items-center rounde-md rounded-md border relative {{ $class }}">
        <select {{ $disabled ? 'disabled' : '' }}
            class=" flex-grow outline-none text-gray-600  py-2 px-2 leading-tight border border-white  " {{ $attributes }}>
            {{ $slot }}
        </select>
        <span class="absolute right-2">
            @if (isset($icon))
                {{ $icon }}
            @endif
        </span>
    </div>
</div>
