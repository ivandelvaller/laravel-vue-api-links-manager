<template>
  <header class="bg-green-700 text-white mx-auto py-4 flex flex-col md:flex-col">
      <div class="text-center mb-8">
        <h1 class="font-bold text-3xl">Links App</h1>
      </div>

      <div class="mx-auto">
          <Button @btn-click="$emit('toggle-add-link')" class="bg-gray-200 text-black rounded p-1">
              Add link <i class="fas fa-plus"></i>
          </Button>
      </div>
  </header>
</template>

<script>
import Button from './Button';
export default {
  name: "Header",
  components: {
      Button
  }
};
</script>
