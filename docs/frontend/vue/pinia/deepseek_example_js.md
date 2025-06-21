# Пример использования Vue 3 с Axios, Pinia для управления состоянием загрузки и ошибок

Вот полный пример реализации с использованием Vue 3, Axios и Pinia для управления состоянием загрузки и ошибок в приложении.

## 1. Установка зависимостей

Сначала установите необходимые пакеты:

```bash
npm install vue axios pinia @pinia/nuxt
```

## 2. Настройка хранилища Pinia

Создадим хранилище для управления состоянием загрузки и ошибок.

`stores/apiStore.js`:

```javascript
import { defineStore } from 'pinia'
import axios from 'axios'

export const useApiStore = defineStore('api', {
  state: () => ({
    loading: false,
    error: null,
    data: null
  }),
  actions: {
    async fetchData(url) {
      this.loading = true
      this.error = null

      try {
        const response = await axios.get(url)
        this.data = response.data
        return response.data
      } catch (err) {
        this.error = err.message || 'Произошла ошибка'
        throw err
      } finally {
        this.loading = false
      }
    },

    async postData(url, payload) {
      this.loading = true
      this.error = null

      try {
        const response = await axios.post(url, payload)
        this.data = response.data
        return response.data
      } catch (err) {
        this.error = err.message || 'Произошла ошибка'
        throw err
      } finally {
        this.loading = false
      }
    },

    clearError() {
      this.error = null
    }
  }
})
```

## 3. Настройка Axios (опционально)

Можно создать экземпляр Axios с базовыми настройками:

`api/index.js`:

```javascript
import axios from 'axios'

const api = axios.create({
  baseURL: 'https://api.example.com',
  timeout: 5000,
  headers: {
    'Content-Type': 'application/json'
  }
})

// Перехватчики для обработки ошибок
api.interceptors.response.use(
  response => response,
  error => {
    if (error.response) {
      // Ошибки сервера (не 2xx)
      error.message = `Server error: ${error.response.status} - ${error.response.data?.message || 'No message'}`
    } else if (error.request) {
      // Запрос был сделан, но ответ не получен
      error.message = 'No response received from server'
    } else {
      // Ошибка при настройке запроса
      error.message = `Request error: ${error.message}`
    }

    return Promise.reject(error)
  }
)

export default api
```

## 4. Компонент для отображения состояния

Создадим компонент, который использует хранилище:

`components/ApiComponent.vue`:

```vue
<template>
  <div>
    <h2>Пример работы с API</h2>

    <!-- Индикатор загрузки -->
    <div v-if="apiStore.loading" class="loading">
      Загрузка данных...
    </div>

    <!-- Сообщение об ошибке -->
    <div v-if="apiStore.error" class="error">
      Ошибка: {{ apiStore.error }}
      <button @click="apiStore.clearError()">×</button>
    </div>

    <!-- Данные -->
    <div v-if="apiStore.data">
      <pre>{{ apiStore.data }}</pre>
    </div>

    <!-- Кнопки для тестирования -->
    <div class="actions">
      <button
        @click="fetchData"
        :disabled="apiStore.loading"
      >
        Получить данные
      </button>

      <button
        @click="postData"
        :disabled="apiStore.loading"
      >
        Отправить данные
      </button>
    </div>
  </div>
</template>

<script setup>
import { useApiStore } from '@/stores/apiStore'

const apiStore = useApiStore()

const fetchData = async () => {
  try {
    await apiStore.fetchData('https://jsonplaceholder.typicode.com/todos/1')
  } catch (err) {
    console.error('Ошибка в компоненте:', err)
  }
}

const postData = async () => {
  try {
    await apiStore.postData('https://jsonplaceholder.typicode.com/posts', {
      title: 'foo',
      body: 'bar',
      userId: 1
    })
  } catch (err) {
    console.error('Ошибка в компоненте:', err)
  }
}
</script>

<style scoped>
.loading {
  padding: 1rem;
  background: #fff9c4;
  margin: 1rem 0;
}

.error {
  padding: 1rem;
  background: #ffcdd2;
  margin: 1rem 0;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.error button {
  background: none;
  border: none;
  font-size: 1.2rem;
  cursor: pointer;
}

.actions {
  margin-top: 1rem;
  display: flex;
  gap: 1rem;
}

button {
  padding: 0.5rem 1rem;
  cursor: pointer;
}

button:disabled {
  opacity: 0.5;
  cursor: not-allowed;
}
</style>
```

## 5. Основной файл приложения

`main.js`:

```javascript
import { createApp } from 'vue'
import { createPinia } from 'pinia'
import App from './App.vue'

const app = createApp(App)
const pinia = createPinia()

app.use(pinia)
app.mount('#app')
```

## 6. App.vue

`App.vue`:

```vue
<template>
  <div id="app">
    <ApiComponent />
  </div>
</template>

<script setup>
import ApiComponent from './components/ApiComponent.vue'
</script>
```

## Как это работает:

1. **Pinia хранилище** управляет состоянием загрузки (`loading`), ошибок (`error`) и данных (`data`).
2. **Действия хранилища** (`fetchData`, `postData`) выполняют запросы и автоматически обновляют состояние.
3. **Компонент** подписывается на состояние хранилища и отображает:
  - Индикатор загрузки, когда `loading = true`
  - Сообщение об ошибке, когда есть `error`
  - Полученные данные, когда они доступны
4. **Обработка ошибок** происходит на нескольких уровнях:
  - В хранилище (запись ошибки в состояние)
  - В компоненте (дополнительная обработка при необходимости)

Этот подход обеспечивает централизованное управление состоянием API-запросов и может быть легко расширен для поддержки более сложных сценариев.
