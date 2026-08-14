# Production site audit — 2026-08-14

## Summary

The Astro build and Cloudflare Pages deployment are healthy. The remaining
work is primarily production-host cleanup and content accuracy. No content was
changed automatically because the fee, refund, and service-availability text
requires a business decision.

## Technical checks passed

- Local `npm run build` completed successfully and generated 33 routes.
- `https://eudiasporacouncil.org/` returns HTTP 200 over HTTPS.
- The production Pages deployment is connected to GitHub branch `main` and the
  deployed source commit matched the repository head at audit time.
- The generated sitemap exposed 26 canonical pages. All 26 pages and 66 unique
  internal links/assets discovered from them were fetched without a 4xx/5xx
  response.
- All tested sitemap pages had a canonical URL on the apex production host.
- HTTP redirects to HTTPS correctly.
- The repository had no open GitHub issues or pull requests.
- The XServer screen confirmed that the domain has no mail accounts.

## Remaining infrastructure work

### 1. Move the `www` redirect off WordPress

`https://www.eudiasporacouncil.org/` returns 301 to the apex URL, but the
response still has `x-redirect-by: WordPress`. Create an equivalent Cloudflare
redirect that preserves path and query string before deleting or restricting
the old WordPress installation.

### 2. Remove stale XServer mail DNS

No mailbox exists, but public DNS still includes the XServer MX, SPF, and
`mail`/`smtp`/`imap`/`pop` host records. Remove them after confirming that no
third-party sender uses an `@eudiasporacouncil.org` From address. A null MX,
SPF `-all`, and optionally DMARC `p=reject` can explicitly declare that the
domain does not send or receive mail.

### 3. Decide whether to redirect the Pages preview hostname

`https://uk-eta-fr.pages.dev/` currently returns HTTP 200 instead of
redirecting to the custom domain. Canonical tags already point to the apex, so
this is not an immediate indexing fault, but a host-level redirect would make
the public origin unambiguous.

## High-priority content corrections

### 1. Service availability is contradictory

The `/entry/`, `/status/`, and `/contact/` routes say that the service is
temporarily unavailable. Other pages and site-wide calls to action say that:

- applications are accepted 24 hours a day, 365 days a year;
- the French application form is available;
- support replies within 24 hours;
- users can check their application status at any time.

Until the backend service resumes, either add a consistent maintenance notice
and disable active-service claims site-wide, or restore the application,
status, and contact functionality.

### 2. The UK government ETA fee is outdated

GOV.UK states that the official ETA application fee became GBP 20 on
2026-04-08. The site still describes the government component as GBP 16 in the
fee page, procedure page, terms, and legal/refund text. The business may choose
to keep or change its GBP 75 total service price, but every fee breakdown and
refund calculation must use one approved, consistent policy.

Official references:

- `https://www.gov.uk/eta/apply`
- `https://www.gov.uk/government/publications/visa-regulations-revised-table/home-office-immigration-and-nationality-fees-8-april-2026`

### 3. The eligible-nationality list is materially outdated

The site says 87 nationalities and includes several entries absent from the
current GOV.UK list, including Ireland, Nicaragua, Trinidad and Tobago,
Botswana, Jordan, Namibia, and South Africa. It also omits multiple currently
eligible locations. Replace the hand-maintained list with the GOV.UK list
updated on 2026-04-09. Irish citizens do not need an ETA.

Official references:

- `https://www.gov.uk/guidance/check-when-you-can-get-an-electronic-travel-authorisation-eta`
- `https://www.gov.uk/eta/when-not-need-eta`

### 4. The child-photo guidance confuses face scan with face photo

The site says children aged 9 or younger do not need a digital face photo.
GOV.UK says they are exempt from the app's liveness face scan, but a face photo
is still required. Correct the procedure and required-documents pages.

Official references:

- `https://www.gov.uk/eta/apply`
- `https://www.gov.uk/guidance/using-the-uk-eta-app`

### 5. Refund statements conflict internally

The fee page says a rejected application is not refundable. The legal notice
says a rejected application is refunded after deducting the government and
processing fees. The terms say no refund after review starts. Select the actual
business policy and make the fee page, terms, legal notice, and application
checkout agree.

## Secondary content checks

- GOV.UK says decisions usually arrive within one day and applicants should
  allow up to three working days. Review local claims of `72 working hours`, a
  fixed 30-day extension, and a `minimum absolute` three-day lead time.
- GOV.UK now provides an official online ETA status checker. While the site's
  private status form is unavailable, consider linking users to
  `https://www.gov.uk/check-eta` where appropriate.
- Verify that `support@uketa-travel.net` is actively monitored because it is
  the published privacy, legal, receipt, and support contact address. It is a
  separate domain and is unrelated to the empty XServer mailbox list for
  `eudiasporacouncil.org`.
