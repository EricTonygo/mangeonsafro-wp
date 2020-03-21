<!-- Hero Section-->
<section class="hero">
    <div class="container">
        <!-- Breadcrumbs -->
        <ol class="breadcrumb justify-content-center">
            <li class="breadcrumb-item"><a href="<?php echo wp_make_link_relative(home_url('/')); ?>"><?php _e("Home", "mangeonsafrodomain"); ?></a></li>
            <li class="breadcrumb-item active"><?php _e("Your profile", "mangeonsafrodomain"); ?></li>
        </ol>
        <!-- Hero Content-->
        <div class="hero-content text-center">
            <div style="text-align: left;">
            <?php include(locate_template("statics-pages/content-success-or-faillure-message.php")); ?>
            </div>
            <h1 class="hero-heading"><?php _e("Your profile", "mangeonsafrodomain"); ?></h1>
            
        </div>
    </div>
</section>
<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-xl-9">
                <?php //include(locate_template("statics-pages/content-success-or-faillure-message.php")); ?>
                <div class="block mb-5">
                    <div class="block-header"><strong class="text-uppercase"><?php _e("Reset your password", "mangeonsafrodomain"); ?></strong></div>
                    <div class="block-body">

                        <form method="POST" action="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__("reset-password", "mangeonsafrodomain"))->ID)); ?>" autocomplete="off">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="password_old" class="form-label"><?php _e("Current Password", "mangeonsafrodomain"); ?> <em style="color: red; font-weight: bold;">*</em></label>
                                        <input id="password_old" type="password" name="current_password" class="form-control" placeholder="<?php _e("Current Password", "mangeonsafrodomain"); ?>" required="true">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="password_1" class="form-label"><?php _e("New Password", "mangeonsafrodomain"); ?> <em style="color: red; font-weight: bold;">*</em></label>
                                        <input id="password_1" type="password" name="new_password" class="form-control" placeholder="<?php _e("New Password", "mangeonsafrodomain"); ?>" required="true">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="password_2" class="form-label"><?php _e("Confirm New Password", "mangeonsafrodomain"); ?> <em style="color: red; font-weight: bold;">*</em></label>
                                        <input id="password_2" type="password" name="new_password_confirm" class="form-control" placeholder="<?php _e("Confirm New Password", "mangeonsafrodomain"); ?>" required="true">
                                    </div>
                                </div>
                            </div>
                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-outline-dark"><i class="far fa-save mr-2"></i><?php _e("Reset password", "mangeonsafrodomain"); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="block mb-5">
                    <div class="block-header"><strong class="text-uppercase"><?php _e("Personal informations", "mangeonsafrodomain"); ?></strong></div>
                    <div class="block-body">
                        <form method="POST" action="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('account', 'mangeonsafrodomain') . '/' . __("profile", "mangeonsafrodomain"))->ID)); ?>" autocomplete="off">
                            
                            <div class="form-group detail-option">
                                <label id="account_type_0_label" for="account_type_0" class="btn btn-sm btn-outline-secondary detail-option-btn-label <?php if (in_array("particular", $roles)): ?>active<?php endif; ?>">
                                    <?php _e("Particular", "mangeonsafrodomain"); ?>
                                    <input id="account_type_0" type="radio" name="role" value="particular" class="input-invisible" <?php if (in_array("particular", $roles)): ?>checked<?php endif; ?>>
                                </label>
                                <label id="account_type_1_label" for="account_type_1" class="btn btn-sm btn-outline-secondary detail-option-btn-label <?php if (in_array("professional", $roles)): ?>active<?php endif; ?>">
                                    <?php _e("Professional", "mangeonsafrodomain"); ?>
                                    <input id="account_type_1" type="radio" name="role" value="professional" class="input-invisible" <?php if (in_array("professional", $roles)): ?>checked<?php endif; ?>>
                                </label>
                            </div>
                            
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="firstname" class="form-label"><?php _e("First name", "mangeonsafrodomain"); ?></label>
                                        <input id="firstname" type="text" name="firstname" class="form-control" placeholder="<?php _e("First name", "mangeonsafrodomain"); ?>" value="<?php echo $first_name; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="lastname" class="form-label"><?php _e("Last name", "mangeonsafrodomain"); ?></label>
                                        <input id="lastname" type="text" name="lastname" class="form-control" placeholder="<?php _e("Last name", "mangeonsafrodomain"); ?>" value="<?php echo $last_name; ?>">
                                    </div>
                                </div>
                            </div>
                            <!-- /.row-->
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="displayname" class="form-label"><?php _e("Display name", "mangeonsafrodomain"); ?> </label>
                                        <input id="displayname" type="text" name="displayname" class="form-control" placeholder="<?php _e("Display name", "mangeonsafrodomain"); ?>" value="<?php echo $display_name; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="email" class="form-label"><?php _e("E-mail", "mangeonsafrodomain"); ?> <em style="color: red; font-weight: bold;">*</em></label>
                                        <input id="email" type="text" name="email" class="form-control" placeholder="<?php _e("E-mail", "mangeonsafrodomain"); ?>" value="<?php echo $user_email; ?>" required="true">
                                    </div>
                                </div>
                            </div>
                            <!-- /.row-->
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="phone" class="form-label"><?php _e("Phone number", "mangeonsafrodomain"); ?></label>
                                        <input id="phone" type="text" name="phone-number" class="form-control" placeholder="<?php _e("Phone number", "mangeonsafrodomain"); ?>" value="<?php echo $user_phone_number; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="localisation" class="form-label"><?php _e("Single Address", "mangeonsafrodomain"); ?></label>
                                        <input id="localisation" type="text" name="localisation" class="form-control" placeholder="<?php _e("Localisation", "mangeonsafrodomain"); ?>" value="<?php echo $user_localisation; ?>">
                                    </div>
                                </div>
                            </div>
                            <!-- /.row-->
                            <div class="row">
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <label for="city" class="form-label"><?php _e("City", "mangeonsafrodomain"); ?></label>
                                        <input id="city" type="text" name="city" class="form-control" placeholder="<?php _e("City", "mangeonsafrodomain"); ?>" value="<?php echo $user_city; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <label for="zip" class="form-label"><?php _e("Postal code", "mangeonsafrodomain"); ?></label>
                                        <input id="zip" type="text" name="zip" class="form-control" placeholder="<?php _e("Postal code", "mangeonsafrodomain"); ?>" value="<?php echo $user_zip; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <label for="country" class="form-label"><?php _e("Country", "mangeonsafrodomain"); ?></label>                                        
                                        <select id="country" name="country-code" class="form-control">
                                            <?php include(locate_template('statics-pages/content-select-country.php')); ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- /.row-->
                            <?php if ($roles && !in_array("particular", $roles)): ?>
<!--                            <div class="row">
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <label for="proname" class="form-label"><?php _e("Pro name", "mangeonsafrodomain"); ?></label>
                                        <input id="proname" type="text" name="pro-name" class="form-control" placeholder="<?php _e("Professional name", "mangeonsafrodomain"); ?>" value="<?php echo $user_pro_name; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <label for="proemail" class="form-label"><?php _e("Pro email", "mangeonsafrodomain"); ?></label>
                                        <input id="proemail" type="text" name="pro-email" class="form-control" placeholder="<?php _e("Professional email", "mangeonsafrodomain"); ?>" value="<?php echo $user_pro_email; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group">
                                        <label for="prophonenumber" class="form-label"><?php _e("Pro phone number", "mangeonsafrodomain"); ?></label>
                                        <input id="prophonenumber" type="text" name="pro-phone-number" class="form-control" placeholder="<?php _e("Professional phone number", "mangeonsafrodomain"); ?>" value="<?php echo $user_pro_phone_number; ?>">
                                    </div>
                                </div>
                            </div>-->
                            <?php endif ?>
                            <!-- /.row-->
                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-outline-dark"><i class="far fa-save mr-2"></i><?php _e("Save modifications", "mangeonsafrodomain"); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Customer Sidebar-->
            <div class="col-xl-3 col-lg-4 mb-5">
                <div class="customer-sidebar card border-0"> 
                    <div class="customer-profile"><a href="#" class="d-inline-block"><img src="<?php echo wp_make_link_relative(get_template_directory_uri()) ?>/assets/img/photo/kyle-loftus-589739-unsplash-avatar.jpg" class="img-fluid rounded-circle customer-image"></a>
                        <h5><?php echo $current_user->display_name; ?></h5>
                        <p class="text-muted text-sm mb-0"><?php echo $current_user->user_email; ?></p>
                    </div>
                    <nav class="list-group customer-nav"><a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('account', 'mangeonsafrodomain') . "/" . __('orders', 'mangeonsafrodomain'))->ID)) ?>" class="list-group-item d-flex justify-content-between align-items-center"><span>
                                <svg class="svg-icon svg-icon-heavy mr-2">
                                <use xlink:href="#paper-bag-1"> </use>
                                </svg><?php _e("Orders", "mangeonsafrodomain"); ?></span>
                            <div class="badge badge-pill badge-dark font-weight-normal px-3">0</div></a><a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('account', 'mangeonsafrodomain') . "/" . __('profile', 'mangeonsafrodomain'))->ID)) ?>" class="active list-group-item d-flex justify-content-between align-items-center"><span>
                                <svg class="svg-icon svg-icon-heavy mr-2">
                                <use xlink:href="#male-user-1"> </use>
                                </svg><?php _e("Profile", "mangeonsafrodomain"); ?></span></a><a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('account', 'mangeonsafrodomain') . "/" . __('multiple-address', 'mangeonsafrodomain'))->ID)) ?>" class="list-group-item d-flex justify-content-between align-items-center"><span>
                                <svg class="svg-icon svg-icon-heavy mr-2">
                                <use xlink:href="#navigation-map-1"> </use>
                                </svg><?php _e("Address", "mangeonsafrodomain"); ?></span></a><?php if ($roles && !in_array("particular", $roles)): ?><a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('account', 'mangeonsafrodomain') . "/" . __('seller-zone', 'mangeonsafrodomain'))->ID)) ?>" class="list-group-item d-flex justify-content-between align-items-center"><span>
                                <svg class="svg-icon svg-icon-heavy mr-2">
                                <use xlink:href="#pay-1"></use>
                                </svg><?php _e("Seller zone", "mangeonsafrodomain"); ?></span></a><?php endif ?><a href="<?php echo esc_url(add_query_arg(array('logout' => 'true'), wp_make_link_relative(home_url('/')))) ?>" class="list-group-item d-flex justify-content-between align-items-center"><span>
                                <svg class="svg-icon svg-icon-heavy mr-2">
                                <use xlink:href="#exit-1"> </use>
                                </svg><?php _e("Sign out", "mangeonsafrodomain"); ?></span></a>
                    </nav>
                </div>
            </div>
            <!-- /Customer Sidebar-->
        </div>
    </div>
</section>