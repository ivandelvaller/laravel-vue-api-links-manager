<template>
  <div class="w-full bg-green-700 p-4">
    <h3 class="w-full text-center text-5x1">{{title}}</h3>
    <form @submit="onSubmit">
      <FormGroup 
        :hasError="errors.link ? true : false" 
        :errorMessage="errors.link">
        <label for="link">Link</label>
        <Input />
        <input
          type="text"
          name="link"
          placeholder="Link (required)."
          class="form-control"
          v-model.trim="link"
        />
      </FormGroup>
      <FormGroup>
        <label for="title">Title</label>
        <input
          type="text"
          name="title"
          class="form-control"
          placeholder="Add a title (required)."
          ref="inputTitle"
          v-model.trim="title"
        />
        <span v-if="errors.title">{{ errors.title }}</span>
      </FormGroup>
      <FormGroup>
        <label for="description">Description</label>
        <textarea
          type="text"
          name="description"
          class="form-control"
          rows="3"
          style="resize: none"
          placeholder="Add a description (required)."
          ref="inputDescription"
          v-model.trim="description"
        />
        <span v-if="errors.description">{{ errors.description }}</span>
      </FormGroup>
      <FormGroup>
        <label for="thumbnail">Thumbnail</label>
        <input
          type="text"
          name="thumbnail"
          class="form-control"
          placeholder="Add a thumbnail (url)"
          ref="inputThumbnail"
          v-model.trim="thumbnail"
        />
      </FormGroup>
      <button type="submit">+</button>
    </form>
  </div>
</template>

<script>
import FormGroup from './FormGroup';
import Input from './Input';

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
    title: String,
    editMood: {
      type: Boolean,
      default: false,
    },
  },
  components: {
    FormGroup,
    Input
  },
  methods: {
    onSubmit: function (e) {
      e.preventDefault();

      console.log(this.$refs.inputTitle.checkValidity());

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

<style scoped>
  .form-control {
    font-size: 1rem;
    font-family: inherit;
    padding: 0.5rem 1rem;
    border-radius: 30px; 
  }
</style>