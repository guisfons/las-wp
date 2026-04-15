<?php
/**
 * The template for displaying the front page
 *
 * This template is specifically for the homepage defined in the WordPress settings.
 * Since this is a headless project, this file serves to identify the homepage
 * for ACF location rules and can also display a simple message.
 *
 * @package LAS-WP
 */

get_header();
?>

<main id="primary" class="site-main">
    <section class="hero-section">
        <div class="container">
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <h1><?php the_title(); ?></h1>
                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
                <p style="text-align: center; padding: 50px 0; color: #666;">
                    <?php esc_html_e( 'Headless WordPress Homepage - LAS for Life', 'las-wp' ); ?>
                </p>
            <?php endwhile; endif; ?>
        </div>
    </section>
</main>

<?php
get_footer();
