<template>
  <div class="main">
    <!-- BEGIN: Mobile Menu -->
    <patient-mobile-menu></patient-mobile-menu>
    <!-- END: Mobile Menu -->
    <div class="flex">
      <!-- BEGIN: Side Menu -->
      <patient-side-menu page="hospital-visits"></patient-side-menu>
      <!-- END: Side Menu -->
      <!-- BEGIN: Content -->
      <div class="content">
        <!-- BEGIN: Top Bar -->
        <patient-top-bar title="Patient Satisfactory Survey"></patient-top-bar>
        <!-- END: Top Bar -->

        <div class="grid grid-cols-12 gap-6 mt-4">
          <div class="intro-y col-span-12 xxl:col-span-12">
            <div class="intro-y box">
              <div
                class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60"
              >
                <h2 class="font-medium text-base mr-auto">
                  {{ patient.name }} Satisfactory Survey for
                  {{ data.consultation_details.registered_facility_name }}
                </h2>
                <div class="w-full sm:w-auto sm:ml-auto mt-3 sm:mt-0"></div>
              </div>
              <div class="p-5">
                <form @submit.prevent="store">
                  <div class="grid grid-cols-12 gap-x-5" :disabled="loading">
                    <div class="col-span-12 xl:col-span-12">
                      <p>
                        Please, fill this form and click submit below. Your information is
                        help us improve our services at
                        {{ data.consultation_details.registered_facility_name }}. If you
                        require for a response to a specific concern please email us at
                        <strong>{{ data.consultation_details.uemail }}</strong
                        >. Thank you for helping us serve you better
                      </p>
                    </div>
                    <div class="col-span-12 xl:col-span-12 mt-2">
                      <label for="experience" class="form-label"
                        >What can we do to improve your experience?</label
                      >
                      <textarea
                        id="experience"
                        rows="4"
                        type="text"
                        class="form-control"
                        v-model="form.experience"
                      ></textarea>
                      <div
                        class="text-danger font-medium text-xs mt-1"
                        v-if="errors.experience"
                      >
                        {{ errors.experience[0] }}
                      </div>
                    </div>
                    <div class="col-span-12 xl:col-span-12 mt-2">
                      <label for="why_choose_us" class="form-label"
                        >Why choose
                        {{ data.consultation_details.registered_facility_name }}?</label
                      >
                      <div class="flex flex-col md:flex-row mt-2">
                        <div class="form-check mr-5">
                          <input
                            id="gp_recommendation"
                            class="form-check-input"
                            type="radio"
                            v-model="form.why_choose_us"
                            name="why_choose_us"
                            value="GP's recommendation"
                          />
                          <label class="form-check-label" for="gp_recommendation"
                            >GP's recommendation</label
                          >
                        </div>
                        <div class="form-check mr-5 mt-2 sm:mt-0">
                          <input
                            id="s_recommendation"
                            class="form-check-input"
                            type="radio"
                            name="why_choose_us"
                            v-model="form.why_choose_us"
                            value="Specialist's recommendation"
                          />
                          <label class="form-check-label" for="s_recommendation"
                            >Specialist's recommendation</label
                          >
                        </div>
                        <div class="form-check mr-5 mt-2 sm:mt-0">
                          <input
                            id="reputation"
                            class="form-check-input"
                            type="radio"
                            name="why_choose_us"
                            v-model="form.why_choose_us"
                            value="Reputation of hospital"
                          />
                          <label class="form-check-label" for="reputation"
                            >Reputation of hospital</label
                          >
                        </div>
                        <div class="form-check mr-5 mt-2 sm:mt-0">
                          <input
                            id="location"
                            class="form-check-input"
                            type="radio"
                            name="why_choose_us"
                            v-model="form.why_choose_us"
                            value="Location"
                          />
                          <label class="form-check-label" for="location">Location</label>
                        </div>
                        <div class="form-check mr-2 mt-2 sm:mt-0">
                          <input
                            id="f_recommendation"
                            class="form-check-input"
                            type="radio"
                            name="why_choose_us"
                            v-model="form.why_choose_us"
                            value="Friends or relative recommendation"
                          />
                          <label class="form-check-label" for="f_recommendation"
                            >Friends or relative recommendation</label
                          >
                        </div>
                      </div>
                      <div class="flex flex-col md:flex-row mt-2">
                        <div class="form-check mr-5 mt-2 sm:mt-0">
                          <input
                            id="requirement"
                            class="form-check-input"
                            type="radio"
                            name="why_choose_us"
                            v-model="form.why_choose_us"
                            value="Insurance requirement"
                          />
                          <label class="form-check-label" for="requirement"
                            >Insurance requirement</label
                          >
                        </div>
                        <div class="form-check mr-5 mt-2 sm:mt-0">
                          <input
                            id="p_experience"
                            class="form-check-input"
                            type="radio"
                            name="why_choose_us"
                            v-model="form.why_choose_us"
                            value="Previous experience"
                          />
                          <label class="form-check-label" for="p_experience"
                            >Previous experience</label
                          >
                        </div>
                        <div class="form-check mr-5 mt-2 sm:mt-0">
                          <input
                            id="other"
                            class="form-check-input"
                            type="radio"
                            name="why_choose_us"
                            v-model="form.why_choose_us"
                            value="Other"
                          />
                          <label class="form-check-label" for="other">Other</label>
                        </div>
                        <div class="mt-2" v-if="form.why_choose_us == 'Other'">
                          <input
                            id="why_choose_us"
                            type="text"
                            class="form-control"
                            placeholder="Input other reason"
                            v-model="form.other"
                          />
                        </div>
                      </div>
                      <div
                        class="text-danger font-medium text-xs mt-1"
                        v-if="errors.why_choose_us"
                      >
                        {{ errors.why_choose_us[0] }}
                      </div>
                    </div>
                    <div class="col-span-12 xl:col-span-12 mt-3">
                      <label class="form-label" for="first_time"
                        >Was this your first time at  {{ data.consultation_details.registered_facility_name }}?</label
                      >
                      <div class="flex flex-col sm:flex-row mt-2">
                        <div class="form-check mr-2">
                          <input
                            id="yes"
                            class="form-check-input"
                            type="radio"
                            v-model="form.first_time"
                            name="first_time"
                            value="Yes"
                          />
                          <label class="form-check-label" for="yes">Yes</label>
                        </div>
                        <div class="form-check mr-2 mt-2 sm:mt-0">
                          <input
                            id="fahrenheit"
                            class="form-check-input"
                            type="radio"
                            name="first_time"
                            v-model="form.first_time"
                            value="No"
                          />
                          <label class="form-check-label" for="no">No</label>
                        </div>
                      </div>
                      <div
                        class="text-danger font-medium text-xs mt-1"
                        v-if="errors.first_time"
                      >
                        {{ errors.first_time[0] }}
                      </div>
                    </div>
                    <div class="col-span-12 border-t py-4 mt-4">
                      <h4 class="font-medium text-lg">Please Tell Us</h4>
                    </div>
                    <div class="col-span-12 xl:col-span-6">
                      <label for="impressed" class="form-label"
                        >What impressed you most?</label
                      >
                      <input
                        id="impressed"
                        type="text"
                        class="form-control"
                        placeholder="Provide what impressed you most"
                        v-model="form.impressed"
                      />
                      <div
                        class="text-danger font-medium text-xs mt-1"
                        v-if="errors.impressed"
                      >
                        {{ errors.impressed[0] }}
                      </div>
                    </div>
                    <div class="col-span-12 xl:col-span-6">
                      <label for="exceptional_staff" class="form-label"
                        >Any exceptional staff member?</label
                      >
                      <input
                        id="exceptional_staff"
                        type="text"
                        class="form-control"
                        placeholder="Provide the name of an exceptional staff in the hospital"
                        v-model="form.exceptional_staff"
                      />
                      <div
                        class="text-danger font-medium text-xs mt-1"
                        v-if="errors.exceptional_staff"
                      >
                        {{ errors.exceptional_staff[0] }}
                      </div>
                    </div>
                    <div class="col-span-12 xl:col-span-4 mt-3 border-t py-4 mt-4">
                      <img
                        alt="Facility Logo"
                        class="img-size"
                        :src="'../../' + data.consultation_details.logo"
                      />
                      <table class="table text-xs">
                        <tbody>
                          <tr>
                            <td>Address:</td>
                            <td>
                              {{
                                data.consultation_details.physical_location +
                                ", " +
                                data.consultation_details.postal_code +
                                ", " +
                                data.consultation_details.state
                              }}
                            </td>
                          </tr>
                          <tr>
                            <td>Phone Number:</td>
                            <td>{{ data.consultation_details.phone_number }}</td>
                          </tr>
                          <tr>
                            <td>Website:</td>
                            <td>{{ data.consultation_details.website }}</td>
                          </tr>
                        </tbody>
                      </table>
                      <figure class="mt-3 flex flex-row">
                        <img
                          alt="Facility Logo"
                          class="img-size mr-3"
                          :src="'../../' + data.consultation_details.ownership_picture"
                        />
                        <figcaption>
                          <p>{{ data.consultation_details.name }}</p>
                          <small>
                            {{
                              data.consultation_details.role +
                              " at " +
                              data.consultation_details.registered_facility_name
                            }}</small
                          >
                        </figcaption>
                      </figure>
                    </div>
                    <div class="col-span-12 xl:col-span-8 border-t py-4 mt-4">
                      <h5 class="font-medium text-md">
                        What is unique about
                        {{ data.consultation_details.registered_facility_name }}
                      </h5>
                      <div v-html="data.consultation_details.facility_uniqueness"></div>
                    </div>
                    <div class="col-span-12 xl:col-span-12 border-t py-4 mt-4">
                      <h4 class="font-medium text-lg">Overall Rating</h4>
                      <p class="text-md">What is your overall opinion of:</p>
                      <table class="table">
                        <thead>
                          <tr>
                            <th></th>
                            <th>Excellent</th>
                            <th>Good</th>
                            <th>Fair</th>
                            <th>Poor</th>
                            <th>Very poor</th>
                            <th>Does not apply</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>
                              <label for="hospital_name" class="form-label">
                                {{
                                  data.consultation_details.registered_facility_name
                                }}</label
                              >
                            </td>
                            <td>
                              <div class="form-check sm:mt-0">
                                <input
                                  class="form-check-input"
                                  type="radio"
                                  name="hospital_name"
                                  v-model="form.hospital_name"
                                  value="Excellent"
                                />
                              </div>
                            </td>
                            <td>
                              <div class="form-check sm:mt-0">
                                <input
                                  class="form-check-input"
                                  type="radio"
                                  name="hospital_name"
                                  v-model="form.hospital_name"
                                  value="Good"
                                />
                              </div>
                            </td>
                            <td>
                              <div class="form-check sm:mt-0">
                                <input
                                  class="form-check-input"
                                  type="radio"
                                  name="hospital_name"
                                  v-model="form.hospital_name"
                                  value="Fair"
                                />
                              </div>
                            </td>
                            <td>
                              <div class="form-check sm:mt-0">
                                <input
                                  class="form-check-input"
                                  type="radio"
                                  name="hospital_name"
                                  v-model="form.hospital_name"
                                  value="Poor"
                                />
                              </div>
                            </td>
                            <td>
                              <div class="form-check sm:mt-0">
                                <input
                                  class="form-check-input"
                                  type="radio"
                                  name="hospital_name"
                                  v-model="form.hospital_name"
                                  value="Very Poor"
                                />
                              </div>
                            </td>
                            <td>
                              <div class="form-check sm:mt-0">
                                <input
                                  class="form-check-input"
                                  type="radio"
                                  name="hospital_name"
                                  v-model="form.hospital_name"
                                  value="Does not apply"
                                />
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <label for="hospital_name" class="form-label">
                                Nursing care</label
                              >
                            </td>
                            <td>
                              <div class="form-check sm:mt-0">
                                <input
                                  class="form-check-input"
                                  type="radio"
                                  name="nursing_care"
                                  v-model="form.nursing_care"
                                  value="Excellent"
                                />
                              </div>
                            </td>
                            <td>
                              <div class="form-check sm:mt-0">
                                <input
                                  class="form-check-input"
                                  type="radio"
                                  name="nursing_care"
                                  v-model="form.nursing_care"
                                  value="Good"
                                />
                              </div>
                            </td>
                            <td>
                              <div class="form-check sm:mt-0">
                                <input
                                  class="form-check-input"
                                  type="radio"
                                  name="nursing_care"
                                  v-model="form.nursing_care"
                                  value="Fair"
                                />
                              </div>
                            </td>
                            <td>
                              <div class="form-check sm:mt-0">
                                <input
                                  class="form-check-input"
                                  type="radio"
                                  name="nursing_care"
                                  v-model="form.nursing_care"
                                  value="Poor"
                                />
                              </div>
                            </td>
                            <td>
                              <div class="form-check sm:mt-0">
                                <input
                                  class="form-check-input"
                                  type="radio"
                                  name="nursing_care"
                                  v-model="form.nursing_care"
                                  value="Very Poor"
                                />
                              </div>
                            </td>
                            <td>
                              <div class="form-check sm:mt-0">
                                <input
                                  class="form-check-input"
                                  type="radio"
                                  name="nursing_care"
                                  v-model="form.nursing_care"
                                  value="Does not apply"
                                />
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <label for="hospital_name" class="form-label">
                                Medical Officer/Doctor care</label
                              >
                            </td>
                            <td>
                              <div class="form-check sm:mt-0">
                                <input
                                  class="form-check-input"
                                  type="radio"
                                  name="medical_officer_care"
                                  v-model="form.medical_officer_care"
                                  value="Excellent"
                                />
                              </div>
                            </td>
                            <td>
                              <div class="form-check sm:mt-0">
                                <input
                                  class="form-check-input"
                                  type="radio"
                                  name="medical_officer_care"
                                  v-model="form.medical_officer_care"
                                  value="Good"
                                />
                              </div>
                            </td>
                            <td>
                              <div class="form-check sm:mt-0">
                                <input
                                  class="form-check-input"
                                  type="radio"
                                  name="medical_officer_care"
                                  v-model="form.medical_officer_care"
                                  value="Fair"
                                />
                              </div>
                            </td>
                            <td>
                              <div class="form-check sm:mt-0">
                                <input
                                  class="form-check-input"
                                  type="radio"
                                  name="medical_officer_care"
                                  v-model="form.medical_officer_care"
                                  value="Poor"
                                />
                              </div>
                            </td>
                            <td>
                              <div class="form-check sm:mt-0">
                                <input
                                  class="form-check-input"
                                  type="radio"
                                  name="medical_officer_care"
                                  v-model="form.medical_officer_care"
                                  value="Very Poor"
                                />
                              </div>
                            </td>
                            <td>
                              <div class="form-check sm:mt-0">
                                <input
                                  class="form-check-input"
                                  type="radio"
                                  name="medical_officer_care"
                                  v-model="form.medical_officer_care"
                                  value="Does not apply"
                                />
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <label for="clerical_staff" class="form-label">
                                Clerical/Receptionist
                              </label>
                            </td>
                            <td>
                              <div class="form-check sm:mt-0">
                                <input
                                  class="form-check-input"
                                  type="radio"
                                  name="clerical_staff"
                                  v-model="form.clerical_staff"
                                  value="Excellent"
                                />
                              </div>
                            </td>
                            <td>
                              <div class="form-check sm:mt-0">
                                <input
                                  class="form-check-input"
                                  type="radio"
                                  name="clerical_staff"
                                  v-model="form.clerical_staff"
                                  value="Good"
                                />
                              </div>
                            </td>
                            <td>
                              <div class="form-check sm:mt-0">
                                <input
                                  class="form-check-input"
                                  type="radio"
                                  name="clerical_staff"
                                  v-model="form.clerical_staff"
                                  value="Fair"
                                />
                              </div>
                            </td>
                            <td>
                              <div class="form-check sm:mt-0">
                                <input
                                  class="form-check-input"
                                  type="radio"
                                  name="clerical_staff"
                                  v-model="form.clerical_staff"
                                  value="Poor"
                                />
                              </div>
                            </td>
                            <td>
                              <div class="form-check sm:mt-0">
                                <input
                                  class="form-check-input"
                                  type="radio"
                                  name="clerical_staff"
                                  v-model="form.clerical_staff"
                                  value="Very Poor"
                                />
                              </div>
                            </td>
                            <td>
                              <div class="form-check sm:mt-0">
                                <input
                                  class="form-check-input"
                                  type="radio"
                                  name="clerical_staff"
                                  v-model="form.clerical_staff"
                                  value="Does not apply"
                                />
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <label for="food_services" class="form-label">
                                Food services</label
                              >
                            </td>
                            <td>
                              <div class="form-check sm:mt-0">
                                <input
                                  class="form-check-input"
                                  type="radio"
                                  name="food_services"
                                  v-model="form.food_services"
                                  value="Excellent"
                                />
                              </div>
                            </td>
                            <td>
                              <div class="form-check sm:mt-0">
                                <input
                                  class="form-check-input"
                                  type="radio"
                                  name="food_services"
                                  v-model="form.food_services"
                                  value="Good"
                                />
                              </div>
                            </td>
                            <td>
                              <div class="form-check sm:mt-0">
                                <input
                                  class="form-check-input"
                                  type="radio"
                                  name="food_services"
                                  v-model="form.food_services"
                                  value="Fair"
                                />
                              </div>
                            </td>
                            <td>
                              <div class="form-check sm:mt-0">
                                <input
                                  class="form-check-input"
                                  type="radio"
                                  name="food_services"
                                  v-model="form.food_services"
                                  value="Poor"
                                />
                              </div>
                            </td>
                            <td>
                              <div class="form-check sm:mt-0">
                                <input
                                  class="form-check-input"
                                  type="radio"
                                  name="food_services"
                                  v-model="form.food_services"
                                  value="Very Poor"
                                />
                              </div>
                            </td>
                            <td>
                              <div class="form-check sm:mt-0">
                                <input
                                  class="form-check-input"
                                  type="radio"
                                  name="food_services"
                                  v-model="form.food_services"
                                  value="Does not apply"
                                />
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <label for="cleanliness" class="form-label">
                                Cleanliness</label
                              >
                            </td>
                            <td>
                              <div class="form-check sm:mt-0">
                                <input
                                  class="form-check-input"
                                  type="radio"
                                  name="cleanliness"
                                  v-model="form.cleanliness"
                                  value="Excellent"
                                />
                              </div>
                            </td>
                            <td>
                              <div class="form-check sm:mt-0">
                                <input
                                  class="form-check-input"
                                  type="radio"
                                  name="cleanliness"
                                  v-model="form.cleanliness"
                                  value="Good"
                                />
                              </div>
                            </td>
                            <td>
                              <div class="form-check sm:mt-0">
                                <input
                                  class="form-check-input"
                                  type="radio"
                                  name="cleanliness"
                                  v-model="form.cleanliness"
                                  value="Fair"
                                />
                              </div>
                            </td>
                            <td>
                              <div class="form-check sm:mt-0">
                                <input
                                  class="form-check-input"
                                  type="radio"
                                  name="cleanliness"
                                  v-model="form.cleanliness"
                                  value="Poor"
                                />
                              </div>
                            </td>
                            <td>
                              <div class="form-check sm:mt-0">
                                <input
                                  class="form-check-input"
                                  type="radio"
                                  name="cleanliness"
                                  v-model="form.cleanliness"
                                  value="Very Poor"
                                />
                              </div>
                            </td>
                            <td>
                              <div class="form-check sm:mt-0">
                                <input
                                  class="form-check-input"
                                  type="radio"
                                  name="cleanliness"
                                  v-model="form.cleanliness"
                                  value="Does not apply"
                                />
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <label for="staff_courtesy" class="form-label">
                                Staff courtesy</label
                              >
                            </td>
                            <td>
                              <div class="form-check sm:mt-0">
                                <input
                                  class="form-check-input"
                                  type="radio"
                                  name="staff_courtesy"
                                  v-model="form.staff_courtesy"
                                  value="Excellent"
                                />
                              </div>
                            </td>
                            <td>
                              <div class="form-check sm:mt-0">
                                <input
                                  class="form-check-input"
                                  type="radio"
                                  name="staff_courtesy"
                                  v-model="form.staff_courtesy"
                                  value="Good"
                                />
                              </div>
                            </td>
                            <td>
                              <div class="form-check sm:mt-0">
                                <input
                                  class="form-check-input"
                                  type="radio"
                                  name="staff_courtesy"
                                  v-model="form.staff_courtesy"
                                  value="Fair"
                                />
                              </div>
                            </td>
                            <td>
                              <div class="form-check sm:mt-0">
                                <input
                                  class="form-check-input"
                                  type="radio"
                                  name="staff_courtesy"
                                  v-model="form.staff_courtesy"
                                  value="Poor"
                                />
                              </div>
                            </td>
                            <td>
                              <div class="form-check sm:mt-0">
                                <input
                                  class="form-check-input"
                                  type="radio"
                                  name="staff_courtesy"
                                  v-model="form.staff_courtesy"
                                  value="Very Poor"
                                />
                              </div>
                            </td>
                            <td>
                              <div class="form-check sm:mt-0">
                                <input
                                  class="form-check-input"
                                  type="radio"
                                  name="staff_courtesy"
                                  v-model="form.staff_courtesy"
                                  value="Does not apply"
                                />
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <label for="discharge_process" class="form-label">
                                Discharge process
                              </label>
                            </td>
                            <td>
                              <div class="form-check sm:mt-0">
                                <input
                                  class="form-check-input"
                                  type="radio"
                                  name="discharge_process"
                                  v-model="form.discharge_process"
                                  value="Excellent"
                                />
                              </div>
                            </td>
                            <td>
                              <div class="form-check sm:mt-0">
                                <input
                                  class="form-check-input"
                                  type="radio"
                                  name="discharge_process"
                                  v-model="form.discharge_process"
                                  value="Good"
                                />
                              </div>
                            </td>
                            <td>
                              <div class="form-check sm:mt-0">
                                <input
                                  class="form-check-input"
                                  type="radio"
                                  name="discharge_process"
                                  v-model="form.discharge_process"
                                  value="Fair"
                                />
                              </div>
                            </td>
                            <td>
                              <div class="form-check sm:mt-0">
                                <input
                                  class="form-check-input"
                                  type="radio"
                                  name="discharge_process"
                                  v-model="form.discharge_process"
                                  value="Poor"
                                />
                              </div>
                            </td>
                            <td>
                              <div class="form-check sm:mt-0">
                                <input
                                  class="form-check-input"
                                  type="radio"
                                  name="discharge_process"
                                  v-model="form.discharge_process"
                                  value="Very Poor"
                                />
                              </div>
                            </td>
                            <td>
                              <div class="form-check sm:mt-0">
                                <input
                                  class="form-check-input"
                                  type="radio"
                                  name="discharge_process"
                                  v-model="form.discharge_process"
                                  value="Does not apply"
                                />
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <label for="facilities_and_accomodation" class="form-label">
                                Facilities &amp; accomodation</label
                              >
                            </td>
                            <td>
                              <div class="form-check sm:mt-0">
                                <input
                                  class="form-check-input"
                                  type="radio"
                                  name="facilities_and_accomodation"
                                  v-model="form.facilities_and_accomodation"
                                  value="Excellent"
                                />
                              </div>
                            </td>
                            <td>
                              <div class="form-check sm:mt-0">
                                <input
                                  class="form-check-input"
                                  type="radio"
                                  name="facilities_and_accomodation"
                                  v-model="form.facilities_and_accomodation"
                                  value="Good"
                                />
                              </div>
                            </td>
                            <td>
                              <div class="form-check sm:mt-0">
                                <input
                                  class="form-check-input"
                                  type="radio"
                                  name="facilities_and_accomodation"
                                  v-model="form.facilities_and_accomodation"
                                  value="Fair"
                                />
                              </div>
                            </td>
                            <td>
                              <div class="form-check sm:mt-0">
                                <input
                                  class="form-check-input"
                                  type="radio"
                                  name="facilities_and_accomodation"
                                  v-model="form.facilities_and_accomodation"
                                  value="Poor"
                                />
                              </div>
                            </td>
                            <td>
                              <div class="form-check sm:mt-0">
                                <input
                                  class="form-check-input"
                                  type="radio"
                                  name="facilities_and_accomodation"
                                  v-model="form.facilities_and_accomodation"
                                  value="Very Poor"
                                />
                              </div>
                            </td>
                            <td>
                              <div class="form-check sm:mt-0">
                                <input
                                  class="form-check-input"
                                  type="radio"
                                  name="facilities_and_accomodation"
                                  v-model="form.facilities_and_accomodation"
                                  value="Does not apply"
                                />
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                      <div
                        class="text-danger font-medium text-xs mt-1"
                        v-if="errors.hospital_name"
                      >
                        {{ errors.hospital_name[0] }}
                      </div>
                    </div>
                    <div class="col-span-12 xl:col-span-12 mt-4">
                      <h4 class="font-medium text-lg">Were you served?</h4>
                      <p class="text-md">
                        What is your opinion about how you were served:
                      </p>
                      <table class="table">
                        <thead>
                          <tr>
                            <th></th>
                            <th>Yes</th>
                            <th>To some extent</th>
                            <th>No</th>
                            <th>Does not apply</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>
                              <label for="special_needs" class="form-label">
                                During your admission were your cultural and/or special
                                needs met?</label
                              >
                            </td>
                            <td>
                              <div class="form-check sm:mt-0">
                                <input
                                  class="form-check-input"
                                  type="radio"
                                  name="special_needs"
                                  v-model="form.special_needs"
                                  value="Yes"
                                />
                              </div>
                            </td>
                            <td>
                              <div class="form-check sm:mt-0">
                                <input
                                  class="form-check-input"
                                  type="radio"
                                  name="special_needs"
                                  v-model="form.special_needs"
                                  value="To some extent"
                                />
                              </div>
                            </td>
                            <td>
                              <div class="form-check sm:mt-0">
                                <input
                                  class="form-check-input"
                                  type="radio"
                                  name="special_needs"
                                  v-model="form.special_needs"
                                  value="No"
                                />
                              </div>
                            </td>
                            <td>
                              <div class="form-check sm:mt-0">
                                <input
                                  class="form-check-input"
                                  type="radio"
                                  name="special_needs"
                                  v-model="form.special_needs"
                                  value="Does not apply"
                                />
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                      <div
                        class="text-danger font-medium text-xs mt-1"
                        v-if="errors.special_needs"
                      >
                        {{ errors.special_needs[0] }}
                      </div>
                    </div>
                    <div class="col-span-12 xl:col-span-12 mt-4">
                      <h4 class="font-medium text-lg">
                        Do you like
                        {{ data.consultation_details.registered_facility_name }} ?
                      </h4>
                      <p class="text-md">
                        Please select from extremely likely of 10 to to not likely of 0
                      </p>
                      <table class="table">
                        <tr>
                          <th></th>
                          <th>Extremely Likely</th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th>Not Likely</th>
                        </tr>
                        <tr>
                          <td>
                            <label for="return_for_medical_care" class="form-label">
                              How likely are you to return to
                              {{ data.consultation_details.registered_facility_name }} for
                              your medical care?</label
                            >
                          </td>
                          <td>
                            <div class="form-check sm:mt-0">
                              <input
                                class="form-check-input"
                                type="radio"
                                name="return_for_medical_care"
                                v-model="form.return_for_medical_care"
                                value="10"
                                id="10"
                              />
                              <label class="form-check-label block" for="10">10</label>
                            </div>
                          </td>
                          <td>
                            <div class="form-check sm:mt-0">
                              <input
                                class="form-check-input"
                                type="radio"
                                name="return_for_medical_care"
                                v-model="form.return_for_medical_care"
                                value="9"
                                id="9"
                              />
                              <label class="form-check-label" for="9">9</label>
                            </div>
                          </td>
                          <td>
                            <div class="form-check sm:mt-0">
                              <input
                                class="form-check-input"
                                type="radio"
                                name="return_for_medical_care"
                                v-model="form.return_for_medical_care"
                                value="8"
                                id="8"
                              />
                              <label class="form-check-label" for="8">8</label>
                            </div>
                          </td>
                          <td>
                            <div class="form-check sm:mt-0">
                              <input
                                class="form-check-input"
                                type="radio"
                                name="return_for_medical_care"
                                v-model="form.return_for_medical_care"
                                value="7"
                                id="7"
                              />
                              <label class="form-check-label" for="7">7</label>
                            </div>
                          </td>
                          <td>
                            <div class="form-check sm:mt-0">
                              <input
                                class="form-check-input"
                                type="radio"
                                name="return_for_medical_care"
                                v-model="form.return_for_medical_care"
                                value="6"
                                id="6"
                              />
                              <label class="form-check-label" for="6">6</label>
                            </div>
                          </td>
                          <td>
                            <div class="form-check sm:mt-0">
                              <input
                                class="form-check-input"
                                type="radio"
                                name="return_for_medical_care"
                                v-model="form.return_for_medical_care"
                                value="5"
                                id="5"
                              />
                              <label class="form-check-label block" for="5">5</label>
                            </div>
                          </td>
                          <td>
                            <div class="form-check sm:mt-0">
                              <input
                                class="form-check-input"
                                type="radio"
                                name="return_for_medical_care"
                                v-model="form.return_for_medical_care"
                                value="4"
                                id="4"
                              />
                              <label class="form-check-label" for="4">4</label>
                            </div>
                          </td>
                          <td>
                            <div class="form-check sm:mt-0">
                              <input
                                class="form-check-input"
                                type="radio"
                                name="return_for_medical_care"
                                v-model="form.return_for_medical_care"
                                value="3"
                                id="3"
                              />
                              <label class="form-check-label" for="3">3</label>
                            </div>
                          </td>
                          <td>
                            <div class="form-check sm:mt-0">
                              <input
                                class="form-check-input"
                                type="radio"
                                name="return_for_medical_care"
                                v-model="form.return_for_medical_care"
                                value="2"
                                id="2"
                              />
                              <label class="form-check-label" for="2">2</label>
                            </div>
                          </td>
                          <td>
                            <div class="form-check sm:mt-0">
                              <input
                                class="form-check-input"
                                type="radio"
                                name="return_for_medical_care"
                                v-model="form.return_for_medical_care"
                                value="1"
                                id="1"
                              />
                              <label class="form-check-label" for="1">1</label>
                            </div>
                          </td>
                          <td>
                            <div class="form-check sm:mt-0">
                              <input
                                class="form-check-input"
                                type="radio"
                                name="return_for_medical_care"
                                v-model="form.return_for_medical_care"
                                value="0"
                                id="0"
                              />
                              <label class="form-check-label" for="0">0</label>
                            </div>
                          </td>
                        </tr>
                        <tr v-if="errors.return_for_medical_care">
                          <td colspan="12">
                            <div
                              class="text-danger font-medium text-xs mt-1"
                              v-if="errors.return_for_medical_care"
                            >
                              {{ errors.return_for_medical_care[0] }}
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td colspan="12">
                            <label for="breathe_rate" class="form-label"
                              >Why would you return to
                              {{ data.consultation_details.registered_facility_name }} for
                              medical care</label
                            >
                            <input
                              id="why_return_for_medical_care"
                              type="text"
                              class="form-control"
                              placeholder="Input why you would return for medical care"
                              v-model="form.why_return_for_medical_care"
                            />
                            <div
                              class="text-danger font-medium text-xs mt-1"
                              v-if="errors.why_return_for_medical_care"
                            >
                              {{ errors.why_return_for_medical_care[0] }}
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <label for="recommend_facility" class="form-label">
                              How likely are you to recommend this hospital to your
                              friends and relatives?
                            </label>
                          </td>
                          <td>
                            <div class="form-check sm:mt-0">
                              <input
                                class="form-check-input"
                                type="radio"
                                name="recommend_facility"
                                v-model="form.recommend_facility"
                                value="10"
                                id="10"
                              />
                              <label class="form-check-label block" for="10">10</label>
                            </div>
                          </td>
                          <td>
                            <div class="form-check sm:mt-0">
                              <input
                                class="form-check-input"
                                type="radio"
                                name="recommend_facility"
                                v-model="form.recommend_facility"
                                value="9"
                                id="9"
                              />
                              <label class="form-check-label" for="9">9</label>
                            </div>
                          </td>
                          <td>
                            <div class="form-check sm:mt-0">
                              <input
                                class="form-check-input"
                                type="radio"
                                name="recommend_facility"
                                v-model="form.recommend_facility"
                                value="8"
                                id="8"
                              />
                              <label class="form-check-label" for="8">8</label>
                            </div>
                          </td>
                          <td>
                            <div class="form-check sm:mt-0">
                              <input
                                class="form-check-input"
                                type="radio"
                                name="recommend_facility"
                                v-model="form.recommend_facility"
                                value="7"
                                id="7"
                              />
                              <label class="form-check-label" for="7">7</label>
                            </div>
                          </td>
                          <td>
                            <div class="form-check sm:mt-0">
                              <input
                                class="form-check-input"
                                type="radio"
                                name="recommend_facility"
                                v-model="form.recommend_facility"
                                value="6"
                                id="6"
                              />
                              <label class="form-check-label" for="6">6</label>
                            </div>
                          </td>
                          <td>
                            <div class="form-check sm:mt-0">
                              <input
                                class="form-check-input"
                                type="radio"
                                name="recommend_facility"
                                v-model="form.recommend_facility"
                                value="5"
                                id="5"
                              />
                              <label class="form-check-label block" for="5">5</label>
                            </div>
                          </td>
                          <td>
                            <div class="form-check sm:mt-0">
                              <input
                                class="form-check-input"
                                type="radio"
                                name="recommend_facility"
                                v-model="form.recommend_facility"
                                value="4"
                                id="4"
                              />
                              <label class="form-check-label" for="4">4</label>
                            </div>
                          </td>
                          <td>
                            <div class="form-check sm:mt-0">
                              <input
                                class="form-check-input"
                                type="radio"
                                name="recommend_facility"
                                v-model="form.recommend_facility"
                                value="3"
                                id="3"
                              />
                              <label class="form-check-label" for="3">3</label>
                            </div>
                          </td>
                          <td>
                            <div class="form-check sm:mt-0">
                              <input
                                class="form-check-input"
                                type="radio"
                                name="recommend_facility"
                                v-model="form.recommend_facility"
                                value="2"
                                id="2"
                              />
                              <label class="form-check-label" for="2">2</label>
                            </div>
                          </td>
                          <td>
                            <div class="form-check sm:mt-0">
                              <input
                                class="form-check-input"
                                type="radio"
                                name="recommend_facility"
                                v-model="form.recommend_facility"
                                value="1"
                                id="1"
                              />
                              <label class="form-check-label" for="1">1</label>
                            </div>
                          </td>
                          <td>
                            <div class="form-check sm:mt-0">
                              <input
                                class="form-check-input"
                                type="radio"
                                name="recommend_facility"
                                v-model="form.recommend_facility"
                                value="0"
                                id="0"
                              />
                              <label class="form-check-label" for="0">0</label>
                            </div>
                          </td>
                        </tr>
                        <tr v-if="errors.recommend_facility">
                          <td colspan="12">
                            <div
                              class="text-danger font-medium text-xs mt-1"
                              v-if="errors.recommend_facility"
                            >
                              {{ errors.recommend_facility[0] }}
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td colspan="12">
                            <label for="why_recommend_facility" class="form-label"
                              >Why would you recommend
                              {{ data.consultation_details.registered_facility_name }} to
                              friends and family</label
                            >
                            <input
                              id="why_recommend_facility"
                              type="text"
                              class="form-control"
                              placeholder="Input why you would return for medical care"
                              v-model="form.why_recommend_facility"
                            />
                            <div
                              class="text-danger font-medium text-xs mt-1"
                              v-if="errors.why_recommend_facility"
                            >
                              {{ errors.why_recommend_facility[0] }}
                            </div>
                          </td>
                        </tr>
                      </table>
                    </div>
                    <input type="submit" value="Submit" class="btn btn-primary mt-2" />
                    <loading v-if="loading == true"></loading>
                  </div>
                </form>
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
  name: "consultations",
  data() {
    return {
      id: null,
      token: null,
      loading: false,
      error: false,
      errors: {},
      patient: "",
      data: {},
      key: "",
      form: {
        patient_id: "",
        key: "",
        experience: "",
        why_choose_us: "",
        other: "",
        first_time: "",
        impressed: "",
        exceptional_staff: "",
        name: "",
        nursing_care: "",
        medical_officer_care: "",
        clerical_staff: "",
        food_services: "",
        cleanliness: "",
        staff_courtesy: "",
        discharge_process: "",
        facilities_and_accomodation: "",
        special_needs: "",
        return_for_medical_care: "",
        why_return_for_medical_care: "",
        recommend_facility: "",
        why_recommend_facility: "",
      },
    };
  },

  created() {
    this.login();
    this.getPatient();
    this.getData();
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
        this.key = this.$route.params.key;
        this.form.key = this.$route.params.key;
        this.form.patient_id = Patient.id();
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
    getData() {
      axios
        .get("/api-patient/v1/patient-consultation/" + this.key, {
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
    store() {
      this.loading = true;
      axios
        .post("/api/patient-satisfactory-survey", this.form)
        .then(() => {
          this.$router.push({
            name: "hospital-visits",
          });

          Toast.fire({
            icon: "success",
            title: "Patient satisfactory survey successfully added",
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
.img-size {
  height: 5rem;
}
.block {
  display: block;
}
</style>
