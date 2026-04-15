<?php
// wp-content/themes/las-wp/inc/fields-eventos.php

if (function_exists('acf_add_local_field_group')):

    acf_add_local_field_group(array(
        'key' => 'group_eventos',
        'title' => 'Detalhes do Evento',
        'fields' => array(
            array(
                'key' => 'field_evento_img',
                'label' => 'Imagem do Evento',
                'name' => 'img',
                'type' => 'image',
                'instructions' => 'Selecione a imagem de destaque do evento. (A prioridade pode ser desta imagem antes do Thumbnail do post)',
                'return_format' => 'array',
                'preview_size' => 'medium',
                'library' => 'all',
            ),
            array(
                'key' => 'field_evento_image_type',
                'label' => 'Tipo de Imagem',
                'name' => 'image_type',
                'type' => 'select',
                'instructions' => 'Selecione o formato da imagem para adaptação no layout',
                'choices' => array(
                    'quadrada' => 'Quadrada',
                    'banner' => 'Banner',
                    'icon' => 'Ícone',
                ),
                'default_value' => 'quadrada',
                'return_format' => 'value',
            ),
            array(
                'key' => 'field_evento_date_number',
                'label' => 'Dia',
                'name' => 'date_number',
                'type' => 'text',
                'instructions' => 'Ex: 09 ou 29-31',
                'required' => 1,
            ),
            array(
                'key' => 'field_evento_month',
                'label' => 'Mês',
                'name' => 'month',
                'type' => 'text',
                'instructions' => 'Ex: OUTUBRO',
                'required' => 1,
            ),
            array(
                'key' => 'field_evento_year',
                'label' => 'Ano',
                'name' => 'year',
                'type' => 'text',
                'instructions' => 'Ex: 2025',
                'required' => 1,
            ),
            array(
                'key' => 'field_evento_hours',
                'label' => 'Horário',
                'name' => 'hours',
                'type' => 'text',
                'instructions' => 'Ex: 14h às 18h (Pode deixar em branco)',
                'required' => 0,
            ),
            array(
                'key' => 'field_evento_speaker',
                'label' => 'Palestrante',
                'name' => 'speaker',
                'type' => 'text',
                'required' => 0,
            ),
            array(
                'key' => 'field_evento_moderator',
                'label' => 'Moderador',
                'name' => 'moderator',
                'type' => 'text',
                'required' => 0,
            ),
            array(
                'key' => 'field_evento_local',
                'label' => 'Localização',
                'name' => 'local',
                'type' => 'text',
                'instructions' => 'Ex: São Paulo/SP',
                'required' => 0,
            ),
            array(
                'key' => 'field_evento_subscribe',
                'label' => 'Link de Inscrição',
                'name' => 'subscribe',
                'type' => 'url',
                'instructions' => 'Link externo para comprar ingressos ou inscrever-se.',
                'required' => 0,
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'evento',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
        'show_in_graphql' => 1,
        'graphql_field_name' => 'eventoacf',
        'map_graphql_types_from_location_rules' => 0,
        'graphql_types' => array(
            0 => 'Evento',
        ),
    ));

endif;
