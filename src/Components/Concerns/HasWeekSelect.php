<?php

namespace Noraitec\FilamentFlatpickrPlugin\Components\Concerns;

trait HasWeekSelect
{
    /**
     * Habilita el plugin weekSelect de Flatpickr y aplica configuración básica.
     *
     * @param  bool  $state
     * @param  array $config  Opciones específicas del plugin (p. ej. ['weekStart' => 1])
     * @return static
     */
    public function weekSelect(bool $state = true, array $config = []): static
    {
        if ($state) {
            // Registra el plugin para que el init JS lo cargue
            $this->withPlugins(['weekSelect']);

            // Configuración por defecto para la selección de semanas
            $default = [
                'weekStart' => 1,                    // lunes como inicio de semana
                'dateFormat' => 'Y-\\WW',            // formato ISO de año-semana (semana con doble W)
                'altInput'   => true,                // usa campo alternativo para mostrar texto
                'altFormat'  => "'Semana' W",        // sólo muestra "Semana X" en el input
            ];

            // Mezcla con la configuración pasada por el usuario
            $this->config([
                'weekSelect' => array_merge($default, $config),
                // Forzamos modo single que es lo correcto para weekSelect
                'mode'       => 'single',
            ]);
        }

        return $this;
    }
}
