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

use Tests\TestCase;
use Noraitec\FilamentFlatpickrPlugin\Components\Concerns\HasRangeOptions;

uses(TestCase::class);

class DummyRangeComponent {
    use HasRangeOptions;

    public array $options = [];
}
it('sets a valid mode in trait', function () {
    $component = new DummyRangeComponent();
    $component->mode('range');

    expect($component->options)->toHaveKey('mode', 'range');
});

it('throws exception on invalid mode in trait', function () {
    $component = new DummyRangeComponent();
    $component->mode('invalid');
})->throws(InvalidArgumentException::class);

it('sets valid modes', function () {
    $component = new DummyRangeComponent();

    foreach (['single', 'multiple', 'range', 'time'] as $mode) {
        $component->mode($mode);
        expect($component->options['mode'])->toBe($mode);
    }
});

it('throws exception on invalid mode', function () {
    $component = new DummyRangeComponent();
    $component->mode('invalid');
})->throws(InvalidArgumentException::class);

it('sets defaultDate with string', function () {
    $component = new DummyRangeComponent();
    $component->defaultDate('2025-01-01');
    expect($component->options)->toHaveKey('defaultDate', '2025-01-01');
});

it('sets defaultDate with array', function () {
    $component = new DummyRangeComponent();
    $component->defaultDate(['2025-01-01', '2025-01-02']);
    expect($component->options)->toHaveKey('defaultDate', ['2025-01-01', '2025-01-02']);
});

it('sets disableFunction correctly', function () {
    $component = new DummyRangeComponent();
    $component->disableFunction('function() { return true; }');
    expect($component->options['disable'])->toBe(['function() { return true; }']);
});

it('sets enableFunction correctly', function () {
    $component = new DummyRangeComponent();
    $component->enableFunction('function() { return true; }');
    expect($component->options['enable'])->toBe(['function() { return true; }']);
});

it('sets conjunction correctly', function () {
    $component = new DummyRangeComponent();
    $component->conjunction('|');
    expect($component->options['conjunction'])->toBe('|');
});
