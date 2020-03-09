<!-- Hero Section-->
<section class="hero">
    <div class="container">
        <!-- Breadcrumbs -->
        <ol class="breadcrumb justify-content-center">
            <li class="breadcrumb-item"><a href="<?php echo wp_make_link_relative(home_url('/')); ?>"><?php _e("Home", "mangeonsafrodomain"); ?></a></li>
            <li class="breadcrumb-item active"><?php _e("Order confirmed", "mangeonsafrodomain"); ?></li>
        </ol>
        <!-- Hero Content-->
        <div class="hero-content pb-5 text-center">
            <h1 class="hero-heading"><?php _e("Order confirmed", "mangeonsafrodomain"); ?></h1>
        </div>
    </div>
</section>
<section class="pb-5">
    <div class="container text-center">
        <div class="icon-rounded bg-primary mb-3 mx-auto text-white">
            <svg class="svg-icon w-2rem h-2rem align-middle">
            <use xlink:href="#checkmark-1"> </use>
            </svg>
        </div>
        <h4 class="mb-3 ff-base"><?php _e("Thank you", "mangeonsafrodomain"); ?>, <?php echo $current_user->display_name; ?>. <?php _e("Your order is confirmed", "mangeonsafrodomain"); ?>.</h4>
        <p class="text-muted mb-5"><?php _e("Your order hasn't treated yet but we will send you an email when it does", "mangeonsafrodomain"); ?>.</p>
        <p> <a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('account', 'mangeonsafrodomain') . "/" . __('orders', 'mangeonsafrodomain'))->ID)) ?>" class="btn btn-outline-dark"><?php _e("View or manage your order", "mangeonsafrodomain"); ?></a></p>
    </div>
</section>