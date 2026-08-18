# Mobile navigation and category hub refresh

Date: 2026-08-18

## Mobile navigation

- The mobile menu now uses `site-navigation.ts`, the same source as the desktop expanded navigation and shared footer.
- WordPress snapshot pages also use this shared mobile menu instead of their archived navigation HTML, so the inventory is current on every route.
- Four primary actions remain immediately visible: home, ETA application, status check, and contact.
- ETA, UK entry, visa, and site-information sections expose their current canonical child routes through compact accordions.
- A category title links directly to its hub; its adjacent disclosure button only expands or collapses child pages.

## Category hubs

The following canonical category pages now use a shared editorial hub component:

- `/eta/`
- `/entree-uk/`
- `/visa/`
- `/info/`

Each page includes a breadcrumb, category hero, numbered guide cards with short context labels, and an ETA application call to action. Desktop uses a two-column directory, while mobile uses a single content-width column.

## Migration page count

The current production inventory contains 26 canonical pages and seven legacy aliases. Fourteen canonical pages did not exist among the 12 protected WordPress source routes and were introduced as new content during the Astro/GitHub build:

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
- `/info/a-propos/`

The seven renamed canonical routes are not counted as additional content pages because each replaces an existing WordPress route while keeping the old URL as an alias.
