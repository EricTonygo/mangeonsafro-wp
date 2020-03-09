<?php

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' && isset($_POST["action"]) && $_POST["action"] == "add-comment" && isset($_POST["post_id"])) {
        global $current_user;
        $post_id = intval(removeslashes(esc_attr(trim($_POST['post_id']))));
        $comment_content = removeslashes(esc_attr(trim($_POST['comment_content'])));
        $comment_parent = 0;
        if(!is_user_logged_in()){
            $comment_author = removeslashes(esc_attr(trim($_POST['comment_author'])));
            $comment_author_email = removeslashes(esc_attr(trim($_POST['comment_author_email'])));
            $comment_author_url = 'http://www.test.bledshare.com';
            $user_id = -1;
        }else{
            $comment_author = $current_user->user_login;
            $comment_author_email = $current_user->user_email;
            $comment_author_url = 'http://www.test.bledshare.com';
            $user_id = $current_user->ID;
        }
        $comment_data = array(
            'comment_post_ID' => $post_id,
            'comment_author'=>$comment_author,
            'comment_author_email' => $comment_author_email,
            'comment_author_url' => $comment_author_url,
            'comment_content' => $comment_content,
            'comment_parent' => $comment_parent,
            'user_id'=> $user_id
        );
        $comment_id = add_post_comment($comment_data);
        if ($comment_id == null || is_wp_error($comment_id)) {
            $json = array("message" => __("Unable to add comment to this review", "gpdealdomain"));
            return wp_send_json_error($json);
        }
        $json = array("message" => __("Comment added successfully", "gpdealdomain"));
        return wp_send_json_success($json);
    } elseif (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' && isset($_POST["action"]) && $_POST["action"] == "add-comment-reply" && isset($_POST["post_id"]) && isset($_POST["comment_parent_id"])) {
        $post_id = intval(removeslashes(esc_attr(trim($_POST['post_id']))));
        $comment_content = removeslashes(esc_attr(trim($_POST['comment_content'])));
        $comment_parent = intval(removeslashes(esc_attr(trim($_POST['comment_parent_id']))));
        if(!is_user_logged_in()){
            $comment_author = removeslashes(esc_attr(trim($_POST['comment_author'])));
            $comment_author_email = removeslashes(esc_attr(trim($_POST['comment_author_email'])));
            $comment_author_url = 'http://www.test.bledshare.com';
            $user_id = -1;
        }else{
            $comment_author = $current_user->user_login;
            $comment_author_email = $current_user->user_email;
            $comment_author_url = 'http://www.test.bledshare.com';
            $user_id = $current_user->ID;
        }
        $comment_reply_data = array(
            'comment_post_ID' => $post_id,
            'comment_author'=>$comment_author,
            'comment_author_email' => $comment_author_email,
            'comment_author_url' => $comment_author_url,
            'comment_content' => $comment_content,
            'comment_parent' => $comment_parent,
            'user_id' => $user_id
        );
        $comment_reply_id = add_comment_reply($comment_reply_data);
        if ($comment_reply_id == null || is_wp_error($comment_reply_id)) {
            $json = array("message" => __("Unable to add response to this comment", "gpdealdomain"));
            return wp_send_json_error($json);
        }
        $json = array("message" => __("Successfully replied", "gpdealdomain"));
        return wp_send_json_success($json);
    }
} elseif (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET') {
    get_header();
    $post_author = get_post_field('post_author', get_the_ID());
    include(locate_template('blog/content-single-post.php'));
    get_footer();
}
