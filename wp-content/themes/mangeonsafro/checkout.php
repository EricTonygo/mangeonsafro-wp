<?php

/*
  Template Name: Checkout Page
 */

wp_safe_redirect(get_permalink(get_page_by_path(__('checkout', 'mangeonsafrodomain') . "/" . __('single-address', 'mangeonsafrodomain'))->ID));
exit;
