<?php

declare(strict_types=1);

use JeroenG\BladeMacro\Macro;

if (!function_exists('m')) {
    function m($name, $arguments): string
    {
        return Macro::$macros[$name]($arguments);
    }
}
