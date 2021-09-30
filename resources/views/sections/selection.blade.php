<x-app>
    @php
        $days = ['LUN', 'MAR', 'MIER', 'JUE', 'VIE', 'SAB'];
    @endphp
    <h1 class="text-center uppercase font-bold text-xl mb-4">{{optional(Auth::user()->career)->name}}</h1>
    <hr>
    <div class="xl:flex xl:items-start xl:space-x-3 max-w-7xl mx-auto  dark:shadow-none">
        @hasanyrole('admin|support')
        <x-section-form :subjects="$subjects" :sections="$sections" :teachers="$teachers" :days="$days" />
        @endhasanyrole
        @hasanyrole('student')
        @if (Auth::user()->subjects->count())
        <div class="max-w-4xl mx-auto">
            
            @livewire('section-table',['having'=>true])

        </div>
        @endif
      
        @endhasanyrole

        <div class="max-w-4xl mx-auto">
            
            @livewire('section-table')

        </div>
    </div>
</x-app>
