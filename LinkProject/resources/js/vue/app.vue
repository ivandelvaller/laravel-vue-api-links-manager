<template>
  <div class="container ">
    <Header />
    <LinkForm @link-submitted="addLink" :title="'Add a new link'"/>
    <Links :links="links" />
  </div>
</template>

<script>
import axios from "axios";

import Header from "./components/Header";
import Links from "./components/Links";
import LinkForm from "./components/LinkForm";

export default {
  name: "App",
  data() {
    return {
      links: [],
      errors: [],
    };
  },
  components: {
    Header,
    Links,
    LinkForm,
  },
  methods: {
    addLink(link) {
      console.log("Link added", link);
    },
    async fetchLinks() {
      const response = await axios.get("api/links");

      if (response.status !== 200) {
        throw new Error("No data received.");
      }
      return response.data.links;
    },
  },
  async created() {
    this.links = await this.fetchLinks();
  },
};
</script>