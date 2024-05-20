<?php

namespace Seeme\Components\Blocks;

use Seeme\Components\Blocks\Abstract\BaseBlock;
use Seeme\Components\Providers\CoreServiceProvider;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Section extends BaseBlock
{
    /**
     * The block styles.
     */
    public $styles_support = ['background', 'text', 'border', 'shadow'];

    /**
     * The block view path.
     */
    public $view = CoreServiceProvider::NAMESPACE . '::blocks.section';

    /**
     * The block attributes.
     */
    public function attributes(): array
    {
        return [
            'name' => __('Section', 'sm-components'),
            'description' => __('Section block', 'sm-components'),
            'icon' => 'tagcloud',
            'keywords' => ['section'],
            'post_types' => [],
            'parent' => [],
            'mode' => 'preview',
            'supports' => [
                'align' => false,
                'align_text' => false,
                'align_content' => true,
                'full_height' => true,
                'anchor' => true,
                'mode' => true,
                'multiple' => true,
                'jsx' => true,
                'spacing' => [
                    'padding' => true,
                    'margin' => true
                ],
                'color' => [
                    'text' => false,
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
        return [];
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function getBlockFields(): FieldsBuilder
    {
        $builder = new FieldsBuilder('section');

        return $builder;
    }
}
