@props(['disabled' => false, 'class' => ''])


<div class=" py-0 flex justify-between items-center overflow-hidden rounded-md border relative w-full  {{ $class }}">
    <select {{ $disabled ? 'disabled' : '' }}
        style="padding-top: 0.70rem; padding-bottom:0.70rem; -webkit-appearance: none;"
        class=" flex-grow outline-none text-gray-900 dark:text-gray-300   px-2 leading-tight border border-white dark:bg-gray-800 dark:border-gray-800 overflow-hidden"
        {{$attributes}}>
        {{ $slot }}
    </select>
    <span class="absolute right-2">
        @if (isset($icon))
            {{ $icon }}
        @endif
    </span>
</div>
