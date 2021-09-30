<x-app>
    <div
        class="bg-white dark:bg-gray-800 rounded-xl max-w-2xl mx-auto px-4 py-2  flex flex-col items-end self-center w-full
    ">
        <h1 class="text-center font-bold uppercase mb-4 w-full">Pensum de {{ $career->name }}</h1>
        @if ($subjects->count() !== $career->subjects->count())
            <div class="w-full">
                <form id="formNew" action="{{ route('careers.storesubject', $career) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div>
                        <div class=" sm:flex space-y-2 sm:space-y-0 space-x-0 sm:space-x-2 p-1 w-full">
                            <div class="sm:w-5/6">
                                <x-label class="text-lg" for="subject">Nombre</x-label>
                                <x-select name="subject">
                                    @foreach ($subjects as $subject)
                                        @if (!$career->subjects->contains($subject))
                                            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                        @endif
                                    @endforeach
                                </x-select>
                            </div>
                            <div class="sm:w-1/6">
                                <x-label class="text-lg" for="trimester">Trimestre</x-label>
                                <x-select name="trimester">
                                    @for ($i = 1; $i < $career->trimesters + 1; $i++)
                                        <option value="{{ $i }}">{{ $i }}º</option>
                                    @endfor
                                </x-select>
                            </div>
                        </div>
                    </div>

                </form>

            </div>
            <x-button type="submit" form="formNew" class="bg-main-100 my-3">
                Añadir al Pensum
            </x-button>
        @endif

    </div>
    <hr>
    @php
        $trimsubjects = $career->trimestersubjects->groupby('pivot.trimester');
     
    @endphp
    <div class="max-w-7xl mx-4 xl:mx-auto my-3 grid grid-cols-1 md:grid-cols-2 grid-flow-row gap-2">
        @foreach ($trimsubjects as $trimester)

            <x-trimester :trimester="$trimester[0]->pivot->trimester.'º Trimestre'">
                <div class="text-gray-600 dark:text-gray-200 text-sm">
                    <li class="grid grid-cols-8 uppercase mb-2 text-gray-500 dark:text-blue-300 text-left">
                        <span class=" col-span-6">Asignatura</span>
                        <span class=" col-span-1">CR.</span>
                        <span class=" col-span-1">PREQ.</span>
                    </li>
                </div>
                @foreach ($trimester as $subject)
                @php
                       $preq=optional($subject->prerrequisite)->code;
                @endphp
                    <div class="text-gray-600 dark:text-gray-200 text-sm">
                        <li class="grid grid-cols-8 justify-between uppercase mb-2 ">
                            <div class="flex col-span-6">
                                <form action="{{ route('careers.detachsubject', [$career, $subject]) }}"
                                    method="POST">
                                    @csrf
                                    <button onclick="return confirm('¿Eliminar registro?')">
                                        <span class="fas fa-times mr-2 text-red-600"></span>
                                    </button>
                                </form>
                                <span>{{ $subject->name }}</span>
                            </div>
                            <span class="col-span-1">{{ $subject->credits }} Cr.</span>
                            <span class="col-span-1">{{ $preq? $preq:'BACH' }}</span>
                        </li>
                    </div>
                @endforeach
                <hr>
                <div class="flex justify-end mt-1">
                    <span>Total {{ $trimester->sum('credits') }} Crds.</span>
                </div>
            </x-trimester>

        @endforeach
    </div>
</x-app>
