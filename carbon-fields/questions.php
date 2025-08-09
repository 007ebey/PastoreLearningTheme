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
            Field::make('textarea', 'question_answer', 'Question Answer')
                ->set_help_text('Lead paragraph content.')
        ));
});

add_action('admin_post_nopriv_submit_question', 'handle_question_submission');
add_action('admin_post_submit_question', 'handle_question_submission');

function handle_question_submission() {
    $name = sanitize_text_field($_POST['name']);
    $email = sanitize_email($_POST['email']);
    $subject = sanitize_text_field($_POST['subject']);
    $message = sanitize_textarea_field($_POST['message']);

    $post_id = wp_insert_post([
        'post_title'   => wp_trim_words($message, 8, '...'),
        'post_content' => $message,
        'post_type'    => 'question',
        'post_status'  => 'pending'
    ]);

    if ($post_id && !is_wp_error($post_id)) {
        carbon_set_post_meta($post_id, 'question_name', $name);
        carbon_set_post_meta($post_id, 'question_email', $email);
        carbon_set_post_meta($post_id, 'question_subject', $subject);
    }

    $redirect_url = wp_get_referer();
    $redirect_url = add_query_arg( 'success', 1, $redirect_url );

    wp_safe_redirect( $redirect_url );
    exit;
}