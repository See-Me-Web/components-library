<?php

namespace Seeme\Components\Blocks\Abstract;

use Illuminate\Support\Arr;
use Log1x\AcfComposer\Block;
use Seeme\Components\StylesPartials\Background;
use Seeme\Components\StylesPartials\Border;
use Seeme\Components\StylesPartials\Shadow;
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
        'aligncenter' => 'mx-auto',
        'alignright' => 'ml-auto',
        'is-position-top' => 'flex flex-col justify-start',
        'is-position-center' => 'flex flex-col justify-center',
        'is-position-bottom' => 'flex flex-col justify-end'
    ];

    /**
     * Replace gutenberg classes with Tailwind ones
     */
    public function getClasses(): string
    {
        $classes = explode(' ', parent::getClasses());

        $classes = Arr::toCssClasses([
            ...$classes,
            ...$this->getStylesClasses()
        ]);

        return str_replace(
            array_keys($this->classes_map),
            array_values($this->classes_map),
            $classes
        );
    }

    public function getStylesClasses(): array
    {
        $classes = [];

        foreach($this->styles_support as $partial) {
            if( $this->supportsStyles($partial) ) {
                $controller = $this->partials_controllers[$partial] ?? false;

                if( !$controller ) {
                    continue;
                }

                $classes[] = $controller::getClasses();
            }
        }

        return $classes;
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
                    ->addAccordion($controller::getFieldsTitle())
                    ->addFields($controller::getFields());
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

                $style[] = $controller::getStyle();
            }
        }

        return str_replace([
            'blockGap',
            'lineHeight'
        ], [
            'gap',
            'line-height'
        ], implode(';', $style));
    }

    public function getStylesConfig(): array
    {
        $config = [];

        foreach($this->styles_support as $partial) {
            if( $this->supportsStyles($partial) ) {
                $controller = $this->partials_controllers[$partial] ?? false;

                if( !$controller ) {
                    continue;
                }

                $config = array_merge($config, $controller::getStylesConfig());
            }
        }

        return $config;
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
}
