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
        <top-bar title="Patient Satisfactory Survies"></top-bar>
        <!-- END: Top Bar -->

        <div class="grid grid-cols-12 gap-6 mt-4">
          <div class="intro-y col-span-12 xxl:col-span-12">
            <div class="intro-y box">
              <div
                class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60"
              >
                <h2 class="font-medium text-base mr-auto">
                  Patient Satisfactory Survies
                </h2>
                <div class="w-full sm:w-auto sm:ml-auto mt-3 sm:mt-0">
                  <input
                    class="form-control mr-0 ml-3"
                    type="text"
                    v-model="search"
                    placeholder="Seach Patient"
                  />
                </div>
              </div>
              <div class="p-5">
                <div class="grid grid-cols-12 gap-x-5">
                  <div class="col-span-12 xl:col-span-12 mt-3">
                    <div v-if="patients.length != 0">
                      <div class="overflow-x-auto">
                        <table class="table text-xs table-bordered">
                          <thead>
                            <tr>
                              <th class="whitespace-nowrap">Patient</th>
                              <th class="whitespace-nowrap">Experience</th>
                              <th class="whitespace-nowrap">Why Choose Us</th>
                              <th class="whitespace-nowrap">First Time</th>
                              <th class="whitespace-nowrap">Age</th>
                              <th class="whitespace-nowrap">Exceptional Staff</th>
                              <th class="whitespace-nowrap">Approval</th>
                              <th class="whitespace-nowrap">Modified</th>
                              <th class="whitespace-nowrap"></th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr v-for="patient in filterSearch" :key="patient.id">
                              <td>{{ patient.name }}</td>
                              <td>
                                {{ patient.experience }}
                              </td>
                              <td>{{ patient.why_choose_us }}</td>
                              <td>{{ patient.first_time }}</td>
                              <td>{{ patient.age }}</td>
                              <td>{{ patient.exceptional_staff }}</td>
                              <td>
                                <span
                                  v-if="patient.approval == false"
                                  class="btn btn-danger text-white"
                                  >Unapproved</span
                                ><span v-else class="btn btn-success text-white"
                                  >Approved</span
                                >
                              </td>
                              <td>{{ patient.created_at | moment("from", "now") }}</td>
                              <td>
                                <router-link
                                  :to="{
                                    name: 'hospital-patient-satisfactory-survey',
                                    params: { key: patient.key },
                                  }"
                                  class="btn btn-primary"
                                  >More</router-link
                                >
                                <button
                                  v-if="patient.approval == false"
                                  class="btn btn-primary"
                                  @click="approveSurvey(patient.key)"
                                >
                                  Approve
                                </button>
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
                        <strong class="mr-2"> Whoops! </strong> There are no patient satisfactory
                        survies
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
  name: "patient-satisfactory-survies",
  data() {
    return {
      id: null,
      token: null,
      patients: [],
      search: "",
      loading: false,
    };
  },
  computed: {
    filterSearch() {
      let str = this.search;
      let string = str.charAt(0).toUpperCase() + str.slice(1);
      return this.patients.filter((patient) => {
        return patient.name.match(string);
      });
    },
  },
  created() {
    this.login();
    this.getPatients();
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

    getPatients() {
      axios
        .get("/api/v1/patient-satisfactory-survies/" + this.token, {
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
    approveSurvey(key) {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, approve survey!",
      }).then((result) => {
        if (result.isConfirmed) {
          axios
            .get("/api/approve-survey/" + key)
            .then(() => {
              this.$router.push({
                name: "hospital-patient-satisfactory-survies",
              });
              this.getPatients();
            })
            .catch((error) => {
              this.error = true;
              console.log(error);
              if (error.response.status == 401) {
                this.errors.push(error.response.data.error);
              }
            });
          Swal.fire(
            "Patient Satisfactory Survey Approved!",
            "Patient Satisfactory Survey for patient has been approved",
            "success"
          );
        }
      });
    },
  },
};
</script>

<style scoped></style>
