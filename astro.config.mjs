// @ts-check
import { defineConfig } from 'astro/config';
import tailwindcss from '@tailwindcss/vite';
import sitemap from '@astrojs/sitemap';

const site = 'https://eudiasporacouncil.org';
const redirectedUrls = new Set([
  '/page_cat/uketa/',
  '/service/',
  '/fee/',
  '/page_cat/site/',
  '/agreement/',
  '/mentions-legales/',
  '/privacy/',
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
