<?php

session_start();
wp_reset_postdata();
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' && isset($_POST["action"]) && $_POST["action"] == "add-message-reply" && isset($_POST["message_id"]) && isset($_POST["message_reply"])) {
            $message_id = intval(removeslashes(esc_attr(trim($_POST['message_id']))));
            $message_reply = removeslashes(esc_attr(trim($_POST['message_reply'])));
            $comment_id = add_message_comment($message_id, $message_reply);
            if ($comment_id == null || is_wp_error($comment_id)) {
                $json = array("message" => __("Unable to send confirmation for this message", "booksharedomain"));
                return wp_send_json_error($json);
            }
            $post_referred_id = get_post_meta(get_the_ID(), "post-ID", true);
            if(get_post_type($post_referred_id) == 'publications_cpt'){
                send_email_message_reply_for_book(get_the_ID());
                send_sms_message_reply_for_book(get_the_ID());
            }elseif(get_post_type($post_referred_id) == 'alerts_cpt'){
                send_email_message_reply_for_alert(get_the_ID());
                send_sms_message_reply_for_alert(get_the_ID());
            }
            $json = array("message" => __("Confirmation sended successfully", "booksharedomain"));
            return wp_send_json_success($json);
        }
}


