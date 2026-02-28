<?php
    add_filter('acf/format_value/type=text', 'do_shortcode', 10, 3);
	add_filter('acf/format_value/type=textarea', 'do_shortcode', 10, 3);

	add_filter('acf/load_field/name=gform', 'load_gforms');
    function load_gforms( $field ) {
		if(!class_exists('GFAPI')) {return;}
        $forms = GFAPI::get_forms();

        $field['choices'] = array();
        $field['choices'][''] = 'Select a Form';
        foreach ($forms as $form) {
            $field['choices'][ $form['id'] ] = $form['title'];
        }

        return $field;
    }