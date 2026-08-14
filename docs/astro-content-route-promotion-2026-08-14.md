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

The former WordPress routes remain available as aliases and internally serve
the corresponding Astro pages with HTTP 200:

- `/page_cat/uketa/` serves `/eta/`
- `/service/` serves `/eta/qu-est-ce-que-eta/`
- `/fee/` serves `/eta/tarif/`
- `/page_cat/site/` serves `/info/`
- `/agreement/` serves `/info/conditions-generales/`
- `/mentions-legales/` serves `/info/mentions-legales/`
- `/privacy/` serves `/info/politique-confidentialite/`

HTTP 200 rewrites are intentional. The previous production rules permanently
redirected in the opposite direction, so immediately reversing them with new
301 responses could create a redirect loop for browsers that cached the old
rules. The content served at each alias carries the canonical URL of its Astro
route.

Navigation and internal links were updated to point directly to the canonical
Astro routes. The sitemap includes the new canonical routes and excludes their
legacy aliases.

## Verification requirements

- Build all 33 Astro routes successfully.
- Verify all 26 sitemap URLs return HTTP 200.
- Verify all seven former WordPress URLs return HTTP 200 with their Astro
  route's content and canonical URL.
- Verify the Pages hostname and custom production domain serve the same page
  content for every sitemap URL.
