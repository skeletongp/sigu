@php
$roles = ['admin' => 'Admin', 'support' => 'Soporte', 'teacher' => 'Docente', 'student' => 'Estudiante'];
@endphp
<x-app>
    <div class="bg-white p-4 max-w-xl mx-auto relative dark:bg-gray-800">
        @hasanyrole('admin')
        <div class=" absolute top-3 right-3">
            <a href="{{ route('users.edit', $user) }}"><span class="fas fa-pen text-blue-400"></span></a>
        </div>
        @endhasanyrole
        <div class=" absolute top-3 left-3">
            <a class="text-blue-400 flex items-center space-x-2"
                href="{{ route('users.index', ['r' => $user->rol()]) }}"><span class="fas fa-angle-left "></span> <span
                    class="text-sm font-semibold">Regregar</span></a>
        </div>
        <div class="sm:grid grid-cols-6 gap-6 h-72 sm:h-60 ">
            <div class="sm:col-span-2 flex flex-col items-center justify-center">
                <div class="w-48 h-44 rounded-full bg-cover bg-center bg-no-repeat"
                    style="background-image: url({{ $user->photo }})"></div>
            </div>
            <div class="sm:col-span-4">
                <div class="w-full h-full flex flex-col justify-center items-center">
                    <h1 class="sm:text-3xl font-bold">{{ $user->fullname }}</h1>
                    <h2>{{ $user->email }}</h2>
                    <h2 class=" font-bold uppercase text-lg mt-2">{{ $user->role() }}</h2>
                    <h2>{{ optional($user->career)->name }}</h2>
                    <div class="flex space-x-3 uppercase text-sm font-bold">
                        @if ($user->teach_students->count())
                            <h2>{{ $user->teach_students->groupby('id')->count() }} Estudiantes</h2>
                        @endif

                    </div>


                </div>
            </div>
        </div>


    </div>
    <div class="max-w-4xl mx-auto">
        <x-students-subjects :id="$user->id" :user="$user" :trim="$trim"></x-students-subjects>
    </div>
    <div class="max-w-4xl mx-auto">
        @if ($user->teach_subjects->count())
            <h2>{{ $user->teach_sections->count() }} Secciones</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 mx-auto   gap-3">
                @foreach ($user->teach_sections as $subj)
                    
                    <x-list title="{{ $subj->subject->code . '-' . $subj->subject->name }}" :key="$subj->id"
                        image="https://cdn3.iconfinder.com/data/icons/ballicons-reloaded-vol-1/512/icon-13-512.png"
                        url="{{ route('subjects.show', $subj->subject) }}"
                        subtitle="{{ $subj->section->code . ': ' . $subj->day . '->' . $subj->from . '-' . $subj->finish }}"
                        text="nada" rDelete="{{ route('subjects.destroy', $subj) }}"
                        rEdit="{{ route('subjects.edit', $subj) }}">
                    </x-list>

                @endforeach
            </div>
        @endif
    </div>

    <x-slot name="lateral">
    </x-slot>

    </div>
</x-app>
