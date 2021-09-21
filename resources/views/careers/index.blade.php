@php
$roles = ['admin' => 'Admin', 'support' => 'Soporte', 'teacher' => 'Docente', 'student' => 'Estudiante'];
@endphp
<x-app>
    <div class="w-full p-4 bg-white rounded-xl relative ">
        {{-- Crear nuevo usuario --}}
        <a href="{{ route('careers.create') }}">
            <div
                class="fixed right-2 bottom-2 xl:right-5 xl:bottom-5 z-50 w-8 h-8 xl:w-12 xl:h-12 bg-blue-600 text-white rounded-full flex items-center justify-center        cursor-pointer hover:bg-white hover:text-gray-900">
                <span class="fas fa-plus xl:text-3xl"></span>
            </div>
        </a>

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
        <div class=" flex flex-col  w-full items-start justify-center  dark:bg-gray-800 rounded-lg shadow p-3">
            @if ($careers->count())
                <ul class="grid grid-cols-1 sm:grid-cols-2 mx-auto   gap-3  ">

                    @foreach ($careers as $career)
                        <x-list title="{{ $career->name }}" image="https://cdn3.iconfinder.com/data/icons/ballicons-reloaded-vol-1/512/icon-13-512.png"
                            url="{{ route('careers.show', $career) }}" subtitle="{{$career->code}}"
                            text="nada">
                        </x-list>
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
