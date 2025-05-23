<?php
/**
 * This file is part of the Noraitec Filament Flatpickr Plugin.
 *
 * (c) Noraitec dsotelo@noraitec.com
 *
 * This source file is subject to the GNU Lesser General Public License (LGPL-3.0)
 * that is bundled with this source code in the LICENSE file.
 * For details see <https://www.gnu.org/licenses/lgpl-3.0.html>
 */

 namespace Noraitec\FilamentFlatpickrPlugin\Components;
 
 use Filament\Forms\Components\Field;
 use Noraitec\FilamentFlatpickrPlugin\Components\Concerns\HasLocalization;
 use Noraitec\FilamentFlatpickrPlugin\Components\Concerns\HasTimeOptions;
 use Noraitec\FilamentFlatpickrPlugin\Components\Concerns\HasDateOptions;
 use Noraitec\FilamentFlatpickrPlugin\Components\Concerns\HasUIConfig;
 use Noraitec\FilamentFlatpickrPlugin\Components\Concerns\HasDisplayOptions;
 use Noraitec\FilamentFlatpickrPlugin\Components\Concerns\HasWeekSelect;
 
 
 class Flatpickr extends Field
 {
     use HasLocalization, HasTimeOptions, HasDateOptions, HasUIConfig, HasDisplayOptions ,HasWeekSelect;
 
     protected string $view = 'filament-flatpickr::components.flatpickr';
     protected array $options = [];
     protected array $plugins = [];
 
     public function getOptions(): array
     {
         return $this->options;
     }
     public static function getAssets(): array
{
    $mode = config('filament-flatpickr.assets', 'cdn');

    if ($mode === 'cdn') {
        return [
            'https://cdn.jsdelivr.net/npm/flatpickr',
            'https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css',
        ];
    }

    return [
        asset('vendor/filament-flatpickr-plugin/flatpickr.js'),
        asset('vendor/filament-flatpickr-plugin/flatpickr.css'),
    ];
}
 
     public function config(array $options): static
     {
         $this->options = array_merge($this->options, $options);
         return $this;
     }
//for testing purposes
protected function getConfig(string $key, mixed $default = null): mixed
{
    if (function_exists('config')) {
        try {
            $value = config($key);
            return $value !== null ? $value : $default; // @codeCoverageIgnore
        } catch (\Throwable) {
            return $default; // @codeCoverageIgnore
        }
    }

    return $default;  // @codeCoverageIgnore
}
 
     public function withPlugins(array $plugins): static
{
    $this->plugins = $plugins; // No accedemos a config aquí
    return $this;
}

protected function getConfiguredPlugins(): array
{
    if (function_exists('config')) {
        try {
            return config('filament-flatpickr.plugins', []) ?? [];
        } catch (\Throwable) {
            return []; // @codeCoverageIgnore
        }
    }

    return []; // @codeCoverageIgnore
}

public function getPlugins(): array
{
    return array_values(array_unique(array_merge(
        $this->getConfiguredPlugins(),
        $this->plugins
    )));
}

public function noCalendar(bool $noCalendar = true): static
    {
        return $this->config(['noCalendar' => $noCalendar]);
    }
        public function mode(string $mode): static
{
    return $this->config(['mode' => $mode]);
}
public function serializable(bool $enabled = true): static
{
    if ($enabled) {
        // Asegúrate de que el modo es multiple
        $this->config(['mode' => 'multiple']);

        // Establece el callback que JSON-serializa las fechas
        $this->config([
            'onChange' => "function(selectedDates, dateStr, instance) {
                instance._input.value = JSON.stringify(
                    selectedDates.map(d => instance.formatDate(d, instance.config.dateFormat))
                );
            }",
        ]);
    }

    return $this;
}


}