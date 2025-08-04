<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', function() {
    Container::make( 'post_meta', 'Contact Details' )
        ->where( 'post_type', '=', 'page' )
        ->add_fields( array(
            Field::make( 'text', 'contact_address', 'Address' )
                ->set_default_value( 'Moon St. 14/05 Light, Jupiter' ),
            Field::make( 'text', 'contact_phone', 'Phone' )
                ->set_default_value( '0247 541 65 87' ),
            Field::make( 'text', 'contact_email', 'Email' )
                ->set_default_value( 'support@slowave.com' ),
            Field::make('textarea', 'contact_message', 'Contact Text')
                ->set_help_text('Lead paragraph content.')
        ) );
});
