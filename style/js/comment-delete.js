console.log(jQuery)
jQuery(document).on('click', '.delete-comment', function (e) {
    console.log('Its working')
    e.preventDefault();

    if (!confirm('Are you sure you want to delete this comment?')) return;

    const commentId = jQuery(this).data('comment-id');

    jQuery.ajax({
        url: commentDelete.ajax_url,
        type: 'POST',
        data: {
            action: 'delete_comment',
            nonce: commentDelete.nonce,
            comment_id: commentId
        },
        success: function (response) {
            if (response.success) {
                jQuery('#comment-' + response.data.comment_id).fadeOut(300, function () {
                    jQuery(this).remove();
                });
            } else {
                alert(response.data || 'Failed to delete comment.');
            }
        },
        error: function () {
            alert('Something went wrong. Try again.');
        }
    });
});
