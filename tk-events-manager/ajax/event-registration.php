<?php

function tkEventRegistration()
{
    require_once "../../../../wp-load.php";
    require_once "../email/confirmation-email.php";

    $eventId = $_POST['eventId'] ?? 0;
    $email = $_POST['email'] ?? '';
    $eventName = $_POST['eventName'] ?? '';


    if (!$eventId || empty($email) || empty($eventName)) {
        tkSendJsonMessage('Not enough Post information was retrieved.', 'error');
    }

    global $wpdb;

    $prefix = $wpdb->prefix;
    $table_name = $prefix . 'tk_events_manager';

    $data = array(
        'event_id' => $eventId,
        'email' => $email,
    );

    if (!tkCheckIfEmailExists($eventId, $email, $wpdb, $table_name)) {
        tkSendJsonMessage('Sie haben sich bereits für diese Veranstaltung angemeldet', 'error');
    }

    if (!tkCheckEventPlaceAvailability($eventId)) {
        tkSendJsonMessage('Es wurden leider Alle Plätze reserviert.', 'error');
    }

    $wpdb->query(
        $wpdb->prepare(
            "INSERT INTO $table_name (event_id, email) VALUES (%s, %s)",
            $data['event_id'],
            $data['email']
        )
    );

    if ($wpdb->last_error !== '') {
        tkSendJsonMessage($wpdb->last_error, 'error');
    }

   
    $eventCurrentAvailablePlaces = intval(get_post_meta($eventId, 'tk-available-places', true));
    update_post_meta($eventId, 'tk-available-places', $eventCurrentAvailablePlaces - 1);

    $eventDbId = $wpdb->get_results(
        $wpdb->prepare(
            "SELECT id FROM $table_name where email = %s", $email
        ),
    )[0]->id;
    $unregisterLink =  get_home_url() . '/tk-events/?abmelden=true&id=' . $eventDbId;

    tkSendConfirmationEmail($email, $eventName, $unregisterLink);

    tkSendJsonMessage('Sie haben sich erfolgreich für diese Veranstaltung angemeldet!', 'success');
}


tkEventRegistration();


/**
 * @param $eventId
 * @param $email
 * @param $wpdb
 * @param $table_name
 * @return bool
 */
function tkCheckIfEmailExists($eventId, $email, $wpdb, $table_name): bool
{
    $event_id_exists = $wpdb->get_var(
        $wpdb->prepare(
            "SELECT COUNT(*) FROM $table_name WHERE event_id = %s AND email = %s",
            $eventId, $email
        )
    );
    return $event_id_exists == 0;
}

/**
 * @param $eventId
 * @return bool
 */
function tkCheckEventPlaceAvailability($eventId): bool
{
    $eventAvailablePlaces = intval(get_post_meta($eventId, 'tk-available-places', true));
    return $eventAvailablePlaces >= 1;
}


/**
 * @param $message
 * @param $type
 * @return void
 */
function tkSendJsonMessage($message, $type)
{
    if ($type == 'error') {
        wp_send_json_error(array(
            'message' => __($message, 'tkt'),
        ));
    } else {
        wp_send_json_success(array(
            'message' => __($message, 'tkt'),
        ));
    }
}