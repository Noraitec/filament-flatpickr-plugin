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
use Noraitec\FilamentFlatpickrPlugin\Components\Concerns\HasCallbacks;
use Noraitec\FilamentFlatpickrPlugin\Components\Concerns\HasLimits;
use Noraitec\FilamentFlatpickrPlugin\Components\Concerns\HasLocalization;
use Noraitec\FilamentFlatpickrPlugin\Components\Concerns\HasPositioning;
use Noraitec\FilamentFlatpickrPlugin\Components\Concerns\HasRangeOptions;
use Noraitec\FilamentFlatpickrPlugin\Components\Concerns\HasTimeOptions;

class Flatpickr extends Field
{
    use HasCallbacks;
    use HasLimits;
    use HasLocalization;
    use HasPositioning;
    use HasRangeOptions;
    use HasTimeOptions;

    protected string $view = 'filament-flatpickr-plugin::components.flatpickr';

    protected string $locale = 'default'; // default = en
    protected array $plugins = [];

    protected array $options = [];

    public function options(array $options): static
    {
        $this->options = $options;
        return $this;
    }

    public function getOptions(): array
    {
        return $this->options;
    }

    public function locale(string $locale): static
    {
        $this->locale = $locale;
        return $this;
    }

    public function getLocale(): string
    {
        return $this->locale;
    }

    public function mode(string $mode): static
    {
        $allowed = ['single', 'multiple', 'range', 'time'];

        if (! in_array($mode, $allowed)) {
            throw new \InvalidArgumentException("Modo inválido: {$mode}. Los permitidos son: " . implode(', ', $allowed));
        }

        $this->options['mode'] = $mode;
        return $this;
    }

    public function disableMobile(bool $enabled = true): static
    {
        $this->options['disableMobile'] = $enabled;
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

    public function altInputClass(string $class): static
    {
        $this->options['altInputClass'] = $class;
        return $this;
    }

    public function conjunction(string $separator): static
    {
        $this->options['conjunction'] = $separator;
        return $this;
    }
    public function withPlugins(array $plugins): static
{
    $this->plugins = $plugins;

    return $this;
}

public function getPlugins(): array
{
    return $this->plugins;
}

}
