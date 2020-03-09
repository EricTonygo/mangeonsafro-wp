<section class="product-details">
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-6 py-3 order-2 order-lg-1">
                <div data-slider-id="1" class="owl-carousel owl-theme owl-dots-modern detail-full">
                    <div style="background: center center url('<?php if ($prod_thumbnail_image_id): ?> <?php echo wp_make_link_relative(wp_get_attachment_url($prod_thumbnail_image_id)); ?> <?php else: ?> <?php echo wp_make_link_relative(get_template_directory_uri()); ?>/assets/img/product.png <?php endif ?>') no-repeat; background-size: cover;" class="detail-full-item">     </div>
                    <div style="background: center center url('img/photo/kyle-loftus-596319-detail-2.jpg') no-repeat; background-size: cover;" class="detail-full-item">     </div>
                    <div style="background: center center url('img/photo/kyle-loftus-596319-detail-3.jpg') no-repeat; background-size: cover;" class="detail-full-item">     </div>
                    <div style="background: center center url('img/photo/kyle-loftus-594535-unsplash-detail-3.jpg') no-repeat; background-size: cover;" class="detail-full-item">     </div>
                    <div style="background: center center url('img/photo/kyle-loftus-594535-unsplash-detail-4.jpg') no-repeat; background-size: cover;" class="detail-full-item">     </div>
                </div>
            </div>
            <div class="d-flex align-items-center col-lg-6 col-xl-5 pl-lg-5 mb-5 order-1 order-lg-2">

                <div>
                    <?php include(locate_template("statics-pages/content-success-or-faillure-message.php")); ?>
                    <ul class="breadcrumb justify-content-start">
                        <li class="breadcrumb-item"><a href="<?php echo wp_make_link_relative(home_url('/')); ?>"><?php _e("Home", "mangeonsafrodomain"); ?></a></li>
                        <li class="breadcrumb-item"><a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('our-products', 'mangeonsafrodomain'))->ID)) ?>"><?php _e("Products", "mangeonsafrodomain"); ?></a></li>
                        <?php if ($product_category): ?>
                            <li class="breadcrumb-item"><a href="<?php echo wp_make_link_relative(esc_url(get_category_link($product_category->term_id))) ?>"><?php echo $product_category->name; ?></a></li>
                        <?php endif ?>
                        <?php if ($product_sub_category): ?>
                            <li class="breadcrumb-item"><a href="<?php echo wp_make_link_relative(esc_url(get_category_link($product_sub_category->term_id))) ?>"><?php echo $product_sub_category->name; ?></a></li>
                        <?php endif ?>
                        <li class="breadcrumb-item active"><?php the_title(); ?></li>
                    </ul>
                    <h3 class="mb-4"><?php the_title(); ?></h3>
                    <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-sm-between mb-4">
                        <ul class="list-inline mb-2 mb-sm-0">
                            <li class="list-inline-item h4 font-weight-light mb-0"><?php
                                if ($prod_currency_print_left_side) {
                                    echo get_post_meta($prod_currency->ID, "currency-symbol", true);
                                }
                                ?><?php echo number_format($prod_price, 2, '.', ''); ?><?php
                                if ($prod_currency_print_right_side) {
                                    echo get_post_meta($prod_currency->ID, "currency-symbol", true);
                                }
                                ?></li>
                            <?php if ($prod_delete_price): ?>
                                <li class="list-inline-item text-muted font-weight-light"> 
                                    <del><?php
                                        if ($prod_currency_print_left_side) {
                                            echo get_post_meta($prod_currency->ID, "currency-symbol", true);
                                        }
                                        ?><?php echo number_format($prod_delete_price, 2, '.', ''); ?><?php
                                        if ($prod_currency_print_right_side) {
                                            echo get_post_meta($prod_currency->ID, "currency-symbol", true);
                                        }
                                        ?></del>
                                </li>
                            <?php endif; ?>
                        </ul>
                        <div class="d-flex align-items-center">
                            <ul class="list-inline mr-2 mb-0">
                                <?php
                                $reviews_mean_rest = 5 - $reviews_mean;
                                ?>
                                <?php for ($i = 0; $i < $reviews_mean; $i++): ?>
                                    <li class="list-inline-item mr-0"><i class="fa fa-star text-primary"></i></li>
                                <?php endfor; ?>
                                <?php if ($reviews_mean_rest > 0) : ?>
                                    <?php for ($j = 0; $j < $reviews_mean_rest; $j++): ?>
                                        <i class="fa fa-xs fa-star text-gray-300"></i>
                                    <?php endfor; ?>
                                <?php endif; ?>
                            </ul><span class="text-muted text-uppercase text-sm"><?php echo $reviews_count; ?> <?php _e("review", "mangeonsafrodomain"); ?> <?php if ($reviews_count > 1): ?>s<?php endif; ?></span>
                        </div>
                    </div>
                    <p class="mb-4 text-muted"><?php the_excerpt(); ?></p>
                    <form action="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('cart', 'mangeonsafrodomain'))->ID)) ?>" method="POST" autocomplete="off">
                        <div class="row">
                            <input name="product-id" type="hidden" value="<?php the_ID(); ?>">
                            <!--                            <div class="col-sm-6 col-lg-12 detail-option mb-3">
                                                            <h6 class="detail-option-heading"><?php _e("Delivery mode", "mangeonsafrodomain"); ?> </h6>
                                                            <label for="material_0" class="btn btn-sm btn-outline-secondary detail-option-btn-label">
                            
                            <?php _e("In Home", "mangeonsafrodomain"); ?>
                                                                <input type="radio" name="product-delivery-mode" value="home" id="material_0" required class="input-invisible">
                                                            </label>
                                                            <label for="material_1" class="btn btn-sm btn-outline-secondary detail-option-btn-label">
                            
                            <?php _e("Relay station", "mangeonsafrodomain"); ?>
                                                                <input type="radio" name="product-delivery-mode" value="relay-station" id="material_1" required class="input-invisible">
                                                            </label>
                                                        </div>-->

                            <div class="col-12 col-lg-6 detail-option mb-5">
                                <label class="detail-option-heading font-weight-bold"><?php _e("Items number", "mangeonsafrodomain"); ?> <span>(<?php _e("required", "mangeonsafrodomain"); ?>)</span></label>
                                <input name="product-item-quantity" type="number" value="1" class="form-control detail-quantity" required="true">
                            </div>
                        </div>

                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <button type="submit" class="btn btn-dark btn-lg mb-1"> <i class="fa fa-shopping-cart mr-2"></i><?php _e("Add to cart", "mangeonsafrodomain"); ?></button>
                            </li>
                            <!--li class="list-inline-item"><a href="#" class="btn btn-outline-secondary mb-1"> <i class="far fa-heart mr-2"></i>Add to wishlist</a></li-->
                        </ul>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="mt-5">
    <div class="container">
        <ul role="tablist" class="nav nav-tabs flex-column flex-sm-row">
            <li class="nav-item"><a data-toggle="tab" href="#description" role="tab" class="nav-link detail-nav-link active"><?php _e("Description", "mangeonsafrodomain"); ?></a></li>
            <li class="nav-item"><a data-toggle="tab" href="#additional-information" role="tab" class="nav-link detail-nav-link"><?php _e("Additional informations", "mangeonsafrodomain"); ?></a></li>
            <li class="nav-item"><a data-toggle="tab" href="#reviews" role="tab" class="nav-link detail-nav-link"><?php _e("Notes and reviews", "mangeonsafrodomain"); ?></a></li>
        </ul>
        <div class="tab-content py-4">
            <div id="description" role="tabpanel" class="tab-pane active px-3">
                <p class="text-muted"><?php the_content(); ?> </p>
            </div>
            <div id="additional-information" role="tabpanel" class="tab-pane">
                <p class="text-muted"><?php echo get_post_meta(get_the_ID(), 'product-additional-informations', true); ?></p>

            </div>
            <div id="reviews" role="tabpanel" class="tab-pane">
                <div class="row mb-5">
                    <div class="col-lg-10 col-xl-9">
                        <?php if ($reviews->have_posts()): ?>
                            <?php
                            while ($reviews->have_posts()): $reviews->the_post();
                                $comments_count = get_comments_number(get_the_ID())
                                ?>
                                <div class="media review">
                                    <div class="text-center mr-4 mr-xl-5"><img src="<?php echo wp_make_link_relative(get_template_directory_uri()) ?>/assets/img/photo/kyle-loftus-589739-unsplash-avatar.jpg" alt="Han Solo" class="review-image"><span class="text-uppercase text-muted"><?php _e("Ago_fr", "mangeonsafrodomain"); ?> <?php echo "" . human_time_diff(get_the_time('U'), current_time('timestamp')); ?> <?php _e("ago", "mangeonsafrodomain"); ?></span></div>
                                    <div class="media-body">
                                        <h5 class="mt-2 mb-1"><?php echo get_post_meta(get_the_ID(), "review-user-name", true); ?></h5>
                                        <div class="mb-2">
                                            <?php
                                            $mark = get_post_meta(get_the_ID(), "review-user-mark", true);
                                            $rest_mark = 5 - $mark;
                                            ?>
                                            <?php for ($k = 0; $k < $mark; $k++): ?>
                                                <i class="fa fa-xs fa-star text-warning"></i>
                                            <?php endfor; ?>
                                            <?php if ($rest_mark > 0) : ?>
                                                <?php for ($l = 0; $l < $rest_mark; $l++): ?>
                                                    <i class="fa fa-xs fa-star text-gray-300"></i>
                                                <?php endfor; ?>
                                            <?php endif; ?>
                                        </div>
                                        <p class="text-muted"><?php echo get_post_field("post_content", get_the_ID()) ?></p>
                                    </div>
                                </div>
                                <?php
                            endwhile;
                            wp_reset_postdata();
                            ?>
                        <?php endif ?>

                        <div class="py-5 px-3">
                            <h5 class="text-uppercase mb-4"><?php _e("Laissez votre avis", "mangeonsafrodomain"); ?></h5>
                            <form id="review-form" method="POST" action="<?php echo wp_make_link_relative(get_permalink()) ?>" class="form" autocomplete="off">
                                <input type="hidden" name="post-id" id="username"  required="required" class="form-control" value="<?php echo get_the_ID(); ?>">
                                <input type="hidden" name="send-review" id="username"  required="required" class="form-control" value="yes">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="username" class="form-label"><?php _e("Your name", "mangeonsafrodomain"); ?> <em style="color: red; font-weight: bold;">*</em></label>
                                            <input type="text" name="username" id="username" placeholder="<?php _e("Enter your name", "mangeonsafrodomain"); ?>" required="true" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="review-mark" class="form-label"><?php _e("Your mark", "mangeonsafrodomain"); ?> <em style="color: red; font-weight: bold;">*</em></label>
                                            <select name="review-mark" id="review-mark" class="custom-select focus-shadow-0" required="true">
                                                <option value="5">&#9733;&#9733;&#9733;&#9733;&#9733; (5/5)</option>
                                                <option value="4">&#9733;&#9733;&#9733;&#9733;&#9734; (4/5)</option>
                                                <option value="3">&#9733;&#9733;&#9733;&#9734;&#9734; (3/5)</option>
                                                <option value="2">&#9733;&#9733;&#9734;&#9734;&#9734; (2/5)</option>
                                                <option value="1">&#9733;&#9734;&#9734;&#9734;&#9734; (1/5)</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="form-label"><?php _e("Your email", "mangeonsafrodomain"); ?> <em style="color: red; font-weight: bold;">*</em></label>
                                    <input type="email" name="email" id="email" placeholder="<?php _e("Enter your email", "mangeonsafrodomain"); ?>" required="true" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="review-comment" class="form-label"><?php _e("Your review comment", "mangeonsafrodomain"); ?> <em style="color: red; font-weight: bold;">*</em></label>
                                    <textarea rows="4" name="review-comment" id="review-comment" placeholder="<?php _e("Enter your review comment", "mangeonsafrodomain"); ?>" required="true" class="form-control"></textarea>
                                </div>
                                <button type="submit" class="btn btn-outline-dark"><?php _e("Submit your review", "mangeonsafrodomain"); ?></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
$products_in_same_catgories = new WP_Query(array('post_type' => 'products_cpt', 'posts_per_page' => 6, "post_status" => 'publish', 'category__in' => $product_categories, 'post__not_in' => array(get_the_ID()), 'orderby' => 'post_date', 'order' => 'DESC'));

if ($products_in_same_catgories->have_posts()) {
    ?>
    <section class="my-5">
        <div class="container">
            <header class="text-center">
                <h6 class="text-uppercase mb-5">Produits pouvant vous intéresser</h6>
            </header>
            <div class="row">
                <?php
                while ($products_in_same_catgories->have_posts()): $products_in_same_catgories->the_post();
                    $product_thumbnail_image_id = get_post_meta(get_the_ID(), 'product-thubmnail-image-id', true);
                    $post_author = get_post_field('post_author', get_the_ID());
                    ?>
                    <!-- product-->
                    <div class="col-lg-2 col-md-4 col-6">
                        <div class="product">
                            <div class="product-image">
                                <img src="<?php if ($product_thumbnail_image_id): ?> <?php echo wp_make_link_relative(wp_get_attachment_url($product_thumbnail_image_id)); ?> <?php else: ?> <?php echo wp_make_link_relative(get_template_directory_uri()); ?>/assets/img/product.png <?php endif ?>" alt="product" class="img-fluid"/>
                                <div class="product-hover-overlay"><a href="<?php echo wp_make_link_relative(get_permalink()); ?>" class="product-hover-overlay-link"></a>
                                    <div class="product-hover-overlay-buttons"><a href="<?php echo wp_make_link_relative(get_permalink()); ?>" class="btn btn-dark btn-buy"><i class="fa-search fa"></i><span class="btn-buy-label ml-2"><?php _e("View", "mangeonsafrodomain"); ?> </span></a>
                                    </div>
                                </div>
                            </div>
                            <div class="py-2">
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
                                    <p class="text-muted text-sm mb-1">
                                        <a class="text-muted text-sm" href="<?php echo wp_make_link_relative(esc_url(get_category_link($product_category->term_id))) ?>">
                                            <?php
                                            echo $product_category->name;
                                            ?>
                                        </a> 
                                    </p>
                                <?php endif ?>
                                <?php if ($product_sub_category): ?>
                                    <p class="text-muted text-sm mb-1">
                                        <a class="text-muted text-sm" href="<?php echo wp_make_link_relative(esc_url(get_category_link($product_sub_category->term_id))) ?>">
                                            <?php
                                            echo $product_sub_category->name;
                                            ?>
                                        </a>
                                    </p>
                                <?php endif ?>

                                <h3 class="h6 text-uppercase mb-1"><a href="<?php echo wp_make_link_relative(get_permalink()); ?>" class="text-dark"><?php the_title(); ?></a></h3>
                                <span class="text-muted">
                                    <?php
                                    $my_prod_currency = get_post(get_post_meta(get_the_ID(), "product-currency-id", true));
                                    if (get_post_meta($my_prod_currency->ID, "currency-print-left-side", true)) {
                                        echo get_post_meta($my_prod_currency->ID, "currency-symbol", true);
                                    }
                                    ?><?php echo number_format(get_post_meta(get_the_ID(), "product-price", true), 2, '.', ''); ?><?php
                                    if (get_post_meta($my_prod_currency->ID, "currency-print-right-side", true)) {
                                        echo get_post_meta($my_prod_currency->ID, "currency-symbol", true);
                                    }
                                    ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <!-- /product-->
                    <?php
                endwhile;
                ?>
            </div>
        </div>
    </section>
    <?php
}
wp_reset_postdata();
?>
        