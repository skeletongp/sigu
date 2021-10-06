<x-app>
    <div class="max-w-xl {{ $subjects->count() > 1 ? 'max-w-4xl' : '' }} mx-auto">
        @if ($subjects->count())
            <h1 class="text-center font-bold text-xl xl:text-3xl uppercase my-3">Mis Secciones</h1>
            <div class="max-w-4xl mx-auto">
                @php
                    $user=Auth::user();
                @endphp
                @if ($user->teach_subjects->count())
                    <h2>{{ $user->teach_sections->count() }} Secciones</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 mx-auto   gap-3">
                        @foreach ($user->teach_sections as $subj)
                            <x-list title="{{ $subj->subject->code . '-' . $subj->subject->name }}" :key="$subj->id"
                                image="https://cdn3.iconfinder.com/data/icons/ballicons-reloaded-vol-1/512/icon-13-512.png"
                                url="{{ route('subjects.myteachstudents', $subj->id) }}"
                                subtitle="{{ $subj->section->code . ': ' . $subj->day . '->' . $subj->from . '-' . $subj->finish }}"
                                text="nada" rDelete="{{ route('subjects.destroy', $subj) }}"
                                rEdit="{{ route('subjects.edit', $subj) }}">
                            </x-list>
                        @endforeach
                    </div>
                @endif
            </div>
           
        @else
            <h1 class="uppercase text-center font-bold text-xl xl:text-4xl">No has seleccionado ninguna asignatura</h1>
        @endif


    </div>
</x-app>
