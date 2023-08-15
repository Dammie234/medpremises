<template>
  <div class="main">
    <!-- BEGIN: Mobile Menu -->
    <patient-mobile-menu></patient-mobile-menu>
    <!-- END: Mobile Menu -->
    <div class="flex">
      <!-- BEGIN: Side Menu -->
      <patient-side-menu page="profile"></patient-side-menu>
      <!-- END: Side Menu -->
      <!-- BEGIN: Content -->
      <div class="content">
        <!-- BEGIN: Top Bar -->
        <patient-top-bar title="Edit Facility Signature"></patient-top-bar>
        <!-- END: Top Bar -->
        <div class="intro-y flex items-center mt-8">
          <h2 class="text-lg font-medium mr-auto">Facility Setting</h2>
        </div>
        <div class="grid grid-cols-12 gap-6">
          <!-- BEGIN: Profile Menu -->
          <div
            class="col-span-12 lg:col-span-3 xxl:col-span-3 flex lg:block flex-col-reverse"
          >
            <patient-setting page="Facility Setting"></patient-setting>
          </div>
          <!-- END: Profile Menu -->
          <div class="col-span-12 lg:col-span-9 xxl:col-span-9">
            <!-- BEGIN: Personal Information -->
            <div class="intro-y box mt-5">
              <div
                class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5"
              >
                <h2 class="font-medium text-base mr-auto">Profile</h2>
              </div>
              <div class="p-5">
                <div id="faq-accordion-1" class="accordion">
                  <div class="accordion-item">
                    <div id="faq-accordion-content-1" class="accordion-header">
                      <button
                        class="accordion-button"
                        type="button"
                        data-tw-toggle="collapse"
                        data-tw-target="#faq-accordion-collapse-1"
                        aria-expanded="true"
                        aria-controls="faq-accordion-collapse-1"
                      >
                        Biodata
                      </button>
                    </div>
                    <div
                      id="faq-accordion-collapse-1"
                      class="accordion-collapse collapse show"
                      aria-labelledby="faq-accordion-content-1"
                      data-tw-parent="#faq-accordion-1"
                    >
                      <div
                        class="accordion-body text-slate-600 dark:text-slate-500 leading-relaxed"
                      >
                        <div class="overflow-x-auto">
                          <table class="table">
                            <tr>
                              <td><span>Name</span> {{ user.name }}</td>
                              <td><span>Email Address</span>{{ user.email }}</td>
                              <td><span>Role</span>{{ user.role }}</td>
                            </tr>
                            <tr>
                              <td><span>Gender</span> {{ biodata.name }}</td>
                              <td>
                                <span>Date of birth</span
                                >{{ biodata.date_of_birth | moment("DD/MM/YYYY") }}
                              </td>
                              <td>
                                <span>Marital Status</span>{{ biodata.marital_status }}
                              </td>
                              <td><span>Religion</span>{{ biodata.religion }}</td>
                            </tr>
                            <tr>
                              <td><span>Address</span> {{ biodata.address }}</td>
                              <td><span>City</span>{{ biodata.city }}</td>
                              <td><span>State</span>{{ biodata.state }}</td>
                              <td><span>Postal Code</span>{{ biodata.postal_code }}</td>
                            </tr>
                            <tr>
                              <td>
                                <span>Phone (Home)</span>
                                <div v-if="biodata.home_phone">
                                  {{ biodata.home_phone }}
                                </div>
                                <div v-else>-</div>
                              </td>
                              <td>
                                <span>Phone (Work)</span>
                                <div v-if="biodata.work_phone">
                                  {{ biodata.work_phone }}
                                </div>
                                <div v-else>-</div>
                              </td>
                              <td>
                                <span>Phone (Mobile)</span>
                                <div v-if="biodata.mobile_phone">
                                  {{ biodata.mobile_phone }}
                                </div>
                                <div v-else>-</div>
                              </td>
                              <td>
                                <span>Skype Id</span>
                                <div v-if="biodata.skype_id">{{ biodata.skype_id }}</div>
                                <div v-else>-</div>
                              </td>
                            </tr>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="accordion-item">
                    <div id="faq-accordion-content-5" class="accordion-header">
                      <button
                        class="accordion-button collapsed"
                        type="button"
                        data-tw-toggle="collapse"
                        data-tw-target="#faq-accordion-collapse-5"
                        aria-expanded="false"
                        aria-controls="faq-accordion-collapse-5"
                      >
                        Next Of Kin
                      </button>
                    </div>
                    <div
                      id="faq-accordion-collapse-5"
                      class="accordion-collapse collapse"
                      aria-labelledby="faq-accordion-content-4"
                      data-tw-parent="#faq-accordion-1"
                    >
                      <div
                        class="accordion-body text-slate-600 dark:text-slate-500 leading-relaxed"
                      >
                        <div class="overflow-x-auto">
                          <table class="table">
                            <tbody>
                              <tr>
                                <td><span>Name</span>{{ kin.name }}</td>
                                <td><span>Relation</span>{{ kin.relation }}</td>
                                <td><span>Gender</span>{{ kin.gender }}</td>
                                <td><span>Email Address</span>{{ kin.email }}</td>
                              </tr>
                              <tr>
                                <td><span>Address</span>{{ kin.address }}</td>
                                <td><span>City</span>{{ kin.city }}</td>
                                <td><span>State</span>{{ kin.state }}</td>
                                <td><span>Postal Code</span>{{ kin.postal_code }}</td>
                              </tr>
                              <tr>
                                <td><span>Phone (Work)</span>{{ kin.work_phone }}</td>
                                <td><span>Phone (Home)</span>{{ kin.home_phone }}</td>
                                <td><span>Phone (Mobile)</span>{{ kin.mobile_phone }}</td>
                                <td></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div
                    class="accordion-item"
                    v-if="
                      biodata.marital_status == 'Married' &&
                      spouse_information &&
                      spouse_information.acceptance == true
                    "
                  >
                    <div id="faq-accordion-content-6" class="accordion-header">
                      <button
                        class="accordion-button collapsed"
                        type="button"
                        data-tw-toggle="collapse"
                        data-tw-target="#faq-accordion-collapse-6"
                        aria-expanded="false"
                        aria-controls="faq-accordion-collapse-6"
                      >
                        Spouse Information
                      </button>
                    </div>
                    <div
                      id="faq-accordion-collapse-5"
                      class="accordion-collapse collapse"
                      aria-labelledby="faq-accordion-content-4"
                      data-tw-parent="#faq-accordion-1"
                    >
                      <div
                        class="accordion-body text-slate-600 dark:text-slate-500 leading-relaxed"
                      >
                        <div class="overflow-x-auto">
                          <table class="table">
                            <tbody>
                              <tr>
                                <td><span>Name</span>{{ spouse_information.name }}</td>

                                <td>
                                  <span>Gender</span>{{ spouse_information.gender }}
                                </td>
                                <td>
                                  <span>Email Address</span>{{ spouse_information.email }}
                                </td>
                                <td>
                                  <span>Phone Number</span
                                  >{{ spouse_information.phone_number }}
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
            </div>
            <!-- END: Personal Information -->
          </div>
        </div>
      </div>
      <!-- END: Content -->
    </div>
  </div>
</template>

<script>
export default {
  name: "profile",
  data() {
    return {
      id: null,
      token: null,
      biodata: "",
      spouse_information: "",
      user: "",
      kin: "",
    };
  },
  created() {
    this.login();
    this.getBiodata();

    this.getPatient();
    this.getSpouseInformation();
    this.getKin();
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
    getPatient() {
      axios
        .get("/api-patient/v1/patient/" + this.id, {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then((response) => (this.user = response.data))
        .catch((error) => {
          console.log(error);
          if (error.response.status == 401) {
            this.$router.push({
              name: "patient-logout",
            });
          }
        });
    },
    getSpouseInformation() {
      axios
        .get("/api-patient/v1/spouse-information/" + this.id, {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then((response) => (this.spouse_information = response.data))
        .catch((error) => {
          console.log(error);
          if (error.response.status == 401) {
            this.$router.push({
              name: "patient-logout",
            });
          }
        });
    },
    getKin() {
      axios
        .get("/api-patient/v1/patient-next-of-kin/" + this.id, {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then((response) => (this.kin = response.data))
        .catch((error) => {
          console.log(error);
          if (error.response.status == 401) {
            this.$router.push({
              name: "patient-logout",
            });
          }
        });
    },
    getBiodata() {
      axios
        .get("/api-patient/v1/biodata/" + this.id, {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then((response) => (this.biodata = response.data.biodata))
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

<style scoped>
.table tr td span {
  display: block;
  text-transform: uppercase;
  font-size: 12px;
}
</style>
