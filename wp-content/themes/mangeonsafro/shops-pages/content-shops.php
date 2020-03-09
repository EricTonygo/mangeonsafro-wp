<!-- Hero Section-->
<section class="hero">
    <div class="container">
        <!-- Breadcrumbs -->
        <ol class="breadcrumb justify-content-center">
            <li class="breadcrumb-item"><a href="<?php echo wp_make_link_relative(home_url('/')); ?>"><?php _e("Home", "mangeonsafrodomain"); ?></a></li>
            <li class="breadcrumb-item"><a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('account', 'mangeonsafrodomain') . "/" . __('profile', 'mangeonsafrodomain'))->ID)) ?>"><?php _e("My Account", "mangeonsafrodomain"); ?></a></li>
            <li class="breadcrumb-item"><a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('account', 'mangeonsafrodomain') . "/" . __('seller-zone', 'mangeonsafrodomain'))->ID)) ?>"><?php _e("Seller zone", "mangeonsafrodomain"); ?></a></li>
            <li class="breadcrumb-item active"><?php _e("Shops", "mangeonsafrodomain"); ?></li>
        </ol>
        <!-- Hero Content-->
        <div class="hero-content text-center">
            <h1 class="hero-heading"><?php _e("My shops", "mangeonsafrodomain"); ?></h1>
        </div>
    </div>
</section>
<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-xl-9">
                <?php include(locate_template("statics-pages/content-success-or-faillure-message.php")); ?>
                <table class="table table-borderless table-hover table-responsive-md">
                    <thead class="bg-light">
                        <tr>
                            <th class="py-4 text-uppercase text-sm"><?php _e("N°", "mangeonsafrodomain"); ?></th>
                            <th class="py-4 text-uppercase text-sm"><?php _e("Name", "mangeonsafrodomain"); ?></th>
                            <th class="py-4 text-uppercase text-sm"><?php _e("City", "mangeonsafrodomain"); ?></th>
                            <th class="py-4 text-uppercase text-sm"><?php _e("Category", "mangeonsafrodomain"); ?></th>
                            <th class="py-4 text-uppercase text-sm"><?php _e("Actions", "mangeonsafrodomain"); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($shops->have_posts()) :
                            ?>
                            <?php
                            $i = 0;
                            while ($shops->have_posts()): $shops->the_post();
                                ?>
                                <tr>
                                    <td class="py-4 align-middle"><?php echo ++$i; ?></td>
                                    <th class="py-4 align-middle"><a href="<?php echo wp_make_link_relative(get_permalink()); ?>" class="text-uppercase text-dark"><strong><?php the_title(); ?></strong></a></th>
                                    <td class="py-4 align-middle"><?php echo get_post_meta(get_the_ID(), 'shop-city', true); ?></td>
                                    <td class="py-4 align-middle">
                                        <?php
                                        $shop_categories = wp_get_post_terms(get_the_ID(), 'category', array("fields" => "names"));
                                        $shop_category_name = null;
                                        foreach ($shop_categories as $shop_category):
                                            $shop_category_name = $shop_category
                                            ?>

                                        <?php endforeach ?>
                                        <?php echo __($shop_category_name, "mangeonsafrodomain"); ?>
                                    </td>
                                    <td class="py-4 align-middle">
                                        <a href="<?php echo esc_url(add_query_arg(array('action' => "edit"), wp_make_link_relative(get_permalink()))) ?>" class="btn btn-outline-dark btn-sm"><?php _e("Edit", "mangeonsafrodomain"); ?></a>
                                        <?php if (get_post_status() == "publish"): ?>
                                            <a href="<?php echo esc_url(add_query_arg(array('action' => "put-offline"), wp_make_link_relative(get_permalink()))) ?>" class="btn btn-outline-dark btn-sm"><?php _e("Put offline", "mangeonsafrodomain"); ?></a>
                                        <?php elseif (get_post_status() == "trash"): ?>
                                            <a href="<?php echo esc_url(add_query_arg(array('action' => "put-online", "ID" => get_the_ID()), wp_make_link_relative(get_permalink(get_page_by_path(__('account', 'mangeonsafrodomain') . "/" . __("seller-zone", "mangeonsafrodomain") . "/" . __("shops", "mangeonsafrodomain"))->ID)))) ?>" class="btn btn-outline-dark btn-sm"><?php _e("Put online", "mangeonsafrodomain"); ?></a>
                                        <?php endif ?>
                                        <!--<a class="btn btn-outline-dark btn-sm" href="<?php echo esc_url(add_query_arg(array('action' => "delete", "ID" => get_the_ID()), wp_make_link_relative(get_permalink(get_page_by_path(__('account', 'mangeonsafrodomain') . "/" . __("seller-zone", "mangeonsafrodomain") . "/" . __("shops", "mangeonsafrodomain"))->ID)))) ?>"><i class="remove icon"></i><?php _e("Delete", "mangeonsafrodomain"); ?></a>-->
                                        <a class="btn btn-outline-dark btn-sm" href="<?php echo wp_make_link_relative(get_permalink()); ?>"><i class="remove icon"></i><?php _e("Manage", "mangeonsafrodomain"); ?></a>
                                    </td>
                                </tr>
                                <?php
                            endwhile;
                            ?>
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
                                <!--                            <div style="margin-top: 1.5em; text-align: center;">
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
                                                            </div>-->
                            <?php endif ?>
                        <?php else: ?>
                            <!--                        <div class="alert alert-warning" role="alert">
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                            <?php _e("You have any published shop at this moment", "mangeonsafrodomain"); ?>.
                                                        </button>
                                                    </div>-->
                        <?php
                        endif;
                        wp_reset_postdata();
                        ?>
                    </tbody>
                </table>
                <div class="text-center mt-4">
                    <a class="btn btn-outline-dark" href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('account', 'mangeonsafrodomain') . '/' . __("seller-zone", "mangeonsafrodomain") . '/' . __("shops", "mangeonsafrodomain") . '/' . __("new-shop", "mangeonsafrodomain"))->ID)); ?>"><i class="far fa-plus-square mr-2"></i><?php _e("Create new shop", "mangeonsafrodomain"); ?></a>
                </div>
            </div>
            <!-- Customer Sidebar-->
            <div class="col-xl-3 col-lg-4 mb-5">
                <div class="customer-sidebar card border-0"> 
                    <div class="customer-profile"><a href="#" class="d-inline-block"><img src="<?php echo wp_make_link_relative(get_template_directory_uri()) ?>/assets/img/photo/kyle-loftus-589739-unsplash-avatar.jpg" class="img-fluid rounded-circle customer-image"></a>
                        <h5> <?php
                            if ($user_pro_name) {
                                echo $user_pro_name;
                            } else {
                                echo $current_user->display_name;
                            }
                            ?></h5>
                        <p class="text-muted text-sm mb-0"><?php
                            if ($user_pro_email) {
                                echo $user_pro_email;
                            } else {
                                echo $current_user->user_email;
                            }
                            ?></p>
                    </div>
                    <nav class="list-group customer-nav"><a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('account', 'mangeonsafrodomain') . "/" . __('seller-zone', 'mangeonsafrodomain') . "/" . __('shops', 'mangeonsafrodomain'))->ID)) ?>" class="active list-group-item d-flex justify-content-between align-items-center"><span>
                                <svg class="svg-icon svg-icon-heavy mr-2">
                                <use xlink:href="#store-1"></use>
                                </svg><?php _e("Shops", "mangeonsafrodomain"); ?></span></a><a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('account', 'mangeonsafrodomain') . "/" . __('seller-zone', 'mangeonsafrodomain') . "/" . __('products', 'mangeonsafrodomain'))->ID)) ?>" class="list-group-item d-flex justify-content-between align-items-center"><span>
                                <svg class="svg-icon svg-icon-heavy mr-2">
                                <use xlink:href="#shipping-box-1"></use>
                                </svg><?php _e("Products", "mangeonsafrodomain"); ?></span></a>
                    </nav>
                </div>
            </div>
            <!-- /Customer Sidebar-->
        </div>
    </div>
</section>