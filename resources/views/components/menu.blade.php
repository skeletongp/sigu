    <div class="bg-gray-200 dark:bg-gray-700  py-3 w-full h-12 absolute  flex justify-between z-50">
        <nav class="max-w-7xl w-full flex items-center justify-between mx-auto h-full px-4">
            <div class="hidden sm:flex justify-between space-x-3">
                <x-nav-link href="{{ route('home') }}" class="text-xl cursor-pointer">
                    <div class="w-10 h-10 rounded-full bg-black bg-cover bg-center flex justify-center items-center" >
                        <span class="fas fa-home text-white"></span>
                    </div>
                </x-nav-link>

            </div>
            <div class="">
                <div class=" fixed top-4 left-3 z-50">
                <div class="mb-3 flex items-center">
                    <div class="relative inline-block w-8 mr-2 align-middle select-none">
                        <input type="checkbox" name="toggle" id="toggle"
                            class="checked:bg-blue-500 outline-none focus:outline-none right-4 checked:right-0 duration-300 ease-in absolute block w-4 h-4 rounded-full bg-white border-3 appearance-none cursor-pointer"
                            {{ Auth::user() ? (Auth::user()->darkmode == 'Y' ? 'checked' : '') : '' }} />
                        <label for="toggle" class="block overflow-hidden h-4 rounded-full bg-gray-300 cursor-pointer">
                        </label>
                        <input type="hidden" name="user" id="user" value="{{ Auth::user()->id }}">
                    </div>
                    <label for="toggle" class=" font-medium text-xs">
                        Darkmode
                    </label>
                </div>
            </div>
    </div>
    <x-dropdown contentClasses="w-max bg-white pr-2 lg:text-lg font-semibold">
        <x-slot name="trigger">
            <div class="flex items-center space-x-2 cursor-pointer">
                <div class="w-10 h-10 rounded-full bg-cover bg-no-repeat bg-center"
                    style="background-image: url({{ Auth::user()->photo }})">
                </div>
                <span class="fas fa-angle-down"></span>
            </div>
        </x-slot>
        <x-slot name="content">
            <x-dropdown-link
                class=" font-bold text-center bg-gray-900 text-blue-400 hover:bg-gray-800 hover:text-white -mt-2 -mx-2"
                href="
                    {{ route('users.show', Auth::user()) }}">
                    <div class="flex flex-col">
                        <span>{{ Auth::user()->fullname }}</span>
                        <span class="text-xs">{{ Auth::user()->role() }}</span>
                    </div>
            </x-dropdown-link>
            <hr>
            <x-dropdown-link class="flex space-x-5" href=" {{ route('users.show', Auth::user()) }}">
                <span>Mi Perfil</span>
            </x-dropdown-link>

            @hasanyrole('teacher')
            <x-dropdown-link class="flex space-x-4" href="{{ route('users.index') }}">
                <span>Lista de Usuarios</span>
            </x-dropdown-link>
            @endhasanyrole
            @hasanyrole('admin|support')
            <x-dropdown-link class="flex space-x-5" href="{{ route('users.index') }}">
                <span>Gestionar Usuarios</span>
            </x-dropdown-link>
            <x-dropdown-link class="flex space-x-5" href="{{ route('careers.index') }}">
                <span> Gestionar Carreras</span>
            </x-dropdown-link>
            <x-dropdown-link class="flex space-x-5" href="{{ route('subjects.index') }}">
                <span>Gestionar Asignaturas</span>
            </x-dropdown-link>
            <x-dropdown-link class="flex space-x-5" href="{{ route('sections.index') }}">
                <span>Gestionar Secciones</span>
            </x-dropdown-link>
            <x-dropdown-link class="flex space-x-5" href="{{ route('sections.selection') }}">
                <span>Horarios</span>
            </x-dropdown-link>
            @endhasanyrole
            @hasanyrole('student|teacher')
            <x-dropdown-link class="flex space-x-5" href="{{ route('subjects.mysubjects') }}">
                <span>Mi Horario</span>
            </x-dropdown-link>
            @endhasanyrole
            @role('student')
            <x-dropdown-link class="flex space-x-5" href="{{ route('careers.show', Auth::user()->career) }}">
                <span>Mi Carrera</span>
            </x-dropdown-link>
            @if (Auth::user()->career->selectiondate->count() && Auth::user()->subjects->count() < 3)
                <x-dropdown-link class="flex space-x-5" href="{{ route('sections.selection') }}">
                    <span>Selección</span>
                </x-dropdown-link>
            @endif
            @endrole
            <x-dropdown-link class="flex space-x-5" href="{{ route('users.logout') }}">
                <span>Salir</span>
            </x-dropdown-link>
        </x-slot>
    </x-dropdown>

    </nav>

    </div>
