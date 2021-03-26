<template>
  <div class="my-4 shadow-xl rounded-lg">
    <!-- HEADER -->
    <div class="bg-gray-400 flex flex-row items-center justify-between">
      <!-- TITLE -->
      <div class="flex-grow-0">
        <h3
          @click="toggleThumbnail"
          class="p-4 text-2xl text-bold text-gray-800 cursor-pointer"
        >
          {{ link.title }}
        </h3>
      </div>
      <div class="mx-2">
        <i
          class="far fa-edit cursor-pointer text-3xl text-green-300"
          v-if="!editMood"
          @click="$emit('on-edit-link', link.id)"
        ></i>
        <i
          class="fas fa-backspace cursor-pointer text-3xl text-red-300"
          @click="$emit('on-remove-link', link.id)"
        ></i>
      </div>
    </div>

    <!-- Image -->
    <div
      v-if="sThumbnail" 
      class="w-full flex justify-center items-center">
      <img :src="link.thumbnail" :alt="link.title" class="w-40" />
    </div>

    <div class="my-2 border-gray-100">
      <p class="w-full p-4 italic">{{ link.description }}</p>
    </div>

    <div class="text-center py-3">
      <a class="text-red-500 text-2xl" :href="link.link" target="_blank"
        >Go to YouTube!</a
      >
    </div>
  </div>
</template>

<script>
import Button from "./Button";

export default {
  name: "Link",
  data: function () {
    return {
      editMood: false,
      sThumbnail: false,
    };
  },
  props: {
    link: Object,
  },
  components: {
    Button,
  },
  methods: {
    toggleThumbnail: function() {
      this.sThumbnail = !this.sThumbnail;
    },
  },
};
</script>