<template>
  <div class="login">
    <div class="container sm:px-10">
      <div class="block xl:grid grid-cols-2 gap-4">
        <!-- BEGIN: Login Info -->
        <div class="hidden xl:flex flex-col min-h-screen">
          <router-link :to="{ name: 'index' }" class="-intro-x flex items-center pt-5">
            <img alt="MedPremises" class="w-40" :src="logo" /> </router-link
          >:to {
          <div class="my-auto">
            <img
              alt="Rubick Tailwind HTML Admin Template"
              class="-intro-x w-1/2 -mt-16"
              :src="'../' + illustration"
            />
            <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">
              A few more clicks to
              <br />
              sign in to your account.
            </div>
            <div
              class="-intro-x mt-5 text-lg text-white text-opacity-70 dark:text-gray-500"
            >
              Manage all your account in one place
            </div>
          </div>
        </div>
        <!-- END: Login Info -->
        <!-- BEGIN: Login Form -->

        <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
          <div
            class="my-auto mx-auto xl:ml-20 bg-white dark:bg-dark-1 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto"
          >
            <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
              Forgot Password
            </h2>
            <div v-if="error == true" class="">
              <div
                class="alert alert-outline-danger alert-dismissible show flex items-center mb-2"
                role="alert"
                v-for="(error, index) in errors"
                :key="index"
              >
                <i data-feather="alert-octagon" class="fa fa-exclamation-circle fa-2x mr-2fa fa-exclamation-circle fa-2x mr-2"></i>
                <strong class="mr-2">Whoops!</strong> {{ error }}
                <button
                  type="button"
                  class="btn-close"
                  data-bs-dismiss="alert"
                  aria-label="Close"
                >
                  <i data-feather="x" class="fa fa-times w-4 h-4"></i>
                </button>
              </div>
            </div>
            <div class="intro-x mt-2 text-gray-500 xl:hidden text-center">
              A few more clicks to sign in to your account. Manage all your e-commerce
              accounts in one place
            </div>
            <form @submit.prevent="forgot">
              <div class="intro-x mt-8" :disabled="loading">
                <input
                  type="email"
                  required
                  class="intro-x login__input form-control py-3 px-4 border-gray-300 block"
                  placeholder="Email"
                  v-model="form.email"
                />
              </div>

              <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                <button
                  type="submit"
                  class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top"
                >
                  Forgot Password
                </button>
                <loading v-if="loading == true"></loading>
                <router-link
                  :to="{ name: 'medical-staff-registration' }"
                  class="btn btn-outline-secondary py-3 px-4 w-full xl:w-32 mt-3 xl:mt-0 align-top"
                  >Sign up</router-link
                >
              </div>
              <div
                class="intro-x mt-10 xl:mt-24 text-gray-700 dark:text-gray-600 text-center xl:text-left"
              >
                By signin up, you agree to our
                <br />
                <a class="text-theme-1 dark:text-theme-10" href=""
                  >Terms and Conditions</a
                >
                & <a class="text-theme-1 dark:text-theme-10" href="">Privacy Policy</a>
              </div>
            </form>
          </div>
        </div>
        <!-- END: Login Form -->
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "login",
  created() {
    if (User.loggedIn()) {
      this.$router.push({
        name: "home",
      });
    }
  },

  data() {
    return {
      logo: "dist/images/logo-white.png",
      illustration: "dist/images/illustration.svg",
      form: {
        email: null,
      },
      errors: [],
      error: false,
      loading: false,
    };
  },
  methods: {
    forgot() {
      this.loading = true;
      axios
        .post("/api/auth/change-password", this.form)
        .then((res) => {
          Toast.fire({
            icon: "success",
            title: "An e-mail has been sent to your mail/spam",
          });
          this.$router.push({
            name: "login",
          });
        })
        .catch((error) => {
          this.error = true;
          console.log(error);
          if (error.response.status == 401) {
            this.errors.push(error.response.data.error);
          }
        })
        .finally(() => {
          this.loading = false;
        });
    },
  },
};
</script>

<style scoped>
html body {
  -webkit-font-smoothing: antialiased;
  overflow-x: hidden;
  padding: 0px !important;
  font-family: Roboto;
  font-size: 0.875rem;
  line-height: 1.25rem;
  --tw-text-opacity: 1;
  color: rgba(45, 55, 72, var(--tw-text-opacity));
}
</style>
