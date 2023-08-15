<template>
  <div>
    <div
      class="border-b border-white/[0.08] -mt-10 md:-mt-5 -mx-3 sm:-mx-8 px-3 sm:px-8 pt-3 md:pt-0 mb-10"
    >
      <div class="top-bar-boxed flex items-center">
        <!-- BEGIN: Logo -->
        <router-link :to="{ name: 'index' }" class="-intro-x hidden md:flex">
          <img
            alt="Med Premises"
            v-if="user.role == 'Facility Manager'"
            class="w-10"
            :src="'../../../' + facility.logo"
          />
          <img
            alt="Med Premises"
            v-else-if="user.role == 'Medical Staff' || user.role == 'Non Medical Staff'"
            class="w-10"
            :src="'../../../' + staff_facility.logo"
          />
          <img v-else :src="'../../../' + logo" alt="" class="w-40" />
        </router-link>
        <!-- END: Logo -->
        <!-- BEGIN: Breadcrumb -->
        <nav aria-label="breadcrumb" class="-intro-x h-full mr-auto">
          <ol class="breadcrumb breadcrumb-light">
            <li class="breadcrumb-item"><a href="#">Application</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ page }}</li>
          </ol>
        </nav>
        <div class="intro-x relative mr-3 text-white" v-if="token == null">
          <router-link :to="{ name: 'login' }" class="mr-3">Patient</router-link> |
          <router-link :to="{ name: 'staff-login' }" class="ml-3 mr-3">
            Staff</router-link
          >
          |
          <router-link :to="{ name: 'facility-registration' }" class="ml-3"
            >Facility Registration</router-link
          >
        </div>
        <!-- END: Breadcrumb -->

        <!-- BEGIN: Account Menu -->
        <div class="intro-x dropdown w-8 h-8" v-if="token != null">
          <div
            class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in scale-110"
            role="button"
            aria-expanded="false"
            data-tw-toggle="dropdown"
          >
            <img
              v-if="user.role == 'Facility Manager'"
              :src="'../../../' + facility.ownership_picture"
            />
            <img
              v-else-if="
                user.role == 'Non Medical Staff' ||
                user.role == 'Medical Staff' ||
                user.role == 'Patient'
              "
              :src="'../../../../' + staff.profile_picture"
            />
            <img v-else :src="'../../../../' + profile" />
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
                  <i data-lucide="help-circle" class="w-4 h-4 mr-2"></i> Facility
                  Signature
                </router-link>
              </li>
              <li
                v-if="
                  user.role == 'Medical Staff' ||
                  user.role == 'Non Medical Staff' ||
                  user.role == 'Patient'
                "
              >
                <router-link
                  :to="{ name: 'edit-profile' }"
                  class="dropdown-item hover:bg-white/5"
                >
                  <i data-lucide="help-circle" class="w-4 h-4 mr-2"></i> Profile Setting
                </router-link>
              </li>
              <li
                v-if="
                  user.role == 'Medical Staff' ||
                  user.role == 'Non Medical Staff' ||
                  user.role == 'Patient'
                "
              >
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
  </div>
</template>
<script>
export default {
  name: "frontend-top-bar",
  data() {
    return {
      token: null,
      facility: "",
      user: "",
      staff: "",
      profile: "dist/images/profile-12.jpg",
      logo: "dist/images/logo-white.png",
    };
  },
  props: ["page"],
  created() {
    this.login();
    this.getUser();
    this.getStaff();
    this.getFacilitySignature();
  },
  methods: {
    login() {
      if (User.loggedIn()) {
        this.token = User.token();
        this.id = User.id();
      }
    },

    getUser() {
      if (User.loggedIn()) {
        axios
          .get("/api/v1/user/" + this.id, {
            headers: {
              Authorization: "Bearer " + this.token,
              Accept: "application/json",
            },
          })
          .then((response) => (this.user = response.data))
          .catch();
      }
    },
    getFacilitySignature() {
      if (User.loggedIn()) {
        axios
          .get("/api/v1/facility-details/" + this.id, {
            headers: {
              Authorization: "Bearer " + this.token,
              Accept: "application/json",
            },
          })
          .then((response) => (this.facility = response.data))
          .catch();
      }
    },
    getStaff() {
      if (User.loggedIn()) {
        axios
          .get("/api/v1/staff/" + this.id, {
            headers: {
              Authorization: "Bearer " + this.token,
              Accept: "application/json",
            },
          })
          .then((response) => (this.staff = response.data.biodata))
          .catch();
      }
    },
  },
};
</script>
