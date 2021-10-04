@php
$roles = ['admin' => 'Admin', 'support' => 'Soporte', 'teacher' => 'Docente', 'student' => 'Estudiante'];
$order = ['id' => 'Matrícula', 'name' => 'Nombre', 'lastname' => 'Apellido', 'birthday' => 'Edad'];

@endphp

<x-app>
    <div class="w-full p-4 bg-white dark:bg-gray-800 shadow-xl rounded-xl relative  max-w-7xl mx-auto">
        {{-- Crear nuevo usuario --}}
        @hasanyrole('admin|support')
        <div class=" top-2 xl:left-5  z-50 absolute">
            <x-dropdown align="left">
                <x-slot name="trigger">
                    <div id="btnAdd"
                        class="flex space-x-3 bg-blue-600 text-white rounded-full items-center justify-center cursor-pointer hover:bg-gray-900  w-max px-3 py-1">
                        <span class="fas fa-plus xl:text-lg"></span>
                        <input type="text"
                            class="hidden cursor-pointer bg-transparent outline-none border-none font-bold text-white "
                            id="spanText" readonly value="Nuevo usuario" />
                    </div>
                </x-slot>
                <x-slot name="content">
                    @foreach ($roles as $key => $role)
                        <x-dropdown-link class="cursor-pointer" href="{{ route('users.create', ['role' => $key]) }}">
                            {{ $role }}</x-dropdown-link>
                    @endforeach
                </x-slot>
            </x-dropdown>
        </div>
        @endhasanyrole
        {{-- Form de búsqueda y filtrado --}}
        <form action="{{ route('users.index') }}" class="m-3 xl:mt-5 mx-auto " id="formSearch">
            <div class=" lg:flex lg:space-x-3 justify-center my-4 xl:w-2/3 mx-auto">
                <div class="w-full lg:w-1/3">
                    <x-label class="text-lg ">Buscar</x-label>
                    <x-input type="search" class="w-full" placeholder="Término de búsqueda" name="q"
                        value="{{ old('q', request('q')) }}" autocomplete>
                        <x-slot name="icon">
                            <button>
                                <span role="button" class="fas fa-search text-blue-500 cursor-pointer">
                                </span>
                            </button>
                        </x-slot>
                    </x-input>
                </div>
                @hasanyrole('admin|support')
                <div class="w-full lg:w-1/3 my-2 lg:my-0">
                    <x-label class="text-lg">Filtrar por</x-label>
                    <x-select name="r" style="-webkit-appearance: none;" id="roleSearch">
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
                @endhasanyrole
                <div class="hidden xl:block w-full lg:w-1/3 my-2 lg:my-0">
                    <x-label class="text-lg">Ordernar por</x-label>
                    <x-select name="o" style="-webkit-appearance: none;" id="orderSearch">
                        @foreach ($order as $key => $ord)
                            <option value="{{ $key }}" {{ request('o') == $key ? 'selected' : '' }}>
                                {{ $ord }}</option>
                        @endforeach
                        <x-slot name="icon">
                            <button>
                                <span role="button" class="fas fa-sort text-blue-500 cursor-pointer">
                                </span>
                            </button>
                        </x-slot>
                    </x-select>
                </div>
            </div>
        </form>
        @if ($users->count())
            <div class="lg:mt-8">
                @if (!request('r'))
                    <h1 class=" font-bold text-xl xl:text-2xl  mt-3 uppercase w-full text-center">Resgistro de
                        usuarios
                    </h1>
                @else
                    <h1 class=" font-bold text-xl xl:text-2xl mt-3 uppercase w-full text-center">LISTADO DE
                        {{ $roles[$users[0]->rol()] }}s
                    </h1>
                @endif
            </div>
        @endif

        {{-- Listado de datos --}}
        <div class=" flex flex-col  w-full items-center justify-center   rounded-lg shadow p-3">
            @if ($users->count())
                <ul class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 mx-auto  gap-3  ">
                    @foreach ($users as $user)
                        <div class="pt-1 px-1">
                            <x-list title="{{ $user->fullname }}" image="{{ $user->photo }}"
                                url="{{ route('users.show', $user) }}"
                                subtitle="{!! '<b>' . strtoupper($roles[$user->rol()]) . '</b>' !!} {!! '<i>' . optional($user->career)->code . '</i>' !!}" text="nada"
                                rDelete="{{ route('users.destroy', $user) }}"
                                rEdit="{{ route('users.edit', $user) }}">
                            </x-list>
                        </div>
                    @endforeach
                    </i>
                </ul>
            @else
                <h1 class="my-4 text-xl text-black dark:text-gray-300">Sin resultados</h1>
            @endif
        </div>
        <div class=" my-3 max-w-7xl mx-auto ">
            {{ $users->links('vendor.pagination.tailwind') }}
        </div>
    </div>
    @php
        $user = new App\Models\User();
    @endphp
    <x-slot name="lateral">
        <div class="flex flex-col justify-center items-center w-full space-y-8 dark:text-gray-900">
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
