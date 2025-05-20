<?php

namespace Tests\Unit;

use Orchestra\Testbench\TestCase;
use Noraitec\FilamentFlatpickrPlugin\Components\Concerns\HasWeekSelect;

class HasWeekSelectTest extends TestCase
{
    protected function makeDummy(): object
    {
        return new class {
            use HasWeekSelect;

            public array $options = [];
            public array $plugins = [];

            public function withPlugins(array $plugins): static
            {
                $this->plugins = array_merge($this->plugins, $plugins);
                return $this;
            }

            public function getOptions(): array
            {
                return $this->options;
            }
        };
    }

    public function test_week_select_trait_sets_options(): void
    {
        $dummy = $this->makeDummy();

        // Antes no está habilitado
        $this->assertFalse($dummy->isWeekSelectEnabled());
        $this->assertArrayNotHasKey('weekSelect', $dummy->getOptions());
        $this->assertArrayNotHasKey('mode', $dummy->getOptions());

        // Habilitamos
        $dummy->weekSelect();

        $opts = $dummy->getOptions();

        $this->assertTrue($dummy->isWeekSelectEnabled());
        $this->assertSame('single', $opts['mode']);
        $this->assertIsArray($opts['weekSelect']);

        foreach (['weekStart','dateFormat','altInput','altFormat'] as $key) {
            $this->assertArrayHasKey($key, $opts['weekSelect']);
        }

        $this->assertContains('weekSelect', $dummy->plugins);
    }

    public function test_week_select_trait_can_be_disabled(): void
    {
        $dummy = $this->makeDummy();

        // Deshabilitamos explícitamente
        $dummy->weekSelect(false);

        $opts = $dummy->getOptions();

        $this->assertFalse($dummy->isWeekSelectEnabled());
        $this->assertArrayNotHasKey('mode', $opts);
        $this->assertArrayNotHasKey('weekSelect', $opts);
        $this->assertEmpty($dummy->plugins);
    }

    public function test_week_select_trait_merges_custom_config(): void
    {
        $dummy = $this->makeDummy();

        $custom = [
            'weekStart' => 2,
            'altInput'  => false,
            'altFormat' => "'MiSemana' W",
        ];

        $dummy->weekSelect(true, $custom);

        $weekOpts = $dummy->getOptions()['weekSelect'];

        // Las claves personalizadas deben sobrescribir
        $this->assertSame(2,              $weekOpts['weekStart']);
        $this->assertFalse($weekOpts['altInput']);
        $this->assertSame("'MiSemana' W", $weekOpts['altFormat']);

        // El resto permanece en defaults
        $this->assertArrayHasKey('dateFormat', $weekOpts);
    }
}
