<?php

namespace Seeme\Components\Blocks;

use Seeme\Components\Blocks\Abstract\BaseBlock;
use Seeme\Components\Providers\CoreServiceProvider;
use StoutLogic\AcfBuilder\FieldsBuilder;

class ContactAccordeon extends BaseBlock
{
    /**
     * The block view path.
     */
    public $view = CoreServiceProvider::NAMESPACE . '::blocks.contact-accordeon';

    /**
     * The block attributes.
     */
    public function attributes(): array
    {
      return [
        'name' => __('Contact accordeon', 'sm-components'),
        'description' => '',
        'icon' => 'arrow-down-alt2',
        'keywords' => ['accordeon'],
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
          'open' => get_field('open'),
          'title' => get_field('title') ?: '',
          'allowedBlocks' => [
            'core/paragraph',
            'acf/icon',
            'acf/icons'
          ]
        ];
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function getBlockFields(): FieldsBuilder
    {
        $builder = new FieldsBuilder('contact-accordeon');

        $builder
          ->addAccordion('Ustawienia bloku')
          ->addText('title', [
            'label' => 'Tytuł'
          ])
          ->addTrueFalse('open', [
            'label' => 'Domyślnie otwarte',
            'default_value' => false
          ]);

        return $builder;
    }

    public function getAdditionalClasses(): array
    {
      return [];
    }

    public function getAdditionalStyles(): array
    {
      return [];
    }
}
