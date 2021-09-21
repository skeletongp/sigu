<x-app>
    <div class="bg-white rounded-xl max-w-2xl mx-auto px-4 py-8 flex flex-col items-end">
        <h1 class="text-center font-bold uppercase mb-4 w-full">Registro de carrera</h1>
        <div class="w-full">
            <form id="formNew" action="{{route('careers.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div>
                    <div class=" sm:flex space-y-2 sm:space-y-0 space-x-0 sm:space-x-2 p-1 w-full">
                        <div class="sm:w-2/3">
                            <x-label class="text-lg" for="name">Nombre</x-label>
                            <x-input class="w-full" type="text" placeholder="Nombre de la carrera" name='name' id="name"
                                value="{{ old('name', request('name')) }}" required/>
                            <x-input-error for="name" />
                        </div>
                        <div class="sm:w-1/3">
                            <x-label class="text-lg" for="code">Código</x-label>
                            <x-input class="w-full" type="text" placeholder="Ingrese el código" name='code'
                                id="code" value="{{ old('code', request('code')) }}" required maxlength="4"/>
                            <x-input-error for="code" />
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
