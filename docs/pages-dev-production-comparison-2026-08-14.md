# Pages preview / production comparison — 2026-08-14

## Scope

Compared the page inventory in `UK-ETA_2026-08-07.xlsx` with both live hosts:

- `https://uk-eta-fr.pages.dev`
- `https://eudiasporacouncil.org`

The audit covered the 26 public pages recorded in the workbook plus the seven
route aliases changed after the workbook was created, for 33 tested routes.

## Result

- All 33 routes return HTTP 200 on both hosts.
- Both hosts use the same CSS asset on every tested route.
- Canonical URLs match on both hosts.
- Both sitemap files contain the same 26 canonical URLs.
- The Astro production build succeeds and generates 33 HTML pages.
- No page or visual asset exists on the current `pages.dev` deployment without
  also being available on the custom production domain.

## Chromium render verification

After the HTTP comparison, all 33 production routes were loaded and rendered
sequentially in Headless Chrome 151 at `https://eudiasporacouncil.org`.

- 33/33 routes reached `document.readyState === "complete"`.
- 33/33 routes rendered a `<main>` element and loaded stylesheets.
- 0 routes showed a `Page introuvable`, `404`, or `Not Found` title/H1.
- Chrome reported no page or console errors after the run.
- 32 routes had no failed image resources.
- `/sitemap/` rendered but contains a broken legacy image and stale Japanese
  ETIAS content. It is a real page, but it needs content correction.

The count of 33 must not be interpreted as 33 independent public content
pages. It consists of 26 canonical pages and seven legacy aliases that render
the same content as their canonical replacements.

Two content pairs (`/fee/` and `/eta/tarif/`, and `/privacy/` and
`/info/politique-confidentialite/`) have different response bytes only because
Cloudflare email-address obfuscation is enabled on the custom domain. The page
text, layout and CSS are otherwise the same.

## Change since the 2026-08-07 workbook

The workbook represents the routing plan before the edited Astro pages were
promoted. The following Astro routes are now canonical and included in the
sitemap:

- `/eta/`
- `/eta/qu-est-ce-que-eta/`
- `/eta/tarif/`
- `/info/`
- `/info/conditions-generales/`
- `/info/mentions-legales/`
- `/info/politique-confidentialite/`

The corresponding legacy WordPress paths remain working aliases with the same
content and point their canonical tags at the routes above:

- `/page_cat/uketa/`
- `/service/`
- `/fee/`
- `/page_cat/site/`
- `/agreement/`
- `/mentions-legales/`
- `/privacy/`

This is an update to the URL model in the workbook, not a missing production
deployment.

## Current inventory

### Canonical pages (26)

- `/`
- `/contact/`
- `/entry/`
- `/status/`
- `/eta/`
- `/eta/qu-est-ce-que-eta/`
- `/eta/tarif/`
- `/eta/pays-eligibles/`
- `/eta/procedure-demande/`
- `/eta/documents-necessaires/`
- `/eta/validite-et-delai/`
- `/eta/faq/`
- `/entree-uk/`
- `/entree-uk/aeroport-heathrow/`
- `/entree-uk/transit-correspondance/`
- `/entree-uk/irlande-du-nord/`
- `/visa/`
- `/visa/creative-worker/`
- `/visa/permitted-paid-engagement/`
- `/visa/difference-eta-visa/`
- `/info/`
- `/info/a-propos/`
- `/info/conditions-generales/`
- `/info/mentions-legales/`
- `/info/politique-confidentialite/`
- `/sitemap/`

### Legacy aliases (7)

- `/page_cat/uketa/`
- `/service/`
- `/fee/`
- `/page_cat/site/`
- `/agreement/`
- `/mentions-legales/`
- `/privacy/`

## Separate content issue retained from the workbook

Resolved on 2026-08-18: `/sitemap/` now renders a maintained French Astro page generated from the shared canonical navigation inventory. The notes below describe the historical state found during this audit.

`/sitemap/` still has a Japanese title and H1 and no meta description. This is
the same on both hosts and is therefore a content/SEO task, not a deployment
difference. Browser rendering also confirmed that its body still contains old
Japanese ETIAS navigation and that this image does not load:

`/wp-content/themes/uketa-fr/images/sitemap/sitemap-title-bg-1024x362.jpg`
