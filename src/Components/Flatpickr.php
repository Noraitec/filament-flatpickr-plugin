<?php

namespace Noraitec\FilamentFlatpickrPlugin\Forms\Components;

use Filament\Forms\Components\Field;
use Noraitec\FilamentFlatpickrPlugin\Components\Concerns\HasCallbacks;
use Noraitec\FilamentFlatpickrPlugin\Components\Concerns\HasLimits;
use Noraitec\FilamentFlatpickrPlugin\Components\Concerns\HasLocalization;
use Noraitec\FilamentFlatpickrPlugin\Components\Concerns\HasPositioning;
use Noraitec\FilamentFlatpickrPlugin\Components\Concerns\HasRangeOptions;
use Noraitec\FilamentFlatpickrPlugin\Components\Concerns\HasTimeOptions;

class Flatpickr extends Field
{
    use HasCallbacks;
    use HasLimits;
    use HasLocalization;
    use HasPositioning;
    use HasRangeOptions;
    use HasTimeOptions;

    protected string $view = 'filament-flatpickr-plugin::components.flatpickr';

    protected string $locale = 'default'; // default = en

    protected array $options = [];

    public function options(array $options): static
    {
        $this->options = $options;
        return $this;
    }

    public function getOptions(): array
    {
        return $this->options;
    }

    public function locale(string $locale): static
    {
        $this->locale = $locale;
        return $this;
    }

    public function getLocale(): string
    {
        return $this->locale;
    }

    public function mode(string $mode): static
    {
        $allowed = ['single', 'multiple', 'range', 'time'];

        if (! in_array($mode, $allowed)) {
            throw new \InvalidArgumentException("Modo inválido: {$mode}. Los permitidos son: " . implode(', ', $allowed));
        }

        $this->options['mode'] = $mode;
        return $this;
    }

    public function disableMobile(bool $enabled = true): static
    {
        $this->options['disableMobile'] = $enabled;
        return $this;
    }

    public function disableFunction(string $jsFunction): static
    {
        $this->options['disable'] = [$jsFunction];
        return $this;
    }

    public function enableFunction(string $jsFunction): static
    {
        $this->options['enable'] = [$jsFunction];
        return $this;
    }

    public function altInputClass(string $class): static
    {
        $this->options['altInputClass'] = $class;
        return $this;
    }

    public function conjunction(string $separator): static
    {
        $this->options['conjunction'] = $separator;
        return $this;
    }
}
