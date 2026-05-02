# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

WordPress theme (`bs-vite`) built with Vue 3 + Vite. The theme uses Vite for bundling TypeScript/Vue/SCSS, and PHP for WordPress templating. Node 22 is required.

## Commands

```bash
# Development (starts Vite HMR dev server on localhost:3000)
yarn dev        # predev: flips vite_dev flag in functions.php + patches vite.config.js and inc/inc.vite.php

# Production build (runs type-check, eslint, stylelint before building)
yarn build      # prebuild: flips vite_dev flag to false, then stylelint/vue-tsc/eslint

# Watch mode (build without HMR)
yarn watch

# Preview (browser-sync + watch in parallel)
yarn preview

# Linting
yarn lint           # ESLint
yarn lint:fix       # ESLint with auto-fix
yarn format:scss    # Stylelint SCSS auto-fix
yarn type:check     # vue-tsc --noEmit

# Dependency management
yarn clean      # removes node_modules and all lock files
yarn restart    # clean + install + dev
```

**Note:** `yarn dev` and `yarn build` automatically toggle the `$vite_dev` variable in `functions.php` via `sed`. Do not manually edit this flag.

## Architecture

### WordPress + Vite Integration

The core of the architecture is `inc/inc.vite.php`, which switches between two modes:
- **Dev mode** (`$vite_dev = true`): loads assets from the Vite dev server at `http://localhost:3000`
- **Prod mode** (`$vite_dev = false`): reads `dist/manifest.json` and enqueues hashed files

The single JS entry point is `main.ts`, which imports `src/scss/my.scss` and `src/js/my.ts`.

### Frontend Source (`src/`)

- `src/js/my.ts` — JS/TS entry; imports modules from `src/js/modules/`
- `src/vue/vue-app.ts` — Vue 3 app initialization with Pinia
- `src/scss/my.scss` — SCSS entry; imports partials from `src/scss/partials/` and component styles from `src/scss/blocks/`

### PHP Structure

- `functions.php` — loads all `inc/*.php` modules; `$footer_page_id` is a hardcoded page ID set here
- `inc/` — theme utilities (ACF, images, search API, URL rewrites, Vite integration)
- `inc/project-variables.php` — API keys/auth tokens used by external integrations
- `shortcodes/` — simple shortcodes for company info (name, address, phone, email, VAT)
- `acf/` — ACF field group JSON exports (import via admin → Custom Fields → Tools → Import). `inc/acf.php` adds import/export filters that auto-assign `menu_order` from JSON array position, keeping field order stable across roundtrips.
- `api/search-api.php` — custom REST API: `GET /wp-json/page/v1/search?title={query}`. Schema available at `/wp-json/page/v1/search/schema`.
- `schemas/` — JSON Schema files for the search API contract (source of truth for PHP↔Vue data shape)
- `assets/libs/` — legacy jQuery plugins (slick, swiper, nouislider, etc.) loaded as static files; **not** bundled by Vite

### Vue Components

Vue is mounted selectively via `src/js/modules/helpers/mount.ts`. The main use case is the search view (`src/vue/views/SearchView.vue`). Pinia is available for state, Vuelidate for form validation, Vue Leaflet for maps.

### Feature Scaffolds

`template-parts/layouts/` contains starter files for adding new page features:
- `default.php` + `default.vue` — PHP template + Vue component pair
- `default-interface.ts` — TypeScript types for the feature's data
- `default-pinia.ts` — Pinia store scaffold
- `default-hook.ts` — composable/hook scaffold
- `api-layout.ts` / `js-layout.ts` — API and JS module scaffolds

`src/templates/` contains static HTML reference templates (design prototypes, not served by WordPress).

### Build Output

`dist/` contains hashed assets. CSS files are named `css/[name].{timestamp}.[hash].css`. After build, `dist/css/admin-style.css` is created as an unhashed copy of the main CSS (for WordPress admin use).

## Commit Convention

- `feat` — new implementations
- `fix` — non-blocking error fix
- `bugfix` — fix blocking bug in development/staging
- `upd` — general changes
- `core` — config files, dependencies, framework utilities
- `backup` — import from backup
