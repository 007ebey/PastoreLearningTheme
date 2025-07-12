<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make('post_meta', 'Page: Services Section')
    ->where('post_type', '=', 'page')
    ->add_fields([
        Field::make('text', 'services_section_title', 'Section Title')
            ->set_default_value('What We Do'),

        Field::make('text', 'services_section_icon', 'Section Icon Class')
            ->set_default_value('icon-cog-1'),

        Field::make('complex', 'services_items', 'Service Items')
            ->set_layout('tabbed-vertical')
            ->add_fields([
                Field::make('text', 'icon_class', 'Icon Class')
                    ->set_default_value('icon-picons-printer')
                    ->set_help_text('Enter the full icon class, e.g., icon-picons-printer'),
                
                Field::make('text', 'title', 'Title')
                    ->set_default_value('Service Title'),
                
                Field::make('textarea', 'description', 'Description')
                    ->set_rows(3),
            ])
    ]);
