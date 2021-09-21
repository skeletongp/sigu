<x-app>
    <div class="bg-white rounded-xl max-w-2xl mx-auto px-4 py-8 flex flex-col items-end">
        <h1 class="text-center font-bold uppercase mb-4 w-full">Registro de usuario</h1>
        <div class="w-full">
            <x-form-user :careers="$careers" id="formNew" method="post" :action="route('users.store')" ></x-form-user>
        </div>
        <x-button type="submit" form="formNew" class="bg-main-100 my-3">
            Guardar
        </x-button>
    </div>
</x-app>
