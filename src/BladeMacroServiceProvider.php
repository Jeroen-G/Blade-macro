<?php

declare(strict_types=1);

namespace JeroenG\BladeMacro;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeMacroServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Blade::directive('macro', fn ($macroName) => Macro::define($macroName));
        Blade::directive('endMacro', fn () => Macro::endDefinition());
        Blade::directive('showMacro', fn ($expression) => Macro::show($expression));
    }
}
