<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', function () {
    Container::make('theme_options', 'Navbar Settings')
        ->add_fields([
            Field::make('image', 'navbar_logo', 'Navbar Logo'),
            Field::make('image', 'navbar_logo_retina', 'Navbar Logo Retina (2x)'),
            Field::make('complex', 'navbar_menu', 'Navigation Menu')
                ->set_layout('tabbed-horizontal')
                ->add_fields([
                    Field::make('text', 'label', 'Menu Label'),
                    Field::make('text', 'url', 'Menu URL'),
                    Field::make('checkbox', 'is_dropdown', 'Has Dropdown?'),
                    Field::make('complex', 'submenu', 'Dropdown Items')
                        ->set_layout('tabbed-vertical')
                        ->add_fields([
                            Field::make('text', 'label', 'Submenu Label'),
                            Field::make('text', 'url', 'Submenu URL'),
                        ])
                        ->set_conditional_logic([
                            [
                                'field' => 'is_dropdown',
                                'value' => true,
                            ]
                        ]),
                ]),
        ]);
});
