<?php
/*
Template Name: Restaurant Page
*/
get_header();
get_template_part('template-parts/shared/booking-bar');
?>

<?php get_template_part('template-parts/dine/dine-restaurant'); ?>

<?php get_template_part('template-parts/shared/more'); ?>

<?php get_template_part('template-parts/shared/booking-modal'); ?>

<?php get_footer(); ?>
