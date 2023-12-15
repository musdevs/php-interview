# Vue.js

Начать новый проект с Vue и Semantic UI

1. Установить [vue-cli](https://cli.vuejs.org/ru/guide/installation.html)
```bash
yarn global add @vue/cli
```

2. [Создать проект](https://cli.vuejs.org/ru/guide/creating-a-project.html#vue-create) **my-project**
```bash
vue create my-project
```

3. Перейти в каталог проекта
```bash
cd my-project
```

4. Добавить Semantic UI Vue
```bash
yarn add semantic-ui-vue
```

5. Добавить Semantic UI
```bash
npm install semantic-ui --save-dev
```

6. Собрать Semantic UI
```bash
cd semantic
gulp build
```

7. В файле **src/main.js** добавить строки:
```javascript
import SuiVue from 'semantic-ui-vue'
import '../semantic/dist/semantic.min.css'
...
Vue.use(SuiVue);
```

Пример файла:
```javascript
import Vue from 'vue'
import App from './App.vue'
import SuiVue from 'semantic-ui-vue'
import '../semantic/dist/semantic.min.css'

Vue.config.productionTip = false;
Vue.use(SuiVue);

new Vue({
  render: h => h(App),
}).$mount('#app');
```

## Экосистема Vue.js

Хорошо описана в [комментарии](https://habr.com/ru/articles/776480/comments/#comment_26211824):

1. Frontend Framework - Vue
2. SSR Framework - Nuxt
3. SSG / Static Sites - Vitepress
4. STM - Pinia / @vue/reactivity
5. Builder - Vite
6. Test - Vitest
7. CSS framework - UnoCSS (убийца тейлвинда)
8. Linting / Formating - Stylistic / antfu-eslint-config
9. Language Tools - Volar
10. Презентации - Slidev
11. common web tasks - unjs

## Ресурсы

[Бесплатный курс по Vue.js](https://www.youtube.com/playlist?list=PLvTBThJr861yMBhpKafII3HZLAYujuNWw)
