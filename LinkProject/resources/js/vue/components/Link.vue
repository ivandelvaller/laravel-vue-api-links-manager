<template>
  <div class="my-4 shadow-xl rounded-lg">
    <!-- HEADER -->
    <div class="bg-gray-400 flex flex-row">
      <!-- TITLE -->
      <h3 class="p-4 text-2xl text-bold text-gray-700">{{ link.title }}</h3>
    </div>

    <!-- <div class="w-full">
      <img :src="link.thumbnail" :alt="link.title" />
    </div> -->

    <!-- BODY -->
    <div>
      <p class="w-full p-4 italic">{{ link.description }}</p>
    </div>

    <!-- FOOTER -->
    <div class="bg-white text-black flex flex-row justify-around items-center p-4">
      <div class="">
        <a class="text-green-500" :href="link.link" target="_blank">WATCH!</a>
      </div>

      <div
        class="flex flex-row items-center text-gray-700"
      >
        <Button 
          class="bg-green-800"
          @btn-click="$emit('on-remove-link', link.id)">
          <i class="far fa-trash-alt"></i>
        </Button>

        <Button 
          class="bg-green-800"
          @btn-click="$emit('on-edit-link', link.id)">
          <i class="far fa-edit"></i>
        </Button>
      </div>
    </div>
  </div>
</template>

<script>
import Button from "./Button";
import axios from "axios";

export default {
  name: "Link",
  props: {
    link: Object,
  },
  components: {
    Button,
  },
  methods: {
    remove: async function () {
      try {
        const response = await axios.delete("api/link/" + link.id);
        if (response.data.success === "error") {
          throw new Error(response.data.error || "Error");
        }
        this.$emit("onlinkchanged");
      } catch (error) {}
    },
    update: async function () {
      const response = await axios.put("api/link/" + link.id, {});
    },
  },
};
</script>