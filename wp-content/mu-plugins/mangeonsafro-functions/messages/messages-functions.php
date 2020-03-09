<?php

function saveMessage($message_data) {
    if (is_user_logged_in()) {
        $post_author = get_current_user_id();
    } else {
        if ($message_data["user_email"] && get_user_by("email", $message_data["user_email"])) {
            $post_author = get_user_by("email", $message_data["user_email"])->ID;
        } else {
            $post_author = -1;
        }
    }
    $date = new DateTime('now');
    $post_title = str_replace(":", "", str_replace("-", "", str_replace(" ", "", "Msge" . $date->format('Y-m-d H:i:s') . $date->getTimestamp())));
    $post_args = array(
        'post_title' => wp_strip_all_tags($post_title),
        'post_type' => 'messages_cpt',
        'post_content' => $message_data["message_content"],
        'post_author' => $post_author,
        'post_status' => 'publish',
        'meta_input' => array(
            'message-user-email' => $message_data["user_email"],
            'message-user-phone-number' => $message_data["user_phone_number"],
            'message-user-name' => $message_data["user_name"],
            'post-ID' => $message_data["post_id"]
        )
    );
    $message_id = wp_insert_post($post_args, true);
    return $message_id;
}

function send_email_new_message_for_book($message_id) {
    $headers[] = 'MIME-Version: 1.0';
    $headers[] = 'Content-Type: text/html; charset=UTF-8';
    $headers[] = 'From: BledShare <infos@bledshare.com>';
    $headers[] = 'Bcc:<erictonyelissouck@yahoo.fr>';

    $sender_email = get_post_meta($message_id, "message-user-email", true);
    $sender_phone_number = get_post_meta($message_id, "message-user-phone-number", true);
    $sender_user_name = get_post_meta($message_id, "message-user-name", true);
    $post_referred_id = get_post_meta($message_id, "post-ID", true);
    $post_referred_user = get_user_by('id', get_post_field('post_author', $post_referred_id));

    $subject = $post_referred_user->data->display_name . ", " . $sender_user_name . " " . __("want to get your book", "booksharedomain") . ": <<" . get_post_field('post_title', $post_referred_id) . ">>";
    ob_start();
    ?>
    <div style="font-size: 12.8px;"><?php echo __("Hello", "booksharedomain"); ?> <?php echo $post_referred_user->data->display_name; ?> ! </div>
    <div><br></div>
    <div style="font-size: 12.8px;"><?php echo $sender_user_name; ?> <?php _e("want to get your book", "booksharedomain"); ?>: <a href="<?php echo get_permalink($post_referred_id); ?>" ><?php echo get_post_field('post_title', $post_referred_id); ?></a>. <?php _e("You can get his contact information below", "booksharedomain"); ?></div>
    <div><br></div>
    <div style="font-size: 12.8px;"><?php _e("Email", "booksharedomain"); ?>: <?php echo $sender_email; ?></div>
    <div style="font-size: 12.8px;"><?php _e("Phone number", "booksharedomain"); ?>: <?php echo $sender_phone_number; ?></div>
    <div><br></div>
    <div style="font-size: 12.8px;"><?php _e("If this book is not availabe", "booksharedomain"); ?>, <?php _e("you can", "booksharedomain") ?> <a href="<?php echo esc_url(add_query_arg(array('action' => "put-offline"), get_permalink($post_referred_id))) ?>"><?php _e("put it offline here", "booksharedomain"); ?></a> <?php _e("or", "booksharedomain"); ?> <a href="<?php echo esc_url(add_query_arg(array('action' => "delete"), get_permalink($post_referred_id))) ?>"><?php _e("delete it here", "booksharedomain"); ?></a></div>
    <div><br></div>
    <div>
        <p style="margin:0px;padding:0px;border:0px;font-size:12.8px;font-stretch:normal;line-height:normal;font-family:Tahoma;width:auto;height:auto;float:none;color:rgb(0,0,0)"><?php _e("Thank you for using Bledshare", "booksharedomain"); ?>,</p>
        <p style="margin:0px 0px 1em;padding:0px;border:0px;font-size:12.8px;font-stretch:normal;line-height:normal;font-family:Tahoma;width:auto;height:auto;float:none;color:rgb(0,0,0)"><?php _e("Your BledShare team", "booksharedomain"); ?>.</p>
    </div>

    <?php
    $body = ob_get_contents();
    ob_end_clean();
    wp_mail($post_referred_user->data->user_email, $subject, $body, $headers);
}

function send_email_new_message_for_alert($message_id) {
    $headers[] = 'MIME-Version: 1.0';
    $headers[] = 'Content-Type: text/html; charset=UTF-8';
    $headers[] = 'From: BledShare <infos@bledshare.com>';
    $headers[] = 'Bcc:<erictonyelissouck@yahoo.fr>';

    $sender_email = get_post_meta($message_id, "message-user-email", true);
    $sender_phone_number = get_post_meta($message_id, "message-user-phone-number", true);
    $sender_user_name = get_post_meta($message_id, "message-user-name", true);
    $post_referred_id = get_post_meta($message_id, "post-ID", true);
    $post_referred_user = get_user_by('id', get_post_field('post_author', $post_referred_id));

    $subject = $post_referred_user->data->display_name . ", " . $sender_user_name . " " . __("want to solve your alert", "booksharedomain") . ": <<" . get_post_field('post_title', $post_referred_id) . ">>";
    ob_start();
    ?>
    <div style="font-size: 12.8px;"><?php echo __("Hello", "booksharedomain"); ?> <?php echo $post_referred_user->data->display_name; ?> ! </div>
    <div><br></div>
    <div style="font-size: 12.8px;"><?php echo $sender_user_name; ?> <?php _e("have a book that can solve your alert", "booksharedomain"); ?>: <a href="<?php echo get_permalink($post_referred_id); ?>" ><?php echo get_post_field('post_title', $post_referred_id); ?></a>. <?php _e("You can get his contact information below", "booksharedomain"); ?></div>
    <div><br></div>
    <div style="font-size: 12.8px;"><?php _e("Email", "booksharedomain"); ?>: <?php echo $sender_email; ?></div>
    <div style="font-size: 12.8px;"><?php _e("Phone number", "booksharedomain"); ?>: <?php echo $sender_phone_number; ?></div>
    <div><br></div>
    <div style="font-size: 12.8px;"><?php _e("If this alert is not availabe", "booksharedomain"); ?>, <?php _e("you can", "booksharedomain") ?> <a href="<?php echo esc_url(add_query_arg(array('action' => "put-offline"), get_permalink($post_referred_id))) ?>"><?php _e("put it offline here", "booksharedomain"); ?></a> <?php _e("or", "booksharedomain"); ?> <a href="<?php echo esc_url(add_query_arg(array('action' => "delete"), get_permalink($post_referred_id))) ?>"><?php _e("delete it here", "booksharedomain"); ?></a></div>
    <div><br></div>
    <div>
        <p style="margin:0px;padding:0px;border:0px;font-size:12.8px;font-stretch:normal;line-height:normal;font-family:Tahoma;width:auto;height:auto;float:none;color:rgb(0,0,0)"><?php _e("Thank you for using Bledshare", "booksharedomain"); ?>,</p>
        <p style="margin:0px 0px 1em;padding:0px;border:0px;font-size:12.8px;font-stretch:normal;line-height:normal;font-family:Tahoma;width:auto;height:auto;float:none;color:rgb(0,0,0)"><?php _e("Your BledShare team", "booksharedomain"); ?>.</p>
    </div>

    <?php
    $body = ob_get_contents();
    ob_end_clean();
    wp_mail($post_referred_user->data->user_email, $subject, $body, $headers);
}

function send_email_message_reply_for_book($message_id) {
    $headers[] = 'MIME-Version: 1.0';
    $headers[] = 'Content-Type: text/html; charset=UTF-8';
    $headers[] = 'From: BledShare <infos@bledshare.com>';
    $headers[] = 'Bcc:<erictonyelissouck@yahoo.fr>';

    $sender_email = get_post_meta($message_id, "message-user-email", true);
    $sender_user_name = get_post_meta($message_id, "message-user-name", true);
    $post_referred_id = get_post_meta($message_id, "post-ID", true);
    $post_referred_user = get_user_by('id', get_post_field('post_author', $post_referred_id));
    $post_referred_user_email = $post_referred_user->data->user_email;
    $post_referred_user_phone_number = get_user_meta($post_referred_user->ID, "user-country-code", true)."".get_user_meta($post_referred_user->ID, "user-phone-number", true);

    $subject = $sender_user_name . ", " . $post_referred_user->data->display_name . " " . __("has validated your request", "booksharedomain") . ": <<" . get_post_field('post_title', $post_referred_id) . ">>";
    ob_start();
    ?>
    <div style="font-size: 12.8px;"><?php echo __("Hello", "booksharedomain"); ?> <?php echo $sender_user_name; ?> ! </div>
    <div><br></div>
    <div style="font-size: 12.8px;"><?php echo $post_referred_user->data->display_name; ?> <?php _e("has validated your request for getting his book", "booksharedomain"); ?>: <a href="<?php echo get_permalink($post_referred_id); ?>" ><?php echo get_post_field('post_title', $post_referred_id); ?></a>. <?php _e("You can get his contact information below", "booksharedomain"); ?></div>
    <div><br></div>
    <div style="font-size: 12.8px;"><?php _e("Email", "booksharedomain"); ?>: <?php echo $post_referred_user_email; ?></div>
    <div style="font-size: 12.8px;"><?php _e("Phone number", "booksharedomain"); ?>: <?php echo $post_referred_user_phone_number; ?></div>
    <div><br></div>
    <div>
        <p style="margin:0px;padding:0px;border:0px;font-size:12.8px;font-stretch:normal;line-height:normal;font-family:Tahoma;width:auto;height:auto;float:none;color:rgb(0,0,0)"><?php _e("Thank you for using Bledshare", "booksharedomain"); ?>,</p>
        <p style="margin:0px 0px 1em;padding:0px;border:0px;font-size:12.8px;font-stretch:normal;line-height:normal;font-family:Tahoma;width:auto;height:auto;float:none;color:rgb(0,0,0)"><?php _e("Your BledShare team", "booksharedomain"); ?>.</p>
    </div>

    <?php
    $body = ob_get_contents();
    ob_end_clean();
    wp_mail($sender_email, $subject, $body, $headers);
}


function send_email_message_reply_for_alert($message_id) {
    $headers[] = 'MIME-Version: 1.0';
    $headers[] = 'Content-Type: text/html; charset=UTF-8';
    $headers[] = 'From: BledShare <infos@bledshare.com>';
    $headers[] = 'Bcc:<erictonyelissouck@yahoo.fr>';

    $sender_email = get_post_meta($message_id, "message-user-email", true);
    $sender_user_name = get_post_meta($message_id, "message-user-name", true);
    $post_referred_id = get_post_meta($message_id, "post-ID", true);
    $post_referred_user = get_user_by('id', get_post_field('post_author', $post_referred_id));
    $post_referred_user_email = $post_referred_user->data->user_email;
    $post_referred_user_phone_number = get_user_meta($post_referred_user->ID, "user-country-code", true)."".get_user_meta($post_referred_user->ID, "user-phone-number", true);

    $subject = $sender_user_name . ", " . $post_referred_user->data->display_name . " " . __("has validated your request", "booksharedomain") . ": <<" . get_post_field('post_title', $post_referred_id) . ">>";
    ob_start();
    ?>
    <div style="font-size: 12.8px;"><?php echo __("Hello", "booksharedomain"); ?> <?php echo $sender_user_name; ?> ! </div>
    <div><br></div>
    <div style="font-size: 12.8px;"><?php echo $post_referred_user->data->display_name; ?> <?php _e("has validated your request for solving his alert", "booksharedomain"); ?>: <a href="<?php echo get_permalink($post_referred_id); ?>" ><?php echo get_post_field('post_title', $post_referred_id); ?></a>. <?php _e("You can get his contact information below", "booksharedomain"); ?></div>
    <div><br></div>
    <div style="font-size: 12.8px;"><?php _e("Email", "booksharedomain"); ?>: <?php echo $post_referred_user_email; ?></div>
    <div style="font-size: 12.8px;"><?php _e("Phone number", "booksharedomain"); ?>: <?php echo $post_referred_user_phone_number; ?></div>
    <div><br></div>
    <div>
        <p style="margin:0px;padding:0px;border:0px;font-size:12.8px;font-stretch:normal;line-height:normal;font-family:Tahoma;width:auto;height:auto;float:none;color:rgb(0,0,0)"><?php _e("Thank you for using Bledshare", "booksharedomain"); ?>,</p>
        <p style="margin:0px 0px 1em;padding:0px;border:0px;font-size:12.8px;font-stretch:normal;line-height:normal;font-family:Tahoma;width:auto;height:auto;float:none;color:rgb(0,0,0)"><?php _e("Your BledShare team", "booksharedomain"); ?>.</p>
    </div>

    <?php
    $body = ob_get_contents();
    ob_end_clean();
    wp_mail($sender_email, $subject, $body, $headers);
}


function send_sms_message_reply_for_book($message_id){
    $sender_phone_number = get_post_meta($message_id, "message-user-phone-number", true);
    $sender_user_name = get_post_meta($message_id, "message-user-name", true);
    $post_referred_id = get_post_meta($message_id, "post-ID", true);
    $post_referred_user = get_user_by('id', get_post_field('post_author', $post_referred_id));
    $post_referred_user_phone_number = get_user_meta($post_referred_user->ID, "user-country-code", true)."".get_user_meta($post_referred_user->ID, "user-phone-number", true);
    $sms_content = $sender_user_name . ", " . $post_referred_user->data->display_name . " " . __("has validated your request for getting his book", "booksharedomain") . ": " . get_post_field('post_title', $post_referred_id) . " You can contact him at: ".$post_referred_user_phone_number;
    sendSMS($sender_phone_number, $sms_content);
}

function send_sms_message_reply_for_alert($message_id){
    $sender_phone_number = get_post_meta($message_id, "message-user-phone-number", true);
    $sender_user_name = get_post_meta($message_id, "message-user-name", true);
    $post_referred_id = get_post_meta($message_id, "post-ID", true);
    $post_referred_user = get_user_by('id', get_post_field('post_author', $post_referred_id));
    $post_referred_user_phone_number = get_user_meta($post_referred_user->ID, "user-country-code", true)."".get_user_meta($post_referred_user->ID, "user-phone-number", true);
    $sms_content = $sender_user_name . ", " . $post_referred_user->data->display_name . " " . __("has validated your request for solving his alert", "booksharedomain") . ": " . get_post_field('post_title', $post_referred_id) . " You can contact him at: ".$post_referred_user_phone_number;
    sendSMS($sender_phone_number, $sms_content);
}

//Function for adding a comment to a message 
function add_message_comment($message_id, $comment_content) {
    global $current_user;
    $comment_id = null;
    if ($message_id) {
        $commentdata = array(
            'comment_post_ID' => $message_id, // to which post the comment will show up
            'comment_author' => $current_user->user_login, //fixed value - can be dynamic 
            'comment_author_email' => $current_user->user_email, //fixed value - can be dynamic 
            'comment_author_url' => 'http://bledshare.com', //fixed value - can be dynamic 
            'comment_content' => $comment_content, //fixed value - can be dynamic 
            'comment_type' => '', //empty for regular comments, 'pingback' for pingbacks, 'trackback' for trackbacks
            'comment_parent' => 0, //0 if it's not a reply to another comment; if it's a reply, mention the parent comment ID here
            'user_id' => get_current_user_id(), //passing current user ID or any predefined as per the demand
        );

//Insert new comment and get the comment ID
        $comment_id = wp_new_comment($commentdata);
    }
    return $comment_id;
}

//Function to get and echo all reply of comment recursively
function getAndechoAllMessageComments($message_id) {
    global $current_user;
    $comments_view_content = "";
    if ($message_id) {
        $comments = get_comments(array('post_id' => $message_id, "parent" => 0, "orderby" => "comment_date", "order" => "asc"));
        if ($comments && !empty($comments)) {
            ob_start();
            ?>
            <div class="comments">
                <?php
                foreach ($comments as $comment):
                    $comment_user = get_userdata($comment->user_id);
                    ?>
                    <div class="comment">
                        <a class="avatar">
                            <?php echo get_avatar(get_the_author_meta('ID'), 64); ?>
                        </a>
                        <div class="content">
                            <a class="author"><?php echo $comment_user->display_name; ?></a>
                            <div class="metadata">
                                <div class="date"><?php
                                    $date = apply_filters('get_comment_time', $comment->comment_date, 'U', false, true, $comment);
                                    echo __("has validated", "booksharedomain") . " " . human_time_diff(strtotime($date), current_time('timestamp'))." ".__("ago", "booksharedomain");
                                    ?></div>
                            </div>
                            <div class="text">
                                <p><?php echo $comment->comment_content; ?></p>
                            </div>
                            
                        </div>
                    </div>
                    
                <?php endforeach; ?>
            </div>
            <?php
            $comments_view_content = ob_get_contents();
            ob_end_clean();
        }
    }
    return $comments_view_content;
}
