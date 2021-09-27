<x-app>
    <div
        class="bg-white dark:bg-gray-800 rounded-xl max-w-2xl mx-auto px-4 py-10  flex flex-col items-end self-center w-full
    ">
        <h1 class="text-center font-bold uppercase mb-4 w-full">Pensum de {{$career->name}}</h1>
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
            Guardar
        </x-button>
        @endif

    </div>
    <hr>
    @php
        $trimsubjects=$career->trimestersubjects->groupby('pivot.trimester');
    @endphp
    <div class="max-w-4xl mx-4 sm:mx-auto my-3 grid grid-cols-1 md:grid-cols-2 grid-flow-row gap-6">
        @foreach ($trimsubjects as $trimester)

            <x-trimester :trimester="$trimester[0]->pivot->trimester.'º Trimestre'">
                @foreach ($trimester as $subject)
                    <div class="text-gray-600 dark:text-gray-200 text-sm">
                        <li class="flex justify-between uppercase"> 
                            <span>{{ $subject->name }}</span>
                            <span>{{ $subject->code }} / {{$subject->credits}} Cr.</span>
                        </li>
                    </div>
                @endforeach
                <hr>
                    <div class="flex justify-end mt-1">
                        <span>Total {{$trimester->sum('credits')}} Crds.</span>
                    </div>
            </x-trimester>

        @endforeach
    </div>
</x-app>
