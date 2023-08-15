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
                    <label for="admitted_date" class="form-label"
                      >Date of Admission</label
                    >
                    <input
                      id="admitted_date"
                      type="date"
                      class="form-control"
                      v-model="form.admitted_date"
                      @change="getSpouseInformation"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.admitted_date"
                    >
                      {{ errors.admitted_date[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-3 mt-3">
                    <label for="room_type" class="form-label">Type of Room</label>
                    <select id="room_type" class="form-control" v-model="form.room_type">
                      <option value=""></option>
                      <option value="Public">Public</option>
                      <option value="Private">Private</option>
                    </select>
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.room_type"
                    >
                      {{ errors.room_type[0] }}
                    </div>
                  </div>

                  <div class="col-span-12 xl:col-span-3 mt-3">
                    <label for="room_number" class="form-label">Room Number</label>
                    <input
                      id="room_number"
                      type="text"
                      class="form-control"
                      v-model="form.room_number"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.room_number"
                    >
                      {{ errors.room_number[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-6">
                    <div class="flex flex-col sm:flex-row mt-2">
                      <label class="mr-2"
                        >Did you register for prenatal/antenatal in our facility or
                        another facility?</label
                      >
                      <div class="form-check mr-2">
                        <input
                          id="radio-switch-1"
                          class="form-check-input"
                          type="radio"
                          name="prenatal"
                          v-model="form.prenatal"
                          value="1"
                        />
                        <label class="form-check-label" for="radio-switch-1">Yes</label>
                      </div>
                      <div class="form-check mr-2 mt-2 sm:mt-0">
                        <input
                          id="radio-switch-2"
                          class="form-check-input"
                          type="radio"
                          name="prenatal"
                          v-model="form.prenatal"
                          value="0"
                        />
                        <label class="form-check-label" for="radio-switch-2">No</label>
                      </div>
                    </div>
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.prenatal"
                    >
                      {{ errors.prenatal[0] }}
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
                    <h3 class="font-medium text-xl mt-2">Status Upon Admission</h3>
                    <p>Check if the patient has any of the following</p>
                  </div>
                  <div class="col-span-12 xl:col-span-6">
                    <div class="grid grid-cols-12 gap-x-5">
                      <label for="" class="form-label mt-2 col-span-12 xl:col-span-6"
                        >Pregnant not in labour</label
                      >
                      <div class="col-span-12 xl:col-span-6">
                        <div class="flex flex-col sm:flex-row mt-2">
                          <div class="form-check mr-2">
                            <input
                              id="radio-switch-50"
                              class="form-check-input"
                              type="radio"
                              name="pregnant_not_in_labour"
                              v-model="form.pregnant_not_in_labour"
                              value="Yes"
                            />
                            <label class="form-check-label" for="radio-switch-50"
                              >Yes</label
                            >
                          </div>
                          <div class="form-check mr-2 mt-2 sm:mt-0">
                            <input
                              id="radio-switch-52"
                              class="form-check-input"
                              type="radio"
                              name="pregnant_not_in_labour"
                              v-model="form.pregnant_not_in_labour"
                              value="No"
                            />
                            <label class="form-check-label" for="radio-switch-52"
                              >No</label
                            >
                          </div>
                        </div>
                      </div>
                    </div>
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.pregnant_not_in_labour"
                    >
                      {{ errors.pregnant_not_in_labour[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-6">
                    <div class="grid grid-cols-12 gap-x-5">
                      <label for="" class="form-label mt-2 col-span-12 xl:col-span-6"
                        >Pregnant in labour</label
                      >
                      <div class="col-span-12 xl:col-span-6">
                        <div class="flex flex-col sm:flex-row mt-2">
                          <div class="form-check mr-2">
                            <input
                              id="radio-switch-53"
                              class="form-check-input"
                              type="radio"
                              name="pregnant_in_labour"
                              v-model="form.pregnant_in_labour"
                              value="Yes"
                            />
                            <label class="form-check-label" for="radio-switch-53"
                              >Yes</label
                            >
                          </div>
                          <div class="form-check mr-2 mt-2 sm:mt-0">
                            <input
                              id="radio-switch-54"
                              class="form-check-input"
                              type="radio"
                              name="pregnant_in_labour"
                              v-model="form.pregnant_in_labour"
                              value="No"
                            />
                            <label class="form-check-label" for="radio-switch-54"
                              >No</label
                            >
                          </div>
                        </div>
                      </div>
                    </div>
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.pregnant_in_labour"
                    >
                      {{ errors.pregnant_in_labour[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-6">
                    <div class="grid grid-cols-12 gap-x-5">
                      <label for="" class="form-label mt-2 col-span-12 xl:col-span-6"
                        >Postpartum [days]</label
                      >
                      <div class="col-span-12 xl:col-span-6">
                        <div class="flex flex-col sm:flex-row mt-2">
                          <div class="form-check mr-2">
                            <input
                              id="radio-switch-55"
                              class="form-check-input"
                              type="radio"
                              name="postpartum"
                              v-model="form.postpartum"
                              value="Yes"
                            />
                            <label class="form-check-label" for="radio-switch-55"
                              >Yes</label
                            >
                          </div>
                          <div class="form-check mr-2 mt-2 sm:mt-0">
                            <input
                              id="radio-switch-56"
                              class="form-check-input"
                              type="radio"
                              name="postpartum"
                              v-model="form.postpartum"
                              value="No"
                            />
                            <label class="form-check-label" for="radio-switch-56"
                              >No</label
                            >
                          </div>
                          <div class="w-full" v-if="form.postpartum == 'Yes'">
                            <input
                              type="text"
                              v-model="form.postpartum_days"
                              required
                              placeholder="Days"
                              class="form-control"
                            />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.postpartum"
                    >
                      {{ errors.postpartum[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-6" v-if="form.postpartum == 'Yes'">
                    <div class="grid grid-cols-12 gap-x-5">
                      <label for="" class="form-label mt-2 col-span-12 xl:col-span-6"
                        >Breastfeeding</label
                      >
                      <div class="col-span-12 xl:col-span-6">
                        <div class="flex flex-col sm:flex-row mt-2">
                          <div class="form-check mr-2">
                            <input
                              id="radio-switch-57"
                              class="form-check-input"
                              type="radio"
                              name="breastfeeding"
                              v-model="form.breastfeeding"
                              value="Yes"
                            />
                            <label class="form-check-label" for="radio-switch-57"
                              >Yes</label
                            >
                          </div>
                          <div class="form-check mr-2 mt-2 sm:mt-0">
                            <input
                              id="radio-switch-58"
                              class="form-check-input"
                              type="radio"
                              name="breastfeeding"
                              v-model="form.breastfeeding"
                              value="No"
                            />
                            <label class="form-check-label" for="radio-switch-58"
                              >No</label
                            >
                          </div>
                        </div>
                      </div>
                    </div>
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.breastfeeding"
                    >
                      {{ errors.breastfeeding[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-6">
                    <div class="grid grid-cols-12 gap-x-5">
                      <label for="" class="form-label mt-2 col-span-12 xl:col-span-6"
                        >Post-abortion, miscarriage</label
                      >
                      <div class="col-span-12 xl:col-span-6">
                        <div class="flex flex-col sm:flex-row mt-2">
                          <div class="form-check mr-2">
                            <input
                              id="radio-switch-59"
                              class="form-check-input"
                              type="radio"
                              name="post_abortion"
                              v-model="form.post_abortion"
                              value="Yes"
                            />
                            <label class="form-check-label" for="radio-switch-59"
                              >Yes</label
                            >
                          </div>
                          <div class="form-check mr-2 mt-2 sm:mt-0">
                            <input
                              id="radio-switch-60"
                              class="form-check-input"
                              type="radio"
                              name="post_abortion"
                              v-model="form.post_abortion"
                              value="No"
                            />
                            <label class="form-check-label" for="radio-switch-60"
                              >No</label
                            >
                          </div>
                        </div>
                      </div>
                    </div>
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.post_abortion"
                    >
                      {{ errors.post_abortion[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-9">
                    <div class="grid grid-cols-12 gap-x-5">
                      <label for="" class="form-label mt-2 col-span-12 xl:col-span-4"
                        >Number of fetuses</label
                      >
                      <div class="col-span-12 xl:col-span-8">
                        <div class="flex flex-col sm:flex-row mt-2">
                          <div class="form-check mr-2">
                            <input
                              id="radio-switch-61"
                              class="form-check-input"
                              type="radio"
                              name="number_of_fetuses"
                              v-model="form.number_of_fetuses"
                              value="Singleton"
                            />
                            <label class="form-check-label" for="radio-switch-61"
                              >Singleton</label
                            >
                          </div>
                          <div class="form-check mr-2 mt-2 sm:mt-0">
                            <input
                              id="radio-switch-62"
                              class="form-check-input"
                              type="radio"
                              name="number_of_fetuses"
                              v-model="form.number_of_fetuses"
                              value="Twin"
                            />
                            <label class="form-check-label" for="radio-switch-62"
                              >Twin</label
                            >
                          </div>
                          <div class="form-check mr-2 mt-2 sm:mt-0">
                            <input
                              id="radio-switch-63"
                              class="form-check-input"
                              type="radio"
                              name="number_of_fetuses"
                              v-model="form.number_of_fetuses"
                              value="Triplet"
                            />
                            <label class="form-check-label" for="radio-switch-63"
                              >Triplet</label
                            >
                          </div>
                          <div class="form-check mr-2 mt-2 sm:mt-0">
                            <input
                              id="radio-switch-64"
                              class="form-check-input"
                              type="radio"
                              name="number_of_fetuses"
                              v-model="form.number_of_fetuses"
                              value="Unknown"
                            />
                            <label class="form-check-label" for="radio-switch-64"
                              >Unknown</label
                            >
                          </div>
                          <div class="form-check mr-2 mt-2 sm:mt-0">
                            <input
                              id="radio-switch-65"
                              class="form-check-input"
                              type="radio"
                              name="number_of_fetuses"
                              v-model="form.other"
                              value="Yes"
                            />
                            <label class="form-check-label" for="radio-switch-65"
                              >Other</label
                            >
                          </div>
                          <div class="w-full" v-if="form.other == 'Yes'">
                            <input
                              type="text"
                              v-model="form.number_of_fetuses"
                              id=""
                              class="form-control"
                            />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.number_of_fetuses"
                    >
                      {{ errors.number_of_fetuses[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-3 mt-3">
                    <label for="fetal_heart_rate" class="form-label">Fetal Heart Rate</label>
                    <input
                      id="room_number"
                      type="text"
                      class="form-control"
                      v-model="form.fetal_heart_rate"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.fetal_heart_rate"
                    >
                      {{ errors.fetal_heart_rate[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-12 mt-4 border-top">
                    <h3 class="font-medium text-xl mt-2">Admission Signs and Symptoms</h3>
                    <p>Check if the patient has any of the following</p>
                  </div>

                  <div class="col-span-12 xl:col-span-6">
                    <div class="grid grid-cols-12 gap-x-5">
                      <label for="" class="form-label mt-2 col-span-12 xl:col-span-6"
                        >Vaginal watery discharge</label
                      >
                      <div class="col-span-12 xl:col-span-6">
                        <div class="flex flex-col sm:flex-row mt-2">
                          <div class="form-check mr-2">
                            <input
                              id="radio-switch-6000"
                              class="form-check-input"
                              type="radio"
                              name="vaginal_watery_discharge"
                              v-model="form.vaginal_watery_discharge"
                              value="Yes"
                            />
                            <label class="form-check-label" for="radio-switch-6000"
                              >Yes</label
                            >
                          </div>
                          <div class="form-check mr-2 mt-2 sm:mt-0">
                            <input
                              id="radio-switch-6100"
                              class="form-check-input"
                              type="radio"
                              name="vaginal_watery_discharge"
                              v-model="form.vaginal_watery_discharge"
                              value="No"
                            />
                            <label class="form-check-label" for="radio-switch-6100"
                              >No</label
                            >
                          </div>
                          <div class="form-check mr-2 mt-2 sm:mt-0">
                            <input
                              id="radio-switch-6200"
                              class="form-check-input"
                              type="radio"
                              name="vaginal_watery_discharge"
                              v-model="form.vaginal_watery_discharge"
                              value="Unknown"
                            />
                            <label class="form-check-label" for="radio-switch-6200"
                              >Unknown</label
                            >
                          </div>
                        </div>
                      </div>
                    </div>
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.vaginal_watery_discharge"
                    >
                      {{ errors.vaginal_watery_discharge[0] }}
                    </div>
                  </div>

                  <div class="col-span-12 xl:col-span-6">
                    <div class="grid grid-cols-12 gap-x-5">
                      <label for="" class="form-label mt-2 col-span-12 xl:col-span-6"
                        >Vaginal bleeding</label
                      >
                      <div class="col-span-12 xl:col-span-6">
                        <div class="flex flex-col sm:flex-row mt-2">
                          <div class="form-check mr-2">
                            <input
                              id="radio-switch-7000"
                              class="form-check-input"
                              type="radio"
                              name="vaginal_bleeding"
                              v-model="form.vaginal_bleeding"
                              value="Yes"
                            />
                            <label class="form-check-label" for="radio-switch-7000"
                              >Yes</label
                            >
                          </div>
                          <div class="form-check mr-2 mt-2 sm:mt-0">
                            <input
                              id="radio-switch-7100"
                              class="form-check-input"
                              type="radio"
                              name="vaginal_bleeding"
                              v-model="form.vaginal_bleeding"
                              value="No"
                            />
                            <label class="form-check-label" for="radio-switch-7100"
                              >No</label
                            >
                          </div>
                          <div class="form-check mr-2 mt-2 sm:mt-0">
                            <input
                              id="radio-switch-7200"
                              class="form-check-input"
                              type="radio"
                              name="vaginal_bleeding"
                              v-model="form.vaginal_bleeding"
                              value="Unknown"
                            />
                            <label class="form-check-label" for="radio-switch-7200"
                              >Unknown</label
                            >
                          </div>
                        </div>
                      </div>
                    </div>
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.vaginal_bleeding"
                    >
                      {{ errors.vaginal_bleeding[0] }}
                    </div>
                  </div>

                  <div class="col-span-12 xl:col-span-6">
                    <div class="grid grid-cols-12 gap-x-5">
                      <label for="" class="form-label mt-2 col-span-12 xl:col-span-6"
                        >Headaches</label
                      >
                      <div class="col-span-12 xl:col-span-6">
                        <div class="flex flex-col sm:flex-row mt-2">
                          <div class="form-check mr-2">
                            <input
                              id="radio-switch-8000"
                              class="form-check-input"
                              type="radio"
                              name="headaches"
                              v-model="form.headaches"
                              value="Yes"
                            />
                            <label class="form-check-label" for="radio-switch-8000"
                              >Yes</label
                            >
                          </div>
                          <div class="form-check mr-2 mt-2 sm:mt-0">
                            <input
                              id="radio-switch-8100"
                              class="form-check-input"
                              type="radio"
                              name="headaches"
                              v-model="form.headaches"
                              value="No"
                            />
                            <label class="form-check-label" for="radio-switch-8100"
                              >No</label
                            >
                          </div>
                          <div class="form-check mr-2 mt-2 sm:mt-0">
                            <input
                              id="radio-switch-8200"
                              class="form-check-input"
                              type="radio"
                              name="headaches"
                              v-model="form.headaches"
                              value="Unknown"
                            />
                            <label class="form-check-label" for="radio-switch-8200"
                              >Unknown</label
                            >
                          </div>
                        </div>
                      </div>
                    </div>
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.headaches"
                    >
                      {{ errors.headaches[0] }}
                    </div>
                  </div>

                  <div class="col-span-12 xl:col-span-6">
                    <div class="grid grid-cols-12 gap-x-5">
                      <label for="" class="form-label mt-2 col-span-12 xl:col-span-6"
                        >Vision changes</label
                      >
                      <div class="col-span-12 xl:col-span-6">
                        <div class="flex flex-col sm:flex-row mt-2">
                          <div class="form-check mr-2">
                            <input
                              id="radio-switch-9000"
                              class="form-check-input"
                              type="radio"
                              name="vision_changes"
                              v-model="form.vision_changes"
                              value="Yes"
                            />
                            <label class="form-check-label" for="radio-switch-9000"
                              >Yes</label
                            >
                          </div>
                          <div class="form-check mr-2 mt-2 sm:mt-0">
                            <input
                              id="radio-switch-9100"
                              class="form-check-input"
                              type="radio"
                              name="vision_changes"
                              v-model="form.vision_changes"
                              value="No"
                            />
                            <label class="form-check-label" for="radio-switch-9100"
                              >No</label
                            >
                          </div>
                          <div class="form-check mr-2 mt-2 sm:mt-0">
                            <input
                              id="radio-switch-9200"
                              class="form-check-input"
                              type="radio"
                              name="vision_changes"
                              v-model="form.vision_changes"
                              value="Unknown"
                            />
                            <label class="form-check-label" for="radio-switch-9200"
                              >Unknown</label
                            >
                          </div>
                        </div>
                      </div>
                    </div>
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.vision_changes"
                    >
                      {{ errors.vision_changes[0] }}
                    </div>
                  </div>

                  <div class="col-span-12 xl:col-span-6">
                    <div class="grid grid-cols-12 gap-x-5">
                      <label for="" class="form-label mt-2 col-span-12 xl:col-span-6"
                        >Right upper quadrant (abdominal) pain</label
                      >
                      <div class="col-span-12 xl:col-span-6">
                        <div class="flex flex-col sm:flex-row mt-2">
                          <div class="form-check mr-2">
                            <input
                              id="radio-switch-10000"
                              class="form-check-input"
                              type="radio"
                              name="abdominal_pain"
                              v-model="form.abdominal_pain"
                              value="Yes"
                            />
                            <label class="form-check-label" for="radio-switch-10000"
                              >Yes</label
                            >
                          </div>
                          <div class="form-check mr-2 mt-2 sm:mt-0">
                            <input
                              id="radio-switch-10100"
                              class="form-check-input"
                              type="radio"
                              name="abdominal_pain"
                              v-model="form.abdominal_pain"
                              value="No"
                            />
                            <label class="form-check-label" for="radio-switch-10100"
                              >No</label
                            >
                          </div>
                          <div class="form-check mr-2 mt-2 sm:mt-0">
                            <input
                              id="radio-switch-10200"
                              class="form-check-input"
                              type="radio"
                              name="abdominal_pain"
                              v-model="form.abdominal_pain"
                              value="Unknown"
                            />
                            <label class="form-check-label" for="radio-switch-10200"
                              >Unknown</label
                            >
                          </div>
                        </div>
                      </div>
                    </div>
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.abdominal_pain"
                    >
                      {{ errors.abdominal_pain[0] }}
                    </div>
                  </div>

                  <div class="col-span-12 xl:col-span-6">
                    <div class="grid grid-cols-12 gap-x-5">
                      <label for="" class="form-label mt-2 col-span-12 xl:col-span-6"
                        >Decreased or no fetal movement</label
                      >
                      <div class="col-span-12 xl:col-span-6">
                        <div class="flex flex-col sm:flex-row mt-2">
                          <div class="form-check mr-2">
                            <input
                              id="radio-switch-11000"
                              class="form-check-input"
                              type="radio"
                              name="decreased"
                              v-model="form.decreased"
                              value="Yes"
                            />
                            <label class="form-check-label" for="radio-switch-11000"
                              >Yes</label
                            >
                          </div>
                          <div class="form-check mr-2 mt-2 sm:mt-0">
                            <input
                              id="radio-switch-11100"
                              class="form-check-input"
                              type="radio"
                              name="decreased"
                              v-model="form.decreased"
                              value="No"
                            />
                            <label class="form-check-label" for="radio-switch-11100"
                              >No</label
                            >
                          </div>
                          <div class="form-check mr-2 mt-2 sm:mt-0">
                            <input
                              id="radio-switch-11200"
                              class="form-check-input"
                              type="radio"
                              name="decreased"
                              v-model="form.decreased"
                              value="Unknown"
                            />
                            <label class="form-check-label" for="radio-switch-11200"
                              >Unknown</label
                            >
                          </div>
                        </div>
                      </div>
                    </div>
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.decreased"
                    >
                      {{ errors.decreased[0] }}
                    </div>
                  </div>

                  <div class="col-span-12 xl:col-span-6">
                    <div class="grid grid-cols-12 gap-x-5">
                      <label for="" class="form-label mt-3 col-span-12 xl:col-span-6"
                        >Uterine contractions</label
                      >
                      <div class="col-span-12 xl:col-span-6">
                        <div class="flex flex-col sm:flex-row mt-2">
                          <div class="form-check mr-2">
                            <input
                              id="radio-switch-12000"
                              class="form-check-input"
                              type="radio"
                              name="uterine_contractions"
                              v-model="form.uterine_contractions"
                              value="Yes"
                            />
                            <label class="form-check-label" for="radio-switch-12000"
                              >Yes</label
                            >
                          </div>
                          <div class="form-check mr-2 mt-2 sm:mt-0">
                            <input
                              id="radio-switch-12100"
                              class="form-check-input"
                              type="radio"
                              name="uterine_contractions"
                              v-model="form.uterine_contractions"
                              value="No"
                            />
                            <label class="form-check-label" for="radio-switch-12100"
                              >No</label
                            >
                          </div>
                          <div class="form-check mr-2 mt-2 sm:mt-0">
                            <input
                              id="radio-switch-12200"
                              class="form-check-input"
                              type="radio"
                              name="uterine_contractions"
                              v-model="form.uterine_contractions"
                              value="Unknown"
                            />
                            <label class="form-check-label" for="radio-switch-12200"
                              >Unknown</label
                            >
                          </div>
                        </div>
                      </div>
                    </div>
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.uterine_contractions"
                    >
                      {{ errors.uterine_contractions[0] }}
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
  name: "create-prenatal-admission",
  data() {
    return {
      token: "",
      form: {
        patient: "",
        last_menstral_period: "",
        gestational_period: "",
        expected_due_date: "",
        date_of_conception: "",
        admitted_date: "",
        room_type: "",
        type_of_last_delivery: "",
        room_number: "",
        expected_delivery_facility: "",
        pregnancy_type: "",
        pregnant_not_in_labour: "",
        pregnant_in_labour: "",
        postpartum: "",
        postpartum_days: "",
        breastfeeding: "",
        post_abortion: "",
        number_of_fetuses: "",
        pregnancy_responsibility: "",
        other: "",
        antibiotics_generic_name: "",
        vaginal_watery_discharge: "",
        vaginal_bleeding: "",
        headaches: "",
        vision_changes: "",
        abdominal_pain: "",
        decreased: "",
        uterine_contractions: "",
        fetal_heart_rate: '',
        token: "",

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
        .post("/api/prenatal-admission/", this.form)
        .then(() => {
          this.$router.push({
            name: "prenatals",
          });

          Toast.fire({
            icon: "success",
            title: "Prenatal Admitted successfully",
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
