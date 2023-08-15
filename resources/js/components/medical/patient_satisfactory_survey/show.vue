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
        <top-bar title="Patient Satisfactory Survey"></top-bar>
        <!-- END: Top Bar -->

        <div class="grid grid-cols-12 gap-6 mt-4">
          <div class="intro-y col-span-12 xxl:col-span-12">
            <div class="intro-y box">
              <div
                class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60"
              >
                <h2 class="font-medium text-base mr-auto">
                  Patient Satisfactory Survey for {{ survey.name }}
                </h2>
                <div class="w-full sm:w-auto sm:ml-auto mt-3 sm:mt-0"></div>
              </div>
              <div class="p-5">
                <div class="grid grid-cols-12 gap-x-5">
                  <div class="col-span-12 xl:col-span-12 mt-3">
                    <h4 class="font-medium text-lg">Patient Satisfactory Details</h4>
                    <h5 class="font-medium text-md">
                      What can we do to improve your experience?
                    </h5>
                    <p>{{ survey.experience }}</p>
                    <h5 class="mt-4 font-medium text-md">
                      Why choose {{ survey.registered_facility_name }}
                    </h5>
                    <p>{{ survey.why_choose_us }}</p>
                    <h5 class="mt-4 font-medium text-md">
                      Was this your first time at {{ survey.registered_facility_name }}
                    </h5>
                    <p>{{ survey.first_time }}</p>
                    <h5 class="mt-4 font-medium text-md">What impressed you most?</h5>
                    <p>{{ survey.impressed }}</p>
                    <h5 class="mt-4 font-medium text-md">
                      Any exceptional staff member?
                    </h5>
                    <p>{{ survey.exceptional_staff }}</p>
                    <h3 class="font-medium text-lg mt-4">Overall Rating</h3>
                    <table class="table">
                      <thead>
                        <tr>
                          <th></th>
                          <th>Excellent</th>
                          <th>Good</th>
                          <th>Fair</th>
                          <th>Poor</th>
                          <th>Very poor</th>
                          <th>Does not apply</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                            {{ survey.registered_facility_name }}
                          </td>
                          <td>
                            <span
                              v-if="survey.hospital_name == 'Excellent'"
                              class="p-3 rounded text-white bg-excellent"
                              ><i class="fa fa-check"></i
                            ></span>
                          </td>
                          <td>
                            <span
                              v-if="survey.hospital_name == 'Good'"
                              class="p-3 rounded text-white bg-good"
                              ><i class="fa fa-check"></i
                            ></span>
                          </td>
                          <td>
                            <span
                              v-if="survey.hospital_name == 'Fair'"
                              class="p-3 rounded text-white bg-fair"
                              ><i class="fa fa-check"></i
                            ></span>
                          </td>
                          <td>
                            <span
                              v-if="survey.hospital_name == 'Poor'"
                              class="p-3 rounded text-white bg-poor"
                              ><i class="fa fa-check"></i
                            ></span>
                          </td>
                          <td>
                            <span
                              v-if="survey.hospital_name == 'Very Poor'"
                              class="p-3 rounded text-white bg-very-poor"
                              ><i class="fa fa-check"></i
                            ></span>
                          </td>
                          <td>
                            <span
                              v-if="survey.hospital_name == 'Does not apply'"
                              class="p-3 rounded text-white bg-very-poor"
                              ><i class="fa fa-times"></i
                            ></span>
                          </td>
                        </tr>
                        <tr>
                          <td>Nursing Care</td>
                          <td>
                            <span
                              v-if="survey.nursing_care == 'Excellent'"
                              class="p-3 rounded text-white bg-excellent"
                              ><i class="fa fa-check"></i
                            ></span>
                          </td>
                          <td>
                            <span
                              v-if="survey.nursing_care == 'Good'"
                              class="p-3 rounded text-white bg-good"
                              ><i class="fa fa-check"></i
                            ></span>
                          </td>
                          <td>
                            <span
                              v-if="survey.nursing_care == 'Fair'"
                              class="p-3 rounded text-white bg-fair"
                              ><i class="fa fa-check"></i
                            ></span>
                          </td>
                          <td>
                            <span
                              v-if="survey.nursing_care == 'Poor'"
                              class="p-3 rounded text-white bg-poor"
                              ><i class="fa fa-check"></i
                            ></span>
                          </td>
                          <td>
                            <span
                              v-if="survey.nursing_care == 'Very Poor'"
                              class="p-3 rounded text-white bg-very-poor"
                              ><i class="fa fa-check"></i
                            ></span>
                          </td>
                          <td>
                            <span
                              v-if="survey.nursing_care == 'Does not apply'"
                              class="p-3 rounded text-white bg-very-poor"
                              ><i class="fa fa-times"></i
                            ></span>
                          </td>
                        </tr>
                        <tr>
                          <td>Medical Officer/Doctor care</td>
                          <td>
                            <span
                              v-if="survey.medical_officer_care == 'Excellent'"
                              class="p-3 rounded text-white bg-excellent"
                              ><i class="fa fa-check"></i
                            ></span>
                          </td>
                          <td>
                            <span
                              v-if="survey.medical_officer_care == 'Good'"
                              class="p-3 rounded text-white bg-good"
                              ><i class="fa fa-check"></i
                            ></span>
                          </td>
                          <td>
                            <span
                              v-if="survey.medical_officer_care == 'Fair'"
                              class="p-3 rounded text-white bg-fair"
                              ><i class="fa fa-check"></i
                            ></span>
                          </td>
                          <td>
                            <span
                              v-if="survey.medical_officer_care == 'Poor'"
                              class="p-3 rounded text-white bg-poor"
                              ><i class="fa fa-check"></i
                            ></span>
                          </td>
                          <td>
                            <span
                              v-if="survey.medical_officer_care == 'Very Poor'"
                              class="p-3 rounded text-white bg-very-poor"
                              ><i class="fa fa-check"></i
                            ></span>
                          </td>
                          <td>
                            <span
                              v-if="survey.medical_officer_care == 'Does not apply'"
                              class="p-3 rounded text-white bg-very-poor"
                              ><i class="fa fa-times"></i
                            ></span>
                          </td>
                        </tr>
                        <tr>
                          <td>Clerical/Receptionist</td>
                          <td>
                            <span
                              v-if="survey.clerical_staff == 'Excellent'"
                              class="p-3 rounded text-white bg-excellent"
                              ><i class="fa fa-check"></i
                            ></span>
                          </td>
                          <td>
                            <span
                              v-if="survey.clerical_staff == 'Good'"
                              class="p-3 rounded text-white bg-good"
                              ><i class="fa fa-check"></i
                            ></span>
                          </td>
                          <td>
                            <span
                              v-if="survey.clerical_staff == 'Fair'"
                              class="p-3 rounded text-white bg-fair"
                              ><i class="fa fa-check"></i
                            ></span>
                          </td>
                          <td>
                            <span
                              v-if="survey.clerical_staff == 'Poor'"
                              class="p-3 rounded text-white bg-poor"
                              ><i class="fa fa-check"></i
                            ></span>
                          </td>
                          <td>
                            <span
                              v-if="survey.clerical_staff == 'Very Poor'"
                              class="p-3 rounded text-white bg-very-poor"
                              ><i class="fa fa-check"></i
                            ></span>
                          </td>
                          <td>
                            <span
                              v-if="survey.clerical_staff == 'Does not apply'"
                              class="p-3 rounded text-white bg-very-poor"
                              ><i class="fa fa-times"></i
                            ></span>
                          </td>
                        </tr>
                        <tr>
                          <td>Food services</td>
                          <td>
                            <span
                              v-if="survey.food_services == 'Excellent'"
                              class="p-3 rounded text-white bg-excellent"
                              ><i class="fa fa-check"></i
                            ></span>
                          </td>
                          <td>
                            <span
                              v-if="survey.food_services == 'Good'"
                              class="p-3 rounded text-white bg-good"
                              ><i class="fa fa-check"></i
                            ></span>
                          </td>
                          <td>
                            <span
                              v-if="survey.food_services == 'Fair'"
                              class="p-3 rounded text-white bg-fair"
                              ><i class="fa fa-check"></i
                            ></span>
                          </td>
                          <td>
                            <span
                              v-if="survey.food_services == 'Poor'"
                              class="p-3 rounded text-white bg-poor"
                              ><i class="fa fa-check"></i
                            ></span>
                          </td>
                          <td>
                            <span
                              v-if="survey.food_services == 'Very Poor'"
                              class="p-3 rounded text-white bg-very-poor"
                              ><i class="fa fa-check"></i
                            ></span>
                          </td>
                          <td>
                            <span
                              v-if="survey.food_services == 'Does not apply'"
                              class="p-3 rounded text-white bg-very-poor"
                              ><i class="fa fa-times"></i
                            ></span>
                          </td>
                        </tr>
                        <tr>
                          <td>Cleanliness</td>
                          <td>
                            <span
                              v-if="survey.cleanliness == 'Excellent'"
                              class="p-3 rounded text-white bg-excellent"
                              ><i class="fa fa-check"></i
                            ></span>
                          </td>
                          <td>
                            <span
                              v-if="survey.cleanliness == 'Good'"
                              class="p-3 rounded text-white bg-good"
                              ><i class="fa fa-check"></i
                            ></span>
                          </td>
                          <td>
                            <span
                              v-if="survey.cleanliness == 'Fair'"
                              class="p-3 rounded text-white bg-fair"
                              ><i class="fa fa-check"></i
                            ></span>
                          </td>
                          <td>
                            <span
                              v-if="survey.cleanliness == 'Poor'"
                              class="p-3 rounded text-white bg-poor"
                              ><i class="fa fa-check"></i
                            ></span>
                          </td>
                          <td>
                            <span
                              v-if="survey.cleanliness == 'Very Poor'"
                              class="p-3 rounded text-white bg-very-poor"
                              ><i class="fa fa-check"></i
                            ></span>
                          </td>
                          <td>
                            <span
                              v-if="survey.cleanliness == 'Does not apply'"
                              class="p-3 rounded text-white bg-very-poor"
                              ><i class="fa fa-times"></i
                            ></span>
                          </td>
                        </tr>
                        <tr>
                          <td>Staff courtesy</td>
                          <td>
                            <span
                              v-if="survey.staff_courtesy == 'Excellent'"
                              class="p-3 rounded text-white bg-excellent"
                              ><i class="fa fa-check"></i
                            ></span>
                          </td>
                          <td>
                            <span
                              v-if="survey.staff_courtesy == 'Good'"
                              class="p-3 rounded text-white bg-good"
                              ><i class="fa fa-check"></i
                            ></span>
                          </td>
                          <td>
                            <span
                              v-if="survey.staff_courtesy == 'Fair'"
                              class="p-3 rounded text-white bg-fair"
                              ><i class="fa fa-check"></i
                            ></span>
                          </td>
                          <td>
                            <span
                              v-if="survey.staff_courtesy == 'Poor'"
                              class="p-3 rounded text-white bg-poor"
                              ><i class="fa fa-check"></i
                            ></span>
                          </td>
                          <td>
                            <span
                              v-if="survey.staff_courtesy == 'Very Poor'"
                              class="p-3 rounded text-white bg-very-poor"
                              ><i class="fa fa-check"></i
                            ></span>
                          </td>
                          <td>
                            <span
                              v-if="survey.staff_courtesy == 'Does not apply'"
                              class="p-3 rounded text-white bg-very-poor"
                              ><i class="fa fa-times"></i
                            ></span>
                          </td>
                        </tr>
                        <tr>
                          <td>Discharge process</td>
                          <td>
                            <span
                              v-if="survey.discharge_process == 'Excellent'"
                              class="p-3 rounded text-white bg-excellent"
                              ><i class="fa fa-check"></i
                            ></span>
                          </td>
                          <td>
                            <span
                              v-if="survey.discharge_process == 'Good'"
                              class="p-3 rounded text-white bg-good"
                              ><i class="fa fa-check"></i
                            ></span>
                          </td>
                          <td>
                            <span
                              v-if="survey.discharge_process == 'Fair'"
                              class="p-3 rounded text-white bg-fair"
                              ><i class="fa fa-check"></i
                            ></span>
                          </td>
                          <td>
                            <span
                              v-if="survey.discharge_process == 'Poor'"
                              class="p-3 rounded text-white bg-poor"
                              ><i class="fa fa-check"></i
                            ></span>
                          </td>
                          <td>
                            <span
                              v-if="survey.discharge_process == 'Very Poor'"
                              class="p-3 rounded text-white bg-very-poor"
                              ><i class="fa fa-check"></i
                            ></span>
                          </td>
                          <td>
                            <span
                              v-if="survey.discharge_process == 'Does not apply'"
                              class="p-3 rounded text-white bg-very-poor"
                              ><i class="fa fa-times"></i
                            ></span>
                          </td>
                        </tr>
                        <tr>
                          <td>Facilities &amp; accomodation</td>
                          <td>
                            <span
                              v-if="survey.facilities_and_accomodation == 'Excellent'"
                              class="p-3 rounded text-white bg-excellent"
                              ><i class="fa fa-check"></i
                            ></span>
                          </td>
                          <td>
                            <span
                              v-if="survey.facilities_and_accomodation == 'Good'"
                              class="p-3 rounded text-white bg-good"
                              ><i class="fa fa-check"></i
                            ></span>
                          </td>
                          <td>
                            <span
                              v-if="survey.facilities_and_accomodation == 'Fair'"
                              class="p-3 rounded text-white bg-fair"
                              ><i class="fa fa-check"></i
                            ></span>
                          </td>
                          <td>
                            <span
                              v-if="survey.facilities_and_accomodation == 'Poor'"
                              class="p-3 rounded text-white bg-poor"
                              ><i class="fa fa-check"></i
                            ></span>
                          </td>
                          <td>
                            <span
                              v-if="survey.facilities_and_accomodation == 'Very Poor'"
                              class="p-3 rounded text-white bg-very-poor"
                              ><i class="fa fa-check"></i
                            ></span>
                          </td>
                          <td>
                            <span
                              v-if="
                                survey.facilities_and_accomodation == 'Does not apply'
                              "
                              class="p-3 rounded text-white bg-very-poor"
                              ><i class="fa fa-times"></i
                            ></span>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <table class="table mt-3">
                      <thead>
                        <tr>
                          <th></th>
                          <th>Yes</th>
                          <th>To some extent</th>
                          <th>No</th>
                          <th>Does not apply</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                            During your admission were your cultural and/or special needs
                            met?
                          </td>
                          <td>
                            <span
                              v-if="survey.special_needs == 'Good'"
                              class="p-3 rounded text-white bg-good"
                              ><i class="fa fa-check"></i
                            ></span>
                          </td>
                          <td>
                            <span
                              v-if="survey.special_needs == 'Fair'"
                              class="p-3 rounded text-white bg-fair"
                              ><i class="fa fa-check"></i
                            ></span>
                          </td>
                          <td>
                            <span
                              v-if="survey.special_needs == 'Poor'"
                              class="p-3 rounded text-white bg-poor"
                              ><i class="fa fa-check"></i
                            ></span>
                          </td>
                          <td>
                            <span
                              v-if="survey.special_needs == 'Does not apply'"
                              class="p-3 rounded text-white bg-very-poor"
                              ><i class="fa fa-times"></i
                            ></span>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <table class="table mt-3">
                      <thead>
                        <tr>
                          <th></th>
                          <th>Extremely Likely</th>
                          <th>9</th>
                          <th>8</th>
                          <th>7</th>
                          <th>6</th>
                          <th>5</th>
                          <th>4</th>
                          <th>3</th>
                          <th>2</th>
                          <th>1</th>
                          <th>Not Likely</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                            <h5 class="font-medium text-md">
                              How likely are you to return to
                              {{ survey.registered_facility_name }} for your medical care?
                            </h5>
                          </td>
                          <td>
                            <span v-if="survey.return_for_medical_care == '10'"
                              ><i class="fa fa-check"></i
                            ></span>
                          </td>
                          <td>
                            <span v-if="survey.return_for_medical_care == '9'"
                              ><i class="fa fa-check"></i
                            ></span>
                          </td>
                          <td>
                            <span v-if="survey.return_for_medical_care == '8'"
                              ><i class="fa fa-check"></i
                            ></span>
                          </td>
                          <td>
                            <span v-if="survey.return_for_medical_care == '7'"
                              ><i class="fa fa-check"></i
                            ></span>
                          </td>
                          <td>
                            <span v-if="survey.return_for_medical_care == '6'"
                              ><i class="fa fa-check"></i
                            ></span>
                          </td>
                          <td>
                            <span v-if="survey.return_for_medical_care == '5'"
                              ><i class="fa fa-check"></i
                            ></span>
                          </td>
                          <td>
                            <span v-if="survey.return_for_medical_care == '4'"
                              ><i class="fa fa-check"></i
                            ></span>
                          </td>
                          <td>
                            <span v-if="survey.return_for_medical_care == '3'"
                              ><i class="fa fa-check"></i
                            ></span>
                          </td>
                          <td>
                            <span v-if="survey.return_for_medical_care == '2'"
                              ><i class="fa fa-check"></i
                            ></span>
                          </td>
                          <td>
                            <span v-if="survey.return_for_medical_care == '1'"
                              ><i class="fa fa-check"></i
                            ></span>
                          </td>
                          <td>
                            <span v-if="survey.return_for_medical_care == '0'"
                              ><i class="fa fa-check"></i
                            ></span>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <h5 class="mt-4 font-medium text-md">
                      Why would you return to
                      {{ survey.registered_facility_name }} for medical care
                    </h5>
                    <p>{{ survey.why_return_for_medical_care }}</p>
                    <table class="table mt-3">
                      <thead>
                        <tr>
                          <th></th>
                          <th>Extremely Likely</th>
                          <th>9</th>
                          <th>8</th>
                          <th>7</th>
                          <th>6</th>
                          <th>5</th>
                          <th>4</th>
                          <th>3</th>
                          <th>2</th>
                          <th>1</th>
                          <th>Not Likely</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                            <h5 class="font-medium text-md">
                              How likely are you to recommend this hospital to your
                              friends and relatives?
                            </h5>
                          </td>
                          <td>
                            <span v-if="survey.recommend_facility == '10'"
                              ><i class="fa fa-check"></i
                            ></span>
                          </td>
                          <td>
                            <span v-if="survey.recommend_facility == '9'"
                              ><i class="fa fa-check"></i
                            ></span>
                          </td>
                          <td>
                            <span v-if="survey.recommend_facility == '8'"
                              ><i class="fa fa-check"></i
                            ></span>
                          </td>
                          <td>
                            <span v-if="survey.recommend_facility == '7'"
                              ><i class="fa fa-check"></i
                            ></span>
                          </td>
                          <td>
                            <span v-if="survey.recommend_facility == '6'"
                              ><i class="fa fa-check"></i
                            ></span>
                          </td>
                          <td>
                            <span v-if="survey.recommend_facility == '5'"
                              ><i class="fa fa-check"></i
                            ></span>
                          </td>
                          <td>
                            <span v-if="survey.recommend_facility == '4'"
                              ><i class="fa fa-check"></i
                            ></span>
                          </td>
                          <td>
                            <span v-if="survey.recommend_facility == '3'"
                              ><i class="fa fa-check"></i
                            ></span>
                          </td>
                          <td>
                            <span v-if="survey.recommend_facility == '2'"
                              ><i class="fa fa-check"></i
                            ></span>
                          </td>
                          <td>
                            <span v-if="survey.recommend_facility == '1'"
                              ><i class="fa fa-check"></i
                            ></span>
                          </td>
                          <td>
                            <span v-if="survey.recommend_facility == '0'"
                              ><i class="fa fa-check"></i
                            ></span>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <h5 class="mt-4 font-medium text-md">
                      Why would you recommend
                      {{ survey.registered_facility_name }} to friends and family
                    </h5>
                    <p>{{ survey.why_recommend_facility }}</p>
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
  name: "patient-satisfactory-survey",
  data() {
    return {
      id: null,
      token: null,
      survey: "",
      key: "",
    };
  },

  created() {
    this.login();
    this.getSurvey();
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
      }
    },

    getSurvey() {
      axios
        .get("/api/v1/patient-satisfactory-survey/" + this.key, {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then((response) => (this.survey = response.data))
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

<style scoped>
.bg-excellent {
  background-color: rgb(20 83 45);
}
.bg-good {
  background-color: rgb(21 128 61);
}
.bg-fair {
  background-color: rgb(233, 133, 36);
}
.bg-poor {
  background-color: rgb(227, 67, 33);
}
.bg-very-poor {
  background-color: rgb(178, 29, 36);
}
</style>
