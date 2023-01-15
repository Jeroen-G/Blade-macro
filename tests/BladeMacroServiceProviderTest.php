<?php

declare(strict_types=1);

namespace JeroenG\BladeMacro\Tests;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Blade;
use JeroenG\BladeMacro\BladeMacroServiceProvider;
use PHPUnit\Framework\TestCase;

class BladeMacroServiceProviderTest extends TestCase
{
    public function test_it_registers_blade_directives(): void
    {
        $app = \Mockery::mock(Application::class);

        Blade::expects('directive')->withArgs(function ($name, $handler) {
            self::assertSame('macro', $name);
            return $name === 'macro' && is_callable($handler);
        });

        Blade::expects('directive')->withArgs(function ($name, $handler) {
            self::assertSame('endMacro', $name);
            return $name === 'endMacro' && is_callable($handler);
        });

        Blade::expects('directive')->withArgs(function ($name, $handler) {
            self::assertSame('showMacro', $name);
            return $name === 'showMacro' && is_callable($handler);
        });

        $provider = new BladeMacroServiceProvider($app);

        $provider->boot();
    }
}
