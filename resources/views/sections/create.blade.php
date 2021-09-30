<x-app>

    <div class="container mx-auto px-4 sm:px-8 max-w-xl">
        
       
            <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                <form action="{{route('sections.store')}}" method="POST">
                    @csrf
                    <div class="flex space-x-3 justify-between p-4">
                        <div class="w-5/6">
                            <x-label>Nombre</x-label>
                            <x-input name="name" type='text'  placeholder="Nombre de la sección"></x-input>
                            <x-input-error for="name"></x-input-error>
                        </div>
                        <div class="w-1/6">
                            <x-label>Código</x-label>
                            <x-input name="code" type='text'  placeholder="Código"></x-input>
                            <x-input-error for="code"></x-input-error>
                        </div>
                    </div>
                   <div class=" my-2 flex justify-end">
                    <x-button class="bg-gray-600">Guardar</x-button>
                   </div>
                </form>

                </div>
            </div>
        </div>

</x-app>
