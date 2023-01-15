<?php

declare(strict_types=1);

namespace JeroenG\BladeMacro;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeMacroServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Blade::directive('macro', function ($macroName) {
            return Macro::define($macroName);
        });

        Blade::directive('endMacro', function () {
            return Macro::endDefinition();
        });

        Blade::directive('showMacro', function ($expression) {
            return Macro::show($expression);
        });
    }
}
