<div class="signin_container">
    <div id="login_content" class="ui vertical stripe segment">
        <div class="ui middle aligned stackable container">
            <div class="ui fluid card">
                <div class="content">
                    <div class="header"><?php _e("LOGIN", "booksharedomain"); ?></div>
                </div>
                <div class="content">
                    <?php include(locate_template("statics-pages/content-success-or-faillure-message.php")); ?>
                    <form class="ui form" id="login_form" class="ui form" method="POST" action="<?php echo wp_make_link_relative(get_permalink()); ?>" autocomplete="off">

                        <div class="field">
                            <label for="name"><?php _e("Username or e-mail", "booksharedomain");?> <span class="required">*</span></label>
                            <input id="username" type="text" name="username"  value="<?php echo $login; ?>" placeholder="<?php _e("Username or e-mail", "booksharedomain") ?>">
                        </div>

                        <div class="field">
                            <label for="password"><?php _e("Password", "booksharedomain"); ?> <span class="required">*</span></label>
                            <input id="password" type="password" name="password" placeholder="<?php _e("Password", "booksharedomain") ?>">
                        </div>

                        <?php if (isset($_SESSION['redirect_to'])): ?>
                            <input type="hidden" name='redirect_to' value="<?php echo $_SESSION['redirect_to']; //unset($_SESSION['redirect_to']);   ?>" >
                        <?php endif ?>

                        <div class="field">
                            <div class="ui checkbox">
                                <input type="checkbox" name="_member">
                                <label><?php _e("Remember me", "booksharedomain"); ?></label>
                            </div>
                        </div>
                            
                        <div class="fields">                            
                            <div class="twelve wide field" id="recaptcha_login">
                            </div>                              
                        </div>

                        <div class="field">
                            <button id="submit_login_form" class="ui disabled green button" type="submit"><?php _e("Sign in", "booksharedomain"); ?></button>
                            <a href="<?php echo wp_make_link_relative(get_permalink(get_page_by_path(__('forgot-password', 'booksharedomain'))->ID)); ?>" class="ui button btn-link forgot_password "><?php _e("Forgot your password", "booksharedomain"); ?>?</a>
                        </div>
                    </form>                            
                </div>
            </div>
        </div>
    </div>
</div>