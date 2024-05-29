<?php

namespace Seeme\Components\Blocks;

use Seeme\Components\Blocks\Abstract\BaseBlock;
use Seeme\Components\Providers\CoreServiceProvider;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Breadcrumbs extends BaseBlock
{
    public $category = 'sm-blocks-layout';
    public $styles_support = ['text'];

    /**
     * Array of partials used by this block.
     */
    public array $partials = [];

    /**
     * The block view path.
     */
    public $view = CoreServiceProvider::NAMESPACE . '::blocks.breadcrumbs';

    /**
     * The block attributes.
     */
    public function attributes(): array
    {
        return [
            'slug' => 'breadcrumbs',
            'name' => __('Breadcrumbs', 'sm-components'),
            'description' => '',
            'icon' => 'admin-links',
            'keywords' => ['breadcrumbs'],
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
                ]
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
          'items' => $this->getBreadcrumbs()
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
    
    public function getBreadcrumbs(): array
    {
      global $post;
      $items = [];
      $homepageId = get_option('page_on_front');

      $items['home'] = $this->getBreadcrumb($homepageId);
      $ancestors = get_post_ancestors($post->ID);

      if( !empty($ancestors) ) {
        foreach($ancestors as $ancestor) {
          $items["ancestor-$ancestor"] = $this->getBreadcrumb($ancestor);
        }
      }

      if( $post->post_type !== 'page' ) {
        $postType = get_post_type_object($post->post_type);

        $items['archive'] = [
          'title' => $postType->labels->name,
          'url' => ''
        ];
      }

      if( $post->ID !== $homepageId ) {
        $items[$post->ID] = $this->getBreadcrumb($post->ID);
      }

      return $items;
    }

    public function getBreadcrumb(int $id): array
    {
      return [
        'title' => get_the_title($id),
        'url' => get_the_permalink($id)
      ];
    }
}
