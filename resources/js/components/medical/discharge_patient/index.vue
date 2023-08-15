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
        <top-bar title="Discharged Patients"></top-bar>
        <!-- END: Top Bar -->
        <div class="grid grid-cols-12 gap-6 mt-4">
          <div class="intro-y col-span-12 xxl:col-span-12">
            <div class="intro-y box">
              <div
                class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60"
              >
                <h2 class="font-medium text-base mr-auto">Discharged Patients</h2>
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
                              <th class="whitespace-nowrap">Admitted Date</th>
                              <th class="whitespace-nowrap">Diagnosis at Admittance</th>
                              <th class="whitespace-nowrap">Discharged Date</th>
                              <th class="whitespace-nowrap">Reason for Discharge</th>

                              <th class="whitespace-nowrap">Discharged By</th>
                              <th class="whitespace-nowrap">Taken</th>
                              <th class="whitespace-nowrap"></th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr v-for="patient in filterSearch" :key="patient.id">
                              <td>{{ patient.name }}</td>
                              <td>
                                {{ patient.admitted_date | moment("Do MMMM YYYY") }}
                              </td>
                              <td>{{ patient.diagnosis_at_admittance }}</td>
                              <td>
                                {{ patient.date_discharged | moment("Do MMMM YYYY") }}
                              </td>
                              <td>{{ patient.reason_for_discharged }}</td>

                              <td>{{ patient.staff_name }}</td>
                              <td>{{ patient.created_at | moment("from", "now") }}</td>
                              <td>
                                <router-link
                                  :to="{
                                    name: 'discharged-patient',
                                    params: { key: patient.key },
                                  }"
                                  class="btn btn-primary mr-2"
                                  >More Info</router-link
                                >
                                <router-link
                                  :to="{
                                    name: 'edit-discharge-planning-checklist-staff',
                                    params: { key: patient.key },
                                  }"
                                  class="btn btn-primary mr-2"
                                  >Edit Discharge Planning Checklist</router-link
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
                        <strong class="mr-2"> Whoops! </strong> There are no discharged patients added
                        yet!
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
    </div>
  </div>
</template>
<script>
export default {
  name: "discharged-patients",
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
  data() {
    return {
      token: "",
      patients: [],
      search: "",
    };
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
        .get("/api/v1/discharged-patients/" + this.token, {
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
