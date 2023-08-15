<template>
  <div class="login" style="margin: -15px">
    <div class="container sm:px-10">
      <div class="block xl:grid grid-cols-2 gap-4">
        <!-- BEGIN: Register Info -->
        <div class="hidden xl:flex flex-col">
          <router-link :to="{ name: 'index' }" class="-intro-x flex items-center pt-5">
            <img alt="" class="w-40" :src="'../' + logo" />
          </router-link>
          <div class="my-auto">
            <img class="-intro-x w-1/2 -mt-16" :src="'../' + illustration" />
            <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">
              Join our community now!
            </div>
            <div
              class="-intro-x mt-5 text-lg text-white text-opacity-70 dark:text-gray-500"
            >
              Manage your medical facility in one place
            </div>
          </div>
        </div>
        <!-- END: Register Info -->
        <!-- BEGIN: Register Form -->
        <div class="flex py-5 my-5">
          <div
            class="my-auto mx-auto xl:ml-5 bg-white xl:bg-transparent px-5 4 py-3 rounded-md shadow-md w-full xl:w-auto"
          >
            <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
              Facility Registration
            </h2>
            <div
              class="intro-x mt-2 text-gray-500 dark:text-gray-500 xl:hidden text-center"
            >
              Join our community to manage your facility in one place.
            </div>
            <form @submit.prevent="register" enctype="multipart/form-data" class="mt-8">
              <div class="intro-x mt-8 p-5" :disabled="loading">
                <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                  <div class="intro-y col-span-12 sm:col-span-6">
                    <label for="name" class="form-label">Name</label>
                    <input
                      id="name"
                      type="text"
                      class="form-control"
                      placeholder="Enter your full name"
                      v-model="form.name"
                    />
                    <div class="text-danger font-medium text-xs mt-1" v-if="errors.name">
                      {{ errors.name[0] }}
                    </div>
                  </div>
                  <div class="intro-y col-span-12 sm:col-span-6">
                    <label for="email" class="form-label">Email Address</label>
                    <input
                      id="email"
                      type="email"
                      class="form-control"
                      placeholder="Enter your valid email address"
                      v-model="form.email"
                    />
                    <div class="text-danger font-medium text-xs mt-1" v-if="errors.email">
                      {{ errors.email[0] }}
                    </div>
                  </div>
                  <div class="intro-y col-span-12 sm:col-span-6">
                    <label for="nin_number" class="form-label">NIN Number</label>
                    <input
                      id="nin_number"
                      type="text"
                      class="form-control"
                      placeholder="Enter your valid NIN Number"
                      v-model="form.nin_number"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.nin_number"
                    >
                      {{ errors.nin_number[0] }}
                    </div>
                  </div>
                  <div class="intro-y col-span-12 sm:col-span-6">
                    <label for="registered_facility_name" class="form-label"
                      >Registered Facility Name</label
                    >
                    <input
                      id="registered_facility_name"
                      type="text"
                      class="form-control"
                      placeholder="Enter name of Hospital/Laboratory/Pharmaceutical Premises"
                      v-model="form.registered_facility_name"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.registered_facility_name"
                    >
                      {{ errors.registered_facility_name[0] }}
                    </div>
                  </div>
                  <div class="intro-y col-span-12 sm:col-span-6">
                    <label for="national_facility_id" class="form-label"
                      >National Facility ID</label
                    >
                    <input
                      id="national_facility_id"
                      type="text"
                      class="form-control"
                      placeholder="Enter National Facility ID"
                      v-model="form.national_facility_id"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.national_facility_id"
                    >
                      {{ errors.national_facility_id[0] }}
                    </div>
                  </div>
                  <div class="intro-y col-span-12 sm:col-span-6">
                    <label for="state_facility_id" class="form-label"
                      >State Facility ID</label
                    >
                    <input
                      id="state_facility_id"
                      type="text"
                      class="form-control"
                      placeholder="Enter State Facility ID"
                      v-model="form.state_facility_id"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.state_facility_id"
                    >
                      {{ errors.state_facility_id[0] }}
                    </div>
                  </div>
                  <div class="intro-y col-span-12 sm:col-span-6">
                    <label for="facility_type" class="form-label">Facility Type</label>
                    <select
                      class="form-select sm:mr-2"
                      aria-label="Default select example"
                      v-model="form.facility_type"
                    >
                      <option
                        v-for="(facility, index) in facilities"
                        :key="index"
                        :value="facility"
                      >
                        {{ facility }}
                      </option>
                    </select>
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.facility_type"
                    >
                      {{ errors.facility_type[0] }}
                    </div>
                  </div>
                  <div class="intro-y col-span-12 sm:col-span-6">
                    <label for="cac_registration_number" class="form-label"
                      >CAC Registration Number</label
                    >
                    <input
                      id="cac_registration_number"
                      type="text"
                      class="form-control"
                      placeholder="Enter Valid CAC Registration Number"
                      v-model="form.cac_registration_number"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.cac_registration_number"
                    >
                      {{ errors.cac_registration_number[0] }}
                    </div>
                  </div>
                  <div class="intro-y col-span-12 sm:col-span-6">
                    <label for="logo" class="form-label"
                      >Upload Hospital/Pharmacy/Laboratory Logo</label
                    >
                    <input
                      id="logo"
                      type="file"
                      class="form-control"
                      @change="onFileSelected"
                      placeholder="Upload Hospital/Pharmacy/Laboratory Logo"
                    />
                    <div class="text-danger font-medium text-xs mt-1" v-if="errors.logo">
                      {{ errors.logo[0] }}
                    </div>
                  </div>
                  <div class="intro-y col-span-12 sm:col-span-6">
                    <label for="ownership_picture" class="form-label"
                      >Upload Ownership Picture</label
                    >
                    <input
                      id="ownershp_picture"
                      type="file"
                      class="form-control"
                      @change="onFileSelectedPicture"
                      placeholder="Upload Hospital/Pharmacy/Laboratory Logo"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.ownership_picture"
                    >
                      {{ errors.ownership_picture[0] }}
                    </div>
                  </div>
                  <div class="intro-y col-span-12 sm:col-span-6">
                    <label for="password" class="form-label">Password</label>
                    <input
                      id="password"
                      type="password"
                      class="form-control"
                      placeholder="Enter Password"
                      v-model="form.password"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.password"
                    >
                      {{ errors.password[0] }}
                    </div>
                  </div>
                  <div class="intro-y col-span-12 sm:col-span-6">
                    <label for="password_confirmation" class="form-label"
                      >Password Confirmation</label
                    >
                    <input
                      id="password_confirmation"
                      type="password"
                      class="form-control"
                      placeholder="Enter Password Again"
                      v-model="form.password_confirmation"
                    />
                  </div>
                </div>
              </div>
              <div
                class="intro-x flex items-center text-gray-700 dark:text-gray-600 mt-4 text-xs sm:text-sm"
              >
                <input
                  id="agreement"
                  type="checkbox"
                  class="form-check-input border mr-2"
                  v-model="form.agreement"
                />
                <label class="cursor-pointer select-none" for="agreement"
                  >I agree to the MedPremises</label
                >
                <a class="text-theme-1 dark:text-theme-10 ml-1" href="">Privacy Policy</a
                >.
                <div
                  class="text-danger font-medium text-xs mt-1"
                  v-if="errors.remember_me"
                >
                  {{ errors.agreement[0] }}
                </div>
              </div>
              <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                <button
                  class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top"
                  type="submit"
                >
                  Register
                </button>
                <loading v-if="loading == true"></loading>
                <router-link
                  class="btn btn-outline-secondary py-3 px-4 w-full xl:w-32 mt-3 xl:mt-0 align-top"
                  :to="{ name: 'staff-login' }"
                  >Sign in</router-link
                >
              </div>
            </form>
          </div>
        </div>
        <!-- END: Register Form -->
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "register",
  data() {
    return {
      logo: "dist/images/logo-white.png",
      illustration: "dist/images/illustration.svg",
      form: {
        name: null,
        email: null,
        registered_facility_name: null,
        national_facility_id: null,
        state_facility_id: null,
        cac_registration_number: null,
        facility_type: null,
        logo: null,
        ownership_picture: null,
        password: null,
        password_confirmation: null,
        role: "Facility Manager",
        agreement: null,
      },
      errors: {},
      loading: false,
      facilities: ["Hospital", "Pharmaceutical Premises", "Laboratory"],
    };
  },
  created() {
    this.login();
  },
  methods: {
    login() {
      if (User.loggedIn()) {
        this.$router.push({
          name: "home",
        });
      }
    },
    onFileSelected(event) {
      let file = event.target.files[0];
      if (file.size > 1048770) {
        Notification.image_validation();
      } else {
        let reader = new FileReader();
        reader.readAsDataURL(file);

        let type = file.type;
        let name = file.name;
        reader.onload = (event) => {
          this.form.logo = event.target.result;
        };
      }
    },
    onFileSelectedPicture(event) {
      let file = event.target.files[0];
      if (file.size > 1048770) {
        Notification.image_validation();
      } else {
        let reader = new FileReader();
        reader.readAsDataURL(file);

        let type = file.type;
        let name = file.name;
        reader.onload = (event) => {
          this.form.ownership_picture = event.target.result;
        };
      }
    },
    register() {
      this.loading = true;
      axios
        .post("/api/auth/facility_registration", this.form)
        .then((res) => {
          //User.responseAfterLogin(res)
          Toast.fire({
            icon: "success",
            title: "Registration successful. Visit your mail/spam to verify account.",
          });
          this.$router.push({
            name: "staff-login",
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
<style scoped></style>
