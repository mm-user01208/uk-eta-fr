# XServer to Cloudflare Pages production cutover — 2026-08-12

## Purpose

Serve `https://eudiasporacouncil.org` from the Astro deployment in Cloudflare
Pages while keeping XServer mail working. Do not delete the WordPress site or
XServer account during the cutover; they provide the immediate rollback path.

## Current state checked on 2026-08-12

- The public nameservers are still `ns1.xserver.jp` through `ns5.xserver.jp`.
- The public apex and `www` A records resolve to the XServer origin
  `85.131.213.168`.
- The Cloudflare-assigned nameservers are:
  - `hayes.ns.cloudflare.com`
  - `vita.ns.cloudflare.com`
- The Pages project is `uk-eta-fr`; its working preview is
  `https://uk-eta-fr.pages.dev`.
- Cloudflare already has the mail-preservation records prepared, including MX
  to `sv16842.xserver.jp`, SPF, Google verification, and DNS-only A records for
  `mail`, `smtp`, `imap`, and `pop` to `85.131.213.168`.

## Pre-cutover checks

1. In Cloudflare, open **Websites > eudiasporacouncil.org > DNS > Records**.
2. Confirm the following before changing nameservers:
   - MX: `eudiasporacouncil.org` to `sv16842.xserver.jp`, priority `0`.
   - TXT: the current SPF record is present.
   - TXT: `google-site-verification=H58gjGQMHZPoIE1NF_bHieVxqrqwPFk6fHEjjuPIHT0`.
   - `mail`, `smtp`, `imap`, and `pop` point to `85.131.213.168` and are
     **DNS only** (grey cloud), never proxied.
   - Preserve any DKIM or DMARC records shown in XServer/DNS even if they are
     not listed in this document.
3. Open **Workers & Pages > uk-eta-fr > Custom domains**.
4. Add or verify `eudiasporacouncil.org` through the Pages **Custom domains**
   screen. Do not create only a manual CNAME without registering the domain in
   the Pages project.
5. Verify the Pages binding creates/uses a proxied apex record targeting the
   Pages project and that the custom domain is waiting only for nameserver
   activation.
6. Check the preview routes, especially `/`, `/entry/`, `/visa/`,
   `/entree-uk/`, and a lower article page.
7. Export or screenshot the current XServer DNS records and keep the WordPress
   files/database intact.

## Nameserver change in XServer

1. Sign in to **XServer Account**.
2. On the account home page, find **Domains** and select
   `eudiasporacouncil.org`.
3. In **Nameserver settings**, choose **Change settings**.
4. Choose the option for nameservers from another provider and enter only:
   - Nameserver 1: `hayes.ns.cloudflare.com`
   - Nameserver 2: `vita.ns.cloudflare.com`
5. Continue to the confirmation page and submit **Change settings**.
6. Do not change XServer mail accounts, WordPress files, or the server contract.

XServer states that nameserver propagation generally takes several hours and
may take about 24 hours.

## Verification after submission

Run or check the equivalent of the following until the Cloudflare nameservers
appear:

```sh
dig +short eudiasporacouncil.org NS
curl -I https://eudiasporacouncil.org/
curl -I https://eudiasporacouncil.org/visa/
curl -I https://eudiasporacouncil.org/entree-uk/
```

Then verify:

1. Cloudflare marks the zone **Active** and the Pages custom domain **Active**.
2. The apex site and the principal routes return `200` from Cloudflare.
3. `www` redirects once to the canonical apex URL, if `www` is enabled.
4. `/sitemap-index.xml`, `robots.txt`, canonical tags, GA4 consent, forms, and
   the mobile/desktop navigation work.
5. Send and receive a real email using the existing XServer mailbox. Confirm
   MX, SPF, DKIM, and DMARC with the received message headers.
6. Check Search Console after the site is stable and resubmit the sitemap if
   necessary.

## Rollback

If the site or mail has a serious issue, restore the XServer nameservers
`ns1.xserver.jp` through `ns5.xserver.jp` in XServer Account. Because the
WordPress site and XServer mail are retained, this returns DNS control to the
previous setup after propagation. Fix the Cloudflare records before attempting
the cutover again.

## Official references

- XServer nameserver settings:
  https://www.xserver.ne.jp/manual/man_domain_namesever_setting.php
- Cloudflare Pages custom domains:
  https://developers.cloudflare.com/pages/configuration/custom-domains/
- Cloudflare full DNS setup:
  https://developers.cloudflare.com/dns/zone-setups/full-setup/setup/
