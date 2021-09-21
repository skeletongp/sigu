<div>
    <div class="bg-second-100  py-2 w-full h-12 fixed top-0  flex justify-between z-50">
        <nav class="max-w-7xl w-full flex items-center justify-between mx-auto h-full px-4">
            <div class="hidden sm:flex justify-between space-x-3">
                <x-nav-link href="{{route('welcome')}}" class="text-xl cursor-pointer text-gray-50 " :active="request()->routeIs('users.index')">Home
                </x-nav-link>
                <x-nav-link class="text-xl cursor-pointer text-gray-50 " :active="request()->routeIs('users.index')">Materias
                </x-nav-link>
            </div>
            <div class="sm:hidden">
            <x-dropdown  align="left">
                <x-slot name="trigger">
                    <span class="fas fa-bars text-xl text-main-80"></span>
                </x-slot>
                <x-slot name="content">
                    <x-responsive-nav-link href="{{ route('welcome') }}" class="text-xl cursor-pointer   "
                        :active="request()->routeIs('users.index')">
                        Home
                    </x-responsive-nav-link>
                    <x-responsive-nav-link href="{{ route('welcome') }}" class="text-xl cursor-pointer   "
                        :active="request()->routeIs('users.index')">
                        Carreras
                    </x-responsive-nav-link>
                </x-slot>
                </x-dropdown>
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
                    <x-dropdown-link href="{{ route('users.index') }}">Gestionar Asignaturas</x-dropdown-link>
                    @endhasanyrole
                    @hasanyrole('student|teacher')
                    <x-dropdown-link href="{{ route('users.logout') }}">Mis Materias</x-dropdown-link>
                    @endhasanyrole
                    <x-dropdown-link href="{{ route('users.logout') }}">Salir</x-dropdown-link>
                </x-slot>
            </x-dropdown>

        </nav>

    </div>


</div>
