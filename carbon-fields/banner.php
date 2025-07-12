<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', function () {
  Container::make('post_meta', __('Page Slider'))
    ->where('post_type', '=', 'page')
    ->add_fields([
      Field::make('complex', 'page_slider_slides', 'Slides')
        ->set_layout('tabbed-horizontal')
        ->add_fields([
          Field::make('image', 'background', 'Background Image'),
          Field::make('complex', 'text_elements', 'Text Elements')
            ->set_layout('tabbed-vertical')
            ->add_fields([
              Field::make('textarea', 'title', 'Slide Text'),
              Field::make('text', 'title_style_class', 'Text Style Class') // e.g. bold, lite, lite small
                ->set_help_text('CSS classes like huge, big, small, bold,lite,lite small,dark,opacity-bg.'),
              Field::make('text', 'title_incoming_animation_class', 'Text Incoming Animation Class') // e.g. sfb, lft
                ->set_help_text('Incoming animation class, e.g., sft - Short from Top
                              sfb - Short from Bottom
                              sfr - Short from Right
                              sfl - Short from Lef
                              lft - Long from Top
                              lfb - Long from Bottom
                              lfr - Long from Right
                              lfl - Long from Left
                              skewfromleft - Skew from Left
                              skewfromright - Skew from Right
                              skewfromleftshort - Skew Short from Left
                              skewfromrightshort - Skew Short from Right
                              fade - fading
                              randomrotate- Fade in, Rotate from a Random position and Degree
              '),
              Field::make('text', 'title_outgoing_animation_class', 'Text Outgoing Animation Class') // e.g. sfb, lft
                ->set_help_text('Outgoing animation class, stt - Short to Top
                            stb - Short to Bottom
                            str - Short to Right
                            stl - Short to Left
                            ltt - Long to Top
                            ltb - Long to Bottom
                            ltr - Long to Right
                            ltl - Long to Left
                            skewtoleft - Skew to Left
                            skewtoright - Skew to Right
                            skewtoleftshort - Skew Short to Left
                            skewtorightshort - Skew Short to Right
                            fadeout - fading
                            randomrotateout- Fade in, Rotate from a Random position and Degree
                            customout - Custom Outgoing Animation - see below all data settings
              '),
              Field::make('text', 'title_data_x', 'Text Data-X')->set_default_value('center'),
              Field::make('text', 'title_data_y', 'Text Data-Y')->set_default_value('198'),
              Field::make('text', 'title_data_speed', 'Text Speed')->set_default_value('900'),
              Field::make('text', 'title_data_start', 'Text Start Time')->set_default_value('800'),
              Field::make('text', 'title_data_easing', 'Text Easing')->set_default_value('Sine.easeOut')
            ]),
          Field::make('complex', 'image_elements', 'Image Elements')
            ->set_layout('tabbed-vertical')
            ->add_fields([
              Field::make('image', 'slide_image', 'Image'),
              Field::make('text', 'title_style_class', 'Image Style Class') // e.g. bold, lite, lite small
                ->set_help_text('CSS classes like huge, big, small, bold,lite,lite small,dark,opacity-bg.'),
              Field::make('text', 'title_incoming_animation_class', 'Image Incoming Animation Class') // e.g. sfb, lft
                ->set_help_text('Incoming animation class, e.g., sft - Short from Top
                              sfb - Short from Bottom
                              sfr - Short from Right
                              sfl - Short from Lef
                              lft - Long from Top
                              lfb - Long from Bottom
                              lfr - Long from Right
                              lfl - Long from Left
                              skewfromleft - Skew from Left
                              skewfromright - Skew from Right
                              skewfromleftshort - Skew Short from Left
                              skewfromrightshort - Skew Short from Right
                              fade - fading
                              randomrotate- Fade in, Rotate from a Random position and Degree
              '),
              Field::make('text', 'title_outgoing_animation_class', 'Image Outgoing Animation Class') // e.g. sfb, lft
                ->set_help_text('Outgoing animation class, stt - Short to Top
                            stb - Short to Bottom
                            str - Short to Right
                            stl - Short to Left
                            ltt - Long to Top
                            ltb - Long to Bottom
                            ltr - Long to Right
                            ltl - Long to Left
                            skewtoleft - Skew to Left
                            skewtoright - Skew to Right
                            skewtoleftshort - Skew Short to Left
                            skewtorightshort - Skew Short to Right
                            fadeout - fading
                            randomrotateout- Fade in, Rotate from a Random position and Degree
                            customout - Custom Outgoing Animation - see below all data settings
              '),
              Field::make('text', 'title_data_x', 'Image Data-X')->set_default_value('center'),
              Field::make('text', 'title_data_y', 'Image Data-Y')->set_default_value('198'),
              Field::make('text', 'title_data_speed', 'Image Speed')->set_default_value('900'),
              Field::make('text', 'title_data_start', 'Image Start Time')->set_default_value('800'),
              Field::make('text', 'title_data_easing', 'Image Easing')->set_default_value('Sine.easeOut')
            ]),
          Field::make('checkbox', 'show_button', 'Show Button'),
          Field::make('text', 'button_text', 'Button Text')
            ->set_conditional_logic([
              [
                'field' => 'show_button',
                'value' => true,
              ]
            ]),
          Field::make('text', 'button_url', 'Button URL')
            ->set_conditional_logic([
              [
                'field' => 'show_button',
                'value' => true,
              ]
            ]),
          Field::make('text', 'button_animation_class', 'Button Animation Class')
            ->set_conditional_logic([
              [
                'field' => 'show_button',
                'value' => true,
              ]
            ]),
          Field::make('text', 'button_data_x', 'Button Data-X')
            ->set_default_value('center')
            ->set_conditional_logic([
              [
                'field' => 'show_button',
                'value' => true,
              ]
            ]),
          Field::make('text', 'button_data_y', 'Button Data-Y')
            ->set_default_value('353')
            ->set_conditional_logic([
              [
                'field' => 'show_button',
                'value' => true,
              ]
            ]),
          Field::make('text', 'button_data_speed', 'Button Speed')
            ->set_default_value('900')
            ->set_conditional_logic([
              [
                'field' => 'show_button',
                'value' => true,
              ]
            ]),
          Field::make('text', 'button_data_start', 'Button Start')
            ->set_default_value('2200')
            ->set_conditional_logic([
              [
                'field' => 'show_button',
                'value' => true,
              ]
            ]),
          Field::make('text', 'button_data_easing', 'Button Easing')
            ->set_conditional_logic([
              [
                'field' => 'show_button',
                'value' => true,
              ]
            ]),
        ])

    ]);
});
