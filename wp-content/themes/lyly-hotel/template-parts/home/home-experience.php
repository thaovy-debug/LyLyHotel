<section class="experience-section py-5" style="background-color: #fcfcfc;">
    <div class="container py-lg-5">
        <h1 class="text-center mb-5 fw-light display-6 text-uppercase">ĐẾN VÀ TRẢI NGHIỆM</h1>
        
        <div class="row align-items-center mt-5">
            <!-- Left Side: Tabs -->
            <div class="col-12 col-md-6 position-relative pe-lg-5" style="z-index: 10;">
                <div class="experience-sidebar">
                    <div class="exp-accordion list-unstyled">
                        
                        <?php
                        $experiences = [
                            [
                                'id' => '1', 'title' => 'THỊ GIÁC', 
                                'img' => 'https://malibuhotel.com.vn/files/blog/46_1815/M-POOL-MALIBU-HOTEL_1__1.jpg', 
                                'desc' => 'Lấy cảm hứng từ kiến trúc Châu Âu sang trọng để thấy được vẻ đẹp từ nhiều thứ, đặc biệt là những công trình kiến trúc tinh tế do bàn tay con người tạo ra.',
                                'active' => true
                            ],
                            [
                                'id' => '2', 'title' => 'VỊ GIÁC', 
                                'img' => 'https://malibuhotel.com.vn/files/blog/46_1815/CARINA-MALIBU_HOTEL_1.jpg', 
                                'desc' => 'Thưởng thức sự bùng nổ trong hương vị của từng món ăn, thức uống được chế biến để thưởng thức hương vị tuyệt vời của các món ăn và đồ uống từ các đầu bếp chuyên nghiệp tại khách sạn.',
                                'active' => false
                            ],
                            [
                                'id' => '3', 'title' => 'KHƯỚU GIÁC', 
                                'img' => 'https://malibuhotel.com.vn/files/blog/46_1815/M-SPA-MALIBU_HOTEL_1.jpg', 
                                'desc' => 'Đánh thức mọi giác quan bằng mùi hương tinh tế của tinh dầu thiên nhiên, xua tan mọi mệt mỏi sau một ngày dài khám phá.',
                                'active' => false
                            ],
                            [
                                'id' => '4', 'title' => 'THÍNH GIÁC', 
                                'img' => 'https://malibuhotel.com.vn/files/blog/46_1815/ENTERTAINMENT.jpg', 
                                'desc' => 'Lắng nghe thanh âm êm dịu của tiếng sóng biển hòa quyện cùng bản nhạc du dương, tạo nên một không gian thư giãn hoàn hảo.',
                                'active' => false
                            ],
                            [
                                'id' => '5', 'title' => 'XÚC GIÁC', 
                                'img' => 'https://malibuhotel.com.vn/files/blog/46_1815/DSC00288_1.jpg', 
                                'desc' => 'Cảm nhận sự mềm mại từ những bộ chăn ga gối đệm cao cấp và sự chăm sóc tận tình tại dịch vụ Spa đẳng cấp của chúng tôi.',
                                'active' => false
                            ],
                        ];
                        
                        foreach ($experiences as $exp): ?>
                            <div class="exp-item mb-2">
                                <button class="nav-link w-100 p-0 text-start bg-transparent exp-tab <?php echo $exp['active'] ? 'active' : ''; ?>" 
                                        data-image="<?php echo $exp['img']; ?>" 
                                        type="button">
                                    <h3 class="w-100 text-uppercase d-flex justify-content-between align-items-center mb-0 py-3 exp-title gap-3" style="font-size: 18px; font-weight: 500;">
                                        <span><?php echo $exp['title']; ?></span>
                                        <i class="bi bi-arrow-down fs-5 arrow text-dark"></i>
                                    </h3>
                                </button>
                                <div class="exp-content <?php echo $exp['active'] ? 'show' : ''; ?>">
                                    <p class="mb-0 text-dark pt-2 pe-md-4" style="font-size: 16px; line-height: 1.6; font-style: italic;">
                                        <?php echo $exp['desc']; ?>
                                    </p>
                                </div>
                                <div class="wavy-line mt-3"></div>
                            </div>
                        <?php endforeach; ?>
                        
                    </div>
                </div>
            </div>

            <!-- Right Side: Images -->
            <div class="col-12 col-md-6 px-0 d-flex justify-content-center align-items-center position-relative mt-5 mt-md-0" style="z-index: 1;">
                <!-- Background Decorative Images -->
                <img class="img-fluid position-absolute d-none d-lg-block top-0 start-0 z-0" 
                     src="https://malibuhotel.com.vn/files/blog/46_1815/Asset_23@4x_1.png" 
                     style="width: 45%; transform: translate(-5%, -15%); object-fit: cover; opacity: 0.8; border-radius: 8px;">
                     
                <img class="img-fluid position-absolute d-none d-lg-block bottom-0 start-0 z-0" 
                     src="https://malibuhotel.com.vn/files/blog/46_1815/Anh_1_4_1.jpg" 
                     style="height: 45%; width: 45%; transform: translate(5%, 15%); object-fit: cover; opacity: 0.8; border-radius: 8px;">
                
                <!-- Main Active Image -->
                <div class="experience-image-wrapper z-1 bg-white p-2 p-md-3 shadow mx-auto position-relative" style="width: 75%; transition: all 0.4s ease;">
                    <img id="main-exp-image" class="img-fluid w-100 h-100 object-fit-cover" 
                         src="https://malibuhotel.com.vn/files/blog/46_1815/M-POOL-MALIBU-HOTEL_1__1.jpg" 
                         style="min-height: 350px; max-height: 450px; transition: opacity 0.3s ease;">
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .experience-sidebar .exp-tab {
        border: none;
        outline: none;
    }
    .experience-sidebar .exp-title {
        color: #2c3e50 !important;
        transition: color 0.3s ease;
    }
    .experience-sidebar .exp-item:hover .exp-title,
    .experience-sidebar .exp-tab.active .exp-title {
        color: var(--main-color-orange) !important;
    }
    .experience-sidebar .arrow {
        transition: transform 0.3s ease;
    }
    .experience-sidebar .exp-tab.active .arrow {
        transform: rotate(180deg);
    }
    .experience-sidebar .exp-content {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.4s ease, padding 0.4s ease, opacity 0.4s ease;
        opacity: 0;
    }
    .experience-sidebar .exp-content.show {
        max-height: 300px;
        padding-bottom: 20px;
        opacity: 1;
    }
    .experience-sidebar .wavy-line {
        height: 6px;
        background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="12" height="6"><path d="M0 3 Q3 0 6 3 T12 3" fill="none" stroke="%23e0e0e0" stroke-width="1"/></svg>') repeat-x;
        transition: transform 0.3s ease;
    }
    .experience-sidebar .exp-item:hover .wavy-line {
        transform: translateY(4px);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const expItems = document.querySelectorAll('.exp-item');
        const mainImage = document.getElementById('main-exp-image');

        expItems.forEach(item => {
            const tab = item.querySelector('.exp-tab');
            
            tab.addEventListener('click', function() {
                const isActive = this.classList.contains('active');

                // Close all
                expItems.forEach(otherItem => {
                    otherItem.querySelector('.exp-tab').classList.remove('active');
                    otherItem.querySelector('.exp-content').classList.remove('show');
                });
                
                // If it was already active, we just closed it, so stop here
                if (isActive) return; 
                
                // Open clicked
                this.classList.add('active');
                item.querySelector('.exp-content').classList.add('show');
                
                // Change image with fade effect
                const newImgSrc = this.getAttribute('data-image');
                mainImage.style.opacity = '0';
                
                setTimeout(() => {
                    mainImage.setAttribute('src', newImgSrc);
                    mainImage.style.opacity = '1';
                }, 300);
            });
        });
    });
</script>
