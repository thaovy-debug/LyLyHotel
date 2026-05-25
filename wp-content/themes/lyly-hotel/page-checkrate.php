<?php
/**
 * Template Name: Check Rate
 * Description: Trang hiển thị kết quả tìm kiếm phòng theo phong cách Malibu.
 */

get_header();

// 1. Lấy thông tin từ URL
$checkin_str = isset($_GET['checkin']) ? $_GET['checkin'] : date('Y-m-d');
$checkout_str = isset($_GET['checkout']) ? $_GET['checkout'] : date('Y-m-d', strtotime('+1 days'));
$guests = isset($_GET['guests']) ? intval($_GET['guests']) : 2;
$branch_id = isset($_GET['branch']) ? intval($_GET['branch']) : 0;

// Lấy tên chi nhánh
$branch_name = 'CHI NHÁNH';
if ($branch_id > 0) {
    $branch = get_term($branch_id, 'lyly_branch');
    if ($branch && !is_wp_error($branch)) {
        $branch_name = $branch->name;
    }
}

// Parse ngày để hiển thị
$checkin_date = new DateTime($checkin_str);
$checkout_date = new DateTime($checkout_str);
$months_vi = ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"];
?>

<style>
    :root {
        --main-color-orange: #fbc25e;
        --bg-dark: #16192c;
    }

    .checkrate-header-bar {
        background-color: var(--main-color-orange);
        padding: 20px 0;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        z-index: 10;
    }

    .checkrate-header-bar:hover {
        filter: brightness(1.05);
    }

    .checkrate-header-bar .nav-checkrate-title {
        font-size: 1.2rem;
        font-weight: 700;
        color: #000;
    }

    .checkrate-header-bar .nav-checkrate-month {
        font-size: 1.2rem;
        font-weight: 500;
        color: #000;
    }

    .checkrate-header-bar .nav-checkrate-date {
        font-size: 2.5rem;
        font-weight: 300;
        color: #000;
        line-height: 1;
    }

    .checkrate-results-container {
        padding: 60px 0;
        background-color: #f8f9fa;
        min-height: 600px;
    }

    .room-card {
        background: #fff;
        margin-bottom: 30px;
        border: 1px solid #eee;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        overflow: hidden;
    }

    .room-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }

    .room-image-side {
        position: relative;
        min-height: 300px;
    }

    .room-info-side {
        padding: 30px;
        border-left: 1px solid #eee;
    }

    .room-action-side {
        padding: 30px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        background-color: #fcfcfc;
        border-left: 1px solid #eee;
    }

    .room-title {
        font-weight: 700;
        text-transform: uppercase;
        margin-bottom: 15px;
        color: #333;
    }

    .room-highlights {
        font-size: 0.95rem;
        color: #666;
        margin-bottom: 25px;
    }

    .amenity-icon-box {
        text-align: center;
        margin-bottom: 20px;
    }

    .amenity-icon-box i {
        font-size: 1.5rem;
        color: #888;
        display: block;
        margin-bottom: 5px;
    }

    .amenity-icon-box span {
        font-size: 0.75rem;
        text-transform: uppercase;
        color: #999;
    }

    .price-value {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--bg-dark);
    }

    .price-unit {
        font-size: 0.9rem;
        color: #888;
    }

    .btn-book-room {
        background-color: var(--main-color-orange);
        color: #000;
        border: none;
        padding: 12px 30px;
        font-weight: 700;
        text-transform: uppercase;
        border-radius: 4px;
        width: 100%;
        transition: 0.3s;
    }

    .btn-book-room:hover {
        background-color: #000;
        color: #fff;
    }
</style>

<div class="checkrate-header-bar" onclick="window.location.href='<?php echo home_url(); ?>'">
    <div class="container">
        <div class="row align-items-center text-center">
            <!-- Check In -->
            <div class="col-md-3">
                <div class="nav-checkrate-title">NHẬN PHÒNG</div>
                <div class="d-flex align-items-center justify-content-center gap-3">
                    <div class="nav-checkrate-date"><?php echo $checkin_date->format('d'); ?></div>
                    <div class="text-start">
                        <div class="nav-checkrate-month"><?php echo $months_vi[intval($checkin_date->format('m')) - 1]; ?></div>
                        <div class="nav-checkrate-month"><?php echo $checkin_date->format('Y'); ?></div>
                    </div>
                </div>
            </div>
            <!-- Check Out -->
            <div class="col-md-3">
                <div class="nav-checkrate-title">TRẢ PHÒNG</div>
                <div class="d-flex align-items-center justify-content-center gap-3">
                    <div class="nav-checkrate-date"><?php echo $checkout_date->format('d'); ?></div>
                    <div class="text-start">
                        <div class="nav-checkrate-month"><?php echo $months_vi[intval($checkout_date->format('m')) - 1]; ?></div>
                        <div class="nav-checkrate-month"><?php echo $checkout_date->format('Y'); ?></div>
                    </div>
                </div>
            </div>
            <!-- Branch -->
            <div class="col-md-3">
                <div class="nav-checkrate-title">KHÁCH SẠN</div>
                <div class="nav-checkrate-date" style="font-size: 1.5rem; font-weight: 700;"><?php echo $branch_name; ?></div>
            </div>
            <!-- Guests -->
            <div class="col-md-3 border-start border-dark">
                <div class="nav-checkrate-title">KHÁCH</div>
                <div class="nav-checkrate-date"><?php echo $guests; ?></div>
            </div>
        </div>
    </div>
</div>

<div class="checkrate-results-container">
    <div class="container">
        <?php
        $args = array(
            'post_type' => 'lyly_room',
            'posts_per_page' => -1,
        );

        if ($branch_id > 0) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'lyly_branch',
                    'field' => 'term_id',
                    'terms' => $branch_id,
                ),
            );
        }

        $query = new WP_Query($args);

        if ($query->have_posts()) : ?>
            <?php while ($query->have_posts()) : $query->the_post(); 
                $room_id = get_the_ID();
                $price_overnight = get_post_meta($room_id, '_lyly_price_overnight', true);
                $area = get_post_meta($room_id, '_lyly_area', true);
                $highlights = get_post_meta($room_id, '_lyly_highlights', true);
                $amenities = get_post_meta($room_id, '_lyly_amenities', true);
                $gallery = get_post_meta($room_id, '_lyly_room_gallery', true);
                $gallery_ids = $gallery ? explode(',', $gallery) : [];
                $thumbnail_id = get_post_thumbnail_id($room_id);
                if ($thumbnail_id) array_unshift($gallery_ids, $thumbnail_id);
                $gallery_ids = array_unique($gallery_ids);
            ?>
                <div class="room-card">
                    <div class="row g-0">
                        <!-- Carousel ảnh -->
                        <div class="col-lg-4">
                            <div class="room-image-side h-100">
                                <div class="swiper room-swiper h-100">
                                    <div class="swiper-wrapper">
                                        <?php if (!empty($gallery_ids)) : ?>
                                            <?php foreach ($gallery_ids as $img_id) : 
                                                $img_url = wp_get_attachment_image_src($img_id, 'large');
                                                if ($img_url) :
                                            ?>
                                                <div class="swiper-slide">
                                                    <img src="<?php echo $img_url[0]; ?>" class="w-100 h-100" style="object-fit: contain;">
                                                </div>
                                            <?php endif; endforeach; ?>
                                        <?php else: ?>
                                            <div class="swiper-slide">
                                                <img src="https://placehold.co/600x400?text=LyLy+Hotel" class="w-100 h-100" style="object-fit: contain;">
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="swiper-button-next" style="color: #fff;"></div>
                                    <div class="swiper-button-prev" style="color: #fff;"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Thông tin phòng -->
                        <div class="col-lg-5">
                            <div class="room-info-side">
                                <h2 class="room-title"><?php the_title(); ?></h2>
                                <div class="room-highlights">
                                    <p><?php echo $highlights ?: 'Phòng sang trọng với đầy đủ tiện nghi hiện đại.'; ?></p>
                                    <?php if ($area): ?>
                                        <span class="badge bg-secondary mb-3"><?php echo $area; ?> m2</span>
                                    <?php endif; ?>
                                </div>

                                <div class="row row-cols-3">
                                    <div class="col amenity-icon-box">
                                        <i class="bi bi-wind"></i>
                                        <span>Điều hòa</span>
                                    </div>
                                    <div class="col amenity-icon-box">
                                        <i class="bi bi-wifi"></i>
                                        <span>Wifi</span>
                                    </div>
                                    <div class="col amenity-icon-box">
                                        <i class="bi bi-tv"></i>
                                        <span>Tivi LCD</span>
                                    </div>
                                    <div class="col amenity-icon-box">
                                        <i class="bi bi-cup-hot"></i>
                                        <span>Mini Bar</span>
                                    </div>
                                    <div class="col amenity-icon-box">
                                        <i class="bi bi-droplet"></i>
                                        <span>Nước nóng</span>
                                    </div>
                                    <div class="col amenity-icon-box">
                                        <i class="bi bi-shield-check"></i>
                                        <span>Két sắt</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Giá và Nút đặt -->
                        <div class="col-lg-3">
                            <div class="room-action-side h-100">
                                <div class="text-center mb-3">
                                    <div class="price-unit">Giá từ</div>
                                    <div class="price-value"><?php echo number_format($price_overnight ?: 0); ?>đ</div>
                                    <div class="price-unit">/đêm</div>
                                </div>
                                <?php 
                                $zalo_no = function_exists('lyly_get_zalo_number') ? lyly_get_zalo_number() : '0941871644';
                                ?>
                                <a href="https://zalo.me/<?php echo esc_attr($zalo_no); ?>" target="_blank" class="btn btn-book-room">ĐẶT PHÒNG</a>
                                <a href="<?php the_permalink(); ?>" class="btn btn-link text-dark mt-2 text-decoration-none">Xem chi tiết <i class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; wp_reset_postdata(); ?>
        <?php else : ?>
            <div class="text-center py-5">
                <h3>Không tìm thấy phòng phù hợp.</h3>
                <p>Vui lòng thử lại với ngày khác hoặc liên hệ hotline: 0941 871 644</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Khởi tạo Swiper cho mỗi phòng
    const swipers = document.querySelectorAll('.room-swiper');
    swipers.forEach(el => {
        new Swiper(el, {
            loop: true,
            navigation: {
                nextEl: el.querySelector('.swiper-button-next'),
                prevEl: el.querySelector('.swiper-button-prev'),
            },
        });
    });
});
</script>

<?php get_footer(); ?>
