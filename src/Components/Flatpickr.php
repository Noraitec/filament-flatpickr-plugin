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
 use Noraitec\FilamentFlatpickrPlugin\Components\Concerns\HasLocalization;
 use Noraitec\FilamentFlatpickrPlugin\Components\Concerns\HasTimeOptions;
 use Noraitec\FilamentFlatpickrPlugin\Components\Concerns\HasDateOptions;
 use Noraitec\FilamentFlatpickrPlugin\Components\Concerns\HasUIConfig;
 
 class Flatpickr extends Field
 {
     use HasLocalization, HasTimeOptions, HasDateOptions, HasUIConfig;
 
     protected string $view = 'filament-flatpickr-plugin::components.flatpickr';
     protected array $options = [];
     protected array $plugins = [];
 
     public function getOptions(): array
     {
         return $this->options;
     }
 
     public function config(array $options): static
     {
         $this->options = array_merge($this->options, $options);
         return $this;
     }
 
     public function withPlugins(array $plugins): static
     {
         $this->plugins = $plugins;
         return $this;
     }
 
     public function getPlugins(): array
     {
         return array_merge(config('filament-flatpickr.plugins', []), $this->plugins);
     }
 }