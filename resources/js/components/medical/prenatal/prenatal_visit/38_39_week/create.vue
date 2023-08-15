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
                  <h2 class="font-medium text-base mr-auto">
                    Create 38/39 week Prenantal/Antenatal Visit for {{ data.prenatal.name }}
                  </h2>
  
                  <div class="w-full flex flex-row sm:w-auto sm:ml-auto mt-2 sm:mt-0">
                    <router-link
                      :to="{ name: 'prenatal-visit', params: { key: key } }"
                      class="btn btn-primary"
                      >Go Back</router-link
                    >
                  </div>
                </div>
                <div class="p-5">
                  <form class="grid grid-cols-12 gap-6" @submit.prevent="submit">
                    <div class="col-span-12 xl:col-span-4 mt-2">
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
                    <div class="col-span-12 xl:col-span-4 mt-2">
                      <label for="tummy_measurement" class="form-label"
                        >Tummy Measurement</label
                      >
                      <input
                        id="height"
                        type="text"
                        class="form-control"
                        v-model="form.tummy_measurement"
                      />
                      <div
                        class="text-danger font-medium text-xs mt-1"
                        v-if="errors.tummy_measurement"
                      >
                        {{ errors.tummy_measurement[0] }}
                      </div>
                    </div>
                    
  
                    <div class="col-span-12 xl:col-span-4 mt-2">
                      <label for="gestational_age" class="form-label"
                        >Gestational Age
                      </label>
                      <input
                        id="gestational_age"
                        type="text"
                        disabled
                        class="form-control"
                        :value="computeGestationalAge"
                      />
                      <div
                        class="text-danger font-medium text-xs mt-1"
                        v-if="errors.gestational_age"
                      >
                        {{ errors.gestational_age[0] }}
                      </div>
                    </div>
                    <div class="col-span-12 xl:col-span-6 mt-2">
                        <label for="baby_heartbeat" class="form-label"
                          >Baby Heartbeat</label
                        >
                        <textarea
                          id="baby_heartbeat"
                          rows="5"
                          class="form-control"
                          v-model="form.baby_heartbeat"
                        ></textarea>
                        <div
                          class="text-danger font-medium text-xs mt-1"
                          v-if="errors.baby_heartbeat"
                        >
                          {{ errors.baby_heartbeat[0] }}
                        </div>
                      </div>
                    <div class="col-span-12 xl:col-span-6 mt-2">
                      <label for="cervical_screening" class="form-label"
                        >Health Status</label
                      >
                      <textarea
                        id="health_status"
                        rows="5"
                        class="form-control"
                        v-model="form.health_status"
                      ></textarea>
                      <div
                        class="text-danger font-medium text-xs mt-1"
                        v-if="errors.health_status"
                      >
                        {{ errors.health_status[0] }}
                      </div>
                    </div>
  
                    <div class="col-span-12 xl:col-span-6 mt-2">
                      <label for="haemoglobin_result" class="form-label"
                        >Haemogloblin Result</label
                      >
                      <input
                        id="haemoglobin_result"
                        type="text"
                        class="form-control"
                        v-model="form.haemoglobin_result"
                      />
                      <div
                        class="text-danger font-medium text-xs mt-1"
                        v-if="errors.haemoglobin_result"
                      >
                        {{ errors.haemoglobin_result[0] }}
                      </div>
                    </div>
                    <div class="col-span-12 xl:col-span-6 mt-2">
                      <label for="antenatal_risk" class="form-label"
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
                      <button type="submit" class="btn btn-primary w-20 mt-2">Save</button>
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
    name: "create-prenatal-38-39-week",
    data() {
      return {
        token: "",
        key: "",
        data: {},
        form: {
          key: "",
          blood_pressure: "",
          tummy_measurement: "",
          baby_heartbeat: '',
          health_status: "",
          gestational_age: "",
          haemoglobin_result: "",
          antenatal_risk: "",
          fetal_heart_rate: "",
        tocolysis: "",
        induction_of_labour: "",
        blood_transfusion: "",
          token: "",
        },
        errors: {},
        loading: false,
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
  
        let gestational_age = weeks + " weeks " + days + " days";
        this.form.gestational_age = weeks + " weeks " + days + " days";
        return gestational_age;
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
          this.form.token = User.token();
          this.form.key = this.$route.params.key;
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
  
      submit() {
        this.loading = true;
        axios
          .post("/api/prenatal-38-39-week/", this.form)
          .then(() => {
            this.$router.push({
              path: `/medical/prenatals/visit/${this.key}`,
            });
  
            Toast.fire({
              icon: "success",
              title: "Prenatal 38/39 week added successfully",
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
  