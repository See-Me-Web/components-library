<?php

namespace Seeme\Components\Blocks;

use Log1x\AcfComposer\AcfComposer;
use Seeme\Components\Blocks\Abstract\BaseBlock;
use Seeme\Components\Helpers\ViewHelper;
use Seeme\Components\Partials\Slider;
use Seeme\Components\Providers\CoreServiceProvider;
use StoutLogic\AcfBuilder\FieldsBuilder;

class ImageSlider extends BaseBlock
{
    /**
     * The block styles.
     */
    public $styles_support = ['background', 'border', 'shadow'];

    public $partial = null;

    /**
     * The block view path.
     */
    public $view = CoreServiceProvider::NAMESPACE . '::blocks.image-slider';

    /**
     * The block constructor.
     */
    public function __construct(AcfComposer $composer)
    {
        $this->partial = new Slider(['parents' => ['slider-settings']]);
        parent::__construct($composer);
    }

    /**
     * The block attributes.
     */
    public function attributes(): array
    {
      return [
        'name' => __('Image slider', 'sm-components'),
        'description' => __('Slider with images', 'sm-components'),
        'icon' => 'slides',
        'keywords' => ['slider', 'image'],
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
            'margin' => true
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
      return [
        'slidesPerView' => get_field('slidesPerView') ?: 4,
        'spaceBetween' => get_field('spaceBetween') ?: 20,
        'config' => get_field('slider-settings')
      ];
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
            ->addFields($this->partial->fields())
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

      $classes = array_merge($classes, $this->partial->getClasses());

      return $classes;
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
