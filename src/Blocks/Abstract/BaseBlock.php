<?php

namespace Seeme\Components\Blocks\Abstract;

use Illuminate\Support\Arr;
use Log1x\AcfComposer\Block;
use Seeme\Components\Helpers\ArrHelper;
use Seeme\Components\Partials\Styles\Background;
use Seeme\Components\Partials\Styles\Border;
use Seeme\Components\Partials\Styles\Shadow;
use StoutLogic\AcfBuilder\FieldsBuilder;

abstract class BaseBlock extends Block
{
    /**
     * The block category.
     *
     * @var string
     */
    public $category = 'sm-blocks';

    public $styles_support = [
        // 'background',
        // 'border',
        // 'shadow'
    ];

    public $partials_controllers = [
        'background' => Background::class,
        'border' => Border::class,
        'shadow' => Shadow::class
    ];

    public $classes_map = [
        'align-text-left' => 'text-left',
        'align-text-center' => 'text-center',
        'align-text-right' => 'text-right',
        'full-height' => 'min-h-[80vh]',
        'alignleft' => 'mr-auto',
        'aligncenter' => '!mx-auto',
        'alignright' => 'ml-auto',
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
        $classes = explode(' ', parent::getClasses());

        foreach($this->styles_support as $partial) {
            if( $this->supportsStyles($partial) ) {
                $controller = $this->partials_controllers[$partial] ?? false;

                if( !$controller ) {
                    continue;
                }

                $classes[] = Arr::toCssClasses($controller::getClasses());
            }
        }

        $classes = Arr::toCssClasses([
            ...$classes,
            ...$this->getAdditionalClasses()
        ]);

        return str_replace(
            array_keys($this->classes_map),
            array_values($this->classes_map),
            $classes
        );
    }

    /**
     * Get block style property from gutenberg settings
     * 
     * @return string
     */
    public function getStyle(): string
    {
        $styleSettings = $this->block->style ?? [];

        $style = array_map(fn ($setting) => $this->computeStyle($setting), $styleSettings);

        if (isset($this->block->backgroundColor)) {
            $style[] = "background-color: var(--wp--preset--color--{$this->block->backgroundColor})";
        }

        if (isset($this->block->textColor)) {
            $style[] = ";color: var(--wp--preset--color--{$this->block->textColor})";
        }

        foreach($this->styles_support as $partial) {
            if( $this->supportsStyles($partial) ) {
                $controller = $this->partials_controllers[$partial] ?? false;

                if( !$controller ) {
                    continue;
                }

                $style[] = ArrHelper::toCssStyles($controller::getStyles());
            }
        }

        $style = array_merge($style, $this->getAdditionalStyles());

        $style = implode(';', $style);

        return str_replace(
            array_keys($this->styles_map),
            array_values($this->styles_map),
            $style
        );
    }

    public function getStylesFields()
    {
        $builder = new FieldsBuilder('styles');

        foreach($this->styles_support as $partial) {
            if( $this->supportsStyles($partial) ) {
                $controller = $this->partials_controllers[$partial] ?? false;

                if( !$controller ) {
                    continue;
                }

                $builder
                    ->addFields($controller::fields());
            }
        }

        return $builder;
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

    public function getStylesVariables(): array
    {
        $vars = [];

        foreach($this->styles_support as $partial) {
            if( $this->supportsStyles($partial) ) {
                $controller = $this->partials_controllers[$partial] ?? false;

                if( !$controller ) {
                    continue;
                }

                $vars = array_merge($vars, $controller::getVariables());
            }
        }

        return $vars;
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
            fn ($value, $property) => str_replace('.', '-', $property) . ":" . $this->getPropertyValue(($value)),
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
        return [
            'style' => $this->getStyle(),
            'stylesSupport' => $this->styles_support,
            ...$this->getStylesVariables(),
            ...$this->getWith()
        ];
    }

    public function fields() 
    {
        $builder = $this->getBlockFields();

        $builder
            ->addFields($this->getStylesFields());

        return $builder->build();
    }
}
