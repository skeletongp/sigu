<!DOCTYPE html>
<html lang="es" class="{{ Auth::user() ? (Auth::user()->darkmode == 'Y' ? 'dark' : '') : '' }}">
@props(['bg'])

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ request('q') ? 'Search: ' . request('q') : config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="//apps.bdimg.com/libs/jqueryui/1.10.4/css/jquery-ui.min.css">
    {{-- @livewireStyles --}}

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src="{{ mix('js/custom.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"
        integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
    <script src="//apps.bdimg.com/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.4.1/dist/chart.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    @livewireStyles
</head>

<body class="font-sans antialiased  bg-white dark:bg-gray-900 dark:text-white p-0  bg-cover bg-no-repeat bg-fixed absolute"
    style="background-image: url({{ isset($bg) ? $bg : '' }})">
    @php
        date_default_timezone_set('America/Santo_Domingo');
        setlocale(LC_ALL, 'es_ES.UTF-8');
        
    @endphp <header class="sticky top-0 z-50">
        @if (Auth::user())
            <x-menu></x-menu>
        @endif
    </header>
    <div class="h-screen  w-screen flex flex-col justify-center">

        <main class="relative h-full overflow-hidden  flex flex-col justify-center py-16 xl:pb-24 bg-white dark:bg-gray-800" >
           <div class=" overflow-y-auto">
            {{ $slot }}
           </div>
        </main>

    </div>
    <footer class="fixed bottom-0 z-50 bg-gray-100 dark:bg-gray-700 w-full">
        @if (Auth::user())
        <x-footer></x-footer>
        @endif
    </footer>

    @stack('modals')
    @stack('js')
    {{-- @livewireScripts --}}
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    @livewireScripts
</body>

<style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        /* display: none; <- Crashes Chrome on hover */
        -webkit-appearance: none;
        margin: 0;
        /* <-- Apparently some margin are still there even though it's hidden */
    }

</style>

</html>
