<template>
  <div class="main">
    <!-- BEGIN: Mobile Menu -->
    <mobile-menu></mobile-menu>
    <!-- END: Mobile Menu -->
    <div class="flex">
      <!-- BEGIN: Side Menu -->
      <side-menu
        :page="'pharmacy'"
        
      ></side-menu>
      <!-- END: Side Menu -->
      <!-- BEGIN: Content -->
      <div class="content">
        <!-- BEGIN: Top Bar -->
        <top-bar
          :title="'Delivery'"
         
        ></top-bar>
        <!-- END: Top Bar -->

        <div class="grid grid-cols-12 gap-6" v-if="add_delivery == true">
          <div class="intro-y col-span-12 xxl:col-span-12">
            <div class="intro-y box">
              <div
                class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5"
              >
                <h2 class="font-medium text-base mr-auto">Add Delivery</h2>
              </div>
              <form class="input p-5" @submit.prevent="store">
                <div class="grid grid-cols-12 gap-x-5" :disabled="loading">
                  <div class="col-span-12 xl:col-span-4 mt-3">
                    <label for="delivery_name" class="form-label">Delivery Name</label>
                    <input
                      id="delivery_name"
                      type="text"
                      class="form-control"
                      placeholder="Input delivery full name"
                      v-model="form.delivery_name"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.delivery_name"
                    >
                      {{ errors.delivery_name[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-4 mt-3">
                    <label for="company_name" class="form-label">Company Name</label>
                    <input
                      id="company_name"
                      type="text"
                      class="form-control"
                      placeholder="Input company name"
                      v-model="form.company_name"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.company_name"
                    >
                      {{ errors.company_name[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-4 mt-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input
                      id="email"
                      type="email"
                      class="form-control"
                      placeholder="Input delivery email"
                      v-model="form.email"
                    />
                    <div class="text-danger font-medium text-xs mt-1" v-if="errors.email">
                      {{ errors.email[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-3 mt-3">
                    <label for="phone_number" class="form-label">Phone Number</label>
                    <input
                      id="phone_number"
                      type="text"
                      class="form-control"
                      placeholder="Input delivery phone number"
                      v-model="form.phone_number"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.phone_number"
                    >
                      {{ errors.phone_number[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-6 mt-3">
                    <label for="address" class="form-label">Address</label>
                    <vue-google-autocomplete
                      ref="address"
                      id="map"
                      required
                      classname="form-control"
                      placeholder="Search Address, mouse down and press enter once found"
                      v-on:placechanged="getAddress"
                      v-on:error="handleError"
                      types=""
                      country="ng"
                    >
                    </vue-google-autocomplete>
                    <div class="text-success font-medium text-xs" v-if="form.address">
                      Address Selected
                    </div>
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.address"
                    >
                      {{ errors.address[0] }}
                    </div>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary w-20 mt-3">Save</button>
                <loading v-if="loading == true"></loading>
                <button class="btn btn-secondary" @click="addDelivery">Close</button>
              </form>
            </div>
          </div>
        </div>
        <div class="grid grid-cols-12 gap-6 mt-4">
          <div class="intro-y col-span-12 xxl:col-span-12">
            <div class="intro-y box">
              <div
                class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60"
              >
                <h2 class="font-medium text-base mr-auto">Deliveries</h2>
                <div class="w-full sm:w-auto sm:ml-auto mt-3 sm:mt-0">
                  <input
                    class="form-control mr-3 pr-3"
                    type="text"
                    v-model="search"
                    placeholder="Seach Delivery Name"
                  />
                </div>
                <button
                  class="btn btn-primary"
                  @click="addDelivery"
                  style="margin-left: 15px"
                >
                  Add Delivery
                </button>
              </div>
              <div class="p-5">
                <div class="grid grid-cols-12 gap-x-5">
                  <div class="col-span-12 xl:col-span-12 mt-3">
                    <div v-if="deliveries.length != 0">
                      <div class="overflow-x-auto">
                        <table class="table table-sm table-auto table-bordered">
                          <thead>
                            <tr>
                              <th></th>
                              <th class="text-xs uppercase">Delivery Name</th>
                              <th class="text-xs uppercase">Company Name</th>
                              <th class="text-xs uppercase">Email Address</th>
                              <th class="text-xs uppercase">Phone Number</th>
                              <th class="text-xs uppercase">Address</th>
                              <th class="text-xs uppercase">Modified By</th>
                              <th class="text-xs uppercase">Modified</th>
                              <th class="text-xs uppercase">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr
                              class="text-xs"
                              v-for="(delivery, index) in filterSearch"
                              :key="index"
                            >
                              <td>{{ index + 1 }}</td>
                              <td>{{ delivery.delivery_name }}</td>
                              <td>{{ delivery.company_name }}</td>
                              <td>{{ delivery.email }}</td>
                              <td>{{ delivery.phone_number }}</td>
                              <td>{{ delivery.address }}</td>
                              <td>{{ delivery.added_by }}</td>
                              <td>{{ delivery.updated_at | moment("from", "now") }}</td>
                              <td class="whitespace-nowrap">
                                <router-link
                                  :to="{
                                    name: 'edit-delivery',
                                    params: { id: delivery.uniqueId },
                                  }"
                                  class="btn btn-primary mr-2"
                                >
                                  <i class="fa fa-edit"></i>
                                </router-link>
                                <button
                                  @click="deleteDelivery(delivery.uniqueId)"
                                  class="btn btn-danger"
                                >
                                  <i class="fa fa-trash"></i>
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
                        <i
                          data-feather="alert-octagon"
                          class="fa fa-exclamation-circle fa-2x mr-2"
                        ></i>
                        <strong class="mr-2"> Whoops! </strong> There are no deliveries
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
import VueGoogleAutocomplete from "vue-google-autocomplete";
export default {
  name: "delivery",
  components: { VueGoogleAutocomplete },
  data() {
    return {
      id: null,
      token: null,
      address: {},

      form: {
        delivery_name: "",
        company_name: "",
        email: "",
        phone_number: "",
        address: "",
        city: "",
        state: "",
        postal_code: "",
        url: "",
        country: "",
        local_government_area: "",
        gps_coordinate_longtitude: "",
        gps_coordinate_latitude: "",
        id: "",
      },
      errors: {},
      deliveries: [],
      search: "",
      
      loading: false,
      add_delivery: false,
    };
  },
  computed: {
    filterSearch() {
      let str = this.search;
      let string = str.charAt(0).toUpperCase() + str.slice(1);
      return this.deliveries.filter((delivery) => {
        return delivery.delivery_name.match(string);
      });
    },
  },
  created() {
    this.login();
    
    this.getDeliveries();
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
        this.form.id = User.id();
      }
    },
    
    getAddress(address, placeResultData, id) {
      this.address = address;
      this.form.address = placeResultData.formatted_address;
      this.form.city = placeResultData.address_components[3].long_name;
      this.form.state = placeResultData.address_components[5].long_name;
      this.form.local_government_area = placeResultData.address_components[4].long_name;
      this.form.country = address.country;
      this.form.postal_code = address.postal_code;
      this.form.gps_coordinate_latitude = address.latitude;
      this.form.gps_coordinate_longtitude = address.longitude;
      this.form.url = placeResultData.url;
      console.log(address);
    },

    handleError(error) {
      alert(error);
    },
    addDelivery() {
      if (this.add_delivery == false) {
        this.add_delivery = true;
      } else {
        this.add_delivery = false;
      }
    },
    store() {
      this.loading = true;
      axios
        .post("/api/delivery", this.form)
        .then(() => {
          this.$router.push({
            name: "delivery",
          });
          this.form = {
            delivery_name: "",
            company_name: "",
            email: "",
            phone_number: "",
            address: "",
            id: "",
          };
          this.login();
          this.getDeliveries();
          this.add_delivery = false;
          Toast.fire({
            icon: "success",
            title: "Delivery successfully added",
          });
        })
        .catch((error) => (this.errors = error.response.data.errors))
        .finally(() => {
          this.loading = false;
        });
    },
    getDeliveries() {
      axios
        .get("/api/v1/deliveries/" + this.id, {
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

    deleteDelivery(id) {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          axios
            .delete("/api/delivery/" + id)
            .then(() => {
              this.deliveries = this.deliveries.filter((delivery) => {
                return delivery.uniqueId != id;
              });
            })
            .catch(() => {
              this.$router.push({
                name: "delivery",
              });
              this.getDeliveries();
            });
          Swal.fire("Deleted!", "A delivery has been deleted.", "success");
        }
      });
    },
  },
};
</script>

<style scoped></style>
