<template>
  <div class="my-3.5 flex flex-col">
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
    padding: 0.5rem 1rem;
  }

  label {
    margin: 0.5rem 0.9rem;
  }
</style>