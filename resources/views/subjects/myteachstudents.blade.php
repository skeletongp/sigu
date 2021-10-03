<x-app>
    <div class="max-w-4xl mx-auto">
        <h1 class="text-center font-bold text-xl xl:text-3xl uppercase my-3">Estudiantes Inscritos</h1>
        <div class=" flex flex-col  w-full items-center justify-center   rounded-lg shadow p-3">
            @if ($students && $students->count())
                <ul
                    class="grid grid-cols-1 {{ $students->count() > 2 ? 'xl:grid-cols-3' : ($students->count() > 1 ? 'sm:grid-cols-2' : '') }} mx-auto  gap-3  ">

                    @foreach ($students as $student)
                        <div class="pt-1 px-1">
                                <div class="flex justify-end space-x-1 w-full px-2">
                                   <button title="Calificar" class="flex space-x-2 items-center">
                                       <span class="fas fa-list text-green-400"></span>
                                       <span>Calificar</span>
                                   </button>

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
