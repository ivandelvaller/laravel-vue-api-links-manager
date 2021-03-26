<template>
  <div class="w-full text-green-700 bg-gray-200">
    <form @submit="onSubmit" class="md:w-80 bg-gray-800 rounded p-4">
      <FormGroup>
        <label for="link">Link</label>
        <input
          type="text"
          name="link"
          placeholder="Link (required)."
          class="form-control placeholder-gray-500 placeholder-opacity-75 text-sm"
          v-model.trim="link"
        />
        <span v-if="errors.link">{{ errors.link }}</span>
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
        <span v-if="errors.title">{{ errors.title }}</span>
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
        <span v-if="errors.description">{{ errors.description }}</span>
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
      </FormGroup>

      <button type="submit" class="w-full bg-green-600 rounded my-4 py-2">
        <i
          class="fas fa-plus-circle text-3xl text-center hover:bg-red-700"
          style="color: black"
        ></i>
      </button>
    </form>
  </div>
</template>

<script>
import FormGroup from "./FormGroup";

export default {
  name: "LinkForm",
  data: function () {
    return {
      errors: {},
      link: "",
      title: "",
      description: "",
      thumbnail: "",
    };
  },
  props: {
    task: {
      link: String,
      title: String,
      description: String,
      thumbnail: String,
    },
    titleForm: String,
    editMood: {
      type: Boolean,
      default: false,
    },
  },
  components: {
    FormGroup,
  },
  methods: {
    created: function () {
      if(this.editMood) {
        console.log('IS EDIT MOOD');
      }
    },
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

      const thereAreErrors = Object.keys(this.errors).length > 0 ? true : false;
      if (thereAreErrors) {
        return;
      }

      const newLink = {
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
      this.$emit("link-submitted", newLink);
    },
    validLink: function (link) {
      const urlRegex = /http(?:s?):\/\/(?:www\.)?youtu(?:be\.com\/watch\?v=|\.be\/)([\w\-\_]*)(&(amp;)?‌​[\w\?‌​=]*)?/gi;

      if (!link.match(urlRegex)) {
        return false;
      }
      return true;
    },
  },
};
</script>