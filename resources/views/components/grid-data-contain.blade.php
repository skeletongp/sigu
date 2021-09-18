@props(['backgroundImg', 'title', 'details', 'author', 'rating', 'duration'])
<!-- component -->
<div {{$attributes->merge(['class'=>"flex justify-center items-center w-full"])}}>
    <div class=" bg-white shadow-xl border border-collapse border-blue-200 h-60  mx-3  rounded-3xl flex flex-col justify-around items-center overflow-hidden         sm:flex-row sm:h-40 sm:w-3/5 md:w-96 relative">
        <img class="h-1/2 w-full sm:h-full sm:w-1/3 object-fit"
            src="{{$backgroundImg}}"
            alt="image" />

        <div class="flex-1 w-2/3 flex flex-col items-center justify-around h-1/2  pl-2
          sm:h-full sm:items-center">
            <div class="flex flex-col justify-center items-center text-center">
                <p class="text-sm font-bold mb-0 text-blue-800 uppercase text-center w-full px-2 my-2 leading-4" title="{{$title}}">
                    {{substr($title, 0, 50)}}...
                </p>
                <span class="text-sm text-indigo-900 mt-0">{{$author}}</span>
            </div>
            <p class="text-md sm:text-xs text-gray-900 mx-2 overflow-ellipsis text-center">
               {{substr($details,0, 80)}}...
            </p>
            <div class="w-full flex justify-between items-center">
               <div class="flex space-x-3 items-center">
                <h1 class="font-bold text-gray-500"><span class="fas fa-star text-yellow-500"></span>{{$rating}}</h1>
                <span class="bg-blue-100 px-2 rounded-xl  text-xs">{{isset($duration)?$duration:'0'}}</span>
               </div>
                <button class="bg-gray-700 mr-5 text-white px-3 py-0 hover:bg-gray-600 shadow-md rounded-xl">
                    Detalles
                </button>
            </div>
        </div>
        
    </div>
</div>
