<x-app>
    <div class="max-w-2xl mx-auto">
        @foreach ($data as $dat)
            <div class="mb-4 divide-y-4 divide-gray-100 divide-dashed">
                @livewire('acordion', ['data' => $dat], key($dat->id))
            </div>
        @endforeach
        </ul>
        @push('js')
            <script>
                $('.acord-trigger').each(function() {
                    $(this).click(function() {
                        $(this).toggleClass('fa-angle-down fa-angle-right')
                        id = $(this).prop('id');
                        
                        /* Oculta todos los cuerpos */
                        $('.acord-body').each(function(){
                            if (!$(this).hasClass('hidden') && !$(this).hasClass(id)) {
                                $(this).addClass('hidden');
                            }
                        });

                        /* Si el actual está cerrado, lo abre, y viceversa */
                        $('.' + id).each(function() {
                            $(this).toggleClass('hidden block');
                           
                        })
                    })
                })
            </script>
        @endpush
</x-app>
