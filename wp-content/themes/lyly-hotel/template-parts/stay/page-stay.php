<?php
/*
Template Name: Stay Page
*/
get_header();
?>

<main class="stay-page">
    <?php get_template_part('template-parts/stay/stay-hero'); ?>
    <?php get_template_part('template-parts/stay/stay-rooms'); ?>
</main>

<?php get_template_part('template-parts/shared/booking-modal'); ?>

<?php get_footer(); ?>

