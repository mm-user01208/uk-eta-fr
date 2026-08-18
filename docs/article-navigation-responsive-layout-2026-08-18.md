# Responsive article navigation layout

Date: 2026-08-18

## Decision

- Desktop keeps the left sidebar with the table of contents and three related-article links.
- Mobile places the same visible table-of-contents card used on desktop after the introductory paragraph and before the first section. The card follows the article content width; only nested `h3` groups retain their expand/collapse controls.
- Mobile hides the upper related-article links to shorten the path to the article body.
- The image-based related-article cards at the bottom remain visible on desktop and mobile.
- Pages without an introductory paragraph place the mobile table of contents directly after the article title.

## Follow-up correction

The first responsive implementation wrapped the mobile table of contents in a generic `details` element. Global legacy styles then added a grey summary bar and a second disclosure control, which did not match the desktop sidebar. The wrapper was removed so desktop and mobile now share the same card markup and visual hierarchy.

## Scope

The behavior is implemented in the shared `ArticleLayout.astro`, so it applies to every lower-level article that uses this layout.
