<x-app>
    <div class="max-w-5xl mx-auto">
        <h1 class="text-center font-bold text-xl xl:text-3xl uppercase my-3">Estudiantes Inscritos</h1>
        <form action="">

           <div class="px-4 max-w-md mx-auto">
            <x-label>Buscar</x-label>
            <x-input type="search" placeholder="Buscar estudiante" name="q" value="{{old('q', request('q'))}}">
            <x-slot name="icon">
                <button>
                    <span class="fas fa-search text-blue-400"></span>
                </button>
            </x-slot>
            </x-input>
           </div>

        </form>
        <div class=" flex flex-col  w-full items-center justify-center   rounded-lg shadow p-3">
            @if ($students && $students->count())
                <ul
                    class="grid grid-cols-1 {{ $students->count() > 2 ? 'xl:grid-cols-3' : ($students->count() > 1 ? 'sm:grid-cols-2' : '') }} mx-auto  gap-8  ">

                    @foreach ($students as $student)
                    {{-- course= subject_user
                        section=section_subject_user --}}
                        @php
                            $status = ['coursing' => ['En Curso', 'text-yellow-600 dark:text-yellow-400'], 'aproved' => ['Aprobada', 'text-green-400'], 'failed' => ['Reprobada', 'text-red-400']];
                            $course = $student->courses->where('course_id', '=', $section->id)
                            ->where('subject_id','=',$section->subject_id)->first();
                        @endphp
                        <div class="pt-1 relative border border-gray-200 dark:border-gray-700 px-2 py-1">
                            <div class="flex justify-between space-x-1 w-full px-2">
                                <div class="flex space-x-2 items-center">
                                    <span></span>
                                    <span
                                        class="{{ $status[$course->status][1] }}">{{ $status[$course->status][0] }}</span>
                                </div>
                                @if ($course->status == 'coursing')
                                    <a href="{{ route('subjects.editnotes', ['user_id' => $student->id, 'course_id' => $section->id]) }}"
                                        title="Calificar" class="flex space-x-2 items-center">
                                        <span class="fas fa-list text-green-400"></span>
                                        <span>Calificar</span>
                                    </a>
                                @else
                                    <div
                                        class="w-20 h-20 rounded-full absolute right-2  flex items-center justify-center p-4 dark:bg-gray-700">
                                        <span
                                            class="font-bold text-xl {{ $course->status == 'aproved' ? 'text-green-400' : 'text-red-400' }}">{{ $course->nf }}</span>
                                    </div>
                                @endif

                            </div>
                            <x-list title="{{ $student->lastname.', '.$student->name }}" image="{{ $student->photo }}"
                                url="{{ route('users.show', $student) }}" subtitle="{!! $student->id !!}"
                                text="nada" rDelete="{{ route('users.destroy', $student) }}"
                                rEdit="{{ route('users.edit', $student) }}">
                            </x-list>
                            @role('teacher')
                            <div class="flex justify-between text-sm">
                                <div><span class="font-bold">AP:</span> {{ round($course->ap) }}</div>
                                <div><span class="font-bold">POE</span> {{ round($course->poe) }}</div>
                                <div><span class="font-bold">PF:</span> {{ round($course->pf) }}</div>
                                <div><span class="font-bold">EF:</span> {{ round($course->ef) }}</div>
                                <div><span class="font-bold">NF:</span> {{ round($course->nf) }}</div>
                            </div>
                            @endrole
                        </div>
                    @endforeach
                    </i>
                </ul>
                <div class="my-3 w-full">
                    {{$students->links()}}
                </div>
            @else
                <h1 class="my-4 text-xl text-black dark:text-gray-300">No se hallaron resultados</h1>
            @endif
        </div>

    </div>
</x-app>
