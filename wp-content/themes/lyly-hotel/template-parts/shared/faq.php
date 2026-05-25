<?php
/**
 * Template Part: FAQ (More)
 */
?>
<section class="faq-section" style="margin-top: 150px; padding: 60px 0;">
    <div class="container text-center mb-5">
        <h1 class="display-4 fw-bold text-uppercase mb-4">CÂU HỎI THƯỜNG GẶP</h1>
        <p class="lead mb-5">Chào mừng bạn đến với trang hỗ trợ của LyLy Hotel.</p>
    </div>

    <div class="container mb-5">
        <div class="accordion" id="faqAccordion" style="max-width: 900px; margin: 0 auto;">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                        Làm thế nào để tôi đặt phòng trực tuyến?
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Quý khách có thể đặt phòng trực tiếp thông qua nút "BOOK NOW" trên website hoặc liên hệ hotline (+84) 941 871 644.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                        Chính sách hủy phòng của khách sạn như thế nào?
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Vui lòng thông báo hủy phòng trước 48 giờ để được hoàn tiền 100%. Các trường hợp muộn hơn sẽ áp dụng phí hủy theo quy định.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_template_part('template-parts/shared/more'); ?>
