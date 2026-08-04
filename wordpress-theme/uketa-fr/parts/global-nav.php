<?php
$eta_nav_items = [
  ['href' => home_url('/'), 'label' => 'ETA Royaume-Uni'],
  ['href' => home_url('/entry/'), 'label' => "Demander l'ETA"],
  ['href' => home_url('/status/'), 'label' => 'Vérifier la demande'],
  ['href' => home_url('/contact/'), 'label' => 'Contact'],
  ['href' => '#global-nav-sp-sections', 'label' => 'FAQ', 'is_more' => true],
];

// Dynamic header sections from page_cat taxonomy.
$header_sections = [];
$terms = get_terms([
  'taxonomy' => 'page_cat',
  'hide_empty' => false,
  'orderby' => 'term_id',
]);

if (!is_wp_error($terms)) {
  foreach ($terms as $term) {
    $header_sections[] = [
      'title' => $term->name,
      'slug' => $term->slug,
      'links' => ($term->slug === 'uketa')
        ? [['href' => home_url('/'), 'label' => 'ETA Royaume-Uni']]
        : [],
      'taxonomy' => 'page_cat',
    ];
  }
}

if (function_exists('build_nav_sections_links')) {
  $header_sections = build_nav_sections_links($header_sections, 'header');
}
?>

<!-- PC Nav -->
<nav class="global-nav pc-only">
  <ul class="global-nav-main">
    <?php foreach ($eta_nav_items as $item): ?>
      <?php if (!empty($item['sp_only'])) continue; ?>
      <li<?= !empty($item['is_more']) ? ' class="global-nav-more"' : '' ?>>
        <a href="<?= esc_url($item['href']) ?>">
          <?= esc_html($item['label']) ?>
          <?php if (!empty($item['is_more'])): ?>
            <i class="icon icon-bottomarrow"></i>
          <?php endif; ?>
        </a>
      </li>
    <?php endforeach; ?>
  </ul>

  <div class="global-nav-expand">
    <div class="common-nav">
      <?php foreach ($header_sections as $sec): ?>
        <section class="pc-only">
          <h2>
            <a href="<?= esc_url(home_url('/page_cat/' . $sec['slug'] . '/')) ?>">
              <?= esc_html($sec['title']) ?>
            </a>
            <i class="icon icon-minus"></i>
          </h2>
          <ul>
            <?php foreach ($sec['links'] as $link): ?>
              <li>
                <a href="<?= esc_url($link['href']) ?>">
                  <?= esc_html($link['label']) ?>
                  <i class="icon icon-rightarrow"></i>
                </a>
              </li>
            <?php endforeach; ?>
          </ul>
        </section>
      <?php endforeach; ?>
    </div>
  </div>
</nav>

<!-- SP Nav -->
<nav id="global-nav-sp" class="global-nav sp-only" aria-label="Navigation mobile" aria-hidden="true">
  <ul>
    <?php foreach ($eta_nav_items as $item): ?>
      <?php if (!empty($item['pc_only'])) continue; ?>
      <?php $is_more = !empty($item['is_more']); ?>
      <li<?= $is_more ? ' class="mobile-nav-faq"' : '' ?>>
        <a
          href="<?= esc_url($item['href']) ?>"
          <?= $is_more ? 'class="mobile-nav-toggle" aria-controls="global-nav-sp-sections" aria-expanded="false"' : '' ?>
        >
          <p><?= esc_html($item['label']) ?></p>
          <?php if ($is_more): ?>
            <span class="mobile-nav-chevron" aria-hidden="true"></span>
          <?php else: ?>
            <i class="icon icon-rightarrow"></i>
          <?php endif; ?>
        </a>
      </li>
    <?php endforeach; ?>
  </ul>

  <div id="global-nav-sp-sections" class="common-nav" aria-hidden="true">
    <?php foreach ($header_sections as $sec): ?>
      <?php
      $panel_id = 'mobile-nav-section-' . sanitize_html_class($sec['slug']);
      $section_url = home_url('/page_cat/' . $sec['slug'] . '/');
      ?>
      <section class="sp-only">
        <h2>
          <button
            type="button"
            class="mobile-nav-section-toggle"
            aria-controls="<?= esc_attr($panel_id) ?>"
            aria-expanded="false"
          >
            <span><?= esc_html($sec['title']) ?></span>
            <span class="mobile-nav-chevron" aria-hidden="true"></span>
          </button>
        </h2>
        <ul id="<?= esc_attr($panel_id) ?>" aria-hidden="true">
          <?php foreach ($sec['links'] as $link): ?>
            <li>
              <a href="<?= esc_url($link['href']) ?>">
                <?= esc_html($link['label']) ?>
                <i class="icon icon-rightarrow"></i>
              </a>
            </li>
          <?php endforeach; ?>
          <li class="mobile-nav-category-link">
            <a href="<?= esc_url($section_url) ?>">
              Toutes les pages <?= esc_html($sec['title']) ?>
              <i class="icon icon-rightarrow"></i>
            </a>
          </li>
        </ul>
      </section>
    <?php endforeach; ?>
  </div>
</nav>
