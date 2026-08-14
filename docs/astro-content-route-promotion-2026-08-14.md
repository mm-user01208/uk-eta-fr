# Astro content routes promoted to production — 2026-08-14

## Problem

Seven edited Astro pages existed in the build but Cloudflare Pages redirect
rules sent visitors from those routes to older WordPress snapshot routes. This
made the edited pages appear not to have been promoted from the Pages preview
work to production.

## Resolution

The redirect direction was reversed. The edited Astro routes are now the
canonical public pages:

- `/eta/`
- `/eta/qu-est-ce-que-eta/`
- `/eta/tarif/`
- `/info/`
- `/info/conditions-generales/`
- `/info/mentions-legales/`
- `/info/politique-confidentialite/`

The former WordPress routes remain available as permanent aliases and redirect
to the corresponding Astro pages:

- `/page_cat/uketa/` → `/eta/`
- `/service/` → `/eta/qu-est-ce-que-eta/`
- `/fee/` → `/eta/tarif/`
- `/page_cat/site/` → `/info/`
- `/agreement/` → `/info/conditions-generales/`
- `/mentions-legales/` → `/info/mentions-legales/`
- `/privacy/` → `/info/politique-confidentialite/`

Navigation and internal links were updated to point directly to the canonical
Astro routes. The sitemap includes the new canonical routes and excludes their
legacy aliases.

## Verification requirements

- Build all 33 Astro routes successfully.
- Verify all 26 sitemap URLs return HTTP 200.
- Verify all seven former WordPress URLs return HTTP 301 to their Astro route.
- Verify the Pages hostname and custom production domain serve the same page
  content for every sitemap URL.
