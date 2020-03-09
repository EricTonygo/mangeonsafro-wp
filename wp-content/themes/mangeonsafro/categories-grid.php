<div class="four wide column">
    <div class="">
        <div class="ui vertical fluid accordion menu categories" id="categories">
            <div class="item">
                <a class="title header">
                    <i class="dropdown icon"></i>
                    <?php echo __("CATEGORIES", "booksharedomain"); ?>
                </a>
                <div class="content <?php //if ((is_singular("publications_cpt") || is_singular("alerts_cpt") || is_category() || is_post_type_archive("publications_cpt") || is_post_type_archive("alerts_cpt")) && !cat_is_ancestor_of( get_category_by_slug('textbooks')->term_id, get_category(get_query_var('cat'))->term_id)):           ?>  <?php //endif            ?> menu">
                    <div class="item">
                        <?php if (is_post_type_archive("alerts_cpt") || is_singular("alerts_cpt") || $pub_type == "alerts"): ?>
                            <a class="<?php if (is_post_type_archive("alerts_cpt")): ?>title<?php else: ?>header<?php endif ?>" href="<?php echo get_post_type_archive_link('alerts_cpt') ?>">
                                <?php echo __("All Categories", "booksharedomain"); ?>
                            </a>
                        <?php else: ?>
                            <a class="<?php if (is_post_type_archive("publications_cpt")): ?>title<?php else: ?>header<?php endif ?>" href="<?php echo get_post_type_archive_link('publications_cpt') ?>">
                                <?php echo __("All Categories", "booksharedomain"); ?>
                            </a>
                        <?php endif ?>
                    </div>
                    <?php
                    global $current_user;
                    $publications_type = get_categories(array('hide_empty' => false, 'orderby' => 'name', 'order' => 'ASC', 'parent' => 0));
                    foreach ($publications_type as $publication_type):
                        ?>
                        <div class="item">
                            <?php if (is_post_type_archive("alerts_cpt") || is_singular("alerts_cpt") || $pub_type == "alerts"): ?>
                                <a class="<?php if (get_category(get_query_var('cat'))->term_id == $publication_type->term_id): ?>title<?php else: ?>header<?php endif ?>" href="<?php echo esc_url(add_query_arg(array('publication-type' => "alerts"), wp_make_link_relative(esc_url(get_category_link($publication_type->term_id))))) ?>">
                                    <?php echo __($publication_type->name, "booksharedomain"); ?>
                                </a>
                            <?php else: ?>
                                <a class="<?php if (get_category(get_query_var('cat'))->term_id == $publication_type->term_id): ?>title<?php else: ?>header<?php endif ?>" href="<?php echo wp_make_link_relative(esc_url(get_category_link($publication_type->term_id))) ?>">
                                    <?php echo __($publication_type->name, "booksharedomain"); ?>
                                </a>
                            <?php endif ?>
                        </div>
                    <?php endforeach ?>  
                </div>
            </div>
            <div class="item">
                <a class="title header">
                    <i class="dropdown icon"></i>
                    <?php echo __("CLASSES", "booksharedomain"); ?>
                </a>
                <div class="content <?php //if (cat_is_ancestor_of(get_category_by_slug(__('textbooks', 'booksharedomain'))->term_id, get_category(get_query_var('cat'))->term_id)):        ?> <?php //endif        ?> menu">
                    <?php
                    $publications_level = get_categories(array('hide_empty' => false, 'orderby' => 'name', 'order' => 'ASC', 'parent' => get_category_by_slug(__('textbooks', 'booksharedomain'))->term_id));
                    foreach ($publications_level as $publication_level):
                        ?>
                        <span class="header" style="text-transform: uppercase; margin-left: 4px;"><?php echo $publication_level->name; ?></span>
                        <?php
                        $publications_class = get_categories(array('hide_empty' => false, 'orderby' => 'slug', 'order' => 'ASC', 'parent' => $publication_level->term_id));
                        foreach ($publications_class as $publication_class):
                            $publication_class_opp_lang = get_category(getTranslateTermInOppositeLanguage($publication_class->term_id));
                            ?>
                            <div class="item">
                                <?php if (is_post_type_archive("alerts_cpt") || is_singular("alerts_cpt") || $pub_type == "alerts"): ?>
                                    <a class="<?php if (get_category(get_query_var('cat'))->term_id == $publication_class->term_id): ?>title<?php else: ?>header<?php endif ?>" href="<?php echo esc_url(add_query_arg(array('publication-type' => "alerts"), wp_make_link_relative(esc_url(get_category_link($publication_class->term_id))))) ?>">
                                        <?php echo $publication_class->name; ?>
                                    </a> | <a class="<?php if (get_category(get_query_var('cat'))->term_id == $publication_class_opp_lang->term_id): ?>title<?php else: ?>header<?php endif ?>" href="<?php echo esc_url(add_query_arg(array('publication-type' => "alerts"), wp_make_link_relative(esc_url(get_category_link($publication_class_opp_lang->term_id))))) ?>">
                                        <?php echo $publication_class_opp_lang->name; ?>
                                    </a>
                                <?php else: ?>
                                    <a class="<?php if (get_category(get_query_var('cat'))->term_id == $publication_class->term_id): ?>title<?php else: ?>header<?php endif ?>" href="<?php echo wp_make_link_relative(esc_url(get_category_link($publication_class->term_id))) ?>">
                                        <?php echo $publication_class->name; ?>
                                    </a> | <a class="<?php if (get_category(get_query_var('cat'))->term_id == $publication_class_opp_lang->term_id): ?>title<?php else: ?>header<?php endif ?>" href="<?php echo wp_make_link_relative(esc_url(get_category_link($publication_class_opp_lang->term_id))) ?>">
                                        <?php echo $publication_class_opp_lang->name; ?>
                                    </a>
                                <?php endif ?>
                            </div>
                        <?php endforeach ?>
                    <?php endforeach ?>
                </div>
            </div>
            <div class="item">
                <a class="title header">
                    <i class="dropdown icon"></i>
                    <?php echo __("BOOK STATES", "booksharedomain"); ?>
                </a>
                <div class="content <?php if (is_tax("publication_state")): ?> active <?php endif ?> menu">
                    <?php
                    $publications_state = get_terms(array('taxonomy' => 'publication_state', 'hide_empty' => false, 'orderby' => 'name', 'order' => 'ASC'));
                    foreach ($publications_state as $publication_state):
                        ?>
                        <div class="item">
                            <?php if (is_post_type_archive("alerts_cpt") || is_singular("alerts_cpt") || $pub_type == "alerts"): ?>
                                <a class="<?php if (get_queried_object_id() == $publication_state->term_id): ?>title<?php else: ?>header<?php endif ?>" href="<?php echo esc_url(add_query_arg(array('publication-type' => "alerts"), wp_make_link_relative(esc_url(get_term_link($publication_state->term_id))))) ?>">
                                    <?php echo __($publication_state->name, "booksharedomain"); ?>
                                </a>
                            <?php else: ?>
                                <a class="<?php if (get_queried_object_id() == $publication_state->term_id): ?>title<?php else: ?>header<?php endif ?>" href="<?php echo wp_make_link_relative(esc_url(get_term_link($publication_state->term_id))) ?>">
                                    <?php echo __($publication_state->name, "booksharedomain"); ?>
                                </a>
                            <?php endif ?>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
            <div class="item">
                <a class="title header">
                    <i class="dropdown icon"></i>
                    <?php echo __("SALE OPTIONS", "booksharedomain"); ?>
                </a>
                <div class="content <?php if (is_tax("publication_option")): ?> active <?php endif ?> menu">
                    <?php
                    $publications_option = get_terms(array('taxonomy' => 'publication_option', 'hide_empty' => false, 'orderby' => 'name', 'order' => 'ASC'));
                    foreach ($publications_option as $publication_option):
                        ?>
                        <div class="item">
                            <?php if (is_post_type_archive("alerts_cpt") || is_singular("alerts_cpt") || $pub_type == "alerts"): ?>
                                <a class="<?php if (get_queried_object_id() == $publication_option->term_id): ?>title<?php else: ?>header<?php endif ?>" href="<?php echo esc_url(add_query_arg(array('publication-type' => "alerts"), wp_make_link_relative(esc_url(get_term_link($publication_option->term_id))))) ?>">
                                    <?php echo __($publication_option->name, "booksharedomain"); ?>
                                </a>
                            <?php else: ?>
                                <a class="<?php if (get_queried_object_id() == $publication_option->term_id): ?>title<?php else: ?>header<?php endif ?>" href="<?php echo wp_make_link_relative(esc_url(get_term_link($publication_option->term_id))) ?>">
                                    <?php echo __($publication_option->name, "booksharedomain"); ?>
                                </a>
                            <?php endif ?>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
</div>