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
        <top-bar title="Patient Checkin Archive"></top-bar>
        <!-- END: Top Bar -->

        <div class="grid grid-cols-12 gap-6 mt-4">
          <div class="intro-y col-span-12 xxl:col-span-12">
            <div class="intro-y box">
              <div
                class="flex gap-6 flex-col sm:flex-row items-center p-5 border-b border-slate-200/60"
              >
                <div class="w-full xl:w-2/5">
                  <h2 class="font-medium text-base">
                    Patient Checkin Archive for {{ new_month | moment("MMMM YYYY") }}
                  </h2>
                </div>

                <div class="w-full xl:w-1/5">
                  <label class="form-label" for="date"
                    >Search Patient Checkin By Date</label
                  >
                  <input
                    id="date"
                    class="form-control"
                    type="date"
                    v-model="date"
                    @change="archiveDate"
                    placeholder="Search Patient Checkin Archive"
                  />
                </div>
                <div class="w-full xl:w-1/5">
                  <label class="form-label" for="month">
                    Search Patient Checkin By Month</label
                  >
                  <input
                    id="month"
                    class="form-control"
                    type="month"
                    v-model="month"
                    @change="archiveMonth"
                    placeholder="Search Patient Checkin Archive"
                  />
                </div>
                <div class="w-full xl:w-1/5 xl:mt-5">
                  <input
                    class="form-control"
                    type="text"
                    v-model="search"
                    placeholder="Seach Patient Name"
                  />
                </div>
              </div>
              <div class="p-5">
                <div class="grid grid-cols-12 gap-x-5">
                  <div class="col-span-12 xl:col-span-12 mt-3">
                    <div v-if="checkins.length != 0">
                      <div class="overflow-x-auto">
                        <table class="table table-sm table-bordered">
                          <thead>
                            <tr>
                              <th class="whitespace-nowrap">Patient</th>
                              <th class="whitespace-nowrap">Who Brought Patient</th>
                              <th class="whitespace-nowrap">Checkin Date</th>
                              <th class="whitespace-nowrap">Checkout Date</th>
                              <th class="whitespace-nowrap">Duration</th>
                              <th class="whitespace-nowrap">Who Picked Patient</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr v-for="checkin in filterSearch" :key="checkin.id">
                              <td>{{ checkin.name }}</td>
                              <td>
                                <span v-if="checkin.self == 1"
                                  >Patient came by herself/himself</span
                                ><span v-else
                                  >Brought by
                                  {{
                                    checkin.brought_name +
                                    " - " +
                                    checkin.brought_phone +
                                    " - " +
                                    checkin.relationship
                                  }}</span
                                >
                              </td>

                              <td>
                                {{
                                  checkin.created_at
                                    | moment("dddd Do MMMM YYYY, h:mm:ss a")
                                }}
                              </td>
                              <td>
                                {{
                                  checkin.updated_at
                                    | moment("dddd Do MMMM YYYY, h:mm:ss a")
                                }}
                              </td>
                              <td>
                                {{ diffBtwDates(checkin.created_at, checkin.updated_at) }}
                              </td>
                              <td>
                                <span v-if="checkin.myself == 1"
                                  >Patient left by himself/herself</span
                                ><span v-else
                                  >Picked by
                                  {{
                                    checkin.pickup_name +
                                    " - " +
                                    checkin.pickup_phone +
                                    " - " +
                                    checkin.my_relationship
                                  }}</span
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
                        <strong class="mr-2"> Whoops! </strong> There are no checkins
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
  name: "patient-checkin-archive",
  data() {
    return {
      id: null,
      token: null,
      date: "",
      month: "",
      new_month: "",
      checkins: [],
      search: "",
    };
  },
  computed: {
    filterSearch() {
      let str = this.search;
      let string = str.charAt(0).toUpperCase() + str.slice(1);
      return this.checkins.filter((checkin) => {
        return checkin.name.match(string);
      });
    },
  },
  created() {
    this.login();

    this.getPatientCheckins();
  },
  methods: {
    login() {
      if (!User.loggedIn()) {
        this.$router.push({
          name: "logout",
        });
      } else {
        this.token = User.token();
        this.id = User.id()
        this.new_month = this.$route.params.month;
      }
    },
    archiveDate() {
      let date = this.date;
      this.$router.push({
        path: `/medical/patient/checkin-archive-date/${date}`,
      });
    },
    archiveMonth() {
      let month = this.month;
      document.location.href = `/medical/patient/checkin-archive-month/${month}`;
    },
    diffBtwDates(date1, date2) {
      let checkin = new Date(date1);
      let checkout = new Date(date2);
      let t1 = checkin.getTime();
      let t2 = checkout.getTime();
      let diffInDays = Math.floor((t2 - t1) / (24 * 3600 * 1000));
      let weeks = parseInt(diffInDays / 7);
      let days = diffInDays % 7;
      return weeks + " weeks " + days + " days";
    },
    getPatientCheckins() {
      axios
        .get(
          "/api/v1/patient-checkins-archive-date/" + this.new_month + "/" + this.id,
          {
            headers: {
              Authorization: "Bearer " + this.token,
              Accept: "application/json",
            },
          }
        )
        .then((response) => (this.checkins = response.data))
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
