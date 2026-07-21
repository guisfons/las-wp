<?php
// wp-content/themes/las-wp/inc/fields-midia.php

if (function_exists('acf_add_local_field_group')):

    acf_add_local_field_group(array(
        'key'    => 'group_midia',
        'title'  => 'Detalhes da Mídia',
        'fields' => array(

            // ==========================================
            // TAB 1: Identificação
            // ==========================================
            array(
                'key'       => 'field_tab_midia_identificacao',
                'label'     => 'Identificação',
                'name'      => '',
                'type'      => 'tab',
                'placement' => 'top',
                'endpoint'  => 0,
            ),
            array(
                'key'          => 'field_midia_tipo',
                'label'        => 'Tipo de Mídia',
                'name'         => 'tipo',
                'type'         => 'select',
                'instructions' => 'Selecione o tipo de mídia',
                'choices'      => array(
                    'video'      => 'Vídeo',
                    'podcast'    => 'Podcast',
                    'artigo'     => 'Artigo',
                    'release'    => 'Release',
                    'entrevista' => 'Entrevista',
                    'pdf'        => 'PDF',
                    'outro'      => 'Outro',
                ),
                'default_value' => 'video',
                'return_format' => 'value',
                'required'      => 1,
            ),
            array(
                'key'            => 'field_midia_data_publicacao',
                'label'          => 'Data de Publicação',
                'name'           => 'data_publicacao',
                'type'           => 'date_picker',
                'instructions'   => 'Data original de publicação da mídia.',
                'display_format' => 'd/m/Y',
                'return_format'  => 'Y-m-d',
                'first_day'      => 0,
                'required'       => 0,
            ),
            array(
                'key'          => 'field_midia_fonte',
                'label'        => 'Fonte / Veículo',
                'name'         => 'fonte',
                'type'         => 'text',
                'instructions' => 'Ex: Band, Globo, Folha de SP, Spotify...',
                'required'     => 0,
            ),
            array(
                'key'           => 'field_midia_destaque',
                'label'         => 'Destaque',
                'name'          => 'destaque',
                'type'          => 'true_false',
                'instructions'  => 'Marque para exibir esta mídia em seções de destaque.',
                'default_value' => 0,
                'ui'            => 1,
                'required'      => 0,
            ),

            // ==========================================
            // TAB 2: Conteúdo (Vídeo / Podcast / Link)
            // ==========================================
            array(
                'key'       => 'field_tab_midia_conteudo',
                'label'     => 'Conteúdo',
                'name'      => '',
                'type'      => 'tab',
                'placement' => 'top',
                'endpoint'  => 0,
            ),
            array(
                'key'           => 'field_midia_thumbnail',
                'label'         => 'Thumbnail',
                'name'          => 'thumbnail',
                'type'          => 'image',
                'instructions'  => 'Imagem de capa / thumbnail da mídia.',
                'return_format' => 'array',
                'preview_size'  => 'medium',
                'library'       => 'all',
                'required'      => 0,
            ),
            array(
                'key'          => 'field_midia_url',
                'label'        => 'URL da Mídia',
                'name'         => 'url',
                'type'         => 'url',
                'instructions' => 'Link do vídeo (YouTube, Vimeo...), podcast, artigo externo, etc.',
                'required'     => 0,
            ),
            array(
                'key'          => 'field_midia_embed',
                'label'        => 'Embed / Player',
                'name'         => 'embed',
                'type'         => 'oembed',
                'instructions' => 'Cole a URL do vídeo ou áudio para gerar o player incorporado.',
                'required'     => 0,
                'width'        => '',
                'height'       => '',
            ),
            array(
                'key'          => 'field_midia_duracao',
                'label'        => 'Duração',
                'name'         => 'duracao',
                'type'         => 'text',
                'instructions' => 'Ex: 12min, 1h30min',
                'required'     => 0,
            ),

            // ==========================================
            // TAB 3: PDF
            // ==========================================
            array(
                'key'       => 'field_tab_midia_pdf',
                'label'     => 'PDF',
                'name'      => '',
                'type'      => 'tab',
                'placement' => 'top',
                'endpoint'  => 0,
            ),
            array(
                'key'           => 'field_midia_pdf',
                'label'         => 'Arquivo PDF',
                'name'          => 'pdf',
                'type'          => 'file',
                'instructions'  => 'Faça o upload do arquivo PDF. Será disponibilizado para download/visualização.',
                'return_format' => 'array',
                'library'       => 'all',
                'mime_types'    => 'pdf',
                'required'      => 0,
            ),
            array(
                'key'          => 'field_midia_pdf_capa',
                'label'        => 'Capa do PDF',
                'name'         => 'pdf_capa',
                'type'         => 'image',
                'instructions' => 'Imagem representando a capa ou primeira página do PDF.',
                'return_format' => 'array',
                'preview_size'  => 'medium',
                'library'       => 'all',
                'required'      => 0,
            ),
            array(
                'key'          => 'field_midia_pdf_paginas',
                'label'        => 'Número de Páginas',
                'name'         => 'pdf_paginas',
                'type'         => 'number',
                'instructions' => 'Ex: 12',
                'required'     => 0,
                'min'          => 1,
                'step'         => 1,
            ),
            array(
                'key'          => 'field_midia_pdf_descricao',
                'label'        => 'Descrição do PDF',
                'name'         => 'pdf_descricao',
                'type'         => 'textarea',
                'instructions' => 'Breve descrição do conteúdo do documento.',
                'rows'         => 3,
                'required'     => 0,
            ),

        ),
        'location' => array(
            array(
                array(
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'midia',
                ),
            ),
        ),
        'menu_order'            => 0,
        'position'              => 'normal',
        'style'                 => 'default',
        'label_placement'       => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen'        => '',
        'active'                => true,
        'description'           => '',
        'show_in_graphql'       => 1,
        'graphql_field_name'    => 'midiaacf',
        'map_graphql_types_from_location_rules' => 0,
        'graphql_types' => array(
            0 => 'Midia',
        ),
    ));

endif;
