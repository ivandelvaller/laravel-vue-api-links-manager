<template>
  <main class="mx-2">
    <!-- <Modal>
      <div class="bg-transparent">
        <LinkForm />
      </div>
    </Modal> -->

    <!-- display form button -->
    <Button
      @click="toggleAddLink"
      class="bg-gray-200 text-black rounded p-1 w-full"
    >
      <span v-text="showForm ? 'Close' : 'Add link'"> </span>
      <i v-if="!showForm" class="fas fa-plus"></i>
      <i v-if="showForm" class="fas fa-times-circle"></i>
    </Button>

    <LinkForm 
      :editMood="true"
      v-if="showForm && !isLoading" 
      @link-submitted="addLink" />

    <!-- display list button -->
    <Button
      v-if="links.length > 0"
      @click="toggleList"
      class="bg-gray-200 text-black rounded p-1 w-full"
    >
      <span v-text="showList ? 'Close' : 'Display links'"> </span>
      <i v-if="!showList" class="fas fa-plus"></i>
      <i v-if="showList" class="fas fa-times-circle"></i>
    </Button>

    <Message color="red" v-if="errors.hasError">
      <strong>Error!</strong>
      <p v-for="(error, index) in errors" :key="index">{{ error.message }}</p>
    </Message>

    <Loading v-if="isLoading" />

    <Message v-if="links.length === 0">
      <p>This list is empty!</p>
    </Message>

    <Links
      @on-remove-link="removeLink"
      @on-edit-link="editLink"
      v-else-if="showList && !isLoading"
      :links="links"
    />
  </main>
</template>

<script>
import axios from "axios";

import LinkForm from "../components/LinkForm";
import Links from "../components/Links";
import Message from "../components/Message";
import Loading from "../components/Loading";
import Modal from "../components/Modal";

export default {
  name: "Dashboard",
  data() {
    return {
      links: [],
      errors: {},
      showForm: false,
      showList: false,
      isLoading: false,
    };
  },
  components: {
    Links,
    LinkForm,
    Message,
    Loading,
    Modal,
  },
  methods: {
    toggleAddLink() {
      this.showForm = !this.showForm;
    },
    toggleList() {
      this.showList = !this.showList;
    },
    addLink: async function (link) {
      this.isLoading = true;
      try {
        const response = await axios.post("api/link/store", link);

        if (await response.data.success) {
          this.links = await this.fetchLinks();
        }

        if (response.status === 400) {
          throw new Error(response.data.error.message);
        }
      } catch (error) {
        console.log(error);
      } finally {
        this.isLoading = false;
        this.showForm = false;
        this.showList = true;
      }
    },
    removeLink: async function (id) {
      this.isLoading = true;
      try {
        const response = axios.delete(`api/link/${id}`);
        if ((await response).data.success) {
          this.links = await this.fetchLinks();
        }
      } finally {
        this.isLoading = false;
      }
    },
    editLink: async function (id) {
      console.log(id);
    },
    fetchLinks: async function () {
      try {
        const response = await axios.get("api/links");

        if (!(await response).data.success) {
          throw new Error(response.data.error);
        }
        return response.data.links;
      } catch (err) {}
    },
  },
  created: async function () {
    this.isLoading = true;
    try {
      this.links = await this.fetchLinks();
    } finally {
      this.isLoading = false;
    }
  },
  updated: function () {
    if (this.links.length === 0) {
      this.showList = false;
    }
  },
};
</script>