<?php
if (is_tax()) :
  if ($paged > 1) :
    header('Location: ' . '/page_cat/' . $term . '/', true, 301);
    exit;
  endif;
endif;
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
  <meta name="format-detection" content="telephone=no">

  <title><?php echo esc_html(wp_get_document_title()); ?></title>
  <?php wp_head(); ?>

</head>
<?php
$id = '';
$current_path = $_SERVER['REQUEST_URI'];
if (strpos($current_path, '/about/') !== false) {
  $id = 'floating-on';
}
$extra_class = '';
if (strpos($current_path, '/flow/') !== false) {
  $extra_class = 'page-flow';
}
?>
<body class="home blog <?php echo htmlspecialchars($extra_class, ENT_QUOTES, 'UTF-8'); ?> <?= function_exists('get_tax_class') ? get_tax_class() : ''; ?>" id="<?php echo htmlspecialchars($id, ENT_QUOTES, 'UTF-8'); ?>">

  <header>
    <div class="header-description">
      <h1><?php echo function_exists('uketa_the_h1') ? uketa_the_h1() : 'Autorisation électronique de voyage (ETA) pour le Royaume-Uni'; ?></h1>
    </div>

    <div class="header-wrapper">
      <div class="header-logo">
        <a href="<?php echo esc_url(home_url('/')); ?>">
          <picture>
            <source media="(max-width: 767px)" srcset="<?= function_exists('get_img_dir') ? get_img_dir() : get_template_directory_uri() . '/assets/images/'; ?>logo/logo-text-sp.svg">
            <img src="<?= function_exists('get_img_dir') ? get_img_dir() : get_template_directory_uri() . '/assets/images/'; ?>logo/logo-text.svg" alt="<?php bloginfo('name'); ?>" aria-label="<?php bloginfo('name'); ?>">
          </picture>
        </a>
      </div>
      <div class="pc-only header-btn">
        <?php echo function_exists('get_cta_btn') ? get_cta_btn() : ''; ?>
      </div>

      <a id="sp-menu-btn" href="#" class="menu sp-only">
        <i class="icon icon-menu"></i>
        <span>Menu</span>
      </a>
    </div>

  </header>
  <?php get_template_part('parts/global-nav'); ?>
