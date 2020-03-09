<!-- Footer-->
<footer class="main-footer">
    <!-- Main block - menus, subscribe form-->
    <div class="py-6 bg-gray-300 text-muted"> 
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <div class="font-weight-bold text-uppercase text-lg text-dark mb-3">Mangeons Afro<span class="text-primary"></span></div>
                    <p><?php _e("Website promoting African culinary diversities", "mangeonsafrodomain"); ?></p>
                    <ul class="list-inline">
                        <li class="list-inline-item"><a href="#" target="_blank" title="twitter" class="text-muted text-hover-primary"><i class="fab fa-twitter"></i></a></li>
                        <li class="list-inline-item"><a href="#" target="_blank" title="facebook" class="text-muted text-hover-primary"><i class="fab fa-facebook"></i></a></li>
                        <li class="list-inline-item"><a href="#" target="_blank" title="instagram" class="text-muted text-hover-primary"><i class="fab fa-instagram"></i></a></li>
                        <li class="list-inline-item"><a href="#" target="_blank" title="pinterest" class="text-muted text-hover-primary"><i class="fab fa-pinterest"></i></a></li>
                        <li class="list-inline-item"><a href="#" target="_blank" title="vimeo" class="text-muted text-hover-primary"><i class="fab fa-vimeo"></i></a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6 mb-5 mb-lg-0">
                    <h6 class="text-uppercase text-dark mb-3"><?php _e("Shops", "mangeonsafrodomain"); ?></h6>
                    <ul class="list-unstyled">
                        <li> <a href="#" class="text-muted"><?php _e("Restaurant", "mangeonsafrodomain"); ?></a></li>
                        <li> <a href="#" class="text-muted"><?php _e("Grocery store", "mangeonsafrodomain"); ?></a></li>
                        <li> <a href="#" class="text-muted"><?php _e("Catering", "mangeonsafrodomain"); ?></a></li>
                        <li> <a href="#" class="text-muted"><?php _e("Homemade", "mangeonsafrodomain"); ?></a></li>
                        <li> <a href="#" class="text-muted"><?php _e("Our shops", "mangeonsafrodomain"); ?></a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6 mb-5 mb-lg-0">
                    <h6 class="text-uppercase text-dark mb-3"><?php _e("Company", "mangeonsafrodomain"); ?></h6>
                    <ul class="list-unstyled">
                        <?php if (!is_user_logged_in()): ?>
                            <li> <a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('customer-zone', 'mangeonsafrodomain')))) ?>" class="text-muted"><?php _e("Customer zone", "mangeonsafrodomain"); ?></a></li>
                        <?php else: ?>
                            <li> <a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('account', 'mangeonsafrodomain') . "/" . __('profile', 'mangeonsafrodomain'))->ID)) ?>" class="text-muted"><?php _e("My profile", "mangeonsafrodomain"); ?></a></li>    
                        <?php endif; ?>
                        <li> <a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('about-us', 'mangeonsafrodomain')))) ?>" class="text-muted"><?php _e("About us", "mangeonsafrodomain"); ?></a></li>
                        <li> <a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('contact-us', 'mangeonsafrodomain')))) ?>" class="text-muted"><?php _e("Contact", "mangeonsafrodomain"); ?> </a></li>
                        <li> <a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('faq', 'mangeonsafrodomain')))) ?>" class="text-muted"><?php _e("F.A.Q", "mangeonsafrodomain"); ?> </a></li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h6 class="text-uppercase text-dark mb-3"><?php _e("Daily offers and discounts", "mangeonsafrodomain"); ?></h6>
                    <p class="mb-3"><?php _e("Stay informed about new offers and daily discounts", "mangeonsafrodomain"); ?></p>
                    <form action="#" id="newsletter-form">
                        <div class="input-group mb-3">
                            <input type="email" placeholder="<?php _e("Your Email Address", "mangeonsafrodomain"); ?>" aria-label="<?php _e("Your Email Address", "mangeonsafrodomain"); ?>" class="form-control bg-transparent border-secondary border-right-0">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-outline-secondary border-left-0"> <i class="fa fa-paper-plane text-lg text-dark"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright section of the footer-->
    <div class="py-4 font-weight-light bg-gray-800 text-gray-300">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-left">
                    <p class="mb-md-0">&copy; 2019 Mangeons Afro.  <?php _e("All rights reserved", "mangeonsafrodomain"); ?>.</p>
                </div>
                <div class="col-md-6">
                    <ul class="list-inline mb-0 mt-2 mt-md-0 text-center text-md-right">
                        <li class="list-inline-item"><img src="<?php echo wp_make_link_relative(get_template_directory_uri() . '/assets/img/visa.svg'); ?>" alt="..." class="w-2rem"></li>
                        <li class="list-inline-item"><img src="<?php echo wp_make_link_relative(get_template_directory_uri() . '/assets/img/mastercard.svg'); ?>" alt="..." class="w-2rem"></li>
                        <li class="list-inline-item"><img src="<?php echo wp_make_link_relative(get_template_directory_uri() . '/assets/img/paypal.svg'); ?>" alt="..." class="w-2rem"></li>
                        <li class="list-inline-item"><img src="<?php echo wp_make_link_relative(get_template_directory_uri() . '/assets/img/western-union.svg'); ?>" alt="..." class="w-2rem"></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- /Footer end-->
<div id="scrollTop"><i class="fa fa-long-arrow-alt-up"></i></div>
<!-- JavaScript files-->
<script>
    // ------------------------------------------------------- //
    //   Inject SVG Sprite - 
    //   see more here 
    //   https://css-tricks.com/ajaxing-svg-sprite/
    // ------------------------------------------------------ //
    function injectSvgSprite(path) {

        var ajax = new XMLHttpRequest();
        ajax.open("GET", path, true);
        ajax.send();
        ajax.onload = function (e) {
            var div = document.createElement("div");
            div.className = 'd-none';
            div.innerHTML = ajax.responseText;
            document.body.insertBefore(div, document.body.childNodes[0]);
        }
    }
    // this is set to Bootstrapious website as you cannot 
    // inject local SVG sprite (using only 'icons/orion-svg-sprite.svg' path)
    // while using file:// protocol
    // pls don't forget to change to your domain :)
    injectSvgSprite('https://demo.bootstrapious.com/sell/1-2-0/icons/orion-svg-sprite.svg');

</script>


<script>
    var basePath = '';

</script>
<?php wp_footer() ?>

<?php if (!is_user_logged_in() && is_page(get_page_by_path(__('customer-zone', 'mangeonsafrodomain'))->ID)): ?>
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallbackRegister&render=explicit&hl=en"
            async defer>
    </script> 
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallbackLogin&render=explicit&hl=en"
            async defer>
    </script> 
<?php endif ?>
<?php if (!is_user_logged_in() && is_page(get_page_by_path(__('forgot-password', 'mangeonsafrodomain'))->ID)): ?>
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallbackForgotPassword&render=explicit&hl=en"
            async defer>
    </script> 
<?php endif ?>

<?php if (is_page(get_page_by_path(__('our-products', 'mangeonsafrodomain'))->ID) || is_post_type_archive("products_cpt") || is_singular("products_cpt") || is_category()): ?>
    <script>
        var snapSlider = document.getElementById('slider-snap');

        noUiSlider.create(snapSlider, {
            start: [40, 110],
            snap: false,
            connect: true,
            step: 1,
            range: {
                'min': 0,
                'max': 250
            }
        });
        var snapValues = [
            document.getElementById('slider-snap-value-lower'),
            document.getElementById('slider-snap-value-upper')
        ];
        var inputValues = [
            document.getElementById('slider-snap-input-lower'),
            document.getElementById('slider-snap-input-upper')
        ];
        snapSlider.noUiSlider.on('update', function (values, handle) {
            snapValues[handle].innerHTML = values[handle];
        });

        snapSlider.noUiSlider.on('change', function (values, handle) {
            inputValues[handle].value = values[handle];
        });

    </script>
<?php endif ?>
<?php if (is_page(get_page_by_path(__('blog', 'mangeonsafrodomain'))->ID)): ?>
    <div id="fb-root"></div>
    <script>(function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id))
                return;
            js = d.createElement(s);
            js.id = id;
            js.src = 'https://connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.11';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
<?php endif ?>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD0-vYyoLewswX3Mq5Fcnh3rokGi69nqu0&libraries=places&language=en"></script>
<?php if (is_page(get_page_by_path(__('account', 'mangeonsafrodomain'). "/" . __("seller-zone", "mangeonsafrodomain") . "/" . __("shops", "mangeonsafrodomain") . "/" . __("new-shop", "mangeonsafrodomain"))->ID) || is_singular("shops_cpt")): ?>
    <script>
//        var input_shop_city = document.getElementById('shop-city');
//        var options = {
//            //bounds: defaultBounds,
//            types: ['(cities)']
//        };
//        autocomplete_shop_city = new google.maps.places.Autocomplete(input_shop_city, options);
    </script>
<?php endif ?>

<?php if (is_page(get_page_by_path(__('account', 'mangeonsafrodomain'). "/" . __("seller-zone", "mangeonsafrodomain") . "/" . __("products", "mangeonsafrodomain") . "/" . __("new-product", "mangeonsafrodomain"))->ID) || is_singular("products_cpt")): ?>
    <script>
//        var input_product_city = document.getElementById('product-city');
//        var options = {
//            //bounds: defaultBounds,
//            types: ['(cities)']
//        };
//        autocomplete_product_city = new google.maps.places.Autocomplete(input_product_city, options);
    </script>
<?php endif ?>
<?php if (is_page(get_page_by_path(__('account', 'mangeonsafrodomain') . "/" . __("profile", "mangeonsafrodomain"))->ID)): ?>
    <script>
//                var input_user_localisation = document.getElementById('localisation');
//                var options = {
//                    //bounds: defaultBounds,
//                    types: ['(cities)']
//                };
//                autocomplete_user_localisation = new google.maps.places.Autocomplete(input_user_localisation, options);
    </script>
<?php endif ?>
</body>
</html>
