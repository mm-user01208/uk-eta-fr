# Article sidebar and hub history — 2026-08-12

## Why `/entree-uk/` and `/visa/` are hubs

Both routes were specified as `Column list page` routes in the original site
brief and were committed in that form in the initial Astro build on 2026-03-10
(`c73466e`). There is no later commit that converted either route from an
article or WordPress-style category archive into a hub.

The French organic content plan dated 2026-08-06 retained a visible hub
structure for internal linking. The current structure is therefore deliberate,
but it originates from the initial information architecture rather than a
separately documented performance test or later SEO intervention.

## Article sidebar change

`ArticleLayout.astro` now applies the following structure to every informational
article that uses the shared layout:

- a left sidebar on desktop;
- a table of contents generated from the article's `h2` and `h3` headings;
- `Articles connexes` immediately below the table of contents;
- sticky sidebar behavior while the article scrolls;
- a single-column, non-sticky sidebar on screens up to 768 px wide.

Heading IDs are generated from their French labels when an explicit ID is not
already present. Duplicate IDs receive a numeric suffix, and the generated links
remain valid for accented headings.
