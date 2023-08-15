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
        <top-bar title="Patient Visitors"></top-bar>
        <!-- END: Top Bar -->

        <div class="grid grid-cols-12 gap-6">
          <div class="intro-y col-span-12 xxl:col-span-12">
            <div class="intro-y box">
              <div
                class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5"
              >
                <h2 class="font-medium text-base mr-auto">Checkin Patient Visitor</h2>
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
                <div class="grid grid-cols-12 gap-x-5" :disabled="loading">
                  <div class="col-span-12">
                    <p class="text-red-500">
                      <strong>Notice:</strong> Visitor's details can't be editted or
                      deleted. So, be mindful of the data you add.
                    </p>
                  </div>
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

                  <div class="col-span-12 xl:col-span-4 mt-3">
                    <label for="name" class="form-label">Name</label>
                    <input
                      id="name"
                      type="text"
                      class="form-control"
                      placeholder="Name of person who brought patient"
                      v-model="form.name"
                    />
                    <div class="text-danger font-medium text-xs mt-1" v-if="errors.name">
                      {{ errors.name[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-4 mt-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input
                      id="phone"
                      type="text"
                      class="form-control"
                      placeholder="Phone Number of person who brought patient"
                      v-model="form.phone"
                    />
                    <div class="text-danger font-medium text-xs mt-1" v-if="errors.phone">
                      {{ errors.phone[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-3 mt-3">
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
                <h2 class="font-medium text-base mr-auto">Patient Visitors</h2>
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
                    <div v-if="visitors.length != 0">
                      <div class="overflow-x-auto">
                        <table class="table table-sm table-bordered">
                          <thead>
                            <tr>
                              <th class="whitespace-nowrap">Patient</th>

                              <th class="whitespace-nowrap">Visitor Name</th>
                              <th class="whitespace-nowrap">Visitor Phone</th>
                              <th class="whitespace-nowrap">Relationship</th>
                              <th class="whitespace-nowrap">Time In</th>
                              <th class="whitespace-nowrap">Time Out</th>

                              <th class="whitespace-nowrap">Added By</th>
                              <th class="whitespace-nowrap">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr v-for="visitor in filterSearch" :key="visitor.id">
                              <td>{{ visitor.patient_name }}</td>

                              <td>
                                {{ visitor.name }}
                              </td>
                              <td>
                                {{ visitor.phone }}
                              </td>
                              <td>
                                {{ visitor.relationship }}
                              </td>
                              <td>{{ visitor.time_in }}</td>
                              <td>
                                <strong v-if="!visitor.time_out"> still around</strong
                                ><span v-else>{{ visitor.time_out }}</span>
                              </td>

                              <td>{{ visitor.staff_name }}</td>
                              <td class="whitespace-nowrap">
                                <buuton
                                  v-if="!visitor.time_out"
                                  class="btn btn-primary"
                                  @click="checkoutVisitor(visitor.id)"
                                  >Checkout</buuton
                                >
                              </td>
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
                        <strong class="mr-2"> Whoops! </strong> There are no visitors
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
  name: "patient-checkins",
  data() {
    return {
      id: null,
      token: null,
      form: {
        patient: "",
        name: "",
        phone: "",
        relationship: "",
        token: "",
      },
      errors: [],
      error: false,
      visitors: [],
      patients: [],
      search: "",
      loading: false,
    };
  },
  computed: {
    filterSearch() {
      let str = this.search;
      let string = str.charAt(0).toUpperCase() + str.slice(1);
      return this.visitors.filter((visitor) => {
        return visitor.patient_name.match(string);
      });
    },
  },
  created() {
    this.login();
    this.getPatients();
    this.getPatientVisitors();
  },
  methods: {
    login() {
      if (!User.loggedIn()) {
        this.$router.push({
          name: "logout",
        });
      } else {
        this.token = User.token();
        this.form.token = User.token();
      }
    },
    store() {
      this.loading = true;
      axios
        .post("/api/visitor", this.form)
        .then(() => {
          this.$router.push({
            name: "visitors",
          });
          this.form = {
            patient: "",
            name: "",
            phone: "",
            relationship: "",
            token: "",
          };
          this.login();
          this.getPatientVisitors();
          this.getPatients();
          Toast.fire({
            icon: "success",
            title: "Patient visitor successfully added",
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
    checkoutVisitor(id) {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, checkout visitor!",
      }).then((result) => {
        if (result.isConfirmed) {
          axios
            .get("/api/visitor/" + id)
            .then(() => {
              this.$router.push({
                name: "visitors",
              });
              this.getVitalSigns();
            })
            .catch((error) => {
              this.error = true;
              console.log(error);
              if (error.response.status == 401) {
                this.errors.push(error.response.data.error);
              }
            });
          Swal.fire("Visitor Checkout!", "Patient visitor has checkout", "success");
        }
      });
    },
    getPatientVisitors() {
      axios
        .get("/api/v1/visitors/" + this.token, {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then((response) => (this.visitors = response.data))
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
        .get("/api/v1/patient-checkins/" + this.token, {
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
