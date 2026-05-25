<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php wp_head(); ?>
    <style>
        :root {
            --primary-color: #0ba4ff;
            --main-font-family: 'Montserrat', sans-serif;
            --main-color-orange: #FFCC66;
            --bg-modal-checkrate: #16192C;
        }

        body {
            font-family: var(--main-font-family), sans-serif;
            margin: 0;
            padding: 0;
        }

        /* --- CẤU TRÚC GIỮ TỈ LỆ KHUNG VIDEO 16:9 HIỂN THỊ TRỌN VẸN NỘI DUNG --- */
        .hero-video {
            position: relative;
            background-color: black;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            /* Tự động tính toán chiều cao theo đúng tỉ lệ video 16:9 để không bị cắt lề trên/dưới */
            aspect-ratio: 16 / 9;
            height: auto;
        }

        .hero-video video,
        .hero-video img.bg-image {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 100%;
            height: 100%;
            transform: translate(-50%, -50%);
            /* 'cover' giúp ảnh/video tràn đầy khung hình, không bị khoảng trống đen */
            object-fit: cover;
            object-position: top;
            z-index: 0;
        }

        .overlay {
            background: rgba(0, 0, 0, 0.4);
            z-index: 1;
        }

        .hero-video .container {
            position: relative;
            z-index: 2;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <section class="hero-video">
        <img class="bg-image" src="https://res.cloudinary.com/ddtv5nc3t/image/upload/v1779432359/bgLyLy_wxotp1.jpg" alt="Ly Ly Hotel Background">
        <div class="overlay position-absolute top-0 start-0 w-100 h-100"></div>

        <div class="container px-0">
            <div class="text-center w-100 text-white">
                <img src="https://res.cloudinary.com/ddtv5nc3t/image/upload/v1778952363/Logo_cpnyib.png" style="width: 25%;"
                    onerror="this.src='https://res.cloudinary.com/ddtv5nc3t/image/upload/v1778952363/Logo_cpnyib.png'">
            </div>
        </div>
    </section>

</body>

</html>