<?php



class TkEventsPostType
{
    public function __construct()
    {
        add_action('init', array($this, 'registerPostType'));
        add_action('add_meta_boxes', array($this, 'addMetaBoxes'));
        add_action('save_post', array($this, 'saveMetaFields'));
    }

    public function registerPostType()
    {
        $labels = array(
            'name' => __('Tk Events', 'TKT'),
            'singular_name' => __('Tk Event', 'TKT'),
            'menu_name' => __('Tk Events', 'TKT'),
            'parent_item_colon' => __('Parent Tk Event:', 'TKT'),
            'all_items' => __('All Tk Events', 'TKT'),
            'view_item' => __('View Tk Event', 'TKT'),
            'add_new_item' => __('Add New Tk Event', 'TKT'),
            'add_new' => __('Add New', 'TKT'),
            'edit_item' => __('Edit Tk Event', 'TKT'),
            'update_item' => __('Update Tk Event', 'TKT'),
            'search_items' => __('Search Tk Events', 'TKT'),
            'not_found' => __('Not found', 'TKT'),
            'not_found_in_trash' => __('Not found in Trash', 'TKT'),
        );

        $args = array(
            'label' => __('tk-events', 'TKT'),
            'description' => __('Tk Events', 'TKT'),
            'labels' => $labels,
            'supports' => array('title', 'editor', 'thumbnail'),
            'hierarchical' => false,
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'menu_position' => 5,
            'menu_icon' => 'dashicons-calendar-alt',
            'show_in_admin_bar' => true,
            'show_in_nav_menus' => true,
            'can_export' => true,
            'has_archive' => true,
            'exclude_from_search' => false,
            'publicly_queryable' => true,
            'rewrite' => array('slug' => 'tk-events'),
            'capability_type' => 'post',
            'has_archive' => true,
        );

        register_post_type('tk-events', $args);
    }

    public function addMetaBoxes()
    {
        add_meta_box(
            'tk-available-places',
            __('Max Available Places', 'TKT'),
            array($this, 'maxAvailablePlacesCallback'),
            'tk-events',
            'normal',
            'default'
        );

        add_meta_box(
            'tk-date',
            __('Date', 'TKT'),
            array($this, 'datePrefixCallback'),
            'tk-events',
            'normal',
            'default'
        );
    }

    public function maxAvailablePlacesCallback($post)
    {
        wp_nonce_field('tk-available-places_meta_box', 'tk-available-places_meta_box_nonce');
        $value = get_post_meta($post->ID, 'tk-available-places', true);
        echo '<label for="tk-available-places">' . __('Available Places', 'TKT') . '</label>';
        echo '<input type="number" id="tk-available-places" name="tk-available-places" value="' . esc_attr($value) . '">';
    }

    public function datePrefixCallback($post)
    {
        wp_nonce_field('tk-date_meta_box', 'tk-date_meta_box_nonce');
        $value = get_post_meta($post->ID, 'tk-date', true);
        echo '<label for="tk-date">' . __('Date', 'TKT') . '</label>';
        echo '<input type="text" id="tk-date" name="tk-date" value="' . esc_attr($value) . '">';
    }

    public function saveMetaFields($post_id)
    {
        if (!isset($_POST['tk-available-places_meta_box_nonce']) ||
            !wp_verify_nonce($_POST['tk-available-places_meta_box_nonce'], 'tk-available-places_meta_box')) {
            return;
        }
        if (!isset($_POST['tk-date_meta_box_nonce']) ||
            !wp_verify_nonce($_POST['tk-date_meta_box_nonce'], 'tk-date_meta_box')) {
            return;
        }

        if (isset($_POST['tk-available-places'])) {
            update_post_meta($post_id, 'tk-available-places', sanitize_text_field($_POST['tk-available-places']));
        }

        if (isset($_POST['tk-date'])) {
            update_post_meta($post_id, 'tk-date', sanitize_text_field($_POST['tk-date']));
        }
    }
}
new TkEventsPostType();


