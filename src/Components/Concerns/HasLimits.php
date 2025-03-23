<?php

namespace Noraitec\FilamentFlatpickrPlugin\Components\Concerns;

trait HasLimits
{
    public function minDate(string $date): static
    {
        $this->options['minDate'] = $date;
        return $this;
    }

    public function maxDate(string $date): static
    {
        $this->options['maxDate'] = $date;
        return $this;
    }

    public function defaultDate(string|array $date): static
    {
        $this->options['defaultDate'] = $date;
        return $this;
    }

    public function defaultHour(int $hour): static
    {
        $this->options['defaultHour'] = $hour;
        return $this;
    }

    public function defaultMinute(int $minute): static
    {
        $this->options['defaultMinute'] = $minute;
        return $this;
    }

    public function defaultSeconds(int $seconds): static
    {
        $this->options['defaultSeconds'] = $seconds;
        return $this;
    }

    public function hourIncrement(int $value): static
    {
        $this->options['hourIncrement'] = $value;
        return $this;
    }

    public function minuteIncrement(int $value): static
    {
        $this->options['minuteIncrement'] = $value;
        return $this;
    }

    public function disable(array $dates): static
    {
        $this->options['disable'] = $dates;
        return $this;
    }

    public function enable(array $dates): static
    {
        $this->options['enable'] = $dates;
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
}
