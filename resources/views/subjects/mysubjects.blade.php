<x-app>
    <div class="max-w-2xl mx-auto">
       <h1 class=" text-center text-xl xl:text-3xl my-2 font-bold uppercase">
        mi horario
       </h1>
        @livewire('section-table', ['having' => true])
    </div>
</x-app>