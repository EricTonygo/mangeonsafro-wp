<div id="second_menu" class="ui stackable menu">
    <div class="ui container">
        <div class="left menu">
            <a class="header logo item" href="<?php echo wp_make_link_relative(home_url('/')) ?>">
                <img class="ui mini image" src="<?php echo get_template_directory_uri() ?>/assets/images/bledshare.png"> <span class="site_title">BledShare</span>
            </a>

        </div>
        <div class="center menu">

        </div>
        <div class="right menu">
            <div class="item"><span style="padding-right: 0.5em;"><?php _e("Do you already have an account", "booksharedomain"); ?>?</span> <a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('login', 'booksharedomain')))) ?>"><?php _e("Sign in", "booksharedomain"); ?></a></div>                    
        </div>

        <div>
        </div>
    </div>
</div>