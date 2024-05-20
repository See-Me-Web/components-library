<?php

namespace Seeme\Components\Fields;

use Log1x\AcfComposer\Field;
use Seeme\Components\Partials\Card;
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
        $builder = new FieldsBuilder('post');
        $builder
          ->setLocation('post_type', '==', 'post')
          ->or('post_type', '==', 'portfolio')
          ->or('post_type', '==', 'offer');

        $builder->addFields((new Card([
          'style' => 'tab'
        ]))->fields(['label' => '']));

        return $builder->build();
    }
}
