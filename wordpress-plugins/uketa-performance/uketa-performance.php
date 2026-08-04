<?php
/**
 * Plugin Name: UK ETA Performance
 * Description: Optimises the UK ETA front page's critical rendering path, images, scripts, and static-asset caching.
 * Version: 1.1.0
 * Author: UK ETA Application Site
 */

if (!defined('ABSPATH')) {
  exit;
}

const UKETA_PERFORMANCE_VERSION = '1.1.0';

/**
 * Return a URL for an asset bundled with this plugin.
 */
function uketa_performance_asset_url($path = '') {
  return plugins_url(ltrim($path, '/'), __FILE__);
}

/**
 * Preload only the hero image matching the current viewport.
 */
function uketa_performance_preload_hero() {
  if (!is_front_page()) {
    return;
  }

  $mobile = uketa_performance_asset_url('assets/images/hero-mobile-900.webp');
  $desktop = uketa_performance_asset_url('assets/images/hero-desktop-1600.webp');
  ?>
  <link rel="preload" as="image" href="<?php echo esc_url($mobile); ?>" type="image/webp" media="(max-width: 500px)" fetchpriority="high">
  <link rel="preload" as="image" href="<?php echo esc_url($desktop); ?>" type="image/webp" media="(min-width: 501px)" fetchpriority="high">
  <?php
}
add_action('wp_head', 'uketa_performance_preload_hero', 2);

/**
 * Small structural overrides required by the HTML hero and font-free icons.
 */
function uketa_performance_print_overrides() {
  if (is_admin()) {
    return;
  }
  ?>
  <style id="uketa-performance-overrides">
    .kv{position:relative;isolation:isolate;overflow:hidden}
    .kv-bg{background-image:none!important}
    .kv-media{position:absolute;inset:0;z-index:-1;display:block}
    .kv-media img{width:100%;height:100%;max-width:none;object-fit:cover;object-position:10% center}
    summary::after,.question::after{width:9px!important;height:9px!important;border-right:2px solid currentColor;border-bottom:2px solid currentColor;content:""!important;font-family:inherit!important;transform:rotate(45deg);transform-origin:center}
    details[open] summary::after,.question.is-open::after{transform:rotate(225deg)}
    div#ez-toc-container .ez-toc-icon-toggle::before{content:"−"!important;font-family:inherit!important}
    div#ez-toc-container .on .ez-toc-icon-toggle::before{content:"+"!important}
    div#ez-toc-container li::before{content:"›"!important;font-family:inherit!important}
    @media(max-width:500px){.kv-media img{object-position:center bottom}}
  </style>
  <?php
}
add_action('wp_head', 'uketa_performance_print_overrides', 3);

/**
 * Keep jQuery out of the head and remove front-page-only unused assets.
 */
function uketa_performance_tune_front_assets() {
  if (!is_front_page()) {
    return;
  }

  wp_dequeue_style('my-news');
  wp_dequeue_style('my-page');
  wp_dequeue_script('details-polyfill');
  wp_dequeue_script('lazyload');

  // The front page uses a small vanilla-JS replacement below, so the legacy
  // jQuery/Waypoints/Modernizr bundle is not needed here.
  foreach (array('app', 'jquery-waypoints', 'jquery', 'jquery-core', 'jquery-migrate') as $handle) {
    wp_dequeue_script($handle);
  }
}
add_action('wp_enqueue_scripts', 'uketa_performance_tune_front_assets', 100);

/**
 * Use one accessible mobile-navigation controller on every page.
 *
 * The legacy app.js handlers no longer match the updated IDs/classes, which
 * avoids double toggles on lower pages while keeping the existing desktop and
 * footer behaviours intact.
 */
function uketa_performance_mobile_navigation() {
  if (is_admin()) {
    return;
  }
  ?>
  <script id="uketa-mobile-navigation">
    (function () {
      'use strict';

      function setPanel(trigger, panel, open) {
        if (!trigger || !panel) {
          return;
        }

        trigger.setAttribute('aria-expanded', open ? 'true' : 'false');
        panel.setAttribute('aria-hidden', open ? 'false' : 'true');
        panel.style.display = open ? 'block' : 'none';
      }

      function togglePanel(trigger, panel) {
        var open = trigger.getAttribute('aria-expanded') !== 'true';
        setPanel(trigger, panel, open);
        return open;
      }

      var menuButton = document.getElementById('uketa-sp-menu-btn');
      var mobileNav = document.getElementById('global-nav-sp');
      if (menuButton && mobileNav) {
        menuButton.addEventListener('click', function (event) {
          event.preventDefault();
          var open = togglePanel(menuButton, mobileNav);
          var icon = menuButton.querySelector('i');
          if (icon) {
            icon.classList.toggle('icon-menu', !open);
            icon.classList.toggle('icon-close', open);
          }
        });
      }

      var faqToggle = document.querySelector('#global-nav-sp .mobile-nav-toggle');
      var sectionList = document.getElementById('global-nav-sp-sections');
      if (faqToggle && sectionList) {
        faqToggle.addEventListener('click', function (event) {
          event.preventDefault();
          togglePanel(faqToggle, sectionList);
        });
      }

      document.querySelectorAll('#global-nav-sp .mobile-nav-section-toggle').forEach(function (trigger) {
        var panel = document.getElementById(trigger.getAttribute('aria-controls'));
        if (!panel) {
          return;
        }

        trigger.addEventListener('click', function () {
          togglePanel(trigger, panel);
        });
      });
    }());
  </script>
  <?php
}
add_action('wp_footer', 'uketa_performance_mobile_navigation', 19);

/**
 * Preserve the front-page interactions without the legacy jQuery bundle.
 */
function uketa_performance_front_interactions() {
  if (!is_front_page()) {
    return;
  }
  ?>
  <script id="uketa-front-interactions">
    (function () {
      'use strict';

      function toggleDisplay(element) {
        if (!element) {
          return false;
        }

        var willOpen = window.getComputedStyle(element).display === 'none';
        element.style.display = willOpen ? 'block' : 'none';
        return willOpen;
      }

      var desktopMore = document.querySelector('.global-nav.pc-only .global-nav-more');
      var desktopPanel = document.querySelector('.global-nav.pc-only .global-nav-expand');
      if (desktopMore && desktopPanel) {
        [desktopMore, desktopPanel].forEach(function (element) {
          element.addEventListener('mouseenter', function () {
            desktopPanel.style.display = 'block';
          });
          element.addEventListener('mouseleave', function () {
            desktopPanel.style.display = 'none';
          });
        });
      }

      document.querySelectorAll('footer .common-nav p i').forEach(function (icon) {
        icon.addEventListener('click', function (event) {
          event.preventDefault();
          toggleDisplay(icon.closest('p').nextElementSibling);
          icon.classList.toggle('icon-plus');
          icon.classList.toggle('icon-hyphen');
        });
      });

      document.querySelectorAll('.answer').forEach(function (answer) {
        answer.hidden = true;
      });

      document.querySelectorAll('.question').forEach(function (question) {
        question.addEventListener('click', function () {
          var answer = question.nextElementSibling;
          if (!answer || !answer.classList.contains('answer')) {
            return;
          }
          answer.hidden = !answer.hidden;
          question.classList.toggle('is-open', !answer.hidden);
        });
      });
    }());
  </script>
  <?php
}
add_action('wp_footer', 'uketa_performance_front_interactions', 20);

/**
 * Add long-lived browser caching for versioned static assets.
 */
function uketa_performance_install_cache_rules() {
  if (!function_exists('insert_with_markers')) {
    require_once ABSPATH . 'wp-admin/includes/misc.php';
  }

  $htaccess = ABSPATH . '.htaccess';
  if (!is_writable($htaccess)) {
    return;
  }

  $rules = array(
    '<IfModule mod_expires.c>',
    'ExpiresActive On',
    'ExpiresByType text/css "access plus 1 year"',
    'ExpiresByType application/javascript "access plus 1 year"',
    'ExpiresByType text/javascript "access plus 1 year"',
    'ExpiresByType image/avif "access plus 1 year"',
    'ExpiresByType image/webp "access plus 1 year"',
    'ExpiresByType image/svg+xml "access plus 1 year"',
    'ExpiresByType image/png "access plus 1 year"',
    'ExpiresByType image/jpeg "access plus 1 year"',
    'ExpiresByType font/woff2 "access plus 1 year"',
    '</IfModule>',
    '<IfModule mod_headers.c>',
    '<FilesMatch "\\.(?:css|js|avif|webp|svg|png|jpe?g|woff2)$">',
    'Header set Cache-Control "public, max-age=31536000, immutable"',
    '</FilesMatch>',
    '</IfModule>',
  );

  insert_with_markers($htaccess, 'UKETA Performance Cache', $rules);
}
register_activation_hook(__FILE__, 'uketa_performance_install_cache_rules');
