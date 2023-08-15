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
        <patient-top-bar title="Prenatal Laboratory Medical Tests"></patient-top-bar>
        <!-- END: Top Bar -->

        <div class="grid grid-cols-12 gap-6 mt-4">
          <div class="intro-y col-span-12 xxl:col-span-12">
            <div class="intro-y box">
              <div
                class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60"
              >
                <div class="w-full lg:w-1/2">
                  <h2 class="font-medium text-base mr-auto">
                    {{ patient.name + " " + present_week }}
                  </h2>
                </div>

                <div class="w-full flex flex-row sm:w-auto sm:ml-auto mt-3 sm:mt-0">
                  <router-link
                    :to="{ name: 'patient-prenatal-visits', params: { key: key } }"
                    class="btn btn-primary"
                    >Go Back</router-link
                  >
                </div>
              </div>
              <div class="p-5">
                <div class="overflow-x-auto">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Facility</th>
                        <th>Test</th>

                        <th></th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody class="text-xs">
                      <tr v-for="test in data.tests" :key="test.id">
                        <td>{{ test.registered_facility_name }}</td>
                        <td>
                          {{ test.test_name }}
                        </td>

                        <td>
                          {{ test.updated_at | moment("dddd, MMMM Do YYYY, h:mm:ss a") }}
                        </td>
                        <td>
                          <router-link
                            :to="{
                              name: 'patient-prenatal-laboratory-result',
                              params: { id: test.test_id },
                            }"
                            class="btn btn-primary"
                            >View Result</router-link
                          >
                        </td>
                      </tr>
                    </tbody>
                  </table>
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
      token: "",
      key: "",
      data: {},
      week: "",
      patient: "",
      present_week: "",
    };
  },

  created() {
    this.login();
    this.getPrenatalMedicalTestResults();
    this.getPatient();
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
        this.key = this.$route.params.key;
        this.week = this.$route.params.week;
        if (this.week == "prenatal-first-visit") {
          this.present_week = "Prenatal First Visit";
        } else if (this.week == "prenatal-28-week") {
          this.present_week = "Prenatal 28 Week";
        } else if (this.week == "prenatal-34-36-week") {
          this.present_week = "Prenatal 34/36 Week";
        } else if (this.week == "prenatal-40-41-week") {
          this.present_week = "Prenatal 40/41 Week";
        }
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
    getPrenatalMedicalTestResults() {
      let key = this.$route.params.key;
      let week = this.$route.params.week;
      axios
        .get("/api-patient/v1/patient-prental-medical-test-results/" + key + "/" + week, {
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
              name: "logout",
            });
          }
        });
    },
  },
};
</script>
<style scoped>
ul {
  list-style: disc;
}
</style>
