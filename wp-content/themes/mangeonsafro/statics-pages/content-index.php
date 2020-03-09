<!-- Hero Section-->
<!--<section class="home-full-slider-wrapper mb-10px">
     Hero Slider
    <div class="owl-carousel owl-theme owl-dots-modern home-full-slider">
        <div style="background: #f8d5cf;" class="item home-full-item"><img src="<?php echo wp_make_link_relative(get_template_directory_uri() . '/assets/img/photo/matheus-ferrero-334418-unsplash.jpg'); ?>" alt="" class="bg-image">
            <div class="container-fluid h-100 py-5">
                <div class="row align-items-center h-100">
                    <div class="col-lg-8 col-xl-6 mx-auto text-white text-center">
                        <h5 class="text-uppercase text-white font-weight-light mb-4 letter-spacing-5"> </h5>
                        <h1 class="mb-5 display-2 font-weight-bold text-serif">Epiceries</h1>
                        <p class="lead mb-4"></p>
                        <p> <a href="category.html" class="btn btn-light">View collection</a></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="item home-full-item bg-dark dark-overlay"><img src="<?php echo wp_make_link_relative(get_template_directory_uri() . '/assets/img/photo/ian-dooley-347942-unsplash.jpg'); ?>" alt="" class="bg-image">
            <div class="container-fluid h-100">
                <div class="row align-items-center h-100">
                    <div class="col-lg-8 col-xl-6 mx-auto text-white text-center overlay-content">
                        <h1 class="mb-4 display-2 text-uppercase font-weight-bold">Restaurants</h1>
                        <p class="lead mb-5"></p>
                        <p> <a href="category.html" class="btn btn-light">View collection</a></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="item home-full-item"><img src="<?php echo wp_make_link_relative(get_template_directory_uri() . '/assets/img/photo/haley-phelps-62815-unsplash.jpg'); ?>" alt="" class="bg-image">
            <div class="container-fluid h-100">
                <div class="row align-items-center h-100">
                    <div class="col-lg-8 col-xl-6 mx-auto text-white text-center">
                        <h5 class="text-uppercase font-weight-light mb-4 letter-spacing-5"></h5>
                        <h1 class="mb-5 display-1 font-weight-bold text-serif">Reservation de tables</h1>
                        <p> <a href="category.html" class="btn btn-light">View collection</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>-->
<section>
    <div class="container-fluid px-5px">
        <div class="row mx-0">
            <div class="col-md-6 mb-10px px-5px">
                <div class="card border-0 text-white text-center"><img src="<?php echo wp_make_link_relative(get_template_directory_uri() . '/assets/img/photo/christopher-campbell-28571-unsplash.jpg'); ?>" alt="Card image" class="card-img">
                    <div class="card-img-overlay d-flex align-items-center"> 
                        <div class="w-100 py-3">
                            <h2 class="display-3 font-weight-bold mb-4"><?php echo get_category_by_slug(__('restaurant-en', 'mangeonsafrodomain'))->name; ?></h2><a href="<?php echo wp_make_link_relative(esc_url(get_category_link(get_category_by_slug(__('restaurant-en', 'mangeonsafrodomain'))->term_id))) ?>" class="btn btn-light"><?php _e("List all", "mangeonsafrodomain"); ?><i class="fa-arrow-right fa ml-2"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-10px px-5px">
                <div class="card border-0 text-white text-center"><img src="<?php echo wp_make_link_relative(get_template_directory_uri() . '/assets/img/photo/marco-xu-496929-unsplash.jpg'); ?>" alt="Card image" class="card-img">
                    <div class="card-img-overlay d-flex align-items-center"> 
                        <div class="w-100 py-3">
                            <h2 class="display-3 font-weight-bold mb-4"><?php echo get_category_by_slug(__('catering', 'mangeonsafrodomain'))->name; ?></h2><a href="<?php echo wp_make_link_relative(esc_url(get_category_link(get_category_by_slug(__('catering', 'mangeonsafrodomain'))->term_id))) ?>" class="btn btn-light"><?php _e("List all", "mangeonsafrodomain"); ?><i class="fa-arrow-right fa ml-2"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mx-0">
            <div class="col-md-6 mb-10px px-5px">
                <div class="card border-0 text-center text-white"><img src="<?php echo wp_make_link_relative(get_template_directory_uri() . '/assets/img/photo/benjamin-voros-260869-unsplash.jpg'); ?>" alt="Card image" class="card-img">
                    <div class="card-img-overlay d-flex align-items-center"> 
                        <div class="w-100">
                            <h2 class="display-4 font-weight-bold mb-4"><?php echo get_category_by_slug(__('homemade', 'mangeonsafrodomain'))->name; ?></h2><a href="<?php echo wp_make_link_relative(esc_url(get_category_link(get_category_by_slug(__('homemade', 'mangeonsafrodomain'))->term_id))) ?>" class="btn btn-light"><?php _e("List all", "mangeonsafrodomain"); ?><i class="fa-arrow-right fa ml-2"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-10px px-5px">
                <div class="card border-0 text-center text-white"><img src="<?php echo wp_make_link_relative(get_template_directory_uri() . '/assets/img/photo/malvestida-magazine-458585-unsplash.jpg'); ?>" alt="Card image" class="card-img">
                    <div class="card-img-overlay d-flex align-items-center"> 
                        <div class="w-100">
                            <h2 class="display-4 font-weight-bold mb-4"><?php echo get_category_by_slug(__('grocery-store', 'mangeonsafrodomain'))->name; ?></h2><a href="<?php echo wp_make_link_relative(esc_url(get_category_link(get_category_by_slug(__('grocery-store', 'mangeonsafrodomain'))->term_id))) ?>" class="btn btn-light"><?php _e("List all", "mangeonsafrodomain"); ?><i class="fa-arrow-right fa ml-2"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>