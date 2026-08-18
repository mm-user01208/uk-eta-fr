# Site navigation and HTML sitemap refresh

Date: 2026-08-18

## Reference and decision

The mobile information hierarchy was compared with `https://sardogs.net/` on desktop and at a 390 px viewport. The useful interaction pattern was retained without copying its Japanese content:

1. The mobile menu shows the primary actions and one collapsed `FAQ` row.
2. Opening `FAQ` reveals category rows. Each category name links to its hub and has a separate expand/collapse control.
3. Opening a category reveals its current page names as indented links with right arrows.

All labels and URLs come from `src/content/site-navigation.ts`, which is also used by the desktop FAQ expansion and footer. WordPress snapshot pages no longer inject archived desktop or mobile navigation, so the top page and all content pages expose the same current inventory.

## French HTML sitemap

`/sitemap/` no longer renders the archived Japanese WordPress snapshot. It now provides a French HTML sitemap containing all 26 canonical pages, grouped into four content categories:

- ETA information;
- UK entry information;
- UK visa information;
- site information.

The application and status pages are grouped with ETA information instead of appearing in a separate generic primary-pages block. Contact and service-policy pages remain under site information. The seven legacy URL aliases are intentionally excluded because their canonical replacements are listed.

The mobile FAQ menu uses one consistent horizontal separator weight. The category expand buttons have no vertical divider, avoiding the unnecessary boxed-column effect around the plus controls.
