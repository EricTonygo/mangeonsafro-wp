<?php
    $page_url_en = esc_url(add_query_arg(array('lang' => 'en'), wp_make_link_relative(home_url('/'))));
    $page_url_fr = esc_url(add_query_arg(array('lang' => 'fr'), wp_make_link_relative(home_url('/'))));
    if(is_page()){
        $page_url_en = wp_make_link_relative(get_permalink(pll_get_post(get_the_ID(), "en")));
        $page_url_fr = wp_make_link_relative(get_permalink(pll_get_post(get_the_ID(), "fr")));
    }elseif(is_category()){
        $page_url_en = wp_make_link_relative(esc_url(get_category_link(pll_get_term(get_category(get_query_var('cat'))->term_id, "en"))));
        $page_url_fr = wp_make_link_relative(esc_url(get_category_link(pll_get_term(get_category(get_query_var('cat'))->term_id, "fr"))));        
    }
?>
<div id="first_menu" class="ui tiny menu">
    <div class="left menu">
        <a class="item" href="http://www.bledshare.com/wp-content/uploads/2018/01/About.pdf" target="_blank"><?php _e("About us", "booksharedomain"); ?></a>
        <a class="item" style="padding-left: 0; padding-right: 0;">|</a>
        <a class="item" href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('how-it-works', 'booksharedomain'))->ID)) ?>"><?php _e("How it works", "booksharedomain"); ?>?</a>
        <a class="item" style="padding-left: 0; padding-right: 0;">|</a>
        <a class="item" href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('blog', 'booksharedomain'))->ID)) ?>"><?php _e("Blog", "booksharedomain"); ?></a>
    </div>
    <div class="right menu">
        <div class="ui dropdown item">
            <i class="<?php _e("flag_code", "booksharedomain"); ?> flag"></i> <?php _e("Lang_title", "booksharedomain"); ?><i class="dropdown icon"></i>
            <div class="menu">
                <a href="<?php echo $page_url_en; ?>" class="item"><?php _e("English", "booksharedomain"); ?></a>
                <a href="<?php echo $page_url_fr; ?>" class="item"><?php _e("French", "booksharedomain"); ?></a>
            </div>
        </div>
        <?php if(is_user_logged_in()): ?>
        <div class="ui dropdown item">
            <?php _e("My account", "booksharedomain"); ?><i class="dropdown icon"></i>
            <div class="menu">
                <a class="item" href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('account', 'booksharedomain')."/".__('profile', 'booksharedomain'))->ID)) ?>"><?php _e("My Profile", "booksharedomain"); ?></a>
                <a class="item" href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('account', 'booksharedomain')."/".__('books', 'booksharedomain'))->ID)) ?>"><?php _e("My Books", "booksharedomain"); ?></a>
                <a class="item" href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('account', 'booksharedomain')."/".__('alerts', 'booksharedomain'))->ID)) ?>"><?php _e("My Alerts", "booksharedomain"); ?></a>
                <a class="item" href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('account', 'booksharedomain')."/".__('backups', 'booksharedomain'))->ID)) ?>"><?php _e("My Backups", "booksharedomain"); ?></a>
            </div>
        </div>
        
        <?php endif ?>
        <a class="item" target="_blank" href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('help', 'booksharedomain'))->ID)) ?>"><?php _e("Help", "booksharedomain"); ?></a>
    </div>
</div>