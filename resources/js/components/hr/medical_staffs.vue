<template>
  <div class="main">
    <!-- BEGIN: Mobile Menu -->
    <mobile-menu></mobile-menu>
    <!-- END: Mobile Menu -->
    <div class="flex">
      <!-- BEGIN: Side Menu -->
      <side-menu page="hr"></side-menu>
      <!-- END: Side Menu -->
      <!-- BEGIN: Content -->
      <div class="content">
        <!-- BEGIN: Top Bar -->
        <top-bar title="Medical Staffs"></top-bar>
        <!-- END: Top Bar -->

        <div class="grid grid-cols-12 gap-6 mt-4">
          <div class="intro-y col-span-12 xxl:col-span-12">
            <div class="intro-y box">
              <div
                class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60"
              >
                <h2 class="font-medium text-base mr-auto">Medical Staffs</h2>
              </div>
              <div class="p-5">
                <div class="grid grid-cols-12 gap-x-5">
                  <div class="col-span-12 xl:col-span-6">
                    <input
                      class="form-control mr-0 ml-3"
                      type="text"
                      v-model="search"
                      placeholder="Seach Medical Staff"
                    />
                  </div>
                  <div class="col-span-12 xl:col-span-6">
                    <div class="grid grid-cols-12 gap-2">
                      <div class="col-span-12 xl:col-span-9 md:col-span-10 mr-3">
                        <input
                          class="form-control mr-0 ml-3"
                          type="text"
                          v-model="unemployed"
                          required
                          placeholder="Seach Unemployed Medical Staff"
                        />
                      </div>
                      <div class="col-span-12 xl:col-span-3">
                        <button
                          class="btn btn-primary"
                          @click="getUnemplyedMedicalStaffs"
                        >
                          <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            icon-name="search"
                            data-lucide="search"
                            class="lucide lucide-search block mx-auto"
                          >
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                          </svg>
                          Search
                        </button>
                      </div>
                    </div>
                  </div>
                  <div
                    class="col-span-12 xl:col-span-12 mt-3"
                    v-if="unemployed_staff == true"
                  >
                    <div v-if="unemployed_staffs.length != 0">
                      <h3 class="text-2xl font-medium leading-none mt-3">
                        Unemployed Medical Staffs
                      </h3>
                      <div class="overflow-x-auto">
                        <table class="table table-sm table-bordered">
                          <thead>
                            <tr>
                              <th class="whitespace-nowrap">Name</th>
                              <th class="whitespace-nowrap">Role</th>
                              <th class="whitespace-nowrap">Email Address</th>
                              <th class="whitespace-nowrap">Practice Type</th>
                              <th class="whitespace-nowrap">Job Type</th>
                              <th class="whitespace-nowrap">MDCN Number</th>
                              <th class="whitespace-nowrap">Employment Type</th>

                              <th class="whitespace-nowrap">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr v-for="staff in unemployed_staffs" :key="staff.id">
                              <td>{{ staff.name }}</td>
                              <td>{{ staff.role }}</td>
                              <td>{{ staff.email }}</td>
                              <td>{{ staff.practice_type }}</td>
                              <td>{{ staff.job_type }}</td>
                              <td>{{ staff.mdcn_number }}</td>
                              <td>{{ staff.employment_type }}</td>

                              <td class="whitespace-nowrap">
                                <router-link
                                  :to="{
                                    name: 'medical-staff',
                                    params: { id: staff.id },
                                  }"
                                  class="btn btn-primary mr-3"
                                >
                                  <i class="fa fa-info pr-2"></i> More
                                </router-link>
                                <button
                                  class="btn btn-success"
                                  @click="employMedicalStaff(staff.id)"
                                >
                                  <i class="fa fa-user pr-2"></i> Employ
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
                        <strong class="mr-2"> Whoops! </strong> There is no unemployed medical staffs
                        based on your search
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
                  <div class="col-span-12 xl:col-span-12 mt-3">
                    <div v-if="staffs.length != 0">
                      <h3 class="text-2xl font-medium leading-none mt-3">
                        Medical Staffs
                      </h3>
                      <div class="overflow-x-auto">
                        <table class="table table-sm table-bordered">
                          <thead>
                            <tr>
                              <th class="whitespace-nowrap">Name</th>
                              <th class="whitespace-nowrap">Role</th>

                              <th class="whitespace-nowrap">Job Type</th>
                              <th class="whitespace-nowrap">MDCN Number</th>
                              <th class="whitespace-nowrap">Employment Type</th>
                              <th class="whitespace-nowrap">Generate PIN</th>
                              <th class="whitespace-nowrap">PIN</th>
                              <th class="whitespace-nowrap">PIN Usability</th>
                              <th class="whitespace-nowrap">Active</th>
                              <th class="whitespace-nowrap">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr v-for="staff in filterSearch" :key="staff.id">
                              <td>{{ staff.name }}</td>
                              <td>{{ staff.role }}</td>

                              <td>{{ staff.job_type }}</td>
                              <td>{{ staff.mdcn_number }}</td>
                              <td>{{ staff.employment_type }}</td>
                              <td>
                                <button
                                  @click="generatePIN(staff.id)"
                                  class="btn btn-primary btn-sm"
                                >
                                  Generate PIN
                                </button>
                              </td>
                              <td>
                                <span v-if="staff.pin_usability == false">{{
                                  staff.pin
                                }}</span
                                ><span v-else>Generate Another PIN</span>
                              </td>
                              <td>
                                <span v-if="staff.pin_usability == true">PIN Used</span
                                ><span v-else>-</span>
                              </td>
                              <td>
                                <span v-if="staff.active == true">Online</span
                                ><span v-else>Offline</span>
                              </td>
                              <td class="whitespace-nowrap">
                                <router-link
                                  :to="{
                                    name: 'medical-staff',
                                    params: { id: staff.id },
                                  }"
                                  class="btn btn-primary mr-3"
                                >
                                  <i class="fa fa-info pr-2"></i>
                                </router-link>
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
                        <strong class="mr-2"> Whoops! </strong> There are no medical staffs
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
  name: "medical-staffs",
  data() {
    return {
      id: null,
      token: "",
      staffs: [],
      search: "",
      unemployed: "",
      unemployed_staffs: [],
      unemployed_staff: false,
    };
  },
  computed: {
    filterSearch() {
      let str = this.search;
      let string = str.charAt(0).toUpperCase() + str.slice(1);
      return this.staffs.filter((staff) => {
        return staff.name.match(string);
      });
    },
    filterNewSearch() {
      let str = this.unemployed;
      let string = str.charAt(0).toUpperCase() + str.slice(1);
      return this.unemployed_staffs.filter((employed_staff) => {
        return employed_staff.name.match(string);
      });
    },
  },
  created() {
    this.login();
    this.getMedicalStaffs();
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

    getMedicalStaffs() {
      axios
        .get("/api/v1/medical-staffs/" + this.token, {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then((response) => (this.staffs = response.data))
        .catch((error) => {
          console.log(error);
          if (error.response.status == 401) {
            this.$router.push({
              name: "logout",
            });
          }
        });
    },
    getUnemplyedMedicalStaffs() {
      this.unemployed_staff = true;
      axios
        .get("/api/v1/unemployed-medical-staffs/" + this.unemployed, {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then((response) => (this.unemployed_staffs = response.data))
        .catch((error) => {
          console.log(error);
          if (error.response.status == 401) {
            this.$router.push({
              name: "logout",
            });
          }
        });
    },
    generatePIN(id) {
      Swal.fire({
        title: "Are you sure?",
        text: "Staff will have access to login!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, generate PIN!",
      }).then((result) => {
        if (result.isConfirmed) {
          axios
            .get("/api/generate-pin/" + id)
            .then(() => {
              this.getStaffs();
              this.$router.push({
                name: "medical-staffs",
              });
            })
            .catch();
          Swal.fire("PIN Generated!", "User now has access to login.", "success");
          this.getStaffs();
          this.$router.push({
            name: "medical-staffs",
          });
        }
      });
    },
    employMedicalStaff(id) {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, employ medical staff!",
      }).then((result) => {
        if (result.isConfirmed) {
          axios
            .get("/api/employ-medical-staff/" + id + "/" + this.token)
            .then(() => {
              this.$router.push({
                name: "medical-staffs",
              });
              this.getMedicalStaffs();
            })
            .catch();
          Swal.fire("Employed!", "A medical staff has been employed.", "success");
        }
      });
    },
  },
};
</script>

<style scoped></style>
