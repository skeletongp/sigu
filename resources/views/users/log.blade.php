<x-app>
    <x-slot name="bg">https://p0.pxfuel.com/preview/187/633/72/5be997aec83a2.jpg</x-slot>
    @php
        $roles = ['admin' => 'Administrador', 'support' => 'Soporte', 'teacher' => 'Docente', 'student' => 'Estudiante'];
    @endphp
    <div class="w-full flex items-center" style="height: 78vh">
        <a href="{{route('welcome')}}" class="fixed left-3 top-3 flex justify-start items-center space-x-4 w-60 h-12">
            <x-application-logo class="h-12" />
            <h1>SIGU 2021</h1>
        </a>
        <div class="w-5/6 sm:w-1/2 mx-auto md:mx-1  shadow-xl px-2 sm:px-8 py-4 md:py-8 bg-white rounded-xl">
            <div class="w-20 h-20 mx-auto mb-8">
                <x-application-logo />
            </div>
            <div class="md:w-3/4 md:mx-auto">
                <h1 class="text-center uppercase font-bold text-lg sm:text-xl mb-4 text-main-100">Ingresa como
                    {{ $roles[request('u')] }} </h1>
                <form action="{{ route('users.login', ['u' => request('u')]) }}" method="POST">
                    @csrf
                    <div class="space-y-4 flex flex-col justify-end">
                        <div class="flex flex-col space-y-2">
                            <x-label class="text-lg text-main-70" for="id">Correo</x-label>
                            <x-input type="email" placeholder="Ingrese su correo" name='email' required/>
                        </div>
                        <div class="flex flex-col space-y-2">
                            <x-label class="text-lg text-main-70 " for="password">Contraseña</x-label>
                            <x-input type="password" id="password" placeholder="Ingrese su contraseña" name='password' required>
                                <x-slot name="icon"><span id="togglePassoword"
                                    title="Ver/Ocultar contraseña"
                                        class="fas fa-eye text-blue-400 cursor-pointer"></span></x-slot>
                            </x-input>

                        </div>
                        <div class="flex justify-between">
                            <div class="flex items-center space-x-1">
                                <x-input type="checkbox" id="remember" name="remember" class="border-0 border-white" />
                                <x-label class="w-1/3 sm:w-full text-main-70" for="remember">Recordar contraseña</x-label>
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

</x-app>
