<?php
/**
 * Template Part: Shared - Fixed Booking Bar (Bottom)
 */
$branches = get_terms(array('taxonomy' => 'lyly_branch', 'hide_empty' => false));
$first_branch_name = !empty($branches) ? $branches[0]->name : 'Chọn chi nhánh';
$first_branch_id = !empty($branches) ? $branches[0]->term_id : '';
$first_branch_meta = $first_branch_id ? get_term_meta($first_branch_id, 'lyly_branch_meta', true) : array();
$first_branch_address = isset($first_branch_meta['address']) ? $first_branch_meta['address'] : '';
?>

<div id="lyly-fixed-booking-bar" class="lyly-booking-bar-wrapper">
    <div class="container-fluid px-0">
        <div class="booking-bar-content d-flex align-items-stretch">
            <div class="booking-item branch-item flex-grow-1" onclick="togglePopup('popup-branch')">
                <div class="item-label">Chi nhánh</div>
                <div class="item-value" id="bar-branch-name"><?php echo esc_html($first_branch_name); ?></div>
                <div class="item-sub-value" id="bar-branch-address"
                    style="font-size: 0.7rem; color: rgba(0,0,0,0.5); font-weight: 400;">
                    <?php echo esc_html($first_branch_address); ?>
                </div>
                <input type="hidden" id="bar-selected-branch" value="<?php echo esc_attr($first_branch_id); ?>">
                <i class="bi bi-chevron-down ms-auto"></i>

                <div id="popup-branch" class="booking-popup popup-branch-list">
                    <?php if (!empty($branches)):
                        foreach ($branches as $branch):
                            $branch_meta = get_term_meta($branch->term_id, 'lyly_branch_meta', true);
                            $address = isset($branch_meta['address']) ? $branch_meta['address'] : '';
                            ?>
                            <div class="branch-option"
                                onclick="selectBarBranch('<?php echo $branch->term_id; ?>', '<?php echo esc_js($branch->name); ?>', '<?php echo esc_js($address); ?>', event)">
                                <div class="branch-name"><?php echo esc_html($branch->name); ?></div>
                                <?php if ($address): ?>
                                    <div class="branch-address" style="font-size: 0.75rem; color: #888; font-weight: 400;">
                                        <?php echo esc_html($address); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; endif; ?>
                </div>
            </div>

            <div class="booking-item date-item" onclick="togglePopup('popup-calendar')">
                <div class="item-label">Nhận phòng</div>
                <div class="item-value" id="bar-checkin-display">16/05/2026</div>
                <i class="bi bi-calendar3"></i>
            </div>

            <div class="booking-item date-item" onclick="togglePopup('popup-calendar')">
                <div class="item-label">Trả phòng</div>
                <div class="item-value" id="bar-checkout-display">17/05/2026</div>
                <i class="bi bi-calendar3"></i>
            </div>

            <div class="booking-item guest-item" onclick="togglePopup('popup-guests')">
                <div class="item-label">Khách</div>
                <div class="item-value" id="bar-guests-display">2 người lớn, 0 trẻ em</div>
                <i class="bi bi-person"></i>

                <div id="popup-guests" class="booking-popup popup-guest-selector" onclick="event.stopPropagation()">
                    <div class="guest-popup-header">Khách</div>
                    <div class="guest-rows mb-4">
                        <div class="guest-row-item mb-3 pb-3 border-bottom">
                            <div class="row align-items-center">
                                <div class="col-12 mb-2">
                                    <span style="font-weight: 700; font-size: 0.8rem; color: #888;">PHÒNG 1</span>
                                </div>
                                <div class="col-6 text-start">
                                    <div class="guest-label">Người lớn</div>
                                </div>
                                <div class="col-6 d-flex justify-content-end">
                                    <div class="guest-control d-flex align-items-center">
                                        <button type="button" class="btn-count"
                                            onclick="updateGuestCount('adults', -1)">-</button>
                                        <span id="count-adults" class="count-val">2</span>
                                        <button type="button" class="btn-count"
                                            onclick="updateGuestCount('adults', 1)">+</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-center mt-3">
                                <div class="col-6 text-start">
                                    <div class="guest-label">Trẻ em</div>
                                    <small
                                        style="font-size: 0.65rem; color: #888; display: block; line-height: 1.2;">dưới 8 tuổi</small>
                                </div>
                                <div class="col-6 d-flex justify-content-end">
                                    <div class="guest-control d-flex align-items-center">
                                        <button type="button" class="btn-count"
                                            onclick="updateGuestCount('children', -1)">-</button>
                                        <span id="count-children" class="count-val">0</span>
                                        <button type="button" class="btn-count"
                                            onclick="updateGuestCount('children', 1)">+</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="guest-popup-footer d-flex gap-2">
                        <button class="btn btn-outline-light text-dark w-50"
                            style="font-size: 0.8rem; border-color: #eee;">+ Thêm phòng</button>
                        <button class="btn-done w-50" onclick="closePopups()">Xong</button>
                    </div>
                </div>
            </div>

            <div class="booking-btn-wrapper">
                <button type="button" class="btn-find-room" onclick="handleFindRoom()">TÌM PHÒNG</button>
            </div>
        </div>
    </div>

    <div id="popup-calendar" class="booking-popup popup-calendar-view" onclick="event.stopPropagation()">
        <div class="calendar-render-container">
            <div id="lyly-calendar-inline-bar"></div>
        </div>
        <div class="calendar-footer-text">
            Chọn ngày nhận phòng<br>
            <small>Giá tốt nhất cho 1 khách/đêm</small>
            <p class="mb-0 mt-1" style="font-size: 0.65rem; color: #aaa;">Giá có sẵn dựa trên các điều kiện đặt phòng đặc biệt</p>
        </div>
    </div>
</div>

<style>
    .lyly-booking-bar-wrapper {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        background: #fbc25e;
        /* Yellow background */
        color: #000;
        z-index: 9999;
        font-family: 'Montserrat', sans-serif;
        box-shadow: 0 -5px 20px rgba(0, 0, 0, 0.1);
    }

    .booking-bar-content {
        height: 75px;
    }

    .booking-item {
        padding: 5px 25px;
        border-right: 1px solid rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column;
        justify-content: center;
        cursor: pointer;
        position: relative;
    }

    .booking-item:hover {
        background: rgba(255, 255, 255, 0.2);
    }

    .branch-item {
        min-width: 250px;
    }

    .date-item {
        min-width: 160px;
    }

    .guest-item {
        min-width: 220px;
    }

    .item-label {
        font-size: 0.7rem;
        color: rgba(0, 0, 0, 0.6);
        text-transform: capitalize;
        margin-bottom: 0px;
    }

    .item-value {
        font-size: 0.95rem;
        font-weight: 700;
        white-space: nowrap;
        color: #000;
    }

    .booking-item i {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #000;
        opacity: 0.6;
        font-size: 1.1rem;
    }

    /* Popups định vị chung */
    .booking-popup {
        display: none;
        position: absolute;
        bottom: 100%;
        background: #fff;
        color: #333;
        box-shadow: 0 -10px 30px rgba(0, 0, 0, 0.2);
        z-index: 10000;
        margin-bottom: 15px;
        border-radius: 4px;
    }

    /* FIX LỖI ẨN HIỆN: Căn giữa bảng lịch tuyệt đối, khoảng trống trái/phải bằng nhau */
    .popup-calendar-view {
        width: 800px; /* Tăng chiều rộng để chứa 2 tháng */
        left: 50% !important;
        transform: translateX(-50%) !important;
        padding: 20px !important;
        background: #fff !important;
        border-radius: 8px;
    }

    .calendar-render-container {
        display: flex;
        justify-content: center;
        width: 100%;
        background: #fff;
    }

    .calendar-footer-text {
        padding-top: 15px;
        margin-top: 10px;
        border-top: 1px solid #eee;
        font-size: 0.8rem;
        color: #555;
        text-align: left;
    }

    .popup-branch-list {
        width: 100%;
        min-width: 250px;
        left: 0;
        transform: none;
    }

    .branch-option {
        padding: 12px 20px;
        border-bottom: 1px solid #eee;
        transition: 0.2s;
        font-weight: 500;
    }

    .branch-option:hover {
        background: #000;
        color: #fff;
    }

    .popup-guest-selector {
        width: 320px;
        padding: 25px;
        left: 50%;
        transform: translateX(-50%);
    }

    .guest-popup-header {
        font-weight: 700;
        font-size: 1.5rem;
        margin-bottom: 25px;
    }

    .guest-label {
        font-weight: 600;
        font-size: 0.95rem;
    }

    .btn-count {
        width: 32px;
        height: 32px;
        border-radius: 4px;
        border: none;
        background: #fdf5e6;
        color: #b08d57;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 1.2rem;
        font-weight: bold;
    }

    .count-val {
        width: 45px;
        text-align: center;
        font-weight: 600;
        font-size: 1.2rem;
    }

    .btn-done {
        background: #000;
        color: #fff;
        border: none;
        padding: 12px;
        font-weight: 700;
        border-radius: 4px;
        font-size: 0.9rem;
    }

    /* Promo Item */
    .promo-item {
        flex-grow: 1;
        min-width: 200px;
    }

    .promo-input {
        background: rgba(255, 255, 255, 0.3);
        border: none;
        color: #000;
        width: 100%;
        height: 100%;
        font-size: 0.85rem;
        font-weight: 500;
    }

    .promo-input::placeholder {
        color: #000;
        opacity: 0.4;
    }

    .promo-input:focus {
        outline: none;
        background: rgba(255, 255, 255, 0.5);
    }

    /* Find Room Button */
    .booking-btn-wrapper {
        min-width: 200px;
    }

    .btn-find-room {
        width: 100%;
        height: 100%;
        background: #000;
        color: #fff;
        border: none;
        font-weight: 700;
        font-size: 1.1rem;
        letter-spacing: 1px;
        text-transform: uppercase;
        transition: 0.3s;
    }

    .btn-find-room:hover {
        background: #222;
    }

    /* STYLE FLATPICKR CHUẨN - CHỈ SỬA MÀU SẮC, KHÔNG SỬA LAYOUT */
    .popup-calendar-view .flatpickr-calendar {
        background: #fff !important;
        box-shadow: none !important;
        border: none !important;
        width: auto !important;
    }

    /* Hiển thị lại mũi tên chuyển tháng */
    .popup-calendar-view .flatpickr-prev-month,
    .popup-calendar-view .flatpickr-next-month {
        display: flex !important;
        padding: 10px !important;
        color: #fbc25e !important;
        fill: #fbc25e !important;
    }

    .popup-calendar-view .flatpickr-prev-month:hover,
    .popup-calendar-view .flatpickr-next-month:hover {
        background: #f5f5f5 !important;
    }

    /* Tiêu đề tháng - Đảm bảo hiện rõ chữ tiếng Việt không bị nhảy dòng */
    .popup-calendar-view .flatpickr-months .flatpickr-month {
        background: #fff !important;
        color: #000 !important;
        fill: #000 !important;
        height: 70px !important;
        display: flex !important;
        align-items: center !important;
    }

    .popup-calendar-view .flatpickr-current-month {
        font-size: 1.1rem !important;
        font-weight: 700 !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        height: auto !important;
        padding: 0 !important;
        position: static !important;
        width: 100% !important;
    }

    /* Chỉnh dropdown tháng và năm */
    .popup-calendar-view .flatpickr-monthDropdown-months,
    .popup-calendar-view .cur-year {
        font-weight: 700 !important;
        font-size: 1.1rem !important;
        color: #000 !important;
        background: transparent !important;
        border: none !important;
        padding: 0 5px !important;
        margin: 0 !important;
        cursor: pointer !important;
    }

    .popup-calendar-view .flatpickr-monthDropdown-months:hover,
    .popup-calendar-view .cur-year:hover {
        background: #f5f5f5 !important;
    }

    /* Các ngày trong tuần */
    .popup-calendar-view .flatpickr-weekday {
        background: #fff !important;
        color: #888 !important;
        font-weight: 700 !important;
        font-size: 0.85rem !important;
    }

    /* TRIỆT TIÊU GẠCH ĐỨNG TRÊN SỐ */
    .popup-calendar-view .flatpickr-day {
        border-radius: 50% !important; /* Biến ô chọn thành hình tròn sạch sẽ */
        color: #333 !important;
        background: transparent !important;
        box-shadow: none !important;
        border: none !important;
        margin: 2px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
    }

    /* Xóa bỏ hoàn toàn các thanh dọc (pseudo elements) */
    .popup-calendar-view .flatpickr-day::before,
    .popup-calendar-view .flatpickr-day::after,
    .popup-calendar-view .flatpickr-day.selected::before,
    .popup-calendar-view .flatpickr-day.selected::after {
        content: none !important;
        display: none !important;
        background: none !important;
        border: none !important;
    }

    /* Khi chọn ngày - Hiện hình tròn vàng */
    .popup-calendar-view .flatpickr-day.selected,
    .popup-calendar-view .flatpickr-day.startRange,
    .popup-calendar-view .flatpickr-day.endRange {
        background: #fbc25e !important;
        color: #000 !important;
        border: none !important;
        box-shadow: none !important;
    }

    .popup-calendar-view .flatpickr-day.inRange {
        background: #fff3db !important;
        border-radius: 0 !important;
        box-shadow: none !important;
    }

    /* Chỉnh kích thước khung lịch cho 1 tháng */
    .popup-calendar-view {
        width: 400px !important;
        background: #fff !important;
    }

    .popup-calendar-view .flatpickr-calendar {
        width: 100% !important;
    }


    /* Fix lỗi căn lề cho container 2 tháng */
    .popup-calendar-view .flatpickr-innerContainer {
        background: #fff !important;
    }
    
    .popup-calendar-view .flatpickr-rContainer {
        background: #fff !important;
    }

    @media (max-width: 1200px) {
        .popup-calendar-view {
            width: 360px;
        }

        .popup-calendar-view .flatpickr-calendar {
            flex-direction: column;
        }
    }

    @media (max-width: 992px) {
        .lyly-booking-bar-wrapper {
            display: none;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let adults = 2;
        let children = 0;

        let now = new Date();
        let tomorrow = new Date();
        tomorrow.setDate(now.getDate() + 1);
        let selectedDates = [now, tomorrow];

        updateBarDates();

        const barFp = flatpickr("#lyly-calendar-inline-bar", {
            inline: true,
            mode: "range",
            showMonths: 1, // Chỉ hiện 1 tháng theo yêu cầu
            minDate: "today",
            locale: "vn",
            dateFormat: "d/m/Y",
            defaultDate: selectedDates,
            onChange: function (dates) {
                selectedDates = dates;
                updateBarDates();
                
                // Nếu đã chọn xong cả 2 ngày thì tự đóng (tùy chọn)
                // if (dates.length === 2) setTimeout(closePopups, 300);
            }
        });

        window.togglePopup = function (id) {
            const popup = document.getElementById(id);
            const isOpen = popup.style.display === 'block';
            closePopups();
            if (!isOpen) {
                popup.style.display = 'block';
                if (id === 'popup-calendar') {
                    barFp.redraw();
                }
            }
        };

        window.closePopups = function () {
            document.querySelectorAll('.booking-popup').forEach(p => p.style.display = 'none');
        };

        window.selectBarBranch = function (id, name, address, e) {
            e.stopPropagation();
            document.getElementById('bar-selected-branch').value = id;
            document.getElementById('bar-branch-name').innerText = name;
            document.getElementById('bar-branch-address').innerText = address;
            closePopups();
        };

        window.updateGuestCount = function (type, delta) {
            if (type === 'adults') {
                adults = Math.max(1, adults + delta);
                document.getElementById('count-adults').innerText = adults;
            } else {
                children = Math.max(0, children + delta);
                document.getElementById('count-children').innerText = children;
            }
            document.getElementById('bar-guests-display').innerText = adults + ' người lớn, ' + children + ' trẻ em';
        };

        function updateBarDates() {
            if (!selectedDates[0]) return;

            const d1 = selectedDates[0];
            const d2 = selectedDates[1] || d1;

            const pad = (n) => n < 10 ? '0' + n : n;
            document.getElementById('bar-checkin-display').innerText = `${pad(d1.getDate())}/${pad(d1.getMonth() + 1)}/${d1.getFullYear()}`;
            document.getElementById('bar-checkout-display').innerText = `${pad(d2.getDate())}/${pad(d2.getMonth() + 1)}/${d2.getFullYear()}`;
        }

        window.handleFindRoom = function () {
            const checkin = formatDate(selectedDates[0]);
            const checkout = selectedDates[1] ? formatDate(selectedDates[1]) : checkin;
            const guests = adults;
            const childCount = children;
            const branch = document.getElementById('bar-selected-branch').value;

            window.location.href = `<?php echo site_url('/stay'); ?>?checkin=${checkin}&checkout=${checkout}&guests=${guests}&children=${childCount}&branch=${branch}`;
        };

        function formatDate(date) {
            if (!date) return '';
            const y = date.getFullYear();
            const m = String(date.getMonth() + 1).padStart(2, '0');
            const d = String(date.getDate()).padStart(2, '0');
            return `${y}-${m}-${d}`;
        }

        document.addEventListener('click', function (e) {
            if (!e.target.closest('.booking-item') && !e.target.closest('.flatpickr-calendar')) {
                closePopups();
            }
        });
    });
</script>