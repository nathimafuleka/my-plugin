# wp-events-plugin
### This plugin does the following:

1. You can now create new events in the WordPress admin dashboard by going to Posts > Add New and selecting the Event post type from the dropdown menu.

2. You can add custom fields for the event, such as the event date, ticket price, and number of tickets available, by using the event_date, ticket_price, and tickets_available meta keys. These fields will be automatically exposed in the WordPress REST API for the event post type.

3. You can access the event's meta data in the WordPress REST API by making a GET request to the `/wp-json/wp/v2/events` endpoint. For example, to get the event date, ticket price, and number of tickets available for a specific event, you can make a request to `/wp-json/wp/v2/events/{event_id}` and the meta data will be included in the response.

For example, if the event with an ID of `123` has an event date of "2022-12-31", a ticket price of "20.00", and 20 tickets available, the response from the API would be:
```
{
    "id": 123,
    "title": "New Year's Eve Party",
    "content": "Join us for a fun-filled New Year's Eve party...",
    "event_date": "2022-12-31",
    "ticket_price": "20.00",
    "tickets_available": "20"
}

```

## suggestion to improve this plugin
<li>One possible way to improve this plugin would be to add support for custom taxonomies. Taxonomies are a way to categorize and organize your content in WordPress, and they can be very useful for organizing events by type, location, or other criteria.
  <br><br>
For example, you could create a custom taxonomy called "Event Type" that allows you to categorize events as "Concert", "Festival", "Conference", etc. You could then add this taxonomy to your custom post type and expose it in the WordPress REST API. This would allow you to filter events by type and display them in different sections of your website or application.
</li>
<br><br>
<li>To add custom taxonomies to your plugin, you can use the register_taxonomy() function. Here is an example of how you could add a "Event Type" taxonomy to your plugin:
</li>

```
// Register the custom taxonomy for event types
function wp_events_plugin_register_taxonomy() {
    $labels = array(
        'name'                       => _x( 'Event Types', 'taxonomy general name' ),
        'singular_name'              => _x( 'Event Type', 'taxonomy singular name' ),
        'search_items'               => __( 'Search Event Types' ),
        'popular_items'              => __( 'Popular Event Types' ),
        'all_items'                  => __( 'All Event Types' ),
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => __( 'Edit Event Type' ),
        'update_item'                => __( 'Update Event Type' ),
        'add_new_item'               => __( 'Add New Event Type' ),
        'new_item_name'              => __( 'New Event Type Name' ),
        'separate_items_with_commas' => __( 'Separate event types with commas' ),
        'add_or_remove_items'        => __( 'Add or remove event types' ),
        'choose_from_most_used'      => __( 'Choose from the most used event types' ),
        'not_found'                  => __( 'No event types found.' ),
        'menu_name'                  => __( 'Event Types' ),
    );

    $args = array(
        'hierarchical'          => false,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'show_in_rest'          => true,
        'rest_base'             => 'event-type',
        'rest_controller_class' => 'WP_REST_Terms_Controller',
    );

    register_taxonomy( 'event_type', 'event', $args );
}
add_action( 'init', 'wp_events_plugin_register_taxonomy' );
```

<li>Once you have added the taxonomy, you can assign event types to your events in the WordPress admin dashboard by going to Events > Event Types and selecting the appropriate event type for each event. you can use the WordPress REST API to filter events by type by making a GET request to the /wp-json/wp/v2/events endpoint with a event_type query parameter. For example, if you want to get all events with the "Concert" event type, you can make a request to /wp-json/wp/v2/events?event_type=concert. This will return a list of all events with the "Concert" event type, and the response will include the event's title, content, and other meta data, as well as the event type taxonomy data.</li>

<li>Here is an example of how the response might look:
</li>

```
[    {        "id": 123,        "title": "Foo Fighters Concert",        "content": "Join us for a rockin' concert with the Foo Fighters...",        "event_date": "2022-12-31",        "ticket_price": "75.00",        "tickets_available": "100",        "event_type": [            {                "id": 5,                "name": "Concert",                "slug": "concert"            }        ]
    },
    {
        "id": 124,
        "title": "Lady Gaga Concert",
        "content": "Join us for an electrifying concert with Lady Gaga...",
        "event_date": "2022-12-31",
        "ticket_price": "75.00",
        "tickets_available": "100",
        "event_type": [
            {
                "id": 5,
                "name": "Concert",
                "slug": "concert"
            }
        ]
    }
]
```

