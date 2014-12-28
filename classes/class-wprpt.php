<?php

/**
 * Class WPRPT
 */
class WPRPT {

    /**
     * @var WPRPT
     */
    private static $instance = null;


    /**
     * Constructor. :)
     */
    function __construct() {

        $this->init_options_page();

        add_filter( 'post_thumbnail_id', array($this, 'set_post_thumbnail_id') );
        add_filter( 'get_post_metadata', array($this, 'filter_get_post_metadata') , 10, 4);

    }


    /**
     * Initializes the class
     *
     * @param none
     * @return WPRPT
     * @since 1.0.0
     */
    static function init() {

        if ( is_null( self::$instance ) ) {
            self::$instance = new WPRPT;
        }
        return self::$instance;

    }


    /**
     * Start up our options page class
     * @param none
     * @since 1.0.0
     */
    function init_options_page() {

        global $WPRPT_Options;
        $WPRPT_Options = new WPRPT_Options();
        $WPRPT_Options->hooks();

    }


    /**
     * Overrides the ID of the post thumbnail if one doesn't already exist.
     * @param $post_id
     * @return mixed
     * @since 1.0.0
     */
    function set_post_thumbnail_id($thumbnail_id) {

        // If the post already has a thumbnail, get out now
        if ( ! empty($thumbnail_id) )
            return $thumbnail_id;

        $selected_post_types = wprpt_get_post_types();

        // Get out if this isn't a valid selected post type
        if ( ! in_array( get_post_type(), $selected_post_types ) )
            return $thumbnail_id;

        // Grab a random image and return the ID
        $image_id = wprpt_get_random_image();
        return $image_id;

    }


    /**
     * Add a filter to modify get_post_metadata() so we can add a filter on the post thumbnail ID.
     * So, now there's a new filter 'post_thumbnail_id'.
     *
     * @see https://gist.github.com/westonruter/5808015
     * @param $value (null|array|string)
     * @param $object_id (int|array|string)
     * @param $meta_key (string|array|string)
     * @param $single (string|array|string)
     * @return string
     * @since 1.0.0
     */
    function filter_get_post_metadata( $value, $post_id, $meta_key, $single ) {

        // We want to pass the actual _thumbnail_id into the filter, so requires recursion
        static $is_recursing = false;

        // Only filter if we're not recursing and if it is a post thumbnail ID
        if ( ! $is_recursing && $meta_key === '_thumbnail_id' ) {
            $is_recursing = true; // prevent this conditional when get_post_thumbnail_id() is called
            $value = get_post_thumbnail_id( $post_id );
            $is_recursing = false;
            $value = apply_filters( 'post_thumbnail_id', $value, $post_id ); // yay!
            if ( ! $single ) {
                $value = array( $value );
            }
        }

        return $value;

    }

}