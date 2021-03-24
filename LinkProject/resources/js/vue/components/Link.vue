<template>
  <div>
    <h3>{{ link.title }}</h3>
    <div>
      <img :src="link.thumbnail" :alt="link.title" />
    </div>
    <p>{{ link.description }}</p>
    <hr />
    <p>Click <a :href="link.link">here</a> to watch now!</p>
    <div>
      <Button
        @btn-click="$emit('on-remove-link', link.id)"
        :textButton="'Remove'"/>
      <Button 
        @btn-click="$emit('on-edit-link', link.id)" 
        :textButton="'Edit'" />
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