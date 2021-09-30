<div class="container mx-auto px-4 sm:px-8 max-w-xl">

    <div
        class="bg-blue-300 text-black dark:text-gray-100 dark:bg-gray-900 w-max px-2 py-1 h-8 flex flex-col justify-center items-center rounded-full ">
        <a href="{{ route('sections.create') }}">
            <span class="fas fa-plus"></span> Nueva Sección
        </a>
    </div>
    @if ($subjects->count() && $sections->count())
        <div class="py-8">
            <h1 class="text-center uppercase font-bold">Añadir asignatura a sección</h1>
            <form action="{{route('sections.select')}}" method="POST">
                @csrf
                <div class="xl:flex xl:space-x-4">
                    <div class="w-full xl:w-1/2 my-4">
                        <x-label for="subject" class="mb-2">Asignatura</x-label>
                        <x-select id="subject" name="subject_id" required>
                            <option value="">Seleccione una asignatura</option>
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                            @endforeach
                        </x-select>
                    </div>
                    <div class="w-full xl:w-1/2 my-4">
                        <x-label for="section" class="mb-2">Sección</x-label>
                        <x-select id="section" name="section_id" required>
                            <option value="">Seleccione una Sección</option>
                            @foreach ($sections as $section)
                                <option value="{{ $section->id }}">{{ $section->name }}</option>
                            @endforeach
                        </x-select>
                    </div>
                </div>
                <div class="w-full my-4">
                    <x-label for="teacher" class="mb-2">Docente</x-label>
                    <x-select id="teacher" name="user_id" required>
                        <option value="">Seleccione un docente</option>
                        @foreach ($teachers as $teacher)
                            <option value="{{ $teacher->id }}">{{ $teacher->fullname }}</option>
                        @endforeach
                    </x-select>
                </div>
                <div class="flex space-x-2 w-full">
                    <div class="w-1/2 my-4">
                        <x-label for="subject" class="mb-2">Desde</x-label>
                        <x-input type="time" name="start" placeholder="Hora de Inicio" required></x-input>
                    </div>
                    <div class="w-1/2 my-4">
                        <x-label for="subject" class="mb-2">Hasta</x-label>
                        <x-input type="time" name="end" placeholder="Hora de Inicio" required></x-input>
                    </div>
                </div>
                <div class="flex space-x-2 w-full">
                    <div class="w-1/2 my-4">
                        <x-label for="day" class="mb-2">Día</x-label>
                        <x-select name="day">
                            <option value="">Día de clases</option>
                            @foreach ($days as $day)
                                <option value="{{$day}}">{{$day}}</option>
                            @endforeach
                        </x-select>
                    </div>
                    <div class="w-1/2 my-4">
                        <x-label for="subject" class="mb-2">Cupos</x-label>
                        <x-input type="number" name="quota" placeholder="Cuota" min="10" max="30" value="30" required></x-input>
                    </div>
                </div>
               
                <div class=" flex justify-end">
                    <x-button>Añadir</x-button>
                </div>
            </form>
        </div>
    @else
        <h1 class="my-4 text-center uppercase text-lg">
            No hay secciones o asignaturas para trabajar
        </h1>
    @endif
</div>
