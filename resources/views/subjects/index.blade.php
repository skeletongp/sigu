<x-app>
    <div class="w-full p-4 bg-white dark:bg-gray-800 rounded-xl relative max-w-6xl mx-auto">
        {{-- Crear nuevo usuario --}}
        @hasanyrole('admin|support')
        <div class=" bottom-2 right-2 xl:right-5 xl:bottom-5 z-50 w-max" id="btnAdd">
            <a href="{{ route('subjects.create') }}">
                <div
                    class=" w-max px-3 py-1 flex space-x-3 bg-blue-600 text-white rounded-full  items-center justify-center        cursor-pointer hover:bg-gray-900 ">
                    <span class="fas fa-plus "></span>
                    <input type="text"
                        class="hidden w-full cursor-pointer bg-transparent outline-none border-none font-bold text-white "
                        id="spanText" readonly value="Nueva asignatura" />
                </div>
            </a>
        </div>
        @endhasanyrole
        {{-- Form de búsqueda y filtrado --}}
        <form action="{{ route('subjects.index') }}" class="m-3 xl:mt-5 mx-auto ">
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

        @if ($subjects->count())
            <h1 class=" font-bold text-xl xl:text-2xl mb-2 mt-3 uppercase text-center">Índice de asignaturas
            </h1>
        @endif

        {{-- Listado de datos --}}
        <div class=" flex flex-col  w-full items-start justify-center  dark:bg-gray-800 rounded-lg shadow p-3">
            @if ($subjects->count())
            
                <ul class="grid grid-cols-1 sm:grid-cols-2 mx-auto   gap-3  ">

                    @foreach ($subjects as $subject)
                        <div class="p-4  rounded-xl">

                            <x-list title="{{ $subject->name }}"
                                image="https://cdn3.iconfinder.com/data/icons/ballicons-reloaded-vol-1/512/icon-13-512.png"
                                url="{{ route('subjects.show', $subject) }}"
                                subtitle="{{ $subject->code }}- {{ optional($subject->students)->count() }} estudiantes"
                                text="nada" rDelete="{{ route('subjects.destroy', $subject) }}"
                                rEdit="{{ route('subjects.edit', $subject) }}">
                            </x-list>
                        </div>
                    @endforeach

                </ul>
            @else
                <h1 class="my-4 text-xl text-black">Sin resultados</h1>
            @endif
        </div>
        <div class=" my-3 max-w-7xl mx-auto">
            {{ $subjects->links('vendor.pagination.tailwind') }}
        </div>
    </div>
    <x-slot name="lateral">
        <div class="flex flex-col justify-center items-center w-full space-y-8">
            <h1 class="uppercase font-bold text-2xl text-center">Estadísticas de usuarios</h1>

        </div>
    </x-slot>
</x-app>
