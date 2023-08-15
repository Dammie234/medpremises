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
        <top-bar title="Vital Signs"></top-bar>
        <!-- END: Top Bar -->

        <div class="grid grid-cols-12 gap-6">
          <div class="intro-y col-span-12 xxl:col-span-12">
            <div class="intro-y box">
              <div
                class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5"
              >
                <h2 class="font-medium text-base mr-auto">Add Vital Sign</h2>
              </div>
              <form class="input p-5" @submit.prevent="store">
                <div class="grid grid-cols-12 gap-x-5" :disabled="loading">
                  <div class="col-span-12 xl:col-span-4 mt-3">
                    <label for="patient" class="form-label">Patient</label>
                    <vue-single-select
                      name="maybe"
                      placeholder="pick a patient"
                      you-want-to-select-a-post="ok"
                      v-model="form.patient"
                      out-of-all-these-posts="makes sense"
                      :options="patients"
                      :required="true"
                      a-post-has-an-id="good for search and display"
                      the-post-has-a-title="make sure to show these"
                      option-label="name"
                    ></vue-single-select>
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.patient"
                    >
                      {{ errors.patient[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-4 mt-3">
                    <label for="temperature" class="form-label">Temperature</label>
                    <input
                      id="temperature"
                      type="text"
                      class="form-control"
                      placeholder="Input temperature"
                      v-model="form.temperature"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.temperature"
                    >
                      {{ errors.temperature[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-4 mt-3">
                    <label for="temperature_measurement">Temperature Measurement</label>
                    <div class="flex flex-col sm:flex-row mt-2">
                      <div class="form-check mr-2">
                        <input
                          id="celcius"
                          class="form-check-input"
                          type="radio"
                          v-model="form.temperature_measurement"
                          name="temperature_measurement"
                          value="Celcius"
                        />
                        <label class="form-check-label" for="celcius">Celcius</label>
                      </div>
                      <div class="form-check mr-2 mt-2 sm:mt-0">
                        <input
                          id="fahrenheit"
                          class="form-check-input"
                          type="radio"
                          name="temperature_measurement"
                          v-model="form.temperature_measurement"
                          value="Fahrenheit"
                        />
                        <label class="form-check-label" for="fahrenheit"
                          >Fahrenheit</label
                        >
                      </div>
                    </div>
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.temperature_measurement"
                    >
                      {{ errors.temperature_measurement[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-3 mt-3">
                    <label for="breathe_rate" class="form-label">Breathe Rate</label>
                    <input
                      id="breathe_rate"
                      type="text"
                      class="form-control"
                      placeholder="Input breathe rate"
                      v-model="form.breathe_rate"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.breathe_rate"
                    >
                      {{ errors.breathe_rate[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-3 mt-3">
                    <label for="heart_rate" class="form-label">Heart Rate</label>
                    <input
                      id="heart_rate"
                      type="text"
                      class="form-control"
                      placeholder="Input heart rate"
                      v-model="form.heart_rate"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.heart_rate"
                    >
                      {{ errors.heart_rate[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-3 mt-3">
                    <label for="blood_pressure" class="form-label">Blood Pressure</label>
                    <input
                      id="blood_pressure"
                      type="text"
                      class="form-control"
                      placeholder="Input Blood Pressure"
                      v-model="form.blood_pressure"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.blood_pressure"
                    >
                      {{ errors.blood_pressure[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-3 mt-3">
                    <label for="weight" class="form-label">Weight</label>
                    <input
                      id="weight"
                      type="text"
                      class="form-control"
                      placeholder="Input Weight"
                      v-model="form.weight"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.weight"
                    >
                      {{ errors.weight[0] }}
                    </div>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary w-20 mt-3">Save</button>
                <loading v-if="loading == true"></loading>
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
                <h2 class="font-medium text-base mr-auto">Vital Signs</h2>
                <div class="w-full sm:w-auto sm:ml-auto mt-3 sm:mt-0">
                  <input
                    class="form-control mr-0 ml-3"
                    type="text"
                    v-model="search"
                    placeholder="Seach Patient"
                  />
                </div>
              </div>
              <div class="p-5">
                <div class="grid grid-cols-12 gap-x-5">
                  <div class="col-span-12 xl:col-span-12 mt-3">
                    <div v-if="vital_signs.length != 0">
                      <div class="overflow-x-auto">
                        <table class="table text-xs table-bordered">
                          <thead>
                            <tr>
                              <th class="whitespace-nowrap">Patient</th>
                              <th class="whitespace-nowrap">Temperature</th>
                              <th class="whitespace-nowrap">Breathe Rate</th>
                              <th class="whitespace-nowrap">Heart Rate</th>
                              <th class="whitespace-nowrap">Blood Pressure</th>
                              <th class="whitespace-nowrap">Weight</th>
                              <th class="whitespace-nowrap">Modified By</th>
                              <th class="whitespace-nowrap">Modified</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr v-for="vital in filterSearch" :key="vital.id">
                              <td>{{ vital.name }}</td>
                              <td>
                                {{ vital.temperature }}<br />{{
                                  vital.temperature_measurement
                                }}
                              </td>
                              <td>{{ vital.breathe_rate }}</td>
                              <td>{{ vital.heart_rate }}</td>
                              <td>{{ vital.blood_pressure }}</td>
                              <td>{{ vital.weight }}</td>
                              <td>{{ vital.staff_name }}</td>
                              <td>{{ vital.created_at | moment("from", "now") }}</td>
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
                        <strong class="mr-2"> Whoops! </strong> There are no vital signs
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
  name: "vital-signs",
  data() {
    return {
      id: null,
      token: null,
      form: {
        patient: "",
        temperature: "",
        temperature_measurement: "",
        heart_rate: "",
        breathe_rate: "",
        blood_pressure: "",
        weight: "",
        token: "",
      },
      errors: {},
      vital_signs: [],
      patients: [],
      search: "",
      loading: false,
    };
  },
  computed: {
    filterSearch() {
      let str = this.search;
      let string = str.charAt(0).toUpperCase() + str.slice(1);
      return this.vital_signs.filter((vital_sign) => {
        return vital_sign.name.match(string);
      });
    },
  },
  created() {
    this.login();
    this.getPatients();
    this.getVitalSigns();
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
      }
    },
    store() {
      this.loading = true;
      axios
        .post("/api/vital-signs", this.form)
        .then(() => {
          this.$router.push({
            name: "vital-signs",
          });
          this.form = {
            patient: "",
            temperature: "",
            temperature_measurement: "",
            heart_rate: "",
            breathe_rate: "",
            blood_pressure: "",
            weight: "",
            token: "",
          };
          this.login();
          this.getVitalSigns();
          Toast.fire({
            icon: "success",
            title: "Vital Sign successfully added",
          });
        })
        .catch((error) => (this.errors = error.response.data.errors))
        .finally(() => {
          this.loading = false;
        });
    },
    getVitalSigns() {
      axios
        .get("/api/v1/vital-signs/" + this.token, {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then((response) => (this.vital_signs = response.data))
        .catch((error) => {
          console.log(error);
          if (error.response.status == 401) {
            this.$router.push({
              name: "logout",
            });
          }
        });
    },
    getPatients() {
      axios
        .get("/api/v1/patient-checkins/" + this.token, {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then((response) => (this.patients = response.data))
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
