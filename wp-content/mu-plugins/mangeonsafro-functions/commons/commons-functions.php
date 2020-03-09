<?php

function bookshare_no_admin_access() {
    $redirect = home_url('/');
    //exit(wp_redirect($redirect));
    if (is_admin() && !current_user_can('manage_options') && !wp_doing_ajax()) {
        exit(wp_redirect($redirect));
    }
}

//Disable password reset from wp-login.php page
function disable_password_reset() {
    return false;
}

//Remove Reset lost password link form wp-login page
function remove_lostpassword_text($text) {
    if ($text == 'Lost your password?' || $text == 'Mot de passe oublié ?') {
        $text = '';
    }
    return $text;
}

//Prevent access to wp-login 
function custom_login_page() {
    global $pagenow;
    if ($pagenow == "wp-login.php" && $_SERVER['REQUEST_METHOD'] == 'GET') {
        wp_redirect(home_url('/'));
        exit;
    }
}

//use \Osms\Osms;
//This function Unquotes a quoted string even if it is more than one
function removeslashes($string) {
    $string = implode("", explode("\\", $string));
    return stripslashes(trim($string));
}

function text_domain_setup() {
    load_theme_textdomain('mangeonsafrodomain', get_template_directory() . '/languages');
}

function childtheme_formats() {
    //Enable a support thumbnail
    add_theme_support('post-thumbnails');
    add_theme_support('post-formats', array('aside', 'gallery', 'link'));
}

function my_theme_supports() {
    childtheme_formats();
    remove_theme_supports();
    text_domain_setup();
}

function remove_theme_supports() {
    /* ----------------------------------------------------------------------------- */
    //Prevent wordpress to display version of wordpress installation
    /* ----------------------------------------------------------------------------- */
    remove_action('wp_head', 'wp_generator');
}

function set_my_locale($lang) {
    return 'en_US';
}

function get_multiple_files(array $_files, $top = TRUE) {
    $files = array();
    foreach ($_files as $name => $file) {
        if ($top)
            $sub_name = $file['name'];
        else
            $sub_name = $name;

        if (is_array($sub_name)) {
            foreach (array_keys($sub_name) as $key) {
                $files[$name][$key] = array(
                    'name' => $file['name'][$key],
                    'type' => $file['type'][$key],
                    'tmp_name' => $file['tmp_name'][$key],
                    'error' => $file['error'][$key],
                    'size' => $file['size'][$key],
                );
                $files[$name] = get_multiple_files($files[$name], FALSE);
            }
        } else {
            $files[$name] = $file;
        }
    }
    return $files;
}

function upload_file($file = array(), $parent_post_id = 0) {
    require_once( ABSPATH . 'wp-admin/includes/admin.php' );
    $file_return = wp_handle_upload($file, array('test_form' => false));
    if (isset($file_return['error']) || isset($file_return['upload_error_handler'])) {
        return false;
    } else {
        $filename = $file_return['file'];
        $attachment = array(
            'post_mime_type' => $file_return['type'],
            'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
            'post_content' => '',
            'post_status' => 'inherit',
            'guid' => $file_return['url']
        );

        $attachment_id = wp_insert_attachment($attachment, $file_return['url'], $parent_post_id);

        require_once(ABSPATH . 'wp-admin/includes/image.php');
        $attachment_data = wp_generate_attachment_metadata($attachment_id, $filename);
        wp_update_attachment_metadata($attachment_id, $attachment_data);

        if (0 < intval($attachment_id)) {
            return $attachment_id;
        }
        return false;
    }
}

//Generate a array containing city, region, country from google places api city
function getCountryRegionCityInformations($locality) {
    $country_region_city = array();
    if ($locality && $locality != "") {
        $country = "";
        $state = "";
        $city = trim($locality);
//array containing city name, region name, and country name of start
        $localities = explode(", ", $city);
        if (count($localities) == 2) {
            $city = trim($localities[0]);
            $country = trim($localities[1]);
            //$state = getRegionByCityAndCountry($city, $country);
            $state ="";
        } elseif (count($localities) == 3) {
            $city = trim($localities[0]);
            $state = trim($localities[1]);
            $country = trim($localities[2]);
        }
        $country_region_city = array(
            "country" => $country,
            "region" => $state,
            "city" => $city
        );
    }
    return $country_region_city;
}

function getRegionByCityAndCountry($city, $country) {
    $region = "";
//    $args = array(
//        'post_type' => 'city',
//        "post_status" => 'publish',
//        'posts_per_page' => 1,
//        'title' => $city,
//        'meta_query' => array(
//            array(
//                'key' => 'country',
//                'value' => $country,
//                'compare' => '='
//            )
//        )
//    );
//    $cities = new WP_Query($args);
//    if ($cities->have_posts()) {
//        while ($cities->have_posts()) {
//            $cities->the_post();
//            $region = get_post_meta(get_the_ID(), 'region', true);
//        }
//    }
//    wp_reset_postdata();
    return $region;
}

function sendSMS($receiver, $content) {
    require 'Osms.php';
    $config = array(
        'token' => "MskEAyO9WuuKsljXho8VuGP263VE",
//    'clientId' =>'TaQ6sSSqnMlO9ELOP1HSZQHvNUAGio8n',
//    'clientSecret'=> '8yExHGyEPSYoFioI'
    );

    $osms = new Osms\Osms($config);
    $osms->setVerifyPeerSSL(false);
    $response = $osms->sendSms(
            // sender
            'tel:+237699213790',
            // receiver
//    'tel:+221786363801',
            'tel:' . $receiver,
            // message
            $content
    );
    if (empty($response['error'])) {
//        return 'Done!';
        return json_encode($response);
    } else {
        return json_encode($response);
    }
}

function save_post($post_id) {
    $save_result = null;
    if (is_user_logged_in()) {
        $user_id = get_current_user_id();
        $save_posts = get_user_meta($user_id, 'user-save-posts', true);
        if (is_array($save_posts) && !empty($save_posts) && !in_array($post_id, $save_posts)) {
            $save_posts[] = $post_id;
            $save_result = update_user_meta($user_id, 'user-save-posts', $save_posts);
        } elseif ($save_posts == null) {
            $save_result = update_user_meta($user_id, 'user-save-posts', array($post_id));
        }
    }
    return $save_result;
}

function unsave_post($post_id) {
    $unsave_result = null;
    if (is_user_logged_in()) {
        $user_id = get_current_user_id();
        $save_posts = get_user_meta($user_id, 'user-save-posts', true);
        if (is_array($save_posts) && !empty($save_posts) && in_array($post_id, $save_posts)) {
            $save_posts = array_diff(array_map('intval', $save_posts), array($post_id));
            $unsave_result = update_user_meta($user_id, 'user-save-posts', $save_posts);
        }
    }
    return $unsave_result;
}

//Fonction to verify user in grecaptcha
function verify_use_grecaptcha($codesecurity) {
    $privatekey = '6Le5BrwUAAAAAG8CzX8VaRTTwYSKX-XoHCgsRK5t'; // votre clé privée
    $post_data = "secret=" . $privatekey . "&response=" .
            $codesecurity . "&remoteip=" . $_SERVER['REMOTE_ADDR'];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded; charset=utf-8',
        'Content-Length: ' . strlen($post_data)));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    $googresp = curl_exec($ch);
    $decgoogresp = json_decode($googresp);
    curl_close($ch);

    return $decgoogresp->success;
}

/**
 *  Given a file, i.e. /css/base.css, replaces it with a string containing the
 *  file's mtime, i.e. /css/base.1221534296.css.
 *  
 *  @param $file  The file to be loaded.  Must be an absolute path (i.e.
 *                starting with slash).
 */
function auto_version($file) {
    if (strpos($file, '/') !== 0 || !file_exists($_SERVER['DOCUMENT_ROOT'] . $file))
        return $file;

    $mtime = filemtime($_SERVER['DOCUMENT_ROOT'] . $file);
    return preg_replace('{\\.([^./]+)$}', ".$mtime.\$1", $file);
}

//Function to get and echo all reply of comment recursively
function getAndechoAllReply($post_id, $comment_id) {
    $comments_children_view_content = "";
    if ($post_id && $comment_id) {
        $comments_children = get_comments(array('post_id' => $post_id, "parent" => $comment_id, "orderby" => "comment_date", "order" => "asc"));
        if ($comments_children && !empty($comments_children)) {
            ob_start();
            ?>
            <div class="comments">
                <?php
                foreach ($comments_children as $comment):
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
                                    echo __("a répondu il y a", "mangeonsafrodomain") . " " . human_time_diff(strtotime($date), current_time('timestamp'));
                                    ?></div>
                            </div>
                            <div class="text">
                                <p><?php echo $comment->comment_content; ?></p>
                            </div>
                            <div class="actions">
                                <?php if (is_user_logged_in()): ?>
                                    <a id="show_comment_reply_form<?php echo $comment->comment_ID; ?>" onclick="show_comment_reply_form(<?php echo $comment->comment_ID; ?>)" class="reply"><i class="reply icon"></i><?php echo __("Répondre", "mangeonsafrodomain") ?></a>
                                    <a id="hide_comment_reply_form<?php echo $comment->comment_ID; ?>" onclick="hide_comment_reply_form(<?php echo $comment->comment_ID; ?>)" class="reply" style="display: none"><?php echo __("Annuler", "mangeonsafrodomain") ?></a>
                                <?php endif ?>
                                <?php
                                $comments_children_count = count(get_comments(array('post_id' => $post_id, "parent" => $comment->comment_ID, "orderby" => "comment_date", "order" => "asc")));
                                ?>
                                <?php if ($comments_children_count >= 1): ?>
                                    <a id="show_all_reply_comment<?php echo $comment->comment_ID; ?>" onclick="show_all_reply_comment(<?php echo $comment->comment_ID; ?>)" class="reply"><?php echo $comments_children_count . " " . __("réponse", "mangeonsafrodomain") ?>(s)<i class="chevron down icon"></i></a>
                                    <a id="hide_all_reply_comment<?php echo $comment->comment_ID; ?>" onclick="hide_all_reply_comment(<?php echo $comment->comment_ID; ?>)" class="reply" style="display: none;"><?php echo $comments_children_count . " " . __("réponse", "mangeonsafrodomain") ?>(s)<i class="chevron up icon"></i></a>
                                <?php endif ?>
                            </div>
                        </div>
                        <div id="all_reply_comment<?php echo $comment->comment_ID; ?>" style="display: none;">
                            <?php echo getAndechoAllReply($post_id, $comment->comment_ID); ?>
                        </div>
                    </div>
                    <?php if (is_user_logged_in()): ?>
                        <form id="comment_reply_form<?php echo $comment->comment_ID; ?>" class="ui reply form add_comment_reply_form" method="POST" action="<?php echo get_permalink($post_id); ?>" onsubmit="add_comment_reply(event, <?php echo $comment->comment_ID; ?>); return false;" style="display: none">
                            <input type="hidden" name="action" value="add-comment-reply">
                            <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                            <input type="hidden" name="comment_parent_id" value="<?php echo $comment->comment_ID; ?>">
                            <div class="field">
                                <div id="server_error_message<?php echo $comment->comment_ID; ?>" class="ui negative message" style="display:none">
                                    <i class="close icon"></i>
                                    <div id="server_error_content<?php echo $comment->comment_ID; ?>" class="header"><?php _e("Internal server error", "mangeonsafrodomain"); ?></div>
                                </div>
                                <div id="error_name_message<?php echo $comment->comment_ID; ?>" class="ui error message" style="display: none">
                                    <i class="close icon"></i>
                                    <div id="error_name_header<?php echo $comment->comment_ID; ?>" class="header"></div>
                                    <ul id="error_name_list<?php echo $comment->comment_ID; ?>" class="list">

                                    </ul>
                                </div>
                            </div>
                            <div class="fields">
                                <div class="twelve wide field">
                                    <textarea rows="4" name="comment_content" data-emojiable="true" placeholder="<?php _e("Your reply", "mangeonsafrodomain"); ?>"></textarea>
                                </div>
                                <div class="four wide field">
                                    <button class="ui black submit button">
                                        <?php _e("Reply", "mangeonsafrodomain"); ?>
                                    </button>
                                </div>
                            </div>
                        </form>
                    <?php endif ?>
                <?php endforeach; ?>
            </div>
            <?php
            $comments_children_view_content = ob_get_contents();
            ob_end_clean();
        }
    }
    return $comments_children_view_content;
}

//Function for adding a comment to an evaluation 
function add_comment_reply($comment_reply_data) {
    $comment_id = null;
    if (is_array($comment_reply_data) && !empty($comment_reply_data)) {
        $commentdata = array(
            'comment_post_ID' => $comment_reply_data['comment_post_ID'], // to which post the comment will show up
            'comment_author' => $comment_reply_data['comment_author'], //fixed value - can be dynamic 
            'comment_author_email' => $comment_reply_data['comment_author_email'], //fixed value - can be dynamic 
            'comment_author_url' => $comment_reply_data['comment_author_url'], //fixed value - can be dynamic 
            'comment_content' => $comment_reply_data['comment_content'], //fixed value - can be dynamic 
            'comment_type' => '', //empty for regular comments, 'pingback' for pingbacks, 'trackback' for trackbacks
            'comment_parent' => $comment_reply_data['comment_parent'], //0 if it's not a reply to another comment; if it's a reply, mention the parent comment ID here
            'user_id' => $comment_reply_data['user_id'], //passing current user ID or any predefined as per the demand
        );

        //Insert new comment and get the comment ID
        $comment_id = wp_new_comment($commentdata);
        send_email_reply_for_comment_to_comment_user(intval($comment_reply_data['comment_post_ID']), intval($comment_reply_data['comment_parent']), $comment_id);
        send_email_reply_for_comment_to_post_user(intval($comment_reply_data['comment_post_ID']), intval($comment_reply_data['comment_parent']), $comment_id);
    }
    return $comment_id;
}

//Function for adding a comment to a post 
function add_post_comment($comment_data) {
    $comment_id = null;
    if (is_array($comment_data) && !empty($comment_data)) {
        $commentdata = array(
            'comment_post_ID' => $comment_data['comment_post_ID'], // to which post the comment will show up
            'comment_author' => $comment_data['comment_author'], //fixed value - can be dynamic 
            'comment_author_email' => $comment_data['comment_author_email'], //fixed value - can be dynamic 
            'comment_author_url' => $comment_data['comment_author_url'], //fixed value - can be dynamic 
            'comment_content' => $comment_data['comment_content'], //fixed value - can be dynamic 
            'comment_type' => '', //empty for regular comments, 'pingback' for pingbacks, 'trackback' for trackbacks
            'comment_parent' => 0, //0 if it's not a reply to another comment; if it's a reply, mention the parent comment ID here
            'user_id' => $comment_data['user_id'], //passing current user ID or any predefined as per the demand
        );

        //Insert new comment and get the comment ID
        $comment_id = wp_new_comment($commentdata);
        send_email_add_comment_on_pub(intval($comment_data['comment_post_ID']), $comment_id);
    }
    return $comment_id;
}

function bookshare_set_post_views($postID) {
    $count_key = 'bookshare_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    } else {
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

function bookshare_get_post_views($postID) {
    $count_key = 'bookshare_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 View";
    }
    return $count . ' Views';
}

function send_email_add_comment_on_pub($post_id, $comment_id) {
    $headers[] = 'MIME-Version: 1.0';
    $headers[] = 'Content-Type: text/html; charset=UTF-8';
    $headers[] = 'From: BledShare <infos@bledshare.com>';
    $headers[] = 'Bcc:<erictonyelissouck@yahoo.fr>';

    $post_type = get_post_type($post_id);
    $user = get_user_by('id', get_post_field('post_author', $post_id));
    $comment = get_comment($comment_id);
    $comment_user = get_user_by('email', $comment->comment_author_email);
    if ($user->ID != $comment_user->ID) {
        $subject = "";
        if ($post_type == 'alerts_cpt') {
            $subject = $user->data->display_name . ", " . $comment_user->data->display_name . " " . __("commented on your alert", "mangeonsafrodomain") . ": " . mb_convert_encoding(get_post_field('post_title', $post_id), "HTML-ENTITIES", 'ISO-8859-1');
        } elseif ($post_type == 'publications_cpt') {
            $subject = $user->data->display_name . ", " . $comment_user->data->display_name . " " . __("commented on your book", "mangeonsafrodomain") . ": " . mb_convert_encoding(get_post_field('post_title', $post_id), "HTML-ENTITIES", 'ISO-8859-1');
        }
        ob_start();
        ?>
        <div style="font-size: 12.8px;"><?php echo __("Hello", "mangeonsafrodomain"); ?> <?php echo $user->data->display_name; ?> ! </div>
        <div><br></div>
        <?php if ($post_type == 'alerts_cpt'): ?>
            <div style="font-size: 12.8px;"><?php echo $comment_user->data->display_name; ?> <?php _e("commented on your alert", "mangeonsafrodomain"); ?>: <a href="<?php echo get_permalink($post_id) . "#comments"; ?>" ><?php echo get_post_field('post_title', $post_id); ?></a>.</div>
        <?php elseif ($post_type == 'publications_cpt'): ?>
            <div style="font-size: 12.8px;"><?php echo $comment_user->data->display_name; ?> <?php _e("commented on your book", "mangeonsafrodomain"); ?>: <a href="<?php echo get_permalink($post_id) . "#comments"; ?>" ><?php echo get_post_field('post_title', $post_id); ?></a>.</div>
        <?php endif ?>
        <div><br></div>
        <div>
            <p style="margin:0px;padding:0px;border:0px;font-size:12.8px;font-stretch:normal;line-height:normal;font-family:Tahoma;width:auto;height:auto;float:none;color:rgb(0,0,0)"><?php _e("Thank you for using Bledshare", "mangeonsafrodomain"); ?>,</p>
            <p style="margin:0px 0px 1em;padding:0px;border:0px;font-size:12.8px;font-stretch:normal;line-height:normal;font-family:Tahoma;width:auto;height:auto;float:none;color:rgb(0,0,0)"><?php _e("Your BledShare team", "mangeonsafrodomain"); ?>.</p>
        </div>

        <?php
        $body = ob_get_contents();
        ob_end_clean();
        wp_mail($user->data->user_email, $subject, $body, $headers);
    }
}

function send_email_reply_for_comment_to_comment_user($post_id, $comment_parent_id, $comment_reply_id) {
    $headers[] = 'MIME-Version: 1.0';
    $headers[] = 'Content-Type: text/html; charset=UTF-8';
    $headers[] = 'From: BledShare <infos@bledshare.com>';
    $headers[] = 'Bcc:<erictonyelissouck@yahoo.fr>';

    $post_type = get_post_type($post_id);
    $user = get_user_by('id', get_post_field('post_author', $post_id));
    $comment = get_comment($comment_parent_id);
    $comment_user = get_user_by('email', $comment->comment_author_email);
    $comment_reply = get_comment($comment_reply_id);
    $comment_reply_user = get_user_by('email', $comment_reply->comment_author_email);
    if ($comment_user->ID != $comment_reply_user->ID) {
        $subject = "";
        if ($post_type == 'alerts_cpt') {
            $subject = $comment_user->data->display_name . ", " . $comment_reply_user->data->display_name . " " . __("replied to your comment on alert", "mangeonsafrodomain") . ": " . get_post_field('post_title', $post_id);
        } elseif ($post_type == 'publications_cpt') {
            $subject = $comment_user->data->display_name . ", " . $comment_reply_user->data->display_name . " " . __("replied to your comment on book", "mangeonsafrodomain") . ": " . get_post_field('post_title', $post_id);
        }
        ob_start();
        ?>
        <div style="font-size: 12.8px;"><?php echo __("Hello", "mangeonsafrodomain"); ?> <?php echo $comment_user->data->display_name; ?> ! </div>
        <div><br></div>
        <?php if ($post_type == 'alerts_cpt'): ?>
            <div style="font-size: 12.8px;"><?php echo $comment_reply_user->data->display_name; ?> <?php _e("replied to your comment on alert", "mangeonsafrodomain"); ?>: <a href="<?php echo get_permalink($post_id) . "#comments"; ?>" ><?php echo get_post_field('post_title', $post_id); ?></a>.</div>
        <?php elseif ($post_type == 'publications_cpt'): ?>
            <div style="font-size: 12.8px;"><?php echo $comment_reply_user->data->display_name; ?> <?php _e("replied to your comment on book", "mangeonsafrodomain"); ?>: <a href="<?php echo get_permalink($post_id) . "#comments"; ?>" ><?php echo get_post_field('post_title', $post_id); ?></a>.</div>
        <?php endif ?>
        <div><br></div>
        <div>
            <p style="margin:0px;padding:0px;border:0px;font-size:12.8px;font-stretch:normal;line-height:normal;font-family:Tahoma;width:auto;height:auto;float:none;color:rgb(0,0,0)"><?php _e("Thank you for using Bledshare", "mangeonsafrodomain"); ?>,</p>
            <p style="margin:0px 0px 1em;padding:0px;border:0px;font-size:12.8px;font-stretch:normal;line-height:normal;font-family:Tahoma;width:auto;height:auto;float:none;color:rgb(0,0,0)"><?php _e("Your BledShare team", "mangeonsafrodomain"); ?>.</p>
        </div>

        <?php
        $body = ob_get_contents();
        ob_end_clean();
        wp_mail($comment_user->data->user_email, $subject, $body, $headers);
    }
}

function send_email_reply_for_comment_to_post_user($post_id, $comment_parent_id, $comment_reply_id) {
    $headers[] = 'MIME-Version: 1.0';
    $headers[] = 'Content-Type: text/html; charset=UTF-8';
    $headers[] = 'From: BledShare <infos@bledshare.com>';
    $headers[] = 'Bcc:<erictonyelissouck@yahoo.fr>';

    $post_type = get_post_type($post_id);
    $user = get_user_by('id', get_post_field('post_author', $post_id));
    $comment = get_comment($comment_parent_id);
    $comment_user = get_user_by('email', $comment->comment_author_email);
    $comment_reply = get_comment($comment_reply_id);
    $comment_reply_user = get_user_by('email', $comment_reply->comment_author_email);
    if ($user->ID != $comment_reply_user->ID) {
        $subject = "";
        if ($post_type == 'alerts_cpt') {
            $subject = $user->data->display_name . ", " . $comment_reply_user->data->display_name . " " . __("replied to a comment on your alert", "mangeonsafrodomain") . ": " . get_post_field('post_title', $post_id);
        } elseif ($post_type == 'publications_cpt') {
            $subject = $user->data->display_name . ", " . $comment_reply_user->data->display_name . " " . __("replied to a comment on your book", "mangeonsafrodomain") . ": " . get_post_field('post_title', $post_id);
        }
        ob_start();
        ?>
        <div style="font-size: 12.8px;"><?php echo __("Hello", "mangeonsafrodomain"); ?> <?php echo $user->data->display_name; ?> ! </div>
        <div><br></div>
        <?php if ($post_type == 'alerts_cpt'): ?>
            <div style="font-size: 12.8px;"><?php echo $comment_reply_user->data->display_name; ?> <?php _e("replied to a comment on your alert", "mangeonsafrodomain"); ?>: <a href="<?php echo get_permalink($post_id) . "#comments"; ?>" ><?php echo get_post_field('post_title', $post_id); ?></a>.</div>
        <?php elseif ($post_type == 'publications_cpt'): ?>
            <div style="font-size: 12.8px;"><?php echo $comment_reply_user->data->display_name; ?> <?php _e("replied to a comment on your book", "mangeonsafrodomain"); ?>: <a href="<?php echo get_permalink($post_id) . "#comments"; ?>" ><?php echo get_post_field('post_title', $post_id); ?></a>.</div>
        <?php endif ?>
        <div><br></div>
        <div>
            <p style="margin:0px;padding:0px;border:0px;font-size:12.8px;font-stretch:normal;line-height:normal;font-family:Tahoma;width:auto;height:auto;float:none;color:rgb(0,0,0)"><?php _e("Thank you for using Bledshare", "mangeonsafrodomain"); ?>,</p>
            <p style="margin:0px 0px 1em;padding:0px;border:0px;font-size:12.8px;font-stretch:normal;line-height:normal;font-family:Tahoma;width:auto;height:auto;float:none;color:rgb(0,0,0)"><?php _e("Your BledShare team", "mangeonsafrodomain"); ?>.</p>
        </div>

        <?php
        $body = ob_get_contents();
        ob_end_clean();
        wp_mail($user->data->user_email, $subject, $body, $headers);
    }
}
