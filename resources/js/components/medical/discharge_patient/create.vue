<template>
  <div class="main">
    <!-- BEGIN: Mobile Menu -->
    <mobile-menu></mobile-menu>
    <!-- END: Mobile Menu -->
    <div class="flex">
      <!-- BEGIN: Side Menu -->
      <side-menu page="patient"></side-menu>
      <!-- END: Side Menu -->
      <div class="content">
        <!-- BEGIN: Top Bar -->
        <top-bar title="Discharge Patient"></top-bar>
        <!-- END: Top Bar -->
        <div class="grid grid-cols-12 gap-6 mt-4">
          <div class="intro-y col-span-12 xxl:col-span-12">
            <div class="intro-y box">
              <div class="flex flex-col p-5 border-b border-slate-200/60">
                <h2 class="font-medium text-base">Discharge {{ data.patient.name }}</h2>
                <p class="text-red-600 text-danger">
                  The patient discharge is not editable. So, provide valid data.
                </p>
              </div>
              <div class="p-5">
                <div class="grid grid-cols-12 gap-x-5">
                  <div class="col-span-12 xl:col-span-12 mt-3">
                    <div class="grid grid-cols-12 gap-x-5">
                      <div class="col-span-12 xl:col-span-12">
                        <form @submit.prevent="submit">
                          <div :disabled="loading">
                            <div class="grid grid-cols-12 gap-x-5">
                              <div class="col-span-12 xl:col-span-12">
                                <label for="reason_for_admittance" class="form-label"
                                  >Reason for Admittance</label
                                >
                                <vue-editor
                                  id="reason_for_admittance"
                                  class="form-control"
                                  v-model="form.reason_for_admittance"
                                  :editorToolbar="customToolbar"
                                ></vue-editor>
                                <div
                                  class="text-danger font-medium text-xs mt-1"
                                  v-if="errors.reason_for_admittance"
                                >
                                  {{ errors.reason_for_admittance[0] }}
                                </div>
                              </div>
                              <div class="col-span-12 xl:col-span-4 mt-3">
                                <label for="admitted_date" class="form-label"
                                  >Admitted Date</label
                                >
                                <input
                                  id="admitted_date"
                                  class="form-control"
                                  :value="admission.admitted_date"
                                  type="text"
                                  disabled
                                />
                              </div>
                              <div class="col-span-12 xl:col-span-8 mt-3">
                                <label class="form-label">Diagnosis at Admittance</label>
                                <input
                                  disabled
                                  class="form-control"
                                  :value="data.diagnostic.diagnosis"
                                  type="text"
                                />
                              </div>
                              <div class="col-span-12 xl:col-span-9 mt-3">
                                <label for="title" class="form-label"
                                  >Treatment Summary</label
                                >
                                <div v-html="data.treatment.treatment"></div>
                              </div>
                              <div class="col-span-12 xl:col-span-3 mt-3">
                                <label for="date_discharged" class="form-label"
                                  >Date Discharged</label
                                >
                                <input
                                  id="date_discharged"
                                  class="form-control"
                                  v-model="form.date_discharged"
                                  type="date"
                                />
                                <div
                                  class="text-danger font-medium text-xs mt-1"
                                  v-if="errors.date_discharged"
                                >
                                  {{ errors.date_discharged[0] }}
                                </div>
                              </div>
                              <div class="col-span-12 xl:col-span-3 mt-3">
                                <label for="self" class="form-label"
                                  >Physician Approved</label
                                >
                                <div class="flex flex-col sm:flex-row mt-2">
                                  <div class="form-check mr-2">
                                    <input
                                      id="radio-switch-4"
                                      class="form-check-input"
                                      type="radio"
                                      v-model="form.physician_approved"
                                      name="physician_approved"
                                      value="Yes"
                                    />
                                    <label class="form-check-label" for="radio-switch-4"
                                      >Yes</label
                                    >
                                  </div>
                                  <div class="form-check mr-2 mt-2 sm:mt-0">
                                    <input
                                      id="radio-switch-5"
                                      class="form-check-input"
                                      type="radio"
                                      name="physician_approved"
                                      v-model="form.physician_approved"
                                      value="No"
                                    />
                                    <label class="form-check-label" for="radio-switch-5"
                                      >No</label
                                    >
                                  </div>
                                </div>
                                <div
                                  class="text-danger font-medium text-xs mt-1"
                                  v-if="errors.physician_approved"
                                >
                                  {{ errors.physician_approved[0] }}
                                </div>
                              </div>
                              <div class="col-span-12 xl:col-span-9 mt-3">
                                <label for="self" class="form-label"
                                  >Reason for Discharge</label
                                >
                                <div class="flex flex-col sm:flex-row mt-2">
                                  <div class="form-check mr-2">
                                    <input
                                      id="radio-switch-6"
                                      class="form-check-input"
                                      type="radio"
                                      v-model="form.reason_for_discharge"
                                      name="reason_for_discharge"
                                      value="Patient Deceased"
                                    />
                                    <label class="form-check-label" for="radio-switch-6"
                                      >Patient Deceased</label
                                    >
                                  </div>
                                  <div class="form-check mr-2 mt-2 sm:mt-0">
                                    <input
                                      id="radio-switch-7"
                                      class="form-check-input"
                                      type="radio"
                                      name="reason_for_discharge"
                                      v-model="form.reason_for_discharge"
                                      value="Patient Transformed"
                                    />
                                    <label class="form-check-label" for="radio-switch-7"
                                      >Patient Transformed</label
                                    >
                                  </div>
                                  <div class="form-check mr-2 mt-2 sm:mt-0">
                                    <input
                                      id="radio-switch-8"
                                      class="form-check-input"
                                      type="radio"
                                      name="reason_for_discharge"
                                      v-model="form.reason_for_discharge"
                                      value="Patient Transfered"
                                    />
                                    <label class="form-check-label" for="radio-switch-8"
                                      >Patient Transfered</label
                                    >
                                  </div>
                                  <div class="form-check mr-2 mt-2 sm:mt-0">
                                    <input
                                      id="radio-switch-9"
                                      class="form-check-input"
                                      type="radio"
                                      name="reason_for_discharge"
                                      v-model="form.reason_for_discharge"
                                      value="Patient Terminated"
                                    />
                                    <label class="form-check-label" for="radio-switch-9"
                                      >Patient Terminated</label
                                    >
                                  </div>
                                </div>
                                <div
                                  class="text-danger font-medium text-xs mt-1"
                                  v-if="errors.reason_for_discharge"
                                >
                                  {{ errors.reason_for_discharge[0] }}
                                </div>
                              </div>
                              <div class="col-span-12 xl:col-span-12 mt-3">
                                <label for="diagnosis_at_discharge" class="form-label"
                                  >Diagnosis at Discharge</label
                                >
                                <input
                                  id="diagnosis_at_discharge"
                                  class="form-control"
                                  v-model="form.diagnosis_at_discharge"
                                  type="text"
                                />
                                <div
                                  class="text-danger font-medium text-xs mt-1"
                                  v-if="errors.diagnosis_at_discharge"
                                >
                                  {{ errors.diagnosis_at_discharge[0] }}
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="mt-2">
                            <input
                              type="submit"
                              value="Submit"
                              class="w-20 btn btn-primary"
                            />
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
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: "patient-discharge",
  created() {
    this.login();
    this.getPatient();
    this.getAdmissionDetails();
  },
  data() {
    return {
      token: "",
      key: "",
      form: {
        reason_for_admittance: null,
        key: "",
        token: "",
        date_discharged: null,
        physician_approved: null,
        reason_for_discharge: null,
        diagnosis_at_discharge: null,
      },
      admission: "",
      data: {},
      customToolbar: [
        ["bold", "italic", "underline", "strike"],
        [{ align: "" }, { align: "center" }, { align: "right" }, { align: "justify" }],
        ["blockquote", "code-block"],
        [{ list: "ordered" }, { list: "bullet" }, { list: "check" }],
        [{ indent: "-1" }, { indent: "+1" }], // outdent/indent
        ["link"],
        ["clean"],
      ],
      errors: {},
    };
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
        this.form.key = this.$route.params.key;
      }
    },
    getPatient() {
      axios
        .get("/api/v1/consultation/" + this.key, {
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
    getAdmissionDetails() {
      axios
        .get("/api/v1/admission-facility-detail/" + this.key, {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then((response) => (this.admission = response.data))
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
      this.form.token = User.token();
      this.form.key = this.key;
      axios
        .post("/api/discharge-patient/", this.form)
        .then(() => {
          this.$router.push({
            name: "discharged-patients",
          });

          Toast.fire({
            icon: "success",
            title: "Patient successfully discharged discharged",
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
