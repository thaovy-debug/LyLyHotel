<style>
    .banquet-container { max-width: 100%; padding: 0; }
    @media only screen and (min-width: 991.98px) {
        .banquet-page .delimiter-bottom, .banquet-page .pt-4 { padding-top: unset !important; }
        .banquet-page .mg-post { padding-top: unset !important; padding-bottom: unset !important; }
    }
    .banquet-hero img { width: 100%; height: 100%; object-fit: cover; }
    .banquet-meeting-effect { overflow: hidden; }
    .banquet-meeting-effect .post-bg {
        padding-top: 100%;
        background-size: cover !important;
        background-position: center !important;
        background-repeat: no-repeat !important;
        height: 100%; width: 100%;
    }
    .banquet-meeting-effect:hover .bg-overlay {
        background-color: rgb(228 169 0 / 33%);
        width: 100%; height: 100%;
        position: absolute; z-index: 1;
        display: block;
        transition: all 3s ease;
    }
    .banquet-meeting-effect .bg-overlay { display: none; }
    .banquet-meeting-effect .bg-overlay h2 {
        position: absolute; top: 50%;
        transform: translateY(-50%);
        color: #fff; z-index: 5;
    }
</style>

<div class="banquet-page">
<div class="delimiter-bottom" data-offset-top="#header-main" style="padding-top: 70px;"></div>
<div class="w-100 pt-4" style="margin-top: 50px;">
    <div class="container-fluid banquet-container">
        <article class="mg-post">
            <header><h1 class="mg-post-title d-none"><span>Banquet Menu</span></h1></header>
            <div class="blog-content">
                <!-- Hero Banner -->
                <div class="banquet-hero mb-0">
                    <div class="row text-md-start align-items-center bg-warning g-0">
                        <div class="col-lg-6 p-0">
                            <img alt="Banquet Menu" class="d-block w-100" src="https://malibuhotel.com.vn/files/sites/70/meeting-3.jpg" style="height: 450px; object-fit: cover;">
                        </div>
                        <div class="col-lg-6 p-0">
                            <div class="px-5 py-5 px-md-10 pb-md-10">
                                <div class="text-white fw-300">
                                    <span class="h2 text-white">WELCOME TO LY LY</span><br>
                                    <span class="display-6 text-white text-uppercase">Banquet Menu</span>
                                    <p class="mt-3">Lịch sử - Kiến trúc - Tầm nhìn.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Content -->
                <div class="container my-5 py-4">
                    <div class="mb-5 text-center">
                        <h1 class="font-regular">HỘI HỌP & SỰ KIỆN</h1>
                        <h1 class="font-regular py-3 display-4" style="font-weight: 300;">THỰC ĐƠN TIỆC</h1>
                        <p class="font-regular lead mx-lg-5 mx-3">
                            Khách sạn Ly Ly sở hữu 7 phòng hội nghị cho tối đa 450 khách. Các phòng Malibu Grand có thể tách thành 3 phòng nhỏ với sức chứa 120 khách mỗi phòng bằng hệ thống vách ngăn.<br>
                            Với hệ thống âm thanh tiêu chuẩn quốc tế, màn hình LED hiện đại và máy chiếu, nội thất cao cấp sẵn sàng đáp ứng nhu cầu của mọi khách hàng.
                        </p>
                    </div>

                    <div class="row row-cols-1 row-cols-md-3 g-4 mb-5">
                        <div class="col">
                            <div class="banquet-meeting-effect">
                                <div class="position-relative">
                                    <div class="bg-overlay"><h2 class="ms-4">Xem chi tiết</h2></div>
                                    <div class="post-bg" style="background: url(https://malibuhotel.com.vn/files/sites/70/meeting-1.jpg);"></div>
                                </div>
                            </div>
                            <h3 class="py-2">Hội thảo</h3>
                            <p class="lead">Tham khảo nhanh cách tổ chức sự kiện tại khách sạn Ly Ly</p>
                        </div>
                        <div class="col">
                            <div class="banquet-meeting-effect">
                                <div class="position-relative">
                                    <div class="bg-overlay"><h2 class="ms-4">Xem chi tiết</h2></div>
                                    <div class="post-bg" style="background: url(https://malibuhotel.com.vn/files/sites/70/meeting-2.jpg);"></div>
                                </div>
                            </div>
                            <h3 class="py-2">Hội nghị</h3>
                            <p class="lead">Tham khảo nhanh cách tổ chức sự kiện tại khách sạn Ly Ly</p>
                        </div>
                        <div class="col">
                            <div class="banquet-meeting-effect">
                                <div class="position-relative">
                                    <div class="bg-overlay"><h2 class="ms-4">Xem chi tiết</h2></div>
                                    <div class="post-bg" style="background: url(https://malibuhotel.com.vn/files/sites/70/meeting-3.jpg);"></div>
                                </div>
                            </div>
                            <h3 class="py-2">Sự kiện</h3>
                            <p class="lead">Tham khảo nhanh cách tổ chức sự kiện tại khách sạn Ly Ly</p>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </div>
</div>
</div>

<?php get_template_part('template-parts/shared/more'); ?>
