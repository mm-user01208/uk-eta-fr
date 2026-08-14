export const siteNavigationSections = [
  {
    id: 'eta',
    title: 'Infos ETA Royaume-Uni',
    href: '/eta/',
    links: [
      { href: '/', label: 'ETA Royaume-Uni — Accueil' },
      { href: '/eta/qu-est-ce-que-eta/', label: "À propos de l’ETA" },
      { href: '/eta/tarif/', label: 'Frais ETA Royaume-Uni' },
      { href: '/eta/pays-eligibles/', label: 'Pays éligibles à l’ETA' },
      { href: '/eta/procedure-demande/', label: 'Procédure de demande' },
      { href: '/eta/documents-necessaires/', label: 'Documents nécessaires' },
      { href: '/eta/validite-et-delai/', label: 'Validité et délais' },
      { href: '/eta/faq/', label: 'Questions fréquentes' },
    ],
  },
  {
    id: 'entry',
    title: 'Entrée au Royaume-Uni',
    href: '/entree-uk/',
    links: [
      { href: '/entree-uk/aeroport-heathrow/', label: 'Aéroport de Londres-Heathrow' },
      { href: '/entree-uk/transit-correspondance/', label: 'Transit et correspondance' },
      { href: '/entree-uk/irlande-du-nord/', label: 'Irlande du Nord et ETA' },
    ],
  },
  {
    id: 'visa',
    title: 'Visas Royaume-Uni',
    href: '/visa/',
    links: [
      { href: '/visa/creative-worker/', label: 'Creative Worker Concession' },
      { href: '/visa/permitted-paid-engagement/', label: 'Permitted Paid Engagement' },
      { href: '/visa/difference-eta-visa/', label: 'Différence entre ETA et visa' },
    ],
  },
  {
    id: 'site',
    title: 'Infos du site',
    href: '/info/',
    links: [
      { href: '/entry/', label: 'Demander l’ETA' },
      { href: '/status/', label: 'Vérifier la demande' },
      { href: '/contact/', label: 'Contact' },
      { href: '/info/politique-confidentialite/', label: 'Politique de confidentialité' },
      { href: '/info/mentions-legales/', label: 'Mentions légales' },
      { href: '/info/conditions-generales/', label: 'Conditions générales' },
      { href: '/info/a-propos/', label: 'À propos de notre service' },
      { href: '/sitemap/', label: 'Plan du site' },
    ],
  },
] as const;
