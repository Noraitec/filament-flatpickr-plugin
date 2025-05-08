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

use Carbon\Carbon;

trait HasWeekSelect
{
    public function weekSelect(bool $state = true): static
    {
        if ($state) {
            $this->withPlugins(['weekSelect']);
            $this->config([
                'mode' => 'single',
                'weekSelect' => true,
                'dateFormat' => 'Y-W', // Año y semana
                'altInput' => true,
                'altFormat' => 'W \\| \\d\\e F \\d\\e Y - \\d\\e F \\d\\e Y',
                'onChange' => <<<JS
                function(selectedDates, dateStr, instance) {
                    const [year, weekNumber] = dateStr.split("-");
                    
                    // Calcular fechas de inicio y fin de semana
                    const startDate = new Date(year, 0, 1 + (weekNumber - 1) * 7);
                    const endDate = new Date(startDate);
                    endDate.setDate(startDate.getDate() + 6);
                    
                    // Formatear las fechas
                    const options = { year: "numeric", month: "long", day: "numeric" };
                    const startFormatted = startDate.toLocaleDateString("es-ES", options);
                    const endFormatted = endDate.toLocaleDateString("es-ES", options);
                    
                    // Asignar el valor al campo
                    instance._input.value = 'Semana ' + weekNumber + ' | ' + startFormatted + ' - ' + endFormatted;
                }
                JS,
            ]);
        }

        return $this;
    }
}
