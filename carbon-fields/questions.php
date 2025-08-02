<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', function() {
    Container::make('post_meta', 'Question Details')
        ->where('post_type', '=', 'question')
        ->add_fields(array(
            Field::make('text', 'question_name', 'Name')->set_required(true),
            Field::make('text', 'question_email', 'Email')->set_required(true),
            Field::make('text', 'question_subject', 'Subject'),
        ));
});
