<template>
  <div>
    <div class="top-bar">
      <!-- BEGIN: Breadcrumb -->
      <div class="-intro-x breadcrumb mr-auto hidden sm:flex">
        <a href="">Application </a> <i class="fa fa-chevron-right px-2"></i>
        <a href="" class="breadcrumb--active">{{ title }}</a>
      </div>
      <!-- END: Breadcrumb -->
      <!-- BEGIN: Search -->
      <!-- <div class="intro-x relative mr-3 sm:mr-6">
                <div class="search hidden sm:block">
                    <input type="text" class="search__input form-control border-transparent placeholder-theme-13" placeholder="Search...">
                    <i data-feather="search" class="search__icon dark:text-gray-300"></i>
                </div>
                <a class="notification sm:hidden" href=""> <i data-feather="search" class="notification__icon dark:text-gray-300"></i> </a>
                <div class="search-result">
                    <div class="search-result__content">
                        <div class="search-result__content__title">Pages</div>
                        <div class="mb-5">
                            <a href="" class="flex items-center">
                                <div class="w-8 h-8 bg-theme-18 text-theme-9 flex items-center justify-center rounded-full"> <i class="w-4 h-4" data-feather="inbox"></i> </div>
                                <div class="ml-3">Mail Settings</div>
                            </a>
                            <a href="" class="flex items-center mt-2">
                                <div class="w-8 h-8 bg-theme-17 text-theme-11 flex items-center justify-center rounded-full"> <i class="w-4 h-4" data-feather="users"></i> </div>
                                <div class="ml-3">Users & Permissions</div>
                            </a>
                            <a href="" class="flex items-center mt-2">
                                <div class="w-8 h-8 bg-theme-14 text-theme-10 flex items-center justify-center rounded-full"> <i class="w-4 h-4" data-feather="credit-card"></i> </div>
                                <div class="ml-3">Transactions Report</div>
                            </a>
                        </div>
                        <div class="search-result__content__title">Users</div>
                        <div class="mb-5">
                            <a href="" class="flex items-center mt-2">
                                <div class="w-8 h-8 image-fit">
                                    <img alt="Rubick Tailwind HTML Admin Template" class="rounded-full" src="dist/images/profile-13.jpg">
                                </div>
                                <div class="ml-3">Kevin Spacey</div>
                                <div class="ml-auto w-48 truncate text-gray-600 text-xs text-right">kevinspacey@left4code.com</div>
                            </a>
                            <a href="" class="flex items-center mt-2">
                                <div class="w-8 h-8 image-fit">
                                    <img alt="Rubick Tailwind HTML Admin Template" class="rounded-full" src="dist/images/profile-11.jpg">
                                </div>
                                <div class="ml-3">Leonardo DiCaprio</div>
                                <div class="ml-auto w-48 truncate text-gray-600 text-xs text-right">leonardodicaprio@left4code.com</div>
                            </a>
                            <a href="" class="flex items-center mt-2">
                                <div class="w-8 h-8 image-fit">
                                    <img alt="Rubick Tailwind HTML Admin Template" class="rounded-full" src="dist/images/profile-14.jpg">
                                </div>
                                <div class="ml-3">Tom Hanks</div>
                                <div class="ml-auto w-48 truncate text-gray-600 text-xs text-right">tomhanks@left4code.com</div>
                            </a>
                            <a href="" class="flex items-center mt-2">
                                <div class="w-8 h-8 image-fit">
                                    <img alt="Rubick Tailwind HTML Admin Template" class="rounded-full" src="dist/images/profile-14.jpg">
                                </div>
                                <div class="ml-3">Denzel Washington</div>
                                <div class="ml-auto w-48 truncate text-gray-600 text-xs text-right">denzelwashington@left4code.com</div>
                            </a>
                        </div>
                        <div class="search-result__content__title">Products</div>
                        <a href="" class="flex items-center mt-2">
                            <div class="w-8 h-8 image-fit">
                                <img alt="Rubick Tailwind HTML Admin Template" class="rounded-full" src="dist/images/preview-14.jpg">
                            </div>
                            <div class="ml-3">Oppo Find X2 Pro</div>
                            <div class="ml-auto w-48 truncate text-gray-600 text-xs text-right">Smartphone &amp; Tablet</div>
                        </a>
                        <a href="" class="flex items-center mt-2">
                            <div class="w-8 h-8 image-fit">
                                <img alt="Rubick Tailwind HTML Admin Template" class="rounded-full" src="dist/images/preview-4.jpg">
                            </div>
                            <div class="ml-3">Samsung Q90 QLED TV</div>
                            <div class="ml-auto w-48 truncate text-gray-600 text-xs text-right">Electronic</div>
                        </a>
                        <a href="" class="flex items-center mt-2">
                            <div class="w-8 h-8 image-fit">
                                <img alt="Rubick Tailwind HTML Admin Template" class="rounded-full" src="dist/images/preview-13.jpg">
                            </div>
                            <div class="ml-3">Sony A7 III</div>
                            <div class="ml-auto w-48 truncate text-gray-600 text-xs text-right">Photography</div>
                        </a>
                        <a href="" class="flex items-center mt-2">
                            <div class="w-8 h-8 image-fit">
                                <img alt="Rubick Tailwind HTML Admin Template" class="rounded-full" src="dist/images/preview-12.jpg">
                            </div>
                            <div class="ml-3">Nike Air Max 270</div>
                            <div class="ml-auto w-48 truncate text-gray-600 text-xs text-right">Sport &amp; Outdoor</div>
                        </a>
                    </div>
                </div>
            </div> -->
      <!-- END: Search -->
      <!-- BEGIN: Notifications -->
      <!-- <div class="intro-x dropdown mr-auto sm:mr-6">
                <div class="dropdown-toggle notification notification--bullet cursor-pointer" role="button" aria-expanded="false"> <i data-feather="bell" class="notification__icon dark:text-gray-300"></i> </div>
                <div class="notification-content pt-2 dropdown-menu">
                    <div class="notification-content__box dropdown-menu__content box dark:bg-dark-6">
                        <div class="notification-content__title">Notifications</div>
                        <div class="cursor-pointer relative flex items-center ">
                            <div class="w-12 h-12 flex-none image-fit mr-1">
                                <img alt="Rubick Tailwind HTML Admin Template" class="rounded-full" src="dist/images/profile-13.jpg">
                                <div class="w-3 h-3 bg-theme-9 absolute right-0 bottom-0 rounded-full border-2 border-white"></div>
                            </div>
                            <div class="ml-2 overflow-hidden">
                                <div class="flex items-center">
                                    <a href="javascript:;" class="font-medium truncate mr-5">Kevin Spacey</a>
                                    <div class="text-xs text-gray-500 ml-auto whitespace-nowrap">06:05 AM</div>
                                </div>
                                <div class="w-full truncate text-gray-600 mt-0.5">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomi</div>
                            </div>
                        </div>
                        <div class="cursor-pointer relative flex items-center mt-5">
                            <div class="w-12 h-12 flex-none image-fit mr-1">
                                <img alt="Rubick Tailwind HTML Admin Template" class="rounded-full" src="dist/images/profile-11.jpg">
                                <div class="w-3 h-3 bg-theme-9 absolute right-0 bottom-0 rounded-full border-2 border-white"></div>
                            </div>
                            <div class="ml-2 overflow-hidden">
                                <div class="flex items-center">
                                    <a href="javascript:;" class="font-medium truncate mr-5">Leonardo DiCaprio</a>
                                    <div class="text-xs text-gray-500 ml-auto whitespace-nowrap">06:05 AM</div>
                                </div>
                                <div class="w-full truncate text-gray-600 mt-0.5">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#039;s standard dummy text ever since the 1500</div>
                            </div>
                        </div>
                        <div class="cursor-pointer relative flex items-center mt-5">
                            <div class="w-12 h-12 flex-none image-fit mr-1">
                                <img alt="Rubick Tailwind HTML Admin Template" class="rounded-full" src="dist/images/profile-14.jpg">
                                <div class="w-3 h-3 bg-theme-9 absolute right-0 bottom-0 rounded-full border-2 border-white"></div>
                            </div>
                            <div class="ml-2 overflow-hidden">
                                <div class="flex items-center">
                                    <a href="javascript:;" class="font-medium truncate mr-5">Tom Hanks</a>
                                    <div class="text-xs text-gray-500 ml-auto whitespace-nowrap">01:10 PM</div>
                                </div>
                                <div class="w-full truncate text-gray-600 mt-0.5">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomi</div>
                            </div>
                        </div>
                        <div class="cursor-pointer relative flex items-center mt-5">
                            <div class="w-12 h-12 flex-none image-fit mr-1">
                                <img alt="Rubick Tailwind HTML Admin Template" class="rounded-full" src="dist/images/profile-14.jpg">
                                <div class="w-3 h-3 bg-theme-9 absolute right-0 bottom-0 rounded-full border-2 border-white"></div>
                            </div>
                            <div class="ml-2 overflow-hidden">
                                <div class="flex items-center">
                                    <a href="javascript:;" class="font-medium truncate mr-5">Denzel Washington</a>
                                    <div class="text-xs text-gray-500 ml-auto whitespace-nowrap">05:09 AM</div>
                                </div>
                                <div class="w-full truncate text-gray-600 mt-0.5">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem </div>
                            </div>
                        </div>
                        <div class="cursor-pointer relative flex items-center mt-5">
                            <div class="w-12 h-12 flex-none image-fit mr-1">
                                <img alt="Rubick Tailwind HTML Admin Template" class="rounded-full" src="dist/images/profile-6.jpg">
                                <div class="w-3 h-3 bg-theme-9 absolute right-0 bottom-0 rounded-full border-2 border-white"></div>
                            </div>
                            <div class="ml-2 overflow-hidden">
                                <div class="flex items-center">
                                    <a href="javascript:;" class="font-medium truncate mr-5">Angelina Jolie</a>
                                    <div class="text-xs text-gray-500 ml-auto whitespace-nowrap">01:10 PM</div>
                                </div>
                                <div class="w-full truncate text-gray-600 mt-0.5">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomi</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
      <!-- END: Notifications -->
      <!-- BEGIN: Account Menu -->
      <div class="intro-x dropdown w-8 h-8">
        <div
          class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in"
          role="button"
          aria-expanded="false"
        >
          <div
            v-if="
              user.role == 'Non Medical biodata' ||
              user.role == 'Medical biodata' ||
              user.role == 'Patient'
            "
          >
            <img
              alt="profile picture"
              v-if="biodata.profile_picture"
              :src="'../../../../../' + biodata.profile_picture"
            />
            <img
              alt="profile picture"
              v-else
              src="https://img.icons8.com/ios-glyphs/50/null/guest-male.png"
            />
          </div>
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

            <li>
              <router-link
                :to="{ name: 'edit-patient-profile' }"
                class="dropdown-item hover:bg-white/5"
              >
                Profile Setting
              </router-link>
            </li>
            <li>
              <router-link
                :to="{ name: 'patient-profile' }"
                class="dropdown-item hover:bg-white/5"
              >
                Profile
              </router-link>
            </li>

            <li>
              <router-link
                :to="{ name: 'change-patient-password' }"
                class="dropdown-item hover:bg-white/5"
              >
                Change Password</router-link
              >
            </li>
            <li>
              <hr class="dropdown-divider border-white/[0.08]" />
            </li>
            <li>
              <router-link
                :to="{ name: 'patient-logout' }"
                class="dropdown-item hover:bg-white/5"
              >
                <i data-lucide="toggle-right" class="w-4 h-4 mr-2"></i> Sign Out
              </router-link>
            </li>
          </ul>
          <!-- <div class="dropdown-menu__content box bg-primary/80 dark:bg-dark-6 text-white">
                        <div class="p-4 border-b border-theme-27 dark:border-dark-3">
                            <div class="font-medium">{{user.name}}</div>
                            <div class="text-xs text-theme-28 mt-0.5 dark:text-gray-600">{{user.role}}</div>
                        </div>
                        <div class="p-2">
                            <router-link v-if="user.role == 'Facility Manager'" :to="{name: 'edit-signature'}" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md"> <i data-feather="user" class="w-4 h-4 mr-2"></i> Facility Setting </router-link>
                            <router-link v-if="user.role == 'Facility Manager' && facility.facility_type == 'Hospital'" :to="{name: 'edit-hospital-class'}" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md"> <i data-feather="user" class="w-4 h-4 mr-2"></i> Hospital Setting </router-link>
                            <router-link v-if="user.role == 'Facility Manager' && facility.facility_type == 'Hospital'" :to="{name: 'edit-medical-services'}" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md"> <i data-feather="user" class="w-4 h-4 mr-2"></i> Medical Service Setting </router-link>
                            <router-link v-if="user.role == 'Facility Manager'" :to="{name: 'signature'}" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md"> <i data-feather="user" class="w-4 h-4 mr-2"></i> Facility Signature </router-link>
                            <router-link v-if="user.role == 'Medical biodata' || user.role == 'Non Medical biodata' || user.role == 'Patient'" :to="{name: 'edit-profile'}" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md"> <i data-feather="user" class="w-4 h-4 mr-2"></i>Profile Setting </router-link>
                            <router-link v-if="user.role == 'Medical biodata' || user.role == 'Non Medical biodata' || user.role == 'Patient'" :to="{name: 'profile'}" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md"> <i data-feather="user" class="w-4 h-4 mr-2"></i> Profile </router-link>
                            <router-link v-if="user.role == 'Facility Manager' && (facility.facility_type == 'Laboratory' || facility.facility_type == 'Hospital')" :to="{name: 'laboratory-tests'}" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md"> <i data-feather="edit" class="w-4 h-4 mr-2"></i> Add Medical Diagnostic &amp; Laboratory Tests </router-link>
                            <router-link :to="{name: 'change-password'}" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md"> <i data-feather="lock" class="w-4 h-4 mr-2"></i> Change Password </router-link>

                        </div>
                        <div class="p-2 border-t border-theme-27 dark:border-dark-3">
                            <router-link :to="{name: 'patient-logout'}" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md"> <i data-feather="toggle-right" class="w-4 h-4 mr-2"></i> patient-logout </router-link>
                        </div>
                    </div> -->
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
      id: null,
      token: null,
      user: "",
      facility: "",
      biodata: "",
      profile: "dist/images/profile-12.jpg",
    };
  },
  props: ["title"],
  created() {
    this.login();
    this.getPatient();
    this.getBiodata();
  },
  methods: {
    login() {
      if (Patient.loggedIn()) {
        this.id = Patient.id();
        this.token = Patient.token();
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
