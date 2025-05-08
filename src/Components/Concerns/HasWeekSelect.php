<?php

namespace Noraitec\FilamentFlatpickrPlugin\Components\Concerns;

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
                'altFormat' => 'W | d \\d\\e F \\d\\e Y - d \\d\\e F \\d\\e Y',
                'onChange' => "
                function(selectedDates, dateStr, instance) {
                    const [year, weekNumber] = dateStr.split('-');
                    const startDate = new Date(year, 0, 1 + (weekNumber - 1) * 7);
                    const endDate = new Date(startDate);
                    endDate.setDate(startDate.getDate() + 6);
                    const options = { year: 'numeric', month: 'long', day: 'numeric' };
                    const startFormatted = startDate.toLocaleDateString('es-ES', options);
                    const endFormatted = endDate.toLocaleDateString('es-ES', options);
                    instance._input.value = 'Semana ' + weekNumber + ' | ' + startFormatted + ' - ' + endFormatted;
                }",
            ]);
        }

        return $this;
    }
}