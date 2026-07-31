# Search Console zero-data diagnosis — 2026-07-31

Target: `https://eudiasporacouncil.org/`

## Summary

The public site is online and crawlable. The zero values in Search Console are not
explained by an outage, a `robots.txt` block, or removal of the current DNS
ownership-verification record.

The strongest public-side signal is that the site does not appear to have pages
indexed by Google at the time of this check. Search Console's URL Inspection,
Page indexing, Manual actions, and Security issues reports are needed to determine
Google's exact internal reason.

## Observed public-side facts

- The canonical homepage returns HTTP `200`.
- HTTP redirects to HTTPS, and `www` redirects to the non-`www` canonical host.
- Googlebot desktop and mobile user agents receive the same HTTP `200` homepage
  response and content as a regular client.
- All 10 URLs listed in the page sitemap return HTTP `200`.
- `robots.txt` allows all crawlers and advertises
  `https://eudiasporacouncil.org/sitemap_index.xml`.
- The sitemap index and page sitemap both return HTTP `200`.
- Indexable pages declare `index, follow`; no `X-Robots-Tag: noindex` was found
  on the homepage.
- A random nonexistent path correctly returns HTTP `404` with `noindex, follow`.
- The root DNS contains a Google site-verification TXT record. Therefore an HTML
  verification meta tag is not required for the corresponding DNS-verified
  ownership.
- No Google Analytics or Google Tag Manager loader was found in the homepage
  source. This affects Analytics collection, not Search Console's search
  impressions/clicks.
- A `site:eudiasporacouncil.org` web search returned no result from the target
  domain during the check.

## Problems and risks found

### 1. Every checked page has an empty HTML title

All sitemap pages currently render:

```html
<title></title>
```

Yoast emits Open Graph and structured-data names, but that does not repair the
empty HTML title. This should be fixed on every indexable page. It is a serious
SEO defect, although it is not by itself proof of why the entire site is absent
from the index.

### 2. Domain history and current topic are sharply mismatched

Public search results associate the domain with the former "EU Diaspora Council"
non-profit, while the current site is a commercial French-language UK ETA
application service. This is a material search-quality risk. Google explicitly
lists repurposing an expired/previously established domain to manipulate rankings
as expired-domain abuse. We cannot determine from public checks alone whether
Google classified this site that way or whether a manual action exists.

### 3. The Search Console property variant may be wrong

The live canonical property is:

```text
https://eudiasporacouncil.org/
```

If Search Console is currently showing the URL-prefix property for
`http://...` or `https://www...`, it can show no useful data for the canonical
non-`www` HTTPS URLs. Prefer the Domain property `eudiasporacouncil.org`, which
covers all protocols and subdomains, and clear all report filters.

### 4. The repository does not match the deployed site

The GitHub repository is an Astro project, but the live site is WordPress using
the custom theme path `wp-content/themes/uketa-fr/`. The deployed source and
operational configuration are therefore not fully represented in this repository.

## Required Search Console checks

Use the Domain property `eudiasporacouncil.org` and perform these checks in order:

1. In **URL Inspection**, inspect `https://eudiasporacouncil.org/`.
   Record the exact verdict and the reason under **Page indexing**.
2. Run **Test live URL**. If the live test is eligible, use **Request indexing**.
3. Open **Indexing > Pages** and record:
   - indexed-page count;
   - not-indexed-page count;
   - each exclusion reason and affected URL count.
4. Open **Sitemaps** and submit:
   `https://eudiasporacouncil.org/sitemap_index.xml`.
5. Open **Security & Manual Actions > Manual actions**.
6. Open **Security & Manual Actions > Security issues**.
7. In **Performance > Search results**, select 16 months and clear all query,
   page, country, device, search-appearance, and date-comparison filters.

The URL Inspection screenshot/result and the Page indexing reasons are the
minimum evidence needed for a definitive diagnosis.

## Recommended remediation

1. Fix the theme so WordPress outputs a unique, non-empty `<title>` for every
   indexable page.
2. Confirm the Domain property and submit the sitemap index.
3. Address any Page indexing, Manual action, or Security issue reported by
   Search Console before repeatedly requesting indexing.
4. Reassess use of this historically unrelated domain for the ETA service.
   A new domain whose name and history match the service is the lower-risk
   long-term SEO choice.
5. Add GA4/GTM only if Analytics collection is required; do not treat that as
   a fix for Search Console zero impressions.
6. Bring the deployed WordPress theme/configuration under version control, or
   document why the Astro repository is retained separately.

## References

- [About Search Console data](https://support.google.com/webmasters/answer/96568)
- [Verify site ownership](https://support.google.com/webmasters/answer/9008080)
- [URL Inspection](https://support.google.com/webmasters/answer/9012289)
- [Page indexing report](https://support.google.com/webmasters/answer/7440203)
- [Manual actions report](https://support.google.com/webmasters/answer/9044175)
- [Security issues report](https://support.google.com/webmasters/answer/9044101)
- [Google spam policies: expired domain abuse](https://developers.google.com/search/docs/essentials/spam-policies#expired-domain-abuse)
