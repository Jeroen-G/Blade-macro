<?php

declare(strict_types=1);

namespace JeroenG\BladeMacro\Tests;

use Illuminate\Support\Facades\Blade;
use JeroenG\BladeMacro\Macro;
use PHPUnit\Framework\TestCase;

class MacroTest extends TestCase
{
    protected function tearDown(): void
    {
        parent::tearDown();

        Macro::$macros = [];
    }

    public function test_a_definition_can_be_started(): void
    {
        $result = Macro::define('testcase');

        self::assertSame(
            "<?php \JeroenG\BladeMacro\Macro::\$macros['testcase'] = fn(...\$args) => JeroenG\BladeMacro\Macro::create(\$args, '",
            $result
        );
    }

    public function test_a_definition_can_be_finished(): void
    {
        $result = Macro::endDefinition();

        self::assertSame("'); ?>", $result);
    }

    public function test_creating_a_macro(): void
    {
        Blade::expects('render')->with('testcase', [])->andReturn('rendered with no arguments');
        Blade::expects('render')->with('testcase', ['foo' => 'bar'])->andReturn('rendered with arguments');

        $macroWithNoArguments = Macro::create([], 'testcase');
        $macroWithArguments = Macro::create([['foo' => 'bar']], 'testcase');

        self::assertSame('rendered with no arguments', $macroWithNoArguments);
        self::assertSame('rendered with arguments', $macroWithArguments);
    }

    public function test_show_macro(): void
    {
        Macro::$macros['testcase'] = 'hello';

        $macro = Macro::show('testcase');

        self::assertSame(
            "<?php echo \JeroenG\BladeMacro\Macro::\$macros['testcase'](); ?>",
            $macro
        );
    }

    public function test_showing_undefined_macro_throws_exception(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('The `testcase` macro is not defined.');

        self::assertEmpty(Macro::$macros);
        Macro::show('testcase');
    }
}
