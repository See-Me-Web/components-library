<?php

namespace Seeme\Components\Partials\Styles\Background;

use Seeme\Components\Partials\Abstract\StylesPartial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class BackgroundVideo extends StylesPartial
{
  public static $slug = 'background-video';
  public static $parentSlug = 'background';

  public static $options = [
    'provider' => [
      'label' => 'Źródło filmu',
      'choices' => [
        'youtube' => 'YouTube',
        'file' => 'Plik'
      ],
      'default_value' => 'file'
    ]
  ];

  public static function getFields(): ?FieldsBuilder
  {
    $builder = new FieldsBuilder(static::$slug);

    $builder
        ->addFile('video', [
          'label' => 'Film',
          'mime_types' => 'mp4, mov, wmv, avi, ogv',
          'conditional_logic' => [
            [
              [
                'field' => 'provider',
                'operator' => '==',
                'value' => 'file'
              ]
            ]
          ]
        ])
        ->addText('youtube-id', [
          'label' => 'ID filmu YouTube',
          'conditional_logic' => [
            [
              [
                'field' => 'provider',
                'operator' => '==',
                'value' => 'youtube'
              ]
            ]
          ]
        ]);

    return $builder;
  }

  public static function hasVideo(): bool
  {
    $settings = static::getSettings();
    $provider = $settings['provider'] ?? static::getDefault('provider');

    return (
      ($provider === 'youtube' && isset($settings['youtube-id']) && !empty($settings['youtube-id'])) || 
      ($provider === 'file' && isset($settings['video']) && !empty($settings['video']))
    ); 
  }

  public static function getClasses(): array
  {
    $settings = static::getSettings();
    $classes = [];
    $provider = $settings['provider'] ?? static::getDefault('provider');

    $classes = array_merge($classes, static::getOptionsClasses());

    if(static::hasVideo()) {
      $classes[] = "z-10 relative overflow-hidden";
    }

    if(isset($settings['youtube-id']) && $provider === 'youtube') {
      $classes[] = "has-youtube-video-bg";
    }

    if(isset($settings['video']) && $provider === 'file') {
      $classes[] = "has-file-video-bg";
    }

    return $classes;
  }

  public static function getVariables(): array
  {
    $settings = static::getSettings();

    return [
      'provider' => $settings['provider'] ?? static::getDefault('provider'),
      'video' => $settings['video'] ?? [],
      'youtubeId' => $settings['youtube-id'] ?? false
    ];
  }
}