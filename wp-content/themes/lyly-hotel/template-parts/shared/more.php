<?php
/**
 * Shared "Hơn Thế Nữa" section
 */
?>
<section class="more-section py-5" style="background-color: #f4f4f4;">
    <div class="bg-surface-secondary bg-overlap gallery-tag mt-md-5">
        <div class="px-3 px-lg-5 mx-auto" style="max-width: 1400px;">
            <div class="pt-5 pb-1">
                <h1 class="text-center pb-4 text-dark font-regular text-uppercase">HƠN THẾ NỮA</h1>

                <?php
                // Groups for Desktop Accordion
                $group1 = [
                    'https://malibuhotel.com.vn/files/sites/70/pool%208.png',
                    'https://malibuhotel.com.vn/files/sites/70/food%201.png',
                    'https://malibuhotel.com.vn/files/sites/70/pool%205.png',
                    'https://malibuhotel.com.vn/files/sites/70/pool%206.png',
                    'https://malibuhotel.com.vn/files/sites/70/pool%207.png'
                ];
                $group2 = [
                    'https://malibuhotel.com.vn/files/sites/70/pool%204.png',
                    'https://malibuhotel.com.vn/files/sites/70/pool%202.png',
                    'https://malibuhotel.com.vn/files/sites/70/massage%201.png',
                    'https://malibuhotel.com.vn/files/sites/70/DSC00316.jpg',
                    'https://malibuhotel.com.vn/files/sites/70/DSC00703.jpg'
                ];

                // All 10 Images for Mobile Swiper
                $all_images = array_merge($group1, $group2);
                ?>

                <!-- Desktop Carousel -->
                <div class="carousel slide d-md-block d-none pointer-event position-relative px-5"
                    data-bs-ride="carousel" id="sharedMoreCarousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active" data-bs-interval="4000">
                            <div class="contain-effect-img">
                                <?php foreach ($group1 as $img): ?>
                                    <div class="card">
                                        <img src="<?php echo $img; ?>" alt="Gallery Image"
                                            onerror="this.onerror=null; this.src='https://malibuhotel.com.vn/files/blog/46_1815/DELI-MALIBU-HOTEL_1__1.jpg'">
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="carousel-item" data-bs-interval="4000">
                            <div class="contain-effect-img">
                                <?php foreach ($group2 as $img): ?>
                                    <div class="card">
                                        <img src="<?php echo $img; ?>" alt="Gallery Image"
                                            onerror="this.onerror=null; this.src='https://malibuhotel.com.vn/files/blog/46_1815/DELI-MALIBU-HOTEL_1__1.jpg'">
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                    <div>
                        <button class="carousel-control-prev" data-bs-slide="prev"
                            data-bs-target="#sharedMoreCarousel" type="button" style="width: 50px; left: 0;">
                            <i class="bi bi-arrow-left fs-3 text-secondary"></i>
                        </button>
                        <button class="carousel-control-next" data-bs-slide="next"
                            data-bs-target="#sharedMoreCarousel" type="button" style="width: 50px; right: 0;">
                            <i class="bi bi-arrow-right fs-3 text-secondary"></i>
                        </button>
                    </div>
                </div>

                <!-- Mobile Swiper -->
                <div class="swiper-js-container d-block d-md-none position-relative">
                    <div class="swiper mobile-more-swiper">
                        <div class="swiper-wrapper">
                            <?php foreach ($all_images as $img): ?>
                                <div class="swiper-slide">
                                    <div class="w-100" style="aspect-ratio: 1/1;">
                                        <img src="<?php echo $img; ?>" class="img-fluid w-100 h-100 object-fit-cover"
                                            alt="Gallery Image"
                                            onerror="this.onerror=null; this.src='https://malibuhotel.com.vn/files/blog/46_1815/DELI-MALIBU-HOTEL_1__1.jpg'">
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="mobile-more-prev position-absolute top-50 start-0 translate-middle-y ms-2 z-3 cs-pointer bg-white rounded-circle d-flex justify-content-center align-items-center shadow-sm"
                        style="width: 30px; height: 30px; opacity: 0.8;">
                        <i class="bi bi-arrow-left fs-6 text-secondary"></i>
                    </div>
                    <div class="mobile-more-next position-absolute top-50 end-0 translate-middle-y me-2 z-3 cs-pointer bg-white rounded-circle d-flex justify-content-center align-items-center shadow-sm"
                        style="width: 30px; height: 30px; opacity: 0.8;">
                        <i class="bi bi-arrow-right fs-6 text-secondary"></i>
                    </div>
                </div>

                <!-- Newsletter block -->
                <div class="container mt-5 pt-3">
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-10 col-lg-8 text-center">
                            <p class="mb-5" style="font-size: 1.15rem; color: #212529;">Hãy kết nối với chúng tôi để luôn được cập nhật thông tin và chương trình ưu đãi mới nhất.</p>

                            <form class="newsletter-form text-start mx-auto" style="max-width: 600px;">
                                <div class="d-flex justify-content-between align-items-center border-bottom border-dark border-opacity-25 pb-2 mb-3">
                                    <input type="email" class="form-control border-0 bg-transparent px-2 shadow-none text-secondary"
                                        placeholder="Email" required style="outline: none; box-shadow: none; border-radius: 0;">
                                    <button type="submit" class="btn btn-link text-decoration-none text-secondary fw-semibold text-nowrap px-3 text-uppercase"
                                        style="letter-spacing: 0.5px;">ĐĂNG KÝ</button>
                                </div>
                                <div class="form-check mt-3 px-2 d-flex align-items-center gap-2">
                                    <input class="form-check-input rounded-0 border-secondary m-0" type="checkbox"
                                        value="" id="privacyCheck" required style="cursor: pointer; width: 16px; height: 16px;">
                                    <label class="form-check-label text-dark" for="privacyCheck" style="font-size: 0.95rem; cursor: pointer;">
                                        Tôi đồng ý với chính sách bảo mật và các điều khoản và điều kiện
                                    </label>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .contain-effect-img {
        display: flex;
        width: 100%;
        height: 350px;
    }
    .contain-effect-img .card {
        flex: 1;
        transition: flex 0.6s cubic-bezier(0.25, 1, 0.5, 1);
        overflow: hidden;
        cursor: pointer;
        border: none;
        border-radius: 0;
        margin: 0;
    }
    .contain-effect-img .card:hover {
        flex: 2.5;
    }
    .contain-effect-img .card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
    }
</style>
