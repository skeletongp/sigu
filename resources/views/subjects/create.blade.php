<x-app>
    <div
        class="bg-white dark:bg-gray-800 rounded-xl max-w-2xl mx-auto px-4 py-8 flex flex-col items-end self-center w-full
    ">
        <h1 class="text-center font-bold uppercase mb-4 w-full">Registro de asignatura</h1>
        <div class="w-full">
            <div class=" bottom-2 right-2 xl:right-5 xl:bottom-5 z-50">
                <a href="{{ route('subjects.index') }}">
                    <div
                        class="flex space-x-3  text-black dark:text-white rounded-full items-center justify-start cursor-pointer hover:bg-gray-900 h-5  w-9 px-3 py-1">
                        <span class="fas fa-angle-left xl:text-lg"></span>

                    </div>
                </a>    
            </div>
            <form id="formNew" action="{{ route('subjects.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="flex flex-col space-y-4">
                    <div class=" sm:flex space-y-2 sm:space-y-0 space-x-0 sm:space-x-3 p-1 w-full">
                        <div class="sm:w-4/6">
                            <x-label class="text-lg" for="name">Nombre</x-label>
                            <x-input class="w-full" type="text" placeholder="Nombre de la carrera" name='name'
                                id="name" value="{{ old('name', request('name')) }}" />
                            <x-input-error for="name" />
                        </div>
                        <div class="sm:w-2/6">
                            <x-label class="text-lg" for="code">Código</x-label>
                            <x-input class="w-full" type="text" placeholder="Código" name='code' id="code"
                                value="{{ old('code', request('code')) }}" maxlength="4" />
                            <x-input-error for="code" />
                        </div>
                    </div>
                    <div class=" sm:flex space-y-2 sm:space-y-0 space-x-0 sm:space-x-3 p-1 w-full">
                        <div class="sm:w-4/6">
                            <x-label class="text-lg" for="name">Prerrequisito</x-label>
                            <x-select name="preq">
                                <option value="">Ninguno</option>
                                @foreach ($subjects as $subject)
                                    <option value="{{$subject->id}}">{{$subject->name}}</option>
                                @endforeach
                            </x-select>
                        </div>
                        <div class="sm:w-2/6">
                            <x-label class="text-lg" for="credits">Créditos</x-label>
                            <x-select name="credits">
                                @for ($i = 1; $i < 6; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </x-select>

                        </div>
                    </div>
                </div>

            </form>

        </div>
        <x-button type="submit" form="formNew" class="bg-main-100 my-3">
            Guardar
        </x-button>
    </div>
</x-app>
