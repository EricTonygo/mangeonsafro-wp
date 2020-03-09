<div class="ui vertical fluid tabular menu">
    <a class="item <?php if(is_page(get_page_by_path(__("account", "booksharedomain")."/".__('profile', 'booksharedomain'))->ID)): ?>active<?php endif ?>" href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__("account", "booksharedomain")."/".__('profile', 'booksharedomain'))->ID)); ?>">
        <?php _e("My Profile", "booksharedomain"); ?>
    </a>
    <a class="item <?php if(is_page(get_page_by_path(__("account", "booksharedomain")."/".__('profile', 'booksharedomain')."/".__('reading-suggestions', 'booksharedomain'))->ID)): ?>active<?php endif ?>" href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__("account", "booksharedomain")."/".__('profile', 'booksharedomain')."/".__('reading-suggestions', 'booksharedomain'))->ID)); ?>">
        <?php _e("Reading suggestions", "booksharedomain"); ?>
    </a>
    <a class="item <?php if(is_page(get_page_by_path(__("account", "booksharedomain")."/".__('books', 'booksharedomain'))->ID) ||
            is_page(get_page_by_path(__("account", "booksharedomain")."/".__('books', 'booksharedomain')."/".__("publish", "booksharedomain"))->ID) || 
            is_singular("publications_cpt")): ?>active<?php endif ?>" href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__("account", "booksharedomain")."/".__('books', 'booksharedomain'))->ID)); ?>">
        <?php 
        $all_user_publications = new WP_Query(array('post_type' => 'publications_cpt', 'posts_per_page' => -1, "post_status" => array('publish', 'trash'), 'author' => get_current_user_id()));
        ?>
         <div class="ui small teal label"><?php if($all_user_publications->have_posts()): ?> <?php echo $all_user_publications->post_count; ?> <?php else : ?> 0 <?php endif ?></div>
        <?php _e("My Books", "booksharedomain"); ?> 
    </a>
    <a class="item <?php if(is_page(get_page_by_path(__("account", "booksharedomain")."/".__('alerts', 'booksharedomain'))->ID) ||
            is_page(get_page_by_path(__("account", "booksharedomain")."/".__('alerts', 'booksharedomain')."/".__("publish", "booksharedomain"))->ID) || 
            is_singular("alerts_cpt")): ?>active<?php endif ?>" href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__("account", "booksharedomain")."/".__('alerts', 'booksharedomain'))->ID)); ?>">
        <?php 
        $all_user_alerts = new WP_Query(array('post_type' => 'alerts_cpt', 'posts_per_page' => -1, "post_status" => array('publish', 'trash'), 'author' => get_current_user_id()));
        ?>
        <div class="ui small teal label"><?php if($all_user_alerts->have_posts()): ?> <?php echo $all_user_alerts->post_count; ?> <?php else : ?> 0 <?php endif ?></div>
        <?php _e("My Alerts", "booksharedomain"); ?> <!--span class="ui red circular label">2</span-->
    </a>
    <a class="item <?php if(is_page(get_page_by_path(__("account", "booksharedomain")."/".__('backups', 'booksharedomain'))->ID)): ?>active<?php endif ?>" href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__("account", "booksharedomain")."/".__('backups', 'booksharedomain'))->ID)); ?>">
        <?php 
        $all_user_backups = get_user_meta(get_current_user_id(), 'user-save-posts', true);
        ?>
        <div class="ui small teal label"><?php if($all_user_backups): ?> <?php echo count($all_user_backups); ?> <?php else : ?> 0 <?php endif ?></div>
        <?php _e("My Backups", "booksharedomain"); ?> <!--span class="ui red circular label">2</span-->
    </a>
</div>