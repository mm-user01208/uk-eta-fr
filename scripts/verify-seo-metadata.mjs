const origin = 'https://eudiasporacouncil.org';

const pages = [
  {
    path: '/page_cat/uketa/',
    title: 'Infos ETA Royaume-Uni | UK ETA Application Site',
    description:
      'Découvrez toutes les informations sur l’ETA pour le Royaume-Uni : conditions d’éligibilité, procédure de demande, documents nécessaires et conseils pratiques pour votre voyage.',
  },
  {
    path: '/',
    title: 'Faire la demande d’ETA：UK ETA application site',
    description:
      "La demande d'ETA sur le site UK ETA Application Site prend environ 10 minutes et doit être soumise au moins 72 heures avant le départ.",
  },
  {
    path: '/service/',
    title: 'À propos de l’ETA Royaume-Uni | UK ETA Application Site',
    description:
      'L’ETA, instaurée par le ministère britannique de l’Intérieur en 2025, est une autorisation obligatoire pour les Français se rendant au Royaume-Uni.',
  },
  {
    path: '/fee/',
    title: 'Frais de demande ETA pour le Royaume-Uni | UK ETA Application Site',
    description:
      'Découvrez les frais et les modes de paiement pour la demande d’ETA, les cartes acceptées et la façon d’obtenir un reçu.',
  },
  {
    path: '/page_cat/site/',
    title: 'Liste des informations sur le site | UK ETA Application Site',
    description:
      'Cette page regroupe les informations essentielles du site de demande UK ETA, notamment le formulaire de demande, la vérification des informations, les coordonnées de contact, la politique de confidentialité, les mentions légales et les conditions d’utilisation.',
  },
  {
    path: '/entry/',
    title: 'Demander l’ETA | UK ETA Application Site',
    description:
      'L’ETA est une autorisation électronique obligatoire pour voyager au Royaume-Uni à des fins touristiques ou professionnelles. La demande dure 10 min.',
  },
  {
    path: '/status/',
    title: 'Vérifier la demande | UK ETA Application Site',
    description:
      'L’ETA est une autorisation électronique obligatoire pour voyager au Royaume-Uni à des fins touristiques ou professionnelles. La demande dure 10 min.',
  },
  {
    path: '/contact/',
    title: 'Contact | UK ETA Application Site',
    description:
      'L’ETA est une autorisation électronique obligatoire pour voyager au Royaume-Uni à des fins touristiques ou professionnelles. La demande dure 10 min.',
  },
  {
    path: '/privacy/',
    title: 'Politique de confidentialite | UK ETA Application Site',
    description:
      'Vos données sont protégées conformément au RGPD. Découvrez nos pratiques de collecte, d’utilisation et de sécurité des informations.',
  },
  {
    path: '/mentions-legales/',
    title: 'Mentions legales | UK ETA Application Site',
    description:
      'Mentions légales du site UK ETA : informations sur l’exploitant, les services d’autorisation de voyage et la conformité au RGPD.',
  },
  {
    path: '/agreement/',
    title: 'Conditions générales de services | UK ETA Application Site',
    description:
      "Le site UK ETA application a établi des conditions d'utilisation basées sur sa politique de confidentialité afin de fournir à ses clients un service approprié.",
  },
];

function decodeEntities(value) {
  return value
    .replace(/&#(\d+);/g, (_, number) =>
      String.fromCodePoint(Number(number)),
    )
    .replace(/&#x([0-9a-f]+);/gi, (_, number) =>
      String.fromCodePoint(Number.parseInt(number, 16)),
    )
    .replace(/&apos;|&#039;/g, "'")
    .replace(/&quot;/g, '"')
    .replace(/&amp;/g, '&')
    .replace(/&lt;/g, '<')
    .replace(/&gt;/g, '>')
    .replace(/&rsquo;/g, '’');
}

function extractMetadata(html) {
  const titles = [...html.matchAll(/<title[^>]*>([\s\S]*?)<\/title>/gi)].map(
    (match) => decodeEntities(match[1].trim()),
  );
  const descriptionMatch = html.match(
    /<meta[^>]+name=["']description["'][^>]+content=["']([\s\S]*?)["']\s*\/?\s*>/i,
  );

  return {
    titles,
    description: descriptionMatch
      ? decodeEntities(descriptionMatch[1])
      : '',
  };
}

const results = await Promise.all(
  pages.map(async (expected) => {
    const url = new URL(expected.path, origin);
    url.searchParams.set('seo_verify', Date.now().toString());

    const response = await fetch(url);
    const metadata = extractMetadata(await response.text());

    const passed =
      response.status === 200 &&
      metadata.titles.length === 1 &&
      metadata.titles[0] === expected.title &&
      metadata.description === expected.description;

    return {
      ...expected,
      status: response.status,
      actualTitle: metadata.titles[0] ?? '',
      titleCount: metadata.titles.length,
      actualDescription: metadata.description,
      passed,
    };
  }),
);

for (const result of results) {
  console.log(
    `${result.passed ? 'PASS' : 'FAIL'} ${result.path} HTTP ${result.status} TITLE_COUNT ${result.titleCount}`,
  );

  if (!result.passed) {
    console.log(`  actual title: ${JSON.stringify(result.actualTitle)}`);
    console.log(`  expected title: ${JSON.stringify(result.title)}`);
    console.log(
      `  actual description: ${JSON.stringify(result.actualDescription)}`,
    );
    console.log(`  expected description: ${JSON.stringify(result.description)}`);
  }
}

if (results.some((result) => !result.passed)) {
  process.exitCode = 1;
}
