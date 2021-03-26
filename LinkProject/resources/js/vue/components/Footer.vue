<template>
  <footer>
    <p>Created by Iván Del Valle; Copyright &copy; {{ this.date }}</p>
  </footer>
</template>

<script>
export default {
  name: "Footer",
  data: function () {
    return {
      date: new Date().getFullYear(),
    };
  },
};
</script>