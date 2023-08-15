<template>
  <div>
    <div class="top-bar">
      <!-- BEGIN: Breadcrumb -->
      <div class="-intro-x breadcrumb mr-auto hidden sm:flex">
        <a href="/dashboard">Dashboard </a> <i class="fa fa-chevron-right px-2"></i>
        <a href="" class="breadcrumb--active">{{ title }}</a>
      </div>
      <!-- END: Breadcrumb -->

      <!-- BEGIN: Account Menu -->
      <div class="intro-x dropdown w-8 h-8">
        <div
          class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in"
          role="button"
          aria-expanded="false"
        >
          <img
            alt="Facility Manager"
            v-if="user.role == 'Facility Manager'"
            :src="'../../../../../' + facility.ownership_picture"
          />
          <img
            alt="Staff"
            v-else-if="user.role == 'Non Medical Staff' || user.role == 'Medical Staff'"
            :src="'../../../../../' + staff.profile_picture"
          />
          <img alt="Staff" v-else :src="'../../../../' + profile" />
        </div>
        <div class="dropdown-menu w-56">
          <ul
            class="dropdown-content bg-primary/80 before:block before:absolute before:bg-black before:inset-0 before:rounded-md before:z-[-1] text-white"
          >
            <li class="p-2">
              <div class="font-medium">{{ user.name }}</div>
              <div class="text-xs text-white/60 mt-0.5 dark:text-slate-500">
                {{ user.role }}
              </div>
            </li>
            <li>
              <hr class="dropdown-divider border-white/[0.08]" />
            </li>
            <li v-if="user.role == 'Facility Manager'">
              <router-link
                :to="{ name: 'edit-signature' }"
                class="dropdown-item hover:bg-white/5"
              >
                <i data-lucide="user" class="w-4 h-4 mr-2"></i> Facility Setting
              </router-link>
            </li>
            <li
              v-if="
                user.role == 'Facility Manager' && facility.facility_type == 'Hospital'
              "
            >
              <router-link
                :to="{ name: 'edit-hospital-class' }"
                class="dropdown-item hover:bg-white/5"
              >
                <i data-lucide="edit" class="w-4 h-4 mr-2"></i> Hospital Setting
              </router-link>
            </li>
            <li
              v-if="
                user.role == 'Facility Manager' && facility.facility_type == 'Hospital'
              "
            >
              <router-link
                :to="{ name: 'edit-medical-services' }"
                class="dropdown-item hover:bg-white/5"
              >
                <i data-lucide="lock" class="w-4 h-4 mr-2"></i> Medical Service Setting
              </router-link>
            </li>
            <li v-if="user.role == 'Facility Manager'">
              <router-link
                :to="{ name: 'signature' }"
                class="dropdown-item hover:bg-white/5"
              >
                <i data-lucide="help-circle" class="w-4 h-4 mr-2"></i> Facility Signature
              </router-link>
            </li>
            <li v-if="user.role == 'Medical Staff' || user.role == 'Non Medical Staff'">
              <router-link
                :to="{ name: 'edit-profile' }"
                class="dropdown-item hover:bg-white/5"
              >
                <i data-lucide="help-circle" class="w-4 h-4 mr-2"></i> Profile Setting
              </router-link>
            </li>
            <li v-if="user.role == 'Medical Staff' || user.role == 'Non Medical Staff'">
              <router-link
                :to="{ name: 'profile' }"
                class="dropdown-item hover:bg-white/5"
              >
                <i data-lucide="help-circle" class="w-4 h-4 mr-2"></i> Profile
              </router-link>
            </li>
            <li
              v-if="
                user.role == 'Facility Manager' &&
                (facility.facility_type == 'Laboratory' ||
                  facility.facility_type == 'Hospital')
              "
            >
              <router-link
                :to="{ name: 'laboratory-tests' }"
                class="dropdown-item hover:bg-white/5"
              >
                <i data-lucide="help-circle" class="w-4 h-4 mr-2"></i> Add Medical
                Diagnostic &amp; Laboratory Tests
              </router-link>
            </li>
            <li>
              <router-link
                :to="{ name: 'change-password' }"
                class="dropdown-item hover:bg-white/5"
              >
                <i data-lucide="help-circle" class="w-4 h-4 mr-2"></i> Change
                Password</router-link
              >
            </li>
            <li>
              <hr class="dropdown-divider border-white/[0.08]" />
            </li>
            <li>
              <router-link
                :to="{ name: 'logout' }"
                class="dropdown-item hover:bg-white/5"
              >
                <i data-lucide="toggle-right" class="w-4 h-4 mr-2"></i> Sign Out
              </router-link>
            </li>
          </ul>
        </div>
      </div>
      <!-- END: Account Menu -->
    </div>
  </div>
</template>
<script>
export default {
  name: "top-bar",
  data() {
    return {
      profile: "dist/images/profile-12.jpg",
      id: '',
      token: '',
      user: '',
      facility: '',
      staff: ''
    };
  },
  props: ["title"],
  created(){
    this.login()
    this.getStaff()
    this.getFacilitySignature()
    this.getUser()
  },
  methods: {
    login(){
        if(User.loggedIn()){
            this.id = User.id()
            this.token = User.token()
        }
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
    getFacilitySignature() {
      axios
        .get("/api/v1/facility-details/" + this.id, {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then((response) => (this.facility = response.data))
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
        .get("/api/v1/staff/" + this.id, {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then((response) => (this.staff = response.data.biodata))
        .catch((error) => {
          console.log(error);
          if (error.response.status == 401) {
            this.$router.push({
              name: "logout",
            });
          }
        });
    },
  }
};
</script>
