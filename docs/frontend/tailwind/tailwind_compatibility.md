# Совместимость Tailwind CSS между версиями

## Прозрачность фона (bg-opacity-50 -> /50)

```html
<!-- ✅ Правильно для Tailwind 4 -->
<div class="fixed inset-0 bg-black/50 z-30">
  <aside class="w-64 bg-white">
    <!-- Непрозрачный aside -->
  </aside>
</div>

<!-- ❌ То, что давало эффект прозрачности для всего -->
<div class="fixed inset-0 bg-black opacity-50 z-30">
  <aside class="w-64 bg-white">
    <!-- Тоже прозрачный aside -->
  </aside>
</div>
```
