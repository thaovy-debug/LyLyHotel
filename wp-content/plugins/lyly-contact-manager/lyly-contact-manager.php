<?php
/**
 * Plugin Name: LyLy Contact Manager
 * Description: Quản lý thông tin liên hệ, chi nhánh và cấu hình số điện thoại tổng liên kết Zalo cho LyLy Hotel.
 * Version: 1.0.0
 * Author: Triều & Antigravity
 */

if (!defined('ABSPATH'))
    exit;

// 1. Đăng ký menu trang cấu hình trong admin
add_action('admin_menu', 'lyly_contact_manager_add_admin_menu');
function lyly_contact_manager_add_admin_menu()
{
    add_menu_page(
        'Quản lý Liên Hệ',
        'Quản lý Liên Hệ',
        'manage_options',
        'lyly-contact-manager',
        'lyly_contact_manager_settings_page_html',
        'dashicons-phone',
        26
    );
}

// 2. Định nghĩa các giá trị mặc định
function lyly_contact_manager_defaults()
{
    return array(
        'general_phone' => '0941 871 644',
        'branch_1_name' => 'Ly Ly Hotel - Bình Phú',
        'branch_1_address' => '110-112 Đường Song Hành, Phường Bình Phú, TP. Hồ Chí Minh',
        'branch_1_phone' => '028 3755 8599',
        'branch_2_name' => 'Ly Ly Hotel 2 - An Lạc',
        'branch_2_address' => '344A Đường Số 1, Phường An Lạc, TP. Hồ Chí Minh',
        'branch_2_phone' => '028 2222 3579',
    );
}

// Update options to new phone numbers automatically
add_action('init', 'lyly_contact_manager_update_old_phones');
function lyly_contact_manager_update_old_phones() {
    $options = get_option('lyly_contact_settings');
    if (is_array($options)) {
        $updated = false;
        if (isset($options['branch_1_phone']) && ($options['branch_1_phone'] === '028 3755 8598 - 028 3755 8599' || $options['branch_1_phone'] === '028 3755 8598 - 028 3755 8599')) {
            $options['branch_1_phone'] = '028 3755 8599';
            $updated = true;
        }
        if (isset($options['branch_2_phone']) && ($options['branch_2_phone'] === '028 2222 3579 - 0983 479 689' || $options['branch_2_phone'] === '028 2222 3579 - 0983 479 689')) {
            $options['branch_2_phone'] = '028 2222 3579';
            $updated = true;
        }
        if ($updated) {
            update_option('lyly_contact_settings', $options);
        }
    }
}

// 3. Hàm lấy cấu hình (có fallback về mặc định)
function lyly_get_contact_option($key)
{
    $options = get_option('lyly_contact_settings');
    $defaults = lyly_contact_manager_defaults();

    if (isset($options[$key]) && !empty($options[$key])) {
        return $options[$key];
    }
    return isset($defaults[$key]) ? $defaults[$key] : '';
}

// Hàm làm sạch số điện thoại để làm link Zalo (chỉ giữ lại số)
function lyly_get_zalo_number()
{
    $phone = lyly_get_contact_option('general_phone');
    // Loại bỏ khoảng trắng, dấu chấm, dấu gạch ngang, dấu ngoặc
    $clean_phone = preg_replace('/[^0-9]/', '', $phone);
    return $clean_phone;
}

// 4. Đăng ký settings và render HTML trang quản trị
add_action('admin_init', 'lyly_contact_manager_register_settings');
function lyly_contact_manager_register_settings()
{
    register_setting('lyly_contact_settings_group', 'lyly_contact_settings');
}

function lyly_contact_manager_settings_page_html()
{
    ?>
    <style>
        :root {
            --lyly-primary: #fbc25e;
            --lyly-dark: #1a1f33;
            --lyly-bg: #f0f2f5;
            --lyly-card-bg: #ffffff;
            --lyly-border: #e2e8f0;
            --lyly-text: #334155;
            --lyly-success: #10b981;
        }

        .lyly-admin-wrap {
            font-family: 'Open Sans', -apple-system, sans-serif;
            max-width: 900px;
            margin: 20px auto 40px auto;
            padding: 0 15px;
        }

        .lyly-header {
            background: var(--lyly-dark);
            color: #fff;
            padding: 30px;
            border-radius: 12px;
            margin-bottom: 25px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .lyly-header h1 {
            color: #fff !important;
            margin: 0;
            font-size: 24px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .lyly-header h1 i {
            color: var(--lyly-primary);
        }

        .lyly-header p {
            margin: 5px 0 0 0;
            opacity: 0.8;
            font-size: 13px;
        }

        .lyly-card {
            background: var(--lyly-card-bg);
            border-radius: 12px;
            border: 1px solid var(--lyly-border);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            margin-bottom: 25px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .lyly-card:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.08);
        }

        .lyly-card-header {
            background: #f8fafc;
            padding: 18px 25px;
            border-bottom: 1px solid var(--lyly-border);
            font-weight: 700;
            font-size: 15px;
            color: var(--lyly-dark);
            display: flex;
            align-items: center;
            gap: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .lyly-card-header i {
            color: var(--lyly-primary);
            font-size: 18px;
        }

        .lyly-card-body {
            padding: 25px 30px;
        }

        .lyly-form-group {
            margin-bottom: 20px;
        }

        .lyly-form-group:last-child {
            margin-bottom: 0;
        }

        .lyly-label {
            display: block;
            font-weight: 600;
            font-size: 13px;
            color: #475569;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .lyly-input {
            width: 100% !important;
            padding: 12px 16px !important;
            border: 2px solid var(--lyly-border) !important;
            border-radius: 8px !important;
            font-size: 14px !important;
            font-weight: 500 !important;
            color: var(--lyly-dark) !important;
            background: #fdfdfd !important;
            transition: all 0.3s ease !important;
            box-sizing: border-box !important;
        }

        .lyly-input:hover {
            border-color: #cbd5e1 !important;
        }

        .lyly-input:focus {
            outline: none !important;
            border-color: var(--lyly-primary) !important;
            box-shadow: 0 0 0 3px rgba(251, 194, 94, 0.25) !important;
            background: #fff !important;
        }

        .lyly-alert {
            background: #f0fdf4;
            border-left: 4px solid var(--lyly-success);
            padding: 15px 20px;
            border-radius: 0 8px 8px 0;
            margin-bottom: 20px;
            color: #166534;
            font-size: 13px;
            line-height: 1.6;
        }

        .lyly-alert i {
            margin-right: 8px;
            font-size: 15px;
        }

        .lyly-submit-btn {
            background: var(--lyly-primary) !important;
            color: var(--lyly-dark) !important;
            border: none !important;
            padding: 12px 30px !important;
            border-radius: 8px !important;
            font-weight: 700 !important;
            font-size: 14px !important;
            cursor: pointer !important;
            transition: all 0.3s ease !important;
            box-shadow: 0 4px 6px -1px rgba(251, 194, 94, 0.3) !important;
        }

        .lyly-submit-btn:hover {
            background: #e5af52 !important;
            box-shadow: 0 10px 15px -3px rgba(251, 194, 94, 0.4) !important;
            transform: translateY(-1px);
        }

        .lyly-submit-btn:active {
            transform: translateY(0);
        }
    </style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <div class="wrap lyly-admin-wrap">
        <div class="lyly-header">
            <div>
                <h1><i class="fa-solid fa-hotel"></i> Cấu hình Liên Hệ & Chi Nhánh</h1>
                <p>Quản lý tập trung các số điện thoại, địa chỉ chi nhánh và hotline Zalo cho toàn bộ website.</p>
            </div>
        </div>

        <?php if (isset($_GET['settings-updated']) && $_GET['settings-updated']): ?>
            <div class="lyly-alert">
                <i class="fa-solid fa-circle-check"></i> Cấu hình đã được lưu và cập nhật thành công trên toàn bộ website!
            </div>
        <?php endif; ?>

        <form method="post" action="options.php">
            <?php
            settings_fields('lyly_contact_settings_group');
            $options = get_option('lyly_contact_settings', lyly_contact_manager_defaults());
            ?>

            <!-- SECTION 1: HOTLINE CHUNG & ZALO -->
            <div class="lyly-card">
                <div class="lyly-card-header">
                    <i class="fa-solid fa-comments"></i> Hotline tổng đặt phòng (Tự động tạo link Zalo)
                </div>
                <div class="lyly-card-body">
                    <div class="lyly-alert" style="background: #eff6ff; border-color: #3b82f6; color: #1e3a8a;">
                        <i class="fa-solid fa-circle-info"></i> Số điện thoại nhập ở đây sẽ hiển thị làm số Hotline
                        Reservations trên header. Khi khách hàng bấm các nút **"TÌM PHÒNG" / "CHECK AVAILABILITY"**, hệ
                        thống sẽ tự động chuyển hướng họ đến Zalo chat của số này để đặt phòng trực tuyến.
                    </div>
                    <div class="lyly-form-group">
                        <label class="lyly-label" for="general_phone">Hotline tổng / Số Zalo nhận phòng</label>
                        <input type="text" id="general_phone" name="lyly_contact_settings[general_phone]" class="lyly-input"
                            value="<?php echo esc_attr($options['general_phone']); ?>" placeholder="Ví dụ: 0941 871 644"
                            required />
                    </div>
                </div>
            </div>

            <!-- SECTION 2: CHI NHÁNH 1 -->
            <div class="lyly-card">
                <div class="lyly-card-header">
                    <i class="fa-solid fa-location-dot"></i> Chi Nhánh 1
                </div>
                <div class="lyly-card-body">
                    <div class="lyly-form-group">
                        <label class="lyly-label" for="branch_1_name">Tên chi nhánh 1</label>
                        <input type="text" id="branch_1_name" name="lyly_contact_settings[branch_1_name]" class="lyly-input"
                            value="<?php echo esc_attr($options['branch_1_name']); ?>" required />
                    </div>
                    <div class="lyly-form-group">
                        <label class="lyly-label" for="branch_1_address">Địa chỉ chi nhánh 1</label>
                        <input type="text" id="branch_1_address" name="lyly_contact_settings[branch_1_address]"
                            class="lyly-input" value="<?php echo esc_attr($options['branch_1_address']); ?>" required />
                    </div>
                    <div class="lyly-form-group">
                        <label class="lyly-label" for="branch_1_phone">Số điện thoại chi nhánh 1</label>
                        <input type="text" id="branch_1_phone" name="lyly_contact_settings[branch_1_phone]"
                            class="lyly-input" value="<?php echo esc_attr($options['branch_1_phone']); ?>" required />
                    </div>
                </div>
            </div>

            <!-- SECTION 3: CHI NHÁNH 2 -->
            <div class="lyly-card">
                <div class="lyly-card-header">
                    <i class="fa-solid fa-location-dot"></i> Chi Nhánh 2
                </div>
                <div class="lyly-card-body">
                    <div class="lyly-form-group">
                        <label class="lyly-label" for="branch_2_name">Tên chi nhánh 2</label>
                        <input type="text" id="branch_2_name" name="lyly_contact_settings[branch_2_name]" class="lyly-input"
                            value="<?php echo esc_attr($options['branch_2_name']); ?>" required />
                    </div>
                    <div class="lyly-form-group">
                        <label class="lyly-label" for="branch_2_address">Địa chỉ chi nhánh 2</label>
                        <input type="text" id="branch_2_address" name="lyly_contact_settings[branch_2_address]"
                            class="lyly-input" value="<?php echo esc_attr($options['branch_2_address']); ?>" required />
                    </div>
                    <div class="lyly-form-group">
                        <label class="lyly-label" for="branch_2_phone">Số điện thoại chi nhánh 2</label>
                        <input type="text" id="branch_2_phone" name="lyly_contact_settings[branch_2_phone]"
                            class="lyly-input" value="<?php echo esc_attr($options['branch_2_phone']); ?>" required />
                    </div>
                </div>
            </div>

            <div style="margin-top: 30px;">
                <input type="submit" class="lyly-submit-btn" value="Lưu Cấu Hình Cập Nhật" />
            </div>
        </form>
    </div>
    <?php
}
