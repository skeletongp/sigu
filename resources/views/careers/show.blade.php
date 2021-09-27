@php
$roles = ['admin' => 'Admin', 'support' => 'Soporte', 'teacher' => 'Docente', 'student' => 'Estudiante'];
@endphp

<x-app>
    <div class="w-full p-4 bg-white rounded-xl relative dark:bg-gray-800 dark:text-white max-w-7xl mx-auto">
        {{-- Crear nuevo usuario --}}
        @hasanyrole('admin|support')
        <div class=" bottom-2 right-2 xl:right-5 xl:bottom-5 z-50" >
            <x-dropdown align="left">
                <x-slot name="trigger">
                    <div id="btnAdd"
                        class="flex space-x-3 bg-blue-600 text-white rounded-full items-center justify-center cursor-pointer hover:bg-gray-900  w-max px-3 py-1">
                        <span class="fas fa-plus xl:text-lg"></span>
                        <input type="text" class="hidden cursor-pointer bg-transparent outline-none border-none font-bold text-white " id="spanText" readonly value="Nuevo usuario"/>
                    </div>
                </x-slot>
                <x-slot name="content">
                    
                    <x-dropdown-link class="cursor-pointer" href="{{route('careers.create')}}">Nueva Carrera</x-dropdown-link>
                    <x-dropdown-link class="cursor-pointer" href="{{route('careers.addsubject', $career)}}">Ver/Añadir Asignaturas</x-dropdown-link>
                </x-slot>
            </x-dropdown>
        </div>
        @endhasanyrole

        {{-- Form de búsqueda y filtrado --}}
        <form action="{{ route('careers.show', $career) }}" class="m-3 xl:mt-5 mx-auto ">
            <div class=" lg:flex lg:space-x-3 justify-center my-4 xl:w-2/3 mx-auto">
                <div class="w-full lg:w-1/3">
                    <x-label class="text-lg dark:text-white">Buscar</x-label>
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
        @if ($users->count())
            <h1 class=" font-bold text-xl xl:text-2xl mb-2 mt-3 uppercase w-full text-center">Estudiantes en esta carrera
            </h1>
        @endif

        {{-- Listado de datos --}}
        <div class=" flex flex-col  w-full items-center justify-center  dark:bg-gray-800 rounded-lg shadow p-3">
            @if ($users->count())
                <ul class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 mx-auto  gap-3  ">

                    @foreach ($users as $user)
                      <div class="pt-1 px-1">
                        
                        <x-list title="{{ $user->fullname }}" image="{{ $user->photo }}"
                            url="{{ route('users.show', $user) }}" subtitle="{!!'<b>'.$user->id.'</b>'!!} / {!!$user->career->code!!} "
                            text="nada"
                            rDelete="{{route('users.destroy', $user) }}"
                            rEdit="{{route('users.edit', $user)}}">
                        </x-list>
                      </div>
                    @endforeach
                   </i>

                </ul>
            @else
                <h1 class="my-4 text-xl text-black dark:text-gray-300">Sin resultados</h1>
            @endif
        </div>
        <div class=" my-3 max-w-7xl mx-auto">
            {{ $users->links('vendor.pagination.tailwind') }}
        </div>
    </div>
    @php
        $user = new App\Models\User();
    @endphp
    <x-slot name="lateral">
        <div class="flex flex-col justify-start py-2 items-center w-full space-y-8">
            <h1 class="uppercase font-bold text-2xl text-center">Estadísticas de usuarios</h1>
         <ul>
            @foreach ($subjects as $subject)
                
            @endforeach
         </ul>
        </div>
    </x-slot>
</x-app>
