<div class=" ">
@if ($sections && $sections->count())
        <div class="flex flex-col text-left">
            @if (!$having)
                <h1 class="font-bold text-center uppercase text-xl mb-4">Horarios disponibles</h1>
               
            @else
                <h1 class="font-bold text-center uppercase text-xl mb-4">Materias Seleccionadas</h1>
            @endif
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50 dark:bg-gray-700 ">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">
                                        Sección
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-center text-xs font-medium  uppercase tracking-wider">
                                        Horario
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-center text-xs font-medium  uppercase tracking-wider">
                                        {{ $role == 'student' ? 'Estado' : 'Cupo' }}
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-center text-xs font-medium  uppercase tracking-wider">
                                        Docente
                                    </th>
                                    @role('student')
                                    @if (!$having)
                                        <th scope="col" class="relative px-6 py-3">
                                            Añadir
                                        </th>
                                    @endif
                                    @endrole
                                </tr>
                            </thead>
                            @php
                                $subjects = $sections->groupby('subject_id');
                            @endphp
                            <tbody class="dark:bg-gray-800 divide-y divide-gray-200 text-center text-sm lg:text-lg">
                                @foreach ($subjects as $subject)
                                    <tr class="bg-gray-800 cursor-pointer trselection" id="tr{{ $subject[0]->id }}">
                                        <td colspan="3" class="text-left pl-2 uppercase text-blue-400 font-bold py-2">
                                            <a href="{{route('subjects.show',$subject[0]->subject)}}">
                                                <h1>{{ $subject[0]->subject->name }}</h1>
                                            </a>
                                        </td>
                                        <td colspan="2" class="text-center uppercase px-1 text-blue-400 font-bold py-2">
                                            <a href="{{route('subjects.show',$subject[0]->subject)}}">
                                                <h1 class="">{{ $subject[0]->subject->credits }} Créditos </h1>
                                            </a>
                                          
                                        </td>
                                    </tr>
                                    @foreach ($subject as $section)

                                                    @php
                                                        if ($role == 'student') {
                                                            $trim = $career->subjects->where('id', $section->subject->id)->first();
                                                            $course=Auth::user()->courses->where('course_id',$section->id)->first();
                                                            $status=['aproved'=>['Aprobada','text-green-400'], 'failed'=>['Reprobada','text-red-400'], 'coursing'=>['Cursando','text-yellow-600 dark:text-yellow-400']];
                                                        }
                                                    @endphp
                                    <tr class="
                                                tr{{ $subject[0]->id }} dark:bg-gray-800">
                                        <td class="px-2 py-2 whitespace-nowrap">
                                            <div class="flex items-center space-x-2">
                                                @hasanyrole('admin|support')
                                                <div class="flex space-x-3 text-sm">
                                                    <button
                                                        onclick="confirm('Eliminar del horario') || event.preventDefault()"
                                                        wire:click="delete({{ $subject }})">
                                                        <span class=" fas fa-times text-red-400"></span>
                                                    </button>
                                                    <a href="{{ route('sections.edit', $section) }}">
                                                        <span class=" fas fa-pen text-blue-400"></span>
                                                    </a>
                                                </div>
                                                @endhasanyrole
                                                <div>
                                                    
                                                    {{ $subject[0]->subject->code }}-{{ $section->section->code }}-{{ $section->day }}-{{ str_pad($section->id, 3, '0', STR_PAD_LEFT) }}
                                                    <br>
                                                    @role('student')
                                                    {{ $trim ? $trim->pivot->trimester . 'º Trimestre' : '' }}
                                                    @endrole
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-2 whitespace-nowrap">
                                            <div>
                                                {{ $section->day }}
                                            </div>
                                            <div>
                                                {{ $section->from }}-{{ $section->finish }}
                                            </div>
                                        </td>
                                        <td
                                            class="px-6 py-2 whitespace-nowrap font-semibold  {{ $role == 'student' ? ($course ? $status[$course->status][1] : '') : '' }}">
                                            {{ $role == 'student' ? ($course ? $status[$course->status][0] : 'Disponible') : $section->quota }}
                                        </td>
                                        <td class="px-6 py-2 whitespace-nowrap ">
                                          <a href="{{route('users.show', $section->teacher)}}">  {{ $section->teacher->fullname }}</a>
                                        </td>
                                        @role('student')
                                        @if (!$hide_button)
                                            <td class="px-6 py-2 whitespace-nowrap text-right text-sm font-medium">
                                                @if (!$having)
                                                    <div
                                                        class="relative inline-block w-10 mr-2 align-middle select-none">
                                                        <input type="checkbox" id="s{{ $section->id }}"
                                                            class="checked:bg-green-500 outline-none focus:outline-none right-4 checked:right-0 duration-200 ease-in absolute block w-6 h-6 rounded-full bg-white disabled:bg-gray-300 disabled:opacity-30 border-4 appearance-none cursor-pointer"
                                                            {{ in_array($section->subject_id, $matIds) ? (in_array($section->id, $selected) ? '' : 'disabled') : '' }}
                                                            {{ in_array($section->id, $selected) ? 'checked' : '' }}
                                                            name="added[]" value="{{ $section->id }}"
                                                            wire:change="check({{ $section->id }},{{ $section->subject_id }})" />
                                                        <label for="s{{ $section->id }}"
                                                            class="block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer">
                                                        </label>
                                                    </div>
                                                @else
                                                    <button
                                                        onclick="confirm('Eliminar asignatura') || event.preventDefault()"
                                                        wire:click="unselect({{ $section->id }},{{ $section->subject_id }})">
                                                        <span class="fas fa-trash text-red-400 text-xl"></span>
                                                    </button>
                                                @endif

                                            </td>
                                        @endif
                                        @endrole
                                    </tr>
                                @endforeach
    @endforeach
    </tbody>
    <tfoot>
        @if ($having)
            <tr class="bg-black uppercase font-bold text-blue-400 ">
                <td colspan="3" class=" py-2 text-center">
                    <h1>Total</h1>
                </td>
                <td colspan="2" class="text-center py-2">
                    {{ Auth::user()->subjects->sum('credits') }} Créditos
                </td>
            </tr>
        @endif
    </tfoot>
    </table>
</div>
</div>
</div>
</div>
<div class="my-2 dark:text-white ">
    {{$sections->links() }}
</div>
<div>
    @if (!$having && count($selected))
        <div class="w-full flex justify-end my-2">
            <x-button type="button" wire:click="select">Guardar selección</x-button>
        </div>
    @endif
</div>
@endif
</div>
