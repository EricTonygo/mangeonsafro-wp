<!-- content of Register -->
<!-- Hero Section-->
<section class="hero">
    <div class="container">
        <!-- Breadcrumbs -->
        <ol class="breadcrumb justify-content-center">
            <li class="breadcrumb-item"><a href="<?php echo wp_make_link_relative(home_url('/')) ?>"><?php _e("Home", "mangeonsafrodomain"); ?></a></li>
            <li class="breadcrumb-item active"><?php _e("Reset your password", "mangeonsafrodomain"); ?></li>
        </ol>
        <!-- Hero Content-->
        <div class="hero-content pb-5 text-center">
            <h1 class="hero-heading mb-0" style="font-size: 3.05rem"><?php _e("Reset your password", "mangeonsafrodomain"); ?></h1>
        </div>
    </div>
</section>
<!-- customer login-->
<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-xl-12">
                <div class="block mb-5">
                    <div class="block-header"><strong class="text-uppercase"><?php _e("Reset your password", "mangeonsafrodomain"); ?></strong></div>
                    <div class="block-body">
                        <?php include(locate_template("statics-pages/content-success-or-faillure-message.php")); ?>
                        <form method="POST" action="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__("reset-password", "mangeonsafrodomain"))->ID)); ?>" autocomplete="off">
                            <input type="hidden" name="username" value="<?php echo $user_login; ?>">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="password_1" class="form-label"><?php _e("New Password", "mangeonsafrodomain"); ?></label>
                                        <input id="password_1" type="password" name="new-password" class="form-control" placeholder="<?php _e("New Password", "mangeonsafrodomain"); ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="password_2" class="form-label"><?php _e("Confirm New Password", "mangeonsafrodomain"); ?></label>
                                        <input id="password_2" type="password" name="new-password-confirm" class="form-control" placeholder="<?php _e("Confirm New Password", "mangeonsafrodomain"); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-outline-dark"><i class="far fa-save mr-2"></i><?php _e("Reset password", "mangeonsafrodomain"); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>