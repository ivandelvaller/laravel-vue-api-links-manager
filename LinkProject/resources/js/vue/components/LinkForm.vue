<template>
  <div class="w-full text-green-700 bg-gray-200">
    <form @submit="onSubmit" class="w-full bg-gray-800 rounded p-4">
      <FormGroup>
        <label for="link">Link</label>
        <input
          type="text"
          name="link"
          placeholder="Link (required)."
          class="form-control placeholder-gray-500 placeholder-opacity-75 text-sm"
          v-model.trim="link"
        />
        <Message :color="'red'" v-if="errors.link">
          {{ errors.link }}
        </Message>
      </FormGroup>

      <FormGroup>
        <label for="title">Title</label>
        <input
          type="text"
          name="title"
          class="form-control placeholder-gray-500 placeholder-opacity-75 text-sm"
          placeholder="Add a title (required)."
          v-model.trim="title"
        />
        <Message :color="'red'" v-if="errors.title">
          {{ errors.title }}
        </Message>
      </FormGroup>
      <FormGroup>
        <label for="description">Description</label>
        <textarea
          type="text"
          name="description"
          class="form-control placeholder-gray-500 placeholder-opacity-75 text-sm"
          rows="3"
          style="resize: none"
          placeholder="Add a description (required)."
          v-model.trim="description"
        />
        <Message :color="'red'" v-if="errors.description">
          {{ errors.description }}
        </Message>
      </FormGroup>
      <FormGroup>
        <label for="thumbnail">Thumbnail</label>
        <input
          type="text"
          name="thumbnail"
          class="placeholder-gray-500 placeholder-opacity-75 text-sm"
          placeholder="Add a thumbnail (url)"
          v-model.trim="thumbnail"
        />
        <Message :color="'red'" v-if="errors.thumbnail">
          {{ errors.thumbnail }}
        </Message>
      </FormGroup>

      <button type="submit" class="w-full bg-green-600 rounded my-4 py-2">
        <i
          class="fas fa-plus-circle text-3xl text-center"
          style="color: black"
        ></i>
      </button>

      <button 
        v-if="editMood"
        @click="$emit('on-cancel')"
        type="submit" class="w-full bg-green-600 rounded my-4 py-2">
        Cancel
      </button>
    </form>
  </div>
</template>

<script>
import FormGroup from "./FormGroup";
import Message from "./Message";

export default {
  name: "LinkForm",
  data: function () {
    return {
      errors: {},
      link: this.editedLink.link ? this.editedLink.link : "",
      title: this.editedLink.title ? this.editedLink.title : "",
      description: this.editedLink.description
        ? this.editedLink.description
        : "",
      thumbnail: this.editedLink.thumbnail ? this.editedLink.thumbnail : "",
    };
  },
  props: {
    editMood: {
      type: Boolean,
      default: false,
    },
    editedLink: {
      type: Object,
      default: Object,
    },
  },
  components: {
    FormGroup,
    Message,
  },
  methods: {
    onSubmit: function (e) {
      if (e) {
        e.preventDefault();
      }

      this.errors = {};

      // Check fields
      if (!this.title) {
        this.errors.title = "Title is required.";
      }

      if (!this.description) {
        this.errors.description = "Description is required.";
      }

      if (!this.link) {
        this.errors.link = "Link is required.";
      } else if (!this.validLink(this.link)) {
        this.errors.link = "Invalid Link.";
      }

      if (!this.validURL(this.thumbnail)) {
        this.errors.thumbnail = "Invalid url";
      }

      const thereAreErrors = Object.keys(this.errors).length > 0 ? true : false;
      if (thereAreErrors) {
        return;
      }

      const link = {
        link: this.link,
        title: this.title,
        description: this.description,
        thumbnail: this.thumbnail,
      };
      if (!this.editMood) {
        // reset inputs
        this.link = null;
        this.title = null;
        this.description = null;
        this.thumbnail = null;
      }

      this.$emit("link-submitted", link);
    },
    validLink: function (link) {
      const urlRegex = /http(?:s?):\/\/(?:www\.)?youtu(?:be\.com\/watch\?v=|\.be\/)([\w\-\_]*)(&(amp;)?‌​[\w\?‌​=]*)?/gi;

      if (!link.match(urlRegex)) {
        return false;
      }
      return true;
    },
    validURL: function (url) {
      const urlRegex = /(https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|www\.[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9]+\.[^\s]{2,}|www\.[a-zA-Z0-9]+\.[^\s]{2,})/gi;

      if (!url.match(urlRegex)) {
        return false;
      }
      return true;
    },
  },
};
</script>

<style scoped>
label {
  padding: 0 0.5rem;
}
input,
textarea {
  padding: 1rem 0.5rem;
}
</style>