<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <!-- Google Tag Manager -->
  <!-- <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-P688SJQ2');</script> -->
  <!-- End Google Tag Manager -->
  <title><?php wp_title(); ?></title>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes" />
  <link rel="apple-touch-icon" sizes="180x180" href="<?= get_template_directory_uri() ?>/assets/icons/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?= get_template_directory_uri() ?>/assets/icons/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?= get_template_directory_uri() ?>/assets/icons/favicon-16x16.png">
  <meta name="author" content="DM">
  <meta name="mobile-web-app-capable" content="yes">
  <meta name="application-name" content="<?php bloginfo('name'); ?>">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <meta name="apple-mobile-web-app-title" content="<?php bloginfo('charset'); ?>">
  <link rel="apple-touch-icon" sizes="180x180" href="<?= get_template_directory_uri() ?>/assets/icons/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?= get_template_directory_uri() ?>/assets/icons/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?= get_template_directory_uri() ?>/assets/icons/favicon-16x16.png">
  <link rel="manifest" href="<?= get_template_directory_uri() ?>/manifest.json">
  <link rel="mask-icon" href="<?= get_template_directory_uri() ?>/assets/icons/safari-favicon.svg" color="#000000">
  <link rel="shortcut icon" href="<?= get_template_directory_uri() ?>/assets/icons/favicon.ico">
  <meta name="theme-color" content="#ffffff">
<link 
  rel="preload"
  href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
  as="style"
  onload="this.onload=null;this.rel='stylesheet'"
  integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
  crossorigin=""
/>
<noscript>
  <link 
    rel="stylesheet"
    href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
    crossorigin=""
  />
</noscript>
  <!-- Make sure you put this AFTER Leaflet's CSS -->
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" defer integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="crossorigin=""></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">


  <?php

  // echo wp_get_environment_type(); 
  $is_dev = wp_get_environment_type() === 'development';

  if ($is_dev) : ?>
    <!-- Vite dev server client for HMR and full-reload -->
    <script type="module" src="https://wordpress-starter.loc:5173/@vite/client"></script>
    <!-- Your main app.js -->
    <script type="module" src="https://wordpress-starter.loc:5173/resources/js/app.js"></script>
  <?php else : ?>
    <?= vite('resources/js/app.js') ?> <!-- production build -->
  <?php endif; ?>


  <style>
    [v-cloak] {
      display: none;
    }
  </style>
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <!-- Google Tag Manager (noscript) -->
  <!-- <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P688SJQ2"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript> -->
  <!-- End Google Tag Manager (noscript) -->
  <div id="app" v-cloak>
    <a class="sr-only" href="#content"><?php esc_html_e('Skip to content', 'dm'); ?></a>

    <sticky-nav class="z-30">
      <nav class="px-6 w-full lg:w-10/12 max-w-screen-2xl mx-auto flex justify-between gap-4 xl:gap-8 py-3 items-center">
        <a class="logo transition duration-500 justify-between hidden items-start max-w-[200px] lg:max-w-full relative z-[70] block " href="/" title="Simon Community">
          <logo-dark class="w-[100px] lg:w-[135px]"></logo-dark>
        </a>
        <?php if (have_rows('navigation', 'option')): ?>
          <div class="menu flex font-informa text-base lg:text-lg justify-between rounded-full bg-transparent items-center xl:h-[50px] z-[60]">
            <ul class="flex gap-6 items-center font-informa font-medium xl:px-6 2xl:px-8 h-full text-base 2xl:text-lg">
              <?php while (have_rows('navigation', 'option')) : the_row();
                $top_level_link = get_sub_field('top_level_link');
                $highlight_link = get_sub_field('highlight_link');
                if ($top_level_link):
                  $link_url = $top_level_link['url'];
                  $link_title = $top_level_link['title'];
                  $link_target = $top_level_link['target'] ? $top_level_link['target'] : '_self';
                  $link_title_safe = strtolower($link_title);
                  $link_title_safe = str_replace(" ", "-", $link_title_safe);
              ?>
                  <li class="group">
                    <?php if ($highlight_link) : ?>
                      <a class="flex items-center gap-2 group font-extrabold font-informa uppercase highlights text-base lg:text-xl" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>" title="View <?php echo esc_html($link_title); ?> "><?php echo esc_html($link_title); ?></a>
                    <?php endif; ?>
                  </li>
                <?php endif; ?>
              <?php endwhile; ?>
            </ul>

            <div class="flex ml-2">
              <button id="menuBtn" aria-label="Open Menu" title="Open Menu" class="h-[50px] p-[10px] inline-flex items-center justify-center rounded-full mobile-menu">
                <span class="sr-only">Open main menu</span>
                <svg id="menu-open" class="h-[30px] w-[30px] stroke-black hover:stroke-red transition-all duration-300 ease-in-out" width="50" height="24" viewBox="0 0 50 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <line x1="1.74846e-07" y1="2" x2="50" y2="2" stroke="currentColor" stroke-width="4" />
                  <line x1="1.74846e-07" y1="12" x2="50" y2="12" stroke="currentColor" stroke-width="4" />
                  <line x1="1.74846e-07" y1="22" x2="50" y2="22" stroke="currentColor" stroke-width="4" />
                </svg>

                <svg width="54" height="24" viewBox="0 0 54 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="hidden h-[30px] w-[30px]" id="menu-close">
                  <line x1="2.74278" y1="2.14305" x2="52.7428" y2="22.143" stroke="currentColor" stroke-width="4" />
                  <line x1="1.25722" y1="22.143" x2="51.2572" y2="2.14305" stroke="currentColor" stroke-width="4" />
                </svg>
              </button>
            </div>
          </div>
        <?php endif; ?>
      </nav>
    </sticky-nav>

    <!-- Slide-Down Menu -->
    <div id="menu" class="fixed top-[110px] left-0 w-full transform -translate-y-full transition-transform duration-500 z-50 flex-col overflow-hidden bg-[#000000] shadow-lg overflow-y-auto hidden px-6 h-3/4">

      <!-- Mobile Panel Wrapper -->
      <div id="mobile-panel-wrapper" class="relative w-full h-full lg:hidden overflow-hidden">
        <!-- Level 0: Main Navigation -->
        <div class="mobile-panel absolute top-0 left-0 w-full h-full overflow-y-auto bg-[#000000] translate-x-0 transition-transform duration-300" data-panel-level="0">
          <div class="space-y-0 py-6">
            <?php if (have_rows('navigation', 'option')): ?>
              <?php while (have_rows('navigation', 'option')): the_row();
                $top_link = get_sub_field('top_level_link');
                $sub_links = get_sub_field('sub_links');
                $has_children = $sub_links && count($sub_links) > 0;
                $panel_id = sanitize_title($top_link['title']);
              ?>
                <?php if ($has_children): ?>
                  <button class="mobile-trigger w-full text-left flex items-center justify-between text-lg font-informa font-semibold uppercase border-b border-b-[#FFFFFF33] py-4 px-0 opacity-80 hover:opacity-100 transition-opacity" data-next-panel="level1-<?php echo $panel_id; ?>">
                    <span><?php echo esc_html($top_link['title']); ?></span>
                    <span>
                      <arrow class="nav-arrow"></arrow>
                    </span>
                  </button>
                <?php else: ?>
                  <a href="<?php echo esc_url($top_link['url']); ?>" target="<?php echo esc_attr($top_link['target'] ?: '_self'); ?>" class="w-full text-left block text-lg font-informa font-semibold uppercase border-b border-b-[#FFFFFF33] py-4 px-0 opacity-80 hover:opacity-100 transition-opacity">
                    <?php echo esc_html($top_link['title']); ?>
                  </a>
                <?php endif; ?>
              <?php endwhile; ?>
            <?php endif; ?>
          </div>
        </div>

        <!-- Level 1: Sub Links -->
        <?php if (have_rows('navigation', 'option')): ?>
          <?php while (have_rows('navigation', 'option')): the_row();
            $top_link = get_sub_field('top_level_link');
            $sub_links = get_sub_field('sub_links');
            $panel_id = sanitize_title($top_link['title']);

            if (!$sub_links) continue;
          ?>
            <div class="mobile-panel absolute top-0 left-0 w-full h-full overflow-y-auto bg-[#000000] translate-x-full transition-transform duration-300" data-panel-level="1" data-panel-id="level1-<?php echo $panel_id; ?>">
              <!-- Back Button -->
              <button class="mobile-back w-full text-left flex items-center gap-2 text-sm font-informa font-medium border-b border-b-[#FFFFFF33] py-4 px-0 opacity-80 hover:opacity-100 transition-opacity">
                <span class="rotate-180">
                  <arrow class="nav-arrow text-black"></arrow>
                </span>
                <span class="font-informa font-semibold">Back</span>
              </button>

              <!-- Links -->
              <div class="space-y-0 py-6">
                <?php foreach ($sub_links as $sub): ?>
                  <?php if ($sub['links']): ?>
                    <?php foreach ($sub['links'] as $link): ?>
                      <?php
                      $link_url = $link['link']['url'];
                      $link_title = $link['link']['title'];
                      $third_level_links = $link['third_level_links'] ?? array();
                      $has_third_level = !empty($third_level_links);
                      $sub_panel_id = sanitize_title($link_title);
                      ?>
                      <?php if ($has_third_level): ?>
                        <button class="mobile-trigger w-full text-left flex items-center justify-between text-lg font-informa font-semibold uppercase border-b border-b-[#FFFFFF33] py-4 px-0 opacity-80 hover:opacity-100 transition-opacity" data-next-panel="level2-<?php echo $panel_id; ?>-<?php echo $sub_panel_id; ?>">
                          <span><?php echo esc_html($link_title); ?></span>
                          <span>
                            <arrow class="nav-arrow"></arrow>
                          </span>
                        </button>
                      <?php else: ?>
                        <a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link['link']['target'] ?: '_self'); ?>" class="w-full text-left block text-lg font-informa font-semibold uppercase border-b border-b-[#FFFFFF33] py-4 px-0 opacity-80 hover:opacity-100 transition-opacity">
                          <?php echo esc_html($link_title); ?>
                        </a>
                      <?php endif; ?>
                    <?php endforeach; ?>
                  <?php endif; ?>
                <?php endforeach; ?>
              </div>
            </div>
          <?php endwhile; ?>
        <?php endif; ?>

        <!-- Level 2: Third Level Links -->
        <?php if (have_rows('navigation', 'option')): ?>
          <?php while (have_rows('navigation', 'option')): the_row();
            $top_link = get_sub_field('top_level_link');
            $sub_links = get_sub_field('sub_links');
            $panel_id = sanitize_title($top_link['title']);

            if (!$sub_links) continue;

            foreach ($sub_links as $sub):
              if (!$sub['links']) continue;
              foreach ($sub['links'] as $link):
                $link_title = $link['link']['title'];
                $third_level_links = $link['third_level_links'] ?? array();
                $has_third_level = !empty($third_level_links);
                $sub_panel_id = sanitize_title($link_title);

                if ($has_third_level):
          ?>
                  <div class="mobile-panel absolute top-0 left-0 w-full h-full overflow-y-auto bg-[#000000] translate-x-full transition-transform duration-300" data-panel-level="2" data-panel-id="level2-<?php echo $panel_id; ?>-<?php echo $sub_panel_id; ?>">
                    <!-- Back Button -->
                    <button class="mobile-back w-full text-left flex items-center gap-2 text-sm font-informa font-medium border-b border-b-[#FFFFFF33] py-4 px-0 opacity-80 hover:opacity-100 transition-opacity">
                      <span class="rotate-180">
                        <arrow class="nav-arrow text-white"></arrow>
                      </span>
                      <span class="font-informa font-semibold">Back</span>
                    </button>

                    <!-- Links -->
                    <div class="space-y-0 py-6">
                      <?php foreach ($third_level_links as $third_link): ?>
                        <?php $third_url = $third_link['link']['url'] ?? ''; ?>
                        <?php $third_title = $third_link['link']['title'] ?? ''; ?>
                        <?php if ($third_url): ?>
                          <a href="<?php echo esc_url($third_url); ?>" target="<?php echo esc_attr($third_link['link']['target'] ?: '_self'); ?>" class="w-full text-left block text-lg font-informa font-semibold uppercase border-b border-b-[#FFFFFF33] py-4 px-0 opacity-80 hover:opacity-100 transition-opacity">
                            <?php echo esc_html($third_title); ?>
                          </a>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </div>
                  </div>
          <?php
                endif;
              endforeach;
            endforeach;
          endwhile; ?>
        <?php endif; ?>
      </div>

      <!-- Desktop Panel Wrapper -->
      <div id="panel-wrapper" class="relative w-full h-full overflow-y-auto overflow-x-hidden px-6 lg:w-10/12 max-w-screen-2xl mx-auto hidden lg:block">
        <?php if (have_rows('navigation', 'option')): ?>
          <?php
          $level = 0;
          $panel_stack = [];
          $first_item = true;

          while (have_rows('navigation', 'option')): the_row();
            $top_level_link = get_sub_field('top_level_link');
            $sublinks = get_sub_field('sub_links');
            $panel_id = sanitize_title($top_level_link['title']);
            $panel_stack[] = $panel_id;
            $first_item = false;
          endwhile;

          reset_rows('navigation', 'option');
          $first_item = true;
          ?>

          <!-- Main Panel -->
          <div class="main-panel absolute transition-transform duration-300 space-y-6 bg-[#000000] w-full left-0 top-0 h-full translate-x-0 z-20 grid lg:grid-cols-3" data-level="0">
            <div class="lg:border-r lg:border-r-[#FFFFFF33] py-20">
              <?php while (have_rows('navigation', 'option')): the_row();
                $top_link = get_sub_field('top_level_link');
                $sub_links = get_sub_field('sub_links');
                $has_children = $sub_links && count($sub_links) > 0;
                $panel_id = sanitize_title($top_link['title']);
                $is_first_with_children = $first_item && $has_children;
              ?>

                <?php if ($has_children): ?>
                  <button class="flex items-center justify-between text-lg font-informa w-full font-semibold uppercase cursor-pointer border-b border-b-[#FFFFFF33] py-4 !mt-0 pr-6 <?php echo $is_first_with_children ? 'lg:opacity-100 lg:border-r-red' : 'lg:opacity-60 lg:hover:opacity-100 lg:border-r-[#000000] lg:hover:border-r-red opacity-60 hover:opacity-100 border-r-[#000000] hover:border-r-red'; ?> border-r-8" data-target-panel="<?php echo $panel_id; ?>" aria-expanded="<?php echo $is_first_with_children ? 'true' : 'false'; ?>" <?php echo $is_first_with_children ? 'data-default-open="true"' : ''; ?>>
                    <span><?php echo esc_html($top_link['title']); ?></span>
                    <span>
                      <arrow class="nav-arrow"></arrow>
                    </span>
                  </button>
                <?php else: ?>
                  <a href="<?php echo esc_url($top_link['url']); ?>" target="<?php echo esc_attr($top_link['target'] ?: '_self'); ?>" class="flex items-center gap-2 font-informa text-lg uppercase border-b border-b-[#FFFFFF33] py-4 font-semibold !mt-0 justify-between opacity-60 hover:opacity-100 border-r-8 border-r-[#000000] hover:border-r-red"><?php echo esc_html($top_link['title']); ?></a>
                <?php endif; ?>
                <?php $first_item = false; ?>
              <?php endwhile; ?>
            </div>
            <div id="hover-area" class="grid w-full lg:grid-cols-2 lg:col-span-2 !mt-0">
              <div id="middle-column" class="lg:border-r lg:border-r-[#FFFFFF33] py-20 !mt-0">
                <!-- Sub Panels -->
                <?php reset_rows('navigation', 'option'); ?>
                <?php
                $first_item = true;
                while (have_rows('navigation', 'option')): the_row();
                  $top_link = get_sub_field('top_level_link');
                  $sub_links = get_sub_field('sub_links');
                  $panel_id = sanitize_title($top_link['title']);
                  $is_first_with_children = $first_item && $sub_links && count($sub_links) > 0;

                  if (!$sub_links) {
                    $first_item = false;
                    continue;
                  }
                ?>
                  <div class="menu-panel relative duration-300 flex-col space-y-4 bg-[#000000] w-full h-full pl-6 lg:pl-12 z-40 <?php echo $is_first_with_children ? 'lg:flex hidden' : 'hidden'; ?>" id="<?php echo $panel_id; ?>" <?php echo $is_first_with_children ? 'data-default-open="true"' : ''; ?>>

                    <?php foreach ($sub_links as $sub): ?>
                      <?php if ($sub['links']): ?>
                        <?php foreach ($sub['links'] as $link): ?>
                          <?php
                          $link_url = $link['link']['url'];
                          $thumbnail = '';
                          $excerpt = '';

                          $path = trim(parse_url($link_url, PHP_URL_PATH), '/');
                          $post_obj = get_page_by_path($path, OBJECT, ['post', 'page']);

                          if ($post_obj) {
                            $link_id = $post_obj->ID;
                            $thumbnail = get_the_post_thumbnail_url($link_id, 'large') ?: '';
                            $excerpt = get_post_field('post_excerpt', $link_id) ?: '';
                          }

                          $third_level_links = $link['third_level_links'] ?? array();
                          $children_html = '';

                          if (!empty($third_level_links)) {
                            $children_html = '<div class="space-y-4">';
                            foreach ($third_level_links as $third_link) {
                              $third_url = $third_link['link']['url'] ?? '';
                              $third_title = $third_link['link']['title'] ?? '';
                              $third_target = $third_link['link']['target'] ?? '_self';

                              if ($third_url) {
                                $children_html .= '<a href="' . esc_url($third_url) . '" target="' . esc_attr($third_target) . '" class="flex items-center gap-2 font-informa text-lg uppercase py-4 font-semibold !mt-0 justify-between opacity-60 hover:opacity-100 child-link">
                                  <span>' . esc_html($third_title) . '</span>
                                </a>';
                              }
                            }
                            $children_html .= '</div>';
                          }
                          ?>
                          <?php if (!empty($third_level_links)): ?>
                            <span
                              data-id="<?php echo esc_attr($link_id ?: sanitize_title($link['link']['title'])); ?>"
                              data-excerpt="<?php echo esc_attr($excerpt); ?>"
                              data-thumbnail="<?php echo esc_url($thumbnail); ?>"
                              data-link-id="<?php echo esc_attr($link_id); ?>"
                              data-show-children="true"
                              data-children="<?php echo esc_attr($children_html); ?>"
                              class="sub-link flex items-center gap-2 font-informa text-lg uppercase py-4 font-semibold !mt-0 justify-between opacity-60 hover:opacity-100 border-r-8 border-r-[#000000] hover:border-r-red pr-10">
                              <span><?php echo esc_html($link['link']['title']); ?></span>
                            </span>
                          <?php else: ?>

                            data-id="<?php echo esc_attr($link_id ?: sanitize_title($link['link']['title'])); ?>"
                            data-excerpt="<?php echo esc_attr($excerpt); ?>"
                            data-thumbnail="<?php echo esc_url($thumbnail); ?>"
                            data-link-id="<?php echo esc_attr($link_id); ?>"
                            data-show-children="false"
                            href="<?php echo esc_url($link['link']['url']); ?>"
                            target="<?php echo esc_attr($link['link']['target'] ?: '_self'); ?>"
                            class="sub-link flex items-center gap-2 font-informa text-lg uppercase py-4 font-semibold !mt-0 justify-between opacity-60 hover:opacity-100 border-r-8 border-r-[#000000] hover:border-r-red pr-10">
                            <span><?php echo esc_html($link['link']['title']); ?></span>
                            </a>
                          <?php endif; ?>
                        <?php endforeach; ?>
                      <?php endif; ?>
                    <?php endforeach; ?>
                  </div>
                  <?php $first_item = false; ?>
                <?php endwhile; ?>
              </div>
              <div id="hover-info" class="py-20 bg-[#FFFFFF1A] px-10 !mt-0 font-informa hidden lg:flex"></div>
            </div>
          </div>
        <?php endif; ?>
      </div>
    </div>

    <div id="content"></div>