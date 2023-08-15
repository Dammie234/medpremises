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
        <top-bar title="Registration for Prenatal"></top-bar>
        <!-- END: Top Bar -->
        <div class="grid grid-cols-12 gap-6">
          <div class="intro-y col-span-12 xxl:col-span-12">
            <div class="intro-y box">
              <div
                class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5"
              >
                <h2 class="font-medium text-base mr-auto">Registration for Prenatal</h2>
                <router-link :to="{ name: 'prenatals' }" class="btn btn-primary"
                  >Go Back</router-link
                >
              </div>
              <form class="input p-5" @submit.prevent="submit">
                <div class="grid grid-cols-12 gap-x-5" :disabled="loading">
                  <div class="col-span-12 xl:col-span-3 lg:col-span-3 md:col-span-3 mt-3">
                    <label for="patient" class="form-label">Patient</label>
                    <vue-single-select
                      name="maybe"
                      placeholder="pick a patient"
                      you-want-to-select-a-post="ok"
                      v-model="form.patient"
                      out-of-all-these-posts="makes sense"
                      :options="patients"
                      :required="true"
                      a-post-has-an-id="good for search and display"
                      the-post-has-a-title="make sure to show these"
                      option-label="name"
                    ></vue-single-select>
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.patient"
                    >
                      {{ errors.patient[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-3 mt-3">
                    <label for="last_menstral_period" class="form-label"
                      >Last Menstral Period</label
                    >
                    <input
                      id="last_menstral_period"
                      type="date"
                      class="form-control"
                      v-model="form.last_menstral_period"
                      @change="computeGestationPeriod"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.last_menstral_period"
                    >
                      {{ errors.last_menstral_period[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-3 mt-3">
                    <label for="expected_due_date" class="form-label"
                      >Expected/Estimated Due Date</label
                    >
                    <input
                      id="expected_due_date"
                      type="text"
                      disabled
                      class="form-control"
                      v-model="form.expected_due_date"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.expected_due_date"
                    >
                      {{ errors.expected_due_date[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-3 mt-3">
                    <label for="gestational_period" class="form-label"
                      >Gestational Period</label
                    >
                    <input
                      id="gestational_period"
                      type="text"
                      disabled
                      class="form-control"
                      v-model="form.gestational_period"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.gestational_period"
                    >
                      {{ errors.gestational_period[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-3 mt-3">
                    <label for="date_of_conception" class="form-label"
                      >Date of Conception</label
                    >
                    <input
                      id="date_of_conception"
                      type="text"
                      disabled
                      class="form-control"
                      v-model="form.date_of_conception"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.date_of_conception"
                    >
                      {{ errors.date_of_conception[0] }}
                    </div>
                  </div>

                  <div class="col-span-12 xl:col-span-3 mt-3">
                    <label for="date_of_first_prenatal_visit" class="form-label"
                      >Date of First Prenatal Visit</label
                    >
                    <input
                      id="date_of_first_prenatal_visit"
                      type="date"
                      class="form-control"
                      v-model="form.date_of_first_prenatal_visit"
                      @change="getSpouseInformation"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.date_of_first_prenatal_visit"
                    >
                      {{ errors.date_of_first_prenatal_visit[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-3 mt-3">
                    <label for="day_of_prenatal_visit" class="form-label"
                      >Day of Prenatal Visit</label
                    >
                    <select
                      id="day_of_prenatal_visit"
                      class="form-control"
                      v-model="form.day_of_prenatal_visit"
                    >
                      <option value=""></option>
                      <option value="Monday">Monday</option>
                      <option value="Tuesday">Tuesday</option>
                      <option value="Wednesday">Wednesday</option>
                      <option value="Thursday">Thursday</option>
                      <option value="Friday">Friday</option>
                      <option value="Saturday">Saturday</option>
                    </select>
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.day_of_prenatal_visit"
                    >
                      {{ errors.day_of_prenatal_visit[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-3 mt-3">
                    <label for="type_of_last_delivery" class="form-label"
                      >Type of Last Delivery</label
                    >
                    <select
                      v-model="form.type_of_last_delivery"
                      id=""
                      class="form-control"
                    >
                      <option value=""></option>
                      <option value="Vaginal Birth">Vaginal Birth</option>
                      <option value="Cesarean Birth (C-section)">
                        Cesarean Birth (C-section)
                      </option>
                      <option value="Vaginal Birth After Cesarean Delivery (VBAC)">
                        Vaginal Birth After Cesarean Delivery (VBAC)
                      </option>
                    </select>
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.type_of_last_delivery"
                    >
                      {{ errors.type_of_last_delivery[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-3 mt-3">
                    <label for="date_of_last_delivery" class="form-label"
                      >Date of Last Delivery</label
                    >
                    <input
                      id="date_of_last_delivery"
                      type="date"
                      class="form-control"
                      v-model="form.date_of_last_delivery"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.date_of_last_delivery"
                    >
                      {{ errors.date_of_last_delivery[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-4 mt-3">
                    <label for="expected_delivery_facility" class="form-label"
                      >Expected Delivery Facility</label
                    >
                    <input
                      id="expected_delivery_facility"
                      type="text"
                      class="form-control"
                      v-model="form.expected_delivery_facility"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.expected_delivery_facility"
                    >
                      {{ errors.expected_delivery_facility[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-4 mt-3">
                    <label for="pregnancy_type" class="form-label"
                      >Check if these apply for this pregnancy</label
                    >
                    <select
                      v-model="form.pregnancy_type"
                      id="pregnancy_type"
                      class="form-control"
                    >
                      <option value=""></option>
                      <option value="Open adoption">Open adoption</option>
                      <option value="Closed adoption">Closed adoption</option>
                      <option value="Surrogacy">Surrogacy</option>
                      <option value="Gestational carrier">Gestational carrier</option>
                      <option value="N/A">N/A</option>
                    </select>
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.pregnancy_type"
                    >
                      {{ errors.pregnancy_type[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-6">
                    <div class="flex flex-col sm:flex-row mt-2">
                      <label class="mr-2"
                        >Is your husband responsible for your pregnancy?</label
                      >
                      <div class="form-check mr-2">
                        <input
                          id="radio-switch-4"
                          class="form-check-input"
                          type="radio"
                          name="responsibility"
                          v-model="form.pregnancy_responsibility"
                          value="1"
                        />
                        <label class="form-check-label" for="radio-switch-4">Yes</label>
                      </div>
                      <div class="form-check mr-2 mt-2 sm:mt-0">
                        <input
                          id="radio-switch-5"
                          class="form-check-input"
                          type="radio"
                          name="responsibility"
                          v-model="form.pregnancy_responsibility"
                          value="0"
                        />
                        <label class="form-check-label" for="radio-switch-5">No</label>
                      </div>
                    </div>
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.pregnancy_responsibility"
                    >
                      {{ errors.pregnancy_responsibility[0] }}
                    </div>
                  </div>

                  <div class="col-span-12 xl:col-span-12 mt-4 border-top">
                    <h3 class="font-medium text-xl mt-2">Behavioural Risk</h3>
                  </div>

                  <div class="col-span-12 xl:col-span-3">
                    <div class="flex flex-col sm:flex-row mt-2">
                      <label for="smokes" class="mr-5">Do you smoke?</label>
                      <div class="form-check mr-2">
                        <input
                          id="radio-switch-100"
                          class="form-check-input"
                          type="radio"
                          name="smokes"
                          v-model="form.smokes"
                          value="Yes"
                        />
                        <label class="form-check-label" for="radio-switch-100">Yes</label>
                      </div>
                      <div class="form-check mr-2 mt-2 sm:mt-0">
                        <input
                          id="radio-switch-101"
                          class="form-check-input"
                          type="radio"
                          name="smokes"
                          v-model="form.smokes"
                          value="No"
                        />
                        <label class="form-check-label" for="radio-switch-101">No</label>
                      </div>
                    </div>
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.smokes"
                    >
                      {{ errors.smokes[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-3">
                    <label for="smoke_qty_per_day" class="form-label"
                      >How many cigarretes per day?</label
                    >
                    <input
                      type="text"
                      class="form-control"
                      v-model="form.smoke_qty_per_day"
                      id="smoke_qty_per_day"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.smoke_qty_per_day"
                    >
                      {{ errors.smoke_qty_per_day[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-6">
                    <div class="flex flex-col sm:flex-row mt-2">
                      <label for="ceased_smoking" class="mr-5"
                        >If ceased smoking, when?</label
                      >
                      <div class="form-check mr-2">
                        <input
                          id="radio-switch-102"
                          class="form-check-input"
                          type="radio"
                          name="ceased_smoking"
                          v-model="form.ceased_smoking"
                          value="< 20 wks"
                        />
                        <label class="form-check-label" for="radio-switch-102"
                          >&lt; 20 wks</label
                        >
                      </div>
                      <div class="form-check mr-2 mt-2 sm:mt-0">
                        <input
                          id="radio-switch-103"
                          class="form-check-input"
                          type="radio"
                          name="ceased_smoking"
                          v-model="form.ceased_smoking"
                          value="> 20 wks"
                        />
                        <label class="form-check-label" for="radio-switch-103"
                          >&gt; 20 wks</label
                        >
                      </div>
                      <div class="form-check mr-2 mt-2 sm:mt-0">
                        <input
                          id="radio-switch-104"
                          class="form-check-input"
                          type="radio"
                          name="ceased_smoking"
                          v-model="form.ceased_smoking"
                          value="Quit Not Stated"
                        />
                        <label class="form-check-label" for="radio-switch-104"
                          >Quit Not Stated</label
                        >
                      </div>
                    </div>
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.ceased_smoking"
                    >
                      {{ errors.ceased_smoking[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-4">
                    <div class="flex flex-col sm:flex-row mt-2">
                      <label for="substance_use" class="mr-5">Substance use</label>
                      <div class="form-check mr-2">
                        <input
                          id="radio-switch-107"
                          class="form-check-input"
                          type="radio"
                          name="substance_use"
                          v-model="form.substance_use"
                          value="Yes"
                        />
                        <label class="form-check-label" for="radio-switch-107">Yes</label>
                      </div>
                      <div class="form-check mr-2 mt-2 sm:mt-0">
                        <input
                          id="radio-switch-108"
                          class="form-check-input"
                          type="radio"
                          name="substance_use"
                          v-model="form.substance_use"
                          value="No"
                        />
                        <label class="form-check-label" for="radio-switch-108">No</label>
                      </div>
                    </div>
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.substance_use"
                    >
                      {{ errors.substance_use[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-4">
                    <div class="flex flex-col sm:flex-row mt-2">
                      <label for="spouse_smoke" class="mr-5"
                        >Does your spouse smoke?</label
                      >
                      <div class="form-check mr-2">
                        <input
                          id="radio-switch-105"
                          class="form-check-input"
                          type="radio"
                          name="spouse_smoke"
                          v-model="form.spouse_smoke"
                          value="Yes"
                        />
                        <label class="form-check-label" for="radio-switch-105">Yes</label>
                      </div>
                      <div class="form-check mr-2 mt-2 sm:mt-0">
                        <input
                          id="radio-switch-106"
                          class="form-check-input"
                          type="radio"
                          name="spouse_smoke"
                          v-model="form.spouse_smoke"
                          value="No"
                        />
                        <label class="form-check-label" for="radio-switch-106">No</label>
                      </div>
                    </div>
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.spouse_smoke"
                    >
                      {{ errors.spouse_smoke[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 lg:col-span-4">
                    <div class="flex flex-col sm:flex-row mt-2">
                      <label for="smokes" class="mr-5"
                        >Was QUIT information discussed?</label
                      >
                      <div class="form-check mr-2">
                        <input
                          id="radio-switch-109"
                          class="form-check-input"
                          type="radio"
                          name="quit_information"
                          v-model="form.quit_information"
                          value="Yes"
                        />
                        <label class="form-check-label" for="radio-switch-109">Yes</label>
                      </div>
                      <div class="form-check mr-2 mt-2 sm:mt-0">
                        <input
                          id="radio-switch-110"
                          class="form-check-input"
                          type="radio"
                          name="quit_information"
                          v-model="form.quit_information"
                          value="No"
                        />
                        <label class="form-check-label" for="radio-switch-110">No</label>
                      </div>
                    </div>
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.quit_information"
                    >
                      {{ errors.quit_information[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-4">
                    <div class="flex flex-col sm:flex-row mt-2">
                      <label for="smokes" class="mr-5">Alcohol consumption</label>
                      <div class="form-check mr-2">
                        <input
                          id="radio-switch-111"
                          class="form-check-input"
                          type="radio"
                          name="alcohol"
                          v-model="form.alcohol"
                          value="Yes"
                        />
                        <label class="form-check-label" for="radio-switch-111">Yes</label>
                      </div>
                      <div class="form-check mr-2 mt-2 sm:mt-0">
                        <input
                          id="radio-switch-112"
                          class="form-check-input"
                          type="radio"
                          name="alcohol"
                          v-model="form.alcohol"
                          value="No"
                        />
                        <label class="form-check-label" for="radio-switch-112">No</label>
                      </div>
                    </div>
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.alcohol"
                    >
                      {{ errors.alcohol[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-3">
                    <label for="alcohol_qty_per_week" class="form-label"
                      >How many bottles per week?</label
                    >
                    <input
                      type="text"
                      class="form-control"
                      v-model="form.alcohol_qty_per_week"
                      id="alcohol_qty_per_week"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.alcohol_qty_per_week"
                    >
                      {{ errors.alcohol_qty_per_week[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-4">
                    <div class="flex flex-col sm:flex-row mt-2">
                      <label for="smokes" class="mr-5"
                        >Current rubella immunisation</label
                      >
                      <div class="form-check mr-2">
                        <input
                          id="radio-switch-113"
                          class="form-check-input"
                          type="radio"
                          name="current_rubella_immunisation"
                          v-model="form.current_rubella_immunisation"
                          value="Yes"
                        />
                        <label class="form-check-label" for="radio-switch-113">Yes</label>
                      </div>
                      <div class="form-check mr-2 mt-2 sm:mt-0">
                        <input
                          id="radio-switch-114"
                          class="form-check-input"
                          type="radio"
                          name="current_rubella_immunisation"
                          v-model="form.current_rubella_immunisation"
                          value="No"
                        />
                        <label class="form-check-label" for="radio-switch-114">No</label>
                      </div>
                    </div>
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.current_rubella_immunisation"
                    >
                      {{ errors.current_rubella_immunisation[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-3">
                    <label for="smoke_qty_per_day" class="form-label"
                      >Current rubella immunisation level</label
                    >
                    <input
                      type="text"
                      class="form-control"
                      v-model="form.current_rubella_immunisation_level"
                      id="current_rubella_immunisation_level"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.current_rubella_immunisation_level"
                    >
                      {{ errors.current_rubella_immunisation_level[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-12 mt-4 border-top">
                    <h3 class="font-medium text-xl mt-2">Psychological Risks</h3>
                    <p>Check if patient has any of the following</p>
                  </div>
                  <div class="col-span-12 mt-3 xl:col-span-3">
                    <div class="flex flex-col sm:flex-row mt-2">
                      <div class="form-check mr-2">
                        <input
                          id="radio-switch-5"
                          class="form-check-input"
                          type="checkbox"
                          v-model="form.adolescent"
                          name="adolescent"
                          value="1"
                        />
                        <label class="form-check-label" for="radio-switch-5"
                          >Adolescent</label
                        >
                      </div>
                    </div>
                  </div>
                  <div class="col-span-12 mt-3 xl:col-span-3">
                    <div class="flex flex-col sm:flex-row mt-2">
                      <div class="form-check mr-2">
                        <input
                          id="radio-switch-6"
                          class="form-check-input"
                          type="checkbox"
                          v-model="form.inadequate_finances"
                          name="inadequate_finances"
                          value="1"
                        />
                        <label class="form-check-label" for="radio-switch-6">
                          Inadequate finances</label
                        >
                      </div>
                    </div>
                  </div>
                  <div class="col-span-12 mt-3 xl:col-span-3">
                    <div class="flex flex-col sm:flex-row mt-2">
                      <div class="form-check mr-2">
                        <input
                          id="radio-switch-7"
                          class="form-check-input"
                          type="checkbox"
                          v-model="form.inadequate_housing"
                          name="inadequate_housing"
                          value="1"
                        />
                        <label class="form-check-label" for="radio-switch-7"
                          >Doesn't have a house she lives</label
                        >
                      </div>
                    </div>
                  </div>
                  <div class="col-span-12 mt-3 xl:col-span-3">
                    <div class="flex flex-col sm:flex-row mt-2">
                      <div class="form-check mr-2">
                        <input
                          id="radio-switch-8"
                          class="form-check-input"
                          type="checkbox"
                          v-model="form.inadequate_social_supports"
                          name="inadequate_social_supports"
                          value="1"
                        />
                        <label class="form-check-label" for="radio-switch-8"
                          >Social support</label
                        >
                      </div>
                    </div>
                  </div>
                  <div class="col-span-12 mt-3 xl:col-span-3">
                    <div class="flex flex-col sm:flex-row mt-2">
                      <div class="form-check mr-2">
                        <input
                          id="radio-switch-9"
                          class="form-check-input"
                          type="checkbox"
                          v-model="form.less_than_high_school_education"
                          name="less_than_high_school_education"
                          value="1"
                        />
                        <label class="form-check-label" for="radio-switch-9">
                          Less than secondary school education</label
                        >
                      </div>
                    </div>
                  </div>
                  <div class="col-span-12 mt-3 xl:col-span-3">
                    <div class="flex flex-col sm:flex-row mt-2">
                      <div class="form-check mr-2">
                        <input
                          id="radio-switch-10"
                          class="form-check-input"
                          type="checkbox"
                          v-model="form.poor_nutrition"
                          name="poor_nutrition"
                          value="1"
                        />
                        <label class="form-check-label" for="radio-switch-10">
                          Poor nutrition</label
                        >
                      </div>
                    </div>
                  </div>
                  <div class="col-span-12 mt-3 xl:col-span-3">
                    <div class="flex flex-col sm:flex-row mt-2">
                      <div class="form-check mr-2">
                        <input
                          id="radio-switch-11"
                          class="form-check-input"
                          type="checkbox"
                          v-model="form.psychiatric_history"
                          name="psychiatric_history"
                          value="1"
                        />
                        <label class="form-check-label" for="radio-switch-11"
                          >Psychiatric history</label
                        >
                      </div>
                    </div>
                  </div>
                  <div class="col-span-12 mt-3 xl:col-span-3">
                    <div class="flex flex-col sm:flex-row mt-2">
                      <div class="form-check mr-2">
                        <input
                          id="radio-switch-12"
                          class="form-check-input"
                          type="checkbox"
                          v-model="form.significant_learning_disabilities"
                          name="significant_learning_disabilities"
                          value="1"
                        />
                        <label class="form-check-label" for="radio-switch-12"
                          >Significant learning disabilities</label
                        >
                      </div>
                    </div>
                  </div>
                  <div class="col-span-12 mt-3 xl:col-span-3">
                    <div class="flex flex-col sm:flex-row mt-2">
                      <div class="form-check mr-2">
                        <input
                          id="radio-switch-13"
                          class="form-check-input"
                          type="checkbox"
                          v-model="form.violence"
                          name="violence"
                          value="1"
                        />
                        <label class="form-check-label" for="radio-switch-13"
                          >Violent/abusive</label
                        >
                      </div>
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-12 mt-4 border-top">
                    <h3 class="font-medium text-xl mt-2">Medical Risk</h3>
                    <p>Check if the patient has any of the following</p>
                  </div>
                  <div class="col-span-12 mt-3 xl:col-span-3">
                    <div class="flex flex-col sm:flex-row mt-2">
                      <div class="form-check mr-2">
                        <input
                          id="radio-switch-14"
                          class="form-check-input"
                          type="checkbox"
                          v-model="form.cardiac_diseases"
                          name="cardiac_diseases"
                          value="1"
                        />
                        <label class="form-check-label" for="radio-switch-14"
                          >Cardiac Disease</label
                        >
                      </div>
                    </div>
                  </div>
                  <div class="col-span-12 mt-3 xl:col-span-3">
                    <div class="flex flex-col sm:flex-row mt-2">
                      <div class="form-check mr-2">
                        <input
                          id="radio-switch-15"
                          class="form-check-input"
                          type="checkbox"
                          v-model="form.diabetes"
                          name="diabetes"
                          value="1"
                        />
                        <label class="form-check-label" for="radio-switch-15"
                          >Diabetes</label
                        >
                      </div>
                    </div>
                  </div>
                  <div class="col-span-12 mt-3 xl:col-span-3">
                    <div class="flex flex-col sm:flex-row mt-2">
                      <div class="form-check mr-2">
                        <input
                          id="radio-switch-16"
                          class="form-check-input"
                          type="checkbox"
                          v-model="form.endocrine_disorders"
                          name="endocrine_disorders"
                          value="1"
                        />
                        <label class="form-check-label" for="radio-switch-16"
                          >Endocrine Disorders</label
                        >
                      </div>
                    </div>
                  </div>
                  <div class="col-span-12 mt-3 xl:col-span-3">
                    <div class="flex flex-col sm:flex-row mt-2">
                      <div class="form-check mr-2">
                        <input
                          id="radio-switch-17"
                          class="form-check-input"
                          type="checkbox"
                          v-model="form.gi_disorders"
                          name="gi_disorders"
                          value="1"
                        />
                        <label class="form-check-label" for="radio-switch-17"
                          >GastroIntestinal Disorders</label
                        >
                      </div>
                    </div>
                  </div>
                  <div class="col-span-12 mt-3 xl:col-span-3">
                    <div class="flex flex-col sm:flex-row mt-2">
                      <div class="form-check mr-2">
                        <input
                          id="radio-switch-18"
                          class="form-check-input"
                          type="checkbox"
                          v-model="form.hyperthyroid"
                          name="hyperthyroid"
                          value="1"
                        />
                        <label class="form-check-label" for="radio-switch-18"
                          >Hyperthyroid</label
                        >
                      </div>
                    </div>
                  </div>
                  <div class="col-span-12 mt-3 xl:col-span-3">
                    <div class="flex flex-col sm:flex-row mt-2">
                      <div class="form-check mr-2">
                        <input
                          id="radio-switch-19"
                          class="form-check-input"
                          type="checkbox"
                          v-model="form.hypothyroid"
                          name="hypothyroid"
                          value="1"
                        />
                        <label class="form-check-label" for="radio-switch-19"
                          >Hypothyroid</label
                        >
                      </div>
                    </div>
                  </div>
                  <div class="col-span-12 mt-3 xl:col-span-3">
                    <div class="flex flex-col sm:flex-row mt-2">
                      <div class="form-check mr-2">
                        <input
                          id="radio-switch-20"
                          class="form-check-input"
                          type="checkbox"
                          v-model="form.malignancy"
                          name="malignancy"
                          value="1"
                        />
                        <label class="form-check-label" for="radio-switch-20"
                          >Malignancy</label
                        >
                      </div>
                    </div>
                  </div>
                  <div class="col-span-12 mt-3 xl:col-span-3">
                    <div class="flex flex-col sm:flex-row mt-2">
                      <div class="form-check mr-2">
                        <input
                          id="radio-switch-21"
                          class="form-check-input"
                          type="checkbox"
                          v-model="form.moderate_asthma"
                          name="moderate_asthma"
                          value="1"
                        />
                        <label class="form-check-label" for="radio-switch-21"
                          >Moderate or severe asthma</label
                        >
                      </div>
                    </div>
                  </div>
                  <div class="col-span-12 mt-3 xl:col-span-3">
                    <div class="flex flex-col sm:flex-row mt-2">
                      <div class="form-check mr-2">
                        <input
                          id="radio-switch-22"
                          class="form-check-input"
                          type="checkbox"
                          v-model="form.renal_disease"
                          name="renal_disease"
                          value="1"
                        />
                        <label class="form-check-label" for="radio-switch-22"
                          >Renal disease/history of urinary tract infections</label
                        >
                      </div>
                    </div>
                  </div>

                  <div class="col-span-12 mt-3 xl:col-span-3">
                    <div class="flex flex-col sm:flex-row mt-2">
                      <div class="form-check mr-2">
                        <input
                          id="radio-switch-23"
                          class="form-check-input"
                          type="checkbox"
                          v-model="form.seizure_disorders"
                          name="seizure_disorders"
                          value="1"
                        />
                        <label class="form-check-label" for="radio-switch-23"
                          >Seizure disorders</label
                        >
                      </div>
                    </div>
                  </div>
                  <div class="col-span-12 mt-3 xl:col-span-3">
                    <div class="flex flex-col sm:flex-row mt-2">
                      <div class="form-check mr-2">
                        <input
                          id="radio-switch-24"
                          class="form-check-input"
                          type="checkbox"
                          v-model="form.sickle_cell_diseases"
                          name="sickle_cell_diseases"
                          value="1"
                        />
                        <label class="form-check-label" for="radio-switch-24"
                          >Sickle cell diseases</label
                        >
                      </div>
                    </div>
                  </div>
                  <div class="col-span-12 mt-3 xl:col-span-3">
                    <div class="flex flex-col sm:flex-row mt-2">
                      <div class="form-check mr-2">
                        <input
                          id="radio-switch-80"
                          class="form-check-input"
                          type="checkbox"
                          v-model="form.kidney_disease"
                          name="kidney_disease"
                          value="1"
                        />
                        <label class="form-check-label" for="radio-switch-80"
                          >Kidney diseases</label
                        >
                      </div>
                    </div>
                  </div>
                  <div class="col-span-12 mt-3 xl:col-span-3">
                    <div class="flex flex-col sm:flex-row mt-2">
                      <div class="form-check mr-2">
                        <input
                          id="radio-switch-81"
                          class="form-check-input"
                          type="checkbox"
                          v-model="form.epilepsy"
                          name="epilepsy"
                          value="1"
                        />
                        <label class="form-check-label" for="radio-switch-81"
                          >Epilepsy</label
                        >
                      </div>
                    </div>
                  </div>
                  <div class="col-span-12 mt-3 xl:col-span-3">
                    <div class="flex flex-col sm:flex-row mt-2">
                      <div class="form-check mr-2">
                        <input
                          id="radio-switch-82"
                          class="form-check-input"
                          type="checkbox"
                          v-model="form.disorder_of_nervous_system"
                          name="disorder_of_nervous_system"
                          value="1"
                        />
                        <label class="form-check-label" for="radio-switch-82"
                          >Disorder of nervous system</label
                        >
                      </div>
                    </div>
                  </div>
                  <div class="col-span-12 mt-3 xl:col-span-3">
                    <div class="flex flex-col sm:flex-row mt-2">
                      <div class="form-check mr-2">
                        <input
                          id="radio-switch-83"
                          class="form-check-input"
                          type="checkbox"
                          v-model="form.psychiatric_illness"
                          name="psychiatric_illness"
                          value="1"
                        />
                        <label class="form-check-label" for="radio-switch-83"
                          >Psychiatric illness / depression / anxiety</label
                        >
                      </div>
                    </div>
                  </div>
                  <div class="col-span-12 mt-3 xl:col-span-3">
                    <div class="flex flex-col sm:flex-row mt-2">
                      <div class="form-check mr-2">
                        <input
                          id="radio-switch-84"
                          class="form-check-input"
                          type="checkbox"
                          v-model="form.high_blood_pressure"
                          name="high_blood_pressure"
                          value="1"
                        />
                        <label class="form-check-label" for="radio-switch-84"
                          >High blood pressure</label
                        >
                      </div>
                    </div>
                  </div>
                  <div class="col-span-12 mt-3 xl:col-span-3">
                    <div class="flex flex-col sm:flex-row mt-2">
                      <div class="form-check mr-2">
                        <input
                          id="radio-switch-85"
                          class="form-check-input"
                          type="checkbox"
                          v-model="form.lung_disease"
                          name="lung_disease"
                          value="1"
                        />
                        <label class="form-check-label" for="radio-switch-85"
                          >Lung diseases (e.g. TB)</label
                        >
                      </div>
                    </div>
                  </div>
                  <div class="col-span-12 mt-3 xl:col-span-3">
                    <div class="flex flex-col sm:flex-row mt-2">
                      <div class="form-check mr-2">
                        <input
                          id="radio-switch-86"
                          class="form-check-input"
                          type="checkbox"
                          v-model="form.blood_transfusion"
                          name="blood_transfusion"
                          value="1"
                        />
                        <label class="form-check-label" for="radio-switch-86"
                          >Blood transfusion</label
                        >
                      </div>
                    </div>
                  </div>
                  <div class="col-span-12 mt-3 xl:col-span-3">
                    <div class="flex flex-col sm:flex-row mt-2">
                      <div class="form-check mr-2">
                        <input
                          id="radio-switch-87"
                          class="form-check-input"
                          type="checkbox"
                          v-model="form.hepatitis"
                          name="hepatitis"
                          value="1"
                        />
                        <label class="form-check-label" for="radio-switch-87"
                          >Hepatitis / Jaundice</label
                        >
                      </div>
                    </div>
                  </div>
                  <div class="col-span-12 mt-3 xl:col-span-3">
                    <div class="flex flex-col sm:flex-row mt-2">
                      <div class="form-check mr-2">
                        <input
                          id="radio-switch-88"
                          class="form-check-input"
                          type="checkbox"
                          v-model="form.blood_disorder"
                          name="blood_disorder"
                          value="1"
                        />
                        <label class="form-check-label" for="radio-switch-88"
                          >Blood disorder (e.g. aneamia, thalassaemia)</label
                        >
                      </div>
                    </div>
                  </div>
                  <div class="col-span-12 mt-3 xl:col-span-3">
                    <div class="flex flex-col sm:flex-row mt-2">
                      <div class="form-check mr-2">
                        <input
                          id="radio-switch-89"
                          class="form-check-input"
                          type="checkbox"
                          v-model="form.assault"
                          name="assault"
                          value="1"
                        />
                        <label class="form-check-label" for="radio-switch-89"
                          >Assault (physical/psychological)</label
                        >
                      </div>
                    </div>
                  </div>
                  <div class="col-span-12 mt-3 xl:col-span-3">
                    <div class="flex flex-col sm:flex-row mt-2">
                      <div class="form-check mr-2">
                        <input
                          id="radio-switch-90"
                          class="form-check-input"
                          type="checkbox"
                          v-model="form.hormone_problem"
                          name="hormone_problem"
                          value="1"
                        />
                        <label class="form-check-label" for="radio-switch-90"
                          >Hormone problems (e.g. thyroid)
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="col-span-12 mt-3 xl:col-span-3">
                    <div class="flex flex-col sm:flex-row mt-2">
                      <div class="form-check mr-2">
                        <input
                          id="radio-switch-91"
                          class="form-check-input"
                          type="checkbox"
                          v-model="form.bone_problem"
                          name="bone_problem"
                          value="1"
                        />
                        <label class="form-check-label" for="radio-switch-91"
                          >Muscle / bone problems</label
                        >
                      </div>
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-12 mt-4 border-top">
                    <h3 class="font-medium text-xl mt-2">Obstetric Risks</h3>
                    <p>Check if the patient has any of the following</p>
                  </div>
                  <div class="col-span-12 mt-3 xl:col-span-3">
                    <div class="flex flex-col sm:flex-row mt-2">
                      <div class="form-check mr-2">
                        <input
                          id="radio-switch-25"
                          class="form-check-input"
                          type="checkbox"
                          v-model="form.abnormal_pap_smear"
                          name="abnormal_pap_smear"
                          value="1"
                        />
                        <label class="form-check-label" for="radio-switch-25"
                          >Abnormal pap smear</label
                        >
                      </div>
                    </div>
                  </div>

                  <div class="col-span-12 mt-3 xl:col-span-3">
                    <div class="flex flex-col sm:flex-row mt-2">
                      <div class="form-check mr-2">
                        <input
                          id="radio-switch-27"
                          class="form-check-input"
                          type="checkbox"
                          v-model="form.bmi"
                          name="bmi"
                          value="1"
                        />
                        <label class="form-check-label" for="radio-switch-27"
                          >BMI > 30</label
                        >
                      </div>
                    </div>
                  </div>
                  <div class="col-span-12 mt-3 xl:col-span-3">
                    <div class="flex flex-col sm:flex-row mt-2">
                      <div class="form-check mr-2">
                        <input
                          id="radio-switch-28"
                          class="form-check-input"
                          type="checkbox"
                          v-model="form.gestational_diabetes"
                          name="gestational_diabetes"
                          value="1"
                        />
                        <label class="form-check-label" for="radio-switch-28"
                          >Gestational Diabetes</label
                        >
                      </div>
                    </div>
                  </div>
                  <div class="col-span-12 mt-3 xl:col-span-3">
                    <div class="flex flex-col sm:flex-row mt-2">
                      <div class="form-check mr-2">
                        <input
                          id="radio-switch-29"
                          class="form-check-input"
                          type="checkbox"
                          v-model="form.cervical_uterine_infections"
                          name="cervical_uterine_infections"
                          value="1"
                        />
                        <label class="form-check-label" for="radio-switch-29"
                          >History of cervical uterine infections</label
                        >
                      </div>
                    </div>
                  </div>
                  <div class="col-span-12 mt-3 xl:col-span-6">
                    <div class="flex flex-col sm:flex-row mt-2">
                      <div class="form-check mr-2">
                        <input
                          id="radio-switch-30"
                          class="form-check-input"
                          type="checkbox"
                          v-model="form.neurological_defect"
                          name="neurological_defect"
                          value="1"
                        />
                        <label class="form-check-label" for="radio-switch-30"
                          >History of infant with birth injury, neurological defect or
                          congenial abnormality</label
                        >
                      </div>
                    </div>
                  </div>
                  <div class="col-span-12 mt-3 xl:col-span-3">
                    <div class="flex flex-col sm:flex-row mt-2">
                      <div class="form-check mr-2">
                        <input
                          id="radio-switch-31"
                          class="form-check-input"
                          type="checkbox"
                          v-model="form.history_of_infertility"
                          name="history_of_infertility"
                          value="1"
                        />
                        <label class="form-check-label" for="radio-switch-31"
                          >History of infertility</label
                        >
                      </div>
                    </div>
                  </div>
                  <div class="col-span-12 mt-3 xl:col-span-3">
                    <div class="flex flex-col sm:flex-row mt-2">
                      <div class="form-check mr-2">
                        <input
                          id="radio-switch-32"
                          class="form-check-input"
                          type="checkbox"
                          v-model="form.inadequate_prenatal_care"
                          name="inadequate_prenatal_care"
                          value="1"
                        />
                        <label class="form-check-label" for="radio-switch-32"
                          >Indequate prenatal care</label
                        >
                      </div>
                    </div>
                  </div>
                  <div class="col-span-12 mt-3 xl:col-span-3">
                    <div class="flex flex-col sm:flex-row mt-2">
                      <div class="form-check mr-2">
                        <input
                          id="radio-switch-33"
                          class="form-check-input"
                          type="checkbox"
                          v-model="form.history_of_low_birth_weight"
                          name="history_of_low_birth_weight"
                          value="1"
                        />
                        <label class="form-check-label" for="radio-switch-33"
                          >History low birth weight infant</label
                        >
                      </div>
                    </div>
                  </div>
                  <div class="col-span-12 mt-3 xl:col-span-3">
                    <div class="flex flex-col sm:flex-row mt-2">
                      <div class="form-check mr-2">
                        <input
                          id="radio-switch-34"
                          class="form-check-input"
                          type="checkbox"
                          v-model="form.incompetent_cervix"
                          name="incompetent_cervix"
                          value="1"
                        />
                        <label class="form-check-label" for="radio-switch-34"
                          >Incompetent cervix</label
                        >
                      </div>
                    </div>
                  </div>
                  <div class="col-span-12 mt-3 xl:col-span-3">
                    <div class="flex flex-col sm:flex-row mt-2">
                      <div class="form-check mr-2">
                        <input
                          id="radio-switch-35"
                          class="form-check-input"
                          type="checkbox"
                          v-model="form.intrauterine_growth_retardation"
                          name="intrauterine_growth_retardation"
                          value="1"
                        />
                        <label class="form-check-label" for="radio-switch-35"
                          >Intrauterine growth retardation (IUGR)</label
                        >
                      </div>
                    </div>
                  </div>
                  <div class="col-span-12 mt-3 xl:col-span-3">
                    <div class="flex flex-col sm:flex-row mt-2">
                      <div class="form-check mr-2">
                        <input
                          id="radio-switch-36"
                          class="form-check-input"
                          type="checkbox"
                          v-model="form.placenta_previa"
                          name="placenta_previa"
                          value="1"
                        />
                        <label class="form-check-label" for="radio-switch-36"
                          >Placenta Previa/Placenta Abruptia</label
                        >
                      </div>
                    </div>
                  </div>
                  <div class="col-span-12 mt-3 xl:col-span-3">
                    <div class="flex flex-col sm:flex-row mt-2">
                      <div class="form-check mr-2">
                        <input
                          id="radio-switch-37"
                          class="form-check-input"
                          type="checkbox"
                          v-model="form.polyhydramnios"
                          name="polyhydramnios"
                          value="1"
                        />
                        <label class="form-check-label" for="radio-switch-37"
                          >Polyhydramnios/oligohydramnios</label
                        >
                      </div>
                    </div>
                  </div>
                  <div class="col-span-12 mt-3 xl:col-span-3">
                    <div class="flex flex-col sm:flex-row mt-2">
                      <div class="form-check mr-2">
                        <input
                          id="radio-switch-38"
                          class="form-check-input"
                          type="checkbox"
                          v-model="form.poor_weight_gain"
                          name="poor_weight_gain"
                          value="1"
                        />
                        <label class="form-check-label" for="radio-switch-38"
                          >Poor weight gain</label
                        >
                      </div>
                    </div>
                  </div>
                  <div class="col-span-12 mt-3 xl:col-span-3">
                    <div class="flex flex-col sm:flex-row mt-2">
                      <div class="form-check mr-2">
                        <input
                          id="radio-switch-39"
                          class="form-check-input"
                          type="checkbox"
                          v-model="form.postpartum_depression_family"
                          name="postpartum_depression_family"
                          value="1"
                        />
                        <label class="form-check-label" for="radio-switch-39"
                          >Postpartum depression—family history</label
                        >
                      </div>
                    </div>
                  </div>
                  <div class="col-span-12 mt-3 xl:col-span-3">
                    <div class="flex flex-col sm:flex-row mt-2">
                      <div class="form-check mr-2">
                        <input
                          id="radio-switch-40"
                          class="form-check-input"
                          type="checkbox"
                          v-model="form.postpartum_depression_personal"
                          name="postpartum_depression_personal"
                          value="1"
                        />
                        <label class="form-check-label" for="radio-switch-40"
                          >Postpartum depression—personal history</label
                        >
                      </div>
                    </div>
                  </div>
                  <div class="col-span-12 mt-3 xl:col-span-3">
                    <div class="flex flex-col sm:flex-row mt-2">
                      <div class="form-check mr-2">
                        <input
                          id="radio-switch-41"
                          class="form-check-input"
                          type="checkbox"
                          v-model="form.pregnancy_induced_hypertension"
                          name="pregnancy_induced_hypertension"
                          value="1"
                        />
                        <label class="form-check-label" for="radio-switch-41"
                          >Pregnancy-induced hypertension</label
                        >
                      </div>
                    </div>
                  </div>
                  <div class="col-span-12 mt-3 xl:col-span-3">
                    <div class="flex flex-col sm:flex-row mt-2">
                      <div class="form-check mr-2">
                        <input
                          id="radio-switch-42"
                          class="form-check-input"
                          type="checkbox"
                          v-model="form.pre_pregnant_weight"
                          name="pre_pregnant_weight"
                          value="1"
                        />
                        <label class="form-check-label" for="radio-switch-42"
                          >Pre-pregnancy weight of less than 100 pounds</label
                        >
                      </div>
                    </div>
                  </div>
                  <div class="col-span-12 mt-3 xl:col-span-3">
                    <div class="flex flex-col sm:flex-row mt-2">
                      <div class="form-check mr-2">
                        <input
                          id="radio-switch-43"
                          class="form-check-input"
                          type="checkbox"
                          v-model="form.previous_pre_term_labour"
                          name="previous_pre_term_labour"
                          value="1"
                        />
                        <label class="form-check-label" for="radio-switch-43"
                          >Previous pre-term labour (PTL)</label
                        >
                      </div>
                    </div>
                  </div>
                  <div class="col-span-12 mt-3 xl:col-span-3">
                    <div class="flex flex-col sm:flex-row mt-2">
                      <div class="form-check mr-2">
                        <input
                          id="radio-switch-44"
                          class="form-check-input"
                          type="checkbox"
                          v-model="form.previous_pre_term_delivery"
                          name="previous_pre_term_delivery"
                          value="1"
                        />
                        <label class="form-check-label" for="radio-switch-44"
                          >Previous pre-term delivery (PTD)</label
                        >
                      </div>
                    </div>
                  </div>
                  <div class="col-span-12 mt-3 xl:col-span-3">
                    <div class="flex flex-col sm:flex-row mt-2">
                      <div class="form-check mr-2">
                        <input
                          id="radio-switch-45"
                          class="form-check-input"
                          type="checkbox"
                          v-model="form.previous_stillborn"
                          name="previous_stillborn"
                          value="1"
                        />
                        <label class="form-check-label" for="radio-switch-45"
                          >Previous stillborn/neonatal death</label
                        >
                      </div>
                    </div>
                  </div>
                  <div class="col-span-12 mt-3 xl:col-span-3">
                    <div class="flex flex-col sm:flex-row mt-2">
                      <div class="form-check mr-2">
                        <input
                          id="radio-switch-46"
                          class="form-check-input"
                          type="checkbox"
                          v-model="form.multiple_gestation"
                          name="multiple_gestation"
                          value="1"
                        />
                        <label class="form-check-label" for="radio-switch-46"
                          >Multiple gestation</label
                        >
                      </div>
                    </div>
                  </div>

                  <div class="col-span-12 mt-3 xl:col-span-3">
                    <div class="flex flex-col sm:flex-row mt-2">
                      <div class="form-check mr-2">
                        <input
                          id="radio-switch-47"
                          class="form-check-input"
                          type="checkbox"
                          v-model="form.rh_sensitization"
                          name="rh_sensitization"
                          value="1"
                        />
                        <label class="form-check-label" for="radio-switch-47"
                          >Rh sensitization</label
                        >
                      </div>
                    </div>
                  </div>
                  <div class="col-span-12 mt-3 xl:col-span-3">
                    <div class="flex flex-col sm:flex-row mt-2">
                      <div class="form-check mr-2">
                        <input
                          id="radio-switch-48"
                          class="form-check-input"
                          type="checkbox"
                          v-model="form.sexually_transmitted_disease"
                          name="sexually_transmitted_disease"
                          value="1"
                        />
                        <label class="form-check-label" for="radio-switch-48"
                          >Sexually Transmitted Disease</label
                        >
                      </div>
                    </div>
                  </div>
                  <div class="col-span-12 mt-3 xl:col-span-3">
                    <div class="flex flex-col sm:flex-row mt-2">
                      <div class="form-check mr-2">
                        <input
                          id="radio-switch-49"
                          class="form-check-input"
                          type="checkbox"
                          v-model="form.therapeutics_abortion"
                          name="therapeutics_abortion"
                          value="1"
                        />
                        <label class="form-check-label" for="radio-switch-49"
                          >2 or more spontaneous abortions (SABs) or therapeutic abortions
                          (TABs)</label
                        >
                      </div>
                    </div>
                  </div>
                  <div class="col-span-12 mt-3 xl:col-span-3">
                    <div class="flex flex-col sm:flex-row mt-2">
                      <div class="form-check mr-2">
                        <input
                          id="radio-switch-50"
                          class="form-check-input"
                          type="checkbox"
                          v-model="form.uterine_anomally"
                          name="uterine_anomally"
                          value="1"
                        />
                        <label class="form-check-label" for="radio-switch-50"
                          >Uterine/cervical anomaly</label
                        >
                      </div>
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-12 mt-4 border-top">
                    <h3 class="font-medium text-xl mt-2">Obstetric History</h3>
                    <p>Provide the number for the following</p>
                  </div>
                  <div class="col-span-12 mt-3 xl:col-span-3">
                    <label for="number_of_pregnancy" class="form-label"
                      >Number of Pregnancy > 22 weeks gestation</label
                    >
                    <input
                      id="number_of_pregnancy"
                      type="number"
                      class="form-control"
                      v-model="form.number_of_pregnancy"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.number_of_pregnancy"
                    >
                      {{ errors.number_of_pregnancy[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 mt-3 xl:col-span-3">
                    <label for="number_of_previous_vaginal_deliveries" class="form-label"
                      >Number of Previous Vaginal Delivery</label
                    >
                    <input
                      id="number_of_previous_vaginal_deliveries"
                      type="number"
                      class="form-control"
                      v-model="form.number_of_previous_vaginal_deliveries"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.number_of_previous_vaginal_deliveries"
                    >
                      {{ errors.number_of_previous_vaginal_deliveries[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 mt-3 xl:col-span-3">
                    <label for="number_of_surviving_children" class="form-label"
                      >Number of Surviving Children</label
                    >
                    <input
                      id="number_of_surviving_children"
                      type="number"
                      class="form-control"
                      v-model="form.number_of_surviving_children"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.number_of_surviving_children"
                    >
                      {{ errors.number_of_surviving_children[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 mt-3 xl:col-span-3">
                    <label for="number_of_caesarian_sections" class="form-label"
                      >Number of Caesarian Section</label
                    >
                    <input
                      id="number_of_caesarian_sections"
                      type="number"
                      class="form-control"
                      v-model="form.number_of_caesarian_sections"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.number_of_caesarian_sections"
                    >
                      {{ errors.number_of_caesarian_sections[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 mt-2">
                    <p class="font-medium">
                      Please tick any which apply to previous deliveries:
                    </p>
                  </div>
                  <div class="col-span-12 xl:col-span-12 mt-3">
                    <div class="grid grid-cols-12 gap-x-5">
                      <div class="col-span-12 xl:col-span-4">
                        <label for="" class="form-label mt-2"
                          >Preterm birth (&lt; 37 weeks' gestation)</label
                        >
                      </div>
                      <div class="col-span-12 xl:col-span-8">
                        <div class="flex flex-col sm:flex-row mt-2">
                          <div class="form-check mr-2">
                            <input
                              id="radio-switch-300"
                              class="form-check-input"
                              type="radio"
                              name="nsaid"
                              v-model="form.preterm_birth"
                              value="Yes"
                            />
                            <label class="form-check-label" for="radio-switch-300"
                              >Yes</label
                            >
                          </div>
                          <div class="form-check mr-2 mt-2 sm:mt-0">
                            <input
                              id="radio-switch-301"
                              class="form-check-input"
                              type="radio"
                              name="nsaid"
                              v-model="form.preterm_birth"
                              value="No"
                            />
                            <label class="form-check-label" for="radio-switch-301"
                              >No</label
                            >
                          </div>
                          <div class="form-check mr-2 mt-2 sm:mt-0">
                            <input
                              id="radio-switch-302"
                              class="form-check-input"
                              type="radio"
                              name="nsaid"
                              v-model="form.preterm_birth"
                              value="Unknown"
                            />
                            <label class="form-check-label" for="radio-switch-302"
                              >Unknown</label
                            >
                          </div>
                        </div>
                        <div
                          class="text-danger font-medium text-xs mt-1"
                          v-if="errors.preterm_birth"
                        >
                          {{ errors.preterm_birth[0] }}
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-12 mt-3">
                    <div class="grid grid-cols-12 gap-x-5">
                      <div class="col-span-12 xl:col-span-4">
                        <label for="" class="form-label mt-2">Congenital anomaly</label>
                      </div>
                      <div class="col-span-12 xl:col-span-8">
                        <div class="flex flex-col sm:flex-row mt-2">
                          <div class="form-check mr-2">
                            <input
                              id="radio-switch-303"
                              class="form-check-input"
                              type="radio"
                              name="congenital_anomaly"
                              v-model="form.congenital_anomaly"
                              value="Yes"
                            />
                            <label class="form-check-label" for="radio-switch-303"
                              >Yes</label
                            >
                          </div>
                          <div class="form-check mr-2 mt-2 sm:mt-0">
                            <input
                              id="radio-switch-304"
                              class="form-check-input"
                              type="radio"
                              name="congenital_anomaly"
                              v-model="form.congenital_anomaly"
                              value="No"
                            />
                            <label class="form-check-label" for="radio-switch-304"
                              >No</label
                            >
                          </div>
                          <div class="form-check mr-2 mt-2 sm:mt-0">
                            <input
                              id="radio-switch-305"
                              class="form-check-input"
                              type="radio"
                              name="congenital_anomaly"
                              v-model="form.congenital_anomaly"
                              value="Unknown"
                            />
                            <label class="form-check-label" for="radio-switch-305"
                              >Unknown</label
                            >
                          </div>
                        </div>
                        <div
                          class="text-danger font-medium text-xs mt-1"
                          v-if="errors.congenital_anomaly"
                        >
                          {{ errors.congenital_anomaly[0] }}
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-12 mt-3">
                    <div class="grid grid-cols-12 gap-x-5">
                      <div class="col-span-12 xl:col-span-4">
                        <label for="" class="form-label mt-2">Stillborn</label>
                      </div>
                      <div class="col-span-12 xl:col-span-8">
                        <div class="flex flex-col sm:flex-row mt-2">
                          <div class="form-check mr-2">
                            <input
                              id="radio-switch-306"
                              class="form-check-input"
                              type="radio"
                              name="stillborn"
                              v-model="form.stillborn"
                              value="Yes"
                            />
                            <label class="form-check-label" for="radio-switch-306"
                              >Yes</label
                            >
                          </div>
                          <div class="form-check mr-2 mt-2 sm:mt-0">
                            <input
                              id="radio-switch-307"
                              class="form-check-input"
                              type="radio"
                              name="stillborn"
                              v-model="form.stillborn"
                              value="No"
                            />
                            <label class="form-check-label" for="radio-switch-307"
                              >No</label
                            >
                          </div>
                          <div class="form-check mr-2 mt-2 sm:mt-0">
                            <input
                              id="radio-switch-308"
                              class="form-check-input"
                              type="radio"
                              name="stillborn"
                              v-model="form.stillborn"
                              value="Unknown"
                            />
                            <label class="form-check-label" for="radio-switch-308"
                              >Unknown</label
                            >
                          </div>
                        </div>
                        <div
                          class="text-danger font-medium text-xs mt-1"
                          v-if="errors.stillborn"
                        >
                          {{ errors.stillborn[0] }}
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-12 mt-3">
                    <div class="grid grid-cols-12 gap-x-5">
                      <div class="col-span-12 xl:col-span-4">
                        <label for="" class="form-label mt-2"
                          >Neonatal death (0 - 6 days)</label
                        >
                      </div>
                      <div class="col-span-12 xl:col-span-8">
                        <div class="flex flex-col sm:flex-row mt-2">
                          <div class="form-check mr-2">
                            <input
                              id="radio-switch-309"
                              class="form-check-input"
                              type="radio"
                              name="neonatal_death"
                              v-model="form.neonatal_death"
                              value="Yes"
                            />
                            <label class="form-check-label" for="radio-switch-309"
                              >Yes</label
                            >
                          </div>
                          <div class="form-check mr-2 mt-2 sm:mt-0">
                            <input
                              id="radio-switch-310"
                              class="form-check-input"
                              type="radio"
                              name="neonatal_death"
                              v-model="form.neonatal_death"
                              value="No"
                            />
                            <label class="form-check-label" for="radio-switch-310"
                              >No</label
                            >
                          </div>
                          <div class="form-check mr-2 mt-2 sm:mt-0">
                            <input
                              id="radio-switch-311"
                              class="form-check-input"
                              type="radio"
                              name="neonatal_death"
                              v-model="form.neonatal_death"
                              value="Unknown"
                            />
                            <label class="form-check-label" for="radio-switch-311"
                              >Unknown</label
                            >
                          </div>
                          <div class="w-full" v-if="form.neonatal_death == 'Yes'">
                            <input
                              type="text"
                              v-model="form.neonatal_death_days"
                              placeholder="Neonatal death days"
                              class="form-control"
                            />
                          </div>
                        </div>
                        <div
                          class="text-danger font-medium text-xs mt-1"
                          v-if="errors.neonatal_death"
                        >
                          {{ errors.neonatal_death[0] }}
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-12 mt-3">
                    <div class="grid grid-cols-12 gap-x-5">
                      <div class="col-span-12 xl:col-span-4">
                        <label for="" class="form-label mt-2">Weight &lt; 2.5 kg</label>
                      </div>
                      <div class="col-span-12 xl:col-span-8">
                        <div class="flex flex-col sm:flex-row mt-2">
                          <div class="form-check mr-2">
                            <input
                              id="radio-switch-312"
                              class="form-check-input"
                              type="radio"
                              name="lesser_weight"
                              v-model="form.lesser_weight"
                              value="Yes"
                            />
                            <label class="form-check-label" for="radio-switch-312"
                              >Yes</label
                            >
                          </div>
                          <div class="form-check mr-2 mt-2 sm:mt-0">
                            <input
                              id="radio-switch-313"
                              class="form-check-input"
                              type="radio"
                              name="lesser_weight"
                              v-model="form.lesser_weight"
                              value="No"
                            />
                            <label class="form-check-label" for="radio-switch-313"
                              >No</label
                            >
                          </div>
                          <div class="form-check mr-2 mt-2 sm:mt-0">
                            <input
                              id="radio-switch-314"
                              class="form-check-input"
                              type="radio"
                              name="lesser_weight"
                              v-model="form.lesser_weight"
                              value="Unknown"
                            />
                            <label class="form-check-label" for="radio-switch-314"
                              >Unknown</label
                            >
                          </div>
                        </div>
                        <div
                          class="text-danger font-medium text-xs mt-1"
                          v-if="errors.lesser_weight"
                        >
                          {{ errors.lesser_weight[0] }}
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-12 mt-3">
                    <div class="grid grid-cols-12 gap-x-5">
                      <div class="col-span-12 xl:col-span-4">
                        <label for="" class="form-label mt-2">Weight &gt; 4.5kg</label>
                      </div>
                      <div class="col-span-12 xl:col-span-8">
                        <div class="flex flex-col sm:flex-row mt-2">
                          <div class="form-check mr-2">
                            <input
                              id="radio-switch-315"
                              class="form-check-input"
                              type="radio"
                              name="greater_weight"
                              v-model="form.greater_weight"
                              value="Yes"
                            />
                            <label class="form-check-label" for="radio-switch-315"
                              >Yes</label
                            >
                          </div>
                          <div class="form-check mr-2 mt-2 sm:mt-0">
                            <input
                              id="radio-switch-316"
                              class="form-check-input"
                              type="radio"
                              name="greater_weight"
                              v-model="form.greater_weight"
                              value="No"
                            />
                            <label class="form-check-label" for="radio-switch-316"
                              >No</label
                            >
                          </div>
                          <div class="form-check mr-2 mt-2 sm:mt-0">
                            <input
                              id="radio-switch-317"
                              class="form-check-input"
                              type="radio"
                              name="greater_weight"
                              v-model="form.greater_weight"
                              value="Unknown"
                            />
                            <label class="form-check-label" for="radio-switch-317"
                              >Unknown</label
                            >
                          </div>
                        </div>
                        <div
                          class="text-danger font-medium text-xs mt-1"
                          v-if="errors.greater_weight"
                        >
                          {{ errors.greater_weight[0] }}
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-12 mt-4 border-top">
                    <h3 class="font-medium text-xl mt-2">
                      Medications During This Pregnancy
                    </h3>
                    <p>Prior to onset of current illness episode</p>
                  </div>

                  <div class="col-span-12 xl:col-span-12">
                    <div class="grid grid-cols-12 gap-x-5">
                      <div class="col-span-12 xl:col-span-3">
                        <label for="" class="form-label mt-12"
                          >Fever or pain treatment</label
                        >
                      </div>
                      <div class="col-span-12 xl:col-span-9">
                        <div class="grid grid-cols-12 gap-x-5">
                          <div class="col-span-12 xl:col-span-6">
                            <label for="" class="form-label"
                              >Acetaminophen/Paracetamol</label
                            >
                          </div>
                          <div class="col-span-12 xl:col-span-6">
                            <div class="flex flex-col sm:flex-row mt-2">
                              <div class="form-check mr-2">
                                <input
                                  id="radio-switch-400"
                                  class="form-check-input"
                                  type="radio"
                                  name="paracetamol"
                                  v-model="form.paracetamol"
                                  value="Yes"
                                />
                                <label class="form-check-label" for="radio-switch-400"
                                  >Yes</label
                                >
                              </div>
                              <div class="form-check mr-2 mt-2 sm:mt-0">
                                <input
                                  id="radio-switch-500"
                                  class="form-check-input"
                                  type="radio"
                                  name="paracetamol"
                                  v-model="form.paracetamol"
                                  value="No"
                                />
                                <label class="form-check-label" for="radio-switch-500"
                                  >No</label
                                >
                              </div>
                              <div class="form-check mr-2 mt-2 sm:mt-0">
                                <input
                                  id="radio-switch-600"
                                  class="form-check-input"
                                  type="radio"
                                  name="paracetamol"
                                  v-model="form.paracetamol"
                                  value="Unknown"
                                />
                                <label class="form-check-label" for="radio-switch-600"
                                  >Unknown</label
                                >
                              </div>
                            </div>
                            <div
                              class="text-danger font-medium text-xs mt-1"
                              v-if="errors.paracetamol"
                            >
                              {{ errors.paracetamol[0] }}
                            </div>
                          </div>
                          <div class="col-span-12 xl:col-span-6">
                            <label for="" class="form-label">NSAID/s</label>
                          </div>
                          <div class="col-span-12 xl:col-span-6">
                            <div class="flex flex-col sm:flex-row mt-2">
                              <div class="form-check mr-2">
                                <input
                                  id="radio-switch-700"
                                  class="form-check-input"
                                  type="radio"
                                  name="nsaid"
                                  v-model="form.nsaid"
                                  value="Yes"
                                />
                                <label class="form-check-label" for="radio-switch-700"
                                  >Yes</label
                                >
                              </div>
                              <div class="form-check mr-2 mt-2 sm:mt-0">
                                <input
                                  id="radio-switch-800"
                                  class="form-check-input"
                                  type="radio"
                                  name="nsaid"
                                  v-model="form.nsaid"
                                  value="No"
                                />
                                <label class="form-check-label" for="radio-switch-800"
                                  >No</label
                                >
                              </div>
                              <div class="form-check mr-2 mt-2 sm:mt-0">
                                <input
                                  id="radio-switch-900"
                                  class="form-check-input"
                                  type="radio"
                                  name="nsaid"
                                  v-model="form.nsaid"
                                  value="Unknown"
                                />
                                <label class="form-check-label" for="radio-switch-900"
                                  >Unknown</label
                                >
                              </div>
                            </div>
                            <div
                              class="text-danger font-medium text-xs mt-1"
                              v-if="errors.nsaid"
                            >
                              {{ errors.nsaid[0] }}
                            </div>
                          </div>
                          <div class="col-span-12">
                            <label for="" class="form-label">Other/s (specify)</label>
                            <input
                              type="text"
                              class="form-control"
                              v-model="form.fever_specify"
                            />
                          </div>
                        </div>
                      </div>
                      <div class="col-span-12 xl:col-span-3">
                        <label for="" class="form-label mt-6">Anticonvulsants</label>
                      </div>
                      <div class="col-span-12 xl:col-span-9">
                        <div class="flex flex-col sm:flex-row mt-2">
                          <div class="form-check mr-2">
                            <input
                              id="radio-switch-1000"
                              class="form-check-input"
                              type="radio"
                              name="anticonvulsants"
                              v-model="form.anticonvulsants"
                              value="Yes"
                            />
                            <label class="form-check-label" for="radio-switch-1000"
                              >Yes</label
                            >
                          </div>
                          <div class="form-check mr-2 mt-2 sm:mt-0">
                            <input
                              id="radio-switch-1100"
                              class="form-check-input"
                              type="radio"
                              name="anticonvulsants"
                              v-model="form.anticonvulsants"
                              value="No"
                            />
                            <label class="form-check-label" for="radio-switch-1100"
                              >No</label
                            >
                          </div>
                          <div class="form-check mr-2 mt-2 sm:mt-0">
                            <input
                              id="radio-switch-1200"
                              class="form-check-input"
                              type="radio"
                              name="anticonvulsants"
                              v-model="form.anticonvulsants"
                              value="Unknown"
                            />
                            <label class="form-check-label" for="radio-switch-1200"
                              >Unknown</label
                            >
                          </div>
                          <div class="sm:mt-0" v-if="form.anticonvulsants == 'Yes'">
                            <input
                              id="anticonvulsants_generic_name"
                              type="text"
                              required
                              class="form-control"
                              placeholder="Specify generic name"
                              v-model="form.anticonvulsants_generic_name"
                            />
                          </div>
                        </div>
                        <div
                          class="text-danger font-medium text-xs mt-1"
                          v-if="errors.anticonvulsants"
                        >
                          {{ errors.anticonvulsants[0] }}
                        </div>
                      </div>
                      <div class="col-span-12 xl:col-span-3">
                        <label for="" class="form-label mt-6">Antinausea</label>
                      </div>
                      <div class="col-span-12 xl:col-span-9">
                        <div class="flex flex-col sm:flex-row mt-2">
                          <div class="form-check mr-2">
                            <input
                              id="radio-switch-2000"
                              class="form-check-input"
                              type="radio"
                              name="antinausea"
                              v-model="form.antinausea"
                              value="Yes"
                            />
                            <label class="form-check-label" for="radio-switch-2000"
                              >Yes</label
                            >
                          </div>
                          <div class="form-check mr-2 mt-2 sm:mt-0">
                            <input
                              id="radio-switch-2100"
                              class="form-check-input"
                              type="radio"
                              name="antinausea"
                              v-model="form.antinausea"
                              value="No"
                            />
                            <label class="form-check-label" for="radio-switch-2100"
                              >No</label
                            >
                          </div>
                          <div class="form-check mr-2 mt-2 sm:mt-0">
                            <input
                              id="radio-switch-2200"
                              class="form-check-input"
                              type="radio"
                              name="antinausea"
                              v-model="form.antinausea"
                              value="Unknown"
                            />
                            <label class="form-check-label" for="radio-switch-2200"
                              >Unknown</label
                            >
                          </div>
                          <div class="sm:mt-0" v-if="form.antinausea == 'Yes'">
                            <input
                              id="antinausea_generic_name"
                              type="text"
                              required
                              placeholder="Specify generic name"
                              class="form-control"
                              v-model="form.antinausea_generic_name"
                            />
                          </div>
                        </div>
                        <div
                          class="text-danger font-medium text-xs mt-1"
                          v-if="errors.antinausea"
                        >
                          {{ errors.antinausea[0] }}
                        </div>
                      </div>
                      <div class="col-span-12 xl:col-span-3">
                        <label for="" class="form-label mt-4"
                          >Prenatals vitamins and micronutrients</label
                        >
                      </div>
                      <div class="col-span-12 xl:col-span-9">
                        <div class="flex flex-col sm:flex-row mt-2">
                          <div class="form-check mr-2">
                            <input
                              id="radio-switch-3000"
                              class="form-check-input"
                              type="radio"
                              name="prenatal_vitamins"
                              v-model="form.prenatal_vitamins"
                              value="Yes"
                            />
                            <label class="form-check-label" for="radio-switch-3000"
                              >Yes</label
                            >
                          </div>
                          <div class="form-check mr-2 mt-2 sm:mt-0">
                            <input
                              id="radio-switch-3100"
                              class="form-check-input"
                              type="radio"
                              name="prenatal_vitamins"
                              v-model="form.prenatal_vitamins"
                              value="No"
                            />
                            <label class="form-check-label" for="radio-switch-3100"
                              >No</label
                            >
                          </div>
                          <div class="form-check mr-2 mt-2 sm:mt-0">
                            <input
                              id="radio-switch-3200"
                              class="form-check-input"
                              type="radio"
                              name="prenatal_vitamins"
                              v-model="form.prenatal_vitamins"
                              value="Unknown"
                            />
                            <label class="form-check-label" for="radio-switch-3200"
                              >Unknown</label
                            >
                          </div>
                          <div class="sm:mt-0" v-if="form.prenatal_vitamins == 'Yes'">
                            <input
                              id="prenatal_vitamins_generic_name"
                              type="text"
                              placeholder="Specify generic name"
                              class="form-control"
                              v-model="form.prenatal_vitamins_generic_name"
                            />
                          </div>
                        </div>
                        <div
                          class="text-danger font-medium text-xs mt-1"
                          v-if="errors.prenatal_vitamins"
                        >
                          {{ errors.prenatal_vitamins[0] }}
                        </div>
                      </div>
                      <div class="col-span-12 xl:col-span-3">
                        <label for="" class="form-label mt-6">Antivirals</label>
                      </div>
                      <div class="col-span-12 xl:col-span-9">
                        <div class="flex flex-col sm:flex-row mt-2">
                          <div class="form-check mr-2">
                            <input
                              id="radio-switch-4000"
                              class="form-check-input"
                              type="radio"
                              name="antivirals"
                              v-model="form.antivirals"
                              value="Yes"
                            />
                            <label class="form-check-label" for="radio-switch-4000"
                              >Yes</label
                            >
                          </div>
                          <div class="form-check mr-2 mt-2 sm:mt-0">
                            <input
                              id="radio-switch-4100"
                              class="form-check-input"
                              type="radio"
                              name="antivirals"
                              v-model="form.antivirals"
                              value="No"
                            />
                            <label class="form-check-label" for="radio-switch-4100"
                              >No</label
                            >
                          </div>
                          <div class="form-check mr-2 mt-2 sm:mt-0">
                            <input
                              id="radio-switch-4200"
                              class="form-check-input"
                              type="radio"
                              name="antivirals"
                              v-model="form.antivirals"
                              value="Unknown"
                            />
                            <label class="form-check-label" for="radio-switch-4200"
                              >Unknown</label
                            >
                          </div>
                          <div class="sm:mt-0" v-if="form.antivirals == 'Yes'">
                            <input
                              id="prenatal_vitamins_generic_name"
                              type="text"
                              placeholder="Specify generic name"
                              class="form-control"
                              v-model="form.antivirals_generic_name"
                            />
                          </div>
                        </div>
                        <div
                          class="text-danger font-medium text-xs mt-1"
                          v-if="errors.antivirals"
                        >
                          {{ errors.antivirals[0] }}
                        </div>
                      </div>
                      <div class="col-span-12 xl:col-span-3">
                        <label for="" class="form-label mt-6">Antibiotics</label>
                      </div>
                      <div class="col-span-12 xl:col-span-9">
                        <div class="flex flex-col sm:flex-row mt-2">
                          <div class="form-check mr-2">
                            <input
                              id="radio-switch-5000"
                              class="form-check-input"
                              type="radio"
                              name="antibiotics"
                              v-model="form.antibiotics"
                              value="Yes"
                            />
                            <label class="form-check-label" for="radio-switch-5000"
                              >Yes</label
                            >
                          </div>
                          <div class="form-check mr-2 mt-2 sm:mt-0">
                            <input
                              id="radio-switch-5100"
                              class="form-check-input"
                              type="radio"
                              name="antibiotics"
                              v-model="form.antibiotics"
                              value="No"
                            />
                            <label class="form-check-label" for="radio-switch-5100"
                              >No</label
                            >
                          </div>
                          <div class="form-check mr-2 mt-2 sm:mt-0">
                            <input
                              id="radio-switch-5200"
                              class="form-check-input"
                              type="radio"
                              name="antibiotics"
                              v-model="form.antibiotics"
                              value="Unknown"
                            />
                            <label class="form-check-label" for="radio-switch-5200"
                              >Unknown</label
                            >
                          </div>
                          <div class="sm:mt-0" v-if="form.antibiotics == 'Yes'">
                            <input
                              id="antibiotics_generic_name"
                              type="text"
                              placeholder="Specify generic name"
                              class="form-control"
                              v-model="form.antibiotics_generic_name"
                            />
                          </div>
                        </div>
                        <div
                          class="text-danger font-medium text-xs mt-1"
                          v-if="errors.antibiotics"
                        >
                          {{ errors.antibiotics[0] }}
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-span-12 xl:col-span-12 mt-4 border-top">
                    <h3 class="font-medium text-xl mt-2">Fetal Heart Rate</h3>
                    <p>First available data at presentation/admission</p>
                  </div>
                  <div class="col-span-12 xl:col-span-6">
                    <label for="fetal_heart_rate" class="form-label"
                      >Fetal Heart Rate</label
                    >
                  </div>
                  <div class="col-span-12 xl:col-span-6">
                    <input
                      id="fetal_heart_rate"
                      type="text"
                      class="form-control"
                      v-model="form.fetal_heart_rate"
                      placeholder="beats/min"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.fetal_heart_rate"
                    >
                      {{ errors.fetal_heart_rate[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-12 mt-4 border-top">
                    <h3 class="font-medium text-xl mt-2">Family History</h3>
                    <p>Check if the patient has any of the following family history</p>
                  </div>
                  <div class="col-span-12 xl:col-span-6">
                    <div class="grid grid-cols-12 gap-x-5">
                      <label for="twins" class="col-span-12 xl:col-span-8 form-label mt-3"
                        >Twins</label
                      >
                      <div
                        class="col-span-12 xl:col-span-4 flex flex-col sm:flex-row mt-2"
                      >
                        <div class="form-check mr-2">
                          <input
                            id="radio-switch-120"
                            class="form-check-input"
                            type="radio"
                            name="twins"
                            v-model="form.twins"
                            value="Yes"
                          />
                          <label class="form-check-label" for="radio-switch-120"
                            >Yes</label
                          >
                        </div>
                        <div class="form-check mr-2 mt-2 sm:mt-0">
                          <input
                            id="radio-switch-121"
                            class="form-check-input"
                            type="radio"
                            name="twins"
                            v-model="form.twins"
                            value="No"
                          />
                          <label class="form-check-label" for="radio-switch-121"
                            >No</label
                          >
                        </div>
                      </div>
                    </div>

                    <div class="text-danger font-medium text-xs mt-1" v-if="errors.twins">
                      {{ errors.twins[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-6">
                    <div class="grid grid-cols-12 gap-x-5">
                      <label
                        for="high_blood_pressure"
                        class="col-span-12 xl:col-span-8 form-label mt-3"
                        >High blood pressure</label
                      >
                      <div
                        class="col-span-12 xl:col-span-4 flex flex-col sm:flex-row mt-2"
                      >
                        <div class="form-check mr-2">
                          <input
                            id="radio-switch-122"
                            class="form-check-input"
                            type="radio"
                            name="high_blood_pressure"
                            v-model="form.high_blood_pressure"
                            value="Yes"
                          />
                          <label class="form-check-label" for="radio-switch-122"
                            >Yes</label
                          >
                        </div>
                        <div class="form-check mr-2 mt-2 sm:mt-0">
                          <input
                            id="radio-switch-123"
                            class="form-check-input"
                            type="radio"
                            name="high_blood_pressure"
                            v-model="form.high_blood_pressure"
                            value="No"
                          />
                          <label class="form-check-label" for="radio-switch-123"
                            >No</label
                          >
                        </div>
                      </div>
                    </div>

                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.high_blood_pressure"
                    >
                      {{ errors.high_blood_pressure[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-6">
                    <div class="grid grid-cols-12 gap-x-5">
                      <label
                        for="aboriginal_status"
                        class="col-span-12 xl:col-span-8 form-label mt-2"
                        >Aboriginal status of baby</label
                      >
                      <div
                        class="col-span-12 xl:col-span-4 flex flex-col sm:flex-row mt-2"
                      >
                        <div class="form-check mr-2">
                          <input
                            id="radio-switch-124"
                            class="form-check-input"
                            type="radio"
                            name="aboriginal_status"
                            v-model="form.aboriginal_status"
                            value="Yes"
                          />
                          <label class="form-check-label" for="radio-switch-124"
                            >Yes</label
                          >
                        </div>
                        <div class="form-check mr-2 mt-2 sm:mt-0">
                          <input
                            id="radio-switch-125"
                            class="form-check-input"
                            type="radio"
                            name="aboriginal_status"
                            v-model="form.aboriginal_status"
                            value="No"
                          />
                          <label class="form-check-label" for="radio-switch-125"
                            >No</label
                          >
                        </div>
                      </div>
                    </div>
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.aboriginal_status"
                    >
                      {{ errors.aboriginal_status[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-6">
                    <div class="grid grid-cols-12 gap-x-5">
                      <label
                        for="genetic_disorders"
                        class="col-span-12 xl:col-span-8 form-label mt-2"
                        >Genetic disorders</label
                      >
                      <div
                        class="col-span-12 xl:col-span-4 flex flex-col sm:flex-row mt-2"
                      >
                        <div class="form-check mr-2">
                          <input
                            id="radio-switch-126"
                            class="form-check-input"
                            type="radio"
                            name="genetic_disorders"
                            v-model="form.genetic_disorders"
                            value="Yes"
                          />
                          <label class="form-check-label" for="radio-switch-126"
                            >Yes</label
                          >
                        </div>
                        <div class="form-check mr-2 mt-2 sm:mt-0">
                          <input
                            id="radio-switch-127"
                            class="form-check-input"
                            type="radio"
                            name="genetic_disorders"
                            v-model="form.genetic_disorders"
                            value="No"
                          />
                          <label class="form-check-label" for="radio-switch-127"
                            >No</label
                          >
                        </div>
                      </div>
                    </div>

                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.genetic_disorders"
                    >
                      {{ errors.genetic_disorders[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-6">
                    <div class="grid grid-cols-12 gap-x-5">
                      <label
                        for="family_diabetes"
                        class="col-span-12 xl:col-span-8 form-label mt-2"
                        >Diabetes</label
                      >
                      <div
                        class="col-span-12 xl:col-span-4 flex flex-col sm:flex-row mt-2"
                      >
                        <div class="form-check mr-2">
                          <input
                            id="radio-switch-128"
                            class="form-check-input"
                            type="radio"
                            name="family_diabetes"
                            v-model="form.family_diabetes"
                            value="Yes"
                          />
                          <label class="form-check-label" for="radio-switch-128"
                            >Yes</label
                          >
                        </div>
                        <div class="form-check mr-2 mt-2 sm:mt-0">
                          <input
                            id="radio-switch-129"
                            class="form-check-input"
                            type="radio"
                            name="family_diabetes"
                            v-model="form.family_diabetes"
                            value="No"
                          />
                          <label class="form-check-label" for="radio-switch-129"
                            >No</label
                          >
                        </div>
                      </div>
                    </div>

                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.family_diabetes"
                    >
                      {{ errors.family_diabetes[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-12 mt-3">
                    <label for="family_specify" class="form-label"
                      >If yes to any of the selection above, please specify </label
                    ><input
                      type="text"
                      v-model="form.family_specify"
                      id="family_specify"
                      class="form-control"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.family_specify"
                    >
                      {{ errors.family_specify[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-12 mt-3">
                    <label for="medical_illness" class="form-label"
                      >Do you have any other medical illnesses (i.e. Crohn's Disease,
                      eczema, disability, deafness, blindness, etc.)? </label
                    ><input
                      type="text"
                      v-model="form.medical_illness"
                      id="medical_illness"
                      class="form-control"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.medical_illness"
                    >
                      {{ errors.medical_illness[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-12 mt-3">
                    <label for="gynaecological_history" class="form-label"
                      >Do you have gynaecological history (i.e. Cervical dysplasia,
                      herpes, etc.)? </label
                    ><input
                      type="text"
                      v-model="form.gynaecological_history"
                      id="gynaecological_history"
                      class="form-control"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.gynaecological_history"
                    >
                      {{ errors.gynaecological_history[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-12 mt-3">
                    <label for="previous_operation" class="form-label"
                      >Have you previously had an operation? If so, please state what and
                      when </label
                    ><input
                      type="text"
                      v-model="form.previous_operation"
                      id="previous_operation"
                      class="form-control"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.previous_operation"
                    >
                      {{ errors.previous_operation[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-12 mt-3">
                    <label for="anaesthetic" class="form-label"
                      >Did you experience any problem with anaesthetic? </label
                    ><input
                      type="text"
                      v-model="form.anaesthetic"
                      id="anaesthetic"
                      class="form-control"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.anaesthetic"
                    >
                      {{ errors.anaesthetic[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-12 mt-3">
                    <label for="medication" class="form-label"
                      >Are you on any medication? If so, please name and specify dosage </label
                    ><input
                      type="text"
                      v-model="form.medication"
                      id="medication"
                      class="form-control"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.medication"
                    >
                      {{ errors.medication[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-12 mt-3">
                    <label for="depression_during_pregnancy" class="form-label"
                      >Have you had depression during pregnancy or post pregnancy? </label
                    ><input
                      type="text"
                      v-model="form.depression_during_pregnancy"
                      id="depression_during_pregnancy"
                      class="form-control"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.depression_during_pregnancy"
                    >
                      {{ errors.depression_during_pregnancy[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-6 mt-3">
                    <label for="edinburgh_score" class="form-label"
                      >Edinburgh Score
                      <a
                        href="http://www.perinatology.com/calculators/Edinburgh%20Depression%20Scale.htm"
                        target="_blank"
                        class="text-blue"
                        >Click here to know edinburgh score</a
                      > </label
                    ><input
                      type="text"
                      v-model="form.edinburgh_score"
                      id="edinburgh_score"
                      class="form-control"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.edinburgh_score"
                    >
                      {{ errors.edinburgh_score[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-6 mt-3">
                    <label for="gestational_period" class="form-label"
                      >Weeks Gestation</label
                    >
                    <input
                      id="gestational_period"
                      type="text"
                      disabled
                      class="form-control"
                      v-model="form.gestational_period"
                    />
                  </div>
                  <div class="col-span-12 xl:col-span-12 mt-3">
                    <label for="well_so_far_in_this_pregnancy" class="form-label"
                      >Are you well so far in this pregnancy? </label
                    ><input
                      type="text"
                      v-model="form.well_so_far_in_this_pregnancy"
                      id="well_so_far_in_this_pregnancy"
                      class="form-control"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.well_so_far_in_this_pregnancy"
                    >
                      {{ errors.well_so_far_in_this_pregnancy[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-12 mt-4 border-top">
                    <h3 class="font-medium text-xl mt-2">Investigations/Procedures</h3>
                    <p>Check if the patient has any of the following</p>
                  </div>
                  <div class="col-span-12 xl:col-span-6">
                    <div class="grid grid-cols-12 gap-x-5">
                      <label
                        for="ultrasound"
                        class="col-span-12 xl:col-span-8 form-label mt-2"
                        >Ultrasound</label
                      >
                      <div
                        class="col-span-12 xl:col-span-4 flex flex-col sm:flex-row mt-2"
                      >
                        <div class="form-check mr-2">
                          <input
                            id="radio-switch-130"
                            class="form-check-input"
                            type="radio"
                            name="ultrasound"
                            v-model="form.ultrasound"
                            value="Yes"
                          />
                          <label class="form-check-label" for="radio-switch-130"
                            >Yes</label
                          >
                        </div>
                        <div class="form-check mr-2 mt-2 sm:mt-0">
                          <input
                            id="radio-switch-131"
                            class="form-check-input"
                            type="radio"
                            name="ultrasound"
                            v-model="form.ultrasound"
                            value="No"
                          />
                          <label class="form-check-label" for="radio-switch-131"
                            >No</label
                          >
                        </div>
                      </div>
                    </div>

                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.ultrasound"
                    >
                      {{ errors.ultrasound[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-6">
                    <label for="ultrasound_week" class="form-label"
                      >If yes, how many weeks</label
                    >
                    <input
                      type="text"
                      v-model="form.ultrasound_week"
                      id="ultrasound_week"
                      class="form-control"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.ultrasound_week"
                    >
                      {{ errors.ultrasound_week[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-6">
                    <div class="grid grid-cols-12 gap-x-5">
                      <label for="cvs" class="col-span-12 xl:col-span-8 form-label mt-2"
                        >CVS</label
                      >
                      <div
                        class="col-span-12 xl:col-span-4 flex flex-col sm:flex-row mt-2"
                      >
                        <div class="form-check mr-2">
                          <input
                            id="radio-switch-132"
                            class="form-check-input"
                            type="radio"
                            name="cvs"
                            v-model="form.cvs"
                            value="Yes"
                          />
                          <label class="form-check-label" for="radio-switch-132"
                            >Yes</label
                          >
                        </div>
                        <div class="form-check mr-2 mt-2 sm:mt-0">
                          <input
                            id="radio-switch-133"
                            class="form-check-input"
                            type="radio"
                            name="cvs"
                            v-model="form.cvs"
                            value="No"
                          />
                          <label class="form-check-label" for="radio-switch-133"
                            >No</label
                          >
                        </div>
                      </div>
                    </div>

                    <div class="text-danger font-medium text-xs mt-1" v-if="errors.cvs">
                      {{ errors.cvs[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-6">
                    <div class="grid grid-cols-12 gap-x-5">
                      <label
                        for="maternal_serum_screening"
                        class="col-span-12 xl:col-span-8 form-label mt-2"
                        >Maternal serum screening</label
                      >
                      <div
                        class="col-span-12 xl:col-span-4 flex flex-col sm:flex-row mt-2"
                      >
                        <div class="form-check mr-2">
                          <input
                            id="radio-switch-134"
                            class="form-check-input"
                            type="radio"
                            name="maternal_serum_screening"
                            v-model="form.maternal_serum_screening"
                            value="Yes"
                          />
                          <label class="form-check-label" for="radio-switch-134"
                            >Yes</label
                          >
                        </div>
                        <div class="form-check mr-2 mt-2 sm:mt-0">
                          <input
                            id="radio-switch-135"
                            class="form-check-input"
                            type="radio"
                            name="maternal_serum_screening"
                            v-model="form.maternal_serum_screening"
                            value="No"
                          />
                          <label class="form-check-label" for="radio-switch-135"
                            >No</label
                          >
                        </div>
                      </div>
                    </div>

                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.maternal_serum_screening"
                    >
                      {{ errors.maternal_serum_screening[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-6">
                    <div class="grid grid-cols-12 gap-x-5">
                      <label
                        for="amniocentesis"
                        class="col-span-12 xl:col-span-8 form-label mt-2"
                        >Amniocentesis</label
                      >
                      <div
                        class="col-span-12 xl:col-span-4 flex flex-col sm:flex-row mt-2"
                      >
                        <div class="form-check mr-2">
                          <input
                            id="radio-switch-136"
                            class="form-check-input"
                            type="radio"
                            name="amniocentesis"
                            v-model="form.amniocentesis"
                            value="Yes"
                          />
                          <label class="form-check-label" for="radio-switch-136"
                            >Yes</label
                          >
                        </div>
                        <div class="form-check mr-2 mt-2 sm:mt-0">
                          <input
                            id="radio-switch-137"
                            class="form-check-input"
                            type="radio"
                            name="amniocentesis"
                            v-model="form.amniocentesis"
                            value="No"
                          />
                          <label class="form-check-label" for="radio-switch-137"
                            >No</label
                          >
                        </div>
                      </div>
                    </div>

                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.amniocentesis"
                    >
                      {{ errors.amniocentesis[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-6">
                    <div class="grid grid-cols-12 gap-x-5">
                      <label
                        for="other_procedures"
                        class="col-span-12 xl:col-span-8 form-label mt-2"
                        >Other Procedures (e.g. IVF)</label
                      >
                      <div
                        class="col-span-12 xl:col-span-4 flex flex-col sm:flex-row mt-2"
                      >
                        <div class="form-check mr-2">
                          <input
                            id="radio-switch-138"
                            class="form-check-input"
                            type="radio"
                            name="other_procedures"
                            v-model="form.other_procedures"
                            value="Yes"
                          />
                          <label class="form-check-label" for="radio-switch-138"
                            >Yes</label
                          >
                        </div>
                        <div class="form-check mr-2 mt-2 sm:mt-0">
                          <input
                            id="radio-switch-139"
                            class="form-check-input"
                            type="radio"
                            name="other_procedures"
                            v-model="form.other_procedures"
                            value="No"
                          />
                          <label class="form-check-label" for="radio-switch-139"
                            >No</label
                          >
                        </div>
                      </div>
                    </div>

                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.other_procedures"
                    >
                      {{ errors.other_procedures[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-12 mt-3">
                    <label for="specify_other_procedures" class="form-label"
                      >Please specify if yes to other procedures:</label
                    >
                    <input
                      type="text"
                      v-model="form.specify_other_procedures"
                      id="specify_other_procedures"
                      class="form-control"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.specify_other_procedures"
                    >
                      {{ errors.specify_other_procedures[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-12 mt-3">
                    <label for="condition_developed" class="form-label"
                      >Condition developed during pregnancy</label
                    >
                    <input
                      type="text"
                      v-model="form.condition_developed"
                      id="condition_developed"
                      class="form-control"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.condition_developed"
                    >
                      {{ errors.condition_developed[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-12 mt-3">
                    <div class="grid grid-cols-12 gap-x-5">
                      <label
                        for="vaginal_birth"
                        class="col-span-12 xl:col-span-9 form-label mt-2"
                        >Plan for vaginal birth after a previous caesarian?</label
                      >
                      <div
                        class="col-span-12 xl:col-span-3 flex flex-col sm:flex-row mt-2"
                      >
                        <div class="form-check mr-2">
                          <input
                            id="radio-switch-140"
                            class="form-check-input"
                            type="radio"
                            name="vaginal_birth"
                            v-model="form.vaginal_birth"
                            value="N/A"
                          />
                          <label class="form-check-label" for="radio-switch-140"
                            >N/A</label
                          >
                        </div>
                        <div class="form-check mr-2">
                          <input
                            id="radio-switch-141"
                            class="form-check-input"
                            type="radio"
                            name="vaginal_birth"
                            v-model="form.vaginal_birth"
                            value="Yes"
                          />
                          <label class="form-check-label" for="radio-switch-141"
                            >Yes</label
                          >
                        </div>
                        <div class="form-check mr-2 mt-2 sm:mt-0">
                          <input
                            id="radio-switch-142"
                            class="form-check-input"
                            type="radio"
                            name="vaginal_birth"
                            v-model="form.vaginal_birth"
                            value="No"
                          />
                          <label class="form-check-label" for="radio-switch-142"
                            >No</label
                          >
                        </div>
                      </div>
                    </div>

                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.vaginal_birth"
                    >
                      {{ errors.vaginal_birth[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-12 mt-3">
                    <div class="grid grid-cols-12 gap-x-5">
                      <label
                        for="antenatal_classes"
                        class="col-span-12 xl:col-span-9 form-label mt-2"
                        >Do you intend to have ante natal classes?</label
                      >
                      <div
                        class="col-span-12 xl:col-span-3 flex flex-col sm:flex-row mt-2"
                      >
                        <div class="form-check mr-2">
                          <input
                            id="radio-switch-143"
                            class="form-check-input"
                            type="radio"
                            name="antenatal_classes"
                            v-model="form.antenatal_classes"
                            value="Yes"
                          />
                          <label class="form-check-label" for="radio-switch-143"
                            >Yes</label
                          >
                        </div>
                        <div class="form-check mr-2 mt-2 sm:mt-0">
                          <input
                            id="radio-switch-144"
                            class="form-check-input"
                            type="radio"
                            name="antenatal_classes"
                            v-model="form.antenatal_classes"
                            value="No"
                          />
                          <label class="form-check-label" for="radio-switch-144"
                            >No</label
                          >
                        </div>
                      </div>
                    </div>

                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.antenatal_classes"
                    >
                      {{ errors.antenatal_classes[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-12 mt-4 border-top">
                    <h3 class="font-medium text-xl mt-2">
                      CREUTZFELDT – JAKOB DISEASE (CJD) QUESTIONNAIRE
                    </h3>
                    <p>Check if the patient has any of the following</p>
                  </div>
                  <div class="col-span-12 xl:col-span-12 mt-3">
                    <div class="grid grid-cols-12 gap-x-5">
                      <label
                        for="rapid_progressive_dementia"
                        class="col-span-12 xl:col-span-9 form-label mt-2"
                        >Have you suffered from a recent rapid progressive dementia,
                        physical or mental, the cause of which has not been
                        diagnosed?</label
                      >
                      <div
                        class="col-span-12 xl:col-span-3 flex flex-col sm:flex-row mt-2"
                      >
                        <div class="form-check mr-2">
                          <input
                            id="radio-switch-145"
                            class="form-check-input"
                            type="radio"
                            name="rapid_progressive_dementia"
                            v-model="form.rapid_progressive_dementia"
                            value="Yes"
                          />
                          <label class="form-check-label" for="radio-switch-145"
                            >Yes</label
                          >
                        </div>
                        <div class="form-check mr-2 mt-2 sm:mt-0">
                          <input
                            id="radio-switch-146"
                            class="form-check-input"
                            type="radio"
                            name="rapid_progressive_dementia"
                            v-model="form.rapid_progressive_dementia"
                            value="No"
                          />
                          <label class="form-check-label" for="radio-switch-146"
                            >No</label
                          >
                        </div>
                      </div>
                    </div>

                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.rapid_progressive_dementia"
                    >
                      {{ errors.rapid_progressive_dementia[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-12 mt-3">
                    <div class="grid grid-cols-12 gap-x-5">
                      <label for="cjd" class="col-span-12 xl:col-span-9 form-label mt-2"
                        >Do you have a family history of 2 or more first-degree relatives
                        with CJD or other undiagnosed neurological illness?</label
                      >
                      <div
                        class="col-span-12 xl:col-span-3 flex flex-col sm:flex-row mt-2"
                      >
                        <div class="form-check mr-2">
                          <input
                            id="radio-switch-145"
                            class="form-check-input"
                            type="radio"
                            name="cjd"
                            v-model="form.cjd"
                            value="Yes"
                          />
                          <label class="form-check-label" for="radio-switch-145"
                            >Yes</label
                          >
                        </div>
                        <div class="form-check mr-2 mt-2 sm:mt-0">
                          <input
                            id="radio-switch-146"
                            class="form-check-input"
                            type="radio"
                            name="cjd"
                            v-model="form.cjd"
                            value="No"
                          />
                          <label class="form-check-label" for="radio-switch-146"
                            >No</label
                          >
                        </div>
                      </div>
                    </div>

                    <div class="text-danger font-medium text-xs mt-1" v-if="errors.cjd">
                      {{ errors.cjd[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-12 mt-3">
                    <div class="grid grid-cols-12 gap-x-5">
                      <label
                        for="human_pituitary"
                        class="col-span-12 xl:col-span-9 form-label mt-2"
                        >Have you received human pituitary- derived gonadotrophin (for
                        infertility) or growth hormone (for short stature)?</label
                      >
                      <div
                        class="col-span-12 xl:col-span-3 flex flex-col sm:flex-row mt-2"
                      >
                        <div class="form-check mr-2">
                          <input
                            id="radio-switch-147"
                            class="form-check-input"
                            type="radio"
                            name="human_pituitary"
                            v-model="form.human_pituitary"
                            value="Yes"
                          />
                          <label class="form-check-label" for="radio-switch-147"
                            >Yes</label
                          >
                        </div>
                        <div class="form-check mr-2 mt-2 sm:mt-0">
                          <input
                            id="radio-switch-148"
                            class="form-check-input"
                            type="radio"
                            name="human_pituitary"
                            v-model="form.human_pituitary"
                            value="No"
                          />
                          <label class="form-check-label" for="radio-switch-148"
                            >No</label
                          >
                        </div>
                      </div>
                    </div>

                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.human_pituitary"
                    >
                      {{ errors.human_pituitary[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-12 mt-3">
                    <div class="grid grid-cols-12 gap-x-5">
                      <label
                        for="dura_mater_graft"
                        class="col-span-12 xl:col-span-9 form-label mt-2"
                        >Have you received a dura mater graft in a neurological or other
                        surgical procedure before 1990?</label
                      >
                      <div
                        class="col-span-12 xl:col-span-3 flex flex-col sm:flex-row mt-2"
                      >
                        <div class="form-check mr-2">
                          <input
                            id="radio-switch-149"
                            class="form-check-input"
                            type="radio"
                            name="dura_mater_graft"
                            v-model="form.dura_mater_graft"
                            value="Yes"
                          />
                          <label class="form-check-label" for="radio-switch-149"
                            >Yes</label
                          >
                        </div>
                        <div class="form-check mr-2 mt-2 sm:mt-0">
                          <input
                            id="radio-switch-150"
                            class="form-check-input"
                            type="radio"
                            name="dura_mater_graft"
                            v-model="form.dura_mater_graft"
                            value="No"
                          />
                          <label class="form-check-label" for="radio-switch-150"
                            >No</label
                          >
                        </div>
                      </div>
                    </div>

                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.dura_mater_graft"
                    >
                      {{ errors.dura_mater_graft[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-12 mt-3">
                    <div class="grid grid-cols-12 gap-x-5">
                      <label
                        for="cjd_look_back"
                        class="col-span-12 xl:col-span-9 form-label mt-2"
                        >Have been involved in a CJD look back?</label
                      >
                      <div
                        class="col-span-12 xl:col-span-3 flex flex-col sm:flex-row mt-2"
                      >
                        <div class="form-check mr-2">
                          <input
                            id="radio-switch-151"
                            class="form-check-input"
                            type="radio"
                            name="cjd_look_back"
                            v-model="form.cjd_look_back"
                            value="Yes"
                          />
                          <label class="form-check-label" for="radio-switch-151"
                            >Yes</label
                          >
                        </div>
                        <div class="form-check mr-2 mt-2 sm:mt-0">
                          <input
                            id="radio-switch-152"
                            class="form-check-input"
                            type="radio"
                            name="cjd_look_back"
                            v-model="form.cjd_look_back"
                            value="No"
                          />
                          <label class="form-check-label" for="radio-switch-152"
                            >No</label
                          >
                        </div>
                      </div>
                    </div>

                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.cjd_look_back"
                    >
                      {{ errors.cjd_look_back[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-12 mt-3">
                    <div class="grid grid-cols-12 gap-x-5">
                      <label
                        for="medical_in_confidence"
                        class="col-span-12 xl:col-span-9 form-label mt-2"
                        >Do you have a "Medical in Confidence" letter in regard to your
                        risk of CJD?</label
                      >
                      <div
                        class="col-span-12 xl:col-span-3 flex flex-col sm:flex-row mt-2"
                      >
                        <div class="form-check mr-2">
                          <input
                            id="radio-switch-153"
                            class="form-check-input"
                            type="radio"
                            name="medical_in_confidence"
                            v-model="form.medical_in_confidence"
                            value="Yes"
                          />
                          <label class="form-check-label" for="radio-switch-153"
                            >Yes</label
                          >
                        </div>
                        <div class="form-check mr-2 mt-2 sm:mt-0">
                          <input
                            id="radio-switch-154"
                            class="form-check-input"
                            type="radio"
                            name="medical_in_confidence"
                            v-model="form.medical_in_confidence"
                            value="No"
                          />
                          <label class="form-check-label" for="radio-switch-154"
                            >No</label
                          >
                        </div>
                      </div>
                    </div>

                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.medical_in_confidence"
                    >
                      {{ errors.medical_in_confidence[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-12 mt-4 border-top">
                    <h3 class="font-medium text-xl mt-2">Others</h3>
                    <p>Check if the patient has any of the following</p>
                  </div>
                  <div class="col-span-12 mt-3 xl:col-span-3">
                    <label for="pack_volume_cells" class="form-label"
                      >Pack volume cells</label
                    >
                    <input
                      id="pack_volume_cells"
                      type="text"
                      class="form-control"
                      v-model="form.pack_volume_cells"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.pack_volume_cells"
                    >
                      {{ errors.pack_volume_cells[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 mt-3 xl:col-span-3">
                    <div class="flex flex-col sm:flex-row mt-2">
                      <div class="form-check mr-2">
                        <input
                          id="radio-switch-51"
                          class="form-check-input"
                          type="checkbox"
                          v-model="form.pregnancy_scan"
                          name="pregnancy_scan"
                          value="1"
                        />
                        <label class="form-check-label" for="radio-switch-51"
                          >Pregnancy scan</label
                        >
                      </div>
                    </div>
                  </div>
                  <div class="col-span-12 mt-3 xl:col-span-3">
                    <div class="flex flex-col sm:flex-row mt-2">
                      <div class="form-check mr-2">
                        <input
                          id="radio-switch-52"
                          class="form-check-input"
                          type="checkbox"
                          v-model="form.primp_scan"
                          name="primp_scan"
                          value="1"
                        />
                        <label class="form-check-label" for="radio-switch-52"
                          >Primp scan</label
                        >
                      </div>
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-12 mt-4 border-top">
                    <h3 class="font-medium text-xl mt-2" v-if="!spouse_information">
                      Spouse/Partner Information
                    </h3>
                    <p v-if="!spouse_information">Provide the details of your husband.</p>
                    <h4
                      class="font-medium text-xl mt-2"
                      v-if="form.pregnancy_responsibility == '0'"
                    >
                      Pregnancy Responsibility Information
                    </h4>
                    <p v-if="form.pregnancy_responsibility == '0'">
                      Provide details of the man who pregnated you.
                    </p>
                  </div>

                  <div class="col-span-12" v-if="form.pregnancy_responsibility == '0'">
                    <div class="grid grid-cols-12 gap-x-5">
                      <div class="col-span-12 xl:col-span-4 mt-3">
                        <label for="spouse_name" class="form-label">Full Name</label>
                        <input
                          id="spouse_name"
                          type="text"
                          class="form-control"
                          v-model="form.spouse_name"
                        />
                        <div
                          class="text-danger font-medium text-xs mt-1"
                          v-if="errors.spouse_name"
                        >
                          {{ errors.spouse_name[0] }}
                        </div>
                      </div>
                      <div class="col-span-12 xl:col-span-4 mt-3">
                        <label for="spouse_email" class="form-label">Email Address</label>
                        <input
                          id="spouse_email"
                          type="email"
                          class="form-control"
                          v-model="form.spouse_email"
                        />
                        <div
                          class="text-danger font-medium text-xs mt-1"
                          v-if="errors.spouse_email"
                        >
                          {{ errors.spouse_email[0] }}
                        </div>
                      </div>
                      <div class="col-span-12 xl:col-span-4 mt-3">
                        <label for="spouse_phone_number" class="form-label"
                          >Phone Number</label
                        >
                        <input
                          id="spouse_phone_number"
                          type="text"
                          class="form-control"
                          v-model="form.spouse_phone_number"
                        />
                        <div
                          class="text-danger font-medium text-xs mt-1"
                          v-if="errors.spouse_phone_number"
                        >
                          {{ errors.spouse_phone_number[0] }}
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-span-12" v-if="!spouse_information">
                    <div class="grid grid-cols-12 gap-x-5">
                      <div class="col-span-12 xl:col-span-4 mt-3">
                        <label for="spouse_name" class="form-label"
                          >Spouse Full Name</label
                        >
                        <input
                          id="spouse_name"
                          type="text"
                          class="form-control"
                          v-model="form.spouse_name"
                          @change="updateHusband"
                        />
                        <div
                          class="text-danger font-medium text-xs mt-1"
                          v-if="errors.spouse_name"
                        >
                          {{ errors.spouse_name[0] }}
                        </div>
                      </div>
                      <div class="col-span-12 xl:col-span-4 mt-3">
                        <label for="spouse_email" class="form-label"
                          >Spouse Email Address</label
                        >
                        <input
                          id="spouse_email"
                          type="email"
                          class="form-control"
                          v-model="form.spouse_email"
                        />
                        <div
                          class="text-danger font-medium text-xs mt-1"
                          v-if="errors.spouse_email"
                        >
                          {{ errors.spouse_email[0] }}
                        </div>
                      </div>
                      <div class="col-span-12 xl:col-span-4 mt-3">
                        <label for="spouse_phone_number" class="form-label"
                          >Spouse Phone Number</label
                        >
                        <input
                          id="spouse_phone_number"
                          type="text"
                          class="form-control"
                          v-model="form.spouse_phone_number"
                        />
                        <div
                          class="text-danger font-medium text-xs mt-1"
                          v-if="errors.spouse_phone_number"
                        >
                          {{ errors.spouse_phone_number[0] }}
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-span-12 mt-4 border-top" v-if="spouse_information">
                    <h3 class="font-medium text-xl mt-2" v-if="spouse_information">
                      Spouse/Partner Information
                    </h3>
                    <table class="table">
                      <tbody>
                        <tr>
                          <td>
                            <strong class="block">Full Name</strong>
                            {{ spouse_information.name }}
                          </td>
                          <td>
                            <strong class="block">Email Address</strong>
                            {{ spouse_information.email }}
                          </td>
                          <td>
                            <strong class="block">Phone Number</strong>
                            {{ spouse_information.phone_number }}
                          </td>
                          <td>
                            <strong class="block">Acceptance</strong>
                            <span
                              v-if="spouse_information.acceptance"
                              class="bg-success py-3 px-2 text-white"
                              >Accepted</span
                            ><span v-else class="bg-danger py-3 px-2 text-white"
                              >Not Accepted</span
                            >
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary w-20 mt-3">Save</button>
                <loading v-if="loading == true"></loading>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "create-prenatal",
  data() {
    return {
      token: "",
      form: {
        patient: "",
        last_menstral_period: "",
        gestational_period: "",
        expected_due_date: "",
        date_of_conception: "",
        date_of_first_prenatal_visit: "",
        day_of_prenatal_visit: "",
        type_of_last_delivery: "",
        date_of_last_delivery: "",
        expected_delivery_facility: "",
        pregnancy_type: "",
        smokes: "",
        smoke_qty_per_day: "",
        ceased_smoking: "",
        substance_use: "",
        spouse_smoke: "",
        quit_information: "",
        alcohol: "",
        alcohol_qty_per_week: "",
        current_rubella_immunisation: "",
        current_rubella_immunisation_level: "",
        adolescent: "",
        inadequate_finances: "",
        inadequate_housing: "",
        inadequate_social_supports: "",
        less_than_high_school_education: "",
        poor_nutrition: "",
        psychiatric_history: "",
        significant_learning_disabilities: "",
        violence: "",
        cardiac_diseases: "",
        diabetes: "",
        endocrine_disorders: "",
        hyperthyroid: "",
        hypothyroid: "",
        gi_disorders: "",
        malignancy: "",
        moderate_asthma: "",
        renal_disease: "",
        seizure_disorders: "",
        sickle_cell_diseases: "",
        kidney_disease: "",
        epilepsy: "",
        disorder_of_nervous_system: "",
        psychiatric_illness: "",
        high_blood_pressure: "",
        lung_disease: "",
        blood_transfusion: "",
        hepatitis: "",
        blood_disorder: "",
        assault: "",
        hormone_problem: "",
        bone_problem: "",
        abnormal_pap_smear: "",
        anemia: "",
        bmi: "",
        gestational_diabetes: "",
        cervical_uterine_infections: "",
        neurological_defect: "",
        history_of_infertility: "",
        inadequate_prenatal_care: "",
        history_of_low_birth_weight: "",
        incompetent_cervix: "",
        intrauterine_growth_retardation: "",
        placenta_previa: "",
        polyhydramnios: "",
        poor_weight_gain: "",
        postpartum_depression_family: "",
        postpartum_depression_personal: "",
        pregnancy_induced_hypertension: "",
        pre_pregnant_weight: "",
        previous_pre_term_labour: "",
        previous_pre_term_delivery: "",
        previous_stillborn: "",
        multiple_gestation: "",
        rh_sensitization: "",
        sexually_transmitted_disease: "",
        therapeutics_abortion: "",
        uterine_anomally: "",
        pack_volume_cells: "",
        pregnancy_scan: "",
        primp_scan: "",
        number_of_pregnancy: "",
        number_of_previous_vaginal_deliveries: "",
        number_of_surviving_children: "",
        number_of_caesarian_sections: "",
        preterm_birth: "",
        congenital_anomaly: "",
        stillborn: "",
        neonatal_death: "",
        neonatal_death_days: "",
        lesser_weight: "",
        greater_weight: "",
        pregnancy_responsibility: "",
        fever_specify: "",
        nsaid: "",
        paracetamol: "",
        anticonvulsants: "",
        anticonvulsants_generic_name: "",
        antinausea: "",
        antinausea_generic_name: "",
        prenatal_vitamins: "",
        prenatal_vitamins_generic_name: "",
        antivirals: "",
        antivirals_generic_name: "",
        antibiotics: "",
        antibiotics_generic_name: "",
        fetal_heart_rate: "",
        token: "",
        twins: "",
        high_blood_pressure: "",
        aboriginal_status: "",
        genetic_disorders: "",
        family_diabetes: "",
        family_history_specify: "",
        medical_illness: "",
        gynaecological_history: "",
        previous_operation: "",
        anaesthetic: "",
        medication: "",
        depression_during_pregnancy: "",
        edinburgh_score: "",
        gestation_week: "",
        well_so_far_in_this_pregnancy: "",
        ultrasound: "",
        ultrasound_week: "",
        cvs: "",
        maternal_serum_screening: "",
        amniocentesis: "",
        other_procedures: "",
        specify_other_procedures: "",
        antenatal_visit: "",
        condition_developed: "",
        vaginal_birth: "",
        antenatal_classes: "",
        rapid_progressive_dementia: "",
        cjd: "",
        human_pituitary: "",
        dura_mater_graft: "",
        cjd_look_back: "",
        medical_in_confidence: "",
        add_husband: false,
        spouse_name: "",
        spouse_email: "",
        spouse_phone_number: "",
        spouse_gender: "Male",
      },
      patients: "",
      spouse_information: "",
      loading: false,
      errors: {},
    };
  },
  created() {
    this.login();
    this.getPatients();
  },
  methods: {
    login() {
      if (!User.loggedIn()) {
        this.$router.push({
          name: "logout",
        });
      } else {
        this.token = User.token();
        this.form.token = User.token();
      }
    },
    getPatients() {
      axios
        .get("/api/v1/patient-checkins/" + this.token, {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then((response) => (this.patients = response.data))
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
        .get("/api/v1/get-spouse-information/" + this.form.patient["patient_id"], {
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
    updateHusband() {
      this.form.add_husband = true;
    },
    computeGestationPeriod() {
      let date = new Date(this.form.last_menstral_period);
      let add7Days = date.setDate(date.getDate() + 7);
      let newDate = new Date(add7Days);
      let minus3Month = newDate.setMonth(newDate.getMonth() - 3);
      let anotherDate = new Date(minus3Month);
      let add1Year = anotherDate.setFullYear(anotherDate.getFullYear() + 1);
      let EED = new Date(add1Year);
      let today = new Date();
      let lmp = new Date(this.form.last_menstral_period);
      let t1 = lmp.getTime();
      let t2 = today.getTime();
      let diffInDays = Math.floor((t2 - t1) / (24 * 3600 * 1000));
      let weeks = parseInt(diffInDays / 7);
      let days = diffInDays % 7;
      let add14Days = lmp.setDate(lmp.getDate() + 14);
      let DoC = new Date(add14Days);

      // console.log(lmp, today, diffInDays, weeks, days, DoC);
      // console.log(EED);
      let d1 = String(EED.getDate()).padStart(2, "0");
      let m1 = String(EED.getMonth() + 1).padStart(2, "0");
      let y1 = EED.getFullYear();

      let d2 = String(DoC.getDate()).padStart(2, "0");
      let m2 = String(DoC.getMonth() + 1).padStart(2, "0");
      let y2 = DoC.getFullYear();

      this.form.expected_due_date = y1 + "-" + m1 + "-" + d1;
      this.form.gestational_period = weeks + " weeks " + days + " days";
      this.form.date_of_conception = y2 + "-" + m2 + "-" + d2;
      this.form.pregnancy_duration = weeks;
      this.form.gestational_age = weeks + " weeks " + days + " days";
    },
    submit() {
      this.loading = true;
      axios
        .post("/api/prenatal/", this.form)
        .then(() => {
          this.$router.push({
            name: "prenatals",
          });

          Toast.fire({
            icon: "success",
            title: "Prenatal registered successfully",
          });
        })
        .catch((error) => (this.errors = error.response.data.errors))
        .finally(() => {
          this.loading = false;
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

.block {
  display: block;
}
</style>
