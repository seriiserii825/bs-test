// View your website at your own local server
// for example http://vite-php-setup.test
// http://localhost:3000 is serving Vite on development
// but accessing it directly will be empty
// IMPORTANT image urls in CSS works fine
// BUT you need to create a symlink on dev server to map this folder during dev:
// ln -s {path_to_vite}/src/assets {path_to_public_html}/assets
// on production everything will work just fine
//import vue from '@vitejs/plugin-vue'
import { defineConfig } from 'vite';
import liveReload from 'vite-plugin-live-reload';
import vue from '@vitejs/plugin-vue';
// import { chunkSplitPlugin } from "vite-plugin-chunk-split";
const { resolve } = require('path');
const fs = require('fs');
const path = require('path');
// https://vitejs.dev/config
export default defineConfig({
  plugins: [
    vue(),
    liveReload([
      __dirname + '/**/*.php',
      __dirname + '/assets/js/custom-jquery.js',
      __dirname + '/style.css'
    ]),
    copyCssWithoutHash()
  ],
  // config
  root: '',
  base: process.env.NODE_ENV === 'development' ? '/' : '/dist/',
  build: {
    // output dir for production build
    outDir: resolve(__dirname, './dist'),
    emptyOutDir: true,
    // emit manifest so PHP can find the hashed files
    // manifest: true,
    manifest: true,
    // esbuild target
    target: 'esnext',
    // our entry
    rollupOptions: {
      input: {
        main: resolve(__dirname + '/main.ts')
      },
      output: {
        manualChunks(id) {
          if (id.includes('node_modules')) {
            return 'vendor';
          }
        },
        // Custom naming pattern for JavaScript files
        entryFileNames: 'js/[name].[hash].js',
        chunkFileNames: 'js/[name].[hash].js',
        // Custom naming pattern for CSS files
        assetFileNames: ({ name }) => {
          if (name && name.endsWith('.css')) {
            return 'css/[name].[hash][extname]';
          }
          return '[name].[hash][extname]';
        }
      }
    },
    // minifying switch
    minify: true,
    write: true
  },
  css: {
    devSourcemap: true
  },
  server: {
    // required to load scripts from custom host
    cors: true,
    // we need a strict port to match on PHP side
    // change freely, but update in your functions.php to match the same port
    strictPort: true,
    port: 3000,
    // serve over http
    https: false,
    // serve over httpS
    // to generate localhost certificate follow the link:
    // https://github.com/FiloSottile/mkcert - Windows, MacOS and Linux supported - Browsers Chrome, Chromium and Firefox (FF MacOS and Linux only)
    // installation example on Windows 10:
    // > choco install mkcert (this will install mkcert)
    // > mkcert -install (global one time install)
    // > mkcert localhost (in project folder files localhost-key.pem & localhost.pem will be created)
    // uncomment below to enable https
    //https: {
    //  key: fs.readFileSync('localhost-key.pem'),
    //  cert: fs.readFileSync('localhost.pem'),
    //},
    hmr: {
      host: 'localhost'
      //port: 443
    }
  },
  // target: 'web',
  // publicPath: 'https://test.altuofianco.com/',
  // required for in-browser template compilation
  // https://v3.vuejs.org/guide/installation.html#with-a-bundler
  resolve: {
    alias: {
      // vue: 'vue/dist/vue.esm-bundler.js'
      // "@": path.resolve(__dirname, "./src"),
    }
  }
});

function copyCssWithoutHash() {
  return {
    name: 'copy-css-without-hash',
    closeBundle() {
      const cssDir = path.resolve(__dirname, 'dist/css');
      if (!fs.existsSync(cssDir)) return;

      // ищем main.*.css
      const files = fs
        .readdirSync(cssDir)
        .filter((f) => f.startsWith('main.') && f.endsWith('.css'));
      if (!files.length) return;

      const newest = files
        .map((f) => ({ f, time: fs.statSync(path.join(cssDir, f)).mtime }))
        .sort((a, b) => b.time - a.time)[0].f;

      const from = path.join(cssDir, newest);
      const to = path.join(cssDir, 'admin-style.css');
      fs.copyFileSync(from, to);
      console.log(`→ Copied ${newest} → admin-style.css`);
    }
  };
}
