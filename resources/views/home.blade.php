<x-app>
    <div class=" w-screen max-w-7xl mx-auto shadow-xl p-4  flex flex-col justify-center relative">
       
        <section class="bg-white dark:bg-gray-800 max-w-6xl mx-auto text-center">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
                <div class="p-4 w-full">
                    <div style="background-image: url({{ asset('imgs/student.jpg') }})"
                        class="w-24 h-24 bg-center shadow-xl bg-cover rounded-full mx-auto">
                    </div>
                    <h1 class="mt-4 text-xl font-bold  font-sans uppercase ">Estudiantes inscritos</h1>
                    <p class="mt-2  text-lg font-bold text-blue-400">{{ $user->total('student') }} Activos</p>
                </div>
                <div class="p-4 w-full">
                    <div style="background-image: url({{ asset('imgs/teacher.jpg') }})"
                        class="w-24 h-24 bg-center shadow-xl bg-cover rounded-full mx-auto">
                    </div>
                    <h1 class="mt-4 text-xl font-bold font-sans uppercase ">Nuestros Docentes</h1>
                    <p class="mt-2 text-lg font-bold text-blue-400">{{ $user->total('teacher') }} Activos</p>
                </div>
                <div class="p-4 w-full">
                    <div style="background-image: url({{ asset('imgs/student.jpg') }})"
                        class="w-24 h-24 bg-center shadow-xl bg-cover rounded-full mx-auto">
                    </div>
                    <h1 class="mt-4 text-xl font-bold  font-sans uppercase ">Oferta Académica</h1>
                    <p class="mt-2  text-lg font-bold text-blue-400">{{ $careers->count() }} Carreras</p>
                </div>
                <div class="p-4 w-full">
                    <div style="background-image: url({{ asset('imgs/student.jpg') }})"
                        class="w-24 h-24 bg-center shadow-xl bg-cover rounded-full mx-auto">
                    </div>
                    <h1 class="mt-4 text-xl font-bold  font-sans uppercase ">Materias Impartidas</h1>
                    <p class="mt-2  text-lg font-bold text-blue-400">{{ $subjects->count() }} Asignaturas</p>
                </div>

            </div>
        </section>
    </div>
</x-app>
