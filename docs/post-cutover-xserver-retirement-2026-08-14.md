# Post-cutover XServer and WordPress retirement plan — 2026-08-14

## Decision

The production web site has moved to the GitHub-managed Astro build deployed
by Cloudflare Pages. XServer must not be cancelled or the WordPress installation
deleted yet because XServer still handles mail and the `www` redirect still
passes through WordPress.

## Verified production state

- GitHub source: `mm-user01208/uk-eta-fr`, production branch `main`.
- Framework and build: Astro, `npm run build`, output directory `dist`.
- Cloudflare Pages preview: `https://uk-eta-fr.pages.dev/`.
- Production custom domain: `https://eudiasporacouncil.org/`.
- On 2026-08-14, the preview and custom-domain home pages had identical SHA-256
  hashes and the production apex returned HTTP 200 through Cloudflare.
- Public authoritative nameservers are `hayes.ns.cloudflare.com` and
  `vita.ns.cloudflare.com`.
- The application, status, and contact routes are static maintenance/snapshot
  pages. There is no active form backend or WordPress runtime requirement for
  those routes.
- Site assets under the old `/wp-content/` paths required by the migrated pages
  are copied into this repository's `public/` directory and served by Pages.

## Remaining XServer dependencies

### Mail

Public DNS still routes mail to XServer:

- MX: `sv16842.xserver.jp`
- `mail`, `smtp`, `imap`, and `pop`: `85.131.213.168`

The existence and use of any mailbox must be checked before server retirement.
If mail is required after XServer expiry, migrate the mailbox and its messages,
then update MX, SPF, DKIM, DMARC, and mail client settings and verify real send
and receive tests.

### `www` redirect

`https://www.eudiasporacouncil.org/` currently returns a 301 to the apex domain,
but the response includes `x-redirect-by: WordPress`. Replace this with a
Cloudflare redirect or a Pages custom-domain redirect before retiring XServer.

### Rollback

The existing WordPress files and database are the immediate rollback copy for
the new deployment. Keep them intact during the initial production observation
period. Do not leave an unused WordPress installation publicly reachable and
unpatched for the remainder of the contract.

## Recommended sequence

1. Keep XServer and WordPress unchanged for an initial two-to-four-week
   rollback window after the 2026-08-14 cutover.
2. Replace the WordPress-based `www` redirect with a Cloudflare-controlled 301.
3. Confirm whether any `@eudiasporacouncil.org` mailbox is used. Migrate mail if
   XServer will not be renewed.
4. Export and retain a full WordPress backup: files, database, uploads, server
   settings, DNS records, and any required mail data. Store it outside XServer.
5. After the rollback window and final route/content checks, remove public
   access to WordPress or retire the installation. If it is retained, restrict
   access and keep WordPress, plugins, and themes patched.
6. Before disabling XServer automatic renewal, verify whether
   `eudiasporacouncil.org` uses the XServer permanent-free-domain benefit. That
   benefit applies only while the server contract remains active, and moving a
   benefited domain can require a one-year renewal fee.
7. If no other site or mail service needs XServer, disable automatic renewal
   after the domain-benefit and mail checks. The paid service remains usable
   until 2027-03-31; disabling renewal alone is not an immediate shutdown.
8. Complete the final backup and dependency check well before 2027-03-31. If a
   formal cancellation is submitted, follow XServer's instruction to remove the
   domain setting before the server usage deadline.

## Useful interim roles for the paid XServer term

- Existing domain mail until its replacement is ready.
- A restricted rollback archive for the former WordPress site.
- A password-protected WordPress staging environment if one is genuinely
  needed.

Do not create a new production dependency merely to use the remaining prepaid
term. GitHub and Cloudflare Pages remain the production web architecture.

## Official XServer references

- Cancellation: `https://www.xserver.ne.jp/manual/man_order_quit.php`
- Permanent free-domain benefit:
  `https://www.xserver.ne.jp/manual/man_order_present_domain.php`

