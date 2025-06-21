# Tailwind CSS в проекте Vue

## Настройка VS Code

### Ошибка @reference в VS Code

Если в компоненте:

```vue
<script setup lang="ts">
import { ChevronLeftIcon } from '@heroicons/vue/24/solid'
import { ChevronRightIcon } from '@heroicons/vue/24/solid'
</script>

<template>
  <div class="inline-flex cursor-pointer items-center p-2 text-2xl text-gray-600">
    <ChevronLeftIcon class="chevron" />
    <span class="px-1">1 июня - 30 июня</span>
    <ChevronRightIcon class="chevron" />
  </div>
</template>

<style scoped>
@reference "tailwindcss";
.chevron {
  @apply h-5 w-5 text-gray-400 hover:text-gray-600;
}
</style>
```

использовать @apply, то будет ошибка, в которой предложат использовать @reference:

```
[vite] Internal server error: Cannot apply unknown utility class `h-5`. Are you using CSS modules or similar and missing `@reference`? https://tailwindcss.com/docs/functions-and-directives#reference-directive
```

Об этом и в документации [Using @apply with Vue, Svelte, or CSS modules](https://tailwindcss.com/docs/upgrade-guide#using-apply-with-vue-svelte-or-css-modules)

Но и @reference и @apply подчеркиваются с ошибкой:

```
Unknown at rule @reference
```

Решение найдено [здесь](https://github.com/tailwindlabs/tailwindcss/discussions/5258) создать в каталоге .vscode два файла:

 - settings.json

```json
{
  "css.customData": [".vscode/tailwindcss.json"]
}
```

 - tailwindcss.json

```json
{
  "version": 1.2,
  "atDirectives": [
    {
      "name": "@theme",
      "description": "Use the `@theme` directive to define your project's custom design tokens, like fonts, colors, and breakpoints.",
      "references": [
        {
          "name": "Tailwind Documentation",
          "url": "https://tailwindcss.com/docs/functions-and-directives#theme-directive"
        }
      ]
    },
    {
      "name": "@source",
      "description": "Use the `@source` directive to explicitly specify source files that aren't picked up by Tailwind's automatic content detection.",
      "references": [
        {
          "name": "Tailwind Documentation",
          "url": "https://tailwindcss.com/docs/functions-and-directives#source-directive"
        }
      ]
    },
    {
      "name": "@utility",
      "description": "Use the `@utility` directive to add custom utilities to your project that work with variants like `hover`, `focus` and `lg`.",
      "references": [
        {
          "name": "Tailwind Documentation",
          "url": "https://tailwindcss.com/docs/functions-and-directives#utility-directive"
        }
      ]
    },
    {
      "name": "@variant",
      "description": "Use the `@variant` directive to apply a Tailwind variant to styles in your CSS.",
      "references": [
        {
          "name": "Tailwind Documentation",
          "url": "https://tailwindcss.com/docs/functions-and-directives#variant-directive"
        }
      ]
    },
    {
      "name": "@custom-variant",
      "description": "Use the `@custom-variant` directive to add a custom variant in your project.",
      "references": [
        {
          "name": "Tailwind Documentation",
          "url": "https://tailwindcss.com/docs/functions-and-directives#custom-variant-directive"
        }
      ]
    },
    {
      "name": "@apply",
      "description": "Use the `@apply` directive to inline any existing utility classes into your own custom CSS.",
      "references": [
        {
          "name": "Tailwind Documentation",
          "url": "https://tailwindcss.com/docs/functions-and-directives#apply-directive"
        }
      ]
    },
    {
      "name": "@reference",
      "description": "If you want to use `@apply` or `@variant` in the `<style>` block of a Vue or Svelte component, or within CSS modules, you will need to import your theme variables, custom utilities, and custom variants to make those values available in that context.\n\nTo do this without duplicating any CSS in your output, use the `@reference` directive to import your main stylesheet for reference without actually including the styles.",
      "references": [
        {
          "name": "Tailwind Documentation",
          "url": "https://tailwindcss.com/docs/functions-and-directives#reference-directive"
        }
      ]
    },
    {
      "name": "@config",
      "description": "Use the `@config` directive to load a legacy JavaScript-based configuration file.",
      "references": [
        {
          "name": "Tailwind Documentation",
          "url": "https://tailwindcss.com/docs/functions-and-directives#config-directive"
        }
      ]
    },
    {
      "name": "@plugin",
      "description": "Use the `@plugin` directive to load a legacy JavaScript-based plugin.",
      "references": [
        {
          "name": "Tailwind Documentation",
          "url": "https://tailwindcss.com/docs/functions-and-directives#plugin-directive"
        }
      ]
    }
  ]
}
```
