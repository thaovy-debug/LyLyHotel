<style>
    .stay-hero {
        margin-top: 100px;
        /* Offset for fixed header */
    }

    .header-main-bottom {
        background-color: var(--main-color-orange) !important;
    }

    .stay-hero .display-6 {
        font-size: 2.5rem;
        font-weight: 300;
        line-height: 1.2;
    }

    .stay-hero .fw-300 {
        font-weight: 300;
    }
</style>

<section class="stay-hero">
    <div class="container-fluid p-0">
        <div class="row g-0 text-md-start align-items-stretch header-main-bottom">
            <div class="col-lg-6 p-0">
                <?php
                // Determine hero image based on selected branch
                $hero_img = 'https://res.cloudinary.com/ddtv5nc3t/image/upload/v1779432359/bgLyLy_wxotp1.jpg'; // default
                $branch_id = isset($_GET['branch']) ? intval($_GET['branch']) : 0;
                if ($branch_id > 0) {
                    $branch = get_term($branch_id, 'lyly_branch');
                    if ($branch && !is_wp_error($branch)) {
                        $slug_lower = strtolower($branch->slug);
                        $name_lower = mb_strtolower($branch->name, 'UTF-8');
                        if (
                            strpos($slug_lower, '2') !== false ||
                            strpos($slug_lower, 'an-lac') !== false ||
                            strpos($slug_lower, 'cn2') !== false ||
                            strpos($name_lower, '2') !== false ||
                            strpos($name_lower, 'an lạc') !== false ||
                            strpos($name_lower, 'cn2') !== false
                        ) {
                            // Chi nhánh 2 - LY LY HOTEL 2
                            $hero_img = 'https://res.cloudinary.com/ddtv5nc3t/image/upload/v1779432359/bgLyLy_wxotp1.jpg';
                        } else {
                            // Chi nhánh 1 - LY LY HOTEL
                            $hero_img = 'https://res.cloudinary.com/ddtv5nc3t/image/upload/v1779164959/gr6_fxbqst.jpg';
                        }
                    }
                }
                ?>
                <img alt="LyLy Hotel Stay" class="d-block w-100"
                    src="<?php echo esc_url($hero_img); ?>">
            </div>
            <div class="col-lg-6 p-0">
                <div class="px-5 py-5 px-md-10 py-md-10 text-white d-flex align-items-center" style="min-height: 100%;">
                    <div class="fw-300">
                        <span class="h2 text-white">KHÁCH SẠN LYLY</span><br>
                        <span class="display-6 text-white text-uppercase">Dịch vụ lưu trú</span>
                        <p class="lead mt-3">Thoải mái - Tiện Nghi</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>