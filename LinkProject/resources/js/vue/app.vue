<template>
  <div class="container mx-auto">
    <Header />
    <main class="h-96">
      <router-view></router-view>
    </main>
    <!-- <Footer /> -->
  </div>
</template>

<script>
import Header from "./components/Header";
import Footer from "./components/Footer";

export default {
  name: "App",
  components: {
    Header,
    Footer,
  },
};
</script>