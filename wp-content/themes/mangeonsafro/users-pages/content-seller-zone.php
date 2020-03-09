<!-- Hero Section-->
<section class="hero">
    <div class="container">
        <!-- Breadcrumbs -->
        <ol class="breadcrumb justify-content-center">
            <li class="breadcrumb-item"><a href="<?php echo wp_make_link_relative(home_url('/')); ?>"><?php _e("Home", "mangeonsafrodomain"); ?></a></li>
            <li class="breadcrumb-item"><a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('account', 'mangeonsafrodomain') . "/" . __('profile', 'mangeonsafrodomain'))->ID)) ?>"><?php _e("My Account", "mangeonsafrodomain"); ?></a></li>
            <li class="breadcrumb-item active"><?php _e("Seller zone", "mangeonsafrodomain"); ?></li>
        </ol>
        <!-- Hero Content-->
        <div class="hero-content text-center">
            <div style="text-align: left;">
                <?php include(locate_template("statics-pages/content-success-or-faillure-message.php")); ?>
            </div>
            <h1 class="hero-heading"><?php _e("Seller zone", "mangeonsafrodomain"); ?></h1>
            <!--            <div class="row">   
                            <div class="col-xl-8 offset-xl-2"><p class="lead text-muted"><?php _e("Profile description", "mangeonsafrodomain"); ?>.</p></div>
                        </div>-->
        </div>
    </div>
</section>
<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-xl-9">
                <?php include(locate_template("statics-pages/content-success-or-faillure-message.php")); ?>
                <div class="block mb-5">
                    <div class="block-header"><strong class="text-uppercase"><?php _e("My Shops", "mangeonsafrodomain"); ?></strong></div>
                    <div class="block-body">
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
                                                <a class="btn btn-outline-dark btn-sm" href="<?php echo wp_make_link_relative(get_permalink()); ?>"><i class="setting icon"></i><?php _e("Manage", "mangeonsafrodomain"); ?></a>
                                            </td>
                                        </tr>
                                        <?php
                                    endwhile;
                                    ?>

                                <?php else: ?>

                                <?php
                                endif;
                                wp_reset_postdata();
                                ?>


                            </tbody>
                        </table>
                        <div class="text-center mt-4">
                            <a class="btn btn-outline-dark" href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('account', 'mangeonsafrodomain') . '/' . __("seller-zone", "mangeonsafrodomain") . '/' . __("shops", "mangeonsafrodomain") . '/' . __("new-shop", "mangeonsafrodomain"))->ID)); ?>"><i class="far fa-plus-square mr-2"></i><?php _e("Create new shop", "mangeonsafrodomain"); ?></a>
                            <?php if ($total_post_pages > 5): ?>
                                <a class="btn btn-outline-dark" href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('account', 'mangeonsafrodomain') . '/' . __("seller-zone", "mangeonsafrodomain") . '/' . __("shops", "mangeonsafrodomain"))->ID)); ?>"><i class="far fa-eye mr-2"></i><?php _e("See more shops", "mangeonsafrodomain"); ?>...</a>
                            <?php endif ?>
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

                        </div>
                        <div class="text-center mt-4">
                            <!--<a class="btn btn-outline-dark" href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('account', 'mangeonsafrodomain') . '/' . __("seller-zone", "mangeonsafrodomain") . '/' . __("products", "mangeonsafrodomain") . '/' . __("new-product", "mangeonsafrodomain"))->ID)); ?>"><i class="far fa-plus-square mr-2"></i><?php _e("Add new product", "mangeonsafrodomain"); ?></a>-->
                            <?php if ($total_post_products_pages > 5): ?>
                                <a class="btn btn-outline-dark" href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('account', 'mangeonsafrodomain') . '/' . __("seller-zone", "mangeonsafrodomain") . '/' . __("products", "mangeonsafrodomain"))->ID)); ?>"><i class="far fa-eye mr-2"></i><?php _e("See more products", "mangeonsafrodomain"); ?>...</a>
                            <?php endif ?>
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
                    <nav class="list-group customer-nav"><a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('account', 'mangeonsafrodomain') . "/" . __('seller-zone', 'mangeonsafrodomain') . "/" . __('shops', 'mangeonsafrodomain'))->ID)) ?>" class="list-group-item d-flex justify-content-between align-items-center"><span>
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