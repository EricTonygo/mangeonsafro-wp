<!-- Hero Section-->
<section class="hero">
    <div class="container">
        <!-- Breadcrumbs -->
        <ol class="breadcrumb justify-content-center">
            <li class="breadcrumb-item"><a href="<?php echo wp_make_link_relative(home_url('/')); ?>"><?php _e("Home", "mangeonsafrodomain"); ?></a></li>
            <li class="breadcrumb-item active"><?php _e("Shopping cart", "mangeonsafrodomain"); ?></li>
        </ol>
        <!-- Hero Content-->
        <div class="hero-content pb-5 text-center">
            <h1 class="hero-heading"><?php _e("Shopping cart", "mangeonsafrodomain"); ?></h1>
            <div class="row">   
                <div class="col-xl-8 offset-xl-2"><p class="lead text-muted"><?php printf(__("You have %d item(s) in your shopping cart", "mangeonsafrodomain"), $cart_items_count); ?></p></div>
            </div>
        </div>
    </div>
</section>
<!-- Shopping Cart Section-->
<section>
    <div class="container">
        <div class="row mb-5"> 
            <?php include(locate_template("statics-pages/content-success-or-faillure-message.php")); ?>
            <div class="col-lg-8">
                <div class="cart">
                    <div class="cart-wrapper">
                        <div class="cart-header text-center">
                            <div class="row">
                                <div class="col-5"><?php _e("Item", "mangeonsafrodomain"); ?></div>
                                <div class="col-2"><?php _e("Price", "mangeonsafrodomain"); ?></div>
                                <div class="col-2"><?php _e("Quantity", "mangeonsafrodomain"); ?></div>
                                <div class="col-2"><?php _e("Total", "mangeonsafrodomain"); ?></div>
                                <div class="col-1"></div>
                            </div>
                        </div>
                        <div class="cart-body">
                            <?php
                            if ($cart && !empty($cart)):
                                ?>
                                <?php
                                $sub_total_cart = 0;
                                $i=0;
                                foreach ($cart as $item):
                                    $product = get_post($item["product-id"]);
                                    $product_thumbnail_image_id = get_post_meta($product->ID, 'product-thubmnail-image-id', true);
                                    $product_item_quantity = $item["product-item-quantity"];
                                    $product_delivery_mode = $item["product-delivery-mode"];
                                    $sub_total_cart += get_post_meta($product->ID, 'product-price', true) * $product_item_quantity;
                                    $shipping_frees = 0;
                                    $tax = 0;
                                    $total_cart = $sub_total_cart + $shipping_frees + $tax;
                                    ?>
                                    <!-- Product-->
                                    <div class="cart-item">
                                        <div class="row d-flex align-items-center text-center">
                                            <div class="col-5">
                                                <div class="d-flex align-items-center"><a href="<?php echo wp_make_link_relative(get_permalink($product->ID)); ?>"><img src="<?php if ($product_thumbnail_image_id): ?> <?php echo wp_make_link_relative(wp_get_attachment_url($product_thumbnail_image_id)); ?> <?php else: ?> <?php echo wp_make_link_relative(get_template_directory_uri()); ?>/assets/img/product.png <?php endif ?>" alt="..." class="cart-item-img"></a>
                                                    <div class="cart-title text-left"><a href="<?php echo wp_make_link_relative(get_permalink($product->ID)); ?>" class="text-uppercase text-dark"><strong><?php echo $product->post_title; ?></strong></a><br>
                                                        <?php
                                                        $product_categories = array_map('intval', wp_get_post_categories($product->ID, array("fields" => "ids")));
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
                                                            <span class="text-muted text-sm">
                                                                <?php
                                                                echo $product_category->name;
                                                                ?>
                                                            </span><br>
                                                        <?php endif ?>
                                                        <?php if ($product_sub_category): ?>
                                                            <span class="text-muted text-sm">
                                                                <?php
                                                                    echo $product_sub_category->name;
                                                                    ?>
                                                            </span><br>
                                                        <?php endif ?>
                                                        <?php if ($product_delivery_mode): ?>
                                                            <span class="text-muted text-sm">
                                                                <?php _e("Delivery", "mangeonsafrodomain"); ?> : <?php echo $product_delivery_mode; ?>
                                                            </span><br>
                                                        <?php endif ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <?php
                                                $my_prod_currency = get_post(get_post_meta($product->ID, "product-currency-id", true));
                                                if (get_post_meta($my_prod_currency->ID, "currency-print-left-side", true)) {
                                                    echo get_post_meta($my_prod_currency->ID, "currency-symbol", true);
                                                }
                                                ?><?php echo number_format(get_post_meta($product->ID, "product-price", true), 2, '.', ''); ?><?php
                                                if (get_post_meta($my_prod_currency->ID, "currency-print-right-side", true)) {
                                                    echo get_post_meta($my_prod_currency->ID, "currency-symbol", true);
                                                }
                                                ?> 
                                            </div>
                                            <div class="col-2">
                                                <div class="d-flex align-items-center">
                                                    <form id="update-item-quantity-form-<?php echo $i; ?>" action="<?php echo wp_make_link_relative(get_permalink())?>" method="POST" autocomplete="off">
                                                        <input type="hidden" name="action" value="update-item-quantity">
                                                        <input type="hidden" name="item-number" value="<?php echo $i; ?>">
                                                        <button type="submit" class="btn btn-items btn-items-decrease">-</button>
                                                        <input type="text" name="product-item-quantity" value="<?php echo $product_item_quantity; ?>" class="form-control text-center input-items">
                                                        <button type="submit" class="btn btn-items btn-items-increase">+</button>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="col-2 text-center">
                                                <?php
                                                if (get_post_meta($my_prod_currency->ID, "currency-print-left-side", true)) {
                                                    echo get_post_meta($my_prod_currency->ID, "currency-symbol", true);
                                                }
                                                ?><?php echo number_format(get_post_meta($product->ID, "product-price", true) * $product_item_quantity, 2, '.', ''); ?><?php
                                                if (get_post_meta($my_prod_currency->ID, "currency-print-right-side", true)) {
                                                    echo get_post_meta($my_prod_currency->ID, "currency-symbol", true);
                                                }
                                                ?> 
                                            </div>
                                            <div class="col-1 text-center"><a href="<?php echo esc_url(add_query_arg(array("action" => "delete-item", "item-number" => $i), wp_make_link_relative(get_permalink()))) ?>" class="cart-remove"> <i class="fa fa-times"></i></a></div>
                                        </div>
                                    </div>
                                    <!-- Product-->
                                    <?php $i++; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="my-5 d-flex justify-content-between flex-column flex-lg-row"><a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('our-products', 'mangeonsafrodomain'))->ID)) ?>" class="btn btn-link text-muted"><i class="fa fa-chevron-left"></i> <?php _e("Continue Shopping", "mangeonsafrodomain"); ?></a><a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('checkout', 'mangeonsafrodomain'))->ID)) ?>" class="btn btn-dark"><?php _e("Proceed to checkout", "mangeonsafrodomain"); ?> <i class="fa fa-chevron-right"></i>                                                     </a></div>
            </div>
            <div class="col-lg-4">
                <div class="block mb-5">
                    <div class="block-header">
                        <h6 class="text-uppercase mb-0"><?php _e("Order Summary", "mangeonsafrodomain"); ?></h6>
                    </div>
                    <div class="block-body bg-light pt-1">
                        <p class="text-sm"><?php _e("Shipping and additional costs are calculated based on values you have entered", "mangeonsafrodomain"); ?>.</p>
                        <ul class="order-summary mb-0 list-unstyled">
                            <li class="order-summary-item"><span><?php _e("Order Subtotal", "mangeonsafrodomain"); ?> </span>
                                <span>
                                    <?php
                                    if (get_post_meta($my_prod_currency->ID, "currency-print-left-side", true)) {
                                        echo get_post_meta($my_prod_currency->ID, "currency-symbol", true);
                                    }
                                    ?><?php echo number_format($sub_total_cart, 2, '.', ''); ?><?php
                                    if (get_post_meta($my_prod_currency->ID, "currency-print-right-side", true)) {
                                        echo get_post_meta($my_prod_currency->ID, "currency-symbol", true);
                                    }
                                    ?>  
                                </span>
                            </li>
                            <li class="order-summary-item"><span><?php _e("Shipping and handling", "mangeonsafrodomain"); ?></span>
                                <span>
                                    <?php
                                    if (get_post_meta($my_prod_currency->ID, "currency-print-left-side", true)) {
                                        echo get_post_meta($my_prod_currency->ID, "currency-symbol", true);
                                    }
                                    ?><?php echo number_format($shipping_frees, 2, '.', ''); ?><?php
                                    if (get_post_meta($my_prod_currency->ID, "currency-print-right-side", true)) {
                                        echo get_post_meta($my_prod_currency->ID, "currency-symbol", true);
                                    }
                                    ?>  
                                </span>
                            </li>
                            <li class="order-summary-item"><span><?php _e("Tax", "mangeonsafrodomain"); ?></span>
                                <span>
                                    <?php
                                    if (get_post_meta($my_prod_currency->ID, "currency-print-left-side", true)) {
                                        echo get_post_meta($my_prod_currency->ID, "currency-symbol", true);
                                    }
                                    ?><?php echo number_format($tax, 2, '.', ''); ?><?php
                                    if (get_post_meta($my_prod_currency->ID, "currency-print-right-side", true)) {
                                        echo get_post_meta($my_prod_currency->ID, "currency-symbol", true);
                                    }
                                    ?>  
                                </span>
                            </li>
                            <li class="order-summary-item border-0"><span><?php _e("Total", "mangeonsafrodomain"); ?></span>
                                <strong class="order-summary-total">
                                    <?php
                                    if (get_post_meta($my_prod_currency->ID, "currency-print-left-side", true)) {
                                        echo get_post_meta($my_prod_currency->ID, "currency-symbol", true);
                                    }
                                    ?><?php echo number_format($total_cart, 2, '.', ''); ?><?php
                                    if (get_post_meta($my_prod_currency->ID, "currency-print-right-side", true)) {
                                        echo get_post_meta($my_prod_currency->ID, "currency-symbol", true);
                                    }
                                    ?>  
                                </strong>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>