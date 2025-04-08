<?php
/**
 * This file is part of the Noraitec Filament Flatpickr Plugin.
 *
 * (c) Noraitec dsotelo@noraitec.com
 *
 * This source file is subject to the GNU Lesser General Public License (LGPL-3.0)
 * that is bundled with this source code in the LICENSE file.
 * For details see <https://www.gnu.org/licenses/lgpl-3.0.html>
 * file: filament-flatpickr-plugin.php
 */
return [

    /*
    |--------------------------------------------------------------------------
    | Usar CDN en lugar de assets locales
    |--------------------------------------------------------------------------
    |
    | Si se activa esta opción, el plugin cargará los scripts y estilos de Flatpickr
    | desde un CDN en lugar de usar los archivos locales publicados.
    |
    */

    'use_cdn' => false,

    /*
    |--------------------------------------------------------------------------
    | Idioma por defecto
    |--------------------------------------------------------------------------
    |
    | Puedes especificar el idioma por defecto para el calendario.
    | Flatpickr soporta múltiples idiomas como 'es', 'fr', 'pt', 'en', etc.
    |
    */

    'default_locale' => 'es',

    /*
    |--------------------------------------------------------------------------
    | Zona horaria por defecto
    |--------------------------------------------------------------------------
    |
    | Si deseas que Flatpickr maneje una zona horaria específica.
    | Deja en null para usar la configuración del sistema.
    |
    */

    'timezone' => 'Europe/Madrid',

    /*
    |--------------------------------------------------------------------------
    | Plugins habilitados globalmente
    |--------------------------------------------------------------------------
    |
    | Puedes definir aquí qué plugins de Flatpickr deseas registrar por defecto.
    | Ejemplo: ['rangePlugin', 'confirmDatePlugin']
    |
    */

    'plugins' => [
        'confirmDate',
        'rangePlugin',
    ],

    /*
    |--------------------------------------------------------------------------
    | Opciones globales de Flatpickr
    |--------------------------------------------------------------------------
    |
    | Estas opciones se aplicarán a todos los calendarios, a menos que se sobrescriban.
    | Puedes usar cualquier configuración válida de la API de Flatpickr.
    |
    */

    'default_options' => [
        'allowInput' => true,
        'dateFormat' => 'd-m-Y',
        'enableTime' => false,
        'time_24hr' => true,
    ],

];