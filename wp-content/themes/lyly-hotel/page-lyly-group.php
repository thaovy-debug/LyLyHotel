<?php
/**
 * Template Name: Ly Ly Group Page
 */
get_header();
?>

<style>
    .lyly-group-container {
        padding-top: 180px;
        /* Tăng thêm khoảng cách để tránh bị che */
        padding-bottom: 80px;
        background-color: #fff;
        min-height: 60vh;
    }

    .group-header {
        text-align: center;
        margin-bottom: 60px;
    }

    .group-header h1 {
        font-family: 'Montserrat', sans-serif;
        font-weight: 500;
        font-size: 3.5rem;
        letter-spacing: 2px;
        color: #000;
        margin-bottom: 15px;
        text-transform: uppercase;
    }

    .group-header p {
        font-size: 1.1rem;
        color: #333;
        font-weight: 400;
    }

    .group-item {
        margin-bottom: 40px;
        transition: transform 0.3s ease;
    }

    .group-item:hover {
        transform: translateY(-10px);
    }

    .group-image-wrapper {
        position: relative;
        overflow: hidden;
        margin-bottom: 20px;
        aspect-ratio: 4 / 3;
    }

    .group-image-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .group-item:hover .group-image-wrapper img {
        transform: scale(1.1);
    }

    .group-content h3 {
        font-size: 1.5rem;
        font-weight: 600;
        color: #000;
        margin-bottom: 10px;
        text-transform: uppercase;
        line-height: 1.2;
    }

    .group-content p {
        color: #666;
        font-size: 1rem;
        margin-bottom: 15px;
    }

    .group-link {
        color: #000;
        text-decoration: none;
        font-weight: 700;
        font-size: 0.9rem;
        text-transform: uppercase;
        display: inline-flex;
        align-items: center;
        letter-spacing: 1px;
    }

    .group-link:hover {
        color: #FFCC66;
    }

    @media (max-width: 768px) {
        .group-header h1 {
            font-size: 2.5rem;
        }

        .lyly-group-container {
            padding-top: 120px;
        }
    }
</style>

<div class="lyly-group-container">
    <div class="container px-lg-5">
        <div class="group-header">
            <h1>LY LY GROUP</h1>
            <p>Các sản phẩm chất lượng khác của Ly Ly Hotel.</p>
        </div>

        <div class="row justify-content-center">
            <!-- Item 1 -->
            <div class="col-md-6 col-lg-4">
                <div class="group-item">
                    <div class="group-image-wrapper">
                        <img src="https://res.cloudinary.com/ddtv5nc3t/image/upload/v1779164959/gr6_fxbqst.jpg"
                            alt="Ly Ly Hotel">
                    </div>
                    <div class="group-content">
                        <h3>Ly Ly Hotel</h3>
                        <p>110-112 Đường Song Hành, Phường Bình Phú, TP. Hồ Chí Minh</p>

                        <a href="<?php echo site_url('/lyly-hotel-1'); ?>" class="group-link">Xem chi tiết →</a>
                    </div>
                </div>
            </div>

            <!-- Item 2 -->
            <div class="col-md-6 col-lg-4">
                <div class="group-item">
                    <div class="group-image-wrapper">
                        <img src="https://res.cloudinary.com/ddtv5nc3t/image/upload/v1779164815/gr5_ypj5re.jpg"
                            alt="Ly Ly Hotel 2">
                    </div>
                    <div class="group-content">
                        <h3>Ly Ly Hotel 2</h3>
                        <p>344A Đường Số 1, Phường An Lạc , TP. Hồ Chí Minh</p>
                        <a href="<?php echo site_url('/lyly-hotel-2'); ?>" class="group-link">Xem chi tiết →</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
