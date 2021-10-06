<x-app>
    <div class="w-full p-4 bg-white dark:bg-gray-800 max-w-6xl mx-auto rounded-xl relative ">


        @if ($careers->count())
            <h1 class=" font-bold text-xl xl:text-2xl mb-2 mt-3 uppercase text-center">Carreras que imparten
                {{ $subject->name }}
            </h1>
        @endif
            @php
                $preq=optional($subject->prerrequisite)->code;
            @endphp
        <div class="max-w-2xl mx-auto">
        <x-list title=" {{ $subject->name }}"
            image="https://cdn3.iconfinder.com/data/icons/ballicons-reloaded-vol-1/512/icon-13-512.png"
            url="{{ route('subjects.show', $subject) }}"
            subtitle=" PRERREQUISITO: {{ $preq?$preq:'BACH' }}" text="nada"
            rDelete="{{ route('subjects.destroy', $subject) }}" rEdit="{{ route('subjects.edit', $subject) }}">
            </x-list>
        </div>
        {{-- Listado de datos --}}
        <div class=" flex flex-col  w-full items-start justify-center  dark:bg-gray-800 rounded-lg shadow p-3">
            @if ($careers->count())

                <ul class="grid grid-cols-1 sm:grid-cols-2 mx-auto   gap-3  ">

                    @foreach ($careers as $career)
                        <div class="p-4  rounded-xl">

                            <x-list title="{{ $career->name }}"
                                image="https://cdn3.iconfinder.com/data/icons/ballicons-reloaded-vol-1/512/icon-13-512.png"
                                url="{{ route('users.index', ['c' => $career->id]) }}"
                                subtitle="{{ $career->code }}- {{ $subject->studentsCareer($career->id)->count() }} estudiantes"
                                text="nada" rDelete="{{ route('subjects.detach', [$career, $subject]) }}"
                                rEdit="{{ route('careers.edit', $career) }}">
                            </x-list>
                        </div>
                    @endforeach

                </ul>
            @else
                <h1 class="my-4 text-xl text-center font-bold select-none uppercase w-full lg:text-2xl">Sin resultados</h1>
            @endif
        </div>
        <div class=" my-3 max-w-7xl mx-auto">
            {{ $careers->links('vendor.pagination.tailwind') }}
        </div>
    </div>
    <x-slot name="lateral">
        <div class="flex flex-col justify-center items-center w-full space-y-8">
            <h1 class="uppercase font-bold text-2xl text-center">Estadísticas de usuarios</h1>

        </div>
    </x-slot>
</x-app>
