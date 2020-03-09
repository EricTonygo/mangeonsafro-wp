<!-- Hero Section-->
<section class="hero">
    <div class="container">
        <!-- Breadcrumbs -->
        <ol class="breadcrumb justify-content-center">
            <li class="breadcrumb-item"><a href="<?php echo wp_make_link_relative(home_url('/')); ?>"><?php _e("Home", "mangeonsafrodomain"); ?></a></li>
            <li class="breadcrumb-item active"><?php _e("Checkout", "mangeonsafrodomain"); ?></li>
        </ol>
        <!-- Hero Content-->
        <div class="hero-content pb-5 text-center">
            <h1 class="hero-heading"><?php _e("Checkout", "mangeonsafrodomain"); ?></h1>
            <div class="row">
                <?php if (is_page(get_page_by_path(__('checkout', 'mangeonsafrodomain') . "/" . __('single-address', 'mangeonsafrodomain'))->ID)): ?>
                    <div class="col-xl-8 offset-xl-2"><p class="lead text-muted"><?php _e("Please fill in your address", "mangeonsafrodomain"); ?></p></div>
                <?php elseif (is_page(get_page_by_path(__('checkout', 'mangeonsafrodomain') . "/" . __('delivery', 'mangeonsafrodomain'))->ID)): ?>
                    <div class="col-xl-8 offset-xl-2"><p class="lead text-muted"><?php _e("Choose your delivery method", "mangeonsafrodomain"); ?></p></div>
                <?php elseif (is_page(get_page_by_path(__('checkout', 'mangeonsafrodomain') . "/" . __('payment', 'mangeonsafrodomain'))->ID)): ?>
                    <div class="col-xl-8 offset-xl-2"><p class="lead text-muted"><?php _e("Choose your payment method", "mangeonsafrodomain"); ?></p></div>
                <?php elseif (is_page(get_page_by_path(__('checkout', 'mangeonsafrodomain') . "/" . __('review-checkout', 'mangeonsafrodomain'))->ID)): ?>
                    <div class="col-xl-8 offset-xl-2"><p class="lead text-muted"><?php _e("Please review your order", "mangeonsafrodomain"); ?></p></div>              
                <?php endif; ?>            
            </div>
        </div>
    </div>
</section>
<!-- Checkout-->
<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <ul class="custom-nav nav nav-pills mb-5">
                    <?php if (is_page(get_page_by_path(__('checkout', 'mangeonsafrodomain') . "/" . __('single-address', 'mangeonsafrodomain'))->ID)): ?>
                        <li class="nav-item w-25"><a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('checkout', 'mangeonsafrodomain') . "/" . __('single-address', 'mangeonsafrodomain'))->ID)) ?>" class="nav-link text-sm active"><?php _e("Address", "mangeonsafrodomain"); ?></a></li>
                        <li class="nav-item w-25"><a href="#" class="nav-link text-sm disabled"><?php _e("Delivery method", "mangeonsafrodomain"); ?></a></li>
                        <li class="nav-item w-25"><a href="#" class="nav-link text-sm disabled"><?php _e("Payment method", "mangeonsafrodomain"); ?> </a></li>
                        <li class="nav-item w-25"><a href="#" class="nav-link text-sm disabled"><?php _e("Order review", "mangeonsafrodomain"); ?></a></li>
                    <?php elseif (is_page(get_page_by_path(__('checkout', 'mangeonsafrodomain') . "/" . __('delivery', 'mangeonsafrodomain'))->ID)): ?>
                        <li class="nav-item w-25"><a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('checkout', 'mangeonsafrodomain') . "/" . __('single-address', 'mangeonsafrodomain'))->ID)) ?>" class="nav-link text-sm"><?php _e("Address", "mangeonsafrodomain"); ?></a></li>
                        <li class="nav-item w-25"><a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('checkout', 'mangeonsafrodomain') . "/" . __('delivery', 'mangeonsafrodomain'))->ID)) ?>" class="nav-link text-sm active"><?php _e("Delivery method", "mangeonsafrodomain"); ?></a></li>
                        <li class="nav-item w-25"><a href="#" class="nav-link text-sm disabled"><?php _e("Payment method", "mangeonsafrodomain"); ?> </a></li>
                        <li class="nav-item w-25"><a href="#" class="nav-link text-sm disabled"><?php _e("Order review", "mangeonsafrodomain"); ?></a></li>
                    <?php elseif (is_page(get_page_by_path(__('checkout', 'mangeonsafrodomain') . "/" . __('payment', 'mangeonsafrodomain'))->ID)): ?>
                        <li class="nav-item w-25"><a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('checkout', 'mangeonsafrodomain') . "/" . __('single-address', 'mangeonsafrodomain'))->ID)) ?>" class="nav-link text-sm"><?php _e("Address", "mangeonsafrodomain"); ?></a></li>
                        <li class="nav-item w-25"><a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('checkout', 'mangeonsafrodomain') . "/" . __('delivery', 'mangeonsafrodomain'))->ID)) ?>" class="nav-link text-sm"><?php _e("Delivery method", "mangeonsafrodomain"); ?></a></li>
                        <li class="nav-item w-25"><a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('checkout', 'mangeonsafrodomain') . "/" . __('payment', 'mangeonsafrodomain'))->ID)) ?>" class="nav-link text-sm active"><?php _e("Payment method", "mangeonsafrodomain"); ?> </a></li>
                        <li class="nav-item w-25"><a href="#" class="nav-link text-sm disabled"><?php _e("Order review", "mangeonsafrodomain"); ?></a></li>
                    <?php elseif (is_page(get_page_by_path(__('checkout', 'mangeonsafrodomain') . "/" . __('review-checkout', 'mangeonsafrodomain'))->ID)): ?>
                        <li class="nav-item w-25"><a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('checkout', 'mangeonsafrodomain') . "/" . __('single-address', 'mangeonsafrodomain'))->ID)) ?>" class="nav-link text-sm"><?php _e("Address", "mangeonsafrodomain"); ?></a></li>
                        <li class="nav-item w-25"><a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('checkout', 'mangeonsafrodomain') . "/" . __('delivery', 'mangeonsafrodomain'))->ID)) ?>" class="nav-link text-sm"><?php _e("Delivery method", "mangeonsafrodomain"); ?></a></li>
                        <li class="nav-item w-25"><a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('checkout', 'mangeonsafrodomain') . "/" . __('payment', 'mangeonsafrodomain'))->ID)) ?>" class="nav-link text-sm"><?php _e("Payment method", "mangeonsafrodomain"); ?> </a></li>
                        <li class="nav-item w-25"><a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('checkout', 'mangeonsafrodomain') . "/" . __('review-checkout', 'mangeonsafrodomain'))->ID)) ?>" class="nav-link text-sm active"><?php _e("Order review", "mangeonsafrodomain"); ?></a></li>              
                    <?php endif; ?>
                </ul>
                <?php if (is_page(get_page_by_path(__('checkout', 'mangeonsafrodomain') . "/" . __('single-address', 'mangeonsafrodomain'))->ID)): ?>
                    <form action="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('checkout', 'mangeonsafrodomain') . "/" . __('single-address', 'mangeonsafrodomain'))->ID)) ?>" method="POST" autocomplete="off">
                        <div class="block">
                            <!-- Invoice Address-->
                            <div class="block-header">
                                <h6 class="text-uppercase mb-0"><?php _e("Invoice address", "mangeonsafrodomain"); ?></h6>
                            </div>
                            <div class="block-body">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="fullname_invoice" class="form-label"><?php _e("Full name", "mangeonsafrodomain"); ?></label>
                                        <input type="text" name="fullname_invoice" placeholder="<?php _e("Full name", "mangeonsafrodomain"); ?>" id="fullname_invoice" class="form-control" value="<?php echo $fullname_invoice; ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="emailaddress_invoice" class="form-label"><?php _e("Email", "mangeonsafrodomain"); ?></label>
                                        <input type="text" name="emailaddres_invoice" placeholder="<?php _e("Email", "mangeonsafrodomain"); ?>" id="emailaddress_invoice" class="form-control" value="<?php echo $emailaddress_invoice; ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="street_invoice" class="form-label"><?php _e("Street", "mangeonsafrodomain"); ?></label>
                                        <input type="text" name="street_invoice" placeholder="<?php _e("Street", "mangeonsafrodomain"); ?>" id="street_invoice" class="form-control" value="<?php echo $street_invoice; ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="city_invoice" class="form-label"><?php _e("City", "mangeonsafrodomain"); ?></label>
                                        <input type="text" name="city_invoice" placeholder="<?php _e("City", "mangeonsafrodomain"); ?>" id="city_invoice" class="form-control" value="<?php echo $city_invoice; ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="zip_invoice" class="form-label"><?php _e("Postal code", "mangeonsafrodomain"); ?></label>
                                        <input type="text" name="zip_invoice" placeholder="<?php _e("Postal code", "mangeonsafrodomain"); ?>" id="zip_invoice" class="form-control" value="<?php echo $zip_invoice; ?>" >
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="state_invoice" class="form-label"><?php _e("State", "mangeonsafrodomain"); ?></label>
                                        <input type="text" name="state_invoice" placeholder="<?php _e("State", "mangeonsafrodomain"); ?>" id="state_invoice" class="form-control" value="<?php echo $state_invoice; ?>" >
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="phonenumber_invoice" class="form-label"><?php _e("Phone number", "mangeonsafrodomain"); ?></label>
                                        <input type="text" name="phonenumber_invoice" placeholder="<?php _e("Phone number", "mangeonsafrodomain"); ?>" id="phonenumber_invoice" class="form-control" value="<?php echo $phonenumber_invoice; ?>">
                                    </div>
                                    <div class="form-group col-12 mt-3">
                                        <div class="custom-control custom-checkbox">
                                            <input id="show-shipping-address" type="checkbox" name="show_shipping_address" class="custom-control-input" value="<?php echo $show_shipping_address; ?>">
                                            <label for="show-shipping-address" data-toggle="collapse" data-target="#shippingAddress" aria-expanded="false" aria-controls="shippingAddress" class="custom-control-label align-middle"><?php _e("Use a different shipping address", "mangeonsafrodomain"); ?></label>
                                        </div>
                                    </div>
                                </div>
                                 <!--Invoice Address -->
                            </div>
                             <!--Shippping Address -->
                            <div id="shippingAddress" aria-expanded="false" class="collapse">
                                <div class="block">
                                    <div class="block-header">
                                        <h6 class="text-uppercase mb-0"><?php _e("Shipping address", "mangeonsafrodomain"); ?> </h6>
                                    </div>
                                    <div class="block-body">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="street_shipping" class="form-label"><?php _e("Street", "mangeonsafrodomain"); ?></label>
                                                <input type="text" name="street_shipping" placeholder="<?php _e("Street", "mangeonsafrodomain"); ?>" id="street_shipping" class="form-control" value="<?php echo $street_shipping; ?>">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="city_shipping" class="form-label"><?php _e("City", "mangeonsafrodomain"); ?></label>
                                                <input type="text" name="city_shipping" placeholder="<?php _e("City", "mangeonsafrodomain"); ?>" id="city_shipping" class="form-control" value="<?php echo $city_shipping; ?>">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="zip_shipping" class="form-label"><?php _e("Postal code", "mangeonsafrodomain"); ?></label>
                                                <input type="text" name="zip_shipping" placeholder="<?php _e("Postal code", "mangeonsafrodomain"); ?>" id="zip_shipping" class="form-control" value="<?php echo $zip_shipping; ?>">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="state_shipping" class="form-label"><?php _e("State", "mangeonsafrodomain"); ?></label>
                                                <input type="text" name="state_shipping" placeholder="<?php _e("State", "mangeonsafrodomain"); ?>" id="state_shipping" class="form-control" value="<?php echo $state_shipping; ?>">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="phonenumber_shipping" class="form-label"><?php _e("Phone number", "mangeonsafrodomain"); ?></label>
                                                <input type="text" name="phonenumber_shipping" placeholder="<?php _e("Phone number", "mangeonsafrodomain"); ?>" id="phonenumber_shipping" class="form-control" value="<?php echo $phonenumber_shipping; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                 <!--Shipping Address -->
                            </div>
                        </div>
                        <div class="mb-5 d-flex justify-content-between flex-column flex-lg-row"><a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('cart', 'mangeonsafrodomain'))->ID)) ?>" class="btn btn-link text-muted"> <i class="fa fa-angle-left mr-2"></i><?php _e("Back to cart", "mangeonsafrodomain") ?> </a><button type="submit" class="btn btn-dark"><?php _e("Choose delivery method", "mangeonsafrodomain") ?><i class="fa fa-angle-right ml-2"></i></button></div>
                    </form>
                <?php elseif (is_page(get_page_by_path(__('checkout', 'mangeonsafrodomain') . "/" . __('delivery', 'mangeonsafrodomain'))->ID)): ?>
                    <div class="block my-5">
                        <form action="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('checkout', 'mangeonsafrodomain') . "/" . __('delivery', 'mangeonsafrodomain'))->ID)) ?>" method="POST" autocomplete="off">
                            <div class="block-body">
                                <div class="row">
                                    <div class="form-group col-md-6 d-flex align-items-center">
                                        <input type="radio" name="shippping_method" id="option0" value="1" <?php if($shippping_method == 1): ?>selected<?php endif; ?>>
                                        <label for="option0" class="ml-3"><strong class="d-block text-uppercase mb-2"><?php _e("Livraison à domicile", "mangeonsafrodomain"); ?></strong><span class="text-muted text-sm"><?php _e("Se faire livrer à son domicile", "mangeonsafrodomain"); ?></span></label>
                                    </div>
                                    <div class="form-group col-md-6 d-flex align-items-center">
                                        <input type="radio" name="shippping_method" id="option1" value="2" <?php if($shippping_method == 2): ?>selected<?php endif; ?>>
                                        <label for="option1" class="ml-3"><strong class="d-block text-uppercase mb-2"><?php _e("Point de relais", "mangeonsafrodomain"); ?></strong><span class="text-muted text-sm"><?php _e("Laisser votre commande à un point de relais", "mangeonsafrodomain"); ?>.</span></label>
                                    </div>
                                    <div class="form-group col-md-6 d-flex align-items-center">
                                        <input type="radio" name="shippping_method" id="option2" value="3" <?php if($shippping_method == 3): ?>selected<?php endif; ?>>
                                        <label for="option2" class="ml-3"><strong class="d-block text-uppercase mb-2"><?php _e("Pas de livraison", "mangeonsafrodomain"); ?></strong><span class="text-muted text-sm"><?php _e("Vous irez consommer sur place", "mangeonsafrodomain"); ?>.</span></label>
                                    </div>
                                    <div class="form-group col-md-6 d-flex align-items-center">
<!--                                        <input type="radio" name="shippping" id="option3">
                                        <label for="option3" class="ml-3"><strong class="d-block text-uppercase mb-2">Usps next day</strong><span class="text-muted text-sm">Get it right on next day - fastest option possible.</span></label>-->
                                    </div>
                                </div>
                            </div>
                            <div class="mb-5 d-flex justify-content-between flex-column flex-lg-row"><a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('checkout', 'mangeonsafrodomain') . "/" . __('single-address', 'mangeonsafrodomain'))->ID)) ?>" class="btn btn-link text-muted"> <i class="fa fa-angle-left mr-2"></i><?php _e("Back to address", "mangeonsafrodomain") ?></a><button type="submit" class="btn btn-dark"><?php _e("Choose payment method", "mangeonsafrodomain"); ?><i class="fa fa-angle-right ml-2"></i></button></div>
                        </form>
                    </div>
                <?php elseif (is_page(get_page_by_path(__('checkout', 'mangeonsafrodomain') . "/" . __('payment', 'mangeonsafrodomain'))->ID)): ?>
                    <form action="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('checkout', 'mangeonsafrodomain') . "/" . __('payment', 'mangeonsafrodomain'))->ID)) ?>" method="POST" autocomplete="off">
                        <div class="mb-5">
                            <div id="accordion" role="tablist">
                                <div class="block mb-3">
                                    <div id="headingOne" role="tab" class="block-header"><strong><a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne" class="accordion-link"><?php _e("Credit card", "mangeonsafrodomain"); ?></a></strong></div>
                                    <div id="collapseOne" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion" class="collapse show">
                                        <div class="block-body">
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="card-name" class="form-label"><?php _e("Name on card", "mangeonsafrodomain"); ?></label>
                                                    <input type="text" name="card_name" placeholder="<?php _e("Name on card", "mangeonsafrodomain"); ?>" id="card-name" class="form-control" value="<?php echo $card_name; ?>">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="card-number" class="form-label"><?php _e("Card number", "mangeonsafrodomain"); ?></label>
                                                    <input type="text" name="card_number" placeholder="<?php _e("Card number", "mangeonsafrodomain"); ?>" id="card-number" class="form-control" value="<?php echo $card_number; ?>">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="expiry-date" class="form-label"><?php _e("Expiry date", "mangeonsafrodomain"); ?></label>
                                                    <input type="text" name="card_expiry_date" placeholder="MM/YY" id="card-expiry-date" class="form-control" value="<?php echo $card_expiry_date; ?>">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="cvv" class="form-label"><?php _e("CVC/CVV", "mangeonsafrodomain"); ?></label>
                                                    <input type="text" name="card_cvv" placeholder="<?php _e("CVC/CVV", "mangeonsafrodomain"); ?>" id="card-cvv" class="form-control" value="<?php echo $card_cvv; ?>">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="zip" class="form-label"><?php _e("ZIP", "mangeonsafrodomain"); ?></label>
                                                    <input type="text" name="card_zip" placeholder="<?php _e("ZIP", "mangeonsafrodomain"); ?>" id="card-zip" class="form-control" value="<?php echo $card_zip; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="block mb-3">
                                    <div id="headingTwo" role="tab" class="block-header"><strong><a data-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" class="accordion-link collapsed"><?php _e("PayPal", "mangeonsafrodomain"); ?></a></strong></div>
                                    <div id="collapseTwo" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion" class="collapse">
                                        <div class="block-body py-5 d-flex align-items-center">
                                            <input type="radio" name="payment_method" id="payment-method-1" value="2">
                                            <label for="payment-method-1" class="ml-3"><strong class="d-block text-uppercase mb-2"><?php _e("Pay with PayPal", "mangeonsafrodomain"); ?></strong><span class="text-muted text-sm"></span></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="block mb-3">
                                    <div id="headingThree" role="tab" class="block-header"><strong><a data-toggle="collapse" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree" class="accordion-link collapsed"><?php _e("Pay on delivery", "mangeonsafrodomain"); ?></a></strong></div>
                                    <div id="collapseThree" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion" class="collapse">
                                        <div class="block-body py-5 d-flex align-items-center">
                                            <input type="radio" name="payment_method" id="payment-method-2" value="3">
                                            <label for="payment-method-2" class="ml-3"><strong class="d-block text-uppercase mb-2"><?php _e("Pay on delivery", "mangeonsafrodomain"); ?></strong><span class="text-muted text-sm"></span></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-5 d-flex justify-content-between flex-column flex-lg-row"><a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('checkout', 'mangeonsafrodomain') . "/" . __('delivery', 'mangeonsafrodomain'))->ID)) ?>" class="btn btn-link text-muted"> <i class="fa fa-angle-left mr-2"></i><?php _e("Back to delivery method", "mangeonsafrodomain") ?></a><button type="submit" class="btn btn-dark"><?php _e("Continue to order review", "mangeonsafrodomain") ?><i class="fa fa-angle-right ml-2"></i></button></div>
                    </form>
                <?php elseif (is_page(get_page_by_path(__('checkout', 'mangeonsafrodomain') . "/" . __('review-checkout', 'mangeonsafrodomain'))->ID)): ?>
                    <div class="mb-5">
                        <div class="cart">
                            <div class="cart-wrapper">
                                <div class="cart-header text-center">
                                    <div class="row">
                                        <div class="col-6"><?php _e("Item", "mangeonsafrodomain"); ?></div>
                                        <div class="col-2"><?php _e("Price", "mangeonsafrodomain"); ?></div>
                                        <div class="col-2"><?php _e("Quantity", "mangeonsafrodomain"); ?></div>
                                        <div class="col-2"><?php _e("Total", "mangeonsafrodomain"); ?></div>
                                    </div>
                                </div>
                                <div class="cart-body">
                                    <?php
                                    if ($cart && !empty($cart)):
                                        ?>
                                        <?php
                                        $sub_total_cart = 0;
                                        $i = 0;
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
                                                    <div class="col-6">
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
                                                        <?php echo $product_item_quantity; ?>
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
                                                </div>
                                            </div>
                                            <!-- Product-->
                                            <?php $i++; ?>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="mb-5 d-flex justify-content-between flex-column flex-lg-row"><a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('checkout', 'mangeonsafrodomain') . "/" . __('review-checkout', 'mangeonsafrodomain'))->ID)) ?>" class="btn btn-link text-muted"> <i class="fa fa-angle-left mr-2"></i><?php _e("Back to payment method", "mangeonsafrodomain") ?></a><a href="<?php echo esc_url(add_query_arg(array("confirmed-order" => "true"), wp_make_link_relative(get_permalink(get_page_by_path(__('checkout', 'mangeonsafrodomain') . "/" . __('review-checkout', 'mangeonsafrodomain'))->ID)))); ?>" class="btn btn-dark"><?php _e("Place an order", "mangeonsafrodomain"); ?><i class="fa fa-angle-right ml-2"></i></a></div>
                    </div>
                <?php endif; ?> 
            </div>
            <?php
            $my_prod_currency = null;
            if ($cart && !empty($cart)) {
                ?>
                <?php
                $sub_total_cart = 0;
                $i = 0;
                foreach ($cart as $item) {
                    $product = get_post($item["product-id"]);
                    $product_thumbnail_image_id = get_post_meta($product->ID, 'product-thubmnail-image-id', true);
                    $product_item_quantity = $item["product-item-quantity"];
                    $product_delivery_mode = $item["product-delivery-mode"];
                    $sub_total_cart += get_post_meta($product->ID, 'product-price', true) * $product_item_quantity;
                    $shipping_frees = 0;
                    $tax = 0;
                    $total_cart = $sub_total_cart + $shipping_frees + $tax;
                    $my_prod_currency = get_post(get_post_meta($product->ID, "product-currency-id", true));
                }
            }
            ?>
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
                                    if ($my_prod_currency && get_post_meta($my_prod_currency->ID, "currency-print-left-side", true)) {
                                        echo get_post_meta($my_prod_currency->ID, "currency-symbol", true);
                                    }
                                    ?><?php echo number_format($sub_total_cart, 2, '.', ''); ?><?php
                                    if ($my_prod_currency && get_post_meta($my_prod_currency->ID, "currency-print-right-side", true)) {
                                        echo get_post_meta($my_prod_currency->ID, "currency-symbol", true);
                                    }
                                    ?>  
                                </span>
                            </li>
                            <li class="order-summary-item"><span><?php _e("Shipping and handling", "mangeonsafrodomain"); ?></span>
                                <span>
                                    <?php
                                    if ($my_prod_currency && get_post_meta($my_prod_currency->ID, "currency-print-left-side", true)) {
                                        echo get_post_meta($my_prod_currency->ID, "currency-symbol", true);
                                    }
                                    ?><?php echo number_format($shipping_frees, 2, '.', ''); ?><?php
                                    if ($my_prod_currency && get_post_meta($my_prod_currency->ID, "currency-print-right-side", true)) {
                                        echo get_post_meta($my_prod_currency->ID, "currency-symbol", true);
                                    }
                                    ?>  
                                </span>
                            </li>
                            <li class="order-summary-item"><span><?php _e("Tax", "mangeonsafrodomain"); ?></span>
                                <span>
                                    <?php
                                    if ($my_prod_currency && get_post_meta($my_prod_currency->ID, "currency-print-left-side", true)) {
                                        echo get_post_meta($my_prod_currency->ID, "currency-symbol", true);
                                    }
                                    ?><?php echo number_format($tax, 2, '.', ''); ?><?php
                                    if ($my_prod_currency && get_post_meta($my_prod_currency->ID, "currency-print-right-side", true)) {
                                        echo get_post_meta($my_prod_currency->ID, "currency-symbol", true);
                                    }
                                    ?>  
                                </span>
                            </li>
                            <li class="order-summary-item border-0"><span><?php _e("Total", "mangeonsafrodomain"); ?></span>
                                <strong class="order-summary-total">
                                    <?php
                                    if ($my_prod_currency && get_post_meta($my_prod_currency->ID, "currency-print-left-side", true)) {
                                        echo get_post_meta($my_prod_currency->ID, "currency-symbol", true);
                                    }
                                    ?><?php echo number_format($total_cart, 2, '.', ''); ?><?php
                                    if ($my_prod_currency && get_post_meta($my_prod_currency->ID, "currency-print-right-side", true)) {
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