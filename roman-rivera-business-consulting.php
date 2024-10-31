<?php
/**
 * @package RomanRiveraBusinessConsulting
 */
/**
    Plugin Name: Roman Rivera Business Consulting
    Plugin URI:
    Description: Plugin for Roman Rivera Business Consulting.
    Version: 1.0.1
    Requires at least: 5.5.3
    Requires PHP: 7.2
    Author: Carlos Colin
    Author URI: www.carloscolin.me
    License: GPL v2 or later
    License URI: www.gnu.org/licenses/gpl-2.0.html
    Text Domain: roman-rivera-business-consulting
    Domain Path: /languages
 */

/**
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

Copyright (C) 2020 Carlos Colin
 */

// Exit if accessed directly. Necessary for addressing site's vulnerabilities. 
// It's good practice and mandatory for uploading plugin.
if(!defined('ABSPATH')) exit;

function roman_rivera_business_consulting_admin_custom_page_contents(){
    ?>

        <h1>
            <?php esc_html_e( '¡Hola, mundo!', 'roman-rivera-business-consulting-plugin' ) ?>
        </h1>

    <?php
}

class Roman_Rivera_Business_Consulting_Plugin{
    // constructor
    function __construct(){
        add_action('init', array($this, 'custom_post_type'));
    }

    function register(){
        // add a style for the admin site
        add_action('admin_enqueue_scripts', array($this, 'enqueue'));

        // add style for the frontend
        add_action('wp_enqueue_scripts', array($this, 'enqueue_frontend'));
    }

    function add_admin_menu(){
        add_menu_page(
            __( 'Página Personalizada', 'roman-rivera-business-consulting-plugin' ),
            __( 'Menú Personalizado', 'roman-rivera-business-consulting-plugin' ),
            'manage_options',
            'sample-page',
            'roman_rivera_business_consulting_admin_custom_page_contents',
            'dashicons-schedule',
            3
        );
    }

    // methods
    function activate(){
        // generate a CPT
        $this->custom_post_type();
        // flush rewrite rules
        flush_rewrite_rules();
    }

    function deactivate(){
        // flush rewrite rules
        flush_rewrite_rules(); 
    }

    function custom_post_type(){
        register_post_type('romanrivera-cpt', array(
            'public' => true,
            'label' => 'Hello, World!'
        ));
    }

    function enqueue(){
        // enqueue scripts
        wp_enqueue_style('romanriverabusinessconsultingstyle', plugins_url('/assets/css/style.css', __FILE__));
    }

    function enqueue_frontend(){
        // enqueue CSS styles
        wp_enqueue_style('romanriverabusinessconsultingstyle', plugins_url('/assets/css/frontend.css', __FILE__));

        // enqueue JS scripts
        wp_enqueue_script('romanriverabusinessconsultingscript', plugins_url('/assets/js/scripts.js', __FILE__));
    }
}

if(class_exists('Roman_Rivera_Business_Consulting_Plugin')){
    $roman_rivera_business_consulting_plugin = new Roman_Rivera_Business_Consulting_Plugin();

    // enqueue scripts and styles
    $roman_rivera_business_consulting_plugin->register();
    
    // add admin custom menu tag
    add_action('admin_menu', array($roman_rivera_business_consulting_plugin, 'add_admin_menu'));
}

// activation
register_activation_hook(__FILE__, array( $roman_rivera_business_consulting_plugin, 'activate' ));

// deactivation
register_deactivation_hook(__FILE__, array( $roman_rivera_business_consulting_plugin, 'deactivate' ));