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

trait HasLocalization
{
    protected string $locale = 'default';

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
}