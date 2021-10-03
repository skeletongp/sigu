<x-app>
    <div class="max-w-3xl mx-auto">
        @if (Auth::user()->subjects->count())
        @livewire('section-table', ['having' => true, 'hide_button'=>true])
        @else
            <h1 class="uppercase text-center font-bold text-xl xl:text-4xl">No has seleccionado ninguna asignatura</h1>
        @endif
        
    </div>
</x-app>