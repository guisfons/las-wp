<?php
// wp-content/themes/las-wp/inc/fields-blog.php

if (function_exists('acf_add_local_field_group')):

    acf_add_local_field_group(array(
        'key'    => 'group_blog_post',
        'title'  => 'Detalhes do Artigo (Blog)',
        'fields' => array(

            // ─── Imagem e SEO ────────────────────────────────────────
            array(
                'key'           => 'field_blog_cover_image',
                'label'         => 'Imagem de Capa',
                'name'          => 'cover_image',
                'type'          => 'image',
                'instructions'  => 'Imagem de destaque do artigo. Recomendado: 1200x630px.',
                'return_format' => 'array',
                'preview_size'  => 'medium',
                'library'       => 'all',
                'required'      => 0,
            ),

            // ─── Metadados ───────────────────────────────────────────
            array(
                'key'          => 'field_blog_reading_time',
                'label'        => 'Tempo de Leitura (minutos)',
                'name'         => 'reading_time',
                'type'         => 'number',
                'instructions' => 'Ex: 5 (para "5 min de leitura"). Deixe vazio para não exibir.',
                'min'          => 1,
                'max'          => 120,
                'required'     => 0,
            ),
            array(
                'key'          => 'field_blog_author_name',
                'label'        => 'Nome do Autor (opcional)',
                'name'         => 'author_name',
                'type'         => 'text',
                'instructions' => 'Se vazio, usa o autor padrão do WordPress.',
                'required'     => 0,
            ),
            array(
                'key'           => 'field_blog_author_photo',
                'label'         => 'Foto do Autor',
                'name'          => 'author_photo',
                'type'          => 'image',
                'instructions'  => 'Avatar do autor. Usado no card e na página interna.',
                'return_format' => 'array',
                'preview_size'  => 'thumbnail',
                'required'      => 0,
            ),
            array(
                'key'          => 'field_blog_author_role',
                'label'        => 'Cargo / Especialidade do Autor',
                'name'         => 'author_role',
                'type'         => 'text',
                'instructions' => 'Ex: "Especialista em Ortopedia"',
                'required'     => 0,
            ),

            // ─── CTA / Destaque ───────────────────────────────────────
            array(
                'key'           => 'field_blog_is_featured',
                'label'         => 'Artigo em Destaque',
                'name'          => 'is_featured',
                'type'          => 'true_false',
                'instructions'  => 'Marque para exibir este artigo em destaque (hero) na listagem do blog.',
                'default_value' => 0,
                'ui'            => 1,
            ),
            array(
                'key'          => 'field_blog_cta_label',
                'label'        => 'Texto do CTA',
                'name'         => 'cta_label',
                'type'         => 'text',
                'instructions' => 'Texto do botão de chamada para ação ao final do artigo. Ex: "Fale com um especialista"',
                'required'     => 0,
            ),
            array(
                'key'          => 'field_blog_cta_url',
                'label'        => 'URL do CTA',
                'name'         => 'cta_url',
                'type'         => 'url',
                'instructions' => 'Link do botão de CTA. Se vazio, o botão não é exibido.',
                'required'     => 0,
            ),

            // ─── Tags / Relação com produtos ─────────────────────────
            array(
                'key'          => 'field_blog_related_product_slug',
                'label'        => 'Slug do Produto Relacionado',
                'name'         => 'related_product_slug',
                'type'         => 'text',
                'instructions' => 'Slug de um produto da LAS relacionado a este artigo. Se preenchido, exibe um card de produto ao final.',
                'required'     => 0,
            ),

        ),
        'location' => array(
            array(
                array(
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'post',
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
        'graphql_field_name'    => 'blogacf',
    ));

endif;
