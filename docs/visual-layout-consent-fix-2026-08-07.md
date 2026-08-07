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

## Follow-up visual correction

The first pass was not sufficient: it treated the absence of horizontal
overflow as proof that the layout was visually correct. A side-by-side check
against the production WordPress site showed additional migration issues:

- the Astro copy still used an older theme baseline with 14 px body copy,
  while production uses 16 px;
- Tailwind spacing, type, and width utilities were being evaluated against the
  legacy theme's 10 px root size, making utility-based pages roughly 37.5%
  smaller than intended;
- the production-only desktop override that stacks and centres the validity
  and document headings was missing;
- the front-page FAQ and footer retained the smaller legacy dimensions.

The compatibility stylesheet now restores the production dimensions for the
home page and translates the Tailwind utility values used by hub, form, and
utility pages to their intended pixel sizes. The validity/document blocks,
application flow, FAQ rows, headings, cards, body copy, spacing, and footer
were checked visually at 1090 px and 390 px.

Follow-up verification:

- `npm run build`: 33 static pages generated successfully;
- 66 route/viewport checks: zero horizontal overflow and zero visible main
  content below 11 px;
- mobile navigation opens with the correct ARIA state and no overflow;
- clean, reject, reopen, and accept cookie states all pass;
- computed home-page dimensions now match the production WordPress reference
  for 16 px body copy, stacked desktop overview blocks, 64 px FAQ rows, and
  16 px footer headings.

## Source-fidelity correction

The layout-only follow-up above was still incomplete. Several existing routes,
including `/service/`, and multiple home-page sections had been rewritten or
shortened during the Astro migration. That changed source text, images, links,
and page structure without approval.

The authoritative WordPress HTML has now been restored for all 12 existing
routes listed in `docs/wordpress-content-fidelity.md`. The shared header,
desktop and mobile navigation, main content, footer, metadata, theme CSS, and
same-origin assets are snapshotted from WordPress instead of being recreated
by hand.

Final desktop verification:

- normalized main text, image attributes, source attributes, link text and
  targets, titles, descriptions, header links, navigation links, and footer
  links match WordPress on all 12 protected routes;
- element geometry and key computed styles match at 1909 px and 1090 px;
- every checked route has `scrollWidth === innerWidth`;
- `/service/` has equal 1909 px screenshot dimensions and approximately
  0.001% pixel variance, limited to rendering anti-aliasing;
- the analytics-cookie clean, accept, persistence, and manage-control states
  still pass after the content restoration.
