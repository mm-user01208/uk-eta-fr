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
- Make the left half of each category row open its category archive and the
  right half toggle its child-page accordion.
- Use separate colours for the FAQ control, category rows, and child links so
  the three navigation levels remain easy to distinguish.

## Implementation

- The FAQ marker is drawn with CSS gradients, so it has no font dependency.
- The lower-page return marker is a CSS triangle and no longer relies on the
  removed Material Icons font.
- Mobile navigation uses explicit `aria-expanded`, `aria-controls`, and
  `aria-hidden` states.
- Each category row has two equal overlay controls: a category link on the
  left and an accordion button on the right. The visible category label spans
  the row without changing those hit areas.
- The mobile FAQ opens the taxonomy categories; each category independently
  opens its dynamic WordPress page links.
- The mobile navigation controller is provided by the performance plugin on
  every page. Updated IDs/classes prevent the legacy jQuery handlers from
  firing a second time on lower pages.
