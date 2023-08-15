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
                <h2 class="font-medium text-base mr-auto">Prenatals</h2>

                <div class="w-full flex flex-row sm:w-auto sm:ml-auto mt-3 sm:mt-0">
                  <input
                    class="form-control mr-0 ml-3"
                    type="text"
                    v-model="search"
                    placeholder="Seach Patient"
                  />
                </div>
              </div>
              <div class="p-5">
                
                <div class="overflow-x-auto" v-if="prenatals.length != 0">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Facility</th>
                        <th>Patient</th>
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
                      <tr v-for="prenatal in filterSearch" :key="prenatal.id">
                        <td>{{ prenatal.registered_facility_name }}</td>
                        <td>{{ prenatal.name }}</td>
                        <td>
                          {{
                            prenatal.last_menstral_period | moment("dddd Do MMMM YYYY")
                          }}
                        </td>
                        <td>{{ prenatal.gestational_period }}</td>
                        <td>
                          {{ prenatal.expected_due_date | moment("dddd Do MMMM YYYY") }}
                        </td>
                        <td>
                          {{
                            prenatal.date_of_first_prenatal_visit
                              | moment("dddd Do MMMM YYYY")
                          }}
                        </td>
                        <td>{{ prenatal.pregnancy_type }}</td>
                        <td>{{ prenatal.count_visits }}</td>
                        <td>{{ prenatal.created_at | moment("from", "now") }}</td>
                        <td>
                          <router-link
                            :to="{ name: 'lab-prenatal', params: { key: prenatal.key } }"
                            class="btn btn-primary mr-3 mt-2 btn-sm"
                            title="More Information"
                            ><i class="fa fa-info mr-2"></i> More</router-link
                          >
                          <router-link
                            :to="{
                              name: 'lab-prenatal-tests',
                              params: { key: prenatal.key },
                            }"
                            class="btn btn-primary mr-3 mt-2 btn-sm"
                            title="More Information"
                          >
                            Medical Tests</router-link
                          >
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div v-else>
                  <div
                    class="alert alert-outline-danger alert-dismissible show flex items-center mb-2"
                    role="alert"
                  >
                    <i data-feather="alert-octagon" class="fa fa-exclamation-circle fa-2x mr-2"></i>
                    <strong class="mr-2"> Whoops! </strong> There are no registered prenatals yet.
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
      <!-- END: Content -->
    </div>
  </div>
</template>
<script>
export default {
  name: "prenatals",
  data() {
    return {
      token: "",
      prenatals: [],
      search: "",
    };
  },
  computed: {
    filterSearch() {
      let str = this.search;
      let string = str.charAt(0).toUpperCase() + str.slice(1);
      return this.prenatals.filter((prenatal) => {
        return prenatal.name.match(string);
      });
    },
  },
  created() {
    this.login();
    this.getPrenatals();
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
    getPrenatals() {
      axios
        .get("/api/v1/fetch-prenatals", {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then((response) => (this.prenatals = response.data))
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
