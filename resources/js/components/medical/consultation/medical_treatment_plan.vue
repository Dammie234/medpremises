<template>
  <div class="main">
    <!-- BEGIN: Mobile Menu -->
    <mobile-menu></mobile-menu>
    <!-- END: Mobile Menu -->
    <div class="flex">
      <!-- BEGIN: Side Menu -->
      <side-menu page="patient"></side-menu>
      <!-- END: Side Menu -->
      <!-- BEGIN: Content -->
      <div class="content">
        <!-- BEGIN: Top Bar -->
        <top-bar title="Consultation - Medical Treatment Plan"></top-bar>
        <!-- END: Top Bar -->

        <div class="grid grid-cols-12 gap-6 mt-4">
          <div class="intro-y col-span-12 xxl:col-span-12">
            <div class="intro-y box">
              <div
                class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60"
              >
                <h2 class="font-medium text-base mr-auto">
                  Medical Treatment Plan for {{ data.patient.name }}
                </h2>
              </div>
              <div class="p-5">
                <div
                  class="grid grid-cols-12 gap-x-5"
                  v-if="data.treatment.treatment !== null"
                >
                  <div class="col-span-12 xl:col-span-12 mt-3">
                    <div class="overflow-x-auto">
                      <table class="table table-bordered table sm">
                        <thead>
                          <tr>
                            <th>Diagnosis</th>
                            <th>Problem</th>
                            <th>Long Term Goal</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>{{ data.treatment_plan.diagnosis }}</td>
                            <td>
                              <span v-if="data.treatment_plan.problem">{{
                                data.treatment_plan.problem
                              }}</span
                              ><span v-else>-</span>
                            </td>
                            <td v-html="data.treatment_plan.long_term_goal"></td>
                            <td>
                              <button
                                v-if="edit_treatment_plan == false"
                                class="btn btn-warning"
                                @click="editTreatmentPlan"
                              >
                                Edit</button
                              ><button
                                v-else
                                class="btn btn-warning"
                                @click="editTreatmentPlan"
                              >
                                Close
                              </button>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                      <button
                        class="btn btn-primary mt-2"
                        @click="addGoal"
                        v-if="add_goal == false"
                      >
                        Add Short Term Goal</button
                      ><button class="btn btn-primary mt-2" v-else @click="addGoal">
                        Close Short Term Goal
                      </button>
                    </div>
                  </div>
                </div>
                <div v-else>
                  <div
                    class="alert alert-outline-danger alert-dismissible show flex items-center mb-2 mt-2"
                    role="alert"
                  >
                    <i data-feather="alert-octagon" class="fa fa-exclamation-circle fa-2x mr-2"></i>
                    <strong class="mr-2"> Whoops! </strong> You have to provide data for Medical
                    Treatment before you can add Medical Treatment Plan.
                    <button
                      type="button"
                      class="btn-close"
                      data-bs-dismiss="alert"
                      aria-label="Close"
                    >
                      <i data-feather="x" class="fa fa-times w-4 h-4"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="grid grid-cols-12 gap-6 mt-4" v-if="edit_treatment_plan == true">
          <div class="intro-y col-span-12 xxl:col-span-12">
            <div class="intro-y box">
              <div
                class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60"
              >
                <h2 class="font-medium text-base mr-auto">
                  Edit Medical Treatment Plan for {{ data.patient.name }}
                </h2>
              </div>
              <div class="p-5">
                <div class="grid grid-cols-12 gap-x-5">
                  <div class="col-span-12 xl:col-span-12 mt-3">
                    <form @submit.prevent="submitTreatmentPlan">
                      <div :disabled="loading">
                        <div class="grid grid-cols-12 gap-x-5">
                          <div class="col-span-12 xl:col-span-12 mt-3">
                            <label for="diagnosis" class="form-label">Diagnosis</label>
                            <input
                              type="text"
                              v-model="treatment_plan.diagnosis"
                              disabled
                              class="form-control"
                            />
                          </div>
                          <div class="col-span-12 xl:col-span-12 mt-3">
                            <label for="problem" class="form-label">Problem</label>
                            <input
                              id="problem"
                              type="text"
                              v-model="treatment_plan.problem"
                              class="form-control"
                            />
                            <div
                              class="text-danger font-medium text-xs mt-1"
                              v-if="errors.problem"
                            >
                              {{ errors.problem[0] }}
                            </div>
                          </div>
                          <div class="col-span-12 xl:col-span-12 mt-3">
                            <label for="long_term_goal" class="form-label"
                              >Long Term Goal</label
                            >
                            <vue-editor
                              id="long_term_goal"
                              class="form-control"
                              v-model="treatment_plan.long_term_goal"
                              :editorToolbar="customToolbar"
                            ></vue-editor>
                            <div
                              class="text-danger font-medium text-xs mt-1"
                              v-if="errors.long_term_goal"
                            >
                              {{ errors.long_term_goal[0] }}
                            </div>
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
        <div v-if="error == true" class="">
          <div
            class="alert alert-outline-danger alert-dismissible show flex items-center mb-2"
            role="alert"
            v-for="(error, index) in errors"
            :key="index"
          >
            <i data-feather="alert-octagon" class="fa fa-exclamation-circle fa-2x mr-2"></i>
            <strong class="mr-2">Whoops!</strong> {{ error }}
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="alert"
              aria-label="Close"
            >
              <i data-feather="x" class="fa fa-times w-4 h-4"></i>
            </button>
          </div>
        </div>
        <div class="grid grid-cols-12 gap-6 mt-4" v-if="add_goal == true">
          <div class="intro-y col-span-12 xxl:col-span-12">
            <div class="intro-y box">
              <div
                class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60"
              >
                <h2 class="font-medium text-base mr-auto">
                  Add Short Term Goal for {{ data.patient.name }}
                </h2>
              </div>
              <div class="p-5">
                <div class="grid grid-cols-12 gap-x-5">
                  <div class="col-span-12 xl:col-span-12 mt-3">
                    <form @submit.prevent="submitShortTermGoal">
                      <div :disabled="loading">
                        <div class="grid grid-cols-12 gap-x-5">
                          <div class="col-span-12 xl:col-span-3 mt-3">
                            <label for="date1" class="form-label">Date</label>
                            <input
                              id="date1"
                              type="date"
                              v-model="form.date1"
                              required
                              class="form-control"
                            />
                            <div
                              class="text-danger font-medium text-xs mt-1"
                              v-if="errors.date1"
                            >
                              {{ errors.date1[0] }}
                            </div>
                          </div>
                          <div class="col-span-12 xl:col-span-9 mt-3">
                            <label for="problem" class="form-label">Problem</label>
                            <input
                              id="problem"
                              type="text"
                              v-model="form.problem"
                              required
                              class="form-control"
                            />
                            <div
                              class="text-danger font-medium text-xs mt-1"
                              v-if="errors.problem"
                            >
                              {{ errors.problem[0] }}
                            </div>
                          </div>
                          <div class="col-span-12 xl:col-span-6 mt-3">
                            <label for="short_term_goal" class="form-label"
                              >Short Term Goal</label
                            >
                            <input
                              id="short_term_goal"
                              type="text"
                              required
                              v-model="form.short_term_goal"
                              class="form-control"
                            />
                            <div
                              class="text-danger font-medium text-xs mt-1"
                              v-if="errors.short_term_goal"
                            >
                              {{ errors.short_term_goal[0] }}
                            </div>
                          </div>
                          <div class="col-span-12 xl:col-span-6 mt-3">
                            <label for="approaches" class="form-label">Approaches</label>
                            <input
                              id="approaches"
                              type="text"
                              required
                              v-model="form.approaches"
                              class="form-control"
                            />
                            <div
                              class="text-danger font-medium text-xs mt-1"
                              v-if="errors.approaches"
                            >
                              {{ errors.approaches[0] }}
                            </div>
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
        <div class="grid grid-cols-12 gap-6 mt-4" v-if="type_1 == true">
          <div class="intro-y col-span-12 xxl:col-span-12">
            <div class="intro-y box">
              <div
                class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60"
              >
                <h2 class="font-medium text-base mr-auto">
                  Edit Short Term Goal for {{ data.patient.name }}
                </h2>
              </div>
              <div class="p-5">
                <div class="grid grid-cols-12 gap-x-5">
                  <div class="col-span-12 xl:col-span-12 mt-3">
                    <form @submit.prevent="submitUpdateShortTermGoal(type.key, type.id)">
                      <div :disabled="loading">
                        <div class="grid grid-cols-12 gap-x-5">
                          <div class="col-span-12 xl:col-span-3 mt-3">
                            <label for="date1" class="form-label">Date</label>
                            <input
                              id="date1"
                              type="date"
                              v-model="type.date1"
                              required
                              class="form-control"
                            />
                            <div
                              class="text-danger font-medium text-xs mt-1"
                              v-if="errors.date1"
                            >
                              {{ errors.date1[0] }}
                            </div>
                          </div>
                          <div class="col-span-12 xl:col-span-9 mt-3">
                            <label for="problem" class="form-label">Problem</label>
                            <input
                              id="problem"
                              type="text"
                              v-model="type.problem"
                              required
                              class="form-control"
                            />
                            <div
                              class="text-danger font-medium text-xs mt-1"
                              v-if="errors.problem"
                            >
                              {{ errors.problem[0] }}
                            </div>
                          </div>
                          <div class="col-span-12 xl:col-span-6 mt-3">
                            <label for="short_term_goal" class="form-label"
                              >Short Term Goal</label
                            >
                            <input
                              id="short_term_goal"
                              type="text"
                              required
                              v-model="type.short_term_goal"
                              class="form-control"
                            />
                            <div
                              class="text-danger font-medium text-xs mt-1"
                              v-if="errors.short_term_goal"
                            >
                              {{ errors.short_term_goal[0] }}
                            </div>
                          </div>
                          <div class="col-span-12 xl:col-span-6 mt-3">
                            <label for="approaches" class="form-label">Approaches</label>
                            <input
                              id="approaches"
                              type="text"
                              required
                              v-model="type.approaches"
                              class="form-control"
                            />
                            <div
                              class="text-danger font-medium text-xs mt-1"
                              v-if="errors.approaches"
                            >
                              {{ errors.approaches[0] }}
                            </div>
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
        <div class="grid grid-cols-12 gap-6 mt-4" v-if="type_2 == true">
          <div class="intro-y col-span-12 xxl:col-span-12">
            <div class="intro-y box">
              <div
                class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60"
              >
                <h2 class="font-medium text-base mr-auto">
                  Edit Short Term Goal for {{ data.patient.name }}
                </h2>
              </div>
              <div class="p-5">
                <div class="grid grid-cols-12 gap-x-5">
                  <div class="col-span-12 xl:col-span-12 mt-3">
                    <form @submit.prevent="submitUpdateShortTermGoal(type.key, type.id)">
                      <div :disabled="loading">
                        <div class="grid grid-cols-12 gap-x-5">
                          <div class="col-span-12 xl:col-span-3 mt-3">
                            <label for="date2" class="form-label">Date</label>
                            <input
                              id="date2"
                              type="date"
                              v-model="type.date2"
                              required
                              class="form-control"
                            />
                            <div
                              class="text-danger font-medium text-xs mt-1"
                              v-if="errors.date2"
                            >
                              {{ errors.date2[0] }}
                            </div>
                          </div>
                          <div class="col-span-12 xl:col-span-9 mt-3">
                            <label for="evaluation" class="form-label">Evaluation</label>
                            <input
                              id="evaluation"
                              type="text"
                              v-model="type.evaluation"
                              required
                              class="form-control"
                            />
                            <div
                              class="text-danger font-medium text-xs mt-1"
                              v-if="errors.evaluation"
                            >
                              {{ errors.evaluation[0] }}
                            </div>
                          </div>
                          <div class="col-span-12 xl:col-span-12 mt-3">
                            <label for="goals_met" class="form-label">Goals Met</label>
                            <input
                              id="goals_met"
                              type="text"
                              required
                              v-model="type.goals_met"
                              class="form-control"
                            />
                            <div
                              class="text-danger font-medium text-xs mt-1"
                              v-if="errors.goals_met"
                            >
                              {{ errors.goals_met[0] }}
                            </div>
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
        <div class="grid grid-cols-12 gap-6 mt-4">
          <div class="intro-y col-span-12 xxl:col-span-12">
            <div class="intro-y box">
              <div
                class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60"
              >
                <h2 class="font-medium text-base mr-auto">
                  Short Term Goals for {{ data.patient.name }}
                </h2>
              </div>
              <div class="p-5">
                <div class="grid grid-cols-12 gap-6 mt-4" v-if="plan_types.length != 0">
                  <div class="col-span-12 xl:col-span-6 mt-3">
                    <div class="overflow-x-auto">
                      <table class="table table-bordered table-xs text-xs">
                        <thead>
                          <tr>
                            <th>Date</th>
                            <th>Problem</th>
                            <th>Short Term Goal</th>
                            <th>Approaches</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="plan in plan_types" :key="plan.id">
                            <td>{{ plan.date1 | moment("DD/MM/YYYY") }}</td>
                            <td>{{ plan.problem }}</td>
                            <td>{{ plan.short_term_goal }}</td>
                            <td>{{ plan.approaches }}</td>
                            <td>
                              <button
                                v-if="type_1 == false"
                                class="btn btn-warning"
                                @click="editType1(plan.key, plan.id)"
                              >
                                Edit</button
                              ><button
                                v-else
                                class="btn btn-warning"
                                @click="editType1(plan.key, plan.id)"
                              >
                                Close
                              </button>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                      <button
                        class="btn btn-primary mt-2"
                        @click="addGoal"
                        v-if="add_goal == false"
                      >
                        Add Short Term Goal</button
                      ><button class="btn btn-primary mt-2" v-else @click="addGoal">
                        Close Short Term Goal
                      </button>
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-6 mt-3">
                    <div class="overflow-x-auto">
                      <table class="table table-bordered table-xs text-xs">
                        <thead>
                          <tr>
                            <th>Date</th>
                            <th>Evaluation</th>
                            <th>Goals Met</th>
                            <th>Added By</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="plan in plan_types" :key="plan.id">
                            <td>
                              <span v-if="plan.date2">{{
                                plan.date2 | moment("DD/MM/YYYY")
                              }}</span
                              ><span v-else>-</span>
                            </td>
                            <td>
                              <span v-if="plan.evaluation">{{ plan.problem }}</span
                              ><span v-else>-</span>
                            </td>
                            <td>
                              <span v-if="plan.goals_met">{{ plan.goals_met }}</span
                              ><span v-else>-</span>
                            </td>
                            <td>{{ plan.staff_name }}</td>
                            <td>
                              <button
                                v-if="type_2 == false"
                                class="btn btn-warning"
                                @click="editType2(plan.key, plan.id)"
                              >
                                Edit</button
                              ><button
                                v-else
                                class="btn btn-warning"
                                @click="editType2(plan.key, plan.id)"
                              >
                                Close
                              </button>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                      <button
                        class="btn btn-primary mt-2"
                        @click="addGoal"
                        v-if="add_goal == false"
                      >
                        Add Short Term Goal</button
                      ><button class="btn btn-primary mt-2" v-else @click="addGoal">
                        Close Short Term Goal
                      </button>
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
  name: "medical-treatment-plan",
  data() {
    return {
      id: null,
      token: null,
      key: "",
      loading: false,
      errors: {},
      error: false,
      data: {},
      add_goal: false,
      edit_treatment_plan: false,
      treatment_plan: {
        problem: "",
        diagnosis: "",
        long_term_goal: "",
        token: "",
      },
      form: {
        date1: null,
        problem: null,
        short_term_goal: null,
        approaches: null,
        token: "",
        key: "",
      },
      plan_types: [],
      type_1: false,
      type_2: false,
      type: "",
      customToolbar: [
        ["bold", "italic", "underline", "strike"],
        [{ align: "" }, { align: "center" }, { align: "right" }, { align: "justify" }],
        ["blockquote", "code-block"],
        [{ list: "ordered" }, { list: "bullet" }, { list: "check" }],
        [{ indent: "-1" }, { indent: "+1" }], // outdent/indent
        ["link"],
        ["clean"],
      ],
    };
  },

  created() {
    this.login();
    this.getMedicalTreatmentPlan();
    this.getData();
    this.getMedicalTreatmentPlanTypes();
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
        this.form.key = this.$route.params.key;
        this.form.token = User.token();
      }
    },
    editTreatmentPlan() {
      if (this.edit_treatment_plan == false) {
        this.edit_treatment_plan = true;
      } else {
        this.edit_treatment_plan = false;
      }
    },
    addGoal() {
      if (this.add_goal == false) {
        this.add_goal = true;
      } else {
        this.add_goal = false;
      }
    },
    getData() {
      axios
        .get("/api/v1/consultation/" + this.key, {
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
    getMedicalTreatmentPlan() {
      axios
        .get("/api/v1/consultation/" + this.key, {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then((response) => (this.treatment_plan = response.data.treatment_plan))
        .catch((error) => {
          console.log(error);
          if (error.response.status == 401) {
            this.$router.push({
              name: "logout",
            });
          }
        });
    },
    getMedicalTreatmentPlanTypes() {
      axios
        .get("/api/v1/medical-treatment-plan-types/" + this.key, {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then((response) => (this.plan_types = response.data))
        .catch((error) => {
          console.log(error);
          if (error.response.status == 401) {
            this.$router.push({
              name: "logout",
            });
          }
        });
    },
    editType1(key, id) {
      if (this.type_1 == false) {
        this.type_1 = true;
        axios
          .get("/api/v1/medical-treatment-plan-type/" + key + "/" + id, {
            headers: {
              Authorization: "Bearer " + this.token,
              Accept: "application/json",
            },
          })
          .then((response) => (this.type = response.data))
          .catch((error) => {
            console.log(error);
            if (error.response.status == 401) {
              this.$router.push({
                name: "logout",
              });
            }
          });
      } else {
        this.type_1 = false;
      }
    },
    editType2(key, id) {
      if (this.type_2 == false) {
        this.type_2 = true;
        axios
          .get("/api/v1/medical-treatment-plan-type/" + key + "/" + id, {
            headers: {
              Authorization: "Bearer " + this.token,
              Accept: "application/json",
            },
          })
          .then((response) => (this.type = response.data))
          .catch((error) => {
            console.log(error);
            if (error.response.status == 401) {
              this.$router.push({
                name: "logout",
              });
            }
          });
      } else {
        this.type_2 = false;
      }
    },
    submitTreatmentPlan() {
      this.loading = true;
      this.treatment_plan.token = User.token();
      axios
        .patch("/api/medical-treatment-plan/" + this.key, this.treatment_plan)
        .then(() => {
          this.$router.push({
            path: `/patient/consultations/medical-treatment-plan/${this.key}`,
          });
          this.getData();
          this.getMedicalTreatmentPlan();
          this.login();
          this.edit_treatment_plan = false;
          Toast.fire({
            icon: "success",
            title: "Medical Treatment Plan successfully updated",
          });
        })
        .catch((error) => (this.errors = error.response.data.errors))
        .finally(() => {
          this.loading = false;
        });
    },
    submitShortTermGoal() {
      this.loading = true;
      this.form.token = User.token();
      this.form.key = this.$route.params.key;
      axios
        .post("/api/short-term-goal", this.form)
        .then(() => {
          this.$router.push({
            path: `/patient/consultations/medical-treatment-plan/${this.key}`,
          });
          this.getData();
          this.getMedicalTreatmentPlan();
          this.getMedicalTreatmentPlanTypes();
          this.login();
          this.add_goal = false;
          this.form = {
            date1: null,
            problem: null,
            short_term_goal: null,
            approaches: null,
            token: "",
            key: "",
          };
          Toast.fire({
            icon: "success",
            title: "Short Term Goal added successfully",
          });
        })
        .catch((error) => {
          this.error = true;
          console.log(error);
          if (error.response.status == 401) {
            this.errors = [];
            this.errors.push(error.response.data.error);
            this.loading = false;
            this.add_goal = false;
          }
        })
        .finally(() => {
          this.loading = false;
        });
    },
    submitUpdateShortTermGoal(key, id) {
      this.loading = true;
      axios
        .patch("/api/short-term-goal/" + key + "/" + id + "/" + this.token, this.type)
        .then(() => {
          this.$router.push({
            path: `/patient/consultations/medical-treatment-plan/${this.key}`,
          });
          this.getData();
          this.getMedicalTreatmentPlan();
          this.login();
          this.getMedicalTreatmentPlanTypes();
          this.type_1 = false;
          this.type_2 = false;
          Toast.fire({
            icon: "success",
            title: "Short Term Goal successfully updated",
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

<style scoped></style>
