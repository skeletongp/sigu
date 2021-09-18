@php
$roles = ['admin' => 'Administradores', 'support' => 'Soportes', 'teacher' => 'Docentes', 'student' => 'Estudiantes'];
@endphp
<x-app>
    <div class="w-full p-4 bg-white rounded-xl">
        @role('admin')
        @endrole
        <div class=" mx-auto my-4 flex ">
            <div class="flex items-center space-x-4"">
               @role('admin')
               <a class="              bg-gray-700 rounded-xl px-2 py-1 text-white"
                href="{{ route('users.create') }}">
                <span class="fas fa-plus"></span> Nuevo
                </a>
                @endrole
            </div>
        </div>
        <h1 class="text-center font-bold text-xl uppercase my-2">Listado de
            {{ $role != '' ? $roles[$role] : 'Usuarios' }}
        </h1>
        <div class=" mx-auto my-2 flex items-center">
            <form action="{{ route('users.index') }}" class="w-full flex items-center" id="form-search">
                <div class="w-max mr-4">
                    @role('admin')
                    <x-dropdown align="left">
                        <x-slot name="trigger">
                            <div class="cursor-pointer w-max">Ver:
                                <strong>{{ request('r') ? $roles[request('r')] : 'Todos' }}</strong> <span
                                    class="fas fa-angle-down"></span>
                            </div>
                        </x-slot>
                        <x-slot name="content">
                            <div>
                                @foreach ($roles as $rol => $text)
                                    <div class="flex items-center mx-2 space-x-3">
                                        <input type="radio" name="r" id="{{ $rol }}"
                                            value="{{ $rol }}" {{ request('r') == $rol ? 'checked' : '' }}>
                                        <label for="{{ $rol }}">{{ $text }}</label>
                                    </div>
                                @endforeach
                                <div class="flex items-center mx-2 space-x-3">
                                    <input type="radio" name="r" id="todos" value=""
                                        {{ request('r') == '' ? 'checked' : '' }}>
                                    <label for="todos">Todos</label>
                                </div>
                            </div>
                        </x-slot>
                    </x-dropdown>
                    @endrole
                </div>
                <div class="w-full">
                    <x-input class="search-input w-full " type="search" placeholder="Ingrese un término para buscar"
                        name='q' id="q" value="{{ old('q', request('q')) }}">
                    </x-input>
                </div>
                <x-button title="Buscar"> <span class="fas fa-search text-blue-500 text-lg"></span>
                </x-button>
            </form>
        </div>
        <x-table>
            <x-slot name="head">
                <x-custom.thead class="text-left px-3" label="name">Nombre</x-custom.thead>

                <x-custom.thead class="text-left px-3 w-max">Rol</x-custom.thead>
                @hasanyrole ('admin')
                <x-custom.thead class="w-6"> </x-custom.thead>
                @endhasanyrole
            </x-slot>


            <x-slot name="body">
                @if ($users->count())
                    @foreach ($users as $user)
                        <tr class="border bt-2 py-1 px-0 text-left   border-r-2 border-gray-50 ">
                            <td class="px-3 flex items-center">
                                <a href="{{ route('users.show', $user) }}"
                                    class="w-10 h-10 m-1 ml-0 rounded-full bg-contain bg-no-repeat bg-center cursor-pointer "
                                    style="background-image: url({{ $user->photo }})">
                                </a>
                                <a class="hover:underline"
                                    href="{{ route('users.show', $user) }}">{{ $user->fullname }} {{date_diff(date_create($user->birthday), now())->y}}</a>

                            </td>
                            <td class="px-3 sm:w-40 ">
                                {{ $user->role() }}</td>

                            @hasanyrole('admin')
                            <td class="px-3">
                                <a onclick="return confirm('¿Borrar usuario?');"
                                    href="{{ route('users.delete', $user) }}" class="delete_confirm">
                                    <button type="button" class="bg-white btnDelete" id="{{ 'b' . $user->id }}">
                                        <span class="fas fa-times text-red-400"></span>
                                    </button>
                                </a>
                            </td>
                            @endhasanyrole

                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="3"> <span>Sin resultados</span></td>
                    </tr>
                @endif
            </x-slot>
        </x-table>
        <div class=" mx-auto table-auto my-6">
            {{ $users->links() }}
        </div>
        <x-slot name="lateral">
            <a href="{{ route('api.users') }}">Prueba del link</a>
        </x-slot>
    </div>
    </div>
  
</x-app>
