<?php
/**
 * Template Name: Single Room Page
 * Template Post Type: lyly_room
 */

get_header();

if (have_posts()) :
    while (have_posts()) : the_post();
        $post_id = get_the_ID();
        
        // Get Meta Data
        $room_id_code = get_post_meta($post_id, '_lyly_room_id', true);
        $num_beds = get_post_meta($post_id, '_lyly_num_beds', true);
        $max_guests = get_post_meta($post_id, '_lyly_max_guests', true);
        $area = get_post_meta($post_id, '_lyly_area', true);
        $price_hourly = get_post_meta($post_id, '_lyly_price_hourly', true);
        $price_overnight = get_post_meta($post_id, '_lyly_price_overnight', true);
        $highlights = get_post_meta($post_id, '_lyly_highlights', true);
        $selected_amenities = get_post_meta($post_id, '_lyly_amenities', true);
        if (!is_array($selected_amenities)) $selected_amenities = array();

        // Gallery
        $gallery_ids_str = get_post_meta($post_id, '_lyly_room_gallery', true);
        $gallery_ids = $gallery_ids_str ? array_filter(explode(',', $gallery_ids_str)) : array();
        $featured_id = get_post_thumbnail_id();
        if ($featured_id) {
            array_unshift($gallery_ids, $featured_id);
        }
        $gallery_ids = array_values(array_unique(array_filter($gallery_ids)));

        $amenities_groups = array(
            'Video và âm thanh' => array('truyền hình vệ tinh', 'TV màn hình phẳng'),
            'Internet và điện thoại' => array('Wi-Fi', 'điện thoại trong phòng'),
            'Phòng tắm' => array('nhà tắm riêng', 'dép', 'đồ vệ sinh', 'khăn tắm', 'máy nước nóng', 'toilet', 'áo tắm', 'bộ tiện nghi phòng tắm'),
            'Nội thất' => array('gương', 'ghế', 'bàn', 'giá treo quần áo', 'tủ'),
            'Thiết bị điện tử' => array('điều hòa', 'máy sấy tóc', 'đèn đọc sách', 'đèn ngủ'),
            'Khác' => array('két sắt', 'quầy bar mini', 'ấm nước', 'khu vực sinh hoạt', 'nước đóng chai', 'dịch vụ giặt là (tính phí)')
        );

        // Icon Mapping
        $icon_map = array(
            'quang cảnh thành phố' => 'bi-building',
            'giường King size' => 'bi-lamp',
            'nhà tắm riêng' => 'bi-droplet',
            'điều hòa' => 'bi-wind',
            'TV màn hình phẳng' => 'bi-tv'
        );
?>

<style>
    .room-detail-wrapper {
        background-color: #fff;
        padding: 40px 0 100px;
        font-family: 'Montserrat', sans-serif;
        color: #333;
    }

    .room-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .room-header h1 {
        font-size: 2.2rem;
        font-weight: 300;
        margin: 0;
    }

    .btn-close-room {
        font-size: 2rem;
        color: #999;
        text-decoration: none;
    }

    /* Gallery Layout */
    .room-gallery-grid {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr;
        grid-template-rows: repeat(2, 250px);
        gap: 10px;
        margin-bottom: 40px;
    }

    .gallery-item {
        position: relative;
        overflow: hidden;
        background-color: #f5f5f5;
    }

    .gallery-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: 0.5s;
    }

    .gallery-item:hover img {
        transform: scale(1.05);
    }

    .large-item {
        grid-column: 1 / 2;
        grid-row: 1 / 3;
    }

    .badge-bestseller {
        position: absolute;
        top: 15px;
        left: 15px;
        background: #a68b6d;
        color: #fff;
        padding: 5px 15px;
        font-size: 0.8rem;
        font-weight: bold;
        text-transform: uppercase;
        z-index: 2;
    }

    /* Room Summary */
    .room-summary-section {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 60px;
        margin-bottom: 50px;
    }

    .summary-left {
        font-size: 0.95rem;
        line-height: 1.8;
    }

    .summary-icon-row {
        display: flex;
        gap: 30px;
        margin-bottom: 20px;
        font-size: 0.9rem;
        font-weight: 600;
    }

    .summary-icon-row i {
        color: #a68b6d;
        font-size: 1.2rem;
        margin-right: 8px;
    }

    /* Quick Icons Bar */
    .quick-amenities-bar {
        display: flex;
        flex-wrap: wrap;
        border-top: 1px solid #eee;
        border-bottom: 1px solid #eee;
        padding: 20px 0;
        margin-bottom: 40px;
    }

    .quick-item {
        padding: 10px 25px;
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 0.9rem;
        font-weight: 500;
        color: #666;
        border-right: 1px solid #f0f0f0;
    }

    .quick-item i {
        font-size: 1.3rem;
        color: #888;
    }

    /* Smoking Preference */
    .preference-row {
        margin-bottom: 40px;
    }

    .pref-label {
        font-weight: 700;
        margin-bottom: 15px;
        display: block;
    }

    .pref-btns {
        display: flex;
        gap: 10px;
    }

    .pref-btn {
        padding: 12px 30px;
        border: 1px solid #ddd;
        background: #fff;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 10px;
        color: #555;
    }

    .pref-btn.active {
        border-color: #a68b6d;
        color: #a68b6d;
    }

    /* Detailed Amenities Grid */
    .amenities-detail-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 40px;
    }

    .amenity-cat h4 {
        font-size: 1rem;
        font-weight: 700;
        margin-bottom: 20px;
        text-transform: capitalize;
    }

    .amenity-cat ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .amenity-cat li {
        margin-bottom: 12px;
        font-size: 0.9rem;
        color: #666;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .amenity-cat li::before {
        content: "";
        width: 18px;
        height: 18px;
        background: url('https://www.svgrepo.com/show/355152/monitor.svg') no-repeat center;
        background-size: contain;
        opacity: 0.5;
    }

    /* Sticky Bottom Bar */
    .room-price-sticky {
        position: fixed;
        bottom: 75px;
        left: 0;
        width: 100%;
        background: #fff;
        box-shadow: 0 -5px 15px rgba(0,0,0,0.05);
        padding: 15px 0;
        z-index: 1000;
        border-top: 1px solid #eee;
    }

    .sticky-content {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 40px;
    }

    .price-info {
        text-align: right;
    }

    .price-promo {
        color: #a68b6d;
        font-size: 0.9rem;
        text-decoration: underline;
        font-weight: 600;
        cursor: pointer;
    }

    .price-main {
        font-size: 1.5rem;
        font-weight: 700;
        margin: 5px 0;
    }

    .price-sub {
        font-size: 0.8rem;
        color: #888;
    }

    .btn-select-room {
        background: #a68b6d;
        color: #fff;
        border: none;
        padding: 12px 50px;
        font-weight: 700;
        text-transform: uppercase;
        border-radius: 4px;
        transition: 0.3s;
    }

    .btn-select-room:hover {
        background: #000;
    }

    @media (max-width: 992px) {
        .room-gallery-grid { grid-template-columns: 1fr; grid-template-rows: auto; }
        .large-item { grid-row: auto; }
        .room-summary-section, .amenities-detail-grid { grid-template-columns: 1fr; }
        .sticky-content { justify-content: space-between; gap: 10px; }
    }
</style>

<div class="room-detail-wrapper">
    <div class="container" style="max-width: 1200px;">
        
        <!-- Header -->
        <div class="room-header">
            <h1><?php the_title(); ?></h1>
            <a href="javascript:history.back()" class="btn-close-room">&times;</a>
        </div>

        <!-- Gallery Slider -->
        <div class="room-gallery-slider-container mb-5">
            <div class="swiper room-detail-swiper">
                <div class="swiper-wrapper">
                    <?php foreach ($gallery_ids as $index => $img_id) : 
                        $img_url_full = wp_get_attachment_image_url($img_id, 'full');
                        $img_url_large = wp_get_attachment_image_url($img_id, 'large');
                        if (!$img_url_large) continue;
                    ?>
                        <div class="swiper-slide gallery-slide" onclick="openLightbox('<?php echo esc_url($img_url_full); ?>')">
                            <?php if ($index === 0) : ?><span class="badge-bestseller">Bestseller</span><?php endif; ?>
                            <img src="<?php echo esc_url($img_url_large); ?>" alt="Room Image">
                            <div class="zoom-icon"><i class="bi bi-zoom-in"></i></div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <!-- Navigation -->
                <div class="swiper-button-next room-swiper-btn"></div>
                <div class="swiper-button-prev room-swiper-btn"></div>
                <!-- Pagination -->
                <div class="swiper-pagination"></div>
            </div>
        </div>

        <!-- Lightbox Modal -->
        <div id="roomLightbox" class="room-lightbox" onclick="closeLightbox()">
            <span class="close-lightbox">&times;</span>
            <img id="lightboxImg" src="" alt="Full size image">
        </div>

        <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof Swiper !== 'undefined') {
                const roomSwiper = new Swiper('.room-detail-swiper', {
                    loop: false,
                    speed: 600,
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true
                    },
                    on: {
                        init: function() {
                            updateNavButtons(this);
                        },
                        slideChange: function() {
                            updateNavButtons(this);
                        }
                    }
                });

                function updateNavButtons(swiper) {
                    const prevBtn = document.querySelector('.swiper-button-prev');
                    const nextBtn = document.querySelector('.swiper-button-next');
                    
                    if (swiper.isBeginning) {
                        prevBtn.style.display = 'none';
                    } else {
                        prevBtn.style.display = 'flex';
                    }
                    
                    if (swiper.isEnd) {
                        nextBtn.style.display = 'none';
                    } else {
                        nextBtn.style.display = 'flex';
                    }
                }
            }
        });

        function openLightbox(url) {
            const lb = document.getElementById('roomLightbox');
            const img = document.getElementById('lightboxImg');
            img.src = url;
            lb.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }

        function closeLightbox() {
            const lb = document.getElementById('roomLightbox');
            lb.style.display = 'none';
            document.body.style.overflow = 'auto';
        }
        </script>

        <style>
            .room-gallery-slider-container {
                position: relative;
                width: 100%;
                max-width: 1000px;
                margin: 0 auto;
            }

            .room-detail-swiper {
                height: 550px;
                background: #f8f8f8;
            }

            .gallery-slide {
                cursor: pointer;
                position: relative;
            }

            .gallery-slide img {
                width: 100%;
                height: 100%;
                object-fit: contain;
                background: #f0f0f0; /* Light gray background for letterboxing */
            }

            .zoom-icon {
                position: absolute;
                bottom: 20px;
                right: 20px;
                background: rgba(0,0,0,0.5);
                color: #fff;
                width: 40px;
                height: 40px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                opacity: 0;
                transition: 0.3s;
            }

            .gallery-slide:hover .zoom-icon {
                opacity: 1;
            }

            .room-swiper-btn {
                width: 50px !important;
                height: 50px !important;
                background: rgba(255, 255, 255, 0.9);
                border-radius: 50%;
                color: #a68b6d !important;
                box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            }

            .room-swiper-btn::after {
                font-size: 1.2rem !important;
                font-weight: bold;
            }

            /* Lightbox */
            .room-lightbox {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0,0,0,0.95);
                z-index: 99999;
                align-items: center;
                justify-content: center;
                padding: 40px;
            }

            .room-lightbox img {
                max-width: 100%;
                max-height: 100%;
                object-fit: contain;
                box-shadow: 0 0 30px rgba(0,0,0,0.5);
            }

            .close-lightbox {
                position: absolute;
                top: 20px;
                right: 30px;
                color: #fff;
                font-size: 3rem;
                cursor: pointer;
                z-index: 100000;
            }
        </style>

        <!-- Summary -->
        <div class="room-summary-section">
            <div class="summary-left">
                <div class="summary-icon-row">
                    <span><i class="bi bi-people"></i> Sức chứa <?php echo esc_html($max_guests); ?> khách.</span>
                </div>
                <div class="summary-icon-row">
                    <span><i class="bi bi-arrows-fullscreen"></i> <?php echo esc_html($area); ?> m²</span>
                </div>
                <div class="description-text mt-4">
                    <p><?php echo esc_html($highlights); ?></p>
                </div>
            </div>
            <div class="summary-right">
                <p>Với diện tích <?php echo esc_html($area); ?> m², giường King size êm ái và tầm nhìn bao quát thành phố, phòng <?php the_title(); ?> là lựa chọn hoàn hảo cho những chuyến nghỉ dưỡng lãng mạn tại trung tâm thành phố Vũng Tàu.</p>
            </div>
        </div>

        <!-- Quick Amenities -->
        <div class="quick-amenities-bar">
            <?php 
            $quick_keys = array('quang cảnh thành phố', 'giường King size', 'nhà tắm riêng', 'điều hòa', 'TV màn hình phẳng');
            foreach ($quick_keys as $key) :
                if (in_array($key, $selected_amenities)) :
                    $label = str_replace(array('quang cảnh ', 'giường '), '', $key);
                    $icon = isset($icon_map[$key]) ? $icon_map[$key] : 'bi-check2';
            ?>
                <div class="quick-item">
                    <i class="bi <?php echo $icon; ?>"></i> <?php echo esc_html(ucfirst($label)); ?>
                </div>
            <?php endif; endforeach; ?>
        </div>

        <!-- Preferences -->
        <div class="preference-row">
            <span class="pref-label">Hút thuốc trong phòng</span>
            <div class="pref-btns">
                <button class="pref-btn"><i class="bi bi-dash-circle"></i> phòng hút thuốc</button>
                <button class="pref-btn active"><i class="bi bi-slash-circle"></i> phòng không hút thuốc</button>
            </div>
            <p class="text-muted mt-2" style="font-size: 0.8rem;">Chúng tôi không thể đảm bảo tất cả các yêu cầu đặc biệt sẽ được đáp ứng.</p>
        </div>

        <!-- Detailed Amenities -->
        <div class="amenities-detail-grid">
            <?php foreach ($amenities_groups as $group_name => $items) : 
                $group_items = array_intersect($items, $selected_amenities);
                if (empty($group_items)) continue;
            ?>
                <div class="amenity-cat">
                    <h4><?php echo esc_html($group_name); ?></h4>
                    <ul>
                        <?php foreach ($group_items as $item) : ?>
                            <li><?php echo esc_html(ucfirst($item)); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</div>

<!-- Sticky Bottom Bar -->
<div class="room-price-sticky">
    <div class="container" style="max-width: 1200px;">
        <div class="sticky-content">
            <div class="price-info">
                <div class="price-promo"><i class="bi bi-award"></i> Đăng ký và thanh toán đ<?php echo number_format((int)$price_overnight * 0.9); ?></div>
                <div class="price-main">Giá từ đ<?php echo number_format((int)$price_overnight); ?></div>
                <div class="price-sub">1 đêm / 2 khách</div>
            </div>
            <?php 
            $zalo_no = function_exists('lyly_get_zalo_number') ? lyly_get_zalo_number() : '0941871644';
            ?>
            <button class="btn-select-room" onclick="window.open('https://zalo.me/<?php echo esc_js($zalo_no); ?>', '_blank')">ĐẶT PHÒNG</button>
        </div>
    </div>
</div>

<?php
    endwhile;
endif;

get_footer();
?>
