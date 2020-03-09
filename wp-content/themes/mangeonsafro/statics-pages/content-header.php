<div id="second_menu" class="ui stackable menu">
    <div class="ui container">
        <div class="left menu">
            <a class="header logo item" href="<?php echo wp_make_link_relative(home_url('/')) ?>">
                <img class="ui mini image" src="<?php echo get_template_directory_uri() ?>/assets/images/bledshare.png"> <span class="site_title">BledShare</span>
            </a>
            
            <a class="item" href="<?php echo wp_make_link_relative(get_post_type_archive_link('alerts_cpt')) ?>"><i class="announcement icon chcolor1" ></i><?php _e("Alerts", "booksharedomain"); ?></a>
            <a class="item" href="<?php echo wp_make_link_relative(get_post_type_archive_link('publications_cpt')) ?>"><i class="book icon chcolor1"></i><?php _e("Books", "booksharedomain"); ?></a>
        </div>
        <div class="center menu">

        </div>
        <div class="right menu">
            <?php if(!is_user_logged_in()): ?>
            <a class="item" href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('login', 'booksharedomain'))->ID)) ?>"><i class="sign in icon chcolor1" ></i><?php _e("Sign in", "booksharedomain"); ?></a>
            <a class="item" href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('register', 'booksharedomain'))->ID)) ?>"><i class="add user icon chcolor1" ></i><?php _e("Sign up", "booksharedomain"); ?></a>
            <?php else: ?>
            <a class="item" href="<?php echo esc_url(add_query_arg(array('logout' => 'true'), wp_make_link_relative(home_url('/')))) ?>"><i class="sign out icon chcolor1" ></i><?php _e("Log out", "booksharedomain"); ?></a>
            
                <?php endif ?>
            <div class="item">
            <a class="ui green button" href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('account', 'booksharedomain')."/".__("alerts", "booksharedomain")."/".__("publish", "booksharedomain"))->ID)) ?>"><?php _e("Publish an alert", "booksharedomain"); ?></a>
            </div>
            <div class="item">
                <a class="ui yellow button" href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('account', 'booksharedomain')."/".__("books", "booksharedomain")."/".__("publish", "booksharedomain"))->ID)) ?>"><?php _e("Publish a book", "booksharedomain"); ?></a>
            </div>
        </div>
    </div>
</div>