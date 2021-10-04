<x-app>
    <div class="max-w-xl {{$subjects->count()>1?'max-w-4xl':''}} mx-auto">
        @if ($subjects->count())
        <h1 class="text-center font-bold text-xl xl:text-3xl uppercase my-3">Mis Secciones</h1>
                <ul class="grid grid-cols-1 {{$subjects->count()>1?'sm:grid-cols-2 ':''}} mx-auto  gap-3  ">
                    @foreach ($subjects as $subject)
                        <div class="pt-1 px-1">
                            <x-list title="{!! $subject->section->code .'-'. $subject->day.'-'.$subject->subject->code.
                            '<br>'.$subject->subject->name !!}" image="https://res.cloudinary.com/dboafhu31/image/upload/v1624658165/Download-Computer-512_fp1r3y.png"
                                url="{{ route('subjects.myteachstudents', $subject) }}"
                                subtitle="{!!$subject->day.' '.$subject->from .'-'. $subject->finish !!}" text="nada"
                                rDelete=""
                                rEdit="">
                            </x-list>
                        </div>
                    @endforeach
                    </i>
                </ul>
            @else
            <h1 class="uppercase text-center font-bold text-xl xl:text-4xl">No has seleccionado ninguna asignatura</h1>
            @endif
           
        
    </div>
</x-app>