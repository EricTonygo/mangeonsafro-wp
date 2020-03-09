<!-- content of Register -->
<!-- Hero Section-->
<section class="hero">
    <div class="container">
        <!-- Breadcrumbs -->
        <ol class="breadcrumb justify-content-center">
            <li class="breadcrumb-item"><a href="<?php echo wp_make_link_relative(home_url('/')) ?>"><?php _e("Home", "mangeonsafrodomain"); ?></a></li>
            <li class="breadcrumb-item active"><?php _e("Forgot your password", "mangeonsafrodomain"); ?></li>
        </ol>
        <!-- Hero Content-->
        <div class="hero-content pb-5 text-center">
            <h1 class="hero-heading mb-0" style="font-size: 3.05rem"><?php _e("Forgot your password", "mangeonsafrodomain"); ?></h1>
        </div>
    </div>
</section>
<!-- customer login-->
<section>
    <div class="container">

        <div class="row">
            <div class="col-lg-8 col-xl-12">
                <div class="block mb-5">
                    <div class="block-header"><strong class="text-uppercase"><?php _e("Enter your e-mail", "mangeonsafrodomain"); ?></strong></div>
                    <div class="block-body">
                        <?php include(locate_template("statics-pages/content-success-or-faillure-message.php")); ?>
                        <form method="POST" action="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__("forgot-password", "mangeonsafrodomain"))->ID)); ?>" autocomplete="off">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="email" class="form-label"><?php _e("E-mail", "mangeonsafrodomain"); ?></label>
                                        <input id="email" type="text" name="email" placeholder="<?php _e("E-mail", "mangeonsafrodomain"); ?>" value="<?php echo $login; ?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div id="recaptcha_forgot_password"></div> 
                                    </div>
                                </div>
                            </div>

                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-outline-dark"><i class="far fa-save mr-2"></i><?php _e("Send reset link", "mangeonsafrodomain"); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>