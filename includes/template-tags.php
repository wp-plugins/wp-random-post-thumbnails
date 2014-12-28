<?php
/**
 * @file template-tags.php
 *
 * Helper functions/template tags that can
 */


/**
 * Wrapper function around cmb_get_option
 * @param  string  $key Options array key
 * @return mixed        Option value
 * @since 1.0.0
 */
function wprpt_get_option( $key = '' ) {

    global $WPRPT_Options;
    return cmb_get_option( $WPRPT_Options->key, $key );

}


/**
 * Returns an array containing 1 image in the format [attachment id] => [image URL]
 *
 * @param none
 * @return mixed
 * @since 1.0.0
 */
function wprpt_get_random_image() {

    $all_images = wprpt_get_option( 'images' );
    $random_image = array_rand($all_images, 1);
    return $random_image;

}


/**
 * Returns the post types that should have a random image generated as the
 * post thumbnail.
 *
 * @param none
 * @return mixed
 * @since 1.0.0
 */
function wprpt_get_post_types() {

    $post_types = wprpt_get_option( 'selected_post_types' );
    return $post_types;

}