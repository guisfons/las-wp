<?php
/**
 * Migration script to move ACF field values to Native Taxonomies.
 * Run this via command line: php migrate-taxonomies.php
 * OR hit it via URL if uploaded to the server.
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Load WordPress
require_once(__DIR__ . '/../../../../wp-load.php');

if (!current_user_can('manage_options') && php_sapi_name() !== 'cli') {
    die('Acesso negado. Você precisa estar logado como administrador ou rodar via CLI.');
}

$args = [
    'post_type' => 'product',
    'posts_per_page' => -1,
    'post_status' => 'any'
];
$products = get_posts($args);

$taxonomies_map = [
    'specialities' => 'product_speciality',
    'brands' => 'product_brand',
    'tags' => 'product_tag'
];

echo "Iniciando migração de " . count($products) . " produtos...\n<br>";

foreach ($products as $product) {
    echo "Processando Produto: {$product->post_title} (ID: {$product->ID})\n<br>";

    foreach ($taxonomies_map as $meta_key => $taxonomy) {
        $values = get_post_meta($product->ID, $meta_key, true);
        
        if (!empty($values) && is_array($values)) {
            $term_ids = [];
            foreach ($values as $term_name) {
                if (empty(trim($term_name))) continue;
                
                // Check if term exists, if not, create it
                $term = term_exists($term_name, $taxonomy);
                if (!$term) {
                    $term = wp_insert_term($term_name, $taxonomy);
                    if (is_wp_error($term)) {
                        echo "  - Erro ao criar termo '{$term_name}' em {$taxonomy}: " . $term->get_error_message() . "\n<br>";
                        continue;
                    }
                }
                
                // term_exists and wp_insert_term return an array or object with term_id
                $term_id = is_array($term) ? $term['term_id'] : $term->term_id;
                $term_ids[] = (int) $term_id;
            }
            
            // Assign terms to post
            if (!empty($term_ids)) {
                $result = wp_set_object_terms($product->ID, $term_ids, $taxonomy, false); // false = replace existing
                if (is_wp_error($result)) {
                    echo "  - Erro ao associar {$taxonomy} ao produto: " . $result->get_error_message() . "\n<br>";
                } else {
                    echo "  - Migrado " . count($term_ids) . " termo(s) para {$taxonomy}.\n<br>";
                }
            }
        }
    }
}

echo "Migração concluída com sucesso!\n<br>";
