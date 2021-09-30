<x-app>

    <div class="container mx-auto px-4 sm:px-8 max-w-xl">
        <div class="bg-blue-300 text-black dark:text-gray-100 dark:bg-gray-900 w-8 h-8 flex flex-col justify-center items-center rounded-full ">
            <x-dropdown align="left">
                <x-slot name="trigger">
                    <span class="fas fa-plus cursor-pointer"></span>
                </x-slot>
                <x-slot name="content">
                    <x-dropdown-link href="{{route('sections.create')}}">Nueva Sección</x-dropdown-link>
                    @if ($sections->count())
                    <x-dropdown-link href="{{route('sections.selection')}}">Llenar Sección</x-dropdown-link>
                    @endif
                </x-slot>
            </x-dropdown>
        </div>
        <div class="py-8">
            <div class="flex flex-row mb-1 sm:mb-0 justify-between items-center w-full">
                <h2 class="text-2xl leading-tight">
                    Secciones
                </h2>
                <div class="text-end ">
                    <form
                        class="flex flex-col md:flex-row w-3/4 md:w-full max-w-sm md:space-x-3 space-y-3 md:space-y-0 justify-center">
                        <div class=" relative ">
                            <x-input placeholder="Buscar" name="q">
                                <x-slot name="icon">
                                    <button><span class="fas fa-search"></span></button>
                                </x-slot>
                            </x-input>
                        </div>

                    </form>
                </div>
            </div>
            <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                    @if ($sections->count())
                        @foreach ($sections as $section)
                            <x-list :rDelete="route('sections.destroy', $section)" :rEdit="route('sections.edit', $section)" :url="''"
                                image="https://res.cloudinary.com/dboafhu31/image/upload/v1624658165/Download-Computer-512_fp1r3y.png"
                                :title="$section->name" :subtitle="$section->code.optional($section->subjects)->count()">
                            </x-list>
                        @endforeach
                    @else
                        <h1 class="my-8 w-full  text-center uppercase">
                            No hay secciones disponibles
                        </h1>
                    @endif

                </div>
            </div>
        </div>

</x-app>
