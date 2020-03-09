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
                    <div class="block-body">
                         <?php include(locate_template("statics-pages/content-success-or-faillure-message.php")); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>