<li class="flex flex-row shadow-xl rounded-xl my-1 relative">

    <div class="select-none  flex flex-1 items-center p-4 w-full ">
        @hasanyrole('admin|support')
        <div class="flex  space-x-4 items-center absolute right-2 bottom-2 shadow-xl">
            @role('admin')
            <form action="{{ $rDelete }}" class=" " method="post">
                @csrf
                @method('delete')
                <button class="fas fa-times text-red-500 hover:text-red-400 cursor-pointer"
                    onclick="return confirm('¿Eliminar registro?')"></button>
            </form>
            @endrole
            @if ($rEdit != '')
                <a href="{{ $rEdit }}" class="  text-sm">
                    <span class="fas fa-pen text-blue-500 hover:text-blue-400 cursor-pointer"></span>
                </a>
            @endif
        </div>
        @endhasanyrole
        <div class="flex flex-col w-10 h-10 justify-center items-center mr-4">
            <a href="{{ $url }}" class="w-full">
                <div class="w-10 h-10 cursor-pointer">
                    <img alt="profil" src="{{ $image }}" class="mx-auto rounded-full  " />
                </div>
            </a>

        </div>
        <div class="flex-1 pl-1 mr-16">
            <div class="font-bold text-lg w-60 dark:text-white truncate overflow-ellipsis mb-1 leading-5">
                {!! $title !!}
            </div>
            <div class="text-gray-600 dark:text-gray-200 text-sm flex justify-between">
                {!! $subtitle !!}
            </div>
        </div>


    </div>
</li>
