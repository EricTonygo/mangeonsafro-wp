<?php
if ($messages->have_posts()):
    ?>
    <!--<div class="ui dividing header" style="font-size: 12pt;"><?php if($post_author == get_current_user_id()): ?> <?php _e("Received Messages", "booksharedomain"); ?> <?php else: ?> <?php _e("Sended Messages", "booksharedomain"); ?> <?php endif ?> [<a id='show_messages_list' href="#received-messages" style="display: none"><?php _e("Show", "booksharedomain"); ?></a> <a id='hide_messages_list' href=""><?php _e("Hide", "booksharedomain"); ?></a>]</div>-->
    <div id='received-messages'>
        <div id='messages_list' class="ui comments">
            <?php while ($messages->have_posts()): $messages->the_post();
                $comments_count = get_comments_number(get_the_ID())
                ?>
                <div class="comment" >
                    <a class="avatar">
                        <?php echo get_avatar(get_the_author_meta('ID'), 64); ?>
                    </a>
                    <div class="content">
                        <span class="author"><?php echo get_post_meta(get_the_ID(), "message-user-name", true); ?></span><?php if($post_author == get_current_user_id()): ?> (<a href="mailto:<?php echo get_post_meta(get_the_ID(), "message-user-email", true); ?>"><?php echo get_post_meta(get_the_ID(), "message-user-email", true); ?></a> / <span><?php echo get_post_meta(get_the_ID(), "message-user-phone-number", true); ?></span>)<?php endif ?>
                        <div class="metadata">
                            <div class="date"><?php _e("Ago_fr", "booksharedomain"); ?> <?php echo "" . human_time_diff(get_the_time('U'), current_time('timestamp')); ?> <?php _e("ago", "booksharedomain"); ?></div>
                        </div>
                        <div class="text">
                            <p><?php echo get_post_field("post_content", get_the_ID()) ?></p>
                        </div>
                        <?php if($comments_count == 0 && $post_author == get_current_user_id()): ?>
                        <div class="actions">
                            <a id="show_message_reply_form<?php echo get_the_ID(); ?>" onclick="show_message_reply_form(<?php echo get_the_ID(); ?>)" class="reply"><i class="checkmark box green large icon"></i><?php _e("Validate", "booksharedomain");?></a>
                            <a id="hide_message_reply_form<?php echo get_the_ID(); ?>" onclick="hide_message_reply_form(<?php echo get_the_ID(); ?>)" class="reply" style="display: none;"><?php _e("Cancel", "booksharedomain");?></a>
                        </div>
                        <?php endif ?>
                    </div>
                    <?php echo getAndechoAllMessageComments(get_the_ID()); ?>
                </div>
                <?php if($comments_count == 0 && $post_author == get_current_user_id()): ?>
                    <form id="message_reply_form<?php echo get_the_ID(); ?>" class="ui reply form add_message_reply_form" method="POST" action="<?php echo get_permalink(); ?>" onsubmit="add_message_reply(event, <?php echo get_the_ID(); ?>); return false;" style="display:none">
                        <div class="field">
                            <textarea name="message_reply" placeholder="<?php _e("Enter a confirmation message here", "booksharedomain"); ?>"></textarea>
                        </div>
                        <input type="hidden" name="action" value="add-message-reply">
                        <input type="hidden" name="message_id" value="<?php echo get_the_ID(); ?>">
                        <div class="field">
                            <div id="server_error_message<?php echo get_the_ID(); ?>" class="ui negative message" style="display:none">
                                <i class="close icon"></i>
                                <div id="server_error_content<?php echo get_the_ID(); ?>" class="header"><?php _e("Internal server error", "booksharedomain"); ?></div>
                            </div>
                            <div id="error_name_message<?php echo get_the_ID(); ?>" class="ui error message" style="display: none">
                                <i class="close icon"></i>
                                <div id="error_name_header<?php echo get_the_ID(); ?>" class="header"></div>
                                <ul id="error_name_list<?php echo get_the_ID(); ?>" class="list">
                                </ul>
                            </div>
                        </div>
                        <button class="ui blue submit icon button">
                            <?php _e("Send confirmation", "booksharedomain"); ?>
                        </button>
                    </form>
                <?php endif ?>
                <?php
            endwhile;
            wp_reset_postdata();
            ?>

        </div>
    </div>
    <?php




 endif ?>