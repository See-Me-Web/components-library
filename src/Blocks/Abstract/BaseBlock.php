<?php

namespace Seeme\Components\Blocks\Abstract;

use Illuminate\Support\Arr;
use Log1x\AcfComposer\Block;
use Seeme\Components\Helpers\ArrHelper;
use Seeme\Components\Helpers\CacheHelper;
use Seeme\Components\Partials\Abstract\BasePartial;
use Seeme\Components\Partials\Background;
use Seeme\Components\Partials\Border;
use Seeme\Components\Partials\Position;
use Seeme\Components\Partials\Shadow;
use Seeme\Components\Partials\Text;
use StoutLogic\AcfBuilder\FieldsBuilder;

abstract class BaseBlock extends Block
{
    /**
     * The block category.
     *
     * @var string
     */
    public $category = 'sm-blocks';

    public $styles_support = [];

    public $partials_controllers = [
        'background' => Background::class,
        'text' => Text::class,
        'border' => Border::class,
        'shadow' => Shadow::class,
        'position' => Position::class
    ];

    public $classes_map = [
        'align-text-left' => 'text-left',
        'align-text-center' => 'text-center',
        'align-text-right' => 'text-right',
        'full-height' => 'min-h-[80vh]',
        'alignleft' => 'ml-0 mr-auto',
        'aligncenter' => 'mx-auto',
        'alignright' => 'mr-0 ml-auto',
        'is-position-top' => 'flex flex-col justify-start',
        'is-position-center' => 'flex flex-col justify-center',
        'is-position-bottom' => 'flex flex-col justify-end'
    ];

    public $styles_map = [
        'blockGap' => 'gap',
        'lineHeight' => 'line-height'
    ];

    abstract public function getWith(): array;
    abstract public function getBlockFields(): FieldsBuilder;

    /**
     * Replace gutenberg classes with Tailwind ones
     */
    public function getClasses(): string
    {
        return CacheHelper::conditionalRemember(
            ! is_admin(),
            "block-{$this->block->id}-classes",
            8 * HOUR_IN_SECONDS,
            function() {
                $classes = explode(' ', parent::getClasses());

                $this->forEachPartial(function($partial) use(&$classes) {
                    $classes[] = Arr::toCssClasses($partial->getClasses());
                });
        
                $classes = Arr::toCssClasses([
                    ...$classes,
                    ...$this->getAdditionalClasses()
                ]);
        
                return str_replace(
                    [...array_keys($this->classes_map), "wp-block-{$this->slug}"],
                    [...array_values($this->classes_map), "wp-block-sm-{$this->slug}"],
                    $classes
                );
            }
        );
    }

    /**
     * Get block style property from gutenberg settings
     * 
     * @return string
     */
    public function getStyle(): string
    {
        return CacheHelper::conditionalRemember(
            ! is_admin(),
            "block-{$this->block->id}-style",
            8 * HOUR_IN_SECONDS,
            function() {
                $styleSettings = $this->block->style ?? [];

                $style = array_map(fn ($setting) => $this->computeStyle($setting), $styleSettings);
        
                if (isset($this->block->backgroundColor)) {
                    $style[] = "background-color: var(--wp--preset--color--{$this->block->backgroundColor})";
                }
        
                if (isset($this->block->textColor)) {
                    $style[] = ";color: var(--wp--preset--color--{$this->block->textColor})";
                }
                
                $this->forEachPartial(function($partial) use(&$style) {
                    $style[] = ArrHelper::toCssStyles($partial->getStyles());
                });
        
                $style = array_merge($style, $this->getAdditionalStyles());
        
                $style = implode(';', $style);
        
                return str_replace(
                    array_keys($this->styles_map),
                    array_values($this->styles_map),
                    $style
                );
            }
        );
    }

    public function getStylesVariables(): array
    {
        return CacheHelper::conditionalRemember(
            ! is_admin(),
            "block-{$this->block->id}-variables",
            8 * HOUR_IN_SECONDS,
            function() {
                $variables = [];

                $this->forEachPartial(function($partial) use(&$variables) {
                    $variables = array_merge($variables, $partial->getVariables());
                });
        
                return $variables;
            }
        );
    }

    /**
     * Check if block supports custom styles
     * 
     * @return bool
     */
    public function supportsStyles(string $style): bool
    {
        return in_array($style, $this->styles_support);
    }

    public function forEachPartial(callable $callback) {
        if( empty($this->styles_support) ) {
            return;
        }

        foreach($this->styles_support as $partial) {
            if( $this->supportsStyles($partial) ) {
                $className = $this->partials_controllers[$partial] ?? false;

                if( !$className ) {
                    continue;
                }

                $partialController = new $className;

                if( !$partialController || ! $partialController instanceof BasePartial ) {
                    continue;
                }

                $callback($partialController);
            }
        }
    }

    /**
     * Compute style from gutenberg settings.
     * 
     * @param array $setting
     * 
     * @return string
     */
    protected function computeStyle($setting): string 
    {
        $properties = Arr::dot($setting);

        $styles = array_map(
            fn ($value, $property) => $property . ':' . $this->getPropertyValue($value),
            array_values($properties),
            array_keys($properties)
        );

        return implode(';', $styles);
    }

    /**
     * Get property value for stle entry.
     * 
     * @param string $value
     * 
     * @return string
     */
    protected function getPropertyValue(string $value): string
    {
        $prefix = 'var:';
        $prefix_len = strlen($prefix);
        $token_in = '|';
        $token_out = '--';

        if (0 === strncmp($value, $prefix, $prefix_len)) {
            $unwrapped_name = str_replace(
                $token_in,
                $token_out,
                substr($value, $prefix_len)
            );
            $value = "var(--wp--$unwrapped_name)";
        }

        return $value;
    }

    public function getAdditionalClasses(): array
    {
        return [];
    }

    public function getAdditionalStyles(): array
    {
        return [];
    }

    public function with()
    {
        return CacheHelper::conditionalRemember(
            ! is_admin(),
            "block-{$this->block->id}-with",
            8 * HOUR_IN_SECONDS,
            fn() => [
                'style' => $this->getStyle(),
                ...$this->getStylesVariables(),
                ...$this->getWith()
            ]
        );
    }

    public function getStylesFields()
    {
        $builder = new FieldsBuilder('styles');

        $this->forEachPartial(function($partial) use(&$builder) {
            $builder
                ->addFields($partial->fields());
        });

        return $builder;
    }

    public function fields()
    {
        $builder = $this->getBlockFields();

        $builder
            ->addFields($this->getStylesFields());

        return $builder->build();
    }

    public function getSlug(): string
    {
        return Arr::get($this->attributes(), 'slug', '');
    }
}
