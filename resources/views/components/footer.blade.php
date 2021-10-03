
<div class="hidden xl:grid grid-cols-3 max-w-7xl mx-auto py-4 w-full text-center mt-3 gap-6 dark:text-blue-400">
       <div>
           <ul>
               <li><a href="{{route('users.index')}}">Usuarios</a></li>
               <li><a href="{{route('careers.index')}}">Carreras</a></li>
           </ul>
       </div>
       <div class="h-full flex items-center justify-center">
        <ul>
            <li><a href="{{route('users.show', Auth::user())}}">Mi perfil</a></li>
        </ul>
       </div>
       <div>
        <ul>
            <li><a href="{{route('users.index',['r'=>"teacher"])}}">Docentes</a></li>
            <li><a href="{{route('users.index',['r'=>"student"])}}">Estudiantes</a></li>
        </ul>
       </div>
</div>