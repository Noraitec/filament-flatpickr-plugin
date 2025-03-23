<?php

namespace Noraitec\FilamentFlatpickrPlugin\Components\Concerns;

trait HasRangeOptions
{
    public function mode(string $mode): static
    {
        $allowed = ['single', 'multiple', 'range', 'time'];

        if (! in_array($mode, $allowed)) {
            throw new \InvalidArgumentException("Modo inválido: {$mode}. Los permitidos son: " . implode(', ', $allowed));
        }

        $this->options['mode'] = $mode;
        return $this;
    }

    public function defaultDate(string|array $date): static
    {
        $this->options['defaultDate'] = $date;
        return $this;
    }

    public function disable(array $dates): static
    {
        $this->options['disable'] = $dates;
        return $this;
    }

    public function disableFunction(string $jsFunction): static
    {
        $this->options['disable'] = [$jsFunction];
        return $this;
    }

    public function enable(array $dates): static
    {
        $this->options['enable'] = $dates;
        return $this;
    }

    public function enableFunction(string $jsFunction): static
    {
        $this->options['enable'] = [$jsFunction];
        return $this;
    }

    public function conjunction(string $separator): static
    {
        $this->options['conjunction'] = $separator;
        return $this;
    }

    public function weekNumbers(bool $enabled = true): static
    {
        $this->options['weekNumbers'] = $enabled;
        return $this;
    }

    public function shorthandCurrentMonth(bool $enabled = true): static
    {
        $this->options['shorthandCurrentMonth'] = $enabled;
        return $this;
    }

    public function monthSelectorType(string $type): static
    {
        $allowed = ['dropdown', 'static'];

        if (! in_array($type, $allowed)) {
            throw new \InvalidArgumentException("Tipo inválido de selector de mes: {$type}");
        }

        $this->options['monthSelectorType'] = $type;
        return $this;
    }
}
