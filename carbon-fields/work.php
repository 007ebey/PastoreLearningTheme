<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'crb_register_portfolio_meta');
function crb_register_portfolio_meta() {
    Container::make('post_meta', __('Portfolio Details'))
        ->where('post_type', '=', 'portfolio')
        ->add_fields(array(
            Field::make('text', 'video_url', 'Video URL')
                ->set_help_text('Use embed URL like https://player.vimeo.com/video/XXXX or https://www.youtube.com/embed/XXXX'),

            Field::make('text', 'client_name', 'Speaker Name'),

            Field::make('text', 'thumb_nail_url', 'Thumb nail link')
                ->set_help_text('Provide thumb nail link example https://img.youtube.com/vi/XXXX/mqdefault.jpg '),
        ));
}

