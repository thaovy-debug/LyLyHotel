<!-- Categories / Swiper Section -->
<style>
    .categories-section {
        padding: 60px 0;
    }
    .malibu-category-item {
        position: relative;
        text-align: center;
    }
    .malibu-category-item .image-box {
        position: relative;
        overflow: hidden;
        aspect-ratio: 1 / 1;
    }
    .malibu-category-item .image-box .post-img {
        width: 100%;
        height: 100%;
        background-size: cover;
        background-position: center;
        transition: transform 0.5s ease;
    }
    .malibu-category-item:hover .image-box .post-img {
        transform: scale(1.1);
    }
    .malibu-category-item .overlay-box {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background-color: var(--main-color-orange, #FBC25E);
        opacity: 0;
        transition: opacity 0.4s ease;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: flex-start;
        padding: 30px;
    }
    .malibu-category-item:hover .overlay-box {
        opacity: 0.95;
    }
    .malibu-category-item .content-box-slide {
        text-align: left;
        transform: translateY(40px);
        transition: transform 0.4s ease, opacity 0.4s ease;
        opacity: 0;
    }
    .malibu-category-item:hover .content-box-slide {
        transform: translateY(0);
        opacity: 1;
    }
    .malibu-category-item .content-box-slide h2 {
        color: #fff;
        font-weight: 400;
        font-size: 30px;
        margin-bottom: 5px;
        text-transform: uppercase;
    }
    .malibu-category-item .content-box-slide h4 {
        color: #fff;
        font-size: 16px;
        text-transform: uppercase;
        font-weight: 300;
        margin: 0;
    }
    .malibu-category-item .title-box {
        padding: 20px 10px;
        background: #fff;
        position: relative;
    }
    /* Vertical line separator between items */
    .swiper-slide:not(:last-child) .malibu-category-item .title-box::after {
        content: '';
        position: absolute;
        right: 0;
        top: 25%;
        height: 50%;
        width: 1px;
        background-color: #dcdcdc;
    }
    .malibu-category-item .title-box h3 {
        font-size: 22px;
        font-weight: 300;
        color: #111;
        margin: 0;
        text-transform: uppercase;
    }
    .categories-container {
        padding: 0 50px;
        position: relative;
    }
    .categories-swiper {
        overflow: hidden;
    }
    .categories-section .swiper-button-next,
    .categories-section .swiper-button-prev {
        color: #000;
    }
    .categories-section .swiper-button-next:after,
    .categories-section .swiper-button-prev:after {
        font-size: 24px;
    }
    @media (max-width: 768px) {
        .categories-container {
            padding: 0 15px;
        }
        .swiper-slide:not(:last-child) .malibu-category-item .title-box::after {
            display: none;
        }
    }
</style>

<section class="categories-section bg-white">
    <div class="container-fluid px-lg-5">
        <h1 class="text-center pb-5 fw-light display-6 text-uppercase">CHỈ CÓ TẠI LYLY HOTEL</h1>
        
        <div class="categories-container">
            <div class="swiper categories-swiper">
                <div class="swiper-wrapper">
                    <?php
                    $items = [
                        ['title' => 'M GYM', 'img' => 'https://malibuhotel.com.vn/files/blog/46_1815/Asset_23@4x_1.png'],
                        ['title' => 'M SPA', 'img' => 'https://malibuhotel.com.vn/files/blog/46_1815/M-SPA-MALIBU_HOTEL_1.jpg'],
                        ['title' => 'BILLIARD & FOOSBALL', 'img' => 'https://malibuhotel.com.vn/files/blog/46_1815/Asset_51@4x_1.png'],
                        ['title' => 'ENTERTAINMENT', 'img' => 'https://malibuhotel.com.vn/files/blog/46_1815/ENTERTAINMENT.jpg'],
                        
                        ['title' => 'M POOL', 'img' => 'https://malibuhotel.com.vn/files/blog/46_1815/M-POOL-MALIBU-HOTEL_1__1.jpg'],
                        ['title' => 'CARINA RESTAURANT', 'img' => 'https://malibuhotel.com.vn/files/blog/46_1815/CARINA-MALIBU_HOTEL_1.jpg'],
                        ['title' => 'VELA RESTAURANT', 'img' => 'https://malibuhotel.com.vn/files/blog/46_1815/_THP4305-HDR_1.jpg'],
                        ['title' => 'THE LUX COFFEE', 'img' => 'https://malibuhotel.com.vn/files/blog/46_1815/Anh_1_4_1.jpg'],
                        
                        ['title' => 'GIFT SHOP', 'img' => 'https://malibuhotel.com.vn/files/blog/46_1815/DSC00288_1.jpg'],
                        ['title' => 'KID ZONE', 'img' => 'https://malibuhotel.com.vn/files/blog/46_1815/KID-ZONE-MALIBU_-_HOTEL_1.jpg'],
                        ['title' => 'CONFERENCE', 'img' => 'https://malibuhotel.com.vn/files/blog/46_1815/800x600_1__1.png'],
                        ['title' => 'PRIVATE LAUNDRY', 'img' => 'https://malibuhotel.com.vn/files/blog/46_1815/Hotel-Laundry-Services-101-Is-It-Worth-It-04012022-735x491.jpg.webp'],
                    ];
                    
                    foreach ($items as $item): ?>
                        <div class="swiper-slide">
                            <a href="#" class="text-decoration-none">
                                <div class="malibu-category-item">
                                    <div class="image-box">
                                        <div class="post-img" style="background-image: url('<?php echo $item['img']; ?>');"></div>
                                        <div class="overlay-box">
                                            <div class="content-box-slide">
                                                <h2><?php echo $item['title']; ?></h2>
                                                <h4>LEARN MORE</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="title-box">
                                        <h3><?php echo $item['title']; ?></h3>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <!-- Add Arrows -->
            <div class="swiper-button-next custom-next"></div>
            <div class="swiper-button-prev custom-prev"></div>
        </div>
    </div>
</section>
