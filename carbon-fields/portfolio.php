<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field\Field;

add_action('carbon_fields_register_fields', function () {
    Container::make('post_meta', 'Project Details')
        ->where('post_type', '=', 'project')
        ->add_fields([
            Field::make('text', 'project_meta', 'Project Meta (e.g. Logo, Corporate)'),
        ]);
});