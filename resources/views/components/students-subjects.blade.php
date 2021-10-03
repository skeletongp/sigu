<div>
    
    <ul class="grid grid-cols-1 sm:grid-cols-2 mx-auto   gap-3  ">

        @foreach ($subjects as $subject)
            <div class="p-4  rounded-xl">
                <x-list title="{{ $subject->name }}"
                    image="https://cdn3.iconfinder.com/data/icons/ballicons-reloaded-vol-1/512/icon-13-512.png"
                    url="{{ $user->rol()=='teacher'?route('subjects.myteachstudents', $subject):route('subjects.show',$subject) }}"
                    subtitle="{{ $subject->code }}- {{ $subject->students->count() }} estudiantes"
                    text="nada"
                    rDelete="{{ route('users.unselect', [$subject, $user]) }}"
                    rEdit="{{ route('subjects.edit', $subject) }}">
                </x-list>
            </div>
        @endforeach
    </ul>
</div>