<template>
  <div class="main">
    <!-- BEGIN: Mobile Menu -->
    <mobile-menu></mobile-menu>
    <!-- END: Mobile Menu -->
    <div class="flex">
      <!-- BEGIN: Side Menu -->
      <side-menu page="lab"></side-menu>
      <!-- END: Side Menu -->
      <!-- BEGIN: Content -->
      <div class="content">
        <!-- BEGIN: Top Bar -->
        <top-bar title="Prenatals"></top-bar>
        <!-- END: Top Bar -->

        <div class="grid grid-cols-12 gap-6 mt-4">
          <div class="intro-y col-span-12 xxl:col-span-12">
            <div class="intro-y box">
              <div
                class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60"
              >
                <h2 class="font-medium text-base mr-auto">
                  {{ data.patient.name + " " + present_week }}
                </h2>

                <div class="w-full flex flex-row sm:w-auto sm:ml-auto mt-3 sm:mt-0"></div>
              </div>
              <div class="p-5">
                <div class="overflow-x-auto" v-if="data.tests.length != 0">
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
                            :to="{ name: 'lab-result', params: { id: test.test_id } }"
                            class="btn btn-primary"
                            >View Result</router-link
                          >
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div
                  v-else
                  class="alert alert-outline-danger alert-dismissible show flex items-center mb-2"
                  role="alert"
                >
                  <i data-feather="alert-octagon" class="fa fa-exclamation-circle fa-2x mr-2"></i>
                  <strong class="mr-2"> Whoops! </strong> There are no patient medical laboratory test
                  yet.
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
      <!-- END: Content -->
    </div>
  </div>
</template>
<script>
export default {
  name: "prenatal-medical-test-results",
  data() {
    return {
      token: "",
      data: {},
      key: "",
      week: "",
      present_week: "",
    };
  },

  created() {
    this.login();
    this.getPrenatalMedicalTestResults();
  },
  methods: {
    login() {
      if (!User.loggedIn()) {
        this.$router.push({
          name: "logout",
        });
      } else {
        this.token = User.token();
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
    getPrenatalMedicalTestResults() {
      let key = this.$route.params.key;
      let week = this.$route.params.week;
      axios
        .get("/api/v1/prental-medical-test-results/" + key + "/" + week, {
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
