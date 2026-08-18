# Responsive article navigation layout

Date: 2026-08-18

## Decision

- Desktop keeps the left sidebar with the table of contents and three related-article links.
- Mobile places a collapsed table of contents after the introductory paragraph and before the first section.
- Mobile hides the upper related-article links to shorten the path to the article body.
- The image-based related-article cards at the bottom remain visible on desktop and mobile.
- Pages without an introductory paragraph place the mobile table of contents directly after the article title.

## Scope

The behavior is implemented in the shared `ArticleLayout.astro`, so it applies to every lower-level article that uses this layout.
