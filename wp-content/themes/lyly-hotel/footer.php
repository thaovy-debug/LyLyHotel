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
                    <p><i class="bi bi-telephone-fill me-2"></i><?php echo esc_html(function_exists('lyly_get_contact_option') ? lyly_get_contact_option('branch_1_phone') : '028 3755 8599'); ?></p>
                </div>
            </div>

            <!-- Chi nhánh 2 -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="footer-title">CHI NHÁNH 2</div>
                <div class="branch-info">
                    <span class="branch-name"><?php echo esc_html(function_exists('lyly_get_contact_option') ? lyly_get_contact_option('branch_2_name') : 'Ly Ly Hotel 2 - An Lạc'); ?></span>
                    <p><i class="bi bi-geo-alt-fill me-2"></i><?php echo esc_html(function_exists('lyly_get_contact_option') ? lyly_get_contact_option('branch_2_address') : '344A Đường Số 1, Phường An Lạc, TP. Hồ Chí Minh'); ?></p>
                    <p><i class="bi bi-telephone-fill me-2"></i><?php echo esc_html(function_exists('lyly_get_contact_option') ? lyly_get_contact_option('branch_2_phone') : '028 2222 3579'); ?></p>
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

<!-- Custom Booking Contact Modal -->
<div class="modal fade" id="bookingContactModal" tabindex="-1" aria-labelledby="bookingContactModalLabel" aria-hidden="true" style="z-index: 10650;">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="background-color: #16192c; color: #fff; border: 1px solid rgba(251, 194, 94, 0.2); border-radius: 16px; font-family: 'Montserrat', sans-serif; overflow: hidden; box-shadow: 0 15px 40px rgba(0,0,0,0.5);">
            <!-- Modal Header -->
            <div class="modal-header border-0 pb-0" style="padding: 24px 24px 10px 24px;">
                <h5 class="modal-title w-100 text-center text-uppercase fw-bold" id="bookingContactModalLabel" style="color: #fbc25e; letter-spacing: 2px; font-size: 1.4rem;">Liên Hệ Đặt Phòng</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" style="box-shadow: none;"></button>
            </div>
            
            <div class="modal-body" style="padding: 24px;">
                <!-- Step 1: Branch Selection -->
                <div id="booking-step-select">
                    <p class="text-center mb-4" style="color: #ccc; font-weight: 300;">Vui lòng chọn chi nhánh Quý khách muốn đặt phòng:</p>
                    
                    <div class="row g-4 justify-content-center">
                        <!-- Branch 1 Card -->
                        <div class="col-md-6">
                            <div class="branch-contact-card">
                                <div class="branch-card-img-wrap">
                                    <img src="https://res.cloudinary.com/ddtv5nc3t/image/upload/v1779164959/gr6_fxbqst.jpg" alt="Ly Ly Hotel - Bình Phú">
                                </div>
                                <div class="branch-card-info">
                                    <h4 class="branch-card-title"><?php echo esc_html(function_exists('lyly_get_contact_option') ? lyly_get_contact_option('branch_1_name') : 'Ly Ly Hotel - Bình Phú'); ?></h4>
                                    <p class="branch-card-address"><i class="bi bi-geo-alt-fill me-2" style="color: #fbc25e;"></i><?php echo esc_html(function_exists('lyly_get_contact_option') ? lyly_get_contact_option('branch_1_address') : '110-112 Đường Song Hành, Phường Bình Phú, TP. Hồ Chí Minh'); ?></p>
                                    <a href="tel:<?php echo esc_attr(str_replace(' ', '', function_exists('lyly_get_contact_option') ? lyly_get_contact_option('branch_1_phone') : '02837558599')); ?>" class="branch-card-select-btn"><i class="bi bi-telephone-fill me-2"></i><?php echo esc_html(function_exists('lyly_get_contact_option') ? lyly_get_contact_option('branch_1_phone') : '028 3755 8599'); ?></a>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Branch 2 Card -->
                        <div class="col-md-6">
                            <div class="branch-contact-card">
                                <div class="branch-card-img-wrap">
                                    <img src="https://res.cloudinary.com/ddtv5nc3t/image/upload/v1779164815/gr5_ypj5re.jpg" alt="Ly Ly Hotel 2 - An Lạc">
                                </div>
                                <div class="branch-card-info">
                                    <h4 class="branch-card-title"><?php echo esc_html(function_exists('lyly_get_contact_option') ? lyly_get_contact_option('branch_2_name') : 'Ly Ly Hotel 2 - An Lạc'); ?></h4>
                                    <p class="branch-card-address"><i class="bi bi-geo-alt-fill me-2" style="color: #fbc25e;"></i><?php echo esc_html(function_exists('lyly_get_contact_option') ? lyly_get_contact_option('branch_2_address') : '344A Đường Số 1, Phường An Lạc, TP. Hồ Chí Minh'); ?></p>
                                    <a href="tel:<?php echo esc_attr(str_replace(' ', '', function_exists('lyly_get_contact_option') ? lyly_get_contact_option('branch_2_phone') : '02822223579')); ?>" class="branch-card-select-btn"><i class="bi bi-telephone-fill me-2"></i><?php echo esc_html(function_exists('lyly_get_contact_option') ? lyly_get_contact_option('branch_2_phone') : '028 2222 3579'); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .branch-contact-card {
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 12px;
        overflow: hidden;
        height: 100%;
        transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
        display: flex;
        flex-direction: column;
    }
    
    .branch-card-img-wrap {
        height: 180px;
        overflow: hidden;
        position: relative;
    }
    
    .branch-card-img-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    
    .branch-card-info {
        padding: 20px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    
    .branch-card-title {
        font-size: 1.15rem;
        font-weight: 700;
        color: #fff;
        margin-bottom: 12px;
        transition: color 0.3s;
    }
    
    .branch-card-address {
        font-size: 0.88rem;
        color: #bbb;
        line-height: 1.5;
        margin-bottom: 20px;
        font-weight: 300;
    }
    
    .branch-card-select-btn {
        display: block;
        width: 100%;
        text-align: center;
        padding: 12px;
        background: #fbc25e;
        color: #16192c;
        font-size: 1rem;
        font-weight: 700;
        border-radius: 8px;
        border: 1px solid #fbc25e;
        transition: all 0.3s;
        text-decoration: none !important;
    }
    
    /* Responsive styles for Laptop / Desktop vs Mobile */
    @media (min-width: 992px) {
        .branch-contact-card {
            cursor: default !important;
            transform: none !important;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15) !important;
            background: rgba(255, 255, 255, 0.03) !important;
            border-color: rgba(255, 255, 255, 0.08) !important;
        }
        .branch-card-img-wrap img {
            transform: none !important;
        }
        .branch-card-title {
            color: #fff !important;
        }
        .branch-card-select-btn {
            background: #fbc25e !important;
            color: #16192c !important;
            border-color: #fbc25e !important;
            pointer-events: none !important;
            cursor: default !important;
        }
    }
    
    @media (max-width: 991px) {
        .branch-contact-card {
            cursor: pointer;
        }
        .branch-contact-card:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.06);
            border-color: rgba(251, 194, 94, 0.4);
            box-shadow: 0 10px 25px rgba(251, 194, 94, 0.1);
        }
        .branch-contact-card:hover .branch-card-img-wrap img {
            transform: scale(1.05);
        }
        .branch-contact-card:hover .branch-card-title {
            color: #fbc25e;
        }
        .branch-card-select-btn:hover {
            background: #e5b352;
            border-color: #e5b352;
            color: #16192c;
        }
    }
</style>

<?php get_template_part('template-parts/shared/booking-bar-fixed'); ?>

<?php wp_footer(); ?>
</body>

</html>