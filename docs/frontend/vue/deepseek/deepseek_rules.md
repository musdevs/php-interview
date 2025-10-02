# Требования к генерации кода

## Контекст

## Стек

Vue 3 + TypeScript + Pinia + Tailwind CSS

## Требования к коду

- Composition API с <script setup>
- Секция script в начале компонента
- Типизация TypeScript
- Использование Pinia store (store/customerStore)
- Tailwind CSS для стилей
- Анимация появления/исчезновения через Transition

## Детализация по стеку

### Для Vue 3

```vue
<script setup lang="ts">
// Код компонента
</script>

<template>
  <!-- Разметка -->
</template>

<style scoped>
/* Стили если нужны */
</style>
```

### Для Pinia

```typescript
// Укажи какой store использовать
import { useCustomerStore } from '@/stores/customerStore'
```

### Для TypeScript

- Указывай интерфейсы для пропсов и данных
- Используй строгую типизацию

### Для Tailwind

- Используй классы Tailwind вместо кастомных стилей
- Указывай если нужны кастомные стили в <style scoped>

## Дополнительные пожелания

Именование: camelCase для переменных, PascalCase для компонентов
Структура: Определённый порядок в script (импорты, пропсы, store, данные, computed, функции)

## Конкретная задача
