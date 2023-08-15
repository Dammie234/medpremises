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
        <top-bar title="Patient Visitors"></top-bar>
        <!-- END: Top Bar -->

        <div class="grid grid-cols-12 gap-6 mt-4">
          <div class="intro-y col-span-12 xxl:col-span-12">
            <div class="intro-y box">
              <div
                class="flex flex-col gap-6 sm:flex-row items-center p-5 border-b border-slate-200/60"
              >
                <div class="w-full xl:2/5">
                  <h2 class="font-medium text-base">
                    Patient Visitors for {{ new_date | moment("dddd Do MMMM YYYY") }}
                  </h2>
                </div>
                <div class="w-full xl:w-1/5">
                  <label class="form-label" for="date"
                    >Search Patient Visitors By Date</label
                  >
                  <input
                    id="date"
                    class="form-control mr-0 md:ml-3"
                    type="date"
                    v-model="date"
                    @change="archiveDate"
                    placeholder="Search Patient Visitors"
                  />
                </div>
                <div class="w-full xl:w-1/5">
                  <label class="form-label" for="month"
                    >Search Patient Visitors By Month</label
                  >
                  <input
                    id="month"
                    class="form-control mr-0 md:ml-3"
                    type="month"
                    v-model="month"
                    @change="archiveMonth"
                  />
                </div>
                <div class="w-full xl:w-1/5">
                  <input
                    class="form-control mt-5"
                    type="text"
                    v-model="search"
                    placeholder="Seach Patient Name"
                  />
                </div>
              </div>
              <div class="p-5">
                <div class="grid grid-cols-12 gap-x-5">
                  <div class="col-span-12 xl:col-span-12 mt-3">
                    <div v-if="visitors.length != 0">
                      <div class="overflow-x-auto">
                        <table class="table table-sm table-bordered">
                          <thead>
                            <tr>
                              <th class="whitespace-nowrap">Patient</th>

                              <th class="whitespace-nowrap">Visitor Name</th>
                              <th class="whitespace-nowrap">Visitor Phone</th>
                              <th class="whitespace-nowrap">Relationship</th>
                              <th class="whitespace-nowrap">Date &amp; Time In</th>
                              <th class="whitespace-nowrap">Date &amp; Time Out</th>
                              <th class="whitespace-nowrap">Duration</th>
                              <th class="whitespace-nowrap">Added By</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr v-for="visitor in filterSearch" :key="visitor.id">
                              <td>{{ visitor.patient_name }}</td>

                              <td>
                                {{ visitor.name }}
                              </td>
                              <td>
                                {{ visitor.phone }}
                              </td>
                              <td>
                                {{ visitor.relationship }}
                              </td>
                              <td>{{ visitor.created_at | moment('dddd Do MMMM YYYY  h:mm:ss a') }}</td>
                              <td>
                                {{ visitor.updated_at | moment('dddd Do MMMM YYYY  h:mm:ss a') }}
                              </td>
                              <td>
                                {{ diffBtwDates(visitor.created_at, visitor.updated_at) }}
                              </td>
                              <td>{{ visitor.staff_name }}</td>
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
                        <strong class="mr-2"> Whoops! </strong> There are no visitors
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
  name: "visitors",
  data() {
    return {
      id: null,
      token: null,
      date: "",
      new_date: "",
      visitors: [],
      month: "",
      search: "",
      loading: false,
    };
  },
  computed: {
    filterSearch() {
      let str = this.search;
      let string = str.charAt(0).toUpperCase() + str.slice(1);
      return this.visitors.filter((visitor) => {
        return visitor.patient_name.match(string);
      });
    },
  },
  created() {
    this.login();

    this.getPatientVisitors();
  },
  methods: {
    login() {
      if (!User.loggedIn()) {
        this.$router.push({
          name: "logout",
        });
      } else {
        this.token = User.token();
        this.new_date = this.$route.params.date;
      }
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
    archiveDate() {
      let date = this.date;
      document.location.href = `/medical/visitor-archive-date/${date}`;
    },
    archiveMonth() {
      let month = this.month;
      this.$router.push({
        path: `/medical/visitor-archive-month/${month}`,
      });
    },
    getPatientVisitors() {
      axios
        .get("/api/v1/visitor-archive-date/" + this.new_date + "/" + this.token, {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then((response) => (this.visitors = response.data))
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
