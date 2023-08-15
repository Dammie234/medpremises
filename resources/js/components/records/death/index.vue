<template>
  <div class="main">
    <!-- BEGIN: Mobile Menu -->
    <mobile-menu></mobile-menu>
    <!-- END: Mobile Menu -->
    <div class="flex">
      <!-- BEGIN: Side Menu -->
      <side-menu page="record"></side-menu>
      <!-- END: Side Menu -->
      <!-- BEGIN: Content -->
      <div class="content">
        <!-- BEGIN: Top Bar -->
        <top-bar title="Death Records"></top-bar>
        <!-- END: Top Bar -->

        <div class="grid grid-cols-12 gap-6 mt-4">
          <div class="intro-y col-span-12 xxl:col-span-12">
            <div class="intro-y box">
              <div
                class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60"
              >
                <h2 class="font-medium text-base mr-auto">Death Records</h2>

                <div class="w-full sm:w-auto sm:ml-auto mt-3 sm:mt-0">
                  <input
                    class="form-control mr-3 ml-3"
                    type="text"
                    v-model="search"
                    placeholder="Seach Decedent Legal Name"
                  />
                </div>
                <router-link
                  :to="{ name: 'create-death-record' }"
                  class="btn btn-primary"
                  style="margin-left: 20px"
                  >Add Death Record</router-link
                >
              </div>
              <div class="p-5">
                <div class="grid grid-cols-12 gap-x-5">
                  <div class="col-span-12 xl:col-span-12 mt-3">
                    <div v-if="deaths.length != 0">
                      <div class="overflow-x-auto">
                        <table class="table table-xs table-bordered">
                          <thead>
                            <tr class="text-xs uppercase">
                              <th>Decedent Legal Name</th>
                              <th>Gender</th>
                              <th>Date of Birth</th>
                              <th>Actual Date of Death</th>
                              <th>Marital Status</th>
                              <th>Address</th>
                              <th>Informant Name</th>
                              <th>Relationship with Decedent</th>
                              <th>Method of Disposition</th>
                              <th>Place of Disposition</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr v-for="death in filterSearch" :key="death.id">
                              <td>{{ death.decedent_legal_name }}</td>
                              <td>{{ death.gender }}</td>
                              <td>{{ death.date_of_birth | moment("MMMM Do YYYY") }}</td>
                              <td>
                                {{ death.actual_date_of_death | moment("MMMM Do YYYY") }}
                              </td>
                              <td>{{ death.marital_status }}</td>
                              <td>{{ death.address }}</td>
                              <td>{{ death.informant_name }}</td>
                              <td>{{ death.relationship_with_decedent }}</td>
                              <td>{{ death.method_of_disposition }}</td>
                              <td>{{ death.place_of_disposition }}</td>
                              <td class="whitespace-nowrap">
                                <router-link
                                  :to="{
                                    name: 'death-record',
                                    params: { slug: death.slug },
                                  }"
                                  class="btn btn-primary"
                                >
                                  <i class="fa fa-info"></i>
                                </router-link>
                                <router-link
                                  :to="{
                                    name: 'edit-death-record',
                                    params: { slug: death.slug },
                                  }"
                                  class="btn btn-primary"
                                  ><i class="fa fa-edit"></i
                                ></router-link>
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
                        <strong class="mr-2"> Whoops! </strong> There are no death records added yet
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
  name: "death-records",
  data() {
    return {
      id: null,
      token: null,
      deaths: [],
      search: "",
    };
  },
  computed: {
    filterSearch() {
      let str = this.search;
      let string = str.charAt(0).toUpperCase() + str.slice(1);
      return this.deaths.filter((death) => {
        return death.decedent_legal_name.match(string);
      });
    },
  },
  created() {
    this.login();
    this.getDeathRecords();
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

    getDeathRecords() {
      axios
        .get("/api/v1/death-records/" + this.token, {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then((response) => (this.deaths = response.data))
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
