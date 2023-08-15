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
            <top-bar title="Edit Facility Signature"></top-bar>
            <!-- END: Top Bar -->
            <div class="intro-y flex items-center mt-8">
                <h2 class="text-lg font-medium mr-auto">
                    Facility Setting
                </h2>
            </div>
            <div class="grid grid-cols-12 gap-6">
                <!-- BEGIN: Profile Menu -->
                <div class="col-span-12 lg:col-span-3 xxl:col-span-3 flex lg:block flex-col-reverse">
                    <setting page="Facility Setting"></setting>
                </div>
                <!-- END: Profile Menu -->
                <div class="col-span-12 lg:col-span-9 xxl:col-span-9">
                    <!-- BEGIN: Personal Information -->
                    <div class="intro-y box mt-5">
                        <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                            <h2 class="font-medium text-base mr-auto">
                                Profile
                            </h2>
                        </div>
                        <div class="p-5">
                            
                                    
                            <div id="faq-accordion-1" class="accordion">
                                <div class="accordion-item">
                                    <div id="faq-accordion-content-1" class="accordion-header">
                                        <button class="accordion-button" type="button" data-tw-toggle="collapse" data-tw-target="#faq-accordion-collapse-1" aria-expanded="true" aria-controls="faq-accordion-collapse-1">
                                           Biodata
                                        </button>
                                    </div>
                                    <div id="faq-accordion-collapse-1" class="accordion-collapse collapse show" aria-labelledby="faq-accordion-content-1" data-tw-parent="#faq-accordion-1">
                                        <div class="accordion-body text-slate-600 dark:text-slate-500 leading-relaxed">
                                           <div class="overflow-x-auto">
                                               <table class="table">
                                                    <tr>
                                                        <td><span>Name</span> {{user.name}}</td>
                                                        <td><span>Email Address</span>{{user.email}}</td>
                                                        <td><span>Role</span>{{user.role}}</td>
                                                        <td><span>MDCN/Folio Number</span><div v-if="user.mdcn_number">{{user.mdcn_number}}</div>
                                                        <div v-else>-</div></td>
                                                    </tr>
                                                    <tr>
                                                        <td><span>Gender</span> {{biodata.name}}</td>
                                                        <td><span>Date of birth</span>{{biodata.date_of_birth | moment('DD/MM/YYYY')}}</td>
                                                        <td><span>Marital Status</span>{{biodata.marital_status}}</td>
                                                        <td><span>Religion</span>{{biodata.religion}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><span>Address</span> {{biodata.address}}</td>
                                                        <td><span>City</span>{{biodata.city}}</td>
                                                        <td><span>State</span>{{biodata.state}}</td>
                                                        <td><span>Postal Code</span>{{biodata.postal_code}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><span>Phone (Home)</span> <div v-if="biodata.home_phone">{{biodata.home_phone}}</div>
                                                        <div v-else>-</div> </td>
                                                        <td><span>Phone (Work)</span><div v-if="biodata.work_phone">{{biodata.work_phone}}</div>
                                                        <div v-else>-</div> </td>
                                                        <td><span>Phone (Mobile)</span><div v-if="biodata.mobile_phone">{{biodata.mobile_phone}}</div>
                                                        <div v-else>-</div> </td>
                                                        <td><span>Skype Id</span><div v-if="biodata.skype_id">{{biodata.skype_id}}</div>
                                                        <div v-else>-</div> </td>
                                                    </tr>
                                               </table>
                                           </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item" v-if="user.role == 'Medical Staff' || user.role == 'Non Medical Staff'">
                                    <div id="faq-accordion-content-2" class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-tw-toggle="collapse" data-tw-target="#faq-accordion-collapse-2" aria-expanded="false" aria-controls="faq-accordion-collapse-2">
                                            Education
                                        </button>
                                    </div>
                                    <div id="faq-accordion-collapse-2" class="accordion-collapse collapse" aria-labelledby="faq-accordion-content-2" data-tw-parent="#faq-accordion-1">
                                        <div class="accordion-body text-slate-600 dark:text-slate-500 leading-relaxed">
                                           <div class="overflow-x-auto">
                                               <table class="table">
                                                   <thead>
                                                       <tr>
                                                           <th>School Name</th>
                                                           <th>From</th>
                                                           <th>To</th>
                                                           <th>School Address</th>
                                                           <th>Studied Course</th>
                                                           <th>Graduated With</th>
                                                       </tr>
                                                   </thead>
                                                   <tbody>
                                                       <tr v-for="edu in educations" :key="edu.id">
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
                                <div class="accordion-item" v-if="user.role == 'Medical Staff'">
                                    <div id="faq-accordion-content-3" class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-tw-toggle="collapse" data-tw-target="#faq-accordion-collapse-3" aria-expanded="false" aria-controls="faq-accordion-collapse-3">
                                            Professional Qualification
                                        </button>
                                    </div>
                                    <div id="faq-accordion-collapse-3" class="accordion-collapse collapse" aria-labelledby="faq-accordion-content-3" data-tw-parent="#faq-accordion-1">
                                        <div class="accordion-body text-slate-600 dark:text-slate-500 leading-relaxed">
                                            <div class="overflow-x-auto">
                                               <table class="table">
                                                   <thead>
                                                       <tr>
                                                           <th>Qualification</th>
                                                           <th>Licensing Body</th>
                                                           <th>Year</th>
                                                       </tr>
                                                   </thead>
                                                   <tbody>
                                                       <tr v-for="qualify in qualifications" :key="qualify.id">
                                                           <td>{{qualify.qualification}}</td>
                                                           <td>{{qualify.licensing_body}}</td>
                                                           <td>{{qualify.year}}</td>
                                                       </tr>
                                                   </tbody>
                                               </table>
                                           </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item" v-if="user.role == 'Medical Staff'">
                                    <div id="faq-accordion-content-4" class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-tw-toggle="collapse" data-tw-target="#faq-accordion-collapse-4" aria-expanded="false" aria-controls="faq-accordion-collapse-4">
                                            Professional Experiences
                                        </button>
                                    </div>
                                    <div id="faq-accordion-collapse-4" class="accordion-collapse collapse" aria-labelledby="faq-accordion-content-4" data-tw-parent="#faq-accordion-1">
                                        <div class="accordion-body text-slate-600 dark:text-slate-500 leading-relaxed">
                                            <div class="overflow-x-auto">
                                               <table class="table">
                                                   <thead>
                                                       <tr>
                                                           <th>Facility Name</th>
                                                           <th>Address</th>
                                                           <th>From</th>
                                                           <th>To</th>
                                                       </tr>
                                                   </thead>
                                                   <tbody>
                                                       <tr v-for="exp in experiences" :key="exp.id">
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
                                <div class="accordion-item" v-if="user.role == 'Patient'">
                                    <div id="faq-accordion-content-5" class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-tw-toggle="collapse" data-tw-target="#faq-accordion-collapse-5" aria-expanded="false" aria-controls="faq-accordion-collapse-5">
                                            Next Of Kin
                                        </button>
                                    </div>
                                    <div id="faq-accordion-collapse-5" class="accordion-collapse collapse" aria-labelledby="faq-accordion-content-4" data-tw-parent="#faq-accordion-1">
                                        <div class="accordion-body text-slate-600 dark:text-slate-500 leading-relaxed">
                                            <div class="overflow-x-auto">
                                               <table class="table">
                                                   <tbody>
                                                       <tr>
                                                           <td><span>Name</span>{{kin.name}}</td>
                                                           <td><span>Relation</span>{{kin.relation}}</td>
                                                           <td><span>Gender</span>{{kin.gender}}</td>
                                                           <td><span>Email Address</span>{{kin.email}}</td>
                                                       </tr>
                                                       <tr>
                                                           <td><span>Address</span>{{kin.address}}</td>
                                                           <td><span>City</span>{{kin.city}}</td>
                                                           <td><span>State</span>{{kin.state}}</td>
                                                           <td><span>Postal Code</span>{{kin.postal_code}}</td>
                                                       </tr>
                                                       <tr>
                                                           <td><span>Phone (Work)</span>{{kin.work_phone}}</td>
                                                           <td><span>Phone (Home)</span>{{kin.home_phone}}</td>
                                                           <td><span>Phone (Mobile)</span>{{kin.mobile_phone}}</td>
                                                           <td></td>
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
    name: 'profile',
    data() {
        return {
            id: null,
            token: null,
            biodata: '',
            
            educations: [],
            qualifications: [],
            experiences: [],
            user: '',
            kin: ''
            
        }
    },
    created() {
        this.login()
        this.getStaff()
        this.getEducations()
        this.getQualifications()
        this.getUser()
        this.getExperiences()
        this.getKin()
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
        getKin(){
            axios.get('/api/v1/next-of-kin/' + this.token, {
                headers: {
                    Authorization: 'Bearer ' + this.token,
                    Accept: 'application/json'
                }
           }).then(response => (this.kin = response.data))
            .catch((error) => {
                console.log(error)
                if (error.response.status == 401) {
                    this.$router.push({
                        name: 'logout'
                    })
                }
            })
        },
        getStaff(){
            axios.get('/api/v1/staff/' + this.token, {
                headers: {
                    Authorization: 'Bearer ' + this.token,
                    Accept: 'application/json'
                }
           }).then(response => (this.biodata = response.data.biodata))
            .catch((error) => {
                console.log(error)
                if (error.response.status == 401) {
                    this.$router.push({
                        name: 'logout'
                    })
                }
            })
        },
        getEducations(){
            axios.get('/api/v1/staff/' + this.token, {
                headers: {
                    Authorization: 'Bearer ' + this.token,
                    Accept: 'application/json'
                }
           }).then(response => (this.educations = response.data.educations))
            .catch((error) => {
                console.log(error)
                if (error.response.status == 401) {
                    this.$router.push({
                        name: 'logout'
                    })
                }
            })
        },
        getQualifications(){
            axios.get('/api/v1/staff/' + this.token, {
                headers: {
                    Authorization: 'Bearer ' + this.token,
                    Accept: 'application/json'
                }
           }).then(response => (this.qualifications = response.data.qualifications))
            .catch((error) => {
                console.log(error)
                if (error.response.status == 401) {
                    this.$router.push({
                        name: 'logout'
                    })
                }
            })
        },
        getExperiences(){
            axios.get('/api/v1/staff/' + this.token, {
                headers: {
                    Authorization: 'Bearer ' + this.token,
                    Accept: 'application/json'
                }
           }).then(response => (this.experiences = response.data.experiences))
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
