<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make('post_meta', 'Tabs Section')
    ->where('post_type', '=', 'page') // restrict to Pages
    ->add_fields([
        Field::make('complex', 'page_tabs_section', 'Tabs Section')
            ->set_layout('tabbed-vertical')
            ->add_fields([
                Field::make('text', 'tab_id', 'Tab ID')
                    ->set_default_value('tab-1')
                    ->set_help_text('Unique anchor ID like "tab-1". Used for tab linking.'),
                Field::make('text', 'tab_title', 'Tab Title')
                    ->set_help_text('Label shown below the icon.'),
                Field::make('text', 'icon_class', 'Icon Class')
                    ->set_default_value('icon-picons-bulb')
                    ->set_help_text('CSS class like icon-picons-rocket, icon-picons-award, etc.'),
                Field::make('text', 'block_title', 'Block Title')
                    ->set_help_text('Main heading (use <span class="colored">...<span> if needed)'),
                Field::make('textarea', 'block_text', 'Block Text')
                    ->set_help_text('Lead paragraph content.')
            ])
    ]);
