<template>
  <div class="main">
    <!-- BEGIN: Mobile Menu -->
    <mobile-menu></mobile-menu>
    <!-- END: Mobile Menu -->
    <div class="flex">
      <!-- BEGIN: Side Menu -->
      <side-menu :page="'dashboard'"></side-menu>
      <!-- END: Side Menu -->
      <!-- BEGIN: Content -->
      <div class="content">
        <!-- BEGIN: Top Bar -->
        <top-bar title="Dashboard"></top-bar>
        <!-- END: Top Bar -->
        <div class="grid grid-cols-12 gap-6">
          <div class="col-span-12 xxl:col-span-9">
            <div class="grid grid-cols-12 gap-6">
              <!-- BEGIN: General Report -->
              <div class="col-span-12 mt-8">
                <div v-if="facility.status == false">
                  <div
                    class="alert alert-outline-danger alert-dismissible show flex items-center mb-2"
                    role="alert"
                  >
                    <i
                      data-feather="alert-octagon"
                      class="fa fa-exclamation-circle fa-2x mr-2"
                    ></i>
                    <strong class="mr-2"> Whoops! </strong> Update your account to
                    continue. To edit the Facility Signature,
                    <router-link :to="{ name: 'edit-signature' }">
                      click here
                    </router-link>
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
                <div
                  v-if="
                    user.role == 'Facility Manager' &&
                    facility.facility_type == 'Laboratory'
                  "
                >
                  <div v-if="medical_tests.length == 0">
                    <div
                      class="alert alert-outline-danger alert-dismissible show flex items-center mb-2"
                      role="alert"
                    >
                      <i
                        data-feather="alert-octagon"
                        class="fa fa-exclamation-circle fa-2x mr-2"
                      ></i>
                      <strong class="mr-2"> Whoops! </strong> Add Medical Diagnostic &amp;
                      Laboratory Tests. To add,
                      <router-link :to="{ name: 'laboratory-tests' }">
                        click here
                      </router-link>
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
                <div
                  v-if="
                    user.role == 'Facility Manager' &&
                    facility.facility_type == 'Hospital' &&
                    hospital.onsite_laboratory == true
                  "
                >
                  <div v-if="medical_tests.length == 0">
                    <div
                      class="alert alert-outline-danger alert-dismissible show flex items-center mb-2"
                      role="alert"
                    >
                      <i
                        data-feather="alert-octagon"
                        class="fa fa-exclamation-circle fa-2x mr-2"
                      ></i>
                      <strong class="mr-2"> Whoops! </strong> Add Medical Diagnostic &amp;
                      Laboratory Tests. To add,
                      <router-link :to="{ name: 'laboratory-tests' }">
                        click here
                      </router-link>
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
                <div v-if="facility.facility_type == 'Hospital'">
                  <div v-if="hospital.medical == false">
                    <div
                      class="alert alert-outline-danger alert-dismissible show flex items-center mb-2"
                      role="alert"
                    >
                      <i
                        data-feather="alert-octagon"
                        class="fa fa-exclamation-circle fa-2x mr-2"
                      ></i>
                      <strong class="mr-2"> Whoops! </strong> Update your hospital setting
                      to continue. To edit,
                      <router-link :to="{ name: 'edit-hospital-class' }">
                        click here
                      </router-link>
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

                <div v-if="user.role == 'Non Medical Staff' || user.role == 'Patient'">
                  <div
                    v-if="
                      biodata.gender == null &&
                      biodata.date_of_birth == null &&
                      biodata.marital_status == null &&
                      biodata.religion == null &&
                      biodata.address == null &&
                      biodata.city == null &&
                      biodata.state == null &&
                      biodata.postal_code == null &&
                      biodata.mobile_phone == null &&
                      biodata.profile_picture == null
                    "
                  >
                    <div
                      class="alert alert-outline-danger alert-dismissible show flex items-center mb-2"
                      role="alert"
                    >
                      <i
                        data-feather="alert-octagon"
                        class="fa fa-exclamation-circle fa-2x mr-2"
                      ></i>
                      <strong class="mr-2"> Whoops! </strong> Update your account to
                      continue. To edit,
                      <router-link :to="{ name: 'edit-profile' }">
                        click here
                      </router-link>
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
                <div class="intro-y flex items-center h-10">
                  <h2 class="text-lg font-medium truncate mr-5">General Report</h2>
                  <a
                    href=""
                    class="ml-auto flex items-center text-theme-1 dark:text-theme-10"
                  >
                    <i data-feather="refresh-ccw" class="w-4 h-4 mr-3"></i> Reload Data
                  </a>
                </div>
                <div
                  class="grid grid-cols-12 gap-6 mt-5"
                  v-if="facility.facility_type == 'Pharmaceutical Premises'"
                >
                  <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                    <div class="report-box zoom-in">
                      <div class="box p-5">
                        <div class="flex">
                          <i
                            class="report-box__icon text-theme-10 fa fa-shopping-basket fa-3x"
                          ></i>
                          <div class="ml-auto">
                            <div
                              class="report-box__indicator bg-theme-9 tooltip cursor-pointer"
                              title="33% Higher than last month"
                            >
                              33% <i data-feather="chevron-up" class="w-4 h-4 ml-0.5"></i>
                            </div>
                          </div>
                        </div>
                        <div class="text-2xl font-medium leading-8 mt-6">
                          &#8358;{{ (sumDrugs + sumItems) | numeral("0,0.00") }}
                        </div>
                        <div class="text-base text-gray-600 mt-1">
                          Drug Stocks: &#8358;{{ sumDrugs | numeral("0,0.00") }} <br />
                          Item Stock: &#8358;{{ sumItems | numeral("0,0.00") }}
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                    <div class="report-box zoom-in">
                      <div class="box p-5">
                        <div class="flex">
                          <i
                            class="report-box__icon text-theme-12 fa fa-shopping-bag fa-3x"
                          ></i>
                          <div class="ml-auto">
                            <div
                              class="report-box__indicator bg-theme-9 tooltip cursor-pointer"
                              title="12% Higher than last month"
                            >
                              12% <i data-feather="chevron-up" class="w-4 h-4 ml-0.5"></i>
                            </div>
                          </div>
                        </div>
                        <div class="text-2xl font-medium leading-8 mt-6">
                          &#8358;{{ sumMonthInflows | numeral("0,0.00") }}
                          <small style="font-size: 12px"
                            >for {{ month | moment("MMM, YYYY") }}</small
                          >
                        </div>
                        <div class="text-base text-gray-600 mt-1">
                          Drug Inflow: &#8358;{{ drug_inflows | numeral("0,0.00") }}
                          <br />
                          Item Inflow: &#8358;{{ item_inflows | numeral("0,0.00") }}
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                    <div class="report-box zoom-in">
                      <div class="box p-5">
                        <div class="flex">
                          <i
                            class="report-box__icon text-theme-11 fa fa-shopping-cart fa-3x"
                          ></i>

                          <div class="ml-auto">
                            <div
                              class="report-box__indicator bg-theme-6 tooltip cursor-pointer"
                              title="2% Lower than last month"
                            >
                              2%
                              <i data-feather="chevron-down" class="w-4 h-4 ml-0.5"></i>
                            </div>
                          </div>
                        </div>
                        <div class="text-2xl font-medium leading-8 mt-6">
                          &#8358;{{ sumProfit | numeral("0,0.00") }}
                          <small style="font-size: 12px"
                            >for {{ month | moment("MMM, YYYY") }}</small
                          >
                        </div>
                        <div class="text-base text-gray-600 mt-1">
                          Drug Profit: &#8358;{{ drug_profit | numeral("0,0.00") }} <br />
                          Item Profit: &#8358;{{ item_profit | numeral("0,0.00") }}
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                    <div class="report-box zoom-in">
                      <div class="box p-5">
                        <div class="flex">
                          <i
                            class="report-box__icon text-theme-9 fa fa-shopping-basket fa-3x"
                          ></i>
                          <div class="ml-auto">
                            <div
                              class="report-box__indicator bg-theme-9 tooltip cursor-pointer"
                              title="22% Higher than last month"
                            >
                              22% <i data-feather="chevron-up" class="w-4 h-4 ml-0.5"></i>
                            </div>
                          </div>
                        </div>
                        <div class="text-2xl font-medium leading-8 mt-6">
                          &#8358;{{ sumSales | numeral("0,0.00") }}
                          <small style="font-size: 12px"
                            >for {{ month | moment("MMM, YYYY") }}</small
                          >
                        </div>
                        <div class="text-base text-gray-600 mt-1">
                          Drug Sales: &#8358;{{ total_drugs | numeral("0,0.00") }} <br />
                          Item Sales: &#8358;{{ total_items | numeral("0,0.00") }}
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="grid grid-cols-12 gap-6 mt-5" v-else>
                  <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                    <div class="report-box zoom-in">
                      <div class="box p-5">
                        <div class="flex">
                          <i
                            data-feather="shopping-cart"
                            class="report-box__icon text-theme-10"
                          ></i>
                          <div class="ml-auto">
                            <div
                              class="report-box__indicator bg-theme-9 tooltip cursor-pointer"
                              title="33% Higher than last month"
                            >
                              33% <i data-feather="chevron-up" class="w-4 h-4 ml-0.5"></i>
                            </div>
                          </div>
                        </div>
                        <div class="text-3xl font-medium leading-8 mt-6">4.710</div>
                        <div class="text-base text-gray-600 mt-1">Item Sales</div>
                      </div>
                    </div>
                  </div>
                  <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                    <div class="report-box zoom-in">
                      <div class="box p-5">
                        <div class="flex">
                          <i
                            data-feather="credit-card"
                            class="report-box__icon text-theme-11"
                          ></i>
                          <div class="ml-auto">
                            <div
                              class="report-box__indicator bg-theme-6 tooltip cursor-pointer"
                              title="2% Lower than last month"
                            >
                              2%
                              <i data-feather="chevron-down" class="w-4 h-4 ml-0.5"></i>
                            </div>
                          </div>
                        </div>
                        <div class="text-3xl font-medium leading-8 mt-6">3.721</div>
                        <div class="text-base text-gray-600 mt-1">New Orders</div>
                      </div>
                    </div>
                  </div>
                  <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                    <div class="report-box zoom-in">
                      <div class="box p-5">
                        <div class="flex">
                          <i
                            data-feather="monitor"
                            class="report-box__icon text-theme-12"
                          ></i>
                          <div class="ml-auto">
                            <div
                              class="report-box__indicator bg-theme-9 tooltip cursor-pointer"
                              title="12% Higher than last month"
                            >
                              12% <i data-feather="chevron-up" class="w-4 h-4 ml-0.5"></i>
                            </div>
                          </div>
                        </div>
                        <div class="text-3xl font-medium leading-8 mt-6">2.149</div>
                        <div class="text-base text-gray-600 mt-1">Total Products</div>
                      </div>
                    </div>
                  </div>
                  <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                    <div class="report-box zoom-in">
                      <div class="box p-5">
                        <div class="flex">
                          <i
                            data-feather="user"
                            class="report-box__icon text-theme-9"
                          ></i>
                          <div class="ml-auto">
                            <div
                              class="report-box__indicator bg-theme-9 tooltip cursor-pointer"
                              title="22% Higher than last month"
                            >
                              22% <i data-feather="chevron-up" class="w-4 h-4 ml-0.5"></i>
                            </div>
                          </div>
                        </div>
                        <div class="text-3xl font-medium leading-8 mt-6">152.040</div>
                        <div class="text-base text-gray-600 mt-1">Unique Visitor</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- END: General Report -->
              <!-- Drug Inflows for the month -->
              <div class="col-span-12 mt-8 lg:col-span-6">
                <div class="intro-y block sm:flex items-center h-10">
                  <h2 class="text-lg font-medium truncate mr-5">
                    Drug Monthly Sales for {{ month | moment("YYYY") }}
                  </h2>
                </div>
                <div class="intro-y overflow-auto lg:overflow-visible mt-8 sm:mt-0">
                  <table class="table table-report sm:mt-2">
                    <thead>
                      <tr>
                        <th class="whitespace-nowrap">MONTHS</th>
                        <th class="whitespace-nowrap">PROFIT</th>
                        <th class="whitespace-nowrap">TOTAL</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr
                        class="intro-x"
                        v-for="sale in drug_monthly_sales"
                        :key="sale.months"
                      >
                        <td>
                          {{ getMonthName(sale.months) }}
                        </td>
                        <td>&#8358;{{ sale.profit | numeral("0,0.00") }}</td>
                        <td>&#8358;{{ sale.total | numeral("0,0.00") }}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- End Drug Inflows for the month -->
              <!-- Item Inflows for the month -->
              <div class="col-span-12 mt-8 lg:col-span-6">
                <div class="intro-y block sm:flex items-center h-10">
                  <h2 class="text-lg font-medium truncate mr-5">
                    Item Monthly Sales for {{ month | moment(" YYYY") }}
                  </h2>
                </div>
                <div class="intro-y overflow-auto lg:overflow-visible mt-8 sm:mt-0">
                  <table class="table table-report sm:mt-2">
                    <thead>
                      <tr>
                        <th class="whitespace-nowrap">MONTHS</th>
                        <th class="whitespace-nowrap">PROFIT</th>
                        <th class="whitespace-nowrap">TOTAL</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr
                        class="intro-x"
                        v-for="sale in item_monthly_sales"
                        :key="sale.months"
                      >
                        <td>
                          {{ getMonthName(sale.months) }}
                        </td>
                        <td>&#8358;{{ sale.profit | numeral("0,0.00") }}</td>
                        <td>&#8358;{{ sale.total | numeral("0,0.00") }}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- End Item Inflows for the month -->
              <!-- Drug Month Inflows -->
              <div class="col-span-12 mt-8 lg:col-span-6">
                <div class="intro-y block sm:flex items-center h-10">
                  <h2 class="text-lg font-medium truncate mr-5">
                    Drug Monthly Inflows for {{ month | moment(" YYYY") }}
                  </h2>
                </div>
                <div class="intro-y overflow-auto lg:overflow-visible mt-8 sm:mt-0">
                  <table class="table table-report sm:mt-2">
                    <thead>
                      <tr>
                        <th class="whitespace-nowrap">MONTHS</th>

                        <th class="whitespace-nowrap">TOTAL</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr
                        class="intro-x"
                        v-for="inflow in drug_monthly_inflows"
                        :key="inflow.months"
                      >
                        <td>
                          {{ getMonthName(inflow.months) }}
                        </td>

                        <td>&#8358;{{ inflow.total | numeral("0,0.00") }}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- End Drug Monthly Inflows -->
              <!-- Drug Month Inflows -->
              <div class="col-span-12 mt-8 lg:col-span-6">
                <div class="intro-y block sm:flex items-center h-10">
                  <h2 class="text-lg font-medium truncate mr-5">
                    Item Monthly Inflows for {{ month | moment(" YYYY") }}
                  </h2>
                </div>
                <div class="intro-y overflow-auto lg:overflow-visible mt-8 sm:mt-0">
                  <table class="table table-report sm:mt-2">
                    <thead>
                      <tr>
                        <th class="whitespace-nowrap">MONTHS</th>

                        <th class="whitespace-nowrap">TOTAL</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr
                        class="intro-x"
                        v-for="inflow in item_monthly_inflows"
                        :key="inflow.months"
                      >
                        <td>
                          {{ getMonthName(inflow.months) }}
                        </td>

                        <td>&#8358;{{ inflow.total | numeral("0,0.00") }}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- End Drug Monthly Inflows -->
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
  name: "home",
  data() {
    return {
      id: null,
      token: null,
      user: "",
      facility: "",
      staff_facility: "",
      medical_tests: [],
      biodata: "",
      hospital: "",
      drugs: "",
      items: "",
      drug_stocks: "",
      item_stocks: "",
      drug_inflows: 0,
      item_inflows: 0,
      drug_profit: 0,
      item_profit: 0,
      month: "",
      item_outflows: "",
      drug_outflows: "",
      total_items: 0,
      total_drugs: 0,
      drug_monthly_sales: "",
      item_monthly_sales: "",
      drug_monthly_inflows: "",
      item_monthly_inflows: "",
    };
  },
  computed: {
    sumDrugs() {
      let stocks = this.drugs;
      let total = 0;
      for (let index = 0; index < stocks.length; index++) {
        if (stocks[index].counting) {
          total +=
            stocks[index].total_quantity * stocks[index].price - stocks[index].price;
        } else {
          total += stocks[index].total_quantity * stocks[index].price;
        }
      }

      return total;
    },
    sumItems() {
      let stocks = this.items;
      let total = 0;
      for (let index = 0; index < stocks.length; index++) {
        total += stocks[index].total_quantity * stocks[index].price;
      }

      return total;
    },
    sumMonthInflows() {
      let drugs = this.drug_stocks;
      let items = this.item_stocks;
      let total_drugs = 0;
      let total_items = 0;
      for (let index = 0; index < drugs.length; index++) {
        if (drugs[index].counting) {
          total_drugs +=
            drugs[index].total_quantity * drugs[index].price - drugs[index].price;
        } else {
          total_drugs += drugs[index].total_quantity * drugs[index].price;
        }
      }
      for (let index = 0; index < items.length; index++) {
        total_items += items[index].total_quantity * items[index].price;
      }
      this.drug_inflows = total_drugs;
      this.item_inflows = total_items;
      return total_drugs + total_items;
    },
    sumSales() {
      let items = this.item_outflows;
      let drugs = this.drug_outflows;
      let total_items = 0;
      let total_drugs = 0;
      for (let index = 0; index < items.length; index++) {
        total_items += items[index].qty * items[index].price;
      }
      for (let index = 0; index < drugs.length; index++) {
        total_drugs += drugs[index].qty * drugs[index].price;
      }
      this.total_items = total_items;
      this.total_drugs = total_drugs;
      return total_items + total_drugs;
    },
    sumProfit() {
      let items = this.item_outflows;
      let drugs = this.drug_outflows;
      let total_items = 0;
      let total_drugs = 0;
      for (let index = 0; index < items.length; index++) {
        total_items +=
          items[index].qty * (items[index].price - items[index].purchase_price);
      }
      for (let index = 0; index < drugs.length; index++) {
        total_drugs +=
          drugs[index].qty * (drugs[index].price - drugs[index].purchase_price);
      }
      this.item_profit = total_items;
      this.drug_profit = total_drugs;
      return total_items + total_drugs;
    },
  },
  created() {
    this.login();
    this.getUser();
    this.getStaff();
    this.getFacilitySignature();
    this.getLaboratoryTests();
    this.getHospitalClass();
    this.getMedicalStaffFacility();
    this.getDrugs();
    this.getItems();
    this.getMonthDrugStock();
    this.getMonthItemStock();
    this.getMonthItemOutflow();
    this.getMonthDrugOutflow();
    this.getDrugMonthlySales();
    this.getItemMonthlySales();
    this.getDrugMonthlyInflows();
    this.getItemMonthlyInflows();
  },
  methods: {
    login() {
      if (!User.loggedIn()) {
        this.$router.push({
          name: "logout",
        });
      } else {
        this.id = User.id();
        this.token = User.token();
      }
    },
    getItems() {
      axios
        .get("/api/v1/item-stocks/" + this.id, {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then((response) => (this.items = response.data))
        .catch((error) => {
          console.log(error);
          if (error.response.status == 401) {
            this.$router.push({
              name: "logout",
            });
          }
        });
    },
    getDrugs() {
      axios
        .get("/api/v1/drug-stocks/" + this.id, {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then((response) => (this.drugs = response.data))
        .catch((error) => {
          console.log(error);
          if (error.response.status == 401) {
            this.$router.push({
              name: "logout",
            });
          }
        });
    },
    getMonthName(monthNumber) {
      const date = new Date();
      date.setMonth(monthNumber - 1);

      return date.toLocaleString("en-US", { month: "long" });
    },
    getDrugMonthlySales() {
      axios
        .get("/api/v1/monthly-drug-sales/" + this.id, {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then((response) => (this.drug_monthly_sales = response.data))
        .catch((error) => {
          console.log(error);
          if (error.response.status == 401) {
            this.$router.push({
              name: "logout",
            });
          }
        });
    },
    getItemMonthlySales() {
      axios
        .get("/api/v1/monthly-item-sales/" + this.id, {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then((response) => (this.item_monthly_sales = response.data))
        .catch((error) => {
          console.log(error);
          if (error.response.status == 401) {
            this.$router.push({
              name: "logout",
            });
          }
        });
    },
    getDrugMonthlyInflows() {
      axios
        .get("/api/v1/monthly-inflows/" + this.id + "/" + "Drug", {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then((response) => (this.drug_monthly_inflows = response.data))
        .catch((error) => {
          console.log(error);
          if (error.response.status == 401) {
            this.$router.push({
              name: "logout",
            });
          }
        });
    },
    getItemMonthlyInflows() {
      axios
        .get("/api/v1/monthly-inflows/" + this.id + "/" + "Item", {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then((response) => (this.item_monthly_inflows = response.data))
        .catch((error) => {
          console.log(error);
          if (error.response.status == 401) {
            this.$router.push({
              name: "logout",
            });
          }
        });
    },
    getMonthDrugStock() {
      let today = new Date();
      let month = today.getMonth() + 1;
      if (month < 10) {
        month = "0" + month;
      }
      this.month = today.getFullYear() + "-" + month;
      axios
        .get("/api/v1/drug-inflows/" + this.id + "/" + this.month, {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then((response) => (this.drug_stocks = response.data))
        .catch((error) => {
          console.log(error);
          if (error.response.status == 401) {
            this.$router.push({
              name: "logout",
            });
          }
        });
    },
    getMonthItemStock() {
      let today = new Date();
      let month = today.getMonth() + 1;
      if (month < 10) {
        month = "0" + month;
      }
      this.month = today.getFullYear() + "-" + month;
      axios
        .get("/api/v1/item-inflows/" + this.id + "/" + this.month, {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then((response) => (this.item_stocks = response.data))
        .catch((error) => {
          console.log(error);
          if (error.response.status == 401) {
            this.$router.push({
              name: "logout",
            });
          }
        });
    },
    getMonthItemOutflow() {
      axios
        .get("/api/v1/item-outflows/" + this.id + "/" + this.month, {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then((response) => (this.item_outflows = response.data))
        .catch((error) => {
          console.log(error);
          if (error.response.status == 401) {
            this.$router.push({
              name: "logout",
            });
          }
        });
    },
    getMonthDrugOutflow() {
      axios
        .get("/api/v1/drug-outflows/" + this.id + "/" + this.month, {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then((response) => (this.drug_outflows = response.data))
        .catch((error) => {
          console.log(error);
          if (error.response.status == 401) {
            this.$router.push({
              name: "logout",
            });
          }
        });
    },
    getMedicalStaffFacility() {
      axios
        .get("/api/v1/medical-staff-facility/" + this.id, {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then((response) => (this.staff_facility = response.data))
        .catch((error) => {
          console.log(error);
          if (error.response.status == 401) {
            this.$router.push({
              name: "logout",
            });
          }
        });
    },
    getStaff() {
      axios
        .get("/api/v1/staff/" + this.id, {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then((response) => (this.biodata = response.data.biodata))
        .catch((error) => {
          console.log(error);
          if (error.response.status == 401) {
            this.$router.push({
              name: "logout",
            });
          }
        });
    },
    getUser() {
      axios
        .get("/api/v1/user/" + this.id, {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then((response) => (this.user = response.data))
        .catch((error) => {
          console.log(error);
          if (error.response.status == 401) {
            this.$router.push({
              name: "logout",
            });
          }
        });
    },
    getFacilitySignature() {
      axios
        .get("/api/v1/facility-details/" + this.id, {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then((response) => (this.facility = response.data))
        .catch((error) => {
          console.log(error);
          if (error.response.status == 401) {
            this.$router.push({
              name: "logout",
            });
          }
        });
    },
    getLaboratoryTests() {
      axios
        .get("/api/v1/laboratory-medical-tests/" + this.id, {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then((response) => (this.medical_tests = response.data))
        .catch((error) => {
          console.log(error);
          if (error.response.status == 401) {
            this.$router.push({
              name: "logout",
            });
          }
        });
    },
    getHospitalClass() {
      axios
        .get("/api/v1/hospital-class/" + this.id, {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then((response) => (this.hospital = response.data))
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
