<!-- Hero Section-->
<section class="hero">
    <div class="container">
        <!-- Breadcrumbs -->
        <ol class="breadcrumb justify-content-center">
            <li class="breadcrumb-item"><a href="<?php echo wp_make_link_relative(home_url('/')); ?>"><?php _e("Home", "mangeonsafrodomain"); ?></a></li>
            <li class="breadcrumb-item"><a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('account', 'mangeonsafrodomain') . "/" . __('profile', 'mangeonsafrodomain'))->ID)) ?>"><?php echo get_page_by_path(__('account', 'mangeonsafrodomain') . "/" . __('profile', 'mangeonsafrodomain'))->post_title; ?></a></li>
            <li class="breadcrumb-item"><a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('account', 'mangeonsafrodomain') . "/" . __('seller-zone', 'mangeonsafrodomain'))->ID)) ?>"><?php echo get_page_by_path(__('account', 'mangeonsafrodomain') . "/" . __('seller-zone', 'mangeonsafrodomain'))->post_title; ?></a></li>
            <li class="breadcrumb-item"><a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('account', 'mangeonsafrodomain') . "/" . __('seller-zone', 'mangeonsafrodomain') . "/" . __('shops', 'mangeonsafrodomain'))->ID)) ?>"><?php echo get_page_by_path(__('account', 'mangeonsafrodomain') . "/" . __('seller-zone', 'mangeonsafrodomain') . "/" . __('shops', 'mangeonsafrodomain'))->post_title; ?></a></li>
            <li class="breadcrumb-item active"><?php the_title(); ?></li>
        </ol>
        <!-- Hero Content-->
        <div class="hero-content text-center">
            <h3 class="hero-heading"><?php the_title(); ?></h3>
        </div>
    </div>
</section>
<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-xl-9">
                <div class="block mb-5">
                    <div class="block-header"><strong class="text-uppercase"><?php _e("Shop management", "mangeonsafrodomain"); ?></strong></div>
                    <div class="block-body">
                        <?php include(locate_template("statics-pages/content-success-or-faillure-message.php")); ?>
                        <?php if (is_user_logged_in() && $post_author == get_current_user_id()): ?>
                            <div class="text-center mb-4">
                                <a class="btn btn-outline-dark" href="<?php echo esc_url(add_query_arg(array('action' => "edit"), wp_make_link_relative(get_permalink()))) ?>"><i class="far fa-edit mr-2"></i><?php _e("Edit this shop", "mangeonsafrodomain"); ?></a>
                                <a class="btn btn-outline-dark" href="<?php echo esc_url(add_query_arg(array('action' => "add-product"), wp_make_link_relative(get_permalink()))) ?>"><i class="far fa-plus-square mr-2"></i><?php _e("Add new product", "mangeonsafrodomain"); ?></a>
                                <a class="btn btn-outline-dark" href="<?php echo esc_url(add_query_arg(array('action' => "list-products"), wp_make_link_relative(get_permalink()))) ?>"><i class="far fa-eye mr-2"></i><?php _e("List products", "mangeonsafrodomain"); ?></a>
                                <a class="btn btn-outline-dark" href="<?php echo esc_url(add_query_arg(array('action' => "delete", "ID" => get_the_ID()), wp_make_link_relative(get_permalink(get_page_by_path(__('account', 'mangeonsafrodomain') . "/" . __("seller-zone", "mangeonsafrodomain") . "/" . __("shops", "mangeonsafrodomain"))->ID)))) ?>"><i class="fa fa-times mr-2"></i><?php _e("Delete", "mangeonsafrodomain"); ?></a>
                            </div>
                        <?php endif; ?>
                        <div class="col-lg-12">
                            <div class="block mb-5">
                                <div class="block-body bg-light pt-1">
                                    <ul class="order-summary mb-0 list-unstyled">
                                        <li class="order-summary-item"><span><strong><?php _e("Name", "mangeonsafrodomain"); ?></strong> </span><span><?php echo $shop_name; ?></span></li>
                                        <li class="order-summary-item"><span><strong><?php _e("Category", "mangeonsafrodomain"); ?></strong></span><span>
                                                <?php
                                                $shops_type = wp_get_post_terms(get_the_ID(), 'category', array("fields" => "names"));
                                                foreach ($shops_type as $shop_type):
                                                    $shop_type_name = $shop_type
                                                    ?>

                                                <?php endforeach ?>
                                                <?php echo __($shop_type_name, "mangeonsafrodomain"); ?>
                                            </span></li>
                                        <li class="order-summary-item"><span><strong><?php _e("City", "mangeonsafrodomain"); ?></strong></span><span><?php echo $shop_city; ?></span></li>
                                        <li class="order-summary-item"><p class="text-sm"><?php echo $shop_description; ?></p></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="block mb-5">
                    <div class="block-header"><strong class="text-uppercase"><?php _e("My products", "mangeonsafrodomain"); ?></strong></div>
                    <div class="block-body">
                        <div class="cart">
                            <div class="cart-wrapper">
                                <div class="cart-header text-center">
                                    <div class="row">
                                        <div class="col-4"><?php _e("Image/Title", "mangeonsafrodomain"); ?></div>
                                        <div class="col-1"><?php _e("Price", "mangeonsafrodomain"); ?></div>
                                        <div class="col-2"><?php _e("Currency", "mangeonsafrodomain"); ?></div>
                                        <div class="col-5"><?php _e("Actions", "mangeonsafrodomain"); ?></div>
                                    </div>
                                </div>
                                <div class="cart-body">
                                    <?php
                                    if ($products->have_posts()) :
                                        ?>
                                        <?php
                                        $i = 0;
                                        while ($products->have_posts()): $products->the_post();
                                            ?>
                                            <!-- Product-->

                                            <div class="cart-item">
                                                <div class="row d-flex align-items-center text-center">
                                                    <div class="col-4">
                                                        <?php $prod_thumbnail_image_id = get_post_meta(get_the_ID(), 'product-thubmnail-image-id', true); ?>
                                                        <div class="d-flex align-items-center"><a href="<?php echo wp_make_link_relative(get_permalink()); ?>"><img src="<?php if ($prod_thumbnail_image_id): ?> <?php echo wp_make_link_relative(wp_get_attachment_url($prod_thumbnail_image_id)); ?> <?php else: ?> <?php echo wp_make_link_relative(get_template_directory_uri()); ?>/assets/img/product.png <?php endif ?>" alt="..." class="cart-item-img"></a>
                                                            <div class="cart-title text-left"><a href="<?php echo wp_make_link_relative(get_permalink()); ?>" class="text-uppercase text-dark"><strong><?php the_title() ?></strong></a><br>
                                                                <?php
                                                                $product_categories = array_map('intval', wp_get_post_categories(get_the_ID(), array("fields" => "ids")));
                                                                $post_parent_categories = get_categories(array('hide_empty' => false, 'orderby' => 'name', 'order' => 'ASC', 'parent' => 0));
                                                                foreach ($post_parent_categories as $post_parent_category) {
                                                                    if (in_array($post_parent_category->term_id, $product_categories, true)) {
                                                                        $product_category = $post_parent_category;
                                                                        break;
                                                                    }
                                                                }
                                                                if ($product_category) {
                                                                    $post_sub_parent_categories = get_categories(array('hide_empty' => false, 'orderby' => 'name', 'order' => 'ASC', 'child_of' => $product_category->term_id));
                                                                    foreach ($post_sub_parent_categories as $post_sub_parent_category) {
                                                                        if (in_array($post_sub_parent_category->term_id, $product_categories, true)) {
                                                                            $product_sub_category = $post_sub_parent_category;
                                                                            break;
                                                                        }
                                                                    }
                                                                }
                                                                ?>
                                                                <?php if ($product_category): ?>
                                                                    <span >
                                                                        <a class="text-muted text-sm" href="<?php echo wp_make_link_relative(esc_url(get_category_link($product_category->term_id))) ?>">
                                                                            <?php
                                                                            echo $product_category->name;
                                                                            ?>
                                                                        </a>
                                                                    </span><br>
                                                                <?php endif ?>
                                                                <?php if ($product_sub_category): ?>
                                                                    <span >
                                                                        <a class="text-muted text-sm" href="<?php echo wp_make_link_relative(esc_url(get_category_link($product_sub_category->term_id))) ?>">
                                                                            <?php
                                                                            echo $product_sub_category->name;
                                                                            ?>
                                                                        </a>
                                                                    </span>
                                                                <?php endif ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-1"><?php echo number_format(get_post_meta(get_the_ID(), 'product-price', true), 2, '.', ''); ?></div>
                                                    <div class="col-2">
                                                        <?php
                                                        $product_currrency = get_post(get_post_meta(get_the_ID(), 'product-currency-id', true));
                                                        echo get_post_meta($product_currrency->ID, "currency-code", true)
                                                        ?>
                                                    </div>

                                                    <div class="col-5">
                                                        <a href="<?php echo esc_url(add_query_arg(array('action' => "edit"), wp_make_link_relative(get_permalink()))) ?>" class="btn btn-outline-dark btn-sm"><?php _e("Edit", "mangeonsafrodomain"); ?></a>
                                                        <?php if (get_post_status() == "publish"): ?>
                                                            <a href="<?php echo esc_url(add_query_arg(array('action' => "put-offline"), wp_make_link_relative(get_permalink()))) ?>" class="btn btn-outline-dark btn-sm"><?php _e("Put offline", "mangeonsafrodomain"); ?></a>
                                                        <?php elseif (get_post_status() == "trash"): ?>
                                                            <a href="<?php echo esc_url(add_query_arg(array('action' => "put-online", "ID" => get_the_ID()), wp_make_link_relative(get_permalink(get_page_by_path(__('account', 'mangeonsafrodomain') . "/" . __("seller-zone", "mangeonsafrodomain") . "/" . __("products", "mangeonsafrodomain"))->ID)))) ?>" class="btn btn-outline-dark btn-sm"><?php _e("Put online", "mangeonsafrodomain"); ?></a>
                                                        <?php endif ?>
                                                        <a class="btn btn-outline-dark btn-sm" href="<?php echo esc_url(add_query_arg(array('action' => "delete", "ID" => get_the_ID()), wp_make_link_relative(get_permalink(get_page_by_path(__('account', 'mangeonsafrodomain') . "/" . __("seller-zone", "mangeonsafrodomain") . "/" . __("products", "mangeonsafrodomain"))->ID)))) ?>"><i class="remove icon"></i>Delete</a>    
                                                    </div>
                                                </div>
                                            </div>

                                            <?php
                                        endwhile;
                                        ?>

                                    <?php else: ?>

                                    <?php
                                    endif;
                                    wp_reset_postdata();
                                    ?>


                                </div>
                            </div>
                            <?php if (is_user_logged_in() && $post_author == get_current_user_id()): ?>
                                <div class="text-center mt-4">
                                    <a class="btn btn-outline-dark" href="<?php echo esc_url(add_query_arg(array('action' => "add-product"), wp_make_link_relative(get_permalink()))) ?>"><i class="far fa-plus-square mr-2"></i><?php _e("Add new product", "mangeonsafrodomain"); ?></a>                        
                                </div>
                            <?php endif; ?>

                        </div>

                    </div>
                </div>
            </div>
            <!-- Customer Sidebar-->
            <div class="col-xl-3 col-lg-4 mb-5">
                <div class="customer-sidebar card border-0"> 
                    <div class="customer-profile"><a href="#" class="d-inline-block"><img src="<?php echo wp_make_link_relative(get_template_directory_uri()) ?>/assets/img/photo/kyle-loftus-589739-unsplash-avatar.jpg" class="img-fluid rounded-circle customer-image"></a>
                        <h5> <?php
                            if ($user_pro_name)
                                echo $user_pro_name;
                            else
                                echo $current_user->display_name;
                            ?></h5>
                        <p class="text-muted text-sm mb-0"><?php
                            if ($user_pro_email)
                                echo $user_pro_email;
                            else
                                echo $current_user->user_email;
                            ?></p>
                    </div>
                    <nav class="list-group customer-nav"><a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('account', 'mangeonsafrodomain') . "/" . __('seller-zone', 'mangeonsafrodomain') . "/" . __('shops', 'mangeonsafrodomain'))->ID)) ?>" class="active list-group-item d-flex justify-content-between align-items-center"><span>
                                <svg class="svg-icon svg-icon-heavy mr-2">
                                <use xlink:href="#store-1"></use>
                                </svg><?php _e("Shops", "mangeonsafrodomain"); ?></span></a>
                        <?php if (is_user_logged_in() && $shop_id): ?>
                            <a href="<?php echo esc_url(add_query_arg(array('shop-id' => $shop_id), wp_make_link_relative(get_permalink(get_page_by_path(__('account', 'mangeonsafrodomain') . "/" . __('seller-zone', 'mangeonsafrodomain') . "/" . __('products', 'mangeonsafrodomain'))->ID)))) ?>" class="list-group-item d-flex justify-content-between align-items-center">
                        <?php else: ?>
                            <a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('account', 'mangeonsafrodomain') . "/" . __('seller-zone', 'mangeonsafrodomain') . "/" . __('products', 'mangeonsafrodomain'))->ID)) ?>" class="list-group-item d-flex justify-content-between align-items-center">
                        <?php endif; ?>
                            <span>
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