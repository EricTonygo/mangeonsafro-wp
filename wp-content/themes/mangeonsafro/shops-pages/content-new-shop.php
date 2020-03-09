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
            <h1 class="hero-heading"><?php the_title(); ?></h1>           
        </div>
    </div>
</section>
<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-xl-9">
                
                <div class="block mb-5">
                    <div class="block-header"><strong class="text-uppercase"><?php _e("New shop", "mangeonsafrodomain"); ?></strong></div>
                    <div class="block-body">
                        <?php include(locate_template("statics-pages/content-success-or-faillure-message.php")); ?>
                        <form method="POST" action="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('account', 'mangeonsafrodomain') . '/' . __("seller-zone", "mangeonsafrodomain") . '/' . __("shops", "mangeonsafrodomain") . '/' . __("new-shop", "mangeonsafrodomain"))->ID)); ?>" autocomplete="off">

                            <!-- /.row-->
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="shop-category" class="form-label"><?php _e("Shop type", "mangeonsafrodomain"); ?> <em style="color: red; font-weight: bold;">*</em></label>                                        
                                        <select id="shop-category" name="shop-category" class="form-control" required="true">
                                            <option value=""><?php _e("Select shop type", "mangeonsafrodomain"); ?></option>
                                            <?php
                                            $shop_categories = get_categories(array('hide_empty' => false, 'orderby' => 'name', 'order' => 'ASC', 'parent' => 0));
                                            foreach ($shop_categories as $shop_category):
                                                ?>
                                                <option value="<?php echo $shop_category->slug; ?>" <?php if (is_array($post_category) && in_array($shop_category->term_id, $post_category, true)): ?> selected="selected" <?php endif ?>><?php echo __($shop_category->name, "mangeonsafrodomain"); ?></option>
                                            <?php endforeach ?>                                    
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- /.row-->
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="shop-name" class="form-label"><?php _e("Name", "mangeonsafrodomain"); ?> <em style="color: red; font-weight: bold;">*</em></label>
                                        <input id="shop-name" type="text" name="shop-name" class="form-control" placeholder="<?php _e("Shop name", "mangeonsafrodomain"); ?>" value="<?php echo $shop_name; ?>" required="true">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="shop-currency-id" class="form-label"><?php _e("Shop's currency", "mangeonsafrodomain"); ?></label>                                        
                                        <select id="shop-currency-id" name="shop-currency-id" class="form-control">
                                            <option value=""><?php _e("Select a shop currency", "mangeonsafrodomain"); ?></option>
                                            <?php
                                            $currencies = new WP_Query(array('post_type' => 'currencies_cpt', "post_status" => array('publish'), 'orderby' => 'post_date', 'order' => 'DESC'));
                                            if ($currencies->have_posts()) :
                                                ?>
                                                <?php
                                                while ($currencies->have_posts()): $currencies->the_post();
                                                    ?>
                                                    <option value="<?php the_ID(); ?>" <?php if (get_the_ID() == $shop_currency_id): ?> selected="selected" <?php endif ?>><?php the_title() ?></option>
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
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="shop-street-number" class="form-label"><?php _e("Stree number", "mangeonsafrodomain"); ?></label>
                                        <input id="shop-street-number" type="text" name="shop-street-number" class="form-control" placeholder="<?php _e("Stree number", "mangeonsafrodomain"); ?>" value="<?php echo $shop_street_number; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label for="shop-street-name" class="form-label"><?php _e("Stree name", "mangeonsafrodomain"); ?></label>
                                        <input id="shop-address" type="text" name="shop-street-name" class="form-control" placeholder="<?php _e("Stree name", "mangeonsafrodomain"); ?>" value="<?php echo $shop_street_name; ?>">
                                    </div>
                                </div>                               
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="shop-zip" class="form-label"><?php _e("Postal code", "mangeonsafrodomain"); ?></label>
                                        <input id="shop-zip" type="text" name="shop-zip" class="form-control" placeholder="<?php _e("Postal code", "mangeonsafrodomain"); ?>" value="<?php echo $shop_zip; ?>">
                                    </div>
                                </div>
                            </div>
                            <!-- /.row-->
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="shop-supplement-address" class="form-label"><?php _e("Supplement address", "mangeonsafrodomain"); ?></label>
                                        <input id="shop-supplement-address" type="text" name="shop-supplement-address" class="form-control" placeholder="<?php _e("Supplement address", "mangeonsafrodomain"); ?>" value="<?php echo $shop_supplement_address; ?>">
                                    </div>
                                </div>                              
                            </div>
                            <!-- /.row-->
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="shop-city" class="form-label"><?php _e("City", "mangeonsafrodomain"); ?> <em style="color: red; font-weight: bold;">*</em></label>
                                        <input id="shop-city" type="text" name="shop-city" class="form-control" placeholder="<?php _e("Shop city", "mangeonsafrodomain"); ?>" value="<?php echo $shop_city; ?>" required="">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="shop-country" class="form-label"><?php _e("Country", "mangeonsafrodomain"); ?> <em style="color: red; font-weight: bold;">*</em></label>                                        
                                        <select id="shop-country" name="shop-country" class="form-control" required="">
                                            <?php include(locate_template('statics-pages/content-select-country.php')); ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- /.row-->
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="shop-description" class="form-label"><?php _e("Shop description", "mangeonsafrodomain"); ?></label>
                                        <textarea id="shop-description" class="form-control" rows="5" name="shop-description" placeholder="<?php _e("Shop description", "mangeonsafrodomain"); ?>" ><?php echo $shop_description; ?></textarea>
                                    </div>
                                </div>
                                
                            </div>
                            
                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-outline-dark"><i class="far fa-save mr-2"></i><?php _e("Save shop", "mangeonsafrodomain"); ?></button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <!-- Customer Sidebar-->
            <div class="col-xl-3 col-lg-4 mb-5">
                <div class="customer-sidebar card border-0"> 
                    <div class="customer-profile"><a href="#" class="d-inline-block"><img src="<?php echo wp_make_link_relative(get_template_directory_uri()) ?>/assets/img/photo/kyle-loftus-589739-unsplash-avatar.jpg" class="img-fluid rounded-circle customer-image"></a>
                        <h5> <?php if ($user_pro_name) echo $user_pro_name;
                                            else echo $current_user->display_name; ?></h5>
                        <p class="text-muted text-sm mb-0"><?php if ($user_pro_email) echo $user_pro_email;
                                            else echo $current_user->user_email; ?></p>
                    </div>
                    <nav class="list-group customer-nav"><a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('account', 'mangeonsafrodomain') . "/" . __('seller-zone', 'mangeonsafrodomain'). "/" . __('shops', 'mangeonsafrodomain'))->ID)) ?>" class="active list-group-item d-flex justify-content-between align-items-center"><span>
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