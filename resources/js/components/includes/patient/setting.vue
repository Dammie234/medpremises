<template>
  <div>
    <div class="intro-y box mt-5">
      <div class="relative flex items-center p-5">
        <div class="w-12 h-12 image-fit">
          <img
            class="rounded-full"
            v-if="biodata.profile_picture"
            :src="'../../../' + biodata.profile_picture"
          />

          <img
            v-else
            class="rounded-full"
            src="https://img.icons8.com/ios-glyphs/50/null/guest-male.png"
          />
        </div>
        <div class="ml-4 mr-auto">
          <div class="font-medium text-base">{{ user.name }}</div>
          <div class="text-gray-600">{{ user.role }}</div>
        </div>
      </div>
      <div class="p-5 border-t border-gray-200 dark:border-dark-5">
        <router-link
          :to="{ name: 'edit-patient-profile' }"
          class="flex items-center mt-5"
          href=""
        >
          <i data-feather="settings" class="w-4 h-4 mr-2"></i> Profile Settings
        </router-link>
        <router-link
          :to="{ name: 'change-patient-password' }"
          class="flex items-center mt-5"
          href=""
        >
          <i data-feather="settings" class="w-4 h-4 mr-2"></i> Change Password
        </router-link>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: "setting",
  data() {
    return {
      user: "",
      facility: "",
      token: "",
      id: "",
      biodata: "",
    };
  },
  props: ["page"],
  created() {
    this.login();
    this.getPatient();

    this.getBiodata();
  },
  methods: {
    login() {
      if (!Patient.loggedIn()) {
        this.$router.push({
          name: "patient-logout",
        });
      } else {
        this.token = Patient.token();
        this.id = Patient.id();
      }
    },
    getPatient() {
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

    getBiodata() {
      axios
        .get("/api-patient/v1/biodata/" + this.id, {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then((response) => (this.biodata = response.data.biodata))
        .catch((error) => {
          console.log(error);
          if (error.response.status == 401) {
            this.$router.push({
              name: "patient-logout",
            });
          }
        });
    },
  },
};
</script>
