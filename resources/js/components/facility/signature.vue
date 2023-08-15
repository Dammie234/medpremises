<template>
<div class="main">
    <!-- BEGIN: Mobile Menu -->
    <mobile-menu></mobile-menu>
    <!-- END: Mobile Menu -->
    <div class="flex">
        <!-- BEGIN: Side Menu -->
        <side-menu page="dashboard"></side-menu>
        <!-- END: Side Menu -->
        <!-- BEGIN: Content -->
        <div class="content">
            <!-- BEGIN: Top Bar -->
            <top-bar title="Facility Signature"></top-bar>
            <!-- END: Top Bar -->
            <div class="intro-y flex items-center mt-8">
                <h2 class="text-lg font-medium mr-auto">
                    Facility Signature
                </h2>
            </div>
            <div class="grid grid-cols-12 gap-6">
                <!-- BEGIN: Profile Menu -->
                <div class="col-span-12 lg:col-span-4 xxl:col-span-3 flex lg:block flex-col-reverse">
                    <setting page="Profile Setting"></setting>
                </div>
                <!-- END: Profile Menu -->
                <div class="col-span-12 lg:col-span-8 xxl:col-span-9">
                    <!-- BEGIN: Display Information -->
                    <div class="intro-y box lg:mt-5">
                        <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                            <h2 class="font-medium text-base mr-auto">
                                Personal Information
                            </h2>
                        </div>
                        <div class="p-5">
                            <div class="flex flex-col-reverse xl:flex-row flex-col">
                                <div  class="flex-1 mt-6 xl:mt-0">
                                    <div class="grid grid-cols-12 gap-x-5">
                                        <div class="col-span-12 xxl:col-span-12">
                                            <div class="overflow-x-auto">
                                                <table class="table">
                                                    <tr>
                                                        <td><span>Display Name</span>{{user.name}}</td>
                                                        <td><span>Email Address</span>{{user.email}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><span>NIN Number</span>{{user.nin_number}}</td>
                                                        <td><span>Role</span>{{user.role}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><span>MDCN Number</span>{{user.mdcn_number}}</td>
                                                        <td></td>
                                                    </tr>
                                                </table>
                                            </div>  
                                        </div>
                                    </div>
                                </div>
                                <div  class="w-52 mx-auto xl:mr-0 xl:ml-6" >
                                    <div class="border-2 border-dashed shadow-sm border-gray-200 dark:border-dark-5 rounded-md p-5">
                                        <div class="h-40 relative image-fit cursor-pointer zoom-in mx-auto">
                                            <img class="rounded-md" alt="Rubick Tailwind HTML Admin Template" v-if="facility.ownership_picture" :src="'../../' + facility.ownership_picture">
                                            <img class="rounded-md" alt="Rubick Tailwind HTML Admin Template" v-else :src="'../../' + profile">
                                            <div title="Remove this profile photo?" class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-theme-6 right-0 top-0 -mr-2 -mt-2"> <i data-feather="x" class="w-4 h-4"></i> </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <!-- END: Display Information -->
                    <!-- BEGIN: Personal Information -->
                    <div class="intro-y box mt-5">
                        <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                            <h2 class="font-medium text-base mr-auto">
                                Facility Signature
                            </h2>
                        </div>
                        <div class="p-5">
                            <div class="grid grid-cols-12 gap-x-5">
                                <div class="col-span-12 xl:col-span-12">
                                    <div class="overflow-x-auto">
                                        <table class="table">
                                            <tr>
                                                <td><span>National Facility ID</span>{{facility.national_facility_id}}</td>
                                                <td><span>State Facility ID</span>{{facility.state_facility_id}}</td>
                                                <td><span>CAC Registration Number</span>facility.cac_registration_number</td>
                                            </tr>
                                            <tr>
                                                <td><span>Date of Commencement of Operation</span>{{facility.date_of_commencement_of_operation | moment('DD/MM/YYYY')}}</td>
                                                <td><span>Registered Facility Name</span>{{facility.registered_facility_name}}</td>
                                                <td><span>State</span>{{facility.state}}</td>
                                            </tr>
                                            <tr>
                                                <td><span>Local Government Area</span>{{facility.local_government_area}}</td>
                                                <td><span>Ward</span>{{facility.ward}}</td>
                                                <td><span>Facility Type</span>{{facility.facility_type}}</td>
                                            </tr>
                                            <tr>
                                                <td><span>LGA Serial Number</span>{{facility.lga_serial_number}}</td>
                                                <td><span>Physical Location</span>{{facility.physical_location}}</td>
                                                <td><span>GPS Coordinate (Longtitude)</span>{{facility.gps_coordinate_longtitude}}</td>
                                            </tr>
                                            <tr>
                                                <td><span>GPS Coordinate (Latitude)</span>{{facility.gps_coordinate_latitude}}</td>
                                                <td><span>Postal Code</span>{{facility.postal_code}}</td>
                                                <td><span>Phone Number</span>{{facility.phone_number}}</td>
                                            </tr>
                                            <tr>
                                                <td><span>Website</span>{{facility.website}}</td>
                                                <td><span>Days of Operation</span>{{facility.days_of_operation}}</td>
                                                <td><span>Hours of Operation</span>{{facility.hours_of_operation}}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                
                                
                                <div class="col-span-12 xl:col-span-12 mt-4">
                                    <div class="grid grid-cols-12" v-if="facility.facility_type == 'Hospital'">
                                        <div class="col-span-12 xl:col-span-3">
                                            <h4 class="mt-5 pt-5">Hospital/CLinic Level</h4>
                                        </div>
                                        <div class="col-span-12 xl:col-span-9">
                                            <div class="grid grid-cols-12 gap-x-5">
                                                <div class="col-span-12 xl:col-span-4">
                                                    <div class="mt-3" v-if="facility.hospital_level && facility.hospital_level == 'Primary'">
                                                        Primary
                                                    </div>
                                                    <div class="mt-3" v-else>
                                                        -
                                                    </div>
                                                </div>
                                                <div class="col-span-12 xl:col-span-4">
                                                     {{facility.hospital_level_type}}
                                                </div>
                                                <div class="col-span-12 xl:col-span-4"></div>
                                            </div>
                                            <div class="grid grid-cols-12 mt-3">
                                                <div class="col-span-12 xl:col-span-4">
                                                    <div class="" v-if="facility.hospital_level && facility.hospital_level == 'Secondary'">
                                                        Secondary
                                                    </div>
                                                    <div class="" v-else>
                                                        -
                                                    </div>
                                                </div>
                                                <div class="col-span-12 xl:col-span-4">
                                                
                                                </div>
                                                <div class="col-span-12 xl:col-span-4"></div>
                                            </div>
                                            <div class="grid grid-cols-12 mt-3 gap-x-5">
                                                <div class="col-span-12 xl:col-span-4">
                                                    <div class=" mt-4" v-if="facility.hospital_level && facility.hospital_level == 'Tertiary'">
                                                        Tertiary
                                                    </div>
                                                    <div class="mt-4" v-else>
                                                        -
                                                    </div>
                                                </div>
                                                <div class="col-span-12 xl:col-span-4">
                                                    {{facility.tertiary_level_type}}
                                                </div>
                                                <div class="col-span-12 xl:col-span-4">
                                                    <div class="" v-if="facility.tertiary_level_type && facility.tertiary_level_type == 'Speacialized Hospital'">
                                                        {{facility.specialized_hospital_type}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-12 xl:col-span-12 mt-4">
                                    <div class="grid grid-cols-12">
                                        <div  class="col-span-12 xl:col-span-3">
                                            <h4 class="mt-3">Ownership Details</h4>
                                            
                                        </div>
                                        <div  class="col-span-12 xl:col-span-9">
                                            <div class="grid grid-cols-12" v-if="facility.ownership_type && facility.ownership_type == 'Public'">
                                                <div class="col-span-12 xl:col-span-4">
                                                    Public
                                                </div>
                                                <div class="col-span-12 xl:col-span-8">
                                                     {{facility.public_type}}
                                                </div>
                                            </div>
                                            <div class="grid grid-cols-12 mt-4" v-if="facility.ownership_type && facility.ownership_type == 'Private'">
                                                <div class="col-span-12 xl:col-span-4">
                                                    Private
                                                </div>
                                                <div class="col-span-12 xl:col-span-8">
                                                    <div class="flex flex-col sm:flex-row mt-2">
                                                        <div class=" mr-4" v-if="facility.private_type && facility.private_type == 'For Profit'"> 
                                                            {{facility.private_type}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-12 xl:col-span-12 mt-4">
                                    <table class="table">
                                        <tr>
                                            <td colspan="2"><span>What make your facility unique from others?</span><div v-html="facility.facility_uniqueness"></div></td>
                                        </tr>
                                        <tr>
                                            <td><span>Operational Status</span>{{facility.operational_status}}</td>
                                            <td><span>License Status</span>{{facility.license_status}}</td>
                                        </tr>
                                    </table>
                                </div>
                                
                            </div>
                           
                        </div>
                    </div>
                    <!-- END: Personal Information -->
                </div>
                
            </div>
        </div>
        <!-- END: Content -->
    </div>
</div>
</template>

<script>
export default {
    name: 'edit-signature',
    data() {
        return {
            id: null,
            token: null,
            user: '',
            facility: '',
            profile: 'dist/images/profile-10.jpg'
           
        }
    },
    created() {
        this.login()
        this.getUser()
        this.getFacilitySignature()

    },
    methods: {
        login(){
            if (!User.loggedIn()) {
                this.$router.push({
                        name: 'logout'
                    })
            }else{
                this.id = User.id()
                this.token = User.token()
            }
        },
        getUser(){
            axios.get('/api/v1/user/' + this.token, {
                headers: {
                    Authorization: 'Bearer ' + this.token,
                    Accept: 'application/json'
                }
           }).then(response => (this.user = response.data))
            .catch((error) => {
                console.log(error)
                if (error.response.status == 401) {
                    this.$router.push({
                        name: 'logout'
                    })
                }
            })
        },
       
        getFacilitySignature(){
            axios.get('/api/v1/facility-details/' + this.token, {
                headers: {
                    Authorization: 'Bearer ' + this.token,
                    Accept: 'application/json'
                }
           }).then(response => (this.facility = response.data))
            .catch((error) => {
                console.log(error)
                if (error.response.status == 401) {
                    this.$router.push({
                        name: 'logout'
                    })
                }
            })
        },
        
    }
}
</script>

<style scoped>
.table tr td span{display: block; text-transform: uppercase; font-size: 12px;}
</style>
