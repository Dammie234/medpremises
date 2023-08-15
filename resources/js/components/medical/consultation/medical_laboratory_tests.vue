<template>
<div class="main">
    <!-- BEGIN: Mobile Menu -->
    <mobile-menu></mobile-menu>
    <!-- END: Mobile Menu -->
    <div class="flex">
        <!-- BEGIN: Side Menu -->
        <side-menu page="patient"></side-menu>
        <!-- END: Side Menu -->
        <!-- BEGIN: Content -->
        <div class="content">
            <!-- BEGIN: Top Bar -->
            <top-bar title="Consultation - Medical Laboratory Tests"></top-bar>
            <!-- END: Top Bar -->
            
            <div class="grid grid-cols-12 gap-6 mt-4">
                <div class="intro-y col-span-12 xxl:col-span-12">
                   <div class="intro-y box">
                        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60">
                            <h2 class="font-medium text-base mr-auto">Medical Laboratory Tests for {{patient.name}}</h2>
                        </div>
                        <div class="p-5">
                            <div class="grid grid-cols-12 gap-x-5">
                                <div class="col-span-12 xl:col-span-12 mt-3">
                                    <consultation-menu :key_value="key" active="laboratory"></consultation-menu>
                                    <div class="grid grid-cols-12 gap-x-5" v-if="investigation.investigation != null">
                                        <div  class="col-span-12 xl:col-span-12" v-if="tests.length != 0">
                                            <div class="grid grid-cols-12 gap-x-5">
                                                <div class="col-span-12 xl:col-span-12" v-for="test in tests" :key="test.id">
                                                    <div class="overflow-x-auto">
                                                        <table class="table">
                                                            <tbody>
                                                                <tr>
                                                                    <td><span>Test Name</span> {{test.test_name}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><span>Test Result</span><div v-html="test.test_result"></div></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div v-else>
                                            <div class="alert alert-outline-danger alert-dismissible show flex items-center mb-2 mt-2" role="alert" > 
                                                <i data-feather="alert-octagon" class="fa fa-exclamation-circle fa-2x mr-2"></i> <strong class="mr-2"> Whoops! </strong>  Medical Laboratory Tests has not been conducted.
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> <i data-feather="x" class="fa fa-times w-4 h-4"></i> </button> 
                                            </div>
                                        </div>
                                    </div>
                                    <div v-else>
                                        <div class="alert alert-outline-danger alert-dismissible show flex items-center mb-2 mt-2" role="alert" > 
                                            <i data-feather="alert-octagon" class="fa fa-exclamation-circle fa-2x mr-2"></i> <strong class="mr-2"> Whoops! </strong>  You have to provide data for Medical Investigation before you can view the Medical Laboratory Tests.
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> <i data-feather="x" class="fa fa-times w-4 h-4"></i> </button> 
                                        </div>
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
    name: 'medical-laboratory-tests',
    data() {
        return {
            id: null,
            token: null,
            patient: '',
            key: '',
            tests: [],
            investigation: ''
        }
    },
    
    created() {
        this.login()
        this.getMedicalInvestigation()
        this.getPatient()
        this.getConductedPatientTests()
    },
    methods: {
        login(){
            if (!User.loggedIn()) {
                this.$router.push({
                        name: 'logout'
                    })
            }else{
                this.token = User.token()
                this.key = this.$route.params.key
            }
        },
        getMedicalInvestigation(){
            axios.get('/api/v1/consultation/' + this.key, {
                headers: {
                    Authorization: 'Bearer ' + this.token,
                    Accept: 'application/json'
                }
           }).then(response => (this.investigation = response.data.investigation))
            .catch((error) => {
                console.log(error)
                if (error.response.status == 401) {
                    this.$router.push({
                        name: 'logout'
                    })
                }
            })
        },
        getPatient(){
            axios.get('/api/v1/consultation/' + this.key, {
                headers: {
                    Authorization: 'Bearer ' + this.token,
                    Accept: 'application/json'
                }
           }).then(response => (this.patient = response.data.patient))
            .catch((error) => {
                console.log(error)
                if (error.response.status == 401) {
                    this.$router.push({
                        name: 'logout'
                    })
                }
            })
        },
        getConductedPatientTests(){
            axios.get('/api/v1/conducted-patient-medical-laboratory-tests/' + this.key, {
                headers: {
                    Authorization: 'Bearer ' + this.token,
                    Accept: 'application/json'
                }
           }).then(response => (this.tests = response.data))
            .catch((error) => {
                console.log(error)
                if (error.response.status == 401) {
                    this.$router.push({
                        name: 'logout'
                    })
                }
            })
        }
        
        
    }
}
</script>

<style scoped>
td span{
    display: block;
    text-transform: uppercase;
}
</style>
