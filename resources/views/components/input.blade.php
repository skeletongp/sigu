@props(['disabled' => false, 'class' => ''])


<div class="bg-white dark:bg-gray-800 rounded-md"> 
    
    <div class=" py-1 px-1 flex justify-between items-center rounde-md rounded-md border relative {{ $class }}">
        
        <input {{ $disabled ? 'disabled' : '' }}
            class=" flex-grow outline-none text-gray-600  py-2 px-2 leading-tight   dark:text-gray-300 dark:bg-gray-800 "
            {{ $attributes }} />
        <span class="mx-1 right-2">
            @if (isset($icon))
                {{ $icon }}
            @endif
        </span>
    </div>
</div>
