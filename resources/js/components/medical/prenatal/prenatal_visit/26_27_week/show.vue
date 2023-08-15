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
                    26/27 Week Prenatal Visit Information for {{ data.prenatal.name }}
                  </h2>
  
                  <div class="w-full flex flex-row sm:w-auto sm:ml-auto mt-3 sm:mt-0">
                    <router-link
                      :to="{ name: 'prenatal-visit', params: { key: key } }"
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
                          >{{ data.prenatal_26_27_week.blood_pressure }}
                        </td>
                        <td class="text-md">
                          <strong class="uppercase block text-xs">Tummy Measurement</strong
                          >{{ data.prenatal_26_27_week.tummy_measurement }}
                        </td>
                        <td class="text-md">
                            <strong class="uppercase block text-xs">Health Status</strong
                            >{{ data.prenatal_26_27_week.health_status }}
                          </td>
                          <td class="text-md">
                            <strong class="uppercase block text-xs">Gestational Age</strong
                            >{{ data.prenatal_26_27_week.gestational_age }}
                          </td>
                      </tr>
                      <tr>
                        
  
                       
                        <td class="text-md">
                          <strong class="uppercase block text-xs"
                            >Haemogloblin Result</strong
                          >{{ data.prenatal_26_27_week.haemoglobin_result }}
                        </td>
                        <td class="text-md">
                          <strong class="uppercase block text-xs">Antenatal Risk</strong
                          >{{ data.prenatal_26_27_week.antenatal_risk }}
                        </td>
                        <td class="text-md">
                          <strong class="uppercase block text-xs">Fetal Heart rate</strong
                          >{{ data.prenatal_26_27_week.fetal_heart_rate }}
                        </td>
                        <td class="text-md">
                          <strong class="uppercase block text-xs">Tocolysis</strong
                          >{{ data.prenatal_26_27_week.tocolysis }}
                        </td>
                      </tr>
                      <tr>
                        
                        <td class="text-md">
                          <strong class="uppercase block text-xs"
                            >Induction of Labour</strong
                          >{{ data.prenatal_26_27_week.induction_of_labour }}
                        </td>
                        <td class="text-md">
                          <strong class="uppercase block text-xs">Blood Transfusion</strong
                          >{{ data.prenatal_26_27_week.blood_transfusion }}
                        </td>
                        <td class="text-md"></td>
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
    name: "prenatal-26-27-week",
    data() {
      return {
        token: "",
        key: "",
        data: {},
      };
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
    },
  };
  </script>
  