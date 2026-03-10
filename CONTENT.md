# UK ETA France - Astro Site Build Instructions

## Goal
Build a complete Astro static site for UK ETA French application agency, ready for Netlify deployment.

## Deploy Info
- Netlify site ID: 32f8c9aa-d800-46e8-ba75-ef8a742b433c
- Netlify token: nfp_5BisGqwzRhwmBcmCXxbPs3qdMu68BmDJb2ab
- Domain: eudiasporacouncil.org

## Design
- Clean professional design, navy/blue color scheme
- Mobile responsive
- French language throughout
- Header: site logo/name + nav (ETA Royaume-Uni, Demander ETA, Vérifier, Contact, FAQ)
- Footer: legal links, company info, credit card logos
- Reference design: sardogs.net (similar UK ETA site in Japanese)

## Site Structure
Create ALL of these pages:

### Main Pages
1. / (index) - Hero + overview of ETA, 4-step process, key stats (6 months stay, 2 year validity, 87 countries, 3 day processing), FAQ section, payment info
2. /contact/ - Contact form (show maintenance message for now)
3. /entry/ - Application form placeholder (closed/maintenance)
4. /status/ - Status check placeholder (closed/maintenance)

### ETA Category (/eta/)
5. /eta/ - Column list page linking to all ETA articles
6. /eta/qu-est-ce-que-eta/ - What is ETA (Electronic Travel Authorisation), effective April 2 2025, like US ESTA/Canada eTA, for stays up to 6 months
7. /eta/procedure-demande/ - 4-step application process: fill form, pay, review (72h), notification
8. /eta/tarif/ - Fees: 75.00 GBP TTC (incl 16 GBP gov fee + 12.50 GBP TVA), cancellation policy (6 GBP fee)
9. /eta/pays-eligibles/ - Eligible countries by region (Asia, Americas, Oceania, Europe incl France, Middle East, Africa)
10. /eta/documents-necessaires/ - Required docs: passport, credit card, email, ID photo (conditions: 3 months, jpg, vertical, no filter)
11. /eta/validite-et-delai/ - Valid 2 years, multiple entries, expires with passport, results in 3 days usually
12. /eta/faq/ - FAQ with structured data (Schema.org FAQPage): 6 Q&As about requirement, timing, validity, etc

### UK Entry Category (/entree-uk/)
13. /entree-uk/ - Column list page
14. /entree-uk/aeroport-heathrow/ - Heathrow airport guide for travelers
15. /entree-uk/irlande-du-nord/ - Northern Ireland travel, ETA scope (England/Scotland/Wales/NI), Republic of Ireland distinction
16. /entree-uk/transit-correspondance/ - Transit rules: airside (not required), landside/Eurostar (required)

### Visa Category (/visa/)
17. /visa/ - Column list page
18. /visa/difference-eta-visa/ - ETA vs Visa comparison, when each is needed
19. /visa/creative-worker/ - Creative Worker Visa Concession, artists, Certificate of Sponsorship
20. /visa/permitted-paid-engagement/ - Permitted Paid Engagement for specialists

### Site Info (/info/)
21. /info/ - Info list page
22. /info/mentions-legales/ - Legal notices (Misaki Mori, Ginza Tokyo address, EU ODR link, RGPD compliance)
23. /info/conditions-generales/ - Terms of service (11 articles)
24. /info/politique-confidentialite/ - Privacy policy (RGPD compliant, 11 sections)
25. /info/a-propos/ - About the service: French forms, 24/7 support, status check, error correction

## Company Info (for footer/legal pages)
- Site name: UK ETA Application Site
- Representative: Misaki Mori
- Address: Daiichi Koseikan Bldg., 3-14-13 Ginza, Chuo-ku, Tokyo 104-0061, Japan
- Email: support@uketa-travel.net
- Phone: +81-3-6899-5493
- French Embassy in UK: 58 Knightsbridge London SW1X 7JT, tel (020) 7073-1000
- Fee: 75.00 GBP TTC (incl 16 GBP gov fee)
- Payment: VISA, Mastercard, JCB, American Express, Diners Club

## SEO Requirements
- Unique meta title + description per page
- hreflang tag (fr)
- sitemap.xml (auto-generated)
- robots.txt
- Open Graph tags
- FAQ structured data (Schema.org FAQPage) on FAQ page
- Organization schema on homepage
- Internal linking between related articles
- Breadcrumb navigation

## Tech Stack
- Astro (latest)
- No framework (pure Astro components)
- CSS: vanilla CSS or Tailwind
- Static output (for Netlify)

## Content Language
ALL content must be in French. Write real, substantive content for each page (not placeholder lorem ipsum). Each article should be 800-1500 words of real informational content about UK ETA for French travelers.

## After Build
Run `npm run build` to verify the site builds successfully.
