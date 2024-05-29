<?php

namespace Seeme\Components\Partials\Abstract;

use Illuminate\Support\Arr;
use Seeme\Components\Partials\Interfaces\IBasePartial;
use StoutLogic\AcfBuilder\FieldsBuilder;

abstract class BasePartial implements IBasePartial
{
  private const DEFAULT_ATTRIBUTES = [
    'title' => '',
    'style' => 'accordion',
    'parents' => [],
    'postId' => false,
    'args' => [],
    'excluded' => []
  ];

  public string $slug = '';
  public array $options = [];
  public array $optionsClasses = [];

  public array $attributes = [];

  public function getFields(): ?FieldsBuilder { return null; }
  public function getClasses(): array { return []; }
  public function getStyles(): array { return []; }
  public function getVariables(): array { return []; }

  public function __construct(array $attributes = [])
  {
    $this->attributes = [
      ...self::DEFAULT_ATTRIBUTES,
      ...$this->attributes,
      ...$attributes,
    ];
  }

  public function getLocation(): string
  {
    $parents = $this->attributes['parents'] ?? [];

    if(empty($parents)) {
      return '';
    }

    array_shift($parents);

    if(empty($parents)) {
      return $this->slug;
    }

    return implode('.', $parents) . '.' . $this->slug;
  }

  public function getFieldName()
  {
    $parents = $this->attributes['parents'] ?? [];
    return empty($parents) ? $this->slug : $parents[0];
  }
  
  public function getSettings(): array
  {
    $fields = [];
    $postId = $this->attributes['postId'] ?? false;
    $location = $this->getLocation();

    $fields = get_field($this->getFieldName(), $postId) ?: [];

    if(!empty($location)) {
      $fields = Arr::get($fields, $this->getLocation(), []);
    }
        
    return [
      ...(is_array($fields) ? $fields : []),
      ...$this->attributes['args'] ?? [],
    ];
  }

  /**
   * Return StoutLogic\AcfBuilder\FieldsBuilder with partial fields
   * 
   * @return FieldsBuilder|null
   */
  public function fields(array $args = []): ?FieldsBuilder
  {
    $builder = new FieldsBuilder($this->slug . '-partial');

    $title = $this->attributes['title'] ?? '';
    $style = $this->attributes['style'] ?? 'accordion';

    if(!empty($title) && $style === 'accordion') {
      $builder->addAccordion($title);
    }

    if( !empty($title) && $style === 'tab' ) {
      $builder->addTab($title);
    }

    $fields = $this->getFields();

    if( $fields ) {
      $builder
        ->addGroup($this->slug, $args)
        ->addFields($this->getOptionsFields())
        ->addFields($fields)
        ->endGroup();
    } else {
      $builder
        ->addGroup($this->slug, $args)
        ->addFields($this->getOptionsFields())
        ->endGroup();
    }

    return $builder;
  }

  public function getOptionsFields(): FieldsBuilder
  {
    $builder = new FieldsBuilder($this->slug . '-options');

    foreach($this->options as $option => $settings) {
      if( in_array($option, $this->attributes['excluded'] ?? []) ) {
        continue;
      }

      $builder
        ->addSelect($option, [
          'label' => $settings['label'] ?? $option,
          'choices' => $settings['choices'] ?? [],
          'default_value' => $settings['default_value'] ?? ''
        ]);
    }

    return $builder;
  }

  public function getOptionsClasses(): array
  {
    $settings = $this->getSettings();
    $classes = [];

    foreach($settings as $setting => $value) {
      if( in_array($setting, $this->attributes['excluded']) ) {
        continue;
      }

      if( 
        !in_array($setting, array_keys($this->options)) && 
        !in_array($setting, array_keys($this->attributes['args'])) 
      ) {
        continue;
      }

      $classes[] = $this->getOptionClasses($setting, $value);
    }

    return $classes;
  }

  public function getOptionClasses(string $option, string $value): string
  {
    $classes = $this->getFilteredClasses();
    return Arr::toCssClasses(Arr::get($classes, $option . '.' . $value, []));
  }

  public function getFilteredClasses()
  { 
    return apply_filters("sm/components/{$this->slug}/classes", $this->optionsClasses);
  }
}