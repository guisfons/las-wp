<?php
/**
 * Migration script to import products from JSON to WordPress.
 * Run this via command line: php migrate-products.php
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Load WordPress
// Adjust path to wp-load.php if necessary. Assuming it's in the root of 'las-wp'
// Current file: las-wp/wp-content/themes/las-wp/inc/migrate-products.php
require_once(__DIR__ . '/../../../../wp-load.php');
require_once(ABSPATH . 'wp-admin/includes/image.php');
require_once(ABSPATH . 'wp-admin/includes/file.php');
require_once(ABSPATH . 'wp-admin/includes/media.php');

if (!function_exists('update_field')) {
    die('ACF is not active.');
}

$json_path = '/app/products-migration.json';
$image_base_path = '/app';

if (!file_exists($json_path)) {
    die('JSON file not found at ' . $json_path);
}

$products = json_decode(file_get_contents($json_path), true);

if (!$products) {
    die('Failed to decode JSON.');
}

function import_local_image($local_path)
{
    global $image_base_path;

    // Normalize path
    $full_path = $image_base_path . $local_path;

    if (!file_exists($full_path) || is_dir($full_path)) {
        echo "Image not found: $full_path\n";
        return null;
    }

    // Check if image already exists in media library by filename
    $filename = basename($full_path);
    $existing = get_posts([
        'post_type' => 'attachment',
        'name' => pathinfo($filename, PATHINFO_FILENAME),
        'posts_per_page' => 1,
        'post_status' => 'inherit'
    ]);

    if (!empty($existing)) {
        return $existing[0]->ID;
    }

    // Copy file to temp location for sideload
    $tmp = download_url('file://' . $full_path); // This might not work with file:// depending on setup
    // Alternative: manual copy
    if (is_wp_error($tmp)) {
        // Prepare file array for sideload
        $file_array = [
            'name' => $filename,
            'tmp_name' => str_replace('//', '/', sys_get_temp_dir() . '/' . $filename)
        ];
        copy($full_path, $file_array['tmp_name']);

        $id = media_handle_sideload($file_array, 0);

        if (is_wp_error($id)) {
            echo "Error importing $filename: " . $id->get_error_message() . "\n";
            return null;
        }
        return $id;
    }

    return null;
}

foreach ($products as $p) {
    echo "Importing: " . $p['name'] . "\n";

    // Check if product exists - simple check by title
    $existing_product = get_page_by_title($p['name'], OBJECT, 'product');
    $post_id = $existing_product ? $existing_product->ID : 0;

    $post_data = [
        'post_title' => $p['name'],
        'post_content' => '', // ACF handles the data
        'post_status' => 'publish',
        'post_type' => 'product',
        'post_name' => sanitize_title($p['name'])
    ];

    if ($post_id) {
        $post_data['ID'] = $post_id;
        wp_update_post($post_data);
    } else {
        $post_id = wp_insert_post($post_data);
    }

    if (!$post_id || is_wp_error($post_id)) {
        echo "Failed to create/update product: " . $p['name'] . "\n";
        continue;
    }

    // Map ACF Fields
    update_field('specialities', $p['specialities'], $post_id);
    update_field('brands', $p['brands'], $post_id);
    update_field('description', $p['description'], $post_id);

    if (!empty($p['logo_brand'])) {
        $logo_id = import_local_image($p['logo_brand']);
        if ($logo_id)
            update_field('logoBrand', $logo_id, $post_id);
    }

    if (!empty($p['imageUrl'])) {
        $img_id = import_local_image($p['imageUrl']);
        if ($img_id) {
            update_field('imageUrl', $img_id, $post_id);
            set_post_thumbnail($post_id, $img_id); // Also set as featured image
        }
    }

    if (isset($p['detail'])) {
        $detail = $p['detail'];
        update_field('subtitle', $detail['subtitle'] ?? '', $post_id);
        update_field('tags', $detail['tags'] ?? [], $post_id);
        update_field('generalInformation', $detail['general_information'] ?? '', $post_id);

        // About - Repeater
        if (!empty($detail['about'])) {
            $about_data = [];
            foreach ($detail['about'] as $point) {
                $about_data[] = ['point' => $point];
            }
            update_field('about', $about_data, $post_id);
        }

        // Technical Data - Repeater
        if (!empty($detail['technical_data'])) {
            $tech_data = [];
            // Assuming first row is header if it matches specific keys, but mock has it as first element
            foreach ($detail['technical_data'] as $index => $row) {
                if ($index === 0 && count($row) >= 3 && $row[0] == 'Categoria')
                    continue; // Skip header
                $tech_data[] = [
                    'col1' => $row[0] ?? '',
                    'col2' => $row[1] ?? '',
                    'col3' => $row[2] ?? '',
                    'col4' => $row[3] ?? '',
                ];
            }
            update_field('technicalData', $tech_data, $post_id);
        }

        // Pictures - Gallery
        if (!empty($detail['pictures'])) {
            $pic_ids = [];
            foreach ($detail['pictures'] as $pic_url) {
                $id = import_local_image($pic_url);
                if ($id)
                    $pic_ids[] = $id;
            }
            update_field('pictures', $pic_ids, $post_id);
        }

        // Links - Repeater
        if (!empty($detail['links'])) {
            $link_data = [];
            foreach ($detail['links'] as $link) {
                // If link is a local file, we might want to import it too, but for now just URL
                $link_data[] = [
                    'title' => $link['title'],
                    'fileUrl' => $link['url'],
                    'fileName' => $link['file_name'],
                    'type' => $link['type'],
                ];
            }
            update_field('links', $link_data, $post_id);
        }

        // Videos - Repeater
        if (!empty($detail['videos'])) {
            $video_data = [];
            foreach ($detail['videos'] as $video) {
                $video_data[] = [
                    'description' => $video['description'],
                    'videoUrl' => $video['url'],
                ];
            }
            update_field('videos', $video_data, $post_id);
        }

        // Images - Gallery
        if (!empty($detail['images'])) {
            $img_ids = [];
            foreach ($detail['images'] as $img_obj) {
                $id = import_local_image($img_obj['url']);
                if ($id)
                    $img_ids[] = $id;
            }
            update_field('images', $img_ids, $post_id);
        }

        // Testimonial - Group
        if (!empty($detail['testimonial']) && !empty($detail['testimonial']['testimonial'])) {
            $test = $detail['testimonial'];
            $test_pics = [];
            if (!empty($test['testimonial_pictures'])) {
                foreach ($test['testimonial_pictures'] as $tp) {
                    $id = import_local_image($tp);
                    if ($id)
                        $test_pics[] = $id;
                }
            }

            $doctor_photo = 0;
            if (!empty($test['doctor']['photo'])) {
                $doctor_photo = import_local_image($test['doctor']['photo']) ?: 0;
            }

            update_field('testimonial', [
                'testimonialText' => $test['testimonial'],
                'testimonialPictures' => $test_pics,
                'doctorName' => $test['doctor']['name'] ?? '',
                'doctorSpecialty' => $test['doctor']['specialty'] ?? '',
                'doctorPhoto' => $doctor_photo,
            ], $post_id);
        }
    }
}

echo "Migration finished.\n";
