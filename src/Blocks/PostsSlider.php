<?php

namespace Seeme\Components\Blocks;

use Log1x\AcfComposer\AcfComposer;
use Seeme\Components\Blocks\Abstract\BaseBlock;
use Seeme\Components\Helpers\ViewHelper;
use Seeme\Components\Partials\Slider;
use Seeme\Components\Partials\Variant;
use Seeme\Components\Providers\CoreServiceProvider;
use StoutLogic\AcfBuilder\FieldsBuilder;

class PostsSlider extends BaseBlock
{
    public $category = 'sm-blocks-posts';

    /**
     * The block styles.
     */
    public $styles_support = ['border', 'background', 'shadow'];

    public $partials = [];

    /**
     * The block view path.
     */
    public $view = CoreServiceProvider::NAMESPACE . '::blocks.posts-slider';

    /**
     * The block constructor.
     */
    public function __construct(AcfComposer $composer)
    {
        $this->partials = [
          'slider' =>  new Slider(['parents' => ['slider-settings'], 'excluded' => ['effect', 'loop']]),
          'variant' => new Variant()
        ];

        parent::__construct($composer);
    }

    /**
     * The block attributes.
     */
    public function attributes(): array
    {
      return [
        'slug' => 'posts-slider',
        'name' => __('Posts slider', 'sm-components'),
        'description' => __('Posts slider block', 'sm-components'),
        'icon' => 'tagcloud',
        'keywords' => ['slider', 'posts'],
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
            'padding' => true,
            'margin' => true,
          ],
          'color' => [
            'text' => true,
            'background' => false
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
        return [
          'slides' => $this->getSlides(),
          'sliderConfig' => $this->getSliderConfig(),
          'blockVariant' => $this->partials['variant']->getVariant()
        ];
    }

    public function getSliderConfig(): array
    {
      return [
        ...$this->partials['slider']->getVariables(),
        'config' => [
          ...$this->partials['slider']->getConfig(),
          'slidesPerView' => 1.2,
          'slidesOffsetBefore' => 16,
          'spaceBetween' => 10,
          'breakpoints' => [
            586 => [
              'slidesPerView' => 2.2
            ],
            768 => [
              'slidesOffsetBefore' => 32,
              'slidesPerView' => 3.2
            ],
            992 => [
              'slidesOffsetBefore' => 128,
              'slidesPerView' => 4.5
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
          ->addFields($this->partials['variant']->fields())
          ->addAccordion('Posty')
            ->addFlexibleContent('slides')
              ->addLayout($this->getPostLayout())
              ->addLayout($this->getImageLayout())
              ->addLayout($this->getGalleryLayout())
              ->addLayout($this->getPageLayout())
            ->endFlexibleContent()
          ->addAccordion('Ustawienia bloku')
            ->addGroup('slider-settings')
              ->addFields($this->partials['slider']->fields())
            ->endGroup();


        return $builder;
    }

    public function getPostLayout(): FieldsBuilder
    {
      $builder = new FieldsBuilder('post-layout', [
        'label' => 'Kafelek - wpis'
      ]);

      $builder
        ->addPostObject('post-id', [
          'label' => 'Post',
          'return_format' => 'id'
        ]);

      return $builder;
    }

    public function getImageLayout(): FieldsBuilder
    {
      $builder = new FieldsBuilder('image-layout', [
        'label' => 'Kafelek - zdjęcie',
      ]);

      $builder
        ->addImage('image', [
          'label' => 'Zdjęcie',
          'return_format' => 'id'
        ]);

      return $builder;
    }

    public function getGalleryLayout(): FieldsBuilder
    {
      $builder = new FieldsBuilder('gallery-layout', [
        'label' => 'Kafelek - galeria'
      ]);

      $builder
        ->addGallery('gallery', [
          'label' => 'Galeria',
          'return_format' => 'id'
        ]);

      return $builder;
    }

    public function getPageLayout(): FieldsBuilder
    {
      $builder = new FieldsBuilder('page-layout', [
        'label' => 'Kafelek - strona'
      ]);

      $builder
        ->addPostObject('page', [
          'post_type' => 'page',
          'return_format' => 'id'
        ]);

      return $builder;
    }

    public function getSlides(): array
    {
      return array_map(function($slide) {
        return [
          'type' => $slide['acf_fc_layout'] ?? 'post-layout',
          ...$this->prepareSlide($slide)
        ];
      }, get_field('slides') ?: []);
    }

    public function prepareSlide($slide): array
    {
      switch($slide['acf_fc_layout'] ?? 'post-layout') {
        case 'image-layout':
          return [
            'image' => ViewHelper::prepareImage($slide['image'], 'large')
          ];
        case 'gallery-layout':
          return [
            'images' => array_map(fn ($image) => ViewHelper::prepareImage($image, 'large'), $slide['gallery'])
          ];
        case 'page-layout':
          $pageId = $slide['page'] ?? false;

          return [
            'permalink' => $pageId ? get_the_permalink($pageId) : false,
            'title' => $pageId ? get_the_title($pageId) : false,
            'thumbnail' => $pageId ? ViewHelper::prepareImage(get_post_thumbnail_id($pageId), 'large') : false
          ];
        default:
          return $slide;
      }
    }

    public function getAdditionalClasses(): array
    {
      $classes = [];

      $classes = array_merge($classes, $this->partials['slider']->getClasses());

      return $classes;
    }

    public function getAdditionalStyles(): array
    {
      $styles = [];

      $styles = array_merge($styles, $this->partials['slider']->getStyles());

      return $styles;
    }
}
