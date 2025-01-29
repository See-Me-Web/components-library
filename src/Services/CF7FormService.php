<?php

namespace Seeme\Components\Services;

use Illuminate\View\AnonymousComponent;
use Seeme\Components\View\Components\Button;

class CF7FormService
{
    public function init()
    {
        if (!function_exists('wpcf7_add_form_tag')) {
            return;
        }

        remove_action('wpcf7_init', 'wpcf7_add_form_tag_text', 10, 0);
        add_action('wpcf7_init', function () {
            wpcf7_add_form_tag(
                array('text', 'text*', 'email', 'email*', 'url', 'url*', 'tel', 'tel*'),
                [$this, 'textFieldHandler'],
                array(
                    'name-attr' => true,
                )
            );
        });

        remove_action('wpcf7_init', 'wpcf7_add_form_tag_textarea', 10, 0);
        add_action('wpcf7_init', function () {
            wpcf7_add_form_tag(
                array('textarea', 'textarea*'),
                [$this, 'textareaFieldHandler'],
                array(
                    'name-attr' => true,
                )
            );
        });

        remove_action('wpcf7_init', 'wpcf7_add_form_tag_acceptance', 10, 0);
        add_action('wpcf7_init', function () {
            wpcf7_add_form_tag(
                'acceptance',
                [$this, 'acceptanceFieldHandler'],
                array(
                    'name-attr' => true,
                )
            );
        });

        remove_action('wpcf7_init', 'wpcf7_add_form_tag_submit', 10, 0);
        add_action('wpcf7_init', function () {
            wpcf7_add_form_tag(
                'submit',
                [$this, 'submitFieldHandler'],
            );
        });

        remove_action('wpcf7_init', 'wpcf7_add_form_tag_select', 10, 0);
        add_action('wpcf7_init', function () {
            wpcf7_add_form_tag(
                ['select', 'select*'],
                [$this, 'selectFieldHandler'],
                array(
                    'name-attr' => true,
                    'selectable-values' => true,
                )
            );
        });
    }

    public function textFieldHandler($tag): string
    {
        if (empty($tag->name)) {
            return '';
        }

        $validation_error = wpcf7_get_validation_error($tag->name);

        $class = wpcf7_form_controls_class($tag->type, 'wpcf7-text');

        if (in_array($tag->basetype, array('email', 'url'))) {
            $class .= ' wpcf7-validates-as-' . $tag->basetype;
        }

        if ($validation_error) {
            $class .= ' wpcf7-not-valid';
        }

        $atts = array();

        $atts['size'] = $tag->get_size_option('40');
        $atts['maxlength'] = $tag->get_maxlength_option();
        $atts['minlength'] = $tag->get_minlength_option();

        if (
            $atts['maxlength'] and $atts['minlength']
            and $atts['maxlength'] < $atts['minlength']
        ) {
            unset($atts['maxlength'], $atts['minlength']);
        }

        $atts['class'] = $tag->get_class_option($class);
        $atts['id'] = $tag->get_id_option();
        $atts['tabindex'] = $tag->get_option('tabindex', 'signed_int', true);
        $atts['readonly'] = $tag->has_option('readonly');

        $atts['autocomplete'] = $tag->get_option(
            'autocomplete',
            '[-0-9a-zA-Z]+',
            true
        );

        if ($tag->is_required()) {
            $atts['aria-required'] = 'true';
        }

        if ($validation_error) {
            $atts['aria-invalid'] = 'true';
            $atts['aria-describedby'] = wpcf7_get_validation_error_reference(
                $tag->name
            );
        } else {
            $atts['aria-invalid'] = 'false';
        }

        $value = (string) reset($tag->values);

        if (
            $tag->has_option('placeholder')
            or $tag->has_option('watermark')
        ) {
            $atts['placeholder'] = $value;
            $value = '';
        }

        $value = $tag->get_default_option($value);

        $value = wpcf7_get_hangover($tag->name, $value);

        $atts['value'] = $value;
        $atts['type'] = $tag->basetype;
        $atts['name'] = $tag->name;

        $label = $atts['placeholder'] ?? '';
        unset($atts['placeholder']);

        $input = new AnonymousComponent('seeme::components.input.text', ['label' => $label, 'wrapperClass' => 'w-full', 'id' => $tag->name]);
        $input->withAttributes(array_filter($atts, fn ($attr) => !is_null($attr) && $attr !== '' && $attr !== false));

        $renderedInput = view($input->render(), $input->data())->render();

        $html = sprintf(
            '<div class="wpcf7-form-control-wrap" data-name="%1$s">%2$s%3$s</div>',
            esc_attr($tag->name),
            $renderedInput,
            $validation_error
        );

        return $html;
    }

    public function textareaFieldHandler($tag): string
    {
        if (empty($tag->name)) {
            return '';
        }

        $validation_error = wpcf7_get_validation_error($tag->name);

        $class = wpcf7_form_controls_class($tag->type);

        if ($validation_error) {
            $class .= ' wpcf7-not-valid';
        }

        $atts = array();

        $atts['cols'] = $tag->get_cols_option('40');
        $atts['rows'] = $tag->get_rows_option('10');
        $atts['maxlength'] = $tag->get_maxlength_option();
        $atts['minlength'] = $tag->get_minlength_option();

        if (
            $atts['maxlength'] and $atts['minlength']
            and $atts['maxlength'] < $atts['minlength']
        ) {
            unset($atts['maxlength'], $atts['minlength']);
        }

        $atts['class'] = $tag->get_class_option($class);
        $atts['id'] = $tag->get_id_option();
        $atts['tabindex'] = $tag->get_option('tabindex', 'signed_int', true);
        $atts['readonly'] = $tag->has_option('readonly');

        $atts['autocomplete'] = $tag->get_option(
            'autocomplete',
            '[-0-9a-zA-Z]+',
            true
        );

        if ($tag->is_required()) {
            $atts['aria-required'] = 'true';
        }

        if ($validation_error) {
            $atts['aria-invalid'] = 'true';
            $atts['aria-describedby'] = wpcf7_get_validation_error_reference(
                $tag->name
            );
        } else {
            $atts['aria-invalid'] = 'false';
        }

        $value = empty($tag->content)
            ? (string) reset($tag->values)
            : $tag->content;

        if (
            $tag->has_option('placeholder')
            or $tag->has_option('watermark')
        ) {
            $atts['placeholder'] = $value;
            $value = '';
        }

        $value = $tag->get_default_option($value);

        $value = wpcf7_get_hangover($tag->name, $value);

        $atts['name'] = $tag->name;

        $label = $atts['placeholder'] ?? '';
        unset($atts['placeholder']);

        $input = new AnonymousComponent('seeme::components.input.textarea', ['label' => $label, 'value' => $value, 'wrapperClass' => 'w-full', 'id' => $tag->name]);
        $input->withAttributes(array_filter($atts, fn ($attr) => !is_null($attr) && $attr !== '' && $attr !== false));

        $renderedInput = view($input->render(), $input->data())->render();

        $html = sprintf(
            '<div class="wpcf7-form-control-wrap" data-name="%1$s">%2$s%3$s</div>',
            esc_attr($tag->name),
            $renderedInput,
            $validation_error
        );

        return $html;
    }

    public function acceptanceFieldHandler($tag)
    {
        if (empty($tag->name)) {
            return '';
        }

        $validation_error = wpcf7_get_validation_error($tag->name);

        $class = wpcf7_form_controls_class($tag->type);

        if ($validation_error) {
            $class .= ' wpcf7-not-valid';
        }

        if ($tag->has_option('invert')) {
            $class .= ' invert';
        }

        if ($tag->has_option('optional')) {
            $class .= ' optional';
        }

        $atts = array(
            'class' => trim($class),
        );

        $item_atts = array(
            'type' => 'checkbox',
            'name' => $tag->name,
            'value' => '1',
            'tabindex' => $tag->get_option('tabindex', 'signed_int', true),
            'checked' => $tag->has_option('default:on'),
            'class' => $tag->get_class_option() ? $tag->get_class_option() : null,
            'id' => $tag->get_id_option(),
        );

        if ($validation_error) {
            $item_atts['aria-invalid'] = 'true';
            $item_atts['aria-describedby'] = wpcf7_get_validation_error_reference(
                $tag->name
            );
        } else {
            $item_atts['aria-invalid'] = 'false';
        }

        $content = empty($tag->content)
            ? (string) reset($tag->values)
            : $tag->content;

        $content = trim($content);

        $input = new AnonymousComponent('seeme::components.input.checkbox', ['label' => $content, 'wrapperClass' => 'w-full']);
        $input->withAttributes(array_filter($item_atts, fn ($attr) => !is_null($attr) && $attr !== '' && $attr !== false));

        $html = view($input->render(), $input->data())->render();

        $html = sprintf(
            '<div class="wpcf7-form-control-wrap" data-name="%1$s"><div %2$s>%3$s</div>%4$s</div>',
            esc_attr($tag->name),
            wpcf7_format_atts($atts),
            $html,
            $validation_error
        );

        return $html;
    }

    public function selectFieldHandler($tag): string
    {
        if ( empty( $tag->name ) ) {
            return '';
        }
    
        $validation_error = wpcf7_get_validation_error( $tag->name );
        $class = wpcf7_form_controls_class( $tag->type );
    
        if ( $validation_error ) {
            $class .= ' wpcf7-not-valid';
        }
    
        $atts = array();
    
        $atts['class'] = $tag->get_class_option( $class );
        $atts['id'] = $tag->get_id_option();
        $atts['tabindex'] = $tag->get_option( 'tabindex', 'signed_int', true );
    
        $atts['autocomplete'] = $tag->get_option(
            'autocomplete', '[-0-9a-zA-Z]+', true
        );

        $label = '';
    
        if ( $tag->is_required() ) {
            $atts['aria-required'] = 'true';
        }
    
        if ( $validation_error ) {
            $atts['aria-invalid'] = 'true';
            $atts['aria-describedby'] = wpcf7_get_validation_error_reference(
                $tag->name
            );
        } else {
            $atts['aria-invalid'] = 'false';
        }
    
        $multiple = $tag->has_option( 'multiple' );
        $include_blank = $tag->has_option( 'include_blank' );
        $first_as_label = $tag->has_option( 'first_as_label' );
    
        if ( $tag->has_option( 'size' ) ) {
            $size = $tag->get_option( 'size', 'int', true );
    
            if ( $size ) {
                $atts['size'] = $size;
            } elseif ( $multiple ) {
                $atts['size'] = 4;
            } else {
                $atts['size'] = 1;
            }
        }
    
        if ( $data = (array) $tag->get_data_option() ) {
            $tag->values = array_merge( $tag->values, array_values( $data ) );
            $tag->labels = array_merge( $tag->labels, array_values( $data ) );
        }
    
        $values = $tag->values;
        $labels = $tag->labels;
    
        if ( $include_blank
        or empty( $values ) ) {
            array_unshift(
                $labels,
                __( '&#8212;Please choose an option&#8212;', 'contact-form-7' )
            );
            array_unshift( $values, '' );
        } elseif ( $first_as_label ) {
            $label = $values[0];
            $values[0] = '';
        }
    
        $atts['multiple'] = (bool) $multiple;
        $atts['name'] = $tag->name . ( $multiple ? '[]' : '' );

        $input = new AnonymousComponent(
            'seeme::components.input.select', 
            [
                'label' => $label,
                'wrapperClass' => 'w-full', 
                'id' => $tag->name,
                'values' => $values,
                'labels' => $labels,
            ]
        );
        $input->withAttributes(array_filter($atts, fn ($attr) => !is_null($attr) && $attr !== '' && $attr !== false));

        $renderedInput = view($input->render(), $input->data())->render();

        $html = sprintf(
            '<div class="wpcf7-form-control-wrap" data-name="%1$s">%2$s%3$s</div>',
            esc_attr($tag->name),
            $renderedInput,
            $validation_error
        );

        return $html;
    }

    public function submitFieldHandler($tag): string
    {
        $class = wpcf7_form_controls_class($tag->type, 'has-spinner');

        $atts = array();

        $atts['class'] = $tag->get_class_option($class);
        $atts['id'] = $tag->get_id_option();
        $atts['tabindex'] = $tag->get_option('tabindex', 'signed_int', true);

        $value = isset($tag->values[0]) ? $tag->values[0] : '';

        if (empty($value)) {
            $value = __('Send', 'contact-form-7');
        }

        $buttonData = [
            'variant' => $tag->get_option('variant', '', true) ?: 'primary',
            'size' => $tag->get_option('size', '', true) ?: 'medium',
            'weight' => $tag->get_option('weight', '', true) ?: 'regular',
            'rounded' => $tag->get_option('rounded', '', true) ?: 'full',
        ];

        $input = new Button(...$buttonData);
        $input->withAttributes(array_filter($atts, fn ($attr) => !is_null($attr) && $attr !== '' && $attr !== false));

        return $input->render()->with([
          'label' => $value
        ]);
    }
}
