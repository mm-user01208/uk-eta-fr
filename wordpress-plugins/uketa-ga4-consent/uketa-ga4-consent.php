<?php
/**
 * Plugin Name: UK ETA GA4 Consent
 * Description: Adds GA4 with Consent Mode v2 and a French analytics-cookie consent banner.
 * Version: 1.1.0
 * Author: UK ETA Application Site
 */

if (!defined('ABSPATH')) {
  exit;
}

const UKETA_GA4_MEASUREMENT_ID = 'G-Y2MEYTFRV8';
const UKETA_GA4_CONSENT_KEY = 'uketa_analytics_consent_v1';

/**
 * Initialise Consent Mode before loading or configuring the Google tag.
 */
function uketa_ga4_consent_head() {
  if (is_admin()) {
    return;
  }

  $measurement_id = wp_json_encode(UKETA_GA4_MEASUREMENT_ID);
  $consent_key = wp_json_encode(UKETA_GA4_CONSENT_KEY);
  ?>
  <script id="uketa-ga4-consent-default">
    (function () {
      var consentKey = <?php echo $consent_key; ?>;
      var storedChoice = null;

      try {
        storedChoice = window.localStorage.getItem(consentKey);
      } catch (error) {
        storedChoice = null;
      }

      window.dataLayer = window.dataLayer || [];
      window.gtag = window.gtag || function () {
        window.dataLayer.push(arguments);
      };

      var analyticsGranted = storedChoice === 'granted';
      var tagRequested = false;

      function loadGoogleTag() {
        if (tagRequested) {
          return;
        }

        tagRequested = true;

        var script = document.createElement('script');
        script.async = true;
        script.src = 'https://www.googletagmanager.com/gtag/js?id=' + encodeURIComponent(<?php echo $measurement_id; ?>);
        document.head.appendChild(script);

        window.gtag('js', new Date());
        window.gtag('config', <?php echo $measurement_id; ?>, {
          allow_google_signals: false,
          allow_ad_personalization_signals: false
        });
      }

      window.gtag('consent', 'default', {
        ad_storage: 'denied',
        ad_user_data: 'denied',
        ad_personalization: 'denied',
        analytics_storage: analyticsGranted ? 'granted' : 'denied',
        wait_for_update: 500
      });
      window.gtag('set', 'ads_data_redaction', true);

      window.uketaAnalyticsConsent = {
        choice: storedChoice,
        load: loadGoogleTag,
        update: function (choice) {
          var granted = choice === 'granted';

          window.gtag('consent', 'update', {
            ad_storage: 'denied',
            ad_user_data: 'denied',
            ad_personalization: 'denied',
            analytics_storage: granted ? 'granted' : 'denied'
          });

          this.choice = granted ? 'granted' : 'denied';

          try {
            window.localStorage.setItem(consentKey, this.choice);
          } catch (error) {
            // Keep the choice for the current page if storage is unavailable.
          }

          if (granted) {
            loadGoogleTag();
          }
        }
      };

      if (analyticsGranted) {
        loadGoogleTag();
      }
    }());
  </script>
  <?php
}
add_action('wp_head', 'uketa_ga4_consent_head', 1);

/**
 * Render the consent controls. Visitors can reject, accept, or reopen them.
 */
function uketa_ga4_consent_banner() {
  if (is_admin()) {
    return;
  }
  ?>
  <style id="uketa-ga4-consent-styles">
    #uketa-cookie-consent[hidden],
    #uketa-cookie-manage[hidden] {
      display: none !important;
    }

    #uketa-cookie-consent {
      position: fixed;
      right: 20px;
      bottom: 20px;
      left: 20px;
      z-index: 2147483000;
      max-width: 760px;
      margin: 0 auto;
      padding: 20px;
      color: #1b1b1b;
      background: #fff;
      border: 1px solid rgba(0, 0, 0, 0.14);
      border-radius: 10px;
      box-shadow: 0 10px 36px rgba(0, 0, 0, 0.2);
      font-family: inherit;
      font-size: 15px;
      line-height: 1.55;
    }

    #uketa-cookie-consent p {
      margin: 0 0 14px;
    }

    #uketa-cookie-consent a {
      color: #195a9b;
      text-decoration: underline;
    }

    .uketa-cookie-actions {
      display: flex;
      flex-wrap: wrap;
      justify-content: flex-end;
      gap: 10px;
    }

    .uketa-cookie-button {
      min-height: 42px;
      padding: 9px 18px;
      border: 1px solid #174f84;
      border-radius: 5px;
      font: inherit;
      font-weight: 700;
      cursor: pointer;
    }

    #uketa-cookie-reject {
      color: #174f84;
      background: #fff;
    }

    #uketa-cookie-accept {
      color: #fff;
      background: #174f84;
    }

    #uketa-cookie-manage {
      position: fixed;
      bottom: 10px;
      left: 10px;
      z-index: 2147482999;
      padding: 7px 10px;
      color: #1b1b1b;
      background: rgba(255, 255, 255, 0.96);
      border: 1px solid rgba(0, 0, 0, 0.22);
      border-radius: 4px;
      font: inherit;
      font-size: 12px;
      cursor: pointer;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.12);
    }

    @media (max-width: 600px) {
      #uketa-cookie-consent {
        right: 10px;
        bottom: 10px;
        left: 10px;
        padding: 16px;
      }

      .uketa-cookie-actions {
        display: grid;
        grid-template-columns: 1fr;
      }

      .uketa-cookie-button {
        width: 100%;
      }
    }
  </style>

  <section
    id="uketa-cookie-consent"
    role="dialog"
    aria-label="Préférences relatives aux cookies"
    aria-live="polite"
    hidden
  >
    <p>
      Nous utilisons Google Analytics pour mesurer l’audience et améliorer ce
      site. Vous pouvez accepter ou refuser les cookies analytiques.
      <a href="<?php echo esc_url(home_url('/privacy/')); ?>">En savoir plus</a>
    </p>
    <div class="uketa-cookie-actions">
      <button id="uketa-cookie-reject" class="uketa-cookie-button" type="button">
        Tout refuser
      </button>
      <button id="uketa-cookie-accept" class="uketa-cookie-button" type="button">
        Accepter les cookies analytiques
      </button>
    </div>
  </section>

  <button id="uketa-cookie-manage" type="button" hidden>
    Gérer les cookies
  </button>

  <script id="uketa-ga4-consent-controls">
    (function () {
      var consent = window.uketaAnalyticsConsent;
      var banner = document.getElementById('uketa-cookie-consent');
      var manageButton = document.getElementById('uketa-cookie-manage');
      var acceptButton = document.getElementById('uketa-cookie-accept');
      var rejectButton = document.getElementById('uketa-cookie-reject');

      if (!consent || !banner || !manageButton || !acceptButton || !rejectButton) {
        return;
      }

      function showBanner() {
        banner.hidden = false;
        manageButton.hidden = true;
      }

      function hideBanner() {
        banner.hidden = true;
        manageButton.hidden = false;
      }

      acceptButton.addEventListener('click', function () {
        consent.update('granted');
        hideBanner();
      });

      rejectButton.addEventListener('click', function () {
        consent.update('denied');
        hideBanner();
      });

      manageButton.addEventListener('click', showBanner);

      if (consent.choice === 'granted' || consent.choice === 'denied') {
        hideBanner();
      } else {
        showBanner();
      }
    }());
  </script>
  <?php
}
add_action('wp_footer', 'uketa_ga4_consent_banner', 100);
