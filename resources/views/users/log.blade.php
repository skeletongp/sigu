<x-app>
    <x-slot name="bg">https://p0.pxfuel.com/preview/187/633/72/5be997aec83a2.jpg</x-slot>
    @php
        $roles = ['admin' => 'Administrador', 'support' => 'Soporte', 'teacher' => 'Docente', 'student' => 'Estudiante'];
    @endphp
    <div class="w-full flex items-center" style="height: 78vh">
        <a href="{{ route('welcome') }}"
            class="fixed left-3 top-3 flex justify-start items-center space-x-4 w-60 h-12">
            <x-application-logo class="h-12" />
            <h1>SIGU 2021</h1>
        </a>

        <div
            class="p-3 block md:flex w-screen mx-auto overflow-hidden bg-white rounded-lg shadow-lg dark:bg-gray-800 lg:max-w-4xl">
            <div class="hidden bg-cover md:block md:w-1/2"
                style="background-image:url('https://images.unsplash.com/photo-1606660265514-358ebbadc80d?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1575&q=80')">
            </div>
            <div class=" lg:w-1/2 mx-auto md:mx-1   px-2 py-4 md:py-8 bg-white ">
                <div class="w-20 h-20 mx-auto mb-8">
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
                                <x-input type="email" placeholder="Ingrese su correo" name='email' required />
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
                            <div class="flex justify-between">
                                <div class="flex items-center space-x-1">
                                    <x-input type="checkbox" id="remember" name="remember"
                                        class="border-0 border-white" />
                                    <x-label class="w-1/3 sm:w-full text-main-70" for="remember">Recordar contraseña
                                    </x-label>
                                </div>
                                <x-button class="w-max ml-auto bg-main-100">Ingresar</x-button>
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
        <div class="hidden  fixed left-4 xl:left-10 rounded-xl  bg-white shadow-xl xl:flex xl:flex-col items-center py-3 w-72 max-h-screen"
            style="min-height: 60vh; margin-top:20vh; margin-bottom:20vh" id="lateral">
            <h1 class="font-bold text-center uppercase text-2xl mb-4 text-main-100">Acceder como</h1>
           <div class=" flex flex-col justify-center " style="height: 50vh">
            <div class="grid grid-cols-1 grid-rows-3 w-72 text-center gap-12">
                @foreach ($roles as $key => $rol)
                    @if ($key != request('u'))
                        <div class="w-full ">
                            <a href="{{ route('users.log', ['u'=>$key]) }}" class="uppercase font-bold text-2xl text-second-80 hover:text-gray-900">
                                <div class="h-20 w-20  mx-auto bg-cover bg-center bg-no-repeat rounded-full"
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
    </div>

</x-app>
