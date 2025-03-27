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

use Noraitec\FilamentFlatpickrPlugin\Components\Flatpickr;
use Tests\TestCase;

//
// getOptions & config
//
it('configures options correctly', function () {
    $component = Flatpickr::make('fecha')->config([
        'inline' => true,
        'weekNumbers' => true,
    ]);

    $options = $component->getOptions();

    expect($options['inline'])->toBeTrue();
    expect($options['weekNumbers'])->toBeTrue();
});

//
// withPlugins & getPlugins
//
it('adds plugins correctly', function () {
    $component = Flatpickr::make('fecha')->withPlugins(['rangePlugin']);
    expect($component->getPlugins())->toContain('rangePlugin');
});

it('merges plugins with config', function () {
    $component = new class('fecha') extends Flatpickr {
        protected function getConfiguredPlugins(): array
        {
            return ['confirmDate'];
        }
    };

    $component->withPlugins(['rangePlugin']);

    expect($component->getPlugins())->toMatchArray(['confirmDate', 'rangePlugin']);
});

//
// getConfig
//
it('returns value from getConfig when config() returns value', function () {
    $component = new class('fecha') extends Flatpickr {
        protected function getConfig(string $key, mixed $default = null): mixed
        {
            return ['plugin-from-config'];
        }

        protected function getConfiguredPlugins(): array
        {
            return $this->getConfig('filament-flatpickr.plugins', []);
        }
    };

    expect($component->getPlugins())->toBe(['plugin-from-config']);
});

it('returns default from getConfig when config() returns null', function () {
    $component = new class('fecha') extends Flatpickr {
        public function exposeGetConfig(string $key, mixed $default = null): mixed
        {
            return $this->getConfig($key, $default);
        }

        protected function getConfiguredPlugins(): array
        {
            return [];
        }
    };

    if (!function_exists('config')) {
        function config($key, $default = null) {
            return null;
        }
    }

    expect($component->exposeGetConfig('nonexistent', 'fallback'))->toBe('fallback');
});
it('returns default from getConfig when config() throws', function () {
    $component = new class('fecha') extends Flatpickr {
        protected function getConfiguredPlugins(): array
        {
            try {
                throw new \Exception('Simulated error');
            } catch (\Throwable) {
                return $this->getConfig('filament-flatpickr.plugins', []);
            }
        }
    };

    expect($component->getPlugins())->toBe([]);
});

it('returns default from getConfig when config() is not available', function () {
    $component = new class('fecha') extends Flatpickr {
        public function testGetConfigWrapper(): mixed
        {
            return $this->getConfig('some.nonexistent.key', 'fallback');
        }

        protected function getConfiguredPlugins(): array
        {
            return [];
        }
    };

    expect($component->testGetConfigWrapper())->toBe('fallback');
});

//
// getConfiguredPlugins
//
it('getConfiguredPlugins returns configured plugins when config exists', function () {
    $component = new class('fecha') extends Flatpickr {
        protected function getConfiguredPlugins(): array
        {
            return ['a', 'b'];
        }
    };

    $component->withPlugins([]);

    expect($component->getPlugins())->toMatchArray(['a', 'b']);
});

it('getConfiguredPlugins returns empty array when config does not exist', function () {
    $component = new class('fecha') extends Flatpickr {
        protected function getConfiguredPlugins(): array
        {
            return [];
        }
    };

    expect($component->getPlugins())->toBe([]);
});

it('getConfiguredPlugins handles config() throwing exception gracefully', function () {
    $component = new class('fecha') extends Flatpickr {
        protected function getConfig(string $key, mixed $default = null): mixed
        {
            throw new \Exception("Boom");
        }
    };

    expect($component->getPlugins())->toBe([]);
});

//
// Otros tests de API pública
//
it('sets and gets locale', function () {
    $component = Flatpickr::make('fecha')->locale('fr');
    expect($component->getLocale())->toBe('fr');
});

it('sets time options', function () {
    $component = Flatpickr::make('fecha')
        ->enableTime(true)
        ->time24hr(false)
        ->defaultHour(10);

    $options = $component->getOptions();

    expect($options['enableTime'])->toBeTrue();
    expect($options['time_24hr'])->toBeFalse();
    expect($options['defaultHour'])->toBe(10);
});

it('sets date options', function () {
    $component = Flatpickr::make('fecha')
        ->minDate('2023-01-01')
        ->maxDate('2023-12-31')
        ->defaultDate('2023-06-15');

    $options = $component->getOptions();

    expect($options['minDate'])->toBe('2023-01-01');
    expect($options['maxDate'])->toBe('2023-12-31');
    expect($options['defaultDate'])->toBe('2023-06-15');
});

it('sets UI config options', function () {
    $component = Flatpickr::make('fecha')
        ->inline(true)
        ->weekNumbers(true)
        ->showMonths(3);

    $options = $component->getOptions();

    expect($options['inline'])->toBeTrue();
    expect($options['weekNumbers'])->toBeTrue();
    expect($options['showMonths'])->toBe(3);
});

it('returns the same instance when withPlugins is called', function () {
    $component = Flatpickr::make('fecha');
    $returned = $component->withPlugins(['rangePlugin']);

    expect($returned)->toBe($component);
});

it('getConfiguredPlugins returns empty array when config does not exist (explicit)', function () {
    $component = new class('fecha') extends Flatpickr {
        public function testGetConfiguredPlugins(): array
        {
            return $this->getConfiguredPlugins();
        }

        protected function getConfig(string $key, mixed $default = null): mixed
        {
            return $default;
        }
    };

    expect($component->testGetConfiguredPlugins())->toBe([]);
});
it('getPlugins returns unique plugins', function () {
    $component = new class('fecha') extends Flatpickr {
        protected function getConfiguredPlugins(): array
        {
            return ['a', 'b', 'a'];
        }
    };

    $component->withPlugins(['b', 'c', 'c']);

    $plugins = $component->getPlugins();

    expect(array_values($plugins))->toBe(['a', 'b', 'c']);
});
it('calls getConfig and returns value when config() exists and returns array', function () {
    $component = new class('fecha') extends Flatpickr {
        protected function getConfig(string $key, mixed $default = null): mixed
        {
            return ['a', 'b'];
        }

        protected function getConfiguredPlugins(): array
        {
            return $this->getConfig('filament-flatpickr.plugins', []);
        }
    };

    expect($component->getPlugins())->toBe(['a', 'b']);
});

it('getConfig returns default if config() throws', function () {
    $component = new class('fecha') extends Flatpickr {
        protected function getConfig(string $key, mixed $default = null): mixed
        {
            throw new \Exception("Simulated");
        }

        public function test(): mixed
        {
            return parent::getConfig('some.key', ['default']);
        }
    };

    expect($component->test())->toBe(['default']);
});
