<template>
  <div class="main">
    <!-- BEGIN: Mobile Menu -->
    <mobile-menu></mobile-menu>
    <!-- END: Mobile Menu -->
    <div class="flex">
      <!-- BEGIN: Side Menu -->
      <side-menu page="record"></side-menu>
      <!-- END: Side Menu -->
      <!-- BEGIN: Content -->
      <div class="content">
        <!-- BEGIN: Top Bar -->
        <top-bar title="Edit Death Record"></top-bar>
        <!-- END: Top Bar -->

        <div class="grid grid-cols-12 gap-6 mt-4">
          <div class="intro-y col-span-12 xxl:col-span-12">
            <div class="intro-y box">
              <div
                class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60"
              >
                <h2 class="font-medium text-base mr-auto">Edit Death Record</h2>

                <router-link
                  :to="{ name: 'death-records' }"
                  class="btn btn-primary btn-sm"
                  style="margin-left: 20px"
                  >Go Back</router-link
                >
              </div>
              <div class="p-5">
                <div class="grid grid-cols-12 gap-x-5">
                  <div class="col-span-12 xl:col-span-12 mt-3">
                    <form @submit.prevent="updateRecord">
                      <div class="grid grid-cols-12 gap-4" :disabled="loading">
                        <div class="col-span-12 xl:col-span-6 sm:mt-2">
                          <label for="decedent_legal_name" class="form-label"
                            >Decendent Legal Name</label
                          >
                          <input
                            id="decedent_legal_name"
                            required
                            type="text"
                            class="form-control"
                            placeholder="Input Legal Decedent Name (Include AKA’s if any) (First, Middle, Last)"
                            v-model="form.decedent_legal_name"
                          />
                          <div
                            class="text-danger font-medium text-xs mt-1"
                            v-if="errors.decedent_legal_name"
                          >
                            {{ errors.decedent_legal_name[0] }}
                          </div>
                        </div>
                        <div class="col-span-12 xl:col-span-2 md:col-span-2 sm:mt-2">
                          <label for="gender" class="form-label block">Gender</label>
                          <select
                            id="gender"
                            class="form-control w-full"
                            required
                            data-placeholder="Select your gender"
                            v-model="form.gender"
                          >
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                          </select>
                          <div
                            class="text-danger font-medium text-xs mt-1"
                            v-if="errors.gender"
                          >
                            {{ errors.gender[0] }}
                          </div>
                        </div>
                        <div class="col-span-12 xl:col-span-2 md:col-span-2 sm:mt-2">
                          <label for="nin_number" class="form-label">NIN Number</label>
                          <input
                            id="nin_number"
                            type="text"
                            required
                            class="form-control"
                            placeholder="Input National Identity Number"
                            v-model="form.nin_number"
                          />
                          <div
                            class="text-danger font-medium text-xs mt-1"
                            v-if="errors.nin_number"
                          >
                            {{ errors.nin_number[0] }}
                          </div>
                        </div>
                        <div class="col-span-12 xl:col-span-2 md:col-span-2 sm:mt-2">
                          <label for="date_of_birth" class="form-label"
                            >Date of Birth</label
                          >
                          <input
                            id="date_of_birth"
                            required
                            type="date"
                            class="form-control"
                            data-single-mode="true"
                            v-model="form.date_of_birth"
                          />
                          <div
                            class="text-danger font-medium text-xs mt-1"
                            v-if="errors.date_of_birth"
                          >
                            {{ errors.date_of_birth[0] }}
                          </div>
                        </div>
                        <div class="col-span-12 xl:col-span-4 mt-2">
                          <label for="birth_place" class="form-label">Birth Place</label>
                          <input
                            id="birth_place"
                            type="text"
                            required
                            class="form-control"
                            placeholder="Input City and State or Foreign Country of Birth"
                            v-model="form.birth_place"
                          />
                          <div
                            class="text-danger font-medium text-xs mt-1"
                            v-if="errors.birth_place"
                          >
                            {{ errors.birth_place[0] }}
                          </div>
                        </div>
                        <div class="col-span-12 xl:col-span-4 mt-2">
                          <label for="address" class="form-label">Address</label>
                          <input
                            id="address"
                            type="text"
                            class="form-control"
                            required
                            placeholder="Input Address of Decedent"
                            v-model="form.address"
                          />
                          <div
                            class="text-danger font-medium text-xs mt-1"
                            v-if="errors.address"
                          >
                            {{ errors.address[0] }}
                          </div>
                        </div>
                        <div class="col-span-12 xl:col-span-2 md:col-span-2 mt-2">
                          <label for="city" class="form-label">City</label>
                          <input
                            id="city"
                            type="text"
                            class="form-control"
                            required
                            placeholder="Input City of Decedent"
                            v-model="form.city"
                          />
                          <div
                            class="text-danger font-medium text-xs mt-1"
                            v-if="errors.city"
                          >
                            {{ errors.city[0] }}
                          </div>
                        </div>
                        <div class="col-span-12 xl:col-span-2 md:col-span-2 mt-2">
                          <label for="state" class="form-label">State</label>
                          <input
                            id="state"
                            type="text"
                            class="form-control"
                            required
                            placeholder="Input State of Decedent"
                            v-model="form.state"
                          />
                          <div
                            class="text-danger font-medium text-xs mt-1"
                            v-if="errors.state"
                          >
                            {{ errors.state[0] }}
                          </div>
                        </div>
                        <div class="col-span-12 xl:col-span-3 md:col-span-3 mt-2">
                          <label for="postal_code" class="form-label">Postal Code</label>
                          <input
                            id="postal_code"
                            type="text"
                            class="form-control"
                            required
                            placeholder="Input Postal Code of Decedent"
                            v-model="form.postal_code"
                          />
                          <div
                            class="text-danger font-medium text-xs mt-1"
                            v-if="errors.postal_code"
                          >
                            {{ errors.postal_code[0] }}
                          </div>
                        </div>
                        <div class="col-span-12 xl:col-span-3 md:col-span-3 mt-2">
                          <label for="marital_status" class="form-label"
                            >Marital Status</label
                          >
                          <select
                            id="marital_status"
                            class="tom-select form-control"
                            required
                            data-placeholder="Select your gender"
                            v-model="form.marital_status"
                          >
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                            <option value="Divorced">Divorced</option>
                            <option value="Seperated">Seperated</option>
                            <option value="Widow">Widow</option>
                          </select>
                          <div
                            class="text-danger font-medium text-xs mt-1"
                            v-if="errors.marital_status"
                          >
                            {{ errors.marital_status[0] }}
                          </div>
                        </div>
                        <div
                          class="col-span-12 xl:col-span-3 md:col-span-3 mt-2"
                          v-if="form.marital_status == 'Married'"
                        >
                          <label for="surviving_spouse_name" class="form-label"
                            >Surviving Spouse Name</label
                          >
                          <input
                            id="surviving_spouse_name"
                            type="text"
                            class="form-control"
                            placeholder="(If wife, give name prior to first marriage)"
                            v-model="form.surviving_spouse_name"
                          />
                          <div
                            class="text-danger font-medium text-xs mt-1"
                            v-if="errors.surviving_spouse_name"
                          >
                            {{ errors.surviving_spouse_name[0] }}
                          </div>
                        </div>
                        <div class="col-span-12 xl:col-span-3 md:col-span-3 mt-2">
                          <label for="father_name" class="form-label"
                            >Father's Name</label
                          >
                          <input
                            id="father_name"
                            type="text"
                            class="form-control"
                            placeholder="(First, Middle, Last)"
                            v-model="form.father_name"
                          />
                          <div
                            class="text-danger font-medium text-xs mt-1"
                            v-if="errors.father_name"
                          >
                            {{ errors.father_name[0] }}
                          </div>
                        </div>
                        <div class="col-span-12 xl:col-span-4 md:col-span-4 mt-2">
                          <label for="mother_name" class="form-label"
                            >MOTHER’S NAME PRIOR TO FIRST MARRIAGE</label
                          >
                          <input
                            id="mother_name"
                            type="text"
                            class="form-control"
                            placeholder="(First, Middle, Last)"
                            v-model="form.mother_name"
                          />
                          <div
                            class="text-danger font-medium text-xs mt-1"
                            v-if="errors.mother_name"
                          >
                            {{ errors.mother_name[0] }}
                          </div>
                        </div>
                        <div class="col-span-12 xl:col-span-3 md:col-span-3 mt-2">
                          <label for="informant_name" class="form-label"
                            >Informant Name</label
                          >
                          <input
                            id="informant_name"
                            type="text"
                            class="form-control"
                            placeholder="(First, Middle, Last)"
                            v-model="form.informant_name"
                          />
                          <div
                            class="text-danger font-medium text-xs mt-1"
                            v-if="errors.informant_name"
                          >
                            {{ errors.informant_name[0] }}
                          </div>
                        </div>
                        <div class="col-span-12 xl:col-span-2 md:col-span-2 mt-2">
                          <label for="relationship_with_decedent" class="form-label"
                            >Relationship with decedent</label
                          >
                          <input
                            id="relationship_with_decedent"
                            type="text"
                            class="form-control"
                            required
                            placeholder="Input Relationship to Decedent"
                            v-model="form.relationship_with_decedent"
                          />
                          <div
                            class="text-danger font-medium text-xs mt-1"
                            v-if="errors.relationship_with_decedent"
                          >
                            {{ errors.relationship_with_decedent[0] }}
                          </div>
                        </div>
                        <div class="col-span-12 xl:col-span-3 md:col-span-3 mt-2">
                          <label for="if_death_occured_in_a_hospital" class="form-label"
                            >Place of Death (Hospital)</label
                          >
                          <select
                            id="if_death_occured_in_a_hospital"
                            class="tom-select form-control"
                            data-placeholder="Select where death occurred in the hospital"
                            v-model="form.if_death_occured_in_a_hospital"
                          >
                            <option value="Inpatient">Inpatient</option>
                            <option value="Emergency Room/Outpatient">
                              Emergency Room/Outpatient
                            </option>
                            <option value="Dead on Arrival">Dead on Arrival</option>
                          </select>
                          <div
                            class="text-danger font-medium text-xs mt-1"
                            v-if="errors.if_death_occured_in_a_hospital"
                          >
                            {{ errors.if_death_occured_in_a_hospital[0] }}
                          </div>
                        </div>
                        <div class="col-span-12 xl:col-span-3 md:col-span-3 mt-2">
                          <label
                            for="if_death_occurred_somewhere_other_than_hospital"
                            class="form-label"
                            >Place of Death (Not Hospital)</label
                          >
                          <select
                            id="if_death_occurred_somewhere_other_than_hospital"
                            class="tom-select form-control"
                            data-placeholder="Select where death occurred in the hospital"
                            v-model="form.if_death_occurred_somewhere_other_than_hospital"
                          >
                            <option value="Hospital Facility">Hospital Facility</option>
                            <option value="Nursing home/Long term care facility">
                              Nursing home/Long term care facility
                            </option>
                            <option value="Decedent's home">Decedent's home</option>
                            <option value="Other">Other</option>
                          </select>
                          <div
                            class="text-danger font-medium text-xs mt-1"
                            v-if="errors.if_death_occurred_somewhere_other_than_hospital"
                          >
                            {{
                              errors.if_death_occurred_somewhere_other_than_hospital[0]
                            }}
                          </div>
                        </div>
                        <div
                          class="col-span-12 xl:col-span-3 md:col-span-3 mt-2"
                          v-if="
                            form.if_death_occurred_somewhere_other_than_hospital ==
                            'Other'
                          "
                        >
                          <label
                            for="if_death_occurred_somewhere_other_than_hospital_specify"
                            class="form-label"
                            >Specify</label
                          >
                          <input
                            id="if_death_occurred_somewhere_other_than_hospital_specify"
                            type="text"
                            class="form-control"
                            placeholder="Specify"
                            v-model="
                              form.if_death_occurred_somewhere_other_than_hospital_specify
                            "
                          />
                          <div
                            class="text-danger font-medium text-xs mt-1"
                            v-if="
                              errors.if_death_occurred_somewhere_other_than_hospital_specify
                            "
                          >
                            {{
                              errors
                                .if_death_occurred_somewhere_other_than_hospital_specify[0]
                            }}
                          </div>
                        </div>
                        <div class="col-span-12 xl:col-span-4 md:col-span-4 mt-2">
                          <label for="facility_name" class="form-label"
                            >Facility Name
                            <small
                              >(If not institution, give street & number)</small
                            ></label
                          >
                          <input
                            id="facility_name"
                            type="text"
                            class="form-control"
                            required
                            placeholder="Facility Name (If not institution, give street & number)"
                            v-model="form.facility_name"
                          />
                          <div
                            class="text-danger font-medium text-xs mt-1"
                            v-if="errors.facility_name"
                          >
                            {{ errors.facility_name[0] }}
                          </div>
                        </div>
                        <div class="col-span-12 xl:col-span-3 md:col-span-3 mt-2">
                          <label for="facility_address" class="form-label"
                            >Facility Address</label
                          >
                          <input
                            id="facility_address"
                            type="text"
                            class="form-control"
                            required
                            placeholder="City, State and Postal Code"
                            v-model="form.facility_address"
                          />
                          <div
                            class="text-danger font-medium text-xs mt-1"
                            v-if="errors.facility_address"
                          >
                            {{ errors.facility_address[0] }}
                          </div>
                        </div>
                        <div class="col-span-12 xl:col-span-2 md:col-span-2 mt-2">
                          <label for="country_of_death" class="form-label"
                            >Country of Death</label
                          >
                          <input
                            id="country_of_death"
                            type="text"
                            class="form-control"
                            required
                            placeholder="Country"
                            v-model="form.country_of_death"
                          />
                          <div
                            class="text-danger font-medium text-xs mt-1"
                            v-if="errors.country_of_death"
                          >
                            {{ errors.country_of_death[0] }}
                          </div>
                        </div>
                        <div class="col-span-12 xl:col-span-3 md:col-span-3 mt-2">
                          <label for="method_of_disposition" class="form-label"
                            >Method of Disposition</label
                          >
                          <select
                            id="method_of_disposition"
                            required
                            class="tom-select form-control"
                            data-placeholder="Select where death occurred in the hospital"
                            v-model="form.method_of_disposition"
                          >
                            <option value="Burial">Burial</option>
                            <option value="Cremation">Cremation</option>
                            <option value="Donation">Donation</option>
                            <option value="Entombment">Entombment</option>
                            <option value="Removal from State">Removal from State</option>
                            <option value="Other">Other</option>
                          </select>
                          <div
                            class="text-danger font-medium text-xs mt-1"
                            v-if="errors.method_of_disposition"
                          >
                            {{ errors.method_of_disposition[0] }}
                          </div>
                        </div>
                        <div
                          class="col-span-12 xl:col-span-3 md:col-span-3 mt-2"
                          v-if="form.method_of_disposition == 'Other'"
                        >
                          <label for="method_of_disposition_specify" class="form-label"
                            >Specify</label
                          >
                          <input
                            id="method_of_disposition_specify"
                            type="text"
                            class="form-control"
                            placeholder="Specify"
                            v-model="form.method_of_disposition_specify"
                          />
                          <div
                            class="text-danger font-medium text-xs mt-1"
                            v-if="errors.method_of_disposition_specify"
                          >
                            {{ errors.method_of_disposition_specify[0] }}
                          </div>
                        </div>
                        <div class="col-span-12 xl:col-span-3 md:col-span-3 mt-2">
                          <label for="place_of_disposition" class="form-label"
                            >Place of Disposition</label
                          >
                          <input
                            id="place_of_disposition"
                            type="text"
                            required
                            class="form-control"
                            placeholder="(Name of cemetery, crematory, other place)"
                            v-model="form.place_of_disposition"
                          />
                          <div
                            class="text-danger font-medium text-xs mt-1"
                            v-if="errors.place_of_disposition"
                          >
                            {{ errors.place_of_disposition[0] }}
                          </div>
                        </div>
                        <div class="col-span-12 xl:col-span-6 md:col-span-6 mt-2">
                          <label for="address_of_disposition" class="form-label"
                            >Address of Disposition</label
                          >
                          <input
                            id="address_of_disposition"
                            type="text"
                            class="form-control"
                            placeholder="Location, city, Town, State"
                            v-model="form.address_of_disposition"
                          />
                          <div
                            class="text-danger font-medium text-xs mt-1"
                            v-if="errors.address_of_disposition"
                          >
                            {{ errors.address_of_disposition[0] }}
                          </div>
                        </div>
                        <div class="col-span-12 xl:col-span-6 md:col-span-6 mt-2">
                          <label
                            for="name_and_address_of_funeral_facility"
                            class="form-label"
                            >Name &amp; Address of Funeral Facility</label
                          >
                          <input
                            id="name_and_address_of_funeral_facility"
                            type="text"
                            class="form-control"
                            placeholder="Name, Street Number, Street Name, City, Town, State"
                            v-model="form.name_and_address_of_funeral_facility"
                          />
                          <div
                            class="text-danger font-medium text-xs mt-1"
                            v-if="errors.name_and_address_of_funeral_facility"
                          >
                            {{ errors.name_and_address_of_funeral_facility[0] }}
                          </div>
                        </div>
                        <div class="col-span-12 xl:col-span-3 md:col-span-3 sm:mt-2">
                          <label for="date_pronounced_dead" class="form-label"
                            >Date Pronounced Dead</label
                          >
                          <input
                            id="date_pronounced_dead"
                            type="date"
                            class="form-control"
                            v-model="form.date_pronounced_dead"
                          />
                          <div
                            class="text-danger font-medium text-xs mt-1"
                            v-if="errors.date_pronounced_dead"
                          >
                            {{ errors.date_pronounced_dead[0] }}
                          </div>
                        </div>
                        <div class="col-span-12 xl:col-span-3 md:col-span-3 sm:mt-2">
                          <label for="time_pronounced_dead" class="form-label"
                            >Time Pronounced Dead</label
                          >
                          <input
                            id="time_pronounced_dead"
                            type="time"
                            class="form-control"
                            v-model="form.time_pronounced_dead"
                          />
                          <div
                            class="text-danger font-medium text-xs mt-1"
                            v-if="errors.time_pronounced_dead"
                          >
                            {{ errors.time_pronounced_dead[0] }}
                          </div>
                        </div>
                        <div class="col-span-12 xl:col-span-3 md:col-span-3 sm:mt-2">
                          <label for="actual_date_of_death" class="form-label"
                            >Actual Date of Death</label
                          >
                          <input
                            id="actual_date_of_death"
                            type="date"
                            class="required form-control"
                            v-model="form.actual_date_of_death"
                          />
                          <div
                            class="text-danger font-medium text-xs mt-1"
                            v-if="errors.actual_date_of_death"
                          >
                            {{ errors.actual_date_of_death[0] }}
                          </div>
                        </div>
                        <div class="col-span-12 xl:col-span-3 md:col-span-3 sm:mt-2">
                          <label for="actual_time_of_death" class="form-label"
                            >Actual Time of Death</label
                          >
                          <input
                            id="actual_time_of_death"
                            type="time"
                            required
                            class="form-control"
                            v-model="form.actual_time_of_death"
                          />
                          <div
                            class="text-danger font-medium text-xs mt-1"
                            v-if="errors.actual_time_of_death"
                          >
                            {{ errors.actual_time_of_death[0] }}
                          </div>
                        </div>
                        <div class="col-span-12 xl:col-span-3 md:col-span-3 sm:mt-2">
                          <label class="form-label"
                            >Was Medical Examiner or Coroner Contacted</label
                          >
                          <div class="flex flex-col sm:flex-row mt-2">
                            <div class="form-check mr-2">
                              <input
                                id="radio-switch-4"
                                class="form-check-input"
                                type="radio"
                                v-model="form.medical_examminer_contacted"
                                name="medical_examminer_contacted"
                                value="1"
                              />
                              <label class="form-check-label" for="radio-switch-4"
                                >Yes</label
                              >
                            </div>
                            <div class="form-check mr-2 mt-2 sm:mt-0">
                              <input
                                id="radio-switch-5"
                                class="form-check-input"
                                type="radio"
                                v-model="form.medical_examminer_contacted"
                                name="medical_examminer_contacted"
                                value="0"
                              />
                              <label class="form-check-label" for="radio-switch-5"
                                >No</label
                              >
                            </div>
                          </div>
                        </div>
                        <div class="col-span-12 xl:col-span-12 md:col-span-12 sm:mt-2">
                          <table class="table table-bordered">
                            <tr>
                              <td colspan="3">
                                <h3 class="font-medium text-xl text-center">
                                  <span class="uppercase">Cause of Death</span>(See
                                  Instruction and examples)
                                </h3>
                                <p>
                                  <strong>PART I.</strong> Enter the chain of
                                  events--diseases, injuries, or complications--that
                                  directly caused the death. DO NOT enter terminal events
                                  such as cardiac arrest, respiratory arrest, or
                                  ventricular fibrillation without showing the etiology.
                                  DO NOT ABBREVIATE. Enter only one cause on a line. Add
                                  additional lines if necessary.
                                </p>
                              </td>
                              <td>Approximate interval: Onset to death</td>
                            </tr>
                            <tr>
                              <td colspan="3">
                                <div class="form-inline">
                                  <label
                                    for="immediate_cause_of_death"
                                    class="form-label sm:w-52"
                                    >IMMEDIATE CAUSE (Final disease or condition resulting
                                    in death)</label
                                  >
                                  <input
                                    id="immediate_cause_of_death"
                                    required
                                    type="text"
                                    v-model="form.immediate_cause_of_death"
                                    class="form-control"
                                    placeholder="Due to or as a consequence of"
                                  />
                                  <div
                                    class="text-danger font-medium text-xs mt-1"
                                    v-if="errors.immediate_cause_of_death"
                                  >
                                    {{ errors.immediate_cause_of_death[0] }}
                                  </div>
                                </div>
                              </td>
                              <td>
                                <div class="w-full">
                                  <input
                                    id="immediate_cause_of_death_interval"
                                    required
                                    type="text"
                                    class="form-control"
                                    v-model="form.immediate_cause_of_death_interval"
                                  />
                                  <div
                                    class="text-danger font-medium text-xs mt-1"
                                    v-if="errors.immediate_cause_of_death_interval"
                                  >
                                    {{ errors.immediate_cause_of_death_interval[0] }}
                                  </div>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td colspan="3">
                                <div class="form-inline">
                                  <label
                                    for="immediate_cause_of_death"
                                    class="form-label sm:w-52"
                                    >Sequential list Conditions, if any, leading to the
                                    cause listed above</label
                                  >
                                  <input
                                    id="sequential_cause_of_death"
                                    type="text"
                                    required
                                    v-model="form.sequential_cause_of_death"
                                    class="form-control"
                                    placeholder="Due to or as a consequence of"
                                  />
                                  <div
                                    class="text-danger font-medium text-xs mt-1"
                                    v-if="errors.sequential_cause_of_death"
                                  >
                                    {{ errors.sequential_cause_of_death[0] }}
                                  </div>
                                </div>
                              </td>
                              <td>
                                <div class="w-full">
                                  <input
                                    id="sequential_cause_of_death_interval"
                                    type="text"
                                    class="form-control"
                                    required
                                    v-model="form.sequential_cause_of_death_interval"
                                  />
                                  <div
                                    class="text-danger font-medium text-xs mt-1"
                                    v-if="errors.sequential_cause_of_death_interval"
                                  >
                                    {{ errors.sequential_cause_of_death_interval[0] }}
                                  </div>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td colspan="3">
                                <div class="form-inline">
                                  <label
                                    for="underlying_cause_of_death"
                                    class="form-label sm:w-52"
                                    >Underlying Cause (disease or injury that initiated
                                    the events resulting in death)</label
                                  >
                                  <input
                                    id="underlying_cause_of_death"
                                    type="text"
                                    v-model="form.underlying_cause_of_death"
                                    required
                                    class="form-control"
                                    placeholder="Due to or as a consequence of"
                                  />
                                  <div
                                    class="text-danger font-medium text-xs mt-1"
                                    v-if="errors.underlying_cause_of_death"
                                  >
                                    {{ errors.underlying_cause_of_death[0] }}
                                  </div>
                                </div>
                              </td>
                              <td>
                                <div class="w-full">
                                  <input
                                    id="underlying_cause_of_death_interval"
                                    required
                                    type="text"
                                    class="form-control"
                                    v-model="form.underlying_cause_of_death_interval"
                                  />
                                  <div
                                    class="text-danger font-medium text-xs mt-1"
                                    v-if="errors.underlying_cause_of_death_interval"
                                  >
                                    {{ errors.underlying_cause_of_death_interval[0] }}
                                  </div>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td colspan="3">
                                <div class="form-inline">
                                  <label
                                    for="last_event_resulting_in_death"
                                    class="form-label sm:w-52"
                                    >Last Event that result to death</label
                                  >
                                  <input
                                    id="last_event_resulting_in_death"
                                    required
                                    type="text"
                                    v-model="form.last_event_resulting_in_death"
                                    class="form-control"
                                    placeholder="Due to or as a consequence of"
                                  />
                                  <div
                                    class="text-danger font-medium text-xs mt-1"
                                    v-if="errors.last_event_resulting_in_death"
                                  >
                                    {{ errors.last_event_resulting_in_death[0] }}
                                  </div>
                                </div>
                              </td>
                              <td>
                                <div class="w-full">
                                  <input
                                    id="last_event_resulting_in_death_interval"
                                    required
                                    type="text"
                                    class="form-control"
                                    v-model="form.last_event_resulting_in_death_interval"
                                  />
                                  <div
                                    class="text-danger font-medium text-xs mt-1"
                                    v-if="errors.last_event_resulting_in_death_interval"
                                  >
                                    {{ errors.last_event_resulting_in_death_interval[0] }}
                                  </div>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td colspan="3">
                                <strong>PART II</strong> Enter other significant
                                conditions contributing to death but not resulting in the
                                underlying cause given in PART I
                                <textarea
                                  rows="5"
                                  class="form-control"
                                  v-model="
                                    form.significant_conditions_contibuting_to_death
                                  "
                                ></textarea>
                                <div
                                  class="text-danger font-medium text-xs mt-1"
                                  v-if="
                                    errors.significant_conditions_contibuting_to_death
                                  "
                                >
                                  {{
                                    errors.significant_conditions_contibuting_to_death[0]
                                  }}
                                </div>
                              </td>
                              <td>
                                <div class="w-full">
                                  <label class="form-label"
                                    >Was an autopsy performed?</label
                                  >
                                  <div class="flex flex-col sm:flex-row mt-2">
                                    <div class="form-check mr-2">
                                      <input
                                        id="radio-switch-6"
                                        class="form-check-input"
                                        type="radio"
                                        v-model="form.autopsy_performed"
                                        name="autopsy_performed"
                                        value="1"
                                      />
                                      <label class="form-check-label" for="radio-switch-6"
                                        >Yes</label
                                      >
                                    </div>
                                    <div class="form-check mr-2 mt-2 sm:mt-0">
                                      <input
                                        id="radio-switch-7"
                                        class="form-check-input"
                                        type="radio"
                                        v-model="form.autopsy_performed"
                                        name="autopsy_performed"
                                        value="0"
                                      />
                                      <label class="form-check-label" for="radio-switch-7"
                                        >No</label
                                      >
                                    </div>
                                  </div>
                                  <div
                                    class="text-danger font-medium text-xs mt-1"
                                    v-if="errors.autopsy_performed"
                                  >
                                    {{ errors.autopsy_performed[0] }}
                                  </div>
                                </div>
                                <div class="w-full mt-3">
                                  <label class="form-label"
                                    >Were the autopsy findings available to complete the
                                    cause of death?</label
                                  >
                                  <div class="flex flex-col sm:flex-row mt-2">
                                    <div class="form-check mr-2">
                                      <input
                                        id="radio-switch-8"
                                        class="form-check-input"
                                        type="radio"
                                        v-model="form.autopsy_findings"
                                        name="autopsy_findings"
                                        value="1"
                                      />
                                      <label class="form-check-label" for="radio-switch-8"
                                        >Yes</label
                                      >
                                    </div>
                                    <div class="form-check mr-2 mt-2 sm:mt-0">
                                      <input
                                        id="radio-switch-9"
                                        class="form-check-input"
                                        type="radio"
                                        v-model="form.autopsy_findings"
                                        name="autopsy_findings"
                                        value="0"
                                      />
                                      <label class="form-check-label" for="radio-switch-9"
                                        >No</label
                                      >
                                    </div>
                                  </div>
                                  <div
                                    class="text-danger font-medium text-xs mt-1"
                                    v-if="errors.autopsy_findings"
                                  >
                                    {{ errors.autopsy_findings[0] }}
                                  </div>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <div class="w-full">
                                  <label class="form-label"
                                    >Did Tobacco use contribute to death?</label
                                  >
                                  <div class="flex flex-col sm:flex-row mt-2">
                                    <div class="form-check mr-2">
                                      <input
                                        id="radio-switch-10"
                                        class="form-check-input"
                                        type="radio"
                                        v-model="form.tobacco_to_death"
                                        name="tobacco_to_death"
                                        value="Yes"
                                      />
                                      <label
                                        class="form-check-label"
                                        for="radio-switch-10"
                                        >Yes</label
                                      >
                                    </div>
                                    <div class="form-check mr-2 mt-2 sm:mt-0">
                                      <input
                                        id="radio-switch-11"
                                        class="form-check-input"
                                        type="radio"
                                        v-model="form.tobacco_to_death"
                                        name="tobacco_to_death"
                                        value="No"
                                      />
                                      <label
                                        class="form-check-label"
                                        for="radio-switch-11"
                                        >No</label
                                      >
                                    </div>
                                    <div class="form-check mr-2 mt-2 sm:mt-0">
                                      <input
                                        id="radio-switch-17"
                                        class="form-check-input"
                                        type="radio"
                                        v-model="form.tobacco_to_death"
                                        name="tobacco_to_death"
                                        value="Probably"
                                      />
                                      <label
                                        class="form-check-label"
                                        for="radio-switch-17"
                                        >Probably</label
                                      >
                                    </div>
                                    <div class="form-check mr-2 mt-2 sm:mt-0">
                                      <input
                                        id="radio-switch-18"
                                        class="form-check-input"
                                        type="radio"
                                        v-model="form.tobacco_to_death"
                                        name="tobacco_to_death"
                                        value="Unknown"
                                      />
                                      <label
                                        class="form-check-label"
                                        for="radio-switch-18"
                                        >Unknown</label
                                      >
                                    </div>
                                  </div>
                                  <div
                                    class="text-danger font-medium text-xs mt-1"
                                    v-if="errors.tobacco_to_death"
                                  >
                                    {{ errors.tobacco_to_death[0] }}
                                  </div>
                                </div>
                              </td>
                              <td colspan="2">
                                <div class="w-full">
                                  <label class="form-label">If Female?</label>
                                  <div class="mt-2">
                                    <div class="form-check mt-2">
                                      <input
                                        id="radio-switch-12"
                                        class="form-check-input"
                                        type="radio"
                                        v-model="form.pregnancy"
                                        name="pregnancy"
                                        value="Not pregnant within past year"
                                      />
                                      <label
                                        class="form-check-label"
                                        for="radio-switch-12"
                                        >Not pregnant within past year</label
                                      >
                                    </div>
                                    <div class="form-check mr-2 pt-3 sm:mt-0">
                                      <input
                                        id="radio-switch-13"
                                        class="form-check-input"
                                        type="radio"
                                        v-model="form.pregnancy"
                                        name="pregnancy"
                                        value="Pregnant at time of death"
                                      />
                                      <label
                                        class="form-check-label"
                                        for="radio-switch-13"
                                        >Pregnant at time of death</label
                                      >
                                    </div>
                                    <div class="form-check pt-3 sm:mt-0">
                                      <input
                                        id="radio-switch-14"
                                        class="form-check-input"
                                        type="radio"
                                        v-model="form.pregnancy"
                                        name="pregnancy"
                                        value="Not pregnant, but pregnant within 42 days of death"
                                      />
                                      <label
                                        class="form-check-label"
                                        for="radio-switch-14"
                                        >Not pregnant, but pregnant within 42 days of
                                        death</label
                                      >
                                    </div>
                                    <div class="form-check pt-3 mt-2 sm:mt-0">
                                      <input
                                        id="radio-switch-15"
                                        class="form-check-input"
                                        type="radio"
                                        v-model="form.pregnancy"
                                        name="pregnancy"
                                        value="Not pregnant, but pregnant 43 days to 1 year before death"
                                      />
                                      <label
                                        class="form-check-label"
                                        for="radio-switch-15"
                                        >Not pregnant, but pregnant 43 days to 1 year
                                        before death</label
                                      >
                                    </div>
                                    <div class="form-check pt-3 mt-2 sm:mt-0">
                                      <input
                                        id="radio-switch-16"
                                        class="form-check-input"
                                        type="radio"
                                        v-model="form.pregnancy"
                                        name="pregnancy"
                                        value="Unknown if pregnant within the past year"
                                      />
                                      <label
                                        class="form-check-label"
                                        for="radio-switch-16"
                                        >Unknown if pregnant within the past year</label
                                      >
                                    </div>
                                  </div>
                                  <div
                                    class="text-danger font-medium text-xs mt-1"
                                    v-if="errors.pregnancy"
                                  >
                                    {{ errors.pregnancy[0] }}
                                  </div>
                                </div>
                              </td>
                              <td>
                                <div class="w-full">
                                  <label class="form-label">Manner of Death</label>
                                  <div class="mt-2">
                                    <div class="form-check mr-2">
                                      <input
                                        id="radio-switch-19"
                                        class="form-check-input"
                                        type="radio"
                                        v-model="form.manner_of_death"
                                        name="manner_of_death"
                                        value="Natural"
                                      />
                                      <label
                                        class="form-check-label"
                                        for="radio-switch-19"
                                        >Natural</label
                                      >
                                    </div>
                                    <div class="form-check mr-2 pt-3 sm:mt-0">
                                      <input
                                        id="radio-switch-20"
                                        class="form-check-input"
                                        type="radio"
                                        v-model="form.manner_of_death"
                                        name="manner_of_death"
                                        value="Homicide"
                                      />
                                      <label
                                        class="form-check-label"
                                        for="radio-switch-20"
                                        >Homicide</label
                                      >
                                    </div>
                                    <div class="form-check mr-2 pt-3 sm:mt-0">
                                      <input
                                        id="radio-switch-21"
                                        class="form-check-input"
                                        type="radio"
                                        v-model="form.manner_of_death"
                                        name="manner_of_death"
                                        value="Accident"
                                      />
                                      <label
                                        class="form-check-label"
                                        for="radio-switch-21"
                                        >Accident</label
                                      >
                                    </div>
                                    <div class="form-check mr-2 pt-3 sm:mt-0">
                                      <input
                                        id="radio-switch-22"
                                        class="form-check-input"
                                        type="radio"
                                        v-model="form.manner_of_death"
                                        name="manner_of_death"
                                        value="Suicide"
                                      />
                                      <label
                                        class="form-check-label"
                                        for="radio-switch-22"
                                        >Suicide</label
                                      >
                                    </div>
                                    <div class="form-check mr-2 pt-3 sm:mt-0">
                                      <input
                                        id="radio-switch-99"
                                        class="form-check-input"
                                        type="radio"
                                        v-model="form.manner_of_death"
                                        name="manner_of_death"
                                        value="Pending Investigation"
                                      />
                                      <label
                                        class="form-check-label"
                                        for="radio-switch-99"
                                        >Pending Investigation</label
                                      >
                                    </div>
                                    <div class="form-check mr-2 pt-3 sm:mt-0">
                                      <input
                                        id="radio-switch-23"
                                        class="form-check-input"
                                        type="radio"
                                        v-model="form.manner_of_death"
                                        name="manner_of_death"
                                        value="Could not be determined"
                                      />
                                      <label
                                        class="form-check-label"
                                        for="radio-switch-21"
                                        >Could not be determined</label
                                      >
                                    </div>
                                  </div>
                                  <div
                                    class="text-danger font-medium text-xs mt-1"
                                    v-if="errors.manner_of_death"
                                  >
                                    {{ errors.manner_of_death[0] }}
                                  </div>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <div class="w-full">
                                  <label for="date_of_injury" class="form-label"
                                    >Date of Injury</label
                                  >
                                  <input
                                    id="date_of_injury"
                                    type="date"
                                    class="form-control"
                                    v-model="form.date_of_injury"
                                  />
                                  <div
                                    class="text-danger font-medium text-xs mt-1"
                                    v-if="errors.date_of_injury"
                                  >
                                    {{ errors.date_of_injury[0] }}
                                  </div>
                                </div>
                              </td>
                              <td>
                                <div class="w-full">
                                  <label for="time_of_injury" class="form-label"
                                    >Time of Injury</label
                                  >
                                  <input
                                    id="time_of_injury"
                                    type="time"
                                    class="form-control"
                                    v-model="form.time_of_injury"
                                  />
                                  <div
                                    class="text-danger font-medium text-xs mt-1"
                                    v-if="errors.time_of_injury"
                                  >
                                    {{ errors.time_of_injury[0] }}
                                  </div>
                                </div>
                              </td>
                              <td>
                                <div class="w-full">
                                  <label for="place_of_injury" class="form-label"
                                    >Place of Injury</label
                                  >
                                  <input
                                    id="place_of_injury"
                                    type="text"
                                    class="form-control"
                                    placeholder="E.g. Decedent's home; construction site, restaurant, wooded area"
                                    v-model="form.place_of_injury"
                                  />
                                  <div
                                    class="text-danger font-medium text-xs mt-1"
                                    v-if="errors.place_of_injury"
                                  >
                                    {{ errors.place_of_injury[0] }}
                                  </div>
                                </div>
                              </td>
                              <td>
                                <div class="w-full">
                                  <label class="form-label">Injury at Work?</label>
                                  <div class="flex flex-col ms:flex-row mt-2">
                                    <div class="form-check mr-2">
                                      <input
                                        id="radio-switch-24"
                                        class="form-check-input"
                                        type="radio"
                                        v-model="form.injury_at_work"
                                        name="injury_at_work"
                                        value="1"
                                      />
                                      <label
                                        class="form-check-label"
                                        for="radio-switch-24"
                                        >Yes</label
                                      >
                                    </div>
                                    <div class="form-check mr-2 pt-3 sm:mt-0">
                                      <input
                                        id="radio-switch-25"
                                        class="form-check-input"
                                        type="radio"
                                        v-model="form.injury_at_work"
                                        name="injury_at_work"
                                        value="0"
                                      />
                                      <label
                                        class="form-check-label"
                                        for="radio-switch-25"
                                        >No</label
                                      >
                                    </div>
                                  </div>
                                  <div
                                    class="text-danger font-medium text-xs mt-1"
                                    v-if="errors.injury_at_work"
                                  >
                                    {{ errors.injury_at_work[0] }}
                                  </div>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <div class="w-full">
                                  <label for="address_of_injury" class="form-label"
                                    >Location of Injury</label
                                  >
                                  <input
                                    id="address_of_injury"
                                    type="text"
                                    class="form-control"
                                    placeholder="Address, City, State of Injury"
                                    v-model="form.address_of_injury"
                                  />
                                  <div
                                    class="text-danger font-medium text-xs mt-1"
                                    v-if="errors.address_of_injury"
                                  >
                                    {{ errors.address_of_injury[0] }}
                                  </div>
                                </div>
                              </td>
                              <td colspan="2">
                                <div class="w-full">
                                  <label for="address_of_injury" class="form-label"
                                    >How Injury Occurred</label
                                  >
                                  <textarea
                                    rows="5"
                                    class="form-control"
                                    v-model="form.how_injury_occurred"
                                  ></textarea>
                                  <div
                                    class="text-danger font-medium text-xs mt-1"
                                    v-if="errors.how_injury_occurred"
                                  >
                                    {{ errors.how_injury_occurred[0] }}
                                  </div>
                                </div>
                              </td>
                              <td>
                                <div class="w-full">
                                  <label class="form-label"
                                    >If Transportation Injury, Specify</label
                                  >
                                  <div class="flex flex-col ms:flex-row mt-2">
                                    <div class="form-check mr-2">
                                      <input
                                        id="radio-switch-26"
                                        class="form-check-input"
                                        type="radio"
                                        v-model="form.transportation_injury"
                                        name="transportation_injury"
                                        value="Driver/Operator"
                                      />
                                      <label
                                        class="form-check-label"
                                        for="radio-switch-26"
                                        >Driver/Operator</label
                                      >
                                    </div>
                                    <div class="form-check mr-2 pt-3 sm:mt-0">
                                      <input
                                        id="radio-switch-27"
                                        class="form-check-input"
                                        type="radio"
                                        v-model="form.transportation_injury"
                                        name="transportation_injury"
                                        value="Passenger"
                                      />
                                      <label
                                        class="form-check-label"
                                        for="radio-switch-27"
                                        >Passenger</label
                                      >
                                    </div>
                                    <div class="form-check mr-2 pt-3 sm:mt-0">
                                      <input
                                        id="radio-switch-28"
                                        class="form-check-input"
                                        type="radio"
                                        v-model="form.transportation_injury"
                                        name="transportation_injury"
                                        value="Pedestrian"
                                      />
                                      <label
                                        class="form-check-label"
                                        for="radio-switch-28"
                                        >Pedestrian</label
                                      >
                                    </div>
                                  </div>
                                  <div
                                    class="text-danger font-medium text-xs mt-1"
                                    v-if="errors.transportation_injury"
                                  >
                                    {{ errors.transportation_injury[0] }}
                                  </div>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td colspan="2">
                                <label
                                  for="name_of_person_completing_cause_death"
                                  class="form-label"
                                  >Name of Person Completing Cause of Death</label
                                >
                                <input
                                  id="name_of_person_completing_cause_death"
                                  required
                                  type="text"
                                  class="form-control"
                                  v-model="form.name_of_person_completing_cause_death"
                                />
                                <div
                                  class="text-danger font-medium text-xs mt-1"
                                  v-if="errors.name_of_person_completing_cause_death"
                                >
                                  {{ errors.name_of_person_completing_cause_death[0] }}
                                </div>
                              </td>
                              <td colspan="2">
                                <label
                                  for="address_of_person_completing_cause_of_death"
                                  class="form-label"
                                  >Address of Person Completing Cause of Death</label
                                >
                                <input
                                  id="address_of_person_completing_cause_of_death"
                                  required
                                  type="text"
                                  class="form-control"
                                  v-model="
                                    form.address_of_person_completing_cause_of_death
                                  "
                                />
                                <div
                                  class="text-danger font-medium text-xs mt-1"
                                  v-if="
                                    errors.address_of_person_completing_cause_of_death
                                  "
                                >
                                  {{
                                    errors.address_of_person_completing_cause_of_death[0]
                                  }}
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <div class="w-full">
                                  <label class="form-label">Decedent Education</label>
                                  <div class="mt-2">
                                    <div class="form-check mt-2">
                                      <input
                                        id="radio-switch-30"
                                        class="form-check-input"
                                        type="radio"
                                        v-model="form.decedent_education"
                                        name="decedent_education"
                                        value="8th Grade"
                                      />
                                      <label
                                        class="form-check-label"
                                        for="radio-switch-30"
                                        >8th Grade</label
                                      >
                                    </div>
                                    <div class="form-check mr-2 pt-3 sm:mt-0">
                                      <input
                                        id="radio-switch-31"
                                        class="form-check-input"
                                        type="radio"
                                        v-model="form.decedent_education"
                                        name="decedent_education"
                                        value="9th - 12th Grade / Secondary"
                                      />
                                      <label
                                        class="form-check-label"
                                        for="radio-switch-31"
                                        >9th - 12th Grade / Secondary</label
                                      >
                                    </div>
                                    <div class="form-check pt-3 sm:mt-0">
                                      <input
                                        id="radio-switch-32"
                                        class="form-check-input"
                                        type="radio"
                                        v-model="form.decedent_education"
                                        name="decedent_education"
                                        value="High school graduate or GED completed"
                                      />
                                      <label
                                        class="form-check-label"
                                        for="radio-switch-32"
                                        >High school graduate or GED completed</label
                                      >
                                    </div>
                                    <div class="form-check pt-3 mt-2 sm:mt-0">
                                      <input
                                        id="radio-switch-33"
                                        class="form-check-input"
                                        type="radio"
                                        v-model="form.decedent_education"
                                        name="decedent_education"
                                        value="Some college credit but no degree"
                                      />
                                      <label
                                        class="form-check-label"
                                        for="radio-switch-33"
                                        >Some college credit but no degree</label
                                      >
                                    </div>
                                    <div class="form-check pt-3 mt-2 sm:mt-0">
                                      <input
                                        id="radio-switch-34"
                                        class="form-check-input"
                                        type="radio"
                                        v-model="form.decedent_education"
                                        name="decedent_education"
                                        value="Associate degree (e.g. AA, AS)"
                                      />
                                      <label
                                        class="form-check-label"
                                        for="radio-switch-34"
                                        >Associate degree (e.g. AA, AS)</label
                                      >
                                    </div>
                                    <div class="form-check pt-3 mt-2 sm:mt-0">
                                      <input
                                        id="radio-switch-35"
                                        class="form-check-input"
                                        type="radio"
                                        v-model="form.decedent_education"
                                        name="decedent_education"
                                        value="Bachelor's degree (e.g. Bsc, BS, BA, AB)"
                                      />
                                      <label
                                        class="form-check-label"
                                        for="radio-switch-35"
                                        >Bachelor's degree (e.g. Bsc, BS, BA, AB)</label
                                      >
                                    </div>
                                    <div class="form-check pt-3 mt-2 sm:mt-0">
                                      <input
                                        id="radio-switch-36"
                                        class="form-check-input"
                                        type="radio"
                                        v-model="form.decedent_education"
                                        name="decedent_education"
                                        value="Master's degree (e.g. MA, MS, MEng, MEd, MSW, MBA, MSc)"
                                      />
                                      <label
                                        class="form-check-label"
                                        for="radio-switch-36"
                                        >Master's degree (e.g. MA, MS, MEng, MEd, MSW,
                                        MBA, MSc)</label
                                      >
                                    </div>
                                    <div class="form-check pt-3 mt-2 sm:mt-0">
                                      <input
                                        id="radio-switch-37"
                                        class="form-check-input"
                                        type="radio"
                                        v-model="form.decedent_education"
                                        name="decedent_education"
                                        value="Doctorate (e.g. PhD, EdD) or Professional degree (e.g. MD, DDS, DVM, LLB, JD)"
                                      />
                                      <label
                                        class="form-check-label"
                                        for="radio-switch-37"
                                        >Doctorate (e.g. PhD, EdD) or Professional degree
                                        (e.g. MD, DDS, DVM, LLB, JD)</label
                                      >
                                    </div>
                                  </div>
                                  <div
                                    class="text-danger font-medium text-xs mt-1"
                                    v-if="errors.decedent_education"
                                  >
                                    {{ errors.decedent_education[0] }}
                                  </div>
                                </div>
                              </td>
                              <td colspan="2" class="whitespace-nowrap">
                                <div class="w-full">
                                  <label class="form-label"
                                    >Decedent of Hispanic Origin?</label
                                  >
                                  <div class="mt-2">
                                    <div class="form-check mt-2">
                                      <input
                                        id="radio-switch-38"
                                        class="form-check-input"
                                        type="radio"
                                        v-model="form.decedent_origin"
                                        name="decedent_origin"
                                        value="No, not Spanish/Hispanic/Latino"
                                      />
                                      <label
                                        class="form-check-label"
                                        for="radio-switch-38"
                                        >No, not Spanish/Hispanic/Latino</label
                                      >
                                    </div>
                                    <div class="form-check mr-2 pt-3 sm:mt-0">
                                      <input
                                        id="radio-switch-39"
                                        class="form-check-input"
                                        type="radio"
                                        v-model="form.decedent_origin"
                                        name="decedent_origin"
                                        value="Yes, Nigerian"
                                      />
                                      <label
                                        class="form-check-label"
                                        for="radio-switch-39"
                                        >Yes, Nigerian</label
                                      >
                                    </div>
                                    <div class="form-check pt-3 sm:mt-0">
                                      <input
                                        id="radio-switch-40"
                                        class="form-check-input"
                                        type="radio"
                                        v-model="form.decedent_origin"
                                        name="decedent_origin"
                                        value="Yes, Mexican, Mexican American, Chicano"
                                      />
                                      <label
                                        class="form-check-label"
                                        for="radio-switch-40"
                                        >Yes, Mexican, Mexican American, Chicano</label
                                      >
                                    </div>
                                    <div class="form-check pt-3 mt-2 sm:mt-0">
                                      <input
                                        id="radio-switch-41"
                                        class="form-check-input"
                                        type="radio"
                                        v-model="form.decedent_origin"
                                        name="decedent_origin"
                                        value="Yes, Puerto Rican"
                                      />
                                      <label
                                        class="form-check-label"
                                        for="radio-switch-41"
                                        >Yes, Puerto Rican</label
                                      >
                                    </div>
                                    <div class="form-check pt-3 mt-2 sm:mt-0">
                                      <input
                                        id="radio-switch-42"
                                        class="form-check-input"
                                        type="radio"
                                        v-model="form.decedent_origin"
                                        name="decedent_origin"
                                        value="Yes, Cuban"
                                      />
                                      <label
                                        class="form-check-label"
                                        for="radio-switch-42"
                                        >Yes, Cuban</label
                                      >
                                    </div>
                                    <div class="form-check pt-3 mt-2 sm:mt-0">
                                      <input
                                        id="radio-switch-43"
                                        class="form-check-input"
                                        type="radio"
                                        v-model="form.decedent_origin"
                                        name="decedent_origin"
                                        value="Yes, other Spanish/Hispanic/Latino"
                                      />
                                      <label
                                        class="form-check-label"
                                        for="radio-switch-43"
                                        >Yes, other Spanish/Hispanic/Latino</label
                                      >
                                    </div>
                                  </div>
                                  <div
                                    class="text-danger font-medium text-xs mt-1"
                                    v-if="errors.decedent_origin"
                                  >
                                    {{ errors.decedent_origin[0] }}
                                  </div>
                                </div>
                              </td>
                              <td class="whitespace-nowrap">
                                <div class="w-full">
                                  <label class="form-label">Decedent Race</label>
                                  <div class="mt-2">
                                    <div class="form-check pt-3 mt-2 sm:mt-0">
                                      <input
                                        id="radio-switch-52"
                                        class="form-check-input"
                                        type="radio"
                                        v-model="form.decedent_race"
                                        name="decedent_race"
                                        value="African"
                                      />
                                      <label
                                        class="form-check-label"
                                        for="radio-switch-52"
                                        >African</label
                                      >
                                    </div>
                                    <div class="form-check mt-2">
                                      <input
                                        id="radio-switch-44"
                                        class="form-check-input"
                                        type="radio"
                                        v-model="form.decedent_race"
                                        name="decedent_race"
                                        value="White"
                                      />
                                      <label
                                        class="form-check-label"
                                        for="radio-switch-44"
                                        >White</label
                                      >
                                    </div>
                                    <div class="form-check mr-2 pt-3 sm:mt-0">
                                      <input
                                        id="radio-switch-45"
                                        class="form-check-input"
                                        type="radio"
                                        v-model="form.decedent_race"
                                        name="decedent_race"
                                        value="Black or African American"
                                      />
                                      <label
                                        class="form-check-label"
                                        for="radio-switch-45"
                                        >Black or African American</label
                                      >
                                    </div>
                                    <div class="form-check pt-3 sm:mt-0">
                                      <input
                                        id="radio-switch-46"
                                        class="form-check-input"
                                        type="radio"
                                        v-model="form.decedent_race"
                                        name="decedent_race"
                                        value="American Indian or Alaska Native"
                                      />
                                      <label
                                        class="form-check-label"
                                        for="radio-switch-46"
                                        >American Indian or Alaska Native</label
                                      >
                                    </div>
                                    <div class="form-check pt-3 mt-2 sm:mt-0">
                                      <input
                                        id="radio-switch-47"
                                        class="form-check-input"
                                        type="radio"
                                        v-model="form.decedent_race"
                                        name="decedent_race"
                                        value="Asian Indian"
                                      />
                                      <label
                                        class="form-check-label"
                                        for="radio-switch-47"
                                        >Asian Indian</label
                                      >
                                    </div>
                                    <div class="form-check pt-3 mt-2 sm:mt-0">
                                      <input
                                        id="radio-switch-48"
                                        class="form-check-input"
                                        type="radio"
                                        v-model="form.decedent_race"
                                        name="decedent_race"
                                        value="Chinese"
                                      />
                                      <label
                                        class="form-check-label"
                                        for="radio-switch-48"
                                        >Chinese</label
                                      >
                                    </div>
                                    <div class="form-check pt-3 mt-2 sm:mt-0">
                                      <input
                                        id="radio-switch-49"
                                        class="form-check-input"
                                        type="radio"
                                        v-model="form.decedent_race"
                                        name="decedent_race"
                                        value="Filipino"
                                      />
                                      <label
                                        class="form-check-label"
                                        for="radio-switch-49"
                                        >Filipino</label
                                      >
                                    </div>
                                    <div class="form-check pt-3 mt-2 sm:mt-0">
                                      <input
                                        id="radio-switch-50"
                                        class="form-check-input"
                                        type="radio"
                                        v-model="form.decedent_race"
                                        name="decedent_race"
                                        value="Japanese"
                                      />
                                      <label
                                        class="form-check-label"
                                        for="radio-switch-50"
                                        >Japanese</label
                                      >
                                    </div>
                                    <div class="form-check pt-3 mt-2 sm:mt-0">
                                      <input
                                        id="radio-switch-51"
                                        class="form-check-input"
                                        type="radio"
                                        v-model="form.decedent_race"
                                        name="decedent_race"
                                        value="Korean"
                                      />
                                      <label
                                        class="form-check-label"
                                        for="radio-switch-51"
                                        >Korean</label
                                      >
                                    </div>
                                    <div class="form-check pt-3 mt-2 sm:mt-0">
                                      <input
                                        id="radio-switch-53"
                                        class="form-check-input"
                                        type="radio"
                                        v-model="form.decedent_race"
                                        name="decedent_race"
                                        value="Vietnamese"
                                      />
                                      <label
                                        class="form-check-label"
                                        for="radio-switch-53"
                                        >Vietnamese</label
                                      >
                                    </div>
                                    <div class="form-check pt-3 mt-2 sm:mt-0">
                                      <input
                                        id="radio-switch-54"
                                        class="form-check-input"
                                        type="radio"
                                        v-model="form.decedent_race"
                                        name="decedent_race"
                                        value="Native Hawaiian"
                                      />
                                      <label
                                        class="form-check-label"
                                        for="radio-switch-54"
                                        >Native Hawaiian</label
                                      >
                                    </div>
                                  </div>
                                  <div
                                    class="text-danger font-medium text-xs mt-1"
                                    v-if="errors.decedent_race"
                                  >
                                    {{ errors.decedent_race[0] }}
                                  </div>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td colspan="2">
                                <label for="decedent_occupation" class="form-label"
                                  >Decedent Occupation</label
                                >
                                <input
                                  id="decedent_occupation"
                                  type="text"
                                  class="form-control"
                                  v-model="form.decedent_occupation"
                                />
                                <div
                                  class="text-danger font-medium text-xs mt-1"
                                  v-if="errors.decedent_occupation"
                                >
                                  {{ errors.decedent_occupation[0] }}
                                </div>
                              </td>
                              <td colspan="2">
                                <label
                                  for="kind_of_business_or_industry"
                                  class="form-label"
                                  >Kind of Business/Industry</label
                                >
                                <input
                                  id="kind_of_business_or_industry"
                                  type="text"
                                  class="form-control"
                                  v-model="form.kind_of_business_or_industry"
                                />
                                <div
                                  class="text-danger font-medium text-xs mt-1"
                                  v-if="errors.kind_of_business_or_industry"
                                >
                                  {{ errors.kind_of_business_or_industry[0] }}
                                </div>
                              </td>
                            </tr>
                          </table>
                        </div>
                      </div>
                      <input
                        type="submit"
                        value="Submit"
                        class="btn btn-primary btn-sm mt-2"
                      />
                      <loading v-if="loading == true"></loading>
                    </form>
                  </div>
                  <div class="col-span-12 xl:col-span-12 mt-5">
                    <h2 class="font-medium text-xl underline font-bold">
                      MEDICAL CERTIFIER INSTRUCTIONS for selected items on Nigeria
                      Standard Certificate of Death
                    </h2>
                    <h3 class="text-lg mt-3 font-bold">ITEMS ON WHEN DEATH OCCURRED</h3>
                    <p class="mt-1">
                      If the facility uses a separate pronouncer or other person to
                      indicate that death has taken place with another person more
                      familiar with the case completing the remainder of the medical
                      portion of the death certificate, the pronouncer completes it.
                    </p>
                    <h3 class="text-lg mt-3 font-bold">CAUSE OF DEATH</h3>
                    <p class="mt-1">Part I (Chain of events leading directly to death)</p>
                    <ul class="list-disc">
                      <li>
                        Only one cause should be entered on each line. Line (a) MUST
                        ALWAYS have an entry. DO NOT leave blank. Additional lines may be
                        added if necessary.
                      </li>
                      <li>
                        If the condition on Line (a) resulted from an underlying
                        condition, put the underlying condition on Line (b), and so on,
                        until the full sequence isreported. ALWAYS enter the underlying
                        cause of death on the lowest used line in Part I.
                      </li>
                      <li>
                        For each cause indicate the best estimate of the interval between
                        the presumed onset and the date of death. The terms “unknown” or
                        "approximately" may be used. General terms, such as minutes,
                        hours, or days, are acceptable, if necessary. DO NOT leave blank.
                      </li>
                      <li>
                        The terminal event (for example, cardiac arrest or respiratory
                        arrest) should not be used. If a mechanism of death seems most
                        appropriate toyou for line (a), then you must always list its
                        cause(s) on the line(s) below it (for example, cardiac arrest due
                        to coronary artery atherosclerosis or cardiac arrest due to blunt
                        impact to chest).
                      </li>
                      <li>
                        If an organ system failure such as congestive heart failure,
                        hepatic failure, renal failure, or respiratory failure is listed
                        as a cause of death, always report its etiology on the line(s)
                        beneath it (for example, renal failure due to Type I diabetes
                        mellitus).
                      </li>
                      <li>
                        When indicating neoplasms as a cause of death, include the
                        following: 1) primary site or that the primary site is unknown, 2)
                        benign or malignant, 3) cell type or that the cell type is
                        unknown, 4) grade of neoplasm, and 5) part or lobe of organ
                        affected. (For example, a primary well-differentiated squamous
                        cell carcinoma, lung, left upper lobe.)
                      </li>
                      <li>
                        Always report the fatal injury (for example, stab wound of chest),
                        the trauma (for example, transection of subclavian vein), and
                        impairment of function (for example, air embolism).
                      </li>
                    </ul>
                    <h3 class="text-lg mt-3 font-bold">
                      PART II (Other significant conditions)
                    </h3>
                    <ul class="list-disc">
                      <li>
                        Enter all diseases or conditions contributing to death that were
                        not reported in the chain of events in Part I and that did not
                        result in the underlying cause of death. See attached examples.
                      </li>
                      <li>
                        If two or more possible sequences resulted in death, or if two
                        conditions seem to have added together, report in Part I the one
                        that, in your opinion, most directly caused death. Report in Part
                        II the other conditions or diseases.
                      </li>
                    </ul>
                    <h3 class="text-lg mt-3 font-bold">CHANGES TO CAUSE DEATH</h3>
                    <p class="mt-1">
                      Should additional medical information or autopsy findings become
                      available that would change the cause of death originally reported,
                      the original death certificate should be amended by the certifying
                      physician by immediately reporting the revised cause of death to the
                      State Vital Records Office.
                    </p>
                    <h3 class="text-lg mt-3 font-bold">AUTOPSY</h3>
                    <ul class="list-disc">
                      <li>
                        Enter "Yes" if either a partial or full autopsy was performed.
                        Otherwise enter "No."
                      </li>
                      <li>
                        Enter "Yes" if autopsy findings were available to complete the
                        cause of death; otherwise enter "No". Leave item blank if no
                        autopsy was performed.
                      </li>
                    </ul>
                    <h3 class="text-lg mt-3 font-bold">
                      DID TOBACCO USE CONTRIBUTE TO DEATH?
                    </h3>
                    <p class="mt-1">
                      Check "yes" if, in your opinion, the use of tobacco contributed to
                      death. Tobacco use may contribute to deaths due to a wide variety of
                      diseases; for example, tobacco use contributes to many deaths due to
                      emphysema or lung cancer and some heart disease and cancers of the
                      head and neck. Check “no” if, in your clinical judgment, tobacco use
                      did not contribute to this particular death.
                    </p>
                    <h3 class="text-lg mt-3 font-bold">
                      IF FEMALE, WAS DECEDENT PREGNANT AT TIME OF DEATH OR WITHIN PAST
                      YEAR?
                    </h3>
                    <p class="mt-1">
                      This information is important in determining pregnancy-related
                      mortality.
                    </p>
                    <h3 class="text-lg mt-3 font-bold">MANNER OF DEATH</h3>
                    <ul class="list-disc">
                      <li>
                        Always check Manner of Death, which is important:
                        <ol style="list-style: decimal; margin-left: 20px">
                          <li>in determining accurate causes of death</li>
                          <li>in processing insurance claims</li>
                          <li>in statistical studies of injuries and death</li>
                        </ol>
                      </li>
                      <li>
                        Indicate "Pending investigation" if the manner of death cannot be
                        determined whether due to an accident, suicide, or homicide within
                        the statutory time limit for filing the death certificate. This
                        should be changed later to one of the other terms.
                      </li>
                      <li>
                        Indicate "Could not be Determined" ONLY when it is impossible to
                        determine the manner of death.
                      </li>
                    </ul>
                    <h3 class="text-lg mt-3 font-bold">
                      ACCIDENT OR INJURY – to be filled out in all cases of deaths due to
                      injury or poisoning.
                    </h3>
                    <ul class="list-disc">
                      <li>
                        Enter the exact month, day, and year of injury. Spell out the name
                        of the month. DO NOT use a number for the month. (Remember,
                        thedate of injury may differ from the date of death.) Estimates
                        may be provided with “Approx.” placed before the date.
                      </li>
                      <li>
                        Enter the exact hour and minutes of injury or use your best
                        estimate. Use a 24-hour clock.
                      </li>
                      <li>
                        Enter the general place (such as restaurant, vacant lot, or home)
                        where the injury occurred. DO NOT enter firm or organization
                        names.(For example, enter "factory", not "Standard Manufacturing,
                        Inc."" )
                      </li>
                      <li>
                        Complete if anything other than natural disease is mentioned in
                        Part I or Part II of the medical certification, including
                        homicides, suicides, and accidents. This includes all motor
                        vehicle deaths. The item must be completed for decedents ages 14
                        years or over and may be completed for those less than 14 years of
                        age if warranted. Enter "Yes" if the injury occurred at work.
                        Otherwise enter "No". An injury may occur at work regardless of
                        whether the injury occurred in the course of the decedent’s
                        “usual” occupation. Examples of injury at work and injury not at
                        work follow:
                      </li>
                    </ul>
                    <div class="grid grid-cols-12 gap-x-5">
                      <div class="col-span-12 md:col-span-6">
                        <h4 class="text-md font-bold">Injury at Work</h4>
                        <ul class="list-disc">
                          <li>
                            Injury while working or in vocational training on job premises
                          </li>
                          <li>
                            Injury while on break or at lunch or in parking lot on job
                            premises
                          </li>
                          <li>
                            Injury while working for pay or compensation, including at
                            home
                          </li>
                          <li>
                            Injury while working as a volunteer law enforcement official
                            etc.
                          </li>
                          <li>
                            Injury while traveling on business, including to/from business
                            contacts
                          </li>
                        </ul>
                      </div>
                      <div class="col-span-12 md:col-span-6">
                        <h4 class="text-md font-bold">Injury not at Work</h4>
                        <ul class="list-disc">
                          <li>
                            Injury while engaged in personal recreational activity on job
                            premises
                          </li>
                          <li>
                            Injury while a visitor (not on official work business) to job
                            premises
                          </li>
                          <li>Homemaker working at homemaking activities</li>
                          <li>Student in school</li>
                          <li>
                            Working for self for no profit (mowing yard, repairing own
                            roof, hobby)Commuting to or from work
                          </li>
                        </ul>
                      </div>
                    </div>
                    <ul class="list-disc">
                      <li>
                        Enter the complete address where the injury occurred including zip
                        code.
                      </li>
                      <li>
                        Enter a brief but specific and clear description of how the injury
                        occurred. Explain the circumstances or cause of the injury.
                        Specifytype of gun or type of vehicle (e.g., car, bulldozer,
                        train, etc.) when relevant to circumstances. Indicate if more than
                        one vehicle involved; specify type of vehicle decedent was in.
                      </li>
                      <li>
                        Specify role of decedent (e.g. driver, passenger). Driver/operator
                        and passenger should be designated for modes other than motor
                        vehicles such as bicycles. Other applies to watercraft, aircraft,
                        animal, or people attached to outside of vehicles (e.g. surfers).
                      </li>
                    </ul>
                    <p>
                      <span class="underline">Rationale:</span> Motor vehicle accidents
                      are a major cause of unintentional deaths; details will help
                      determine effectiveness of current safety features and laws.
                    </p>
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
  name: "edit-death-record",
  data() {
    return {
      id: null,
      token: null,
      form: {},
      errors: {},
      loading: false,
    };
  },
  created() {
    this.login();
    this.getDeathRecord();
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

    updateRecord() {
      this.loading = true;
      let slug = this.$route.params.slug;
      axios
        .patch("/api/death-record/" + slug, this.form)
        .then(() => {
          this.$router.push({
            name: "death-records",
          });
          Toast.fire({
            icon: "success",
            title: "Death record successfully updated",
          });
        })
        .catch((error) => (this.errors = error.response.data.errors))
        .finally(() => {
          this.loading = false;
        });
    },

    getDeathRecord() {
      let slug = this.$route.params.slug;
      axios
        .get("/api/v1/death-record/" + slug, {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then((response) => (this.form = response.data))
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

<style scoped>
.form-label {
  text-transform: uppercase;
}
.list-disc {
  list-style: disc;
  margin-left: 25px;
}
.list-disc li {
  margin-bottom: 0.65rem;
}
</style>
