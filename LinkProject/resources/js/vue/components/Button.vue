<template>
  <button @click="$emit('btn-click')">{{ this.textButton }}</button>
</template>

<script>
export default {
  name: "Button",
  props: {
    textButton: {
      type: String,
      default: "Button",
    },
    color: {
      type: String,
      default: "green",
    },
  },
};
</script>