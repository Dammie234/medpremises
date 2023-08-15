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
                    <i
                      data-feather="alert-octagon"
                      class="fa fa-exclamation-circle fa-2x mr-2"
                    ></i>
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
                <div class="tabs" id="tabs">
                  <div class="tabs-triggers">
                    <div
                      class="tabs-trigger"
                      v-for="(item, index) in categories"
                      :key="index"
                      :class="[index === active ? 'tabs-trigger--active' : '']"
                      @click="activate(index)"
                    >
                      {{ categories[index] }}
                    </div>
                  </div>
                  <div class="tabs-content" v-if="active === 0">
                    <form class="input" @submit.prevent="processOrder">
                      <div class="p-5" :disabled="loading">
                        <vue-single-select
                          name="maybe"
                          placeholder="pick a customer"
                          you-want-to-select-a-post="ok"
                          v-model="form.customer"
                          out-of-all-these-posts="makes sense"
                          :options="customers"
                          :required="true"
                          a-post-has-an-id="good for search and display"
                          the-post-has-a-title="make sure to show these"
                          option-label="name"
                        ></vue-single-select>
                        <small
                          class="text-danger font-medium text-xs mt-1"
                          v-if="errors.customer"
                        >
                          {{ errors.customer[0] }}
                        </small>
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
                        <div class="mt-3">
                          <label for="pay_by" class="form-label">Pay By</label>
                          <select id="pay_by" class="form-select" v-model="form.pay_by">
                            <option value="Hand Cash">Hand Cash</option>
                            <option value="Cheque">Cheque</option>
                            <option value="POS">POS</option>
                          </select>
                          <div
                            class="text-danger font-medium text-xs mt-1"
                            v-if="errors.pay_by"
                          >
                            {{ errors.pay_by[0] }}
                          </div>
                        </div>
                      </div>

                      <div class="mt-3">
                        <button type="submit" class="btn btn-primary w-50 mt-3">
                          Make Payment
                        </button>
                        <loading v-if="loading == true"></loading>
                      </div>
                    </form>
                  </div>
                  <div class="tabs-content" v-if="active === 1">
                    <form class="input" @submit.prevent="processOrder">
                      <div class="p-5" :disabled="loading">
                        <div>
                          <label for="name" class="form-label">Customer</label>
                          <input
                            id="name"
                            type="text"
                            class="form-control"
                            placeholder="Enter the Customer Name"
                            v-model="form.name"
                          />
                          <div
                            class="text-danger font-medium text-xs mt-1"
                            v-if="errors.name"
                          >
                            {{ errors.name[0] }}
                          </div>
                        </div>
                        <div class="mt-3">
                          <label for="email" class="form-label">Email Address</label>
                          <input
                            id="email"
                            type="text"
                            class="form-control"
                            placeholder="Enter the Customer Email"
                            v-model="form.email"
                          />
                          <div
                            class="text-danger font-medium text-xs mt-1"
                            v-if="errors.email"
                          >
                            {{ errors.email[0] }}
                          </div>
                        </div>
                        <div class="mt-3">
                          <label for="phone" class="form-label">Phone Number</label>
                          <input
                            id="phone"
                            type="text"
                            class="form-control"
                            placeholder="Enter the Customer Phone Number"
                            v-model="form.phone"
                          />
                          <div
                            class="text-danger font-medium text-xs mt-1"
                            v-if="errors.phone"
                          >
                            {{ errors.phone[0] }}
                          </div>
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
                        <div class="mt-3">
                          <label for="pay_y" class="form-label">Pay By</label>
                          <select id="pay_by" class="form-select" v-model="form.pay_by">
                            <option value="Hand Cash">Hand Cash</option>
                            <option value="Cheque">Cheque</option>
                            <option value="POS">POS</option>
                          </select>
                          <div
                            class="text-danger font-medium text-xs mt-1"
                            v-if="errors.pay_by"
                          >
                            {{ errors.pay_by[0] }}
                          </div>
                        </div>
                      </div>

                      <div class="mt-3">
                        <button type="submit" class="btn btn-primary w-50">
                          Make Payment
                        </button>
                        <loading v-if="loading == true"></loading>
                      </div>
                    </form>
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
  name: "patient-invoices",
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
        name: "",
        expected_amount: "",
        amount: "",
        email: "",
        pay_by: "",
        phone: "",
        customer: "",
        payment_type: "",
        token: "",
        deposit: true,
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
        this.form.amount = amount;
      } else {
        this.form.amount = 0;
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
        this.id = User.id();
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
        .get("/api/v1/customers/" + this.id, {
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

    processOrder() {
      this.loading = true;
      this.form.token = User.token();
      this.form.key = this.$route.params.key;
      axios
        .patch("/api/process-hospital-order/" + this.id, this.form)
        .then(() => {
          this.$router.push({
            path: `/patient/invoice/${this.key}`,
          });
          Toast.fire({
            icon: "success",
            title: "Order processed successfully",
          });
        })
        .catch((error) => (this.errors = error.response.data.errors))
        .catch((error) => {
          this.error = true;
          console.log(error);
          if (error.response.status == 401) {
            Toast.fire({
              icon: "warning",
              title: "Stock before processing",
            });
          }
        })
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
