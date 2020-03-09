<!-- content of Register -->
<!-- Hero Section-->
<section class="hero">
    <div class="container">
        <!-- Breadcrumbs -->
        <ol class="breadcrumb justify-content-center">
            <li class="breadcrumb-item"><a href="<?php echo wp_make_link_relative(home_url('/')) ?>"><?php _e("Home", "mangeonsafrodomain"); ?></a></li>
            <li class="breadcrumb-item active"><?php _e("Customer zone", "mangeonsafrodomain"); ?></li>
        </ol>
        <!-- Hero Content-->
        <div class="hero-content pb-5 text-center">
            <h1 class="hero-heading mb-0"><?php _e("Customer zone", "mangeonsafrodomain"); ?></h1>
        </div>
    </div>
</section>
<!-- customer login-->
<section>
    <div class="container">

        <div id="login-block" class="row justify-content-center">           
            <div class="col-lg-6">
                <div class="block">
                    <div class="block-header">
                        <h6 class="text-uppercase mb-0"><?php _e("Login", "mangeonsafrodomain"); ?></h6>
                    </div>
                    <div class="block-body">
                        <?php include(locate_template("statics-pages/content-success-or-faillure-message.php")); ?>
                        <p class="lead"><?php _e("Already customer", "mangeonsafrodomain"); ?>?</p>
                        <p class="text-muted"><?php _e("Sign into your account", "mangeonsafrodomain"); ?>.</p>
                        <hr>
                        <form method="POST" action="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__("login", "mangeonsafrodomain"))->ID)); ?>" autocomplete="off">
                            <div class="form-group">
                                <label for="username-login" class="form-label"><?php _e("E-mail", "mangeonsafrodomain"); ?></label>
                                <input id="username-login" type="text" name="username" placeholder="<?php _e("E-mail", "mangeonsafrodomain"); ?>" value="<?php echo $login; ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password-login" class="form-label"><?php _e("Password", "mangeonsafrodomain"); ?></label>
                                <input id="password-login" type="password" name="password" class="form-control" placeholder="<?php _e("Password", "mangeonsafrodomain"); ?>">
                            </div>
                            
                            <div class="form-group">
                                <div id="recaptcha_login"></div> 
                            </div>
                            
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-outline-dark"><i class="fa fa-sign-in-alt mr-2"></i> <?php _e("Sign in", "mangeonsafrodomain"); ?></button>
                            </div>
                        </form>
                        <p class="text-muted"><?php _e("Forgot your password", "mangeonsafrodomain"); ?> ? <a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__("forgot-password", "mangeonsafrodomain"))->ID)); ?>"><?php _e("Change it here", "mangeonsafrodomain"); ?>.</a></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="block">
                    <div class="block-header">
                        <h6 class="text-uppercase mb-0"><?php _e("New account", "mangeonsafrodomain"); ?></h6>
                    </div>
                    <div class="block-body">
                        <?php include(locate_template("statics-pages/content-registration-success-or-faillure-message.php")); ?>
                        <p class="lead"><?php _e("Not registered", "mangeonsafrodomain"); ?>?</p>
                        <p class="text-muted"><?php _e("A few minutes are enough", "mangeonsafrodomain"); ?>.</p>
                        <p class="text-muted"><?php _e("Problem", "mangeonsafrodomain"); ?>? <?php _e("Question", "mangeonsafrodomain"); ?>?, <a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__("contact-us", "mangeonsafrodomain"))->ID)); ?>"><?php _e("Customer service listens", "mangeonsafrodomain"); ?>.</a></p>
                        <hr>
                        <div id="show-sign-up-form-btn" class="btn btn-outline-dark"><i class="far fa-user mr-2"></i><?php _e("Sign up", "mangeonsafrodomain") ?></div>
                        
                    </div>
                </div>
            </div>
        </div>
        
        <div id="register-block" class="row justify-content-center" style="display: none;">           
            <div class="col-lg-4">
                <div class="block">
                    <div class="block-header">
                        <h6 class="text-uppercase mb-0"><?php _e("Login", "mangeonsafrodomain"); ?></h6>
                    </div>
                    <div class="block-body">
                        <?php include(locate_template("statics-pages/content-success-or-faillure-message.php")); ?>
                        <p class="lead"><?php _e("Already customer", "mangeonsafrodomain"); ?>?</p>
                        <p class="text-muted"><?php _e("Sign into your account", "mangeonsafrodomain"); ?>.</p>
                        <hr>
                        <div id="show-sign-in-form-btn" class="btn btn-outline-dark"><i class="fa fa-sign-in-alt mr-2"></i> <?php _e("Sign in", "mangeonsafrodomain"); ?></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="block">
                    <div class="block-header">
                        <h6 class="text-uppercase mb-0"><?php _e("New account", "mangeonsafrodomain"); ?></h6>
                    </div>
                    <div class="block-body">
                        <?php include(locate_template("statics-pages/content-registration-success-or-faillure-message.php")); ?>
                        <p class="lead"><?php _e("Not registered", "mangeonsafrodomain"); ?>?</p>
                        <p class="text-muted"><?php _e("A few minutes are enough", "mangeonsafrodomain"); ?>.</p>
                        <p class="text-muted"><?php _e("Problem", "mangeonsafrodomain"); ?>? <?php _e("Question", "mangeonsafrodomain"); ?>?, <a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__("contact-us", "mangeonsafrodomain"))->ID)); ?>"><?php _e("Customer service listens", "mangeonsafrodomain"); ?>.</a></p>
                        <hr>
                        <form action="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__("register", "mangeonsafrodomain"))->ID)); ?>" method="POST">

                            <div class="form-group detail-option">
                                <!--<div class="col-sm-6 col-lg-12 detail-option mb-3">-->
                                <!--<label class="form-label"><?php _e("Account Type", "mangeonsafrodomain") ?></label>-->
                                <label id="account_type_0_label" for="account_type_0" class="btn btn-sm btn-outline-secondary detail-option-btn-label">
                                    <?php _e("Particular", "mangeonsafrodomain"); ?>
                                    <input id="account_type_0" type="radio" name="role" value="particular" class="input-invisible">
                                </label>
                                <label id="account_type_1_label" for="account_type_1" class="btn btn-sm btn-outline-secondary detail-option-btn-label">
                                    <?php _e("Professional", "mangeonsafrodomain"); ?>
                                    <input id="account_type_1" type="radio" name="role" value="professional" class="input-invisible">
                                </label>
                                <!--</div>-->
                            </div>
                            
                            <div class="form-group">
                                <label for="username" class="form-label"><?php _e("Username", "mangeonsafrodomain") ?></label>
                                <input id="username" type="text" class="form-control" name="username" placeholder="<?php _e("Username", "mangeonsafrodomain"); ?>" value="<?php echo $user_login; ?>">
                            </div>
                            <div class="form-group">
                                <label for="email" class="form-label"><?php _e("E-mail", "mangeonsafrodomain") ?></label>
                                <input id="email" type="text" class="form-control" name="email" placeholder="<?php _e("E-mail", "mangeonsafrodomain") ?>" value="<?php echo $user_email ?>">
                            </div>
                            <div class="form-group">
                                <label for="password" class="form-label"><?php _e("Password", "mangeonsafrodomain") ?></label>
                                <input id="password" type="password" class="form-control" name="password" placeholder="<?php _e("Password", "mangeonsafrodomain") ?>">
                            </div>
                            <div class="form-group">
                                <div id="recaptcha_register"></div> 
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-outline-dark"><i class="far fa-user mr-2"></i><?php _e("Sign up", "mangeonsafrodomain") ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>