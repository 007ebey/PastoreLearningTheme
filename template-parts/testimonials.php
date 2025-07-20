<?php 
$args = [
    'post_type' => 'testimonial',
    'post_status' => 'publish',
    'meta_query' => [
        [
            'key' => '_testimonial_approved',
            'value' => 'yes',
        ]
    ]
];

$query = new WP_Query($args);

if ($query->have_posts()) : ?>
    <div class="light-wrapper">
        <div class="container inner">
            <div class="section-title text-center">
                <h2>What Our Customers Think</h2>
                <span class="icon"><i class="icon-quote"></i></span>
            </div>
            <div class="row col-testimonials text-center">
                <?php while ($query->have_posts()) : $query->the_post(); ?>
                    <div class="col-sm-3">
                        <div class="arrow-box">
                            <div class="quote">
                                <p><?php echo get_the_content(); ?></p>
                            </div>
                        </div>
                        <span class="author"><?php echo get_the_title(); ?></span>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
<?php 
endif;

wp_reset_postdata();
?>
