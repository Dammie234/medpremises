require("./bootstrap");

import Vue from "vue";
import VueRouter from "vue-router";
import VueMoment from "vue-moment";
import Multiselect from "vue-multiselect";
import VueSingleSelect from "vue-single-select";
import vSelect from "vue-select";
import Vue2Editor from "vue2-editor";
import vueNumeralFilterInstaller from "vue-numeral-filter";
import VueHtmlToPaper from "vue-html-to-paper";

// Routes Imported
import { routes } from "./routes";
// Import User Class
import User from "./helpers/user/user";
import Patient from "./helpers/patient/patient";
// Sweet alert start
import Swal from "sweetalert2";
// import notification
import Notification from "./helpers/notification";
// mobile menu
import MobileMenu from "./components/includes/user/mobile_menu.vue";
import SideMenu from "./components/includes/user/side_menu.vue";
import TopBar from "./components/includes/user/top_bar.vue";
import Setting from "./components/includes/user/setting.vue";
import ConsultationMenu from "./components/includes/user/consultation_menu.vue";

import PatientTopBar from "./components/includes/patient/top_bar.vue";
import PatientSideMenu from "./components/includes/patient/side_menu.vue";
import PatientMobileMenu from "./components/includes/patient/mobile_menu.vue";
import PatientSetting from "./components/includes/patient/setting.vue";

import TopNav from "./components/includes/top_nav.vue";
import FrontendTopBar from "./components/includes/frontend_top_bar.vue";
import FrontendMobileMenu from "./components/includes/frontend_mobile_menu.vue";
import Loader from "./components/includes/loader.vue";

import Pharmacy from "./components/widgets/pharmacy.vue";
import Laboratory from "./components/widgets/laboratory.vue";
import Hospital from "./components/widgets/hospital.vue";

import Disease from "./components/widgets/disease.vue";
import LaboratoryTest from "./components/widgets/test.vue";

const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: (toast) => {
        toast.addEventListener("mouseenter", Swal.stopTimer);
        toast.addEventListener("mouseleave", Swal.resumeTimer);
    },
});

window.Toast = Toast;
window.Swal = Swal;
window.User = User;
window.Patient = Patient;
window.Reload = new Vue();
window.Notification = Notification;

Vue.component("patient-top-bar", PatientTopBar);
Vue.component("patient-side-menu", PatientSideMenu);
Vue.component("patient-mobile-menu", PatientMobileMenu);
Vue.component("patient-setting", PatientSetting);
Vue.component("mobile-menu", MobileMenu);
Vue.component("side-menu", SideMenu);
Vue.component("top-bar", TopBar);
Vue.component("setting", Setting);
Vue.component("multiselect", Multiselect);
Vue.component("v-select", vSelect);
Vue.component("vue-single-select", VueSingleSelect);
Vue.component("top-nav", TopNav);
Vue.component("frontend-top-bar", FrontendTopBar);
Vue.component("frontend-mobile-menu", FrontendMobileMenu);
Vue.component("pharmacy", Pharmacy);
Vue.component("laboratory", Laboratory);
Vue.component("hospital", Hospital);
Vue.component("loading", Loader);
Vue.component("consultation-menu", ConsultationMenu);
Vue.component("disease", Disease);
Vue.component("laboratory-tests", LaboratoryTest);

Vue.use(VueRouter);
Vue.use(Vue2Editor);
Vue.use(VueMoment);
Vue.use(VueHtmlToPaper);
Vue.use(vueNumeralFilterInstaller, { locale: "en-gb" });

const router = new VueRouter({
    routes,
    mode: "history",
});

const app = new Vue({
    el: "#app",
    router,
});
