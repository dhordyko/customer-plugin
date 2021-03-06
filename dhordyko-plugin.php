<?php
/**
 * @package  DhordykoPlugin
 */
/*
Plugin Name: DhordykoPlugin
Plugin URI: http://dhordyko.com/plugin
Description: This is my first attempt on writing a custom Plugin for this amazing tutorial series.
Version: 1.0.0
Author: dhordyko
Author URI: http://dhordyko.com
License: GPLv2 or later
Text Domain: dhordyko-plugin
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.
This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
Copyright 2005-2015 Automattic, Inc.
*/
defined( 'ABSPATH' ) or die( 'Hey, what are you doing here? You silly human!' );

class AlecadddPlugin
{   //in constructor we call custom post type function
	function __construct() {
		add_action( 'init', array( $this, 'custom_post_type' ) );
	}
// in method we register scripts/styles for admin panel and front
	function register() {
        //scripts/styles for front
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ) );
        //scripts/styles for admin panel
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin' ) );
	}
//method for plugin activation hook
	function activate() {
		// generated a CPT
		$this->custom_post_type();
		// flush rewrite rules
		flush_rewrite_rules();
	}
//method for plugin deactivation hook
	function deactivate() {
		// flush rewrite rules
		flush_rewrite_rules();
	}

	function custom_post_type() {
		register_post_type( 'book', ['public' => true, 'label' => 'Books'] );
	}
//mathods for front scripts 
	function enqueue() {
		wp_enqueue_style( 'mypluginstyle', plugins_url( '/assets/mystyle.css',   __FILE__ ) );
		wp_enqueue_script( 'mypluginscript', plugins_url( '/assets/myscript.js',   __FILE__) );
	}
    //mathods for admin scripts 
    function enqueue_admin() {
		wp_enqueue_style( 'admuginstyle', plugins_url( '/assets/admin/admstyles.css',   __FILE__ ) );
		wp_enqueue_script( 'admscript', plugins_url( '/assets/admin/admscripts.js',   __FILE__) );
	}
}

if ( class_exists( 'AlecadddPlugin' ) ) {
	$alecadddPlugin = new AlecadddPlugin();
	$alecadddPlugin->register();
}

// activation we call activate function thiin class
register_activation_hook( __FILE__, array( $alecadddPlugin, 'activate' ) );

// deactivation
register_deactivation_hook( __FILE__, array( $alecadddPlugin, 'deactivate' ) );