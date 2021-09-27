    <div class="bg-second-100 dark:bg-gray-700  py-3 w-full h-12 absolute  flex justify-between z-50">
        <nav class="max-w-7xl w-full flex items-center justify-between mx-auto h-full px-4">
            <div class="hidden sm:flex justify-between space-x-3">
                <x-nav-link href="{{route('welcome')}}" class="text-xl cursor-pointer text-gray-50 " :active="request()->routeIs('users.index')">Home
                </x-nav-link>
               
            </div>
            <div class="">
                <div class="fixed top-3 left-3 z-50">
                    <div class="mb-3 flex items-center">
                        <div class="relative inline-block w-10 mr-2 align-middle select-none">
                            <input type="checkbox" name="toggle" id="toggle" class="checked:bg-blue-500 outline-none focus:outline-none right-4 checked:right-0 duration-200 ease-in absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer" {{Auth::user()?(Auth::user()->darkmode=='Y'?'checked':''):''}}/>
                                <label for="toggle" class="block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer">
                                </label>
                                <input type="hidden" name="user" id="user" value="{{Auth::user()->id}}">
                            </div>
                            <span class="text-white font-medium">
                                Darkmode
                            </span>
                        </div>
                </div>
            </div>
            <x-dropdown>
                <x-slot name="trigger">
                    <div class="flex items-center space-x-2 cursor-pointer">
                        <div class="w-10 h-10 rounded-full bg-cover bg-no-repeat bg-center"
                            style="background-image: url({{ Auth::user()->photo }})">
                        </div>
                        <span class="fas fa-angle-down"></span>
                    </div>
                </x-slot>
                <x-slot name="content" class="">
                    <x-dropdown-link class="" href="
                    {{ route('users.show', Auth::user()) }}">Perfil</x-dropdown-link>
                    @role('admin')
                    <x-dropdown-link href="{{ route('users.index') }}">Gestionar Usuarios</x-dropdown-link>
                    @endrole
                    @hasanyrole('support|teacher')
                    <x-dropdown-link href="{{ route('users.index') }}">Lista de Usuarios</x-dropdown-link>
                    @endhasanyrole
                    @hasanyrole('admin|support')
                    <x-dropdown-link href="{{ route('careers.index') }}">Gestionar Carreras</x-dropdown-link>
                    <x-dropdown-link href="{{ route('subjects.index') }}">Gestionar Asignaturas</x-dropdown-link>
                    @endhasanyrole
                    @hasanyrole('student|teacher')
                    <x-dropdown-link href="{{ route('users.logout') }}">Mis Materias</x-dropdown-link>
                    @endhasanyrole
                    <x-dropdown-link href="{{ route('users.logout') }}">Salir</x-dropdown-link>
                </x-slot>
            </x-dropdown>

        </nav>

    </div>

