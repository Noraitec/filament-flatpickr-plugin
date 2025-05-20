<?php

use Noraitec\FilamentFlatpickrPlugin\Components\Concerns\HasDisplayOptions;

uses(Tests\TestCase::class);

it('sets the dateFormat option', function () {
    $dummy = new class {
        use HasDisplayOptions;
        public array $options = [];
        public function config(array $opts): static
        {
            $this->options = array_merge($this->options, $opts);
            return $this;
        }
    };

    $dummy->dateFormat('d-m-Y');
    expect($dummy->options['dateFormat'])->toBe('d-m-Y');
});

it('sets the defaultMinute option', function () {
    $dummy = new class {
        use HasDisplayOptions;
        public array $options = [];
        public function config(array $opts): static
        {
            $this->options = array_merge($this->options, $opts);
            return $this;
        }
    };

    $dummy->defaultMinute(30);
    expect($dummy->options['defaultMinute'])->toBe(30);
});

it('sets shorthandCurrentMonth to true by default', function () {
    $dummy = new class {
        use HasDisplayOptions;
        public array $options = [];
        public function config(array $opts): static
        {
            $this->options = array_merge($this->options, $opts);
            return $this;
        }
    };

    $dummy->shorthandCurrentMonth();
    expect($dummy->options['shorthandCurrentMonth'])->toBeTrue();
});

it('allows disabling shorthandCurrentMonth', function () {
    $dummy = new class {
        use HasDisplayOptions;
        public array $options = [];
        public function config(array $opts): static
        {
            $this->options = array_merge($this->options, $opts);
            return $this;
        }
    };

    $dummy->shorthandCurrentMonth(false);
    expect($dummy->options['shorthandCurrentMonth'])->toBeFalse();
});
