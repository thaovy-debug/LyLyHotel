<?php
/**
 * Template Part: Gather - Banquet Menu
 */
?>
<style>
    .meeting-effect {
        overflow: hidden;
        position: relative;
    }
    .meeting-effect .post {
        height: 250px;
        background-size: cover !important;
        background-position: center !important;
        transition: transform 0.5s ease;
    }
    .meeting-effect:hover .post {
        transform: scale(1.1);
    }
    .meeting-effect .background {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(255, 204, 102, 0.7);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
        z-index: 2;
    }
    .meeting-effect:hover .background {
        opacity: 1;
    }
    .meeting-effect h2 {
        color: #fff;
        text-transform: uppercase;
        font-weight: bold;
    }
</style>

<section class="banquet-hero mb-5">
    <div class="row m-0 align-items-center bg-dark text-white">
        <div class="col-lg-6 p-0">
            <img src="https://malibuhotel.com.vn/files/sites/70/meeting-3.jpg" class="img-fluid w-100" alt="Banquet Menu">
        </div>
        <div class="col-lg-6 p-5">
            <h6 class="text-uppercase mb-2" style="color: #FFCC66;">WELCOME TO LYLY HOTEL</h6>
            <h2 class="display-5 text-uppercase fw-bold mb-3">Banquet Menu</h2>
            <p class="lead">Sáng tạo - Sang trọng - Đẳng cấp.</p>
        </div>
    </div>
</section>

<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="font-regular text-uppercase">MEETINGS & EVENTS</h2>
        <h1 class="display-4 fw-bold py-3">CREATE MEMORABLE</h1>
        <p class="lead mx-auto" style="max-width: 800px;">
            Khách sạn LyLy cung cấp không gian hội nghị linh hoạt với sức chứa lên đến 450 khách. 
            Các phòng hội nghị lớn có thể chia nhỏ thành 3 phòng riêng biệt với hệ thống vách ngăn hiện đại.
            Hệ thống âm thanh ánh sáng đạt chuẩn quốc tế, màn hình LED hiện đại sẵn sàng đáp ứng mọi nhu cầu của quý khách.
        </p>
    </div>

    <div class="row g-4">
        <!-- Hội thảo -->
        <div class="col-md-4">
            <div class="meeting-effect mb-3">
                <div class="background"><h2>Xem chi tiết</h2></div>
                <div class="post" style="background: url('https://malibuhotel.com.vn/files/sites/70/meeting-1.jpg');"></div>
            </div>
            <h3 class="text-uppercase mt-3">Hội thảo</h3>
            <p>Không gian chuyên nghiệp cho các buổi thảo luận và đào tạo.</p>
            <ul class="small text-muted">
                <li>Hơn 20,000 feet vuông không gian linh hoạt</li>
                <li>Công nghệ nghe nhìn tiên tiến</li>
                <li>Thực đơn tiệc tự chọn linh hoạt</li>
            </ul>
        </div>

        <!-- Hội nghị -->
        <div class="col-md-4">
            <div class="meeting-effect mb-3">
                <div class="background"><h2>Xem chi tiết</h2></div>
                <div class="post" style="background: url('https://malibuhotel.com.vn/files/sites/70/meeting-2.jpg');"></div>
            </div>
            <h3 class="text-uppercase mt-3">Hội nghị</h3>
            <p>Địa điểm lý tưởng cho các hội nghị quy mô lớn và quan trọng.</p>
            <ul class="small text-muted">
                <li>Phòng họp đa chức năng</li>
                <li>Đội ngũ hỗ trợ kỹ thuật tận tâm</li>
                <li>Dịch vụ ẩm thực cao cấp</li>
            </ul>
        </div>

        <!-- Sự kiện -->
        <div class="col-md-4">
            <div class="meeting-effect mb-3">
                <div class="background"><h2>Xem chi tiết</h2></div>
                <div class="post" style="background: url('https://malibuhotel.com.vn/files/sites/70/meeting-3.jpg');"></div>
            </div>
            <h3 class="text-uppercase mt-3">Sự kiện</h3>
            <p>Tổ chức những sự kiện đáng nhớ và rực rỡ nhất.</p>
            <ul class="small text-muted">
                <li>Không gian tiệc ngoài trời và trong nhà</li>
                <li>Trang trí theo yêu cầu</li>
                <li>Hệ thống đèn LED công suất lớn</li>
            </ul>
        </div>
    </div>
</div>
