<template>
  <div class="main">
    <!-- BEGIN: Mobile Menu -->
    <mobile-menu></mobile-menu>
    <!-- END: Mobile Menu -->
    <div class="flex">
      <!-- BEGIN: Side Menu -->
      <side-menu page="patient"></side-menu>
      <!-- END: Side Menu -->
      <!-- BEGIN: Content -->
      <div class="content">
        <!-- BEGIN: Top Bar -->
        <top-bar title="Patient Checkout"></top-bar>
        <!-- END: Top Bar -->

        <div class="grid grid-cols-12 gap-6">
          <div class="intro-y col-span-12 xxl:col-span-12">
            <div class="intro-y box">
              <div
                class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5"
              >
                <h2 class="font-medium text-base mr-auto">Checkout Patient</h2>
              </div>
              <form class="input p-5" @submit.prevent="store">
                <div v-if="error == true" class="">
                  <div
                    class="alert alert-outline-danger alert-dismissible show flex items-center mb-2"
                    role="alert"
                    v-for="(error, index) in errors"
                    :key="index"
                  >
                    <i
                      data-feather="alert-octagon"
                      class="fa fa-exclamation-circle fa-2x mr-2"
                    ></i>
                    <strong class="mr-2">Whoops! </strong> {{ error }}
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
                <div class="grid grid-cols-12 gap-x-5" :disabled="loading">
                  <div class="col-span-12 xl:col-span-4 mt-3">
                    <label for="patient" class="form-label">Patient</label>
                    <vue-single-select
                      name="maybe"
                      placeholder="pick a patient"
                      you-want-to-select-a-post="ok"
                      v-model="form.patient"
                      out-of-all-these-posts="makes sense"
                      :options="patients"
                      :required="true"
                      a-post-has-an-id="good for search and display"
                      the-post-has-a-title="make sure to show these"
                      option-label="name"
                    ></vue-single-select>

                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.patient"
                    >
                      {{ errors.patient[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-3 mt-3">
                    <label for="self" class="form-label">Who Checkout Patient</label>
                    <div class="flex flex-col sm:flex-row mt-2">
                      <div class="form-check mr-2">
                        <input
                          id="radio-switch-4"
                          class="form-check-input"
                          type="radio"
                          v-model="form.self"
                          name="self"
                          value="1"
                        />
                        <label class="form-check-label" for="radio-switch-4"
                          >Checkout Alone</label
                        >
                      </div>
                      <div class="form-check mr-2 mt-2 sm:mt-0">
                        <input
                          id="radio-switch-5"
                          class="form-check-input"
                          type="radio"
                          name="self"
                          v-model="form.self"
                          value="0"
                        />
                        <label class="form-check-label" for="radio-switch-5"
                          >Checkout By Someone</label
                        >
                      </div>
                    </div>
                    <div class="text-danger font-medium text-xs mt-1" v-if="errors.self">
                      {{ errors.self[0] }}
                    </div>
                  </div>
                  <div
                    class="col-span-12 xl:col-span-4 mt-3"
                    v-if="form.self == '' || form.self == '0'"
                  >
                    <label for="pickup_name" class="form-label">Pickup Name</label>
                    <input
                      id="pickup_name"
                      type="text"
                      class="form-control"
                      placeholder="Name of person who pick patient"
                      v-model="form.pickup_name"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.pickup_name"
                    >
                      {{ errors.pickup_name[0] }}
                    </div>
                  </div>
                  <div
                    class="col-span-12 xl:col-span-4 mt-3"
                    v-if="form.self == '' || form.self == '0'"
                  >
                    <label for="pickup_phone" class="form-label">Pickup Phone</label>
                    <input
                      id="pickup_phone"
                      type="text"
                      class="form-control"
                      placeholder="Phone Number of person who pick patient"
                      v-model="form.pickup_phone"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.pickup_phone"
                    >
                      {{ errors.pickup_phone[0] }}
                    </div>
                  </div>
                  <div
                    class="col-span-12 xl:col-span-3 mt-3"
                    v-if="form.self == '' || form.self == '0'"
                  >
                    <label for="relationship" class="form-label">Relationship</label>
                    <input
                      id="relationship"
                      type="text"
                      class="form-control"
                      placeholder="Relationship of person to patient"
                      v-model="form.relationship"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.relationship"
                    >
                      {{ errors.relationship[0] }}
                    </div>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary w-20 mt-3">Save</button>
                <loading v-if="loading == true"></loading>
              </form>
            </div>
          </div>
        </div>
        <div class="grid grid-cols-12 gap-6 mt-4">
          <div class="intro-y col-span-12 xxl:col-span-12">
            <div class="intro-y box">
              <div
                class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60"
              >
                <h2 class="font-medium text-base mr-auto">Patient Checkouts</h2>
                <div class="w-full sm:w-auto sm:ml-auto mt-3 sm:mt-0">
                  <input
                    class="form-control mr-0 ml-3"
                    type="text"
                    v-model="search"
                    placeholder="Seach Patient Name"
                  />
                </div>
              </div>
              <div class="p-5">
                <div class="grid grid-cols-12 gap-x-5">
                  <div class="col-span-12 xl:col-span-12 mt-3">
                    <div v-if="checkouts.length != 0">
                      <div class="overflow-x-auto">
                        <table class="table table-sm table-bordered">
                          <thead>
                            <tr>
                              <th class="whitespace-nowrap">Patient</th>
                              <th class="whitespace-nowrap">Self</th>
                              <th class="whitespace-nowrap">Brought Name</th>
                              <th class="whitespace-nowrap">Brought Phone</th>
                              <th class="whitespace-nowrap">Relationship</th>
                              <th class="whitespace-nowrap">Added Date</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr v-for="checkout in filterSearch" :key="checkout.id">
                              <td>{{ checkout.name }}</td>
                              <td>
                                <span v-if="checkout.self == 1">Yes</span
                                ><span v-else>Brought by Someone</span>
                              </td>
                              <td>
                                <span v-if="checkout.self == 0">{{
                                  checkout.pickup_name
                                }}</span
                                ><span v-else>-</span>
                              </td>
                              <td>
                                <span v-if="checkout.self == 0">{{
                                  checkout.pickup_phone
                                }}</span
                                ><span v-else>-</span>
                              </td>
                              <td>
                                <span v-if="checkout.self == 0">{{
                                  checkout.relationship
                                }}</span
                                ><span v-else>-</span>
                              </td>

                              <td>{{ checkout.created_at | moment("from", "now") }}</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div v-else>
                      <div
                        class="alert alert-outline-danger alert-dismissible show flex items-center mb-2"
                        role="alert"
                      >
                        <i
                          data-feather="alert-octagon"
                          class="fa fa-exclamation-circle fa-2x mr-2"
                        ></i>
                        <strong class="mr-2"> Whoops! </strong> There are no checkouts
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
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- END: Content -->
    </div>
  </div>
</template>

<script>
export default {
  name: "patient-checkouts",
  data() {
    return {
      id: null,
      token: null,
      form: {
        patient: "",
        self: "",
        pickup_name: "",
        pickup_phone: "",
        relationship: "",
        token: "",
      },
      errors: [],
      error: false,
      checkouts: [],
      patients: [],
      search: "",
      loading: false,
    };
  },
  computed: {
    filterSearch() {
      let str = this.search;
      let string = str.charAt(0).toUpperCase() + str.slice(1);
      return this.checkouts.filter((checkout) => {
        return checkout.name.match(string);
      });
    },
  },
  created() {
    this.login();
    this.getPatients();
    this.getPatientCheckouts();
  },
  methods: {
    login() {
      if (!User.loggedIn()) {
        this.$router.push({
          name: "logout",
        });
      } else {
        this.token = User.token();
        this.id = User.id()
        this.form.id = User.id();
      }
    },
    store() {
      this.loading = true;
      axios
        .post("/api/patient-checkout", this.form)
        .then(() => {
          this.$router.push({
            name: "patient-checkouts",
          });
          this.form = {
            patient: "",
            self: "",
            pickup_name: "",
            pickup_phone: "",
            relationship: "",
            id: "",
          };
          this.login();
          this.getPatientCheckouts();
          this.getPatients();
          Toast.fire({
            icon: "success",
            title: "Patient successfully checked-out",
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
    getPatientCheckouts() {
      axios
        .get("/api/v1/patient-checkouts/" + this.id, {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then((response) => (this.checkouts = response.data))
        .catch((error) => {
          console.log(error);
          if (error.response.status == 401) {
            this.$router.push({
              name: "logout",
            });
          }
        });
    },
    getPatients() {
      axios
        .get("/api/v1/patient-checkins/" + this.id, {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then((response) => (this.patients = response.data))
        .catch((error) => {
          console.log(error);
          if (error.response.status == 401) {
            this.$router.push({
              name: "logout",
            });
          }
        });
    },
  },
};
</script>

<style scoped></style>
