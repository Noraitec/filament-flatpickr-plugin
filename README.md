# 🧩 Filament Flatpickr Plugin


[![Coverage](https://codecov.io/gh/Noraitec/filament-flatpickr-plugin/branch/main/graph/badge.svg)](https://codecov.io/gh/Noraitec/filament-flatpickr-plugin)  
[![Tests](https://github.com/Noraitec/filament-flatpickr-plugin/actions/workflows/tests.yml/badge.svg)](https://github.com/Noraitec/filament-flatpickr-plugin/actions/workflows/tests.yml)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/noraitec/filament-flatpickr-plugin.svg)](https://packagist.org/packages/noraitec/filament-flatpickr-plugin)  
[![Total Downloads](https://img.shields.io/packagist/dt/noraitec/filament-flatpickr-plugin.svg)](https://packagist.org/packages/noraitec/filament-flatpickr-plugin)  
[![License: LGPL v3](https://img.shields.io/badge/License-LGPL%20v3-blue.svg)](https://www.gnu.org/licenses/lgpl-3.0)  
[![Changelog](https://img.shields.io/badge/changelog-keepachangelog-brightgreen.svg)](https://github.com/Noraitec/filament-flatpickr-plugin/blob/main/CHANGELOG.md)





Un plugin completo de Filament v3 que integra la librería Flatpickr, permitiendo configurar todos los parámetros de su API, incluidos los `locales`, `rangos`, `formato`, `estilos` y más.


## 🧾 Changelog

Revisá el historial completo de cambios en [CHANGELOG.md](./CHANGELOG.md)

---

## 🚀 Características

- 📅 Soporte completo para [Flatpickr](https://flatpickr.js.org/)
- 🧩 Configuración detallada de opciones
- 🌍 Localización (idioma, formato de fecha, etc.)
- 🔥 Modo rango, selección múltiple, hora, segundos...
- 💡 Compatible con Filament v3

---

## 📦 Instalación

```bash
composer require noraitec/filament-flatpickr-plugin

```

Opcionalmente, publica los assets si es necesario:

```bash
php artisan vendor:publish --tag=filament-flatpickr-plugin

```

## 🛠️ Uso





```php

use Noraitec\FilamentFlatpickrPlugin\Components\Flatpickr;

Flatpickr::make('fecha')
    ->enableTime()
    ->dateFormat('Y-m-d H:i')
    ->locale('es')
    ->mode('range');

    //También se pueden configurar funciones JS:

    Flatpickr::make('fecha')
    ->onChange('function(selectedDates, dateStr, instance) { console.log(dateStr); }');



```

## 📋 Opciones Soportadas

enableTime, enableSeconds, time_24hr, defaultHour, etc.

locale, altInput, altFormat, dateFormat, etc.

mode: single | multiple | range | time

Callbacks: onChange, onOpen, onClose, etc.

## 🧪 Pruebas


```bash

./vendor/bin/pest
./vendor/bin/pest --coverage

```

## 📄 Licencia


This plugin is open-sourced software licensed under the [GNU Lesser General Public License v3.0](https://www.gnu.org/licenses/lgpl-3.0.html).

You may use it in both open-source and proprietary projects, provided that modifications to the plugin itself are published under the same license.