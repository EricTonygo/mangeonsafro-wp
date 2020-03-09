<!-- product-->
<div class="col-xl-4 col-sm-6">
    <div class="product">
        <div class="product-image">
            <img src="<?php if ($product_thumbnail_image_id): ?> <?php echo wp_make_link_relative(wp_get_attachment_url($product_thumbnail_image_id)); ?> <?php else: ?> <?php echo wp_make_link_relative(get_template_directory_uri()); ?>/assets/img/product.png <?php endif ?>" alt="product" class="img-fluid"/>
            <div class="product-hover-overlay"><a href="<?php echo wp_make_link_relative(get_permalink()); ?>" class="product-hover-overlay-link"></a>
                <div class="product-hover-overlay-buttons"><a href="#" class="btn btn-outline-dark btn-product-left"><i class="fa fa-shopping-cart"></i></a><a href="<?php echo wp_make_link_relative(get_permalink()); ?>" class="btn btn-dark btn-buy"><i class="fa-search fa"></i><span class="btn-buy-label ml-2"><?php _e("View", "mangeonsafrodomain"); ?></span></a><a href="#" data-toggle="modal" data-target="#exampleModal" class="btn btn-outline-dark btn-product-right"><i class="fa fa-expand-arrows-alt"></i></a>
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