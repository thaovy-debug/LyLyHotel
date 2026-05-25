<?php
/*
Template Name: Gather Page
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

    .div-effect {
        overflow: hidden;
        width: 100%;
    }

    .div-effect img {
        -webkit-transform: scale(1);
        transform: scale(1);
        transition: all 3s ease;
        object-fit: cover;
    }

    .div-effect:hover img {
        -webkit-transform: scale(1.1);
        transform: scale(1.1);
        transition: all 3s ease;
    }

    .bg-light-orange {
        background: #fff6e5;
    }
</style>

<div class="delimiter-bottom" data-offset-top="#header-main" style="padding-top: 70px;"></div>
<div class="w-100 pt-4" style="margin-top: 50px;">
    <div class="container-fluid container-mg-post">
        <div class="row">
            <div class="col-md-12">
                <article class="mg-post">
                    <header>
                        <h1 class="mg-post-title d-none"><span>Gather</span></h1>
                    </header>
                    <div class="blog-content pb-5">
                        <section class="bg-cover" id="content1">
                            <div class="container">
                                <div class="mt-10 pt-5">
                                    
                                    <!-- Conference Row -->
                                    <div class="row bg-light-orange mb-4 shadow-sm">
                                        <div class="col-12 col-lg-6 w-reponsive p-0 d-flex" style="min-height: 400px;">
                                            <div class="div-effect w-100 h-100">
                                                <a href="<?php echo site_url('/conference'); ?>">
                                                    <img class="w-100 h-100" src="https://s3-north1.viettelidc.com.vn/zonex/one/files/sites/70/1.jpg">
                                                </a>
                                            </div>
                                        </div>

                                        <div class="col-12 col-lg-6 w-reponsive d-flex align-items-center">
                                            <div class="px-md-10 pt-5 pb-5 p-4">
                                                <h1 class="font-regular mb-4 text-uppercase">Hội Nghị (Conference)</h1>
                                                <p class="lead" style="font-size: 1.1rem; line-height: 1.8; color: #444;">
                                                    Với đội ngũ quản lý dịch vụ hội nghị chuyên nghiệp tại chỗ và các cơ sở tổ chức cuộc họp được thiết kế lại mới mẻ, sự kiện tiếp theo của bạn sẽ trở nên liền mạch và đáng nhớ.
                                                </p>
                                                <div class="mt-5 d-flex gap-10">
                                                    <h5><a class="text-dark font-bold text-decoration-none" style="transition: color 0.3s;" href="<?php echo site_url('/conference'); ?>" onmouseover="this.style.color='#FFCC66'" onmouseout="this.style.color='#212529'">CHI TIẾT <i class="bi bi-arrow-right"></i></a></h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Wedding Row -->
                                    <div class="row bg-light-orange mb-4 shadow-sm">
                                        <div class="col-12 col-lg-6 w-reponsive d-flex align-items-center order-2 order-lg-1">
                                            <div class="px-md-10 pt-5 pb-5 p-4 text-md-end w-100">
                                                <h1 class="font-regular mb-4 text-uppercase">Tiệc Cưới (Wedding)</h1>
                                                <p class="lead" style="font-size: 1.1rem; line-height: 1.8; color: #444;">
                                                    Cho dù bạn đang lên kế hoạch cho một đám cưới thân mật hay một lễ kỷ niệm lớn, các địa điểm tổ chức tiệc cưới lãng mạn của chúng tôi đều hoàn hảo cho ngày trọng đại của bạn.
                                                </p>
                                                <div class="mt-5 d-flex gap-10 justify-content-md-end">
                                                    <h5><a class="text-dark font-bold text-decoration-none" style="transition: color 0.3s;" href="<?php echo site_url('/wedding'); ?>" onmouseover="this.style.color='#FFCC66'" onmouseout="this.style.color='#212529'">CHI TIẾT <i class="bi bi-arrow-right"></i></a></h5>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-lg-6 w-reponsive p-0 d-flex order-1 order-lg-2" style="min-height: 400px;">
                                            <div class="div-effect w-100 h-100">
                                                <a href="<?php echo site_url('/wedding'); ?>">
                                                    <img class="w-100 h-100" src="https://s3-north1.viettelidc.com.vn/zonex/one/files/sites/70/3.jpg">
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Banquet Menu Row -->
                                    <div class="row bg-light-orange mb-4 shadow-sm">
                                        <div class="col-12 col-lg-6 w-reponsive p-0 d-flex" style="min-height: 400px;">
                                            <div class="div-effect w-100 h-100">
                                                <a href="<?php echo site_url('/banquet-menu'); ?>">
                                                    <img class="w-100 h-100" src="https://s3-north1.viettelidc.com.vn/zonex/one/files/sites/70/346498570_1304832573402425_3861313240524634359_n.jpg">
                                                </a>
                                            </div>
                                        </div>

                                        <div class="col-12 col-lg-6 w-reponsive d-flex align-items-center">
                                            <div class="px-md-10 pt-5 pb-5 p-4">
                                                <h1 class="font-regular mb-4 text-uppercase">Thực đơn Tiệc (Banquet Menu)</h1>
                                                <p class="lead" style="font-size: 1.1rem; line-height: 1.8; color: #444;">
                                                    Thực đơn được chế biến từ các nguyên liệu địa phương tươi ngon hòa nhịp cùng các mùa, đồng thời hỗ trợ nông dân và ngư dân phát triển bền vững.
                                                </p>
                                                <div class="mt-5 d-flex gap-10">
                                                    <h5><a class="text-dark font-bold text-decoration-none" style="transition: color 0.3s;" href="<?php echo site_url('/banquet-menu'); ?>" onmouseover="this.style.color='#FFCC66'" onmouseout="this.style.color='#212529'">CHI TIẾT <i class="bi bi-arrow-right"></i></a></h5>
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

<?php get_template_part('template-parts/shared/more'); ?>

<?php get_footer(); ?>
