@props(['label'])
<th {{$attributes->merge(['class'=>"py-1 "])}} {{$attributes}}>
    @if (isset($label))
    <a href="{{ route('users.index', ['order' => $label, 'dir' => !request('dir')]) }}">
        {{$slot}} <span
            class="fas {{ request('order') == $label ? (request('dir') == true ? 'fa-sort-up' : 'fa-sort-down') : 'fa-sort' }}"></span>
    </a>
    @else
        {{$slot}}
    @endif
</th>