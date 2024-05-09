<?php

namespace Seeme\Components\Ajax;

use Seeme\Components\Ajax\Abstract\AjaxAction;
use Seeme\Components\Helpers\ArticleHelper;
use Seeme\Components\Helpers\PortfolioHelper;

class PostsFeedAjax extends AjaxAction
{
    const ACTION = 'fetch_posts';
    const DEFAULT_POSTS_PER_PAGE = 4;
    const DEFAULT_SORTING = [
        'date' => 'DESC',
        'ID' => 'DESC'
    ];

    const POST_TYPES_CATEGORIES = [
        'post' => 'category',
        'portfolio' => 'portfolio_category',
        'offer' => 'offer_category'
    ];

    public static function getPosts($params): \WP_Query
    {
        if(is_array($params)) {
            $params = (object) $params;
        }

        $args = [
            'post_type'             => $params->postType ?? 'post',
            'posts_per_page'        => $params->perPage ?? static::DEFAULT_POSTS_PER_PAGE,
            'post_status'           => 'publish',
            'paged'                 => $params->page,
            'tax_query'             => [],
            'meta_query'            => [],
            'ignore_sticky_posts'   => true,
            'cache_results'         => false
        ];

        $taxQuery = [];
        $metaQuery = [];
        $orderBy = static::DEFAULT_SORTING;

        if ( ! empty($params->categories)) {
            $taxQuery[] = [
                'taxonomy' => static::POST_TYPES_CATEGORIES[$params->postType ?? 'post'],
                'field'    => 'term_id',
                'terms'    => $params->categories,
            ];
        }


        if ( ! empty($taxQuery)) {
            $args['tax_query'] = [
                'relation' => 'AND',
                ...$taxQuery,
            ];
        }

        if( ! empty($metaQuery)) {
            $args['meta_query'] = [
                'relation' => 'AND',
                ...$metaQuery
            ];
        }

        if ( ! empty($params->orderby)) {
            $orderBy[$params->orderby] = 'DESC';
        }

        if( !empty($orderBy) ) {
            $args['orderby'] = $orderBy;
        }

        return new \WP_Query($args);
    }

    public static function getCategories(string $postType): array
    {
        return get_terms([
            'taxonomy' => static::POST_TYPES_CATEGORIES[$postType] ?? 'category'
        ]);
    }

    public function getResponseData(): array
    {
        $params = $this->getParams();
        $query = static::getPosts($params);

        return [
            'posts' => array_map(fn($post) => $this->preparePost($post), $query->posts)
        ];
    }

    public function preparePost(\WP_Post $post)
    {
        switch($post->post_type) {
            case 'portfolio':
                return PortfolioHelper::prepareForTile($post->ID);
            default: 
                return ArticleHelper::prepareForTile($post->ID);
        }
    }

    private function getParams()
    {
        return (object) [
            'postType' => sanitize_text_field($_REQUEST['postType'] ?? 'post'),
            'perPage' => (int) sanitize_text_field($_REQUEST['perPage'] ?? static::POSTS_PER_PAGE),
            'page' => (int) sanitize_text_field($_REQUEST['page'] ?? 1),
            'categories' => array_map(
                fn($catId) => (int) sanitize_key($catId),
                (array) ($_REQUEST['categories'] ?? [])
            ),
        ];
    }

    public function verifyRequest()
    {
        return true;
    }
}
