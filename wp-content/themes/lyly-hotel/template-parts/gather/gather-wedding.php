<style>
    .wedding-container { max-width: 100%; padding: 0; }
    @media only screen and (min-width: 991.98px) {
        .wedding-page .delimiter-bottom, .wedding-page .pt-4 { padding-top: unset !important; }
        .wedding-page .mg-post { padding-top: unset !important; padding-bottom: unset !important; }
    }
    .wedding-slider-ks .carousel-control-prev,
    .wedding-slider-ks .carousel-control-next { top: 15% !important; }
    .wedding-slider-ks .slide.height-screen {
        height: 80vh;
        background-position: center center;
        background-size: cover;
    }
    .wedding-slider-ks .content-logo {
        left: 25px; right: 25px;
        top: 50%; transform: translateY(-50%);
        position: absolute; z-index: 100;
    }
    .wedding-slider-ks .bg-overlay-dark {
        background: black;
        position: absolute;
        height: 100%; width: 100%;
        opacity: 0.3; z-index: 10;
    }
    .img-wedding { overflow: hidden; }
    .img-wedding img,
    .img-text-content img {
        transition: transform 3s ease;
    }
    .img-wedding:hover img,
    .img-text-content .col:hover img {
        transform: scale(1.05);
    }
    .img-wedding .background,
    .img-text-content .background {
        position: absolute; top: 0; left: 0;
        width: 100%; height: 100%;
        background-color: rgba(255,255,255,0.5);
        display: flex; align-items: center; justify-content: center;
        opacity: 0; transition: opacity 0.5s ease; z-index: 1;
    }
    .img-wedding:hover .background,
    .img-text-content .col:hover .background { opacity: 1; }
</style>

<div class="wedding-page">
<div class="delimiter-bottom" data-offset-top="#header-main" style="padding-top: 70px;"></div>
<div class="w-100 pt-4" style="margin-top: 50px;">
    <div class="container-fluid wedding-container">
        <article class="mg-post">
            <header><h1 class="mg-post-title d-none"><span>Wedding</span></h1></header>
            <div class="blog-content">
                <!-- Hero Slider -->
                <div class="wedding-slider-ks">
                    <div class="carousel slide carousel-fade" data-bs-ride="carousel" id="weddingBannerSlider">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="bg-overlay-dark"></div>
                                <div class="slide height-screen position-relative" style="background-image: url(https://www.alohilaniresort.com/cdn-cgi/image/format=auto/wp-content/uploads/2023/01/Wedding-Aki_JK_0362_2800x1600-scaled.jpg);">
                                    <div class="content-logo">
                                        <div class="text-center overlap-10 text-white">
                                            <h1 class="text-white">HỘI HỌP & SỰ KIỆN</h1>
                                            <h1 class="text-white display-4">TIỆC CƯỚI</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="bg-overlay-dark"></div>
                                <div class="slide height-screen position-relative" style="background-image: url(https://malibuhotel.com.vn/files/sites/70/weeding-banner.jpg);">
                                    <div class="content-logo">
                                        <div class="text-center overlap-10 text-white">
                                            <h1 class="text-white">WEDDING</h1>
                                            <h1 class="text-white display-4">NGÀY TRỌNG ĐẠI</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="carousel-control-prev" data-bs-slide="prev" data-bs-target="#weddingBannerSlider" type="button"><i class="bi bi-arrow-left text-xl"></i></button>
                        <button class="carousel-control-next" data-bs-slide="next" data-bs-target="#weddingBannerSlider" type="button"><i class="bi bi-arrow-right text-xl"></i></button>
                    </div>
                </div>

                <!-- Wedding Content -->
                <div class="container my-5 py-4">
                    <div class="row">
                        <div class="col-md-9">
                            <h3>TIỆC CƯỚI</h3>
                            <h1 class="mb-4 display-5" style="font-weight: 300;">Khách Sạn Ly Ly - Điểm Đến Cho Ngày Trọng Đại</h1>
                            <p class="mb-4 lead">Cho dù bạn đang lên kế hoạch cho một buổi tiệc thân mật hay một lễ kỷ niệm lớn, đội ngũ chuyên nghiệp của chúng tôi sẽ giúp bạn thiết kế ngày trọng đại tại các địa điểm tổ chức tiệc cưới của Ly Ly.</p>
                            <p class="mb-4 lead">Các gói tiệc cưới tại Vũng Tàu đáp ứng mọi nhu cầu, bao gồm chụp ảnh, hoa tươi và nhiều hơn nữa. Các địa điểm tiệc cưới đa dạng và linh hoạt, có thể phục vụ tiệc từ 50 đến 250 khách.</p>
                            <p class="mb-4 lead">Làm việc với đội ngũ phục vụ chuyên nghiệp sẽ cho phép bạn tạo ra thực đơn thể hiện tinh hoa của ngày đặc biệt.</p>
                            <div class="mt-4">
                                <a class="btn btn-warning px-5 py-3 text-white fw-bold me-3 mb-2" href="#">WEDDING FAQS</a>
                                <a class="btn btn-warning px-5 py-3 text-white fw-bold mb-2" href="#">GỬI YÊU CẦU</a>
                            </div>
                        </div>
                    </div>

                    <!-- Wedding Gallery -->
                    <div class="row text-center text-md-start my-5 g-0">
                        <div class="col-lg-6 p-0 position-relative img-wedding">
                            <img class="w-100 h-100" src="https://malibuhotel.com.vn/files/sites/70/weeding-tai-malibu.jpg" style="object-fit: cover; min-height: 600px;">
                            <div class="background"><h1 class="text-white font-regular">Special Day</h1></div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row row-cols-1 row-cols-md-2 g-0 img-text-content">
                                <div class="col p-0 position-relative overflow-hidden">
                                    <img class="w-100" src="https://malibuhotel.com.vn/files/sites/70/malibu-weeding-5.png" style="height: 300px; object-fit: cover;">
                                    <div class="background"><h1 class="text-white font-regular">Special Day</h1></div>
                                </div>
                                <div class="col p-0 overflow-hidden">
                                    <img class="w-100" src="https://malibuhotel.com.vn/files/sites/70/malibu-weeding-2.png" style="height: 300px; object-fit: cover;">
                                </div>
                                <div class="col p-0 overflow-hidden">
                                    <img class="w-100" src="https://malibuhotel.com.vn/files/sites/70/malibu-weeding-4.png" style="height: 300px; object-fit: cover;">
                                </div>
                                <div class="col p-0 position-relative overflow-hidden">
                                    <img class="w-100" src="https://malibuhotel.com.vn/files/sites/70/malibu-weeding-3.png" style="height: 300px; object-fit: cover;">
                                    <div class="background"><h1 class="text-white font-regular">Special Day</h1></div>
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

<?php get_template_part('template-parts/shared/more'); ?>
