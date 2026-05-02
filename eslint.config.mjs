import pluginVue from 'eslint-plugin-vue';
import tseslint from 'typescript-eslint';
import vueParser from 'vue-eslint-parser';

export default [
  ...tseslint.configs.recommended,
  ...pluginVue.configs['flat/recommended'],
  {
    files: ['**/*.vue'],
    languageOptions: {
      parser: vueParser,
      parserOptions: {
        parser: tseslint.parser,
        sourceType: 'module'
      }
    }
  },
  {
    files: ['**/*.ts', '**/*.tsx', '**/*.vue'],
    rules: {
      // логика — оставляем
      'vue/no-v-html': 'off',
      'vue/multi-word-component-names': 'off',
      'vue/attributes-order': 'off',

      // форматирование — всё off, пусть prettier
      'vue/max-attributes-per-line': 'off',
      'vue/html-self-closing': 'off',
      'vue/html-closing-bracket-newline': 'off',
      'vue/html-closing-bracket-spacing': 'off',
      'vue/html-indent': 'off',
      'vue/singleline-html-element-content-newline': 'off'
    }
  },
  {
    ignores: ['node_modules', 'dist', 'vendor', '*.php', '**/*.js']
  }
];
