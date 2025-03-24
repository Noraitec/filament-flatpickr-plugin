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
