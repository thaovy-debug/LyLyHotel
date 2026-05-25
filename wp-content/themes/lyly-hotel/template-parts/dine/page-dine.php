<?php
/*
Template Name: Dine Page
*/
get_header();
?>

<style>
    .container-mg-post {
        max-width: 100%;
        padding-left: 0rem;
        padding-right: 0rem;
    }

    @media only screen and (min-width: 991.98px) {

        .delimiter-bottom,
        .pt-4 {
            padding-top: unset !important;
        }

        .mg-post {
            padding-top: unset !important;
            padding-bottom: unset !important;
        }
    }

    .dine-box:hover .background {
        background-color: rgba(255, 255, 255, 0.7);
        width: 100%;
        transition: all 3s ease;
        height: 100%;
        position: absolute;
        display: block;
    }

    .dine-box:hover .post1 img {
        transform: scale(1.1);
        transition: 1s;
    }

    .dine-box:hover .text-dine a {
        color: var(--main-color-orange) !important;
        transition: all .3s ease
    }

    .bg-warning {
        background-color: var(--main-color-orange) !important;
    }
</style>

<div class="delimiter-bottom" data-offset-top="#header-main" style="padding-top: 70px;"></div>
<div class="w-100 pt-4" style="margin-top: 50px;">
    <div class="container-fluid container-mg-post">
        <div class="row">
            <div class="col-md-12">
                <article class="mg-post">
                    <header>
                        <h1 class="mg-post-title d-none"><span>Dine</span></h1>
                    </header>
                    <div class="blog-content">
                        <div class="mb-10 mb-lg-32 mt-md-20">
                            <!-- Banner Section -->
                            <div class="row text-md-start align-items-center bg-warning header-main-bottom m-0">
                                <div class="col-lg-6 p-0">
                                    <img alt="First slide" class="d-block w-100" src="https://s3-north1.viettelidc.com.vn/zonex/one/files/sites/70/FOOD01.png">
                                </div>
                                <div class="col-lg-6 p-0">
                                    <div class="px-5 py-5 px-md-20 pb-md-20 w-md-75 mx-auto">
                                        <div class="text-white fw-300">
                                            <span class="h2 text-white">KHÁCH SẠN LY LY</span><br>
                                            <span class="display-6 text-white" style="font-weight: bold;">NHÀ HÀNG &amp; GIẢI TRÍ</span>
                                            <p class="mt-3">Cuộc sống đẹp....</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Introduction Text -->
                            <div class="container mt-5 pt-5 pb-5">
                                <p class="text-center lead" style="max-width: 800px; margin: 0 auto; line-height: 1.8;">
                                    Tận hưởng trải nghiệm ẩm thực tuyệt vời tại các nhà hàng yêu thích mới của bạn tại <strong>Ly Ly Hotel</strong>.<br>
                                    Hãy khám phá <strong>Vela Restaurant</strong>, <strong>Carina Restaurant &amp; Entertainment</strong> – nơi hương vị tinh tế hòa quyện cùng không gian sang trọng, mang đến những khoảnh khắc đáng nhớ.
                                </p>
                            </div>

                            <!-- Dine Boxes -->
                            <div class="px-4 px-lg-24 pb-5 container">
                                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-2 g-5 mb-6">
                                    <!-- Restaurant Box -->
                                    <div class="col">
                                        <div class="dine-box h-100 d-flex flex-column">
                                            <div class="div-effect flex-grow-0" style="overflow: hidden;">
                                                <div class="position-relative">
                                                    <div class="post1">
                                                        <a href="<?php echo site_url('/restaurant'); ?>">
                                                            <img class="w-100" src="https://s3-north1.viettelidc.com.vn/zonex/one/files/sites/70/food%201.png" style="object-fit: cover; height: 350px; transition: transform 1s ease;">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-4">
                                                <h1 class="py-2 text-dine h3" style="text-transform: uppercase;">
                                                    <a class="text-black text-decoration-none" style="transition: color 0.3s;" href="<?php echo site_url('/restaurant'); ?>">NHÀ HÀNG</a>
                                                </h1>
                                            </div>
                                            <div class="flex-grow-1">
                                                <p class="lead" style="font-size: 1rem; color: #555;">Với tầm nhìn tuyệt đẹp, quầy bar và sảnh khách bên hồ bơi điểm đến của chúng tôi chuyển đổi liền mạch từ các món ăn và đồ uống buổi chiều sang địa điểm tổ chức buổi tối với nhạc sống địa phương, khiến nơi đây trở thành một trong những quán bar tốt nhất tại Ly Ly Hotel.</p>
                                            </div>
                                            <div class="py-2 mt-auto">
                                                <a class="font-bolder text-dark text-decoration-none" style="font-weight: bold; font-size: 14px;" href="<?php echo site_url('/restaurant'); ?>">CHI TIẾT <i class="bi bi-arrow-right"></i></a>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Entertainment Box -->
                                    <div class="col">
                                        <div class="dine-box h-100 d-flex flex-column">
                                            <div class="div-effect flex-grow-0" style="overflow: hidden;">
                                                <div class="position-relative">
                                                    <div class="post1">
                                                        <a href="<?php echo site_url('/entertainment'); ?>">
                                                            <img class="w-100" src="https://s3-north1.viettelidc.com.vn/zonex/one/files/sites/70/_THP4269-HDR.jpg" style="object-fit: cover; height: 350px; transition: transform 1s ease;">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-4">
                                                <h1 class="py-2 text-dine h3" style="text-transform: uppercase;">
                                                    <a class="text-black text-decoration-none" style="transition: color 0.3s;" href="<?php echo site_url('/entertainment'); ?>">GIẢI TRÍ</a>
                                                </h1>
                                            </div>
                                            <div class="flex-grow-1">
                                                <p class="lead" style="font-size: 1rem; color: #555;">Tại Ly Ly Hotel, dòng sản phẩm giải trí của chúng tôi tự hào có nhiều trải nghiệm đa dạng, từ các sự kiện nghệ thuật hấp dẫn đến các đêm câu lạc bộ độc quyền và khung cảnh quán bar sôi động. Du khách được mời đến thư giãn và đắm mình trong bầu không khí sang trọng của chúng tôi, tận hưởng sự thư giãn cũng như những thú vui văn hóa.</p>
                                            </div>
                                            <div class="py-2 mt-auto">
                                                <a class="font-bolder text-dark text-decoration-none" style="font-weight: bold; font-size: 14px;" href="<?php echo site_url('/entertainment'); ?>">CHI TIẾT <i class="bi bi-arrow-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
</div>

<?php get_template_part('template-parts/shared/more'); ?>

<?php get_footer(); ?>
