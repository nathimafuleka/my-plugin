<?php
/*
Plugin Name: WP Events Plugin
Plugin URI: http://bayzel.co.za/wp-events-plugi
Description: A plugin that creatnes a custom post type for events and exposes the event's meta data in the WordPress REST API
Version: 1.0
Author: Nkosinathi Mafuleka
Author URI: http://bayzel.co.za
License: MIT
*/
// Register the custom post type for events
function wp_events_plugin_register_post_type() {
    register_post_type( 'event', array(
        'labels' => array(
            'name' => __( 'Events' ),
            'singular_name' => __( 'Event' )
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array( 'title', 'editor', 'thumbnail' )
    ) );
}
add_action( 'init', 'wp_events_plugin_register_post_type' );

// Register the custom fields for the event post type
function wp_events_plugin_register_meta_fields() {
    register_meta( 'post', 'event_date', array(
        'show_in_rest' => true,
        'single' => true,
        'type' => 'string'
    ) );
    register_meta( 'post', 'ticket_price', array(
        'show_in_rest' => true,
        'single' => true,
        'type' => 'string'
    ) );
    register_meta( 'post', 'tickets_available', array(
        'show_in_rest' => true,
        'single' => true,
        'type' => 'string'
    ) );
}
add_action( 'init', 'wp_events_plugin_register_meta_fields' );
