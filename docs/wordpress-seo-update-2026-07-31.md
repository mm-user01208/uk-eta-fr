# WordPress SEO update — 2026-07-31

Target: `https://eudiasporacouncil.org/`

## Cause of the empty title element

The active WordPress theme is `uketa-fr`. Its deployed `header.php` contained a
literal empty title element:

```html
<title></title>
```

Yoast SEO was already generating the configured title for Open Graph and
structured data, but the theme's empty element prevented a normal HTML document
title from appearing.

The fix changes that line to:

```php
<title><?php echo esc_html(wp_get_document_title()); ?></title>
```

The complete updated `header.php` is stored in
`wordpress-theme/uketa-fr/header.php`.

## Requested Yoast metadata

- `/page_cat/uketa/`
  - Title: `Infos ETA Royaume-Uni | UK ETA Application Site`
  - Description: `Découvrez toutes les informations sur l’ETA pour le Royaume-Uni : conditions d’éligibilité, procédure de demande, documents nécessaires et conseils pratiques pour votre voyage.`
- `/`
  - Title: `Faire la demande d’ETA：UK ETA application site`
  - Description: `La demande d'ETA sur le site UK ETA Application Site prend environ 10 minutes et doit être soumise au moins 72 heures avant le départ.`
- `/service/`
  - Title: `À propos de l’ETA Royaume-Uni | UK ETA Application Site`
  - Description: `L’ETA, instaurée par le ministère britannique de l’Intérieur en 2025, est une autorisation obligatoire pour les Français se rendant au Royaume-Uni.`
- `/fee/`
  - Title: `Frais de demande ETA pour le Royaume-Uni | UK ETA Application Site`
  - Description: `Découvrez les frais et les modes de paiement pour la demande d’ETA, les cartes acceptées et la façon d’obtenir un reçu.`
- `/page_cat/site/`
  - Title: `Liste des informations sur le site | UK ETA Application Site`
  - Description: `Cette page regroupe les informations essentielles du site de demande UK ETA, notamment le formulaire de demande, la vérification des informations, les coordonnées de contact, la politique de confidentialité, les mentions légales et les conditions d’utilisation.`
- `/entry/`
  - Title: `Demander l’ETA | UK ETA Application Site`
  - Description: `L’ETA est une autorisation électronique obligatoire pour voyager au Royaume-Uni à des fins touristiques ou professionnelles. La demande dure 10 min.`
- `/status/`
  - Title: `Vérifier la demande | UK ETA Application Site`
  - Description: `L’ETA est une autorisation électronique obligatoire pour voyager au Royaume-Uni à des fins touristiques ou professionnelles. La demande dure 10 min.`
- `/contact/`
  - Title: `Contact | UK ETA Application Site`
  - Description: `L’ETA est une autorisation électronique obligatoire pour voyager au Royaume-Uni à des fins touristiques ou professionnelles. La demande dure 10 min.`
- `/privacy/`
  - Title: `Politique de confidentialite | UK ETA Application Site`
  - Description: `Vos données sont protégées conformément au RGPD. Découvrez nos pratiques de collecte, d’utilisation et de sécurité des informations.`
- `/mentions-legales/`
  - Title: `Mentions legales | UK ETA Application Site`
  - Description: `Mentions légales du site UK ETA : informations sur l’exploitant, les services d’autorisation de voyage et la conformité au RGPD.`
- `/agreement/`
  - Title: `Conditions générales de services | UK ETA Application Site`
  - Description: `Le site UK ETA application a établi des conditions d'utilisation basées sur sa politique de confidentialité afin de fournir à ses clients un service approprié.`

## WordPress object mapping

- Front page: page ID `4`
- `/entry/`: page ID `5`
- `/status/`: page ID `7`
- `/contact/`: page ID `8`
- `/fee/`: page ID `10`
- `/privacy/`: page ID `13`
- `/service/`: page ID `14`
- `/agreement/`: page ID `15`
- `/mentions-legales/`: page ID `45`
- `/page_cat/uketa/`: `page_cat` term ID `5`
- `/page_cat/site/`: `page_cat` term ID `7`

## Completion

The requested Yoast titles and meta descriptions were applied in WordPress.
The active theme's `header.php` was updated so every page emits one non-empty
HTML title element. All 11 requested URLs were then fetched from production and
verified for:

- HTTP `200`
- exactly one `<title>` element
- an exact title match
- an exact meta-description match

The production check can be repeated with:

```bash
node scripts/verify-seo-metadata.mjs
```
