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
                  Prenatal First Visit Information of {{ data.prenatal.name }}
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
                    <tr>
                      <td class="text-md">
                        <strong class="uppercase block text-xs">Fetal Heart rate</strong
                        >{{ data.first_visit.fetal_heart_rate }}
                      </td>
                      <td class="text-md">
                        <strong class="uppercase block text-xs">Tocolysis</strong
                        >{{ data.first_visit.tocolysis }}
                      </td>
                      <td class="text-md">
                        <strong class="uppercase block text-xs"
                          >Induction of Labour</strong
                        >{{ data.first_visit.induction_of_labour }}
                      </td>
                      <td class="text-md">
                        <strong class="uppercase block text-xs">Blood Transfusion</strong
                        >{{ data.first_visit.blood_transfusion }}
                      </td>
                      <td class="text-md"></td>
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
