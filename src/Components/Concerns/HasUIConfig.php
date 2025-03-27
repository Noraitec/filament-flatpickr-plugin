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

trait HasUIConfig
{
    public function inline(bool $enabled = true): static
    {
        $this->options['inline'] = $enabled;
        return $this;
    }

    public function weekNumbers(bool $enabled = true): static
    {
        $this->options['weekNumbers'] = $enabled;
        return $this;
    }

    public function showMonths(int $number): static
    {
        if ($number < 1) {
            throw new \InvalidArgumentException("Number of months to show must be at least 1.");
        }
        $this->options['showMonths'] = $number;
        return $this;
    }
}