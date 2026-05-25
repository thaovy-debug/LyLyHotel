<?php
/**
 * Template Name: Gallery Page
 */

get_header(); ?>

<style>
    /* CSS for Gallery */
    .gallery {
        -webkit-column-count: 3;
        -moz-column-count: 3;
        column-count: 3;
        -webkit-column-gap: 1rem;
        -moz-column-gap: 1rem;
        column-gap: 1rem;
    }
    .gallery .pics {
        position: relative;
        -webkit-transition: all 350ms ease;
        transition: all 350ms ease;
        margin-bottom: 1rem;
        break-inside: avoid;
        overflow: hidden;
        border-radius: 4px;
    }
    .gallery .animation {
        -webkit-transform: scale(1);
        -ms-transform: scale(1);
        transform: scale(1); 
    }
    .gallery .pics img, .gallery .pics > .position-relative > div {
        width: 100%;
        min-height: 100px;
        -webkit-transition: all .4s ease;
        -moz-transition: all .4s ease;
        -ms-transition: all .4s ease;
        transition: all .4s ease;
    }
    .gallery .pics:hover > .position-relative > div {
        transform: scale(1.1);
    }
    .gallery .pics .img_description {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 8px;
        background: rgba(251, 194, 94, 0.6); /* LyLy Hotel Gold Overlay */
        color: #fff;
        visibility: hidden;
        opacity: 0;
        transition: opacity .4s, visibility .4s;
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 2;
    }
    .gallery .pics:hover .img_description {
        visibility: visible;
        opacity: 1;
        cursor: pointer;
    }
    .gallery .pics:hover .img_description i {
        font-size: 3rem;
        color: #000;
    }

    @media (max-width: 992px) {
        .gallery {
            -webkit-column-count: 2;
            -moz-column-count: 2;
            column-count: 2;
        }
    }

    @media (max-width: 576px) {
        .gallery {
            -webkit-column-count: 1;
            -moz-column-count: 1;
            column-count: 1;
            -webkit-column-width: 100%;
            -moz-column-width: 100%;
            column-width: 100%;
        }
    }

    .gallery-filter .btn.filter {
        border-color: #6c757d;
        color: #6c757d;
        border-radius: 0;
        padding: 0.5rem 1.5rem;
        margin-bottom: 10px;
        transition: all 0.3s ease;
        text-transform: uppercase;
        font-weight: 500;
        letter-spacing: 1px;
    }
    .gallery-filter .btn.filter:hover, .gallery-filter .btn.filter.active {
        background-color: #fbc25e; /* Theme gold color */
        border-color: #fbc25e;
        color: #000;
    }
    
    /* Hide items based on filter */
    .gallery .pics.hide {
        display: none;
    }
    
    .page-title {
        font-family: var(--main-font-family, 'Montserrat', sans-serif);
        font-weight: 500;
        color: #282828;
        letter-spacing: 2px;
    }
</style>

<div class="delimiter-bottom" style="padding-top: 100px;"></div>

<div class="pt-5 pb-5">
    <div class="container">
        <h1 class="text-center pt-5 pb-4 display-4 text-uppercase page-title">Thư viện ảnh</h1>
        
        <div class="d-flex justify-content-center flex-wrap py-4 gallery-filter">
            <button type="button" class="btn btn-outline-primary filter active mx-2" data-rel="all">Tất cả</button>
            <button type="button" class="btn btn-outline-primary filter mx-2" data-rel="room">Phòng nghỉ</button>
            <button type="button" class="btn btn-outline-primary filter mx-2" data-rel="general">Không gian chung</button>
        </div>

        <div class="gallery mt-4" id="gallery">
            <?php
            $heights = ['30vh', '40vh', '25vh', '35vh', '45vh', '28vh', '38vh'];
            $height_idx = 0;

            // 1. Fetch Room Images
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

            foreach ($room_imgs as $img_id) {
                $img_url = wp_get_attachment_image_url($img_id, 'large');
                if ($img_url) {
                    $h = $heights[$height_idx % count($heights)];
                    $height_idx++;
                    ?>
                    <div class="pics animation all room">
                        <div class="position-relative">
                            <div style="background-image: url('<?php echo esc_url($img_url); ?>'); width: 100%; height: <?php echo $h; ?>; background-size: cover; background-position: center;"></div>
                        </div>
                        <div class="img_description"><i class="bi bi-arrows-fullscreen"></i></div>
                    </div>
                    <?php
                }
            }

            // 2. Fetch General Images from Admin Page
            $saved_images = get_option('lyly_gallery_custom_images', '');
            $general_imgs = array_filter(explode(',', $saved_images));
            
            foreach ($general_imgs as $img_id) {
                $img_url = wp_get_attachment_image_url($img_id, 'large');
                if ($img_url) {
                    $h = $heights[$height_idx % count($heights)];
                    $height_idx++;
                    ?>
                    <div class="pics animation all general">
                        <div class="position-relative">
                            <div style="background-image: url('<?php echo esc_url($img_url); ?>'); width: 100%; height: <?php echo $h; ?>; background-size: cover; background-position: center;"></div>
                        </div>
                        <div class="img_description"><i class="bi bi-arrows-fullscreen"></i></div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</div>

<!-- Modal để hiển thị ảnh full screen (tuỳ chọn thêm) -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-body p-0 position-relative text-center">
                <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close" style="z-index: 10;"></button>
                <img src="" id="modalImage" class="img-fluid rounded" style="max-height: 90vh;">
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const filters = document.querySelectorAll('.gallery-filter .filter');
    const pics = document.querySelectorAll('.gallery .pics');

    filters.forEach(filter => {
        filter.addEventListener('click', function() {
            filters.forEach(f => f.classList.remove('active'));
            this.classList.add('active');

            const target = this.getAttribute('data-rel');

            pics.forEach(pic => {
                if (target === 'all') {
                    pic.classList.remove('hide');
                    setTimeout(() => pic.style.transform = 'scale(1)', 50);
                } else {
                    if (pic.classList.contains(target)) {
                        pic.classList.remove('hide');
                        setTimeout(() => pic.style.transform = 'scale(1)', 50);
                    } else {
                        pic.classList.add('hide');
                        pic.style.transform = 'scale(0.8)';
                    }
                }
            });
        });
    });

    // Image popup logic
    const modalImage = document.getElementById('modalImage');
    const imageModal = new bootstrap.Modal(document.getElementById('imageModal'));
    
    document.querySelectorAll('.gallery .pics').forEach(pic => {
        pic.addEventListener('click', function() {
            const bgImg = this.querySelector('.position-relative > div').style.backgroundImage;
            const url = bgImg.slice(4, -1).replace(/["']/g, "");
            modalImage.src = url;
            imageModal.show();
        });
    });
});
</script>

<?php get_template_part('template-parts/shared/more'); ?>

<?php get_footer(); ?>
