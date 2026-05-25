<?php
/*
Plugin Name: LyLy Room Manager
Plugin URI: http://localhost/lylyhotel
Description: Quản lý phòng chuyên nghiệp cho LyLy Hotel với 2 chi nhánh và hệ thống tiện nghi chi tiết.
Version: 1.0
Author: Antigravity
Author URI: #
License: GPL2
*/

if (!defined('ABSPATH')) exit;

/**
 * 1. Register Custom Post Type: Room
 */
function lyly_register_room_cpt() {
    $labels = array(
        'name'               => 'Quản lý phòng',
        'singular_name'      => 'Phòng',
        'menu_name'          => 'Quản lý phòng',
        'add_new'            => 'Thêm phòng mới',
        'add_new_item'       => 'Thêm phòng mới',
        'edit_item'          => 'Sửa thông tin phòng',
        'new_item'           => 'Phòng mới',
        'view_item'          => 'Xem phòng',
        'all_items'          => 'Tất cả phòng',
        'search_items'       => 'Tìm kiếm phòng',
        'not_found'          => 'Không tìm thấy phòng nào',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => true,
        'menu_icon'          => 'dashicons-admin-home',
        'supports'           => array('title', 'thumbnail'),
        'rewrite'            => array('slug' => 'room'),
    );

    register_post_type('lyly_room', $args);
}
add_action('init', 'lyly_register_room_cpt');

/**
 * 2. Register Taxonomy: Branch (Chi nhánh)
 */
function lyly_register_branch_taxonomy() {
    $labels = array(
        'name'                       => 'Chi nhánh',
        'singular_name'              => 'Chi nhánh',
        'search_items'               => 'Tìm kiếm chi nhánh',
        'all_items'                  => 'Tất cả chi nhánh',
        'parent_item'                => 'Chi nhánh cha',
        'parent_item_colon'          => 'Chi nhánh cha:',
        'edit_item'                  => 'Sửa chi nhánh',
        'update_item'                => 'Cập nhật chi nhánh',
        'add_new_item'               => 'Thêm chi nhánh mới',
        'new_item_name'              => 'Tên chi nhánh mới',
        'menu_name'                  => 'Chi nhánh',
        'add_or_remove_items'        => 'Thêm hoặc xóa chi nhánh',
        'not_found'                  => 'Không tìm thấy chi nhánh nào',
        'no_terms'                   => 'Không có chi nhánh',
        'items_list_navigation'      => 'Danh sách chi nhánh',
        'items_list'                 => 'Danh sách chi nhánh',
        'back_to_items'              => '← Quay lại chi nhánh',
    );

    register_taxonomy('lyly_branch', 'lyly_room', array(
        'labels'       => $labels,
        'rewrite'      => array('slug' => 'branch'),
        'hierarchical' => true,
        'show_admin_column' => true,
    ));
}
add_action('init', 'lyly_register_branch_taxonomy');

/**
 * Add custom fields to Branch (lyly_branch)
 */
function lyly_branch_add_meta_fields() {
    ?>
    <div class="form-field">
        <label for="branch_meta[address]">Địa chỉ chi nhánh</label>
        <input type="text" name="branch_meta[address]" id="branch_meta[address]" value="">
    </div>
    <div class="form-field">
        <label for="branch_meta[phone]">Số điện thoại</label>
        <input type="text" name="branch_meta[phone]" id="branch_meta[phone]" value="">
    </div>
    <?php
}
add_action('lyly_branch_add_form_fields', 'lyly_branch_add_meta_fields', 10, 2);

function lyly_branch_edit_meta_fields($term) {
    $branch_meta = get_term_meta($term->term_id, 'lyly_branch_meta', true);
    $address = isset($branch_meta['address']) ? $branch_meta['address'] : '';
    $phone = isset($branch_meta['phone']) ? $branch_meta['phone'] : '';
    ?>
    <tr class="form-field">
        <th scope="row" valign="top"><label>Địa chỉ chi nhánh</label></th>
        <td>
            <input type="text" name="branch_meta[address]" value="<?php echo esc_attr($address); ?>">
        </td>
    </tr>
    <tr class="form-field">
        <th scope="row" valign="top"><label>Số điện thoại</label></th>
        <td>
            <input type="text" name="branch_meta[phone]" value="<?php echo esc_attr($phone); ?>">
        </td>
    </tr>
    <?php
}
add_action('lyly_branch_edit_form_fields', 'lyly_branch_edit_meta_fields', 10, 2);

function lyly_save_branch_meta($term_id) {
    if (isset($_POST['branch_meta'])) {
        $branch_meta = get_term_meta($term_id, 'lyly_branch_meta', true);
        if (!is_array($branch_meta)) $branch_meta = array();
        
        $keys = array_keys($_POST['branch_meta']);
        foreach ($keys as $key) {
            if (isset($_POST['branch_meta'][$key])) {
                $branch_meta[$key] = sanitize_text_field($_POST['branch_meta'][$key]);
            }
        }
        update_term_meta($term_id, 'lyly_branch_meta', $branch_meta);
    }
}
add_action('edited_lyly_branch', 'lyly_save_branch_meta', 10, 2);
add_action('create_lyly_branch', 'lyly_save_branch_meta', 10, 2);



/**
 * 3. Add Meta Boxes for Room Details
 */
function lyly_add_room_meta_boxes() {
    add_meta_box('lyly_room_details', 'Thông tin chi tiết phòng', 'lyly_room_details_callback', 'lyly_room', 'normal', 'high');
    add_meta_box('lyly_room_amenities', 'Tiện nghi & Nội thất', 'lyly_room_amenities_callback', 'lyly_room', 'normal', 'high');
    add_meta_box('lyly_room_gallery', 'Thư viện ảnh phòng', 'lyly_room_gallery_callback', 'lyly_room', 'normal', 'high');
}
add_action('add_meta_boxes', 'lyly_add_room_meta_boxes');

// Callback for Room Details
function lyly_room_details_callback($post) {
    wp_nonce_field('lyly_save_room_details', 'lyly_room_details_nonce');
    
    $room_id = get_post_meta($post->ID, '_lyly_room_id', true);
    $num_beds = get_post_meta($post->ID, '_lyly_num_beds', true);
    $status = get_post_meta($post->ID, '_lyly_status', true);
    $max_guests = get_post_meta($post->ID, '_lyly_max_guests', true);
    $area = get_post_meta($post->ID, '_lyly_area', true);
    $price_hourly = get_post_meta($post->ID, '_lyly_price_hourly', true);
    $price_overnight = get_post_meta($post->ID, '_lyly_price_overnight', true);
    $highlights = get_post_meta($post->ID, '_lyly_highlights', true);

    ?>
    <style>
        .lyly-admin-field { margin-bottom: 15px; }
        .lyly-admin-field label { display: block; font-weight: bold; margin-bottom: 5px; }
        .lyly-admin-field input, .lyly-admin-field select { width: 100%; max-width: 400px; padding: 8px; }
        .lyly-row { display: flex; gap: 20px; flex-wrap: wrap; }
    </style>

    <div class="lyly-row">
        <div class="lyly-admin-field">
            <label>Mã số phòng</label>
            <input type="text" name="lyly_room_id" value="<?php echo esc_attr($room_id); ?>" placeholder="VD: P.101">
        </div>
        <div class="lyly-admin-field">
            <label>Số giường</label>
            <input type="number" name="lyly_num_beds" value="<?php echo esc_attr($num_beds); ?>">
        </div>
        <div class="lyly-admin-field">
            <label>Trạng thái</label>
            <select name="lyly_status">
                <option value="empty" <?php selected($status, 'empty'); ?>>Đang trống</option>
                <option value="occupied" <?php selected($status, 'occupied'); ?>>Có khách</option>
                <option value="cleaning" <?php selected($status, 'cleaning'); ?>>Đang dọn dẹp</option>
            </select>
        </div>
    </div>

    <div class="lyly-row">
        <div class="lyly-admin-field">
            <label>Số lượng khách tối đa</label>
            <input type="number" name="lyly_max_guests" value="<?php echo esc_attr($max_guests); ?>">
        </div>
        <div class="lyly-admin-field">
            <label>Diện tích phòng (m2)</label>
            <input type="text" name="lyly_area" value="<?php echo esc_attr($area); ?>">
        </div>
    </div>

    <div class="lyly-row">
        <div class="lyly-admin-field">
            <label>Giá theo giờ (VNĐ)</label>
            <input type="text" name="lyly_price_hourly" value="<?php echo esc_attr($price_hourly); ?>">
        </div>
        <div class="lyly-admin-field">
            <label>Giá qua đêm (VNĐ)</label>
            <input type="text" name="lyly_price_overnight" value="<?php echo esc_attr($price_overnight); ?>">
        </div>
    </div>

    <div class="lyly-admin-field">
        <label>Tiện nghi nổi bật (Tự nhập tay, cách nhau bằng dấu phẩy)</label>
        <input type="text" name="lyly_highlights" value="<?php echo esc_attr($highlights); ?>" placeholder="VD: Wifi, Điều hòa, View biển...">
    </div>
    <?php
}

// Callback for Amenities
function lyly_room_amenities_callback($post) {
    $selected_amenities = get_post_meta($post->ID, '_lyly_amenities', true);
    if (!is_array($selected_amenities)) $selected_amenities = array();

    $amenities_groups = array(
        'Hình ảnh/âm thanh' => array('truyền hình vệ tinh', 'TV màn hình phẳng'),
        'Mạng internet và điện thoại' => array('Wi-Fi', 'điện thoại trong phòng'),
        'Đồ điện tử' => array('điều hòa', 'máy sấy tóc', 'đèn đọc sách', 'đèn ngủ'),
        'Nhà tắm' => array('nhà tắm riêng', 'dép', 'đồ vệ sinh', 'khăn tắm', 'máy nước nóng', 'toilet', 'áo tắm', 'bộ tiện nghi phòng tắm'),
        'Ngoài trời & Cửa sổ' => array('quang cảnh thành phố'),
        'Giường' => array('giường King size', 'giường sofa'),
        'Đồ nội thất' => array('gương', 'ghế', 'bàn', 'giá treo quần áo', 'tủ'),
        'Khác' => array('két sắt', 'quầy bar mini', 'ấm nước', 'khu vực sinh hoạt', 'nước đóng chai', 'dịch vụ giặt là (tính phí)')
    );

    ?>
    <style>
        .amenity-group { margin-bottom: 20px; border-bottom: 1px solid #eee; padding-bottom: 10px; }
        .amenity-group h3 { margin-bottom: 10px; font-size: 14px; color: #2271b1; }
        .amenity-list { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 5px; }
    </style>
    
    <?php foreach ($amenities_groups as $group_name => $items) : ?>
        <div class="amenity-group">
            <h3><?php echo esc_html($group_name); ?></h3>
            <div class="amenity-list">
                <?php foreach ($items as $item) : ?>
                    <label>
                        <input type="checkbox" name="lyly_amenities[]" value="<?php echo esc_attr($item); ?>" 
                        <?php checked(in_array($item, $selected_amenities)); ?>>
                        <?php echo esc_html($item); ?>
                    </label>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endforeach; ?>
    <?php
}

/**
 * 4. Gallery Meta Box Callback
 */
function lyly_room_gallery_callback($post) {
    $gallery_data = get_post_meta($post->ID, '_lyly_room_gallery', true);
    ?>
    <div id="lyly_gallery_container">
        <ul id="lyly_gallery_list" style="display: flex; flex-wrap: wrap; gap: 10px; list-style: none; padding: 0;">
            <?php
            if ($gallery_data) {
                $ids = explode(',', $gallery_data);
                foreach ($ids as $id) {
                    $url = wp_get_attachment_image_src($id, 'thumbnail');
                    if ($url) {
                        echo '<li data-id="' . $id . '" style="position: relative; border: 1px solid #ccc; padding: 5px; background: #fff;">';
                        echo '<img src="' . $url[0] . '" style="display: block; width: 100px; height: 100px; object-fit: cover;">';
                        echo '<a href="#" class="lyly-remove-img" style="position: absolute; top: -5px; right: -5px; background: red; color: #fff; border-radius: 50%; width: 20px; height: 20px; text-align: center; line-height: 18px; text-decoration: none; font-weight: bold;">×</a>';
                        echo '</li>';
                    }
                }
            }
            ?>
        </ul>
        <input type="hidden" name="lyly_room_gallery" id="lyly_room_gallery_input" value="<?php echo esc_attr($gallery_data); ?>">
        <button type="button" id="lyly_add_gallery_btn" class="button button-primary">Thêm ảnh vào thư viện</button>
        <p class="description">Bạn có thể chọn nhiều ảnh cùng lúc.</p>
    </div>

    <script>
    jQuery(document).ready(function($) {
        var frame;
        $('#lyly_add_gallery_btn').on('click', function(e) {
            e.preventDefault();
            if (frame) { frame.open(); return; }
            frame = wp.media({
                title: 'Chọn ảnh cho thư viện',
                button: { text: 'Thêm vào thư viện' },
                multiple: true
            });
            frame.on('select', function() {
                var selection = frame.state().get('selection');
                var ids = $('#lyly_room_gallery_input').val() ? $('#lyly_room_gallery_input').val().split(',') : [];
                selection.map(function(attachment) {
                    attachment = attachment.toJSON();
                    if (ids.indexOf(attachment.id.toString()) === -1) {
                        ids.push(attachment.id);
                        $('#lyly_gallery_list').append('<li data-id="' + attachment.id + '" style="position: relative; border: 1px solid #ccc; padding: 5px; background: #fff;"><img src="' + attachment.sizes.thumbnail.url + '" style="display: block; width: 100px; height: 100px; object-fit: cover;"><a href="#" class="lyly-remove-img" style="position: absolute; top: -5px; right: -5px; background: red; color: #fff; border-radius: 50%; width: 20px; height: 20px; text-align: center; line-height: 18px; text-decoration: none; font-weight: bold;">×</a></li>');
                    }
                });
                $('#lyly_room_gallery_input').val(ids.join(','));
            });
            frame.open();
        });

        $(document).on('click', '.lyly-remove-img', function(e) {
            e.preventDefault();
            var li = $(this).closest('li');
            var id = li.data('id').toString();
            var ids = $('#lyly_room_gallery_input').val().split(',');
            var index = ids.indexOf(id);
            if (index > -1) {
                ids.splice(index, 1);
                $('#lyly_room_gallery_input').val(ids.join(','));
            }
            li.remove();
        });
    });
    </script>
    <?php
}

/**
 * 5. Enqueue Media Scripts for Admin
 */
function lyly_admin_scripts($hook) {
    // Kiểm tra nếu là trang sửa phòng
    $screen = get_current_screen();
    if (!$screen) return;

    $is_room_page = ($screen->post_type === 'lyly_room');

    if ($is_room_page) {
        wp_enqueue_media();
    }
}
add_action('admin_enqueue_scripts', 'lyly_admin_scripts');

/**
 * 6. Save Meta Box Data
 */
function lyly_save_room_meta($post_id) {
    if (!isset($_POST['lyly_room_details_nonce']) || !wp_verify_nonce($_POST['lyly_room_details_nonce'], 'lyly_save_room_details')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    // Fields to save
    $fields = array(
        'lyly_room_id' => '_lyly_room_id',
        'lyly_num_beds' => '_lyly_num_beds',
        'lyly_status' => '_lyly_status',
        'lyly_max_guests' => '_lyly_max_guests',
        'lyly_area' => '_lyly_area',
        'lyly_price_hourly' => '_lyly_price_hourly',
        'lyly_price_overnight' => '_lyly_price_overnight',
        'lyly_highlights' => '_lyly_highlights',
        'lyly_room_gallery' => '_lyly_room_gallery', // Save gallery
    );

    foreach ($fields as $post_key => $meta_key) {
        if (isset($_POST[$post_key])) {
            update_post_meta($post_id, $meta_key, sanitize_text_field($_POST[$post_key]));
        }
    }

    // Save Amenities (Array)
    if (isset($_POST['lyly_amenities'])) {
        $sanitized_amenities = array_map('sanitize_text_field', $_POST['lyly_amenities']);
        update_post_meta($post_id, '_lyly_amenities', $sanitized_amenities);
    } else {
        update_post_meta($post_id, '_lyly_amenities', array());
    }
}
add_action('save_post', 'lyly_save_room_meta');

/**
 * 7. Add custom columns to Room list
 */
function lyly_room_columns($columns) {
    $new_columns = array(
        'cb' => $columns['cb'],
        'title' => $columns['title'],
        'branch' => 'Chi nhánh',
        'room_id' => 'Mã phòng',
        'price' => 'Giá',
        'status' => 'Trạng thái',
        'date' => $columns['date'],
    );
    return $new_columns;
}
add_filter('manage_lyly_room_posts_columns', 'lyly_room_columns');

function lyly_room_custom_column($column, $post_id) {
    switch ($column) {
        case 'branch':
            $branches = get_the_terms($post_id, 'lyly_branch');
            if ($branches && !is_wp_error($branches)) {
                $branch_names = array();
                foreach ($branches as $branch) {
                    $branch_names[] = $branch->name;
                }
                echo implode(', ', $branch_names);
            } else {
                echo '<span style="color: #ccc;">Chưa chọn</span>';
            }
            break;
        case 'room_id':
            echo get_post_meta($post_id, '_lyly_room_id', true);
            break;
        case 'price':
            $hourly = get_post_meta($post_id, '_lyly_price_hourly', true);
            $overnight = get_post_meta($post_id, '_lyly_price_overnight', true);
            echo 'Giờ: ' . number_format($hourly) . 'đ<br>Đêm: ' . number_format($overnight) . 'đ';
            break;
        case 'status':
            $status = get_post_meta($post_id, '_lyly_status', true);
            if ($status == 'empty') echo '<span style="color: green; font-weight: bold;">Đang trống</span>';
            elseif ($status == 'occupied') echo '<span style="color: red; font-weight: bold;">Có khách</span>';
            else echo '<span style="color: orange;">Đang dọn</span>';
            break;
    }
}
add_action('manage_lyly_room_posts_custom_column', 'lyly_room_custom_column', 10, 2);

/**
 * Filter by Branch in Admin List
 */
function lyly_room_filter_by_branch() {
    global $typenow;
    if ($typenow == 'lyly_room') {
        $selected = isset($_GET['branch_filter']) ? $_GET['branch_filter'] : '';
        $branches = get_terms(array('taxonomy' => 'lyly_branch', 'hide_empty' => false));
        echo '<select name="branch_filter">';
        echo '<option value="">Tất cả chi nhánh</option>';
        foreach ($branches as $branch) {
            echo '<option value="' . $branch->term_id . '" ' . selected($selected, $branch->term_id, false) . '>' . $branch->name . '</option>';
        }
        echo '</select>';
    }
}
add_action('restrict_manage_posts', 'lyly_room_filter_by_branch');

function lyly_room_filter_query_by_branch($query) {
    global $pagenow, $typenow;
    if (is_admin() && $pagenow == 'edit.php' && $typenow == 'lyly_room' && isset($_GET['branch_filter']) && $_GET['branch_filter'] != '') {
        $branch_id = (int)$_GET['branch_filter'];
        $tax_query = array(
            array(
                'taxonomy' => 'lyly_branch',
                'field'    => 'term_id',
                'terms'    => $branch_id,
            )
        );
        $query->set('tax_query', $tax_query);
    }
}
add_action('parse_query', 'lyly_room_filter_query_by_branch');
