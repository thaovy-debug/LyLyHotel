<?php get_header(); ?>

<main>
    <?php get_template_part('template-parts/home/home-hero'); ?>

    <?php /*
    <!-- Mobile Booking Bar -->
    <div class="d-block d-md-none w-100 book-now-container " data-color="#ffcc66" data-bgcolor="#0e2b4c">
        <div class="mg-book-now-md mg-book-now container" style="background-color: rgb(14, 43, 76);">
            <div class="row">
                <div class="col-lg-12">
                    <div class="mg-bn-forms" data-bs-toggle="modal" data-bs-target="#checkrateFormModal">
                        <div class="row py-3 text-center" style="color: rgb(255, 204, 102);">
                            <div class="col-12 h4 mb-0">BOOK NOW</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Desktop Booking Bar -->
    <style>
        .header-bottom {
            background-color: #ffcc66 !important;
            color: #0e2b4c !important;
            font-family: "Times New Roman", Times, serif;
            transition: background-color 0.4s ease;
        }

        .header-bottom:hover {
            background-color: #ffffff !important;
        }

        .nav-checkrate-title,
        .nav-checkrate-month {
            font-size: 1.1rem;
            text-transform: uppercase;
        }

        .nav-checkrate-date,
        .nav-checkrate-adult {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-weight: 300;
            font-size: 2.8rem;
            line-height: 1;
            margin-left: 8px;
        }

        .checkrate-separator {
            font-size: 1.2rem;
            margin: 0 1.5rem;
            font-family: Arial, sans-serif;
            color: #0e2b4c;
        }

        .nav-checkrate-booknow {
            font-size: 1.2rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
    </style>
    <!-- Thêm data-bs-toggle và data-bs-target vào thẻ div chính của thanh màu vàng -->
    <div class="position-header header-bottom w-100 py-4 cs-pointer" style="background-color: #fbc25e;"
        data-bs-toggle="modal" data-bs-target="#checkrateFormModal"> <!-- ĐÂY LÀ DÒNG QUAN TRỌNG ĐỂ MỞ FORM -->

        <div class="container">
            <div class="d-flex justify-content-center gap-4 align-items-center">
                <!-- Ngày đến -->
                <div class="d-flex gap-1 align-items-center">
                    <div class="h3 mb-0">NGÀY ĐẾN</div>
                    <div class="h3 mb-0">Tháng 5</div>
                    <div class="display-6 mb-0">13</div>
                </div>
                <!-- ... các phần khác như Ngày đi, Khách ... -->
                <div class="ms-lg-5">
                    <h3 class="mb-0">ĐẶT BÂY GIỜ</h3>
                </div>
            </div>
        </div>
    </div>
    */ ?>

    <?php get_template_part('template-parts/home/home-welcome'); ?>

    <!-- Booking Platforms Carousel -->
    <div class="container my-5 pb-4">
        <div class="platforms-carousel-wrapper position-relative">
            <div class="text-center mb-4"
                style="font-size: 0.8rem; letter-spacing: 2px; color: #999; font-weight: 700;">ĐỐI TÁC LIÊN KẾT</div>
            <div class="swiper platforms-swiper">
                <div class="swiper-wrapper">
                    <?php
                    $partners_query = new WP_Query(array(
                        'post_type'      => 'lyly_partner',
                        'posts_per_page' => -1,
                        'post_status'    => 'publish',
                        'orderby'        => 'menu_order',
                        'order'          => 'ASC'
                    ));
                    if ($partners_query->have_posts()):
                        while ($partners_query->have_posts()): $partners_query->the_post();
                            $post_id = get_the_ID();
                            $ext_img = get_post_meta($post_id, '_lyly_partner_external_image_url', true);
                            $logo_url = $ext_img ? $ext_img : get_the_post_thumbnail_url($post_id, 'full');
                            if ($logo_url):
                                $partner_link = get_post_meta($post_id, '_lyly_partner_link', true);
                                $logo_url_esc = function_exists('lyly_esc_url_with_base64') ? lyly_esc_url_with_base64($logo_url) : esc_url($logo_url);
                                ?>
                                <div class="swiper-slide">
                                    <?php if ($partner_link): ?>
                                        <a href="<?php echo esc_url($partner_link); ?>" target="_blank" rel="noopener noreferrer" style="display: flex; justify-content: center; align-items: center; width: 100%; height: 100%;">
                                    <?php endif; ?>
                                    <img src="<?php echo $logo_url_esc; ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
                                    <?php if ($partner_link): ?>
                                        </a>
                                    <?php endif; ?>
                                </div>
                                <?php
                            endif;
                        endwhile;
                        wp_reset_postdata();
                    else:
                        // Fallback to static list if no partner posts exist
                        ?>
                        <!-- Booking.com -->
                        <div class="swiper-slide">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/b/be/Booking.com_logo.svg"
                                alt="Booking.com">
                        </div>
                        <!-- Agoda -->
                        <div class="swiper-slide">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/c/ce/Agoda_logo.svg" alt="Agoda">
                        </div>
                        <!-- Traveloka -->
                        <div class="swiper-slide">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/0/0b/Traveloka_Logo.png"
                                alt="Traveloka">
                        </div>
                        <!-- TripAdvisor -->
                        <div class="swiper-slide">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/0/02/TripAdvisor_Logo.svg"
                                alt="TripAdvisor">
                        </div>
                        <!-- Klook -->
                        <div class="swiper-slide">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/1/1d/Klook_logo.svg" alt="Klook">
                        </div>
                        <!-- Expedia (Additional) -->
                        <div class="swiper-slide">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/7/77/Expedia_logo_2023.svg"
                                alt="Expedia">
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</main>

<?php get_template_part('template-parts/shared/booking-modal'); ?>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Swiper initialization
        if (typeof Swiper !== 'undefined') {
            var swiper = new Swiper(".categories-swiper", {
                slidesPerView: 1,
                slidesPerGroup: 1,
                spaceBetween: 0,
                loop: true,
                speed: 800,
                autoplay: {
                    delay: 4000,
                    disableOnInteraction: false,
                },
                navigation: {
                    nextEl: ".custom-next",
                    prevEl: ".custom-prev",
                },
                breakpoints: {
                    768: {
                        slidesPerView: 2,
                        slidesPerGroup: 2,
                    },
                    1024: {
                        slidesPerView: 4,
                        slidesPerGroup: 4,
                    },
                },
            });

            // Offers Swiper initialization
            var offersSwiper = new Swiper(".offers-swiper", {
                slidesPerView: 1,
                spaceBetween: 0,
                loop: true,
                speed: 800,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                navigation: {
                    nextEl: ".offers-next",
                    prevEl: ".offers-prev",
                },
                breakpoints: {
                    768: {
                        slidesPerView: 2,
                    },
                    1024: {
                        slidesPerView: 3,
                    },
                },
            });

            // Mobile More Swiper initialization
            var mobileMoreSwiper = new Swiper(".mobile-more-swiper", {
                slidesPerView: 1,
                spaceBetween: 10,
                loop: true,
                speed: 800,
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                },
                navigation: {
                    nextEl: ".mobile-more-next",
                    prevEl: ".mobile-more-prev",
                },
                breakpoints: {
                    576: {
                        slidesPerView: 2,
                    },
                    768: {
                        slidesPerView: 3,
                    }
                }
            });
        }

        // Header scroll effect
        const header = document.querySelector('header');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                header.classList.remove('header-transparent');
                header.style.backgroundColor = 'var(--main-header-bg-color)';
            } else {
                header.classList.add('header-transparent');
                header.style.backgroundColor = 'transparent';
            }
        });
    });
</script>

<?php get_footer(); ?>