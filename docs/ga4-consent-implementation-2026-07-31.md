# GA4 and Consent Mode implementation — 2026-07-31

Target: `https://eudiasporacouncil.org/`

Measurement ID: `G-Y2MEYTFRV8`

## Implementation

The custom WordPress plugin in
`wordpress-plugins/uketa-ga4-consent/uketa-ga4-consent.php` provides:

- the Google tag for GA4;
- Consent Mode v2 defaults before the GA4 `config` command;
- denied defaults for `analytics_storage`, `ad_storage`, `ad_user_data`, and
  `ad_personalization` when no choice exists;
- analytics-only consent when a visitor accepts;
- a French accept/reject banner linked to `/privacy/`;
- persisted consent in local storage;
- a persistent “Gérer les cookies” control so visitors can change their choice;
- disabled Google signals, ad personalization signals, and ad-data retention.

The implementation follows Google's requirement to issue the consent
`default` command before measurement commands and to issue `update` after the
visitor chooses.

## Verification checklist

- The public HTML contains `G-Y2MEYTFRV8` once in the external tag URL and once
  in the GA4 config command.
- The consent `default` command precedes the GA4 `config` command.
- A first-time visitor sees the French consent banner.
- Rejecting persists `denied` and hides the banner.
- Accepting persists `granted` and updates `analytics_storage` to `granted`.
- Advertising-related consent types remain denied in both cases.
- “Gérer les cookies” reopens the controls.

## Production verification

The plugin was installed and activated in WordPress. Production testing
confirmed:

- one external `gtag.js` load for `G-Y2MEYTFRV8`;
- the consent default command appears before the GA4 config command;
- a first visit has no consent value, shows the banner, defaults all four
  Consent Mode v2 storage/data fields to denied, and creates no `_ga` cookies;
- “Tout refuser” persists `denied`, sends a denied consent update, and leaves
  `_ga` cookies absent;
- “Gérer les cookies” reopens the banner after a stored decision;
- accepting persists `granted`, sends an analytics-only consent update, and
  creates `_ga` and `_ga_Y2MEYTFRV8` cookies;
- the next navigation starts with `analytics_storage: granted` while all three
  advertising-related consent fields remain denied;
- GA4 collection requests target measurement ID `G-Y2MEYTFRV8`;
- the existing 11-page SEO metadata verification still passes after plugin
  activation.
