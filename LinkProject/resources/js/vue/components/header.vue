<template>
  <header class="bg-green-700 text-white mx-auto py-4 flex flex-col md:flex-col">
      <div class="text-center mb-8">
        <h1 class="font-bold text-3xl">Links App</h1>
        <p>Let us take care about your bussines</p>
      </div>

      <div>
        <ul>
          <router-link to="/" active-class="underline" exact>Home</router-link>
          <router-link to="/dashboard" active-class="underline">Links</router-link>
        </ul>
      </div>
  </header>
</template>

<script>
export default {
  name: "Header",
};
</script>
