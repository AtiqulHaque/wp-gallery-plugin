<?php

/**
 * Class GalleryManager
 */
class GalleryManager {
    protected $version  = "";
    protected $plugin_slug  = "";
    protected $loader   = "";
    protected $langauge = "";


    public function __construct(){
        $this->version = '1.0';
        $this->plugin_slug = 'culture-aupair-gallery';
        $this->loadDependencies();
        $this->defineTheHooks();
    }

    private function loadDependencies() {
        require_once plugin_dir_path( __FILE__) . '/admin/GalleryCustomPost.php';

        require_once plugin_dir_path(__FILE__ ) . '/admin/GalleryManagerAdminLoader.php';

        require_once plugin_dir_path(__FILE__ ) . '/GalleryForntView.php';
        require_once plugin_dir_path(__FILE__ ) . '/GalleryWidget.php';

        $this->loader = new GalleryManagerAdminLoader();

    }

    private function defineTheHooks() {

        $adminView  = new GalleryCustomPost();
        $forntView  = new GalleryForntView();
        $this->loader->add_action( 'init', $adminView, 'registerGallery' );
        $this->loader->add_filter( 'post_updated_messages', $adminView, 'galleryUpdatedMessages' );
        $this->loader->add_action( 'wp_ajax_nopriv_myajax-submit', $forntView, 'myAjaxSubmit' );
        $this->loader->add_action( 'wp_ajax_myajax-submit', $forntView, 'myAjaxSubmit' );
        $this->loader->add_filter( 'manage_edit-gallery_columns',$adminView, "galleryEditColumns");
        $this->loader->add_action( 'manage_gallery_posts_custom_column', $adminView, 'galleryManagerCustomColumns' );
        $this->loader->add_action( 'template_include', $forntView, 'overrideTaxonomyTemplate' );
        $this->loader->add_filter( 'pll_get_post_types',$adminView, "myPllGetPostTypes");
        $this->loader->add_filter( 'pll_get_taxonomies',$adminView, "myPllGetTaxonoMy");

    }

    public function get_version() {
        return $this->version;
    }

    public function run() {
        $this->loader->run();
    }
}
