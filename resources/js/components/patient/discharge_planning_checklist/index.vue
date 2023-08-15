<template>
  <div class="main">
    <!-- BEGIN: Mobile Menu -->
    <patient-mobile-menu></patient-mobile-menu>
    <!-- END: Mobile Menu -->
    <div class="flex">
      <!-- BEGIN: Side Menu -->
      <patient-side-menu page="hospital-visits"></patient-side-menu>
      <!-- END: Side Menu -->
      <div class="content">
        <!-- BEGIN: Top Bar -->
        <patient-top-bar title="Discharge Patient"></patient-top-bar>
        <!-- END: Top Bar -->
        <div class="grid grid-cols-12 gap-6 mt-4">
          <div class="intro-y col-span-12 xxl:col-span-12">
            <div class="intro-y box">
              <div class="flex flex-col p-5 border-b border-slate-200/60">
                <h2 class="font-medium text-base">
                  Discharge Planning Checklist for {{ patient.name }}
                </h2>
              </div>
              <div class="p-5">
                <div class="grid grid-cols-12 gap-x-5">
                  <div class="col-span-12 xl:col-span-12 mt-3">
                    <div class="grid grid-cols-12 gap-x-5">
                      <div class="col-span-12 xl:col-span-12">
                        <h5>Dear {{ patient.name }}</h5>
                        <p class="mt-2">
                          You and your family members play a crucial role in our discharge
                          planning team. Throughout your stay, our team will work with you
                          to plan and prepare so that you are comfortable in managing your
                          health when you leave. Use this checklist as a guide for
                          yourself and your family members. It will help us to learn about
                          your preferences after you leave the hospital and will ensure a
                          smooth care transition, whether you will be going to your home
                          or to another health care setting. Check off or fill in each
                          item as you discuss it with your health care team (doctors,
                          nurses, social workers, discharge planners, etc ) Please skip
                          any questions that don't apply to you.
                        </p>
                        <form @submit.prevent="submit">
                          <div :disabled="loading">
                            <div class="grid grid-cols-12 gap-x-5">
                              <div class="col-span-12 mt-3">
                                <h4 class="text-xl">Next Steps</h4>
                                <p class="mt-1">
                                  Be sure to express your personal preferences to the care
                                  team when discussing next steps.
                                </p>
                              </div>
                              <div class="col-span-12 xl:col-span-12 mt-3">
                                <label
                                  for="where_to_go_after_discharge"
                                  class="form-label"
                                  >Where will I be going after discharge? Discuss any
                                  options that are available to you.</label
                                >
                                <input
                                  id="where_to_go_after_discharge"
                                  class="form-control"
                                  v-model="form.where_to_go_after_discharge"
                                  type="text"
                                />
                                <div
                                  class="text-danger font-medium text-xs mt-1"
                                  v-if="errors.where_to_go_after_discharge"
                                >
                                  {{ errors.where_to_go_after_discharge[0] }}
                                </div>
                              </div>
                              <div class="col-span-12 mt-3 xl:col-span-12">
                                <div class="flex flex-col sm:flex-row mt-2">
                                  <div class="form-check mr-2">
                                    <input
                                      id="radio-switch-6"
                                      class="form-check-input"
                                      type="checkbox"
                                      v-model="form.job_arrangement"
                                      name="job_arrangement"
                                      value="1"
                                    />
                                    <label class="form-check-label" for="radio-switch-6"
                                      >I have made arrangement for my job.</label
                                    >
                                  </div>
                                </div>
                              </div>
                              <div class="col-span-12 mt-3 xl:col-span-12">
                                <div class="flex flex-col sm:flex-row mt-2">
                                  <div class="form-check mr-2">
                                    <input
                                      id="radio-switch-7"
                                      class="form-check-input"
                                      type="checkbox"
                                      v-model="form.caregiver_arrangement"
                                      name="caregiver_arrangement"
                                      value="1"
                                    />
                                    <label class="form-check-label" for="radio-switch-7"
                                      >I have made arrangement to secure a
                                      caregiver(s).</label
                                    >
                                  </div>
                                </div>
                              </div>
                              <div class="col-span-12 mt-3 xl:col-span-12">
                                <div class="flex flex-col sm:flex-row mt-2">
                                  <div class="form-check mr-2">
                                    <input
                                      id="radio-switch-8"
                                      class="form-check-input"
                                      type="checkbox"
                                      v-model="form.health_insurance_services"
                                      name="health_insurance_services"
                                      value="1"
                                    />
                                    <label class="form-check-label" for="radio-switch-8"
                                      >I have learned what services I can get from my
                                      health insurance or Medicare</label
                                    >
                                  </div>
                                </div>
                              </div>
                              <div class="col-span-12 mt-3">
                                <h4 class="text-xl">For the caregiver</h4>
                              </div>
                              <div class="col-span-12 xl:col-span-12 mt-3">
                                <label for="caregiver_contact" class="form-label"
                                  >Who will be assisting me after I leave the hospital?
                                  (Write down the name and contact information for your
                                  caregiver(s)).</label
                                >
                                <input
                                  id="caregiver_contact"
                                  class="form-control"
                                  v-model="form.caregiver_contact"
                                  type="text"
                                />
                                <div
                                  class="text-danger font-medium text-xs mt-1"
                                  v-if="errors.caregiver_contact"
                                >
                                  {{ errors.caregiver_contact[0] }}
                                </div>
                              </div>
                              <div class="col-span-12 mt-3 xl:col-span-12">
                                <div class="flex flex-col sm:flex-row mt-2">
                                  <div class="form-check mr-2">
                                    <input
                                      id="radio-switch-1"
                                      class="form-check-input"
                                      type="checkbox"
                                      v-model="form.patient_help"
                                      name="patient_help"
                                      value="1"
                                    />
                                    <label class="form-check-label" for="radio-switch-1"
                                      >Can you give the patient the help he or she
                                      needs?</label
                                    >
                                  </div>
                                </div>
                              </div>
                              <div class="col-span-12 xl:col-span-12 mt-3">
                                <label for="task_for_help" class="form-label"
                                  >What tasks do you need help with?</label
                                >
                                <input
                                  id="task_for_help"
                                  class="form-control"
                                  v-model="form.task_for_help"
                                  type="text"
                                />
                                <div
                                  class="text-danger font-medium text-xs mt-1"
                                  v-if="errors.task_for_help"
                                >
                                  {{ errors.task_for_help[0] }}
                                </div>
                              </div>
                              <div class="col-span-12 xl:col-span-12 mt-3">
                                <label for="caregiver_education" class="form-label"
                                  >What education or training do you need?</label
                                >
                                <input
                                  id="task_for_help"
                                  class="form-control"
                                  v-model="form.caregiver_education"
                                  type="text"
                                />
                                <div
                                  class="text-danger font-medium text-xs mt-1"
                                  v-if="errors.caregiver_education"
                                >
                                  {{ errors.caregiver_education[0] }}
                                </div>
                              </div>
                              <div class="col-span-12 xl:col-span-12 mt-3">
                                <label
                                  for="who_to_contact_for_question"
                                  class="form-label"
                                  >Write down a name and phone number of a person you can
                                  call if you have questions.</label
                                >
                                <input
                                  id="task_for_help"
                                  class="form-control"
                                  v-model="form.who_to_contact_for_question"
                                  type="text"
                                />
                                <div
                                  class="text-danger font-medium text-xs mt-1"
                                  v-if="errors.who_to_contact_for_question"
                                >
                                  {{ errors.who_to_contact_for_question[0] }}
                                </div>
                              </div>
                              <div class="col-span-12 mt-3">
                                <h4 class="text-xl">
                                  Managing Your Health After Discharge
                                </h4>
                                <p class="mt-1">
                                  Ask the following questions of your care team to ensure
                                  you have a good understanding of the things you'll be
                                  responsible for in managing your health after leaving
                                  the hospital:
                                </p>
                              </div>
                              <div class="col-span-12 xl:col-span-12 mt-3">
                                <label for="side_effects" class="form-label"
                                  >What problems or side effects should I watch for? How
                                  often do these complications occur?</label
                                >
                                <input
                                  id="task_for_help"
                                  class="form-control"
                                  v-model="form.side_effects"
                                  type="text"
                                  disabled
                                />
                                <div
                                  class="text-danger font-medium text-xs mt-1"
                                  v-if="errors.side_effects"
                                >
                                  {{ errors.side_effects[0] }}
                                </div>
                              </div>
                              <div class="col-span-12 xl:col-span-12 mt-3">
                                <label for="what_to_expect" class="form-label"
                                  >How can I expect to feel in the coming days?</label
                                >
                                <input
                                  id="task_for_help"
                                  class="form-control"
                                  v-model="form.what_to_expect"
                                  type="text"
                                  disabled
                                />
                                <div
                                  class="text-danger font-medium text-xs mt-1"
                                  v-if="errors.what_to_expect"
                                >
                                  {{ errors.what_to_expect[0] }}
                                </div>
                              </div>
                              <div class="col-span-12 xl:col-span-12 mt-3">
                                <label for="pain_experience" class="form-label"
                                  >If I experience pain, what should I do? What kind of
                                  pain medications can I take?</label
                                >
                                <input
                                  id="task_for_help"
                                  class="form-control"
                                  v-model="form.pain_experience"
                                  type="text"
                                  disabled
                                />
                                <div
                                  class="text-danger font-medium text-xs mt-1"
                                  v-if="errors.pain_experience"
                                >
                                  {{ errors.pain_experience[0] }}
                                </div>
                              </div>
                              <div class="col-span-12 xl:col-span-12 mt-3">
                                <label for="special_diet" class="form-label"
                                  >Do I need to follow a special diet at home? What foods
                                  should I avoid? Can I drink alcohol?</label
                                >
                                <input
                                  id="task_for_help"
                                  class="form-control"
                                  v-model="form.special_diet"
                                  type="text"
                                  disabled
                                />
                                <div
                                  class="text-danger font-medium text-xs mt-1"
                                  v-if="errors.special_diet"
                                >
                                  {{ errors.special_diet[0] }}
                                </div>
                              </div>
                              <div class="col-span-12 xl:col-span-12 mt-3">
                                <label for="activities" class="form-label"
                                  >What activities should I avoid after leaving the
                                  hospital?</label
                                >
                                <input
                                  id="task_for_help"
                                  class="form-control"
                                  v-model="form.activities"
                                  type="text"
                                  disabled
                                />
                                <div
                                  class="text-danger font-medium text-xs mt-1"
                                  v-if="errors.activities"
                                >
                                  {{ errors.activities[0] }}
                                </div>
                              </div>
                              <div class="col-span-12 xl:col-span-12 mt-3">
                                <label for="work_school_return" class="form-label"
                                  >When can I return to work, school, etc.?</label
                                >
                                <input
                                  id="task_for_help"
                                  class="form-control"
                                  v-model="form.work_school_return"
                                  type="text"
                                  disabled
                                />
                                <div
                                  class="text-danger font-medium text-xs mt-1"
                                  v-if="errors.work_school_return"
                                >
                                  {{ errors.work_school_return[0] }}
                                </div>
                              </div>
                              <div class="col-span-12 xl:col-span-12 mt-3">
                                <label for="when_to_drive" class="form-label"
                                  >When can I drive again?</label
                                >
                                <input
                                  id="task_for_help"
                                  class="form-control"
                                  v-model="form.when_to_drive"
                                  type="text"
                                  disabled
                                />
                                <div
                                  class="text-danger font-medium text-xs mt-1"
                                  v-if="errors.when_to_drive"
                                >
                                  {{ errors.when_to_drive[0] }}
                                </div>
                              </div>
                              <div class="col-span-12 xl:col-span-12 mt-3">
                                <label for="when_to_bath" class="form-label"
                                  >When can I take a shower and/or bath?</label
                                >
                                <input
                                  id="task_for_help"
                                  class="form-control"
                                  v-model="form.when_to_bath"
                                  type="text"
                                  disabled
                                />
                                <div
                                  class="text-danger font-medium text-xs mt-1"
                                  v-if="errors.when_to_bath"
                                >
                                  {{ errors.when_to_bath[0] }}
                                </div>
                              </div>
                              <div class="col-span-12 xl:col-span-12 mt-3">
                                <label for="climb_stairs" class="form-label"
                                  >Is it okay for me to climb stairs?</label
                                >
                                <input
                                  id="task_for_help"
                                  class="form-control"
                                  v-model="form.climb_stairs"
                                  type="text"
                                  disabled
                                />
                                <div
                                  class="text-danger font-medium text-xs mt-1"
                                  v-if="errors.climb_stairs"
                                >
                                  {{ errors.climb_stairs[0] }}
                                </div>
                              </div>
                              <div class="col-span-12 xl:col-span-12 mt-3">
                                <label for="care_for_incision" class="form-label"
                                  >How should I care for my incision or dressing? (Ask
                                  staff to show you how to perform any tasks, like
                                  changing dressing or giving a shot, that you’ll be
                                  required to do after leaving the hospital. Show the
                                  staff how to do it after their instructions.)</label
                                >
                                <input
                                  id="task_for_help"
                                  class="form-control"
                                  v-model="form.care_for_incision"
                                  type="text"
                                  disabled
                                />
                                <div
                                  class="text-danger font-medium text-xs mt-1"
                                  v-if="errors.care_for_incision"
                                >
                                  {{ errors.care_for_incision[0] }}
                                </div>
                              </div>
                              <div class="col-span-12 xl:col-span-12 mt-3">
                                <label for="medical_equipment" class="form-label"
                                  >Will I need medical equipment when I leave the
                                  hospital? Who will arrange for this? List the telephone
                                  number for the best person/organization to call with
                                  questions about medical equipment.</label
                                >
                                <input
                                  id="task_for_help"
                                  class="form-control"
                                  v-model="form.medical_equipment"
                                  type="text"
                                  disabled
                                />
                                <div
                                  class="text-danger font-medium text-xs mt-1"
                                  v-if="errors.medical_equipment"
                                >
                                  {{ errors.medical_equipment[0] }}
                                </div>
                              </div>
                              <div class="col-span-12 mt-3 xl:col-span-12">
                                <div class="flex flex-col sm:flex-row mt-2">
                                  <div class="form-check mr-2">
                                    <input
                                      id="radio-switch-9"
                                      class="form-check-input"
                                      type="checkbox"
                                      v-model="form.understand_medical_equipment"
                                      name="understand_medical_equipment"
                                      value="1"
                                      disabled
                                    />
                                    <label class="form-check-label" for="radio-switch-9"
                                      >I understand how to use the medical equipment I’ll
                                      need after leaving the hospital. (Ask for
                                      demonstrations or instructions if needed.)</label
                                    >
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-span-12 mt-3">
                              <h4 class="text-xl">Follow-Up Care</h4>
                              <p class="mt-1">
                                Be sure to express your personal preferences when
                                discussing the following follow-up care issues.
                              </p>
                            </div>
                            <div class="col-span-12 xl:col-span-12 mt-3">
                              <label for="inpatient_healthcare_setting" class="form-label"
                                >Will I need to go to another inpatient health care
                                setting? Why? How long will I be there?</label
                              >
                              <input
                                id="task_for_help"
                                class="form-control"
                                v-model="form.inpatient_healthcare_setting"
                                type="text"
                                disabled
                              />
                              <div
                                class="text-danger font-medium text-xs mt-1"
                                v-if="errors.inpatient_healthcare_setting"
                              >
                                {{ errors.inpatient_healthcare_setting[0] }}
                              </div>
                            </div>
                            <div class="col-span-12 xl:col-span-12 mt-3">
                              <label for="outpatient_theraphy" class="form-label"
                                >Will I need outpatient therapy? What kind? How will it be
                                scheduled? Where will it take place?</label
                              >
                              <input
                                id="task_for_help"
                                class="form-control"
                                v-model="form.outpatient_theraphy"
                                type="text"
                              />
                              <div
                                class="text-danger font-medium text-xs mt-1"
                                v-if="errors.outpatient_theraphy"
                              >
                                {{ errors.outpatient_theraphy[0] }}
                              </div>
                            </div>
                            <div class="col-span-12 mt-3 xl:col-span-12">
                              <div class="flex flex-col sm:flex-row mt-2">
                                <div class="form-check mr-2">
                                  <input
                                    id="radio-switch-10"
                                    class="form-check-input"
                                    type="checkbox"
                                    v-model="form.appointment_plan"
                                    name="appointment_plan"
                                    disabled
                                    value="1"
                                  />
                                  <label class="form-check-label" for="radio-switch-10"
                                    >Do I need an appointment plan for checkups?</label
                                  >
                                </div>
                              </div>
                            </div>
                            <div class="col-span-12 xl:col-span-12 mt-3">
                              <label for="follow_up_testing" class="form-label"
                                >Will any follow-up testing be required? What kind? Where?
                                When?</label
                              >
                              <input
                                id="task_for_help"
                                class="form-control"
                                v-model="form.follow_up_testing"
                                type="text"
                                disabled
                              />
                              <div
                                class="text-danger font-medium text-xs mt-1"
                                v-if="errors.follow_up_testing"
                              >
                                {{ errors.follow_up_testing[0] }}
                              </div>
                            </div>
                            <div class="col-span-12 xl:col-span-12 mt-3">
                              <label for="urgent_issue" class="form-label"
                                >If I have an urgent issue after I leave the hospital, who
                                should I call?</label
                              >
                              <input
                                id="task_for_help"
                                class="form-control"
                                v-model="form.urgent_issue"
                                type="text"
                                disabled
                              />
                              <div
                                class="text-danger font-medium text-xs mt-1"
                                v-if="errors.urgent_issue"
                              >
                                {{ errors.urgent_issue[0] }}
                              </div>
                            </div>
                            <div class="col-span-12 xl:col-span-12 mt-3">
                              <label for="general_question" class="form-label"
                                >If I have general questions about my recovery after I
                                leave the hospital, who should I call?</label
                              >
                              <input
                                id="task_for_help"
                                class="form-control"
                                v-model="form.general_question"
                                type="text"
                                disabled
                              />
                              <div
                                class="text-danger font-medium text-xs mt-1"
                                v-if="errors.general_question"
                              >
                                {{ errors.general_question[0] }}
                              </div>
                            </div>
                            <div class="col-span-12 xl:col-span-12 mt-3">
                              <label for="doctor_appointment" class="form-label"
                                >How will I get to doctor's appointments, pick up
                                prescriptions after I leave the hospital?
                              </label>
                              <input
                                id="task_for_help"
                                class="form-control"
                                v-model="form.doctor_appointment"
                                type="text"
                                disabled
                              />
                              <div
                                class="text-danger font-medium text-xs mt-1"
                                v-if="errors.doctor_appointment"
                              >
                                {{ errors.doctor_appointment[0] }}
                              </div>
                            </div>
                          </div>

                          <div class="mt-2">
                            <input
                              type="submit"
                              value="Submit"
                              class="w-20 btn btn-primary"
                            />
                            <loading v-if="loading == true"></loading>
                          </div>
                        </form>
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
</template>
<script>
export default {
  name: "edit-discharge-planning-checklist",
  data() {
    return {
      token: "",
      patient: "",
      form: {
        key: "",
        token: "",
        where_to_go_after_discharge: null,
        job_arrangement: null,
        caregiver_arrangement: null,
        caregiver_contact: null,
        health_insurance_services: null,
        hospital_bills: null,
        patient_help: null,
        task_for_help: null,
        caregiver_education: null,
        who_to_contact_for_question: null,
        side_effects: null,
        what_to_expect: null,
        pain_experience: null,
        special_diet: null,
        activities: null,
        work_school_return: null,
        when_to_drive: null,
        when_to_bath: null,
        climb_stairs: null,
        care_for_incision: null,
        medical_equipment: null,
        understand_medical_equipment: null,
        inpatient_healthcare_setting: null,
        outpatient_theraphy: null,
        appointment_plan: null,
        follow_up_testing: null,
        urgent_issue: null,
        general_question: null,
        doctor_appointment: null,
        patient: true,
      },
      errors: {},
      loading: false,
    };
  },
  created() {
    this.login();
    this.getPatient();
    this.getDischargePlanningChecklist();
  },
  methods: {
    login() {
      if (!Patient.loggedIn()) {
        this.$router.push({
          name: "patient-logout",
        });
      } else {
        this.token = Patient.token();
        this.key = this.$route.params.key;
      }
    },
    getPatient() {
      axios
        .get("/api-patient/v1/patient-consultation/" + this.key, {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then((response) => (this.patient = response.data.patient))
        .catch((error) => {
          console.log(error);
          if (error.response.status == 401) {
            this.$router.push({
              name: "patient-logout",
            });
          }
        });
    },
    getDischargePlanningChecklist() {
      axios
        .get("/api-patient/v1/patient-discharge-planning-checklist/" + this.key, {
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
              name: "patient-logout",
            });
          }
        });
    },
    submit() {
      this.loading = true;
      this.form.patient = true;

      axios
        .patch("/api-patient/discharge-patient-planning-checklist/" + this.key, this.form)
        .then(() => {
          this.$router.push({
            name: "hospital-visits",
          });

          Toast.fire({
            icon: "success",
            title: "Discharge Planning Checklist successfully updated",
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
