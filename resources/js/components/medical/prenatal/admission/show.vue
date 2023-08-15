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
        <top-bar title="Edit Prenatal"></top-bar>
        <!-- END: Top Bar -->
        <div class="grid grid-cols-12 gap-6">
          <div class="intro-y col-span-12 xxl:col-span-12">
            <div class="intro-y box">
              <div
                class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5"
              >
                <h2 class="font-medium text-base mr-auto">
                  Edit Prenatal Admission for {{ prenatal.name }}
                </h2>
                <router-link :to="{ name: 'prenatal-admissions' }" class="btn btn-primary"
                  >Go Back</router-link
                >
              </div>
              <div class="overflow-x-auto p-5">
                <table class="table table-bordered">
                  <tr>
                    <td class="text-medium">
                      <strong class="uppercase block text-xs">Last Menstral Period</strong
                      >{{ prenatal.last_menstral_period | moment("dddd Do MMMM YYYY") }}
                    </td>
                    <td class="text-medium">
                      <strong class="uppercase block text-xs"
                        >Expected/Estimated Due Date</strong
                      >{{ prenatal.expected_due_date | moment("dddd Do MMMM YYYY") }}
                    </td>
                    <td class="text-medium">
                      <strong class="uppercase block text-xs">Gestational Period</strong
                      >{{ prenatal.gestational_period }}
                    </td>
                    <td class="text-medium">
                      <strong class="uppercase block text-xs">Date of Conception</strong
                      >{{ prenatal.date_of_conception | moment("dddd Do MMMM YYYY") }}
                    </td>
                  </tr>
                  <tr>
                    <td class="text-medium">
                      <strong class="uppercase block text-xs">Admitted Date</strong
                      >{{ prenatal.admitted_date | moment("dddd Do MMMM YYYY") }}
                    </td>
                    <td class="text-medium">
                      <strong class="uppercase block text-xs">Type of Room</strong
                      >{{ prenatal.room_type }}
                    </td>
                    <td class="text-medium">
                      <strong class="uppercase block text-xs">Room Number</strong
                      >{{ prenatal.room_number }}
                    </td>
                    <td class="text-medium">
                      <strong class="uppercase block text-xs"
                        >Did you attend prenatal?</strong
                      ><span v-if="prenatal.prenatal">Attended</span
                      ><span v-else>Didn't Attend</span>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-medium">
                      <strong class="uppercase block text-xs"
                        >Number of Prenatal Visits</strong
                      ><span v-if="prenatal.prenatal">{{ prenatal.prenatal_visits }}</span
                      ><span v-else>0</span>
                    </td>
                    <td class="text-medium">
                      <strong class="uppercase block text">Pregnant not in labour</strong
                      >{{ prenatal.pregnant_not_in_labour }}
                    </td>
                    <td class="text-medium">
                      <strong class="uppercase block text">Pregnant in labour</strong
                      >{{ prenatal.pregnant_in_labour }}
                    </td>
                    <td class="text-medium">
                      <strong class="uppercase block text">Postpartum</strong
                      >{{ prenatal.postpartum }}
                      <span v-if="prenatal.postpartum == 'Yes'">{{
                        prenatal.postpartum_days
                      }}</span>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-medium">
                      <strong class="uppercase block text"
                        >Post-abortion, miscarriage</strong
                      >{{ prenatal.post_abortion }}
                    </td>
                    <td class="text-medium">
                      <strong class="uppercase block text">Number of fetuses</strong
                      >{{ prenatal.number_of_fetuses }}
                    </td>
                    <td class="text-medium">
                      <strong class="uppercase block text">Fetal Heart Rate</strong
                      >{{ prenatal.fetal_heart_rate }}
                    </td>
                    <td></td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
        </div>

        <div class="grid grid-cols-12 gap-6 my-5">
          <div class="intro-y col-span-12 xxl:col-span-12">
            <div class="intro-y box">
              <div
                class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5"
              >
                <h2 class="font-medium text-base mr-auto">
                  Prenatal Admission Signs &amp; Symptoms For {{ prenatal.name }}
                </h2>
              </div>
              <div class="overflow-x-auto p-5">
                <table class="table table-bordered">
                  <tr>
                    <td class="text-md">
                      <strong class="uppercase block text-xs"
                        >Vaginal Watery discharge</strong
                      >{{ admission.vaginal_watery_discharge }}
                    </td>
                    <td class="text-md">
                      <strong class="uppercase block text-xs">Vaginal Bleeding</strong
                      >{{ admission.vaginal_bleeding }}
                    </td>
                    <td class="text-md">
                      <strong class="uppercase block text-xs">Headaches</strong
                      >{{ admission.headaches }}
                    </td>
                    <td class="text-md">
                      <strong class="uppercase block text-xs">Vision Changes</strong
                      >{{ admission.vision_changes }}
                    </td>
                  </tr>
                  <tr>
                    <td class="text-md">
                      <strong class="uppercase block text-xs"
                        >Right upper quadrant (abdominal) pain</strong
                      >{{ admission.abdominal_pain }}
                    </td>
                    <td class="text-md">
                      <strong class="uppercase block text-xs"
                        >Decreased or no fetal movement</strong
                      >{{ admission.decreased }}
                    </td>
                    <td class="text-md">
                      <strong class="uppercase block text-xs"
                        >Uterine Contractions </strong
                      >{{ admission.uterine_contractions }}
                    </td>
                    <td></td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
        </div>

        <div class="grid grid-cols-12 gap-6 my-5">
          <div class="intro-y col-span-12 xxl:col-span-12">
            <div class="intro-y box">
              <div
                class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5"
              >
                <h2 class="font-medium text-base mr-auto">
                  Spouse Information For {{ prenatal.name }}
                </h2>
              </div>
              <div class="overflow-x-auto p-5">
                <table class="table table-bordered">
                  <tr>
                    <td class="text-md">
                      <strong class="uppercase block text-xs">Name</strong
                      >{{ spouse.name }}
                    </td>
                    <td class="text-md">
                      <strong class="uppercase block text-xs">Email Address</strong
                      >{{ spouse.email }}
                    </td>
                    <td class="text-md">
                      <strong class="uppercase block text-xs">Phone Number</strong
                      >{{ spouse.phone_number }}
                    </td>
                    <td class="text-md">
                      <strong class="uppercase block text-xs">Gender</strong
                      >{{ spouse.gender }}
                    </td>
                  </tr>
                </table>
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
  name: "prenatal-admission",
  data() {
    return {
      token: "",
      key: "",
      prenatal: "",
      spouse: "",
      admission: "",

      errors: {},
    };
  },
  created() {
    this.login();
    this.getPrenatalAdmission();
    this.getPrenatalAdmissionSign();
    this.getSpouseInformation();
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

    getPrenatalAdmission() {
      axios
        .get("/api/v1/prenatal-admission/" + this.key, {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then((response) => (this.prenatal = response.data))
        .catch((error) => {
          console.log(error);
          if (error.response.status == 401) {
            this.$router.push({
              name: "logout",
            });
          }
        });
    },

    getPrenatalAdmissionSign() {
      axios
        .get("/api/v1/prenatal-admission-sign/" + this.key, {
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
    getSpouseInformation() {
      axios
        .get("/api/v1/admission-spouse-information/" + this.key, {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then((response) => (this.spouse = response.data))
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
.border-top {
  border-top: 1px solid #aaa;
}
.mt-4 {
  margin-top: 0.8rem;
}
.form-check-label {
  font-weight: 400;
}
</style>
