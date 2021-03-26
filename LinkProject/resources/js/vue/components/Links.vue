<template>
  <ul class="p-4 rounded shadow-xl w-full">
    <li v-for="link in links" :key="link.id">
      <Link
        :link="link"
        @on-remove-link="onRemoveLink"
        @on-edit-link="onEditLink"
      />
    </li>
  </ul>
</template>

<script>
import Link from "./Link";

export default {
  name: "Links",
  props: {
    links: Array,
  },
  components: {
    Link,
  },
  methods: {
    onRemoveLink: function (id) {
      this.$emit("on-remove-link", id);
    },
    onEditLink: function (id) {
      this.$emit("on-edit-link", id);
    },
  },
};
</script>