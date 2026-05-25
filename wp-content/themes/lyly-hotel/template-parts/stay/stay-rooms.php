<style>
    :root {
        --malibu-orange: #FFCC66;
        --dark-blue: #002d58;
    }

    .room-grid-section {
        padding: 60px 0;
        background-color: #fff;
        font-family: 'Mulish', sans-serif;
    }

    /* ĐÃ CHỈNH LỀ VỪA VẶN: 88% là mức cân bằng nhất */
    .custom-container {
        width: 88% !important;
        max-width: 1300px !important;
        /* Khóa độ rộng để không bị quá to trên màn hình lớn */
        margin: 0 auto !important;
        padding: 0 10px !important;
    }

    .custom-container .row {
        margin-left: 0 !important;
        margin-right: 0 !important;
        --bs-gutter-x: 2rem;
        /* Khoảng cách giữa thẻ phòng trái và phải */
    }

    .room-card {
        margin-bottom: 50px;
    }

    .room-carousel {
        position: relative;
        overflow: hidden;
        margin-bottom: 20px;
        aspect-ratio: 16 / 9;
        background-color: #f8f8f8;
    }

    .room-carousel img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .room-card h2 {
        font-size: 1.4rem;
        font-weight: 700;
        margin-bottom: 8px;
        color: var(--dark-blue);
        text-transform: uppercase;
    }

    .room-card .lead {
        font-size: 0.9rem;
        color: #555;
        margin-bottom: 15px;
        min-height: 1.2rem;
    }

    .facility-row {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        margin-bottom: 25px;
        align-items: center;
    }

    .facility-item {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .facility-item img {
        height: 18px;
        width: auto;
    }

    .facility-item p {
        margin: 0;
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        color: #666;
    }

    .button-fill,
    .button-outline {
        padding: 12px 25px;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.8rem;
        border-radius: 0 !important;
        text-decoration: none !important;
        display: inline-block;
        transition: 0.3s;
    }

    .button-fill {
        background-color: var(--malibu-orange);
        color: white !important;
        border: none;
    }
    .button-fill:hover {
        background-color: #888;
        color: white !important;
    }

    .button-outline {
        border: 1px solid var(--malibu-orange);
        color: var(--malibu-orange) !important;
        background: transparent;
    }
    .button-outline:hover {
        background-color: var(--malibu-orange);
        color: #666 !important;
    }

    /* Carousel controls */
    .room-carousel .carousel-control-prev,
    .room-carousel .carousel-control-next {
        width: 10%;
        opacity: 0;
        transition: opacity 0.3s;
    }
    .room-carousel:hover .carousel-control-prev,
    .room-carousel:hover .carousel-control-next {
        opacity: 1;
    }
    .room-carousel .carousel-control-prev i,
    .room-carousel .carousel-control-next i {
        font-size: 1.5rem;
        color: #fff;
        text-shadow: 0 1px 3px rgba(0,0,0,0.5);
    }
</style>

<section class="room-grid-section">
    <div class="custom-container">
        <div class="row">

            <?php
            // 1. Lấy tham số lọc từ URL
            $branch_id = isset($_GET['branch']) ? (int)$_GET['branch'] : 0;
            $checkin = isset($_GET['checkin']) ? sanitize_text_field($_GET['checkin']) : '';
            $checkout = isset($_GET['checkout']) ? sanitize_text_field($_GET['checkout']) : '';
            $guests = isset($_GET['guests']) ? (int)$_GET['guests'] : 1;
            $children = isset($_GET['children']) ? (int)$_GET['children'] : 0;

            // 2. Thiết lập Query
            $args = array(
                'post_type' => 'lyly_room',
                'posts_per_page' => -1,
                'status' => 'publish'
            );

            $tax_queries = array('relation' => 'AND');

            // 3. Lọc theo Chi nhánh (Quan trọng)
            if ($branch_id > 0) {
                $tax_queries[] = array(
                    'taxonomy' => 'lyly_branch',
                    'field'    => 'term_id',
                    'terms'    => $branch_id,
                );
            }

            if (count($tax_queries) > 1) {
                $args['tax_query'] = $tax_queries;
            }

            $query = new WP_Query($args);

            // 4. Lấy tên chi nhánh làm tiêu đề
            $display_title = 'TẤT CẢ PHÒNG';
            if ($branch_id > 0) {
                $current_branch = get_term($branch_id, 'lyly_branch');
                if ($current_branch && !is_wp_error($current_branch)) {
                    $display_title = 'PHÒNG - ' . $current_branch->name;
                }
            }
            ?>

            <div class="col-12 mb-5 text-center">
                <h1 class="display-5 fw-bold text-uppercase" style="color: var(--dark-blue); letter-spacing: 2px;">
                    <?php echo esc_html($display_title); ?>
                </h1>
                <div style="width: 60px; height: 3px; background: var(--malibu-orange); margin: 20px auto;"></div>
            </div>

            <?php
            if ($query->have_posts()) : 
                // Hiển thị thông tin lọc nếu có
                if ($checkin || $branch_id) {
                    $branch_obj = $branch_id ? get_term($branch_id, 'lyly_branch') : null;
                    echo '<div class="col-12 mb-4"><div class="alert alert-light border-0 shadow-sm p-3">';
                    echo '<strong>Đang hiển thị phòng tại:</strong> ' . ($branch_obj ? $branch_obj->name : 'Tất cả chi nhánh');
                    if ($checkin) echo ' | <strong>Thời gian:</strong> ' . $checkin . ' - ' . $checkout;
                    if ($guests) echo ' | <strong>Khách:</strong> ' . $guests . ' người lớn, ' . $children . ' trẻ em';
                    echo '</div></div>';
                }

                $room_idx = 0;
                while ($query->have_posts()) : $query->the_post();

                    $room_idx++;
                    $post_id = get_the_ID();
                    
                    // Lấy Meta
                    $room_code = get_post_meta($post_id, '_lyly_room_id', true);
                    $num_beds = get_post_meta($post_id, '_lyly_num_beds', true);
                    $max_guests = get_post_meta($post_id, '_lyly_max_guests', true);
                    $area = get_post_meta($post_id, '_lyly_area', true);
                    $highlights = get_post_meta($post_id, '_lyly_highlights', true);
                    $gallery_ids_str = get_post_meta($post_id, '_lyly_room_gallery', true);
                    $gallery_ids = $gallery_ids_str ? explode(',', $gallery_ids_str) : array();
                    
                    // Ảnh đại diện
                    $thumb_id = get_post_thumbnail_id();
                    if ($thumb_id) {
                        array_unshift($gallery_ids, $thumb_id);
                        $gallery_ids = array_unique($gallery_ids);
                    }
            ?>
                <div class="col-lg-6 room-card">
                    <div class="room-carousel">
                        <?php if (!empty($gallery_ids)) : ?>
                            <div id="roomCarousel-<?php echo $post_id; ?>" class="carousel slide carousel-fade" data-bs-ride="carousel">
                                <div class="carousel-inner h-100">
                                    <?php foreach ($gallery_ids as $index => $img_id) : 
                                        $img_url = wp_get_attachment_image_url($img_id, 'large');
                                        if (!$img_url) continue;
                                    ?>
                                        <div class="carousel-item h-100 <?php echo $index === 0 ? 'active' : ''; ?>">
                                            <img src="<?php echo esc_url($img_url); ?>" class="d-block w-100 h-100" alt="<?php the_title(); ?>">
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <?php if (count($gallery_ids) > 1) : ?>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#roomCarousel-<?php echo $post_id; ?>" data-bs-slide="prev">
                                        <i class="bi bi-arrow-left"></i>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#roomCarousel-<?php echo $post_id; ?>" data-bs-slide="next">
                                        <i class="bi bi-arrow-right"></i>
                                    </button>
                                <?php endif; ?>
                            </div>
                        <?php else: ?>
                            <img src="https://placehold.co/800x450?text=No+Image" alt="No Image">
                        <?php endif; ?>
                    </div>

                    <h2><?php the_title(); ?> (<?php echo esc_html($room_code); ?>)</h2>
                    <p class="lead"><?php echo esc_html($highlights); ?></p>
                    
                    <div class="facility-row">
                        <div class="facility-item">
                            <img src="https://www.alohilaniresort.com/wp-content/uploads/2022/09/ALO_Rooms-Suites_Bed-icon.svg">
                            <p><?php echo esc_html($num_beds); ?> GIƯỜNG</p>
                        </div>
                        <div class="facility-item">
                            <img src="https://www.alohilaniresort.com/wp-content/uploads/2022/09/ALO_Rooms-Suites_Beach-Candy-icon.svg">
                            <p>MAX <?php echo esc_html($max_guests); ?> KHÁCH</p>
                        </div>
                        <div class="facility-item">
                            <img src="https://www.alohilaniresort.com/wp-content/uploads/2022/09/ALO_Rooms-Suites_SqFt-icon.svg">
                            <p><?php echo esc_html($area); ?> M2</p>
                        </div>
                    </div>

                    <div class="room-actions">
                        <a href="<?php echo site_url('/checkrate'); ?>?room=<?php echo $post_id; ?>" class="button-fill">KIỂM TRA GIÁ</a>
                        <a href="<?php the_permalink(); ?>" class="button-outline">XEM CHI TIẾT</a>
                    </div>
                </div>
            <?php 
                endwhile; 
                wp_reset_postdata();
            else : ?>
                <div class="col-12 text-center py-5">
                    <p class="lead">Hiện chưa có phòng nào trong danh mục này.</p>
                </div>
            <?php endif; ?>

        </div>
    </div>
</section>