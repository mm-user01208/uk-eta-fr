<?php
/**
 * Assets enqueue
 */
function mytheme_enqueue_assets() {
  $theme_uri = get_template_directory_uri();
  $theme_dir = get_template_directory();

  // =========================
  // CSS paths（実ファイル名に合わせて変更）
  // =========================
  $css_style = $theme_uri . '/assets/css/style.css';
  $css_top   = $theme_uri . '/assets/css/top.css';
  $css_news  = $theme_uri . '/assets/css/news.css';
  $css_page  = $theme_uri . '/assets/css/page.css';

  // filemtimeでキャッシュ対策（存在しないときはnull）
  $ver_style = file_exists($theme_dir . '/assets/css/style.css')
    ? filemtime($theme_dir . '/assets/css/style.css')
    : null;
  $ver_top = file_exists($theme_dir . '/assets/css/top.css')
    ? filemtime($theme_dir . '/assets/css/top.css')
    : null;
  $ver_news = file_exists($theme_dir . '/assets/css/news.css')
    ? filemtime($theme_dir . '/assets/css/news.css')
    : null;
  $ver_page = file_exists($theme_dir . '/assets/css/page.css')
    ? filemtime($theme_dir . '/assets/css/page.css')
    : null;

  // =========================
  // WPらしい判定（/top, /news の置き換え）
  // =========================
  // /top 相当：フロントページ or 固定ページ top
  $is_top = is_front_page() || is_page('top');

  // /news 相当：
  // 1) カスタム投稿タイプ news を想定（最もWPらしい）
  $is_news = is_post_type_archive('news') || is_singular('news');

  // もし「/news が通常投稿（ブログ）」なら、↑をやめて下に差し替え
  // $is_news = is_home() || is_archive() || is_single();

  // =========================
  // /united-kingdom/top だけ page.css を除外（WPらしく）
  // =========================
  $exclude_page_css = false;
  $obj = get_queried_object();

  if ($obj && isset($obj->post_type) && $obj->post_type === 'page') {
    // 階層を含むページURI（例: united-kingdom/top）
    $path = trim(get_page_uri($obj->ID), '/');
    if ($path === 'united-kingdom/top') {
      $exclude_page_css = true;
    }
  }

  // =========================
  // CSS enqueue（常時）
  // =========================
  wp_enqueue_style('my-style', $css_style, [], $ver_style);
  wp_enqueue_style('my-top', $css_top, [], $ver_top);

  // ニュース系CSS（news のときだけ）
  if ($is_news) {
    wp_enqueue_style('my-news', $css_news, [], $ver_news);
  }

  // 一般ページCSS（トップと除外ページ以外）
  if (!$is_top && !$exclude_page_css) {
    wp_enqueue_style('my-page', $css_page, [], $ver_page);
  }

  // =========================
  // JS enqueue（画像の4本）
  // =========================
  $js_details_polyfill = $theme_uri . '/assets/js/details-polyfill.js';
  $js_waypoints        = $theme_uri . '/assets/js/jquery.waypoints.min.js';
  $js_lazyload         = $theme_uri . '/assets/js/lazyload.min.js';
  $js_app              = $theme_uri . '/assets/js/app.js';

  $ver_details_polyfill = file_exists($theme_dir . '/assets/js/details-polyfill.js')
    ? filemtime($theme_dir . '/assets/js/details-polyfill.js')
    : null;
  $ver_waypoints = file_exists($theme_dir . '/assets/js/jquery.waypoints.min.js')
    ? filemtime($theme_dir . '/assets/js/jquery.waypoints.min.js')
    : null;
  $ver_lazyload = file_exists($theme_dir . '/assets/js/lazyload.min.js')
    ? filemtime($theme_dir . '/assets/js/lazyload.min.js')
    : null;
  $ver_app = file_exists($theme_dir . '/assets/js/app.js')
    ? filemtime($theme_dir . '/assets/js/app.js')
    : null;

  // 現行ブラウザでは details 要素が標準対応のため、トップでは不要。
  if (!$is_top) {
    wp_enqueue_script(
      'details-polyfill',
      $js_details_polyfill,
      [],
      $ver_details_polyfill,
      [
        'in_footer' => true,
        'strategy'  => 'defer',
      ]
    );
  }

  // waypoints（jQuery依存が一般的）
  wp_enqueue_script(
    'jquery-waypoints',
    $js_waypoints,
    ['jquery'],
    $ver_waypoints,
    [
      'in_footer' => true,
      'strategy'  => 'defer',
    ]
  );

  // トップの画像はネイティブ lazy-loading を使う。
  if (!$is_top) {
    wp_enqueue_script(
      'lazyload',
      $js_lazyload,
      [],
      $ver_lazyload,
      [
        'in_footer' => true,
        'strategy'  => 'defer',
      ]
    );
  }

  // app.js（あなたの中身次第：jQuery/waypointsに依存させる例）
  wp_enqueue_script(
    'app',
    $js_app,
    ['jquery', 'jquery-waypoints'],
    $ver_app,
    [
      'in_footer' => true,
      'strategy'  => 'defer',
    ]
  );
}
add_action('wp_enqueue_scripts', 'mytheme_enqueue_assets');
