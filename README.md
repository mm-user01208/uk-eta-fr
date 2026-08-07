# UK ETA France

French-language static information site for UK ETA travel requirements.

## Stack

- Astro
- Tailwind CSS
- GitHub source control
- Cloudflare Pages hosting

## Local development

```sh
npm ci
npm run dev
```

## Production build

```sh
npm ci
npm run build
```

The deployable static output is generated in `dist/`.

## Cloudflare Pages

- Production branch: `main`
- Build command: `npm run build`
- Build output directory: `dist`
- Canonical origin: `https://eudiasporacouncil.org`

Do not change the canonical host to `www`. The current production site uses the apex domain as its canonical origin.

Cloudflare Pages reads redirect and response-header rules from `public/_redirects` and `public/_headers`.

## Content publishing

The existing WordPress pages are the source of truth for text, images, links, metadata, and page structure. Do not rewrite, shorten, translate, replace, or remove that content during the Astro migration.

The protected routes and their WordPress snapshots are documented in `docs/wordpress-content-fidelity.md`. Refresh them only from the production WordPress source with:

```sh
npm run snapshot:wordpress
```

Add new static routes under `src/pages/` without changing existing production URLs or protected source content. New French organic-search articles should be linked from the relevant hub and related articles only when that change is explicitly approved.
