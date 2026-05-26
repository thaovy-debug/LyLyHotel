<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<?php
if (!function_exists('lyly_get_language_switch_url')) {
    function lyly_get_language_switch_url($target_lang) {
        if (class_exists('TRP_Translate_Press')) {
            $trp = TRP_Translate_Press::get_trp_instance();
            $url_converter = $trp->get_component("url_converter");
            if (method_exists($url_converter, 'get_url_for_language')) {
                $switch_url = $url_converter->get_url_for_language($target_lang);
                if (strpos($switch_url, '#TRPLINKPROCESSED') === false) {
                    $switch_url .= '#TRPLINKPROCESSED';
                }
                return $switch_url;
            }
        }

        $current_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        
        // Strip any existing hash first to avoid duplicates
        $current_url_parts = explode('#', $current_url);
        $current_url = $current_url_parts[0];
        
        if ($target_lang === 'vi') {
            // Translate from EN to VI: Remove the /en/ path case-insensitively
            $switch_url = preg_replace('/\/en(\/|$)/i', '/', $current_url);
        } else {
            // Translate from VI to EN: Insert /en/ after the /lylyhotel/ folder case-insensitively
            if (preg_match('/\/lylyhotel(\/|$)/i', $current_url, $matches)) {
                $subdirectory = $matches[0];
                $replacement = (substr($subdirectory, -1) === '/') ? substr($subdirectory, 0, -1) . '/en/' : $subdirectory . '/en/';
                $switch_url = str_ireplace($subdirectory, $replacement, $current_url);
            } else {
                $switch_url = $current_url;
            }
        }
        
        // Append #TRPLINKPROCESSED to bypass TranslatePress URL rewriting completely!
        return $switch_url . '#TRPLINKPROCESSED';
    }
}

if (!function_exists('lyly_get_lang_info')) {
    function lyly_get_lang_info($code) {
        $lang_details = array(
            'vi' => array('label' => 'Tiếng Việt', 'short' => 'VI', 'flag' => '🇻🇳'),
            'vi_vn' => array('label' => 'Tiếng Việt', 'short' => 'VI', 'flag' => '🇻🇳'),
            'en_us' => array('label' => 'English', 'short' => 'EN', 'flag' => '🇬🇧'),
            'en_gb' => array('label' => 'English', 'short' => 'EN', 'flag' => '🇬🇧'),
            'en' => array('label' => 'English', 'short' => 'EN', 'flag' => '🇬🇧'),
            'zh_cn' => array('label' => '中文', 'short' => 'ZH', 'flag' => '🇨🇳'),
            'zh_tw' => array('label' => '中文', 'short' => 'ZH', 'flag' => '🇨🇳'),
            'zh' => array('label' => '中文', 'short' => 'ZH', 'flag' => '🇨🇳'),
        );
        $code_lower = strtolower($code);
        if (isset($lang_details[$code_lower])) {
            return $lang_details[$code_lower];
        }
        // Fallback
        $short = strtoupper(substr($code, 0, 2));
        return array('label' => $code, 'short' => $short, 'flag' => '');
    }
}
?>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php wp_head(); ?>
    <style>
        :root {
            --primary-color: #0ba4ff;
            --primary-gradient-color: #0ba4ff;
            --secondary-color: #FFCC66;
            --secondary-gradient-color: #ff4704;
            --main-bg-color: #0ba4ff;
            --main-header-bg-color: #282828;
            --main-top-header-bg-color: #282828;
            --main-top-header-txt-color: #000000;
            --main-footer-bg-color: #0ba4ff;
            --main-font-family: 'Montserrat', sans-serif;
            --config-bg-color: #0e2b4c;
            --config-txt-color: #000;
            --main-header-bg-gradient-color: #282828;
            --main-header-txt-color: #ffffff;
            --main-header-font-family: 'Roboto', sans-serif;
            --main-footer-txt-color: #000;
            --main-body-txt-color: #000;
            --x-body-font-family: 'Montserrat', sans-serif;
            --x-body-color: #000;
            --x-dark-rgb: #0ba4ff;
            --main-color-orange: #FFCC66;
            --bg-modal-checkrate: #16192C;
            --header-height: 100px;
        }

        body {
            font-family: var(--main-font-family), sans-serif;
            color: var(--main-body-txt-color);
            margin: 0;
            padding: 0;
        }

        .header-transparent {
            background-color: transparent !important;
        }

        /* --- NAVBAR ĐÃ ĐƯỢC TỐI ƯU --- */
        .navbar-main {
            padding: 0 !important;
            transition: all 0.5s ease;
            height: var(--header-height) !important;
        }

        .navbar-main .container-fluid {
            height: 100% !important;
            position: relative;
            display: flex !important;
            align-items: center !important;
        }

        /* Nút Đặt Phòng */
        .btn-book-now-header {
            background-color: var(--main-color-orange) !important;
            color: #000 !important;
            font-weight: 700 !important;
            padding: 10px 25px !important;
            border-radius: 4px;
            text-transform: uppercase;
            font-size: 13px !important;
            transition: all 0.3s ease;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid var(--main-color-orange) !important;
            white-space: nowrap !important;
        }

        .btn-book-now-header:hover {
            background-color: transparent !important;
            color: var(--main-color-orange) !important;
        }

        .navbar-nav .nav-item {
            display: flex;
            align-items: center;
            height: 100%;
        }

        /* Nav Link căn dọc bằng padding */
        .nav-link {
            color: white !important;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 13px !important;
            position: relative;
            padding: 38px 15px !important;
            margin: 0 !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            line-height: normal !important;
            z-index: 1005;
            text-decoration: none;
            white-space: nowrap !important;
        }

        .nav-link:hover {
            color: var(--main-color-orange) !important;
        }

        /* GIẢI PHÁP ĐÁNH LỪA BOOTSTRAP BẰNG CSS GIẢ PHỦ TRÊN DESKTOP */
        @media (min-width: 992px) {
            .custom-mega-menu {
                position: relative !important;
            }

            .custom-mega-menu>.nav-link::after {
                content: "";
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                z-index: 99999 !important;
                /* Đè lên hoàn toàn tầng chặn click của Bootstrap */
                cursor: pointer;
            }
        }

        /* Mega Dropdown Styles */
        .dropdown {
            position: static !important;
        }

        .nav-item.dropdown:hover>.dropdown-menu {
            display: flex !important;
            visibility: visible !important;
            opacity: 1 !important;
        }

        .navbar-collapse .dropdown-menu {
            display: none;
            visibility: hidden;
            opacity: 0;
            position: absolute;
            left: 0;
            right: 0;
            top: 100%;
            width: 100vw;
            background: white !important;
            border: none;
            border-radius: 0;
            padding: 3rem 5% !important;
            margin-top: 0;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            justify-content: center;
            align-items: flex-start !important;
            gap: 20px;
            flex-wrap: wrap !important;
            z-index: 9998 !important;
            /* Thấp hơn lớp phủ click một chút */
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }

        .dropdown-menu::before {
            content: "";
            position: absolute;
            top: -100px;
            left: 0;
            width: 100%;
            height: 100px;
            background: transparent;
            z-index: -1;
        }

        .dropdown-menu li {
            width: 220px;
            list-style: none;
            text-align: center;
            flex-shrink: 0;
        }

        .dropdown-menu .box-img {
            overflow: hidden;
            width: 100%;
            margin-bottom: 1rem;
        }

        .dropdown-menu .box-img img {
            width: 100%;
            height: 140px;
            display: block;
            object-fit: cover;
            transition: transform 1s ease;
        }

        .dropdown-menu .image {
            width: 100%;
            height: 100%;
            background-position: center;
            background-size: cover;
            transition: transform 1s ease;
        }

        .dropdown-menu li:hover .image,
        .dropdown-menu li:hover .box-img img {
            transform: scale(1.1);
        }

        .dropdown-menu h4 {
            font-size: 14px;
            font-weight: 400;
        }

        .dropdown-menu h4 a {
            text-decoration: none;
            color: var(--main-color-orange) !important;
            position: relative;
        }

        .dropdown-menu h4 a span::after {
            content: '';
            width: 0;
            position: absolute;
            left: 50%;
            background-color: var(--main-color-orange);
            height: 1px;
            transition: width 0.5s;
            transform: translateX(-50%);
            bottom: -2px;
        }

        .dropdown-menu li:hover h4 a span::after {
            width: 100%;
        }

        .room-links-sub a:hover {
            color: var(--main-color-orange) !important;
        }

        /* Utils */
        .booking-now {
            background-color: var(--main-color-orange) !important;
            z-index: 1000;
            transition: transform 0.4s ease;
        }

        header.header:has(.nav-item.dropdown:hover) .booking-now {
            transform: translateY(240px);
        }

        .btn-open-checkrate {
            border-radius: 0px !important;
            padding-top: 20px;
            padding-bottom: 20px;
            background-color: transparent;
            color: #fff;
            border: none;
            width: 100%;
        }

        .logo-top-main img {
            width: 80px;
        }

        header.header {
            transition: background-color 0.5s ease;
        }

        header.header:hover,
        header.header:not(.header-transparent) {
            background-color: white !important;
        }

        header.header:hover .nav-link,
        header.header:not(.header-transparent) .nav-link {
            color: var(--main-color-orange) !important;
        }

        @media (min-width: 992px) {
            .navbar-collapse {
                display: flex !important;
                align-items: center !important;
                justify-content: space-between;
                height: 100% !important;
            }

            .header-left {
                flex: 1 1 0% !important;
                min-width: 0 !important;
                display: flex !important;
                align-items: center !important;
            }

            .header-center {
                flex: 0 0 auto !important;
                display: flex !important;
                justify-content: center !important;
            }

            .header-right {
                flex: 1 1 0% !important;
                min-width: 0 !important;
                display: flex !important;
                justify-content: flex-end !important;
                align-items: center !important;
            }

            .header-right .navbar-nav {
                gap: 12px !important;
            }

            header.header .nav-link {
                padding-left: 8px !important;
                padding-right: 8px !important;
            }

            .header-right .btn-book-now-header {
                padding: 10px 15px !important;
            }

            .navbar-collapse>.navbar-nav {
                flex: 1;
                margin: 0 !important;
                height: 100% !important;
                display: flex !important;
                align-items: center !important;
            }

            .navbar-nav.me-auto {
                display: flex !important;
                justify-content: flex-start;
                align-items: center !important;
                height: 100% !important;
            }

            .navbar-nav.ms-auto {
                display: flex !important;
                justify-content: flex-end;
                align-items: center !important;
                height: 100% !important;
                margin-bottom: 0 !important;
            }

            .logo-centered {
                position: absolute;
                left: 50%;
                top: 50%;
                transform: translate(-50%, -50%);
                z-index: 10;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
                height: 100% !important;
                margin: 0 !important;
                line-height: 0 !important;
            }

            .navbar-collapse {
                overflow: visible !important;
            }
        }

        @media (max-width: 991.98px) {
            .navbar-brand {
                width: 50% !important;
            }

            .navbar-main {
                height: auto !important;
            }

            .nav-link {
                height: auto !important;
                padding: 15px !important;
                justify-content: flex-start !important;
                color: #333 !important;
            }

            .navbar-collapse .dropdown-menu {
                width: 100%;
                padding: 1rem !important;
                flex-direction: column;
                position: static !important;
                display: none;
                background: #f8f9fa !important;
                border: none;
                box-shadow: none;
                margin: 0;
            }

            .nav-item.dropdown.show .dropdown-menu {
                display: block !important;
            }

            .dropdown-menu li {
                width: 100% !important;
                margin-bottom: 20px;
                text-align: left !important;
            }
        }

        /* Hide dropdown images on mobile */
        @media (max-width: 767.98px) {
            .dropdown-menu .box-img {
                display: none !important;
            }
        }

        /* Tablet Portrait menu layout with images */
        @media (min-width: 768px) and (max-width: 991.98px) {
            .header-right .dropdown-menu {
                flex-direction: row !important;
                flex-wrap: wrap !important;
                justify-content: center !important;
                gap: 20px !important;
                padding: 20px !important;
            }
            .header-right .nav-item.dropdown.show .dropdown-menu {
                display: flex !important;
            }
            .header-right .dropdown-menu li {
                width: 220px !important;
                border-bottom: none !important;
                margin-bottom: 10px !important;
            }
            .header-right .dropdown-menu .box-img {
                display: block !important;
            }
        }

        .admin-bar header.header {
            top: 32px !important;
        }

        @media screen and (max-width: 782px) {
            .admin-bar header.header {
                top: 46px !important;
            }
        }

        /* ======================================================== */
        /* LUXURY MOBILE RESPONSIVE SIDE-MENU OFF-CANVAS            */
        /* ======================================================== */
        @media (max-width: 991.98px) {
            /* Keep brand and toggle positioned on opposite ends */
            .navbar-main .container-fluid {
                display: flex !important;
                justify-content: space-between !important;
                align-items: center !important;
                width: 100% !important;
                padding-left: 20px !important;
                padding-right: 20px !important;
            }

            /* Custom gold hamburger icon */
            .navbar-toggler {
                border: none !important;
                padding: 8px !important;
                outline: none !important;
                box-shadow: none !important;
                background: transparent !important;
            }
            .navbar-toggler-icon {
                width: 26px !important;
                height: 26px !important;
                background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgb%28255, 204, 102%29' stroke-width='2.5' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e") !important;
            }

            /* Hide the redundant centered logo in menu panel */
            .header-center {
                display: none !important;
            }

            /* Main Side Panel styling (Slides out from the right, occupies 100% width as requested) */
            #navbar-main-collapse {
                position: fixed !important;
                top: 0 !important;
                right: 0 !important;
                width: 100vw !important; /* Full width */
                height: 100vh !important; /* Full height */
                background-color: #ffffff !important;
                z-index: 10600 !important; /* High z-index to overlay header */
                transform: translateX(100%) !important;
                transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1) !important;
                display: block !important;
                overflow-y: auto !important;
                padding: 0 !important; /* Content starts directly at the top with mobile-menu-header */
            }

            /* Smoothly handle Bootstrap height collapse overrides */
            #navbar-main-collapse.collapsing {
                position: fixed !important;
                top: 0 !important;
                right: 0 !important;
                width: 100vw !important;
                height: 100vh !important;
                background-color: #ffffff !important;
                z-index: 10600 !important;
                transform: translateX(100%) !important;
                transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1) !important;
                display: block !important;
                overflow: hidden !important;
            }

            /* Open state */
            #navbar-main-collapse.show {
                transform: translateX(0) !important;
            }

            /* Mobile Menu Header inside the panel (Logo on left, Close button on right) */
            .mobile-menu-header {
                display: flex !important;
                justify-content: space-between !important;
                align-items: center !important;
                padding: 15px 20px !important;
                border-bottom: 1px solid #f2f2f2 !important;
                background-color: #ffffff !important;
                width: 100% !important;
            }

            /* Close Button inside menu panel (Red X) */
            .btn-close-menu {
                background: none !important;
                border: none !important;
                font-size: 26px !important;
                color: #ff3b30 !important; /* Solid red X as in screenshot */
                cursor: pointer !important;
                z-index: 10700 !important;
                padding: 5px !important;
                line-height: 1 !important;
                transition: transform 0.2s ease !important;
            }
            .btn-close-menu:hover {
                transform: scale(1.1);
            }

            /* Stack sections vertically in side menu */
            .navbar-collapse > div:not(.mobile-menu-header) {
                flex-direction: column !important;
                align-items: stretch !important;
                margin-top: 0 !important;
            }

            /* Hide the default language switcher in collapse menu */
            .header-left {
                display: none !important;
            }

            /* Menu Items Navigation styling - Centered, divided by lines */
            .header-right {
                width: 100% !important;
                justify-content: center !important;
                padding: 20px 0 !important;
            }
            .header-right .navbar-nav {
                width: 100% !important;
                flex-direction: column !important;
                align-items: center !important; /* Centered menu links */
                gap: 0 !important; /* No gap, spacing is managed by link padding */
            }
            .header-right .nav-item {
                width: 100% !important;
                text-align: center !important;
                justify-content: center !important;
                margin: 0 !important;
                border-bottom: 1px solid #f2f2f2 !important; /* Horizontal separator line */
                flex-direction: column !important;
                align-items: center !important;
                height: auto !important;
            }
            .header-right .nav-item:last-child {
                border-bottom: none !important; /* No line under the last link/button */
            }
            .header-right .nav-link {
                width: 100% !important;
                display: inline-flex !important;
                justify-content: center !important;
                align-items: center !important;
                text-align: center !important;
                padding: 16px 0 !important; /* Tappable vertical padding */
                font-size: 15px !important;
                font-weight: 700 !important; /* Bold like in the screenshot */
                color: #111111 !important;
                letter-spacing: 0.5px !important;
                text-transform: uppercase !important;
                border-bottom: none !important;
                transition: color 0.2s ease !important;
            }
            .header-right .nav-link:hover {
                color: var(--main-color-orange) !important;
            }

            /* Animated chevron indicators on mobile submenus */
            .header-right .nav-link i {
                font-size: 11px !important;
                color: #555555 !important;
                transition: transform 0.3s ease !important;
            }
            .header-right .nav-item.dropdown.show .nav-link i {
                transform: rotate(180deg) !important;
            }

            /* Style drop-down menu inside sidebar (Accordian style, centered) */
            .header-right .dropdown-menu {
                width: 100% !important;
                background-color: #fafafa !important;
                border: none !important;
                border-radius: 0 !important;
                padding: 5px 0 !important;
                margin-top: 0 !important;
                box-shadow: none !important;
                display: none !important;
                position: static !important;
            }
            .header-right .nav-item.dropdown.show .dropdown-menu {
                display: block !important;
            }
            .header-right .dropdown-menu li {
                width: 100% !important;
                margin-bottom: 0 !important;
                text-align: center !important;
                border-bottom: 1px solid #f5f5f5 !important;
            }
            .header-right .dropdown-menu li:last-child {
                border-bottom: none !important;
            }
            .header-right .dropdown-menu h4 {
                margin: 0 !important;
                font-size: 13px !important;
            }
            .header-right .dropdown-menu h4 a {
                color: #555 !important;
                font-weight: 600 !important;
                display: block !important;
                padding: 12px 0 !important;
                text-decoration: none !important;
            }
            .header-right .dropdown-menu h4 a:hover {
                color: var(--main-color-orange) !important;
            }

            /* Style the premium Book Now button on mobile */
            .header-right .btn-book-now-header {
                width: 80% !important; /* Contained button */
                margin: 25px auto 10px auto !important; /* Centered button */
                padding: 12px !important;
                text-align: center !important;
                justify-content: center !important;
                font-size: 13px !important;
                display: flex !important;
            }

            /* Language Switcher at the bottom of the menu panel */
            .mobile-language-switcher {
                display: flex !important;
                justify-content: center !important;
                align-items: center !important;
                margin-top: 35px !important;
                margin-bottom: 35px !important;
            }
            .mobile-lang-link {
                display: inline-flex !important;
                align-items: center !important;
                justify-content: center !important;
                text-decoration: none !important;
                color: var(--main-color-orange) !important; /* Bold Gold */
                font-weight: 700 !important;
                font-size: 18px !important; /* Large, premium font like screenshot */
                background-color: transparent !important;
                border: none !important;
                padding: 10px 20px !important;
                transition: color 0.2s ease !important;
            }
            .mobile-lang-link:hover {
                color: #e5b358 !important;
            }

            /* Adjust for admin bar if logged in */
            .admin-bar #navbar-main-collapse {
                top: 32px !important;
                height: calc(100vh - 32px) !important;
            }
        }

        @media (max-width: 782px) {
            .admin-bar #navbar-main-collapse {
                top: 46px !important;
                height: calc(100vh - 46px) !important;
            }
        }

        /* Backdrop element styling */
        .menu-backdrop {
            display: none !important;
        }

        /* Prevent scrolling when menu is open */
        body.menu-open {
            overflow: hidden !important;
        }
    </style>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <header
        class="position-fixed w-100 top-0 header <?php echo (is_front_page() || is_home()) ? 'header-transparent' : 'header-solid'; ?>"
        style="z-index: 999;">
        <div class="header-top position-relative" id="header-main"
            style="z-index: 9999; background-color: transparent;">
            <nav class="navbar navbar-main navbar-expand-lg navbar-dark" id="navbar-main">
                <div class="container-fluid px-lg-5">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="navbar-brand d-lg-none">
                        <img src="https://res.cloudinary.com/ddtv5nc3t/image/upload/v1778952363/Logo_cpnyib.png"
                            style="width: 60px;">
                    </a>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbar-main-collapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbar-main-collapse">
                        <!-- Mobile Menu Header (Logo on left, Red Close button on right) -->
                        <div class="mobile-menu-header d-lg-none">
                            <a href="<?php echo esc_url(home_url('/')); ?>">
                                <img src="https://res.cloudinary.com/ddtv5nc3t/image/upload/v1778952363/Logo_cpnyib.png"
                                    style="width: 60px;">
                            </a>
                            <button type="button" class="btn-close-menu" aria-label="Close">
                                <i class="bi bi-x-lg"></i>
                            </button>
                        </div>
                        <div class="d-lg-flex justify-content-between align-items-center w-100 mt-3 mt-lg-0">
                            <div class="header-left d-flex align-items-center" style="flex: 1;">
                                <style>
                                    .trp-floating-switcher,
                                    #trp-floater-ls,
                                    [id^="trp-floater"],
                                    .trp-floater-ls-names {
                                        display: none !important;
                                        visibility: hidden !important;
                                        opacity: 0 !important;
                                        pointer-events: none !important;
                                    }
                                    /* Desktop Language Switcher (Transparent to Solid White on Hover) */
                                    @media (min-width: 992px) {
                                        /* Common Transitions */
                                        .header-left .trp-shortcode-switcher {
                                            transition: all 0.3s ease !important;
                                        }
                                        .header-left .trp-shortcode-switcher .trp-language-item-name {
                                            transition: color 0.3s ease !important;
                                        }
                                        .header-left .trp-shortcode-switcher .trp-shortcode-arrow path {
                                            transition: stroke 0.3s ease !important;
                                        }

                                        /* Default state on Transparent Header (Non-hovered header) */
                                        .header.header-transparent:not(:hover) .header-left .trp-shortcode-switcher {
                                            background: transparent !important;
                                            border: 1px solid transparent !important;
                                            box-shadow: none !important;
                                        }
                                        .header.header-transparent:not(:hover) .header-left .trp-shortcode-switcher .trp-language-item-name {
                                            color: #ffffff !important;
                                        }
                                        .header.header-transparent:not(:hover) .header-left .trp-shortcode-switcher .trp-shortcode-arrow path {
                                            stroke: #ffffff !important;
                                        }

                                        /* Hover state on Transparent Header OR Scrolled / Solid Header default state */
                                        .header.header-transparent:hover .header-left .trp-shortcode-switcher,
                                        .header:not(.header-transparent) .header-left .trp-shortcode-switcher {
                                            background: transparent !important;
                                            border: 1px solid transparent !important;
                                            box-shadow: none !important;
                                        }
                                        .header.header-transparent:hover .header-left .trp-shortcode-switcher .trp-language-item-name,
                                        .header:not(.header-transparent) .header-left .trp-shortcode-switcher .trp-language-item-name {
                                            color: var(--main-color-orange, #dfab49) !important;
                                        }
                                        .header.header-transparent:hover .header-left .trp-shortcode-switcher .trp-shortcode-arrow path,
                                        .header:not(.header-transparent) .header-left .trp-shortcode-switcher .trp-shortcode-arrow path {
                                            stroke: var(--main-color-orange, #dfab49) !important;
                                        }

                                        /* Hover state specifically on the switcher wrapper (on any header state) */
                                        .header-left .trp-shortcode-switcher__wrapper:hover .trp-shortcode-switcher {
                                            background: #ffffff !important;
                                            border: 1px solid rgba(20, 56, 82, 0.1) !important;
                                        }
                                        .header-left .trp-shortcode-switcher__wrapper:hover .trp-shortcode-switcher .trp-language-item-name {
                                            color: var(--main-color-orange, #dfab49) !important;
                                        }
                                        .header-left .trp-shortcode-switcher__wrapper:hover .trp-shortcode-switcher .trp-shortcode-arrow path {
                                            stroke: var(--main-color-orange, #dfab49) !important;
                                        }
                                        
                                        /* Options Dropdown list styling */
                                        .header-left .trp-shortcode-switcher .trp-switcher-dropdown-list {
                                            background: #ffffff !important;
                                            border: 1px solid rgba(20, 56, 82, 0.1) !important;
                                            border-top: none !important;
                                        }
                                        .header-left .trp-shortcode-switcher .trp-switcher-dropdown-list .trp-language-item .trp-language-item-name {
                                            color: #143852 !important;
                                        }
                                        .header-left .trp-shortcode-switcher .trp-switcher-dropdown-list .trp-language-item:hover {
                                            background: #f3f3f3 !important;
                                        }
                                        .header-left .trp-shortcode-switcher .trp-switcher-dropdown-list .trp-language-item:hover .trp-language-item-name {
                                            color: var(--main-color-orange, #dfab49) !important;
                                        }
                                    }
                                    
                                    /* Mobile Language Switcher Wrapper & Centering & Vertical Stacking */
                                    @media (max-width: 991.98px) {
                                        .mobile-language-switcher {
                                            display: flex !important;
                                            justify-content: center !important;
                                            align-items: center !important;
                                            text-align: center !important;
                                            width: 100% !important;
                                            margin-top: 25px !important;
                                            margin-bottom: 25px !important;
                                        }
                                        .mobile-language-switcher .trp-shortcode-switcher__wrapper {
                                            display: inline-block !important;
                                            width: 170px !important;
                                            margin: 0 auto !important;
                                            float: none !important;
                                            overflow: visible !important;
                                            position: relative !important;
                                        }
                                        .mobile-language-switcher .trp-shortcode-switcher {
                                            display: block !important;
                                            margin: 0 auto !important;
                                            float: none !important;
                                            width: auto !important;
                                            overflow: visible !important;
                                            background: transparent !important;
                                            border: none !important;
                                            box-shadow: none !important;
                                        }
                                        .mobile-language-switcher .trp-language-item-name {
                                            color: var(--main-color-orange, #dfab49) !important;
                                            text-transform: uppercase !important;
                                            font-weight: 500 !important;
                                            font-family: var(--main-font-family, 'Montserrat', sans-serif) !important;
                                            letter-spacing: 1px !important;
                                        }
                                        .mobile-language-switcher .trp-shortcode-arrow path {
                                            stroke: var(--main-color-orange, #dfab49) !important;
                                        }
                                        .mobile-language-switcher .trp-language-switcher-inner {
                                            display: flex !important;
                                            flex-direction: column !important;
                                            align-items: center !important;
                                            width: 100% !important;
                                            overflow: visible !important;
                                        }
                                        .mobile-language-switcher .trp-current-language-item__wrapper {
                                            display: flex !important;
                                            align-items: center !important;
                                            justify-content: flex-start !important;
                                            width: 100% !important;
                                            border: none !important;
                                            background: transparent !important;
                                            padding-left: 20px !important;
                                        }
                                        .mobile-language-switcher .trp-switcher-dropdown-list {
                                            width: 100% !important;
                                            margin: 5px 0 0 0 !important;
                                            padding: 0 !important;
                                            list-style: none !important;
                                            overflow: visible !important;
                                            max-height: none !important;
                                            background: #ffffff !important;
                                            border: 1px solid rgba(20, 56, 82, 0.1) !important;
                                            min-width: 150px !important;
                                            position: absolute !important;
                                            z-index: 1000 !important;
                                        }
                                        .mobile-language-switcher .trp-switcher-dropdown-list .trp-language-item {
                                            justify-content: flex-start !important;
                                            align-items: center !important;
                                            width: 100% !important;
                                        }
                                        .mobile-language-switcher .trp-switcher-dropdown-list .trp-language-item a {
                                            display: flex !important;
                                            justify-content: flex-start !important;
                                            align-items: center !important;
                                            width: 100% !important;
                                            padding-left: 20px !important;
                                        }
                                        .mobile-language-switcher .trp-switcher-dropdown-list .trp-language-item .trp-language-item-name {
                                            color: #143852 !important;
                                        }
                                        .mobile-language-switcher .trp-switcher-dropdown-list .trp-language-item:hover {
                                            background: #f3f3f3 !important;
                                        }
                                        .mobile-language-switcher .trp-switcher-dropdown-list .trp-language-item:hover .trp-language-item-name {
                                            color: var(--main-color-orange, #dfab49) !important;
                                        }
                                    }
                                </style>
                                <?php
                                if (class_exists('TRP_Translate_Press')) {
                                    echo do_shortcode('[language-switcher]');
                                }
                                ?>
                            </div>

                            <div class="header-center d-flex justify-content-center mx-lg-5">
                                <a href="<?php echo esc_url(home_url('/')); ?>">
                                    <img src="https://res.cloudinary.com/ddtv5nc3t/image/upload/v1778952363/Logo_cpnyib.png"
                                        style="width: 80px;">
                                </a>
                            </div>
                            <!-- CỘT PHẢI: Menu chính -->
                            <div class="header-right d-flex justify-content-end" style="flex: 1;">
                                <style>
                                    /* CƠ CHẾ HOVER THUẦN CSS - KHÔNG BỊ BOOTSTRAP CHẶN CLICK */
                                    @media (min-width: 992px) {
                                        .custom-hover-menu:hover > .dropdown-menu {
                                            display: flex !important;
                                            opacity: 1 !important;
                                            visibility: visible !important;
                                            margin-top: 0 !important;
                                        }
                                    }
                                </style>
                                <ul class="navbar-nav gap-4 align-items-center">
                                    <li class="nav-item custom-hover-menu dropdown">
                                        <a id="link-phong-nghi" class="nav-link" href="<?php echo site_url('/stay'); ?>" 
                                           style="cursor: pointer !important; position: relative; z-index: 999999 !important;">KHÁCH SẠN <i class="bi bi-chevron-down ms-1 d-lg-none" style="font-size: 11px;"></i></a>
                                        <ul class="dropdown-menu custom-mega-menu-content">
                                            <?php
                                            $branches = get_terms(array(
                                                'taxonomy' => 'lyly_branch',
                                                'hide_empty' => false,
                                            ));

                                            if (!empty($branches) && !is_wp_error($branches)):
                                                foreach ($branches as $branch):
                                                    $slug = $branch->slug;
                                                    $slug_lower = strtolower($slug);
                                                    $name_lower = mb_strtolower($branch->name, 'UTF-8');
                                                    if (
                                                        strpos($slug_lower, '2') !== false || 
                                                        strpos($slug_lower, 'an-lac') !== false || 
                                                        strpos($slug_lower, 'cn2') !== false || 
                                                        strpos($name_lower, '2') !== false || 
                                                        strpos($name_lower, 'an lạc') !== false || 
                                                        strpos($name_lower, 'cn 2') !== false ||
                                                        strpos($name_lower, 'cn2') !== false
                                                    ) {
                                                        $img_url = 'https://res.cloudinary.com/ddtv5nc3t/image/upload/v1779164815/gr5_ypj5re.jpg';
                                                    } elseif (
                                                        strpos($slug_lower, '1') !== false || 
                                                        strpos($slug_lower, 'binh-phu') !== false || 
                                                        strpos($slug_lower, 'cn1') !== false || 
                                                        strpos($slug_lower, 'lyly-hotel') !== false ||
                                                        strpos($slug_lower, 'ly-ly-hotel') !== false ||
                                                        strpos($name_lower, '1') !== false || 
                                                        strpos($name_lower, 'bình phú') !== false || 
                                                        strpos($name_lower, 'cn 1') !== false || 
                                                        strpos($name_lower, 'cn1') !== false ||
                                                        strpos($name_lower, 'ly ly hotel') !== false ||
                                                        strpos($name_lower, 'lyly hotel') !== false
                                                    ) {
                                                        $img_url = 'https://res.cloudinary.com/ddtv5nc3t/image/upload/v1779164959/gr6_fxbqst.jpg';
                                                    } else {
                                                        $img_url = 'https://res.cloudinary.com/ddtv5nc3t/image/upload/v1779432359/bgLyLy_wxotp1.jpg';
                                                    }
                                                    $link = site_url('/stay?branch=' . $branch->term_id);
                                                    ?>
                                                    <li>
                                                        <a href="<?php echo esc_url($link); ?>">
                                                            <div class="box-img">
                                                                <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($branch->name); ?>">
                                                            </div>
                                                        </a>
                                                        <h4 class="text-uppercase">
                                                            <a
                                                                href="<?php echo esc_url($link); ?>"><span><?php echo esc_html($branch->name); ?></span></a>
                                                        </h4>
                                                    </li>
                                                    <?php
                                                endforeach;
                                            endif;
                                            ?>
                                        </ul>
                                    </li>

                                    <li class="nav-item"><a class="nav-link"
                                            href="<?php echo site_url('/offers'); ?>">ƯU ĐÃI</a></li>
                                    <li class="nav-item"><a class="nav-link"
                                            href="<?php echo site_url('/gallery'); ?>">THƯ VIỆN ẢNH</a></li>

                                    <li class="nav-item dropdown">
                                        <a class="nav-link" style="cursor: pointer;">THÊM <i class="bi bi-chevron-down ms-1 d-lg-none" style="font-size: 11px;"></i></a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="<?php echo site_url('/about'); ?>">
                                                    <div class="box-img">
                                                        <img src="https://malibuhotel.com.vn/files/sites/site_70/site_70_header/about-header.jpg" alt="Giới thiệu">
                                                    </div>
                                                </a>
                                                <h4 class="text-uppercase"><a
                                                        href="<?php echo site_url('/about'); ?>"><span>Giới
                                                            thiệu</span></a></h4>
                                            </li>
                                            <li>
                                                <a href="<?php echo site_url('/faqs'); ?>">
                                                    <div class="box-img">
                                                        <img src="https://malibuhotel.com.vn/files/sites/site_70/site_70_header/faqs-header.jpg" alt="Câu hỏi thường gặp">
                                                    </div>
                                                </a>
                                                <h4 class="text-uppercase"><a
                                                        href="<?php echo site_url('/hotel-faqs'); ?>"><span>Câu hỏi
                                                            thường gặp</span></a></h4>
                                            </li>
                                            <li>
                                                <a href="<?php echo site_url('/contact'); ?>">
                                                    <div class="box-img">
                                                        <img src="https://malibuhotel.com.vn/files/sites/site_70/site_70_header/contact-header.jpg" alt="Liên hệ">
                                                    </div>
                                                </a>
                                                <h4 class="text-uppercase"><a
                                                        href="<?php echo site_url('/contact'); ?>"><span>Liên
                                                            hệ</span></a></h4>
                                            </li>
                                            <li>
                                                <a href="<?php echo site_url('/lyly-group'); ?>">
                                                    <div class="box-img">
                                                        <img src="https://res.cloudinary.com/ddtv5nc3t/image/upload/v1779162772/LyLyGr2_oqeglr.jpg" alt="Ly Ly Group" style="object-position: bottom;">
                                                    </div>
                                                </a>
                                                <h4 class="text-uppercase"><a
                                                        href="<?php echo site_url('/lyly-group'); ?>"><span>Ly Ly
                                                            Group</span></a></h4>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="nav-item">
                                        <a class="btn-book-now-header ms-lg-3" href="https://zalo.me/0913906650"
                                            target="_blank" rel="noopener noreferrer">LIÊN HỆ ĐẶT PHÒNG</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        
                        <!-- Dynamic Language Switcher at the bottom of the mobile menu -->
                        <div class="mobile-language-switcher d-lg-none">
                            <?php
                            if (class_exists('TRP_Translate_Press')) {
                                echo do_shortcode('[language-switcher]');
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <!-- Mobile Menu Backdrop -->
    <div class="menu-backdrop d-lg-none" id="menu-backdrop"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const collapseEl = document.getElementById('navbar-main-collapse');
            const backdrop = document.getElementById('menu-backdrop');
            const closeBtn = document.querySelector('.btn-close-menu');

            // Handle slide menu backdrop & body lock
            if (collapseEl) {
                collapseEl.addEventListener('show.bs.collapse', function () {
                    document.body.classList.add('menu-open');
                    if (backdrop) backdrop.classList.add('show');
                });
                
                collapseEl.addEventListener('hide.bs.collapse', function () {
                    document.body.classList.remove('menu-open');
                    if (backdrop) backdrop.classList.remove('show');
                });
            }

            // Close button click event
            if (closeBtn) {
                closeBtn.addEventListener('click', function () {
                    const toggler = document.querySelector('.navbar-toggler');
                    if (toggler && collapseEl.classList.contains('show')) {
                        toggler.click();
                    } else {
                        collapseEl.classList.remove('show');
                        document.body.classList.remove('menu-open');
                        if (backdrop) backdrop.classList.remove('show');
                    }
                });
            }

            // Backdrop click event
            if (backdrop) {
                backdrop.addEventListener('click', function () {
                    const toggler = document.querySelector('.navbar-toggler');
                    if (toggler && collapseEl.classList.contains('show')) {
                        toggler.click();
                    } else {
                        collapseEl.classList.remove('show');
                        document.body.classList.remove('menu-open');
                        backdrop.classList.remove('show');
                    }
                });
            }

            // Mobile dropdown toggle logic for submenus
            const mobileDropdowns = document.querySelectorAll('.header-right .nav-item.dropdown');
            mobileDropdowns.forEach(dropdown => {
                const link = dropdown.querySelector('.nav-link');
                if (link) {
                    link.addEventListener('click', function (e) {
                        if (window.innerWidth < 992) {
                            e.preventDefault();
                            e.stopPropagation();
                            
                            // Toggle self
                            const isShown = dropdown.classList.contains('show');
                            
                            // Close other mobile dropdowns first
                            mobileDropdowns.forEach(d => {
                                d.classList.remove('show');
                                const m = d.querySelector('.dropdown-menu');
                                if (m) m.style.setProperty('display', 'none', 'important');
                            });
                            
                            if (!isShown) {
                                dropdown.classList.add('show');
                                const menu = dropdown.querySelector('.dropdown-menu');
                                if (menu) {
                                    menu.style.setProperty('display', 'block', 'important');
                                }
                            }
                        }
                    });
                }
            });

            // Handle mobile dropdown toggle (legacy custom fallback support if needed)
            const toggles = document.querySelectorAll('.dropdown-toggle-custom');
            toggles.forEach(toggle => {
                toggle.addEventListener('click', function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    const parent = this.closest('.dropdown');
                    const menu = parent.querySelector('.dropdown-menu');
                    const icon = this.querySelector('i');

                    if (menu.style.display === 'block') {
                        menu.style.display = 'none';
                        icon.classList.replace('bi-chevron-up', 'bi-chevron-down');
                    } else {
                        menu.style.display = 'block';
                        icon.classList.replace('bi-chevron-down', 'bi-chevron-up');
                    }
                });
            });
        });
    </script>
</body>

</html>