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
        <top-bar title="Consultation - Medical Services"></top-bar>
        <!-- END: Top Bar -->

        <div class="grid grid-cols-12 gap-6 mt-4">
          <div class="intro-y col-span-12 xxl:col-span-12">
            <div class="intro-y box">
              <div
                class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60"
              >
                <h2 class="font-medium text-base mr-auto">
                  Medical Service for {{ patient.name }}
                </h2>
              </div>
              <div class="p-5">
                <div class="grid grid-cols-12 gap-x-5">
                  <div class="col-span-12 xl:col-span-12 mt-3">
                    <consultation-menu
                      :key_value="key"
                      active="service"
                    ></consultation-menu>
                    <div class="grid grid-cols-12 gap-x-5">
                      <div class="col-span-12 xl:col-span-12">
                        <form @submit.prevent="submit" v-if="treat.treatment !== null">
                          <div :disabled="loading">
                            <p class="text-danger">
                              The medical service is irreversible. So, be careful before
                              you add medical service.
                            </p>
                            <div class="grid grid-cols-12 gap-x-5">
                              <div
                                class="col-span-12 xl:col-span-2 mt-3"
                                v-for="(service, index) in medical_services"
                                :key="index"
                              >
                                <div class="form-check mt-2">
                                  <input
                                    :id="'service-' + index"
                                    class="form-check-input"
                                    type="checkbox"
                                    v-model="form.medical_services"
                                    :value="service"
                                  />
                                  <label
                                    class="form-check-label"
                                    :for="'service-' + index"
                                    >{{ service }}</label
                                  >
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="mt-2">
                            <input
                              type="submit"
                              value="Submit"
                              v-if="treat.completed == 0"
                              class="w-20 btn btn-primary"
                            />
                            <loading v-if="loading == true"></loading>
                          </div>
                        </form>
                        <div v-else>
                          <div
                            class="alert alert-outline-danger alert-dismissible show flex items-center mb-2 mt-2"
                            role="alert"
                          >
                            <i data-feather="alert-octagon" class="fa fa-exclamation-circle fa-2x mr-2"></i>
                            <strong class="mr-2"> Whoops! </strong> You have to provide data for
                            Medical Treatment before you can add Medical Services.
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
        </div>
      </div>
      <!-- END: Content -->
    </div>
  </div>
</template>

<script>
export default {
  name: "medical-investigation",
  data() {
    return {
      id: null,
      token: null,
      patient: "",
      key: "",
      treat: "",
      loading: false,
      errors: {},
      medical_services: "",
      form: {
        medical_services: [],
        token: "",
      },
    };
  },

  created() {
    this.login();
    this.getMedicalServices();
    this.getPatient();
    this.getMedicalTreatment();
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
        this.key = this.$route.params.key;
      }
    },
    getMedicalServices() {
      axios
        .get("/api/v1/facility-services/" + this.token, {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then((response) => (this.medical_services = response.data.services))
        .catch((error) => {
          console.log(error);
          if (error.response.status == 401) {
            this.$router.push({
              name: "logout",
            });
          }
        });
    },
    getMedicalTreatment() {
      axios
        .get("/api/v1/consultation/" + this.key, {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then((response) => (this.treat = response.data.treatment))
        .catch((error) => {
          console.log(error);
          if (error.response.status == 401) {
            this.$router.push({
              name: "logout",
            });
          }
        });
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
    submit() {
      this.loading = true;
      axios
        .post("/api/delivery", this.form)
        .then(() => {
          this.$router.push({
            name: "delivery",
          });
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
  },
};
</script>

<style scoped></style>
