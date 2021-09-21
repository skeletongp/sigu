@php
$roles = ['admin' => 'Admin', 'support' => 'Soporte', 'teacher' => 'Docente', 'student' => 'Estudiante'];
@endphp

<x-app>
    <div class="w-full p-4 bg-white rounded-xl relative ">
        {{-- Crear nuevo usuario --}}
        <a href="{{ route('users.create') }}">
            <div
                class="fixed right-2 bottom-2 xl:right-5 xl:bottom-5 z-50 w-8 h-8 xl:w-12 xl:h-12 bg-blue-600 text-white rounded-full flex items-center justify-center        cursor-pointer hover:bg-white hover:text-gray-900">
                <span class="fas fa-plus xl:text-3xl"></span>
            </div>
        </a>

        {{-- Form de búsqueda y filtrado --}}
        <form action="{{ route('users.index') }}" class="m-3 xl:mt-5 mx-auto ">
            <div class=" lg:flex lg:space-x-3 justify-center my-4 xl:w-2/3 mx-auto">
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
                <div class="w-full lg:w-1/3 my-2 lg:my-0">
                    <x-label class="text-lg">Filtrar por</x-label>
                    <x-select name="r" style="-webkit-appearance: none;">
                        <option value="">Todos</option>
                        @foreach ($roles as $key => $rol)
                            <option value="{{ $key }}" {{ request('r') == $key ? 'selected' : '' }}>
                                {{ $rol }}</option>
                        @endforeach
                        <x-slot name="icon">
                            <button>
                                <span role="button" class="fas fa-filter text-blue-500 cursor-pointer">
                                </span>
                            </button>
                        </x-slot>
                    </x-select>
                </div>
            </div>
        </form>
        @if ($users->count())
            <h1 class=" font-bold text-xl xl:text-2xl mb-2 mt-3 uppercase w-full text-center">Resgistro de usuarios
            </h1>
        @endif
        
        {{-- Listado de datos --}}
        <div class=" flex flex-col  w-full items-center justify-center  dark:bg-gray-800 rounded-lg shadow p-3">
            @if ($users->count())
                <ul class="grid grid-cols-1 sm:grid-cols-2 mx-auto  gap-3  ">
                    
                    @foreach ($users as $user)
                        <x-list title="{{ $user->fullname }}" image="{{ $user->photo }}"
                            url="{{ route('users.show', $user) }}" subtitle="{{ $user->getRoleNames() }} {{optional($user->career)->name}}"
                            text="nada">
                        </x-list>
                    @endforeach

                </ul>
            @else
                <h1 class="my-4 text-xl text-black">Sin resultados</h1>
            @endif
        </div>
        <div class=" my-3 max-w-7xl mx-auto">
            {{ $users->links('vendor.pagination.tailwind') }}
        </div>
    </div>
    
    <x-slot name="lateral">
        <div class="flex flex-col justify-center items-center w-full space-y-8">
            <h1 class="uppercase font-bold text-2xl text-center">Estadísticas de usuarios</h1>
            <a href="{{ route('users.index') }}" class=" font-bold text-center">
                Total de Usuarios: <br> <span class="text-main-100">{{ $user->total() }}</span>
            </a>
            <hr>
            @foreach ($roles as $key => $rol)
                <a href="{{ route('users.index', ['r' => $key]) }}" class=" font-bold text-center  border-b-2">
                    {{ $rol }}s: <br> <span class="text-main-100">{{ $user->total($key) }}</span>
                </a>
            @endforeach
        </div>
    </x-slot>
</x-app>
