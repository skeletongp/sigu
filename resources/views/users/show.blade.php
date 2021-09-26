@php
$roles = ['admin' => 'Admin', 'support' => 'Soporte', 'teacher' => 'Docente', 'student' => 'Estudiante'];
@endphp
<x-app>
    <div class="bg-white p-4 lg:max-w-3xl mx-auto relative">
        <div class="sm:grid grid-cols-6 gap-6 h-72 sm:h-60 ">
            <div class="sm:col-span-2 flex flex-col items-center justify-center">
                <div class="w-48 h-48 rounded-full bg-cover bg-center bg-no-repeat"
                    style="background-image: url({{ $user->photo }})"></div>
            </div>
            <div class="sm:col-span-4">
                <div class="w-full h-full flex flex-col justify-center items-center">
                    <h1 class="sm:text-3xl font-bold">{{ $user->fullname }}</h1>
                    <h2>{{ $user->email }}</h2>
                    <h2 class=" font-bold uppercase">{{ $roles[$user->getRoleNames()[0]] }}</h2>
                    <h2>{{ optional($user->career)->name }}</h2>


                </div>
            </div>
        </div>
        @if ($user->getRoleNames()[0] == 'student')
            <div class="w-full">
                @if ($career_subjects)

                <form action="{{ route('users.select', $user) }}" method="POST">
                    @csrf
                    @method('put')
                    <x-label class="text-lg" for="careers">Seleccionar asignaturas</x-label>
                        <x-select multiple name="subjects[]">
                            @foreach ($career_subjects as $subject)
                                @if (!$user->subjects->contains($subject))
                                    <option value="{{ $subject->id }}"
                                        {{ $user->subjects->contains($subject) ? 'selected' : '' }}>
                                        {{ $subject->name }}</option>
                                @endif
                            @endforeach

                        </x-select>
                    <div class="flex justify-end"> <button
                            class="text-black px-2 py-1 bg-gray-300 m-1 rounded-xl ml-auto">Guardar Selección</button>
                    </div>
                </form>
                @endif

            </div>
            <x-students-subjects :id="$user->id" :user="$user"></x-students-subjects>

        @endif
        @hasanyrole('admin')
        <div class=" absolute top-3 left-3">
            <a href="{{ route('users.edit', $user) }}"><span class="fas fa-pen text-blue-400"></span></a>
        </div>
        @endhasanyrole
        <x-slot name="lateral">
        </x-slot>

    </div>
</x-app>
