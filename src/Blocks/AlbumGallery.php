<?php

namespace Seeme\Components\Blocks;

use Illuminate\Support\Arr;
use Seeme\Components\Blocks\Abstract\BaseBlock;
use Seeme\Components\Helpers\TemplateHelper;
use Seeme\Components\Models\Album;
use Seeme\Components\Providers\CoreServiceProvider;
use StoutLogic\AcfBuilder\FieldsBuilder;

class AlbumGallery extends BaseBlock
{
    /**
     * The block view path.
     */
    public $view = CoreServiceProvider::NAMESPACE . '::blocks.album-gallery';

    private ?Album $mainAlbum = null;
    private array $albums = [];

    /**
     * The block attributes.
     */
    public function attributes(): array
    {
        return [
            'slug' => 'album-gallery',
            'name' => __('Album Gallery', 'sm-components'),
            'description' => __('Album grid gallery', 'sm-components'),
            'icon' => 'format-gallery',
            'keywords' => ['images', 'gallery'],
            'post_types' => [],
            'parent' => [],
            'mode' => 'preview',
            'supports' => [
                'align' => false,
                'align_text' => false,
                'align_content' => false,
                'full_height' => false,
                'anchor' => true,
                'mode' => true,
                'multiple' => true,
                'jsx' => true,
                'spacing' => [
                    'padding' => ['top', 'bottom'],
                    'margin' => ['top', 'bottom'],
                    'blockGap' => true
                ],
            ]
        ];
    }
    
    /**
     * Data to be passed to the block before rendering.
     *
     * @return array
     */
    public function getWith(): array
    {
        $this->setAlbums();

        return [
          'columns' => get_field('columns') ?: 3,
          'mobileColumns' => get_field('mobile-columns') ?: 1,
          'albums' => $this->getAllAlbums(),
          'images' => $this->getAllImages(),
          'mainAlbumSlug' => $this->mainAlbum->slug,
          'paged' => get_field('paged'),
          'perPage' => (int) get_field('per-page') ?: 6,
          'displayCaption' => boolval(get_field('display-image-caption')),
          'allowedBlocks' => [
            'acf/heading'
          ],
          'template' => [
            [
              'acf/heading',
              [
                'data' => TemplateHelper::getPartialTemplate('heading', [
                    'text' => 'Podtytuł',
                    'size' => 'md',
                    'weight' => 'light',
                    'element' => 'h2',
                ])
              ]
            ],
            [
              'acf/heading',
              [
                'data' => TemplateHelper::getPartialTemplate('heading', [
                    'text' => 'Tytuł',
                    'size' => 'lg',
                    'weight' => 'bold',
                    'element' => 'h2',
                ]),
                'style' => [
                  'spacing' => [
                      'margin' => [
                          'bottom' => 'var:preset|spacing|sm'
                      ]
                  ]
                ]
              ]
            ]
          ]
        ];
    }

    /**
     * The block field group.
     *
     * @return FieldsBuilder
     */
    public function getBlockFields(): FieldsBuilder
    {
        $builder = new FieldsBuilder($this->getSlug());

        $builder
          ->addAccordion('Ustawienia bloku')
            ->addFlexibleContent('albums', [
              'label' => 'Albumy',
              'button_label' => 'Dodaj album'
            ])
              ->addLayout($this->getAlbumLayout())
            ->endFlexibleContent()
          ->addAccordion('Ustawienia wyświetlania')
          ->addRange('columns', [
            'label' => 'Liczba kolumn',
            'min' => 1,
            'max' => 6,
            'step' => 1,
            'default_value' => 3
          ])
          ->addRange('mobile-columns', [
            'label' => 'Liczba kolumn dla urządzeń mobilnych',
            'min' => 1,
            'max' => 6,
            'step' => 1,
            'default_value' => 1,
          ])
          ->addTrueFalse('paged', [
            'label' => 'Z podziałem na strony',
            'default_value' => false
          ])
          ->addRange('per-page', [
            'label' => 'Liczba zdjęć na stronę',
            'min' => 1,
            'default_value' => 6,
            'conditional_logic' => [
              [
                [
                  'field' => 'paged',
                  'operator' => '==',
                  'value' => '1'
                ]
              ]
            ]
          ])
          ->addTrueFalse('display-image-caption', [
            'label' => 'Wyświetlaj podpis zdjęć',
            'default_value' => false
          ]);
        
        return $builder;
    }

    public function getAlbumLayout()
    {
      $builder = new FieldsBuilder('album');

      $builder
        ->addText('title', [
          'label' => 'Tytuł'
        ])
        ->addGallery('images', [
          'label' => 'Obrazy',
          'return_format' => 'id'
        ]);

      return $builder;
    }

    public function setAlbums(): void
    {
      $this->albums = [];
      $this->mainAlbum = null;

      $albums = get_field('albums') ?: [];
      $allImages = [];

      foreach($albums as $album) {
        $images = Arr::get($album, 'images', []);

        if(is_array($images) && !empty($images)) {
          $a = new Album(Arr::get($album, 'title', ''));

          $a->setImages($images);
          $allImages = array_merge($allImages, $images);
  
          $this->albums[] = $a;
        }
      }

      $mainAlbum = new Album(__('All', 'sm-components'));
      $mainAlbum->setImages($allImages);

      $this->mainAlbum = $mainAlbum;
    }

    public function getAllAlbums(): array
    {
      return [
        ...$this->albums,
        $this->mainAlbum,
      ];
    }

    public function getAllImages(): array
    {
      if( empty($this->albums) ) {
        return [];
      }

      $images = [];

      foreach($this->albums as $album) {
        $albumImages = array_map(fn($image) => (object) [
          ...(array) $image,
          'album' => Arr::toCssClasses([
            $this->mainAlbum->slug,
            $album->slug
          ])
        ], $album->images);

        $images = array_merge($images, $albumImages);
      }

      return $images;
    }

    public function getAdditionalStyles(): array
    {
      $columns = get_field('columns') ?: 3;
      $mobileColumns = get_field('mobile-columns') ?: 1;

      return [
        "--columns: {$columns}",
        "--mobile-columns: {$mobileColumns}",
      ];
    }
}
