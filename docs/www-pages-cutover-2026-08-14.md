# `www` hostname cutover to Cloudflare Pages — 2026-08-14

## Incident

The apex hostname served the new Astro pages correctly, but the same paths on
`www.eudiasporacouncil.org` returned the old WordPress 404 page with the text
`Page introuvable`.

Examples before the fix:

- `https://eudiasporacouncil.org/eta/pays-eligibles/`: HTTP 200
- `https://www.eudiasporacouncil.org/eta/pays-eligibles/`: HTTP 404

The `www` response included `x-redirect-by: WordPress`, confirming that this
hostname still reached Xserver rather than Cloudflare Pages.

## Pages-side change

`www.eudiasporacouncil.org` was added to the Cloudflare Pages project
`uk-eta-fr` through the Cloudflare API. The custom domain was accepted but
remains pending with `CNAME record not set` until the existing DNS record is
changed.

## Required DNS record

Replace the existing `www` record with:

- Type: `CNAME`
- Name: `www`
- Target: `uk-eta-fr.pages.dev`
- Proxy status: Proxied

The Cloudflare API token available to the project has Pages Write permission
but does not have DNS Read or DNS Write permission, so the DNS record must be
changed through the authenticated Cloudflare dashboard or a DNS-enabled API
token.

## Completion checks

After the CNAME is saved:

1. Wait for the Pages custom-domain status to become `active`.
2. Verify the apex and `www` versions of every sitemap path return HTTP 200.
3. Confirm the three reported pages no longer contain `Page introuvable`.
4. Confirm the content and canonical URLs point to the apex Astro routes.

