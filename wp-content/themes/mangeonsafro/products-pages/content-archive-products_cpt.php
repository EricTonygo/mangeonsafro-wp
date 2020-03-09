<?php
$products_count = 0;
if ($products->have_posts()) {
    $products_count = $products->found_posts;
}
?>

<!-- Hero Section-->
<section class="hero">
    <div class="container">
        <!-- Breadcrumbs -->
        <ol class="breadcrumb justify-content-center">
            <li class="breadcrumb-item"><a href="<?php echo wp_make_link_relative(home_url('/')); ?>"><?php _e("Home", "mangeonsafrodomain"); ?></a></li>
            <?php if (is_post_type_archive("products_cpt")): ?>
                <li class="breadcrumb-item active"><?php _e("Our products", "mangeonsafrodomain"); ?></li>
            <?php elseif (is_page(get_page_by_path(__("our-products", "mangeonsafrodomain"))->ID)): ?>
                <?php if ($shop): ?>
                    <li class="breadcrumb-item active"><?php _e("Products of", "mangeonsafrodomain"); ?> <?php echo $shop->post_title; ?></li>
                <?php else : ?>
                    <li class="breadcrumb-item active"><?php _e("Our products", "mangeonsafrodomain"); ?></li>
                <?php endif; ?>

            <?php elseif (is_category()) : ?>
                <li class="breadcrumb-item"><a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('our-products', 'mangeonsafrodomain'))->ID)) ?>"><?php _e("Products", "mangeonsafrodomain"); ?></a></li>
                <?php if (get_category(get_query_var('cat'))->category_parent > 0): ?>
                    <li class="breadcrumb-item"><a href="<?php echo wp_make_link_relative(esc_url(get_category_link(get_category(get_query_var('cat'))->category_parent))) ?>"><?php echo get_category(get_category(get_query_var('cat'))->category_parent)->name; ?></a></li>
                <?php endif; ?>
                <li class="breadcrumb-item active"><?php echo get_category(get_query_var('cat'))->name; ?></li>
            <?php endif; ?>
        </ol>
        <!-- Hero Content-->
        <div class="hero-content text-center">
            <?php if (is_post_type_archive("products_cpt")): ?>
                <h2 class="hero-heading"><?php _e("Our products", "mangeonsafrodomain"); ?></h2>
            <?php elseif (is_page(get_page_by_path(__("our-products", "mangeonsafrodomain"))->ID)): ?>
                <?php if ($shop): ?>
                    <h3 class="hero-heading"><?php _e("Products of", "mangeonsafrodomain"); ?> <?php echo $shop->post_title; ?></h3>
                <?php else : ?>
                    <h2 class="hero-heading"><?php _e("Our products", "mangeonsafrodomain"); ?></h2>
                <?php endif; ?>
            <?php elseif (is_category()) : ?>
                <h2 class="hero-heading"><?php echo get_category(get_query_var('cat'))->name; ?></h2>
            <?php endif; ?>
        </div>
    </div>
</section>
<div class="container">
    <div class="row">
        <!-- Grid -->
        <div class="products-grid col-xl-9 col-lg-8 order-lg-2">
            <header class="product-grid-header">
                <div class="mr-3 mb-3">

                    <?php _e("Showing", "mangeonsafrodomain"); ?> <strong>1-<?php echo $posts_per_page; ?> </strong><?php _e("of", "mangeonsafrodomain"); ?> <strong><?php echo $products_count; ?> </strong><?php _e("products", "mangeonsafrodomain"); ?>
                </div>
                <div class="mr-3 mb-3"><span class="mr-2"><?php _e("Show", "mangeonsafrodomain"); ?></span>
                    <?php
                    $params_arg_tmp = $params_arg;
                    $params_arg_tmp["posts-per-page"] = 12;
                    ?>
                    <a href="<?php echo esc_url(add_query_arg($params_arg_tmp, wp_make_link_relative($page_link))); ?>" class="product-grid-header-show <?php if ($posts_per_page == 12): ?>active<?php endif; ?>">12    </a>
                    <?php
                    $params_arg_tmp["posts-per-page"] = 24;
                    ?>
                    <a href="<?php echo esc_url(add_query_arg($params_arg_tmp, wp_make_link_relative($page_link))); ?>" class="product-grid-header-show <?php if ($posts_per_page == 24): ?>active<?php endif; ?>">24</a>
                    <?php
                    $params_arg_tmp["posts-per-page"] = -1;
                    ?>
                    <a href="<?php echo esc_url(add_query_arg($params_arg_tmp, wp_make_link_relative($page_link))); ?>" class="product-grid-header-show <?php if ($posts_per_page == -1): ?>active<?php endif; ?>"><?php _e("All", "mangeonsafrodomain"); ?>    </a>
                </div>
                <div class="mb-3 d-flex align-items-center"><span class="d-inline-block mr-1"><?php _e("Sort by", "mangeonsafrodomain"); ?></span>
                    <select class="custom-select w-auto border-0">
                        <option value="orderby_0"><?php _e("Default", "mangeonsafrodomain"); ?></option>
                        <option value="orderby_1"><?php _e("Popularity", "mangeonsafrodomain"); ?></option>
                        <option value="orderby_2"><?php _e("Rating", "mangeonsafrodomain"); ?></option>
                        <option value="orderby_3"><?php _e("Newest first", "mangeonsafrodomain"); ?></option>
                    </select>
                </div>
            </header>
            <?php
            global $current_user;
            if ($products->have_posts()) :
                ?>
                <div class="row">
                    <?php
                    while ($products->have_posts()): $products->the_post();
                        $product_thumbnail_image_id = get_post_meta(get_the_ID(), 'product-thubmnail-image-id', true);
                        $post_author = get_post_field('post_author', get_the_ID());
                        ?>
                        <?php include(locate_template("products-pages/content-single-product-card.php")); ?>                       
                        <?php
                    endwhile;
                    ?>
                </div>
            <?php else: ?>
                <div class="alert alert-warning fluid" role="alert">
                    <?php
                    if ($shop) {
                        if (is_category()) {
                            _e("This shop have not yet registered any products in this category", "mangeonsafrodomain");
                        } else {
                            _e("We have not yet registered any products of this shop", "mangeonsafrodomain");
                        }
                    } else {
                        _e("We have not yet registered any products in this category", "mangeonsafrodomain");
                    }
                    ?>.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif ?>
            <?php wp_reset_postdata();
            ?>

            <?php
            if ($total_post_pages > 1):
                $start = 1;
                $end = $total_post_pages;
                if ($total_post_pages > 5 && $num_page > 3) {
                    $end = $num_page + 2 < $total_post_pages ? $num_page + 2 : $total_post_pages;
                    $start = $end - 4 > 1 ? $end - 4 : 1;
                } elseif ($total_post_pages > 5) {
                    $end = 5;
                }
                $params_arg_tmp = $params_arg;
                ?>

                <nav aria-label="page navigation" class="d-flex justify-content-center mb-5 mt-3">
                    <ul class="pagination">
                        <?php if ($num_page > 1): ?>
                            <?php
                            $params_arg_tmp["page"] = $num_page - 1;
                            ?>
                            <li class="page-item"><a href="<?php echo esc_url(add_query_arg($params_arg_tmp, wp_make_link_relative($page_link))); ?>" aria-label="Previous" class="page-link"><span aria-hidden="true"><?php _e("Prev", "mangeonsafrodomain"); ?></span><span class="sr-only"><?php _e("Previous", "mangeonsafrodomain"); ?></span></a></li>
                        <?php endif ?>
                        <?php for ($i = $start; $i <= $end; $i++): ?>
                            <?php
                            $params_arg_tmp["page"] = $i;
                            ?>
                            <li class="page-item <?php if ($num_page == $i): ?>active<?php endif ?>"><a href="<?php echo esc_url(add_query_arg($params_arg_tmp, wp_make_link_relative($page_link))); ?>" class="page-link"><?php echo $i; ?></a></li>
                        <?php endfor; ?>
                        <?php if ($num_page < $total_post_pages): ?>
                            <?php
                            $params_arg_tmp["page"] = $num_page + 1;
                            ?>
                            <li class="page-item"><a href="<?php echo esc_url(add_query_arg($params_arg_tmp, wp_make_link_relative($page_link))); ?>" aria-label="Next" class="page-link"><span aria-hidden="true"><?php _e("Next", "mangeonsafrodomain"); ?></span><span class="sr-only"><?php _e("Next", "mangeonsafrodomain"); ?></span></a></li>
                        <?php endif ?>
                    </ul>
                </nav>
            <?php endif ?>

        </div>
        <!-- / Grid End-->
        <!-- Sidebar-->
        <div class="sidebar col-xl-3 col-lg-4 order-lg-1">
            <div class="sidebar-block px-3 px-lg-0 mr-lg-4"><a data-toggle="collapse" href="#categoriesMenu" aria-expanded="false" aria-controls="categoriesMenu" class="d-lg-none block-toggler"><?php _e("Product Categories", "mangeonsafrodomain"); ?></a>
                <div id="categoriesMenu" class="expand-lg collapse">
                    <div class="nav nav-pills flex-column mt-4 mt-lg-0">
                        <?php
                        $product_parent_categories = get_categories(array('hide_empty' => false, 'orderby' => 'name', 'order' => 'ASC', 'parent' => 0));
                        foreach ($product_parent_categories as $product_parent_category):
                            ?>
                            <?php
                            $product_sub_categories = get_categories(array('hide_empty' => false, 'orderby' => 'slug', 'order' => 'ASC', 'parent' => $product_parent_category->term_id));
                            ?>
                            <?php if ($product_sub_categories): ?>
                            <a href="<?php echo esc_url(add_query_arg($params_arg, wp_make_link_relative(esc_url(get_category_link($product_parent_category->term_id))))); ?>" class="has-sub-categories font-weight-bold nav-link d-flex justify-content-between mb-2 <?php if ($product_parent_category->term_id == get_category(get_query_var('cat'))->term_id): ?> active <?php endif; ?>"><span><?php echo $product_parent_category->name; ?></span></a>
                                <div class="nav nav-pills flex-column ml-3">
                                    <?php foreach ($product_sub_categories as $product_sub_category):
                                        ?>
                                        
                                        <?php
                                        $product_sub_sub_categories = get_categories(array('hide_empty' => false, 'orderby' => 'slug', 'order' => 'ASC', 'parent' => $product_sub_category->term_id));
                                        ?>
                                        <?php if ($product_sub_sub_categories): ?>
                                            <a href="<?php echo esc_url(add_query_arg($params_arg, wp_make_link_relative(esc_url(get_category_link($product_sub_category->term_id))))); ?>" class="has-sub-categories font-weight-bold nav-link mb-2 <?php if ($product_sub_category->term_id == get_category(get_query_var('cat'))->term_id): ?> active <?php endif; ?>"><?php echo $product_sub_category->name; ?></a>
                                            <div class="nav nav-pills flex-column ml-3">
                                                <?php foreach ($product_sub_sub_categories as $product_sub_sub_category):
                                                    ?>
                                                    <a href="<?php echo esc_url(add_query_arg($params_arg, wp_make_link_relative(esc_url(get_category_link($product_sub_sub_category->term_id))))); ?>" class="nav-link mb-2 <?php if ($product_sub_sub_category->term_id == get_category(get_query_var('cat'))->term_id): ?> active <?php endif; ?>"><?php echo $product_sub_sub_category->name; ?></a>
                                                <?php endforeach ?>
                                            </div>
                                        <?php else: ?>
                                            <a href="<?php echo esc_url(add_query_arg($params_arg, wp_make_link_relative(esc_url(get_category_link($product_sub_category->term_id))))); ?>" class="nav-link mb-2 <?php if ($product_sub_category->term_id == get_category(get_query_var('cat'))->term_id): ?> active <?php endif; ?>"><?php echo $product_sub_category->name; ?></a>
                                        <?php endif; ?>
                                    <?php endforeach ?>
                                </div>
                            
                            <?php else: ?>
                            <a href="<?php echo esc_url(add_query_arg($params_arg, wp_make_link_relative(esc_url(get_category_link($product_parent_category->term_id))))); ?>" class="nav-link d-flex justify-content-between mb-2 <?php if ($product_parent_category->term_id == get_category(get_query_var('cat'))->term_id): ?> active <?php endif; ?>"><span><?php echo $product_parent_category->name; ?></span></a>
                            <?php endif; ?>
                        <?php endforeach ?>

                    </div>
                </div>
            </div>
            <div class="sidebar-block px-3 px-lg-0 mr-lg-4"><a data-toggle="collapse" href="#priceFilterMenu" aria-expanded="false" aria-controls="priceFilterMenu" class="d-lg-none block-toggler"><?php _e("Filter by price", "mangeonsafrodomain"); ?></a>
                <div id="priceFilterMenu" class="expand-lg collapse">
                    <h6 class="sidebar-heading d-none d-lg-block"><?php _e("Price", "mangeonsafrodomain"); ?>  </h6>
                    <div id="slider-snap" class="mt-4 mt-lg-0"> </div>
                    <div class="nouislider-values">
                        <div class="min"><?php _e("From", "mangeonsafrodomain"); ?> <span id="slider-snap-value-lower"></span>€</div>
                        <div class="max"><?php _e("To", "mangeonsafrodomain"); ?> <span id="slider-snap-value-upper"></span>€</div>
                        <input type="hidden" name="pricefrom" id="slider-snap-input-lower" value="40" class="slider-snap-input">
                        <input type="hidden" name="priceto" id="slider-snap-input-upper" value="110" class="slider-snap-input">
                    </div>
                </div>
            </div>
            <!--            <div class="sidebar-block px-3 px-lg-0 mr-lg-4"><a data-toggle="collapse" href="#brandFilterMenu" aria-expanded="true" aria-controls="brandFilterMenu" class="d-lg-none block-toggler">Filter by brand</a>
                             Brand filter menu - this menu has .show class, so is expanded by default
                            <div id="brandFilterMenu" class="expand-lg collapse show">
                                <h6 class="sidebar-heading d-none d-lg-block">Restaurants </h6>
                                <form action="#" class="mt-4 mt-lg-0"> 
                                    <div class="form-group mb-1">
                                        <div class="custom-control custom-checkbox">
                                            <input id="brand0" type="checkbox" name="clothes-brand" checked class="custom-control-input">
                                            <label for="brand0" class="custom-control-label">Restaurant 1 <small>(18)</small></label>
                                        </div>
                                    </div>
                                    <div class="form-group mb-1">
                                        <div class="custom-control custom-checkbox">
                                            <input id="brand1" type="checkbox" name="clothes-brand" checked class="custom-control-input">
                                            <label for="brand1" class="custom-control-label">Restaurant 2 <small>(30)</small></label>
                                        </div>
                                    </div>
                                    <div class="form-group mb-1">
                                        <div class="custom-control custom-checkbox">
                                            <input id="brand2" type="checkbox" name="clothes-brand" class="custom-control-input">
                                            <label for="brand2" class="custom-control-label">Restaurant 3 <small>(120)</small></label>
                                        </div>
                                    </div>
                                    <div class="form-group mb-1">
                                        <div class="custom-control custom-checkbox">
                                            <input id="brand3" type="checkbox" name="clothes-brand" class="custom-control-input">
                                            <label for="brand3" class="custom-control-label">Restaurant 4 <small>(70)</small></label>
                                        </div>
                                    </div>
                                    <div class="form-group mb-1">
                                        <div class="custom-control custom-checkbox">
                                            <input id="brand4" type="checkbox" name="clothes-brand" class="custom-control-input">
                                            <label for="brand4" class="custom-control-label">Restaurant 5  <small>(110)</small></label>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>-->
            <!--            <div class="sidebar-block px-3 px-lg-0 mr-lg-4"> <a data-toggle="collapse" href="#sizeFilterMenu" aria-expanded="false" aria-controls="sizeFilterMenu" class="d-lg-none block-toggler">Filter by size</a>
                             Size filter menu
                            <div id="sizeFilterMenu" class="expand-lg collapse"> 
                                <h6 class="sidebar-heading d-none d-lg-block">Quantity </h6>
                                <form action="#" class="mt-4 mt-lg-0">  
                                    div class="form-group mb-1">
                                      <div class="custom-control custom-radio">
                                        <input id="size0" type="radio" name="size" checked class="custom-control-input">
                                        <label for="size0" class="custom-control-label">Small</label>
                                      </div>
                                    </div>
                                    <div class="form-group mb-1">
                                      <div class="custom-control custom-radio">
                                        <input id="size1" type="radio" name="size" class="custom-control-input">
                                        <label for="size1" class="custom-control-label">Medium</label>
                                      </div>
                                    </div>
                                    <div class="form-group mb-1">
                                      <div class="custom-control custom-radio">
                                        <input id="size2" type="radio" name="size" class="custom-control-input">
                                        <label for="size2" class="custom-control-label">Large</label>
                                      </div>
                                    </div>
                                    <div class="form-group mb-1">
                                      <div class="custom-control custom-radio">
                                        <input id="size3" type="radio" name="size" class="custom-control-input">
                                        <label for="size3" class="custom-control-label">X-Large</label>
                                      </div>
                                    </div
                                    <input name="items" type="number" value="1" class="form-control detail-quantity">
                                </form>
                            </div>
                        </div>-->
<!--            <div class="sidebar-block px-3 px-lg-0 mr-lg-4"><a data-toggle="collapse" href="#colourFilterMenu" aria-expanded="false" aria-controls="colourFilterMenu" class="d-lg-none block-toggler">Filter by colour</a>
                 Size filter menu
                div id="colourFilterMenu" class="expand-lg collapse">
                  <h6 class="sidebar-heading d-none d-lg-block">Colour </h6>
                  <div class="mt-4 mt-lg-0"> 
                    <ul class="list-inline mb-0 colours-wrapper">
                      <li class="list-inline-item">
                        <label for="colour_sidebar_Blue" style="background-color: #668cb9" data-allow-multiple class="btn-colour"> </label>
                        <input type="checkbox" name="colour" value="value_sidebar_Blue" id="colour_sidebar_Blue" class="input-invisible">
                      </li>
                      <li class="list-inline-item">
                        <label for="colour_sidebar_White" style="background-color: #fff" data-allow-multiple class="btn-colour"> </label>
                        <input type="checkbox" name="colour" value="value_sidebar_White" id="colour_sidebar_White" class="input-invisible">
                      </li>
                      <li class="list-inline-item">
                        <label for="colour_sidebar_Violet" style="background-color: #8b6ea4" data-allow-multiple class="btn-colour"> </label>
                        <input type="checkbox" name="colour" value="value_sidebar_Violet" id="colour_sidebar_Violet" class="input-invisible">
                      </li>
                      <li class="list-inline-item">
                        <label for="colour_sidebar_Red" style="background-color: #dd6265" data-allow-multiple class="btn-colour"> </label>
                        <input type="checkbox" name="colour" value="value_sidebar_Red" id="colour_sidebar_Red" class="input-invisible">
                      </li>
                    </ul>
                  </div>
                </div
            </div>-->
        </div>
        <!-- /Sidebar end-->
    </div>
</div>
<!-- Quickview Modal    -->
<div id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade quickview">
    <div role="document" class="modal-dialog modal-lg">
        <div class="modal-content">
            <button type="button" data-dismiss="modal" aria-label="Close" class="close modal-close">
                <svg class="svg-icon w-100 h-100 svg-icon-light align-middle">
                <use xlink:href="#close-1"> </use>
                </svg>
            </button>
            <div class="modal-body"> 
                <!--                <div class="ribbon ribbon-primary">Meilleure offre</div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div data-slider-id="1" class="owl-carousel owl-theme owl-dots-modern detail-full">
                                            <div style="background: center center url('img/photo/kyle-loftus-596319-detail-1.jpg') no-repeat; background-size: cover;" class="detail-full-item-modal">  </div>
                                            <div style="background: center center url('img/photo/kyle-loftus-596319-detail-2.jpg') no-repeat; background-size: cover;" class="detail-full-item-modal">  </div>
                                            <div style="background: center center url('img/photo/kyle-loftus-596319-detail-3.jpg') no-repeat; background-size: cover;" class="detail-full-item-modal">  </div>
                                            <div style="background: center center url('img/photo/kyle-loftus-594535-unsplash-detail-3.jpg') no-repeat; background-size: cover;" class="detail-full-item-modal">  </div>
                                            <div style="background: center center url('img/photo/kyle-loftus-594535-unsplash-detail-4.jpg') no-repeat; background-size: cover;" class="detail-full-item-modal">  </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 d-flex align-items-center">
                                        <div>
                                            <h2 class="mb-4 mt-4 mt-lg-1">Curry Thai</h2>
                                            <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-sm-between mb-4">
                                                <ul class="list-inline mb-2 mb-sm-0">
                                                    <li class="list-inline-item h4 font-weight-light mb-0">$65.00</li>
                                                    <li class="list-inline-item text-muted font-weight-light"> 
                                                        <del>$90.00</del>
                                                    </li>
                                                </ul>
                                                <div class="d-flex align-items-center">
                                                    <ul class="list-inline mr-2 mb-0">
                                                        <li class="list-inline-item mr-0"><i class="fa fa-star text-primary"></i></li>
                                                        <li class="list-inline-item mr-0"><i class="fa fa-star text-primary"></i></li>
                                                        <li class="list-inline-item mr-0"><i class="fa fa-star text-primary"></i></li>
                                                        <li class="list-inline-item mr-0"><i class="fa fa-star text-primary"></i></li>
                                                        <li class="list-inline-item mr-0"><i class="fa fa-star text-gray-300"></i></li>
                                                    </ul><span class="text-muted text-uppercase text-sm">25 avis</span>
                                                </div>
                                            </div>
                                            <p class="mb-4 text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</p>
                                            <form action="#">
                                                <div class="row">
                                                    <div class="col-sm-6 col-lg-12 detail-option mb-3">
                                                        <h6 class="detail-option-heading">Mode de livraison <span>(required)</span></h6>
                                                        <label for="material_0" class="btn btn-sm btn-outline-secondary detail-option-btn-label">
                
                                                            A domicile
                                                            <input type="radio" name="material" value="value_0" id="material_0" required class="input-invisible">
                                                        </label>
                                                        <label for="material_1" class="btn btn-sm btn-outline-secondary detail-option-btn-label">
                
                                                            Poste relais
                                                            <input type="radio" name="material" value="value_1" id="material_1" required class="input-invisible">
                                                        </label>
                                                    </div>
                
                                                    <div class="col-12 col-lg-6 detail-option mb-5">
                                                        <label class="detail-option-heading font-weight-bold">Nombres de plats <span>(required)</span></label>
                                                        <input name="items" type="number" value="1" class="form-control detail-quantity">
                                                    </div>
                                                </div>
                                                <ul class="list-inline">
                                                    <li class="list-inline-item">
                                                        <button type="submit" class="btn btn-dark btn-lg mb-1"> <i class="fa fa-shopping-cart mr-2"></i>Ajouter au panier</button>
                                                    </li>
                                                    li class="list-inline-item"><a href="#" class="btn btn-outline-secondary mb-1"> <i class="far fa-heart mr-2"></i>Add to wishlist</a></li
                                                </ul>
                                            </form>
                                        </div>
                                    </div>
                                </div>-->
            </div>
        </div>
    </div>
</div>