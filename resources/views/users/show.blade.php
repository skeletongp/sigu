<x-app>
    <div class="bg-white p-4 sm:w-1/2 mx-auto relative">
        <div class="sm:grid grid-cols-6 gap-6 h-72 sm:h-60 ">
            <div class="sm:col-span-2 flex flex-col items-center justify-center">
                <div class="w-48 h-48 rounded-full bg-cover bg-center bg-no-repeat"
                    style="background-image: url({{ $user->photo }})"></div>
            </div>
            <div class="sm:col-span-4">
                <div class="w-full h-full flex flex-col justify-center items-center">
                    <h1 class="sm:text-3xl font-bold">{{ $user->fullname }}</h1>
                    <h2>{{ $user->email }}</h2>
                    <h2>{{ optional($user->career)->name }}</h2>


                </div>
            </div>
        </div>
        @hasanyrole('admin')
        <div class=" absolute top-3 left-3">
            <a href="{{ route('users.edit', $user) }}"><span class="fas fa-pen text-blue-400"></span></a>
        </div>
        @endhasanyrole
        <x-slot name="lateral">
        </x-slot>

    </div>
</x-app>
