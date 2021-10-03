<div>
    <!-- Button trigger modal -->
    <button wire:click="toggle">

        <span >Abrir selección</span>
    </button>
    <!-- Modal -->
    <div class="{{$open?'flex':'hidden'}} overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center"
        id="modal-example-small">
        <div class="relative w-auto my-6 mx-auto max-w-xl">
            <!--content-->
            <div
                class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white dark:bg-gray-800 outline-none focus:outline-none">
                <!--header-->
                <div class="flex items-start justify-between p-5 border-b border-solid border-gray-200 rounded-t">
                    <h3 class="text-xl font-bold">
                       Abrir selección
                    </h3>
                    <button
                        class="p-1 ml-auto bg-transparent border-0 text-gray-300 float-right text-3xl leading-none font-semibold outline-none focus:outline-none"
                        wire:click="toggle">
                        <span class="bg-transparent h-6 w-6 text-2xl block outline-none focus:outline-none">
                            <i class="fas fa-times text-red-400"></i>
                        </span>
                    </button>
                </div>
                <!--body-->
                <div class="relative p-6 flex-auto w-full">
                    <div >
                        <div class="w-full my-2">
                            <x-label for="career_id">Carrera</x-label>
                            <x-input readonly value="{{$career->name}}"></x-input>
                        </div>
                        <div class="flex items-center space-x-3 my-2">
                            <div class="w-full">
                                <x-label for="start">F. de Inicio</x-label>
                                <x-input type="date" name="start" id="start" wire:model="start"></x-input>
                                <x-input-error for="start"></x-input-error>
                            </div>
                            <div class="w-full">
                                <x-label for="end">F. de Cierre</x-label>
                                <x-input type="date" name="end" id="end" wire:model="end"></x-input>
                                <x-input-error for="end"></x-input-error>
                            </div>
                        </div>
                    </div>
                </div>
                <!--footer-->
                <div class="flex items-center justify-end p-6 border-t border-solid border-gray-200 rounded-b" >
                        <x-button class="text-base" wire:click="opendate">Aceptar</x-button>
                </div>
            </div>
        </div>
    </div>
    <div class="{{$open?'flex':'hidden'}} opacity-25 fixed inset-0 z-40 bg-black" id="modal-example-small-backdrop" ></div>
    
</div>
