// @ts-check
import { defineConfig } from 'astro/config';
import tailwindcss from '@tailwindcss/vite';
import sitemap from '@astrojs/sitemap';

const site = 'https://eudiasporacouncil.org';
const redirectedUrls = new Set([
  '/eta/',
  '/eta/qu-est-ce-que-eta/',
  '/eta/tarif/',
  '/info/',
  '/info/conditions-generales/',
  '/info/mentions-legales/',
  '/info/politique-confidentialite/',
].map((path) => new URL(path, site).href));

export default defineConfig({
  site,
  integrations: [sitemap({
    filter: (page) => !redirectedUrls.has(page),
  })],
  vite: {
    plugins: [tailwindcss()]
  }
});
