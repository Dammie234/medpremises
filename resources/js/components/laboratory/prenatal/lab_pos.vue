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
        <top-bar title="Medical Diagnostic &amp; Laboratory Test POS"></top-bar>
        <!-- END: Top Bar -->

        <div class="grid grid-cols-12 gap-6 mt-3" v-if="carts.length != 0">
          <div class="intro-y col-span-12 xxl:col-span-9 xl:col-span-9">
            <div class="intro-y box">
              <div
                class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5"
              >
                <h2 class="font-medium text-base mr-auto">Cart</h2>
              </div>
              <div class="p-5">
                <div class="overflow-x-auto">
                  <table class="table table-sm table-bordered mt-3">
                    <thead>
                      <tr>
                        <th>Name</th>

                        <th>Qty</th>
                        <th>Unit</th>
                        <th>Total</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="cart in carts" :key="cart.id">
                        <td>{{ cart.product_name }}</td>
                        <td>
                          <input
                            type="text"
                            :value="cart.product_qty"
                            readonly
                            style="width: 40px"
                          />
                        </td>
                        <td>&#8358;{{ cart.product_price | numeral("0,0.00") }}</td>
                        <td>
                          &#8358;{{
                            (cart.product_price * cart.product_qty) | numeral("0,0.00")
                          }}
                        </td>

                        <td>
                          <a
                            @click.prevent="removeCart(cart.id)"
                            class="btn btn-danger btn-sm"
                            ><font color="#fff">x</font></a
                          >
                        </td>
                      </tr>
                    </tbody>
                    <tfoot>
                      <tr>
                        <td colspan="3" class="text-right">
                          <strong>Total Quantity:</strong>
                        </td>
                        <td>{{ sumQty }}</td>
                        <td></td>
                      </tr>
                      <tr>
                        <td colspan="3" class="text-right">
                          <strong>Total Cost:</strong>
                        </td>
                        <td>&#8358;{{ sumTotal | numeral("0,0.00") }}</td>
                        <td></td>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="intro-y col-span-12 xxl:col-span-3 xl:col-span-3">
            <div class="intro-y box">
              <div
                class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5"
              >
                <h2 class="font-medium text-base mr-auto">Customer</h2>
              </div>
              <div class="p-3">
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
                          <label for="amount" class="form-label">Amount</label>
                          <input
                            id="amount"
                            type="text"
                            class="form-control"
                            v-model="form.amount"
                            disabled
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

                      <button type="submit" class="btn btn-primary w-50 mt-3">
                        Process Cart
                      </button>
                      <loading v-if="loading == true"></loading>
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
                          <label for="amount" class="form-label">Amount</label>
                          <input
                            id="amount"
                            type="text"
                            class="form-control"
                            v-model="form.amount"
                            disabled
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

                      <button type="submit" class="btn btn-primary w-50 mt-3">
                        Process Cart
                      </button>
                      <loading v-if="loading == true"></loading>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="grid grid-cols-12 gap-6 mt-4">
          <div class="intro-y col-span-12 xxl:col-span-12">
            <div class="intro-y box">
              <div
                class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60"
              >
                <h2 class="font-medium text-base mr-auto">
                  Medical Diagnostic &amp; Laboratory Test POS
                </h2>
              </div>
              <div class="p-5">
                <div class="grid grid-cols-12 gap-x-5">
                  <div class="col-span-12 lg:col-span-12"></div>

                  <div class="col-span-12 xl:col-span-8">
                    <h4 class="text-lg font-medium">
                      Prenatal Medical Laboratory Test for {{ prenatal.patient.name }} for
                      the gestational age of {{ prenatal.prenatal.gestational_period }}
                    </h4>
                    <div class="overflow-x-auto">
                      <table class="table table-sm table-bordered mb-3">
                        <thead>
                          <tr>
                            <th class="whitespace-nowrap">Medical Laboratory Tests</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="(test, index) in prenatal.tests" :key="index">
                            <td>{{ test.test_name }}</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <input
                      class="form-control mr-0"
                      type="text"
                      v-model="search"
                      placeholder="Seach Medical Diagnostic &amp; Laboratory Tests"
                    />
                    <div class="overflow-x-auto">
                      <table class="table table-sm table-bordered mt-3">
                        <thead>
                          <tr>
                            <th class="whitespace-nowrap">Name</th>
                            <th class="whitespace-nowrap">Price</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="test in filterSearch" :key="test.id">
                            <td>{{ test.test_name }}</td>
                            <td>&#8358;{{ test.price }}</td>
                            <td>
                              <button
                                class="btn btn-primary btn-sm"
                                @click.prevent="addToCart(test.id, 'Laboratory-Test')"
                              >
                                <i class="fas fa-cart-plus"></i>
                              </button>
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
        </div>
      </div>
      <!-- END: Content -->
    </div>
  </div>
</template>

<script>
export default {
  name: "laboratory-medical-tests",
  data() {
    return {
      id: null,
      key: "",
      token: "",
      search: "",
      email: "",
      tests: [],

      carts: [],
      prenatal: {},
      customers: [],
      form: {
        name: "",
        amount: "",
        email: "",
        key: "",
        pay_by: "",
        phone: "",
        customer: "",
        prenatal: "Yes",
      },

      loading: false,
      errors: {},
      active: 0,
      categories: ["Existing Customer", "New Customer"],
    };
  },
  computed: {
    filterSearch() {
      let str = this.search;
      let string = str.charAt(0).toUpperCase() + str.slice(1);
      return this.tests.filter((test) => {
        return test.test_name.match(string);
      });
    },
    filterSearchInvestigation() {
      let str = this.email;
      let string = str.charAt(0).toLowerCase() + str.slice(1);
      return this.investigations.filter((investigation) => {
        return investigation.email.match(string);
      });
    },
    sumQty() {
      let total = 0;
      for (let i = 0; i < this.carts.length; i++) {
        total += parseFloat(this.carts[i].product_qty);
      }
      return total;
    },
    sumTotal() {
      let total = 0;
      for (let i = 0; i < this.carts.length; i++) {
        total +=
          parseFloat(this.carts[i].product_qty) * parseFloat(this.carts[i].product_price);
      }
      this.form.amount = total;
      return total;
    },
  },
  created() {
    this.login();

    this.getMedicalLaboratoryTests();

    this.getPrenatalLaboratoryTests();

    this.getCarts();
    Reload.$on("AfterAdd", () => {
      this.getCarts();
    });
    this.getCustomers();
  },
  methods: {
    activate(index) {
      this.active = index;
    },
    login() {
      if (!User.loggedIn()) {
        this.$router.push({
          name: "logout",
        });
      } else {
        this.id = User.id();
        this.key = this.$route.params.key;
        this.token = User.token();
      }
    },

    getPrenatalLaboratoryTests() {
      axios
        .get("/api/v1/fetch-tests/" + this.key, {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then((response) => (this.prenatal = response.data))
        .catch((error) => {
          console.log(error);
          if (error.response.status == 401) {
            this.$router.push({
              name: "logout",
            });
          }
        });
    },
    getMedicalLaboratoryTests() {
      axios
        .get("/api/v1/laboratory-medical-tests/" + this.id, {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then((response) => (this.tests = response.data))
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
    addToCart(id, type) {
      axios
        .get("/api/v1/add-to-cart/" + id + "/" + type + "/" + this.token, {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then(() => {
          Reload.$emit("AfterAdd");
          Toast.fire({
            icon: "success",
            title: "Cart successfully updated",
          });
        })
        .catch();
    },
    removeCart(id) {
      axios
        .get("/api/v1/remove-cart/" + id + "/" + this.token, {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then(() => {
          Reload.$emit("AfterAdd");
          Toast.fire({
            icon: "success",
            title: "Cart successfully deleted",
          });
        })
        .catch();
    },
    getCarts() {
      axios
        .get("/api/v1/carts/" + this.token, {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then((response) => (this.carts = response.data))
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
      this.form.key = this.$route.params.key;
      axios
        .patch("/api/process-lab-order/" + this.token, this.form)
        .then(() => {
          this.$router.push({
            name: "lab-invoice",
          });
          Toast.fire({
            icon: "success",
            title: "Order processed successfully",
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
