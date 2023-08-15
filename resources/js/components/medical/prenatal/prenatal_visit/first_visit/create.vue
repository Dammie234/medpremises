<template>
  <div class="main">
    <!-- BEGIN: Mobile Menu -->
    <mobile-menu></mobile-menu>
    <!-- END: Mobile Menu -->
    <div class="flex">
      <!-- BEGIN: Side Menu -->
      <side-menu page="prenatal"></side-menu>
      <!-- END: Side Menu -->
      <!-- BEGIN: Content -->
      <div class="content">
        <!-- BEGIN: Top Bar -->
        <top-bar title="Prenatals"></top-bar>
        <!-- END: Top Bar -->

        <div class="grid grid-cols-12 gap-6 mt-4">
          <div class="intro-y col-span-12 xxl:col-span-12">
            <div class="intro-y box">
              <div
                class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60"
              >
                <div class="w-full">
                  <h2 class="font-medium text-base mr-auto">
                    Take Prenatal First Visit of {{ data.prenatal.name }}
                  </h2>
                  <p>Gestational Week: {{ computeGestationalAge }}</p>
                </div>

                <div class="w-full flex flex-row sm:w-auto sm:ml-auto mt-3 sm:mt-0">
                  <router-link
                    :to="{ name: 'prenatal-visit', params: { key: key } }"
                    class="btn btn-primary"
                    >Go Back</router-link
                  >
                </div>
              </div>
              <div class="p-5">
                <form
                  class="grid grid-cols-12 gap-6"
                  @submit.prevent="storeFirstPrenatal"
                >
                  <div class="col-span-12 xl:col-span-3 mt-3">
                    <label for="pregnancy_duration" class="form-label"
                      >Pregnancy Duration <small>Duration in weeks</small></label
                    >
                    <input
                      id="pregnancy_duration"
                      type="text"
                      disabled
                      class="form-control"
                      v-model="form.pregnancy_duration"
                    />
                  </div>
                  <div class="col-span-12 xl:col-span-3 mt-3">
                    <label for="blood_pressure" class="form-label">Blood Pressure</label>
                    <input
                      id="blood_pressure"
                      type="text"
                      class="form-control"
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
                    <label for="height" class="form-label">Height</label>
                    <input
                      id="height"
                      type="text"
                      class="form-control"
                      v-model="form.height"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.height"
                    >
                      {{ errors.height[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-3 mt-3">
                    <label for="weight" class="form-label">Weight</label>
                    <input
                      id="weight"
                      type="text"
                      class="form-control"
                      v-model="form.weight"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.weight"
                    >
                      {{ errors.weight[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-6 mt-3">
                    <label for="screening_for_down_syndrome" class="form-label"
                      >Screening for Down Syndrome</label
                    >
                    <textarea
                      id="screening_for_down_syndrome"
                      rows="5"
                      class="form-control"
                      v-model="form.screening_for_down_syndrome"
                    ></textarea>
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.screening_for_down_syndrome"
                    >
                      {{ errors.screening_for_down_syndrome[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-6 mt-3">
                    <label for="cervical_screening" class="form-label"
                      >Cervical Screening</label
                    >
                    <textarea
                      id="cervical_screening"
                      rows="5"
                      class="form-control"
                      v-model="form.cervical_screening"
                    ></textarea>
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.cervical_screening"
                    >
                      {{ errors.cervical_screening[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 mt-3 xl:col-span-3">
                    <label for="ungoing_medication" class="form-label"
                      >Ungoing Medication</label
                    >
                    <div class="flex flex-col sm:flex-row mt-2">
                      <div class="form-check mr-5">
                        <input
                          id="radio-switch-55"
                          class="form-check-input"
                          type="radio"
                          v-model="form.ungoing_medication"
                          name="ungoing_ungoing"
                          value="1"
                        />
                        <label class="form-check-label" for="radio-switch-55">Yes</label>
                      </div>
                      <div class="form-check">
                        <input
                          id="radio-switch-56"
                          class="form-check-input"
                          type="radio"
                          v-model="form.ungoing_medication"
                          name="ungoing_medication"
                          value="0"
                        />
                        <label class="form-check-label" for="radio-switch-56">No</label>
                      </div>
                    </div>
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.ungoing_medication"
                    >
                      {{ errors.ungoing_medication[0] }}
                    </div>
                  </div>

                  <div
                    class="col-span-12 xl:col-span-3 mt-3"
                    v-if="form.ungoing_medication == '1'"
                  >
                    <label for="type_of_ungoing_medication" class="form-label"
                      >Type of Ungoing Medication</label
                    >
                    <input
                      id="type_of_ungoing_medication"
                      type="text"
                      class="form-control"
                      v-model="form.type_of_ungoing_medication"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.type_of_ungoing_medication"
                    >
                      {{ errors.type_of_ungoing_medication[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-3 mt-3">
                    <label for="gestational_age" class="form-label"
                      >Gestational Age</label
                    >
                    <input
                      id="gestational_age"
                      disabled
                      type="text"
                      class="form-control"
                      v-model="form.gestational_age"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.gestational_age"
                    >
                      {{ errors.gestational_age[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-3 mt-3">
                    <label for="haemogloblin_result" class="form-label"
                      >Haemogloblin Result</label
                    >
                    <input
                      id="haemogloblin_result"
                      type="text"
                      class="form-control"
                      v-model="form.haemogloblin_result"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.haemogloblin_result"
                    >
                      {{ errors.haemogloblin_result[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-3 mt-3">
                    <label for="ungoing_medication" class="form-label"
                      >Antenatal Risk</label
                    >
                    <select
                      id="antenatal_risk"
                      class="form-control"
                      v-model="form.antenatal_risk"
                    >
                      <option value="">Select an antenatal result</option>
                      <option value="No Risk Factor">No Risk Factor</option>
                      <option value="Anaemia">Anaemia</option>
                      <option value="Oedema">Oedema</option>
                      <option value="Proteinuria">Proteinuria</option>
                      <option value="High BP (above 140/90)">
                        High BP (above 140/90)
                      </option>
                      <option value="Not gaining weight">Not gaining weight</option>
                      <option value="Antepartum Haem">Antepartum Haem.</option>
                      <option value="Abnormal Lie (after 32 weeks)">
                        Abnormal Lie (after 32 weeks)
                      </option>
                      <option value="Other">Other</option>
                    </select>
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.antenatal_risk"
                    >
                      {{ errors.antenatal_risk[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 mt-3 xl:col-span-3">
                    <label for="smoking" class="form-label">Does patient smokes?</label>
                    <div class="flex flex-col sm:flex-row mt-2">
                      <div class="form-check mr-5">
                        <input
                          id="radio-switch-57"
                          class="form-check-input"
                          type="radio"
                          v-model="form.smoking"
                          name="smoking"
                          value="1"
                        />
                        <label class="form-check-label" for="radio-switch-57">Yes</label>
                      </div>
                      <div class="form-check">
                        <input
                          id="radio-switch-58"
                          class="form-check-input"
                          type="radio"
                          v-model="form.smoking"
                          name="smoking"
                          value="0"
                        />
                        <label class="form-check-label" for="radio-switch-58">No</label>
                      </div>
                    </div>
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.smoking"
                    >
                      {{ errors.smoking[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-3 mt-3" v-if="form.smoking == 1">
                    <label for="smoking_qty" class="form-label"
                      >How many cigarettes does patient smoke per day?</label
                    >
                    <input
                      id="smoking_qty"
                      type="text"
                      required
                      class="form-control"
                      v-model="form.smoking_qty"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.smoking_qty"
                    >
                      {{ errors.smoking_qty[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 mt-3 xl:col-span-3">
                    <label for="alcohol" class="form-label"
                      >Does patient take alcohol?</label
                    >
                    <div class="flex flex-col sm:flex-row mt-2">
                      <div class="form-check mr-5">
                        <input
                          id="radio-switch-59"
                          class="form-check-input"
                          type="radio"
                          v-model="form.alcohol"
                          name="alcohol"
                          value="1"
                        />
                        <label class="form-check-label" for="radio-switch-59">Yes</label>
                      </div>
                      <div class="form-check">
                        <input
                          id="radio-switch-60"
                          class="form-check-input"
                          type="radio"
                          v-model="form.alcohol"
                          name="alcohol"
                          value="0"
                        />
                        <label class="form-check-label" for="radio-switch-60">No</label>
                      </div>
                    </div>
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.alcohol"
                    >
                      {{ errors.alcohol[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-3 mt-3" v-if="form.alcohol == 1">
                    <label for="alcohol_qty" class="form-label"
                      >How many alcohol does patient drink per day?</label
                    >
                    <input
                      id="alcohol_qty"
                      type="text"
                      required
                      class="form-control"
                      v-model="form.alcohol_qty"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.alcohol_qty"
                    >
                      {{ errors.alcohol_qty[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-3 mt-3">
                    <label for="fetal_heart_rate" class="form-label"
                      >Fetal heart rate
                      <small
                        >(record most abnormal value between 00:00 to 24:00)</small
                      ></label
                    >
                    <input
                      id="fetal_heart_rate"
                      type="text"
                      required
                      placeholder="beats/min"
                      class="form-control"
                      v-model="form.fetal_heart_rate"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.fetal_heart_rate"
                    >
                      {{ errors.fetal_heart_rate[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 mt-3 xl:col-span-3">
                    <label for="tocolysis" class="form-label">Tocolysis</label>
                    <div class="flex flex-col sm:flex-row mt-2">
                      <div class="form-check mr-5">
                        <input
                          id="radio-switch-70"
                          class="form-check-input"
                          type="radio"
                          v-model="form.tocolysis"
                          name="tocolysis"
                          value="Yes"
                        />
                        <label class="form-check-label" for="radio-switch-70">Yes</label>
                      </div>
                      <div class="form-check mr-5">
                        <input
                          id="radio-switch-71"
                          class="form-check-input"
                          type="radio"
                          v-model="form.tocolysis"
                          name="tocolysis"
                          value="No"
                        />
                        <label class="form-check-label" for="radio-switch-71">No</label>
                      </div>
                      <div class="form-check">
                        <input
                          id="radio-switch-72"
                          class="form-check-input"
                          type="radio"
                          v-model="form.tocolysis"
                          name="tocolysis"
                          value="Unknown"
                        />
                        <label class="form-check-label" for="radio-switch-72"
                          >Unknown</label
                        >
                      </div>
                    </div>
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.tocolysis"
                    >
                      {{ errors.tocolysis[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 mt-3 xl:col-span-3">
                    <label for="induction_of_labour" class="form-label"
                      >Induction of Labour</label
                    >
                    <div class="flex flex-col sm:flex-row mt-2">
                      <div class="form-check mr-5">
                        <input
                          id="radio-switch-73"
                          class="form-check-input"
                          type="radio"
                          v-model="form.induction_of_labour"
                          name="induction_of_labour"
                          value="Yes"
                        />
                        <label class="form-check-label" for="radio-switch-73">Yes</label>
                      </div>
                      <div class="form-check mr-5">
                        <input
                          id="radio-switch-74"
                          class="form-check-input"
                          type="radio"
                          v-model="form.induction_of_labour"
                          name="induction_of_labour"
                          value="No"
                        />
                        <label class="form-check-label" for="radio-switch-74">No</label>
                      </div>
                      <div class="form-check">
                        <input
                          id="radio-switch-75"
                          class="form-check-input"
                          type="radio"
                          v-model="form.induction_of_labour"
                          name="induction_of_labour"
                          value="Unknown"
                        />
                        <label class="form-check-label" for="radio-switch-75"
                          >Unknown</label
                        >
                      </div>
                    </div>
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.induction_of_labour"
                    >
                      {{ errors.induction_of_labour[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 mt-3 xl:col-span-3">
                    <label for="blood_transfusion" class="form-label"
                      >Blood tranfusion</label
                    >
                    <div class="flex flex-col sm:flex-row mt-2">
                      <div class="form-check mr-5">
                        <input
                          id="radio-switch-76"
                          class="form-check-input"
                          type="radio"
                          v-model="form.blood_transfusion"
                          name="blood_transfusion"
                          value="Yes"
                        />
                        <label class="form-check-label" for="radio-switch-76">Yes</label>
                      </div>
                      <div class="form-check mr-5">
                        <input
                          id="radio-switch-77"
                          class="form-check-input"
                          type="radio"
                          v-model="form.blood_transfusion"
                          name="blood_transfusion"
                          value="No"
                        />
                        <label class="form-check-label" for="radio-switch-77">No</label>
                      </div>
                      <div class="form-check">
                        <input
                          id="radio-switch-78"
                          class="form-check-input"
                          type="radio"
                          v-model="form.blood_transfusion"
                          name="blood_transfusion"
                          value="Unknown"
                        />
                        <label class="form-check-label" for="radio-switch-78"
                          >Unknown</label
                        >
                      </div>
                    </div>
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.blood_transfusion"
                    >
                      {{ errors.blood_transfusion[0] }}
                    </div>
                  </div>
                  <div class="col-span-12">
                    <button type="submit" class="btn btn-primary w-20 mt-3">Save</button>
                    <loading v-if="loading == true"></loading>
                  </div>
                </form>
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
  name: "prenatal",
  data() {
    return {
      token: "",
      key: "",
      data: {},

      errors: {},
      loading: false,
      form: {
        pregnancy_duration: "",
        blood_pressure: "",
        height: "",
        weight: "",
        screening_for_down_syndrome: "",
        cervical_screening: "",
        ungoing_medication: "",
        type_of_ungoing_medication: "",
        smoking: "",
        smoking_qty: "",
        alcohol: "",
        alcohol_qty: "",
        gestational_age: "",
        haemogloblin_result: "",
        antenatal_risk: "",
        fetal_heart_rate: "",
        tocolysis: "",
        induction_of_labour: "",
        blood_transfusion: "",
        key: "",
        token: "",
      },
    };
  },
  computed: {
    computeGestationalAge() {
      let today = new Date();
      let lmp = new Date(this.data.prenatal.last_menstral_period);

      let t1 = lmp.getTime();
      let t2 = today.getTime();
      let diffInDays = Math.floor((t2 - t1) / (24 * 3600 * 1000));
      let weeks = parseInt(diffInDays / 7);
      let days = diffInDays % 7;
      this.weeks = weeks;
      this.days = days;
      this.form.gestational_age = weeks + " weeks " + days + " days";
      this.form.pregnancy_duration = weeks + " weeks";
      return this.form.gestational_age;
    },
  },
  created() {
    this.login();
    this.getPrenatalData();
  },
  methods: {
    login() {
      if (!User.loggedIn()) {
        this.$router.push({
          name: "logout",
        });
      } else {
        this.token = User.token();
        this.key = this.$route.params.key;
        this.form.key = this.$route.params.key;
        this.form.token = User.token();
      }
    },
    getPrenatalData() {
      axios
        .get("/api/v1/prenatal/" + this.key, {
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
    storeFirstPrenatal() {
      this.loading = true;
      axios
        .post("/api/first-prenatal-visit", this.form)
        .then(() => {
          this.$router.push({
            path: `/medical/prenatals/visit/${this.key}`,
          });

          Toast.fire({
            icon: "success",
            title: "Prenatal first visit added successfully",
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
