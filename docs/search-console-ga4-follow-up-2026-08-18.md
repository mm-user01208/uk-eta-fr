# Search Console and GA4 follow-up — 2026-08-18

## Conclusion

No repository record confirms that the sitemap was resubmitted in Search
Console after the canonical inventory increased to 26 URLs on 2026-08-14.
Earlier Search Console guidance and screenshots used the WordPress sitemap URL
`https://eudiasporacouncil.org/sitemap_index.xml`.

The current Astro deployment uses
`https://eudiasporacouncil.org/sitemap-index.xml`. The old underscore URL now
returns the home page as `text/html` with HTTP 200 instead of sitemap XML. A
previous Search Console submission of the old URL therefore cannot process the
current sitemap correctly.

## Current public checks

- `robots.txt` permits search crawling and advertises the current hyphenated
  sitemap index.
- `sitemap-index.xml` and `sitemap-0.xml` return HTTP 200 as XML.
- `sitemap-0.xml` contains 26 canonical URLs.
- All 26 URLs return HTTP 200 to Googlebot, have self-referencing canonicals,
  and do not declare `noindex`.
- The DNS ownership-verification TXT record is still present.
- Public search results remain dominated by older `www` URLs and stale content,
  which is consistent with incomplete recrawling. A `site:` query is not a
  complete index report and must not replace Search Console evidence.

## GA4 collection test

Measurement ID: `G-Y2MEYTFRV8`.

A clean-browser production test confirmed the site's basic-consent behavior:

- before consent: no Google tag or Analytics request;
- after selecting analytics consent: `gtag.js` loaded with HTTP 200;
- a GA4 `page_view` request was sent to `google-analytics.com/g/collect` and
  accepted with HTTP 204;
- the granted choice and `_ga` cookie were stored.

The implementation is functional. Low GA4 totals can therefore result from
low traffic combined with visitors rejecting or not answering the consent
banner. If the test event is absent from Realtime, verify that the viewed GA4
property's web stream uses `G-Y2MEYTFRV8` and review property/data filters.

## Recommended operator checks

1. In the Search Console Domain property `eudiasporacouncil.org`, submit the
   complete current URL:
   `https://eudiasporacouncil.org/sitemap-index.xml`.
2. Confirm `Success`, a recent last-read time, and 26 discovered pages.
3. Remove the obsolete underscore sitemap submission after the new sitemap is
   accepted.
4. Inspect the homepage and priority new content URLs, run the live test, and
   request indexing where eligible.
5. Review Page indexing exclusions, Manual actions, and Security issues.
6. In GA4, confirm the web-stream measurement ID and check Realtime immediately
   after accepting the site's analytics cookies in a clean browser.

## Timing context

The expanded canonical inventory was promoted four days before this check.
Google documents that Search Console performance data normally has a two- to
three-day reporting delay and that recrawling changed pages can take from a few
days to a few weeks. Sitemap submission is a discovery hint, not an indexing
guarantee.

## Official references

- https://developers.google.com/search/docs/crawling-indexing/sitemaps/build-sitemap
- https://developers.google.com/search/docs/crawling-indexing/ask-google-to-recrawl
- https://support.google.com/webmasters/answer/96568
- https://support.google.com/analytics/answer/10000067
- https://support.google.com/analytics/answer/12335634
