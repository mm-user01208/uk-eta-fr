# ETA official-content update — 2026-08-14

## Scope

The production Astro source was updated to align the requested ETA content
with current UK government information and the site's chosen refund policy.

## Changes

- Updated the UK government ETA fee from £16 to £20.
- Kept the customer-facing total at £75 including VAT by changing the stated
  service-fee component from £46.50 to £42.50.
- Replaced the outdated 87-country eligibility list with the current list of
  83 eligible nationalities and territories, including Taiwan's passport
  condition.
- Removed ineligible entries including Ireland, Nicaragua, Trinidad and
  Tobago, Botswana, South Africa, Namibia, Honduras, El Salvador, Fiji and
  Jordan.
- Added current eligible entries that were missing, including Andorra, Monaco,
  San Marino, Vatican City, Maldives, Guyana, Belize, Grenada, Peru, Saint
  Vincent and the Grenadines, the Marshall Islands, Micronesia, Palau and the
  Solomon Islands.
- Standardized the rejection policy: no refund is provided when an ETA
  application is rejected. The existing partial-refund terms for cancellation
  before processing begins remain unchanged.
- Updated both the Astro article sources and the WordPress snapshot content
  that supplies legacy production routes such as `/`, `/fee/` and
  `/mentions-legales/`.

## Staging and production finding

Immediately before this update, `https://uk-eta-fr.pages.dev/` and
`https://eudiasporacouncil.org/` returned byte-identical home pages. Both the
Pages hostname and the custom production domain were serving the same `main`
branch build, and both eligibility pages still displayed 87 nationalities.
There is therefore no independent staging deployment in the current
Cloudflare Pages setup. The legacy `gh-pages` branch contains an older March
2026 CMS build and must not be merged into `main`.

## Verification

- Official eligibility list counted: 83 entries.
- `npm run build`: passed, 33 static pages generated.
- `git diff --check`: passed.
- Stale £16, 87-country and partial-refund-on-rejection wording: absent from
  the Astro source after the update.

## Official sources

- UK ETA application and fee:
  https://www.gov.uk/eta/apply
- Current ETA eligibility list:
  https://www.gov.uk/guidance/check-when-you-can-get-an-electronic-travel-authorisation-eta

