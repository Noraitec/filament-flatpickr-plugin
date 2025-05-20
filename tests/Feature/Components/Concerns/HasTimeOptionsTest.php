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
 use Noraitec\FilamentFlatpickrPlugin\Components\Concerns\HasTimeOptions;
 use Noraitec\FilamentFlatpickrPlugin\Components\Flatpickr;
 use Tests\TestCase;

 uses(Tests\TestCase::class);

it('enables time selection by default', function () {
    $dummy = new class {
        use HasTimeOptions;
        public array $options = [];
    };

    $dummy->enableTime();
    expect($dummy->options['enableTime'])->toBeTrue();
});

it('disables time selection when passed false', function () {
    $dummy = new class {
        use HasTimeOptions;
        public array $options = [];
    };

    $dummy->enableTime(false);
    expect($dummy->options['enableTime'])->toBeFalse();
});

it('sets 24-hour format by default', function () {
    $dummy = new class {
        use HasTimeOptions;
        public array $options = [];
    };

    $dummy->time24hr();
    expect($dummy->options['time_24hr'])->toBeTrue();
});

it('disables 24-hour format when passed false', function () {
    $dummy = new class {
        use HasTimeOptions;
        public array $options = [];
    };

    $dummy->time24hr(false);
    expect($dummy->options['time_24hr'])->toBeFalse();
});

it('sets a default hour correctly', function () {
    $dummy = new class {
        use HasTimeOptions;
        public array $options = [];
    };

    $dummy->defaultHour(14);
    expect($dummy->options['defaultHour'])->toBe(14);
});

it('enables seconds by default', function () {
    $dummy = new class {
        use HasTimeOptions;
        public array $options = [];
    };

    $dummy->enableSeconds();
    expect($dummy->options['enableSeconds'])->toBeTrue();
});

it('disables seconds when passed false', function () {
    $dummy = new class {
        use HasTimeOptions;
        public array $options = [];
    };

    $dummy->enableSeconds(false);
    expect($dummy->options['enableSeconds'])->toBeFalse();
});