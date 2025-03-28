# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),  
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

---

## [1.2.0] - 2025-03-25

### Added
- Soporte completo para la API de Flatpickr desde PHP mediante métodos encadenables.
- Nuevos métodos: `minDate()`, `maxDate()`, `defaultDate()`, `altInput()`, `altFormat()`, `weekNumbers()`, `allowInput()`, `inline()`, `disableMobile()`, etc.
- Hooks de eventos JS: `onChange()`, `onOpen()`, `onClose()`, `onReady()`, `onValueUpdate()`.
- Soporte para opciones avanzadas como `timezone()`, `locale()`, `plugins()`, `disable()` y `enable()`.

### Improved
- Refactor del componente Blade para inyectar funciones JavaScript sin comillas.
- Integración total con configuración global (`config/filament-flatpickr.php`).



## [1.0.1] – 2025-03-24

### Added
- Seleccion interna de resources js (cdn o no cdn)
- Badge de cobertura con cobertura **100%**.
- Pruebas unitarias completas con Pest.
- Soporte para licencia LGPL y badge correspondiente.
- README más completo con ejemplos, badges e instrucciones.

### Changed
- Mejora de organización del código: separación de `Concerns`.
- Mejora en la documentación de los métodos disponibles.

---

## [1.0.0] – 2025-03-23

### Added
- Primer release del plugin `filament-flatpickr-plugin`.
- Componente Flatpickr totalmente integrado con Filament 3.
- Soporte para:
  - `locale`, `dateFormat`, `altInput`, `ariaDateFormat`, etc.
  - `minDate`, `maxDate`, `enableFunction`, `disableFunction`.
  - `mode`, `disableMobile`, `conjunction`, `plugins`, etc.
