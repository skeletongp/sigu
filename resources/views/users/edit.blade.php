<x-app>
    <div class="sm:w-1/2 mx-auto bg-white p-2 sm:p-8 flex flex-col items-end">
        <div class=" w-full">
            <h1 class="text-lg font-bold text-center mt-2 mb-4">Editar Datos de Usuario</h1>
        </div>
        <div class="w-full">
            <x-form-user :careers="$careers" :id="$user->id" method="put" :action="route('users.update', $user)" ></x-form-user>
        </div>
        <x-button type="submit" form="{{$user->id}}" class="bg-main-100 my-3">
            Actualizar
        </x-button>
    </div>
</x-app>