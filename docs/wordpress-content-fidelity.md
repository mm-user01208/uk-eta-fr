# WordPress content fidelity

The production WordPress site at `https://eudiasporacouncil.org` is the authoritative source for all existing page text, images, links, metadata, and structural HTML.

## Protected routes

- `/`
- `/entry/`
- `/status/`
- `/contact/`
- `/fee/`
- `/privacy/`
- `/agreement/`
- `/service/`
- `/mentions-legales/`
- `/sitemap/`
- `/page_cat/uketa/`
- `/page_cat/site/`

These routes render from `src/content/wordpress-snapshots.ts` through `src/layouts/WordPressSnapshot.astro`. The snapshot includes the original header, desktop and mobile navigation, main content, footer, title, and meta description. WordPress theme CSS and same-origin content assets are mirrored under `public/`.

## Non-negotiable migration rule

Do not rewrite, shorten, translate, replace, reorder, add to, or remove any protected page text, image, or link. Do not substitute an SEO article for an existing WordPress page. Changes to protected content require explicit approval.

The shared footer navigation is an approved exception as of 2026-08-07. It is maintained as a site-wide Astro component so all 26 canonical pages can be reached through the four footer categories. This exception does not permit changes to protected main content, images, or in-page links.

## Refresh procedure

Run the snapshot command only when the WordPress source itself has intentionally changed:

```sh
npm run snapshot:wordpress
npm run build
```

After refreshing, compare every protected route against WordPress at desktop width. Verify normalized main text, image `src`/`srcset`, link text/targets, title, description, page chrome, and visual layout before deploying.

The WordPress source currently references `/wp-content/themes/uketa-fr/images/sitemap/sitemap-title-bg-1024x362.jpg`, which returns HTTP 404. Its reference is retained unchanged so the migration does not silently substitute or alter source information.
