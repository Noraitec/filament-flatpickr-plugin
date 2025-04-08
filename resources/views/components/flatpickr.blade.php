@php
   $config = $field->getOptions();
    $rawKeys = ['onChange', 'onOpen', 'onClose', 'onReady', 'onValueUpdate'];
    $jsOptions = '{' . collect($config)->map(function ($value, $key) use ($rawKeys) {
        if (in_array($key, $rawKeys)) {
            return "$key: $value";
        }
        return "$key: " . json_encode($value);
    })->join(', ') . '}';
@endphp

<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
{{-- Assets de Flatpickr --}}
@once
    @if(config('filament-flatpickr.use_cdn', true))
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    @else
        <link rel="stylesheet" href="{{ asset('vendor/filament-flatpickr/flatpickr.min.css') }}">
        <script src="{{ asset('vendor/filament-flatpickr/flatpickr.min.js') }}"></script>
    @endif
@endonce
    <div
        x-data="{}"
        x-init="flatpickr($refs.input, {!! $jsOptions !!})"
        @flatpickr:refresh.window="flatpickr($refs.input, {!! $jsOptions !!})"
        class="filament-forms-input-wrapper"
    >
        <input
            x-ref="input"
            type="text"
            id="{{ $getId() }}"
            name="{{ $getName() }}"
            {!! $getExtraAttributeBag() !!}
            {{ $applyStateBindingModifiers('wire:model') }}="{{ $getStatePath() }}"
            {{ $attributes->merge($getExtraAttributes())->class([
                'filament-forms-input',
                'w-full text-sm rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white',
                'focus:border-primary-500 focus:ring-1 focus:ring-primary-500',
            ]) }}
        />
    </div>
</x-dynamic-component>