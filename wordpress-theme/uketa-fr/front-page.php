<?php
get_header();

// Helper: get ACF field with fallback
function tf($name, $fallback = '') {
  $v = function_exists('get_field') ? get_field($name) : '';
  return $v ? $v : $fallback;
}

$kv_class = isset($kv_class) ? sanitize_html_class($kv_class) : '';
$hero_desktop = function_exists('uketa_performance_asset_url')
  ? uketa_performance_asset_url('assets/images/hero-desktop-1600.webp')
  : get_img_dir('top/kv.webp');
$hero_mobile = function_exists('uketa_performance_asset_url')
  ? uketa_performance_asset_url('assets/images/hero-mobile-900.webp')
  : get_img_dir('top/kv-sp.webp');
$map_300 = function_exists('uketa_performance_asset_url')
  ? uketa_performance_asset_url('assets/images/map-300.webp')
  : get_img_dir('top/map.webp');
$map_480 = function_exists('uketa_performance_asset_url')
  ? uketa_performance_asset_url('assets/images/map-480.webp')
  : get_img_dir('top/map.webp');
?>
<main>
  <div class="kv kv-bg <?= esc_attr($kv_class); ?>">
    <?php if (function_exists('uketa_performance_asset_url')) : ?>
    <picture class="kv-media" aria-hidden="true">
      <source media="(max-width: 500px)" srcset="<?= esc_url($hero_mobile); ?>" width="900" height="1046">
      <img src="<?= esc_url($hero_desktop); ?>" alt="" width="1600" height="970" fetchpriority="high" decoding="async">
    </picture>
    <?php endif; ?>
    <div class="copy-wrap">
      <p class="eye-catch eye-catch-main"><?= esc_html(tf('hero_title', 'La demande d\'ETA est obligatoire pour voyager au Royaume-Uni')); ?></p>
      <p class="eye-catch eye-catch-sub"><?= esc_html(tf('hero_subtitle', 'Veuillez effectuer la procédure au moins 72 heures avant le départ, car le traitement peut prendre du temps.')); ?></p>
      <div class="kv-btn">
        <?php echo get_cta_btn(); ?>
      </div>
    </div>
  </div>

  <section class="sec-iconset" id="floating-on">
    <div class="inner">
      <div class="etias-iconset mb-50">
        <div class="row">
          <div class="icon">
            <img src="<?= get_img_dir(); ?>top/about_icon01.svg" alt="Durée" width="75" height="75">
          </div>
          <div class="text pt01">
            <p><?= esc_html(tf('stat1_label', 'Durée de séjour')); ?></p>
          </div>
          <div class="mark">
            <span class="pt01"><?= esc_html(tf('stat1_value', '6 mois max')); ?></span>
          </div>
        </div>
        <div class="row">
          <div class="icon">
            <img src="<?= get_img_dir(); ?>top/about_icon02.svg" alt="Validité" width="75" height="75">
          </div>
          <div class="text pt02">
            <p><?= esc_html(tf('stat2_label', 'Validité')); ?></p>
          </div>
          <div class="mark">
            <span class="pt02"><?= esc_html(tf('stat2_value', '2 ans')); ?></span>
          </div>
        </div>
        <div class="row">
          <div class="icon">
            <img src="<?= get_img_dir(); ?>top/about_icon03.svg" alt="Pays" width="75" height="75">
          </div>
          <div class="text pt03">
            <p><?= esc_html(tf('stat3_label', 'Pays éligibles')); ?></p>
          </div>
          <div class="mark">
            <span class="pt03"><?= esc_html(tf('stat3_value', '83 pays')); ?></span>
          </div>
        </div>
        <div class="row">
          <div class="icon">
            <img src="<?= get_img_dir(); ?>top/about_icon04.svg" alt="Délai" width="75" height="75">
          </div>
          <div class="text pt04">
            <p><?= esc_html(tf('stat4_label', 'Délai de traitement')); ?></p>
          </div>
          <div class="mark">
            <span class="pt04"><?= esc_html(tf('stat4_value', '3 jours min.')); ?></span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="top-overview">
    <div class="inner">
      <h2><?= esc_html(tf('overview_title', 'Depuis avril 2025, l\'ETA est obligatoire pour voyager au Royaume-Uni')); ?></h2>
      <?php
      $overview = tf('overview_text', '<p>L\'ETA (Electronic Travel Authorisation) est une autorisation électronique de voyage nécessaire pour se rendre au Royaume-Uni. Ce système, similaire à l\'ESTA américain et à l\'eTA canadien, est entré en vigueur le 2 avril 2025 pour les ressortissants européens. Les ressortissants des pays concernés, dont la France, qui souhaitent séjourner au Royaume-Uni pour une durée maximale de six mois à des fins touristiques ou professionnelles doivent effectuer une demande préalable en ligne. La demande nécessite un passeport valide, une adresse e-mail et une carte de crédit. Les mineurs, y compris les nourrissons, doivent également obtenir une ETA.<br>L\'ETA permet aux autorités britanniques de vérifier les informations des voyageurs avant leur arrivée. Les données du passeport sont comparées avec les bases de données des services de police et des agences nationales.</p>');
      echo wp_kses_post($overview);
      ?>
    </div>
  </section>

  <section class="top-apply-flow">
    <div class="inner">
      <h2><?= esc_html(tf('flow_title', 'Procédure de demande ETA')); ?></h2>
      <div class="top-apply-flow-list">
        <?php
        $steps = array(
          array('num'=>1, 'icon'=>'flow_icon01.svg', 'title_field'=>'step1_title', 'text_field'=>'step1_text',
                'title_default'=>'Remplir le formulaire',
                'text_default'=>'Acceptez les conditions générales et remplissez le formulaire de demande ETA avec vos informations personnelles. L\'ETA est obligatoire quel que soit l\'âge du voyageur.'),
          array('num'=>2, 'icon'=>'flow_icon02.svg', 'title_field'=>'step2_title', 'text_field'=>'step2_text',
                'title_default'=>'Paiement par carte',
                'text_default'=>'Vérifiez les informations saisies, puis procédez au paiement de 75,00 £ TTC par carte de crédit.'),
          array('num'=>3, 'icon'=>'flow_icon03.svg', 'title_field'=>'step3_title', 'text_field'=>'step3_text',
                'title_default'=>'Examen de la demande',
                'text_default'=>'Un e-mail de confirmation vous sera envoyé après le paiement. L\'examen peut prendre jusqu\'à 72 heures ouvrables. Veuillez patienter jusqu\'à la notification du résultat.'),
          array('num'=>4, 'icon'=>'flow_icon04.svg', 'title_field'=>'step4_title', 'text_field'=>'step4_text',
                'title_default'=>'Notification du résultat',
                'text_default'=>'Le résultat de l\'examen vous sera communiqué par e-mail. Conservez précieusement la notification d\'autorisation de voyage jusqu\'à votre départ.'),
        );
        foreach($steps as $i => $s):
        ?>
        <?php if($i > 0): ?>
        <figure class="top-apply-flow-list-arrow"><img src="<?= get_img_dir(); ?>icon/icon-right-black.svg" alt="flèche" width="10" height="20" loading="lazy" decoding="async"></figure>
        <?php endif; ?>
        <div class="top-apply-flow-list-item step<?= $s['num']; ?>">
          <h3 class="top-apply-flow-heading">
            <span class="top-apply-flow-list-item-header">ÉTAPE <?= $s['num']; ?></span>
            <div class="icon">
              <img src="<?= get_img_dir(); ?>top/<?= $s['icon']; ?>" alt="" width="75" height="75">
            </div>
            <span class="top-apply-flow-list-item-title"><?= esc_html(tf($s['title_field'], $s['title_default'])); ?></span>
          </h3>
          <p><?= esc_html(tf($s['text_field'], $s['text_default'])); ?></p>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="top-overview">
    <div class="inner">
      <div class="top-overview-flex need-contents">
        <div class="top-overview-title">
          <h2><span class="lang-jp medium"><?= esc_html(tf('validity_title', 'Validité de l\'ETA et délai de demande')); ?></span></h2>
        </div>
        <div class="top-overview-description">
          <?php
          $validity = tf('validity_text', '<p><strong>Validité :</strong><br>L\'ETA est valable deux ans à partir de la date d\'obtention. Pendant cette période, vous pouvez effectuer autant de voyages que souhaité au Royaume-Uni. Toutefois, si votre passeport expire avant la fin de validité de l\'ETA, celle-ci expirera à la même date. Il est recommandé de renouveler votre passeport avant de faire la demande d\'ETA.<br><strong>Délai :</strong><br>Les résultats sont communiqués dans les 3 jours ouvrables suivant la demande. Dans certains cas, des documents supplémentaires peuvent être demandés, ce qui peut prolonger le délai jusqu\'à 30 jours. Le ministère britannique de l\'Intérieur recommande de sauvegarder l\'écran de confirmation de l\'autorisation de voyage.</p>');
          echo wp_kses_post($validity);
          ?>
        </div>
      </div>

      <div class="top-overview-flex mb-50">
        <div class="top-overview-title">
          <h2><span class="lang-jp medium"><?= esc_html(tf('documents_title', 'Documents nécessaires')); ?></span></h2>
        </div>
        <div class="top-overview-description">
          <?php
          $docs = tf('documents_text', '<p>Préparez les 4 documents suivants pour votre demande d\'ETA :</p><ol><li>Passeport valide (image numérique pour téléchargement)</li><li>Photo d\'identité (non requise pour les enfants de moins de 9 ans)</li><li>Adresse e-mail</li><li>Carte de crédit (Visa, Mastercard, JCB, American Express, Diners Club)</li></ol>');
          echo wp_kses_post($docs);
          ?>
        </div>
      </div>
    </div>
  </section>

  <section class="top-contents">
    <section class="top-contents-wrap mb-60">
      <div class="top-contents-wrap-title">
        <h2><?= esc_html(tf('who_title', 'Voyageurs devant demander l\'ETA')); ?></h2>
      </div>
      <div class="inner">
        <div class="top-contents-wrap-flex">
          <div class="flex-left">
            <?php
            $who = tf('who_text', '<p>Les ressortissants français qui se rendent au Royaume-Uni pour le tourisme ou les affaires doivent obligatoirement demander une ETA. La durée maximale de séjour avec une ETA est de 6 mois.</p><h3 class="style-title">Transit aérien (Airside) : en principe non requis</h3><p>L\'ETA n\'est pas nécessaire si vous restez dans la zone de transit de l\'aéroport sans passer le contrôle d\'immigration.</p><h3 class="style-title">Transit terrestre (Landside) : requis</h3><p>Si vous voyagez via l\'Eurostar ou un ferry et passez le contrôle d\'immigration au Royaume-Uni, vous devez demander une ETA.</p>');
            echo wp_kses_post($who);
            ?>
          </div>
          <picture class="flex-right">
            <source
              srcset="<?= esc_url($map_300); ?> 300w, <?= esc_url($map_480); ?> 480w"
              sizes="(max-width: 768px) calc(100vw - 50px), 299px"
            >
            <img src="<?= esc_url($map_300); ?>" alt="" width="300" height="379" loading="lazy" decoding="async">
          </picture>
        </div>
      </div>
    </section>
  </section>

  <section class="top-question">
    <div class="inner">
      <h2 class="common-title pattern02"><?= esc_html(tf('important_title', 'Points importants pour l\'entrée au Royaume-Uni')); ?></h2>
      <?php
      $important = tf('important_text', '<p>Les voyageurs français doivent obtenir une ETA avant le départ pour le Royaume-Uni. Les résultats de l\'examen sont généralement communiqués dans les 3 jours suivant la demande. Si l\'ETA n\'est pas obtenue avant le départ, l\'embarquement ou l\'entrée au Royaume-Uni pourra être refusé. L\'ETA est liée électroniquement au passeport — il n\'est pas nécessaire de l\'imprimer. Le ministère britannique de l\'Intérieur recommande toutefois de sauvegarder la notification d\'autorisation.<br>L\'ETA est une autorisation de voyage électronique, mais ne garantit pas l\'entrée au Royaume-Uni. La décision finale d\'admission revient à l\'agent d\'immigration.</p>');
      echo wp_kses_post($important);
      ?>
    </div>
  </section>

  <?php get_template_part('parts/faq'); ?>

  <section class="top-contents payment">
    <div class="inner">
      <h2><?= esc_html(tf('payment_title', 'Mode de paiement')); ?></h2>
      <?php
      $payment = tf('payment_text', '<p>Le paiement des frais de demande d\'ETA pour le Royaume-Uni peut être effectué par carte de crédit VISA, Mastercard, JCB, Diners Club ou American Express.<br>Toutes les informations personnelles, y compris le numéro de carte, sont chiffrées grâce à la technologie SSL la plus récente, garantissant un paiement sécurisé.<br>Les frais de demande de 75,00 £ TTC facturés par notre site incluent les frais de demande ETA de 20 £ fixés par le ministère de l\'Intérieur britannique.</p><ul class="list-payment"><li>Notre site propose un formulaire de demande entièrement en français.</li><li>Le système du ministère de l\'Intérieur britannique ne prend en charge que l\'anglais pour les formulaires et les demandes de renseignements. Notre site vous permet d\'effectuer les deux démarches en français.</li><li>Pour toute question générale sur l\'ETA ou pour obtenir des informations détaillées sur l\'autorisation, veuillez consulter le site du ministère de l\'Intérieur britannique :<br><a href="https://www.gov.uk/guidance/apply-for-an-electronic-travel-authorisation-eta" target="_blank" rel="noopener noreferrer">Site officiel GOV.UK — ETA</a>&nbsp;&nbsp;&nbsp;<a href="https://ukimmigration-support-webchat.homeoffice.gov.uk/eta" target="_blank" rel="noopener noreferrer">Service de renseignements ETA du ministère de l\'Intérieur</a></li><li>Pour toute question concernant les visas britanniques ou la perte/vol de passeport :<br>Ambassade de France au Royaume-Uni — 58 Knightsbridge London SW1X 7JT — Tél. : 020 7073 1000</li><li>Notre site prend en charge l\'intégralité de la procédure de demande d\'ETA en français, en effectuant les démarches en votre nom.</li></ul>');
      echo wp_kses_post($payment);
      ?>
    </div>
    <div class="inner last-update">Dernière mise à jour :&nbsp;<?= esc_html(tf('last_update', 'mars 2026')); ?></div>
  </section>
</main>
<?php get_footer(); ?>
