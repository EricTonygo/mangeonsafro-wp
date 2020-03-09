<div class="banner">
    <div class="banner_content ui container">
        <h1>
            Bookshare
        </h1>
        <h2>Le leader dans le deal du livre au Cameroun.</h2>
        <div id="card_banner_search" class="ui fluid card">
            <div class="content">
                <div class="ui action input">
                    <input type="text" placeholder="Find books...">
                    <select class="ui selection dropdown">
                        <option value="all">All</option>
                        <option selected="" value="">Types</option>
                        <option value="romans">Romans</option>
                        <option value="scolars manuals">Manuels scolaires</option>
                        <option value="dispo">Alertes disponibilités</option>
                    </select>
                    <button type="submit" class="ui primary button">Search</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="ui container">
    <div class="ui fluid card content_latest_publications">
        <div class="content title_latest_publications">
            <div class="header" >Lastest Publications</div>
        </div>
        <div class="content" style="border-top: none;">
            <?php
            global $current_user;
            $publications = new WP_Query(array('post_type' => 'publications_cpt', 'posts_per_page' => 8, "post_status" => 'publish', 'orderby' => 'post_date', 'order' => 'DESC'));
            if ($publications->have_posts()) {
                ?>
                <div class="ui four column doubling stackable grid list_latest_publications">
                    <?php
                    while ($publications->have_posts()): $publications->the_post();
                        $publication_thumbnail_image_id = get_post_meta(get_the_ID(), 'publication-thubmnail-image-id', true);
                        ?>
                        <div class="column">
                            <div class="ui fluid card publication_card">
                                <div class="content content_publication_image">
                                    <!--                                        <div class="image as_icon" style="text-align: center">
                                                                                <i class="huge icons">
                                                                                    <i class="big thin circle icon"></i>
                                                                                    <i class="book icon"></i>
                                                                                </i>
                                                                            </div>-->
                                    <div class="image as_background" style="background-image: url(<?php if ($publication_thumbnail_image_id): ?> <?php echo wp_make_link_relative(wp_get_attachment_url($publication_thumbnail_image_id)); ?> <?php else: ?> <?php echo wp_make_link_relative(get_template_directory_uri()); ?>/assets/images/book.png <?php endif ?>)">

                                    </div>
                                </div>
                                <div class="content publication_infos">

                                    <a class="header" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>                                
                                    <div class="meta">
                                        <?php echo human_time_diff(get_the_time('U'), current_time('timestamp')); ?> <?php _e("ago", "booksharedomain"); ?> <?php _e("by", "booksharedomain"); ?> <?php echo get_the_author_meta('user_login'); ?></span>
                                    </div>

                                </div>
                                <div class="extra content">
                                    <span>
                                        <?php
                                        $publications_option = wp_get_post_terms(get_the_ID(), 'publication_option', array("fields" => "names"));
                                        foreach ($publications_option as $publication_option):
                                            ?>
                                            #<?php echo __($publication_option, "gpdealdomain"); ?>
                                        <?php endforeach ?>
                                    </span>
                                    <?php if (get_post_meta(get_the_ID(), 'publication-city', true)): ?>
                                        <span><i class="marker icon" style="margin-right: 0;"></i><?php echo get_post_meta(get_the_ID(), 'publication-city', true); ?></span>
                                    <?php endif ?>
                                    <a class="right floated star">
                                        <i class="large remove bookmark icon" title="Save"></i>
                                    </a>
                                    <a class="right floated star"  title="Share">
                                        <i class="large share alternate icon"></i>
                                    </a>

                                </div>
                            </div>
                        </div>
                        <?php
                    endwhile;
                    ?>
                </div>
                <?php
            }
            wp_reset_postdata();
            ?>
        </div>
        <div class="content footer_latest_publications" style="border-top: none;">
            <a class="ui basic blue button"><?php _e("More publications", "booksharedomain"); ?>...</a>
        </div>
    </div>
</div>