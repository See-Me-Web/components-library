<?php

namespace Seeme\Components\StylesPartials;

use Illuminate\Support\Arr;
use Seeme\Components\StylesPartials\Abstract\BasePartial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class BackgroundVideo extends BasePartial
{
  public static function getProviders(): array
  {
    return apply_filters('sm/components/backgroundVideo/providers', [
      'youtube' => 'Youtube',
      'file' => 'Plik'
    ]);
  }

  public static function getDefaultProvider(): string
  {
    return apply_filters('sm/components/backgroundVideo/defaultProvider', 'file');
  }

  public static function getFields(): ?FieldsBuilder
  {
    $builder = new FieldsBuilder('background-video');

    $builder
      ->addGroup('background-video', [
        'conditional_logic' => [
          [
            [
              'field' => 'mode',
              'operator' => '==',
              'value' => 'video'
            ]
          ]
        ]
      ])
        ->addSelect('provider', [
          'label' => 'Źródło',
          'choices' => static::getProviders(),
          'default_value' => static::getDefaultProvider()
        ])
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

  public static function getClasses(): string
  {
    $settings = get_field('background-video');

    return Arr::toCssClasses([
      'has-youtube-video-bg' => isset($settings['youtube-id']) && !empty($settings['youtube-id']) && isset($settings['provider']) && $settings['provider'] === 'youtube',
      'has-file-video-bg' => isset($settings['video']) && !empty($settings['video']) && isset($settings['provider']) && $settings['provider'] === 'file'
    ]);
  }

  public static function hasVideo(): bool
  {
    $settings = get_field('background-video') ?: [];
    return (
            (isset($settings['youtube-id']) && !empty($settings['youtube-id'])) || 
            (isset($settings['video']) && !empty($settings['video']))
          );
  }

  public static function getStylesConfig(): array
  {
    $settings = get_field('background-video') ?: [];

    return [
      'backgroundVideo' => [
        'provider' => isset($settings['provider']) ? $settings['provider'] : static::getDefaultProvider(),
        'video' => isset($settings['video']) ? $settings['video'] : [],
        'youtubeId' => isset($settings['youtube-id']) ? $settings['youtube-id'] : false
      ]
    ];
  }
}