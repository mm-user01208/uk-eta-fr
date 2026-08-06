# French organic content rollout — 2026-08-06

Target: `https://eudiasporacouncil.org/`

## Objective

Grow qualified French organic visibility by publishing useful informational
pages, connecting them through a clear hub structure, and linking each page to
the relevant application or service page without making every article a thin
sales funnel.

## Existing source material

The repository already contains French Astro drafts for the following core ETA
topics, but these routes are not present in the live WordPress sitemap:

- `/eta/qu-est-ce-que-eta/`;
- `/eta/procedure-demande/`;
- `/eta/documents-necessaires/`;
- `/eta/tarif/`;
- `/eta/validite-et-delai/`;
- `/eta/pays-eligibles/`;
- `/eta/faq/`;
- `/entree-uk/transit-correspondance/`;
- `/entree-uk/aeroport-heathrow/`;
- `/entree-uk/irlande-du-nord/`;
- `/visa/difference-eta-visa/`.

These drafts should be fact-checked against current official UK guidance and
adapted to the deployed WordPress templates rather than recreated from scratch.

## Priority rollout

### Phase 1 — core ETA intent

1. What the UK ETA is and who needs it.
2. Application procedure.
3. Required documents and photo rules.
4. Official fee, service fee, and total price explained transparently.
5. Validity, processing time, and passport changes.
6. Eligible nationalities, with a clear section for French travelers.
7. Frequently asked questions.

### Phase 2 — travel scenarios

1. Transit and connections.
2. Heathrow transit guide.
3. Northern Ireland and Republic of Ireland distinction.
4. ETA versus visa.

## Internal-link structure

- Create one visible ETA information hub linked from the global navigation.
- Link every Phase 1 article from the hub and link each article back to the hub.
- Add two to four contextual links between genuinely related articles.
- Link application CTAs to `/entry/` only where they help the reader complete the
  next step.
- Link factual claims to the relevant official GOV.UK source.
- Avoid redirecting old unrelated legacy URLs to these articles unless there is a
  genuine topic match.

## Publishing requirements

- Unique French title, H1, and meta description for each page.
- Self-referencing canonical and `index, follow`.
- Substantive, user-first content with visible update date and official sources.
- Clear disclosure that the site is an independent paid assistance service and
  not the UK government site.
- Accurate separation of the official government fee from the site's service
  charge.
- Breadcrumbs and Article structured data; FAQ structured data only where the
  visible page genuinely contains the same questions and answers.
- Add every published canonical URL to the XML sitemap.
- After publication, inspect the live URL and request indexing in Search Console.

## Success measures

Track in Search Console over 8 to 12 weeks:

- number of current sitemap URLs indexed;
- non-branded French query impressions;
- impressions and clicks originating in France;
- article-to-application click-through events in GA4, subject to consent;
- crawl and indexing status for every published article.
