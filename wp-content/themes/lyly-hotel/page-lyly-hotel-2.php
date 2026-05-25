<?php
/**
 * Template Name: Ly Ly Hotel 2 (Chi Nhánh 2)
 */
get_header();
?>
<style>
    .branch-detail-container {
        padding-top: 150px;
        padding-bottom: 80px;
        background-color: #fff;
        min-height: 60vh;
        font-family: 'Montserrat', sans-serif;
    }

    .branch-header {
        text-align: center;
        margin-bottom: 60px;
    }

    .branch-header h1 {
        font-weight: 500;
        font-size: 3.5rem;
        letter-spacing: 2px;
        color: #333;
        margin-bottom: 15px;
        text-transform: uppercase;
    }

    .branch-header p {
        font-size: 1.1rem;
        color: #333;
        font-weight: 400;
    }

    .branch-gallery {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
        margin-bottom: 40px;
    }

    .gallery-item {
        position: relative;
        aspect-ratio: 4 / 3;
        overflow: hidden;
        background: #f5f5f5;
    }

    .gallery-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .gallery-item:hover img {
        transform: scale(1.05);
    }

    @media (max-width: 992px) {
        .branch-gallery {
            grid-template-columns: repeat(2, 1fr);
        }
        .branch-header h1 {
            font-size: 2.5rem;
        }
    }

    @media (max-width: 768px) {
        .branch-gallery {
            grid-template-columns: 1fr;
        }
        .branch-detail-container {
            padding-top: 120px;
        }
    }
</style>

<div class="branch-detail-container">
    <div class="container px-lg-5" style="max-width: 1400px;">
        <div class="branch-header">
            <h1>LY LY HOTEL 2 - AN LẠC</h1>
            <p>344A Đường Số 1, Phường An Lạc, TP. Hồ Chí Minh</p>
        </div>

        <div class="branch-gallery">
            <!-- Main exterior image -->
            <div class="gallery-item">
                <img src="https://res.cloudinary.com/ddtv5nc3t/image/upload/v1779164815/gr5_ypj5re.jpg" alt="Ly Ly Hotel 2 An Lạc">
            </div>
            
            <?php
            // Lấy thêm các ảnh phòng thuộc chi nhánh này để làm gallery
            // Lấy các bài post sau 5 bài đầu (để không bị trùng ảnh với chi nhánh 1 quá nhiều)
            $args = array(
                'post_type' => 'lyly_room',
                'posts_per_page' => 5,
                'offset' => 5,
                'status' => 'publish'
            );
            $query = new WP_Query($args);
            $images_shown = 1;

            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post();
                    $thumb_id = get_post_thumbnail_id();
                    if ($thumb_id) {
                        $img_url = wp_get_attachment_image_url($thumb_id, 'large');
                        if ($img_url) {
                            echo '<div class="gallery-item"><img src="' . esc_url($img_url) . '" alt="' . get_the_title() . '"></div>';
                            $images_shown++;
                        }
                    }
                }
                wp_reset_postdata();
            }

            // Fallback nếu không có đủ 5 phòng (phòng khi test database ít bài)
            if ($images_shown < 6) {
                $args_fallback = array(
                    'post_type' => 'lyly_room',
                    'posts_per_page' => 6 - $images_shown,
                    'status' => 'publish'
                );
                $query_fb = new WP_Query($args_fallback);
                if ($query_fb->have_posts()) {
                    while ($query_fb->have_posts()) {
                        $query_fb->the_post();
                        $thumb_id = get_post_thumbnail_id();
                        if ($thumb_id) {
                            $img_url = wp_get_attachment_image_url($thumb_id, 'large');
                            if ($img_url) {
                                echo '<div class="gallery-item"><img src="' . esc_url($img_url) . '" alt="' . get_the_title() . '"></div>';
                                $images_shown++;
                            }
                        }
                    }
                    wp_reset_postdata();
                }
            }

            // Nếu thiếu ảnh, điền thêm bằng ảnh tĩnh
            while ($images_shown < 6) {
                echo '<div class="gallery-item"><img src="https://placehold.co/800x600?text=LyLy+Hotel+Gallery" alt="Gallery Placeholder"></div>';
                $images_shown++;
            }
            ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>
