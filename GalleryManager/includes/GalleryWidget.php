<?php
class Gallery_widget extends WP_Widget {

    function __construct() {
        parent::__construct(
            'Gallery_widget',
            __('Gallery Widget', 'wpb_widget_domain'),
            array( 'description' => __( 'Gallery widget', 'wpb_widget_domain' ), )
        );
    }

    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );

       // echo pll_e($args['before_widget']);

        if ( ! empty( $title ) )
            echo $args['before_title'] . $title . $args['after_title'];


        $args = array(
            'post_type' => 'gallery',
            'posts_per_page'=>20 ,
            'orderby'=>'rand'
        );

        $my_query = new WP_Query($args);
        $contents = $my_query->get_posts();
        foreach($contents as $eachPost):?>
            <?php $terms = get_the_terms($eachPost->ID, 'gallery-albums' );?>
            <a href="<?php echo get_term_link( current($terms),'gallery-albums' );?>">
                <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $eachPost->ID ),'list-thumb');?>
                <img src="<?php echo $image[0] ?>" alt="" />
            </a>
        <?php
        endforeach;
        //echo $args['after_widget'];
    }

    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        else {
            $title = __( 'New title', 'wpb_widget_domain' );
        }
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
    <?php
    }

// Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        return $instance;
    }
} // Class wpb_widget ends here

// Register and load the widget
function wpb_load_widget() {
    register_widget( 'Gallery_widget' );
}
add_action( 'widgets_init', 'wpb_load_widget' );

