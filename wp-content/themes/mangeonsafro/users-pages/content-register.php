<!-- content of Register -->
<!-- Hero Section-->
<section class="hero">
    <div class="container">
        <!-- Breadcrumbs -->
        <ol class="breadcrumb justify-content-center">
            <li class="breadcrumb-item"><a href="<?php echo wp_make_link_relative(home_url('/')) ?>"><?php _e("Home", "mangeonsafrodomain"); ?></a></li>
            <li class="breadcrumb-item active"><?php _e("Espace client", "mangeonsafrodomain"); ?></li>
        </ol>
        <!-- Hero Content-->
        <div class="hero-content pb-5 text-center">
            <h1 class="hero-heading mb-0"><?php _e("Espace client", "mangeonsafrodomain"); ?></h1>
        </div>
    </div>
</section>
<!-- customer login-->
<section>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="block">
                    <div class="block-header">
                        <h6 class="text-uppercase mb-0"><?php _e("Connexion", "mangeonsafrodomain"); ?></h6>
                    </div>
                    <div class="block-body">
                        <p class="lead">Déjà notre client?</p>
                        <p class="text-muted">Connectez vous pour avoir accès à nos differents services</p>
                        <hr>
                        <form action="customer-orders.html" method="get">
                            <div class="form-group">
                                <label for="email" class="form-label">Email</label>
                                <input id="email" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="form-label">Mot de passe</label>
                                <input id="password" type="password" class="form-control">
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-outline-dark"><i class="fa fa-sign-in-alt mr-2"></i> Se connecter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="block">
                    <div class="block-header">
                        <h6 class="text-uppercase mb-0">Nouveau compte</h6>
                    </div>
                    <div class="block-body"> 
                        <p class="lead">Vous n'est pas encore inscrit?</p>
                        <p class="text-muted">Créer votre à travers ce formulaire en quelques minutes</p>
                        <p class="text-muted">Si vous avez questions ou vous rencontrez des difficultés, <a href="contact.html">contactez nous ici</a>, notre service client à votre écoute.</p>
                        <hr>
                        <form action="customer-orders.html" method="get">
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


<!--<div class="signin_container">            
    <div id="register_content" class="ui vertical stripe segment">
        <div class="ui middle aligned stackable container">
            <div class="ui fluid card">
                <div class="content">
                    <div class="header"><?php _e("REGISTER", "mangeonsafrodomain"); ?></div>
                </div>
                <div class="content">
                    <form id="register_account_form" class="ui form" method="POST" action="<?php echo wp_make_link_relative(get_permalink()); ?>" autocomplete="off">
                        <div class="field">
                            <label for="username"><?php _e("Username", "mangeonsafrodomain") ?> <span class="required">*</span></label>
                            <input id="username" type="text" name="username" placeholder="<?php _e("Username", "mangeonsafrodomain"); ?>" value="<?php echo $user_login; ?>">
                            <span class="advice" style="font-size: 12px;"><?php _e("This will be your username. You can add the name of your organization or your public name later", "mangeonsafrodomain"); ?>.</span>
                        </div>

                        <div class="field">
                            <label for="email"><?php _e("E-mail", "mangeonsafrodomain") ?> <span class="required">*</span></label>
                            <input id="email" type="text" name="email" placeholder="<?php _e("E-mail", "mangeonsafrodomain") ?>" value="<?php echo $user_email ?>">
                            <span class="advice" style="font-size: 12px;"><?php _e("We'll occasionally send updates about your account to this inbox. We'll never share your email address with anyone", "mangeonsafrodomain"); ?>.</span>
                        </div>

                        <div class="field">
                            <label for="password"><?php _e("Password", "mangeonsafrodomain") ?> <span class="required">*</span></label>
                            <input id="password" type="password" name="password" placeholder="<?php _e("Password", "mangeonsafrodomain") ?>">
                            <span class="advice" style="font-size: 12px;"><?php _e("Use at least one lowercase letter, one numeral, and seven characters", "mangeonsafrodomain"); ?>.</span>
                        </div>

                        <div class="field">
                            <label for="confirm-password"><?php _e("Confirm password", "mangeonsafrodomain") ?> <span class="required">*</span></label>
                            <input id="confirm-password" type="password" name="confirm-password" placeholder="<?php _e("Confirm password", "mangeonsafrodomain") ?>">
                        </div>

                        <div class="fields">
                            <div class="four wide field">
                            </div>
                            <div class="twelve wide field" id="recaptcha_register">
                            </div>                              
                        </div>

                        <button id="submit_register_account" class="ui disabled right green button" type="submit"><?php _e("Sign up", "mangeonsafrodomain") ?></button>
                    </form>                            
                </div>
            </div>
        </div>
    </div>
</div>-->