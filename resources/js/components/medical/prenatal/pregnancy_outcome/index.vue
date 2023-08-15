<template>
  <div class="main">
    <!-- BEGIN: Mobile Menu -->
    <mobile-menu></mobile-menu>
    <!-- END: Mobile Menu -->
    <div class="flex">
      <!-- BEGIN: Side Menu -->
      <side-menu page="prenatal"></side-menu>
      <!-- END: Side Menu -->
      <!-- BEGIN: Content -->
      <div class="content">
        <!-- BEGIN: Top Bar -->
        <top-bar title="Edit Prenatal"></top-bar>
        <!-- END: Top Bar -->
        <div class="grid grid-cols-12 gap-6">
          <div class="intro-y col-span-12 xxl:col-span-12">
            <div class="intro-y box">
              <div
                class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5"
              >
                <h2 class="font-medium text-base mr-auto">
                  Create Delivery, Pregnancy &amp; Maternal Outcome For
                  {{ prenatal.name }}
                </h2>
                <router-link :to="{ name: 'prenatal-admissions' }" class="btn btn-primary"
                  >Go Back</router-link
                >
              </div>
              <form class="input p-5">
                <div class="grid grid-cols-12 gap-x-5" :disabled="loading">
                  <div class="col-span-12 xl:col-span-3 mt-3">
                    <label for="delivery" class="form-label"
                      >Delivery during admission</label
                    >
                    <input
                      id="delivery"
                      type="text"
                      disabled
                      class="form-control"
                      v-model="form.delivery"
                    />
                    <div
                      class="text-danger font-medium text-xs mt-1"
                      v-if="errors.delivery"
                    >
                      {{ errors.delivery[0] }}
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="grid grid-cols-12 gap-6 my-5">
          <div class="intro-y col-span-12 xxl:col-span-12">
            <div class="intro-y box">
              <div
                class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5"
              >
                <h2 class="font-medium text-base mr-auto">
                  Edit Delivery, Pregnancy &amp; Maternal Outcome For {{ prenatal.name }}
                </h2>
              </div>
              <div class="overflow-x-auto p-5"></div>
            </div>
          </div>
        </div>

        <div class="grid grid-cols-12 gap-6 my-5">
          <div class="intro-y col-span-12 xxl:col-span-12">
            <div class="intro-y box">
              <div
                class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5"
              >
                <h2 class="font-medium text-base mr-auto">
                  Delivery, Pregnancy &amp; Maternal Outcome For {{ prenatal.name }}
                </h2>
              </div>
              <div class="overflow-x-auto p-5"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: "pregnancy-outcome",
  data() {
    return {
      token: "",
      key: "",
      prenatal: "",
      form: {
        delivery: "",
        delivery_date: "",
        onset_of_labour: "",
        fetal_presentation_at_delivery: "",
        amniotic_fluid_at_delivery: "",
        gestational_diabetes: "",
        gestational_hypertension: "",
        anaemia: "",
        intrauterine_growth_restriction: "",
        placental_previa: "",
        bacteria_infection: "",
        pre_eclampsia: "",
        placental_abruption: "",
        preterm_contractions: "",
        preterm_labour: "",
        preterm_rupture_of_membranes: "",
        early_or_mid_term_miscarriage: "",
        haemorrhage: "",
        antepartum: "",
        postpartum: "",
        abortion_related: "",
        embolic_disease: "",
        anaesthetic_complication: "",
        key: "",
        token: "",
      },

      errors: {},
    };
  },
  created() {
    this.login();
    this.getPrenatalAdmission();
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

    getPrenatalAdmission() {
      axios
        .get("/api/v1/prenatal-admission/" + this.key, {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then((response) => (this.prenatal = response.data))
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
.border-top {
  border-top: 1px solid #aaa;
}
.mt-4 {
  margin-top: 0.8rem;
}
.form-check-label {
  font-weight: 400;
}
</style>
