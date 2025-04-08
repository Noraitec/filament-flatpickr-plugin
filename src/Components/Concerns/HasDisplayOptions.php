<?php

namespace Noraitec\FilamentFlatpickrPlugin\Components\Concerns;

trait HasDisplayOptions
{

    public function altFormat(string $format): static
    {
        return $this->config(['altFormat' => $format]);
    }

    public function dateFormat(string $format): static
    {
        return $this->config(['dateFormat' => $format]);
    }

    public function defaultHour(int $hour): static
    {
        return $this->config(['defaultHour' => $hour]);
    }

    public function defaultMinute(int $minute): static
    {
        return $this->config(['defaultMinute' => $minute]);
    }

    public function weekNumbers(bool $state = true): static
    {
        return $this->config(['weekNumbers' => $state]);
    }

    public function inline(bool $state = true): static
    {
        return $this->config(['inline' => $state]);
    }

    public function shorthandCurrentMonth(bool $state = true): static
    {
        return $this->config(['shorthandCurrentMonth' => $state]);
    }
}
