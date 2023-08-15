<template>
  <div>
    <nav class="side-nav">
      <a href="" class="intro-x flex items-center pl-5 pt-4">
        <img alt="MedPremises" class="w-32" :src="'../../../../' + logo" />
      </a>
      <div class="side-nav__devider my-6"></div>

      <ul>
        <li>
          <router-link
            :to="{ name: 'patient-dashboard' }"
            class="side-menu"
            :class="page && page == 'dashboard' ? 'side-menu--active' : ''"
          >
            <div class="side-menu__icon"><i class="fa fa-home"></i></div>
            <div class="side-menu__title">Dashboard</div>
          </router-link>
        </li>

        <li>
          <router-link
            :to="{ name: 'hospital-visits' }"
            class="side-menu"
            :class="page && page == 'hospital-visits' ? 'side-menu--active' : ''"
          >
            <div class="side-menu__icon"><i data-feather="file-text"></i></div>
            <div class="side-menu__title">Hospital Visits</div>
          </router-link>
        </li>
        <li v-if="biodata.gender == 'Female' && user.prenatal == true">
          <router-link
            :to="{ name: 'patient-prenatals' }"
            class="side-menu"
            :class="page && page == 'prenatal' ? 'side-menu--active' : ''"
          >
            <div class="side-menu__icon">
              <img
                src="https://img.icons8.com/external-wanicon-lineal-wanicon/30/000000/external-pregnancy-medical-wanicon-lineal-wanicon.png"
              />
            </div>
            <div class="side-menu__title">Prenatals/Antenatal</div>
          </router-link>
        </li>
        <li v-if="biodata.gender == 'Female' && user.prenatal_admission == true">
          <router-link
            :to="{ name: 'patient-prenatal-admission' }"
            class="side-menu"
            :class="page && page == 'prenatal_admission' ? 'side-menu--active' : ''"
          >
            <div class="side-menu__icon">
              <img
                src="https://img.icons8.com/external-coronavirus-icons-berkahicon/30/000000/external-admission-coronavirus-treatment-coronavirus-icons-berkahicon-3.png"
              />
            </div>
            <div class="side-menu__title">Prenatals/Antenatal Admission</div>
          </router-link>
        </li>
        <li>
          <a
            href="javascript:;"
            class="side-menu"
            :class="page && page == 'profile' ? 'side-menu--active' : ''"
          >
            <div class="side-menu__icon"><i data-feather="trello"></i></div>
            <div class="side-menu__title">
              Profile
              <div class="side-menu__sub-icon"><i class="fa fa-chevron-down"></i></div>
            </div>
          </a>
          <ul class="">
            <li>
              <router-link :to="{ name: 'patient-profile' }" class="side-menu">
                <div class="side-menu__title">Profile</div>
              </router-link>
            </li>

            <li>
              <router-link :to="{ name: 'edit-patient-profile' }" class="side-menu">
                <div class="side-menu__title">Profile Setting</div>
              </router-link>
            </li>
            <li>
              <router-link :to="{ name: 'change-patient-password' }" class="side-menu">
                <div class="side-menu__title">Change Password</div>
              </router-link>
            </li>
          </ul>
        </li>
        <li>
          <router-link :to="{ name: 'patient-logout' }" class="side-menu">
            <div class="side-menu__icon"><i class="fa fa-power-off"></i></div>
            <div class="side-menu__title">Logout</div>
          </router-link>
        </li>
      </ul>
    </nav>
  </div>
</template>
<script>
export default {
  name: "side-menu",
  props: ["page"],
  data() {
    return {
      id: null,
      token: null,
      prenatal: "",
      user: "",
      facility: "",
      biodata: "",
      hospital: "",
      patient: false,

      logo: "dist/images/logo-white.png",
    };
  },
  created() {
    this.login();
    this.getPatient();
    this.getPatientBiodata();
  },
  methods: {
    login() {
      if (Patient.loggedIn()) {
        this.id = Patient.id();
        this.token = Patient.token();
      }
    },

    openPatient() {
      if (this.patient == false) {
        this.patient = true;
      } else {
        this.patient = false;
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
    getPatientBiodata() {
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
