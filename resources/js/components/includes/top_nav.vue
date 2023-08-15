<template>
    <div>
        <nav class="top-nav">
            <ul>
                <li>
                    <a href="/dashboard" v-if="page && page == 'frontpage'" class="top-menu top-menu--active">
                        <div class="top-menu__icon"><i class="fa fa-home"></i></div>
                        <div class="top-menu__title">Dashboard</div>
                    </a>
                    <a href="/dashboard" v-else class="top-menu">
                        <div class="top-menu__icon"><i class="fa fa-home"></i></div>
                        <div class="top-menu__title">Dashboard</div>
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
                    <a href="javascript:;" class="top-menu">
                        <div class="top-menu__icon"><i class="fa fa-tablets"></i></div>
                        <div class="top-menu__title">
                            Pharmacy <i class="fa fa-chevron-down top-menu__sub-icon"></i>
                        </div>
                    </a>

                    <ul class="">
                        <li>
                            <router-link :to="{ name: 'delivery' }" class="top-menu">
                                <div class="top-menu__icon"><i class="fa fa-truck"></i></div>
                                <div class="top-menu__title">Delivery</div>
                            </router-link>
                        </li>
                        <li>
                            <router-link :to="{ name: 'drug' }" class="top-menu">
                                <div class="top-menu__icon"><i class="fa fa-tablets"></i></div>
                                <div class="top-menu__title">Drug</div>
                            </router-link>
                        </li>
                        <li>
                            <router-link :to="{ name: 'drug-stock' }" class="top-menu">
                                <div class="top-menu__icon"><i class="fa fa-tablets"></i></div>
                                <div class="top-menu__title">Drug Stock</div>
                            </router-link>
                        </li>
                        <li>
                            <router-link :to="{ name: 'drug-inflow' }" class="top-menu">
                                <div class="top-menu__icon"><i class="fa fa-tablets"></i></div>
                                <div class="top-menu__title">Drug Stock Inflows</div>
                            </router-link>
                        </li>
                        <li>
                            <router-link :to="{ name: 'drug-outflow-today' }" class="top-menu">
                                <div class="top-menu__icon"><i class="fa fa-tablets"></i></div>
                                <div class="top-menu__title">Today Drug Sales</div>
                            </router-link>
                        </li>
                        <li>
                            <router-link :to="{ name: 'drug-outflow' }" class="top-menu">
                                <div class="top-menu__icon"><i class="fa fa-tablets"></i></div>
                                <div class="top-menu__title">Drug Stock Outflows</div>
                            </router-link>
                        </li>
                        <li>
                            <router-link :to="{ name: 'item' }" class="top-menu">
                                <div class="top-menu__icon">
                                    <img
                                        src="https://img.icons8.com/external-smashingstocks-detailed-outline-smashing-stocks/20/ffffff/external-groceries-shopping-and-commerce-smashingstocks-detailed-outline-smashing-stocks-2.png" />
                                </div>
                                <div class="top-menu__title">Item</div>
                            </router-link>
                        </li>
                        <li>
                            <router-link :to="{ name: 'item-stock' }" class="top-menu">
                                <div class="top-menu__icon">
                                    <img
                                        src="https://img.icons8.com/external-smashingstocks-detailed-outline-smashing-stocks/20/ffffff/external-groceries-shopping-and-commerce-smashingstocks-detailed-outline-smashing-stocks-2.png" />
                                </div>
                                <div class="top-menu__title">Item Stock</div>
                            </router-link>
                        </li>
                        <li>
                            <router-link :to="{ name: 'item-inflow' }" class="top-menu">
                                <div class="top-menu__icon">
                                    <img
                                        src="https://img.icons8.com/external-smashingstocks-detailed-outline-smashing-stocks/20/ffffff/external-groceries-shopping-and-commerce-smashingstocks-detailed-outline-smashing-stocks-2.png" />
                                </div>
                                <div class="top-menu__title">Item Inflows</div>
                            </router-link>
                        </li>
                        <li>
                            <router-link :to="{ name: 'item-outflow-today' }" class="top-menu">
                                <div class="top-menu__icon">
                                    <img
                                        src="https://img.icons8.com/external-smashingstocks-detailed-outline-smashing-stocks/20/ffffff/external-groceries-shopping-and-commerce-smashingstocks-detailed-outline-smashing-stocks-2.png" />
                                </div>
                                <div class="top-menu__title">Today Item Sales</div>
                            </router-link>
                        </li>
                        <li>
                            <router-link :to="{ name: 'item-outflow' }" class="top-menu">
                                <div class="top-menu__icon">
                                    <img
                                        src="https://img.icons8.com/external-smashingstocks-detailed-outline-smashing-stocks/20/ffffff/external-groceries-shopping-and-commerce-smashingstocks-detailed-outline-smashing-stocks-2.png" />
                                </div>
                                <div class="top-menu__title">Item Outflows</div>
                            </router-link>
                        </li>
                        <li>
                            <router-link :to="{ name: 'pos' }" class="top-menu">
                                <div class="top-menu__icon"><i class="fas fa-cart-plus"></i></div>
                                <div class="top-menu__title">POS</div>
                            </router-link>
                        </li>
                    </ul>
                </li>
                <li v-if="user.job_type == 'Pharmacy Attendants'">
                    <a href="javascript:;" class="top-menu">
                        <div class="top-menu__icon"><i class="fa fa-tablets"></i></div>
                        <div class="top-menu__title">
                            Pharmacy <i class="fa fa-chevron-down top-menu__sub-icon"></i>
                        </div>
                    </a>
                    <ul class="">
                        <li>
                            <router-link :to="{ name: 'drug-outflow-today' }" class="top-menu">
                                <div class="top-menu__icon"><i class="fa fa-tablets"></i></div>
                                <div class="top-menu__title">Today Drug Sales</div>
                            </router-link>
                        </li>
                        <li>
                            <router-link :to="{ name: 'item-outflow-today' }" class="top-menu">
                                <div class="top-menu__icon">
                                    <img
                                        src="https://img.icons8.com/external-smashingstocks-detailed-outline-smashing-stocks/20/ffffff/external-groceries-shopping-and-commerce-smashingstocks-detailed-outline-smashing-stocks-2.png" />
                                </div>
                                <div class="top-menu__title">Today Item Sales</div>
                            </router-link>
                        </li>
                        <li>
                            <router-link :to="{ name: 'pos' }" class="top-menu">
                                <div class="top-menu__icon"><i class="fas fa-cart-plus"></i></div>
                                <div class="top-menu__title">POS</div>
                            </router-link>
                        </li>
                    </ul>
                </li>
                <li v-if="(user.job_type == 'Receptionist' ||
                        user.job_type == 'Nurse' ||
                        user.job_type == 'Medical Officer' ||
                        user.role == 'Facility Manager') &&
                    facility.facility_type == 'Hospital'
                    ">
                    <a href="javascript:;" class="top-menu">
                        <div class="top-menu__icon">
                            <img src="https://img.icons8.com/ios/25/ffffff/medical-doctor.png" />
                        </div>
                        <div class="top-menu__title">
                            Medical <i class="fa fa-chevron-down top-menu__sub-icon"></i>
                        </div>
                    </a>
                    <ul class="">
                        <li v-if="user.job_type == 'Receptionist' || user.role == 'Facility Manager'">
                            <router-link :to="{ name: 'patient-checkins' }" class="top-menu">
                                <div class="top-menu__icon">
                                    <img
                                        src="https://img.icons8.com/external-basicons-solid-edtgraphics/20/ffffff/external-Check-in-airport-basicons-solid-edtgraphics.png" />
                                </div>
                                <div class="top-menu__title">Patient Checkin</div>
                            </router-link>
                        </li>
                        <li v-if="user.job_type == 'Receptionist' || user.role == 'Facility Manager'">
                            <router-link :to="{ name: 'patient-checkouts' }" class="top-menu">
                                <div class="top-menu__icon">
                                    <img src="https://img.icons8.com/ios-filled/20/ffffff/hotel-chekc-out.png" />
                                </div>
                                <div class="top-menu__title">Patient Checkout</div>
                            </router-link>
                        </li>
                        <li v-if="user.job_type == 'Receptionist' || user.role == 'Facility Manager'">
                            <router-link :to="{ name: 'visitors' }" class="top-menu">
                                <div class="top-menu__icon">
                                    <img
                                        src="https://img.icons8.com/external-ddara-lineal-ddara/20/ffffff/external-company-visit-visitor-business-christmas-ddara-lineal-ddara.png" />
                                </div>
                                <div class="top-menu__title">Patient Visitors</div>
                            </router-link>
                        </li>
                        <li v-if="user.job_type == 'Nurse' ||
                            user.job_type == 'Medical Officer' ||
                            user.role == 'Facility Manager'
                            ">
                            <router-link :to="{ name: 'vital-signs' }" class="top-menu">
                                <div class="top-menu__icon">
                                    <img
                                        src="https://img.icons8.com/external-line512-zulfa-mahendra/20/ffffff/external-pulse-rate-online-pharmacy-line512-zulfa-mahendra.png" />
                                </div>
                                <div class="top-menu__title">Vital Sign</div>
                            </router-link>
                        </li>
                        <li v-if="user.job_type == 'Medical Officer' || user.role == 'Facility Manager'">
                            <router-link :to="{ name: 'consultations' }" class="top-menu">
                                <div class="top-menu__icon">
                                    <img
                                        src="https://img.icons8.com/external-line512-zulfa-mahendra/20/ffffff/external-consultation-online-pharmacy-line512-zulfa-mahendra.png" />
                                </div>
                                <div class="top-menu__title">Consultations</div>
                            </router-link>
                        </li>
                        <li v-if="user.job_type == 'Medical Officer' || user.role == 'Facility Manager'">
                            <router-link :to="{ name: 'discharged-patients' }" class="top-menu">
                                <div class="top-menu__icon">
                                    <img src="https://img.icons8.com/ios-glyphs/20/ffffff/recovery.png" />
                                </div>
                                <div class="top-menu__title">Discharged Patients</div>
                            </router-link>
                        </li>
                        <li v-if="user.role == 'Facility Manager' || user.job_type == 'Receptionist'">
                            <router-link :to="{ name: 'hospital-patient-satisfactory-survies' }" class="top-menu">
                                <div class="top-menu__icon">
                                    <img src="https://img.icons8.com/ios/20/ffffff/customer-survey.png" />
                                </div>
                                <div class="top-menu__title">Patient Satisfactry Survies</div>
                            </router-link>
                        </li>
                        <li v-if="user.role == 'Facility Manager' || user.job_type == 'Receptionist'">
                            <router-link :to="{ name: 'unpaid-invoices' }" class="top-menu">
                                <div class="top-menu__icon">
                                    <img
                                        src="https://img.icons8.com/fluency-systems-regular/20/ffffff/file-invoice-dollar.png" />
                                </div>
                                <div class="top-menu__title">Patient Invoices</div>
                            </router-link>
                        </li>
                    </ul>
                </li>
                <li v-if="(facility.facility_type == 'Laboratory' && user.role == 'Facility Manager') ||
                    (facility.facility_type == 'Hospital' &&
                        user.role == 'Facility Manager' &&
                        hospital.onsite_laboratory == true)
                    ">
                    <a href="javascript:;" class="top-menu">
                        <div class="top-menu__icon">
                            <img
                                src="https://img.icons8.com/external-nawicon-glyph-nawicon/20/ffffff/external-laboratory-back-to-school-nawicon-glyph-nawicon.png" />
                        </div>
                        <div class="top-menu__title">
                            Laboratory <i class="fa fa-chevron-down top-menu__sub-icon"></i>
                        </div>
                    </a>
                    <ul class="">
                        <li>
                            <router-link :to="{ name: 'lab-tests' }" class="top-menu">
                                <div class="top-menu__icon"><i data-lucide="activity"></i></div>
                                <div class="top-menu__title">
                                    Medical Diagnostic &amp; Laboratory Tests
                                </div>
                            </router-link>
                        </li>
                        <li>
                            <router-link :to="{ name: 'lab-pos' }" class="top-menu">
                                <div class="top-menu__icon"><i class="fas fa-cart-plus"></i></div>
                                <div class="top-menu__title">Laboratory Test POS</div>
                            </router-link>
                        </li>
                        <li>
                            <router-link :to="{ name: 'lab-patient-orders' }" class="top-menu">
                                <div class="top-menu__icon">
                                    <img src="https://img.icons8.com/windows/20/ffffff/test-results.png" />
                                </div>
                                <div class="top-menu__title">Customer Orders</div>
                            </router-link>
                        </li>
                        <li>
                            <router-link :to="{ name: 'lab-results' }" class="top-menu">
                                <div class="top-menu__icon">
                                    <img
                                        src="https://img.icons8.com/external-wanicon-lineal-wanicon/20/ffffff/external-pregnancy-medical-wanicon-lineal-wanicon.png" />
                                </div>
                                <div class="top-menu__title">Customer Results</div>
                            </router-link>
                        </li>
                        <li>
                            <router-link :to="{ name: 'lab-results-today' }" class="top-menu">
                                <div class="top-menu__icon"><i data-lucide="activity"></i></div>
                                <div class="top-menu__title">Customer Results Today</div>
                            </router-link>
                        </li>
                        <li v-if="facility.facility_type == 'Hospital'">
                            <router-link :to="{ name: 'lab-prenatals' }" class="top-menu">
                                <div class="top-menu__icon">
                                    <img
                                        src="https://img.icons8.com/external-wanicon-lineal-wanicon/20/ffffff/external-pregnancy-medical-wanicon-lineal-wanicon.png" />
                                </div>
                                <div class="top-menu__title">Prenatals/Antenatals</div>
                            </router-link>
                        </li>
                        <li v-if="facility.facility_type == 'Laboratory'">
                            <router-link :to="{ name: 'laboratory-prenatals' }" class="top-menu">
                                <div class="top-menu__icon">
                                    <img
                                        src="https://img.icons8.com/external-wanicon-lineal-wanicon/20/ffffff/external-pregnancy-medical-wanicon-lineal-wanicon.png" />
                                </div>
                                <div class="top-menu__title">Prenatals/Antenatals</div>
                            </router-link>
                        </li>
                    </ul>
                </li>
                <li v-if="facility.facility_type == 'Laboratory' && user.job_type == 'Receptionist'">
                    <a href="javascript:;" class="top-menu">
                        <div class="top-menu__icon">
                            <img
                                src="https://img.icons8.com/external-nawicon-glyph-nawicon/20/ffffff/external-laboratory-back-to-school-nawicon-glyph-nawicon.png" />
                        </div>
                        <div class="top-menu__title">
                            Laboratory <i class="fa fa-chevron-down top-menu__sub-icon"></i>
                        </div>
                    </a>
                    <ul class="">
                        <li>
                            <router-link :to="{ name: 'lab-tests' }" class="top-menu">
                                <div class="top-menu__icon">
                                    <img src="https://img.icons8.com/ios/20/fffffff/lab-items.png" />
                                </div>
                                <div class="top-menu__title">
                                    Medical Diagnostic &amp; Laboratory Tests
                                </div>
                            </router-link>
                        </li>
                        <li>
                            <router-link :to="{ name: 'lab-pos' }" class="top-menu">
                                <div class="top-menu__icon"><i class="fas fa-cart-plus"></i></div>
                                <div class="top-menu__title">Laboratory Test POS</div>
                            </router-link>
                        </li>
                        <li>
                            <router-link :to="{ name: 'lab-patient-orders' }" class="top-menu">
                                <div class="top-menu__icon">
                                    <img src="https://img.icons8.com/windows/20/ffffff/test-results.png" />
                                </div>
                                <div class="top-menu__title">Customer Orders</div>
                            </router-link>
                        </li>
                        <li v-if="facility.facility_type == 'Hospital'">
                            <router-link href="https://rubick.left4code.com/page/top-menu/light/file-upload"
                                class="top-menu">
                                <div class="top-menu__icon">
                                    <img
                                        src="https://img.icons8.com/external-wanicon-lineal-wanicon/20/ffffff/external-pregnancy-medical-wanicon-lineal-wanicon.png" />
                                </div>
                                <div class="top-menu__title">Prenatals/Antenatals</div>
                            </router-link>
                        </li>

                        <li v-if="facility.facility_type == 'Laboratory'">
                            <router-view :to="{ name: 'laboratory-prenatals' }" class="top-menu">
                                <div class="top-menu__icon"><i data-lucide="activity"></i></div>
                                <div class="top-menu__title">Prenatals/Antenatals</div>
                            </router-view>
                        </li>
                    </ul>
                </li>
                <li v-if="(user.role == 'Facility Manager' || user.role == 'Medical Staff') &&
                    facility.facility_type == 'Hospital'
                    ">
                    <router-link :to="{ name: 'patient-discharge-instruction' }" class="top-menu">
                        <div class="top-menu__icon"><i class="fa fa-file"></i></div>
                        <div class="top-menu__title">Discharge Instructions</div>
                    </router-link>
                </li>
                <li v-if="(user.role == 'Facility Manager' || user.role == 'Medical Staff') &&
                    facility.facility_type == 'Hospital'
                    ">
                    <router-link :to="{ name: 'prenatals' }" class="top-menu">
                        <div class="top-menu__icon">
                            <img
                                src="https://img.icons8.com/external-wanicon-lineal-wanicon/20/ffffff/external-pregnancy-medical-wanicon-lineal-wanicon.png" />
                        </div>
                        <div class="top-menu__title">Prenatals</div>
                    </router-link>
                </li>
                <li v-if="(user.job_type == 'Receptionist' ||
                        user.job_type == 'Nurse' ||
                        user.job_type == 'Medical Officer' ||
                        user.role == 'Facility Manager') &&
                    facility.facility_type == 'Hospital'
                    ">
                    <a href="javascript:;" class="top-menu">
                        <div class="top-menu__icon">
                            <img src="https://img.icons8.com/ios/20/ffffff/big-data.png" />
                        </div>
                        <div class="top-menu__title">
                            Records <i class="fa fa-chevron-down top-menu__sub-icon"></i>
                        </div>
                    </a>
                    <ul class="">
                        <li v-if="user.job_type == 'Nurse' ||
                            user.job_type == 'Medical Officer' ||
                            user.role == 'Facility Manager'
                            ">
                            <router-link :to="{ name: 'death-records' }" class="top-menu">
                                <div class="top-menu__icon">
                                    <img src="https://img.icons8.com/ios/20/ffffff/skull.png" />
                                </div>
                                <div class="top-menu__title">Death</div>
                            </router-link>
                        </li>
                    </ul>
                </li>
                <li v-if="user.role == 'Facility Manager' || user.role == 'Medical Staff'">
                    <a href="/staff/posts" class="top-menu">
                        <div class="top-menu__icon">
                            <img src="https://img.icons8.com/ios/20/ffffff/news.png" />
                        </div>
                        <div class="top-menu__title">Posts</div>
                    </a>
                </li>
                <li v-if="user.role == 'Facility Manager'">
                    <a href="javascript:;" class="top-menu">
                        <div class="top-menu__icon">
                            <img
                                src="https://img.icons8.com/external-smashingstocks-detailed-outline-smashing-stocks/20/ffffff/external-human-resources-content-marketing-smashingstocks-detailed-outline-smashing-stocks-2.png" />
                        </div>
                        <div class="top-menu__title">
                            Human Resources <i class="fa fa-chevron-down top-menu__sub-icon"></i>
                        </div>
                    </a>
                    <ul class="">
                        <li>
                            <router-link :to="{ name: 'medical-staffs' }" class="top-menu">
                                <div class="top-menu__icon">
                                    <img src="https://img.icons8.com/ios/20/ffffff/medical-doctor.png" />
                                </div>
                                <div class="top-menu__title">Medical Staff</div>
                            </router-link>
                        </li>
                        <li>
                            <router-link :to="{ name: 'non-medical-staffs' }" class="top-menu">
                                <div class="top-menu__icon">
                                    <img src="https://img.icons8.com/ios/20/ffffff/staff.png" />
                                </div>
                                <div class="top-menu__title">Non Medical Staff</div>
                            </router-link>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</template>
<script>
export default {
    name: "top-nav",
    props: ["page"],
    data() {
        return {
            id: null,
            token: null,

            user: "",
            facility: "",

            staff_facility: "",
            hospital: "",

            logo: "dist/images/logo-white.png",
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
        login() {
            if (!User.loggedIn()) {
                this.$router.push({
                    name: "logout",
                });
            } else {
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
        getMedicalStaffFacility() {
            axios
                .get("/api/v1/medical-staff-facility/" + this.id, {
                    headers: {
                        Authorization: "Bearer " + this.token,
                        Accept: "application/json",
                    },
                })
                .then((response) => (this.staff_facility = response.data))
                .catch((error) => {
                    console.log(error);
                    if (error.response.status == 401) {
                        this.$router.push({
                            name: "logout",
                        });
                    }
                });
        },
        getHospitalClass() {
            axios
                .get("/api/v1/hospital-class/" + this.id, {
                    headers: {
                        Authorization: "Bearer " + this.token,
                        Accept: "application/json",
                    },
                })
                .then((response) => (this.hospital = response.data))
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
