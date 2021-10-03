<x-app>
    <div class="max-w-4xl mx-auto">
        <h1 class="text-center font-bold text-xl xl:text-3xl uppercase my-3">Estudiantes Inscritos</h1>
        <div class=" flex flex-col  w-full items-center justify-center   rounded-lg shadow p-3">
            @if ($students && $students->count())
                <ul
                    class="grid grid-cols-1 {{ $students->count() > 2 ? 'xl:grid-cols-3' : ($students->count() > 1 ? 'sm:grid-cols-2' : '') }} mx-auto  gap-3  ">

                    @foreach ($students as $student)
                        @php
                            $status = ['coursing' => ['En Curso', 'text-yellow-400'], 'aproved' => ['Aprobada','text-green-400'], 'failed' => ['Reprobada','text-red-400']];
                            $course = $student->courses->where('course_id', '=', $section->id)->first();
                        @endphp
                        <div class="pt-1 px-1 relative">
                            <div class="flex justify-between space-x-1 w-full px-2">
                                <div class="flex space-x-2 items-center">
                                    <span></span>
                                    <span class="{{ $status[$course->status][1] }}">{{ $status[$course->status][0] }}</span>
                                </div>
                                @if ($status[$course->status][0]=='coursing')
                                <a href="{{ route('subjects.editnotes', ['user_id' => $student->id, 'course_id' => $section->id]) }}"
                                    title="Calificar" class="flex space-x-2 items-center">
                                    <span class="fas fa-list text-green-400"></span>
                                    <span>Calificar</span>
                                </a>
                                @else
                                <div class="w-20 h-20 rounded-full absolute right-2  flex items-center justify-center p-4 dark:bg-gray-700">
                                    <span class="font-bold text-xl {{$course->status=='aproved'?'text-green-400':'text-red-400'}}">{{$course->nf}}</span>
                                </div>
                                @endif

                            </div>
                            <x-list title="{{ $student->fullname }}" image="{{ $student->photo }}"
                                url="{{ route('users.show', $student) }}" subtitle="{!! $student->id !!}"
                                text="nada" rDelete="{{ route('users.destroy', $student) }}"
                                rEdit="{{ route('users.edit', $student) }}">
                            </x-list>
                        </div>
                    @endforeach
                    </i>
                </ul>
            @else
                <h1 class="my-4 text-xl text-black dark:text-gray-300">Sin estudiantes registrados</h1>
            @endif
        </div>

    </div>
</x-app>
