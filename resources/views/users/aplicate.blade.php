<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<link rel="stylesheet" href="{{ mix('css/custom.css') }}" defer>
<html class="dark">
<main class="w-screen h-screen flex justify-center items-center bg-gray-800">

    <div class="max-w-2xl mx-auto">
        <h1 class="uppercase text-white text-xl lg:text-2xl font-bold text-center my-2">Llena este formulario</h1>
        <form action="{{ route('users.sendadmision') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="dark:bg-gray-800 flex flex-col space-y-3">
                <div class=" sm:flex space-y-2 sm:space-y-0 space-x-0 sm:space-x-2 p-1 w-full ">
                    <div class="sm:w-1/2">
                        <x-label class="text-lg" for="name">Nombre</x-label>
                        <x-input class="w-full" type="text" placeholder="Ingrese el nombre" name='name' id="name"
                            value="{{ old('name', request('name')) }}" required />
                        <x-input-error for="name" />
                    </div>
                    <div class="sm:w-1/2">
                        <x-label class="text-lg" for="lastname">Apellido</x-label>
                        <x-input class="w-full" type="text" placeholder="Ingrese el apellido" name='lastname'
                            id="lastname" value="{{ old('lastname', request('lastname')) }}" required />
                        <x-input-error for="lastname" />
                    </div>
                </div>

                <div class="sm:flex  space-y-2 sm:space-y-0 space-x-0 sm:space-x-2  p-1 w-full ">
                    <div class="sm:w-1/2  id=" divCareer">
                        <x-label class="text-lg" for="career"> Carrera </x-label>
                        <x-select name="career_id" id="career">
                            @foreach ($careers as $career)
                                <option value="{{ $career->id }}"
                                    {{ $career->id == request('career_id') ? 'selected' : '' }}>{{ $career->name }}
                                </option>
                            @endforeach
                        </x-select>
                    </div>
                    <div class="sm:w-1/2">
                        <x-label class="text-lg" for="birthday">Fecha de Nacimiento</x-label>
                        <x-input class="w-full" type="date" name='birthday' id="birthday"
                            value="{{ old('birthday', request('birthday')) }}" required />
                        <x-input-error for="birthday" />
                    </div>
                </div>
                <div class="sm:flex  space-y-2 sm:space-y-0 space-x-0 sm:space-x-2  p-1 w-full ">
                    <div class="sm:w-1/2  id=" divCareer">
                        <x-label class="text-lg" for="email"> Correo Eletrónico </x-label>
                        <x-input type='email' id="email" name="email" placeholder="Ingrese su email" required></x-input>
                    </div>
                    <div class="sm:w-1/2  id=" divCareer">
                        <x-label class="text-lg" for="phone"> No. Teléfono </x-label>
                        <x-input type='tel' id="phone" name="phone" placeholder="Ingrese su num de teléfono" required></x-input>
                    </div>
                </div>
                <div class="flex justify-end">
                    <x-button class=" w-full flex justify-center bg-gray-900 text-lg my-2 font-bold hover:bg-gray-700 ">
                        <span class="hover:text-gray-400">Solicitar admisión</span>
                    </x-button>
                </div>
            </div>

        </form>

    </div>
</main>

</html>
