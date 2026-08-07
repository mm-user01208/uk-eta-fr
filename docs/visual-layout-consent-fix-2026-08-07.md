# Visual layout and analytics consent fix — 2026-08-07

Target preview: `https://uk-eta-fr.pages.dev/`

## Reported problems

- Several desktop sections and article pages had inconsistent typography,
  spacing, and widths after the WordPress design restoration.
- Desktop browsers showed a second vertical scrollbar inside the browser's
  normal scrollbar.
- The GA4 analytics-cookie consent banner was missing from the Astro site.
- The front-page and article FAQ presentations were inconsistent.

## Causes

- The legacy stylesheet made `html` scrollable, while the Astro compatibility
  stylesheet also made `body` a vertical scroll container.
- Tailwind's reset was present, but article pages had no stable content
  typography layer after the legacy theme styles were added.
- The existing WordPress GA4 consent plugin had not been migrated into the
  Astro layout.
- Native disclosure markers and the legacy Material Icons disclosure glyphs
  were both influencing FAQ controls.

## Changes

- Kept `html` as the single page scroll container and restored `body` to
  `overflow: visible`.
- Added a responsive article layout with stable headings, paragraphs, lists,
  related-article navigation, and mobile stacking.
- Converted the long FAQ page to native accessible accordions and styled both
  FAQ variants without icon-font dependencies.
- Made fixed-width front-page flow content responsive at narrower desktop
  widths and prevented flex children from overflowing.
- Migrated the WordPress GA4 Consent Mode v2 implementation to Astro:
  - denied defaults before measurement commands;
  - no Google tag download for a first-time or rejecting visitor;
  - analytics-only loading after acceptance;
  - persisted `granted`/`denied` choice;
  - visible French accept/reject banner on first visit;
  - persistent `Gérer les cookies` control after a decision.

## Verification

- `npm run build`: 33 static pages generated successfully.
- Browser audit at 1090 × 760 and 390 × 760: 66 route/viewport checks.
- Zero horizontal-overflow elements and zero document/body width overflow.
- One document scrollbar: computed `html` overflow is `auto`; computed `body`
  overflow is `visible`.
- Consent controls exist on all 33 routes at both tested widths.
- A denied clean profile loads zero Google tag scripts.
- Consent flow verified:
  - clean visit: banner shown;
  - reject: `denied` stored, banner hidden, manage control shown, zero tags;
  - manage: banner reopens;
  - accept: `granted` stored, banner hidden, one Google tag loaded;
  - returning granted visit: banner remains hidden and one tag loads.
- Manual screenshots checked at desktop and mobile widths for the home hero,
  four metrics, application flow, validity/documents section, front-page FAQ,
  article layout, and article FAQ.
