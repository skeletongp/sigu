@php
$roles = ['admin' => 'Administrador', 'support' => 'Soporte', 'teacher' => 'Docente', 'student' => 'Estudiante'];
@endphp
<x-app>
    <div class="w-full p-4 bg-white rounded-xl">
        <form action="{{ route('users.index') }}" class="m-3">
            <div class="lg:flex lg:space-x-3">
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
                        @foreach ($roles as $key => $role)
                            <option value="{{ $key }}">{{ $role }}</option>
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
        <h1 class="text-center font-bold text-xl">Resgistro de usuarios</h1>
        <div
            class="container flex flex-col mx-auto w-full items-center justify-center bg-white dark:bg-gray-800 rounded-lg shadow p-3">
            <ul class="grid grid-cols-1 lg:grid-cols-3 gap-6  ">
                @foreach ($users as $user)
                    <x-list title="{{ $user->fullname }}" image="{{ $user->photo }}"
                        url="{{ route('users.show', $user) }}" subtitle="{{ $roles[$user->getRoleNames()[0]] }}"
                        text="nada">
                    </x-list>
                @endforeach
            </ul>
        </div>
        <div class="m-2 my-3">
            {{ $users->links() }}
        </div>
    </div>
    </div>
</x-app>
