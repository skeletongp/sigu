<!DOCTYPE html>
<html lang="es">
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

</head>

<body class="font-sans antialiased h-screen bg-white bg-cover bg-no-repeat bg-fixed"
    style="background-image: url({{ isset($bg) ? $bg : 'https://p0.pxfuel.com/preview/187/633/72/5be997aec83a2.jpg' }})">
    @php
        date_default_timezone_set('America/Santo_Domingo');
        // Unix
        setlocale(LC_ALL, 'es_ES.UTF-8');
        
    @endphp
    <div class=" mx-auto " id="body">

        @if (Auth::check())
            <x-menu />
        @endif

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow fixed w-full top-0 left-0 " style="z-index: 60">
                <div class="mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                    <div class="lg:ml-56 w-full uppercase">
                        {{ $header }}
                    </div>
                    {{-- Funciones del perfil --}}

                </div>

            </header>
        @endif

        <!-- Cuerpo de la página -->
        <main class="lg:pt-16" style=" max-height: 100vh !important; min-height:100vh " id=" main">

                <div class=" w-screen py-9 lg:py-0 sm:px-6 flex items-center overflow-y-auto "
                    >
                    <div class=" w-screen  sm:rounded-lg  flex items-start space-x-3  mr-auto py-4 relative">
                        <div class="w-full bg-white" style="min-height: 80vh">
                            {{ $slot }}
                        </div>
                        @if (isset($lateral))
                            <div class="hidden fixed right-2  rounded-xl  bg-white shadow-xl xl:flex w-72 max-h-screen"
                                style="min-height: 60vh;  margin-bottom:20vh" id="lateral">

                                {{ $lateral }}
                            </div>
                            <div class="fixed bottom-4 left-3 z-40  cursor-pointer hover:text-blue-400"
                                id="rowLeft">
                                <div class=" w-12 h-12 rounded-full flex items-center justify-center bg-white">
                                    <span class=" fas fa-ellipsis-h text-4xl  "></span>
                                </div>

                            </div>

                        @endif
                    </div>
                </div>
        </main>
    </div>

    @stack('modals')
    @stack('js')
    {{-- @livewireScripts --}}
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>

</body>
<footer class="bg-main-100 fixed bottom-0 w-full h-10 z-20 flex items-center">
    <div class="flex justify-between px-8 max-w-7xl w-full mx-auto items-center text-white font-bold">
        <span>@Ismael Contreras, 2021</span>
        <span>SIGU</span>
    </div>
</footer>
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
