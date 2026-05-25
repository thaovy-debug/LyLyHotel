<!-- Booking Modal -->
<div class="modal fade" id="checkrateFormModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content" style="background-color: #1a1f33 !important; border: none; font-family: 'Montserrat', sans-serif;">

            <!-- Nút đóng Form -->
            <div class="modal-header border-0 p-4">
                <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body p-0">
                <div class="container-fluid pt-2 pb-5 text-center">
                    <!-- 1. Tiêu đề Reservations -->
                    <h5 class="text-uppercase mb-5" style="color: white; letter-spacing: 2px; font-weight: 300; opacity: 0.8;">
                        RESERVATIONS: <span style="color: #fbc25e;"><?php echo esc_html(function_exists('lyly_get_contact_option') ? lyly_get_contact_option('general_phone') : '0941 871 644'); ?></span>
                    </h5>

                    <?php
                    $branches = get_terms(array('taxonomy' => 'lyly_branch', 'hide_empty' => false));
                    $first_branch_name = !empty($branches) ? $branches[0]->name : 'CHI NHÁNH';
                    $first_branch_id = !empty($branches) ? $branches[0]->term_id : '';
                    ?>
                    <input type="hidden" id="selected-branch-id" value="<?php echo $first_branch_id; ?>">

                    <!-- 2. Header Thông tin -->
                    <div class="booking-tabs d-flex justify-content-center align-items-center gap-5 mb-5">
                        <div class="tab-item active" id="tab-branch" onclick="switchTab('branch', 'tab-branch')">
                            <span class="label">BRANCH</span>
                            <span class="val-group">
                                <span class="date" id="branch-name-display" style="font-size: 1.8rem;"><?php echo esc_html($first_branch_name); ?></span>
                            </span>
                        </div>
                        <div class="tab-item" id="tab-arrive" onclick="switchTab('date', 'tab-arrive')">
                            <span class="label">ARRIVE</span>
                            <span class="val-group">
                                <span class="month" id="arrive-month-display">THÁNG 5</span>
                                <span class="date" id="arrive-date-display">15</span>
                            </span>
                        </div>
                        <div class="tab-item" id="tab-depart" onclick="switchTab('date', 'tab-depart')">
                            <span class="label">DEPART</span>
                            <span class="val-group">
                                <span class="month" id="depart-month-display">THÁNG 5</span>
                                <span class="date" id="depart-date-display">17</span>
                            </span>
                        </div>
                        <div class="tab-item" id="tab-guest" onclick="switchTab('guest', 'tab-guest')">
                            <span class="label">GUEST</span>
                            <span class="val-group">
                                <span class="date" id="guest-count-display">1</span>
                            </span>
                        </div>
                        <div class="tab-item" id="tab-child" onclick="switchTab('child', 'tab-child')">
                            <span class="label">CHILDS</span>
                            <span class="val-group">
                                <span class="date" id="child-count-display">0</span>
                            </span>
                        </div>
                    </div>

                    <!-- 3. Khu vực chứa lịch TRÀN KHUNG -->
                    <div class="booking-main-wrapper mx-auto" style="max-width: 1000px;">
                        <div class="content-box bg-white text-dark shadow-lg" style="min-height: 450px;">
                            
                            <!-- View Chọn Chi Nhánh -->
                            <div id="view-branch" class="booking-view active">
                                <div class="branch-selector d-flex justify-content-center gap-3 py-5 mt-2">
                                    <?php if (!empty($branches)) : foreach ($branches as $index => $branch) : ?>
                                        <div class="branch-btn <?php echo $index === 0 ? 'active' : ''; ?>" 
                                             onclick="setBranch('<?php echo $branch->term_id; ?>', '<?php echo esc_js($branch->name); ?>', this)">
                                            <?php echo esc_html($branch->name); ?>
                                        </div>
                                    <?php endforeach; endif; ?>
                                </div>
                            </div>
                            
                            <!-- View Lịch -->
                            <div id="view-date" class="booking-view">
                                <div id="lyly-calendar-inline"></div>
                            </div>

                            <!-- View Chọn số người -->
                            <div id="view-guest" class="booking-view">
                                <div class="number-selector d-flex justify-content-center gap-2 py-5 mt-4">
                                    <div class="num-btn active" onclick="setNumber('guest', 1)">1</div>
                                    <div class="num-btn" onclick="setNumber('guest', 2)">2</div>
                                    <div class="num-btn" onclick="setNumber('guest', 3)">3</div>
                                    <div class="num-btn" onclick="setNumber('guest', 4)">4</div>
                                    <div class="num-btn" onclick="setNumber('guest', 5)">5</div>
                                </div>
                            </div>

                            <div id="view-child" class="booking-view">
                                <div class="number-selector d-flex justify-content-center gap-2 py-5 mt-4">
                                    <div class="num-btn active" onclick="setNumber('child', 0)">0</div>
                                    <div class="num-btn" onclick="setNumber('child', 1)">1</div>
                                    <div class="num-btn" onclick="setNumber('child', 2)">2</div>
                                    <div class="num-btn" onclick="setNumber('child', 3)">3</div>
                                </div>
                                <div id="child-ages" class="mt-3 px-5 pb-4"></div>
                            </div>

                        </div>
                        <!-- 4. Nút bấm Check Availability -->
                        <button type="button" id="btn-check-availability" class="btn-submit-booking">CHECK AVAILABILITY</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Tabs Styling */
    .booking-tabs .tab-item { cursor: pointer; opacity: 0.4; text-align: left; }
    .booking-tabs .tab-item.active { opacity: 1; }
    .booking-tabs .tab-item .label { display: block; font-size: 1.1rem; color: #fff; margin-bottom: 5px; }
    .booking-tabs .tab-item.active .label { color: #fbc25e; }
    .booking-tabs .tab-item .val-group { display: flex; align-items: baseline; gap: 10px; }
    .booking-tabs .tab-item .month { font-size: 1.3rem; color: #fff; font-weight: 300; }
    .booking-tabs .tab-item .date { font-size: 3.5rem; color: #fff; line-height: 1; font-weight: 300; }
    .booking-tabs .tab-item.active .date, .booking-tabs .tab-item.active .month { color: #fbc25e; }

    .booking-view { display: none; }
    .booking-view.active { display: block; }

    /* LỊCH TRÀN KHUNG - CSS CUSTOM */
    .flatpickr-calendar {
        width: 100% !important;
        max-width: 1000px !important;
        box-shadow: none !important;
        border: none !important;
        background: #fff !important;
        font-family: inherit !important;
    }
    
    .flatpickr-months {
        display: flex !important;
        padding: 20px 0 !important;
    }
    
    .flatpickr-month {
        flex: 1 !important;
        height: auto !important;
        color: #000 !important;
    }
    
    .flatpickr-current-month {
        font-size: 1.5rem !important;
        font-weight: 600 !important;
        position: static !important;
        width: 100% !important;
        display: flex !important;
        justify-content: center !important;
        align-items: center !important;
        gap: 20px !important;
        pointer-events: auto !important;
    }

    .flatpickr-prev-month, .flatpickr-next-month {
        display: none !important;
    }
    
    .flatpickr-current-month::before {
        content: '<';
        color: #fbc25e;
        cursor: pointer;
        font-weight: bold;
        padding: 0 20px;
        font-size: 1.5rem;
    }
    .flatpickr-current-month::after {
        content: '>';
        color: #fbc25e;
        cursor: pointer;
        font-weight: bold;
        padding: 0 20px;
        font-size: 1.5rem;
    }

    .flatpickr-innerContainer {
        display: flex !important;
        flex-direction: column !important;
        width: 100% !important;
    }

    .flatpickr-weekdays {
        display: flex !important;
        width: 100% !important;
        height: 50px !important;
    }

    .flatpickr-weekdaycontainer {
        display: flex !important;
        flex: 1 !important;
    }

    .flatpickr-weekday {
        color: #fbc25e !important;
        font-weight: 600 !important;
        font-size: 0.9rem !important;
        flex: 1 !important;
        display: flex !important;
        justify-content: center !important;
        align-items: center !important;
    }

    .flatpickr-days {
        width: 100% !important;
        display: flex !important;
        justify-content: center !important;
    }

    .dayContainer {
        flex: 1 !important;
        min-width: 0 !important;
        max-width: none !important;
        display: grid !important;
        grid-template-columns: repeat(7, 1fr) !important;
        padding: 0 10px !important;
    }

    .flatpickr-day {
        max-width: none !important;
        height: 60px !important;
        line-height: 60px !important;
        font-size: 1.2rem !important;
        color: #333 !important;
        border-radius: 0 !important;
        margin: 0 !important;
        border: none !important;
        display: flex !important;
        justify-content: center !important;
        align-items: center !important;
    }

    .flatpickr-day.selected, 
    .flatpickr-day.startRange, 
    .flatpickr-day.endRange {
        background: #fbc25e !important;
        color: #fff !important;
        border-radius: 50% !important; /* Circle like Malibu */
    }

    .flatpickr-day.inRange {
        background: rgba(251, 194, 94, 0.15) !important;
        box-shadow: none !important;
    }

    .flatpickr-day.flatpickr-disabled, 
    .flatpickr-day.flatpickr-disabled:hover {
        color: #ccc !important;
        cursor: not-allowed !important;
    }

    /* Submit Button */
    .btn-submit-booking {
        width: 100%;
        background: #fbc25e;
        color: #1a1f33;
        border: none;
        padding: 20px;
        font-weight: 700;
        font-size: 1.2rem;
        letter-spacing: 2px;
        text-transform: uppercase;
        transition: 0.3s;
    }
    .btn-submit-booking:hover { background: #e5af52; }

    /* Num buttons */
    .num-btn {
        width: 70px; height: 90px; display: flex; align-items: center; justify-content: center;
        font-size: 2.5rem; color: #333; cursor: pointer; transition: 0.2s;
    }
    .num-btn.active { background: #fbc25e; color: #fff; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const monthsVi = ["THÁNG 1", "THÁNG 2", "THÁNG 3", "THÁNG 4", "THÁNG 5", "THÁNG 6", "THÁNG 7", "THÁNG 8", "THÁNG 9", "THÁNG 10", "THÁNG 11", "THÁNG 12"];
    let selectedRange = [];

    // Tab switcher
    window.switchTab = function(view, tabId) {
        document.querySelectorAll('.tab-item').forEach(i => i.classList.remove('active'));
        document.querySelectorAll('.booking-view').forEach(v => v.classList.remove('active'));
        
        const viewEl = document.getElementById('view-' + view);
        if (viewEl) viewEl.classList.add('active');
        
        if (tabId) {
            const tabEl = document.getElementById(tabId);
            if (tabEl) tabEl.classList.add('active');
        } else {
            // Default mappings if tabId is not provided
            if(view === 'branch') document.getElementById('tab-branch').classList.add('active');
            if(view === 'date') document.getElementById('tab-arrive').classList.add('active');
            if(view === 'guest') document.getElementById('tab-guest').classList.add('active');
            if(view === 'child') document.getElementById('tab-child').classList.add('active');
        }
    }

    window.setBranch = function(id, name, el) {
        document.querySelectorAll('.branch-btn').forEach(b => b.classList.remove('active'));
        el.classList.add('active');
        document.getElementById('selected-branch-id').value = id;
        document.getElementById('branch-name-display').innerText = name;
        // Auto switch to Arrive after choosing branch
        setTimeout(() => switchTab('date', 'tab-arrive'), 400);
    }

    window.setNumber = function(type, val) {
        document.getElementById(type + '-count-display').innerText = val;
        const parent = document.getElementById('view-' + type);
        parent.querySelectorAll('.num-btn').forEach(b => {
            if(b.innerText == val) b.classList.add('active');
            else b.classList.remove('active');
        });
    }

    // Flatpickr Init
    const fp = flatpickr("#lyly-calendar-inline", {
        inline: true,
        mode: "range",
        showMonths: window.innerWidth > 768 ? 2 : 1,
        minDate: "today",
        locale: "vn",
        dateFormat: "d/m/Y",
        defaultDate: ["today", new Date().getTime() + 2 * 24 * 60 * 60 * 1000],
        onReady: function(selectedDates) {
            selectedRange = selectedDates;
            updateDisplay(selectedDates);
        },
        onChange: function(selectedDates) {
            selectedRange = selectedDates;
            updateDisplay(selectedDates);
            
            if(selectedDates.length === 1) {
                // Đã chọn ngày đến, chuyển tab sang Ngày đi để người dùng biết
                switchTab('date', 'tab-depart');
            } else if(selectedDates.length === 2) {
                // Đã chọn xong khoảng ngày, chuyển sang chọn số khách
                setTimeout(() => switchTab('guest', 'tab-guest'), 500);
            }
        }
    });

    // Sự kiện click cho mũi tên tự chế (dùng Delegation để không bị mất khi đổi tháng)
    document.addEventListener('click', function(e) {
        const monthEl = e.target.closest('.flatpickr-current-month');
        if (monthEl) {
            const rect = monthEl.getBoundingClientRect();
            const x = e.clientX - rect.left;
            if(x < rect.width/3) fp.changeMonth(-1);
            else if(x > rect.width * 2/3) fp.changeMonth(1);
        }
    });

    function updateDisplay(dates) {
        if (dates.length >= 1) {
            document.getElementById('arrive-month-display').innerText = monthsVi[dates[0].getMonth()];
            document.getElementById('arrive-date-display').innerText = dates[0].getDate();
        }
        if (dates.length >= 2) {
            document.getElementById('depart-month-display').innerText = monthsVi[dates[1].getMonth()];
            document.getElementById('depart-date-display').innerText = dates[1].getDate();
        }
    }

    document.getElementById('btn-check-availability').addEventListener('click', function() {
        const formatLocal = (date) => {
            if (!date) return '';
            const y = date.getFullYear();
            const m = String(date.getMonth() + 1).padStart(2, '0');
            const d = String(date.getDate()).padStart(2, '0');
            return `${y}-${m}-${d}`;
        }

        const checkin = selectedRange[0] ? formatLocal(selectedRange[0]) : '';
        const checkout = selectedRange[1] ? formatLocal(selectedRange[1]) : checkin;
        const guests = document.getElementById('guest-count-display') ? parseInt(document.getElementById('guest-count-display').innerText) || 2 : 2;
        const branch = document.getElementById('selected-branch-id') ? document.getElementById('selected-branch-id').value : '';

        window.location.href = `<?php echo site_url('/checkrate'); ?>?checkin=${checkin}&checkout=${checkout}&guests=${guests}&branch=${branch}`;
    });
});
</script>