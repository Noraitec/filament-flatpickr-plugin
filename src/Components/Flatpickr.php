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

namespace Noraitec\FilamentFlatpickrPlugin\Components;

use Filament\Forms\Components\Field;
use InvalidArgumentException;

class Flatpickr extends Field
{
    protected string $view = 'filament-flatpickr-plugin::components.flatpickr';
    protected string $locale = 'default'; // default = en
    protected array $plugins = [];
    protected array $options = [];

    // Set the date for the calendar
    public function setDate(string $date): static
    {
        $this->options['date'] = $date;
        return $this;
    }

    // Get the selected date
    public function getDate(): string
    {
        return $this->options['date'] ?? '';
    }

    // Clear the selected date
    public function clear(): static
    {
        $this->options['date'] = null;
        return $this;
    }

    // Set the minimum date for the calendar
    public function setMinDate(string $date): static
    {
        $this->options['minDate'] = $date;
        return $this;
    }

    // Set the maximum date for the calendar
    public function setMaxDate(string $date): static
    {
        $this->options['maxDate'] = $date;
        return $this;
    }

    // Open the calendar
    public function open(): static
    {
        $this->options['open'] = true;
        return $this;
    }

    // Close the calendar
    public function close(): static
    {
        $this->options['open'] = false;
        return $this;
    }

    // Get all options
    public function getOptions(): array
    {
        return $this->options;
    }

    // Métodos de HasLocalization
    public function locale(string $locale): static
    {
        $this->locale = $locale;
        return $this;
    }

    public function getLocale(): string
    {
        return $this->locale;
    }

    public function altInput(bool $enabled = true): static
    {
        $this->options['altInput'] = $enabled;
        return $this;
    }

    public function altFormat(string $format): static
    {
        $this->options['altFormat'] = $format;
        return $this;
    }

    public function altInputClass(string $class): static
    {
        $this->options['altInputClass'] = $class;
        return $this;
    }

    public function ariaDateFormat(string $format): static
    {
        $this->options['ariaDateFormat'] = $format;
        return $this;
    }

    public function conjunctionFromLocalization(string $separator): static
    {
        $this->options['conjunction'] = $separator;
        return $this;
    }

    public function shorthandCurrentMonth(bool $enabled = true): static
    {
        $this->options['shorthandCurrentMonth'] = $enabled;
        return $this;
    }

    public function weekNumbers(bool $enabled = true): static
    {
        $this->options['weekNumbers'] = $enabled;
        return $this;
    }

    public function monthSelectorType(string $type): static
    {
        if (!in_array($type, ['dropdown', 'static'])) {
            throw new InvalidArgumentException("Invalid monthSelectorType: {$type}. Must be 'dropdown' or 'static'.");
        }
        $this->options['monthSelectorType'] = $type;
        return $this;
    }

    public function firstDayOfWeek(int $day): static
    {
        if ($day < 0 || $day > 6) {
            throw new InvalidArgumentException("First day of week must be between 0 and 6.");
        }
        $this->options['firstDayOfWeek'] = $day;
        return $this;
    }

    public function showMonths(int $number): static
    {
        if ($number < 1) {
            throw new InvalidArgumentException("Number of months to show must be at least 1.");
        }
        $this->options['showMonths'] = $number;
        return $this;
    }

    public function dateFormat(string $format): static
    {
        $this->options['dateFormat'] = $format;
        return $this;
    }

    // Métodos de HasTimeOptions
    public function setTime(string $time): static
    {
        $this->options['time'] = $time;
        return $this;
    }

    public function getTime(): ?string
    {
        return $this->options['time'] ?? null;
    }

    public function setTimeFormat(string $format): static
    {
        $validFormats = ['H:i', 'h:i A', 'H:i:s', 'h:i:s A']; // Añade más formatos válidos según Flatpickr
        if (!in_array($format, $validFormats)) {
            throw new InvalidArgumentException("Invalid time format: {$format}.");
        }
        $this->options['timeFormat'] = $format;
        return $this;
    }

    // Configurar opciones arbitrarias para cubrir toda la API de Flatpickr
    public function config(array $options): static
    {
        $this->options = array_merge($this->options, $options);
        return $this;
    }

    // Set plugins for the calendar
    public function withPlugins(array $plugins): static
    {
        $this->plugins = $plugins;
        return $this;
    }

    // Get the current plugins
    public function getPlugins(): array
    {
        return array_merge(config('filament-flatpickr.plugins', []), $this->plugins);
    }
}