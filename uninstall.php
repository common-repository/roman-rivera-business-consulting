<?php
/**
 * Script is triggered when plugin is uninstalled
 * @package RomanRiveraBusinessConsulting
 */

/**
 * Always include this security check into the uninstall.php file.
 */
if(!defined('WP_UNINSTALL_PLUGIN')) die;

/**
 * Clear database data
 */
global $wpdb; // Access database via this global variable and execute queries
$wpdb->query("DELETE FROM wp_posts WHERE post_type = 'services-cpt'");
$wpdb->query("DELETE FROM wp_postmeta WHERE post_id NOT IN (SELECT id FROM wp_posts )");

