<?php 
require 'wp-load.php'; 
$page = get_page_by_path('stay');
echo "ID: " . ($page ? $page->ID : 'NOT_FOUND') . "\n";
echo "STATUS: " . ($page ? $page->post_status : 'N/A') . "\n";
echo "PERMA: " . get_option('permalink_structure') . "\n";
