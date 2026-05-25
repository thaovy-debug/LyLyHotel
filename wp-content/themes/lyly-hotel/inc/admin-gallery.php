<?php
// Register the admin menu page
function lyly_gallery_admin_menu() {
    add_menu_page(
        'Quản lý Thư viện ảnh',
        'Thư viện ảnh',
        'manage_options',
        'lyly-gallery',
        'lyly_gallery_admin_page',
        'dashicons-format-gallery',
        30
    );
}
add_action('admin_menu', 'lyly_gallery_admin_menu');

// Enqueue media uploader script
function lyly_gallery_admin_scripts($hook) {
    if ($hook != 'toplevel_page_lyly-gallery') {
        return;
    }
    wp_enqueue_media();
}
add_action('admin_enqueue_scripts', 'lyly_gallery_admin_scripts');

// Render the admin page
function lyly_gallery_admin_page() {
    // Save data if submitted
    if (isset($_POST['lyly_save_gallery']) && check_admin_referer('lyly_gallery_nonce', 'lyly_gallery_nonce_field')) {
        $custom_images = sanitize_text_field($_POST['lyly_custom_gallery_images']);
        update_option('lyly_gallery_custom_images', $custom_images);
        echo '<div class="notice notice-success is-dismissible"><p>Đã lưu thay đổi thư viện ảnh.</p></div>';
    }

    $saved_images = get_option('lyly_gallery_custom_images', '');
    $saved_images_arr = array_filter(explode(',', $saved_images));
    ?>
    <div class="wrap">
        <h1>Quản lý Thư viện ảnh Khách sạn</h1>
        <p>Tại đây bạn có thể tải lên các ảnh chung của khách sạn. Ảnh của các phòng sẽ tự động được lấy và hiển thị trong Thư viện bên ngoài trang web.</p>
        
        <form method="post" action="">
            <?php wp_nonce_field('lyly_gallery_nonce', 'lyly_gallery_nonce_field'); ?>
            
            <h2>1. Ảnh tải lên thêm (Ảnh chung, sự kiện, v.v.)</h2>
            <div style="margin-bottom: 20px;">
                <input type="hidden" name="lyly_custom_gallery_images" id="lyly_custom_gallery_images" value="<?php echo esc_attr($saved_images); ?>">
                <button type="button" class="button button-primary" id="lyly_upload_gallery_btn">Thêm ảnh vào Thư viện</button>
            </div>
            
            <div id="lyly_gallery_preview" style="display: flex; flex-wrap: wrap; gap: 15px; margin-bottom: 30px;">
                <?php
                if (!empty($saved_images_arr)) {
                    foreach ($saved_images_arr as $img_id) {
                        $img_url = wp_get_attachment_image_url($img_id, 'medium');
                        if ($img_url) {
                            echo '<div class="gallery-item-preview" data-id="'.esc_attr($img_id).'" style="position:relative; width: 150px; height: 150px; border: 1px solid #ccc;">';
                            echo '<img src="'.esc_url($img_url).'" style="width:100%; height:100%; object-fit:cover;">';
                            echo '<button type="button" class="button remove-gallery-img" style="position:absolute; top:5px; right:5px; background:red; color:white; border:none; border-radius:50%; cursor:pointer;">X</button>';
                            echo '</div>';
                        }
                    }
                }
                ?>
            </div>
            
            <?php submit_button('Lưu Thư Viện Ảnh', 'primary', 'lyly_save_gallery'); ?>
        </form>

        <hr>

        <h2>2. Ảnh động lấy từ danh sách Phòng (Sẽ tự động hiển thị ở frontend)</h2>
        <div style="display: flex; flex-wrap: wrap; gap: 10px; margin-top: 20px;">
            <?php
            // Fetch room images for preview in admin
            $args = array('post_type' => 'lyly_room', 'posts_per_page' => -1, 'status' => 'publish');
            $room_query = new WP_Query($args);
            $room_imgs = [];
            
            if ($room_query->have_posts()) {
                while ($room_query->have_posts()) {
                    $room_query->the_post();
                    $pid = get_the_ID();
                    
                    $thumb_id = get_post_thumbnail_id();
                    if ($thumb_id) $room_imgs[] = $thumb_id;
                    
                    $gallery = get_post_meta($pid, '_lyly_room_gallery', true);
                    if ($gallery) {
                        $arr = explode(',', $gallery);
                        foreach ($arr as $a) if ($a) $room_imgs[] = $a;
                    }
                }
                wp_reset_postdata();
            }
            
            $room_imgs = array_unique($room_imgs);
            $preview_count = 0;
            foreach ($room_imgs as $img_id) {
                if ($preview_count >= 15) {
                    echo '<div style="width:150px; height:150px; display:flex; align-items:center; justify-content:center; background:#eee;">+ '.(count($room_imgs) - 15).' ảnh nữa</div>';
                    break;
                }
                $img_url = wp_get_attachment_image_url($img_id, 'thumbnail');
                if ($img_url) {
                    echo '<img src="'.esc_url($img_url).'" style="width:150px; height:150px; object-fit:cover; border:1px solid #ccc; opacity:0.8;">';
                    $preview_count++;
                }
            }
            ?>
        </div>
    </div>

    <script>
    jQuery(document).ready(function($){
        var mediaUploader;
        $('#lyly_upload_gallery_btn').click(function(e) {
            e.preventDefault();
            
            if (mediaUploader) {
                mediaUploader.open();
                return;
            }
            
            mediaUploader = wp.media.frames.file_frame = wp.media({
                title: 'Chọn ảnh cho Thư viện',
                button: { text: 'Thêm ảnh' },
                multiple: true
            });
            
            mediaUploader.on('select', function() {
                var selection = mediaUploader.state().get('selection');
                var currentIds = $('#lyly_custom_gallery_images').val();
                var idsArr = currentIds ? currentIds.split(',') : [];
                
                selection.map(function(attachment) {
                    attachment = attachment.toJSON();
                    if (!idsArr.includes(attachment.id.toString())) {
                        idsArr.push(attachment.id);
                        // Add preview
                        var previewHtml = '<div class="gallery-item-preview" data-id="'+attachment.id+'" style="position:relative; width: 150px; height: 150px; border: 1px solid #ccc;">' +
                            '<img src="'+(attachment.sizes && attachment.sizes.medium ? attachment.sizes.medium.url : attachment.url)+'" style="width:100%; height:100%; object-fit:cover;">' +
                            '<button type="button" class="button remove-gallery-img" style="position:absolute; top:5px; right:5px; background:red; color:white; border:none; border-radius:50%; cursor:pointer;">X</button>' +
                            '</div>';
                        $('#lyly_gallery_preview').append(previewHtml);
                    }
                });
                
                $('#lyly_custom_gallery_images').val(idsArr.join(','));
            });
            
            mediaUploader.open();
        });
        
        // Remove image
        $(document).on('click', '.remove-gallery-img', function(e) {
            e.preventDefault();
            var $item = $(this).closest('.gallery-item-preview');
            var idToRemove = $item.data('id').toString();
            
            var currentIds = $('#lyly_custom_gallery_images').val();
            var idsArr = currentIds ? currentIds.split(',') : [];
            
            var index = idsArr.indexOf(idToRemove);
            if (index > -1) {
                idsArr.splice(index, 1);
            }
            
            $('#lyly_custom_gallery_images').val(idsArr.join(','));
            $item.remove();
        });
    });
    </script>
    <?php
}
