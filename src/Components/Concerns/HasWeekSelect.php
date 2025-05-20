<?php

namespace Noraitec\FilamentFlatpickrPlugin\Components\Concerns;

trait HasWeekSelect
{
    protected bool $weekSelectEnabled = false;

    /**
     * Habilita el plugin weekSelect de Flatpickr y aplica configuración básica.
     *
     * @param  bool   $state
     * @param  array  $config  Opciones específicas del plugin
     * @return static
     */
    public function weekSelect(bool $state = true, array $config = []): static
    {
        $this->weekSelectEnabled = $state;

        if ($state) {
            // Registra el plugin para que el ServiceProvider lo incluya
            $this->withPlugins(['weekSelect']);

            // Configuración por defecto
            $default = [
                'weekStart'  => 1,             // lunes como inicio de semana
                'dateFormat' => 'Y-\\WW',      // formato ISO año-semana
                'altInput'   => true,          // usa campo alternativo
                'altFormat'  => "'Semana' W",  // texto mostrado en el altInput
            ];

            // Mezcla con la configuración pasada por el usuario
            $this->options['weekSelect'] = array_merge($default, $config);

            // Forzamos modo single, necesario para weekSelect
            $this->options['mode'] = 'single';
        }

        return $this;
    }

    /**
     * Saber si está habilitado weekSelect.
     */
    public function isWeekSelectEnabled(): bool
    {
        return $this->weekSelectEnabled;
    }
}
