
<?php 
/**
 * Template Name: Home Page
 * Template Post Type: page
 */

get_header();
 ?>

<!-- Your static HTML content from body-wrapper goes here -->
<!-- Eventually replace with WordPress dynamic template tags -->
<?php get_template_part('template-parts/nav'); ?>
<?php get_template_part('template-parts/banner'); ?>
<?php get_template_part('template-parts/offering'); ?>

<?php get_footer(); ?>
