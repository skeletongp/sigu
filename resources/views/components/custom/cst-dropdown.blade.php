@props(['label'])
<x-dropdown>
    <x-slot name="trigger">
        <span class="cursor-pointer">{{$label}} 
            <span class="fas fa-angle-down"></span>
        </span>
    </x-slot>
    <x-slot name="content">
        {{$slot}}
    </x-slot>
</x-dropdown>