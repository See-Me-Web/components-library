<?php

namespace Seeme\Components\Blocks;

use Seeme\Components\Blocks\Abstract\BaseBlock;
use Seeme\Components\Providers\CoreServiceProvider;
use StoutLogic\AcfBuilder\FieldsBuilder;

class AnimatedText extends BaseBlock
{
    /**
     * The block view path.
     */
    public $view = CoreServiceProvider::NAMESPACE . '::blocks.animated-text';

    /**
     * The block attributes.
     */
    public function attributes(): array
    {
        return [
            'slug' => 'animated-text',
            'name' => __('Animated text', 'sm-components'),
            'description' => __('Text animated on page scroll', 'sm-components'),
            'icon' => 'heading',
            'keywords' => ['animated'],
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
                'jsx' => false,
                'spacing' => [
                    'padding' => ['top', 'bottom'],
                    'margin' => ['top', 'bottom'],
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
            'text' => get_field('text') ?: '',
            'speedFactor' => (float) get_field('speedFactor'),
            'fontSize' => get_field('fontSize') ?: 17,
        ];
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function getBlockFields(): FieldsBuilder
    {
        $builder = new FieldsBuilder($this->getSlug());

        $builder
          ->addAccordion('Ustawienia bloku')
          ->addTextarea('text', [
              'label' => 'Tekst',
              'rows' => 3,
              'new_lines' => 'br'
          ])
          ->addRange('speedFactor', [
            'label' => 'Czynnik szybkości',
            'instructions' => 'Im większa liczba tym tekst szybciej przesunie się poza ekran',
            'step' => 0.1,
            'min' => 0,
            'max' => 5,
            'default_value' => 1.5
          ])
          ->addRange('fontSize', [
            'label' => 'Wielkość tekstu',
            'min' => 1,
            'max' => 30,
            'step' => 0.5,
            'append' => 'vw',
            'default_value' => 17
          ]);

        return $builder;
    }

    public function getAdditionalStyles(): array
    {
        $fontSize = get_field('fontSize') ?: 17;

        return [
            "--font-size: {$fontSize}vw"
        ];
    }
}
