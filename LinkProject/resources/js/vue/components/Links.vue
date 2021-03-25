<template>
  <ul class="p-4 rounded shadow-xl w-full">
    <li v-for="link in links" :key="link.id">
      <Link :link=link />
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
};
</script>