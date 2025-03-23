<?php

namespace Noraitec\FilamentFlatpickrPlugin\Components\Concerns;

trait HasCallbacks
{
    public function onChange(string $jsCallback): static
    {
        $this->options['onChange'] = [$jsCallback];
        return $this;
    }

    public function onOpen(string $jsCallback): static
    {
        $this->options['onOpen'] = [$jsCallback];
        return $this;
    }

    public function onClose(string $jsCallback): static
    {
        $this->options['onClose'] = [$jsCallback];
        return $this;
    }

    public function onReady(string $jsCallback): static
    {
        $this->options['onReady'] = [$jsCallback];
        return $this;
    }

    public function onMonthChange(string $jsCallback): static
    {
        $this->options['onMonthChange'] = [$jsCallback];
        return $this;
    }

    public function onYearChange(string $jsCallback): static
    {
        $this->options['onYearChange'] = [$jsCallback];
        return $this;
    }

    public function onValueUpdate(string $jsCallback): static
    {
        $this->options['onValueUpdate'] = [$jsCallback];
        return $this;
    }

    public function onDayCreate(string $jsCallback): static
    {
        $this->options['onDayCreate'] = [$jsCallback];
        return $this;
    }
}
