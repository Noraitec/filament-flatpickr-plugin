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

trait HasTimeOptions
{
    public function enableTime(bool $enabled = true): static
    {
        $this->options['enableTime'] = $enabled;
        return $this;
    }

    public function enableSeconds(bool $enabled = true): static
    {
        $this->options['enableSeconds'] = $enabled;
        return $this;
    }

    public function time24hr(bool $enabled = true): static
    {
        $this->options['time_24hr'] = $enabled;
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
}
