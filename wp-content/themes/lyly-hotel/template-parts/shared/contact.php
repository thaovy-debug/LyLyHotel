<?php
/**
 * Template Part: Contact Us
 */
?>
<style>
    .contact-section {
        background-color: #fafafa;
        font-family: 'Montserrat', sans-serif;
    }
    .contact-header {
        text-align: center;
        margin-bottom: 50px;
    }
    .contact-header h1 {
        font-weight: 700;
        letter-spacing: 2px;
        color: #333;
        font-size: 2.5rem;
    }
    .contact-header p {
        color: #777;
        font-size: 1rem;
    }
    .branch-card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        padding: 30px;
        height: 100%;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: 1px solid #eee;
    }
    .branch-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.08);
    }
    .branch-card h4 {
        font-weight: 700;
        color: #333;
        font-size: 1.25rem;
        margin-bottom: 20px;
        border-bottom: 2px solid #FFCC66;
        padding-bottom: 10px;
    }
    .contact-info-item {
        display: flex;
        align-items: flex-start;
        margin-bottom: 15px;
    }
    .contact-info-item i {
        color: #FFCC66;
        font-size: 1.2rem;
        margin-right: 15px;
        margin-top: 3px;
    }
    .contact-info-item p {
        margin: 0;
        font-size: 0.95rem;
        color: #555;
        line-height: 1.5;
    }
    .contact-info-item a {
        color: #555;
        text-decoration: none;
        transition: color 0.3s;
    }
    .contact-info-item a:hover {
        color: #FFCC66;
    }
    .map-container {
        border-radius: 8px;
        overflow: hidden;
        margin-top: 20px;
        border: 1px solid #ddd;
    }
    .form-container {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        padding: 40px;
        border: 1px solid #eee;
    }
    .form-container h4 {
        font-weight: 700;
        margin-bottom: 30px;
        text-align: center;
        letter-spacing: 1px;
    }
    .form-control:focus {
        border-color: #FFCC66;
        box-shadow: 0 0 0 0.2rem rgba(255, 204, 102, 0.25);
    }
    .submit-btn {
        background-color: #FFCC66;
        color: #fff;
        font-weight: 700;
        letter-spacing: 1px;
        padding: 12px;
        border: none;
        border-radius: 6px;
        transition: background-color 0.3s ease;
    }
    .submit-btn:hover {
        background-color: #e5b85c;
        color: #fff;
    }
</style>

<section class="contact-section py-5">
    <div class="container px-lg-5">
        <div class="contact-header">
            <h1>LIÊN HỆ</h1>
            <p>Hãy liên hệ với chúng tôi để được tư vấn và hỗ trợ đặt phòng nhanh nhất.</p>
        </div>
        
        <div class="row g-4 mb-5">
            <!-- Chi nhánh 1 -->
            <div class="col-lg-6">
                <div class="branch-card">
                    <h4><?php echo esc_html(function_exists('lyly_get_contact_option') ? lyly_get_contact_option('branch_1_name') : 'LY LY HOTEL – CHI NHÁNH 1'); ?></h4>
                    
                    <div class="contact-info-item">
                        <i class="bi bi-geo-alt-fill"></i>
                        <p><strong>Địa chỉ:</strong> <?php echo esc_html(function_exists('lyly_get_contact_option') ? lyly_get_contact_option('branch_1_address') : '110-112 Đường Song Hành, P. Bình Phú, TP. Hồ Chí Minh'); ?></p>
                    </div>
                    
                    <div class="contact-info-item">
                        <i class="bi bi-telephone-fill"></i>
                        <p><strong>Điện thoại:</strong> 
                            <?php 
                            $phone_1 = function_exists('lyly_get_contact_option') ? lyly_get_contact_option('branch_1_phone') : '028 3755 8599';
                            echo esc_html($phone_1);
                            ?>
                        </p>
                    </div>
                    
                    <div class="contact-info-item">
                        <i class="bi bi-envelope-fill"></i>
                        <p><strong>Email:</strong> <a href="mailto:info@lylyhotel.com.vn">info@lylyhotel.com.vn</a></p>
                    </div>
                    
                    <div class="map-container">
                        <div class="ratio ratio-16x9">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3920.0030946375928!2d106.6227138!3d10.7342442!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752dd93af1fd73%3A0xb1de5f7056e81750!2sLy%20Ly%20Hotel!5e0!3m2!1sen!2s!4v1779166519532!5m2!1sen!2s" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Chi nhánh 2 -->
            <div class="col-lg-6">
                <div class="branch-card">
                    <h4><?php echo esc_html(function_exists('lyly_get_contact_option') ? lyly_get_contact_option('branch_2_name') : 'LY LY HOTEL – CHI NHÁNH 2'); ?></h4>
                    
                    <div class="contact-info-item">
                        <i class="bi bi-geo-alt-fill"></i>
                        <p><strong>Địa chỉ:</strong> <?php echo esc_html(function_exists('lyly_get_contact_option') ? lyly_get_contact_option('branch_2_address') : '344A Đường Số 1, Phường An Lạc, TP. Hồ Chí Minh'); ?></p>
                    </div>
                    
                    <div class="contact-info-item">
                        <i class="bi bi-telephone-fill"></i>
                        <p><strong>Điện thoại:</strong> 
                            <?php 
                            $phone_2 = function_exists('lyly_get_contact_option') ? lyly_get_contact_option('branch_2_phone') : '028 2222 3579';
                            echo esc_html($phone_2);
                            ?>
                        </p>
                    </div>
                    
                    <div class="contact-info-item">
                        <i class="bi bi-envelope-fill"></i>
                        <p><strong>Email:</strong> <a href="mailto:info@lylyhotel.com.vn">info@lylyhotel.com.vn</a></p>
                    </div>
                    
                    <div class="map-container">
                        <div class="ratio ratio-16x9">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.8293884971686!2d106.609853!3d10.747629000000002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752dcba1b3e0a7%3A0x1efc023329b66602!2sLy%20Ly%20Hotel%202!5e0!3m2!1sen!2s!4v1779166606296!5m2!1sen!2s" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Tin nhắn -->
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="form-container">
                    <h4>GỬI TIN NHẮN CHO CHÚNG TÔI</h4>
                    <form>
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Họ và tên</label>
                                <input type="text" class="form-control" placeholder="Nhập họ và tên..." required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Số điện thoại</label>
                                <input type="tel" class="form-control" placeholder="Nhập số điện thoại...">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" placeholder="Nhập địa chỉ email..." required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nội dung tin nhắn</label>
                            <textarea class="form-control" rows="5" placeholder="Nhập nội dung cần hỗ trợ..." required></textarea>
                        </div>
                        <div class="text-center mt-4">
                            <button type="submit" class="submit-btn px-5">GỬI YÊU CẦU LIÊN HỆ</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_template_part('template-parts/shared/more'); ?>
