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
 
     // Set the locale for the calendar
     public function locale(string $locale): static
     {
         $this->locale = $locale;
         return $this;
     }
 
     // Get the locale for the calendar
     public function getLocale(): string
     {
         return $this->locale;
     }
 
     // Enable or disable the alternative input
     public function altInput(bool $enabled = true): static
     {
         $this->options['altInput'] = $enabled;
         return $this;
     }
 
     // Set the format for the alternative input
     public function altFormat(string $format): static
     {
         $this->options['altFormat'] = $format;
         return $this;
     }
 
     // Set the class for the alternative input
     public function altInputClass(string $class): static
     {
         $this->options['altInputClass'] = $class;
         return $this;
     }
 
     // Set the ARIA format for the date input
     public function ariaDateFormat(string $format): static
     {
         $this->options['ariaDateFormat'] = $format;
         return $this;
     }
 
     // Set the separator for conjunction between dates
     public function conjunctionFromLocalization(string $separator): static
     {
         $this->options['conjunction'] = $separator;
         return $this;
     }
 }