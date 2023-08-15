<template>
  <div class="main">
    <!-- BEGIN: Mobile Menu -->
    <mobile-menu></mobile-menu>
    <!-- END: Mobile Menu -->
    <div class="flex">
      <!-- BEGIN: Side Menu -->
      <side-menu page="patient"></side-menu>
      <!-- END: Side Menu -->
      <div class="content">
        <!-- BEGIN: Top Bar -->
        <top-bar title="Discharged Patient"></top-bar>
        <!-- END: Top Bar -->
        <div class="grid grid-cols-12 gap-6 mt-4">
          <div class="intro-y col-span-12 xxl:col-span-12">
            <div class="intro-y box">
              <div class="flex flex-col p-5 border-b border-slate-200/60">
                <h2 class="font-medium text-base">
                  Discharged Information of {{ patient.name }}
                </h2>
              </div>
              <div class="p-5">
                <div class="grid grid-cols-12 gap-x-5">
                  <div class="col-span-12 xl:col-span-12 mt-3">
                    <div class="overflow-x-auto">
                      <table class="table">
                        <tbody>
                          <tr>
                            <td>
                              <span class="block uppercase text-xs"
                                >Reason for Admittance</span
                              ><span
                                class="text-lg"
                                v-html="patient.reason_for_admittance"
                              ></span>
                            </td>
                            <td>
                              <span class="block uppercase text-xs">Admitted Date</span
                              ><span class="text-lg">{{
                                patient.admitted_date | moment("Do MMMM YYYY")
                              }}</span>
                            </td>
                            <td>
                              <span class="block uppercase text-xs"
                                >Diagnosis at Admittance</span
                              ><span class="text-lg">{{
                                patient.diagnosis_at_admittance
                              }}</span>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <span class="block uppercase text-xs"
                                >Treatment Summary</span
                              ><span
                                class="text-lg"
                                v-html="patient.treatment_summary"
                              ></span>
                            </td>
                            <td>
                              <span class="block uppercase text-xs">Discharged Date</span
                              ><span class="text-lg">{{
                                patient.date_discharged | moment("Do MMMM YYYY")
                              }}</span>
                            </td>
                            <td>
                              <span class="block uppercase text-xs"
                                >Physician Approved</span
                              ><span class="text-lg">{{
                                patient.physician_approved
                              }}</span>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <span class="block uppercase text-xs"
                                >Reason for Discharged</span
                              ><span class="text-lg">{{
                                patient.reason_for_discharged
                              }}</span>
                            </td>
                            <td>
                              <span class="block uppercase text-xs"
                                >Diagnosis at Discharge</span
                              ><span class="text-lg">{{
                                patient.diagnosis_at_discharge
                              }}</span>
                            </td>
                            <td></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
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
  name: "discharged-patient",
  data() {
    return {
      token: "",
      key: "",
      patient: "",
    };
  },
  created() {
    this.login();
    this.getPatient();
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
    getPatient() {
      axios
        .get("/api/v1/discharged-patient/" + this.key, {
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
              name: "logout",
            });
          }
        });
    },
  },
};
</script>
