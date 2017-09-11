<?php
/*
Plugin Name: Eraser for WP posts
Plugin URI: 
Description: Post erase from WordPress Admin.
Version: 1.0
Author: mrinal013
Author URI: 
Text Domain: eraser
Domain Path: /languages
License: GPL v3

Eraser for WP posts
Copyright (C) 2012-2017, Md. Mrinal Haque, mrinalhaque99@gmail.com

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

// Prevent direct file access
defined( 'ABSPATH' ) or exit;

add_action( 'admin_menu', 'my_admin_menu' );

function my_admin_menu() {
	add_management_page( __('Post Eraser', 'eraser'), __('Eraser Options','eraser'), 'manage_options', 'eraser_option.php', 'eraser_post_option' ); 
}

function eraser_post_option() {
	include 'settings.php';
}

add_action( 'admin_enqueue_scripts', 'my_enqueue' );
function my_enqueue($hook) {
	if($hook != 'tools_page_eraser_option') {
            return;
    }
    wp_enqueue_script( 'ajax-script', plugins_url( 'eraser.js', __FILE__ ), array('jquery'));
    wp_localize_script( 'ajax-script', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' )));
}

add_action("wp_ajax_nopriv_generate", "generate");
add_action("wp_ajax_generate", "generate");

function generate() {     
    $count = $_POST['id'];
    // echo $count;
	$args = array(
	    'post_type' => $count,
	    'posts_per_page' => -1,
	);
    
	$the_query = new WP_Query( $args );

	if ( $the_query->have_posts() ) :
	  while ( $the_query->have_posts() ) : $the_query->the_post();
	    $id = get_the_ID ();
	    echo "<ul id='sortable'>";
	    echo "<li class='ui-state-default'>" . the_title() . "<button class='delete'>x</button></li>";
	  endwhile;
	  echo "</ul>";
	endif;

	wp_reset_postdata();
	wp_die();
}