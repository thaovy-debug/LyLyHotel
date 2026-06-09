<?php
// Register Custom Post Type cho Ưu đãi
function lyly_register_offer_cpt() {
    $labels = array(
        'name'                  => _x( 'Ưu đãi', 'Post Type General Name', 'lyly-hotel' ),
        'singular_name'         => _x( 'Ưu đãi', 'Post Type Singular Name', 'lyly-hotel' ),
        'menu_name'             => __( 'Ưu đãi', 'lyly-hotel' ),
        'name_admin_bar'        => __( 'Ưu đãi', 'lyly-hotel' ),
        'archives'              => __( 'Lưu trữ Ưu đãi', 'lyly-hotel' ),
        'attributes'            => __( 'Thuộc tính Ưu đãi', 'lyly-hotel' ),
        'parent_item_colon'     => __( 'Ưu đãi cha:', 'lyly-hotel' ),
        'all_items'             => __( 'Tất cả Ưu đãi', 'lyly-hotel' ),
        'add_new_item'          => __( 'Thêm Ưu đãi mới', 'lyly-hotel' ),
        'add_new'               => __( 'Thêm mới', 'lyly-hotel' ),
        'new_item'              => __( 'Ưu đãi mới', 'lyly-hotel' ),
        'edit_item'             => __( 'Sửa Ưu đãi', 'lyly-hotel' ),
        'update_item'           => __( 'Cập nhật Ưu đãi', 'lyly-hotel' ),
        'view_item'             => __( 'Xem Ưu đãi', 'lyly-hotel' ),
        'view_items'            => __( 'Xem Ưu đãi', 'lyly-hotel' ),
        'search_items'          => __( 'Tìm kiếm Ưu đãi', 'lyly-hotel' ),
        'not_found'             => __( 'Không tìm thấy', 'lyly-hotel' ),
        'not_found_in_trash'    => __( 'Không tìm thấy trong thùng rác', 'lyly-hotel' ),
        'featured_image'        => __( 'Ảnh đại diện Ưu đãi', 'lyly-hotel' ),
        'set_featured_image'    => __( 'Đặt ảnh đại diện', 'lyly-hotel' ),
        'remove_featured_image' => __( 'Xóa ảnh đại diện', 'lyly-hotel' ),
        'use_featured_image'    => __( 'Sử dụng làm ảnh đại diện', 'lyly-hotel' ),
        'insert_into_item'      => __( 'Chèn vào Ưu đãi', 'lyly-hotel' ),
        'uploaded_to_this_item' => __( 'Được tải lên cho Ưu đãi này', 'lyly-hotel' ),
        'items_list'            => __( 'Danh sách Ưu đãi', 'lyly-hotel' ),
        'items_list_navigation' => __( 'Điều hướng danh sách Ưu đãi', 'lyly-hotel' ),
        'filter_items_list'     => __( 'Lọc danh sách Ưu đãi', 'lyly-hotel' ),
    );
    $args = array(
        'label'                 => __( 'Ưu đãi', 'lyly-hotel' ),
        'description'           => __( 'Quản lý các ưu đãi của khách sạn', 'lyly-hotel' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-tickets-alt',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
    );
    register_post_type( 'lyly_offer', $args );
}
add_action( 'init', 'lyly_register_offer_cpt', 0 );

// Thêm Meta Box trạng thái (để ẩn/hiện)
function lyly_offer_add_meta_boxes() {
    add_meta_box(
        'lyly_offer_status_meta',
        __( 'Trạng thái ưu đãi', 'lyly-hotel' ),
        'lyly_offer_status_meta_callback',
        'lyly_offer',
        'side',
        'high'
    );
}
add_action( 'add_meta_boxes', 'lyly_offer_add_meta_boxes' );

function lyly_offer_status_meta_callback( $post ) {
    wp_nonce_field( 'lyly_offer_save_meta', 'lyly_offer_meta_nonce' );
    $status = get_post_meta( $post->ID, '_lyly_offer_status', true );
    if ( empty( $status ) ) {
        $status = 'active'; // Mặc định là hiển thị
    }
    ?>
    <p>
        <label for="lyly_offer_status"><strong>Trạng thái hiển thị ngoài website:</strong></label><br><br>
        <select name="lyly_offer_status" id="lyly_offer_status" style="width:100%;">
            <option value="active" <?php selected( $status, 'active' ); ?>>Hiển thị</option>
            <option value="inactive" <?php selected( $status, 'inactive' ); ?>>Ẩn (Tạm ngưng)</option>
        </select>
    </p>
    <p class="description">Chọn "Ẩn" nếu bạn muốn giữ lại ưu đãi này để tái sử dụng sau này mà không hiển thị ra ngoài website.</p>
    <?php
}

function lyly_offer_save_meta( $post_id ) {
    if ( ! isset( $_POST['lyly_offer_meta_nonce'] ) ) {
        return;
    }
    if ( ! wp_verify_nonce( $_POST['lyly_offer_meta_nonce'], 'lyly_offer_save_meta' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    if ( isset( $_POST['lyly_offer_status'] ) ) {
        update_post_meta( $post_id, '_lyly_offer_status', sanitize_text_field( $_POST['lyly_offer_status'] ) );
    }
}
add_action( 'save_post_lyly_offer', 'lyly_offer_save_meta' );
