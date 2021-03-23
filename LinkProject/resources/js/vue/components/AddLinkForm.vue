<template>
  <div>

    <span v-if="errors.length > 0">
      <p>Please, check the folowwing errors:</p>
      <ul>
        <li v-for="(error, index) in errors" v-bind:key="index">{{ error }}</li>
      </ul>
    </span>

    <form v-on:submit="onSubmit" class="flex flex-column flex-wrap">
      <div class="form-group">
        <label for="link">Link</label>
        <input
          type="text"
          name="link"
          class="form-control"
          placeholder="Link"
          v-model.trim="link"
        />
      </div>
      <div class="form-group">
        <label for="title">Title</label>
        <input
          type="text"
          name="title"
          class="form-control"
          placeholder="Title"
          v-model.trim="title"
        />
      </div>
      <div class="form-group">
        <label for="description">Description</label>
        <textarea
          type="text"
          name="description"
          class="form-control"
          rows="3"
          style="resize: none"
          placeholder="Description"
          v-model.trim="description"
        />
      </div>
      <div class="form-group">
        <label for="thumbnail">Thumbnail</label>
        <input
          type="text"
          name="thumbnail"
          class="form-control"
          placeholder="Thumbnail"
          v-model.trim="thumbnail"
        />
      </div>
      <button type="submit">+</button>
    </form>
  </div>
</template>

<script>
import axios from "axios";
export default {
  data: function () {
    return {
      errors: [],
      link: null,
      title: null,
      description: null,
      thumbnail: null,
    };
  },
  props: [
      'title',
      'description',
      'link',
      'thumbnail',
  ],
  methods: {
    async onSubmit(e) {
      e.preventDefault();
      this.errors = [];

      if(
          !this.title ||
          !this.link ||
          !this.description ||
          !this.thumbnail
      ) {

      }

      try {
        const response = await axios.post("api/link/store", {
          link: this.link,
          title: this.title,
          description: this.description,
          thumbnail: this.thumbnail,
        });

        if (response.data.success) {
          this.$emit("linkAdded");

          this.link = null;
          this.title = null;
          this.description = null;
          this.thumbnail = null;
        } else {
            errors = response.data.errors
        }
      } catch (error) {
        this.errors = [`Something went wrong: ${error.message}`];
      }
    },
  },
};
</script>