<?php 
/**
 * Template Name: Book Appointment
 * Template Post Type: page
 */

get_header();
 ?>

 <?php get_template_part('template-parts/nav'); ?>

<?php the_content(); ?>


<?php get_template_part('template-parts/offering'); ?>
<?php get_template_part('template-parts/journey-offering'); ?>
<?php get_template_part('template-parts/see-works'); ?>
<?php get_template_part('template-parts/question'); ?>
<?php get_template_part('template-parts/main-footer'); ?>

<?php get_footer(); ?>