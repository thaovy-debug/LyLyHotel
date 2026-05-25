<?php
/*
Template Name: Offers Page
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
        .delimiter-bottom, .pt-4 {
            padding-top: unset !important;
        }
        .mg-post {
            padding-top: unset !important;
            padding-bottom: unset !important;
        }
    }

    .div-effect {
        overflow: hidden;
        width: 100%;
    }

    .div-effect .post {
        transform: scale(1);
        transition: all 1s ease;
        padding-top: 100%; /* Creates a square aspect ratio */
        background-size: cover !important;
        background-position: center !important;
        background-repeat: no-repeat !important;
        height: 100%;
        width: 100%;
    }

    .div-effect:hover .post {
        transform: scale(1.1);
        transition: all 1s ease;
    }

    .div-effect .background {
        display: none;
    }

    .div-effect:hover .background {
        background-color: rgba(255, 255, 255, 0.4);
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
        z-index: 1;
        display: block;
        transition: all 0.5s ease;
    }

    .offer-title {
        color: var(--main-color-orange, #FFCC66);
    }
    
    .offer-box {
        margin-bottom: 2rem;
    }

    .offer-box a {
        text-decoration: none;
    }

    .offer-box h1 {
        font-size: 1.5rem;
        font-weight: 400;
        color: #212529;
        transition: color 0.3s ease;
    }

    .offer-box:hover h1 {
        color: var(--main-color-orange, #FFCC66);
    }
    
    .nav-tabs {
        border-bottom: 1px solid #dee2e6;
    }
    
    .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
        color: var(--main-color-orange, #FFCC66);
        background-color: transparent;
        border-color: transparent transparent var(--main-color-orange, #FFCC66);
        border-bottom-width: 3px;
    }
    
    .nav-tabs .nav-link {
        border: 1px solid transparent;
        border-top-left-radius: .25rem;
        border-top-right-radius: .25rem;
        color: #495057;
        font-weight: 600;
        text-transform: uppercase;
        padding: 0.5rem 1rem 1rem;
    }
    
    .nav-tabs .nav-link:hover {
        border-color: transparent;
        color: var(--main-color-orange, #FFCC66);
    }
</style>

<div class="delimiter-bottom" data-offset-top="#header-main" style="padding-top: 70px;"></div>
<div class="w-100 pt-4" style="margin-top: 150px;">
    <div class="container-fluid container-mg-post">
        <div class="row">
            <div class="col-md-12">
                <article class="mg-post">
                    <header>
                        <h1 class="mg-post-title d-none"><span>Offers</span></h1>
                    </header>
                    <div class="blog-content pb-5">
                        <section>
                            <div>
                                <div class="px-3 px-md-10 px-lg-24 pt-4 pt-md-0 pt-lg-5">
                                    <div class="row justify-content-center text-md-center mb-5">
                                        <h1 class="text-center pt-5 pb-3 display-5 text-uppercase font-regular">ƯU ĐÃI ĐẶC BIỆT TỪ LY LY</h1>
                                        <p class="text-center lead font-regular px-10" style="color: #666; max-width: 800px; margin: 0 auto;">
                                            Khám phá viên ngọc quý của Khách sạn Ly Ly với những gói nghỉ dưỡng độc quyền tại Vũng Tàu — những ưu đãi tốt nhất chỉ có tại Khách sạn Ly Ly.
                                        </p>
                                    </div>

                                    <div class="px-md-10 px-lg-24 justify-content-center pb-5 px-0">
                                        <ul class="nav nav-tabs d-flex justify-content-center gap-4 gap-md-8 py-2 mb-4" id="offerTabs" role="tablist">
                                            <li class="nav-item">
                                                <a aria-selected="true" class="nav-link active" data-bs-toggle="tab" href="#offers-tab" id="tab-offers" role="tab">
                                                    <h3 class="mb-0 fs-4">OFFERS</h3>
                                                </a>
                                            </li>
                                        </ul>

                                        <div class="tab-content" id="offerContent" style="width: 100%;">
                                            <div aria-labelledby="tab-offers" class="tab-pane fade active show" id="offers-tab" role="tabpanel">
                                                <div class="px-0 py-3">
                                                    <div class="row mt-4">
                                                        
                                                        <!-- Offer 1 -->
                                                        <div class="col-12 col-md-4 offer-box">
                                                            <a href="<?php echo site_url('/offer/free-upgrade'); ?>">
                                                                <div class="div-effect">
                                                                    <div class="position-relative">
                                                                        <div class="background"></div>
                                                                        <div class="post" style="background-image: url('https://res.cloudinary.com/ddtv5nc3t/image/upload/v1779164959/gr6_fxbqst.jpg');"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="mt-3">
                                                                    <h1 class="py-2 text-uppercase mb-0">Nâng Cấp Miễn Phí</h1>
                                                                </div>
                                                                <div class="lead text-black mt-2" style="font-size: 1rem; color: #555 !important;">
                                                                    Trải nghiệm hạng phòng cao cấp hơn hoàn toàn miễn phí khi đặt phòng trực tiếp tại Khách sạn Ly Ly.
                                                                </div>
                                                            </a>
                                                            <div class="py-2 my-3">
                                                                <a href="<?php echo site_url('/offer/free-upgrade'); ?>" class="font-bolder text-dark" style="text-decoration: underline; font-weight: 600;">CHI TIẾT</a>
                                                            </div>
                                                        </div>

                                                        <!-- Offer 2 -->
                                                        <div class="col-12 col-md-4 offer-box">
                                                            <a href="<?php echo site_url('/offer/summer-package'); ?>">
                                                                <div class="div-effect">
                                                                    <div class="position-relative">
                                                                        <div class="background"></div>
                                                                        <div class="post" style="background-image: url('https://res.cloudinary.com/ddtv5nc3t/image/upload/v1779164815/gr5_ypj5re.jpg');"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="mt-3">
                                                                    <h1 class="py-2 text-uppercase mb-0">Ưu Đãi Nghỉ Dưỡng</h1>
                                                                </div>
                                                                <div class="lead text-black mt-2" style="font-size: 1rem; color: #555 !important;">
                                                                    "Một tuyệt tác nghỉ dưỡng bên bãi biển tuyệt đẹp." Đặt phòng ngay để nhận ưu đãi hấp dẫn.
                                                                </div>
                                                            </a>
                                                            <div class="py-2 my-3">
                                                                <a href="<?php echo site_url('/offer/summer-package'); ?>" class="font-bolder text-dark" style="text-decoration: underline; font-weight: 600;">CHI TIẾT</a>
                                                            </div>
                                                        </div>

                                                        <!-- Offer 3 -->
                                                        <div class="col-12 col-md-4 offer-box">
                                                            <a href="<?php echo site_url('/offer/healing-escape'); ?>">
                                                                <div class="div-effect">
                                                                    <div class="position-relative">
                                                                        <div class="background"></div>
                                                                        <div class="post" style="background-image: url('https://res.cloudinary.com/ddtv5nc3t/image/upload/v1779432359/bgLyLy_wxotp1.jpg');"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="mt-3">
                                                                    <h1 class="py-2 text-uppercase mb-0">Chuyến Đi Chữa Lành</h1>
                                                                </div>
                                                                <div class="lead text-black mt-2" style="font-size: 1rem; color: #555 !important;">
                                                                    "Một kỳ nghỉ sang trọng bắt đầu từ không gian thoải mái, ẩm thực tinh tế và dịch vụ tận tâm."
                                                                </div>
                                                            </a>
                                                            <div class="py-2 my-3">
                                                                <a href="<?php echo site_url('/offer/healing-escape'); ?>" class="font-bolder text-dark" style="text-decoration: underline; font-weight: 600;">CHI TIẾT</a>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </article>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
