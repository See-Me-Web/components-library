<?php

namespace Seeme\Components\Partials\Abstract;

use Illuminate\Support\Arr;
use Seeme\Components\Partials\Interfaces\IBasePartial;
use StoutLogic\AcfBuilder\FieldsBuilder;

abstract class BasePartial implements IBasePartial
{
  public static $slug = '';
  public static $title = '';
  public static $options = [];
  public static $optionsClasses = [];

  /**
   * Return StoutLogic\AcfBuilder\FieldsBuilder with partial fields
   * 
   * @return FieldsBuilder|null
   */
  public static function fields(array $args = []): ?FieldsBuilder
  {
    $builder = new FieldsBuilder(static::$slug . '-partial');

    if(!empty(static::$title)) {
      $builder->addAccordion(static::$title);
    }

    $builder
      ->addGroup(static::$slug, $args)
      ->addFields(static::getOptionsFields())
      ->addFields(static::getFields())
      ->endGroup();

    return $builder;
  }

  public static function getOptionsFields(): FieldsBuilder
  {
    $builder = new FieldsBuilder(static::$slug . '-options');

    foreach(static::$options as $option => $settings) {
      $builder
        ->addSelect($option, [
          'label' => $settings['label'] ?? $option,
          'choices' => $settings['choices'] ?? [],
          'default_value' => $settings['default_value'] ?? ''
        ]);
    }

    return $builder;
  }

  public static function getChoices(string $option): array
  {
    return Arr::get(static::$options, $option . '.choices', []);
  }

  public static function getDefault(string $option): string
  {
    return Arr::get(static::$options, $option . '.default_value', '');
  }

  public static function getOptionClasses(string $option, string $value): string
  {
    return Arr::toCssClasses(Arr::get(static::$optionsClasses, $option . '.' . $value, []));
  }
}