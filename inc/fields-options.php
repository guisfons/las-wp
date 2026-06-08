<?php
if (!defined('ABSPATH')) {
    exit;
}

if (function_exists('acf_add_local_field_group')):

    acf_add_local_field_group([
        'key' => 'group_las_global_options',
        'title' => 'Configurações de Produtos',
        'fields' => [
            [
                'key' => 'field_global_specialities',
                'label' => 'Especialidades',
                'name' => 'global_specialities',
                'type' => 'textarea',
                'instructions' => 'Digite uma especialidade por linha.',
                'required' => 0,
                'rows' => 10,
                'new_lines' => '',
            ],
            [
                'key' => 'field_global_brands',
                'label' => 'Marcas',
                'name' => 'global_brands',
                'type' => 'textarea',
                'instructions' => 'Digite uma marca por linha.',
                'required' => 0,
                'rows' => 10,
                'new_lines' => '',
            ],
            [
                'key' => 'field_global_tags',
                'label' => 'Tags',
                'name' => 'global_tags',
                'type' => 'textarea',
                'instructions' => 'Digite uma tag por linha.',
                'required' => 0,
                'rows' => 10,
                'new_lines' => '',
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'acf-options',
                ],
            ],
        ],
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
        'show_in_graphql' => 0,
    ]);

endif;

/**
 * Dynamically populate choices for Specialities, Brands, and Tags 
 * based on the global options fields.
 */
function las_wp_load_dynamic_choices($field) {
    // Map the field name to the global option name
    $option_name = 'global_' . $field['name'];
    
    // Get the values from the Options Page
    $values = get_field($option_name, 'option');
    
    if (!is_array($field['choices'])) {
        $field['choices'] = array();
    }

    if ($values) {
        $choices = explode("\n", str_replace("\r", "", $values));
        foreach ($choices as $choice) {
            $choice = trim($choice);
            if (!empty($choice)) {
                // Add choice, keeping existing ones
                $field['choices'][$choice] = $choice;
            }
        }
    }

    return $field;
}

// Add the filter for each field name
add_filter('acf/load_field/name=specialities', 'las_wp_load_dynamic_choices');
add_filter('acf/load_field/name=brands', 'las_wp_load_dynamic_choices');
add_filter('acf/load_field/name=tags', 'las_wp_load_dynamic_choices');
