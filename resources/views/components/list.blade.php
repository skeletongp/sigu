<li class="flex flex-row shadow-xl rounded-xl my-1">
    <a href="{{ $url }}" class="w-full">
        <div class="select-none cursor-pointer flex flex-1 items-center p-4 w-full">
            <div class="flex flex-col w-10 h-10 justify-center items-center mr-4">

                <img alt="profil" src="{{ $image }}" class="mx-auto object-cover rounded-full h-10 w-10 " />

            </div>
            <div class="flex-1 pl-1 mr-16">
                <div class="font-medium dark:text-white">
                    {{ $title }}
                </div>
                <div class="text-gray-600 dark:text-gray-200 text-sm">
                    {{ $subtitle }}
                </div>
            </div>

            <button class="w-24 text-right flex justify-end">
                <span class="fas fa-angle-right"></span>
            </button>
        </div>
    </a>
</li>
