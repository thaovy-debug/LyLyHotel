<?php
/**
 * Template Name: Checkout
 */

get_header();

// Lấy thông tin từ URL
$room_id = isset($_GET['room']) ? intval($_GET['room']) : 0;
$checkin = isset($_GET['checkin']) ? $_GET['checkin'] : '';
$checkout = isset($_GET['checkout']) ? $_GET['checkout'] : '';
$guests = isset($_GET['guests']) ? intval($_GET['guests']) : 2;

// Lấy thông tin phòng
$room_title = 'Phòng nghỉ LyLy';
$price_overnight = 0;
$thumbnail_url = 'https://placehold.co/600x400?text=LyLy+Hotel';

if ($room_id > 0) {
    $room_title = get_the_title($room_id);
    $price_overnight = get_post_meta($room_id, '_lyly_price_overnight', true);
    $thumbnail_id = get_post_thumbnail_id($room_id);
    if ($thumbnail_id) {
        $thumbnail_url = wp_get_attachment_image_url($thumbnail_id, 'large');
    }
}

// Tính số đêm (giả định cơ bản)
$nights = 1;
if ($checkin && $checkout) {
    $d1 = new DateTime($checkin);
    $d2 = new DateTime($checkout);
    $diff = $d1->diff($d2);
    $nights = $diff->days ?: 1;
}

$total_price = $price_overnight * $nights;
?>

<style>
    :root {
        --main-color-orange: #fbc25e;
        --bg-dark: #16192c;
    }

    .checkout-section {
        padding: 130px 0 80px;
        background-color: #f4f7f6;
        min-height: 100vh;
    }

    .checkout-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 15px;
    }

    .checkout-card {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 5px 25px rgba(0,0,0,0.05);
        margin-bottom: 30px;
        overflow: hidden;
    }

    .checkout-header {
        background: var(--bg-dark);
        color: #fff;
        padding: 20px 30px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .checkout-body {
        padding: 30px;
    }

    .form-label {
        font-weight: 600;
        color: #444;
        margin-bottom: 10px;
    }

    .form-control {
        border-radius: 4px;
        padding: 12px 15px;
        border: 1px solid #ddd;
    }

    .form-control:focus {
        border-color: var(--main-color-orange);
        box-shadow: none;
    }

    .order-summary {
        position: sticky;
        top: 120px;
    }

    .summary-item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
        color: #666;
    }

    .summary-total {
        border-top: 1px solid #eee;
        padding-top: 15px;
        margin-top: 15px;
        display: flex;
        justify-content: space-between;
        font-weight: 700;
        font-size: 1.25rem;
        color: #000;
    }

    .btn-confirm-booking {
        background-color: var(--main-color-orange);
        color: #000;
        border: none;
        width: 100%;
        padding: 15px;
        font-weight: 700;
        text-transform: uppercase;
        border-radius: 4px;
        margin-top: 20px;
        transition: 0.3s;
    }

    .btn-confirm-booking:hover {
        background-color: #000;
        color: #fff;
    }

    .room-preview-img {
        width: 100%;
        height: 150px;
        object-fit: cover;
        border-radius: 4px;
        margin-bottom: 20px;
    }
</style>

<div class="checkout-section">
    <div class="checkout-container">
        <div class="row">
            <!-- Cột trái: Thông tin đặt hàng -->
            <div class="col-lg-8">
                <div class="checkout-card">
                    <div class="checkout-header">Thông tin khách hàng</div>
                    <div class="checkout-body">
                        <form id="booking-form">
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label class="form-label">Họ và Tên *</label>
                                    <input type="text" class="form-control" required placeholder="Nguyễn Văn A">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Số điện thoại *</label>
                                    <input type="tel" class="form-control" required placeholder="090x xxx xxx">
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Địa chỉ Email *</label>
                                <input type="email" class="form-control" required placeholder="example@gmail.com">
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Yêu cầu đặc biệt</label>
                                <textarea class="form-control" rows="4" placeholder="Ví dụ: Phòng tầng cao, nệm cứng..."></textarea>
                            </div>
                            
                            <div class="mt-5">
                                <h5 class="mb-4 fw-bold">Phương thức thanh toán</h5>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" name="payment" id="pay_arrival" checked>
                                    <label class="form-check-label" for="pay_arrival">
                                        Thanh toán khi nhận phòng
                                    </label>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" name="payment" id="pay_transfer">
                                    <label class="form-check-label" for="pay_transfer">
                                        Chuyển khoản ngân hàng
                                    </label>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Cột phải: Tóm tắt đơn hàng -->
            <div class="col-lg-4">
                <div class="checkout-card order-summary">
                    <div class="checkout-header">Chi tiết đặt phòng</div>
                    <div class="checkout-body">
                        <img src="<?php echo $thumbnail_url; ?>" class="room-preview-img">
                        <h5 class="fw-bold mb-3"><?php echo $room_title; ?></h5>
                        
                        <div class="summary-item">
                            <span>Ngày nhận phòng:</span>
                            <span class="text-dark fw-bold"><?php echo $checkin; ?></span>
                        </div>
                        <div class="summary-item">
                            <span>Ngày trả phòng:</span>
                            <span class="text-dark fw-bold"><?php echo $checkout; ?></span>
                        </div>
                        <div class="summary-item">
                            <span>Số khách:</span>
                            <span class="text-dark fw-bold"><?php echo $guests; ?> khách</span>
                        </div>
                        <div class="summary-item">
                            <span>Số đêm:</span>
                            <span class="text-dark fw-bold"><?php echo $nights; ?> đêm</span>
                        </div>
                        
                        <div class="summary-total">
                            <span>TỔNG TIÊU</span>
                            <span class="text-danger"><?php echo number_format($total_price); ?>đ</span>
                        </div>

                        <button type="submit" form="booking-form" class="btn-confirm-booking" id="btn-submit-booking">XÁC NHẬN ĐẶT PHÒNG</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('booking-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const btn = document.getElementById('btn-submit-booking');
    btn.innerHTML = '<span class="spinner-border spinner-border-sm"></span> ĐANG XỬ LÝ...';
    btn.disabled = true;
    
    // Giả lập gửi form thành công
    setTimeout(() => {
        window.scrollTo(0,0);
        document.querySelector('.checkout-container').innerHTML = `
            <div class="text-center py-5">
                <div class="mb-4">
                    <i class="bi bi-check-circle-fill text-success" style="font-size: 5rem;"></i>
                </div>
                <h1 class="fw-bold mb-3">ĐẶT PHÒNG THÀNH CÔNG!</h1>
                <p class="lead mb-4">Cảm ơn bạn đã lựa chọn LyLy Hotel. <br> Mã xác nhận đã được gửi vào email của bạn.</p>
                <div class="d-flex justify-content-center gap-3">
                    <a href="<?php echo home_url(); ?>" class="btn btn-dark px-4 py-2">VỀ TRANG CHỦ</a>
                    <a href="<?php echo site_url('/stay'); ?>" class="btn btn-outline-dark px-4 py-2">XEM THÊM PHÒNG</a>
                </div>
            </div>
        `;
    }, 2000);
});
</script>

<?php get_footer(); ?>
