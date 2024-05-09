<?php

namespace Seeme\Components\Fields;

use Log1x\AcfComposer\Field;
use Seeme\Components\Partials\PostCard;
use StoutLogic\AcfBuilder\FieldsBuilder;

/**
 * Class BuilderPost
 * @package App\Fields
 */
class Post extends Field
{
    /**
     * @return array|FieldsBuilder
     */
    public function fields()
    {
        $builder = new FieldsBuilder('post', [
          'position' => 'side'
        ]);
        $builder->setLocation('post_type', '==', 'post');
        $builder->addFields((new PostCard([
          'style' => 'tab'
        ]))->fields(['label' => '']));

        return $builder->build();
    }
}
