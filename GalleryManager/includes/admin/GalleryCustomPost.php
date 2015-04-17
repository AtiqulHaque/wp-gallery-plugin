<?php
/**
 * Created by PhpStorm.
 * User: atiq
 * Date: 12/19/14
 * Time: 1:23 AM
 */

class GalleryCustomPost {

    public function registerGallery(){

        $labels = array(
            'name' => _x( 'Gallery', 'image' ),
            'singular_name' => _x( 'image', 'image' ),
            'add_new' => _x( 'Add New', 'image' ),
            'add_new_item' => _x( 'Add New image', 'image' ),
            'edit_item' => _x( 'Edit image', 'image' ),
            'new_item' => _x( 'New image', 'image' ),
            'view_item' => _x( 'View image', 'image' ),
            'search_items' => _x( 'Search gallery', 'image' ),
            'not_found' => _x( 'No gallery found', 'image' ),
            'not_found_in_trash' => _x( 'No gallery images found in Trash', 'image' ),
            'parent_item_colon' => _x( 'Parent image:', 'image' ),
            'menu_name' => _x( 'Gallery', 'image' ),
        );
        $args = array(
            'labels' => $labels,
            'description' => 'Gallery images',
            'supports' => array( 'title', 'editor', 'thumbnail' ),
            'public' => true,
            'menu_icon' => 'dashicons-id' ,
            'hierarchical'      => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_nav_menus' => true,
            'publicly_queryable' => true,
            'exclude_from_search' => false,
            'has_archive' => true,
            'query_var' => true,
            'rewrite' => true,
            'capability_type' => 'post',
            'taxonomies' => array('gallery-albums'),
            'rewrite'           => array('slug' => 'galleryies', 'with_front' => false)

        );



        register_post_type( 'gallery', $args );
        $this->registerAlbum();

    }

    public function registerAlbum(){
        register_taxonomy('gallery-albums', 'gallery',
            array(
                'labels' =>  array(
                    'name'              => 'Gallery Albums',
                    'singular_name'     => 'Gallery Albums',
                    'search_items'      => 'Search Gallery Albums',
                    'all_items'         => 'All Gallery Albums',
                    'edit_item'         => 'Edit Gallery Albums',
                    'update_item'       => 'Update Gallery Albums',
                    'add_new_item'      => 'Add New Gallery Albums',
                    'new_item_name'     => 'New Gallery Albums Name',
                    'menu_name'         => 'Gallery Albums',
                ),
                'hierarchical' => true,
                'rewrite' => array( 'slug' => 'gallery-albums','with_front' => false),
                'sort' => true,
                'public' => true,
                'query_var' => true,
                'show_admin_column' => true,
                'show_in_nav_menus' => true
            )
        );
    }

    function galleryUpdatedMessages( $messages ) {
        global $post, $post_ID;
        $messages['gallery'] = array(
            0 => '',
            1 => sprintf( __('Gallery updated. <a href="%s">View gallery</a>'), esc_url( get_permalink($post_ID) ) ),
            2 => __('Custom field updated.'),
            3 => __('Custom field deleted.'),
            4 => __('Gallery updated.'),
            5 => isset($_GET['revision']) ? sprintf( __('Gallery restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
            6 => sprintf( __('Gallery published. <a href="%s">View Gallery</a>'), esc_url( get_permalink($post_ID) ) ),
            7 => __('Gallery saved.'),
            8 => sprintf( __('Gallery submitted. <a target="_blank" href="%s">Preview Gallery</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
            9 => sprintf( __('Gallery scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview gallery</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
            10 => sprintf( __('Gallery draft updated. <a target="_blank" href="%s">Preview gallery</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
        );
        return $messages;
    }

    public function galleryEditColumns($columns){
        $columns = array(
            "cb" => "<input type=\"checkbox\" />",
            "title" => "Event Name",
            "description" => "Description",
            "thumbnail" => "Pic",
            "cat" => "Albums"
        );

        return $columns;
    }

    public function galleryManagerCustomColumns($column){
        global $post;
        $custom = get_post_custom();
        switch ($column)
        {
            case "description":
                the_excerpt();
                break;
            case "title":
                title();
                break;
            case "thumbnail":
                var_dump(the_post_thumbnail(array('width'=>100,'height'=>100)));
                break;
            case "cat":
                echo get_the_term_list($post->ID, 'gallery-albums', '', ', ','');
                break;
        }
    }

    public function myPllGetPostTypes($types){
        return array_merge($types, array('gallery' => 'gallery'));
    }
    public function myPllGetTaxonoMy($types){
        return array_merge($types, array('gallery-albums' => 'gallery-albums'));
    }

} 