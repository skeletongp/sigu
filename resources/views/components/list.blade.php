<li class="flex flex-row shadow-xl rounded-xl my-1 relative">
    <a href="{{ $url }}" class="w-full">
        <div class="select-none cursor-pointer flex flex-1 items-center p-4 w-full ">
            <div class="flex flex-col w-10 h-10 justify-center items-center mr-4">

                <div class="w-10 h-10">
                    <img alt="profil" src="{{ $image }}" class="mx-auto rounded-full  " />
                </div>

            </div>
            <div class="flex-1 pl-1 mr-16">
                <div class="font-medium w-60 dark:text-white truncate overflow-ellipsis">
                    {{ $title }}
                </div>
                <div class="text-gray-600 dark:text-gray-200 text-sm">
                    {{ $subtitle }}
                </div>
            </div>

            <button class=" text-right absolute right-2">
                <span class="fas fa-angle-right"></span>
            </button>
        </div>
    </a>
</li>
