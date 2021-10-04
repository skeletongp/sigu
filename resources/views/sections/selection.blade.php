<x-app>
    @php
        $days = ['LUN', 'MAR', 'MIER', 'JUE', 'VIE', 'SAB'];
        $user=Auth::user();
        $career=optional(($user->career));
    @endphp
    <h1 class="text-center uppercase font-bold text-xl mb-4">{{ optional($user->career)->name }}</h1>
    <hr>
    @if ($career->subjects && $career->subjects->count()|| $user->rol()!='student')
        <div class="xl:flex xl:items-start xl:space-x-3 max-w-7xl mx-auto  dark:shadow-none my-4">
            @hasanyrole('admin|support')
            <x-section-form :subjects="$subjects" :sections="$sections" :teachers="$teachers" :days="$days"
                :sect="null" />
            @endhasanyrole
            @hasanyrole('student')
            @if (Auth::user()->subjects->count())
                <div class="max-w-4xl w-full mx-2 xl:mx-auto">

                    @livewire('section-table',['having'=>true])

                </div>
            @endif

            @endhasanyrole

            @if (Auth::user()->role() != 'student' || Auth::user()->subjects->count() < 4)
                <div class="max-w-4xl mx-4 xl:mx-auto w-full">
                    @livewire('section-table')
                </div>
            @endif
        </div>
    @else
        <h1 class="my-2 text-center font-bold uppercase text-xl xl:text-2xl">No hay secciones para esta carrera</h1>
    @endif
</x-app>
