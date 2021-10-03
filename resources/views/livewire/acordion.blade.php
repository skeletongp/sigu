<div class="transition-all	duration-500 ease-in-out">
    <div class="flex justify-between " >
        <span class="uppercase font-bold"> {{ $data[0]->subject->name }}</span>
        <span class="fas {{$open?'fa-angle-down':'fa-angle-right'}} cursor-pointer acord-trigger" id="acord{{$data[0]->id}}"></span>
    </div>
    <div class=" hidden transition-all transform 	duration-500 ease-in-out acord-body acord{{$data[0]->id}}">
        <div class="grid grid-flow-row grid-cols-3">
            <span class="text-gray-700 dark:text-blue-300">Docente</span>
            <span class="text-gray-700 dark:text-blue-300">Día</span>
            <span class="text-gray-700 dark:text-blue-300">Horario</span>
            @foreach ($data as $dat)
                <span>{{ $dat->teacher->fullname }}</span>
                <span>{{ $dat->day }}</span>
                <span>{{ $dat->from }}-{{ $dat->finish }}</span>
            @endforeach
        </div>
    </div>
</div>
