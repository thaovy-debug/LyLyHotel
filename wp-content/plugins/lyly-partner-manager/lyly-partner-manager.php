<?php
/**
 * Plugin Name: LyLy Partner Manager
 * Description: Hệ thống quản lý danh sách "Đối tác & Khách hàng đại lý" cho website LyLy Hotel. Dễ dàng quản lý logo, thứ tự sắp xếp và liên kết trang đối tác.
 * Version: 1.0.0
 * Author: Triều & Antigravity
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// Helper 1: Hỗ trợ hiển thị ảnh URL thường lẫn ảnh chuỗi mã hóa Base64
if (!function_exists('lyly_esc_url_with_base64')) {
    function lyly_esc_url_with_base64($url) {
        if (strpos($url, 'data:') === 0) {
            return strip_tags($url);
        }
        return esc_url($url);
    }
}

// Helper 2: Sửa lỗi WordPress tự xóa link nếu người dùng gõ thiếu giao thức (ví dụ: google.com thay vì http://google.com) hoặc dùng link tương đối
if (!function_exists('lyly_clean_redirect_url')) {
    function lyly_clean_redirect_url($url) {
        if (empty($url)) {
            return '';
        }
        if (strpos($url, '/') === 0 || strpos($url, '#') === 0 || preg_match('/^(http|https|ftp|mailto|tel):/i', $url)) {
            return esc_url($url);
        }
        if (strpos($url, '.') !== false && strpos($url, '/') === false) {
            return esc_url('http://' . $url);
        }
        return esc_url($url);
    }
}

// 0. Load thư viện Media & Font Awesome cho Admin trang soạn thảo Partner
add_action('admin_enqueue_scripts', function($hook) {
    if (get_post_type() == 'lyly_partner') {
        wp_enqueue_media();
        wp_enqueue_style('font-awesome-6', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css');
    }
});

// 1. Đăng ký CPT "Đối tác"
add_action('init', 'lyly_register_partner_cpt');
function lyly_register_partner_cpt() {
    $labels = array(
        'name'               => 'Các Đối Tác',
        'singular_name'      => 'Đối Tác',
        'menu_name'          => 'Đối Tác',
        'add_new'            => 'Thêm Đối Tác Mới',
        'add_new_item'       => 'Thêm Đối Tác Mới',
        'edit_item'          => 'Sửa Đối Tác',
        'new_item'           => 'Đối Tác Mới',
        'all_items'          => 'Tất Cả Đối Tác',
        'view_item'          => 'Xem Đối Tác',
        'search_items'       => 'Tìm kiếm Đối Tác',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => false, // Không tạo trang chi tiết đơn lẻ tự động
        'show_ui'            => true,
        'show_in_menu'       => true,
        'menu_icon'          => 'dashicons-groups', // Icon đối tác/nhóm
        'menu_position'      => 25,
        'supports'           => array('title', 'page-attributes'), // Hỗ trợ tiêu đề và thứ tự sắp xếp
    );

    register_post_type('lyly_partner', $args);
}

// Xóa khung "Ảnh đại diện" mặc định của WordPress ở cột phải để không bị trùng lặp với bộ upload logo tùy biến
add_action('do_meta_boxes', 'lyly_partner_remove_default_featured_image');
function lyly_partner_remove_default_featured_image() {
    remove_meta_box('postimagediv', 'lyly_partner', 'side');
}

// Tắt trình soạn thảo Gutenberg Block Editor cho đối tác để giữ giao diện quản trị gọn gàng
add_filter('use_block_editor_for_post_type', function($is_enabled, $post_type) {
    if ($post_type === 'lyly_partner') return false;
    return $is_enabled;
}, 10, 2);

// 2. Tạo Meta Box Quản Lý Chi Tiết Đối Tác
add_action('add_meta_boxes', 'lyly_partner_add_meta_boxes');
function lyly_partner_add_meta_boxes() {
    add_meta_box(
        'lyly_partner_details', 
        '🤝 HỆ THỐNG CẤU HÌNH ĐỐI TÁC & LOGO', 
        'lyly_partner_meta_box_html', 
        'lyly_partner', 
        'normal', 
        'high'
    );
}

function lyly_partner_meta_box_html($post) {
    wp_nonce_field('lyly_partner_save_meta', 'lyly_partner_nonce');
    
    $external_url = get_post_meta($post->ID, '_lyly_partner_external_image_url', true);
    $partner_link  = get_post_meta($post->ID, '_lyly_partner_link', true);
    $thumb_id     = get_post_thumbnail_id($post->ID);
    
    $preview_url = $external_url ? $external_url : wp_get_attachment_image_url($thumb_id, 'large');
    ?>
    <style>
        :root {
            --lyly-panel-bg: #ffffff;
            --lyly-panel-header: #fafbfc;
            --lyly-gradient-neon: linear-gradient(45deg, #00f2fe 0%, #4facfe 100%);
            --lyly-cyan: #00f2fe;
            --lyly-blue: #2196f3;
            --lyly-red: #ff4757;
            --lyly-text-main: #1d1d1f;
            --lyly-border: #e1e8ed;
        }
        
        #lyly_partner_details { border: none; background: transparent; box-shadow: none; }
        #lyly_partner_details .postbox-header { display: none; } 
        #lyly_partner_details .inside { padding: 0 !important; margin: 0 !important; }

        .lyly-master-wrapper { font-family: 'Open Sans', -apple-system, sans-serif; }
        .lyly-card { background: var(--lyly-panel-bg); border-radius: 12px; margin-bottom: 25px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); overflow: hidden; border: 1px solid var(--lyly-border); transition: all 0.3s ease; }
        .lyly-card:hover { box-shadow: 0 15px 40px rgba(33, 150, 243, 0.08); }
        
        .lyly-card-header { padding: 18px 25px; background: var(--lyly-panel-header); border-bottom: 1px solid var(--lyly-border); display: flex; align-items: center; justify-content: space-between; }
        .lyly-card-header h4 { margin: 0; font-size: 15px; font-weight: 700; color: #1e3c72; text-transform: uppercase; letter-spacing: 1px; display: flex; align-items: center; gap: 10px;}
        .lyly-card-header h4 i { background: var(--lyly-gradient-neon); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-size: 18px; }
        .lyly-card-header .header-bar { height: 3px; width: 60px; background: var(--lyly-gradient-neon); border-radius: 10px; }
        
        .lyly-card-body { padding: 25px 30px; }
        .lyly-form-group { margin-bottom: 20px; }
        .lyly-label { display: flex; align-items: center; gap: 8px; font-weight: 600; margin-bottom: 8px; color: var(--lyly-text-main); font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px;}
        .lyly-label i { color: var(--lyly-blue); }
        
        .lyly-input-wrapper { position: relative; display: flex; align-items: center; width: 100%; }
        .lyly-input-icon { position: absolute; left: 16px; color: #b0b0b7; font-size: 15px; z-index: 10; pointer-events: none; }
        
        input.lyly-input { width: 100% !important; padding: 12px 15px 12px 42px !important; border: 2px solid var(--lyly-border) !important; border-radius: 8px !important; box-sizing: border-box !important; font-size: 14px !important; font-weight: 500 !important; transition: all 0.3s ease !important; color: var(--lyly-text-main) !important; background: #fdfdfd !important; height: 46px !important; line-height: normal !important;}
        input.lyly-input:hover { border-color: #bcd0e0 !important; }
        input.lyly-input:focus { outline: none !important; border-color: var(--lyly-cyan) !important; box-shadow: 0 0 15px rgba(0, 242, 254, 0.4) !important; background: #fff !important; }

        .lyly-help-text { background: #f0f6fc; border-left: 4px solid var(--lyly-blue); padding: 12px 18px; margin-bottom: 18px; font-size: 13px; color: var(--lyly-text-main); border-radius: 0 6px 6px 0; line-height: 1.6; }
    </style>

    <div class="lyly-master-wrapper">
        <!-- 1. QUẢN LÝ LOGO -->
        <div class="lyly-card">
            <div class="lyly-card-header">
                <h4><i class="fa-solid fa-image"></i> Logo của Đối tác</h4>
                <div class="header-bar"></div>
            </div>
            <div class="lyly-card-body">
                <div style="display: grid; grid-template-columns: 200px 1fr; gap: 30px;">
                    <div class="lyly-image-preview-wrapper" style="width: 100%; height: 160px; border-radius: 12px; border: 2px dashed var(--lyly-border); overflow: hidden; background: #f8f9fa; display: flex; align-items: center; justify-content: center; position: relative;">
                        <?php if ($preview_url) : ?>
                            <img id="lyly_partner_preview" src="<?php echo lyly_esc_url_with_base64($preview_url); ?>" style="max-width: 100%; max-height: 100%; object-fit: contain; padding: 10px; background: #fff;">
                        <?php else : ?>
                            <i class="fa-solid fa-cloud-arrow-up" style="font-size: 40px; color: #ccc;"></i>
                        <?php endif; ?>
                    </div>
                    <div>
                        <div class="lyly-form-group">
                            <label class="lyly-label"><i class="fa-solid fa-link"></i> Link ảnh Logo hoặc Base64 hoặc URL ngoài</label>
                            <div class="lyly-input-wrapper">
                                <i class="fa-solid fa-globe kc-input-icon"></i>
                                <input type="text" id="lyly_partner_external_image_url" name="lyly_partner_external_image_url" class="lyly-input" value="<?php echo esc_attr($external_url); ?>" placeholder="https://... hoặc data:image/png;base64,..." />
                            </div>
                        </div>
                        
                        <!-- Hidden field for Library image ID -->
                        <input type="hidden" name="lyly_thumbnail_id" id="lyly_thumbnail_id" value="<?php echo esc_attr($thumb_id); ?>">

                        <div style="display: flex; gap: 10px; margin-top: 15px;">
                            <button type="button" id="lyly_partner_select_media" class="button button-primary button-large" style="height: 40px; border-radius: 6px;"><i class="fa-solid fa-images"></i> Chọn từ Thư viện</button>
                            <button type="button" id="lyly_partner_remove_img" class="button button-secondary button-large" style="height: 40px; border-radius: 6px; color: var(--lyly-red);"><i class="fa-solid fa-trash"></i> Xóa logo</button>
                        </div>
                        <p style="margin-top: 10px; font-size: 12px; color: #888;"><i>Ưu tiên: Link logo ngoài sẽ được chọn trước ảnh Thư viện. Bạn có thể sử dụng ảnh SVG/PNG trong suốt để hiển thị chuyên nghiệp nhất.</i></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2. LIÊN KẾT TRANG ĐỐI TÁC -->
        <div class="lyly-card" style="margin-bottom: 0;">
            <div class="lyly-card-header">
                <h4><i class="fa-solid fa-link"></i> Liên Kết Trang Web Đối Tác</h4>
                <div class="header-bar"></div>
            </div>
            <div class="lyly-card-body">
                <p class="lyly-help-text"><i class="fa-solid fa-circle-info"></i> Nhập link trang chủ hoặc trang giới thiệu của đối tác (Optional). Khi khách hàng click vào logo đối tác ở footer, họ sẽ được điều hướng tới link này. Nếu bỏ trống, logo chỉ hiển thị bình thường.</p>
                <div class="lyly-form-group" style="margin-bottom: 0;">
                    <label class="lyly-label"><i class="fa-solid fa-arrow-pointer"></i> Link đối tác (URL)</label>
                    <div class="lyly-input-wrapper">
                        <i class="fa-solid fa-paperclip kc-input-icon"></i>
                        <input type="text" name="lyly_partner_link" class="lyly-input" value="<?php echo esc_attr($partner_link); ?>" placeholder="Ví dụ: https://booking.com hoặc https://..." />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    jQuery(document).ready(function($){
        var frame;
        $('#lyly_partner_select_media').on('click', function(e){
            e.preventDefault();

            if (typeof wp === 'undefined' || !wp.media) {
                alert('Hệ thống Media chưa sẵn sàng, vui lòng tải lại trang.');
                return;
            }

            if(frame) { frame.open(); return; }
            
            frame = wp.media({ 
                title: 'Chọn Logo đối tác', 
                button: { text: 'Dùng logo này' }, 
                multiple: false 
            });
            
            frame.on('select', function(){
                var attachment = frame.state().get('selection').first().toJSON();
                // Reset link ngoài
                $('#lyly_partner_external_image_url').val(''); 
                // Cập nhật ID
                $('#lyly_thumbnail_id').val(attachment.id);
                // Cập nhật preview
                $('#lyly_partner_preview').attr('src', attachment.url).show();
                if($('#lyly_partner_preview').length == 0) {
                    $('.lyly-image-preview-wrapper').html('<img id="lyly_partner_preview" src="'+attachment.url+'" style="max-width: 100%; max-height: 100%; object-fit: contain; padding: 10px; background: #fff;">');
                }
                $('.lyly-image-preview-wrapper i').hide();
            });
            frame.open();
        });

        $('#lyly_partner_remove_img').on('click', function(){
            $('#lyly_partner_external_image_url').val('');
            $('#lyly_thumbnail_id').val('');
            $('#lyly_partner_preview').attr('src', '').hide();
            if($('.lyly-image-preview-wrapper img').length) $('.lyly-image-preview-wrapper img').remove();
            if($('.lyly-image-preview-wrapper i').length == 0) $('.lyly-image-preview-wrapper').append('<i class="fa-solid fa-cloud-arrow-up" style="font-size: 40px; color: #ccc;"></i>');
            $('.lyly-image-preview-wrapper i').show();
        });

        $('#lyly_partner_external_image_url').on('input', function(){
            var val = $(this).val();
            if(val) {
                $('#lyly_partner_preview').attr('src', val).show();
                $('.lyly-image-preview-wrapper i').hide();
            }
        });
    });
    </script>
    <?php
}

// 3. Lưu Dữ Liệu Meta Box
add_action('save_post', 'lyly_partner_save_meta');
function lyly_partner_save_meta($post_id) {
    if (!isset($_POST['lyly_partner_nonce']) || !wp_verify_nonce($_POST['lyly_partner_nonce'], 'lyly_partner_save_meta')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    if (isset($_POST['lyly_partner_external_image_url'])) {
        update_post_meta($post_id, '_lyly_partner_external_image_url', sanitize_text_field($_POST['lyly_partner_external_image_url']));
    }
    if (isset($_POST['lyly_partner_link'])) {
        update_post_meta($post_id, '_lyly_partner_link', sanitize_text_field($_POST['lyly_partner_link']));
    }
    
    // Lưu Thumbnail ID (Feature Image) từ media library thủ công
    if (isset($_POST['lyly_thumbnail_id'])) {
        $tid = intval($_POST['lyly_thumbnail_id']);
        if ($tid > 0) set_post_thumbnail($post_id, $tid);
        else delete_post_thumbnail($post_id);
    }
}

// 4. Tùy Chỉnh Bảng Danh Sách Trong Admin
add_filter('manage_lyly_partner_posts_columns', 'lyly_set_custom_edit_lyly_partner_columns');
function lyly_set_custom_edit_lyly_partner_columns($columns) {
    $new_columns = array();
    $new_columns['cb'] = $columns['cb'];
    $new_columns['partner_img'] = 'Logo';
    $new_columns['title'] = 'Tên Đối Tác';
    $new_columns['partner_link'] = 'Website Đối Tác';
    $new_columns['menu_order'] = 'Thứ tự';
    $new_columns['date'] = $columns['date'];
    return $new_columns;
}

add_action('manage_lyly_partner_posts_custom_column', 'lyly_custom_lyly_partner_column', 10, 2);
function lyly_custom_lyly_partner_column($column, $post_id) {
    switch ($column) {
        case 'partner_img':
            $ext_img = get_post_meta($post_id, '_lyly_partner_external_image_url', true);
            $img_url = get_the_post_thumbnail_url($post_id, 'thumbnail');
            $final_img = $ext_img ? $ext_img : ($img_url ? $img_url : '');
            if ($final_img) {
                echo '<img src="'.lyly_esc_url_with_base64($final_img).'" style="max-width: 80px; max-height: 40px; object-fit: contain; border: 1px solid #ddd; padding: 2px; border-radius: 4px; background: #fff;" />';
            } else {
                echo '<i style="color: #bbb;">Chưa có logo</i>';
            }
            break;
        case 'partner_link':
            $link = get_post_meta($post_id, '_lyly_partner_link', true);
            if ($link) {
                echo '<a href="'.lyly_clean_redirect_url($link).'" target="_blank" style="font-weight: 500; text-decoration: none;">'.esc_html($link).'</a>';
            } else {
                echo '<span style="color: #888;">Chưa gắn link</span>';
            }
            break;
        case 'menu_order':
            $post = get_post($post_id);
            echo '<b>' . esc_html($post->menu_order) . '</b>';
            break;
    }
}

// Cho phép sort theo menu_order
add_filter('manage_edit-lyly_partner_sortable_columns', 'lyly_partner_sortable_columns');
function lyly_partner_sortable_columns($columns) {
    $columns['menu_order'] = 'menu_order';
    return $columns;
}

// 5. Shortcode Hiển Thị "Đối tác & Khách hàng đại lý"
add_shortcode('lyly_partners_list', 'lyly_partners_list_shortcode');
function lyly_partners_list_shortcode($atts) {
    $default_title = 'Đối tác liên kết';
    $default_subtitle = '';
    
    $args = shortcode_atts([
        'title'     => $default_title,
        'subtitle'  => $default_subtitle,
        'only_grid' => 'false' // 'true' để chỉ hiển thị lưới logo, không bọc section, title, subtitle
    ], $atts);

    $query = new WP_Query([
        'post_type'      => 'lyly_partner',
        'posts_per_page' => -1,
        'orderby'        => 'menu_order',
        'order'          => 'ASC'
    ]);

    $only_grid = (filter_var($args['only_grid'], FILTER_VALIDATE_BOOLEAN) || $args['only_grid'] === 'true');

    ob_start();
    if ($query->have_posts()) :
        if ($only_grid) :
            ?>
            <div class="lyly-clients-grid">
                <?php
                while ($query->have_posts()) : $query->the_post();
                    $post_id = get_the_ID();
                    $ext_img = get_post_meta($post_id, '_lyly_partner_external_image_url', true);
                    $img_url = $ext_img ? $ext_img : get_the_post_thumbnail_url($post_id, 'large');
                    $link = get_post_meta($post_id, '_lyly_partner_link', true);
                    $has_link = !empty($link);

                    $tag_open  = $has_link ? '<a href="' . lyly_clean_redirect_url($link) . '" target="_blank" class="lyly-client-logo" style="text-decoration: none;"' : '<div class="lyly-client-logo"';
                    $tag_close = $has_link ? '</a>' : '</div>';
                    ?>
                    <?php echo $tag_open; ?>>
                        <?php if ($img_url) : ?>
                            <img src="<?php echo lyly_esc_url_with_base64($img_url); ?>" alt="<?php the_title_attribute(); ?>">
                        <?php endif; ?>
                    <?php echo $tag_close; ?>
                    <?php
                endwhile;
                wp_reset_postdata();
                ?>
            </div>
            <?php
        else :
            ?>
            <section class="lyly-section" style="background-color: #f4f5f7; text-align: center; padding: 60px 0;">
                <div class="lyly-container">
                    <h2 class="lyly-title"><?php echo esc_html($args['title']); ?></h2>
                    <p class="lyly-text"><?php echo esc_html($args['subtitle']); ?></p>
                    
                    <div class="lyly-clients-grid">
                        <?php
                        while ($query->have_posts()) : $query->the_post();
                            $post_id = get_the_ID();
                            $ext_img = get_post_meta($post_id, '_lyly_partner_external_image_url', true);
                            $img_url = $ext_img ? $ext_img : get_the_post_thumbnail_url($post_id, 'large');
                            $link = get_post_meta($post_id, '_lyly_partner_link', true);
                            $has_link = !empty($link);

                            $tag_open  = $has_link ? '<a href="' . lyly_clean_redirect_url($link) . '" target="_blank" class="lyly-client-logo" style="text-decoration: none;"' : '<div class="lyly-client-logo"';
                            $tag_close = $has_link ? '</a>' : '</div>';
                            ?>
                            <?php echo $tag_open; ?>>
                                <?php if ($img_url) : ?>
                                    <img src="<?php echo lyly_esc_url_with_base64($img_url); ?>" alt="<?php the_title_attribute(); ?>">
                                <?php endif; ?>
                            <?php echo $tag_close; ?>
                            <?php
                        endwhile;
                        wp_reset_postdata();
                        ?>
                    </div>
                </div>
            </section>
            <?php
        endif;
    else :
        if (is_user_logged_in() && current_user_can('edit_posts')) :
            ?>
            <div style="padding: 40px; background: #fff9db; border: 1px dashed #f59f00; color: #f59f00; border-radius: 8px; max-width: 600px; margin: 20px auto; text-align: center;">
                Chưa có đối tác nào. Vui lòng thêm nội dung trong mục <b>"Đối Tác"</b> trong trang quản lý admin.
            </div>
            <?php
        endif;
    endif;
    return ob_get_clean();
}

// 6. Tự động khởi tạo dữ liệu mẫu khi kích hoạt hoặc tải trang lần đầu (Auto-Seeding)
add_action('init', 'lyly_partner_manager_auto_seed', 20);
function lyly_partner_manager_auto_seed() {
    if (!post_type_exists('lyly_partner')) {
        return;
    }

    if (get_transient('lyly_partners_seeded_v1')) {
        return;
    }

    // Kiểm tra xem đã có đối tác nào chưa
    $existing = get_posts([
        'post_type'   => 'lyly_partner',
        'post_status' => 'any',
        'numberposts' => 1,
        'fields'      => 'ids'
    ]);

    if (empty($existing)) {
        // Danh sách đối tác khách sạn mặc định
        $defaults = [
            [
                'title'      => 'Booking.com',
                'image'      => 'https://upload.wikimedia.org/wikipedia/commons/b/be/Booking.com_logo.svg',
                'menu_order' => 1
            ],
            [
                'title'      => 'Agoda',
                'image'      => 'https://upload.wikimedia.org/wikipedia/commons/c/ce/Agoda_logo.svg',
                'menu_order' => 2
            ],
            [
                'title'      => 'Traveloka',
                'image'      => 'https://upload.wikimedia.org/wikipedia/commons/0/0b/Traveloka_Logo.png',
                'menu_order' => 3
            ],
            [
                'title'      => 'TripAdvisor',
                'image'      => 'https://upload.wikimedia.org/wikipedia/commons/0/02/TripAdvisor_Logo.svg',
                'menu_order' => 4
            ],
            [
                'title'      => 'Klook',
                'image'      => 'https://upload.wikimedia.org/wikipedia/commons/1/1d/Klook_logo.svg',
                'menu_order' => 5
            ],
            [
                'title'      => 'Expedia',
                'image'      => 'https://upload.wikimedia.org/wikipedia/commons/7/77/Expedia_logo_2023.svg',
                'menu_order' => 6
            ]
        ];

        foreach ($defaults as $partner) {
            $post_id = wp_insert_post([
                'post_title'   => $partner['title'],
                'post_type'    => 'lyly_partner',
                'post_status'  => 'publish',
                'menu_order'   => $partner['menu_order']
            ]);

            if ($post_id && !is_wp_error($post_id)) {
                update_post_meta($post_id, '_lyly_partner_external_image_url', $partner['image']);
                update_post_meta($post_id, '_lyly_partner_link', '');
            }
        }
    }

    set_transient('lyly_partners_seeded_v1', true, DAY_IN_SECONDS);
}

// 7. Hook Kích hoạt và Hủy kích hoạt để làm sạch Rewrite Rules
register_activation_hook(__FILE__, 'lyly_partner_manager_activate');
function lyly_partner_manager_activate() {
    lyly_register_partner_cpt();
    delete_transient('lyly_partners_seeded_v1');
    flush_rewrite_rules();
}

register_deactivation_hook(__FILE__, 'lyly_partner_manager_deactivate');
function lyly_partner_manager_deactivate() {
    flush_rewrite_rules();
}
