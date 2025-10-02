<template>
  <div class="h-48 border border-b-blue-300">
    <div>i={{ dragItem }}</div>
    <div
      v-for="(item, i) in items"
      :key="i"
      class="m-4 flex inline-block h-8 w-8 content-center justify-center bg-amber-400"
      draggable="true"
      @dragstart="onDragStart($event, i)"
      @dragend="onDragEnd(i)"
    >
      {{ item }}
    </div>
  </div>

  <div class="h-48 border border-green-500" @dragover.prevent @drop="onDrop($event)">
    <div v-for="(item, i) in selected" :key="i" class="m-4 inline-block h-8 w-8 bg-amber-400">
      {{ item }}
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      items: [1, 2, 3],
      selected: [],
      dragItem: null,
    }
  },
  methods: {
    onDragStart(event, i) {
      event.dataTransfer.setData('application/json', JSON.stringify({ item: i }))
      this.dragItem = i
    },
    onDragEnd(i) {
      this.dragItem = null
    },

    parseDragData(event) {
      const data = event.dataTransfer.getData('application/json')
      debugger

      if (data) {
        try {
          const parsed = JSON.parse(data)
          return parsed.item
        } catch (e) {}
      }

      return null
    },

    onDrop(event) {
      const data = this.parseDragData(event)
      console.log('onDrop', data)
      this.selected.push(this.items[this.dragItem])
      this.items.splice(this.dragItem, 1)
    },
  },
}
</script>
