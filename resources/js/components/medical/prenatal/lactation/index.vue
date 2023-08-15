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
        <top-bar title="Create Lactation Interview"></top-bar>
        <!-- END: Top Bar -->

        <div class="grid grid-cols-12 gap-6 mt-4" v-if="data.check_prenatal_38_39_week">
          <div class="intro-y col-span-12 xxl:col-span-12" v-if="!data.lactation">
            <div class="intro-y box">
              <div
                class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60"
              >
                <h2 class="font-medium text-base mr-auto">
                  Create Lactation Interview for {{ data.prenatal.name }}
                </h2>

                <div class="w-full flex flex-row sm:w-auto sm:ml-auto mt-3 sm:mt-0">
                  <router-link :to="{ name: 'prenatals' }" class="btn btn-primary"
                    >Go Back</router-link
                  >
                </div>
              </div>
              <form class="p-5" @submit.prevent="submit">
                <div class="grid grid-cols-12 gap-6" :disabled="loading">
                  <div class="col-span-12 lg:col-span-4">
                    <label for="date_of_interview" class="form-label"
                      >Date of Interview</label
                    >
                    <input
                      id="date_of_interview"
                      type="date"
                      class="form-control"
                      v-model="form.date_of_interview"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.date_of_interview"
                    >
                      {{ errors.date_of_interview[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 lg:col-span-4">
                    <label for="baby_due_date" class="form-label">Baby Due Date</label>
                    <input
                      id="baby_due_date"
                      type="text"
                      disabled
                      class="form-control"
                      v-model="data.prenatal.expected_due_date"
                    />
                  </div>
                  <div class="col-span-12 xl:col-span-4 pt-4">
                    <div class="flex flex-col sm:flex-row mt-5">
                      <label class="form-label mr-5">Is this your first baby?</label>
                      <div class="form-check mr-2">
                        <input
                          id="radio-switch-4"
                          class="form-check-input"
                          type="radio"
                          name="first_baby"
                          v-model="form.first_baby"
                          value="Yes"
                        />
                        <label class="form-check-label" for="radio-switch-4">Yes</label>
                      </div>
                      <div class="form-check mr-2 mt-2 sm:mt-0">
                        <input
                          id="radio-switch-5"
                          class="form-check-input"
                          type="radio"
                          name="first_baby"
                          v-model="form.first_baby"
                          value="No"
                        />
                        <label class="form-check-label" for="radio-switch-5">No</label>
                      </div>
                    </div>
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.first_baby"
                    >
                      {{ errors.first_baby[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 mt-3">
                    <h3 class="font-medium text-xl">
                      Importance of exclusive Breast Feeding
                    </h3>
                    <p class="mt-1">
                      Protects your baby against many illnesses such as chest infections,
                      diarrhoea, ear infections. Meets all baby's needs for the first 6
                      months, breast milk changes as baby develops. Babies who are not
                      breastfeeding are at higher risk of illness.
                    </p>
                    <h3 class="mt-3 font-medium text-xl">
                      Importance of Breast Feeding to the mother
                    </h3>
                    <p class="mt-1">
                      Protects mothers health long term with decreased risk of breast and
                      ovarian cancer and osteoporosis. Enhances mother's return to
                      pre-pregnant state, delays menstruation.
                    </p>
                    <h3 class="mt-3 font-medium text-xl">
                      Importance of skin-to-skin contact immediately after birth
                    </h3>
                    <p class="mt-1">
                      Calms baby and promotes bonding, helps initiate breast feeding.
                    </p>
                    <p class="mt-1">
                      The baby is kept warm and baby led attachment aids mothers to learn
                      early feeding cues.
                    </p>
                    <h3 class="font-medium text-xl mt-3">
                      Importance of good positioning and attachment
                    </h3>
                    <p class="mt-1">
                      Correct positioning and attachment helps avoid nipple damage,
                      engorgement and promotes maximum milk supply.
                    </p>
                    <h3 class="font-medium text-xl mt-3">
                      No other food or drink needed for the first 6 months <br />
                      Importance of continuing breast feeding after 6 months while giving
                      other foods
                    </h3>
                    <h3 class="font-medium text-xl mt-3">
                      Risks and hazards of not breast feeding
                    </h3>
                    <ul class="mt-1 ml-4">
                      <li>Loss of protection from illness and chronic diseases</li>
                      <li>Difficulty in reversing decision not to breast feed</li>
                      <li>Costs</li>
                      <li>Problems associated with using artificial teats, dummies</li>
                    </ul>
                  </div>
                  <div class="col-span-12 lg:col-span-12 mt-2">
                    <label for="breast_feeding" class="form-label"
                      >What do you know about breast feeding?</label
                    >
                    <input
                      id="breast_feeding"
                      type="text"
                      class="form-control"
                      v-model="form.breast_feeding"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.breast_feeding"
                    >
                      {{ errors.breast_feeding[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 lg:col-span-12 mt-2">
                    <label for="plan_to_feed_baby" class="form-label"
                      >How do you plan to feed your baby?</label
                    >
                    <input
                      id="plan_to_feed_baby"
                      type="text"
                      class="form-control"
                      v-model="form.plan_to_feed_baby"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.plan_to_feed_baby"
                    >
                      {{ errors.plan_to_feed_baby[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 lg:col-span-12 mt-2">
                    <label for="partner_feel_about_decision" class="form-label"
                      >How does your partner feel about your decision?</label
                    >
                    <input
                      id="partner_feel_about_decision"
                      type="text"
                      class="form-control"
                      v-model="form.partner_feel_about_decision"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.partner_feel_about_decision"
                    >
                      {{ errors.partner_feel_about_decision[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 lg:col-span-12 mt-2">
                    <label for="physical_anomalies" class="form-label"
                      >Physical Anomalies (eg: eczema, inversion of nipples, breast
                      reduction or enlargement surgery)</label
                    >
                    <textarea
                      id="physical_anomalies"
                      rows="3"
                      class="form-control"
                      v-model="form.physical_anomalies"
                    ></textarea>
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.physical_anomalies"
                    >
                      {{ errors.physical_anomalies[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 lg:col-span-12 mt-2">
                    <label for="previous_breast_feed_experience" class="form-label"
                      >Previous breast feed experiences/services accessed</label
                    >
                    <input
                      id="previous_breast_feed_experience"
                      type="text"
                      class="form-control"
                      v-model="form.previous_breast_feed_experience"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.previous_breast_feed_experience"
                    >
                      {{ errors.previous_breast_feed_experience[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-12 mt-2">
                    <p class="mb-2 text-md">
                      If you have any concerns you can discuss at booking-in with your
                      midwife and/or request to see the Lactation Consultant.
                    </p>
                    <div class="flex flex-col sm:flex-row mt-2">
                      <label class="mr-2 form-label"
                        >Lactation Consultant Requested</label
                      >
                      <div class="form-check mr-2">
                        <input
                          id="radio-switch-8"
                          class="form-check-input"
                          type="radio"
                          name="cnsultant"
                          v-model="form.lactation_consultant"
                          value="Yes"
                        />
                        <label class="form-check-label" for="radio-switch-8">Yes</label>
                      </div>
                      <div class="form-check mr-2 mt-2 sm:mt-0">
                        <input
                          id="radio-switch-9"
                          class="form-check-input"
                          type="radio"
                          name="consultant"
                          v-model="form.lactation_consultant"
                          value="No"
                        />
                        <label class="form-check-label" for="radio-switch-9">No</label>
                      </div>
                      <div class="form-check mr-2 mt-2 sm:mt-0">
                        <input
                          id="radio-switch-10"
                          class="form-check-input"
                          type="radio"
                          name="consultant"
                          v-model="form.lactation_consultant"
                          value="Declined"
                        />
                        <label class="form-check-label" for="radio-switch-10"
                          >Declined</label
                        >
                      </div>
                    </div>
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.lactation_consultant"
                    >
                      {{ errors.lactation_consultant[0] }}
                    </div>
                  </div>
                  <input type="submit" value="Submit" class="btn btn-primary" />
                  <loading v-if="loading == true"></loading>
                </div>
              </form>
            </div>
          </div>
          <div class="intro-y col-span-12 xxl:col-span-12" v-if="data.lactation">
            <div class="intro-y box">
              <div
                class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60"
              >
                <h2 class="font-medium text-base mr-auto">
                  Edit Lactation Interview of {{ data.prenatal.name }}
                </h2>

                <div class="w-full flex flex-row sm:w-auto sm:ml-auto mt-3 sm:mt-0"></div>
              </div>
              <form class="p-5" @submit.prevent="update">
                <div class="grid grid-cols-12 gap-6" :disabled="loading">
                  <div class="col-span-12 lg:col-span-4">
                    <label for="date_of_interview" class="form-label"
                      >Date of Interview</label
                    >
                    <input
                      id="date_of_interview"
                      type="date"
                      class="form-control"
                      v-model="data.lactation.date_of_interview"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.date_of_interview"
                    >
                      {{ errors.date_of_interview[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 lg:col-span-4">
                    <label for="baby_due_date" class="form-label">Baby Due Date</label>
                    <input
                      id="baby_due_date"
                      type="text"
                      disabled
                      class="form-control"
                      v-model="data.prenatal.expected_due_date"
                    />
                  </div>
                  <div class="col-span-12 xl:col-span-4 pt-4">
                    <div class="flex flex-col sm:flex-row mt-5">
                      <label class="form-label mr-5">Is this your first baby?</label>
                      <div class="form-check mr-2">
                        <input
                          id="radio-switch-4"
                          class="form-check-input"
                          type="radio"
                          name="first_baby"
                          v-model="data.lactation.first_baby"
                          value="Yes"
                        />
                        <label class="form-check-label" for="radio-switch-4">Yes</label>
                      </div>
                      <div class="form-check mr-2 mt-2 sm:mt-0">
                        <input
                          id="radio-switch-5"
                          class="form-check-input"
                          type="radio"
                          name="first_baby"
                          v-model="data.lactation.first_baby"
                          value="No"
                        />
                        <label class="form-check-label" for="radio-switch-5">No</label>
                      </div>
                    </div>
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.first_baby"
                    >
                      {{ errors.first_baby[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 mt-3">
                    <h3 class="font-medium text-xl">
                      Importance of exclusive Breast Feeding
                    </h3>
                    <p class="mt-1">
                      Protects your baby against many illnesses such as chest infections,
                      diarrhoea, ear infections. Meets all baby's needs for the first 6
                      months, breast milk changes as baby develops. Babies who are not
                      breastfeeding are at higher risk of illness.
                    </p>
                    <h3 class="mt-3 font-medium text-xl">
                      Importance of Breast Feeding to the mother
                    </h3>
                    <p class="mt-1">
                      Protects mothers health long term with decreased risk of breast and
                      ovarian cancer and osteoporosis. Enhances mother's return to
                      pre-pregnant state, delays menstruation.
                    </p>
                    <h3 class="mt-3 font-medium text-xl">
                      Importance of skin-to-skin contact immediately after birth
                    </h3>
                    <p class="mt-1">
                      Calms baby and promotes bonding, helps initiate breast feeding.
                    </p>
                    <p class="mt-1">
                      The baby is kept warm and baby led attachment aids mothers to learn
                      early feeding cues.
                    </p>
                    <h3 class="font-medium text-xl mt-3">
                      Importance of good positioning and attachment
                    </h3>
                    <p class="mt-1">
                      Correct positioning and attachment helps avoid nipple damage,
                      engorgement and promotes maximum milk supply.
                    </p>
                    <h3 class="font-medium text-xl mt-3">
                      No other food or drink needed for the first 6 months <br />
                      Importance of continuing breast feeding after 6 months while giving
                      other foods
                    </h3>
                    <h3 class="font-medium text-xl mt-3">
                      Risks and hazards of not breast feeding
                    </h3>
                    <ul class="mt-1 ml-4">
                      <li>Loss of protection from illness and chronic diseases</li>
                      <li>Difficulty in reversing decision not to breast feed</li>
                      <li>Costs</li>
                      <li>Problems associated with using artificial teats, dummies</li>
                    </ul>
                  </div>
                  <div class="col-span-12 lg:col-span-12 mt-2">
                    <label for="breast_feeding" class="form-label"
                      >What do you know about breast feeding?</label
                    >
                    <input
                      id="breast_feeding"
                      type="text"
                      class="form-control"
                      v-model="data.lactation.breast_feeding"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.breast_feeding"
                    >
                      {{ errors.breast_feeding[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 lg:col-span-12 mt-2">
                    <label for="plan_to_feed_baby" class="form-label"
                      >How do you plan to feed your baby?</label
                    >
                    <input
                      id="plan_to_feed_baby"
                      type="text"
                      class="form-control"
                      v-model="data.lactation.plan_to_feed_baby"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.plan_to_feed_baby"
                    >
                      {{ errors.plan_to_feed_baby[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 lg:col-span-12 mt-2">
                    <label for="partner_feel_about_decision" class="form-label"
                      >How does your partner feel about your decision?</label
                    >
                    <input
                      id="partner_feel_about_decision"
                      type="text"
                      class="form-control"
                      v-model="data.lactation.partner_feel_about_decision"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.partner_feel_about_decision"
                    >
                      {{ errors.partner_feel_about_decision[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 lg:col-span-12 mt-2">
                    <label for="physical_anomalies" class="form-label"
                      >Physical Anomalies (eg: eczema, inversion of nipples, breast
                      reduction or enlargement surgery)</label
                    >
                    <textarea
                      id="physical_anomalies"
                      rows="3"
                      class="form-control"
                      v-model="data.lactation.physical_anomalies"
                    ></textarea>
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.physical_anomalies"
                    >
                      {{ errors.physical_anomalies[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 lg:col-span-12 mt-2">
                    <label for="previous_breast_feed_experience" class="form-label"
                      >Previous breast feed experiences/services accessed</label
                    >
                    <input
                      id="previous_breast_feed_experience"
                      type="text"
                      class="form-control"
                      v-model="data.lactation.previous_breast_feed_experience"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.previous_breast_feed_experience"
                    >
                      {{ errors.previous_breast_feed_experience[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-12 mt-2">
                    <p class="mb-2 text-md">
                      If you have any concerns you can discuss at booking-in with your
                      midwife and/or request to see the Lactation Consultant.
                    </p>
                    <div class="flex flex-col sm:flex-row mt-2">
                      <label class="mr-2 form-label"
                        >Lactation Consultant Requested</label
                      >
                      <div class="form-check mr-2">
                        <input
                          id="radio-switch-8"
                          class="form-check-input"
                          type="radio"
                          name="cnsultant"
                          v-model="data.lactation.lactation_consultant"
                          value="Yes"
                        />
                        <label class="form-check-label" for="radio-switch-8">Yes</label>
                      </div>
                      <div class="form-check mr-2 mt-2 sm:mt-0">
                        <input
                          id="radio-switch-9"
                          class="form-check-input"
                          type="radio"
                          name="consultant"
                          v-model="data.lactation.lactation_consultant"
                          value="No"
                        />
                        <label class="form-check-label" for="radio-switch-9">No</label>
                      </div>
                      <div class="form-check mr-2 mt-2 sm:mt-0">
                        <input
                          id="radio-switch-10"
                          class="form-check-input"
                          type="radio"
                          name="consultant"
                          v-model="form.lactation_consultant"
                          value="Declined"
                        />
                        <label class="form-check-label" for="radio-switch-10"
                          >Declined</label
                        >
                      </div>
                    </div>
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.lactation_consultant"
                    >
                      {{ errors.lactation_consultant[0] }}
                    </div>
                  </div>
                  <input type="submit" value="Submit" class="btn btn-primary" />
                  <loading v-if="loading == true"></loading>
                </div>
              </form>
            </div>
          </div>
          <div class="intro-y col-span-12 xxl:col-span-12 mt-5" v-if="data.lactation">
            <div class="intro-y box">
              <div
                class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60"
              >
                <h2 class="font-medium text-base mr-auto">
                  Lactation Interview of {{ data.prenatal.name }}
                </h2>
              </div>
              <div class="w-full flex flex-row sm:w-auto sm:ml-auto mt-3 sm:mt-0">
                <div class="p-5 w-full">
                  <div class="overflow-x-auto">
                    <table class="table table-bordered w-full">
                      <tbody>
                        <tr>
                          <td>
                            <strong class="text-xs uppercase block"
                              >Date of Interview</strong
                            >{{
                              data.lactation.date_of_interview
                                | moment("dddd Do MMMM YYYY")
                            }}
                          </td>
                          <td>
                            <strong class="text-xs uppercase block">Baby Due Date</strong>
                            {{
                              data.lactation.baby_due_date | moment("dddd Do MMMM YYYY")
                            }}
                          </td>

                          <td>
                            <strong class="text-xs block uppercase"
                              >Is this your first baby</strong
                            >{{ data.lactation.first_baby }}
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <strong class="text-xs block uppercase"
                              >What do you Know about breast feeding</strong
                            >{{ data.lactation.breast_feeding }}
                          </td>
                          <td>
                            <strong class="text-xs block uppercase"
                              >How do you plan to feed your baby?</strong
                            >{{ data.lactation.plan_to_feed_baby }}
                          </td>
                          <td>
                            <strong class="text-xs block uppercase"
                              >How doe your partner feel about your decision?</strong
                            >{{ data.lactation_partner_feel_about_decision }}
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <strong class="text-xs block uppercase"
                              >Physical Anomalies</strong
                            >{{ data.lactation.physical_anomalies }}
                          </td>
                          <td>
                            <strong class="text-xs block uppercase"
                              >Previous breast feed experiences/services accessed</strong
                            >{{ data.lactation.previous_breast_feed_experience }}
                          </td>
                          <td>
                            <strong class="text-xs block uppercase"
                              >Lactation Consultant requested</strong
                            >{{ data.lactation.lactation_consultant }}
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
        <div v-else>
          <div
            class="alert alert-outline-danger alert-dismissible show flex items-center mb-2"
            role="alert"
          >
            <i
              data-feather="alert-octagon"
              class="fa fa-exclamation-circle fa-2x mr-2"
            ></i>
            <strong class="mr-2"> Whoops! </strong> Patient must have attended the 38/39
            Prenatal Visit before Lactation Interview
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
      <!-- END: Content -->
    </div>
  </div>
</template>
<script>
export default {
  name: "lactation-interview",
  data() {
    return {
      token: "",
      key: "",
      form: {
        date_of_interview: "",
        baby_due_date: "",
        first_baby: "",
        breast_feeding: "",
        plan_to_feed_baby: "",
        partner_feel_about_decision: "",
        physical_anomalies: "",
        previous_breast_feed_experience: "",
        lactation_consultant: "",
        key: "",
        token: "",
      },
      data: {},
      errors: {},
      loading: false,
    };
  },

  created() {
    this.login();
    this.getPrenatal();
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
    getPrenatal() {
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
        .post("/api/lactation-interview/", this.form)
        .then(() => {
          this.$router.push({
            name: "prenatals",
          });

          Toast.fire({
            icon: "success",
            title: "Lactation Interview added successfully",
          });
        })
        .catch((error) => (this.errors = error.response.data.errors))
        .finally(() => {
          this.loading = false;
        });
    },
    update() {
      this.loading = true;
      axios
        .patch("/api/lactation-interview/" + this.key, this.data.lactation)
        .then(() => {
          this.$router.push({
            name: "prenatals",
          });

          Toast.fire({
            icon: "success",
            title: "Lactation Interview updated successfully",
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
<style scoped>
ul li {
  list-style-type: disc !important;
}
</style>
