<template>
  <div class="login" style="margin: -38px">
    <div class="container sm:px-10">
      <div class="block xl:grid grid-cols-2 gap-4">
        <!-- BEGIN: Login Info -->
        <div class="hidden xl:flex flex-col min-h-screen">
          <router-link :to="{ name: 'index' }" class="-intro-x flex items-center pt-5">
            <img alt="MedPremises" class="w-40" :src="logo" />
          </router-link>
          <div class="my-auto">
            <img class="-intro-x w-1/2 -mt-16" :src="'../' + illustration" />
            <div class="-intro-x text-white font-medium text-3xl leading-tight mt-10">
              A few more clicks to
              <br />
              create your account.
            </div>
            <div
              class="-intro-x mt-5 text-lg text-white text-opacity-70 dark:text-gray-500"
            >
              Manage all your health records in one place
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
              Sign Up as a Patient
            </h2>

            <div class="intro-x mt-2 text-gray-500 xl:hidden text-center">
              A few more clicks to sign in to your account. Manage all your e-commerce
              accounts in one place
            </div>
            <form @submit.prevent="register">
              <div class="intro-x mt-8" :disabled="loading">
                <input
                  type="text"
                  required
                  class="intro-x login__input form-control py-3 px-4 border-gray-300 block"
                  placeholder="Full Name"
                  v-model="form.name"
                />
                <input
                  type="email"
                  required
                  class="intro-x login__input form-control py-3 px-4 border-gray-300 block mt-4"
                  placeholder="Email"
                  v-model="form.email"
                />
                <input
                  type="text"
                  class="intro-x login__input form-control py-3 px-4 border-gray-300 block mt-4"
                  placeholder="NIN Number"
                  v-model="form.nin_number"
                />
                <input
                  type="password"
                  required
                  class="intro-x login__input form-control py-3 px-4 border-gray-300 block mt-4"
                  placeholder="Password"
                  v-model="form.password"
                />
              </div>

              <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                <button
                  type="submit"
                  class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top"
                >
                  Sign up
                </button>
                <loading v-if="loading == true"></loading>
                <router-link
                  :to="{ name: 'login' }"
                  class="btn btn-outline-secondary py-3 px-4 w-full xl:w-32 mt-3 xl:mt-0 align-top"
                  >Sign in</router-link
                >
              </div>
              <div
                class="intro-x mt-10 text-gray-700 dark:text-gray-600 text-center xl:text-left"
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
  name: "sign-up",
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
        name: null,
        email: null,
        password: null,
        nin_number: null,
      },
      errors: {},
      loading: false,
    };
  },
  methods: {
    register() {
      this.loading = true;
      axios
        .post("/api/auth/patient-registration", this.form)
        .then((res) => {
          //User.responseAfterLogin(res)
          Toast.fire({
            icon: "success",
            title: "Registration successful. Visit your mail/spam to verify account.",
          });
          this.$router.push({
            name: "login",
          });
          //document.location.href = "/login"
        })
        .catch((error) => (this.errors = error.response.data.errors))
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
