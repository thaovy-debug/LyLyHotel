<?php
/**
 * Template Part: Shared - Booking Bar
 */
?>
<style>
    .global-booking-bar {
        background-color: #ffcc66;
        color: #fff;
        text-align: center;
        padding: 12px 0;
        cursor: pointer;
        font-family: "Times New Roman", Times, serif;
        text-transform: uppercase;
        letter-spacing: 2px;
        font-weight: bold;
        transition: background-color 0.3s;
        z-index: 99;
        position: relative;
    }
    .global-booking-bar:hover {
        background-color: #f1a92e;
    }
    @media (max-width: 768px) {
        .global-booking-bar {
            padding: 10px 0;
            font-size: 0.9rem;
        }
    }
</style>

<div class="global-booking-bar" data-bs-toggle="modal" data-bs-target="#checkrateFormModal">
    BOOK NOW
</div>
