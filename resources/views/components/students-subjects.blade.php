<div>
    
    <ul class="grid grid-cols-1 sm:grid-cols-2 mx-auto   gap-3  ">

        @foreach ($courses as $course)
            <div class="p-4  rounded-xl">
                <x-list title="{{ $course->subject->name }} "
                    image="https://cdn3.iconfinder.com/data/icons/ballicons-reloaded-vol-1/512/icon-13-512.png"
                    url="{{ $user->rol()=='teacher'?route('subjects.myteachstudents', $course->subject):route('subjects.show',$course->subject) }}"
                    subtitle="{{ $course->subject->code }}-  {{$course->nf?'Nota: '.$course->nf:''}}"
                    text=""
                    rDelete="{{ route('users.unselect', [$course->subject, $user]) }}"
                    rEdit="{{ route('subjects.edit', $course->subject) }}">
                </x-list>
            </div>
        @endforeach
    </ul>
</div>