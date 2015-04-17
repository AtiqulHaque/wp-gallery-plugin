<?php

get_header(); ?>
    <div id="main-container">
        <?php wp_enqueue_style('my_css', WP_CONTENT_URL . '/plugins/GalleryManager/css/magnific-popup.css'); ?>
        <?php wp_enqueue_script('my_script', WP_CONTENT_URL . '/plugins/GalleryManager/js/jquery.magnific-popup.min.js',array('jquery')); ?>
        <?php wp_enqueue_script('custom', WP_CONTENT_URL . '/plugins/GalleryManager/js/custom.js',array('jquery','my_script')); ?>
        <?php wp_enqueue_style( 'style-name', get_template_directory_uri()."/css/gallery.css" );?>
        <?php
                $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
        ?>
       <!-- <h2><?php /*//echo $term->name; */?></h2>-->
        <div class="gallery fusion shape clearfix">
            <?php while (have_posts()) : the_post(); ?>
                <?php
                $img_id = get_post_thumbnail_id();
                $original_img = wp_get_attachment_image_src ($img_id, 'original');
                ?>
                <a  href="<?php echo $original_img[0]; ?>" class="bin picFrame" title="<?php the_content()?>">
                    <?php the_post_thumbnail('thumb'); ?>
                </a>
            <?php endwhile; ?>
        </div>
    </div>

<?php get_footer(); ?>