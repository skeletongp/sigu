<form id="{{ $id }}" action="{{ $action }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method($method)
    <div>
        <div class=" sm:flex space-y-2 sm:space-y-0 space-x-0 sm:space-x-2 p-1 w-full">
            <div class="sm:w-1/2">
                <x-label class="text-lg" for="name">Nombre</x-label>
                <x-input class="w-full" type="text" placeholder="Ingrese el nombre" name='name' id="name"
                    value="{{ old('name', request('name')) }}" />
                <x-input-error for="name" />
            </div>
            <div class="sm:w-1/2">
                <x-label class="text-lg" for="lastname">Apellido</x-label>
                <x-input class="w-full" type="text" placeholder="Ingrese el apellido" name='lastname'
                    id="lastname" value="{{ old('lastname', request('lastname')) }}" />
                <x-input-error for="lastname" />
            </div>
        </div>
        @if (Auth::user()->id == request('id'))
            <div class=" sm:flex space-y-2 sm:space-y-0 space-x-0 sm:space-x-2 p-1 w-full">
                <div class="sm:w-1/2">
                    <x-label class="text-lg" for="password">Password</x-label>
                    <x-input class="w-full" type="password" placeholder="Ingrese nueva contraseña"
                        name='password' id="password" />
                    <x-input-error for="password" />
                </div>
                <div class="sm:w-1/2">
                    <x-label class="text-lg" for="password_confirmation">Apellido</x-label>
                    <x-input class="w-full" type="password" placeholder="Repita la contraseña"
                        name='password_confirmation' id="password_confirmation" />
                    <x-input-error for="password_confirmation" />
                </div>
            </div>
        @endif
        <div class="sm:flex  space-y-2 sm:space-y-0 space-x-0 sm:space-x-2  p-1 w-full">

            <div class="sm:w-1/2">
                <x-label class="text-lg" for="lastname">Foto</x-label>
                <x-label for="photoPicker" class="cursor-pointer">
                    <div class="py-2 px-2 flex justify-between items-center rounde-md rounded-md border relative ">
                        <span class="text-md">Seleccione archivo</span>
                        <div id="preview" class="w-7 h-7 rounded-full bg-contain bg-center bg-red-200"></div>
                    </div>
                </x-label>
                <x-input class="w-full hidden" type="file" accept="image/png, image/gif, image/jpeg" name='photoPicker'
                    id="photoPicker" />
                <x-input type="hidden" class="hidden" id="photo" name="photo"
                    value="{{ old('photo', request('photo')) }}" />
            </div>
            <div class="sm:w-1/2">
                <x-label class="text-lg" for="img"> ... </x-label>
                <x-input disabled class="w-full" type="text" id="img"
                    value="{{ old('photo', request('photo')) }}" />
            </div>
        </div>
        <div class="sm:flex items-end  space-y-2 sm:space-y-0 space-x-0 sm:space-x-2  p-1 w-full">
            <div class="sm:w-1/2">
                <x-label class="text-lg" for="birthday">Fecha de Nacimiento</x-label>
                <x-input class="w-full" type="date" name='birthday' id="birthday"
                    value="{{ old('birthday', request('birthday')) }}" />
            </div>
            @if (Auth::user()->id != request('id'))
                <div class="sm:w-1/2">
                    <x-label class="text-lg" for="role">Tipo de usuario</x-label>
                    <x-select class="" name=" role" id="role">
                        <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Administrador
                        </option>
                        <option value="support" {{ request('role') == 'support' ? 'selected' : '' }}>Soporte</option>
                        <option value="teacher" {{ request('role') == 'teacher' ? 'selected' : '' }}>Docente</option>
                        <option value="student" {{ request('role') == 'student' ? 'selected' : '' }}>Estudiante
                        </option>
                    </x-select>
                </div>
            @endif

        </div>
    </div>

</form>
