<div id='my_mobile_menu' class="ui large borderless menu" style="height: 4em; display: none" >
    <div class="ui container">
        <div  class="left menu">
            <div class="toc item">
                <i class="sidebar icon"></i>
            </div>
            <a href="<?php echo wp_make_link_relative(home_url('/')) ?>" class="header logo item">
                <img id='fixed_menu_logo' class="logo" src="<?php echo wp_make_link_relative(get_template_directory_uri()) ?>/assets/images/bledshare.png">
            </a>
            <a class="item" href="<?php echo get_post_type_archive_link('alerts_cpt') ?>"><i class="announcement icon chcolor1" ></i></a>
            <a class="item" href="<?php echo get_post_type_archive_link('publications_cpt') ?>"><i class="book icon chcolor1"></i></a>
        </div>
        <div class="center menu">

        </div>
        <div class="right menu">
            <?php if (!is_user_logged_in()): ?>
                <a class="item" href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('login', 'booksharedomain'))->ID)) ?>"><i class="sign in icon chcolor1" ></i></a>
                <a class="item" href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('register', 'booksharedomain'))->ID)) ?>"><i class="add user icon chcolor1" ></i></a>
            <?php else: ?>
                <a class="item" href="<?php echo esc_url(add_query_arg(array('logout' => 'true'), wp_make_link_relative(home_url('/')))) ?>"><i class="sign out icon chcolor1" ></i></a>
            <?php endif ?>
        </div>
    </div>
</div>