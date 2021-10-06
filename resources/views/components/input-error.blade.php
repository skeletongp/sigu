@props(['for'])
@error($for)
    @if (strlen($slot->toHtml()) != 0)
        <p {{ $attributes->merge(['class' => 'text-sm text-red-600']) }}>
            {{ $slot }}
        </p>
    @else
        <p {{ $attributes->merge(['class' => 'text-sm text-red-600']) }}>
            {{ $message }}
        </p>
    @endif
@enderror
