<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', function () {
    Container::make('post_meta', 'Testimonial Settings')
        ->where('post_type', '=', 'testimonial')
        ->add_fields([
            Field::make('checkbox', 'testimonial_approved', 'Approved')
                ->set_option_value('yes'),
        ]);
});