<?php

namespace Seeme\Components\Blocks\Abstract;

use Illuminate\Support\Arr;
use Log1x\AcfComposer\Block;

abstract class BaseBlock extends Block
{
    /**
     * The block category.
     *
     * @var string
     */
    public $category = 'sm-blocks';

    /**
     * Replace gutenberg classes with Tailwind ones
     */
    public function getClasses(): string
    {
        return str_replace([
            'align-text-center',
            'align-text-right',
            'full-height'
        ], 
        [
            'text-center',
            'text-right',
            'min-h-[100vh]'
        ], parent::getClasses());
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

        return str_replace([
            'blockGap',
            'lineHeight'
        ], [
            'gap',
            'line-height'
        ], implode(';', $style));
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
