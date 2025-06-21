# Пример использования Vue 3 с TypeScript, Axios и Pinia для управления состоянием загрузки и ошибок

Вот полный пример с TypeScript, включающий типизацию всех основных элементов.

## 1. Установка зависимостей

```bash
npm install vue axios pinia @pinia/nuxt
npm install -D typescript @types/node
```

## 2. Настройка хранилища Pinia с TypeScript

`stores/apiStore.ts`:

```typescript
import { defineStore } from 'pinia'
import axios, { AxiosError, AxiosResponse } from 'axios'

interface ApiState<T = any> {
  loading: boolean
  error: string | null
  data: T | null
}

export const useApiStore = defineStore('api', {
  state: (): ApiState => ({
    loading: false,
    error: null,
    data: null
  }),
  actions: {
    async fetchData<T>(url: string): Promise<T> {
      this.loading = true
      this.error = null

      try {
        const response: AxiosResponse<T> = await axios.get(url)
        this.data = response.data
        return response.data
      } catch (err) {
        const error = err as AxiosError
        this.error = error.message || 'Произошла ошибка'
        throw error
      } finally {
        this.loading = false
      }
    },

    async postData<T>(url: string, payload: any): Promise<T> {
      this.loading = true
      this.error = null

      try {
        const response: AxiosResponse<T> = await axios.post(url, payload)
        this.data = response.data
        return response.data
      } catch (err) {
        const error = err as AxiosError
        this.error = error.message || 'Произошла ошибка'
        throw error
      } finally {
        this.loading = false
      }
    },

    clearError(): void {
      this.error = null
    }
  }
})
```

## 3. Настройка Axios с TypeScript

`api/index.ts`:

```typescript
import axios, { AxiosInstance, AxiosRequestConfig, AxiosResponse, AxiosError } from 'axios'

interface ApiResponse<T = any> {
  data: T
  status: number
  statusText: string
}

const api: AxiosInstance = axios.create({
  baseURL: 'https://jsonplaceholder.typicode.com',
  timeout: 5000,
  headers: {
    'Content-Type': 'application/json'
  }
})

// Добавляем интерцепторы
api.interceptors.response.use(
  (response: AxiosResponse) => response,
  (error: AxiosError) => {
    if (error.response) {
      error.message = `Server error: ${error.response.status} - ${error.response.data?.message || 'No message'}`
    } else if (error.request) {
      error.message = 'No response received from server'
    } else {
      error.message = `Request error: ${error.message}`
    }
    return Promise.reject(error)
  }
)

export default api
```

## 4. Компонент с TypeScript

`components/ApiComponent.vue`:

```vue
<template>
  <div>
    <h2>Пример работы с API (TypeScript)</h2>

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

<script setup lang="ts">
import { useApiStore } from '@/stores/apiStore'

interface Todo {
  userId: number
  id: number
  title: string
  completed: boolean
}

interface Post {
  userId: number
  id?: number
  title: string
  body: string
}

const apiStore = useApiStore()

const fetchData = async (): Promise<void> => {
  try {
    const data = await apiStore.fetchData<Todo>('https://jsonplaceholder.typicode.com/todos/1')
    console.log('Получены данные:', data)
  } catch (err) {
    console.error('Ошибка в компоненте:', err)
  }
}

const postData = async (): Promise<void> => {
  const payload: Post = {
    userId: 1,
    title: 'foo',
    body: 'bar'
  }

  try {
    const data = await apiStore.postData<Post>('https://jsonplaceholder.typicode.com/posts', payload)
    console.log('Данные отправлены:', data)
  } catch (err) {
    console.error('Ошибка в компоненте:', err)
  }
}
</script>

<style scoped>
/* Стили такие же, как в предыдущем примере */
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

## 5. Настройка TypeScript

`tsconfig.json`:

```json
{
  "compilerOptions": {
    "target": "ESNext",
    "module": "ESNext",
    "strict": true,
    "jsx": "preserve",
    "moduleResolution": "node",
    "esModuleInterop": true,
    "skipLibCheck": true,
    "forceConsistentCasingInFileNames": true,
    "baseUrl": ".",
    "paths": {
      "@/*": ["./src/*"]
    },
    "types": ["vite/client"],
    "lib": ["esnext", "dom", "dom.iterable"]
  },
  "include": ["src/**/*.ts", "src/**/*.d.ts", "src/**/*.tsx", "src/**/*.vue"],
  "exclude": ["node_modules"]
}
```

## 6. main.ts

`main.ts`:

```typescript
import { createApp } from 'vue'
import { createPinia } from 'pinia'
import App from './App.vue'

const app = createApp(App)
const pinia = createPinia()

app.use(pinia)
app.mount('#app')
```

## 7. App.vue

`App.vue`:

```vue
<template>
  <div id="app">
    <ApiComponent />
  </div>
</template>

<script setup lang="ts">
import ApiComponent from './components/ApiComponent.vue'
</script>
```

## Ключевые особенности TypeScript реализации:

1. **Типизация состояния хранилища**:
  - Интерфейс `ApiState` определяет структуру состояния
  - Обобщенный тип `T` позволяет работать с разными типами данных

2. **Типизация Axios**:
  - Использование `AxiosResponse`, `AxiosError` из axios
  - Типизация возвращаемых значений и ошибок

3. **Типизация компонента**:
  - Интерфейсы для данных (`Todo`, `Post`)
  - Типизация методов и возвращаемых значений
  - Явное указание типов при вызове методов хранилища

4. **Безопасность типов**:
  - Автодополнение в IDE
  - Проверка типов на этапе компиляции
  - Защита от runtime ошибок

Этот подход обеспечивает надежную типизацию всего потока данных в приложении, от API до компонентов.
