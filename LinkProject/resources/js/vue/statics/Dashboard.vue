<template>
  <main>
    <LinkForm
      v-if="showForm"
      @link-submitted="addLink"
      :titleForm="'Add a new link'"
    />
    <Links :links="links" />
  </main>
</template>

<script>
export default {
  name: 'Dashboard'
};
</script>