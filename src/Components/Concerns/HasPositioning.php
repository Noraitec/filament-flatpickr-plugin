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

trait HasPositioning
{
    public function inline(bool $enabled = true): static
    {
        $this->options['inline'] = $enabled;
        return $this;
    }

    public function position(string $position): static
    {
        $allowed = ['auto', 'above', 'below', 'auto left', 'auto center', 'auto right'];

        if (! in_array($position, $allowed)) {
            throw new \InvalidArgumentException("Posición inválida: {$position}");
        }

        $this->options['position'] = $position;
        return $this;
    }

    public function positionElement(string $selector): static
    {
        $this->options['positionElement'] = $selector;
        return $this;
    }

    public function static(bool $enabled = true): static
    {
        $this->options['static'] = $enabled;
        return $this;
    }

    public function wrap(bool $enabled = true): static
    {
        $this->options['wrap'] = $enabled;
        return $this;
    }

    public function clickOpens(bool $enabled = true): static
    {
        $this->options['clickOpens'] = $enabled;
        return $this;
    }

    public function allowInput(bool $enabled = true): static
    {
        $this->options['allowInput'] = $enabled;
        return $this;
    }

    public function nextArrow(string $html): static
    {
        $this->options['nextArrow'] = $html;
        return $this;
    }

    public function prevArrow(string $html): static
    {
        $this->options['prevArrow'] = $html;
        return $this;
    }

    public function showMonths(int $months): static
    {
        $this->options['showMonths'] = $months;
        return $this;
    }
}
