<template>
<div class="main">
    <!-- BEGIN: Mobile Menu -->
    <mobile-menu></mobile-menu>
    <!-- END: Mobile Menu -->
    <div class="flex">
        <!-- BEGIN: Side Menu -->
        <side-menu page="hr"></side-menu>
        <!-- END: Side Menu -->
        <!-- BEGIN: Content -->
        <div class="content">
            <!-- BEGIN: Top Bar -->
            <top-bar title="Medical Staff"></top-bar>
            <!-- END: Top Bar -->
            
            
            <div class="grid grid-cols-12 gap-6 mt-4">
                <div class="intro-y col-span-12 xl:col-span-12 md:col-span-12">
                   <div class="intro-y box">
                        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60">
                            <h2 class="font-medium text-base mr-auto">Biodata</h2>
                        </div>
                        <div class=" p-5">
                            <div class="grid grid-cols-12 gap-x-5">
                                <div class="col-span-12 xl:col-span-9 mt-3">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td><span>Name</span>{{data.biodata.name}}</td>
                                                <td><span>Role</span>{{data.biodata.role}}</td>
                                                <td><span>Practice Type</span>{{data.biodata.practice_type}}</td>
                                                <td><span>Job Type</span>{{data.biodata.job_type}}</td>
                                            </tr>
                                            <tr>
                                                <td><span>MDCN/Folio Number</span>{{data.biodata.mdcn_number}}</td>
                                                <td><span>Gender</span>{{data.biodata.gender}}</td>
                                                <td><span>Date of Birth</span>{{data.biodata.date_of_birth | moment("DD/MM/YYYY")}}</td>
                                                <td><span>Religion</span>{{data.biodata.religion}}</td>
                                            </tr>
                                            <tr>
                                                <td><span>Address</span>{{data.biodata.address}}</td>
                                                <td><span>City</span>{{data.biodata.city}}</td>
                                                <td><span>State</span>{{data.biodata.state}}</td>
                                                <td><span>Postal Code</span>{{data.biodata.postal_code}}</td>
                                            </tr>
                                            <tr>
                                                <td><span>Email Address</span>{{data.biodata.email}}</td>
                                                <td><span>Phone (Home)</span>{{data.biodata.home_phone}}</td>
                                                <td><span>Phone (Work)</span>{{data.biodata.work_phone}}</td>
                                                <td><span>Phone (Mobile)</span>{{data.biodata.mobile_phone}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    
                                </div>
                                <div class="col-span-12 xl:col-span-3">
                                    <div class="w-full h-64 my-5 image-fit">
                                        <img alt="Medical Staff Image" :src="'../../' + data.biodata.profile_picture" data-action="zoom" class="w-full rounded-md">
                                    </div>
                                </div>
                            </div>
                        </div>
                   </div>
                </div>
                <div class="intro-y col-span-12 xl:col-span-12">
                   <div class="intro-y box">
                        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60">
                            <h2 class="font-medium text-base mr-auto">Education</h2>
                        </div>
                        <div class=" p-5">
                            <div class="grid grid-cols-12 gap-x-5">
                                <div class="col-span-12 xl:col-span-12 mt-3">
                                    <div class="overflow-x-auto">
                                        <table class="table table-sm table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>School Name</th>
                                                    <th>From</th>
                                                    <th>To</th>
                                                    <th>Address</th>
                                                    <th>Studied Course</th>
                                                    <th>Graduated With</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="edu in data.educations" :key="edu.id">
                                                    <td>{{edu.school_name}}</td>
                                                    <td>{{edu.from}}</td>
                                                    <td>{{edu.to}}</td>
                                                    <td>{{edu.school_address}}</td>
                                                    <td>{{edu.studied_course}}</td>
                                                    <td>{{edu.graduated_with}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                   </div>
                </div>
                <div class="intro-y col-span-12 xl:col-span-6 md:col-span-6" v-if="data.biodata.role == 'Medical Staff'">
                   <div class="intro-y box">
                        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60">
                            <h2 class="font-medium text-base mr-auto">Professional Qualification</h2>
                        </div>
                        <div class=" p-5">
                            <div class="grid grid-cols-12 gap-x-5">
                                <div class="col-span-12 xl:col-span-12 mt-3">
                                    <div class="overflow-x-auto">
                                        <table class="table table-sm table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Qualification</th>
                                                    <th>Licensing Body</th>
                                                    <th>Year</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="qua in data.qualifications" :key="qua.id">
                                                    <td>{{qua.qualification}}</td>
                                                    <td>{{qua.licensing_body}}</td>
                                                    <td>{{qua.year}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                   </div>
                </div>
                <div class="intro-y col-span-12 xl:col-span-6 md:col-span-6" v-if="data.biodata.role == 'Medical Staff'">
                   <div class="intro-y box">
                        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60">
                            <h2 class="font-medium text-base mr-auto">Professional Experience</h2>
                        </div>
                        <div class=" p-5">
                            <div class="grid grid-cols-12 gap-x-5">
                                <div class="col-span-12 xl:col-span-12 mt-3">
                                    <div class="overflow-x-auto">
                                        <table class="table table-sm table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Facility</th>
                                                    <th>Address</th>
                                                    <th>From</th>
                                                    <th>To</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="exp in data.experiences" :key="exp.id">
                                                    <td>{{exp.facility_name}}</td>
                                                    <td>{{exp.address}}</td>
                                                    <td>{{exp.from}}</td>
                                                    <td>{{exp.to}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                   </div>
                </div>
                
            </div>
        
        </div>
        <!-- END: Content -->
    </div>
</div>
</template>

<script>
export default {
    name: 'medical-staff',
    data() {
        return {
            id: null,
            token: '',
            data: {},
           
        }
    },
    
    created() {
        this.login()
        this.getMedicalStaff()
        
    },
    methods: {

        login(){
            if (!User.loggedIn()) {
                this.$router.push({
                        name: 'logout'
                    })
            }else{
                this.token = User.token()
            }
        },
       
        getMedicalStaff(){
            let id = this.$route.params.id
            axios.get('/api/v1/medical-staff/' + id, {
                headers: {
                    Authorization: 'Bearer ' + this.token,
                    Accept: 'application/json'
                }
           }).then(response => (this.data = response.data))
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
