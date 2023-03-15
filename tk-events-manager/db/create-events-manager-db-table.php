<?php

function tkCreateEventsManagerDbTable() {
    global $wpdb;

    $table_name = $wpdb->prefix . 'tk_events_manager';
    if( $wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name ) {

        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE $table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            event_id varchar(255) NOT NULL,
            email varchar(255) NOT NULL,
            PRIMARY KEY  (id)
        ) $charset_collate;";
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );
    }
}
tkCreateEventsManagerDbTable();

