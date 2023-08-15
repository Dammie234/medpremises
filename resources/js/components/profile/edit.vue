<template>
  <div class="main">
    <!-- BEGIN: Mobile Menu -->
    <mobile-menu></mobile-menu>
    <!-- END: Mobile Menu -->
    <div class="flex">
      <!-- BEGIN: Side Menu -->
      <side-menu page="dashboard"></side-menu>
      <!-- END: Side Menu -->
      <!-- BEGIN: Content -->
      <div class="content">
        <!-- BEGIN: Top Bar -->
        <top-bar title="Edit Facility Signature"></top-bar>
        <!-- END: Top Bar -->
        <div class="intro-y flex items-center mt-8">
          <h2 class="text-lg font-medium mr-auto">Facility Setting</h2>
        </div>
        <div class="grid grid-cols-12 gap-6">
          <!-- BEGIN: Profile Menu -->
          <div
            class="col-span-12 lg:col-span-3 xxl:col-span-3 flex lg:block flex-col-reverse"
          >
            <setting page="Facility Setting"></setting>
          </div>
          <!-- END: Profile Menu -->
          <div class="col-span-12 lg:col-span-9 xxl:col-span-9">
            <!-- BEGIN: Display Information -->
            <div class="intro-y box lg:mt-5">
              <div
                class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5"
              >
                <h2 class="font-medium text-base mr-auto">Personal Information</h2>
              </div>
              <div class="p-5">
                <div class="flex flex-col-reverse xl:flex-row flex-col">
                  <form
                    @submit.prevent="updateFacilityManager"
                    class="flex-1 mt-6 xl:mt-0"
                  >
                    <div class="grid grid-cols-12 gap-x-5">
                      <div class="col-span-12 xl:col-span-12">
                        <div>
                          <label for="name" class="form-label">Display Name</label>
                          <input
                            id="name"
                            type="text"
                            class="form-control"
                            placeholder="Input text"
                            v-model="form.name"
                            disabled
                          />
                        </div>
                      </div>
                      <div class="col-span-12 xl:col-span-12 mt-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input
                          id="email"
                          type="email"
                          class="form-control"
                          v-model="form.email"
                          disabled
                        />
                      </div>
                      <div
                        class="col-span-12 xl:col-span-12 mt-3"
                        v-if="form.role == 'Medical Staff'"
                      >
                        <label for="nin_number" class="form-label">NIN Number</label>
                        <input
                          id="nin_number"
                          type="text"
                          class="form-control"
                          v-model="form.nin_number"
                          disabled
                        />
                      </div>
                      <div class="col-span-12 xl:col-span-12 mt-3">
                        <label for="role" class="form-label">Role</label>
                        <input
                          id="role"
                          type="text"
                          class="form-control"
                          v-model="form.role"
                          disabled
                        />
                      </div>
                      <div
                        class="col-span-12 xl:col-span-12 mt-3"
                        v-if="form.job_type == 'Medical Officer'"
                      >
                        <label for="mdcn_number" class="form-label">MDCN Number</label>
                        <input
                          id="mdcn_number"
                          disabled
                          type="text"
                          class="form-control"
                          v-model="form.mdcn_number"
                        />
                      </div>
                      <div
                        class="col-span-12 xl:col-span-12 mt-3"
                        v-if="form.job_type == 'Pharmacist'"
                      >
                        <label for="pcn_number" disabled class="form-label"
                          >PCN Number</label
                        >
                        <input
                          id="pcn_number"
                          type="text"
                          class="form-control"
                          v-model="form.pcn_number"
                        />
                      </div>
                      <div
                        class="col-span-12 xl:col-span-12 mt-3"
                        v-if="form.role == 'Medical Staff'"
                      >
                        <label for="nin_number" class="form-label">NIN Number</label>
                        <input
                          id="nin_number"
                          disabled
                          type="text"
                          class="form-control"
                          v-model="form.nin_number"
                        />
                      </div>
                    </div>
                    <!-- <button type="submit" class="btn btn-primary w-20 mt-3">Save</button> -->
                  </form>
                  <form
                    @submit.prevent="updateProfilePicture"
                    class="w-52 mx-auto xl:mr-0 xl:ml-6"
                    enctype="multipart/form-data"
                  >
                    <div
                      class="border-2 border-dashed shadow-sm border-gray-200 dark:border-dark-5 rounded-md p-5"
                    >
                      <div class="h-40 relative image-fit cursor-pointer zoom-in mx-auto">
                        <img
                          class="rounded-md"
                          alt="Rubick Tailwind HTML Admin Template"
                          v-if="images.profile_picture"
                          :src="images.profile_picture"
                        />
                        <img
                          class="rounded-md"
                          alt="Rubick Tailwind HTML Admin Template"
                          v-else
                          :src="'../../' + form.profile_picture"
                        />
                        <div
                          title="Remove this profile photo?"
                          class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-theme-6 right-0 top-0 -mr-2 -mt-2"
                        >
                          <i data-feather="x" class="w-4 h-4"></i>
                        </div>
                      </div>
                      <div
                        class="mx-auto cursor-pointer relative mt-5"
                        :disabed="loading_p"
                      >
                        <input
                          type="file"
                          class="form-control"
                          @change="onFileSelectedPicture"
                        />
                        <button type="submit" class="btn btn-primary w-full">
                          Change Photo
                        </button>
                        <loading v-if="loading_p == true"></loading>
                        <div
                          class="text-danger font-medium text-xs mt-1"
                          v-if="errors.profile_picture"
                        >
                          {{ errors.profile_picture[0] }}
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <!-- END: Display Information -->
            <!-- BEGIN: Personal Information -->
            <div class="intro-y box mt-5">
              <div
                class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5"
              >
                <h2 class="font-medium text-base mr-auto">Biodata</h2>
              </div>
              <form @submit.prevent="updateBiodata" class="p-5">
                <div class="grid grid-cols-12 gap-x-5" :disabled="loading">
                  <div class="col-span-12 xl:col-span-3 mt-3">
                    <label for="gender" class="form-label">Gender</label>
                    <select id="state" class="form-select" v-model="form.gender">
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
                  <div class="col-span-12 xl:col-span-3 mt-3">
                    <label for="date_of_birth" class="form-label">Date of Birth</label>
                    <input
                      id="date_of_birth"
                      type="date"
                      class="form-control"
                      v-model="form.date_of_birth"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.date_of_birth"
                    >
                      {{ errors.date_of_birth[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-3 mt-3">
                    <label for="birth_place" class="form-label">Birth Place</label>
                    <input
                      id="birth_place"
                      type="text"
                      class="form-control"
                      v-model="form.birth_place"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.birth_place"
                    >
                      {{ errors.birth_place[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-3 mt-3">
                    <label for="marital_status" class="form-label">Marital Status</label>
                    <v-select
                      :options="statuses"
                      v-model="form.marital_status"
                    ></v-select>
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.marital_status"
                    >
                      {{ errors.marital_status[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-3 mt-3">
                    <label for="religion" class="form-label">Religion</label>
                    <v-select :options="religions" v-model="form.religion"></v-select>
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.religion"
                    >
                      {{ errors.religion[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-6 mt-3">
                    <label for="address" class="form-label">Address</label>
                    <vue-google-autocomplete
                      ref="address"
                      id="map"
                      required
                      classname="form-control"
                      placeholder="Search Address, mouse down and press enter once found"
                      v-on:placechanged="getAddress"
                      v-on:error="handleError"
                      types=""
                      country="ng"
                    >
                    </vue-google-autocomplete>
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.address"
                    >
                      {{ errors.address[0] }}
                    </div>
                  </div>

                  <div class="col-span-12 xl:col-span-3 mt-3">
                    <label for="home_phone" class="form-label">Phone (Home)</label>
                    <input
                      id="home_phone"
                      type="text"
                      class="form-control"
                      v-model="form.home_phone"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.home_phone"
                    >
                      {{ errors.home_phone[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-3 mt-3">
                    <label for="work_phone" class="form-label">Phone (Work)</label>
                    <input
                      id="work_phone"
                      type="text"
                      class="form-control"
                      v-model="form.work_phone"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.work_phone"
                    >
                      {{ errors.work_phone[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-3 mt-3">
                    <label for="mobile_phone" class="form-label">Phone (Mobile)</label>
                    <input
                      id="mobile_phone"
                      type="text"
                      class="form-control"
                      v-model="form.mobile_phone"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.mobile_phone"
                    >
                      {{ errors.mobile_phone[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-3 mt-3">
                    <label for="skype_id" class="form-label">Skype ID</label>
                    <input
                      id="skype_id"
                      type="text"
                      class="form-control"
                      v-model="form.skype_id"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.skype_id"
                    >
                      {{ errors.skype_id[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-3 mt-3">
                    <label for="father_name" class="form-label">Father's Name</label>
                    <input
                      id="father_name"
                      type="text"
                      class="form-control"
                      v-model="form.father_name"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.father_name"
                    >
                      {{ errors.father_name[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-3 mt-3">
                    <label for="mother_name" class="form-label">Mother's Name</label>
                    <input
                      id="mother_name"
                      type="text"
                      class="form-control"
                      v-model="form.mother_name"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.mother_name"
                    >
                      {{ errors.mother_name[0] }}
                    </div>
                  </div>
                </div>
                <div class="flex justify-end mt-4">
                  <button type="submit" class="btn btn-primary w-20">Save</button>
                  <loading v-if="loading == true"></loading>
                </div>
              </form>
            </div>
            <!-- END: Personal Information -->

            <!-- BEGIN: Education -->
            <div class="intro-y box mt-5 pb-5" v-if="user.role != 'Patient'">
              <div
                class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5"
              >
                <h2 class="font-medium text-base mr-auto">Education</h2>
              </div>
              <div v-for="(education, index) in educations" :key="index">
                <form @submit.prevent="updateEducation(education)" class="p-5">
                  <div class="grid grid-cols-12 gap-x-5" :disabled="loading_e">
                    <div class="col-span-12 xl:col-span-6 mt-3">
                      <label for="school_name" class="form-label">School Name</label>
                      <input
                        id="school_name"
                        required
                        type="text"
                        class="form-control"
                        v-model="education.school_name"
                      />
                    </div>
                    <div class="col-span-12 xl:col-span-3 mt-3">
                      <label for="from" class="form-label">From</label>
                      <input
                        id="from"
                        required
                        type="text"
                        class="form-control"
                        v-model="education.from"
                      />
                    </div>
                    <div class="col-span-12 xl:col-span-3 mt-3">
                      <label for="to" class="form-label">To</label>
                      <input
                        id="to"
                        required
                        type="text"
                        class="form-control"
                        v-model="education.to"
                      />
                    </div>
                    <div class="col-span-12 xl:col-span-4 mt-3">
                      <label for="school_address" class="form-label"
                        >School Address</label
                      >
                      <input
                        id="school_address"
                        required
                        type="text"
                        class="form-control"
                        v-model="education.school_address"
                      />
                    </div>
                    <div class="col-span-12 xl:col-span-4 mt-3">
                      <label for="studied_course" class="form-label"
                        >Studied Course</label
                      >
                      <input
                        id="studied_course"
                        required
                        type="text"
                        class="form-control"
                        v-model="education.studied_course"
                      />
                    </div>
                    <div class="col-span-12 xl:col-span-4 mt-3">
                      <label for="graduated_with" class="form-label"
                        >Graduated With</label
                      >
                      <input
                        id="graduated_with"
                        required
                        type="text"
                        class="form-control"
                        v-model="education.graduated_with"
                      />
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary w-20 mt-3">Save</button>
                  <loading class="mt-3" v-if="loading_e == true"></loading>
                  <button
                    type="button"
                    v-if="index != 0"
                    @click="subtractEducation(education.id)"
                    class="btn btn-danger w-20 mt-3"
                  >
                    Remove
                  </button>
                  <button
                    v-if="education.graduated_with"
                    type="button"
                    class="btn btn-primary w-20 mt-3 ml-5"
                    @click.prevent="addEducation"
                  >
                    Add
                  </button>
                </form>
              </div>
            </div>
            <!-- END: Education -->
            <!-- BEGIN: Qualification -->
            <div class="intro-y box mt-5 pb-5" v-if="user.role == 'Medical Staff'">
              <div
                class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5"
              >
                <h2 class="font-medium text-base mr-auto">Professional Qualifications</h2>
              </div>
              <div v-for="(qualify, index) in qualifications" :key="index">
                <form @submit.prevent="updateQualification(qualify)" class="p-5">
                  <div class="grid grid-cols-12 gap-x-5" :disabled="loading_q">
                    <div class="col-span-12 xl:col-span-4 mt-3">
                      <label for="qualification" class="form-label">Qualification</label>
                      <input
                        id="qualification"
                        required
                        type="text"
                        class="form-control"
                        v-model="qualify.qualification"
                      />
                    </div>
                    <div class="col-span-12 xl:col-span-4 mt-3">
                      <label for="licensing_body" class="form-label"
                        >Licensing Body</label
                      >
                      <input
                        id="licensing_body"
                        required
                        type="text"
                        class="form-control"
                        v-model="qualify.licensing_body"
                      />
                    </div>
                    <div class="col-span-12 xl:col-span-4 mt-3">
                      <label for="year" class="form-label">Year</label>
                      <input
                        id="year"
                        required
                        type="text"
                        class="form-control"
                        v-model="qualify.year"
                      />
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary w-20 mt-3">Save</button>
                  <button
                    type="button"
                    v-if="index != 0"
                    @click="subtractQualification(qualify.id)"
                    class="btn btn-danger w-20 mt-3"
                  >
                    Remove
                  </button>
                </form>
              </div>
              <div class="mt-3 ml-5">
                <button
                  type="button"
                  class="btn btn-primary w-20"
                  @click.prevent="addQualification"
                >
                  Add
                </button>
                <loading v-if="loading_q == true"></loading>
              </div>
            </div>
            <!-- END: Qualification -->
            <!-- BEGIN: Experience -->
            <div class="intro-y box mt-5 pb-5" v-if="user.role == 'Medical Staff'">
              <div
                class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5"
              >
                <h2 class="font-medium text-base mr-auto">Professional Experiences</h2>
              </div>
              <div v-for="(exp, index) in experiences" :key="index">
                <form @submit.prevent="updateExperience(exp)" class="p-5">
                  <div class="grid grid-cols-12 gap-x-5" :disabled="loading_ex">
                    <div class="col-span-12 xl:col-span-4 mt-3">
                      <label for="facility_name" class="form-label">Facility Name</label>
                      <input
                        id="facility_name"
                        required
                        type="text"
                        class="form-control"
                        v-model="exp.facility_name"
                      />
                    </div>
                    <div class="col-span-12 xl:col-span-4 mt-3">
                      <label for="address" class="form-label">Address</label>
                      <input
                        id="address"
                        required
                        type="text"
                        class="form-control"
                        v-model="exp.address"
                      />
                    </div>
                    <div class="col-span-12 xl:col-span-4 mt-3">
                      <label for="from" class="form-label">From</label>
                      <input
                        id="from"
                        required
                        type="text"
                        class="form-control"
                        v-model="exp.from"
                      />
                    </div>
                    <div class="col-span-12 xl:col-span-4 mt-3">
                      <label for="to" class="form-label">To</label>
                      <input
                        id="to"
                        required
                        type="text"
                        class="form-control"
                        v-model="exp.to"
                      />
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary w-20 mt-3">Save</button>
                  <loading class="mt-3" v-if="loading_ex == true"></loading>
                  <button
                    type="button"
                    v-if="index != 0"
                    @click="subtractExperience(exp.id)"
                    class="btn btn-danger w-20 mt-3"
                  >
                    Remove
                  </button>
                </form>
              </div>
              <div class="mt-3 ml-5">
                <button
                  type="button"
                  class="btn btn-primary w-20"
                  @click.prevent="addExperience"
                >
                  Add
                </button>
              </div>
            </div>
            <!-- END: Experience -->
          </div>
        </div>
      </div>
      <!-- END: Content -->
    </div>
  </div>
</template>

<script>
import VueGoogleAutocomplete from "vue-google-autocomplete";
export default {
  name: "edit-profile",
  components: { VueGoogleAutocomplete },
  data() {
    return {
      id: null,
      token: null,
      form: {
        gender: "",
        date_of_birth: "",
        marital_status: "",
        religion: "",
        address: "",
        city: "",
        state: "",
        postal_code: "",
        url: "",
        country: "",
        local_government_area: "",
        gps_coordinate_longtitude: "",
        gps_coordinate_latitude: "",
        home_phone: "",
        work_phone: "",
        mobile_phone: "",
        skype_id: "",
        profile_picture: "",
        token: "",
        birth_place: "",
        mother_name: "",
        father_name: "",
      },

      images: {
        profile_picture: "",
      },
      loading: false,
      loading_k: false,
      loading_e: false,
      loading_ex: false,
      loading_p: false,
      loading_q: false,
      educations: [],
      qualifications: [],
      experiences: [],
      user: "",
      errors: {},
      address: {},
      statuses: ["Single", "Married", "Divorced", "Seperated", "Widow"],
      religions: [
        "Babism",
        "Baha i Faith",
        "Buddhism",
        "Celtic Polytheism",
        "Christianity",
        "Heathenism",
        "Hellenism",
        "Hinduism",
        "Italio-Roman Neopaganism",
        "Judaism",
        "Kemetism",
        "Muslim",
        "Semitic neopaganism",
        "Slavic neopaganism",
        "Sikhism",
        "Taoism",
        "Traditional (African)",
        "Wicca",
      ],
    };
  },

  created() {
    this.login();
    this.getStaff();
    this.getEducations();
    this.getQualifications();
    this.getUser();
    this.getExperiences();
  },
  methods: {
    login() {
      if (!User.loggedIn()) {
        this.$router.push({
          name: "logout",
        });
      } else {
        this.id = User.id();
        this.token = User.token();
        this.form.token = User.token();
      }
    },
    getAddress(address, placeResultData, id) {
      this.address = address;
      this.form.address = placeResultData.formatted_address;
      this.form.city = placeResultData.address_components[3].long_name;
      this.form.state = placeResultData.address_components[5].long_name;
      this.form.local_government_area = placeResultData.address_components[4].long_name;
      this.form.country = address.country;
      this.form.postal_code = address.postal_code;
      this.form.gps_coordinate_latitude = address.latitude;
      this.form.gps_coordinate_longtitude = address.longitude;
      this.form.url = placeResultData.url;
      console.log(address);
    },

    handleError(error) {
      alert(error);
    },
    getUser() {
      axios
        .get("/api/v1/user/" + this.id, {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then((response) => (this.user = response.data))
        .catch((error) => {
          console.log(error);
          if (error.response.status == 401) {
            this.$router.push({
              name: "logout",
            });
          }
        });
    },

    getStaff() {
      axios
        .get("/api/v1/staff/" + this.token, {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then((response) => (this.form = response.data.biodata))
        .catch((error) => {
          console.log(error);
          if (error.response.status == 401) {
            this.$router.push({
              name: "logout",
            });
          }
        });
    },
    getEducations() {
      axios
        .get("/api/v1/staff/" + this.token, {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then((response) => (this.educations = response.data.educations))
        .catch((error) => {
          console.log(error);
          if (error.response.status == 401) {
            this.$router.push({
              name: "logout",
            });
          }
        });
    },
    getQualifications() {
      axios
        .get("/api/v1/staff/" + this.token, {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then((response) => (this.qualifications = response.data.qualifications))
        .catch((error) => {
          console.log(error);
          if (error.response.status == 401) {
            this.$router.push({
              name: "logout",
            });
          }
        });
    },
    getExperiences() {
      axios
        .get("/api/v1/staff/" + this.token, {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then((response) => (this.experiences = response.data.experiences))
        .catch((error) => {
          console.log(error);
          if (error.response.status == 401) {
            this.$router.push({
              name: "logout",
            });
          }
        });
    },
    onFileSelectedPicture(event) {
      let file = event.target.files[0];
      if (file.size > 1048770) {
        Notification.image_validation();
      } else {
        let reader = new FileReader();
        reader.readAsDataURL(file);

        let type = file.type;
        let name = file.name;
        reader.onload = (event) => {
          this.images.profile_picture = event.target.result;
        };
      }
    },
    updateProfilePicture() {
      this.loading_p = true;
      axios
        .patch("/api/update-profile-picture/" + this.token, this.images)
        .then((res) => {
          //User.responseAfterLogin(res)
          Toast.fire({
            icon: "success",
            title: "Profile Picture Updated",
          });
          this.$router.push({
            name: "edit-profile",
          });
          this.getStaff();
          this.images = {
            profile_picture: "",
          };
          //document.location.href = "/login"
        })
        .catch((error) => (this.errors = error.response.data.errors))
        .finally(() => {
          this.loading_p = false;
        });
    },
    updateBiodata() {
      this.loading = true;
      axios
        .patch("/api/update-biodata/" + this.token, this.form)
        .then((res) => {
          //User.responseAfterLogin(res)
          Toast.fire({
            icon: "success",
            title: "Biodata Updated",
          });
          this.$router.push({
            name: "edit-profile",
          });
          this.getStaff();
          this.images = {
            profile_picture: "",
          };
          //document.location.href = "/login"
        })
        .catch((error) => (this.errors = error.response.data.errors))
        .finally(() => {
          this.loading = false;
        });
    },
    updateKin() {
      this.loading_k = true;
      axios
        .patch("/api/update-kin/" + this.token, this.kin)
        .then((res) => {
          //User.responseAfterLogin(res)
          Toast.fire({
            icon: "success",
            title: "Next of Kin Updated",
          });
          this.$router.push({
            name: "edit-profile",
          });
          this.getStaff();
          this.images = {
            profile_picture: "",
          };
          //document.location.href = "/login"
        })
        .catch((error) => (this.errors = error.response.data.errors))
        .finally(() => {
          this.loading_k = false;
        });
    },
    updateEducation(education) {
      this.loading_e = true;
      axios
        .patch("/api/update-education/" + education.id, education)
        .then((res) => {
          //User.responseAfterLogin(res)
          Toast.fire({
            icon: "success",
            title: "Education Updated",
          });
          this.$router.push({
            name: "edit-profile",
          });
          this.getStaff();
          this.getEducations();
        })
        .catch((error) => (this.errors = error.response.data.errors))
        .finally(() => {
          this.loading_e = false;
        });
    },
    addEducation() {
      axios
        .get("/api/add-education/" + this.token)
        .then()
        .catch();
      this.getEducations();
    },

    subtractEducation(id) {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, remove it!",
      }).then((result) => {
        if (result.isConfirmed) {
          axios
            .get("/api/subtract-education/" + id)
            .then(() => {
              this.educations = this.educations.filter((education) => {
                return education.id != id;
              });
            })
            .catch(() => {
              this.$router.push({
                name: "edit-profile",
              });
              this.getEducations();
            });
          Swal.fire(
            "Removed!",
            "A professional qualification has been removed.",
            "success"
          );
        }
      });
    },
    addQualification() {
      axios
        .get("/api/add-qualification/" + this.token)
        .then()
        .catch();
      this.getQualifications();
    },
    subtractQualification(id) {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, remove it!",
      }).then((result) => {
        if (result.isConfirmed) {
          axios
            .get("/api/subtract-qualification/" + id)
            .then(() => {
              this.qualifications = this.qualifications.filter((qualification) => {
                return qualification.id != id;
              });
            })
            .catch(() => {
              this.$router.push({
                name: "edit-profile",
              });
              this.getQualifications();
            });
          Swal.fire(
            "Removed!",
            "A professional qualification has been removed.",
            "success"
          );
        }
      });
    },
    updateQualification(qualify) {
      this.loading_q = true;
      axios
        .patch("/api/update-qualification/" + qualify.id, qualify)
        .then((res) => {
          //User.responseAfterLogin(res)
          Toast.fire({
            icon: "success",
            title: "Professional Qualification Updated",
          });
          this.$router.push({
            name: "edit-profile",
          });
          this.getStaff();
          this.getQualifications();
        })
        .catch((error) => (this.errors = error.response.data.errors))
        .finally(() => {
          this.loading_q = false;
        });
    },
    addExperience() {
      axios
        .get("/api/add-experience/" + this.token)
        .then()
        .catch();
      this.getExperiences();
    },
    subtractExperience(id) {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, remove it!",
      }).then((result) => {
        if (result.isConfirmed) {
          axios
            .get("/api/subtract-experience/" + id)
            .then(() => {
              this.experiences = this.experiences.filter((experience) => {
                return experience.id != id;
              });
            })
            .catch(() => {
              this.$router.push({
                name: "edit-profile",
              });
              this.getExperiences();
            });
          Swal.fire("Removed!", "A professional experience has been removed.", "success");
        }
      });
    },
    updateExperience(exp) {
      this.loading_ex = true;
      axios
        .patch("/api/update-experience/" + exp.id, exp)
        .then((res) => {
          //User.responseAfterLogin(res)
          Toast.fire({
            icon: "success",
            title: "Professional Experience Updated",
          });
          this.$router.push({
            name: "edit-profile",
          });
          this.getStaff();
          this.getExperiences();
        })
        .catch((error) => (this.errors = error.response.data.errors))
        .finally(() => {
          this.loading_ex = false;
        });
    },
  },
};
</script>

<style scoped></style>
