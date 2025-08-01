<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', function () {
    Container::make('theme_options', __('Footer Settings'))
        ->add_fields([
            Field::make('image', 'footer_logo_1x', 'Footer Logo 1x'),
            Field::make('image', 'footer_logo_2x', 'Footer Logo 2x'),
            Field::make('textarea', 'footer_description', 'Footer Description')->set_rows(3),
            Field::make('textarea', 'footer_secondary_description', 'Footer Secondary Description')->set_rows(3),
            Field::make('text', 'footer_address', 'Address'),
            Field::make('text', 'footer_phone', 'Phone'),
            Field::make('text', 'footer_email', 'Email'),
            Field::make('text', 'footer_copyright', 'Copyright'),
            Field::make('complex', 'footer_socials', 'Social Links')
                ->add_fields([
                    Field::make('text', 'icon_class', 'Icon Class'),
                    Field::make('text', 'url', 'URL'),
                ]),
            Field::make('complex', 'footer_menu', 'Footer Menu')
                ->add_fields([
                    Field::make('text', 'label', 'Label'),
                    Field::make('text', 'link', 'Link (#section-id or URL)'),
                ]),
        ]);
});
