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
        <top-bar title="Patient Invoices"></top-bar>
        <!-- END: Top Bar -->

        <div class="grid grid-cols-12 gap-6 mt-4">
          <div class="intro-y col-span-12 xl:col-span-8">
            <div class="intro-y box">
              <div
                class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60"
              >
                <h2 class="font-medium text-base mr-auto">Unpaid Invoices</h2>
              </div>
              <div class="p-5">
                <div v-if="invoices.length != 0">
                  <div class="overflow-x-auto">
                    <table class="table text-xs table-bordered">
                      <thead>
                        <tr>
                          <th class="whitespace-nowrap">Name</th>
                          <th class="whitespace-nowrap"></th>
                          <th class="whitespace-nowrap"></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="invoice in invoices" :key="invoice.id">
                          <td v-text="invoice.name"></td>

                          <td>
                            {{
                              invoice.created_at | moment("dddd, MMMM Do YYYY, h:mm:ss a")
                            }}
                          </td>
                          <td>
                            <router-link
                              :to="{ name: 'invoices', params: { key: invoice.key } }"
                              class="btn btn-primary mt-1"
                              >View Invoices</router-link
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
                    <strong class="mr-2"> Whoops! </strong> There are no invoice yet!
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
  name: "patient-upaid-invoices",
  data() {
    return {
      id: null,
      token: null,
      invoices: "",
      key: "",
    };
  },

  created() {
    this.login();
    this.getPatientUnpaidInvoices();
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

    getPatientUnpaidInvoices() {
      axios
        .get("/api/v1/patient-unpaid-invoices/" + this.token, {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then((response) => (this.invoices = response.data))
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
.tabs {
  position: relative;
  width: 100%;
  height: 100%;
  background-color: #fff;
}
.tabs-triggers {
  display: flex;
}
.tabs-trigger {
  flex: 1 0 auto;
  margin: 0;
  padding: 1rem;
  background-color: #686963;
  font-weight: bold;
  transition: 100ms linear all;
  cursor: pointer;
}
.tabs-trigger--active {
  background-color: #fff;
  color: #bc4b51;
}
.tabs-content {
  padding: 1rem;
  background-color: #fff;
}
</style>
