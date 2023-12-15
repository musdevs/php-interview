# Хуки

## updated

Можно ресайзить родительский элемент

```vue
<template>
  <div ref="container">
    Hello
  </div>
</template>

<script>
  export default {
    name: "Hello",
    updated() {
      this.$nextTick(function () {
        if (window.BX24) {
          let container = this.$refs.container;

          if (container) {
            window.BX24.resizeWindow(
              document.body.clientWidth,
              container.offsetHeight,
            );
          }
        }
      });
    }
  }
</script>
```
