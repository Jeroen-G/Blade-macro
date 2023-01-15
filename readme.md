# Blade Macro

[![Latest Version on Packagist][ico-version]][link-packagist]

Have you as a Laravel developer ever looked at [Twig macros](https://twig.symfony.com/doc/3.x/tags/macro.html) with envy?

Maybe you want to reuse a specific element twice on the same page, but you don't want to have it (supported) as a Blade component.
With a Blade macro, you can. Here is an example:

```blade
@macro(listItem)
<li class="flex justify-center all-sorts-of-tailwind-classes"> {{ $name }} </li>
@endmacro

@if($conditionIsTrue)
    <ul>
        @foreach($listOne as $name)
            @showMacro(listItem, ['name' => $name])
        @endforeach
    </ul>
@else
    <ul>
        @foreach($listTwo as $name)
            @showMacro(listItem, ['name' => $name])
        @endforeach
    </ul>
@endif
```

## Installation

Via Composer

``` bash
$ composer require jeroen-g/blade-macro
```

## Usage

Define a macro with the Blade directives:

```blade
@macro(myMacroName)
<fancy-code />
@endMacro
```

Call the macro elsewhere _in the same Blade file_ with the Blade directive or PHP helper:

```php
@showMacro(myMacroName)
// or
{!! m('myMacroName') !!}
```

Do you want to use a macro in another Blade view? Use a [Blade component](https://laravel.com/docs/blade#components).

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Credits

- [Jeroen][link-author]
- [All Contributors][link-contributors]

## License

MIT. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/jeroen-g/blade-macro.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/jeroen-g/blade-macro
[link-author]: https://github.com/jeroen-g
[link-contributors]: ../../contributors
