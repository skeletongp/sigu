<x-app>
    @php
    $days = ['LUN', 'MAR', 'MIER', 'JUE', 'VIE', 'SAB'];
@endphp
    <div class="xl:flex xl:items-start xl:space-x-3 max-w-7xl mx-auto  dark:shadow-none">
        @hasanyrole('admin|support')
        <x-section-form :subjects="$subjects" :sections="$sections" :teachers="$teachers" :days="$days" :sect="$sect" />
        @endhasanyrole
    </div>
</x-app>