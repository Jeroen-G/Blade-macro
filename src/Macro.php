<?php

declare(strict_types=1);

namespace JeroenG\BladeMacro;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Blade;

final class Macro
{
    public static array $macros = [];

    public static function create($args, $macro): string
    {
        return Blade::render($macro, $args[0] ?? []);
    }

    public static function show(string $expression): string
    {
        $arguments = self::extractArgs($expression);
        $macroName = $arguments->first();

        if (!array_key_exists($macroName, self::$macros)) {
            throw new \Exception("The `$macroName` macro is not defined.");
        }

        $args = $arguments->except([0])->implode(',');
        return "<?php echo \JeroenG\BladeMacro\Macro::\$macros['$macroName']($args); ?>";
    }

    public static function define($macroName): string
    {
        return "<?php \JeroenG\BladeMacro\Macro::\$macros['$macroName'] = fn(...\$args) => JeroenG\BladeMacro\Macro::create(\$args, '";
    }

    public static function endDefinition(): string
    {
        return "'); ?>";
    }

    private static function extractArgs($expression): Collection
    {
        return collect(explode(',', $expression))->map(function ($item) {
            return trim($item);
        });
    }
}
