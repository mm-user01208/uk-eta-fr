# Mobile PageSpeed performance update — 2026-08-04

Target: `https://eudiasporacouncil.org/`

## Result

The production mobile PageSpeed score increased from **68** to **99**.

| Metric | Before | After |
| --- | ---: | ---: |
| Performance | 68 | 99 |
| First Contentful Paint | 3.0 s | 0.9 s |
| Largest Contentful Paint | 6.2 s | 1.2 s |
| Total Blocking Time | 70 ms | 0 ms |
| Cumulative Layout Shift | 0 | 0 |
| Speed Index | 5.6 s | 3.6 s |

Production report:
`https://pagespeed.web.dev/analysis/https-eudiasporacouncil-org/fa1bh7cd75?form_factor=mobile`

The report was captured at 2026-08-04 12:53 JST with Lighthouse 13.4.1,
Moto G Power emulation, and slow 4G throttling. The site does not yet have
enough Chrome UX Report field data, so these are lab measurements.

## Changes

### LCP hero

- Replaced the CSS-only hero background on the front page with a discoverable
  `<picture>` / `<img>` element.
- Added `fetchpriority="high"` and viewport-specific image preloads.
- Replaced the 377 KiB, 3508 × 4074 mobile hero with a 34 KiB,
  900 × 1046 WebP.
- Added a 204 KiB, 1600 × 970 desktop WebP in place of the 1.1 MiB source.
- Initialised `$kv_class` before rendering, removing the production PHP warning
  and the leaked server path from the hero class attribute.

### Rendering path and JavaScript

- Removed `page.css` and `news.css` from the front page because they are not
  used there.
- Removed the ineffective duplicate CSS preload tags.
- Removed the Material Icons Google Fonts import and replaced the handful of
  icons with CSS glyphs.
- Removed jQuery, jQuery Migrate, Waypoints, Modernizr, the details polyfill,
  and the old lazy-load library from the front page.
- Added a small vanilla-JavaScript replacement for the mobile menu, desktop
  navigation panel, footer navigation, and FAQ toggles.
- Kept the two required theme stylesheets render-blocking. An async-CSS trial
  improved LCP but caused CLS, so it was not retained.

### Images

- Added responsive 300 px and 480 px map images.
- Added `srcset`, `sizes`, explicit dimensions, native lazy loading, and async
  decoding to the map.
- Added explicit dimensions and native lazy loading to the flow arrows.

### Analytics

- Updated `UK ETA GA4 Consent` to basic consent loading.
- On a first visit, Consent Mode defaults are created but `gtag.js` is not
  requested.
- Accepting analytics consent dynamically loads `gtag.js`, configures
  `G-Y2MEYTFRV8`, stores the choice, and hides the banner.

### Cache policy

- Added one-year immutable caching for versioned CSS, JavaScript, WebP, AVIF,
  SVG, PNG, JPEG, and WOFF2 assets through a marked `.htaccess` block.
- Production responses now include
  `Cache-Control: public, max-age=31536000, immutable`.

## Source layout

- Theme snapshot and changes: `wordpress-theme/uketa-fr/`
- Performance plugin: `wordpress-plugins/uketa-performance/`
- GA4 consent plugin: `wordpress-plugins/uketa-ga4-consent/`

## Production verification

- Front page and ten important URLs return HTTP 200 with the expected titles
  and descriptions.
- Mobile screenshot verified at a 390 × 844 viewport.
- Mobile menu opens, reports `aria-expanded="true"`, and closes again.
- A clean consent state loads zero Google tag scripts.
- Accepting consent loads exactly one Google tag script for
  `G-Y2MEYTFRV8`.
- Browser console showed no front-page JavaScript errors during the visual
  verification.
