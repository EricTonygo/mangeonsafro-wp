<!-- Hero Section-->
<section class="hero">
    <div class="container">
        <!-- Breadcrumbs -->
        <ol class="breadcrumb justify-content-center">
            <li class="breadcrumb-item"><a href="<?php echo wp_make_link_relative(home_url('/')); ?>"><?php _e("Home", "mangeonsafrodomain"); ?></a></li>
            <li class="breadcrumb-item"><a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('account', 'mangeonsafrodomain') . "/" . __('profile', 'mangeonsafrodomain'))->ID)) ?>"><?php echo get_page_by_path(__('account', 'mangeonsafrodomain') . "/" . __('profile', 'mangeonsafrodomain'))->post_title; ?></a></li>
            <li class="breadcrumb-item"><a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('account', 'mangeonsafrodomain') . "/" . __('seller-zone', 'mangeonsafrodomain'))->ID)) ?>"><?php echo get_page_by_path(__('account', 'mangeonsafrodomain') . "/" . __('seller-zone', 'mangeonsafrodomain'))->post_title; ?></a></li>
            <li class="breadcrumb-item"><a href="<?php echo esc_url(add_query_arg(array('shop-id' => get_the_ID()), wp_make_link_relative(get_permalink(get_page_by_path(__('account', 'mangeonsafrodomain') . "/" . __('seller-zone', 'mangeonsafrodomain') . "/" . __('products', 'mangeonsafrodomain'))->ID)))) ?>"><?php _e("Product of ", "mangeonsafrodomain"); ?> <?php the_title(); ?></a></li>
            <li class="breadcrumb-item active"><?php _e("Add new product", "mangeonsafrodomain"); ?></li>
        </ol>
        <!-- Hero Content-->
        <div class="hero-content text-center">
            <h3 class="hero-heading"><?php _e("Add new product in", "mangeonsafrodomain"); ?> <?php the_title(); ?></h3>
        </div>
    </div>
</section>
<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-xl-9">
                <div class="block mb-5">
                    <div class="block-header"><strong class="text-uppercase"><?php _e("New product", "mangeonsafrodomain"); ?></strong></div>
                    <div class="block-body">
                        <?php include(locate_template("statics-pages/content-success-or-faillure-message.php")); ?>
                        <form method="POST" action="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('account', 'mangeonsafrodomain') . '/' . __("seller-zone", "mangeonsafrodomain") . '/' . __("product", "mangeonsafrodomain") . '/' . __("new-product", "mangeonsafrodomain"))->ID)); ?>" enctype="multipart/form-data" autocomplete="off">

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="product-name" class="form-label"><?php _e("Product name", "mangeonsafrodomain"); ?><em style="color: red; font-weight: bold;">*</em></label>
                                        <input id="product-name" type="text" name="product-name" class="form-control" placeholder="<?php _e("Product name", "mangeonsafrodomain"); ?>" value="<?php echo $prod_name; ?>" required="true">
                                    </div>
                                </div>
                            </div>
                            <!-- /.row-->
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="product-price" class="form-label"><?php _e("Product price", "mangeonsafrodomain"); ?><em style="color: red; font-weight: bold;">*</em></label>
                                        <input id="product-price" type="text" name="product-price" class="form-control" placeholder="<?php _e("Product price", "mangeonsafrodomain"); ?>" value="<?php echo $prod_price; ?>" required="true">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="product-delete-price" class="form-label"><?php _e("Product delete price", "mangeonsafrodomain"); ?></label>
                                        <input id="product-delete-price" type="text" name="product-delete-price" class="form-control" placeholder="<?php _e("Product delete price", "mangeonsafrodomain"); ?>" value="<?php echo $prod_delete_price; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="product-currency-id" class="form-label"><?php _e("Currency", "mangeonsafrodomain"); ?></label>                                        
                                        <select id="product-currency-id" name="product-currency-id" class="form-control">
                                            <option value=""><?php _e("Select a currency", "mangeonsafrodomain"); ?></option>
                                            <?php
                                            $currencies = new WP_Query(array('post_type' => 'currencies_cpt', "post_status" => array('publish'), 'orderby' => 'post_date', 'order' => 'DESC'));
                                            if ($currencies->have_posts()) :
                                                ?>
                                                <?php
                                                while ($currencies->have_posts()): $currencies->the_post();
                                                    ?>
                                                    <option value="<?php the_ID(); ?>" <?php if (get_the_ID() == $prod_currency_id): ?> selected="selected" <?php endif ?>><?php the_title() ?></option>
                                                    <?php
                                                endwhile;
                                                ?>
                                                <?php
                                            endif;
                                            wp_reset_postdata();
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- /.row-->
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="product-category" class="form-label"><?php _e("Category", "mangeonsafrodomain"); ?><em style="color: red; font-weight: bold;">*</em></label>                                        
                                        <select id="product-category" name="product-category" class="form-control" required="true">
                                            <option value=""><?php _e("Select a category", "mangeonsafrodomain"); ?></option>
                                            <?php
                                            $shop_category_term_id = 0;
                                            if($shop_category){
                                                $shop_category_term_id = $shop_category->term_id;
                                            }
                                            $product_categories = get_categories(array('hide_empty' => false, 'orderby' => 'name', 'order' => 'ASC', 'parent' => $shop_category_term_id));
                                            foreach ($product_categories as $product_category):
                                                ?>
                                                <option value="<?php echo $product_category->slug; ?>" <?php if (is_array($post_category) && in_array($product_category->term_id, $post_category, true)): ?> selected="selected" <?php endif ?>><?php echo __($product_category->name, "mangeonsafrodomain"); ?></option>
                                            <?php endforeach ?>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="product-sub-category" class="form-label"><?php _e("Sub category", "mangeonsafrodomain"); ?></label>                                        
                                        <select id="product-sub-category" name="product-sub-category" class="form-control">
                                            <option value=""><?php _e("Select a sub category", "mangeonsafrodomain"); ?></option>
                                            <?php
                                            $product_parent_categories = get_categories(array('hide_empty' => false, 'orderby' => 'name', 'order' => 'ASC', 'parent' => $shop_category_term_id));
                                            foreach ($product_parent_categories as $product_parent_category):
                                                ?>
                                                <optgroup label="<?php echo $product_parent_category->name; ?>">
                                                    <?php
                                                    $product_sub_categories = get_categories(array('hide_empty' => false, 'orderby' => 'slug', 'order' => 'ASC', 'parent' => $product_parent_category->term_id));
                                                    foreach ($product_sub_categories as $product_sub_category):
                                                        ?>
                                                        <option value="<?php echo $product_sub_category->slug; ?>" <?php if (is_array($post_category) && (in_array($product_sub_category->slug, $post_category, true) || in_array($product_sub_category->term_id, $post_category, true))): ?> selected="selected" <?php endif ?>><?php echo $product_sub_category->name; ?></option>
                                                    <?php endforeach ?>
                                                </optgroup>
                                            <?php endforeach ?>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- /.row-->
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="product-city" class="form-label"><?php _e("Product city", "mangeonsafrodomain"); ?><em style="color: red; font-weight: bold;">*</em></label>
                                        <input id="product-city" type="text" name="product-city" class="form-control" placeholder="<?php _e("Product city", "mangeonsafrodomain"); ?>" value="<?php echo $prod_gplace_city; ?>" required="true">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    
                                </div>
                            </div>
                            <!-- /.row-->
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="product-thumbnail-image" class="form-label"><?php _e("Featured Image", "mangeonsafrodomain"); ?></label>
                                        <input id="product-thumbnail-image" type="file" class="form-control-file"  name="product-thumbnail-image">
                                    </div>
                                </div>
                            </div>
                            <!-- /.row-->
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="product-brief-description" class="form-label"><?php _e("Product brief description", "mangeonsafrodomain"); ?></label>
                                        <textarea id="product-brief-description" class="form-control" rows="5" name="product-brief-description" placeholder="<?php _e("Product brief description", "mangeonsafrodomain"); ?>" ><?php echo $prod_brief_description; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <!-- /.row-->
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="product-description" class="form-label"><?php _e("Product integral description", "mangeonsafrodomain"); ?></label>
                                        <textarea id="product-description" class="form-control" rows="5" name="product-description" placeholder="<?php _e("Product integral description", "mangeonsafrodomain"); ?>" ><?php echo $prod_description; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <!-- /.row-->
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="product-additional-informations" class="form-label"><?php _e("Product additional informations", "mangeonsafrodomain"); ?></label>
                                        <textarea id="product-additional-informations" class="form-control" rows="5" name="product-additional-informations" placeholder="<?php _e("Product additional informations", "mangeonsafrodomain"); ?>" ><?php echo $prod_additional_informations; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="shop-id" value="<?php echo $shop_id; ?>" />
                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-outline-dark"><i class="far fa-save mr-2"></i><?php _e("Save product", "mangeonsafrodomain"); ?></button>
                            </div>
                        </form>
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
                                </svg><?php _e("Shops", "mangeonsafrodomain"); ?></span></a>
                        <?php if (is_user_logged_in() && $shop_id): ?>
                            <a href="<?php echo esc_url(add_query_arg(array('shop-id' => $shop_id), wp_make_link_relative(get_permalink(get_page_by_path(__('account', 'mangeonsafrodomain') . "/" . __('seller-zone', 'mangeonsafrodomain') . "/" . __('products', 'mangeonsafrodomain'))->ID)))) ?>" class="active list-group-item d-flex justify-content-between align-items-center">
                        <?php else: ?>
                            <a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('account', 'mangeonsafrodomain') . "/" . __('seller-zone', 'mangeonsafrodomain') . "/" . __('products', 'mangeonsafrodomain'))->ID)) ?>" class="active list-group-item d-flex justify-content-between align-items-center">
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