<template>
  <div class="main">
    <!-- BEGIN: Mobile Menu -->
    <patient-mobile-menu></patient-mobile-menu>
    <!-- END: Mobile Menu -->
    <div class="flex">
      <!-- BEGIN: Side Menu -->
      <patient-side-menu page="prenatal"></patient-side-menu>
      <!-- END: Side Menu -->
      <!-- BEGIN: Content -->
      <div class="content">
        <!-- BEGIN: Top Bar -->
        <patient-top-bar title="Prenatal Visits"></patient-top-bar>
        <!-- END: Top Bar -->

        <div class="grid grid-cols-12 gap-6 mt-4">
          <div class="intro-y col-span-12 xxl:col-span-12">
            <div class="intro-y box">
              <div
                class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60"
              >
                <div class="w-full lg:w-1/2">
                  <h2 class="font-medium text-base mr-auto">
                    Prenatal Visits for {{ patient.name }}
                  </h2>
                </div>

                <div class="w-full flex flex-row sm:w-auto sm:ml-auto mt-3 sm:mt-0">
                  <router-link
                    :to="{ name: 'patient-prenatal-visits', params: { key: key } }"
                    class="btn btn-primary"
                    >Go Back</router-link
                  >
                </div>
              </div>
              <div class="p-5">
                <div class="overflow-x-auto">
                  <table class="table table-bordered">
                    <tr>
                      <td class="text-md">
                        <strong class="uppercase block text-xs"
                          >Pregnancy Duration in weeks</strong
                        >{{ data.first_visit.pregnancy_duration }}
                      </td>
                      <td class="text-md">
                        <strong class="uppercase block text-xs">Blood Pressure</strong
                        >{{ data.first_visit.blood_pressure }}
                      </td>
                      <td class="text-md">
                        <strong class="uppercase block text-xs">Height</strong
                        >{{ data.first_visit.height }}
                      </td>
                      <td class="text-md">
                        <strong class="uppercase block text-xs">Weight</strong
                        >{{ data.first_visit.weight }}
                      </td>
                      <td class="text-md">
                        <strong class="uppercase block text-xs"
                          >Screening for Down Syndrome</strong
                        >{{ data.first_visit.screening_for_down_syndrome }}
                      </td>
                    </tr>
                    <tr>
                      <td class="text-md">
                        <strong class="uppercase block text-xs">Cervical Screening</strong
                        >{{ data.first_visit.cervical_screening }}
                      </td>
                      <td class="text-md">
                        <strong class="uppercase block text-xs">Ungoing Medication</strong
                        ><span v-if="data.first_visit.ungoing_medication">Yes</span
                        ><span v-else>No</span>
                      </td>
                      <td class="text-md">
                        <strong class="uppercase block text-xs"
                          >Type of ungoing medication</strong
                        ><span v-if="data.first_visit.ungoing_medication == 1">{{
                          data.first_visit.type_of_ungoing_medication
                        }}</span
                        ><span v-else>-</span>
                      </td>
                      <td class="text-md">
                        <strong class="uppercase block text-xs">Gestational Age</strong
                        >{{ data.first_visit.gestational_age }}
                      </td>
                      <td class="text-md">
                        <strong class="uppercase block text-xs"
                          >Haemogloblin Result</strong
                        >{{ data.first_visit.haemogloblin_result }}
                      </td>
                    </tr>
                    <tr>
                      <td class="text-md">
                        <strong class="uppercase block text-xs">Antenatal Risk</strong
                        >{{ data.first_visit.antenatal_risk }}
                      </td>
                      <td class="text-md">
                        <strong class="uppercase block text-xs">Smoking</strong
                        ><span v-if="data.first_visit.smoking">Yes</span
                        ><span v-else>No</span>
                      </td>
                      <td class="text-md">
                        <strong class="uppercase block text-xs">Smoking Quantity</strong
                        ><span v-if="data.first_visit.smoking == 1">{{
                          data.first_visit.smoking_qty
                        }}</span
                        ><span v-else>-</span>
                      </td>
                      <td class="text-md">
                        <strong class="uppercase block text-xs">Alcohol</strong
                        ><span v-if="data.first_visit.alcohol">Yes</span
                        ><span v-else>No</span>
                      </td>
                      <td class="text-md">
                        <strong class="uppercase block text-xs">Alcohol Quantity</strong
                        ><span v-if="data.first_visit.alcohol == 1">{{
                          data.first_visit.alcohol_qty
                        }}</span
                        ><span v-else>-</span>
                      </td>
                    </tr>
                  </table>
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
  name: "prenatal",
  data() {
    return {
      token: "",
      key: "",
      data: {},
      weeks: "",
      days: "",
      patient: "",
    };
  },

  created() {
    this.login();
    this.getPrenatalData();
    this.getPatient();
  },
  methods: {
    login() {
      if (!Patient.loggedIn()) {
        this.$router.push({
          name: "patient-logout",
        });
      } else {
        this.id = Patient.id();
        this.token = Patient.token();
        this.key = this.$route.params.key;
      }
    },
    getPatient() {
      axios
        .get("/api-patient/v1/patient-id/" + this.id, {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then((response) => (this.patient = response.data))
        .catch((error) => {
          console.log(error);
          if (error.response.status == 401) {
            this.$router.push({
              name: "patient-logout",
            });
          }
        });
    },
    getPrenatalData() {
      axios
        .get("/api-patient/v1/patient-prenatal/" + this.id, {
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
  },
};
</script>
<style scoped>
ul {
  list-style: disc;
}
</style>
