<template>
  <div class="main">
    <!-- BEGIN: Mobile Menu -->
    <patient-mobile-menu></patient-mobile-menu>
    <!-- END: Mobile Menu -->
    <div class="flex">
      <!-- BEGIN: Side Menu -->
      <patient-side-menu page="profile"></patient-side-menu>
      <!-- END: Side Menu -->
      <!-- BEGIN: Content -->
      <div class="content">
        <!-- BEGIN: Top Bar -->
        <patient-top-bar title="Profile Setting"></patient-top-bar>
        <!-- END: Top Bar -->
        <div class="intro-y flex items-center mt-8">
          <h2 class="text-lg font-medium mr-auto">Profile Setting</h2>
        </div>
        <div class="grid grid-cols-12 gap-6">
          <!-- BEGIN: Profile Menu -->
          <div
            class="col-span-12 lg:col-span-3 xxl:col-span-3 flex lg:block flex-col-reverse"
          >
            <patient-setting page="Profile Setting"></patient-setting>
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
                          v-if="images.profile_picture"
                          :src="images.profile_picture"
                        />
                        <img
                          class="rounded-md"
                          v-else-if="form.profile_picture"
                          :src="'../../' + form.profile_picture"
                        />
                        <img
                          v-else
                          src="https://img.icons8.com/ios-glyphs/200/null/guest-male.png"
                          class="rounded-md"
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
                  <div class="col-span-12 xl:col-span-4 mt-3">
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
                  <div class="col-span-12 xl:col-span-4 mt-3">
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
                  <div class="col-span-12 xl:col-span-4 mt-3">
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
                  <div class="col-span-12 xl:col-span-4 mt-3">
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
                  <div class="col-span-12 xl:col-span-4 mt-3">
                    <label for="religion" class="form-label">Religion</label>
                    <v-select :options="religions" v-model="form.religion"></v-select>
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.religion"
                    >
                      {{ errors.religion[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-4 mt-3">
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
                  <div class="col-span-12 xl:col-span-8 mt-3">
                    <label for="address" class="form-label">Address</label>
                    <vue-google-autocomplete
                      ref="address"
                      id="map"
                      classname="form-control"
                      placeholder="Search Address, mouse down and press enter once found"
                      v-on:placechanged="getAddress"
                      v-on:error="handleError"
                      types=""
                      country="ng"
                    >
                    </vue-google-autocomplete>
                    <small class="text-success" v-if="form.address">{{
                      form.address
                    }}</small>
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.address"
                    >
                      {{ errors.address[0] }}
                    </div>
                  </div>

                  <div class="col-span-12 xl:col-span-4 mt-3">
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
                  <div class="col-span-12 xl:col-span-4 mt-3">
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
                  <div class="col-span-12 xl:col-span-4 mt-3">
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

                  <div class="col-span-12 xl:col-span-4 mt-3">
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
                  <div class="col-span-12 xl:col-span-4 mt-3">
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
            <!-- BEGIN: Kin -->
            <div class="intro-y box mt-5 pb-5">
              <div
                class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5"
              >
                <h2 class="font-medium text-base mr-auto">Next of Kin</h2>
              </div>
              <form @submit.prevent="updateKin" class="p-5">
                <div class="grid grid-cols-12 gap-x-5" :disabled="loading_k">
                  <div class="col-span-12 xl:col-span-6 mt-3">
                    <label for="name1" class="form-label">Name</label>
                    <input
                      id="name1"
                      required
                      type="text"
                      class="form-control"
                      v-model="kin.name"
                    />
                  </div>
                  <div class="col-span-12 xl:col-span-3 mt-3">
                    <label for="gender1" class="form-label">Gender</label>
                    <select id="gender1" class="form-select" v-model="kin.gender">
                      <option value="Male">Male</option>
                      <option value="Female">Female</option>
                    </select>
                  </div>
                  <div class="col-span-12 xl:col-span-3 mt-3">
                    <label for="relationship1" class="form-label">Relation</label>
                    <select id="relationship1" class="form-select" v-model="kin.relation">
                      <option value="Brother">Brother</option>
                      <option value="Sister">Sister</option>
                      <option value="Son">Son</option>
                      <option value="Daughter">Daughter</option>
                    </select>
                  </div>
                  <div class="col-span-12 xl:col-span-4 mt-3">
                    <label for="kin_address" class="form-label">Address</label>
                    <input
                      id="kin_address"
                      type="text"
                      class="form-control"
                      v-model="kin.address"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.address"
                    >
                      {{ errors.address[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-4 mt-3">
                    <label for="kin_city" class="form-label">City</label>
                    <input
                      id="kin_city"
                      type="text"
                      class="form-control"
                      v-model="kin.city"
                    />
                    <div class="text-danger font-medium text-xs mt-1" v-if="errors.city">
                      {{ errors.city[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-4 mt-3">
                    <label for="kin_state" class="form-label">State</label>
                    <input
                      id="kin_state"
                      type="text"
                      class="form-control"
                      v-model="kin.state"
                    />
                    <div class="text-danger font-medium text-xs mt-1" v-if="errors.state">
                      {{ errors.state[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-4 mt-3">
                    <label for="kin_postal_code" class="form-label">Postal Code</label>
                    <input
                      id="kin_postal_code"
                      type="text"
                      class="form-control"
                      v-model="kin.postal_code"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.postal_code"
                    >
                      {{ errors.postal_code[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-4 mt-3">
                    <label for="home_phone1" class="form-label">Phone (Home)</label>
                    <input
                      id="home_phone1"
                      type="text"
                      class="form-control"
                      v-model="kin.home_phone"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.home_phone"
                    >
                      {{ errors.home_phone[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-4 mt-3">
                    <label for="work_phone1" class="form-label">Phone (Work)</label>
                    <input
                      id="work_phone1"
                      type="text"
                      class="form-control"
                      v-model="kin.work_phone"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.work_phone"
                    >
                      {{ errors.work_phone[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-4 mt-3">
                    <label for="mobile_phone1" class="form-label">Phone (Mobile)</label>
                    <input
                      id="mobile_phone1"
                      type="text"
                      class="form-control"
                      v-model="kin.mobile_phone"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.mobile_phone"
                    >
                      {{ errors.mobile_phone[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-6 mt-3">
                    <label for="email1" class="form-label">Email Address</label>
                    <input
                      id="email1"
                      type="email"
                      class="form-control"
                      v-model="kin.email"
                    />
                    <div class="text-danger font-medium text-xs mt-1" v-if="errors.email">
                      {{ errors.email[0] }}
                    </div>
                  </div>
                </div>
                <div class="mt-3">
                  <button type="submit" class="btn btn-primary w-20">Save</button>
                  <loading v-if="loading_k == true"></loading>
                </div>
              </form>
            </div>
            <!-- END: Kin -->
            <!-- BEGIN: Spouse Information -->

            <div
              class="intro-y box mt-5 pb-5"
              v-if="
                form.marital_status == 'Married' &&
                !spouse_information.token &&
                spouse_form == true
              "
            >
              <div
                class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5"
              >
                <h2 class="font-medium text-base mr-auto">Spouse Information</h2>
              </div>
              <form class="p-5" @submit.prevent="updateSpouse">
                <div class="grid grid-cols-12 gap-x-5" :disabled="loading_spouse">
                  <div class="col-span-12 xl:col-span-6">
                    <div class="flex flex-col sm:flex-row mt-2">
                      <label class="mr-2">Is your spouse a member of MedPremises?</label>
                      <div class="form-check mr-2">
                        <input
                          id="radio-switch-4"
                          class="form-check-input"
                          type="radio"
                          name="membership"
                          v-model="spouse.membership"
                          value="Yes"
                        />
                        <label class="form-check-label" for="radio-switch-4">Yes</label>
                      </div>
                      <div class="form-check mr-2 mt-2 sm:mt-0">
                        <input
                          id="radio-switch-5"
                          class="form-check-input"
                          type="radio"
                          name="membership"
                          v-model="spouse.membership"
                          value="No"
                        />
                        <label class="form-check-label" for="radio-switch-5">No</label>
                      </div>
                    </div>
                  </div>
                  <div
                    class="col-span-12 xl:col-span-6 lg:col-span-4 md:col-span-3"
                    v-if="spouse.membership == 'Yes'"
                  >
                    <label for="patient" class="form-label">Patient </label>
                    <vue-single-select
                      name="maybe"
                      placeholder="pick a patient"
                      you-want-to-select-a-post="ok"
                      v-model="spouse.patient"
                      out-of-all-these-posts="makes sense"
                      :options="patients"
                      :required="true"
                      a-post-has-an-id="good for search and display"
                      the-post-has-a-title="make sure to show these"
                      option-label="email"
                    ></vue-single-select>
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.patient"
                    >
                      {{ errors.patient[0] }}
                    </div>
                  </div>
                  <div class="col-span-12 xl:col-span-4" v-else></div>
                  <div
                    class="col-span-12 xl:col-span-4 mt-3"
                    v-if="spouse.membership == 'No'"
                  >
                    <label for="spouse_name" class="form-label">Spouse Full Name</label>
                    <input
                      id="spouse_name"
                      type="text"
                      class="form-control"
                      v-model="spouse.spouse_name"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.spouse_name"
                    >
                      {{ errors.spouse_name[0] }}
                    </div>
                  </div>
                  <div
                    class="col-span-12 xl:col-span-4 mt-3"
                    v-if="spouse.membership == 'No'"
                  >
                    <label for="spouse_email" class="form-label"
                      >Spouse Email Address</label
                    >
                    <input
                      id="spouse_email"
                      type="email"
                      class="form-control"
                      v-model="spouse.spouse_email"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.spouse_email"
                    >
                      {{ errors.spouse_email[0] }}
                    </div>
                  </div>
                  <div
                    class="col-span-12 xl:col-span-4 mt-3"
                    v-if="spouse.membership == 'No'"
                  >
                    <label for="spouse_phone_number" class="form-label"
                      >Spouse Phone Number</label
                    >
                    <input
                      id="spouse_phone_number"
                      type="text"
                      class="form-control"
                      v-model="spouse.spouse_phone_number"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.spouse_phone_number"
                    >
                      {{ errors.spouse_phone_number[0] }}
                    </div>
                  </div>
                  <div
                    class="col-span-12 xl:col-span-4 mt-3"
                    v-if="spouse.membership == 'No' && form.gender == 'Male'"
                  >
                    <label for="" class="form-label">Spouse Gender</label>
                    <input
                      id=""
                      type="text"
                      class="form-control"
                      v-model="gender.male"
                      disabled
                    />
                  </div>
                  <div
                    class="col-span-12 xl:col-span-4 mt-3"
                    v-if="spouse.membership == 'No' && form.gender == 'Female'"
                  >
                    <label for="" class="form-label">Spouse Gender</label>
                    <input
                      id=""
                      type="text"
                      class="form-control"
                      v-model="gender.male"
                      disabled
                    />
                  </div>
                </div>
                <div class="mt-3">
                  <button type="submit" class="btn btn-primary w-20">Save</button>
                  <loading v-if="loading_spouse == true"></loading>
                </div>
              </form>
            </div>
            <!-- End: Spouse Information -->
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
      gender: {
        male: "Male",
        female: "Female",
      },
      kin: {
        name: "",
        email: "",
        relation: "",
        gender: "",
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
      },
      spouse: {
        membership: "",
        patient: "",
        spouse_name: "",
        spouse_email: "",
        spouse_phone_number: "",

        gender: "",
      },
      spouse_information: "",
      images: {
        profile_picture: "",
      },
      spouse_form: true,
      patients: [],
      loading: false,
      loading_k: false,
      loading_p: false,
      loading_spouse: false,
      user: "",
      errors: {},
      address: {},
      kin_address: {},
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
  mounted() {
    // To demonstrate functionality of exposed component functions
    // Here we make focus on the user input
    this.$refs.address.blur();
  },
  created() {
    this.login();
    this.getBiodata();
    this.getSpouseInformation();
    this.getUser();
    this.getData();
    this.getKin();
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
        this.form.id = Patient.id();
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
        .get("/api-patient/v1/patient/" + this.id, {
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
              name: "patient-logout",
            });
          }
        });
    },
    getData() {
      axios
        .get("/api-patient/v1/patients/" + this.id, {
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
              name: "patient-logout",
            });
          }
        });
    },
    getKin() {
      axios
        .get("/api-patient/v1/patient-next-of-kin/" + this.id, {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then((response) => (this.kin = response.data))
        .catch((error) => {
          console.log(error);
          if (error.response.status == 401) {
            this.$router.push({
              name: "patient-logout",
            });
          }
        });
    },
    getBiodata() {
      axios
        .get("/api-patient/v1/biodata/" + this.id, {
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
              name: "patient-logout",
            });
          }
        });
    },
    getSpouseInformation() {
      axios
        .get("/api-patient/v1/spouse-information/" + this.id, {
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
        .patch("/api-patient/update-patient-profile-picture/" + this.id, this.images)
        .then((res) => {
          Toast.fire({
            icon: "success",
            title: "Profile Picture Updated",
          });

          document.location.href = "/patient/profile/edit";
        })
        .catch((error) => (this.errors = error.response.data.errors))
        .finally(() => {
          this.loading_p = false;
        });
    },
    updateBiodata() {
      this.loading = true;
      axios
        .patch("/api-patient/update-patient-biodata/" + this.id, this.form)
        .then((res) => {
          Toast.fire({
            icon: "success",
            title: "Biodata Updated",
          });
          this.$router.push({
            name: "edit-patient-profile",
          });
          this.getStaff();
          this.images = {
            profile_picture: "",
          };
        })
        .catch((error) => (this.errors = error.response.data.errors))
        .finally(() => {
          this.loading = false;
        });
    },
    updateKin() {
      this.loading_k = true;
      axios
        .patch("/api-patient/update-kin/" + this.id, this.kin)
        .then((res) => {
          //User.responseAfterLogin(res)
          Toast.fire({
            icon: "success",
            title: "Next of Kin Updated",
          });
          this.$router.push({
            name: "edit-patient-profile",
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
    updateSpouse() {
      this.loading_spouse = true;
      axios
        .patch("/api-patient/spouse-information/" + this.id, this.spouse)
        .then((res) => {
          //User.responseAfterLogin(res)
          Toast.fire({
            icon: "success",
            title: "Spouse Information Updated",
          });
          this.$router.push({
            name: "edit-patient-profile",
          });
          this.spouse_form = false;
          this.getStaff();

          this.getSpouseInformation();
          //document.location.href = "/login"
        })
        .catch((error) => (this.errors = error.response.data.errors))
        .finally(() => {
          this.loading_spouse = false;
        });
    },
  },
};
</script>

<style scoped></style>
