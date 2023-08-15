<template>
  <div class="main">
    <!-- BEGIN: Mobile Menu -->
    <mobile-menu></mobile-menu>
    <!-- END: Mobile Menu -->
    <div class="flex">
      <!-- BEGIN: Side Menu -->
      <side-menu :page="'pharmacy'"></side-menu>
      <!-- END: Side Menu -->
      <!-- BEGIN: Content -->
      <div class="content">
        <!-- BEGIN: Top Bar -->
        <top-bar title="Delivery"></top-bar>
        <!-- END: Top Bar -->

        <div class="grid grid-cols-12 gap-6">
          <div class="intro-y col-span-12 xxl:col-span-6 xl:col-span-6 md:col-span-6">
            <div class="intro-y box">
              <div
                class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5"
              >
                <h2 class="font-medium text-base mr-auto">Edit Delivery</h2>
                <div class="w-full sm:w-auto sm:ml-auto mt-3 sm:mt-0">
                  <router-link
                    :to="{ name: 'delivery' }"
                    class="btn btn-primary mr-0 ml-3"
                  >
                    Go Back
                  </router-link>
                </div>
              </div>
              <form class="input p-5" @submit.prevent="update">
                <div class="grid grid-cols-12 gap-x-5" :disabled="loading">
                  <div class="col-span-12 xl:col-span-12 mt-3">
                    <label for="delivery_name" class="form-label">Delivery Name</label>
                    <input
                      id="delivery_name"
                      type="text"
                      class="form-control"
                      placeholder="Input delivery full name"
                      v-model="form.delivery_name"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.delivery_name"
                    >
                      {{ errors.delivery_name[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-12 mt-3">
                    <label for="company_name" class="form-label">Company Name</label>
                    <input
                      id="company_name"
                      type="text"
                      class="form-control"
                      placeholder="Input company name"
                      v-model="form.company_name"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.company_name"
                    >
                      {{ errors.company_name[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-12 mt-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input
                      id="email"
                      type="email"
                      class="form-control"
                      placeholder="Input delivery email"
                      v-model="form.email"
                    />
                    <div class="text-danger font-medium text-xs mt-1" v-if="errors.email">
                      {{ errors.email[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-12 mt-3">
                    <label for="phone_number" class="form-label">Phone Number</label>
                    <input
                      id="phone_number"
                      type="text"
                      class="form-control"
                      placeholder="Input delivery phone number"
                      v-model="form.phone_number"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.phone_number"
                    >
                      {{ errors.phone_number[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-12 mt-3">
                    <label for="address" class="form-label">Old Address</label>
                    <input
                      id="address"
                      disabled
                      type="text"
                      class="form-control"
                      placeholder="Input House Number, Street Name, City, Postal Code, State"
                      v-model="form.address"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.address"
                    >
                      {{ errors.address[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-12 mt-3">
                    <label for="address" class="form-label">New Address</label>
                    <vue-google-autocomplete
                      ref="address"
                      id="map"
                      classname="form-control"
                      placeholder="Search Address, mouse down and press enter once found"
                      v-on:placechanged="getAddress"
                      v-on:error="handleError"
                      types=""
                      country="ng"
                    >
                    </vue-google-autocomplete>
                    <div class="text-success font-medium text-xs" v-if="form.new_address">
                      Address Selected
                    </div>
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.new_address"
                    >
                      {{ errors.new_address[0] }}
                    </div>
                  </div>
                </div>
                <div class="mt-3">
                  <button type="submit" class="btn btn-primary w-20">Save</button>
                  <loading v-if="loading == true"></loading>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- END: Content -->
    </div>
  </div>
</template>

<script>
import VueGoogleAutocomplete from "vue-google-autocomplete";
export default {
  name: "edit-delivery",
  components: { VueGoogleAutocomplete },
  data() {
    return {
      id: null,
      token: null,
      address: {},
      form: {
        delivery_name: "",
        company_name: "",
        email: "",
        phone_number: "",
        address: "",
        new_address: "",
        new_city: "",
        new_state: "",
        new_postal_code: "",
        new_url: "",
        new_country: "",
        new_local_government_area: "",
        new_gps_coordinate_longtitude: "",
        new_gps_coordinate_latitude: "",
        user_id: "",
      },
      errors: {},

      loading: false,
    };
  },
  created() {
    this.login();

    this.getDelivery();
  },
  methods: {
    login() {
      if (!User.loggedIn()) {
        this.$router.push({
          name: "logout",
        });
      } else {
        this.id = User.id();
        this.token = User.token();
        this.form.user_id = User.id();
      }
    },

    getAddress(address, placeResultData, id) {
      this.address = address;
      this.form.new_address = placeResultData.formatted_address;
      this.form.new_city = placeResultData.address_components[3].long_name;
      this.form.new_state = placeResultData.address_components[5].long_name;
      this.form.new_local_government_area =
        placeResultData.address_components[4].long_name;
      this.form.new_country = address.country;
      this.form.new_postal_code = address.postal_code;
      this.form.new_gps_coordinate_latitude = address.latitude;
      this.form.new_gps_coordinate_longtitude = address.longitude;
      this.form.new_url = placeResultData.url;
      console.log(address);
    },

    handleError(error) {
      alert(error);
    },
    getDelivery() {
      let id = this.$route.params.id;
      axios
        .get("/api/v1/delivery/" + id, {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then((response) => (this.form = response.data))
        .catch((error) => {
          console.log(error);
          if (error.response.status == 401) {
            this.$router.push({
              name: "logout",
            });
          }
        });
    },

    update() {
      this.loading = true;
      let id = this.$route.params.id;
      this.form.user_id = this.id;
      axios
        .patch("/api/delivery/" + id, this.form)
        .then(() => {
          this.$router.push({
            name: "delivery",
          });
          Toast.fire({
            icon: "success",
            title: "Delivery successfully updated",
          });
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
