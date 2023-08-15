<template>
  <div class="main">
    <!-- BEGIN: Mobile Menu -->
    <mobile-menu></mobile-menu>
    <!-- END: Mobile Menu -->
    <div class="flex">
      <!-- BEGIN: Side Menu -->
      <side-menu
        page="pharmacy"
       
      ></side-menu>
      <!-- END: Side Menu -->
      <!-- BEGIN: Content -->
      <div class="content">
        <!-- BEGIN: Top Bar -->
        <top-bar
          :title="'Edit Drug'"
          
        ></top-bar>
        <!-- END: Top Bar -->

        <div class="grid grid-cols-12 gap-6">
          <div class="intro-y col-span-12 xxl:col-span-6 xl:col-span-6">
            <div class="intro-y box">
              <div
                class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5"
              >
                <h2 class="font-medium text-base mr-auto">Edit Drug</h2>
                <div class="w-full sm:w-auto sm:ml-auto mt-3 sm:mt-0">
                  <router-link :to="{ name: 'drug' }" class="btn btn-primary mr-0 ml-3">
                    Go Back
                  </router-link>
                </div>
              </div>
              <form class="input p-5" @submit.prevent="update">
                <div class="grid grid-cols-12 gap-x-5" :disabled="loading">
                  <div class="col-span-12 xl:col-span-12 mt-3">
                    <label for="category" class="form-label">Category</label>
                    <select id="category" class="form-select" v-model="form.category">
                      <option
                        v-for="(category, index) in categories"
                        :key="index"
                        :value="category"
                      >
                        {{ category }}
                      </option>
                    </select>
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.category"
                    >
                      {{ errors.category[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-12 mt-3">
                    <label for="name" class="form-label">Name</label>
                    <input
                      id="name"
                      type="text"
                      class="form-control"
                      placeholder="Input drug name"
                      v-model="form.name"
                    />
                    <div class="text-danger font-medium text-xs mt-1" v-if="errors.name">
                      {{ errors.name[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-6 mt-3">
                    <label for="prescription_slip" class="form-label"
                      >Does Drug Require Prescription Slip</label
                    >
                    <select
                      id="hours_of_operation"
                      class="form-select"
                      v-model="form.prescription_slip"
                    >
                      <option value=""></option>
                      <option value="1">Yes</option>
                      <option value="0">No</option>
                    </select>
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.prescription_slip"
                    >
                      {{ errors.prescription_slip[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-6 mt-3">
                    <label for="nafdac_number" class="form-label">NAFDAC Number</label>
                    <input
                      id="nafdac_number"
                      type="text"
                      class="form-control"
                      placeholder="Input drug NAFDAC number"
                      v-model="form.nafdac_number"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.nafdac_number"
                    >
                      {{ errors.nafdac_number[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-12 mt-3">
                    <label for="manufacturer" class="form-label">Manufacturer</label>
                    <input
                      id="manufacturer"
                      type="text"
                      class="form-control"
                      placeholder="Input drug manufacturer"
                      v-model="form.manufacturer"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.manufacturer"
                    >
                      {{ errors.manufacturer[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-12 mt-3">
                    <label for="shelf_name" class="form-label"
                      >Shelf Name (Location on Shelf)</label
                    >
                    <input
                      id="manufacturer"
                      type="text"
                      class="form-control"
                      placeholder="Input Shelf Name (Location on Shelf)"
                      v-model="form.shelf_name"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.shelf_name"
                    >
                      {{ errors.shelf_name[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-12 mt-3">
                    <label for="delivery" class="form-label">Drug Delivery</label>
                    <v-select
                      :options="deliveries"
                      label="delivery_name"
                      @input="(delivery) => updateDelivery(form, delivery)"
                    ></v-select>
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.delivery"
                    >
                      {{ errors.delivery[0] }}
                    </div>
                  </div>
                </div>
                <div class="mt-3">
                  <button type="submit" class="btn btn-primary w-20">Save</button>
                  <loading v-if="loading == true"></loading>
                </div>
              </form>
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
  name: "delivery",
  data() {
    return {
      id: null,
      token: null,
      categories: [
        "Pills/Tablets",
        "Creams/Ointments",
        "Lozenges",
        "Capsules",
        "Liquids/Syrubs",
        "Injections",
        "Inhalants",
      ],
      form: {
        category: "",
        delivery: "",
        nafdac_number: "",
        name: "",
        manufacturer: "",
        shelf_name: "",
        prescription_slip: "",
        token: "",
      },
      errors: {},
      loading: false,
      deliveries: [],
      
    };
  },

  created() {
    this.login();
    this.getDeliveries();
    this.getDrug();
    this.getUser();
    this.getFacilitySignature();
    this.getMedicalStaffFacility();
    this.getHospitalClass();
    this.getStaff();
  },
  methods: {
    login() {
      if (!User.loggedIn()) {
        this.$router.push({
          name: "logout",
        });
      } else {
        this.token = User.token();
        this.form.token = User.token();
        this.id = User.id();
      }
    },
    
    updateDelivery(form, delivery) {
      form.delivery = delivery.id;
      form.token = this.token;
    },
    getDrug() {
      let id = this.$route.params.id;
      axios
        .get("/api/v1/drug/" + id, {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then((response) => (this.form = response.data))
        .catch((error) => {
          console.log(error);
          if (error.response.status == 401) {
            this.$router.push({
              name: "logout",
            });
          }
        });
    },
    update() {
      let id = this.$route.params.id;
      this.loading = true;
      axios
        .patch("/api/drug/" + id, this.form)
        .then(() => {
          this.$router.push({
            name: "drug",
          });
          Toast.fire({
            icon: "success",
            title: "Drug successfully updated",
          });
        })
        .catch((error) => (this.errors = error.response.data.errors))
        .finally(() => {
          this.loading = false;
        });
    },
    getDeliveries() {
      axios
        .get("/api/v1/deliveries/" + this.token, {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then((response) => (this.deliveries = response.data))
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
