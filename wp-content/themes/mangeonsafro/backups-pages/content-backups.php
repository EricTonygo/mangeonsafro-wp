<div id="nav_menu" class="ui tiny menu">
    <div class="left menu">
        <ul class="breadcrumb">
            <li class="active here"><?php _e("You are here", "booksharedomain"); ?></li>
            <li class=""><a href="<?php echo wp_make_link_relative(home_url('/')); ?>"><?php _e("Home", "booksharedomain"); ?></a></li>
            <li><i class="small right chevron icon divider"></i></li>
            <li class=""><a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__("account", "booksharedomain")."/".__('profile', 'booksharedomain'))->ID)); ?>"><?php _e("My account", "booksharedomain"); ?></a></li>
            <li><i class="small right chevron icon divider"></i></li>
            <li class=""><span><?php _e("My Backups", "booksharedomain"); ?></span></li>
        </ul>
    </div>
</div><div class="ui stackable grid padded">
    <div class="four wide column">
        <?php include(locate_template("statics-pages/content-aside-account.php")); ?>
    </div>
    <div class="twelve wide stretched column">
        <div class="ui fluid card account_left_main_content">
            <div class="content">
                <?php include(locate_template("statics-pages/content-success-or-faillure-message.php")); ?>
                <?php
                if ($posts->have_posts()) :
                    ?>
                    <div class="ui three column doubling stackable grid list_publications">
                        <?php
                        while ($posts->have_posts()): $posts->the_post();
                            $post_author = get_post_field('post_author', get_the_ID());
                            ?>
                            <div class="column">
                                <?php if(get_post_type() == "publications_cpt"): 
                                    $publication_thumbnail_image_id = get_post_meta(get_the_ID(), 'publication-thubmnail-image-id', true);
                                ?>
                                    <?php include(locate_template("publications-pages/content-single-publication-card.php")); ?>
                                <?php elseif(get_post_type() == "alerts_cpt"): ?>
                                    <?php include(locate_template('notifications-pages/content-single-notification-card.php')); ?>
                                <?php endif ?>
                            </div>
                            <?php
                        endwhile;
                        ?>
                    </div>
                    <?php
                    if ($total_post_pages > 1):
                        $start = 1;
                        $end = $total_post_pages;
                        if ($total_post_pages > 5 && $num_page > 3) {
                            $end = $num_page + 2 < $total_post_pages ? $num_page + 2 : $total_post_pages;
                            $start = $end - 4 > 1 ? $end - 4 : 1;
                        } elseif ($total_post_pages > 5) {
                            $end = 5;
                        }
                        ?>
                        <div style="margin-top: 1.5em; text-align: center;">
                            <div class="ui small icon buttons">
                                <?php if ($num_page > 1): ?>
                                    <?php
                                    $params_arg["num-page"] = $num_page - 1;
                                    ?>
                                    <a class="ui button" href="<?php echo esc_url(add_query_arg($params_arg, wp_make_link_relative($page_link))); ?>"><i class="chevron left icon"></i></a>
                                <?php endif ?>
                                <?php for ($i = $start; $i <= $end; $i++): ?>
                                    <?php
                                    $params_arg["num-page"] = $i;
                                    ?>
                                    <a class="ui <?php if ($num_page == $i): ?>blue<?php else: ?>basic<?php endif ?> button" href="<?php echo esc_url(add_query_arg($params_arg, wp_make_link_relative($page_link))); ?>"><?php echo $i; ?></a>
                                <?php endfor; ?>
                                <?php if ($num_page < $total_post_pages): ?>
                                    <?php
                                    $params_arg["num-page"] = $num_page + 1;
                                    ?>
                                    <a class="ui button" href="<?php echo esc_url(add_query_arg($params_arg, wp_make_link_relative($page_link))); ?>"><i class="chevron right icon"></i></a>
                                <?php endif ?>
                            </div>
                        </div>
                    <?php endif ?>
                <?php else: ?>
                    <div class="ui warning message">
                        <i class="close icon"></i>
                        <?php _e("You have any saved informations at this moment", "booksharedomain"); ?>.                        
                    </div>
                <?php
                endif;
                wp_reset_postdata();
                ?>
            </div>

        </div>

    </div>
</div>