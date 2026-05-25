<?php
require_once('wp-load.php');

$pages = [
    [
        'post_title'    => 'Ly Ly Hotel',
        'post_name'     => 'lyly-hotel-1',
        'post_status'   => 'publish',
        'post_type'     => 'page',
    ],
    [
        'post_title'    => 'Ly Ly Hotel 2',
        'post_name'     => 'lyly-hotel-2',
        'post_status'   => 'publish',
        'post_type'     => 'page',
    ]
];

foreach ($pages as $page) {
    $existing = get_page_by_path($page['post_name']);
    if (!$existing) {
        wp_insert_post($page);
        echo "Created page: " . $page['post_name'] . "\n";
    } else {
        echo "Page exists: " . $page['post_name'] . "\n";
    }
}
?>
