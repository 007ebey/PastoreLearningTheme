<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', function () {
    Container::make('post_meta', 'Project Details')
        ->where('post_type', '=', 'project')
        ->add_fields([
            Field::make('text', 'project_client', 'Client'),
            Field::make('text', 'project_categories', 'Categories')
                ->set_help_text('Comma-separated list of categories (e.g., Branding, Illustration)'),
            Field::make('text', 'project_date', 'Project Date')
                ->set_help_text('e.g., 02 May 2013'),
            Field::make('text', 'project_link', 'External Link')
                ->set_help_text('e.g., https://example.com'),
            Field::make('text', 'project_video_url', 'YouTube url')
                ->set_help_text('Paste url example https://www.youtube.com/live/-KYc59DYLnu '),
            Field::make('text', 'thumb_nail_url', 'Thumb nail link')
                ->set_help_text('Provide thumb nail link example https://img.youtube.com/vi/XXXX/maxresdefault.jpg '),
      
        ]);
});
