<template>
  <div>
    <h3>{{ link.title }}</h3>
    <div>
      <img 
        :src="link.thumbnail" 
        :alt="link.title" />
    </div>
    <p>{{ link.description }}</p>
    <hr />
    <p>Click <a :href="link.link">here</a> to watch now!</p>
    <div>
      <button v-on:click="remove()">Remove</button>
      <button v-on:click="update()">Edit</button>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: "LinkListItem",
  props: ['link'],
  methods: {
    remove: async function () {
        try {
            const response = await axios.delete('api/link/' + link.id );
            if(response.data.success === 'error'){
                throw new Error(response.data.error || 'Error');
            }
            this.$emit('onlinkchanged');
        } catch (error) {
            
        }
    },
    update: async function () {
        const response = await axios.put('api/link/' + link.id, {

        });
    },
  },
};
</script>