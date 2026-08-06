<?php

add_action('acf/init', function() {
if (function_exists('acf_add_local_field_group')):

    /**
     * Helper to safely get the Page ID by slug for ACF Location Rules
     */
    function las_get_page_id_by_slug($slug)
    {
        $page = get_page_by_path($slug);
        return $page ? $page->ID : 0;
    }

    /**
     * Home fields are now managed via the ACF UI. 
     * Import the provided JSON file in Custom Fields > Tools.
     */
    // acf_add_local_field_group([...]);

    /**
     * 2. Articulate the Ecosystem
     * (Gerenciado via UI - acf-export-articulate.json)
     */
    /*
    acf_add_local_field_group([
        'key' => 'group_page_articulate_acf',
        'title' => 'Page - Articulate the Ecosystem Fields',
        'fields' => [
            // ... (campos definidos no JSON)
        ],
        'location' => [
            [['param' => 'page', 'operator' => '==', 'value' => las_get_page_id_by_slug('articulate-the-ecosystem')]],
        ],
        'show_in_graphql' => 1,
        'graphql_field_name' => 'pageArticulate',
    ]);
    */

    // ==========================================
    // 3. Treating Disease
    // ==========================================
    acf_add_local_field_group([
        'key' => 'group_page_treating_acf',
        'title' => 'Page - Treating Disease Fields',
        'fields' => [
            [
                'key' => 'field_treating_hero',
                'label' => 'Hero Banner',
                'name' => 'heroBanner',
                'type' => 'group',
                'sub_fields' => [
                    ['key' => 'field_trt_hero_image_line', 'label' => 'Image Line', 'name' => 'imageLine', 'type' => 'image', 'return_format' => 'url'],
                    ['key' => 'field_trt_hero_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text'],
                    ['key' => 'field_trt_hero_desc', 'label' => 'Description', 'name' => 'description', 'type' => 'textarea'],
                    ['key' => 'field_trt_hero_label', 'label' => 'Button Label', 'name' => 'label', 'type' => 'text'],
                    ['key' => 'field_trt_hero_link', 'label' => 'Button Link', 'name' => 'link', 'type' => 'url'],
                ],
                'show_in_graphql' => 1,
            ],
            [
                'key' => 'field_treating_how',
                'label' => 'How We Do It Today',
                'name' => 'howWeDoItToday',
                'type' => 'group',
                'sub_fields' => [
                    ['key' => 'field_trt_how_banner', 'label' => 'Banner (Image)', 'name' => 'banner', 'type' => 'image', 'return_format' => 'url'],
                    ['key' => 'field_trt_how_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text'],
                    [
                        'key' => 'field_trt_how_desc',
                        'label' => 'Description',
                        'name' => 'description',
                        'type' => 'repeater',
                        'sub_fields' => [
                            ['key' => 'field_trt_how_desc_text', 'label' => 'Paragraph', 'name' => 'text', 'type' => 'textarea']
                        ]
                    ],
                ],
                'show_in_graphql' => 1,
            ],
        ],
        'location' => [
            [['param' => 'page', 'operator' => '==', 'value' => las_get_page_id_by_slug('treating-disease')]],
        ],
        'show_in_graphql' => 1,
        'graphql_field_name' => 'pageTreating',
    ]);

    // ==========================================
    // 4. Generate Health
    // ==========================================
    acf_add_local_field_group([
        'key' => 'group_page_generate_acf',
        'title' => 'Page - Generate Health Fields',
        'fields' => [
            [
                'key' => 'field_generate_hero',
                'label' => 'Hero Banner',
                'name' => 'heroBanner',
                'type' => 'group',
                'sub_fields' => [
                    ['key' => 'field_gen_hero_image_line', 'label' => 'Image Line', 'name' => 'imageLine', 'type' => 'image', 'return_format' => 'url'],
                    ['key' => 'field_gen_hero_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text'],
                    ['key' => 'field_gen_hero_desc', 'label' => 'Description', 'name' => 'description', 'type' => 'textarea'],
                    ['key' => 'field_gen_hero_label', 'label' => 'Button Label', 'name' => 'label', 'type' => 'text'],
                    ['key' => 'field_gen_hero_link', 'label' => 'Button Link', 'name' => 'link', 'type' => 'url'],
                ],
                'show_in_graphql' => 1,
            ],
            [
                'key' => 'field_generate_how',
                'label' => 'How We Do It Today',
                'name' => 'howWeDoItToday',
                'type' => 'group',
                'sub_fields' => [
                    ['key' => 'field_gen_how_banner', 'label' => 'Banner (Image)', 'name' => 'banner', 'type' => 'image', 'return_format' => 'url'],
                    ['key' => 'field_gen_how_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text'],
                    [
                        'key' => 'field_gen_how_desc',
                        'label' => 'Description',
                        'name' => 'description',
                        'type' => 'repeater',
                        'sub_fields' => [
                            ['key' => 'field_gen_how_desc_text', 'label' => 'Paragraph', 'name' => 'text', 'type' => 'textarea']
                        ]
                    ],
                ],
                'show_in_graphql' => 1,
            ],
            [
                'key' => 'field_generate_card_las',
                'label' => 'Card LAS',
                'name' => 'cardLas',
                'type' => 'group',
                'sub_fields' => [
                    ['key' => 'field_gen_card_las_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text'],
                    ['key' => 'field_gen_card_las_desc', 'label' => 'Description', 'name' => 'description', 'type' => 'textarea'],
                    [
                        'key' => 'field_gen_card_las_grid',
                        'label' => 'Grid Items',
                        'name' => 'grid',
                        'type' => 'repeater',
                        'sub_fields' => [
                            ['key' => 'field_gen_card_logo', 'label' => 'Logo', 'name' => 'logo', 'type' => 'image', 'return_format' => 'url'],
                            ['key' => 'field_gen_card_pic', 'label' => 'Picture', 'name' => 'picture', 'type' => 'image', 'return_format' => 'url'],
                            ['key' => 'field_gen_card_desc', 'label' => 'Description', 'name' => 'description', 'type' => 'textarea'],
                            ['key' => 'field_gen_card_link', 'label' => 'Link', 'name' => 'link', 'type' => 'url'],
                        ]
                    ],
                ],
                'show_in_graphql' => 1,
            ],
            [
                'key' => 'field_generate_banner_las',
                'label' => 'Banner LAS',
                'name' => 'bannerLas',
                'type' => 'group',
                'sub_fields' => [
                    ['key' => 'field_gen_banner_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text'],
                    [
                        'key' => 'field_gen_banner_desc',
                        'label' => 'Description',
                        'name' => 'description',
                        'type' => 'repeater',
                        'sub_fields' => [
                            ['key' => 'field_gen_banner_desc_text', 'label' => 'Paragraph', 'name' => 'text', 'type' => 'textarea']
                        ]
                    ],
                    ['key' => 'field_gen_banner_img', 'label' => 'Image', 'name' => 'imageBanner', 'type' => 'image', 'return_format' => 'url'],
                    ['key' => 'field_gen_banner_link', 'label' => 'Link', 'name' => 'link', 'type' => 'url'],
                ],
                'show_in_graphql' => 1,
            ],
        ],
        'location' => [
            [['param' => 'page', 'operator' => '==', 'value' => las_get_page_id_by_slug('generate-health')]],
        ],
        'show_in_graphql' => 1,
        'graphql_field_name' => 'pageGenerate',
    ]);

    // ==========================================
    // 5. Instruções de Uso dos Produtos
    // ==========================================
    acf_add_local_field_group([
        'key' => 'group_page_instructions_acf',
        'title' => 'Page - Instruções de Uso',
        'fields' => [
            [
                'key' => 'field_instructions_title',
                'label' => 'Title Header',
                'name' => 'titleHeader',
                'type' => 'text',
                'show_in_graphql' => 1,
            ],
            [
                'key' => 'field_instructions_products',
                'label' => 'Products List',
                'name' => 'productsList',
                'type' => 'repeater',
                'sub_fields' => [
                    ['key' => 'field_inst_brand', 'label' => 'Brand', 'name' => 'brand', 'type' => 'text'],
                    ['key' => 'field_inst_name', 'label' => 'Name', 'name' => 'name', 'type' => 'text'],
                    ['key' => 'field_inst_anvisa', 'label' => 'ANVISA', 'name' => 'anvisa', 'type' => 'text'],
                    ['key' => 'field_inst_file', 'label' => 'File', 'name' => 'fileUrl', 'type' => 'file', 'return_format' => 'url'],
                ],
                'show_in_graphql' => 1,
            ],
        ],
        'location' => [
            [['param' => 'page', 'operator' => '==', 'value' => las_get_page_id_by_slug('instrucoes-de-uso-dos-produtos')]],
        ],
        'show_in_graphql' => 1,
        'graphql_field_name' => 'pageInstructions',
    ]);

    // ==========================================
    // 6. Generic/Simplistic Pages (Distribuidor, Servicos, Certificado, Eventos etc)
    // ==========================================
    acf_add_local_field_group([
        'key' => 'group_page_generic_acf',
        'title' => 'Page - Generic Fields',
        'fields' => [
            [
                'key' => 'field_generic_header_title',
                'label' => 'Header Title',
                'name' => 'headerTitle',
                'type' => 'text',
                'show_in_graphql' => 1,
            ],
            [
                'key' => 'field_generic_header_desc',
                'label' => 'Header Description',
                'name' => 'headerDescription',
                'type' => 'textarea',
                'show_in_graphql' => 1,
            ],
        ],
        'location' => [
            // [['param' => 'page', 'operator' => '==', 'value' => las_get_page_id_by_slug('seja-um-distribuidor')]],
            // [['param' => 'page', 'operator' => '==', 'value' => las_get_page_id_by_slug('servicos-tecnicos')]],
            [['param' => 'page', 'operator' => '==', 'value' => las_get_page_id_by_slug('certificado')]],
            [['param' => 'page', 'operator' => '==', 'value' => las_get_page_id_by_slug('budget-request')]],
            [['param' => 'page', 'operator' => '==', 'value' => las_get_page_id_by_slug('eventos')]],
        ],
        'show_in_graphql' => 1,
        'graphql_field_name' => 'pageGeneric',
    ]);

    /**
     * 7. Página - Serviços Técnicos
     * (Gerenciado via UI - acf-export-technical.json)
     */
    /*
    acf_add_local_field_group([
        'key' => 'group_page_technical_acf',
        'title' => 'Página - Serviços Técnicos',
        'fields' => [
            [
                'key' => 'field_tech_hero',
                'label' => 'Destaque (Hero)',
                'name' => 'hero',
                'type' => 'group',
                'sub_fields' => [
                    ['key' => 'field_tech_hero_title', 'label' => 'Título', 'name' => 'title', 'type' => 'text'],
                    ['key' => 'field_tech_hero_desc', 'label' => 'Descrição', 'name' => 'description', 'type' => 'textarea'],
                    ['key' => 'field_tech_hero_bg', 'label' => 'Imagem de Fundo', 'name' => 'backgroundImage', 'type' => 'image'],
                ],
                'show_in_graphql' => 1,
            ],
            [
                'key' => 'field_tech_what_is',
                'label' => 'O que são os Serviços Técnicos?',
                'name' => 'whatIs',
                'type' => 'group',
                'sub_fields' => [
                    ['key' => 'field_tech_what_is_title', 'label' => 'Título', 'name' => 'title', 'type' => 'text'],
                    [
                        'key' => 'field_tech_what_is_items',
                        'label' => 'Itens',
                        'name' => 'items',
                        'type' => 'repeater',
                        'sub_fields' => [
                            ['key' => 'field_tech_what_is_item_title', 'label' => 'Título', 'name' => 'title', 'type' => 'text'],
                            ['key' => 'field_tech_what_is_item_desc', 'label' => 'Descrição', 'name' => 'description', 'type' => 'textarea'],
                        ]
                    ]
                ],
                'show_in_graphql' => 1,
            ],
            [
                'key' => 'field_tech_form',
                'label' => 'Formulário',
                'name' => 'form',
                'type' => 'group',
                'sub_fields' => [
                    ['key' => 'field_tech_form_subtitle', 'label' => 'Subtítulo', 'name' => 'subtitle', 'type' => 'text'],
                    ['key' => 'field_tech_form_title', 'label' => 'Título', 'name' => 'title', 'type' => 'text'],
                    ['key' => 'field_tech_form_desc', 'label' => 'Descrição', 'name' => 'description', 'type' => 'textarea'],
                    ['key' => 'field_tech_form_action', 'label' => 'Form Action', 'name' => 'formAction', 'type' => 'text'],
                ],
                'show_in_graphql' => 1,
            ],
        ],
        'location' => [
            [['param' => 'page', 'operator' => '==', 'value' => las_get_page_id_by_slug('servicos-tecnicos')]],
        ],
        'show_in_graphql' => 1,
        'graphql_field_name' => 'pageTechnical',
    ]);
    /**
     * 8. Página - Seja um Distribuidor
     * (Gerenciado via UI - acf-export-distributor.json)
     */
    /*
    acf_add_local_field_group([
        'key' => 'group_page_distributor_acf',
        'title' => 'Página - Seja um Distribuidor',
        'fields' => [
            [
                'key' => 'field_dist_header',
                'label' => 'Cabeçalho',
                'name' => 'header',
                'type' => 'group',
                'sub_fields' => [
                    ['key' => 'field_dist_header_title', 'label' => 'Título', 'name' => 'title', 'type' => 'text'],
                    ['key' => 'field_dist_header_desc', 'label' => 'Descrição', 'name' => 'description', 'type' => 'textarea'],
                ],
                'show_in_graphql' => 1,
            ],
            [
                'key' => 'field_dist_form',
                'label' => 'Formulário',
                'name' => 'form',
                'type' => 'group',
                'sub_fields' => [
                    ['key' => 'field_dist_form_action', 'label' => 'Form Action', 'name' => 'formAction', 'type' => 'text'],
                    ['key' => 'field_dist_form_subject', 'label' => 'Assunto do E-mail', 'name' => 'subject', 'type' => 'text'],
                ],
                'show_in_graphql' => 1,
            ],
        ],
        'location' => [
            [['param' => 'page', 'operator' => '==', 'value' => las_get_page_id_by_slug('seja-um-distribuidor')]],
        ],
        'show_in_graphql' => 1,
        'graphql_field_name' => 'pageDistributor',
    ]);
    */


    acf_add_local_field_group([
        'key' => 'group_las_sports_acf',
        'title' => 'Page - LAS Sports Fields',
        'fields' => [
            [
                'key' => 'field_las_sports_how',
                'label' => 'How We Do It Today',
                'name' => 'howWeDoItToday',
                'type' => 'group',
                'sub_fields' => [
                    ['key' => 'field_las_sports_how_banner', 'label' => 'Banner', 'name' => 'banner', 'type' => 'image', 'return_format' => 'url'],
                    ['key' => 'field_las_sports_how_logo', 'label' => 'Logo', 'name' => 'logo', 'type' => 'image', 'return_format' => 'url'],
                    [
                        'key' => 'field_las_sports_how_desc',
                        'label' => 'Description',
                        'name' => 'description',
                        'type' => 'repeater',
                        'sub_fields' => [
                            ['key' => 'field_las_sports_how_desc_text', 'label' => 'Paragraph', 'name' => 'text', 'type' => 'textarea']
                        ]
                    ],
                    ['key' => 'field_las_sports_how_link', 'label' => 'Link', 'name' => 'link', 'type' => 'url']
                ],
            ],
            [
                'key' => 'field_las_sports_banner_las',
                'label' => 'Banner LAS',
                'name' => 'bannerLas',
                'type' => 'group',
                'sub_fields' => [
                    ['key' => 'field_las_sports_bl_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text'],
                    [
                        'key' => 'field_las_sports_bl_desc',
                        'label' => 'Description',
                        'name' => 'description',
                        'type' => 'repeater',
                        'sub_fields' => [
                            ['key' => 'field_las_sports_bl_desc_text', 'label' => 'Paragraph', 'name' => 'text', 'type' => 'textarea']
                        ]
                    ],
                    ['key' => 'field_las_sports_bl_img', 'label' => 'Image', 'name' => 'imageBanner', 'type' => 'image', 'return_format' => 'url'],
                    ['key' => 'field_las_sports_bl_link', 'label' => 'Link', 'name' => 'link', 'type' => 'url'],
                    ['key' => 'field_las_sports_bl_label', 'label' => 'Label Link', 'name' => 'labelLink', 'type' => 'text'],
                ],
            ],
            [
                'key' => 'field_las_sports_sponsorship',
                'label' => 'Sponsorship',
                'name' => 'sponsorship',
                'type' => 'group',
                'sub_fields' => [
                    ['key' => 'field_las_sports_spon_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text'],
                    [
                        'key' => 'field_las_sports_spon_desc',
                        'label' => 'Description',
                        'name' => 'description',
                        'type' => 'repeater',
                        'sub_fields' => [
                            ['key' => 'field_las_sports_spon_desc_text', 'label' => 'Paragraph', 'name' => 'text', 'type' => 'textarea']
                        ]
                    ],
                    ['key' => 'field_las_sports_spon_img', 'label' => 'Image', 'name' => 'image', 'type' => 'image', 'return_format' => 'url'],
                    ['key' => 'field_las_sports_spon_link', 'label' => 'Link', 'name' => 'link', 'type' => 'url'],
                ],
            ]
        ],
        'location' => [
            [['param' => 'page', 'operator' => '==', 'value' => las_get_page_id_by_slug('las-sports')]],
        ],
        'show_in_graphql' => 1,
        'graphql_field_name' => 'pageLasSports',
    ]);

    acf_add_local_field_group([
        'key' => 'group_las_social_acf',
        'title' => 'Page - LAS Social Fields',
        'fields' => [
            [
                'key' => 'field_las_social_how',
                'label' => 'How We Do It Today',
                'name' => 'howWeDoItToday',
                'type' => 'group',
                'sub_fields' => [
                    ['key' => 'field_las_social_how_banner', 'label' => 'Banner', 'name' => 'banner', 'type' => 'image', 'return_format' => 'url'],
                    ['key' => 'field_las_social_how_logo', 'label' => 'Logo', 'name' => 'logo', 'type' => 'image', 'return_format' => 'url'],
                    [
                        'key' => 'field_las_social_how_desc',
                        'label' => 'Description',
                        'name' => 'description',
                        'type' => 'repeater',
                        'sub_fields' => [
                            ['key' => 'field_las_social_how_desc_text', 'label' => 'Paragraph', 'name' => 'text', 'type' => 'textarea']
                        ]
                    ],
                    ['key' => 'field_las_social_how_link', 'label' => 'Link', 'name' => 'link', 'type' => 'url']
                ],
            ],
            [
                'key' => 'field_las_social_banner_las',
                'label' => 'Banner LAS',
                'name' => 'bannerLas',
                'type' => 'group',
                'sub_fields' => [
                    ['key' => 'field_las_social_bl_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text'],
                    [
                        'key' => 'field_las_social_bl_desc',
                        'label' => 'Description',
                        'name' => 'description',
                        'type' => 'repeater',
                        'sub_fields' => [
                            ['key' => 'field_las_social_bl_desc_text', 'label' => 'Paragraph', 'name' => 'text', 'type' => 'textarea']
                        ]
                    ],
                    ['key' => 'field_las_social_bl_img', 'label' => 'Image', 'name' => 'imageBanner', 'type' => 'image', 'return_format' => 'url'],
                    ['key' => 'field_las_social_bl_link', 'label' => 'Link', 'name' => 'link', 'type' => 'url'],
                    ['key' => 'field_las_social_bl_label', 'label' => 'Label Link', 'name' => 'labelLink', 'type' => 'text'],
                ],
            ]
        ],
        'location' => [
            [['param' => 'page', 'operator' => '==', 'value' => las_get_page_id_by_slug('las-social')]],
        ],
        'show_in_graphql' => 1,
        'graphql_field_name' => 'pageLasSocial',
    ]);

    acf_add_local_field_group([
        'key' => 'group_las_clubs_acf',
        'title' => 'Page - LAS Clubs Fields',
        'fields' => [
            [
                'key' => 'field_las_clubs_how',
                'label' => 'How We Do It Today',
                'name' => 'howWeDoItToday',
                'type' => 'group',
                'sub_fields' => [
                    ['key' => 'field_las_clubs_how_banner', 'label' => 'Banner', 'name' => 'banner', 'type' => 'image', 'return_format' => 'url'],
                    ['key' => 'field_las_clubs_how_logo', 'label' => 'Logo', 'name' => 'logo', 'type' => 'image', 'return_format' => 'url'],
                    [
                        'key' => 'field_las_clubs_how_desc',
                        'label' => 'Description',
                        'name' => 'description',
                        'type' => 'repeater',
                        'sub_fields' => [
                            ['key' => 'field_las_clubs_how_desc_text', 'label' => 'Paragraph', 'name' => 'text', 'type' => 'textarea']
                        ]
                    ],
                    ['key' => 'field_las_clubs_how_link', 'label' => 'Link', 'name' => 'link', 'type' => 'url']
                ],
            ],
            [
                'key' => 'field_las_clubs_banner_las',
                'label' => 'Banner LAS',
                'name' => 'bannerLas',
                'type' => 'group',
                'sub_fields' => [
                    ['key' => 'field_las_clubs_bl_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text'],
                    [
                        'key' => 'field_las_clubs_bl_desc',
                        'label' => 'Description',
                        'name' => 'description',
                        'type' => 'repeater',
                        'sub_fields' => [
                            ['key' => 'field_las_clubs_bl_desc_text', 'label' => 'Paragraph', 'name' => 'text', 'type' => 'textarea']
                        ]
                    ],
                    ['key' => 'field_las_clubs_bl_img', 'label' => 'Image', 'name' => 'imageBanner', 'type' => 'image', 'return_format' => 'url'],
                    ['key' => 'field_las_clubs_bl_link', 'label' => 'Link', 'name' => 'link', 'type' => 'url'],
                    ['key' => 'field_las_clubs_bl_label', 'label' => 'Label Link', 'name' => 'labelLink', 'type' => 'text'],
                ],
            ]
        ],
        'location' => [
            [['param' => 'page', 'operator' => '==', 'value' => las_get_page_id_by_slug('las-clubs')]],
        ],
        'show_in_graphql' => 1,
        'graphql_field_name' => 'pageLasClubs',
    ]);

    acf_add_local_field_group([
        'key' => 'group_las_talks_acf',
        'title' => 'Page - LAS Talks Fields',
        'fields' => [
            [
                'key' => 'field_las_talks_how',
                'label' => 'How We Do It Today',
                'name' => 'howWeDoItToday',
                'type' => 'group',
                'sub_fields' => [
                    ['key' => 'field_las_talks_how_banner', 'label' => 'Banner', 'name' => 'banner', 'type' => 'image', 'return_format' => 'url'],
                    ['key' => 'field_las_talks_how_logo', 'label' => 'Logo', 'name' => 'logo', 'type' => 'image', 'return_format' => 'url'],
                    [
                        'key' => 'field_las_talks_how_desc',
                        'label' => 'Description',
                        'name' => 'description',
                        'type' => 'repeater',
                        'sub_fields' => [
                            ['key' => 'field_las_talks_how_desc_text', 'label' => 'Paragraph', 'name' => 'text', 'type' => 'textarea']
                        ]
                    ],
                    ['key' => 'field_las_talks_how_link', 'label' => 'Link', 'name' => 'link', 'type' => 'url']
                ],
            ],
            [
                'key' => 'field_las_talks_banner_las',
                'label' => 'Banner LAS',
                'name' => 'bannerLas',
                'type' => 'group',
                'sub_fields' => [
                    ['key' => 'field_las_talks_bl_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text'],
                    [
                        'key' => 'field_las_talks_bl_desc',
                        'label' => 'Description',
                        'name' => 'description',
                        'type' => 'repeater',
                        'sub_fields' => [
                            ['key' => 'field_las_talks_bl_desc_text', 'label' => 'Paragraph', 'name' => 'text', 'type' => 'textarea']
                        ]
                    ],
                    ['key' => 'field_las_talks_bl_img', 'label' => 'Image', 'name' => 'imageBanner', 'type' => 'image', 'return_format' => 'url'],
                    ['key' => 'field_las_talks_bl_link', 'label' => 'Link', 'name' => 'link', 'type' => 'url'],
                    ['key' => 'field_las_talks_bl_label', 'label' => 'Label Link', 'name' => 'labelLink', 'type' => 'text'],
                ],
            ]
        ],
        'location' => [
            [['param' => 'page', 'operator' => '==', 'value' => las_get_page_id_by_slug('las-talks')]],
        ],
        'show_in_graphql' => 1,
        'graphql_field_name' => 'pageLasTalks',
    ]);

    acf_add_local_field_group([
        'key' => 'group_las_xperience_acf',
        'title' => 'Page - LAS Xperience Fields',
        'fields' => [
            [
                'key' => 'field_las_xperience_how',
                'label' => 'How We Do It Today',
                'name' => 'howWeDoItToday',
                'type' => 'group',
                'sub_fields' => [
                    ['key' => 'field_las_xperience_how_banner', 'label' => 'Banner', 'name' => 'banner', 'type' => 'image', 'return_format' => 'url'],
                    ['key' => 'field_las_xperience_how_logo', 'label' => 'Logo', 'name' => 'logo', 'type' => 'image', 'return_format' => 'url'],
                    [
                        'key' => 'field_las_xperience_how_desc',
                        'label' => 'Description',
                        'name' => 'description',
                        'type' => 'repeater',
                        'sub_fields' => [
                            ['key' => 'field_las_xperience_how_desc_text', 'label' => 'Paragraph', 'name' => 'text', 'type' => 'textarea']
                        ]
                    ],
                    ['key' => 'field_las_xperience_how_link', 'label' => 'Link', 'name' => 'link', 'type' => 'url']
                ],
            ],
            [
                'key' => 'field_las_xperience_banner_las',
                'label' => 'Banner LAS',
                'name' => 'bannerLas',
                'type' => 'group',
                'sub_fields' => [
                    ['key' => 'field_las_xperience_bl_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text'],
                    [
                        'key' => 'field_las_xperience_bl_desc',
                        'label' => 'Description',
                        'name' => 'description',
                        'type' => 'repeater',
                        'sub_fields' => [
                            ['key' => 'field_las_xperience_bl_desc_text', 'label' => 'Paragraph', 'name' => 'text', 'type' => 'textarea']
                        ]
                    ],
                    ['key' => 'field_las_xperience_bl_img', 'label' => 'Image', 'name' => 'imageBanner', 'type' => 'image', 'return_format' => 'url'],
                    ['key' => 'field_las_xperience_bl_link', 'label' => 'Link', 'name' => 'link', 'type' => 'url'],
                    ['key' => 'field_las_xperience_bl_label', 'label' => 'Label Link', 'name' => 'labelLink', 'type' => 'text'],
                ],
            ]
        ],
        'location' => [
            [['param' => 'page', 'operator' => '==', 'value' => las_get_page_id_by_slug('las-xperience')]],
        ],
        'show_in_graphql' => 1,
        'graphql_field_name' => 'pageLasXperience',
    ]);

    acf_add_local_field_group([
        'key' => 'group_las_xperts_acf',
        'title' => 'Page - LAS Xperts Fields',
        'fields' => [
            [
                'key' => 'field_las_xperts_how',
                'label' => 'How We Do It Today',
                'name' => 'howWeDoItToday',
                'type' => 'group',
                'sub_fields' => [
                    ['key' => 'field_las_xperts_how_banner', 'label' => 'Banner', 'name' => 'banner', 'type' => 'image', 'return_format' => 'url'],
                    ['key' => 'field_las_xperts_how_logo', 'label' => 'Logo', 'name' => 'logo', 'type' => 'image', 'return_format' => 'url'],
                    [
                        'key' => 'field_las_xperts_how_desc',
                        'label' => 'Description',
                        'name' => 'description',
                        'type' => 'repeater',
                        'sub_fields' => [
                            ['key' => 'field_las_xperts_how_desc_text', 'label' => 'Paragraph', 'name' => 'text', 'type' => 'textarea']
                        ]
                    ],
                    ['key' => 'field_las_xperts_how_link', 'label' => 'Link', 'name' => 'link', 'type' => 'url']
                ],
            ],
            [
                'key' => 'field_las_xperts_banner_las',
                'label' => 'Banner LAS',
                'name' => 'bannerLas',
                'type' => 'group',
                'sub_fields' => [
                    ['key' => 'field_las_xperts_bl_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text'],
                    [
                        'key' => 'field_las_xperts_bl_desc',
                        'label' => 'Description',
                        'name' => 'description',
                        'type' => 'repeater',
                        'sub_fields' => [
                            ['key' => 'field_las_xperts_bl_desc_text', 'label' => 'Paragraph', 'name' => 'text', 'type' => 'textarea']
                        ]
                    ],
                    ['key' => 'field_las_xperts_bl_img', 'label' => 'Image', 'name' => 'imageBanner', 'type' => 'image', 'return_format' => 'url'],
                    ['key' => 'field_las_xperts_bl_link', 'label' => 'Link', 'name' => 'link', 'type' => 'url'],
                    ['key' => 'field_las_xperts_bl_label', 'label' => 'Label Link', 'name' => 'labelLink', 'type' => 'text'],
                ],
            ]
        ],
        'location' => [
            [['param' => 'page', 'operator' => '==', 'value' => las_get_page_id_by_slug('las-xperts')]],
        ],
        'show_in_graphql' => 1,
        'graphql_field_name' => 'pageLasXperts',
    ]);


    acf_add_local_field_group([
        'key' => 'group_educacao_acf',
        'title' => 'Page - Educação Fields',
        'fields' => [
            [
                'key' => 'field_educacao_how',
                'label' => 'How We Do It Today',
                'name' => 'howWeDoItToday',
                'type' => 'group',
                'sub_fields' => [
                    ['key' => 'field_educacao_how_banner', 'label' => 'Banner', 'name' => 'banner', 'type' => 'image', 'return_format' => 'url'],
                    ['key' => 'field_educacao_how_logo', 'label' => 'Logo', 'name' => 'logo', 'type' => 'image', 'return_format' => 'url'],
                    [
                        'key' => 'field_educacao_how_desc',
                        'label' => 'Description',
                        'name' => 'description',
                        'type' => 'repeater',
                        'sub_fields' => [
                            ['key' => 'field_educacao_how_desc_text', 'label' => 'Paragraph', 'name' => 'text', 'type' => 'textarea']
                        ]
                    ],
                    ['key' => 'field_educacao_how_link', 'label' => 'Link', 'name' => 'link', 'type' => 'url']
                ],
            ],
            [
                'key' => 'field_educacao_banner_las',
                'label' => 'Banner LAS',
                'name' => 'bannerLas',
                'type' => 'group',
                'sub_fields' => [
                    ['key' => 'field_educacao_bl_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text'],
                    [
                        'key' => 'field_educacao_bl_desc',
                        'label' => 'Description',
                        'name' => 'description',
                        'type' => 'repeater',
                        'sub_fields' => [
                            ['key' => 'field_educacao_bl_desc_text', 'label' => 'Paragraph', 'name' => 'text', 'type' => 'textarea']
                        ]
                    ],
                    ['key' => 'field_educacao_bl_img', 'label' => 'Image', 'name' => 'imageBanner', 'type' => 'image', 'return_format' => 'url'],
                    ['key' => 'field_educacao_bl_link', 'label' => 'Link', 'name' => 'link', 'type' => 'url'],
                    ['key' => 'field_educacao_bl_label', 'label' => 'Label Link', 'name' => 'labelLink', 'type' => 'text'],
                ],
            ]
        ],
        'location' => [
            [['param' => 'page', 'operator' => '==', 'value' => las_get_page_id_by_slug('educacao')]],
        ],
        'show_in_graphql' => 1,
        'graphql_field_name' => 'pageEducacao',
    ]);

endif;
});
