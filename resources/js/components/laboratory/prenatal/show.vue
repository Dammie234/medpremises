<template>
  <div class="main">
    <!-- BEGIN: Mobile Menu -->
    <mobile-menu></mobile-menu>
    <!-- END: Mobile Menu -->
    <div class="flex">
      <!-- BEGIN: Side Menu -->
      <side-menu page="lab"></side-menu>
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
                  Prenatal Information of {{ data.prenatal.name }}
                </h2>

                <div class="w-full flex flex-row sm:w-auto sm:ml-auto mt-3 sm:mt-0">
                  
                </div>
              </div>
              <div class="p-5">
                <div id="faq-accordion-2" class="accordion accordion-boxed">
                  <div class="accordion-item">
                    <div id="faq-accordion-content-5" class="accordion-header">
                      <button
                        class="accordion-button"
                        type="button"
                        data-tw-toggle="collapse"
                        data-tw-target="#faq-accordion-collapse-5"
                        aria-expanded="true"
                        aria-controls="faq-accordion-collapse-5"
                      >
                        Basic Information
                      </button>
                    </div>
                    <div
                      id="faq-accordion-collapse-5"
                      class="accordion-collapse collapse show"
                      aria-labelledby="faq-accordion-content-5"
                      data-tw-parent="#faq-accordion-2"
                    >
                      <div
                        class="accordion-body text-slate-600 dark:text-slate-500 leading-relaxed"
                      >
                        <div class="overflow-x-auto">
                          <table class="table table-bordered">
                            <tbody>
                              <tr>
                                <td class="text-md">
                                  <strong class="uppercase block text-xs"
                                    >Last Menstral Period</strong
                                  >{{
                                    data.prenatal.last_menstral_period
                                      | moment("dddd Do MMMM YYYY")
                                  }}
                                </td>
                                <td class="text-md">
                                  <strong class="uppercase block text-xs"
                                    >Gestational Period</strong
                                  >{{ data.prenatal.gestational_period }}
                                </td>
                                <td class="text-md">
                                  <strong class="uppercase block text-xs"
                                    >Date of Conception</strong
                                  >{{
                                    data.prenatal.date_of_conception
                                      | moment("dddd Do MMMM YYYY")
                                  }}
                                </td>
                                <td class="text-md">
                                  <strong class="uppercase block text-xs"
                                    >Expected/Estimated Due Date</strong
                                  >{{
                                    data.prenatal.expected_due_date
                                      | moment("dddd Do MMMM YYYY")
                                  }}
                                </td>
                                <td class="text-md">
                                  <strong class="uppercase block text-xs"
                                    >Day of Prenatal Visit</strong
                                  >{{ data.prenatal.day_of_prenatal_visit }}
                                </td>
                              </tr>
                              <tr>
                                <td class="text-md">
                                  <strong class="uppercase block text-xs"
                                    >Date of First Prenatal Visit</strong
                                  >{{
                                    data.prenatal.date_of_first_prenatal_visit
                                      | moment("dddd Do MMMM YYYY")
                                  }}
                                </td>
                                <td class="text-md">
                                  <strong class="uppercase block text-xs"
                                    >Type of Last Delivery</strong
                                  ><span v-if="data.prenatal.type_of_last_delivery">{{
                                    data.prenatal.type_of_last_delivery
                                  }}</span
                                  ><span v-else>-</span>
                                </td>
                                <td class="text-md">
                                  <strong class="uppercase block text-xs"
                                    >Date of Last Delivery</strong
                                  ><span v-if="data.prenatal.date_of_last_delivery">{{
                                    data.prenatal.date_of_last_delivery
                                      | moment("dddd Do MMMM YYYY")
                                  }}</span
                                  ><span v-else>-</span>
                                </td>
                                <td class="text-md">
                                  <strong class="uppercase block text-xs"
                                    >expected delivery facility</strong
                                  >{{ data.prenatal.expected_delivery_facility }}
                                </td>
                                <td class="text-md">
                                  <strong class="uppercase block text-xs"
                                    >Pregnancy Type</strong
                                  >{{ data.prenatal.pregnancy_type }}
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="accordion-item">
                    <div id="faq-accordion-content-6" class="accordion-header">
                      <button
                        class="accordion-button collapsed"
                        type="button"
                        data-tw-toggle="collapse"
                        data-tw-target="#faq-accordion-collapse-6"
                        aria-expanded="false"
                        aria-controls="faq-accordion-collapse-6"
                      >
                        Behavioural Risk
                      </button>
                    </div>
                    <div
                      id="faq-accordion-collapse-6"
                      class="accordion-collapse collapse"
                      aria-labelledby="faq-accordion-content-6"
                      data-tw-parent="#faq-accordion-2"
                    >
                      <div
                        class="accordion-body text-slate-600 dark:text-slate-500 leading-relaxed"
                      >
                        <div class="overflow-x-auto">
                          <table class="table table-bordered">
                            <tbody>
                              <tr>
                                <td class="text-md">
                                  <strong class="uppercase block text-xs">Smokes</strong
                                  ><span v-if="data.prenatal.smokes == 1">Yes</span
                                  ><span v-else>No</span>
                                </td>
                                <td class="text-md">
                                  <strong class="uppercase block text-xs"
                                    >Do you smoke less than 2 years since last
                                    pregnancy?</strong
                                  ><span
                                    v-if="data.prenatal.smokes_less_than_2_years == 1"
                                    >Yes</span
                                  ><span v-else>No</span>
                                </td>
                                <td class="text-md">
                                  <strong class="uppercase block text-xs"
                                    >HIV Counseling</strong
                                  ><span v-if="data.prenatal.hiv_counseling == 1"
                                    >Yes</span
                                  ><span v-else>No</span>
                                </td>
                                <td class="text-md">
                                  <strong class="uppercase block text-xs"
                                    >Do you use any substance during pregnancy?</strong
                                  ><span
                                    v-if="data.prenatal.substance_use_in_pregnancy == 1"
                                    >Yes</span
                                  ><span v-else>No</span>
                                </td>
                                <td class="text-md">
                                  <strong class="uppercase block text-xs"
                                    >Check if patient is an Adolescent</strong
                                  ><span v-if="data.prenatal.adolescent == 1">Yes</span
                                  ><span v-else>No</span>
                                </td>
                              </tr>
                              <tr>
                                <td class="text-md">
                                  <strong class="uppercase block text-xs"
                                    >Check if patient has inadequate finances</strong
                                  ><span v-if="data.prenatal.inadequate_finances == 1"
                                    >Yes</span
                                  ><span v-else>No</span>
                                </td>
                                <td class="text-md">
                                  <strong class="uppercase block text-xs"
                                    >Check if patient doesn't have a house she
                                    lives</strong
                                  ><span v-if="data.prenatal.inadequate_housing == 1"
                                    >Yes</span
                                  ><span v-else>No</span>
                                </td>
                                <td class="text-md">
                                  <strong class="uppercase block text-xs"
                                    >Check if patient need a social support</strong
                                  ><span
                                    v-if="data.prenatal.inadequate_social_supports == 1"
                                    >Yes</span
                                  ><span v-else>No</span>
                                </td>
                                <td class="text-md">
                                  <strong class="uppercase block text-xs"
                                    >Check if patient has less than secondary school
                                    education</strong
                                  ><span
                                    v-if="
                                      data.prenatal.less_than_high_school_education == 1
                                    "
                                    >Yes</span
                                  ><span v-else>No</span>
                                </td>
                                <td class="text-md">
                                  <strong class="uppercase block text-xs"
                                    >Check if patient has poor nutrition</strong
                                  ><span v-if="data.prenatal.poor_nutrition == 1"
                                    >Yes</span
                                  ><span v-else>No</span>
                                </td>
                              </tr>
                              <tr>
                                <td class="text-md">
                                  <strong class="uppercase block text-xs"
                                    >Check if patient has a psychiatric history</strong
                                  ><span v-if="data.prenatal.psychiatric_history == 1"
                                    >Yes</span
                                  ><span v-else>No</span>
                                </td>
                                <td class="text-md">
                                  <strong class="uppercase block text-xs"
                                    >Check if patient has a significant learning
                                    disabilities</strong
                                  ><span
                                    v-if="
                                      data.prenatal.significant_learning_disabilities == 1
                                    "
                                    >Yes</span
                                  ><span v-else>No</span>
                                </td>
                                <td class="text-md">
                                  <strong class="uppercase block text-xs"
                                    >Check if patient is violent/abusive</strong
                                  ><span v-if="data.prenatal.violence == 1">Yes</span
                                  ><span v-else>No</span>
                                </td>
                                <td></td>
                                <td></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="accordion-item">
                    <div id="faq-accordion-content-7" class="accordion-header">
                      <button
                        class="accordion-button collapsed"
                        type="button"
                        data-tw-toggle="collapse"
                        data-tw-target="#faq-accordion-collapse-7"
                        aria-expanded="false"
                        aria-controls="faq-accordion-collapse-7"
                      >
                        Medical Risk
                      </button>
                    </div>
                    <div
                      id="faq-accordion-collapse-7"
                      class="accordion-collapse collapse"
                      aria-labelledby="faq-accordion-content-7"
                      data-tw-parent="#faq-accordion-2"
                    >
                      <div
                        class="accordion-body text-slate-600 dark:text-slate-500 leading-relaxed"
                      >
                        <div class="overflow-x-auto">
                          <table class="table table-bordered">
                            <tr>
                              <td class="text-md">
                                <strong class="uppercase block text-xs"
                                  >Cardiac Disease</strong
                                ><span v-if="data.prenatal.cardiac_diseases == 1"
                                  >Yes</span
                                ><span v-else>No</span>
                              </td>
                              <td class="text-md">
                                <strong class="uppercase block text-xs">Diabetes</strong
                                ><span v-if="data.prenatal.diabetes == 1">Yes</span
                                ><span v-else>No</span>
                              </td>
                              <td class="text-md">
                                <strong class="uppercase block text-xs"
                                  >Endocrine Disorders</strong
                                ><span v-if="data.prenatal.endocrine_disorders == 1"
                                  >Yes</span
                                ><span v-else>No</span>
                              </td>
                              <td class="text-md">
                                <strong class="uppercase block text-xs"
                                  >GastroIntestinal Disorders</strong
                                ><span v-if="data.prenatal.gi_disorders == 1">Yes</span
                                ><span v-else>No</span>
                              </td>
                              <td class="text-md">
                                <strong class="uppercase block text-xs"
                                  >Hyperthyroid</strong
                                ><span v-if="data.prenatal.hyperthyroid == 1">Yes</span
                                ><span v-else>No</span>
                              </td>
                            </tr>
                            <tr>
                              <td class="text-md">
                                <strong class="uppercase block text-xs"
                                  >Hypothyroid</strong
                                ><span v-if="data.prenatal.hypothyroid == 1">Yes</span
                                ><span v-else>No</span>
                              </td>
                              <td class="text-md">
                                <strong class="uppercase block text-xs">Malignancy</strong
                                ><span v-if="data.prenatal.malignancy == 1">Yes</span
                                ><span v-else>No</span>
                              </td>
                              <td class="text-md">
                                <strong class="uppercase block text-xs"
                                  >Moderate or severe asthma</strong
                                ><span v-if="data.prenatal.moderate_asthma == 1">Yes</span
                                ><span v-else>No</span>
                              </td>
                              <td class="text-md">
                                <strong class="uppercase block text-xs"
                                  >Renal disease/history of urinary tract
                                  infections</strong
                                ><span v-if="data.prenatal.renal_disease == 1">Yes</span
                                ><span v-else>No</span>
                              </td>
                              <td class="text-md">
                                <strong class="uppercase block text-xs"
                                  >Seizure disorders</strong
                                ><span v-if="data.prenatal.seizure_disorders == 1"
                                  >Yes</span
                                ><span v-else>No</span>
                              </td>
                            </tr>
                            <tr>
                              <td class="text-md">
                                <strong class="uppercase block text-xs"
                                  >Sickle Cell Diseases</strong
                                ><span v-if="data.prenatal.sickle_cell_diseases == 1"
                                  >Yes</span
                                ><span v-else>No</span>
                              </td>
                              <td class="text-md">
                                <strong class="uppercase block text-xs"
                                  >Moderate or severe asthma</strong
                                ><span v-if="data.prenatal.moderate_asthma == 1">Yes</span
                                ><span v-else>No</span>
                              </td>
                              <td></td>
                              <td></td>
                              <td></td>
                            </tr>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="accordion-item">
                    <div id="faq-accordion-content-8" class="accordion-header">
                      <button
                        class="accordion-button collapsed"
                        type="button"
                        data-tw-toggle="collapse"
                        data-tw-target="#faq-accordion-collapse-8"
                        aria-expanded="false"
                        aria-controls="faq-accordion-collapse-8"
                      >
                        Obstetric Risks
                      </button>
                    </div>
                    <div
                      id="faq-accordion-collapse-8"
                      class="accordion-collapse collapse"
                      aria-labelledby="faq-accordion-content-8"
                      data-tw-parent="#faq-accordion-2"
                    >
                      <div
                        class="accordion-body text-slate-600 dark:text-slate-500 leading-relaxed"
                      >
                        <div class="overflow-x-auto">
                          <table class="table table-bordered">
                            <tr>
                              <td class="text-md">
                                <strong class="uppercase block text-xs"
                                  >Abnormal pap smear</strong
                                ><span v-if="data.prenatal.abnormal_pap_smear == 1"
                                  >Yes</span
                                ><span v-else>No</span>
                              </td>
                              <td class="text-md">
                                <strong class="uppercase block text-xs">Anemia</strong
                                ><span v-if="data.prenatal.anemia == 1">Yes</span
                                ><span v-else>No</span>
                              </td>
                              <td class="text-md">
                                <strong class="uppercase block text-xs">BMI > 30</strong
                                ><span v-if="data.prenatal.bmi == 1">Yes</span
                                ><span v-else>No</span>
                              </td>
                              <td class="text-md">
                                <strong class="uppercase block text-xs"
                                  >gestational diabetes</strong
                                ><span v-if="data.prenatal.gestational_diabetes == 1"
                                  >Yes</span
                                ><span v-else>No</span>
                              </td>
                              <td class="text-md">
                                <strong class="uppercase block text-xs"
                                  >History of cervical uterine infections</strong
                                ><span
                                  v-if="data.prenatal.cervical_uterine_infections == 1"
                                  >Yes</span
                                ><span v-else>No</span>
                              </td>
                            </tr>
                            <tr>
                              <td class="text-md">
                                <strong class="uppercase block text-xs"
                                  >History of infant with birth injury, neurological
                                  defect or congenial abnormality</strong
                                ><span v-if="data.prenatal.neurological_defect == 1"
                                  >Yes</span
                                ><span v-else>No</span>
                              </td>
                              <td class="text-md">
                                <strong class="uppercase block text-xs"
                                  >History of infertility</strong
                                ><span v-if="data.prenatal.history_of_infertility == 1"
                                  >Yes</span
                                ><span v-else>No</span>
                              </td>
                              <td class="text-md">
                                <strong class="uppercase block text-xs"
                                  >Inadequate prenatal care</strong
                                ><span v-if="data.prenatal.inadequate_prenatal_care == 1"
                                  >Yes</span
                                ><span v-else>No</span>
                              </td>
                              <td class="text-md">
                                <strong class="uppercase block text-xs"
                                  >History low birth weight infant</strong
                                ><span
                                  v-if="data.prenatal.history_of_low_birth_weight == 1"
                                  >Yes</span
                                ><span v-else>No</span>
                              </td>
                              <td class="text-md">
                                <strong class="uppercase block text-xs"
                                  >Incompetent cervix</strong
                                ><span v-if="data.prenatal.incompetent_cervix == 1"
                                  >Yes</span
                                ><span v-else>No</span>
                              </td>
                            </tr>
                            <tr>
                              <td class="text-md">
                                <strong class="uppercase block text-xs"
                                  >Intrauterine growth retardation (IUGR)</strong
                                ><span
                                  v-if="
                                    data.prenatal.intrauterine_growth_retardation == 1
                                  "
                                  >Yes</span
                                ><span v-else>No</span>
                              </td>
                              <td class="text-md">
                                <strong class="uppercase block text-xs"
                                  >Placenta Previa/Placenta Abruptia</strong
                                ><span v-if="data.prenatal.placenta_previa == 1">Yes</span
                                ><span v-else>No</span>
                              </td>
                              <td class="text-md">
                                <strong class="uppercase block text-xs"
                                  >Polyhydramnios/oligohydramnios</strong
                                ><span v-if="data.prenatal.polyhydramnios == 1">Yes</span
                                ><span v-else>No</span>
                              </td>
                              <td class="text-md">
                                <strong class="uppercase block text-xs"
                                  >Poor weight gain</strong
                                ><span v-if="data.prenatal.poor_weight_gain == 1"
                                  >Yes</span
                                ><span v-else>No</span>
                              </td>
                              <td class="text-md">
                                <strong class="uppercase block text-xs"
                                  >Postpartum depression—family history</strong
                                ><span
                                  v-if="data.prenatal.postpartum_depression_family == 1"
                                  >Yes</span
                                ><span v-else>No</span>
                              </td>
                            </tr>
                            <tr>
                              <td class="text-md">
                                <strong class="uppercase block text-xs"
                                  >Postpartum depression—family personal history</strong
                                ><span
                                  v-if="data.prenatal.postpartum_depression_personal == 1"
                                  >Yes</span
                                ><span v-else>No</span>
                              </td>
                              <td class="text-md">
                                <strong class="uppercase block text-xs"
                                  >Pregnancy-induced hypertension</strong
                                ><span
                                  v-if="data.prenatal.pregnancy_induced_hypertension == 1"
                                  >Yes</span
                                ><span v-else>No</span>
                              </td>
                              <td class="text-md">
                                <strong class="uppercase block text-xs"
                                  >Pre-pregnancy weight of less than 100 pounds</strong
                                ><span v-if="data.prenatal.pre_pregnant_weight == 1"
                                  >Yes</span
                                ><span v-else>No</span>
                              </td>
                              <td class="text-md">
                                <strong class="uppercase block text-xs"
                                  >Previous pre-term labour (PTL)</strong
                                ><span v-if="data.prenatal.previous_pre_term_labour == 1"
                                  >Yes</span
                                ><span v-else>No</span>
                              </td>
                              <td class="text-md">
                                <strong class="uppercase block text-xs"
                                  >Previous pre-term delivery (PTD)</strong
                                ><span
                                  v-if="data.prenatal.previous_pre_term_delivery == 1"
                                  >Yes</span
                                ><span v-else>No</span>
                              </td>
                            </tr>
                            <tr>
                              <td class="text-md">
                                <strong class="uppercase block text-xs"
                                  >Previous stillborn/neonatal death</strong
                                ><span v-if="data.prenatal.previous_stillborn == 1"
                                  >Yes</span
                                ><span v-else>No</span>
                              </td>
                              <td class="text-md">
                                <strong class="uppercase block text-xs"
                                  >Multiple gestation</strong
                                ><span v-if="data.prenatal.multiple_gestation == 1"
                                  >Yes</span
                                ><span v-else>No</span>
                              </td>
                              <td class="text-md">
                                <strong class="uppercase block text-xs"
                                  >Rh sensitization</strong
                                ><span v-if="data.prenatal.rh_sensitization == 1"
                                  >Yes</span
                                ><span v-else>No</span>
                              </td>
                              <td class="text-md">
                                <strong class="uppercase block text-xs"
                                  >Sexually Transmitted Disease</strong
                                ><span
                                  v-if="data.prenatal.sexually_transmitted_disease == 1"
                                  >Yes</span
                                ><span v-else>No</span>
                              </td>
                              <td class="text-md">
                                <strong class="uppercase block text-xs"
                                  >2 or more spontaneous abortions (SABs) or therapeutic
                                  abortions (TABs)</strong
                                ><span v-if="data.prenatal.therapeutics_abortion == 1"
                                  >Yes</span
                                ><span v-else>No</span>
                              </td>
                            </tr>
                            <tr>
                              <td class="text-md">
                                <strong class="uppercase block text-xs"
                                  >Uterine/cervical anomaly</strong
                                ><span v-if="data.prenatal.uterine_anomally == 1"
                                  >Yes</span
                                ><span v-else>No</span>
                              </td>
                              <td class="text-md">
                                <strong class="uppercase block text-xs"
                                  >Number of Pregnancy</strong
                                ><span v-if="data.prenatal.number_of_pregnancy == 1"
                                  >Yes</span
                                ><span v-else>No</span>
                              </td>
                              <td class="text-md">
                                <strong class="uppercase block text-xs"
                                  >Number of Previous Deliveries</strong
                                ><span
                                  v-if="data.prenatal.number_of_previous_deliveries == 1"
                                  >Yes</span
                                ><span v-else>No</span>
                              </td>
                              <td class="text-md">
                                <strong class="uppercase block text-xs"
                                  >Number of Surviving children</strong
                                ><span
                                  v-if="data.prenatal.number_of_surviving_children == 1"
                                  >Yes</span
                                ><span v-else>No</span>
                              </td>
                              <td class="text-md">
                                <strong class="uppercase block text-xs"
                                  >Number of Caesarian Sections</strong
                                ><span
                                  v-if="data.prenatal.number_of_caesarian_sections == 1"
                                  >Yes</span
                                ><span v-else>No</span>
                              </td>
                            </tr>
                            <tr>
                              <td class="text-md">
                                <strong class="uppercase block text-xs"
                                  >Pack Volume Cells</strong
                                >{{ data.prenatal.pack_volume_cells }}
                              </td>
                              <td class="text-md">
                                <strong class="uppercase block text-xs"
                                  >Pregnancy Scan</strong
                                ><span v-if="data.prenatal.pregnancy_scan == 1">Yes</span
                                ><span v-else>No</span>
                              </td>
                              <td class="text-md">
                                <strong class="uppercase block text-xs">Primp scan</strong
                                ><span v-if="data.prenatal.primp_scan == 1">Yes</span
                                ><span v-else>No</span>
                              </td>
                              <td></td>
                              <td></td>
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
