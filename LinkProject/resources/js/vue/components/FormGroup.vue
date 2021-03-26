<template>
  <div class="flex flex-col">
    <slot></slot>
    <span v-if="hasError">{{errorMessage}}</span>
  </div>
</template>

<script>
export default {
  name: "FormGroup",
  props: {
    hasError: {
        type: Boolean,
        default: false
    },
    errorMessage: {
      type: String,
      defualt: "Incorrect field."
    },
  },
};
</script>

<style scoped>
  input, textarea {
    font-family: inherit;
    padding: 1rem 2rem;
  }

  label {
    margin: 0.5rem 0;
  }
</style>