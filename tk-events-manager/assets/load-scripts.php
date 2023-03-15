<?php

add_action( 'wp_enqueue_scripts', 'tkEventsManagerScripts' );
function tkEventsManagerScripts(){
    if(is_page('TK Events')) {
        wp_enqueue_style('tk-events-manager-style', plugin_dir_url( __FILE__ ) . '/css/tk-events-manager-style.css');
        wp_enqueue_script('tk-events-manager', plugin_dir_url( __FILE__ ) . '/js/tk-events-manager.js', array('jquery'));
    }
}