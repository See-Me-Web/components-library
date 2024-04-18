<?php

namespace Seeme\Components\Helpers;

use Illuminate\Support\Arr;
use Seeme\Components\Helpers\Abstract\ComponentHelper;
use StoutLogic\AcfBuilder\FieldsBuilder;

class HeadingHelper extends ComponentHelper
{
  private static $sizes = [
    'xs' => [
      'label' => 'Extra small',
      'classes' => 'heading-xs text-xs'
    ],
    'sm' => [
      'label' => 'Small',
      'classes' => 'heading-sm text-sm'
    ],
    'md' => [
      'label' => 'Medium',
      'classes' => 'heading-md text-base'
    ],
    'lg' => [
      'label' => 'Large',
      'classes' => 'heading-lg text-lg'
    ],
    'xl' => [
      'label' => 'Extra large',
      'classes' => 'heading-xl text-xl'
    ],
    '2xl' => [
      'label' => 'Extra large (2x)',
      'classes' => 'heading-xl text-2xl'
    ],
    '3xl' => [
      'label' => 'Extra large (3x)',
      'classes' => 'heading-xl text-3xl'
    ],
    '4xl' => [
      'label' => 'Extra large (4x)',
      'classes' => 'heading-xl text-4xl'
    ],
    '5xl' => [
      'label' => 'Extra large (5x)',
      'classes' => 'heading-xl text-5xl'
    ],
    '6xl' => [
      'label' => 'Extra large (6x)',
      'classes' => 'heading-xl text-6xl'
    ],
    '7xl' => [
      'label' => 'Extra large (7x)',
      'classes' => 'heading-xl text-7xl'
    ],
    '8xl' => [
      'label' => 'Extra large (8x)',
      'classes' => 'heading-xl text-8xl'
    ],
    '9xl' => [
      'label' => 'Extra large (9x)',
      'classes' => 'heading-xl text-9xl'
    ],
  ];

  private static $weights = [
    'light' => [
      'label' => 'Light',
      'classes' => 'font-light'
    ],
    'normal' => [
      'label' => 'Normal',
      'classes' => 'font-normal'
    ],
    'semibold' => [
      'label' => 'Semibold',
      'classes' => 'font-semibold'
    ],
    'bold' => [
      'label' => 'Bold',
      'classes' => 'font-bold'
    ],
    'black' => [
      'label' => 'Black',
      'classes' => 'font-black'
    ]
  ];

  public static function getSizes(): array
  {
    return apply_filters('sm/components/heading/sizes', static::$sizes);
  }

  public static function getDefaultSize(): string
  {
    return apply_filters('sm/components/heading/defaultSize', 'md');
  }

  public static function getWeights(): array
  {
    return apply_filters('sm/components/heading/weights', static::$weights);
  }

  public static function getDefaultWeight(): string
  {
    return apply_filters('sm/components/heading/defaultWeight', 'normal');
  }

  public static function getFields(): FieldsBuilder
  {
    $builder = new FieldsBuilder('heading');

    $builder
      ->addTextarea('text', [
          'label' => 'Tekst',
          'rows' => 3,
          'new_lines' => 'br'
      ])
      ->addSelect('size', [
          'label' => 'Rozmiar',
          'choices' => static::getOptions(static::getSizes()),
          'default_value' => static::getDefaultSize()
      ])
      ->addSelect('element', [
          'choices' => [
              'div' => 'Div',
              'h2' => 'H2',
              'h3' => 'H3',
              'h4' => 'H4',
              'h5' => 'H5',
              'h6' => 'H6',
          ],
          'default_value' => 'h3'
      ])
      ->addSelect('weight', [
          'label' => 'Grubość czcionki',
          'choices' => static::getOptions(static::getWeights()),
          'default_value' => static::getDefaultWeight()
      ]);

    return $builder;
  }

  public static function getCurrentSettings(): array
  {
    return [
      'text' => get_field('text'),
      'size' => get_field('size') ?: static::getDefaultSize(),
      'element' => get_field('element') ?: 'h3',
      'weight' => get_field('weight') ?: static::getDefaultWeight(),
    ];
  }

  public static function getClasses(string $size = 'md', string $weight = 'normal'): string
  {
    return Arr::toCssClasses([
      Arr::get(static::getSizes(), $size . '.classes', ''),
      Arr::get(static::getWeights(), $weight . '.classes', ''),
    ]);
  }
}