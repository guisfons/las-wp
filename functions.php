<?php
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Handle CORS early - Versão Final Corrigida
 */
function las_wp_handle_cors_early() {
    $allowed_origins = [
        'https://lasbrasil.com.br',
        'https://www.lasbrasil.com.br',
        'https://lasforlife.com.br',
        'https://www.lasforlife.com.br',
        'https://las-brasil.vercel.app',
        'https://mediumblue-swallow-341910.hostingersite.com',
        'http://localhost:3000',
    ];

    $origin = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : '';

    if (in_array($origin, $allowed_origins)) {
        header('Access-Control-Allow-Origin: ' . $origin);
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Allow-Headers: Authorization, Content-Type, X-Requested-With, X-WP-Nonce');
    }

    // Responder imediatamente ao preflight OPTIONS
    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        if (in_array($origin, $allowed_origins)) {
            status_header(200);
        } else {
            // Se não for uma origem permitida, ainda assim sai, mas sem os headers de permissão
            status_header(403);
        }
        exit();
    }
}
las_wp_handle_cors_early();

/**
 * Basic Theme Supports
 */
function las_wp_setup()
{
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');

    register_nav_menus(
        array(
            'primary' => __('Primary Menu', 'las-wp'),
        )
    );
}
add_action('after_setup_theme', 'las_wp_setup');

/**
 * Modify Preview Link to point to Next.js preview route
 */
function las_wp_set_headless_preview_link($link, $post)
{
    $frontend_url = 'http://localhost:3000';

    return sprintf(
        '%s/api/preview?post_id=%s&post_type=%s',
        untrailingslashit($frontend_url),
        $post->ID,
        $post->post_type
    );
}
add_filter('preview_post_link', 'las_wp_set_headless_preview_link', 10, 2);

/**
 * Redirect all frontend requests to Next.js (except GraphQL and Admin)
 */
function las_wp_frontend_redirect()
{
    // NUNCA redireciona se for uma requisição de API ou houver Origin (CORS)
    if (is_admin() || wp_is_json_request() || (defined('DOING_CRON') && DOING_CRON) || (defined('REST_REQUEST') && REST_REQUEST) || isset($_SERVER['HTTP_ORIGIN'])) {
        return;
    }

    // NUNCA redireciona requisições ao log do WordPress, GraphQL, ou arquivos de mídia
    $request_uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
    if (
        strpos($request_uri, '/graphql') !== false || 
        strpos($request_uri, '/wp-json') !== false ||
        strpos($request_uri, '/wp-content/') !== false ||
        strpos($request_uri, '/pdfs/') !== false
    ) {
        return;
    }

    // Bypassa se for uma requisição WPGraphQL (via constante)
    if (defined('GRAPHQL_HTTP_REQUEST') && GRAPHQL_HTTP_REQUEST) {
        return;
    }

    // URL de produção do Next.js
    $frontend_url = 'https://lasbrasil.com.br';

    // Se estiver em ambiente local (detectado pelo host), usa localhost
    if (isset($_SERVER['HTTP_HOST']) && strpos($_SERVER['HTTP_HOST'], '.lndo.site') !== false) {
        $frontend_url = 'http://localhost:3000';
    }

    wp_redirect($frontend_url, 301);
    exit;
}
add_action('template_redirect', 'las_wp_frontend_redirect');

// Os cabeçalhos CORS já são lidados no topo do arquivo.

/**
 * Register Custom Post Types
 */
function las_wp_register_cpts()
{
    $labels = array(
        'name' => _x('Produtos', 'Post Type General Name', 'las-wp'),
        'singular_name' => _x('Produto', 'Post Type Singular Name', 'las-wp'),
        'menu_name' => __('Produtos', 'las-wp'),
        'name_admin_bar' => __('Produto', 'las-wp'),
        'archives' => __('Arquivo de Produtos', 'las-wp'),
        'attributes' => __('Atributos do Produto', 'las-wp'),
        'parent_item_colon' => __('Produto Pai:', 'las-wp'),
        'all_items' => __('Todos os Produtos', 'las-wp'),
        'add_new_item' => __('Adicionar Novo Produto', 'las-wp'),
        'add_new' => __('Adicionar Novo', 'las-wp'),
        'new_item' => __('Novo Produto', 'las-wp'),
        'edit_item' => __('Editar Produto', 'las-wp'),
        'update_item' => __('Atualizar Produto', 'las-wp'),
        'view_item' => __('Ver Produto', 'las-wp'),
        'view_items' => __('Ver Produtos', 'las-wp'),
        'search_items' => __('Procurar Produto', 'las-wp'),
        'not_found' => __('Não encontrado', 'las-wp'),
        'not_found_in_trash' => __('Não encontrado na lixeira', 'las-wp'),
        'featured_image' => __('Imagem de Destaque', 'las-wp'),
        'set_featured_image' => __('Definir imagem de destaque', 'las-wp'),
        'remove_featured_image' => __('Remover imagem de destaque', 'las-wp'),
        'use_featured_image' => __('Usar como imagem de destaque', 'las-wp'),
        'insert_into_item' => __('Inserir no produto', 'las-wp'),
        'uploaded_to_this_item' => __('Enviado para este produto', 'las-wp'),
        'items_list' => __('Lista de Produtos', 'las-wp'),
        'items_list_navigation' => __('Navegação da lista de produtos', 'las-wp'),
        'filter_items_list' => __('Filtrar lista de produtos', 'las-wp'),
    );
    $args = array(
        'label' => __('Produto', 'las-wp'),
        'description' => __('Produtos da LAS', 'las-wp'),
        'labels' => $labels,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-cart',
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'post',
        'show_in_graphql' => true,
        'graphql_single_name' => 'product',
        'graphql_plural_name' => 'products',
    );
    register_post_type('product', $args);

    // ==========================================
    // CPT: Evento
    // ==========================================
    $labels_evento = array(
        'name' => _x('Eventos', 'post type general name', 'las-wp'),
        'singular_name' => _x('Evento', 'post type singular name', 'las-wp'),
        'menu_name' => _x('Eventos', 'admin menu', 'las-wp'),
        'name_admin_bar' => _x('Evento', 'add new on admin bar', 'las-wp'),
        'add_new' => _x('Adicionar Novo', 'evento', 'las-wp'),
        'add_new_item' => __('Adicionar Novo Evento', 'las-wp'),
        'new_item' => __('Novo Evento', 'las-wp'),
        'edit_item' => __('Editar Evento', 'las-wp'),
        'view_item' => __('Ver Evento', 'las-wp'),
        'all_items' => __('Todos os Eventos', 'las-wp'),
        'search_items' => __('Procurar Eventos', 'las-wp'),
        'parent_item_colon' => __('Eventos Pai:', 'las-wp'),
        'not_found' => __('Nenhum evento encontrado.', 'las-wp'),
        'not_found_in_trash' => __('Nenhum evento encontrado na lixeira.', 'las-wp')
    );

    $args_evento = array(
        'labels' => $labels_evento,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'evento'),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => null,
        'menu_icon' => 'dashicons-calendar-alt',
        'supports' => array('title', 'thumbnail', 'page-attributes'),
        'show_in_graphql' => true,
        'graphql_single_name' => 'evento',
        'graphql_plural_name' => 'eventos',
    );

    register_post_type('evento', $args_evento);

    // ==========================================
    // Taxonomia: Categoria do Evento (Type)
    // ==========================================
    $labels_cat_evento = array(
        'name' => _x('Categorias do Evento', 'taxonomy general name', 'las-wp'),
        'singular_name' => _x('Categoria do Evento', 'taxonomy singular name', 'las-wp'),
        'search_items' => __('Procurar Categorias', 'las-wp'),
        'all_items' => __('Todas as Categorias', 'las-wp'),
        'parent_item' => __('Categoria Pai', 'las-wp'),
        'parent_item_colon' => __('Categoria Pai:', 'las-wp'),
        'edit_item' => __('Editar Categoria', 'las-wp'),
        'update_item' => __('Atualizar Categoria', 'las-wp'),
        'add_new_item' => __('Adicionar Nova Categoria', 'las-wp'),
        'new_item_name' => __('Nova Categoria', 'las-wp'),
        'menu_name' => __('Categorias', 'las-wp'),
    );

    $args_cat_evento = array(
        'hierarchical' => true,
        'labels' => $labels_cat_evento,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'categoria-evento'),
        'show_in_graphql' => true,
        'graphql_single_name' => 'eventoCategoria',
        'graphql_plural_name' => 'eventoCategorias',
    );

    register_taxonomy('categoria_evento', array('evento'), $args_cat_evento);
}
add_action('init', 'las_wp_register_cpts', 0);

/**
 * Register ACF Fields
 */
require_once get_template_directory() . '/inc/fields-product.php';
require_once get_template_directory() . '/inc/fields-pages.php';
require_once get_template_directory() . '/inc/fields-eventos.php';

/**
 * Auto Create Necessary Headless Pages
 */
function las_wp_auto_create_pages()
{
    // Only run this once.
    if (get_option('las_wp_initial_pages_created')) {
        return;
    }

    $pages_to_create = array(
        'Home' => 'home',
        'Articulate the Ecosystem' => 'articulate-the-ecosystem',
        'Budget Request' => 'budget-request',
        'Certificado' => 'certificado',
        'Eventos' => 'eventos',
        'Generate Health' => 'generate-health',
        'Instruções de Uso dos Produtos' => 'instrucoes-de-uso-dos-produtos',
        'Produtos' => 'produtos',
        'Seja um Distribuidor' => 'seja-um-distribuidor',
        'Serviços Técnicos' => 'servicos-tecnicos',
        'Treating Disease' => 'treating-disease',
    );

    foreach ($pages_to_create as $page_title => $page_slug) {
        // Check if page already exists
        $page_check = get_page_by_title($page_title);

        if (!isset($page_check->ID)) {
            $page_data = array(
                'post_title' => $page_title,
                'post_name' => $page_slug,
                'post_status' => 'publish',
                'post_type' => 'page',
                'post_author' => 1, // Usually admin ID
            );

            wp_insert_post($page_data);
        }
    }

    // Mark as completed so we don't try creating them on every admin init
    update_option('las_wp_initial_pages_created', true);
}
add_action('admin_init', 'las_wp_auto_create_pages');

/**
 * Register ACF Options Page
 */
function las_wp_register_acf_options_pages() {
    if( function_exists('acf_add_options_page') ) {
        acf_add_options_page(array(
            'page_title'    => 'Opções Globais',
            'menu_title'    => 'Opções',
            'menu_slug'     => 'acf-options',
            'capability'    => 'edit_posts',
            'redirect'      => false,
            'show_in_graphql' => true,
            'graphql_field_name' => 'globalOptions'
        ));
    }
}
add_action('acf/init', 'las_wp_register_acf_options_pages');
