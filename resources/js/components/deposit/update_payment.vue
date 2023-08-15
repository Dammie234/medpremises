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
        <top-bar title="Make Patient Deposit"></top-bar>
        <!-- END: Top Bar -->

        <div class="grid grid-cols-12 gap-6 mt-4">
          <div class="intro-y col-span-12 xl:col-span-8">
            <div class="intro-y box">
              <div
                class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60"
              >
                <h2 class="font-medium text-base mr-auto">{{ patient.name }} Invoices</h2>
              </div>
              <div class="p-5">
                <div v-if="data.invoices.length != 0">
                  <div class="overflow-x-auto">
                    <table class="table text-xs table-bordered">
                      <thead>
                        <tr>
                          <th class="whitespace-nowrap">Description</th>
                          <th class="whitespace-nowrap">Quantity</th>

                          <th class="whitespace-nowrap">Date</th>
                          <th class="whitespace-nowrap">Staff</th>
                          <th class="whitespace-nowrap">Amount</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="invoice in data.invoices" :key="invoice.id">
                          <td v-text="invoice.description"></td>
                          <td v-text="invoice.quantity"></td>

                          <td>
                            {{
                              invoice.created_at | moment("dddd, MMMM Do YYYY, h:mm:ss a")
                            }}
                          </td>
                          <td v-text="invoice.staff_name"></td>
                          <td>&#8358; {{ invoice.amount | numeral("0,0.00") }}</td>
                        </tr>
                      </tbody>
                      <tfoot>
                        <tr>
                          <td colspan="4">Total</td>
                          <td>&#8358;{{ computeTotal | numeral("0,0.00") }}</td>
                        </tr>
                      </tfoot>
                    </table>
                    <div
                      class="flex flex-col sm:flex-row items-center py-3 border-b border-slate-200/60"
                    >
                      <h2 class="font-medium text-base mr-auto">
                        {{ patient.name }} Expected Amount To Pay
                      </h2>
                    </div>
                    <table class="table table-xs table-bordered my-3">
                      <thead>
                        <tr>
                          <th>Diagnosis</th>
                          <th>Expected Amount</th>
                          <th>Paid Amount</th>
                          <th>Current Patient Cost</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>{{ data.deposit.diagnosis }}</td>
                          <td>&#8358;{{ data.deposit.amount | numeral("0,0.00") }}</td>
                          <td>
                            &#8358;{{ data.deposit.paid_amount | numeral("0,0.00") }}
                          </td>
                          <td>
                            &#8358;
                            {{ total | numeral("0,0.00") }}
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
          <div class="col-span-12 xl:col-span-4 mt-3">
            <div class="intro-y box">
              <div
                class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60"
              >
                <h2 class="font-medium text-base mr-auto">Make Payment</h2>
              </div>
              <div class="p-5">
                <form class="input" @submit.prevent="updatePatientDeposit">
                  <div class="p-5" :disabled="loading">
                    <div class="">
                      <label class="form-label">Patient Name</label>
                      <input
                        type="text"
                        class="form-control"
                        v-model="patient.name"
                        disabled
                      />
                    </div>
                    <div class="mt-3">
                      <label for="amount" class="form-label">Expected Amount</label>
                      <input
                        id="amount"
                        type="text"
                        class="form-control"
                        v-model="form.expected_amount"
                        disabled
                      />
                    </div>
                    <div class="mt-3">
                      <label for="amount" class="form-label">Amount to Pay</label>
                      <input
                        id="amount"
                        type="text"
                        class="form-control"
                        v-model="form.amount"
                      />
                      <div
                        class="text-danger font-medium text-xs mt-1"
                        v-if="errors.amount"
                      >
                        {{ errors.amount[0] }}
                      </div>
                    </div>
                  </div>

                  <div class="mt-3">
                    <button type="submit" class="btn btn-primary w-50 mt-3">
                      Submit
                    </button>
                    <loading v-if="loading == true"></loading>
                  </div>
                </form>
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
  name: "update-patient-deposit",
  data() {
    return {
      id: null,
      token: null,
      data: {},
      key: "",
      error: false,
      customers: [],
      patient: "",
      errors: {},
      form: {
        amount: "",

        key: "",
      },
      categories: ["Existing Customer", "New Customer"],
      active: 0,
      deposit: "",
      admission: "",
      total: 0,
      loading: false,
    };
  },
  computed: {
    computeTotal() {
      let total = 0;
      let amount = 0;
      let invoices = this.data.invoices;
      invoices.forEach((invoice) => {
        total += parseInt(invoice.amount) * parseInt(invoice.quantity);
      });
      if (this.data.deposit.amount > this.data.deposit.paid_amount) {
        amount = this.data.deposit.amount - this.data.deposit.paid_amount;
        this.form.expected_amount = amount;
      } else {
        this.form.expected_amount = 0;
      }
      this.total = total;
      return total;
    },
  },
  created() {
    this.login();
    this.getPatientInvoices();
    this.getCustomers();
    this.getPatient();
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
        this.form.key = this.$route.params.key;
      }
    },
    activate(index) {
      this.active = index;
    },
    getPatient() {
      axios
        .get("/api/v1/consultation/" + this.key, {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then((response) => (this.patient = response.data.patient))
        .catch((error) => {
          console.log(error);
          if (error.response.status == 401) {
            this.$router.push({
              name: "logout",
            });
          }
        });
    },
    getCustomers() {
      axios
        .get("/api/v1/customers/" + this.token, {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then((response) => (this.customers = response.data))
        .catch((error) => {
          console.log(error);
          if (error.response.status == 401) {
            this.$router.push({
              name: "logout",
            });
          }
        });
    },
    getPatientInvoices() {
      axios
        .get("/api/v1/patient-invoices/" + this.key, {
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

    updatePatientDeposit() {
      this.loading = true;

      this.form.key = this.$route.params.key;
      axios
        .patch("/api/update-patient-deposit/" + this.token, this.form)
        .then(() => {
          this.$router.push({
            name: "consultations",
          });
          Toast.fire({
            icon: "success",
            title: "Patient deposit successfully updated",
          });
        })
        .catch((error) => (this.errors = error.response.data.errors))

        .finally(() => {
          this.loading = false;
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
