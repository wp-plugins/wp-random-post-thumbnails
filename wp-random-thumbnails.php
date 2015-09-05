<?php
/*
Plugin Name: WP Random Post Thumbnails
Plugin URI: https://github.com/bdeleasa/wp-random-thumbnails
Description: Allows you to upload images to be used as random images for posts.  This plugin shows one of the uploaded images as the featured image for a post (if the post doesn't have one attached already). Useful if your theme shows thumbnails for the posts, and you don't want any posts without images.
Version: 1.3.0
Author: Brianna Deleasa
Author URI: http://www.briannadeleasa.com
License: GPL v3

WP Random Post Thumbnails
Copyright (C) 2014 Brianna Deleasa

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/


// Require our includes and classes
require_once 'includes/template-tags.php';
require_once 'classes/class-wprpt-options.php';
require_once 'classes/class-wprpt.php';


add_action( 'init', 'wprpt_init', 20 );
/**
 * Start up the plugin
 *
 * @params none
 * @since 1.0.0
 */
function wprpt_init() {

    WPRPT::init();

}


add_action( 'init', 'wprpt_initialize_cmb_init', 10 );
/**
 * Includes the necessary CMB init file
 *
 * @param none
 * @return none
 * @since 1.0.2
 */
function wprpt_initialize_cmb_init() {

    if ( !class_exists( 'cmb_Meta_Box' ) ) {
        require_once 'includes/cmb/init.php';
    }

}