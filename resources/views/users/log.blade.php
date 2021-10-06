<x-app>
    <x-slot name="bg">https://p0.pxfuel.com/preview/187/633/72/5be997aec83a2.jpg</x-slot>
    @php
        $roles = ['admin' => 'Administrador', 'support' => 'Soporte', 'teacher' => 'Docente', 'student' => 'Estudiante'];
    @endphp
    <div class="absolute px-3 w-screen py-2 mx-auto top-3">
        <a href="{{ route('welcome') }}" class="mx-auto flex justify-start items-center space-x-4 w-max h-12">
            <x-application-logo class="h-12" />
            <h1>SIGU 2021</h1>
        </a>
    </div>
    <div class="w-full flex items-center">

        <div class="flex space-x-2 max-w-7xl w-full mx-auto">
            <div class="hidden   rounded-xl  bg-white shadow-xl xl:flex xl:flex-col items-center py-3 w-72 "
                id="lateral">
                <h1 class="font-bold text-center uppercase text-2xl mb-4 text-main-100">Acceder como</h1>
                <div class=" flex flex-col justify-center " style="height: 50vh">
                    <div class="grid grid-cols-1 grid-rows-3 w-72 text-center gap-12">
                        @foreach ($roles as $key => $rol)
                            @if ($key != request('u'))
                                <div class="w-full ">
                                    <a href="{{ route('users.log', ['u' => $key]) }}"
                                        class="uppercase font-bold text-xl text-second-80 hover:text-gray-900">
                                        <div class="h-12 w-12  mx-auto bg-cover bg-center bg-no-repeat rounded-full"
                                            style="background-image: url({{ asset('imgs/' . $key . '.jpg') }})">
                                        </div>
                                        {{ $rol }}
                                    </a>
                                    <hr>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div
                class="p-3 block md:flex w-full mx-auto overflow-hidden bg-white rounded-lg shadow-lg dark:bg-gray-800 ">
                <div class="hidden bg-cover md:block md:w-1/2"
                    style="background-image:url({{ asset('imgs/' . request('u') . '.jpg') }})">
                </div>
                <div class=" lg:w-1/2 mx-auto md:mx-1   px-2 md:py-8 bg-white ">
                    <div class="w-20 h-20 mx-auto mb-2">
                        <x-application-logo />
                    </div>
                    <div class="md:w-3/4 md:mx-auto">
                        <h1 class="text-center uppercase font-bold text-lg mb-4 text-main-100">Ingresa como
                            {{ $roles[request('u')] }} </h1>
                        <form action="{{ route('users.login', ['u' => request('u')]) }}" method="POST">
                            @csrf
                            <div class="space-y-4 flex flex-col justify-end">
                                <div class="flex flex-col space-y-2">
                                    <x-label class="text-lg text-main-70" for="id">Correo</x-label>
                                    <x-input id="mat" type="number" placeholder="Ingrese su matrícula" required>
                                        <x-slot name="icon">
                                            <span id="span"
                                                class="text-sm">{{ '@' . substr(request('u'), 0, 2) . config('services.vars.mail_domain') }}</span>
                                        </x-slot>
                                    </x-input>
                                    <input id="email" type="hidden" name="email" />
                                </div>
                                <div class="flex flex-col space-y-2">
                                    <x-label class="text-lg text-main-70 " for="password">Contraseña</x-label>
                                    <x-input type="password" id="password" placeholder="Ingrese su contraseña"
                                        name='password' required>
                                        <x-slot name="icon">
                                            <span id="togglePassword" title="Ver/Ocultar contraseña"
                                                class="fas fa-eye text-blue-400 cursor-pointer"></span>
                                        </x-slot>
                                    </x-input>

                                </div>
                                <div class="flex justify-end">
                                    <x-button class="w-max font-bold text-md ml-auto bg-second-100">Ingresar</x-button>
                                    @if (request('u')=='student')
                                    <x-dropdown-link href="{{route('users.aplicate')}}" class="  rounded-md w-max font-bold text-md ml-auto  bg-main-100" style="color: #fff !important">Quiero Estudiar</x-dropdown-link>
                                    @endif
                                </div>

                            </div>
                        </form>
                        <small class="text-red-400">
                            @if (request('e'))
                                Los datos ingresados no son correctos
                            @endif
                        </small>
                    </div>

                </div>
            </div>
        </div>

    </div>
    @push('js')
        <script>
            $('document').ready(function() {
                $('#mat').on('input', function() {
                    span = $('#span').text();
                    hide = $('#email');
                    mat = $(this).val();
                    hide.val(mat + span);
                })
            })
        </script>
    @endpush
</x-app>
