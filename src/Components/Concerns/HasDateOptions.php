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

trait HasDateOptions
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

    public function defaultDate(string $date): static
    {
        $this->options['defaultDate'] = $date;
        return $this;
    }
}