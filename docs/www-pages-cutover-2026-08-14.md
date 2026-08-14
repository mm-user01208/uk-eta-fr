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
`uk-eta-fr` through the Cloudflare API. The old Xserver A record was replaced
with a proxied CNAME to `uk-eta-fr.pages.dev` on 2026-08-14. Cloudflare now
reports both the custom-domain verification and HTTP validation as `active`.

## Required DNS record

Replace the existing `www` record with:

- Type: `CNAME`
- Name: `www`
- Target: `uk-eta-fr.pages.dev`
- Proxy status: Proxied

The record was changed through the authenticated Cloudflare dashboard.

## Completion checks

Checks after the CNAME was saved:

1. Pages custom-domain status: `active`.
2. `www` home page: HTTP 200 from Cloudflare Pages.
3. `www` `/eta/tarif/`: HTTP 200 from Cloudflare Pages.
4. `www` `/eta/pays-eligibles/`: HTTP 200 from Cloudflare Pages.
5. The old WordPress `Page introuvable` response is no longer served.

## Canonical-host redirect still required

The final canonical-host policy is apex-only. Add a Cloudflare Single Redirect
using the official `Redirect from WWW to root` pattern:

- Request URL: `https://www.*`
- Target URL: `https://${1}`
- Status: `301`
- Preserve query string: enabled

Keep the proxied `www` CNAME and Pages custom domain after enabling the rule;
they allow Cloudflare to receive the request before applying the redirect.

The API token currently available to the project does not have permission to
read or edit zone redirect rules, so this rule must be deployed in the
authenticated Cloudflare dashboard or with a token that grants
`Zone > Single Redirect > Edit`.
