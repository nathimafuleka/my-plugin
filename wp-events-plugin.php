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

/*
MIT License

Copyright (c) 2022 Nkosinathi Mafuleka

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
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
