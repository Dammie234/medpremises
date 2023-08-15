<template>
  <div class="main">
    <!-- BEGIN: Mobile Menu -->
    <mobile-menu></mobile-menu>
    <!-- END: Mobile Menu -->
    <div class="flex">
      <!-- BEGIN: Side Menu -->
      <side-menu></side-menu>
      <!-- END: Side Menu -->
      <!-- BEGIN: Content -->
      <div class="content">
        <!-- BEGIN: Top Bar -->
        <top-bar title="Medical Services"></top-bar>
        <!-- END: Top Bar -->

        <div class="grid grid-cols-12 gap-6 mt-4">
          <div class="intro-y col-span-12 xxl:col-span-12">
            <div class="intro-y box">
              <div
                class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60"
              >
                <h2 class="font-medium text-base mr-auto">Medical Services</h2>
              </div>
              <div class="p-5">
                <div class="grid grid-cols-12 gap-x-5">
                  <div class="col-span-12 xl:col-span-12">
                    <input
                      class="form-control"
                      type="text"
                      v-model="search"
                      placeholder="Seach Medical Services"
                    />
                  </div>

                  <div class="col-span-12 xl:col-span-12 mt-3">
                    <div v-if="error == true" class="">
                      <div
                        class="alert alert-outline-danger alert-dismissible show flex items-center mb-2"
                        role="alert"
                        v-for="(error, index) in errors"
                        :key="index"
                      >
                        <i
                          data-feather="alert-octagon"
                          class="fa fa-exclamation-circle fa-2x mr-2"
                        ></i>
                        <strong class="mr-2">Whoops!</strong> {{ error }}
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
                    <div class="overflow-x-auto">
                      <table class="table table-sm table-bordered">
                        <thead>
                          <tr>
                            <th class="whitespace-nowrap">Name</th>
                            <th class="whitespace-nowrap">Previous Price</th>
                            <th class="whitespace-nowrap">Price</th>
                            <th class="whitespace-nowrap">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="service in filterSearch" :key="service.id">
                            <td>{{ service.name }}</td>
                            <td>
                              <span v-if="service.price">&#8358; {{ service.price }}</span
                              ><span v-else>-</span>
                            </td>
                            <td>
                              <input
                                type="text"
                                v-model="price[service.id]"
                                class="form-control"
                              />
                            </td>
                            <td class="whitespace-nowrap">
                              <button
                                class="btn btn-success btn-sm"
                                @click="
                                  updateMedicalService(service.id, price[service.id])
                                "
                              >
                                <i class="fa fa-plus mr-2"></i> Add Price
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
  name: "edit-mendical-services",
  data() {
    return {
      id: null,
      token: "",
      search: "",
      services: [],
      price: [],
      error: false,
      errors: [],
    };
  },
  computed: {
    filterSearch() {
      let str = this.search;
      let string = str.charAt(0).toUpperCase() + str.slice(1);
      return this.services.filter((service) => {
        return service.name.match(string);
      });
    },
  },
  created() {
    this.login();
    this.getMedicalServices();
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

    getMedicalServices() {
      axios
        .get("/api/v1/medical-services/" + this.token, {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then((response) => (this.services = response.data))
        .catch((error) => {
          console.log(error);
          if (error.response.status == 401) {
            this.$router.push({
              name: "logout",
            });
          }
        });
    },
    updateMedicalService(id, price) {
      let new_price = +price;
      axios
        .get("/api/update-medical-service/" + this.token + "/" + id + "/" + new_price)
        .then((res) => {
          Toast.fire({
            icon: "success",
            title: "Medical Service Updated",
          });
          this.price = [];
          this.getMedicalServices();
        })
        .catch((error) => {
          this.error = true;
          console.log(error);
          if (error.response.status == 401) {
            this.errors.push(error.response.data.error);
          }
        });
    },
  },
};
</script>

<style scoped></style>
