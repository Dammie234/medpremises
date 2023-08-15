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
        <top-bar title="Edit Prenatal"></top-bar>
        <!-- END: Top Bar -->
        <div class="grid grid-cols-12 gap-6">
          <div class="intro-y col-span-12 xxl:col-span-12">
            <div class="intro-y box">
              <div
                class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5"
              >
                <h2 class="font-medium text-base mr-auto">
                  Edit Prenatal Admission for {{ prenatal.name }}
                </h2>
                <router-link :to="{ name: 'prenatal-admissions' }" class="btn btn-primary"
                  >Go Back</router-link
                >
              </div>
              <form class="input p-5" @submit.prevent="submit">
                <div class="grid grid-cols-12 gap-x-5" :disabled="loading">
                  <div class="col-span-12 xl:col-span-3 lg:col-span-3 md:col-span-3 mt-3">
                    <label for="patient" class="form-label">Patient</label>
                    <input
                      type="text"
                      name="patient"
                      v-model="prenatal.name"
                      disabled
                      class="form-control"
                    />
                  </div>
                  <div class="col-span-12 xl:col-span-3 mt-3">
                    <label for="last_menstral_period" class="form-label"
                      >Last Menstral Period</label
                    >
                    <input
                      id="last_menstral_period"
                      type="date"
                      class="form-control"
                      v-model="prenatal.last_menstral_period"
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
                      v-model="prenatal.expected_due_date"
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
                      v-model="prenatal.gestational_period"
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
                      v-model="prenatal.date_of_conception"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.date_of_conception"
                    >
                      {{ errors.date_of_conception[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-3 mt-3">
                    <label for="admitted_date" class="form-label">Admitted Date</label>
                    <input
                      id="admitted_date"
                      type="text"
                      disabled
                      class="form-control"
                      v-model="prenatal.admitted_date"
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
                    <select
                      id="room_type"
                      class="form-control"
                      v-model="prenatal.room_type"
                    >
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
                      v-model="prenatal.room_number"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.room_number"
                    >
                      {{ errors.room_number[0] }}
                    </div>
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
                              v-model="prenatal.pregnant_not_in_labour"
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
                              v-model="prenatal.pregnant_not_in_labour"
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
                              v-model="prenatal.pregnant_in_labour"
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
                              v-model="prenatal.pregnant_in_labour"
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
                              v-model="prenatal.postpartum"
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
                              v-model="prenatal.postpartum"
                              value="No"
                            />
                            <label class="form-check-label" for="radio-switch-56"
                              >No</label
                            >
                          </div>
                          <div class="w-full" v-if="prenatal.postpartum == 'Yes'">
                            <input
                              type="text"
                              v-model="prenatal.postpartum_days"
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
                  <div
                    class="col-span-12 xl:col-span-6"
                    v-if="prenatal.postpartum == 'Yes'"
                  >
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
                              v-model="prenatal.breastfeeding"
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
                              v-model="prenatal.breastfeeding"
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
                        >Post-abortion, abortion</label
                      >
                      <div class="col-span-12 xl:col-span-6">
                        <div class="flex flex-col sm:flex-row mt-2">
                          <div class="form-check mr-2">
                            <input
                              id="radio-switch-59"
                              class="form-check-input"
                              type="radio"
                              name="post_abortion"
                              v-model="prenatal.post_abortion"
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
                              v-model="prenatal.post_abortion"
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
                              v-model="prenatal.number_of_fetuses"
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
                              v-model="prenatal.number_of_fetuses"
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
                              v-model="prenatal.number_of_fetuses"
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
                              v-model="prenatal.number_of_fetuses"
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
                              v-model="prenatal.other"
                              value="Yes"
                            />
                            <label class="form-check-label" for="radio-switch-65"
                              >Other</label
                            >
                          </div>
                          <div class="w-full" v-if="prenatal.other == 'Yes'">
                            <input
                              type="text"
                              v-model="prenatal.number_of_fetuses"
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
                      id="fetal_heart_rate"
                      type="text"
                      class="form-control"
                      v-model="prenatal.fetal_heart_rate"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.fetal_heart_rate"
                    >
                      {{ errors.fetal_heart_rate[0] }}
                    </div>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary w-20 mt-3">Save</button>
                <loading v-if="loading == true"></loading>
              </form>
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
                  Edit Prenatal Admission Signs &amp; Symptoms For {{ prenatal.name }}
                </h2>
              </div>
              <form class="input p-5" @submit.prevent="submitPrenatalAdmission">
                <div class="grid grid-cols-12 gap-x-5" :disabled="loading_admission">
                  <div class="col-span-12 xl:col-span-12">
                    <div class="grid grid-cols-12 gap-x-5">
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
                                  v-model="admission.vaginal_watery_discharge"
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
                                  v-model="admission.vaginal_watery_discharge"
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
                                  v-model="admission.vaginal_watery_discharge"
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
                                  v-model="admission.vaginal_bleeding"
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
                                  v-model="admission.vaginal_bleeding"
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
                                  v-model="admission.vaginal_bleeding"
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
                                  v-model="admission.headaches"
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
                                  v-model="admission.headaches"
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
                                  v-model="admission.headaches"
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
                                  v-model="admission.vision_changes"
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
                                  v-model="admission.vision_changes"
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
                                  v-model="admission.vision_changes"
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
                                  v-model="admission.abdominal_pain"
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
                                  v-model="admission.abdominal_pain"
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
                                  v-model="admission.abdominal_pain"
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
                                  v-model="admission.decreased"
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
                                  v-model="admission.decreased"
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
                                  v-model="admission.decreased"
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
                                  v-model="admission.uterine_contractions"
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
                                  v-model="admission.uterine_contractions"
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
                                  v-model="admission.uterine_contractions"
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
                    </div>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary w-20 mt-3">Save</button>
                <loading v-if="loading_admission == true"></loading>
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
  name: "edit-prenatal-admission",
  data() {
    return {
      token: "",
      key: "",
      prenatal: "",

      admission: "",
      loading: false,

      loading_admission: false,

      errors: {},
    };
  },
  created() {
    this.login();
    this.getPrenatalAdmission();
    this.getPrenatalAdmissionSign();
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

    getPrenatalAdmission() {
      axios
        .get("/api/v1/prenatal-admission/" + this.key, {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then((response) => (this.prenatal = response.data))
        .catch((error) => {
          console.log(error);
          if (error.response.status == 401) {
            this.$router.push({
              name: "logout",
            });
          }
        });
    },

    getPrenatalAdmissionSign() {
      axios
        .get("/api/v1/prenatal-admission-sign/" + this.key, {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then((response) => (this.admission = response.data))
        .catch((error) => {
          console.log(error);
          if (error.response.status == 401) {
            this.$router.push({
              name: "logout",
            });
          }
        });
    },

    computeGestationPeriod() {
      let date = new Date(this.prenatal.last_menstral_period);
      let add7Days = date.setDate(date.getDate() + 7);
      let newDate = new Date(add7Days);
      let minus3Month = newDate.setMonth(newDate.getMonth() - 3);
      let anotherDate = new Date(minus3Month);
      let add1Year = anotherDate.setFullYear(anotherDate.getFullYear() + 1);
      let EED = new Date(add1Year);
      let today = new Date();
      let lmp = new Date(this.prenatal.last_menstral_period);
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

      this.prenatal.expected_due_date = y1 + "-" + m1 + "-" + d1;
      this.prenatal.gestational_period = weeks + " weeks " + days + " days";
      this.prenatal.date_of_conception = y2 + "-" + m2 + "-" + d2;
    },
    submit() {
      this.loading = true;
      axios
        .patch("/api/prenatal-admission/" + this.key, this.prenatal)
        .then(() => {
          this.$router.push({
            name: "prenatal-admissions",
          });

          Toast.fire({
            icon: "success",
            title: "Prenatal Admission successfully updated",
          });
        })
        .catch((error) => (this.errors = error.response.data.errors))
        .finally(() => {
          this.loading = false;
        });
    },

    submitPrenatalAdmission() {
      this.loading_admission = true;
      axios
        .patch("/api/prenatal-admission-sign/" + this.key, this.admission)
        .then(() => {
          this.$router.push({
            name: "prenatal-admissions",
          });

          Toast.fire({
            icon: "success",
            title: "Prenatal Admission Signs & Symptoms successfully updated",
          });
        })
        .catch((error) => (this.errors = error.response.data.errors))
        .finally(() => {
          this.loading_admission = false;
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
</style>
