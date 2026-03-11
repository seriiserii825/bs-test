# Install

- Upload and install Advanced custom fields and All in one migration
- Rename bs-base-vite folder and theme name in style.css
- Add to you themes folder in project
- Choose theme from admin -> appearance -> themes and remove over
- Create Home page and choose Home template from sidebar -> settings -> reading
- Go to settings, permalinks and choose Name and save
- Download your empty theme from bitbucket and .git to your project
- yarn build
- yarn dev
- after finished changes, kill terminal and type yarn build
- go to admin -> appearance -> theme and activate your theme

## footer settings

- create page footer.php in theme
- import footer-fields.json from acf folder in theme
- import cookies-notice.json from acf folder in theme
- in functions.php change variable $footer_page_id with your page id
- rank-math -> general -> top right advanced settings
- page Footer in admin -> rank-math -> advanced -> noindex,nofollow check and save

## settings

- style.css change theme name with your + prefix, example bs-moonflower

## scss

my.scss

## js

- custom-jquery
- my.ts

## acf

- import settings for acf in custom-fields in admin -> tools -> import
- /import/acf-header-footer-contacts.json
- custom-fields -> tools -> import

## cookie policy

- publish coockies policy page in admin from draft
- select the template privacy policey in admin
- add the content to the page from import/privacy/page-privacy.html
- add the styles to the page from privacy-policy.scss
- install plugin "Cookie Notice & Compliance for GDPR / CCPA"
- import acf/cookies-notice.json in admin and set to Privacy policy page
- by default, for language it will be used plugin text and button text,
  for other languages add translations from page Privacy policy acf

## language

- fow widget in admin set list
- template-parts/header/language.php
- src/js/modules/header/language-selector.js
- src/scss/blocks/globals/language.scss

## Commits named

- **feat** - new implementations
- **fix** - non-blocking error fix
- **bugfix** - fix blocking bug in development / staging
- **upd** - general changes
- **core** - update of configuration files, dependencies, utilities for the framework
- **backup** - import from backup
