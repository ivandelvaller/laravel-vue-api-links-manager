<template>
  <button :class="`bg-${color}-700`" @click="$emit('btn-click')">
    <slot></slot>
  </button>
</template>

<script>
export default {
  name: "Button",
  props: {
    color: {
      type: String,
      default: "gray",
    },
  },
};
</script>