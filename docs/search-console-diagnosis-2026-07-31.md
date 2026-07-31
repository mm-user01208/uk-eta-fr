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

## Search Console evidence received

The URL Inspection screenshots for
`https://eudiasporacouncil.org/service/` show:

- **URL is not on Google**.
- Page indexing reason:
  **URL is unknown to Google**.
- No previous crawl date or crawler user agent is recorded.
- Search Console has not detected a referring sitemap or referring page for
  this URL.
- No user-declared or Google-selected canonical is recorded because the URL has
  not yet been crawled.

This is not a crawl rejection, `robots.txt` block, `noindex`, canonical conflict,
or server failure verdict. It means Google has not yet discovered and crawled
the URL in this Search Console data set.

The public site was rechecked after receiving the screenshots:

- `/service/` returns HTTP `200` to both a normal client and Googlebot.
- It declares `index, follow`.
- Its canonical points to itself.
- `sitemap_index.xml` is live and references `page-sitemap.xml`.
- `page-sitemap.xml` explicitly contains `/service/`.

The Search Console statement that no referring sitemap was detected therefore
indicates that Google has not yet processed/associated the currently published
sitemap with this property or URL. It does not mean the sitemap file is missing
from the website.

### Immediate operator actions

1. In URL Inspection, click **Test live URL** for `/service/`.
2. If the live test says the URL is available to Google, click
   **Request indexing**.
3. In **Indexing > Sitemaps**, submit `sitemap_index.xml` under the
   `eudiasporacouncil.org` Domain property and confirm that its status becomes
   **Success**.
4. Repeat URL Inspection and indexing requests for the homepage and the most
   important content pages after fixing their empty HTML titles.
5. Check the Page indexing, Manual actions, and Security issues reports before
   concluding that discovery alone is the only problem.

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
