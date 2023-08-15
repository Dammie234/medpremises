<template>
  <div class="main">
    <!-- BEGIN: Mobile Menu -->
    <patient-mobile-menu></patient-mobile-menu>
    <!-- END: Mobile Menu -->
    <div class="flex">
      <!-- BEGIN: Side Menu -->
      <patient-side-menu page="prenatal"></patient-side-menu>
      <!-- END: Side Menu -->
      <!-- BEGIN: Content -->
      <div class="content">
        <!-- BEGIN: Top Bar -->
        <patient-top-bar title="Prenatal Details"></patient-top-bar>
        <!-- END: Top Bar -->

        <div class="grid grid-cols-12 gap-6 mt-4">
          <div class="intro-y col-span-12 xxl:col-span-12">
            <div class="intro-y box">
              <div
                class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60"
              >
                <h2 class="font-medium text-base mr-auto">
                  {{ patient.name }} Prenatal Details
                </h2>
                <div class="w-full sm:w-auto sm:ml-auto mt-3 sm:mt-0"></div>
              </div>
              <div class="p-5">
                <div class="grid grid-cols-12 gap-x-5">
                  <div class="col-span-12 xl:col-span-12 mt-3">
                    <div v-if="data.count != 0">
                      <div class="overflow-x-auto">
                        <table class="table table-bordered">
                          <thead>
                            <tr>
                              <th>Last Menstral Period</th>
                              <th>Gestational Period</th>

                              <th>Expected Due Date</th>
                              <th>Date of First Prenatal Visit</th>
                              <th>Pregnancy Type</th>
                              <th>Number of Visits</th>
                              <th></th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody class="text-xs">
                            <tr>
                              <td>
                                {{
                                  data.prenatal.last_menstral_period
                                    | moment("dddd Do MMMM YYYY")
                                }}
                              </td>
                              <td>{{ data.prenatal.gestational_period }}</td>
                              <td>
                                {{
                                  data.prenatal.expected_due_date
                                    | moment("dddd Do MMMM YYYY")
                                }}
                              </td>
                              <td>
                                {{
                                  data.prenatal.date_of_first_prenatal_visit
                                    | moment("dddd Do MMMM YYYY")
                                }}
                              </td>
                              <td>{{ data.prenatal.pregnancy_type }}</td>
                              <td>{{ data.prenatal.count_visits }}</td>
                              <td>
                                {{ data.prenatal.created_at | moment("from", "now") }}
                              </td>
                              <td>
                                <router-link
                                  :to="{ name: 'patient-prenatal' }"
                                  class="btn btn-primary mr-3 mt-2 btn-sm"
                                  title="More Information"
                                  ><i class="fa fa-info mr-2"></i> More
                                  Details</router-link
                                ><router-link
                                  :to="{
                                    name: 'patient-prenatal-visits',
                                    params: { key: data.prenatal.key },
                                  }"
                                  title="Prenatal/Antenatal Visits"
                                  class="btn btn-primary mr-3 mt-2 btn-sm"
                                  ><i class="fa fa-map-marker mr-2"></i>
                                  Visits</router-link
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
                        <strong class="mr-2"> Whoops! </strong> You are not pregnant or you have not
                        registered for prenatal/antenantal
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
  name: "prenatal",
  data() {
    return {
      id: null,
      token: null,
      data: {},

      patient: "",
    };
  },

  created() {
    this.login();
    this.getPatient();
    this.getPrenatalData();
  },
  methods: {
    login() {
      if (!Patient.loggedIn()) {
        this.$router.push({
          name: "patient-logout",
        });
      } else {
        this.id = Patient.id();
        this.token = Patient.token();
      }
    },
    getPatient() {
      axios
        .get("/api-patient/v1/patient-id/" + this.id, {
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
              name: "patient-logout",
            });
          }
        });
    },
    getPrenatalData() {
      axios
        .get("/api-patient/v1/patient-prenatal/" + this.id, {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then((response) => (this.data = response.data))
        .catch((error) => {
          console.log(error);
          if (error.response.status == 401) {
            this.$router.push({
              name: "patient-logout",
            });
          }
        });
    },
  },
};
</script>

<style scoped></style>
