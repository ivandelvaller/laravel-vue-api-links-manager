<template>
  <footer class="bg-gray-800">
    <p class="w-full text-center text-white py-8 ">Created by Iván Del Valle; Copyright &copy; {{ this.date }}</p>
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