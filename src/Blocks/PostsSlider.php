<?php

namespace Seeme\Components\Blocks;

use Log1x\AcfComposer\AcfComposer;
use Seeme\Components\Blocks\Abstract\BaseBlock;
use Seeme\Components\Partials\Slider;
use Seeme\Components\Providers\CoreServiceProvider;
use StoutLogic\AcfBuilder\FieldsBuilder;

class PostsSlider extends BaseBlock
{
    public $styles_support = ['border', 'background', 'shadow'];

    public $partial = null;

    public function __construct(AcfComposer $composer)
    {
        $this->partial = new Slider(['parents' => ['slider-settings']]);
        parent::__construct($composer);
    }

    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Posts slider';

    /**
     * The block view.
     */
    public $view = CoreServiceProvider::NAMESPACE . '::blocks.posts-slider';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'Posts slider';

    /**
     * The block icon.
     *
     * @var string|array
     */
    public $icon = 'tagcloud';

    /**
     * The block keywords.
     *
     * @var array
     */
    public $keywords = [
        'post',
        'posts'
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
          'margin' => true,
        ],
        'color' => [
          'text' => true,
          'background' => false
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
          'posts' => $this->getPosts(),
          'sliderConfig' => $this->getSliderConfig(),
        ];
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
        $builder = new FieldsBuilder('posts-slider');

        $builder
          ->addAccordion('Posty')
            ->addFlexibleContent('posts')
              ->addLayout($this->getSlideLayout())
            ->endFlexibleContent()
          ->addAccordion('Ustawienia bloku')
            ->addGroup('slider-settings')
              ->addRange('slidesPerView', [
                'label' => 'Liczba slajdów na widok',
                'min' => 1,
                'step' => 0.1,
                'max' => 10,
                'default_value'
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
      $builder = new FieldsBuilder('post-layout', [
        'label' => 'Kafelek wpisu'
      ]);

      $builder
        ->addPostObject('post-id', [
          'label' => 'Post',
          'return_format' => 'id'
        ]);

      return $builder;
    }

    public function getPosts(): array
    {
      return array_map(fn($post) => $post['post-id'], get_field('posts') ?: []);
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

      $styles = array_merge($styles, $this->partial->getStyles());

      return $styles;
    }
}
