<template>
  <header class="bg-green-800 text-white mx-auto py-4 flex flex-col md:flex-col">
      <div class="text-center mb-8">
        <h1 class="font-bold text-3xl text-gray-200 my-4 tracking-wider font-sans">Links Manager</h1>
        <p class="">Let us take care about your bussines</p>
      </div>

      <div class="bg-green-600 mx-auto w-full">
        <ul class="flex flex-row justify-around text-2xl md:justify-center items-center my-4 mx-3">
          <router-link class="mx-3 hover:text-gray-700" to="/" active-class="underline" exact>Home</router-link>
          <router-link class="mx-3 hover:text-gray-700" to="/dashboard" active-class="underline">Links</router-link>
        </ul>
      </div>
  </header>
</template>

<script>
export default {
  name: "Header",
};
</script>
