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
        <top-bar title="Consultation - Medical Treatment"></top-bar>
        <!-- END: Top Bar -->

        <div class="grid grid-cols-12 gap-6 mt-4">
          <div class="intro-y col-span-12 xxl:col-span-12">
            <div class="intro-y box">
              <div
                class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60"
              >
                <h2 class="font-medium text-base mr-auto">
                  Medical Treatment for {{ data.patient.name }}
                </h2>
              </div>
              <div class="p-5">
                <div class="grid grid-cols-12 gap-x-5">
                  <div class="col-span-12 xl:col-span-12 mt-3">
                    <consultation-menu
                      :key_value="key"
                      active="treatment"
                    ></consultation-menu>
                    <div class="grid grid-cols-12 gap-x-5">
                      <div class="col-span-12 xl:col-span-12">
                        <form
                          @submit.prevent="submit"
                          v-if="data.diagnostic.diagnosis !== null"
                        >
                          <div :disabled="loading">
                            <div class="grid grid-cols-12 gap-x-5">
                              <div class="col-span-12 xl:col-span-12 mt-3">
                                <label for="treatment" class="form-label"
                                  >Medical Treatment</label
                                >
                                <vue-editor
                                  id="treatment"
                                  class="form-control"
                                  v-model="form.treatment"
                                  :editorToolbar="customToolbar"
                                ></vue-editor>
                                <div
                                  class="text-danger font-medium text-xs mt-1"
                                  v-if="errors.treatment"
                                >
                                  {{ errors.treatment[0] }}
                                </div>
                              </div>
                              <div class="col-span-12 xl:col-span-4 mt-3">
                                <label class="form-label">Patient Type</label>
                                <div class="flex flex-col sm:flex-row mt-2">
                                  <div class="form-check mr-5">
                                    <input
                                      id="inpatient"
                                      class="form-check-input"
                                      type="radio"
                                      v-model="form.patient_type"
                                      value="Inpatient"
                                    />
                                    <label class="form-check-label" for="inpatient"
                                      >Inpatient</label
                                    >
                                  </div>
                                  <div class="form-check mr-5 mt-2 sm:mt-0">
                                    <input
                                      id="outpatient"
                                      class="form-check-input"
                                      type="radio"
                                      v-model="form.patient_type"
                                      value="Outpatient"
                                    />
                                    <label class="form-check-label" for="outpatient"
                                      >Outpatient</label
                                    >
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div v-if="form.patient_type == 'Inpatient'">
                              <div
                                v-if="
                                  admission.contact_name == null &&
                                  admission.contact_phone == null &&
                                  admission.admitted_date == null &&
                                  admission.key == null
                                "
                              >
                                <div class="grid grid-cols-12 gap-x-5">
                                  <div class="col-span-12 xl:col-span-12 mt-5">
                                    <h4
                                      class="text-xl font-medium leading-none uppercase"
                                    >
                                      Facility Information &amp; Whom to Contact
                                    </h4>
                                  </div>
                                  <div class="col-span-12 xl:col-span-3 mt-3">
                                    <label for="hospital" class="form-label"
                                      >Hospital/Clinic</label
                                    >
                                    <input
                                      id="hospital"
                                      type="text"
                                      class="form-control"
                                      disabled
                                      v-model="signature.registered_facility_name"
                                    />
                                  </div>
                                  <div
                                    class="col-span-12 xl:col-span-3 mt-3"
                                    v-if="contact.self == false"
                                  >
                                    <label for="contact_name" class="form-label"
                                      >Whom to Contact Name (Brought Name)</label
                                    >
                                    <input
                                      id="contact_name"
                                      type="text"
                                      disabled
                                      class="form-control"
                                      v-model="contact.brought_name"
                                    />
                                  </div>
                                  <div class="col-span-12 xl:col-span-3 mt-3" v-else>
                                    <label for="contact_name" class="form-label"
                                      >Whom to Contact Name (Next of Kin)</label
                                    >
                                    <input
                                      id="contact_name"
                                      type="text"
                                      disabled
                                      class="form-control"
                                      v-model="contact.contact_name"
                                    />
                                  </div>
                                  <div
                                    class="col-span-12 xl:col-span-3 mt-3"
                                    v-if="
                                      contact.self == false &&
                                      contact.contact_name == null
                                    "
                                  >
                                    <label for="contact_name" class="form-label"
                                      >Whom to Contact (Name)</label
                                    >
                                    <input
                                      id="contact_name"
                                      type="text"
                                      class="form-control"
                                      v-model="form.contact_name"
                                    />
                                  </div>
                                  <div
                                    class="col-span-12 xl:col-span-3 mt-3"
                                    v-if="contact.self == false"
                                  >
                                    <label for="contact_phone" class="form-label"
                                      >Whom to Contact (Brought Name Phone)</label
                                    >
                                    <input
                                      id="contact_phone"
                                      type="text"
                                      disabled
                                      class="form-control"
                                      v-model="contact.brought_phone"
                                    />
                                  </div>
                                  <div class="col-span-12 xl:col-span-3 mt-3" v-else>
                                    <label for="contact_phone" class="form-label"
                                      >Whom to Contact (Next of Kin Phone)</label
                                    >
                                    <input
                                      id="contact_phone"
                                      type="text"
                                      disabled
                                      class="form-control"
                                      v-model="contact.mobile_phone"
                                    />
                                  </div>
                                  <div
                                    class="col-span-12 xl:col-span-3 mt-3"
                                    v-if="
                                      contact.self == false &&
                                      contact.mobile_phone == null
                                    "
                                  >
                                    <label for="contact_phone" class="form-label"
                                      >Whom to Contact (Phone)</label
                                    >
                                    <input
                                      id="contact_phone"
                                      type="text"
                                      class="form-control"
                                      v-model="form.contact_phone"
                                    />
                                  </div>
                                  <div class="col-span-12 xl:col-span-3 mt-3">
                                    <label for="today_date" class="form-label"
                                      >Today's Date</label
                                    >
                                    <input
                                      id="today_date"
                                      type="text"
                                      disabled
                                      class="form-control"
                                      :value="
                                        my_date &&
                                        new Date(
                                          my_date.getTime() -
                                            my_date.getTimezoneOffset() * 60 * 1000
                                        )
                                          .toISOString()
                                          .split('T')[0]
                                      "
                                      @input="my_date = $event.target.valueAsDate"
                                    />
                                  </div>
                                </div>
                                <div class="grid grid-cols-12 gap-x-5">
                                  <div class="col-span-12 xl:col-span-12 mt-5">
                                    <h4
                                      class="text-xl font-medium leading-none uppercase"
                                    >
                                      Admission Information
                                    </h4>
                                  </div>
                                  <div class="col-span-12 xl:col-span-3 mt-3">
                                    <label for="admitted_date" class="form-label"
                                      >Admitted Date</label
                                    >
                                    <input
                                      id="admitted_date"
                                      type="date"
                                      v-model="form.admitted_date"
                                      class="form-control"
                                    />
                                    <div
                                      class="text-danger font-medium text-xs mt-1"
                                      v-if="errors.admitted_date"
                                    >
                                      {{ errors.admitted_date[0] }}
                                    </div>
                                  </div>
                                  <div class="col-span-12 xl:col-span-6 mt-3">
                                    <label class="form-label">Admission Type</label>
                                    <div class="flex flex-col sm:flex-row mt-2">
                                      <div class="form-check mr-5">
                                        <input
                                          id="medical"
                                          class="form-check-input"
                                          type="radio"
                                          name="admission_type"
                                          v-model="form.admission_type"
                                          value="Medical"
                                        />
                                        <label class="form-check-label" for="medical"
                                          >Medical</label
                                        >
                                      </div>
                                      <div class="form-check mr-5 mt-2 sm:mt-0">
                                        <input
                                          id="surgical"
                                          class="form-check-input"
                                          type="radio"
                                          name="admission_type"
                                          v-model="form.admission_type"
                                          value="Surgical"
                                        />
                                        <label class="form-check-label" for="surgical"
                                          >Surgical</label
                                        >
                                      </div>
                                      <div class="form-check mr-5 mt-2 sm:mt-0">
                                        <input
                                          id="elective"
                                          class="form-check-input"
                                          type="radio"
                                          name="admission_type"
                                          v-model="form.admission_type"
                                          value="Elective"
                                        />
                                        <label class="form-check-label" for="elective"
                                          >Elective</label
                                        >
                                      </div>
                                      <div class="form-check mr-5 mt-2 sm:mt-0">
                                        <input
                                          id="mental_health"
                                          class="form-check-input"
                                          type="radio"
                                          name="admission_type"
                                          v-model="form.admission_type"
                                          value="Mental Health"
                                        />
                                        <label
                                          class="form-check-label"
                                          for="mental_health"
                                          >Mental Health</label
                                        >
                                      </div>
                                      <div class="form-check mr-5 mt-2 sm:mt-0">
                                        <input
                                          id="chemical_dependency"
                                          class="form-check-input"
                                          type="radio"
                                          name="admission_type"
                                          v-model="form.admission_type"
                                          value="Chemical Dependency"
                                        />
                                        <label
                                          class="form-check-label"
                                          for="chemical_dependency"
                                          >Chemical Dependency</label
                                        >
                                      </div>
                                    </div>
                                    <div
                                      class="text-danger font-medium text-xs mt-1"
                                      v-if="errors.admission_type"
                                    >
                                      {{ errors.admission_type[0] }}
                                    </div>
                                  </div>
                                  <div class="col-span-12 xl:col-span-3 mt-3">
                                    <label class="form-label">Admitted Through</label>
                                    <div class="flex flex-col sm:flex-row mt-2">
                                      <div class="form-check mr-5">
                                        <input
                                          id="emergency_room"
                                          class="form-check-input"
                                          type="radio"
                                          name="admitted_through"
                                          v-model="form.admitted_through"
                                          value="Emergency Room"
                                        />
                                        <label
                                          class="form-check-label"
                                          for="emergency_room"
                                          >Emergency Room</label
                                        >
                                      </div>
                                      <div class="form-check mr-5 mt-2 sm:mt-0">
                                        <input
                                          id="scheduled_admission"
                                          class="form-check-input"
                                          type="radio"
                                          name="admitted_through"
                                          v-model="form.admitted_through"
                                          value="Scheduled Admission"
                                        />
                                        <label
                                          class="form-check-label"
                                          for="scheduled_admission"
                                          >Scheduled Admission</label
                                        >
                                      </div>
                                    </div>
                                    <div
                                      class="text-danger font-medium text-xs mt-1"
                                      v-if="errors.admitted_through"
                                    >
                                      {{ errors.admitted_through[0] }}
                                    </div>
                                  </div>
                                  <div class="col-span-12 xl:col-span-6 mt-3">
                                    <label for="diagnosis" class="form-label"
                                      >Admitting Diagnosis</label
                                    >
                                    <input
                                      id="diagnosis"
                                      type="text"
                                      disabled
                                      class="form-control"
                                      v-model="data.diagnostic.diagnosis"
                                    />
                                  </div>
                                  <div class="col-span-12 xl:col-span-3 mt-3">
                                    <label class="form-label">Room Type</label>
                                    <div class="flex flex-col sm:flex-row mt-2">
                                      <div class="form-check mr-5">
                                        <input
                                          id="private"
                                          class="form-check-input"
                                          type="radio"
                                          name="room_type"
                                          v-model="form.room_type"
                                          value="Private"
                                        />
                                        <label class="form-check-label" for="private"
                                          >Private</label
                                        >
                                      </div>
                                      <div class="form-check mr-5 mt-2 sm:mt-0">
                                        <input
                                          id="public"
                                          class="form-check-input"
                                          type="radio"
                                          name="room_type"
                                          v-model="form.room_type"
                                          value="Public"
                                        />
                                        <label class="form-check-label" for="public"
                                          >Public/Shared Room</label
                                        >
                                      </div>
                                    </div>
                                    <div
                                      class="text-danger font-medium text-xs mt-1"
                                      v-if="errors.room_type"
                                    >
                                      {{ errors.room_type[0] }}
                                    </div>
                                  </div>
                                  <div class="col-span-12 xl:col-span-3 mt-3">
                                    <label for="room_number" class="form-label"
                                      >Room Number</label
                                    >
                                    <input
                                      id="room_number"
                                      type="text"
                                      class="form-control"
                                      v-model="form.room_number"
                                    />
                                    <div
                                      class="text-danger font-medium text-xs mt-1"
                                      v-if="errors.room_number"
                                    >
                                      {{ errors.room_number[0] }}
                                    </div>
                                  </div>
                                </div>
                                
                                <div class="grid grid-cols-12 gap-x-5">
                                  <div class="col-span-12 xl:col-span-12 mt-5">
                                    <h4
                                      class="text-xl font-medium leading-none uppercase"
                                    >
                                      Payment Deposit
                                    </h4>
                                  </div>
                                  <div class="col-span-12 xl:col-span-6 mt-3">
                                    <label for="diagnosis" class="form-label"
                                      >Admitting Diagnosis</label
                                    >
                                    <input
                                      id="diagnosis"
                                      type="text"
                                      disabled
                                      class="form-control"
                                      v-model="data.diagnostic.diagnosis"
                                    />
                                  </div>
                                  <div class="col-span-12 xl:col-span-3 mt-3">
                                    <label for="amount" class="form-label">Amount</label>
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
                                </div>
                              </div>
                              <div v-else>
                                <div
                                  class="alert alert-outline-danger alert-dismissible show flex items-center mb-2 mt-2"
                                  role="alert"
                                >
                                  <i
                                    data-feather="alert-octagon"
                                    class="fa fa-exclamation-circle fa-2x mr-2"
                                  ></i>
                                  <strong class="mr-2"> Whoops! </strong> Patient has already been
                                  admitted.
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
                          <div class="mt-2">
                            <input
                              type="submit"
                              value="Submit"
                              v-if="form.completed == 0"
                              class="w-20 btn btn-primary"
                            />
                            <div class="text-danger" v-else>
                              <p>
                                <strong
                                  >This consultation has been marked as completed. So, you
                                  can't edit the medical treatment</strong
                                >
                              </p>
                            </div>
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
                            Medical Diagnosis before you can add Medical Treatment.
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
  name: "medical-treatment",
  data() {
    return {
      id: null,
      token: null,
      data: {},
      key: "",
      loading: false,
      errors: {},
      signature: "",
      contact: "",
      my_date: "",
      form: {
        treatment: "",
        patient_type: "",
        admitted_date: null,
        contact_name: null,
        contact_phone: null,
        admission_type: null,
        admitted_through: null,
        admitting_diagnosis: null,
        room_type: null,
        room_number: null,
        gender: null,
        date_of_birth: null,
        new_born_name: null,
        delivery_type: null,
        bed_type: null,
        attending_pediatrician: null,
        amount: null,
        token: "",
      },
      admission: "",
      customToolbar: [
        ["bold", "italic", "underline", "strike"],
        [{ align: "" }, { align: "center" }, { align: "right" }, { align: "justify" }],
        ["blockquote", "code-block"],
        [{ list: "ordered" }, { list: "bullet" }, { list: "check" }],
        [{ indent: "-1" }, { indent: "+1" }], // outdent/indent
        ["link"],
        ["clean"],
      ],
    };
  },

  created() {
    this.login();
    this.getMedicalTreatment();
    this.getData();
    this.getFacilitySignature();
    this.getPatientCheckin();
    this.my_date = new Date();
    this.getAdmissionDetail();
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
    getMedicalTreatment() {
      axios
        .get("/api/v1/consultation/" + this.key, {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then((response) => (this.form = response.data.treatment))
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
        .get("/api/v1/facility-details/" + this.token, {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then((response) => (this.signature = response.data))
        .catch((error) => {
          console.log(error);
          if (error.response.status == 401) {
            this.$router.push({
              name: "logout",
            });
          }
        });
    },
    getPatientCheckin() {
      axios
        .get("/api/v1/patient-checkin/" + this.key, {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then((response) => (this.contact = response.data))
        .catch((error) => {
          console.log(error);
          if (error.response.status == 401) {
            this.$router.push({
              name: "logout",
            });
          }
        });
    },
    getAdmissionDetail() {
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

    getData() {
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
    submit() {
      this.loading = true;
      this.form.token = User.token();
      axios
        .patch("/api/medical-treatment/" + this.key, this.form)
        .then(() => {
          this.$router.push({
            path: `/medical/consultations/medical-prescribed-drug/${this.key}`,
          });
          Toast.fire({
            icon: "success",
            title: "Medical Treatment successfully updated ",
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
