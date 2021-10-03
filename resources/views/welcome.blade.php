<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ mix('css/custom.css') }}">
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }

    </style>
</head>

<body class="antialiase bg-cover bg-center bg-no-repeat bg-fixed font-mono" style="background-image: url(https://p1.pxfuel.com/preview/932/467/825/books-education-school-literature.jpg)">
   <div class="sm:w-1/2 h-screen sm:mx-16  flex flex-col justify-center items-center bg-white bg-opacity-70 sm:bg-opacity-0">
    <h1 class="uppercase text-md w-1/2 sm:w-5/6 sm:text-4xl font-bold text-center my-8 sm:mx-8 flex text-color6 select-none hover:text-blue-800">Bienvenido/a al Sistema Integrado de Gestión
        Universitaria</h1>
        @php
            $roles=["admin"=>["Admin","color1"],"support"=>["Soporte","color2"],"teacher"=>["Docente","color2"], "student"=>["Estudiante",'color1']]
        @endphp
    <div class="relative flex items-top justify-start dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
        <div class="grid grid-cols-2 grid-row-2 w-full mx-8 max-w-6xl gap-8">
          @foreach ($roles as $rol => $text)
          <div class=" flex flex-col items-center justify-center ">
            <a class="text-center text-xl font-bold uppercase shadow-md w-full" href="{{ route('users.log', ['u' => $rol]) }}">
                <x-button class="text-center text-md sm:text-xl font-bold uppercase bg-{{$text[1]}} flex space-y-3 flex-col w-full p-4 rounded-xl text-color5 lg:px-8" type=" button">
                    <div class="h-24 w-24 sm:h-36 sm:w-36  bg-cover bg-center bg-no-repeat rounded-full"
                        style="background-image: url({{asset('imgs/'.$rol.'.jpg')}})">
                    </div>
                    <h1>soy {{$text[0]}}</h1>
                </x-button>
            </a>
        </div>
          @endforeach
          
        </div>

    </div>
   </div>
</body>

</html>
