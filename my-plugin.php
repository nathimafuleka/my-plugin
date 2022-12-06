<?php
/*
Plugin Name: My Plugin
Plugin URI: https://bayzel.co.za/my-plugin
Description: This is my plugin.
Version: 1.0.0
Author: Nkosinathi Mafuleka
Author URI: https://bayzel.co.za
License: MIT
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

if ( ! class_exists( 'My_Plugin' ) ) {

  class My_Plugin {

    function __construct() {
      add_action( 'init', array( $this, 'register_post_type' ) );
      add_action( 'rest_api_init', array( $this, 'register_rest_fields' ) );
    }

    function register_post_type() {
      $args = array(
        'public' => true,
        'label' => 'Books',
        'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields' ),
      );
      register_post_type( 'book', $args );
    }

    function register_rest_fields() {
      register_rest_field( 'book',
        'publisher',
        array(
          'get_callback' => array( $this, 'get_meta_data' ),
          'update_callback' => array( $this, 'update_meta_data' ),
          'schema' => array(
            'description' => __( 'The name of the book\'s publisher.' ),
            'type' => 'string',
          ),
        )
      );
    }

    function get_meta_data( $object, $field_name, $request ) {
      return get_post_meta( $object['id'], $field_name, true );
    }

    function update_meta_data( $value, $object, $field_name ) {
      return update_post_meta( $object->ID, $field_name, $value );
    }

  }

  $my_plugin = new My_Plugin();

}
