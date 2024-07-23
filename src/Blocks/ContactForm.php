<?php

namespace Seeme\Components\Blocks;

use Seeme\Components\Blocks\Abstract\BaseBlock;
use Seeme\Components\Providers\CoreServiceProvider;
use StoutLogic\AcfBuilder\FieldsBuilder;

class ContactForm extends BaseBlock
{
    public $category = 'sm-blocks-layout';

    /**
     * The block view path.
     */
    public $view = CoreServiceProvider::NAMESPACE . '::blocks.contact-form';

    /**
     * The block attributes.
     */
    public function attributes(): array
    {
        return [
            'slug' => 'contact-form',
            'name' => __('Contact Form', 'sm-components'),
            'description' => __('Contact Form', 'sm-components'),
            'icon' => 'email',
            'keywords' => ['contact', 'form'],
            'post_types' => [],
            'parent' => [],
            'mode' => 'preview',
            'supports' => [
                'align' => false,
                'align_text' => false,
                'align_content' => false,
                'full_height' => false,
                'anchor' => false,
                'mode' => false,
                'multiple' => true,
                'jsx' => true,
                'color' => [
                    'background' => false,
                    'text' => false,
                ],
                'spacing' => [
                  'margin' => true,
                  'padding' => true,
                  'blockGap' => true
                ]
            ],
        ];
    }

    /**
     * Data to be passed to the block before rendering.
     */
    public function getWith(): array
    {
        $formId = get_field('form') ?: null;

        if( !$formId ) {
          return [];
        }

        return [
          'form' => do_shortcode("[contact-form-7 id='$formId']")
        ];
    }

    /**
     * The block field group.
     */
    public function getBlockFields(): FieldsBuilder
    {
      $builder = new FieldsBuilder($this->getSlug());

      $builder
        ->addAccordion('Ustawienia bloku')
        ->addPostObject('form', [
          'label' => 'Formularz',
          'post_type' => 'wpcf7_contact_form',
          'return_format' => 'id'
        ]);

        return $builder;
    }
}