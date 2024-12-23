<?php

namespace Seeme\Components\Partials\Background;

use Seeme\Components\Partials\Abstract\BasePartial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class BackgroundVideo extends BasePartial
{
  public string $slug = 'background-video';

  public array $options = [
    'provider' => [
      'label' => 'Źródło filmu',
      'choices' => [
        'youtube' => 'YouTube',
        'file' => 'Plik'
      ],
      'default_value' => 'file'
    ]
  ];

  public function getFields(): ?FieldsBuilder
  {
    $builder = new FieldsBuilder($this->slug);

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
        ->addFile('mobile-video', [
          'label' => 'Film mobile',
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

  public function hasVideo(): bool
  {
    $settings = $this->getSettings();
    $provider = $settings['provider'] ?? 'file';

    return (
      ($provider === 'youtube' && isset($settings['youtube-id']) && !empty($settings['youtube-id'])) || 
      ($provider === 'file' && isset($settings['video']) && !empty($settings['video']))
    ); 
  }

  public function getClasses(): array
  {
    $settings = $this->getSettings();
    $classes = [];
    $provider = $settings['provider'] ?? 'file';

    $classes = array_merge($classes, $this->getOptionsClasses());

    if($this->hasVideo()) {
      $classes[] = "z-10 relative overflow-hidden";
    }

    if(isset($settings['youtube-id']) && $provider === 'youtube') {
      $classes[] = "has-youtube-video-bg";
    }

    if(isset($settings['video']) && $provider === 'file') {
      $classes[] = "has-file-video-bg";
    }

    if(isset($settings['mobile-video']) && $provider === 'file') {
      $classes[] = "has-mobile-file-video-bg";
    }

    return $classes;
  }

  public function getVariables(): array
  {
    $settings = $this->getSettings();

    return [
      'provider' => $settings['provider'] ?? 'file',
      'video' => $settings['video'] ?? [],
      'mobileVideo' => $settings['mobile-video'] ?? [],
      'youtubeId' => $settings['youtube-id'] ?? false
    ];
  }
}