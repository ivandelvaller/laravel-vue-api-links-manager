<template>
  <div class="w-100 bg-green-600">
    <Header />
    <AddLinkForm />
    <span v-if="links.count === 0">No links to show</span>
    <link-list v-else v-bind:links="links" />
  </div>
</template>

<script>
import axios from "axios";

import Header from "./components/header";
import LinkList from "./components/linkList";
import LinkListItem from "./components/linkListItem";
import AddLinkForm from "./components/AddLinkForm";

export default {
  name: "App",
  data() {
    return {
      links: {},
    };
  },
  components: {
    Header,
    LinkList,
    LinkListItem,
    AddLinkForm,
  },
  methods: {
    async getAll() {
      try {
        const response = await axios.get("api/links");

        if (response.status !== 200) {
          throw new Error("No data received.");
        }

        this.links = {
            count: response.data.count,
            linksArray: response.data.links
        };
        console.log(this.links);
      } catch (error) {
        console.log(error);
      }
    },
  },
  created() {
    this.getAll();
  },
};
</script>