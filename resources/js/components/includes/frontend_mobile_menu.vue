<template>
    <div>
        <div class="mobile-menu md:hidden">
            <div class="mobile-menu-bar">
                <a href="/dashboard" class="flex mr-auto">
                    <img v-if="user.role == 'Facility Manager'" alt="Logo" class="w-20"
                        :src="'../../../../' + facility.logo" />
                    <img v-else-if="user.role == 'Medical Staff' || user.role == 'Non Medical Staff'" alt="Logo"
                        class="w-20" :src="'../../../../' + staff_facility.logo" />

                    <img v-else alt="Logo" class="w-20" :src="'../../../../' + logo" />
                </a>
                <button v-if="token" @click="dropdownList" id="mobile-menu-toggler">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-8 h-8 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12" />
                    </svg>
                </button>
            </div>
            <ul class="border-t border-white/[0.08] py-5 hidden" v-if="dropdown == true">
                <li>
                    <a href="/dashboard" class="menu">
                        <div class="menu__icon"><i class="fa fa-home"></i></div>
                        <div class="menu__title">Dashboard</div>
                    </a>
                </li>
                <li v-if="(facility.facility_type == 'Pharmaceutical Premises' &&
                        user.role == 'Facility Manager') ||
                    (facility.facility_type == 'Pharmaceutical Premises' &&
                        user.job_type == 'Pharmacist') ||
                    (facility.facility_type == 'Hospital' &&
                        user.role == 'Facility Manager' &&
                        hospital.onsite_pharmacy == true) ||
                    (facility.facility_type == 'Hospital' && user.job_type == 'Pharmacist')
                    ">
                    <a href="javascript:;" class="menu">
                        <div class="menu__icon"><i class="fa fa-tablets"></i></div>
                        <div class="menu__title" @click="openPharmacy">
                            Pharmacy <i class="fa fa-chevron-down menu__sub-icon"></i>
                        </div>
                    </a>
                    <ul class="pl-3" style="display: block" v-if="pharmacy == true">
                        <li>
                            <a href="/pharmacy/delivery" class="menu">
                                <div class="menu__icon"><i class="fa fa-truck"></i></div>
                                <div class="menu__title ml-3">Delivery</div>
                            </a>
                        </li>
                        <li>
                            <a href="/pharmacy/drug" class="menu">
                                <div class="menu__icon"><i class="fa fa-tablets"></i></div>
                                <div class="menu__title ml-3">Drug</div>
                            </a>
                        </li>
                        <li>
                            <a href="/pharmacy/drug/stock" class="menu">
                                <div class="menu__icon"><i class="fa fa-tablets"></i></div>
                                <div class="menu__title ml-3">Drug Stock</div>
                            </a>
                        </li>
                        <li>
                            <a href="/pharmacy/drug/inflows" class="menu">
                                <div class="menu__icon"><i class="fa fa-tablets"></i></div>
                                <div class="menu__title ml-3">Drug Stock Inflows</div>
                            </a>
                        </li>
                        <li>
                            <a href="/pharmacy/drug/outflows/today" class="menu">
                                <div class="menu__icon"><i class="fa fa-tablets"></i></div>
                                <div class="menu__title ml-3">Today Drug Sales</div>
                            </a>
                        </li>
                        <li>
                            <a href="/pharmacy/drug/outflows" class="menu">
                                <div class="menu__icon"><i class="fa fa-tablets"></i></div>
                                <div class="menu__title ml-3">Drug Stock Outflows</div>
                            </a>
                        </li>
                        <li>
                            <a href="/pharmacy/item" class="menu">
                                <div class="menu__icon">
                                    <img
                                        src="https://img.icons8.com/external-smashingstocks-detailed-outline-smashing-stocks/20/ffffff/external-groceries-shopping-and-commerce-smashingstocks-detailed-outline-smashing-stocks-2.png" />
                                </div>
                                <div class="menu__title ml-3">Item</div>
                            </a>
                        </li>
                        <li>
                            <a href="/pharmacy/item/stock" class="menu">
                                <div class="menu__icon">
                                    <img
                                        src="https://img.icons8.com/external-smashingstocks-detailed-outline-smashing-stocks/20/ffffff/external-groceries-shopping-and-commerce-smashingstocks-detailed-outline-smashing-stocks-2.png" />
                                </div>
                                <div class="menu__title ml-3">Item Stock</div>
                            </a>
                        </li>
                        <li>
                            <a href="/pharmacy/item/inflows" class="menu">
                                <div class="menu__icon">
                                    <img
                                        src="https://img.icons8.com/external-smashingstocks-detailed-outline-smashing-stocks/20/ffffff/external-groceries-shopping-and-commerce-smashingstocks-detailed-outline-smashing-stocks-2.png" />
                                </div>
                                <div class="menu__title ml-3">Item Inflows</div>
                            </a>
                        </li>
                        <li>
                            <a href="/pharmacy/item/outflows/today" class="menu">
                                <div class="menu__icon">
                                    <img
                                        src="https://img.icons8.com/external-smashingstocks-detailed-outline-smashing-stocks/20/ffffff/external-groceries-shopping-and-commerce-smashingstocks-detailed-outline-smashing-stocks-2.png" />
                                </div>
                                <div class="menu__title ml-3">Today Item Sales</div>
                            </a>
                        </li>
                        <li>
                            <a href="/pharmacy/item/outflows" class="menu">
                                <div class="menu__icon">
                                    <img
                                        src="https://img.icons8.com/external-smashingstocks-detailed-outline-smashing-stocks/20/ffffff/external-groceries-shopping-and-commerce-smashingstocks-detailed-outline-smashing-stocks-2.png" />
                                </div>
                                <div class="menu__title ml-3">Item Outflows</div>
                            </a>
                        </li>
                        <li>
                            <a href="/pharmacy/pos" class="menu">
                                <div class="menu__icon"><i class="fas fa-cart-plus"></i></div>
                                <div class="menu__title ml-3">POS</div>
                            </a>
                        </li>
                    </ul>
                </li>

                <li v-if="user.job_type == 'Pharmacy Attendants'">
                    <a href="javascript:;" class="menu">
                        <div class="menu__icon"><i class="fa fa-tablets"></i></div>
                        <div class="menu__title" @click="openPharmacy">
                            Pharmacy <i class="fa fa-chevron-down menu__sub-icon"></i>
                        </div>
                    </a>
                    <ul class="" style="display: block" v-if="pharmacy == true">
                        <li>
                            <a href="/pharmacy/drug/outflows/today" class="menu">
                                <div class="menu__icon"><i class="fa fa-tablets"></i></div>
                                <div class="menu__title">Today Drug Sales</div>
                            </a>
                        </li>
                        <li>
                            <a href="/pharmacy/item/outflows/today" class="menu">
                                <div class="menu__icon">
                                    <img
                                        src="https://img.icons8.com/external-smashingstocks-detailed-outline-smashing-stocks/20/ffffff/external-groceries-shopping-and-commerce-smashingstocks-detailed-outline-smashing-stocks-2.png" />
                                </div>
                                <div class="menu__title">Today Item Sales</div>
                            </a>
                        </li>
                        <li>
                            <a href="/pharmacy/pos" class="menu">
                                <div class="menu__icon"><i class="fas fa-cart-plus"></i></div>
                                <div class="menu__title">POS</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;" class="menu">
                        <div class="menu__icon">
                            <img src="https://img.icons8.com/ios/20/ffffff/medical-doctor.png" />
                        </div>
                        <div class="menu__title" @click="openMedical">
                            Medical <i class="fa fa-chevron-down menu__sub-icon"></i>
                        </div>
                    </a>
                    <ul class="" style="display: block" v-if="medical == true">
                        <li v-if="user.job_type == 'Receptionist' || user.role == 'Facility Manager'">
                            <a href="/medical/patient/checkins" class="menu">
                                <div class="menu__icon">
                                    <img
                                        src="https://img.icons8.com/external-basicons-solid-edtgraphics/20/ffffff/external-Check-in-airport-basicons-solid-edtgraphics.png" />
                                </div>
                                <div class="menu__title">Patient Checkin</div>
                            </a>
                        </li>
                        <li v-if="user.job_type == 'Receptionist' || user.role == 'Facility Manager'">
                            <a href="/medical/patient/checkouts" class="menu">
                                <div class="menu__icon">
                                    <img src="https://img.icons8.com/ios-filled/20/ffffff/hotel-chekc-out.png" />
                                </div>
                                <div class="menu__title">Patiet Checkout</div>
                            </a>
                        </li>
                        <li v-if="user.job_type == 'Receptionist' || user.role == 'Facility Manager'">
                            <a href="/medical/visitors" class="menu">
                                <div class="menu__icon">
                                    <img
                                        src="https://img.icons8.com/external-ddara-lineal-ddara/20/ffffff/external-company-visit-visitor-business-christmas-ddara-lineal-ddara.png" />
                                </div>
                                <div class="menu__title">Patient Visitors</div>
                            </a>
                        </li>
                        <li v-if="user.job_type == 'Nurse' ||
                            user.job_type == 'Medical Officer' ||
                            user.role == 'Facility Manager'
                            ">
                            <a href="/medical/vital-signs" class="menu">
                                <div class="menu__icon">
                                    <img
                                        src="https://img.icons8.com/external-line512-zulfa-mahendra/20/ffffff/external-pulse-rate-online-pharmacy-line512-zulfa-mahendra.png" />
                                </div>
                                <div class="menu__title">Vital Signs</div>
                            </a>
                        </li>
                        <li v-if="user.job_type == 'Medical Officer' || user.role == 'Facility Manager'">
                            <a href="/medical/consultations" class="menu">
                                <div class="menu__icon">
                                    <img
                                        src="https://img.icons8.com/external-line512-zulfa-mahendra/20/ffffff/external-consultation-online-pharmacy-line512-zulfa-mahendra.png" />
                                </div>
                                <div class="menu__title">Consultations</div>
                            </a>
                        </li>
                        <li v-if="user.job_type == 'Medical Officer' || user.role == 'Facility Manager'">
                            <a href="/medical/discharged-patients" class="menu">
                                <div class="menu__icon">
                                    <img src="https://img.icons8.com/ios-glyphs/20/ffffff/recovery.png" />
                                </div>
                                <div class="menu__title">Discharged Patient</div>
                            </a>
                        </li>
                        <li v-if="user.role == 'Facility Manager' || user.job_type == 'Receptionist'">
                            <a href="/medical/patient-satisfactory-survies" class="menu">
                                <div class="menu__icon">
                                    <img src="https://img.icons8.com/ios/20/ffffff/customer-survey.png" />
                                </div>
                                <div class="menu__title">Patient Satisfactory Survey</div>
                            </a>
                        </li>
                        <li v-if="user.role == 'Facility Manager' || user.job_type == 'Receptionist'">
                            <a href="/medical/patient-invoices" class="menu">
                                <div class="menu__icon">
                                    <img
                                        src="https://img.icons8.com/fluency-systems-regular/20/ffffff/file-invoice-dollar.png" />
                                </div>
                                <div class="menu__title">Patient Invoices</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li v-if="(facility.facility_type == 'Laboratory' && user.role == 'Facility Manager') ||
                    (facility.facility_type == 'Hospital' &&
                        user.role == 'Facility Manager' &&
                        hospital.onsite_laboratory == true)
                    ">
                    <a href="javascript:;" class="menu">
                        <div class="menu__icon">
                            <img
                                src="https://img.icons8.com/external-nawicon-glyph-nawicon/30/ffffff/external-laboratory-back-to-school-nawicon-glyph-nawicon.png" />
                        </div>
                        <div class="menu__title" @click="openLab">
                            Laboratory <i class="fa fa-chevron-down menu__sub-icon"></i>
                        </div>
                    </a>
                    <ul class="" style="display: block" v-if="lab == true">
                        <li>
                            <a href="/laboratory/medical-diagnostic-laboratory-tests" class="menu">
                                <div class="menu__icon">
                                    <img src="https://img.icons8.com/ios/20/ffffff/lab-items.png" />
                                </div>
                                <div class="menu__title">Medical Diagnostic &amp; Laboratory Tests</div>
                            </a>
                        </li>
                        <li>
                            <a href="/laboratory/pos" class="menu">
                                <div class="menu__icon"><i class="fas fa-cart-plus"></i></div>
                                <div class="menu__title">Laboratory Test POS</div>
                            </a>
                        </li>
                        <li>
                            <a href="/laboratory/orders" class="menu">
                                <div class="menu__icon">
                                    <img src="https://img.icons8.com/windows/20/ffffff/test-results.png" />
                                </div>
                                <div class="menu__title">Customer Orders</div>
                            </a>
                        </li>
                        <li>
                            <a href="/laboratory/results" class="menu">
                                <div class="menu__icon">
                                    <img src="https://img.icons8.com/windows/20/ffffff/test-results.png" />
                                </div>
                                <div class="menu__title">Customer Results</div>
                            </a>
                        </li>
                        <li>
                            <a href="/laboratory/results/today" class="menu">
                                <div class="menu__icon">
                                    <img src="https://img.icons8.com/windows/20/ffffff/test-results.png" />
                                </div>
                                <div class="menu__title">Customer Results Today</div>
                            </a>
                        </li>
                        <li v-if="facility.facility_type == 'Hospital'">
                            <a href="/laboratory/hospital/prenatals" class="menu">
                                <div class="menu__icon">
                                    <img
                                        src="https://img.icons8.com/external-wanicon-lineal-wanicon/20/ffffff/external-pregnancy-medical-wanicon-lineal-wanicon.png" />
                                </div>
                                <div class="menu__title">Prenatal</div>
                            </a>
                        </li>
                        <li v-if="facility.facility_type == 'Laboratory'">
                            <a href="/laboratory/prenatals" class="menu">
                                <div class="menu__icon">
                                    <img
                                        src="https://img.icons8.com/external-wanicon-lineal-wanicon/20/ffffff/external-pregnancy-medical-wanicon-lineal-wanicon.png" />
                                </div>
                                <div class="menu__title">Prenatal</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li v-if="(user.role == 'Facility Manager' || user.role == 'Medical Staff') &&
                    facility.facility_type == 'Hospital'
                    ">
                    <a href="/medical/patient-discharge-instruction" class="menu">
                        <div class="menu__icon"><i class="fa fa-file"></i></div>
                        <div class="menu__title">Patient Discharge Instruction</div>
                    </a>
                </li>
                <li v-if="(user.job_type == 'Receptionist' ||
                        user.job_type == 'Nurse' ||
                        user.job_type == 'Medical Officer' ||
                        user.role == 'Facility Manager') &&
                    facility.facility_type == 'Hospital'
                    ">
                    <a href="/medical/prenatals" class="menu">
                        <div class="menu__icon">
                            <img
                                src="https://img.icons8.com/external-wanicon-lineal-wanicon/30/ffffff/external-pregnancy-medical-wanicon-lineal-wanicon.png" />
                        </div>
                        <div class="menu__title">Prenatals/Antenatals</div>
                    </a>
                </li>
                <li v-if="(user.job_type == 'Receptionist' ||
                        user.job_type == 'Nurse' ||
                        user.job_type == 'Medical Officer' ||
                        user.role == 'Facility Manager') &&
                    facility.facility_type == 'Hospital'
                    ">
                    <a href="javascript:;" class="menu" @click="openRecord">
                        <div class="menu__icon">
                            <img src="https://img.icons8.com/ios/30/ffffff/big-data.png" />
                        </div>
                        <div class="menu__title">Data Records<i class="menu__sub-icon"></i></div>
                    </a>
                    <ul class="" style="display: block" v-if="record == true">
                        <li>
                            <a href="/medical/records/death" class="menu">
                                <div class="menu__icon">
                                    <img src="https://img.icons8.com/ios/20/ffffff/skull.png" />
                                </div>
                                <div class="menu__title">Death</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu__devider my-6"></li>
                <li v-if="user.role == 'Facility Manager' || user.role == 'Medical Staff'">
                    <a href="/staff/posts" class="menu">
                        <div class="menu__icon">
                            <img src="https://img.icons8.com/ios/30/ffffff/news.png" />
                        </div>
                        <div class="menu__title">Posts</div>
                    </a>
                </li>
                <li>
                    <a href="javascript:;" class="menu">
                        <div class="menu__icon">
                            <img
                                src="https://img.icons8.com/external-smashingstocks-detailed-outline-smashing-stocks/30/ffffff/external-human-resources-content-marketing-smashingstocks-detailed-outline-smashing-stocks-2.png" />
                        </div>
                        <div class="menu__title">
                            Human Resources <i class="fa fa-chevron-down menu__sub-icon"></i>
                        </div>
                    </a>
                    <ul class="" style="display: block" v-if="hr == true">
                        <li>
                            <a href="/facility/hr/medical-staffs" class="menu">
                                <div class="menu__icon">
                                    <img src="https://img.icons8.com/ios/20/ffffff/medical-doctor.png" />
                                </div>
                                <div class="menu__title">Medical Staff</div>
                            </a>
                        </li>
                        <li>
                            <a href="/facility/hr/non-medical-staffs" class="menu">
                                <div class="menu__icon">
                                    <img src="https://img.icons8.com/ios/20/ffffff/staff.png" />
                                </div>
                                <div class="menu__title">Non Medical Staff</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="/" class="menu">
                        <div class="menu__icon">
                            <img
                                src="https://img.icons8.com/external-lylac-kerismaker/30/ffffff/external-Frontend-web-development-lylac-kerismaker.png" />
                        </div>
                        <div class="menu__title">Front Page</div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</template>
<script>
export default {
    name: "frontend-mobile-menu",
    data() {
        return {
            id: null,
            token: null,
            staff_facility: "",
            hospital: "",
            user: "",
            facility: "",
            logo: "dist/images/logo-white.png",
            dropdown: false,
            pharmacy: false,
            medical: false,
            lab: false,
            record: false,
            hr: false,
        };
    },
    created() {
        this.login();
        this.getUser();
        this.getFacilitySignature();
        this.getMedicalStaffFacility();
        this.getHospitalClass();
    },
    methods: {
        dropdownList() {
            if (this.dropdown == false) {
                this.dropdown = true;
            } else {
                this.dropdown = false;
            }
        },
        openPharmacy() {
            if (this.pharmacy == false) {
                this.pharmacy = true;
            } else {
                this.pharmacy = false;
            }
        },
        openMedical() {
            if (this.medical == false) {
                this.medical = true;
            } else {
                this.medical = false;
            }
        },
        openLab() {
            if (this.lab == false) {
                this.lab = true;
            } else {
                this.lab = false;
            }
        },
        openRecord() {
            if (this.record == false) {
                this.record = true;
            } else {
                this.record = false;
            }
        },
        openHR() {
            if (this.hr == false) {
                this.hr = true;
            } else {
                this.hr = false;
            }
        },
        login() {
            if (User.loggedIn()) {
                this.id = User.id();
                this.token = User.token();
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
                .catch();
        },
        getFacilitySignature() {
            axios
                .get("/api/v1/facility-details/" + this.token, {
                    headers: {
                        Authorization: "Bearer " + this.token,
                        Accept: "application/json",
                    },
                })
                .then((response) => (this.facility = response.data))
                .catch();
        },
        getMedicalStaffFacility() {
            axios
                .get("/api/v1/medical-staff-facility/" + this.id, {
                    headers: {
                        Authorization: "Bearer " + this.token,
                        Accept: "application/json",
                    },
                })
                .then((response) => (this.staff_facility = response.data))
                .catch();
        },
        getHospitalClass() {
            axios
                .get("/api/v1/hospital-class/" + this.token, {
                    headers: {
                        Authorization: "Bearer " + this.token,
                        Accept: "application/json",
                    },
                })
                .then((response) => (this.hospital = response.data))
                .catch();
        },
    },
};
</script>
