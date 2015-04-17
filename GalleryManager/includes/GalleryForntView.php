<?php
/*
    Plugin Name: Culturepair Gallery
    Description: Culturepair Gallery for various event images
*/

class GalleryForntView {


    public function __construct(){
        add_shortcode('culture-gallery', array(&$this,'addCultureGallery'));
    }

    public function createGallery(){
        $allAlbums  = get_categories(array('taxonomy' => 'gallery-albums'));
        foreach($allAlbums AS $eachAlbums){?>

            <?php
                $terms = apply_filters( 'taxonomy-images-get-terms', '', array(
                        'taxonomy'  =>  'gallery-albums',
                        'term_args' =>  array('slug' => $eachAlbums->slug)
                    ));
            ?>
            <div class="cell">
                <div class="frame">
                    <div class="album">
                        <a href="<?php echo get_term_link( $eachAlbums );?>" id="album-id-<?php echo $eachAlbums->cat_ID?>" class="getDetails picFrame">
                            <?php echo  wp_get_attachment_image( $terms[0]->image_id, 'category-thumb' )?>
                        </a>
                        <div class="album-title"> <?php echo $eachAlbums->name?></div>
                    </div>
                </div>
            </div>
        <?php
        }
    }

    public function addCultureGallery(){
        ob_start();
        $this->createGallery();
        $content = ob_get_clean();
        return $content;
    }

    public function getAlbumImages($albumId){
        echo $albumId;
    }

    public function overrideTaxonomyTemplate($template){
        $taxonomy_array = array('gallery-albums');
        foreach ($taxonomy_array as $taxonomy_single) {
            if ( is_tax($taxonomy_single) ) {
                if(file_exists(trailingslashit(get_stylesheet_directory()) . 'taxonomy-'.$taxonomy_single.'.php')) {
                    $template = trailingslashit(get_stylesheet_directory()) . 'taxonomy-'.$taxonomy_single.'.php';
                }
                else {
                    $template = trailingslashit(dirname(__FILE__)). 'taxonomy-'.$taxonomy_single.'.php';
                }
                break;
            }
        }
        return $template;
    }
}
