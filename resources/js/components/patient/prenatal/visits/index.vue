<template>
  <div class="main">
    <!-- BEGIN: Mobile Menu -->
    <patient-mobile-menu></patient-mobile-menu>
    <!-- END: Mobile Menu -->
    <div class="flex">
      <!-- BEGIN: Side Menu -->
      <patient-side-menu page="prenatal"></patient-side-menu>
      <!-- END: Side Menu -->
      <!-- BEGIN: Content -->
      <div class="content">
        <!-- BEGIN: Top Bar -->
        <patient-top-bar title="Prenatal Visits"></patient-top-bar>
        <!-- END: Top Bar -->

        <div class="grid grid-cols-12 gap-6 mt-4">
          <div class="intro-y col-span-12 xxl:col-span-12">
            <div class="intro-y box">
              <div
                class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60"
              >
                <div class="w-full lg:w-1/2">
                  <h2 class="font-medium text-base mr-auto">
                    Prenatal Visits for {{ patient.name }}
                  </h2>
                </div>

                <div class="w-full flex flex-row sm:w-auto sm:ml-auto mt-3 sm:mt-0">
                  <router-link :to="{ name: 'prenatals' }" class="btn btn-primary"
                    >Go Back</router-link
                  >
                </div>
              </div>
              <div class="p-5">
                <div class="grid grid-cols-12 gap-6 items-center">
                  <div class="col-span-12 xl:col-span-9 lg:col-span-9">
                    <h4 class="font-medium text-xl">First Visit</h4>
                    <ul class="ml-5 text-md">
                      <li>Confirmation that you are pregnant</li>
                      <li>
                        Calculating how many weeks your pregnancy is and when your due
                        date will be. You may be offered an ultrasound scan if the date is
                        not clear.
                      </li>
                      <li>Blood pressure, height and weight</li>
                      <li>Gestational age</li>
                      <li>Haemoglobin result</li>
                      <li>Antenatal risk</li>
                      <li>
                        Full blood test, to check your blood group and test for anaemia,
                        rubella immunity, hepatitis B, hepatitis C, syphilis, chlamydia
                        and HIV
                      </li>
                      <li>
                        Urine test, to see if you have a bladder or urinary tract
                        infection
                      </li>
                      <li>Screening for Down syndrome</li>
                      <li>
                        Cervical screening to check for human papillomavirus (HPV) and/or
                        any signs of cervical cancer
                      </li>
                      <li>
                        If at risk of vitamin D deficiency, a test for this may be offered
                      </li>
                    </ul>
                    <p class="text-md p y-3">
                      As part of your check-up, you will usually also discuss with your
                      doctor or midwife:
                    </p>
                    <ul class="ml-5 text-md">
                      <li>Which medications you are taking</li>
                      <li>Whether you smoke or drink alcohol</li>
                      <li>Whether you would like an influenza (flu) vaccination</li>
                      <li>
                        Which vitamin and mineral supplements you can take or should avoid
                      </li>
                      <li>Antenatal care options available to you</li>
                      <li>Where you can get further information and antenatal classes</li>
                    </ul>
                  </div>
                  <div class="col-span-12 xl:col-span-3 lg:col-span-3">
                    <router-link
                      :to="{ name: 'patient-prenatal-first-visit', params: { key: key } }"
                      class="btn btn-primary mr-2 btn-sm"
                      ><i class="fa fa-info mr-2"></i> Show Data</router-link
                    >
                    <router-link
                      :to="{
                        name: 'patient-prenatal-laboratory-results',
                        params: { week: 'prenatal-first-visit', key: key },
                      }"
                      class="btn btn-primary btn-sm mt-2"
                      >Check Test Results</router-link
                    >
                  </div>
                  <div class="col-span-12">
                    <div
                      class="w-full border-t border-slate-200/60 dark:border-darkmode-400 mt-5"
                    ></div>
                  </div>
                  <div class="col-span-12 xl:col-span-9 lg:col-span-9">
                    <h4 class="font-medium text-2xl">19-20 weeks</h4>
                    <ul class="ml-5">
                      <li>Blood pressure</li>
                      <li>
                        Measuring your tummy (abdominal palpation) to check your baby's
                        growth
                      </li>
                      <li>Checking how your health is and if there are any problems</li>
                      <li>Gestational age</li>
                      <li>Haemoglobin result</li>
                      <li>Antenatal risk</li>
                      <li>
                        Ultrasound scan to check your baby's physical development, growth
                        and any complications with your pregnancy. If you want to, during
                        the ultrasound, you can find out whether the baby is a boy or
                        girl.
                      </li>
                    </ul>
                  </div>
                  <div class="col-span-12 xl:col-span-3 lg:col-span-3">
                    <div class="w-full" v-if="data.check_prenatal_19_20_week == true">
                      <router-link
                        :to="{
                          name: 'patient-prenatal-19-20-visit',
                          params: { key: key },
                        }"
                        class="btn btn-primary mr-2 btn-sm"
                        ><i class="fa fa-info mr-2"></i> Show Data</router-link
                      >
                    </div>
                  </div>
                  <div class="col-span-12">
                    <div
                      class="w-full border-t border-slate-200/60 dark:border-darkmode-400 mt-5"
                    ></div>
                  </div>
                  <div class="col-span-12 xl:col-span-9 lg:col-span-9">
                    <h4 class="font-medium text-2xl">22 weeks</h4>
                    <ul class="ml-5">
                      <li>Blood pressure</li>
                      <li>
                        Measuring your tummy (abdominal palpation) to check your baby's
                        growth
                      </li>
                      <li>Checking how your health is and if you have any problems</li>
                      <li>Gestational age</li>
                      <li>Haemoglobin result</li>
                      <li>Antenatal risk</li>
                    </ul>
                  </div>
                  <div class="col-span-12 xl:col-span-3 lg:col-span-3">
                    <div class="w-full" v-if="data.check_prenatal_19_20_week == true">
                      <div class="w-full" v-if="data.check_prenatal_22_week == true">
                        <router-link
                          :to="{
                            name: 'patient-prenatal-22-visit',
                            params: { key: key },
                          }"
                          class="btn btn-primary mr-2 btn-sm"
                          ><i class="fa fa-info mr-2"></i> Show Data</router-link
                        >
                      </div>
                    </div>
                  </div>
                  <div class="col-span-12">
                    <div
                      class="w-full border-t border-slate-200/60 dark:border-darkmode-400 mt-5"
                    ></div>
                  </div>
                  <div class="col-span-12 xl:col-span-9 lg:col-span-9">
                    <h4 class="font-medium text-2xl">26-27 weeks</h4>
                    <ul class="ml-5">
                      <li>Blood pressure</li>
                      <li>
                        Measuring your tummy (abdominal palpation) to check your baby's
                        growth
                      </li>
                      <li>Checking how your health is and if you have any problems</li>
                      <li>Blood glucose tolerance test for diabetes</li>
                      <li>Gestational age</li>
                      <li>Haemoglobin result</li>
                      <li>Antenatal risk</li>
                    </ul>
                  </div>
                  <div class="col-span-12 xl:col-span-3 lg:col-span-3">
                    <div class="w-full" v-if="data.check_prenatal_22_week == true">
                      <div class="w-full" v-if="data.check_prenatal_26_27_week == true">
                        <router-link
                          :to="{
                            name: 'patient-prenatal-26-27-visit',
                            params: { key: key },
                          }"
                          class="btn btn-primary mr-2 btn-sm"
                          ><i class="fa fa-info mr-2"></i> Show Data</router-link
                        >
                      </div>
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
                      <li>Blood pressure</li>
                      <li>
                        Measuring your tummy (abdominal palpation) to check baby's growth
                      </li>
                      <li>Checking how your health is and if you have any problems</li>
                      <li>Checking your baby's heartbeat and movements</li>
                      <li>Gestational age</li>
                      <li>Haemoglobin result</li>
                      <li>Antenatal risk</li>
                      <li>Discussing your birth plan and going home with your baby</li>
                      <li>
                        Blood test to check for anaemia and blood platelet levels. Your
                        health professional may also check again for syphilis, hepatitis
                        B, hepatitis C and HIV
                      </li>
                      <li>
                        If your blood type is Rh negative, an anti-D immunoglobulin
                        injection may be given
                      </li>
                      <li>Pertussis (whooping cough) vaccination</li>
                      <li>
                        Urine test, if you have signs of a urinary tract infection or
                        raised blood pressure
                      </li>
                    </ul>
                  </div>
                  <div class="col-span-12 xl:col-span-3 lg:col-span-3">
                    <div class="w-full" v-if="data.check_prenatal_26_27_week == true">
                      <div class="w-full" v-if="data.check_prenatal_28_week == true">
                        <router-link
                          :to="{
                            name: 'patient-prenatal-28-visit',
                            params: { key: key },
                          }"
                          class="btn btn-primary mr-2 btn-sm"
                          ><i class="fa fa-info mr-2"></i> Show Data</router-link
                        >
                        <router-link
                          :to="{
                            name: 'patient-prenatal-laboratory-results',
                            params: { week: 'prenatal-28-week', key: key },
                          }"
                          class="btn btn-primary btn-sm mt-2"
                          >Check Test Results</router-link
                        >
                      </div>
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
                      <li>Blood pressure</li>
                      <li>
                        Measuring your tummy (abdominal palpation) to check your baby's
                        growth
                      </li>
                      <li>Checking how your health is and if you have any problems</li>
                      <li>Checking your baby's heartbeat and movements</li>
                      <li>Gestational age</li>
                      <li>Haemoglobin result</li>
                      <li>Antenatal risk</li>
                      <li>
                        Enter date on which 2 (or 3) doses of fansidar were given (dd/mm)
                      </li>
                      <li>
                        Urine test, if you have signs of a urinary tract infection or
                        raised blood pressure
                      </li>
                    </ul>
                  </div>
                  <div class="col-span-12 xl:col-span-3 lg:col-span-3">
                    <div class="w-full" v-if="data.check_prenatal_28_week == true">
                      <div class="w-full" v-if="data.check_prenatal_32_week == true">
                        <router-link
                          :to="{
                            name: 'patient-prenatal-32-visit',
                            params: { key: key },
                          }"
                          class="btn btn-primary mr-2 btn-sm"
                          ><i class="fa fa-info mr-2"></i> Show Data</router-link
                        ><router-link
                          :to="{
                            name: 'patient-prenatal-laboratory-results',
                            params: { week: 'prenatal-32-week', key: key },
                          }"
                          class="btn btn-primary btn-sm mt-2"
                          >Check Test Results</router-link
                        >
                      </div>
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
                      <li>Blood pressure</li>
                      <li>
                        Measuring your tummy (abdominal palpation) to check your baby's
                        growth
                      </li>
                      <li>Checking how your health is and if you have any problems</li>
                      <li>Checking your baby's heartbeat and movements</li>
                      <li>Gestational age</li>
                      <li>Haemoglobin result</li>
                      <li>Antenatal risk</li>
                      <li>
                        Enter dates on which most recent doses of TT vaccine were given
                        (dd/mm/yy)
                      </li>
                      <li>
                        Urine test, if you have signs of a urinary tract infection or
                        raised blood pressure
                      </li>
                      <li>Vaginal swab for Group B streptococcus (GBS)</li>
                      <li>
                        If your blood type is Rh negative, a second anti-D immunoglobulin
                        injection may be given
                      </li>
                      <li>
                        Assessing presentation (which way up your baby is) and station
                        (how far down the baby's head has moved into your pelvis)
                      </li>
                    </ul>
                  </div>
                  <div class="col-span-12 xl:col-span-3 lg:col-span-3">
                    <div class="w-full" v-if="data.check_prenatal_32_week == true">
                      <div class="w-full" v-if="data.check_prenatal_34_36_week == true">
                        <router-link
                          :to="{
                            name: 'patient-prenatal-34-36-visit',
                            params: { key: key },
                          }"
                          class="btn btn-primary mr-2 btn-sm"
                          ><i class="fa fa-info mr-2"></i> Show Data</router-link
                        >
                        <router-link
                          :to="{
                            name: 'patient-prenatal-laboratory-results',
                            params: { week: 'prenatal-34-36-week', key: key },
                          }"
                          class="btn btn-primary btn-sm mt-2"
                          >Check Test Results</router-link
                        >
                      </div>
                    </div>
                  </div>
                  <div class="col-span-12">
                    <div
                      class="w-full border-t border-slate-200/60 dark:border-darkmode-400 mt-5"
                    ></div>
                  </div>
                  <div class="col-span-12 xl:col-span-9 lg:col-span-9">
                    <h4 class="font-medium text-2xl">38/39 weeks</h4>
                    <ul class="ml-5">
                      <li>Blood pressure</li>
                      <li>
                        Measuring your tummy (abdominal palpation) to check your baby's
                        growth
                      </li>
                      <li>Checking how your health is and if you have any problems</li>
                      <li>Checking your baby's heartbeat and movements</li>
                      <li>Gestational age</li>
                      <li>Haemoglobin result</li>
                      <li>Antenatal risk</li>

                      <li>Enter date on which dose of mebendazole was given (dd/mm)</li>
                      <li>
                        Urine test, if you have signs of a urinary tract infection or
                        raised blood pressure
                      </li>
                      <li>Assessing presentation and station</li>
                    </ul>
                  </div>
                  <div class="col-span-12 xl:col-span-3 lg:col-span-3">
                    <div class="w-full" v-if="data.check_prenatal_34_36_week == true">
                      <div class="w-full" v-if="data.check_prenatal_38_39_week == true">
                        <router-link
                          :to="{
                            name: 'patient-prenatal-38-39-visit',
                            params: { key: key },
                          }"
                          class="btn btn-primary mr-2 btn-sm"
                          ><i class="fa fa-info mr-2"></i> Show Data</router-link
                        >
                        <router-link
                          :to="{
                            name: 'patient-prenatal-laboratory-results',
                            params: { week: 'prenatal-38-39-week', key: key },
                          }"
                          class="btn btn-primary btn-sm mt-2"
                          >Check Test Results</router-link
                        >
                      </div>
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
                      <li>Blood pressure</li>
                      <li>
                        Measuring your tummy (abdominal palpation) to check your baby's
                        growth
                      </li>
                      <li>Checking how your health is and if you have any problems</li>
                      <li>Checking your baby's heartbeat and movements</li>
                      <li>Gestational age</li>
                      <li>Haemoglobin result</li>
                      <li>Antenatal risk</li>
                      <li>
                        Enter date on which insecticide treated net was provided (dd/mm)
                      </li>
                      <li>
                        Urine test, if you have signs of a urinary tract infection or
                        raised blood pressure
                      </li>
                      <li>Assessing presentation and station</li>
                      <li>
                        If you haven't had your baby yet, checking your baby's heartbeat
                        and the amount of fluid around them
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
                    <div class="w-full" v-if="data.check_prenatal_38_39_week == true">
                      <div class="w-full" v-if="data.check_prenatal_40_41_week == true">
                        <router-link
                          :to="{
                            name: 'patient-prenatal-40-41-visit',
                            params: { key: key },
                          }"
                          class="btn btn-primary mr-2 btn-sm"
                          ><i class="fa fa-info mr-2"></i> Show Data</router-link
                        >

                        <router-link
                          :to="{
                            name: 'patient-prenatal-laboratory-results',
                            params: { week: 'prenatal-40-41-week', key: key },
                          }"
                          class="btn btn-primary btn-sm mt-2"
                          >Check Test Results</router-link
                        >
                      </div>
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
      patient: "",
    };
  },

  created() {
    this.login();
    this.getPrenatalData();
    this.getPatient();
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
    getPrenatalData() {
      axios
        .get("/api-patient/v1/patient-prenatal/" + this.id, {
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
  },
};
</script>
<style scoped>
ul {
  list-style: disc;
}
</style>
