<?php

namespace Noraitec\FilamentFlatpickrPlugin\Components\Concerns;

trait HasDisplayOptions
{

    public function dateFormat(string $format): static
    {
        return $this->config(['dateFormat' => $format]);
    }

    public function defaultMinute(int $minute): static
    {
        return $this->config(['defaultMinute' => $minute]);
    }
    public function shorthandCurrentMonth(bool $state = true): static
    {
        return $this->config(['shorthandCurrentMonth' => $state]);
    }
}
