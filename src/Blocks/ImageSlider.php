<?php

namespace Seeme\Components\Blocks;

use Seeme\Components\Blocks\Abstract\BaseBlock;
use Seeme\Components\Helpers\ViewHelper;
use Seeme\Components\Partials\Utilities\Slider;
use Seeme\Components\Providers\CoreServiceProvider;
use StoutLogic\AcfBuilder\FieldsBuilder;

class ImageSlider extends BaseBlock
{
    public $styles_support = ['border', 'background', 'shadow'];

    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Image slider';

    /**
     * The block view.
     */
    public $view = CoreServiceProvider::NAMESPACE . '::blocks.image-slider';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'Slider with images';

    /**
     * The block icon.
     *
     * @var string|array
     */
    public $icon = 'slides';

    /**
     * The block keywords.
     *
     * @var array
     */
    public $keywords = [
        'slider',
        'image'
    ];

    /**
     * The block post type allow list.
     *
     * @var array
     */
    public $post_types = [];

    /**
     * The parent block type allow list.
     *
     * @var array
     */
    public $parent = [];

    /**
     * The default block mode.
     *
     * @var string
     */
    public $mode = 'preview';

    /**
     * The default block alignment.
     *
     * @var string
     */
    public $align = '';

    /**
     * The default block text alignment.
     *
     * @var string
     */
    public $align_text = '';

    /**
     * The default block content alignment.
     *
     * @var string
     */
    public $align_content = '';

    /**
     * The supported block features.
     *
     * @var array
     */
    public $supports = [
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
          'margin' => true
        ],
        'color' => [
          'text' => true,
          'background' => true
        ],
    ];

    /**
     * The block styles.
     *
     * @var array
     */
    public $styles = [];

    /**
     * Data to be passed to the block before rendering.
     *
     * @return array
     */
    public function getWith(): array
    {
        return [
          'slides' => $this->getSlides(),
          'sliderConfig' => $this->getSliderConfig()
        ];
    }

    public function getSlides(): array
    {
      return array_map(fn ($slide) => [
        'link' => ViewHelper::prepareLink($slide['link'] ?: []),
        'image' => ViewHelper::prepareImage($slide['image'] ?? 0)
      ], get_field('slides') ?: []);
    }

    public function getSliderConfig(): array
    {
      $variables = Slider::getVariables('slider-settings');
      $config = [
        'slidesPerView' => 2,
        'spaceBetween' => get_field('spaceBetween') ?: 20,
        'breakpoints' => [
          768 => [
            'slidesPerView' => 4
          ],
          992 => [
            'slidesPerView' => get_field('slidesPerView') ?: 8
          ]
        ]
      ];

      $variables['config'] = [
        $variables['config'],
        ...$config
      ];

      return $variables;
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function getBlockFields(): FieldsBuilder
    {
        $builder = new FieldsBuilder('image-slider');

        $builder
          ->addAccordion('Ustawienia bloku')
          ->addFlexibleContent('slides')
            ->addLayout($this->getSlideLayout())
          ->endFlexibleContent()
          ->addGroup('slider-settings')
            ->addNumber('slidesPerView', [
              'label' => 'Liczba slajdów na widok',
              'min' => 1,
              'step' => 1,
              'max' => 8,
              'default_value' => 8
            ])
            ->addRange('spaceBetween', [
              'label' => 'Odstęp pomiędzy slajdami',
              'append' => 'px',
              'min' => 0,
              'step' => 1,
              'max' => 100,
              'default_value' => 20
            ])
            ->addFields(Slider::fields())
          ->endGroup();

        return $builder;
    }

    public function getSlideLayout(): FieldsBuilder
    {
      $builder = new FieldsBuilder('slide');

      $builder
        ->addImage('image', [
          'label' => 'Obraz',
          'return_format' => 'id'
        ])
        ->addLink('link');

      return $builder;
    }

    public function getAdditionalClasses(): array
    {
      $classes = [];

      $classes = array_merge($classes, Slider::getClasses('slider-settings'));

      return [];
    }

    public function getAdditionalStyles(): array
    {
      $styles = [];
      $sliderSettings = get_field('slider-settings') ?: [];

      if(isset($sliderSettings['slidesPerView'])) {
        $styles[] = "--slides-per-view: {$sliderSettings['slidesPerView']}";
      }

      if(isset($sliderSettings['spaceBetween'])) {
        $styles[] = "--space-between: {$sliderSettings['spaceBetween']}px";
      }

      return $styles;
    }
}
