# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

WordPress theme (`bs-vite`) built with Vue 3 + Vite. The theme uses Vite for bundling TypeScript/Vue/SCSS, and PHP for WordPress templating. Node 22 is required.

## Commands

```bash
# Development (starts Vite HMR dev server on localhost:3000)
yarn dev        # also runs predev: flips vite_dev flag in functions.php to true

# Production build (runs type-check, eslint, stylelint before building)
yarn build      # also runs prebuild: flips vite_dev flag to false

# Watch mode (build without HMR)
yarn watch

# Preview (browser-sync + watch in parallel)
yarn preview

# Linting
yarn lint           # ESLint
yarn lint:fix       # ESLint with auto-fix
yarn format:scss    # Stylelint SCSS auto-fix
yarn type:check     # vue-tsc --noEmit
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

- `functions.php` — loads all `inc/*.php` modules
- `inc/` — theme utilities (ACF, images, search API, URL rewrites, Vite integration)
- `shortcodes/` — simple shortcodes for company info (name, address, phone, email, VAT)
- `acf/` — ACF field group JSON exports (import via admin → Custom Fields → Tools → Import)
- `api/search-api.php` — custom REST API endpoint for search, consumed by `src/vue/`

### Vue Components

Vue is mounted selectively via `src/js/modules/helpers/mount.ts`. The main use case is the search view (`src/vue/views/SearchView.vue`). Pinia is used for state, Vuelidate for form validation, Vue Leaflet for maps.

### Build Output

`dist/` contains hashed assets. CSS files are named `css/[name].{timestamp}.[hash].css`. After build, `dist/css/admin-style.css` is created as an unhashed copy of the main CSS (for WordPress admin use).

## Commit Convention

- `feat` — new implementations
- `fix` — non-blocking error fix
- `bugfix` — fix blocking bug in development/staging
- `upd` — general changes
- `core` — config files, dependencies, framework utilities
- `backup` — import from backup
