<section class="offers-section bg-white py-5">
    <div class="container-fluid px-0">
        <h1 class="text-center font-regular display-6 text-uppercase mb-4">GÓI ƯU ĐÃI</h1>
        
        <p class="text-center font-regular px-3 mb-4" style="font-size: 18px;">
            Trải nghiệm LyLy Hotel với các gói kỳ nghỉ độc quyền của chúng tôi, những trải nghiệm đặc sắc và ưu đãi đặc biệt.
        </p>

        <div class="text-center mb-5">
            <a href="#" class="btn btn-outline-warning text-uppercase px-4 py-2" style="border-radius: 0; color: var(--main-color-orange); border-color: var(--main-color-orange); letter-spacing: 1px;">
                XEM THÊM
            </a>
        </div>

        <div class="offers-container position-relative">
            <div class="swiper offers-swiper">
                <div class="swiper-wrapper">
                    <?php
                    $base_offers = [
                        [
                            'link' => '#',
                            'img' => 'https://malibuhotel.com.vn/files/blog/46_1815/THAP_TAM_THANG.png',
                            'title' => 'Tháp Tam Thắng'
                        ],
                        [
                            'link' => '#',
                            'img' => 'https://malibuhotel.com.vn/files/blog/46_1815/HEALING_ESCAPE_PACKAGE_-_NEW.png',
                            'title' => 'Healing Escape'
                        ],
                        [
                            'link' => '#',
                            'img' => 'https://malibuhotel.com.vn/files/blog/46_1815/GOURMET_STAY_PACKAGE_-_NEW.png',
                            'title' => 'Gourmet Stay'
                        ]
                    ];
                    $offers = array_merge($base_offers, $base_offers);
                    
                    foreach ($offers as $offer): ?>
                        <div class="swiper-slide">
                            <a href="<?php echo $offer['link']; ?>" class="d-block text-decoration-none">
                                <div class="offer-item position-relative overflow-hidden">
                                    <img src="<?php echo $offer['img']; ?>" alt="<?php echo $offer['title']; ?>" class="w-100 img-fluid transition-transform" style="transition: transform 0.5s ease;">
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <!-- Navigation Arrows -->
            <div class="swiper-button-next offers-next" style="color: #000;"></div>
            <div class="swiper-button-prev offers-prev" style="color: #000;"></div>
        </div>
    </div>
</section>

<style>
    .offers-section {
        padding-top: 60px;
        padding-bottom: 60px;
    }
    .btn-outline-warning:hover {
        background-color: var(--main-color-orange);
        color: #fff !important;
    }
    .offer-item:hover img {
        transform: scale(1.05);
    }
    .offers-container {
        padding: 0 40px; /* Space for arrows */
    }
    @media (max-width: 768px) {
        .offers-container {
            padding: 0 15px;
        }
        .offers-next, .offers-prev {
            display: none !important;
        }
    }
</style>
