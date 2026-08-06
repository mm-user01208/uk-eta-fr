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

## Follow-up — 2026-08-06

A Search Console Summary screenshot covering approximately 2026-05-05 through
2026-08-06 shows:

- 1 total Google Web Search click;
- 4 indexed pages;
- 25 not-indexed pages.

This is no longer a completely empty property, but it is still effectively not
receiving meaningful organic search exposure. The screenshot does not show the
country of origin for the single click. That must be checked in **Performance >
Search results > Countries**; the country dimension is based on where the search
originated.

The production site was rechecked on 2026-08-06:

- the homepage returns HTTP `200`;
- `robots.txt` allows crawling and references the sitemap index;
- the sitemap index and both child sitemaps return valid XML;
- the current sitemap contains 12 URLs (10 pages and 2 `page_cat` archives), not
  the 29 URLs counted in Search Console;
- current pages have non-empty titles, self-referencing canonicals, and French
  language signals (`<html lang="fr">`, `og:locale=fr_FR`, and
  `inLanguage=fr-FR` on the homepage);
- a public `site:eudiasporacouncil.org` search again returned no result from the
  target domain during this check.

The difference between the 12 current sitemap URLs and 29 Search Console URLs
suggests that the Page indexing report includes URLs outside the current sitemap,
potentially including historical, discovered, duplicate, or removed URLs. The
exact 25-URL exclusion breakdown is required before assigning a definitive
technical cause.

The domain-history mismatch remains a strategic SEO risk: public search results
associate `eudiasporacouncil.org` with the former EU Diaspora Council non-profit,
while the site now sells a French-language UK ETA application service. However,
legitimately purchasing and reusing a previously owned domain is not itself a
policy violation. Google's expired-domain-abuse policy depends on abusive purpose
and low-value use; the domain mismatch alone does not prove a penalty or explain
the current indexing report. Only Search Console's Manual actions report can
confirm whether a manual action exists; algorithmic classifications are not
directly reported.

The repository also contains a much larger planned Astro content set, but the
live WordPress sitemap exposes only 12 current URLs. The planned informational
coverage is therefore not represented on the live site and cannot contribute to
Google discovery, topical relevance, or internal linking.

### Current conclusion

French language detection is configured correctly, but the available evidence
does not show meaningful reach in France. With only one total search click and
only four indexed pages, there is too little organic visibility to claim that the
site is reaching French users. The immediate diagnostic priority is the exact
Page indexing exclusion reasons and discovery of current sitemap URLs. A
service-relevant domain may improve clarity and trust, but a domain move is not
justified by the available indexing evidence alone.

### Page-indexing evidence received later on 2026-08-06

The exclusion breakdown is:

- Not found (404): 17 URLs;
- excluded by `noindex`: 3 URLs;
- redirect: 3 URLs;
- blocked by HTTP 403: 1 URL;
- crawled, currently not indexed: 1 URL.

The 17 shown 404 examples are predominantly historical `www` URLs with numeric
`.html` paths from the former site, plus an old `/tarif` path. These are expected
legacy URLs, not 17 failed current pages. The one shown "crawled, currently not
indexed" URL is `/mentions-legales/`, a legal-information page whose exclusion
does not prevent core landing pages from ranking.

This evidence does **not** support diagnosing an expired-domain penalty. Most of
the 25 not-indexed URLs are expected legacy or intentionally excluded URLs. The
remaining actionable item is the single 403 URL, whose identity must be checked.
The three `noindex` and three redirect examples should also be reviewed to verify
that they are intentional.

The main unresolved performance issue is therefore not the total "25 not
indexed" count. It is that only four current pages are shown as indexed and the
site has generated only one search click. Current sitemap URLs that are absent
from this report should be inspected individually and requested for indexing
after confirming that the sitemap status is **Success**.

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
3. In **Indexing > Sitemaps**, submit the complete URL
   `https://eudiasporacouncil.org/sitemap_index.xml` under the
   `eudiasporacouncil.org` Domain property and confirm that its status becomes
   **Success**. A Domain property does not supply a fixed URL prefix in this
   field, so entering only `sitemap_index.xml` produces the
   **Sitemap address is invalid** error.
4. Repeat URL Inspection and indexing requests for the homepage and the most
   important content pages after fixing their empty HTML titles.
5. Check the Page indexing, Manual actions, and Security issues reports before
   concluding that discovery alone is the only problem.

The full sitemap URL was rechecked after the invalid-address screenshot was
received. It returns HTTP `200` and a valid Yoast XML sitemap index containing
`page-sitemap.xml` and `page_cat-sitemap.xml`. Its `X-Robots-Tag: noindex,
follow` response header applies to the sitemap document itself and does not
prevent Google from crawling or indexing the pages listed in it.

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
