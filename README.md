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

Add static routes under `src/pages/`. Keep existing production URLs stable. New French organic-search articles should be linked from the relevant hub and related articles.
