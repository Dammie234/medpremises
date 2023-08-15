<template>
  <div>
    <ul class="nav nav-link-tabs" role="tablist">
      <li class="nav-item flex-1" role="presentation">
        <router-link
          :to="{ name: 'medical-history', params: { key: key_value } }"
          v-if="active == 'history'"
          class="nav-link w-full py-2 active"
          ><abbr title="Medical History">M.History</abbr></router-link
        >
        <router-link
          :to="{ name: 'medical-history', params: { key: key_value } }"
          v-else
          class="nav-link w-full py-2"
          ><abbr title="Medical History">M.History</abbr></router-link
        >
      </li>
      <li class="nav-item flex-1" role="presentation">
        <router-link
          :to="{ name: 'medical-examination', params: { key: key_value } }"
          v-if="active == 'examination'"
          class="nav-link w-full py-2 active"
          ><abbr title="Medical Examination">M.Examination</abbr></router-link
        >
        <router-link
          :to="{ name: 'medical-examination', params: { key: key_value } }"
          v-else
          class="nav-link w-full py-2"
          ><abbr title="Medical Examination">M.Examination</abbr></router-link
        >
      </li>
      <li class="nav-item flex-1" role="presentation">
        <router-link
          :to="{ name: 'medical-diagnostic', params: { key: key_value } }"
          v-if="active == 'diagnostic'"
          class="nav-link w-full py-2 active"
          ><abbr title="Medical Diagnostic">M.Diagnostic</abbr></router-link
        >
        <router-link
          :to="{ name: 'medical-diagnostic', params: { key: key_value } }"
          v-else
          class="nav-link w-full py-2"
          ><abbr title="Medical Diagnostic">M.Diagnostic</abbr></router-link
        >
      </li>
      <li class="nav-item flex-1" role="presentation">
        <router-link
          :to="{ name: 'medical-investigation', params: { key: key_value } }"
          v-if="active == 'investigation'"
          class="nav-link w-full py-2 active"
          ><abbr title="Medical Investigation">M.Investigation</abbr>
        </router-link>
        <router-link
          :to="{ name: 'medical-investigation', params: { key: key_value } }"
          v-else
          class="nav-link w-full py-2"
          ><abbr title="Medical Investigation">M.Investigation</abbr></router-link
        >
      </li>
      <li class="nav-item flex-1" role="presentation" v-if="tests.length != 0">
        <router-link
          :to="{ name: 'medical-laboratory-tests', params: { key: key_value } }"
          v-if="active == 'laboratory'"
          class="nav-link w-full py-2 active"
          ><abbr title="Medical Laboratory Tests">M.Laboratory Tests</abbr>
        </router-link>
        <router-link
          :to="{ name: 'medical-laboratory-tests', params: { key: key_value } }"
          v-else
          class="nav-link w-full py-2"
          ><abbr title="Medical Laboratory Tests">M.Laboratory Tests</abbr></router-link
        >
      </li>
      <li class="nav-item flex-1" role="presentation">
        <router-link
          :to="{ name: 'medical-treatment', params: { key: key_value } }"
          v-if="active == 'treatment'"
          class="nav-link w-full py-2 active"
          ><abbr title="Medical Treatment">M.Treatment</abbr>
        </router-link>
        <router-link
          :to="{ name: 'medical-treatment', params: { key: key_value } }"
          v-else
          class="nav-link w-full py-2"
          ><abbr title="Medical Treatment">M.Treatment</abbr></router-link
        >
      </li>
      <li class="nav-item flex-1" role="presentation">
        <router-link
          :to="{ name: 'medical-prescribed-drug', params: { key: key_value } }"
          v-if="active == 'drug'"
          class="nav-link w-full py-2 active"
        >
          Prescribe Drug</router-link
        >
        <router-link
          :to="{ name: 'medical-prescribed-drug', params: { key: key_value } }"
          v-else
          class="nav-link w-full py-2"
          >Prescribe Drug</router-link
        >
      </li>
      <!-- <li class="nav-item flex-1" role="presentation">
        <router-link
          :to="{ name: 'medical-service', params: { key: key_value } }"
          v-if="active == 'service'"
          class="nav-link w-full py-2 active"
          ><abbr title="Medical Service">M.Service</abbr></router-link
        >
        <router-link
          :to="{ name: 'medical-service', params: { key: key_value } }"
          v-else
          class="nav-link w-full py-2"
          ><abbr title="Medical Service">M.Service</abbr></router-link
        >
      </li> -->
    </ul>
  </div>
</template>
<script>
export default {
  name: "consultation-menu",
  props: ["key_value", "active"],
  data() {
    return {
      tests: [],
    };
  },
  created() {
    this.getConductedPatientTests();
  },
  methods: {
    getConductedPatientTests() {
      axios
        .get(
          "/api/v1/conducted-patient-medical-laboratory-tests/" + this.$route.params.key,
          {
            headers: {
              Authorization: "Bearer " + User.token(),
              Accept: "application/json",
            },
          }
        )
        .then((response) => (this.tests = response.data))
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
<style lang="css">
.nav ul li {
  list-style: none !important;
}
</style>
