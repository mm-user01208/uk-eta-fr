# Mobile FAQ and navigation UI update — 2026-08-04

Target: `https://eudiasporacouncil.org/`

## Requested changes

- Remove the native disclosure triangle from the front-page FAQ rows.
- Show a plus when a FAQ row is closed and a minus when it is open.
- Replace the broken lower-page return-link Material Icons text fragment with
  a CSS triangle.
- Inset the mobile navigation panel from the left edge.
- Shorten the top-level white separator lines.
- Add visible chevrons to the mobile FAQ and category controls.
- Expose each category's child pages when its category control is opened.
- Make the left two thirds of each category row open its category archive and
  the right third toggle its child-page accordion.
- Keep the original navy navigation design and distinguish hierarchy through
  indentation: category names begin to the right of the FAQ label, and child
  pages are indented one step farther.
- Prefix each child-page name with a small visible triangle marker.

## Implementation

- The FAQ marker is drawn with CSS gradients, so it has no font dependency.
- The lower-page return marker is a CSS triangle and no longer relies on the
  removed Material Icons font.
- Mobile navigation uses explicit `aria-expanded`, `aria-controls`, and
  `aria-hidden` states.
- Each category row has two overlay controls: a two-thirds category link on
  the left and a one-third accordion button on the right.
- The mobile FAQ opens the taxonomy categories; each category independently
  opens its dynamic WordPress page links.
- Child-page triangle markers are decorative and hidden from assistive
  technology so link labels remain concise.
- The mobile navigation controller is provided by the performance plugin on
  every page. Updated IDs/classes prevent the legacy jQuery handlers from
  firing a second time on lower pages.
