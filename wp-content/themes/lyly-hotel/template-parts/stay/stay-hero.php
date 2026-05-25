<style>
    .stay-hero {
        margin-top: 80px; /* Offset for fixed header */
    }
    .header-main-bottom {
        background-color: var(--main-color-orange) !important;
        min-height: 400px;
    }
    .stay-hero .display-6 {
        font-size: 2.5rem;
        font-weight: 300;
        line-height: 1.2;
    }
    .stay-hero .fw-300 {
        font-weight: 300;
    }
    .header-bottom {
        background-color: var(--main-color-orange);
        cursor: pointer;
        z-index: 10;
        position: relative;
        margin-top: -30px; /* Overlap effect */
    }
    .header-bottom-date {
        border-right: 1px solid rgba(255,255,255,0.3);
        padding-right: 2rem;
    }
    .header-bottom-date:last-child {
        border-right: none;
    }
    .nav-checkrate-title {
        font-size: 0.9rem;
        font-weight: 600;
        margin-bottom: 0;
    }
    .nav-checkrate-month {
        font-size: 1.2rem;
        font-weight: 300;
    }
    .nav-checkrate-date {
        font-size: 2.5rem;
        font-weight: 300;
    }
    @media (max-width: 991.98px) {
        .header-bottom {
            margin-top: 0;
        }
        .header-bottom-date {
            border-right: none;
            border-bottom: 1px solid rgba(255,255,255,0.3);
            padding-bottom: 1rem;
            margin-bottom: 1rem;
            width: 100%;
            justify-content: space-between;
        }
    }
</style>

<section class="stay-hero">
    <div class="container-fluid p-0">
        <div class="row g-0 text-md-start align-items-center header-main-bottom">
            <div class="col-lg-6 p-0">
                <img alt="LyLy Hotel Stay" class="d-block w-100" src="https://res.cloudinary.com/ddtv5nc3t/image/upload/v1779432359/bgLyLy_wxotp1.jpg" style="object-fit: cover; height: 100%; min-height: 400px;">
            </div>
            <div class="col-lg-6 p-0">
                <div class="px-5 py-5 px-md-10 py-md-10 text-white">
                    <div class="fw-300">
                        <span class="h2 text-white">KHÁCH SẠN LYLY</span><br>
                        <span class="display-6 text-white text-uppercase">Dịch vụ lưu trú</span>
                        <p class="lead mt-3">Thoải mái - Tiện Nghi</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="header-bottom d-none d-lg-block w-100 py-3 shadow-sm">
            <div class="container" data-bs-target="#checkrateFormModal" data-bs-toggle="modal">
                <div class="d-flex justify-content-center gap-5 align-items-center text-white" id="checkRateLayout">
                    <div class="d-flex gap-3 align-items-center header-bottom-date checkin">
                        <div class="text-end">
                            <div class="nav-checkrate-title">NGÀY ĐẾN</div>
                            <div class="nav-checkrate-month">Tháng 5</div>
                        </div>
                        <div class="nav-checkrate-date">13</div>
                    </div>

                    <div class="d-flex gap-3 align-items-center header-bottom-date checkout">
                        <div class="text-end">
                            <div class="nav-checkrate-title">NGÀY ĐI</div>
                            <div class="nav-checkrate-month">Tháng 5</div>
                        </div>
                        <div class="nav-checkrate-date">15</div>
                    </div>

                    <div class="d-flex gap-3 align-items-center header-bottom-date adult">
                        <div class="text-end">
                            <div class="nav-checkrate-title">KHÁCH</div>
                        </div>
                        <div class="nav-checkrate-adult nav-checkrate-date">1</div>
                    </div>

                    <div class="ms-lg-4">
                        <h3 class="mb-0 fw-bold">ĐẶT BÂY GIỜ</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
