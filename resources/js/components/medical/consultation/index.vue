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
        <top-bar title="Consultation"></top-bar>
        <!-- END: Top Bar -->

        <div class="grid grid-cols-12 gap-6 mt-4">
          <div class="intro-y col-span-12 xxl:col-span-12">
            <div class="intro-y box">
              <div
                class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60"
              >
                <h2 class="font-medium text-base mr-auto">Consultation</h2>
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
                    <div v-if="error == true" class="">
                      <div
                        class="alert alert-outline-danger alert-dismissible show flex items-center mb-2"
                        role="alert"
                        v-for="(error, index) in errors"
                        :key="index"
                      >
                        <i data-feather="alert-octagon" class="fa fa-exclamation-circle fa-2x mr-2"></i>
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
                              <th class="whitespace-nowrap">Taken By</th>
                              <th class="whitespace-nowrap">Taken</th>
                              <th class="whitespace-nowrap"></th>
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
                              <td>
                                <button
                                  v-if="vital.consultation == 0"
                                  class="btn btn-primary mt-1"
                                  @click="makeConsultation(vital.patient_id, vital.key)"
                                >
                                  Make Consultation
                                </button>
                                <router-link
                                  class="btn btn-primary mt-"
                                  v-else
                                  :to="{
                                    name: 'medical-history',
                                    params: { key: vital.key },
                                  }"
                                  >Continue Consultation</router-link
                                >
                                <router-link
                                  :to="{
                                    name: 'medical-treatment-plan',
                                    params: { key: vital.key },
                                  }"
                                  v-if="vital.payment == 0 && vital.consultation == true"
                                  class="btn btn-primary mt-1"
                                  >Treatment Plan</router-link
                                >
                                <router-link
                                  :to="{
                                    name: 'nurse-documentation',
                                    params: { key: vital.key },
                                  }"
                                  v-if="vital.payment == 0 && vital.documentation == true"
                                  class="btn btn-primary mt-1"
                                  >Nurse Documentation</router-link
                                >
                                <router-link
                                  :to="{
                                    name: 'progress-note',
                                    params: { key: vital.key },
                                  }"
                                  v-if="vital.payment == 0 && vital.consultation == true"
                                  class="btn btn-primary mt-1"
                                  >Progress Note</router-link
                                >
                                <router-link
                                  :to="{
                                    name: 'drug-prescription-plan',
                                    params: { key: vital.key },
                                  }"
                                  v-if="
                                    vital.payment == 0 &&
                                    vital.drug_prescription_plan == true
                                  "
                                  class="btn btn-primary mt-1"
                                  >Drug Prescription Plan</router-link
                                >
                                <button
                                  class="btn btn-primary"
                                  @click="endConsultation(vital.key)"
                                  v-if="vital.consultation != 0 && vital.completed == 0"
                                >
                                  End Consultation
                                </button>
                                <router-link
                                  :to="{ name: 'invoices', params: { key: vital.key } }"
                                  v-if="vital.payment == 0"
                                  class="btn btn-primary mt-1"
                                  >Patient Invoices</router-link
                                >
                                <router-link
                                  :to="{
                                    name: 'make-payment',
                                    params: { key: vital.key },
                                  }"
                                  v-if="vital.payment == 0 && vital.admission == 1"
                                  class="btn btn-primary mt-1"
                                  >Make Patient Deposit</router-link
                                >
                                <router-link
                                  :to="{
                                    name: 'update-payment',
                                    params: { key: vital.key },
                                  }"
                                  v-if="vital.payment == 0 && vital.admission == 1"
                                  class="btn btn-primary mt-1"
                                  >Update Patient Deposit</router-link
                                >
                                <router-link
                                  :to="{
                                    name: 'outpatient-visit',
                                    params: { key: vital.key },
                                  }"
                                  class="btn btn-primary mt-1"
                                  v-if="vital.outpatient_visit == true"
                                  >Outpatient Visits</router-link
                                >
                                <router-link
                                  :to="{
                                    name: 'previous-consultations',
                                    params: { id: vital.patient_id },
                                  }"
                                  class="btn btn-primary mt-1"
                                  >Previous Consultation</router-link
                                >
                                <router-link
                                  v-if="
                                    vital.payment == 1 &&
                                    vital.consultation == 1 &&
                                    vital.admission == 1 &&
                                    vital.completed == 1 &&
                                    vital.discharge_patient == 0
                                  "
                                  :to="{
                                    name: 'discharge-patient-create',
                                    params: { key: vital.key },
                                  }"
                                  class="btn btn-primary mt-1"
                                  >Discharge Patient</router-link
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
                        <strong class="mr-2"> Whoops! </strong> There are no vital signs added yet!
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
  name: "consultations",
  data() {
    return {
      id: null,
      token: null,
      vital_signs: [],
      search: "",
      error: false,
      errors: [],
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
      }
    },
    makeConsultation(patient_id, key) {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, make consultation!",
      }).then((result) => {
        if (result.isConfirmed) {
          axios
            .get("/api/make-consultation/" + patient_id + "/" + key + "/" + this.token)
            .then(() => {
              this.$router.push({
                path: `/patient/consultations/medical-history/${key}`,
              });
              this.getVitalSigns();
            })
            .catch((error) => {
              this.error = true;
              console.log(error);
              if (error.response.status == 401) {
                this.errors.push(error.response.data.error);
              }
            });
          Swal.fire(
            "Consultation Initiated!",
            "Consultation has begin for patient",
            "success"
          );
        }
      });
    },
    endConsultation(key) {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, end consultation!",
      }).then((result) => {
        if (result.isConfirmed) {
          axios
            .get("/api/end-medical-consultation/" + key)
            .then(() => {
              this.$router.push({
                name: "consultations",
              });
            })
            .catch((error) => {
              this.error = true;
              console.log(error);
              if (error.response.status == 401) {
                this.errors.push(error.response.data.error);
              }
            });
          Swal.fire(
            "Consultation Ended!",
            "Consultation has ended for patient",
            "success"
          );
        }
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
  },
};
</script>

<style scoped></style>
