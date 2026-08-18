# Sitemap and mobile related-card update — 2026-08-18

## Sitemap categorization

The HTML sitemap now uses `siteNavigationSections` without page-specific
reclassification. `Demander l’ETA` (`/entry/`) and `Vérifier la demande`
(`/status/`) are therefore listed under `Infos du site`, matching the shared
navigation data.

## Mobile related-article images

On viewports below 768 px, the image area in the related-article cards keeps
the full card width and uses a `32 / 9` aspect ratio with centered cover
cropping. This makes it exactly half the height of the previous `16 / 9`
mobile image area. Desktop cards remain unchanged at 145 px high.

## Verification

- `npm run build`: 33 routes generated successfully.
- 390 px viewport: related image 348 × 97.875 px, no horizontal overflow.
- 1440 px viewport: related image height remains 145 px, no horizontal
  overflow.
- Generated sitemap lists `/entry/` and `/status/` under `Infos du site`.
