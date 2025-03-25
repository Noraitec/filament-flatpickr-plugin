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
    // Set the time for the calendar
    public function setTime(string $time): static
    {
        $this->options['time'] = $time;
        return $this;
    }

    // Set hours for the calendar
    public function setHours(int $hours): static
    {
        $this->options['hours'] = $hours;
        return $this;
    }

    // Set minutes for the calendar
    public function setMinutes(int $minutes): static
    {
        $this->options['minutes'] = $minutes;
        return $this;
    }

    // Clear the time
    public function clearTime(): static
    {
        $this->options['time'] = null;
        return $this;
    }
}