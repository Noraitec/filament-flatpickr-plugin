@php
    $id = $getId();
    $options = $getOptions();
    $plugins = $getPlugins();
    $jsonOptions = json_encode($options);
    $locale = $getLocale();
    $wrap = $options['wrap'] ?? false;
@endphp

<div
    x-data
    x-init="flatpickr($refs.input, {
        ...{{ $jsonOptions }},
        locale: '{{ $locale !== 'default' ? $locale : 'en' }}'
    })"
    {{ $attributes->class(['filament-forms-text-input-component']) }}
>
    @if ($wrap)
        <div class="flex items-center space-x-2" data-input>
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
            <button type="button" class="text-sm text-gray-500" data-toggle>📅</button>
            <button type="button" class="text-sm text-gray-500" data-clear>✖</button>
        </div>
    @else
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
    @endif
</div>

<script>
    window.addEventListener('DOMContentLoaded', () => {
        if (typeof window.flatpickr === 'undefined') {
            console.warn('[Flatpickr] CDN failed, loading local fallback...');

            const css = document.createElement('link')
            css.rel = 'stylesheet'
            css.href = '{{ asset("vendor/filament-flatpickr/flatpickr.min.css") }}'
            document.head.appendChild(css)

            const script = document.createElement('script')
            script.src = '{{ asset("vendor/filament-flatpickr/flatpickr.min.js") }}'
            document.head.appendChild(script)

            const locale = '{{ $getLocale() }}' || 'en'
            if (locale !== 'en') {
                const localeScript = document.createElement('script')
                localeScript.src = '{{ asset("vendor/filament-flatpickr/l10n") }}/' + locale + '.js'
                document.head.appendChild(localeScript)
            }

            @foreach ($plugins as $plugin)
                const pluginScript = document.createElement('script')
                pluginScript.src = '{{ asset("vendor/filament-flatpickr/plugins") }}/{{ $plugin }}.js'
                document.head.appendChild(pluginScript)
            @endforeach
        }
    })
</script>
