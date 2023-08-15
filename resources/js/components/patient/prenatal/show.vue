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
        <patient-top-bar title="Prenatal Details"></patient-top-bar>
        <!-- END: Top Bar -->

        <div class="grid grid-cols-12 gap-6 mt-4">
          <div class="intro-y col-span-12 xxl:col-span-12">
            <div class="intro-y box">
              <div
                class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60"
              >
                <h2 class="font-medium text-base mr-auto">
                  {{ patient.name }} Prenatal Details
                </h2>
                <div class="w-full sm:w-auto sm:ml-auto mt-3 sm:mt-0">
                  <router-link class="btn btn-primary" :to="{ name: 'patient-prenatals' }"
                    >Go Back</router-link
                  >
                </div>
              </div>
              <div class="p-5">
                <div class="grid grid-cols-12 gap-x-5">
                  <div class="col-span-12 xl:col-span-12 mt-3">
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
                          data-tw-parent="#faq-accordion-5"
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
                          data-tw-parent="#faq-accordion-6"
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
                                        >Do you Smoke?</strong
                                      >{{ data.behavioural_risk.smokes }}
                                    </td>
                                    <td class="text-md">
                                      <strong class="uppercase block text-xs"
                                        >How many cigarretes per day?</strong
                                      ><span
                                        v-if="data.behavioural_risk.smoke_qty_per_day"
                                        >{{
                                          data.behavioural_risk.smoke_qty_per_day
                                        }}</span
                                      ><span v-else>-</span>
                                    </td>
                                    <td class="text-md">
                                      <strong class="uppercase block text-xs"
                                        >If ceased smoking, when?</strong
                                      ><span
                                        v-if="data.behavioural_risk.ceased_smoking"
                                        >{{ data.behavioural_risk.ceased_smoking }}</span
                                      ><span v-else>-</span>
                                    </td>
                                    <td class="text-md">
                                      <strong class="uppercase block text-xs"
                                        >Substance use</strong
                                      ><span v-if="data.behavioural_risk.substance_use">{{
                                        data.behavioural_risk.substance_use
                                      }}</span
                                      ><span v-else>-</span>
                                    </td>
                                    <td class="text-md">
                                      <strong class="uppercase block text-xs"
                                        >Does your spouse smoke?</strong
                                      >{{ data.behavioural_risk.spouse_smoke }}
                                    </td>
                                  </tr>
                                  <tr>
                                    <td class="text-md">
                                      <strong class="uppercase block text-xs"
                                        >Was QUIT information discussed?</strong
                                      ><span
                                        v-if="
                                          data.behavioural_risk.quit_information == 'Yes'
                                        "
                                        >Yes</span
                                      ><span
                                        v-else-if="
                                          data.behavioural_risk.quit_information == 'No'
                                        "
                                        >No</span
                                      >
                                      <span v-else>-</span>
                                    </td>
                                    <td class="text-md">
                                      <strong class="uppercase block text-xs"
                                        >Alcohol consumption</strong
                                      >{{ data.behavioural_risk.alcohol }}
                                    </td>
                                    <td class="text-md">
                                      <strong class="uppercase block text-xs"
                                        >How many bottles per week?</strong
                                      ><span
                                        v-if="data.behavioural_risk.alcohol_qty_per_week"
                                        >{{
                                          data.behavioural_risk.alcohol_qty_per_week
                                        }}</span
                                      ><span v-else>-</span>
                                    </td>
                                    <td class="text-md">
                                      <strong class="uppercase block text-xs"
                                        >Current rubella immunisation</strong
                                      >{{
                                        data.behavioural_risk.current_rubella_immunisation
                                      }}
                                    </td>
                                    <td class="text-md">
                                      <strong class="uppercase block text-xs"
                                        >Current rubella immunisation level</strong
                                      ><span
                                        v-if="
                                          data.behavioural_risk
                                            .current_rubella_immunisation_level
                                        "
                                        >{{
                                          data.behavioural_risk
                                            .current_rubella_immunisation_level
                                        }}</span
                                      ><span v-else>-</span>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="accordion-item">
                        <div id="faq-accordion-content-20" class="accordion-header">
                          <button
                            class="accordion-button collapsed"
                            type="button"
                            data-tw-toggle="collapse"
                            data-tw-target="#faq-accordion-collapse-20"
                            aria-expanded="false"
                            aria-controls="faq-accordion-collapse-20"
                          >
                            Psychological Risks
                          </button>
                        </div>
                        <div
                          id="faq-accordion-collapse-7"
                          class="accordion-collapse collapse"
                          aria-labelledby="faq-accordion-content-20"
                          data-tw-parent="#faq-accordion-20"
                        >
                          <div
                            class="accordion-body text-slate-600 dark:text-slate-500 leading-relaxed"
                          >
                            <div class="overflow-x-auto">
                              <table class="table table-bordered">
                                <tr>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Adolescent</strong
                                    ><span v-if="data.psychological_risk.adolescent == 1"
                                      >Yes</span
                                    ><span v-else>No</span>
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Inadequate finances</strong
                                    ><span
                                      v-if="
                                        data.psychological_risk.inadequate_finances == 1
                                      "
                                      >Yes</span
                                    ><span v-else>No</span>
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Inadequate housing</strong
                                    ><span
                                      v-if="
                                        data.psychological_risk.inadequate_housing == 1
                                      "
                                      >Yes</span
                                    ><span v-else>No</span>
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Social support</strong
                                    ><span
                                      v-if="
                                        data.psychological_risk
                                          .inadequate_social_supports == 1
                                      "
                                      >Yes</span
                                    ><span v-else>No</span>
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Less than secondary school education</strong
                                    ><span
                                      v-if="
                                        data.psychological_risk
                                          .less_than_high_school_education == 1
                                      "
                                      >Yes</span
                                    ><span v-else>No</span>
                                  </td>
                                </tr>
                                <tr>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >poor nutrition</strong
                                    ><span
                                      v-if="data.psychological_risk.poor_nutrition == 1"
                                      >Yes</span
                                    ><span v-else>No</span>
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Psychiatric history</strong
                                    ><span
                                      v-if="
                                        data.psychological_risk.psychiatric_history == 1
                                      "
                                      >Yes</span
                                    ><span v-else>No</span>
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Moderate or severe asthma</strong
                                    ><span v-if="data.prenatal.moderate_asthma == 1"
                                      >Yes</span
                                    ><span v-else>No</span>
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Significant Learning disabilities</strong
                                    ><span
                                      v-if="
                                        data.psychological_risk
                                          .significant_learning_disabilities == 1
                                      "
                                      >Yes</span
                                    ><span v-else>No</span>
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Violent/abusive</strong
                                    ><span v-if="data.psychological_risk.violence == 1"
                                      >Yes</span
                                    ><span v-else>No</span>
                                  </td>
                                </tr>
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
                          data-tw-parent="#faq-accordion-7"
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
                                    ><span v-if="data.medical_risk.cardiac_diseases == 1"
                                      >Yes</span
                                    ><span v-else>No</span>
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Diabetes</strong
                                    ><span v-if="data.medical_risk.diabetes == 1"
                                      >Yes</span
                                    ><span v-else>No</span>
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Endocrine Disorders</strong
                                    ><span
                                      v-if="data.medical_risk.endocrine_disorders == 1"
                                      >Yes</span
                                    ><span v-else>No</span>
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >GastroIntestinal Disorders</strong
                                    ><span v-if="data.medical_risk.gi_disorders == 1"
                                      >Yes</span
                                    ><span v-else>No</span>
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Hyperthyroid</strong
                                    ><span v-if="data.medical_risk.hyperthyroid == 1"
                                      >Yes</span
                                    ><span v-else>No</span>
                                  </td>
                                </tr>
                                <tr>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Hypothyroid</strong
                                    ><span v-if="data.medical_risk.hypothyroid == 1"
                                      >Yes</span
                                    ><span v-else>No</span>
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Malignancy</strong
                                    ><span v-if="data.medical_risk.malignancy == 1"
                                      >Yes</span
                                    ><span v-else>No</span>
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Moderate or severe asthma</strong
                                    ><span v-if="data.medical_risk.moderate_asthma == 1"
                                      >Yes</span
                                    ><span v-else>No</span>
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Renal disease/history of urinary tract
                                      infections</strong
                                    ><span v-if="data.medical_risk.renal_disease == 1"
                                      >Yes</span
                                    ><span v-else>No</span>
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Seizure disorders</strong
                                    ><span v-if="data.medical_risk.seizure_disorders == 1"
                                      >Yes</span
                                    ><span v-else>No</span>
                                  </td>
                                </tr>
                                <tr>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Sickle Cell Diseases</strong
                                    ><span
                                      v-if="data.medical_risk.sickle_cell_diseases == 1"
                                      >Yes</span
                                    ><span v-else>No</span>
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Kidney disease</strong
                                    ><span v-if="data.medical_risk.kidney_disease == 1"
                                      >Yes</span
                                    ><span v-else>No</span>
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Moderate or severe asthma</strong
                                    ><span v-if="data.medical_risk.moderate_asthma == 1"
                                      >Yes</span
                                    ><span v-else>No</span>
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Epilepsy</strong
                                    ><span v-if="data.medical_risk.epilepsy == 1"
                                      >Yes</span
                                    ><span v-else>No</span>
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Disorder of nervous system</strong
                                    ><span
                                      v-if="
                                        data.medical_risk.disorder_of_nervous_system == 1
                                      "
                                      >Yes</span
                                    ><span v-else>No</span>
                                  </td>
                                </tr>
                                <tr>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Psychiatric illness / depression / anxiety</strong
                                    ><span
                                      v-if="data.medical_risk.psychiatric_illness == 1"
                                      >Yes</span
                                    ><span v-else>No</span>
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Disorder of nervous system</strong
                                    ><span
                                      v-if="
                                        data.medical_risk.disorder_of_nervous_system == 1
                                      "
                                      >Yes</span
                                    ><span v-else>No</span>
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >High blood pressure</strong
                                    ><span
                                      v-if="data.medical_risk.high_blood_pressure == 1"
                                      >Yes</span
                                    ><span v-else>No</span>
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Lung disease</strong
                                    ><span v-if="data.medical_risk.lung_disease == 1"
                                      >Yes</span
                                    ><span v-else>No</span>
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Blood Transfusion</strong
                                    ><span v-if="data.medical_risk.lood_transfusion == 1"
                                      >Yes</span
                                    ><span v-else>No</span>
                                  </td>
                                </tr>
                                <tr>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >hepatitis / Jaundice</strong
                                    ><span v-if="data.medical_risk.hepatitis == 1"
                                      >Yes</span
                                    ><span v-else>No</span>
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Blood disorder (e.g. anaemia, thalassaemia)</strong
                                    ><span v-if="data.medical_risk.blood_disorder == 1"
                                      >Yes</span
                                    ><span v-else>No</span>
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Assault (physical / psychological)</strong
                                    ><span v-if="data.medical_risk.assault == 1">Yes</span
                                    ><span v-else>No</span>
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Hormone problems (e.g. thyroid)</strong
                                    ><span v-if="data.medical_risk.hormone_problem == 1"
                                      >Yes</span
                                    ><span v-else>No</span>
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Bone / Muscle problem</strong
                                    ><span v-if="data.medical_risk.bone_problem == 1"
                                      >Yes</span
                                    ><span v-else>No</span>
                                  </td>
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
                          data-tw-parent="#faq-accordion-8"
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
                                    ><span
                                      v-if="data.obstetric_risk.abnormal_pap_smear == 1"
                                      >Yes</span
                                    ><span v-else>No</span>
                                  </td>

                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >BMI > 30</strong
                                    ><span v-if="data.obstetric_risk.bmi == 1">Yes</span
                                    ><span v-else>No</span>
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >gestational diabetes</strong
                                    ><span
                                      v-if="data.obstetric_risk.gestational_diabetes == 1"
                                      >Yes</span
                                    ><span v-else>No</span>
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >History of cervical uterine infections</strong
                                    ><span
                                      v-if="
                                        data.obstetric_risk.cervical_uterine_infections ==
                                        1
                                      "
                                      >Yes</span
                                    ><span v-else>No</span>
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >History of infant with birth injury, neurological
                                      defect or congenial abnormality</strong
                                    ><span
                                      v-if="data.obstetric_risk.neurological_defect == 1"
                                      >Yes</span
                                    ><span v-else>No</span>
                                  </td>
                                </tr>
                                <tr>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >History of infertility</strong
                                    ><span
                                      v-if="
                                        data.obstetric_risk.history_of_infertility == 1
                                      "
                                      >Yes</span
                                    ><span v-else>No</span>
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Inadequate prenatal care</strong
                                    ><span
                                      v-if="
                                        data.obstetric_risk.inadequate_prenatal_care == 1
                                      "
                                      >Yes</span
                                    ><span v-else>No</span>
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >History low birth weight infant</strong
                                    ><span
                                      v-if="
                                        data.obstetric_risk.history_of_low_birth_weight ==
                                        1
                                      "
                                      >Yes</span
                                    ><span v-else>No</span>
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Incompetent cervix</strong
                                    ><span
                                      v-if="data.obstetric_risk.incompetent_cervix == 1"
                                      >Yes</span
                                    ><span v-else>No</span>
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Intrauterine growth retardation (IUGR)</strong
                                    ><span
                                      v-if="
                                        data.obstetric_risk
                                          .intrauterine_growth_retardation == 1
                                      "
                                      >Yes</span
                                    ><span v-else>No</span>
                                  </td>
                                </tr>
                                <tr>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Placenta Previa/Placenta Abruptia</strong
                                    ><span v-if="data.obstetric_risk.placenta_previa == 1"
                                      >Yes</span
                                    ><span v-else>No</span>
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Polyhydramnios/oligohydramnios</strong
                                    ><span v-if="data.obstetric_risk.polyhydramnios == 1"
                                      >Yes</span
                                    ><span v-else>No</span>
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Poor weight gain</strong
                                    ><span
                                      v-if="data.obstetric_risk.poor_weight_gain == 1"
                                      >Yes</span
                                    ><span v-else>No</span>
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Postpartum depression—family history</strong
                                    ><span
                                      v-if="
                                        data.obstetric_risk
                                          .postpartum_depression_family == 1
                                      "
                                      >Yes</span
                                    ><span v-else>No</span>
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Postpartum depression—family personal
                                      history</strong
                                    ><span
                                      v-if="
                                        data.obstetric_risk
                                          .postpartum_depression_personal == 1
                                      "
                                      >Yes</span
                                    ><span v-else>No</span>
                                  </td>
                                </tr>
                                <tr>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Pregnancy-induced hypertension</strong
                                    ><span
                                      v-if="
                                        data.obstetric_risk
                                          .pregnancy_induced_hypertension == 1
                                      "
                                      >Yes</span
                                    ><span v-else>No</span>
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Pre-pregnancy weight of less than 100
                                      pounds</strong
                                    ><span
                                      v-if="data.obstetric_risk.pre_pregnant_weight == 1"
                                      >Yes</span
                                    ><span v-else>No</span>
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Previous pre-term labour (PTL)</strong
                                    ><span
                                      v-if="
                                        data.obstetric_risk.previous_pre_term_labour == 1
                                      "
                                      >Yes</span
                                    ><span v-else>No</span>
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Previous pre-term delivery (PTD)</strong
                                    ><span
                                      v-if="
                                        data.obstetric_risk.previous_pre_term_delivery ==
                                        1
                                      "
                                      >Yes</span
                                    ><span v-else>No</span>
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Previous stillborn/neonatal death</strong
                                    ><span
                                      v-if="data.obstetric_risk.previous_stillborn == 1"
                                      >Yes</span
                                    ><span v-else>No</span>
                                  </td>
                                </tr>
                                <tr>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Multiple gestation</strong
                                    ><span
                                      v-if="data.obstetric_risk.multiple_gestation == 1"
                                      >Yes</span
                                    ><span v-else>No</span>
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Rh sensitization</strong
                                    ><span
                                      v-if="data.obstetric_risk.rh_sensitization == 1"
                                      >Yes</span
                                    ><span v-else>No</span>
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Sexually Transmitted Disease</strong
                                    ><span
                                      v-if="
                                        data.obstetric_risk
                                          .sexually_transmitted_disease == 1
                                      "
                                      >Yes</span
                                    ><span v-else>No</span>
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >2 or more spontaneous abortions (SABs) or
                                      therapeutic abortions (TABs)</strong
                                    ><span
                                      v-if="
                                        data.obstetric_risk.therapeutics_abortion == 1
                                      "
                                      >Yes</span
                                    ><span v-else>No</span>
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Uterine/cervical anomaly</strong
                                    ><span
                                      v-if="data.obstetric_risk.uterine_anomally == 1"
                                      >Yes</span
                                    ><span v-else>No</span>
                                  </td>
                                </tr>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="accordion-item">
                        <div id="faq-accordion-content-9" class="accordion-header">
                          <button
                            class="accordion-button collapsed"
                            type="button"
                            data-tw-toggle="collapse"
                            data-tw-target="#faq-accordion-collapse-9"
                            aria-expanded="false"
                            aria-controls="faq-accordion-collapse-9"
                          >
                            Obstetric History
                          </button>
                        </div>
                        <div
                          id="faq-accordion-collapse-9"
                          class="accordion-collapse collapse"
                          aria-labelledby="faq-accordion-content-9"
                          data-tw-parent="#faq-accordion-9"
                        >
                          <div
                            class="accordion-body text-slate-600 dark:text-slate-500 leading-relaxed"
                          >
                            <div class="overflow-x-auto">
                              <table class="table table-bordered">
                                <tr>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Number of Pregnancy > 22 weeks gestation</strong
                                    >{{ data.prenatal.number_of_pregnancy }}
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Number of Previous Vaginal Delivery</strong
                                    >{{
                                      data.prenatal.number_of_previous_vaginal_deliveries
                                    }}
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Number of Surviving Children</strong
                                    >{{ data.prenatal.number_of_surviving_children }}
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Number of Caesarian Section</strong
                                    >{{ data.prenatal.number_of_caesarian_sections }}
                                  </td>
                                </tr>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="accordion-item">
                        <div id="faq-accordion-content-10" class="accordion-header">
                          <button
                            class="accordion-button collapsed"
                            type="button"
                            data-tw-toggle="collapse"
                            data-tw-target="#faq-accordion-collapse-10"
                            aria-expanded="false"
                            aria-controls="faq-accordion-collapse-10"
                          >
                            Medications During This Pregnancy
                          </button>
                        </div>
                        <div
                          id="faq-accordion-collapse-10"
                          class="accordion-collapse collapse"
                          aria-labelledby="faq-accordion-content-10"
                          data-tw-parent="#faq-accordion-10"
                        >
                          <div
                            class="accordion-body text-slate-600 dark:text-slate-500 leading-relaxed"
                          >
                            <div class="overflow-x-auto">
                              <table class="table table-bordered">
                                <tr>
                                  <td class="text-xs uppercase" colspan="2">
                                    <strong>Fever or Pain Treatment</strong>
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Acetaminophen/Paracetamol</strong
                                    >{{ data.medication.paracetamol }}
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Nsaid/s</strong
                                    >{{ data.medication.nsaid }}
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Other/s (specify)</strong
                                    ><span v-if="data.medication.fever_specify">{{
                                      data.medication.fever_specify
                                    }}</span
                                    ><span v-else>-</span>
                                  </td>
                                </tr>
                                <tr>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Anticonvulsants</strong
                                    >{{ data.medication.anticonvulsants }}
                                    <span v-if="data.medication.anticonvulsants == 'Yes'"
                                      >/
                                      data.medication.anticonvulsants_generic_name</span
                                    >
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Antinausea</strong
                                    >{{ data.medication.antinausea }}
                                    <span v-if="data.medication.antinausea == 'Yes'"
                                      >/ data.medication.antinausea_generic_name</span
                                    >
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Prenatals vitamins &amp; micronutrients</strong
                                    >{{ data.medication.prenatal_vitamins }}
                                    <span
                                      v-if="data.medication.prenatal_vitamins == 'Yes'"
                                      >/
                                      data.medication.prenatal_vitamins_generic_name</span
                                    >
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Antivirals</strong
                                    >{{ data.medication.antivirals }}
                                    <span v-if="data.medication.antivirals == 'Yes'"
                                      >/ data.medication.antivirals_generic_name</span
                                    >
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Antibiotics</strong
                                    >{{ data.medication.antibiotics }}
                                    <span v-if="data.medication.antibiotics == 'Yes'"
                                      >/ data.medication.antibiotics_generic_name</span
                                    >
                                  </td>
                                </tr>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="accordion-item">
                        <div id="faq-accordion-content-12" class="accordion-header">
                          <button
                            class="accordion-button collapsed"
                            type="button"
                            data-tw-toggle="collapse"
                            data-tw-target="#faq-accordion-collapse-12"
                            aria-expanded="false"
                            aria-controls="faq-accordion-collapse-12"
                          >
                            Fetal Heart Rate
                          </button>
                        </div>
                        <div
                          id="faq-accordion-collapse-12"
                          class="accordion-collapse collapse"
                          aria-labelledby="faq-accordion-content-12"
                          data-tw-parent="#faq-accordion-12"
                        >
                          <div
                            class="accordion-body text-slate-600 dark:text-slate-500 leading-relaxed"
                          >
                            <div class="overflow-x-auto">
                              <table class="table table-bordered">
                                <tr>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Fetal Heart Rate</strong
                                    >{{ data.prenatal.fetal_heart_rate }} beats/min
                                  </td>
                                </tr>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="accordion-item">
                        <div id="faq-accordion-content-13" class="accordion-header">
                          <button
                            class="accordion-button collapsed"
                            type="button"
                            data-tw-toggle="collapse"
                            data-tw-target="#faq-accordion-collapse-13"
                            aria-expanded="false"
                            aria-controls="faq-accordion-collapse-13"
                          >
                            Others
                          </button>
                        </div>
                        <div
                          id="faq-accordion-collapse-13"
                          class="accordion-collapse collapse"
                          aria-labelledby="faq-accordion-content-13"
                          data-tw-parent="#faq-accordion-13"
                        >
                          <div
                            class="accordion-body text-slate-600 dark:text-slate-500 leading-relaxed"
                          >
                            <div class="overflow-x-auto">
                              <table class="table table-bordered">
                                <tr>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Pack Volume Cells</strong
                                    >{{ data.prenatal.pack_volume_cells }}
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Pregnancy Scan</strong
                                    ><span v-if="data.prenatal.pregnancy_scan">Yes</span
                                    ><span v-else>No</span>
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Primp Scan</strong
                                    ><span v-if="data.prenatal.primp_scan">Yes</span
                                    ><span v-else>No</span>
                                  </td>
                                </tr>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="accordion-item">
                        <div id="faq-accordion-content-83" class="accordion-header">
                          <button
                            class="accordion-button collapsed"
                            type="button"
                            data-tw-toggle="collapse"
                            data-tw-target="#faq-accordion-collapse-83"
                            aria-expanded="false"
                            aria-controls="faq-accordion-collapse-83"
                          >
                            Family History
                          </button>
                        </div>
                        <div
                          id="faq-accordion-collapse-83"
                          class="accordion-collapse collapse"
                          aria-labelledby="faq-accordion-content-83"
                          data-tw-parent="#faq-accordion-83"
                        >
                          <div
                            class="accordion-body text-slate-600 dark:text-slate-500 leading-relaxed"
                          >
                            <div class="overflow-x-auto">
                              <table class="table table-bordered">
                                <tr>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs">Twins</strong
                                    >{{ data.family.twins }}
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >High blood pressure</strong
                                    ><span v-if="data.family.high_blood_pressure"
                                      >Yes</span
                                    ><span v-else>No</span>
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Aborginal status of baby</strong
                                    ><span v-if="data.family.aborginal_status">Yes</span
                                    ><span v-else>No</span>
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Genetic disorders</strong
                                    ><span v-if="data.family.genetic_disorders">Yes</span
                                    ><span v-else>No</span>
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Diabetes</strong
                                    ><span v-if="data.family.diabetes">Yes</span
                                    ><span v-else>No</span>
                                  </td>
                                </tr>
                                <tr>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >If yes to family history, specify</strong
                                    ><span v-if="data.family.family_specify">{{
                                      data.family.family_specify
                                    }}</span
                                    ><span v-else>-</span>
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Medical illness</strong
                                    ><span v-if="data.family.medical_illness">{{
                                      data.family.medical_illness
                                    }}</span
                                    ><span v-else>-</span>
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Gynaecological History</strong
                                    ><span v-if="data.family.gynaecological_history">{{
                                      data.family.gynaecological_history
                                    }}</span
                                    ><span v-else>-</span>
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Have had previous operation</strong
                                    ><span v-if="data.family.previous_operation">{{
                                      data.family.previous_operation
                                    }}</span
                                    ><span v-else>-</span>
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Problem with anaesthetic</strong
                                    ><span v-if="data.family.anaesthetic">{{
                                      data.family.anaesthetic
                                    }}</span
                                    ><span v-else></span>
                                  </td>
                                </tr>
                                <tr>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >On Medication</strong
                                    >
                                    <span v-if="data.family.medication">{{
                                      data.family.medication
                                    }}</span
                                    ><span v-else>-</span>
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Depression during pregnancy</strong
                                    >
                                    <span
                                      v-if="data.family.depression_during_pregnancy"
                                      >{{ data.family.depression_during_pregnancy }}</span
                                    ><span v-else>-</span>
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Edinburgh score</strong
                                    >{{ data.family.edinburgh_score }}
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Gestation Week</strong
                                    >{{ data.family.gestation_week }}
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >so well in this pregnancy</strong
                                    >
                                    <span
                                      v-if="data.family.well_so_far_in_this_pregnancy"
                                      >{{
                                        data.family.well_so_far_in_this_pregnancy
                                      }}</span
                                    ><span v-else>-</span>
                                  </td>
                                </tr>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="accordion-item">
                        <div id="faq-accordion-content-84" class="accordion-header">
                          <button
                            class="accordion-button collapsed"
                            type="button"
                            data-tw-toggle="collapse"
                            data-tw-target="#faq-accordion-collapse-84"
                            aria-expanded="false"
                            aria-controls="faq-accordion-collapse-84"
                          >
                            Investigation/Procedures
                          </button>
                        </div>
                        <div
                          id="faq-accordion-collapse-84"
                          class="accordion-collapse collapse"
                          aria-labelledby="faq-accordion-content-84"
                          data-tw-parent="#faq-accordion-84"
                        >
                          <div
                            class="accordion-body text-slate-600 dark:text-slate-500 leading-relaxed"
                          >
                            <div class="overflow-x-auto">
                              <table class="table table-bordered">
                                <tr>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Ultrasound</strong
                                    >{{ data.investigation.ultrasound }}
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Ultrasound week</strong
                                    ><span v-if="data.investigation.ultrasound_week">{{
                                      data.investigation.ultrasound_week
                                    }}</span
                                    ><span v-else>-</span>
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs">CVS</strong
                                    >{{ data.investigation.cvs }}
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Maternal Serum screening</strong
                                    >{{ data.investigation.maternal_serum_screening }}
                                  </td>
                                </tr>
                                <tr>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Amniocentesis</strong
                                    >{{ data.investigation.amniocentesis }}
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Other Procedures</strong
                                    >{{ data.investigation.other_procedures }}
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Specify Other Procedures</strong
                                    >{{ data.investigation.specify_other_procedures }}
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Total Number of Antenatal Visit</strong
                                    >{{ data.investigation.antenatal_visit }}
                                  </td>
                                </tr>
                                <tr>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Condition developed during pregnancy</strong
                                    >{{ data.investigation.condition_developed }}
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Plan for vaginal birth after caesarian</strong
                                    >{{ data.investigation.vaginal_birth }}
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Attend ante natal classes</strong
                                    >{{ data.investigation.antenatal_classes }}
                                  </td>
                                  <td class="text-md"></td>
                                </tr>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="accordion-item">
                        <div id="faq-accordion-content-100" class="accordion-header">
                          <button
                            class="accordion-button collapsed"
                            type="button"
                            data-tw-toggle="collapse"
                            data-tw-target="#faq-accordion-collapse-100"
                            aria-expanded="false"
                            aria-controls="faq-accordion-collapse-100"
                          >
                            CREUTZFELDT – JAKOB DISEASE (CJD) Questionnaire
                          </button>
                        </div>
                        <div
                          id="faq-accordion-collapse-84"
                          class="accordion-collapse collapse"
                          aria-labelledby="faq-accordion-content-100"
                          data-tw-parent="#faq-accordion-100"
                        >
                          <div
                            class="accordion-body text-slate-600 dark:text-slate-500 leading-relaxed"
                          >
                            <div class="overflow-x-auto">
                              <table class="table table-bordered">
                                <tr>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Have you suffered from a recent rapid progressive
                                      dementia, physical or mental, the cause of which has
                                      not been diagnosed?</strong
                                    >{{ data.investigation.rapid_progressive_dementia }}
                                  </td>
                                  <td class="text-md" colspan="2">
                                    <strong class="uppercase block text-xs"
                                      >Do you have a family history of 2 or more
                                      first-degree relatives with CJD or other undiagnosed
                                      neurological illness?</strong
                                    >{{ data.investigation.cjd }}
                                  </td>
                                </tr>
                                <tr>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Have you received human pituitary- derived
                                      gonadotrophin (for infertility) or growth hormone
                                      (for short stature)?</strong
                                    >{{ data.investigation.human_pituitary }}
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Have you received a dura mater graft in a
                                      neurological or other surgical procedure before
                                      1990?</strong
                                    >{{ data.investigation.dura_mater_graft }}
                                  </td>
                                </tr>
                                <tr>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Have been involved in a CJD look back?</strong
                                    >{{ data.investigation.cjd_look_back }}
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Do you have a "Medical in Confidence" letter in
                                      regard to your risk of CJD?</strong
                                    >{{ data.investigation.medical_in_confidence }}
                                  </td>
                                </tr>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="accordion-item">
                        <div id="faq-accordion-content-14" class="accordion-header">
                          <button
                            class="accordion-button collapsed"
                            type="button"
                            data-tw-toggle="collapse"
                            data-tw-target="#faq-accordion-collapse-14"
                            aria-expanded="false"
                            aria-controls="faq-accordion-collapse-14"
                          >
                            Spouse Information
                          </button>
                        </div>
                        <div
                          id="faq-accordion-collapse-14"
                          class="accordion-collapse collapse"
                          aria-labelledby="faq-accordion-content-14"
                          data-tw-parent="#faq-accordion-14"
                        >
                          <div
                            class="accordion-body text-slate-600 dark:text-slate-500 leading-relaxed"
                          >
                            <div class="overflow-x-auto">
                              <table class="table table-bordered">
                                <tr>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs">Name</strong
                                    >{{ data.spouse.name }}
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Email Address</strong
                                    >{{ data.spouse.email }}
                                  </td>
                                  <td class="text-md">
                                    <strong class="uppercase block text-xs"
                                      >Phone Number</strong
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
      id: null,
      token: null,
      data: {},

      patient: "",
    };
  },

  created() {
    this.login();
    this.getPatient();
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
              name: "patient-logout",
            });
          }
        });
    },
  },
};
</script>

<style scoped></style>
