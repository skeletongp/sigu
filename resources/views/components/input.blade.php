@props(['disabled' => false, 'class' => ''])


<div class="bg-white rounded-md"> 
    
    <div class=" py-1 px-1 flex justify-between items-center rounde-md rounded-md border relative {{ $class }}">
        
        <input {{ $disabled ? 'disabled' : '' }}
            class=" flex-grow outline-none text-gray-600  py-2 px-2 leading-tight   "
            {{ $attributes }} />
        <span class="mx-1 right-2">
            @if (isset($icon))
                {{ $icon }}
            @endif
        </span>
    </div>
</div>
