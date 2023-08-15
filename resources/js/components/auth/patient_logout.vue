<template>
  <div></div>
</template>

<script>
export default {
  name: "logout",
  created() {
    this.login();
  },
  data() {
    return {};
  },
  methods: {
    login() {
      localStorage.removeItem("token");
      Toast.fire({
        icon: "success",
        title: "Logout successfully",
      });
      this.$router.push({
        name: "login",
      });
      // document.location.href = "/sign-in"
    },
  },
};
</script>

<style scoped></style>
