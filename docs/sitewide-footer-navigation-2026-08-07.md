# Site-wide footer navigation — 2026-08-07

The Astro layout now renders one shared footer component on every page. This is an explicitly approved exception to the WordPress source-fidelity rule for shared navigation only; protected main content, images, and in-page links remain unchanged.

## Footer structure

The footer exposes all 26 canonical pages through four sections:

- `Infos ETA Royaume-Uni`: category page, home, ETA overview, fees, eligible countries, procedure, documents, validity, and FAQ.
- `Entrée au Royaume-Uni`: hub, Heathrow guide, transit guide, and Northern Ireland guide.
- `Visas Royaume-Uni`: hub, Creative Worker, Permitted Paid Engagement, and ETA/visa comparison.
- `Infos du site`: category page, application, status, contact, privacy, legal notice, terms, service information, and site map.

Desktop displays every link. Mobile starts with all four sections collapsed and exposes an accessible toggle for each section.

## Verification

- `npm run build`: 33 generated routes passed.
- The footer contains four section headings and 26 unique canonical links.
- Home and `/service/` render the same footer link signature.
- All 33 generated HTML files contain exactly one shared footer and four section toggles.
- Desktop at 1909 px and 1090 px: all four lists visible; `scrollWidth === innerWidth`.
- Mobile at 390 px: all four lists collapsed initially; opening a section updates `aria-expanded`, `aria-hidden`, the plus/minus icon, and list visibility; `scrollWidth === innerWidth`.
- All 26 canonical routes passed 52 desktop/mobile checks with zero footer or horizontal-overflow failures.
