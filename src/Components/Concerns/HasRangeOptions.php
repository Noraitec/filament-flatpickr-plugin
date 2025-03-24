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

    public function conjunction(string $separator): static
    {
        $this->options['conjunction'] = $separator;
        return $this;
    }

}
