@php
$roles = ['admin' => 'Admin', 'support' => 'Soporte', 'teacher' => 'Docente', 'student' => 'Estudiante'];
@endphp
<x-app>
    <div class="w-full p-4 bg-white rounded-xl max-w-3xl mx-auto relative dark:bg-gray-800 ">
        {{-- Crear nuevo usuario --}}
        <div class=" top-2 right-2 xl:right-5 xl:top-5 z-50 w-12" id="btnAdd">
            <x-dropdown align="left">
                <x-slot name="trigger">
                    <div
                        class=" w-6 h-5 flex bg-blue-600 dark:bg-gray-700 text-white dark:text-blue-200 rounded-full  items-center justify-center  cursor-pointer hover:bg-gray-400 ">
                        <span class="fas fa-list text-lg lg:text-xl"></span>
                    </div>
                </x-slot>
                <x-slot name="content">
                    <x-dropdown-link href="{{ route('careers.create') }}">Agregar carrera</x-dropdown-link>
                </x-slot>
            </x-dropdown>
        </div>
        {{-- Form de búsqueda y filtrado --}}
        <form action="{{ route('careers.index') }}" class="m-3 xl:mt-5 mx-auto ">
            <div class=" lg:flex lg:space-x-3 justify-center my-4 w-full mx-auto">
                <div class="w-full lg:w-1/3">
                    <x-label class="text-lg">Buscar</x-label>
                    <x-input type="search" class="w-full" placeholder="Término de búsqueda" name="q"
                        value="{{ old('q', request('q')) }}">
                        <x-slot name="icon">
                            <button>
                                <span role="button" class="fas fa-search text-blue-500 cursor-pointer">
                                </span>
                            </button>
                        </x-slot>
                    </x-input>
                </div>

            </div>
        </form>
        @if ($careers->count())
            <h1 class=" font-bold text-xl xl:text-2xl mb-2 mt-3 uppercase text-center">Índice de carreras
            </h1>
        @endif
        {{-- Listado de datos --}}
        <div
            class=" flex flex-col max-w-3xl  mx-auto w-full items-start justify-center  dark:bg-gray-800 rounded-lg shadow p-3">
            @if ($careers->count())
                <ul class="grid grid-cols-1 sm:grid-cols-2 mx-auto   gap-3  ">

                    @foreach ($careers as $career)
                        <div class="p-4  rounded-xl  border-2">
                            <a href="{{ route('careers.addsubject', $career) }}">Ver Pensum</a>
                            <x-list title="{{ $career->name }}"
                                image="https://cdn3.iconfinder.com/data/icons/ballicons-reloaded-vol-1/512/icon-13-512.png"
                                url="{{ route('careers.show', $career) }}"
                                subtitle="{{ $career->code }}- {{ $career->students->count() }} estudiantes"
                                text="nada" rDelete="{{ route('careers.destroy', $career) }}"
                                rEdit="{{ route('careers.edit', $career) }}">
                            </x-list>
                        </div>
                    @endforeach

                </ul>
            @else
                <h1 class="my-4 text-xl text-black">Sin resultados</h1>
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
