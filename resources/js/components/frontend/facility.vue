<template>
    <div class="py-5">
        <!-- BEGIN: Mobile Menu -->
        <frontend-mobile-menu></frontend-mobile-menu>
        <!-- END: Mobile Menu -->
        <!-- BEGIN: Top Bar -->
        <frontend-top-bar page="Facility"></frontend-top-bar>
        <!-- END: Top Bar -->
        <!-- BEGIN: Top Menu -->
        <top-nav v-if="token != null"></top-nav>
        <!-- END: Top Menu -->
        <!-- BEGIN: Content -->
        <div class="content">
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12 xl:col-span-6 lg:col-span-6 mt-6">
                    <div class="intro-y block sm:flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">Facility Signature</h2>
                    </div>
                    <div class="intro-y box p-5">
                        <div class="intro-y block sm:flex items-center h-10">
                            <h2 class="text-lg font-medium truncate mr-5">
                                {{ data.facility.registered_facility_name }}
                            </h2>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="table border-0 text-xs">
                                <tbody>
                                    <tr>
                                        <td class="whitespace-nowrap">
                                            <span class="block uppercase font-medium">National Facility ID</span>
                                            {{ data.facility.national_facility_id }}
                                        </td>
                                        <td class="whitespace-nowrap">
                                            <span class="block uppercase font-medium">State Facility ID</span>
                                            {{ data.facility.state_facility_id }}
                                        </td>
                                        <td class="whitespace-nowrap">
                                            <span class="block uppercase font-medium">LGA Serial Number</span>
                                            {{ data.facility.lga_serial_number }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="whitespace-nowrap">
                                            <span class="block uppercase font-medium">Facility Type</span>
                                            {{ data.facility.facility_type }}
                                        </td>
                                        <td class="whitespace-nowrap">
                                            <span class="block uppercase font-medium">CAC Registration Number</span>
                                            {{ data.facility.cac_registration_number }}
                                        </td>
                                        <td class="whitespace-nowrap">
                                            <span class="block uppercase font-medium">Physical Location</span>
                                            {{ data.facility.physical_location }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="whitespace-nowrap">
                                            <span class="block uppercase font-medium">Local Government Area</span>
                                            {{ data.facility.local_government_area }}
                                        </td>
                                        <td class="whitespace-nowrap">
                                            <span class="block uppercase font-medium">State</span>
                                            {{ data.facility.state }}
                                        </td>
                                        <td class="whitespace-nowrap">
                                            <span class="block uppercase font-medium">Postal Code</span>
                                            {{ data.facility.postal_code }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="whitespace-nowrap">
                                            <span class="block uppercase font-medium">Ward</span>
                                            {{ data.facility.ward }}
                                        </td>
                                        <td class="whitespace-nowrap">
                                            <span class="block uppercase font-medium">Phone Number</span>
                                            {{ data.facility.phone_number }}
                                        </td>
                                        <td class="whitespace-nowrap">
                                            <span class="block uppercase font-medium">Website</span>
                                            {{ data.facility.website }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="block uppercase font-medium">Days of Operation</span>
                                            {{ data.facility.days_of_operation }}
                                        </td>
                                        <td class="whitespace-nowrap">
                                            <span class="block uppercase font-medium">Hours of Operation</span>
                                            {{ data.facility.hours_of_operation }}
                                        </td>
                                        <td class="whitespace-nowrap">
                                            <span class="block uppercase font-medium">Date of Commencement of
                                                Operation</span>
                                            {{
                                                data.facility.date_of_commencement_of_operation
                                                | moment("Do MMMM YYYY")
                                            }}
                                        </td>
                                    </tr>
                                    <tr v-if="data.facility.facility_type == 'Hospital'">
                                        <td class="whitespace-nowrap">
                                            <span class="block uppercase font-medium">Hospital/Clinic</span>
                                            {{ data.facility.hospital_level }}
                                        </td>
                                        <td class="whitespace-nowrap" v-if="data.facility.hospital_level == 'Primary'">
                                            <span class="block uppercase font-medium">Level Type</span>
                                            {{ data.facility.primary_level_type }}
                                        </td>
                                        <td class="whitespace-nowrap"
                                            v-else-if="data.facility.hospital_level == 'Tertiary'">
                                            <span class="block uppercase font-medium">Level Type</span>
                                            {{ data.facility.tertiary_level_type }}
                                        </td>
                                        <td class="whitespace-nowrap" v-else>
                                            <span class="block uppercase font-medium">Level Type</span> -
                                        </td>
                                        <td class="whitespace-nowrap"
                                            v-if="data.facility.tertiary_level_type == 'Specialized Hospital'">
                                            <span class="block uppercase font-medium">Tertiary Level Type</span>
                                            {{ data.facility.specialized_level_type }}
                                        </td>
                                        <td class="whitespace-nowrap" v-else>
                                            <span class="block uppercase font-medium">Sub Type</span> -
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="whitespace-nowrap">
                                            <span class="block uppercase font-medium">Ownership</span>
                                            {{ data.facility.name }}
                                        </td>
                                        <td class="whitespace-nowrap">
                                            <span class="block uppercase font-medium">Ownership Email</span>
                                            {{ data.facility.email }}
                                        </td>
                                        <td class="whitespace-nowrap">
                                            <span class="block uppercase font-medium">Ownership Type</span>
                                            {{ data.facility.ownership_type }}/
                                            <span v-if="data.facility.ownership_type == 'Private'">{{
                                                data.facility.private_type
                                            }}</span><span v-else>{{ data.facility.public_type }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="whitespace-nowrap">
                                            <span class="block uppercase font-medium">Operational Status</span>
                                            {{ data.facility.operational_status }}
                                        </td>
                                        <td class="whitespace-nowrap">
                                            <span class="block uppercase font-medium">Regulatory Status</span>
                                            {{ data.facility.regulatory_status }}
                                        </td>
                                        <td class="whitespace-nowrap">
                                            <span class="block uppercase font-medium">License Status</span>
                                            {{ data.facility.license_status }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            <span class="block uppercase font-medium">Facility Uniqueness</span>
                                            <div v-html="data.facility.facility_uniqueness"></div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 xl:col-span-3 lg:col-span-3 mt-6">
                    <div class="intro-y block sm:flex items-center h-10" v-if="data.facility.facility_type == 'Hospital'">
                        <h2 class="text-lg font-medium truncate mr-5">Hospital Services</h2>
                    </div>
                    <div class="intro-y box p-5" v-if="data.facility.facility_type == 'Hospital'">
                        <div class="overflow-x-auto">
                            <table class="table">
                                <tbody>
                                    <tr v-for="service in data.services" :key="service.id">
                                        <th>{{ service.name }}</th>
                                        <td>&#8358;{{ service.price | numeral("0,0.00") }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="intro-y block sm:flex items-center h-10" v-if="data.facility.facility_type == 'Laboratory'">
                        <h2 class="text-lg font-medium truncate mr-5">Laboratory Services</h2>
                    </div>
                    <div class="intro-y box p-5" v-if="data.facility.facility_type == 'Laboratory'">
                        <div class="overflow-x-auto">
                            <table class="table">
                                <tbody>
                                    <tr v-for="lab in data.laboratories" :key="lab.id">
                                        <th>
                                            <a :href="lab.url" target="_blank">{{ lab.test_name }}</a>
                                        </th>
                                        <td>&#8358;{{ lab.price | numeral("0,0.00") }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 xl:col-span-3 lg:col-span-3 xl:border-l xl:pl-6 mt-6">
                    <div class="intro-y block sm:flex items-center h-10" v-if="data.facility.facility_type == 'Hospital'">
                        <h2 class="text-lg font-medium truncate mr-5">Laboratory Services</h2>
                    </div>
                    <div class="intro-y box p-5" v-if="data.facility.facility_type == 'Hospital'">
                        <div class="overflow-x-auto">
                            <table class="table">
                                <tbody>
                                    <tr v-for="lab in data.laboratories" :key="lab.id">
                                        <th>
                                            <a :href="lab.url" target="_blank">{{ lab.test_name }}</a>
                                        </th>
                                        <td>&#8358;{{ lab.price | numeral("0,0.00") }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Content -->
    </div>
</template>
<script>
export default {
    name: "facility",
    data() {
        return {
            token: null,
            id: null,
            data: {},
            slug: "",
            city: "",
            laboratories: [],
            pharmacies: [],
            public_hospitals: [],
            private_hospitals: [],
        };
    },
    created() {
        this.login();
        this.getFacilityDetails();
        this.getLocation();
        this.getLaboratories();
        this.getPharmacies();
        this.getPrivateHospitals();
        this.getPublicHospitals();
    },
    methods: {
        login() {
            if (User.loggedIn()) {
                this.token = User.token();
                this.id = User.id();
            }
        },
        getFacilityDetails() {
            this.slug = this.$route.params.slug;
            axios
                .get("/api/facility-details-by-slug/" + this.slug)
                .then((response) => (this.data = response.data))
                .catch();
        },
        getLocation() {
            axios
                .get("/api/location")
                .then((response) => (this.city = response.data))
                .catch();
        },
        getLaboratories() {
            axios
                .get("/api/laboratories")
                .then((response) => (this.laboratories = response.data))
                .catch();
        },
        getPharmacies() {
            axios
                .get("/api/pharmacies")
                .then((response) => (this.pharmacies = response.data))
                .catch();
        },
        getPrivateHospitals() {
            axios
                .get("/api/private-hospitals")
                .then((response) => (this.private_hospitals = response.data))
                .catch();
        },
        getPublicHospitals() {
            axios
                .get("/api/public-hospitals")
                .then((response) => (this.public_hospitals = response.data))
                .catch();
        },
    },
};
</script>
