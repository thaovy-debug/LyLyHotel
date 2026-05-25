<?php
/**
 * Template Part: Ly Ly Group
 */
?>

<style>
    .lyly-group-container {
        padding-top: 150px;
        padding-bottom: 80px;
        background-color: #fff;
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

    .group-link::after {
        content: "\f061";
        /* FontAwesome right arrow */
        font-family: "Font Awesome 5 Free";
        font-weight: 900;
        margin-left: 8px;
        font-size: 0.8rem;
    }

    .group-link:hover {
        color: var(--main-color-orange);
    }

    @media (max-width: 768px) {
        .group-header h1 {
            font-size: 2.5rem;
        }
        .lyly-group-container {
            padding-top: 100px;
        }
    }
</style>

<div class="lyly-group-container">
    <div class="container px-lg-5">
        <div class="group-header">
            <h1>LY LY GROUP</h1>
            <p>Các sản phẩm chất lượng khác của Ly Ly Hotel.</p>
        </div>

        <div class="row">
            <!-- Item 1 -->
            <div class="col-md-6 col-lg-3">
                <div class="group-item">
                    <div class="group-image-wrapper">
                        <img src="https://res.cloudinary.com/ddtv5nc3t/image/upload/v1779164959/gr6_fxbqst.jpg" alt="Ly Ly House">
                    </div>
                    <div class="group-content">
                        <h3>LY LY HOUSE</h3>
                        <p>The Ly Ly House</p>
                        <a href="#" class="group-link">GET DETAILS</a>
                    </div>
                </div>
            </div>

            <!-- Item 2 -->
            <div class="col-md-6 col-lg-3">
                <div class="group-item">
                    <div class="group-image-wrapper">
                        <img src="https://res.cloudinary.com/ddtv5nc3t/image/upload/v1779164815/gr5_ypj5re.jpg" alt="Ly Ly Hotel Sài Gòn">
                    </div>
                    <div class="group-content">
                        <h3>LY LY HOTEL SÀI GÒN</h3>
                        <p>The Ly Ly Hotel Sài Gòn</p>
                        <a href="#" class="group-link">GET DETAILS</a>
                    </div>
                </div>
            </div>

            <!-- Item 3 -->
            <div class="col-md-6 col-lg-3">
                <div class="group-item">
                    <div class="group-image-wrapper">
                        <img src="https://res.cloudinary.com/ddtv5nc3t/image/upload/v1779432359/bgLyLy_wxotp1.jpg" alt="Ly Ly Villa">
                    </div>
                    <div class="group-content">
                        <h3>LY LY VILLA</h3>
                        <p>The Ly Ly Villa Long Cung</p>
                        <a href="#" class="group-link">GET DETAILS</a>
                    </div>
                </div>
            </div>

            <!-- Item 4 -->
            <div class="col-md-6 col-lg-3">
                <div class="group-item">
                    <div class="group-image-wrapper">
                        <img src="https://res.cloudinary.com/ddtv5nc3t/image/upload/v1779164959/gr6_fxbqst.jpg" alt="Sanctuary Villa Hồ Tràm">
                    </div>
                    <div class="group-content">
                        <h3>SANCTUARY VILLA HỒ TRÀM</h3>
                        <p>Sanctuary Villa Hồ Tràm</p>
                        <a href="#" class="group-link">GET DETAILS</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
