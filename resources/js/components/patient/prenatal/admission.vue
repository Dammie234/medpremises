<template>
  <div class="main">
    <!-- BEGIN: Mobile Menu -->
    <patient-mobile-menu></patient-mobile-menu>
    <!-- END: Mobile Menu -->
    <div class="flex">
      <!-- BEGIN: Side Menu -->
      <patient-side-menu page="prenatal_admission"></patient-side-menu>
      <!-- END: Side Menu -->
      <!-- BEGIN: Content -->
      <div class="content">
        <!-- BEGIN: Top Bar -->
        <patient-top-bar title="Prenatal Admission Details"></patient-top-bar>
        <!-- END: Top Bar -->

        <div class="grid grid-cols-12 gap-6 mt-4">
          <div class="intro-y col-span-12 xxl:col-span-12">
            <div class="intro-y box">
              <div
                class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60"
              >
                <h2 class="font-medium text-base mr-auto">
                  {{ data.prenatal.name }} Prenatal Admission
                </h2>
                <div class="w-full sm:w-auto sm:ml-auto mt-3 sm:mt-0"></div>
              </div>
              <div class="p-5">
                <div class="grid grid-cols-12 gap-x-5">
                  <div class="col-span-12 xl:col-span-12 mt-3">
                    <div>
                      <div class="overflow-x-auto">
                        <table class="table table-bordered">
                          <tr>
                            <td class="text-medium">
                              <strong class="uppercase block text-xs"
                                >Last Menstral Period</strong
                              >{{
                                data.prenatal.last_menstral_period
                                  | moment("dddd Do MMMM YYYY")
                              }}
                            </td>
                            <td class="text-medium">
                              <strong class="uppercase block text-xs"
                                >Expected/Estimated Due Date</strong
                              >{{
                                data.prenatal.expected_due_date
                                  | moment("dddd Do MMMM YYYY")
                              }}
                            </td>
                            <td class="text-medium">
                              <strong class="uppercase block text-xs"
                                >Gestational Period</strong
                              >{{ data.prenatal.gestational_period }}
                            </td>
                            <td class="text-medium">
                              <strong class="uppercase block text-xs"
                                >Date of Conception</strong
                              >{{
                                data.prenatal.date_of_conception
                                  | moment("dddd Do MMMM YYYY")
                              }}
                            </td>
                          </tr>
                          <tr>
                            <td class="text-medium">
                              <strong class="uppercase block text-xs"
                                >Admitted Date</strong
                              >{{
                                data.prenatal.admitted_date | moment("dddd Do MMMM YYYY")
                              }}
                            </td>
                            <td class="text-medium">
                              <strong class="uppercase block text-xs">Type of Room</strong
                              >{{ data.prenatal.room_type }}
                            </td>
                            <td class="text-medium">
                              <strong class="uppercase block text-xs">Room Number</strong
                              >{{ data.prenatal.room_number }}
                            </td>
                            <td class="text-medium">
                              <strong class="uppercase block text-xs"
                                >Did you attend prenatal?</strong
                              ><span v-if="data.prenatal.prenatal">Attended</span
                              ><span v-else>Didn't Attend</span>
                            </td>
                          </tr>
                          <tr>
                            <td class="text-medium">
                              <strong class="uppercase block text-xs"
                                >Number of Prenatal Visits</strong
                              ><span v-if="data.prenatal.prenatal">{{
                                data.prenatal.prenatal_visits
                              }}</span
                              ><span v-else>0</span>
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
        </div>
        <div class="grid grid-cols-12 gap-6 my-5">
          <div class="intro-y col-span-12 xxl:col-span-12">
            <div class="intro-y box">
              <div
                class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5"
              >
                <h2 class="font-medium text-base mr-auto">
                  Prenatal Admission Signs &amp; Symptoms For {{ data.prenatal.name }}
                </h2>
              </div>
              <div class="overflow-x-auto p-5">
                <table class="table table-bordered">
                  <tr>
                    <td class="text-md">
                      <strong class="uppercase block text-xs"
                        >Vaginal Watery discharge</strong
                      >{{ data.admission.vaginal_watery_discharge }}
                    </td>
                    <td class="text-md">
                      <strong class="uppercase block text-xs">Vaginal Bleeding</strong
                      >{{ data.admission.vaginal_bleeding }}
                    </td>
                    <td class="text-md">
                      <strong class="uppercase block text-xs">Headaches</strong
                      >{{ data.admission.headaches }}
                    </td>
                    <td class="text-md">
                      <strong class="uppercase block text-xs">Vision Changes</strong
                      >{{ data.admission.vision_changes }}
                    </td>
                  </tr>
                  <tr>
                    <td class="text-md">
                      <strong class="uppercase block text-xs"
                        >Right upper quadrant (abdominal) pain</strong
                      >{{ data.admission.abdominal_pain }}
                    </td>
                    <td class="text-md">
                      <strong class="uppercase block text-xs"
                        >Decreased or no fetal movement</strong
                      >{{ data.admission.decreased }}
                    </td>
                    <td class="text-md">
                      <strong class="uppercase block text-xs"
                        >Uterine Contractions </strong
                      >{{ data.admission.uterine_contractions }}
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
                  Spouse Information For {{ data.prenatal.name }}
                </h2>
              </div>
              <div class="overflow-x-auto p-5">
                <table class="table table-bordered">
                  <tr>
                    <td class="text-md">
                      <strong class="uppercase block text-xs">Name</strong
                      >{{ data.spouse.name }}
                    </td>
                    <td class="text-md">
                      <strong class="uppercase block text-xs">Email Address</strong
                      >{{ data.spouse.email }}
                    </td>
                    <td class="text-md">
                      <strong class="uppercase block text-xs">Phone Number</strong
                      >{{ data.spouse.phone_number }}
                    </td>
                    <td class="text-md">
                      <strong class="uppercase block text-xs">Gender</strong
                      >{{ data.spouse.gender }}
                    </td>
                  </tr>
                </table>
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
      id: null,
      token: null,
      data: {},

      patient: "",
    };
  },

  created() {
    this.login();

    this.getPrenatalData();
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
      }
    },

    getPrenatalData() {
      axios
        .get("/api-patient/v1/patient-prenatal-admission/" + this.id, {
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
              name: "patient-logout",
            });
          }
        });
    },
  },
};
</script>

<style scoped></style>
