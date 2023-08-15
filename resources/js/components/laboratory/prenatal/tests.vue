<template>
  <div class="main">
    <!-- BEGIN: Mobile Menu -->
    <mobile-menu></mobile-menu>
    <!-- END: Mobile Menu -->
    <div class="flex">
      <!-- BEGIN: Side Menu -->
      <side-menu page="lab"></side-menu>
      <!-- END: Side Menu -->
      <!-- BEGIN: Content -->
      <div class="content">
        <!-- BEGIN: Top Bar -->
        <top-bar title="Prenatals"></top-bar>
        <!-- END: Top Bar -->

        <div class="grid grid-cols-12 gap-6 mt-4">
          <div class="intro-y col-span-12 xxl:col-span-12">
            <div class="intro-y box">
              <div
                class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60"
              >
                <div class="w-full lg:w-1/2">
                  <h2 class="font-medium text-base mr-auto">
                    Prenatal Visits for {{ data.patient.name }}
                  </h2>
                  <p class="font-medium">Gestational Age: {{ computeGestationalAge }}</p>
                </div>

                <div class="w-full flex flex-row sm:w-auto sm:ml-auto mt-3 sm:mt-0"></div>
              </div>
              <div class="p-5">
                <div class="grid grid-cols-12 gap-6 items-center">
                  <div class="col-span-12 xl:col-span-9 lg:col-span-9">
                    <h4 class="font-medium text-xl">First Visit</h4>
                    <ul class="ml-5 text-md">
                      <li>Blood type test</li>
                      <li>Rheumatoid Factor (RF)</li>
                      <li>Rubella Test</li>
                      <li>Hepatitis B Virus Test</li>
                      <li>Syphilis Tests</li>

                      <li>Chlamydia Test</li>
                      <li>HIV Test</li>
                      <li>Vitamin D test deficiency</li>
                      <li>
                        Urine test, to see if you have a bladder or urinary tract
                        infection
                      </li>
                      <li>CBC (Complete Blood Count)</li>
                    </ul>
                  </div>
                  <div class="col-span-12 xl:col-span-3 lg:col-span-3">
                    <div class="w-full" v-if="weeks < 19 && data.count < 10">
                      <router-link
                        v-if="data.orders == 0"
                        :to="{ name: 'lab-prenatal-pos', params: { key: key } }"
                        class="btn btn-primary btn-sm"
                        >Take Test</router-link
                      >
                    </div>
                    <div
                      class="w-full"
                      v-if="weeks < 19 && data.count > 0 && data.count <= 10"
                    >
                      <router-link
                        v-if="data.orders != 0"
                        :to="{ name: 'lab-patient-orders' }"
                        class="btn btn-primary btn-sm"
                        >Add Result</router-link
                      >
                    </div>

                    <div class="w-full" v-if="test_data.count_test1 == 10">
                      <router-link
                        :to="{
                          name: 'prenatal-lab-results',
                          params: { week: 'prenatal-first-visit', key: key },
                        }"
                        class="btn btn-primary btn-sm mt-2"
                        >Check Results</router-link
                      >
                    </div>
                  </div>
                  <div class="col-span-12">
                    <div
                      class="w-full border-t border-slate-200/60 dark:border-darkmode-400 mt-5"
                    ></div>
                  </div>

                  <div class="col-span-12 xl:col-span-9 lg:col-span-9">
                    <h4 class="font-medium text-2xl">28 weeks</h4>
                    <ul class="ml-5">
                      <li>
                        Blood type test to check for anaemia and blood platelet levels.
                        Your health professional may also check again for syphilis,
                        hepatitis B, hepatitis C and HIV
                      </li>
                      <li>
                        Urine test, if you have signs of a urinary tract infection or
                        raised blood pressure
                      </li>
                    </ul>
                  </div>
                  <div class="col-span-12 xl:col-span-3 lg:col-span-3">
                    <div class="w-full" v-if="weeks == 28 && data.count < 3">
                      <router-link
                        v-if="data.orders == 0"
                        :to="{ name: 'lab-prenatal-pos', params: { key: key } }"
                        class="btn btn-primary btn-sm"
                        >Take Test</router-link
                      >
                    </div>
                    <div
                      class="w-full"
                      v-if="weeks == 28 && data.count > 0 && data.count <= 3"
                    >
                      <router-link
                        v-if="data.orders != 0"
                        :to="{ name: 'lab-patient-orders' }"
                        class="btn btn-primary btn-sm"
                        >Add Result</router-link
                      >
                    </div>
                    <div class="w-full" v-if="test_data.count_test2 == 3">
                      <router-link
                        :to="{
                          name: 'prenatal-lab-results',
                          params: { week: 'prenatal-28-week', key: key },
                        }"
                        class="btn btn-primary btn-sm mt-2"
                        >Check Results</router-link
                      >
                    </div>
                  </div>
                  <div class="col-span-12">
                    <div
                      class="w-full border-t border-slate-200/60 dark:border-darkmode-400 mt-5"
                    ></div>
                  </div>
                  <div class="col-span-12 xl:col-span-9 lg:col-span-9">
                    <h4 class="font-medium text-2xl">32 weeks</h4>
                    <ul class="ml-5">
                      <li>
                        Urine test, if you have signs of a urinary tract infection or
                        raised blood pressure
                      </li>
                    </ul>
                  </div>
                  <div class="col-span-12 xl:col-span-3 lg:col-span-3">
                    <div class="w-full" v-if="weeks == 32 && data.count < 2">
                      <router-link
                        v-if="data.orders == 0"
                        :to="{ name: 'lab-prenatal-pos', params: { key: key } }"
                        class="btn btn-primary btn-sm"
                        >Take Test</router-link
                      >
                    </div>
                    <div
                      class="w-full"
                      v-if="weeks == 32 && data.count > 0 && data.count != 2"
                    >
                      <router-link
                        v-if="data.orders != 0"
                        :to="{ name: 'lab-patient-orders' }"
                        class="btn btn-primary btn-sm"
                        >Add Result</router-link
                      >
                    </div>
                    <div class="w-full" v-if="test_data.count_test3 == 2">
                      <router-link
                        :to="{
                          name: 'prenatal-lab-results',
                          params: { week: 'prenatal-32-week', key: key },
                        }"
                        class="btn btn-primary btn-sm mt-2"
                        >Check Results</router-link
                      >
                    </div>
                  </div>
                  <div class="col-span-12">
                    <div
                      class="w-full border-t border-slate-200/60 dark:border-darkmode-400 mt-5"
                    ></div>
                  </div>
                  <div class="col-span-12 xl:col-span-9 lg:col-span-9">
                    <h4 class="font-medium text-2xl">34-36 weeks</h4>
                    <ul class="ml-5">
                      <li>
                        Urine test, if you have signs of a urinary tract infection or
                        raised blood pressure
                      </li>
                    </ul>
                  </div>
                  <div class="col-span-12 xl:col-span-3 lg:col-span-3">
                    <div
                      class="w-full"
                      v-if="weeks >= 34 && weeks <= 36 && data.count < 2"
                    >
                      <router-link
                        v-if="data.orders == 0"
                        :to="{ name: 'lab-prenatal-pos', params: { key: key } }"
                        class="btn btn-primary btn-sm"
                        >Take Test</router-link
                      >
                    </div>
                    <div
                      class="w-full"
                      v-if="
                        weeks >= 34 && weeks <= 36 && data.count > 0 && data.count != 2
                      "
                    >
                      <router-link
                        v-if="data.orders != 0"
                        :to="{ name: 'lab-patient-orders' }"
                        class="btn btn-primary btn-sm"
                        >Add Result</router-link
                      >
                    </div>
                    <div class="w-full" v-if="test_data.count_test4 == 2">
                      <router-link
                        :to="{
                          name: 'prenatal-lab-results',
                          params: { week: 'prenatal-34-36-week', key: key },
                        }"
                        class="btn btn-primary btn-sm mt-2"
                        >Check Results</router-link
                      >
                    </div>
                  </div>
                  <div class="col-span-12">
                    <div
                      class="w-full border-t border-slate-200/60 dark:border-darkmode-400 mt-5"
                    ></div>
                  </div>
                  <div class="col-span-12 xl:col-span-9 lg:col-span-9">
                    <h4 class="font-medium text-2xl">38-39 weeks</h4>
                    <ul class="ml-5">
                      <li>
                        Urine test, if you have signs of a urinary tract infection or
                        raised blood pressure
                      </li>
                    </ul>
                  </div>
                  <div class="col-span-12 xl:col-span-3 lg:col-span-3">
                    <div
                      class="w-full"
                      v-if="(weeks == 38 || weeks == 39) && data.count < 2"
                    >
                      <router-link
                        v-if="data.orders == 0"
                        :to="{ name: 'lab-prenatal-pos', params: { key: key } }"
                        class="btn btn-primary btn-sm"
                        >Take Test</router-link
                      >
                    </div>
                    <div
                      class="w-full"
                      v-if="
                        (weeks == 38 || weeks == 39) && data.count > 0 && data.count != 2
                      "
                    >
                      <router-link
                        v-if="data.orders != 0"
                        :to="{ name: 'lab-patient-orders' }"
                        class="btn btn-primary btn-sm"
                        >Add Result</router-link
                      >
                    </div>
                    <div class="w-full" v-if="test_data.count_test5 == 2">
                      <router-link
                        :to="{
                          name: 'prenatal-lab-results',
                          params: { week: 'prenatal-38-39-week', key: key },
                        }"
                        class="btn btn-primary btn-sm mt-2"
                        >Check Results</router-link
                      >
                    </div>
                  </div>
                  <div class="col-span-12">
                    <div
                      class="w-full border-t border-slate-200/60 dark:border-darkmode-400 mt-5"
                    ></div>
                  </div>
                  <div class="col-span-12 xl:col-span-9 lg:col-span-9">
                    <h4 class="font-medium text-2xl">40-41 weeks</h4>
                    <ul class="ml-5">
                      <li>
                        Urine test, if you have signs of a urinary tract infection or
                        raised blood pressure
                      </li>
                    </ul>
                    <p class="text-md">
                      As well as the tests, scans and check-ups listed above, your GP,
                      midwife or obstetrician may offer further tests, depending on your
                      risk factors and circumstances. These can include:
                    </p>
                    <ul class="ml-5">
                      <li>
                        Chorionic villus sampling (CVS), where a small amount of the
                        baby's placenta is collected to test for chromosome problems such
                        as Down syndrome or other abnormality. This is usually done
                        between 10 and 11 weeks of pregnancy, or at another time if a
                        problem is suspected.
                      </li>
                      <li>
                        Non-invasive pre-natal testing (NIPT), which is a very accurate
                        test to detect Down syndrome and certain other abnormalities. It
                        is performed between 11 weeks and 13 weeks and 6 days of
                        pregnancy.
                      </li>
                      <li>
                        A nuchal translucency scan, which looks at the back of your baby's
                        neck to assess the risk of your baby having Down syndrome. This
                        test is done between 11 weeks and 13 weeks and 6 days, and may be
                        conducted at the same time as the dating ultrasound.
                      </li>
                      <li>
                        Amniocentesis, where a small amount of amniotic fluid (fluid
                        around the baby) is collected to test if the baby has a chromosome
                        problem or other abnormality. This is usually done at 15-18 weeks,
                        or at another time if a problem is detected.
                      </li>
                    </ul>
                  </div>
                  <div class="col-span-12 xl:col-span-3 lg:col-span-3">
                    <div
                      class="w-full"
                      v-if="(weeks == 40 || weeks == 41) && data.count < 2"
                    >
                      <router-link
                        v-if="data.orders == 0"
                        :to="{ name: 'lab-prenatal-pos', params: { key: key } }"
                        class="btn btn-primary btn-sm"
                        >Take Test</router-link
                      >
                    </div>
                    <div
                      class="w-full"
                      v-if="
                        (weeks == 40 || weeks == 41) && data.count > 0 && data.count != 2
                      "
                    >
                      <router-link
                        v-if="data.orders != 0"
                        :to="{ name: 'lab-patient-orders' }"
                        class="btn btn-primary btn-sm"
                        >Add Result</router-link
                      >
                    </div>
                    <div class="w-full" v-if="test_data.count_test6 == 2">
                      <router-link
                        :to="{
                          name: 'prenatal-lab-results',
                          params: { week: 'prenatal-40-41-week', key: key },
                        }"
                        class="btn btn-primary btn-sm mt-2"
                        >Check Results</router-link
                      >
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
  name: "prenatal",
  data() {
    return {
      token: "",
      key: "",
      data: {},
      weeks: "",
      days: "",
      test_data: {},
      gestational_age: "",
    };
  },
  computed: {
    computeGestationalAge() {
      let today = new Date();
      let lmp = new Date(this.data.prenatal.last_menstral_period);
      let t1 = lmp.getTime();
      let t2 = today.getTime();
      let diffInDays = Math.floor((t2 - t1) / (24 * 3600 * 1000));
      let weeks = parseInt(diffInDays / 7);
      let days = diffInDays % 7;
      this.weeks = weeks;
      this.days = days;
      let gestational_age = weeks + " weeks " + days + " days";
      this.gestational_age = weeks + " weeks " + days + " days";
      return gestational_age;
    },
  },
  created() {
    this.login();
    this.getPrenatalData();
    this.getPrentalMedicalLaboratoryTests();
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
    getPrenatalData() {
      axios
        .get("/api/v1/fetch-tests/" + this.key, {
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
    getPrentalMedicalLaboratoryTests() {
      axios
        .get("/api/v1/check-prenatal-medical-laboratory-tests/" + this.key, {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then((response) => (this.test_data = response.data))
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
ul {
  list-style: disc;
}
</style>
