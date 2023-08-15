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
        <top-bar title="Previous Consultation"></top-bar>
        <!-- END: Top Bar -->

        <div class="grid grid-cols-12 gap-6 mt-4">
          <div class="intro-y col-span-12 xxl:col-span-12">
            <div class="intro-y box">
              <div
                class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60"
              >
                <h2 class="font-medium text-base mr-auto">
                  {{ patient.name }} Previous Consultation
                </h2>
                <div class="w-full sm:w-auto sm:ml-auto mt-3 sm:mt-0">
                  <input
                    class="form-control mr-0 ml-3"
                    type="text"
                    v-model="search"
                    placeholder="Seach Hospital Name"
                  />
                </div>
              </div>
              <div class="p-5">
                <div class="grid grid-cols-12 gap-x-5">
                  <div class="col-span-12 xl:col-span-12 mt-3">
                    <div v-if="consultations.length != 0">
                      <div class="overflow-x-auto">
                        <table class="table text-xs table-bordered">
                          <thead>
                            <tr>
                              <th class="whitespace-nowrap">Visited Date</th>
                              <th class="whitespace-nowrap">Staff Name</th>
                              <th class="whitespace-nowrap">Registered Facility Name</th>
                              <th class="whitespace-nowrap"></th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr
                              v-for="consultation in filterSearch"
                              :key="consultation.id"
                            >
                              <td>
                                Visit on
                                {{
                                  consultation.created_at
                                    | moment("dddd, MMMM Do YYYY, h:mm:ss a")
                                }}
                              </td>
                              <td>{{ consultation.staff_name }}</td>
                              <td>{{ consultation.registered_facility_name }}</td>

                              <td>
                                <router-link
                                  :to="{
                                    name: 'show-previous-consultations',
                                    params: { key: consultation.key },
                                  }"
                                  class="btn btn-primary"
                                  >Visit Info</router-link
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
                        <i data-feather="alert-octagon" class="fa fa-exclamation-circle fa-2x mr-2"></i>
                        <strong class="mr-2"> Whoops! </strong> There are no previous consultation yet!
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
  name: "consultations",
  data() {
    return {
      id: null,
      token: null,
      consultations: [],
      search: "",
      error: false,
      errors: [],
      patient: "",
    };
  },
  computed: {
    filterSearch() {
      let str = this.search;
      let string = str.charAt(0).toUpperCase() + str.slice(1);
      return this.consultations.filter((consultation) => {
        return consultation.registered_facility_name.match(string);
      });
    },
  },
  created() {
    this.login();
    this.getPreviousConsultations();
    this.getPatient();
  },
  methods: {
    login() {
      if (!User.loggedIn()) {
        this.$router.push({
          name: "logout",
        });
      } else {
        this.token = User.token();
      }
    },

    getPreviousConsultations() {
      let id = this.$route.params.id;
      axios
        .get("/api/v1/previous-consultations/" + id, {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then((response) => (this.consultations = response.data))
        .catch((error) => {
          console.log(error);
          if (error.response.status == 401) {
            this.$router.push({
              name: "logout",
            });
          }
        });
    },
    getPatient() {
      let id = this.$route.params.id;
      axios
        .get("/api/v1/patient-by-id/" + id, {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then((response) => (this.patient = response.data))
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
