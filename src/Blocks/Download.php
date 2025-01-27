<?php

namespace Seeme\Components\Blocks;

use Seeme\Components\Blocks\Abstract\BaseBlock;
use Seeme\Components\Providers\CoreServiceProvider;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Download extends BaseBlock
{
    /**
     * The block view path.
     */
    public $view = CoreServiceProvider::NAMESPACE . '::blocks.download';

    /**
     * The block attributes.
     */
    public function attributes(): array
    {
        return [
            'slug' => 'download',
            'name' => __('Download', 'sm-components'),
            'description' => __('File to download', 'sm-components'),
            'icon' => 'download',
            'keywords' => ['file', 'download'],
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
          'file' => get_field('file')
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
          ->addFile('file', [
            'label' => 'Plik'
          ]);
        
        return $builder;
    }
}
