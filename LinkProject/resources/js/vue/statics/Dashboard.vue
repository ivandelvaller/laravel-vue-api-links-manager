<template>
  <div class="flex flex-col md:grid md:grid-cols-2 justify-center items-start w-full ">
    <!-- display form button -->
    
    <div class="w-full md:flex flex-col justify-center items-center">
      <Button
        @click="toggleAddLink"
        class="bg-gray-700 text-white h-12 my-1 w-full md:w-80"
      >
        <span v-text="showForm ? 'Close' : 'Add link'"> </span>
        <i v-if="!showForm" class="fas fa-plus text-green-200"></i>
        <i v-if="showForm" class="fas fa-times-circle text-red-300"></i>
      </Button>

      <LinkForm
        v-if="showForm && !isLoading && !editMood"
        :editMood="false"
        @link-submitted="addLink"
      />

      <LinkForm
        v-if="showForm && !isLoading && editMood"
        @link-submitted="editLink"
        @on-cancel="cancel"
        :editMood="true"
        :editedLink="selectedLink"
      />
    </div>


    <!-- display list button -->
    <div class="w-full md:flex md:flex-col justify-center items-center">
      <Button
        v-if="links.length > 0 && !editMood"
        @click="toggleList"
        class="bg-gray-700 text-white p-1 h-12 my-1 w-full md:w-80"
      >
        <span v-text="showList ? 'Close' : 'Display links'"> </span>
        <i v-if="!showList" class="fas fa-plus text-green-200"></i>
        <i v-if="showList" class="fas fa-times-circle text-red-300"></i>
      </Button>
      <Loading
        class="text-center text-4xl"
        v-if="isLoading" />
      <p
        class="text-center text-3xl self-center justify-self-center"
        v-if="links.length === 0 && !isLoading && !showForm">No links to show.</p>
      <Links
        @on-remove-link="removeLink"
        @on-edit-link="selectLink"
        v-else-if="showList && !isLoading && !editMood"
        :links="links"
      />
    </div>
  </div>
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
      editMood: false,
      selectedLink: {},
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
    cancel() {
      this.editMood = false;
      this.showForm = false;
      this.selectedLink = {};
    },
    toggleAddLink() {
      this.showForm = !this.showForm;
    },
    toggleList() {
      this.showList = !this.showList;
    },
    selectLink: function (id) {
      this.selectedLink = this.links.find((link) => link.id === id);

      if (this.selectedLink) {
        console.log(this.selectedLink);
        this.showForm = true;
        this.editMood = true;
      }
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
    editLink: async function (updates) {
      this.isLoading = true;
      try {
        const response = axios.put(`api/link/${this.selectedLink.id}`, updates);
        if ((await response).data.success) {
          this.links = await this.fetchLinks();
        }
      } finally {
        this.showForm = false;
        this.editMood = false;
        this.isLoading = false;
        this.selectedLink = {};
      }
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