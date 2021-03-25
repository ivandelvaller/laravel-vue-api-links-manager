<template>
  <div class="container">
    <Header @toggle-add-link="toggleAddLink" />
    <router-view></router-view>
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
      showForm: false,
    };
  },
  components: {
    Header,
    Links,
    LinkForm,
  },
  methods: {
    toggleAddLink() {
      this.showForm = !this.showForm;
    },
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
    try {
      this.links = await this.fetchLinks();
    } catch (error) {
      this.errors.push(error.message);
    }
  },
};
</script>