<x-app>
    <div class="max-w-2xl mx-auto shadow-xl ">
        <h1 class="text-center font-bold text-xl uppercase">
            Calificaciones de {{$section->student->fullname}}
        </h1>
        <div>
            <form action="{{ route('subjects.calificate', ['section' => $section]) }}" method="POST">
                @method('put')
                @csrf
                <div class="flex flex-col items-end space-x-2  p-4 w-full">
                    <div class="grid grid-cols-2 grid-rows-3 w-full gap-6 items-start ">
                        <div class="">
                            <x-label for=" ap">Act. Prácticas</x-label>
                            <x-input name="ap" id="ap" type="number" min="0" max="25" placeholder="Rango de 0-25"
                                 value="{{old('ap',$section->ap)}}">
                            </x-input>
                            <x-input-error for="ap"></x-input-error>
                        </div>
                        <div class="">
                            <x-label for=" poe">Participación O/E</x-label>
                            <x-input name="poe" id="poe" type="number" min="0" max="10" placeholder="Rango de 0-10"
                                 value="{{old('poe',$section->poe)}}">
                            </x-input>
                            <x-input-error for="poe"></x-input-error>
                        </div>
                        <div class="">
                            <x-label for=" pf">Práctica Final</x-label>
                            <x-input name="pf" id="pf" type="number" min="0" max="15" placeholder="Rango de 0-15"
                                 value="{{old('pf',$section->pf)}}">
                            </x-input>
                            <x-input-error for="pf"></x-input-error>
                        </div>
                        <div class="">
                            <x-label for=" ef">Prueba Final</x-label>
                            <x-input name="ef" id="ef" type="number" max="50" placeholder="Rango de 0-50" value="{{old('ef',$section->ef)}}">
                            </x-input>
                            <x-input-error for="ef"></x-input-error>
                        </div>
                        <div >
                            <x-label>Condición</x-label>
                            <x-select name="condition">
                                <option value="false">Provisional</option>
                                <option value="true">Final</option>
                            </x-select>
                        </div>
                        <div class="flex justify-end ">
                            <x-button class="bg-gray-600">Calificar</x-button>
                        </div>
                    </div>
                    
                </div>
            </form>
        </div>
    </div>
</x-app>
