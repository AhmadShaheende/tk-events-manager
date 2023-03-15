<?php

add_action( 'init', 'tkCreateEventsPage' );
function tkCreateEventsPage()
{
    $page_title = 'TK Events'; // Replace with the title of the page you want to check
    $page = get_page_by_title($page_title);

    if ($page) {
        return;
    }

    $page_id = wp_insert_post(array(
        'post_title' => 'TK Events',
        'post_content' => '[tk-display-events]',
        'post_status' => 'publish',
        'post_type' => 'page'
    ));
    if ($page_id) {
        return $page_id;
    }
    return false;
}