<?php
/**
 * Template Part: Dine - Restaurant
 */
?>
<style>
    :root {
        --malibu-orange: #FFCC66;
        --dark-blue: #002d58;
    }

    .dine-header {
        padding: 80px 0 40px;
    }

    .dine-header h1 {
        font-family: "Times New Roman", Times, serif;
        font-weight: 300;
        letter-spacing: 2px;
        text-transform: uppercase;
        color: #333;
    }

    .malibu-dine-swiper {
        width: 100%;
        padding-bottom: 50px;
    }

    .malibu-dine-item {
        position: relative;
        overflow: hidden;
    }

    .malibu-dine-item .image-box {
        position: relative;
        width: 100%;
        height: 500px;
        overflow: hidden;
    }

    .malibu-dine-item .image-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.8s ease;
    }

    .malibu-dine-item:hover .image-box img {
        transform: scale(1.1);
    }

    .malibu-dine-item .overlay-box {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background-color: var(--malibu-orange);
        opacity: 0;
        transition: opacity 0.4s ease;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        padding: 20px;
        z-index: 2;
    }

    .malibu-dine-item:hover .overlay-box {
        opacity: 0.9;
    }

    .malibu-dine-item .overlay-box h2 {
        color: #fff;
        font-size: 2rem;
        margin-bottom: 15px;
        text-transform: uppercase;
    }

    .malibu-dine-item .overlay-box .learn-more {
        color: #fff;
        border: 1px solid #fff;
        padding: 8px 25px;
        text-transform: uppercase;
        font-size: 0.9rem;
        letter-spacing: 1px;
        text-decoration: none;
        transition: all 0.3s;
    }

    .malibu-dine-item .overlay-box .learn-more:hover {
        background: #fff;
        color: var(--malibu-orange);
    }

    .dine-title-footer {
        padding: 30px 0;
        border-top: 1px solid #eee;
        min-height: 120px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        background: #fff;
    }

    .dine-title-footer h3 {
        font-size: 1.8rem;
        letter-spacing: 1px;
        color: #333;
        margin: 0;
        font-weight: 400;
    }

    .swiper-button-next, .swiper-button-prev {
        color: #000;
        background: rgba(255,255,255,0.8);
        width: 40px;
        height: 40px;
        border-radius: 50%;
    }

    .swiper-button-next:after, .swiper-button-prev:after {
        font-size: 18px;
    }
</style>

<div class="dine-header">
    <div class="container text-center">
        <h1 class="display-4">NHÀ HÀNG TẠI KHÁCH SẠN LYLY</h1>
    </div>
</div>

<div class="container-fluid p-0">
    <div class="swiper malibu-dine-swiper">
        <div class="swiper-wrapper">
            <!-- Carina Restaurant -->
            <div class="swiper-slide">
                <div class="malibu-dine-item">
                    <div class="image-box">
                        <img src="https://malibuhotel.com.vn/files/blog/46_1815/CARINA-MALIBU_HOTEL_1.jpg" alt="Carina Restaurant">
                        <div class="overlay-box">
                            <h2>CARINA RESTAURANT</h2>
                            <a href="#" class="learn-more">LEARN MORE</a>
                        </div>
                    </div>
                    <div class="dine-title-footer">
                        <h3>CARINA<br>RESTAURANT</h3>
                    </div>
                </div>
            </div>

            <!-- Vela Restaurant -->
            <div class="swiper-slide">
                <div class="malibu-dine-item">
                    <div class="image-box">
                        <img src="https://malibuhotel.com.vn/files/blog/46_1815/_THP4305-HDR_1.jpg" alt="Vela Restaurant">
                        <div class="overlay-box">
                            <h2>VELA RESTAURANT</h2>
                            <a href="#" class="learn-more">LEARN MORE</a>
                        </div>
                    </div>
                    <div class="dine-title-footer">
                        <h3>VELA<br>RESTAURANT</h3>
                    </div>
                </div>
            </div>

            <!-- The Lux Coffee -->
            <div class="swiper-slide">
                <div class="malibu-dine-item">
                    <div class="image-box">
                        <img src="https://malibuhotel.com.vn/files/blog/46_1815/Anh_1_4_1.jpg" alt="The Lux Coffee">
                        <div class="overlay-box">
                            <h2>THE LUX COFFEE</h2>
                            <a href="#" class="learn-more">LEARN MORE</a>
                        </div>
                    </div>
                    <div class="dine-title-footer">
                        <h3>THE LUX COFFEE</h3>
                    </div>
                </div>
            </div>

            <!-- Pool Bar -->
            <div class="swiper-slide">
                <div class="malibu-dine-item">
                    <div class="image-box">
                        <img src="https://malibuhotel.com.vn/files/blog/46_1815/834-HDR-enhanced_1.png" alt="Pool Bar">
                        <div class="overlay-box">
                            <h2>POOL BAR</h2>
                            <a href="#" class="learn-more">LEARN MORE</a>
                        </div>
                    </div>
                    <div class="dine-title-footer">
                        <h3>POOL BAR</h3>
                    </div>
                </div>
            </div>
        </div>
        <!-- Add Arrows -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var dineSwiper = new Swiper('.malibu-dine-swiper', {
            slidesPerView: 1,
            spaceBetween: 0,
            loop: true,
            autoplay: {
                delay: 5000,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                768: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 4,
                }
            }
        });
    });
</script>
