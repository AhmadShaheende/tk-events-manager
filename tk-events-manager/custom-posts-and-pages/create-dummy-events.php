<?php

add_action('init', 'tkCreateDummyEvents');

function tkCreateDummyEvents()
{
    $args = [
        'post_type' => 'tk-events',
        'post_status' => 'published'
    ];
    $events = get_posts($args);
    if (count($events) != 0) {
        return;
    }
    $dummyEvents = [
        [
            'title' => 'Erste Veranstaltung',
            'description' => 'Das ist die erste Event der Aufgabe',
            'eventDate' => '10.04.2023',
            'eventAvailablePlaces' => '5',
        ],
        [
            'title' => 'Erste Veranstaltung',
            'description' => 'Das ist die erste Event der Aufgabe',
            'eventDate' => '10.04.2023',
            'eventAvailablePlaces' => '4',
        ]
    ];

    foreach ($dummyEvents as $dummyEvent) {
        $eventToInsert = array(
            'post_title' => $dummyEvent['title'], // Title of your event
            'post_content' => $dummyEvent['description'], // Content of your event
            'post_status' => 'publish', // Post status, 'publish' to make it visible on the site
            'post_type' => 'tk-events' // Post type should be 'tk_event' to create an event post
        );

        $post_id = wp_insert_post($eventToInsert);
        update_post_meta($post_id, 'tk-available-places', $dummyEvent['eventAvailablePlaces']);
        update_post_meta($post_id, 'tk-date', $dummyEvent['eventDate']);

    }
}