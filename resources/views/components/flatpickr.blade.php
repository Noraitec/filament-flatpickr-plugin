@php
    $id = $getId();
    $locale = $getLocale();
    $options = json_encode($getOptions(), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
@endphp

<div
    x-data
    x-init="
        () => {
            const config = {{ $options }};
            @if ($locale !== 'default')
                config.locale = '{{ $locale }}';
            @endif

            flatpickr($refs.input, config);
        }
    "
    {{ $attributes->class(['filament-forms-text-input-component']) }}
>
    <input
        x-ref="input"
        id="{{ $id }}"
        name="{{ $getName() }}"
        type="text"
        value="{{ $getState() }}"
        @if ($isDisabled()) disabled @endif
        @if ($isRequired()) required @endif
        {{ $getExtraAttributes() }}
        class="w-full border-gray-300 rounded-md shadow-sm focus:border-primary-500 focus:ring-primary-500"
    >
</div>