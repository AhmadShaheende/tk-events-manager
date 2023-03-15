<?php

add_shortcode('tk-display-events', 'tkDisplayEvents');
function tkDisplayEvents()
{
    if (isset($_GET['abmelden']) && isset($_GET['id'])) {
        if(tkCancelRegistration($_GET['id'])) {
         return 'Sie haben sich abgemeldet.';
        }
    }

    $eventsHtml = '';
    $args = [
        'post_type' => 'tk-events',
        'posts_per_page' => -1,
        'post_status' => 'published'
    ];
    $events = get_posts($args);

    if (empty($events)) {
        $eventsHtml = 'Es wurden keine Events gefunden.';
        return $eventsHtml;
    }

    foreach ($events as $event) {
        $eventsHtml .= tkCreateEventHtml(
            $event->ID,
            $event->post_title,
            get_the_excerpt($event->ID),
            get_post_meta($event->ID, 'tk-date', true),
            get_post_meta($event->ID, 'tk-available-places', true),
        );
    }
    return '<div class="tk-events">' . $eventsHtml . '</div>' . do_shortcode('[tk-event-registration-popup]');
}

function tkCreateEventHtml($eventId, $eventTitle, $eventDescription, $eventDate, $eventCurrentlyAvailablePlaces)
{
    $places = $eventCurrentlyAvailablePlaces >= 2 ? 'Plätze' : 'Platz';
    return '
        <div class="tk-event" id="' . $eventId . '">
            <h2>Tk Event: ' . $eventTitle . '</h2>
            <p><strong>Beschreibung:</strong> ' . $eventDescription . '</p>
            <p><strong>Datum:</strong> ' . $eventDate . '</p>
            <p class="tk-mb-3"><strong>Anzahl verfügbare Plätze: </strong>' . $eventCurrentlyAvailablePlaces . ' ' . $places . ' </p>

            <a href="#" class="tk-register-for-event">Anmelden</a>
        </div>
        ';
}

function tkCancelRegistration($eventDbId){
    global $wpdb;
    $prefix = $wpdb->prefix;
    $table_name = $prefix . 'tk_events_manager';
    $eventWpId = $wpdb->get_results(
        $wpdb->prepare(
            "SELECT event_id FROM $table_name where id = %d", $eventDbId
        ),
    )[0]->event_id;
    $deleted = $wpdb->delete(
        $table_name,
        array( 'id' =>  $eventDbId),
        array( '%d' )
    );
    if($deleted) {
        $eventCurrentAvailablePlaces = intval(get_post_meta($eventWpId, 'tk-available-places', true));
        update_post_meta($eventWpId, 'tk-available-places', $eventCurrentAvailablePlaces + 1);
        return true;
    }
    return false;
}

