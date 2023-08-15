<template>
  <div class="main">
    <!-- BEGIN: Mobile Menu -->
    <mobile-menu></mobile-menu>
    <!-- END: Mobile Menu -->
    <div class="flex">
      <!-- BEGIN: Side Menu -->
      <side-menu page="instruction"></side-menu>
      <!-- END: Side Menu -->
      <div class="content">
        <!-- BEGIN: Top Bar -->
        <top-bar title="Patient Discharge Instruction"></top-bar>
        <!-- END: Top Bar -->
        <div class="grid grid-cols-12 gap-6" v-if="add_instruction == true">
          <div class="intro-y col-span-12 xxl:col-span-12">
            <div class="intro-y box">
              <div
                class="flex flex-col p-5 border-b mb-2 border-gray-200 dark:border-dark-5"
              >
                <h2 class="font-medium text-base mr-auto">
                  Add Patient Discharge Instruction
                </h2>
                <p>
                  The name field is the name of the instruction and the url is the website
                  where the patient can get education about what to do after discharge.
                </p>
              </div>
              <form class="input p-5" @submit.prevent="store">
                <div class="grid grid-cols-12 gap-x-5" :disabled="loading">
                  <div class="col-span-12 xl:col-span-4 mt-3">
                    <label for="name" class="form-label">Name</label>
                    <input
                      id="name"
                      type="text"
                      class="form-control"
                      placeholder="Input name"
                      v-model="form.name"
                    />
                    <div class="text-danger font-medium text-xs mt-1" v-if="errors.name">
                      {{ errors.name[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-8 mt-3">
                    <label for="url" class="form-label">URL</label>
                    <input
                      id="url"
                      type="text"
                      class="form-control"
                      placeholder="Input URL"
                      v-model="form.url"
                    />
                    <div class="text-danger font-medium text-xs mt-1" v-if="errors.url">
                      {{ errors.url[0] }}
                    </div>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary w-20 mt-3 mr-2">Save</button>
                <loading v-if="loading == true"></loading>
                <button class="btn btn-secondary mt-3" @click="closeInstruction">
                  Close
                </button>
              </form>
            </div>
          </div>
        </div>
        <div class="grid grid-cols-12 gap-6" v-if="edit_instruction == true">
          <div class="intro-y col-span-12 xxl:col-span-12">
            <div class="intro-y box">
              <div
                class="flex flex-col p-5 border-b mb-2 border-gray-200 dark:border-dark-5"
              >
                <h2 class="font-medium text-base mr-auto">
                  Edit Patient Discharge Instruction
                </h2>
                <p>
                  The name field is the name of the instruction and the url is the website
                  where the patient can get education about what to do after discharge.
                </p>
              </div>
              <form class="input p-5" @submit.prevent="update">
                <div class="grid grid-cols-12 gap-x-5" :disabled="loading">
                  <div class="col-span-12 xl:col-span-4 mt-3">
                    <label for="name" class="form-label">Name</label>
                    <input
                      id="name"
                      type="text"
                      class="form-control"
                      placeholder="Input name"
                      v-model="form.name"
                    />
                    <div class="text-danger font-medium text-xs mt-1" v-if="errors.name">
                      {{ errors.name[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-8 mt-3">
                    <label for="url" class="form-label">URL</label>
                    <input
                      id="url"
                      type="text"
                      class="form-control"
                      placeholder="Input URL"
                      v-model="form.url"
                    />
                    <div class="text-danger font-medium text-xs mt-1" v-if="errors.url">
                      {{ errors.url[0] }}
                    </div>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary w-20 mt-3 mr-2">Save</button>
                <loading v-if="loading == true"></loading>
                <button class="btn btn-secondary mt-3" @click="closeInstruction">
                  Close
                </button>
              </form>
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
                  Patient Discharge Instructions
                </h2>
                <div class="w-full sm:w-auto sm:ml-auto mt-3 sm:mt-0">
                  <input
                    class="form-control mr-3 pr-3"
                    type="text"
                    v-model="search"
                    placeholder="Seach Name"
                  />
                </div>
                <button
                  class="btn btn-primary"
                  @click="addInstruction"
                  style="margin-left: 15px"
                >
                  Add Instruction
                </button>
              </div>
              <div class="p-5">
                <div class="grid grid-cols-12 gap-x-5">
                  <div class="col-span-12 xl:col-span-12 mt-3">
                    <div v-if="instructions.length != 0">
                      <div class="overflow-x-auto">
                        <table class="table table-sm table-auto table-bordered">
                          <thead>
                            <tr>
                              <th class="text-xs uppercase">Name</th>
                              <th class="text-xs uppercase">URL</th>

                              <th class="text-xs uppercase">Added By</th>
                              <th class="text-xs uppercase">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr
                              class="text-xs"
                              v-for="instruction in filterSearch"
                              :key="instruction.id"
                            >
                              <td>{{ instruction.name }}</td>
                              <td>
                                <a :href="instruction.url" target="_blank">{{
                                  instruction.url
                                }}</a>
                              </td>

                              <td>{{ instruction.staff_name }}</td>

                              <td class="whitespace-nowrap">
                                <button
                                  @click="editInstruction(instruction.id)"
                                  class="btn btn-primary mr-2"
                                >
                                  <i class="fa fa-edit"></i>
                                </button>
                                <button
                                  @click="deleteInstruction(instruction.id)"
                                  class="btn btn-danger"
                                >
                                  <i class="fa fa-trash"></i>
                                </button>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div v-else>
                      <div
                        class="alert alert-outline-danger alert-dismissible show flex items-center mb-2"
                        role="alert"
                      >
                        <i data-feather="alert-octagon" class="fa fa-exclamation-circle fa-2x mr-2"></i>
                        <strong class="mr-2"> Whoops! </strong> There are no patient discharge
                        instructions
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
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: "patient-discharge-instruction",
  computed: {
    filterSearch() {
      let str = this.search;
      let string = str.charAt(0).toUpperCase() + str.slice(1);
      return this.instructions.filter((instruction) => {
        return instruction.name.match(string);
      });
    },
  },
  created() {
    this.login();
    this.getPatientDischargeInstructions();
  },
  data() {
    return {
      token: "",
      instructions: [],
      form: {
        name: "",
        url: "",
        token: "",
      },
      loading: false,
      errors: {},
      search: "",
      edit_instruction: false,
      add_instruction: false,
    };
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
    addInstruction() {
      this.edit_instruction = false;
      this.add_instruction = true;
      this.form = {
        name: "",
        url: "",
        token: "",
      };
      this.login();
      this.getPatientDischargeInstructions();
    },
    closeInstruction() {
      this.edit_instruction = false;
      this.add_instruction = false;
      this.form = {
        name: "",
        url: "",
        token: "",
      };
      this.login();
      this.getPatientDischargeInstructions();
    },
    getPatientDischargeInstructions() {
      axios
        .get("/api/v1/patient-discharge-instructions/" + this.token, {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then((response) => (this.instructions = response.data))
        .catch((error) => {
          console.log(error);
          if (error.response.status == 401) {
            this.$router.push({
              name: "logout",
            });
          }
        });
    },
    editInstruction(id) {
      this.add_instruction = false;
      this.edit_instruction = true;
      axios
        .get("/api/v1/patient-discharge-instruction/" + id, {
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
    store() {
      this.loading = true;
      axios
        .post("/api/patient-discharge-instruction", this.form)
        .then(() => {
          this.$router.push({
            name: "patient-discharge-instruction",
          });
          this.form = {
            name: "",
            url: "",
            token: "",
          };
          this.add_instruction = false;
          this.login();
          this.getPatientDischargeInstructions();
          Toast.fire({
            icon: "success",
            title: "Patient Discharge Instruction  successfully added",
          });
        })
        .catch((error) => (this.errors = error.response.data.errors))
        .finally(() => {
          this.loading = false;
        });
    },
    update() {
      this.loading = true;
      axios
        .patch("/api/patient-discharge-instruction/" + this.form.id, this.form)
        .then(() => {
          this.$router.push({
            name: "patient-discharge-instruction",
          });
          this.form = {
            name: "",
            url: "",
            token: "",
          };
          this.edit_instruction = false;
          this.add_instruction = false;
          this.login();
          this.getPatientDischargeInstructions();
          Toast.fire({
            icon: "success",
            title: "Patient Discharge Instruction  successfully updated",
          });
        })
        .catch((error) => (this.errors = error.response.data.errors))
        .finally(() => {
          this.loading = false;
        });
    },
    deleteInstruction(id) {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          axios
            .delete("/api/patient-discharge-instruction/" + id)
            .then(() => {
              this.instructions = this.instructions.filter((instruction) => {
                return instruction.id != id;
              });
            })
            .catch(() => {
              this.$router.push({
                name: "patient-discharge-instruction",
              });
              this.login();
              this.getPatientDischargeInstructions();
            });
          Swal.fire(
            "Deleted!",
            "A patient discharge instruction has been deleted.",
            "success"
          );
        }
      });
    },
  },
};
</script>
