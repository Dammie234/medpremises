<template>
  <div class="py-5">
    <!-- BEGIN: Mobile Menu -->
    <frontend-mobile-menu></frontend-mobile-menu>
    <!-- END: Mobile Menu -->
    <!-- BEGIN: Top Bar -->
    <frontend-top-bar page="Welcome"></frontend-top-bar>
    <!-- END: Top Bar -->
    <!-- BEGIN: Top Menu -->
    <top-nav page="frontpage" v-if="token"></top-nav>
    <!-- END: Top Menu -->
    <!-- BEGIN: Content -->
    <div class="content">
      <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 xl:col-span-9">
          <div class="grid grid-cols-12 gap-6">
            <!-- BEGIN: Post -->
            <div class="col-span-12 lg:col-span-8 xl:col-span-6 mt-6">
              <div class="intro-y block sm:flex items-center h-10">
                <h2 class="text-lg font-medium truncate mr-5">Posts</h2>
              </div>
              <div class="intro-y" v-if="posts.length != 0">
                <div class="intro-y" v-for="post in posts" :key="post.id">
                  <router-link
                    :to="{ name: 'frontend-post', params: { slug: post.slug } }"
                  >
                    <div class="box px-4 py-4 mb-3 flex items-center zoom-in">
                      <div
                        class="w-10 h-10 flex-none image-fit rounded-md overflow-hidden"
                      >
                        <img :src="post.featured_image" />
                      </div>
                      <div class="ml-4 mr-auto">
                        <div class="font-medium">{{ post.title }}</div>
                        <div class="text-slate-500 text-xs mt-0.5">
                          {{ post.categories }}
                        </div>
                        <div class="text-slate-500 text-xs mt-0.5">
                          Posted By {{ post.name }}
                        </div>
                        <div class="text-slate-500 text-xs mt-0.5">
                          {{ post.created_at | moment("from", "now") }}
                        </div>
                      </div>
                    </div>
                  </router-link>
                </div>

                <router-link
                  :to="{ name: 'frontend-posts' }"
                  class="intro-y w-full block text-center rounded-md py-4 border border-dotted border-slate-400 dark:border-darkmode-300 text-slate-500"
                  >View More</router-link
                >
              </div>
            </div>
            <!-- END: Post -->
            <!-- BEGIN: Pharmacy -->
            <div class="col-span-12 sm:col-span-6 lg:col-span-4 xl:col-span-3 mt-6">
              <pharmacy></pharmacy>
            </div>
            <!-- END: Pharmacy -->
            <!-- BEGIN: Laboratory -->
            <div class="col-span-12 sm:col-span-6 lg:col-span-4 xl:col-span-3 mt-6">
              <laboratory></laboratory>
            </div>
            <!-- END: Laboratory -->
            <!-- BEGIN: Search -->
            <div class="col-span-12 lg:col-span-8 mt-6">
              <div class="intro-y block sm:flex items-center h-10">
                <h2 class="text-lg font-medium truncate mr-5">
                  Search for Drugs in {{ city }} Pharmacies
                </h2>
              </div>
              <div class="intro-y box p-5 mt-12 sm:mt-5">
                <input
                  class="form-control mr-0 ml-3"
                  type="text"
                  v-model="search_drug"
                  placeholder="Seach Drug Name"
                />
                <div class="overflow-x-auto mt-3" v-if="search_drug">
                  <table class="table table-sm table-bordered table-hover text-xs">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>NAFDAC Number</th>
                        <th>Shelf Name</th>
                        <th>Prescription Slip</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Facility</th>
                        <th>Address</th>
                        <th>Phone</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="drug in filterSearchDrug" :key="drug.id">
                        <td>{{ drug.name }}</td>
                        <td>{{ drug.nafdac_number }}</td>
                        <td>{{ drug.shelf_name }}</td>
                        <td>
                          <button
                            v-if="drug.prescription_slip == false"
                            class="btn btn-sm btn-rounded btn-danger-soft w-10 mr-1 mb-2"
                          >
                            No
                          </button>
                          <button
                            v-else
                            class="btn btn-sm btn-rounded btn-success-soft w-10 mr-1 mb-2"
                          >
                            Yes
                          </button>
                        </td>
                        <td>{{ drug.total_quantity }}</td>
                        <td>&#8358;{{ drug.price | numeral("0,0.00") }}</td>
                        <td>
                          <router-link
                            :to="{
                              name: 'frontend-facility',
                              params: { slug: drug.slug },
                            }"
                            >{{ drug.registered_facility_name }}</router-link
                          >
                        </td>
                        <td>{{ drug.physical_location }}</td>
                        <td>{{ drug.phone_number }}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <a
                  href=""
                  v-if="search_drug"
                  class="intro-y mt-3 w-full block text-center rounded-md py-4 border border-dotted border-slate-400 dark:border-darkmode-300 text-slate-500"
                  >View More</a
                >
              </div>
              <div class="intro-y block sm:flex items-center h-10 mt-5">
                <h2 class="text-lg font-medium truncate mr-5">
                  Search for Medical Diagnostics &amp; Laboratory Tests Centres in
                  {{ city }}
                </h2>
              </div>
              <div class="intro-y box p-5 mt-12 sm:mt-5">
                <input
                  class="form-control mr-0 ml-3"
                  type="text"
                  v-model="search_lab"
                  placeholder="Seach Medical Diagnostic or Laboratory Test"
                />
                <div class="overflow-x-auto mt-3" v-if="search_lab">
                  <table class="table table-sm table-bordered table-hover text-xs">
                    <thead>
                      <tr>
                        <th>Test Name</th>

                        <th>Price</th>
                        <th>Facility</th>
                        <th>Address</th>
                        <th>Phone</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="lab in filterSearchLaboratory" :key="lab.id">
                        <td>
                          <a
                            :href="lab.url"
                            class="text-primary font-semibold"
                            target="_blank"
                            >{{ lab.test_name }}</a
                          >
                        </td>

                        <td>&#8358;{{ lab.price }}</td>
                        <td>
                          <router-link
                            :to="{
                              name: 'frontend-facility',
                              params: { slug: lab.slug },
                            }"
                            >{{ lab.registered_facility_name }}</router-link
                          >
                        </td>
                        <td>{{ lab.physical_location }}</td>
                        <td>{{ lab.phone_number }}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <a
                  href=""
                  v-if="search_lab"
                  class="intro-y mt-3 w-full block text-center rounded-md py-4 border border-dotted border-slate-400 dark:border-darkmode-300 text-slate-500"
                  >View More</a
                >
              </div>
              <div class="intro-y block sm:flex items-center h-10 mt-5">
                <h2 class="text-lg font-medium truncate mr-5">
                  Search for Medical Services of Hospitals in {{ city }}
                </h2>
              </div>
              <div class="intro-y box p-5 mt-12 sm:mt-5">
                <input
                  class="form-control mr-0 ml-3"
                  type="text"
                  v-model="search_medical_service"
                  placeholder="Seach Medical Services of Hospitals"
                />
                <div class="overflow-x-auto mt-3" v-if="search_medical_service">
                  <table class="table table-sm table-bordered table-hover text-xs">
                    <thead>
                      <tr>
                        <th>Service</th>
                        <th>Price</th>
                        <th>Facility</th>
                        <th>Address</th>
                        <th>Phone</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="medical in filterSearchMedicalService" :key="medical.id">
                        <td>{{ medical.name }}</td>
                        <td>&#8358;{{ medical.price }}</td>
                        <td>
                          <router-link
                            :to="{
                              name: 'frontend-facility',
                              params: { slug: medical.slug },
                            }"
                            >{{ medical.registered_facility_name }}</router-link
                          >
                        </td>
                        <td>{{ medical.physical_location }}</td>
                        <td>{{ medical.phone_number }}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <a
                  href=""
                  v-if="search_lab"
                  class="intro-y mt-3 w-full block text-center rounded-md py-4 border border-dotted border-slate-400 dark:border-darkmode-300 text-slate-500"
                  >View More</a
                >
              </div>
            </div>
            <!-- END: Search -->
            <!-- BEGIN: Medical Record -->
            <div class="col-span-12 xl:col-span-4 mt-6">
              <div class="intro-y flex items-center h-10">
                <h2 class="text-lg font-medium truncate mr-5">
                  Medical Records in {{ city }}
                </h2>
              </div>
              <div class="intro-y box p-5 mt-12 sm:mt-5">
                <div class="overflow-x-auto mt-3">
                  <table class="table text-xs table-bordered">
                    <tbody>
                      <tr>
                        <th>Number of birth</th>
                        <td>0</td>
                      </tr>
                      <tr>
                        <th>Number of birth mortality</th>
                        <td>0</td>
                      </tr>
                      <tr>
                        <th>Number of aleast 4 antenatal care visits</th>
                        <td>0</td>
                      </tr>
                      <tr>
                        <th>Number of aleast 4 postnatal care visits</th>
                        <td>0</td>
                      </tr>
                      <tr>
                        <th>Number of birth mortality</th>
                        <td>0</td>
                      </tr>
                      <tr>
                        <th>Number of mother birth mortality</th>
                        <td>0</td>
                      </tr>
                      <tr>
                        <th>Number of mortality</th>
                        <td>0</td>
                      </tr>
                    </tbody>
                  </table>
                </div>

                <a
                  href=""
                  class="intro-y mt-3 w-full block text-center rounded-md py-4 border border-dotted border-slate-400 dark:border-darkmode-300 text-slate-500"
                  >View More</a
                >
              </div>
            </div>
            <!-- END:  -->
            <!-- BEGIN: Ads 1 -->
            <div class="col-span-12 lg:col-span-6 mt-6">
              <div class="box p-8 relative overflow-hidden bg-primary intro-y">
                <div class="leading-[2.15rem] w-full sm:w-72 text-white text-xl -mt-3">
                  Transact safely with Lender’s Fund Account (RDL)
                </div>
                <div
                  class="w-full sm:w-72 leading-relaxed text-white/70 dark:text-slate-500 mt-3"
                >
                  Apply now, quick registration.
                </div>
                <button
                  class="btn w-32 bg-white dark:bg-darkmode-800 dark:text-white mt-6 sm:mt-10"
                >
                  Start Now
                </button>
                <img
                  class="hidden sm:block absolute top-0 right-0 w-2/5 -mt-3 mr-2"
                  alt="Midone - HTML Admin Template"
                  src="https://rubick.left4code.com/dist/images/woman-illustration.svg"
                />
              </div>
            </div>
            <!-- END: Ads 1 -->
            <!-- BEGIN: Ads 2 -->
            <div class="col-span-12 lg:col-span-6 mt-6">
              <div class="box p-8 relative overflow-hidden intro-y">
                <div
                  class="leading-[2.15rem] w-full sm:w-52 text-primary dark:text-white text-xl -mt-3"
                >
                  Invite friends to get <span class="font-medium">FREE</span> bonuses!
                </div>
                <div class="w-full sm:w-60 leading-relaxed text-slate-500 mt-2">
                  Get a IDR 100,000 voucher by inviting your friends to fund #BecomeMember
                </div>
                <div
                  class="w-48 relative mt-6 cursor-pointer tooltip"
                  title="Copy referral link"
                >
                  <input type="text" class="form-control" value="https://dashboard.in" />
                  <i
                    data-lucide="copy"
                    class="absolute right-0 top-0 bottom-0 my-auto mr-4 w-4 h-4"
                  ></i>
                </div>
                <img
                  class="hidden sm:block absolute top-0 right-0 w-1/2 mt-1 -mr-12"
                  alt="Midone - HTML Admin Template"
                  src="https://rubick.left4code.com/dist/images/phone-illustration.svg"
                />
              </div>
            </div>
            <!-- END: Ads 2 -->
          </div>
        </div>
        <div class="col-span-12 xl:col-span-3">
          <hospital></hospital>
        </div>
      </div>
    </div>
    <!-- END: Content -->
  </div>
</template>
<script>
export default {
  name: "index",
  data() {
    return {
      token: null,
      facility: "",
      user: "",
      staff: "",
      profile: "dist/images/profile-12.jpg",
      posts: [],
      city: "",
      drugs: [],
      search_drug: "",
      laboratories: [],
      search_lab: "",
      medical_services: [],
      search_medical_service: "",
    };
  },
  computed: {
    filterSearchDrug() {
      let str = this.search_drug;
      let string = str.charAt(0).toUpperCase() + str.slice(1);
      return this.drugs.filter((drug) => {
        return drug.name.match(string);
      });
    },
    filterSearchLaboratory() {
      let str = this.search_lab;
      let string = str.charAt(0).toUpperCase() + str.slice(1);
      return this.laboratories.filter((lab) => {
        return lab.test_name.match(string);
      });
    },
    filterSearchMedicalService() {
      let str = this.search_medical_service;
      let string = str.charAt(0).toUpperCase() + str.slice(1);
      return this.medical_services.filter((medical) => {
        return medical.name.match(string);
      });
    },
  },
  created() {
    this.login();
    this.getPosts();
    this.getDrugs();
    this.getLaboratoryCentres();
    this.getMedicalServices();
    this.getLocation();
  },
  methods: {
    login() {
      if (User.loggedIn()) {
        this.token = User.token();
      }
    },
    getPosts() {
      axios
        .get("/api/posts")
        .then((response) => (this.posts = response.data))
        .catch();
    },
    getLocation() {
      axios
        .get("/api/location")
        .then((response) => (this.city = response.data))
        .catch();
    },
    getDrugs() {
      axios
        .get("/api/drugs")
        .then((response) => (this.drugs = response.data))
        .catch();
    },
    getLaboratoryCentres() {
      axios
        .get("/api/laboratory-centres")
        .then((response) => (this.laboratories = response.data))
        .catch();
    },
    getMedicalServices() {
      axios
        .get("/api/medical-services")
        .then((response) => (this.medical_services = response.data))
        .catch();
    },
  },
};
</script>
