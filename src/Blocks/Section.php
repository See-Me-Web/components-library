<?php

namespace Seeme\Components\Blocks;

use Seeme\Components\Blocks\Abstract\BaseBlock;
use Seeme\Components\Helpers\TemplateHelper;
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
            'slug' => 'section',
            'name' => __('Section', 'sm-components'),
            'title' => __('Section', 'sm-components'),
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
        return [
            'template' => [
                [
                    'acf/wrapper',
                    [
                        'data' => TemplateHelper::getPartialTemplate('wrapper', [
                            'maxWidth' => 'xl',
                            'align' => 'center'
                        ]),
                        'style' => [
                            'spacing' => [
                                'padding' => [
                                    'left' => 'var:preset|spacing|sm',
                                    'right' => 'var:preset|spacing|sm'
                                ]
                            ]
                        ]
                    ],
                    [
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
                        ],
                        [
                            'core/paragraph',
                            [
                                'content' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Error laudantium voluptas tempora eveniet. Quos labore ex dolores molestiae neque delectus quibusdam perspiciatis rem odit, aperiam placeat nostrum dolore nesciunt saepe harum suscipit voluptate est? Voluptates ab molestias sed, nulla aspernatur voluptas minima et architecto assumenda saepe repellendus ullam. Velit, sit!'
                            ]
                        ]
                    ]
                ],
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
        $builder = new FieldsBuilder($this->getSlug());
        return $builder;
    }
}
