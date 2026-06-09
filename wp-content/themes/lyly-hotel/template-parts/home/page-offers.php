<?php
/*
Template Name: Offers Page
*/
get_header();
?>

<style>
    .container-mg-post {
        max-width: 100%;
        padding-left: 0rem;
        padding-right: 0rem;
    }

    @media only screen and (min-width: 991.98px) {
        .delimiter-bottom, .pt-4 {
            padding-top: unset !important;
        }
        .mg-post {
            padding-top: unset !important;
            padding-bottom: unset !important;
        }
    }

    .div-effect {
        overflow: hidden;
        width: 100%;
    }

    .div-effect .post {
        transform: scale(1);
        transition: all 1s ease;
        padding-top: 100%; /* Creates a square aspect ratio */
        background-size: cover !important;
        background-position: center !important;
        background-repeat: no-repeat !important;
        height: 100%;
        width: 100%;
    }

    .div-effect:hover .post {
        transform: scale(1.1);
        transition: all 1s ease;
    }

    .div-effect .background {
        display: none;
    }

    .div-effect:hover .background {
        background-color: rgba(255, 255, 255, 0.4);
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
        z-index: 1;
        display: block;
        transition: all 0.5s ease;
    }

    .offer-title {
        color: var(--main-color-orange, #FFCC66);
    }
    
    .offer-box {
        margin-bottom: 2rem;
    }

    .offer-box a {
        text-decoration: none;
    }

    .offer-box h1 {
        font-size: 1.5rem;
        font-weight: 400;
        color: #212529;
        transition: color 0.3s ease;
    }

    .offer-box:hover h1 {
        color: var(--main-color-orange, #FFCC66);
    }
    
    .nav-tabs {
        border-bottom: 1px solid #dee2e6;
    }
    
    .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
        color: var(--main-color-orange, #FFCC66);
        background-color: transparent;
        border-color: transparent transparent var(--main-color-orange, #FFCC66);
        border-bottom-width: 3px;
    }
    
    .nav-tabs .nav-link {
        border: 1px solid transparent;
        border-top-left-radius: .25rem;
        border-top-right-radius: .25rem;
        color: #495057;
        font-weight: 600;
        text-transform: uppercase;
        padding: 0.5rem 1rem 1rem;
    }
    
    .nav-tabs .nav-link:hover {
        border-color: transparent;
        color: var(--main-color-orange, #FFCC66);
    }
</style>

<div class="delimiter-bottom" data-offset-top="#header-main" style="padding-top: 70px;"></div>
<div class="w-100 pt-4" style="margin-top: 150px;">
    <div class="container-fluid container-mg-post">
        <div class="row">
            <div class="col-md-12">
                <article class="mg-post">
                    <header>
                        <h1 class="mg-post-title d-none"><span>Offers</span></h1>
                    </header>
                    <div class="blog-content pb-5">
                        <section>
                            <div>
                                <div class="px-3 px-md-10 px-lg-24 pt-4 pt-md-0 pt-lg-5">
                                    <div class="row justify-content-center text-md-center mb-5">
                                        <h1 class="text-center pt-5 pb-3 display-5 text-uppercase font-regular">ƯU ĐÃI ĐẶC BIỆT TỪ LY LY</h1>
                                        <p class="text-center lead font-regular px-10" style="color: #666; max-width: 800px; margin: 0 auto;">
                                            Khám phá viên ngọc quý của Khách sạn Ly Ly với những gói nghỉ dưỡng độc quyền tại Vũng Tàu — những ưu đãi tốt nhất chỉ có tại Khách sạn Ly Ly.
                                        </p>
                                    </div>

                                    <div class="px-md-10 px-lg-24 justify-content-center pb-5 px-0">
                                        <ul class="nav nav-tabs d-flex justify-content-center gap-4 gap-md-8 py-2 mb-4" id="offerTabs" role="tablist">
                                            <li class="nav-item">
                                                <a aria-selected="true" class="nav-link active" data-bs-toggle="tab" href="#offers-tab" id="tab-offers" role="tab">
                                                    <h3 class="mb-0 fs-4">OFFERS</h3>
                                                </a>
                                            </li>
                                        </ul>

                                        <div class="tab-content" id="offerContent" style="width: 100%;">
                                            <div aria-labelledby="tab-offers" class="tab-pane fade active show" id="offers-tab" role="tabpanel">
                                                <div class="px-0 py-3">
                                                    <div class="row mt-4">
                                                        
                                                        <?php
                                                        $args = array(
                                                            'post_type' => 'lyly_offer',
                                                            'posts_per_page' => -1,
                                                            'meta_query' => array(
                                                                'relation' => 'OR',
                                                                array(
                                                                    'key' => '_lyly_offer_status',
                                                                    'value' => 'active',
                                                                    'compare' => '='
                                                                ),
                                                                array(
                                                                    'key' => '_lyly_offer_status',
                                                                    'compare' => 'NOT EXISTS'
                                                                )
                                                            )
                                                        );
                                                        $offers_query = new WP_Query($args);
                                                        if ( $offers_query->have_posts() ) :
                                                            while ( $offers_query->have_posts() ) : $offers_query->the_post();
                                                                $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
                                                                if (empty($thumbnail_url)) {
                                                                    $thumbnail_url = 'https://res.cloudinary.com/ddtv5nc3t/image/upload/v1779164959/gr6_fxbqst.jpg'; // fallback
                                                                }
                                                        ?>
                                                                <div class="col-12 col-md-4 offer-box">
                                                                    <a href="<?php the_permalink(); ?>">
                                                                        <div class="div-effect">
                                                                            <div class="position-relative">
                                                                                <div class="background"></div>
                                                                                <div class="post" style="background-image: url('<?php echo esc_url($thumbnail_url); ?>');"></div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="mt-3">
                                                                            <h1 class="py-2 text-uppercase mb-0"><?php the_title(); ?></h1>
                                                                        </div>
                                                                        <div class="lead text-black mt-2" style="font-size: 1rem; color: #555 !important;">
                                                                            <?php echo get_the_excerpt(); ?>
                                                                        </div>
                                                                    </a>
                                                                    <div class="py-2 my-3">
                                                                        <a href="<?php the_permalink(); ?>" class="font-bolder text-dark" style="text-decoration: underline; font-weight: 600;">CHI TIẾT</a>
                                                                    </div>
                                                                </div>
                                                        <?php 
                                                            endwhile; 
                                                            wp_reset_postdata();
                                                        else : 
                                                        ?>
                                                            <div class="col-12 text-center">
                                                                <p>Hiện tại chưa có ưu đãi nào.</p>
                                                            </div>
                                                        <?php endif; ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </article>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
