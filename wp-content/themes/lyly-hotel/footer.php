<style>
    .site-footer {
        background-color: #f8f9fa;
        color: #333;
        padding: 60px 0 40px;
        font-family: var(--main-font-family), sans-serif;
    }

    .footer-title {
        font-weight: 700;
        text-transform: uppercase;
        margin-bottom: 20px;
        font-size: 0.9rem;
        color: var(--main-color-orange, #FFCC66);
    }

    .site-footer p {
        margin-bottom: 10px;
        line-height: 1.6;
        font-size: 0.9rem;
    }

    .site-footer a {
        color: #333;
        text-decoration: none;
        transition: color 0.3s;
    }

    .site-footer a:hover {
        color: var(--main-color-orange, #FFCC66);
    }

    .footer-links a {
        display: block;
        margin-bottom: 8px;
        font-size: 0.9rem;
    }

    .platforms-carousel-wrapper {
        margin: 40px 0;
        padding: 30px 0;
        border-top: 1px solid #e5e5e5;
        border-bottom: 1px solid #e5e5e5;
    }

    .platforms-swiper .swiper-slide {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 60px;
        filter: grayscale(1);
        opacity: 0.6;
        transition: 0.3s;
    }

    .platforms-swiper .swiper-slide:hover {
        filter: grayscale(0);
        opacity: 1;
    }

    .platforms-swiper .swiper-slide img {
        max-height: 100%;
        max-width: 150px;
        object-fit: contain;
    }

    .branch-info {
        margin-bottom: 25px;
    }

    .branch-name {
        font-weight: 700;
        margin-bottom: 5px;
        display: block;
        color: #000;
    }
</style>

<footer class="site-footer">
    <div class="container px-4 px-lg-5" style="max-width: 1400px;">
        <div class="row">
            <!-- Giới thiệu -->
            <div class="col-lg-3 col-md-6 mb-4 pe-lg-5">
                <div class="footer-title">VỀ LY LY HOTEL</div>
                <p>Một nơi nghỉ ngơi ấm cúng để bạn thư giãn, tận hưởng những khoảnh khắc đáng nhớ giữa lòng Sài Gòn
                    🏙️💛</p>
                <p>Tận hưởng kỳ nghỉ thoải mái tại Ly Ly Hotel, nơi mỗi chuyến đi đều trở nên tiện nghi và ý nghĩa hơn
                    với sự hiểu khách và không gian yên bình.</p>
            </div>

            <!-- Chi nhánh 1 -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="footer-title">CHI NHÁNH 1</div>
                <div class="branch-info">
                    <span class="branch-name"><?php echo esc_html(function_exists('lyly_get_contact_option') ? lyly_get_contact_option('branch_1_name') : 'Ly Ly Hotel - Bình Phú'); ?></span>
                    <p><i class="bi bi-geo-alt-fill me-2"></i><?php echo esc_html(function_exists('lyly_get_contact_option') ? lyly_get_contact_option('branch_1_address') : '110-112 Đường Song Hành, Phường Bình Phú, TP. Hồ Chí Minh'); ?>
                    </p>
                    <p><i class="bi bi-telephone-fill me-2"></i><?php echo esc_html(function_exists('lyly_get_contact_option') ? lyly_get_contact_option('branch_1_phone') : '028 3755 8598 - 028 3755 8599'); ?></p>
                </div>
            </div>

            <!-- Chi nhánh 2 -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="footer-title">CHI NHÁNH 2</div>
                <div class="branch-info">
                    <span class="branch-name"><?php echo esc_html(function_exists('lyly_get_contact_option') ? lyly_get_contact_option('branch_2_name') : 'Ly Ly Hotel 2 - An Lạc'); ?></span>
                    <p><i class="bi bi-geo-alt-fill me-2"></i><?php echo esc_html(function_exists('lyly_get_contact_option') ? lyly_get_contact_option('branch_2_address') : '344A Đường Số 1, Phường An Lạc, TP. Hồ Chí Minh'); ?></p>
                    <p><i class="bi bi-telephone-fill me-2"></i><?php echo esc_html(function_exists('lyly_get_contact_option') ? lyly_get_contact_option('branch_2_phone') : '028 2222 3579 - 0983 479 689'); ?></p>
                </div>
            </div>

            <!-- Logo & Quick Links -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="text-center mb-4">
                    <img src="https://res.cloudinary.com/ddtv5nc3t/image/upload/v1778952363/Logo_cpnyib.png"
                        alt="Ly Ly Hotel" style="max-width: 100px;">
                </div>
                <div class="row footer-links">
                    <div class="col-6">
                        <a href="<?php echo site_url('/stay'); ?>">Phòng nghỉ</a>
                        <a href="<?php echo site_url('/offers'); ?>">Ưu đãi</a>
                        <a href="<?php echo site_url('/gallery'); ?>">Thư viện</a>
                    </div>
                    <div class="col-6">
                        <a href="<?php echo site_url('/about'); ?>">Giới thiệu</a>
                        <a href="<?php echo site_url('/contact'); ?>">Liên hệ</a>
                        <a href="<?php echo site_url('/faqs'); ?>">Hỏi đáp</a>
                    </div>
                </div>
            </div>
        </div>



        <!-- Copyright -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center pt-4 border-top">
            <p class="mb-3 mb-md-0" style="font-size: 0.8rem; color: #999;">© 2024 LY LY HOTEL. Tất cả quyền được bảo
                lưu.</p>
            <div class="social-links d-flex gap-3">
                <a href="#" class="text-dark"><i class="bi bi-facebook"></i></a>
                <a href="#" class="text-dark"><i class="bi bi-tiktok"></i></a>
                <a href="#" class="text-dark"><i class="bi bi-instagram"></i></a>
                <a href="#" class="text-dark"><i class="bi bi-youtube"></i></a>
            </div>
        </div>
    </div>
</footer>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (typeof Swiper !== 'undefined') {
            new Swiper('.platforms-swiper', {
                slidesPerView: 2,
                spaceBetween: 30,
                loop: true,
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                },
                breakpoints: {
                    576: { slidesPerView: 3 },
                    768: { slidesPerView: 4 },
                    992: { slidesPerView: 5 }
                }
            });
        }
    });
</script>

<?php get_template_part('template-parts/shared/booking-bar-fixed'); ?>

<?php wp_footer(); ?>
</body>

</html>