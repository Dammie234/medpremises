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
                      38/39 Week Prenatal Visit Information for {{ patient.name }}
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
                                <strong class="uppercase block text-xs">Blood Pressure</strong
                                >{{ data.prenatal_38_39_week.blood_pressure }}
                              </td>
                              <td class="text-md">
                                <strong class="uppercase block text-xs">Tummy Measurement</strong
                                >{{ data.prenatal_38_39_week.tummy_measurement }}
                              </td>
                              <td class="text-md">
                                  <strong class="uppercase block text-xs">Baby Heartbeat</strong
                                  >{{ data.prenatal_38_39_week.baby_heartbeat }}
                                </td>
                              <td class="text-md">
                                  <strong class="uppercase block text-xs">Health Status</strong
                                  >{{ data.prenatal_38_39_week.health_status }}
                                </td>
                            </tr>
                            <tr>
                              
        
                              <td class="text-md">
                                <strong class="uppercase block text-xs">Gestational Age</strong
                                >{{ data.prenatal_38_39_week.gestational_age }}
                              </td>
                              <td class="text-md">
                                <strong class="uppercase block text-xs"
                                  >Haemogloblin Result</strong
                                >{{ data.prenatal_38_39_week.haemoglobin_result }}
                              </td>
                              <td class="text-md">
                                <strong class="uppercase block text-xs">Antenatal Risk</strong
                                >{{ data.prenatal_38_39_week.antenatal_risk }}
                              </td>
                              <td></td>
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
        patient: "",
        days: "",
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
  