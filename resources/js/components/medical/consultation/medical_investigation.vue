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
            <top-bar title="Consultation - Medical Investigation"></top-bar>
            <!-- END: Top Bar -->
            
            <div class="grid grid-cols-12 gap-6 mt-4">
                <div class="intro-y col-span-12 xxl:col-span-12">
                   <div class="intro-y box">
                        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60">
                            <h2 class="font-medium text-base mr-auto">Medical Investigation for {{data.patient.name}}</h2>
                        </div>
                        <div class="p-5">
                            <div class="grid grid-cols-12 gap-x-5">
                                <div class="col-span-12 xl:col-span-12 mt-3">
                                    <consultation-menu :key_value="key" active="investigation"></consultation-menu>
                                    <div class="grid grid-cols-12 gap-x-5">
                                        <div class="col-span-12 xl:col-span-12">
                                            <form @submit.prevent="submit" v-if="data.diagnostic.diagnosis !== null ">
                                                <div :disabled="loading">
                                                    <div class="grid grid-cols-12 gap-x-5">
                                                        <div class="col-span-12 xl:col-span-12 mt-3">
                                                            <div class="grid  grid-cols-12 gap-x-5">
                                                                <div class="col-span-12 xl:col-span-4 mt-3">
                                                                    <label class="form-label">Test I</label>
                                                                    <vue-single-select
                                                                    name="test_i"
                                                                    placeholder="search & select a laboratory test"
                                                                    v-model="form.test_i"
                                                                    :options="tests"
                                                                    :required="true"
                                                                    option-label="test_name"
                                                                ></vue-single-select>
                                                                    <div class="text-danger font-medium text-xs mt-1"  v-if="errors.test_i">{{ errors.test_i[0] }}</div>
                                                                </div>
                                                                <div class="col-span-12 xl:col-span-4 mt-3">
                                                                    <label class="form-label">Test II</label>
                                                                    <vue-single-select
                                                                    name="test_ii"
                                                                    placeholder="search & select a laboratory test"
                                                                    v-model="form.test_ii"
                                                                    :options="tests"
                                                                    option-label="test_name"
                                                                ></vue-single-select>
                                                                    <div class="text-danger font-medium text-xs mt-1"  v-if="errors.test_ii">{{ errors.test_ii[0] }}</div>
                                                                </div>
                                                                <div class="col-span-12 xl:col-span-4 mt-3">
                                                                    <label class="form-label">Test III</label>
                                                                    <vue-single-select
                                                                    name="test_iii"
                                                                    placeholder="search & select a laboratory test"
                                                                    v-model="form.test_iii"
                                                                    :options="tests"
                                                                    option-label="test_name"
                                                                ></vue-single-select>
                                                                    <div class="text-danger font-medium text-xs mt-1"  v-if="errors.test_iii">{{ errors.test_iii[0] }}</div>
                                                                </div>
                                                                <div class="col-span-12 xl:col-span-4 mt-3">
                                                                    <label class="form-label">Test IV</label>
                                                                    <vue-single-select
                                                                    name="test_iv"
                                                                    placeholder="search & select a laboratory test"
                                                                    v-model="form.test_iv"
                                                                    :options="tests"
                                                                    option-label="test_name"
                                                                ></vue-single-select>
                                                                    <div class="text-danger font-medium text-xs mt-1"  v-if="errors.test_iv">{{ errors.test_iv[0] }}</div>
                                                                </div>
                                                                <div class="col-span-12 xl:col-span-12 mt-3" v-if="form.investigation">
                                                                    <p>Previous Selected Medical Laboratory Test &amp; Diagnostic: {{form.investigation}}</p>
                                                                </div>
                                                            </div>
                                                           
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mt-2">
                                                    <input type="submit" v-if="form.completed == 0" value="Submit" class="w-20 btn btn-primary">
                                                    <div class="text-danger" v-else>
                                                        <p><strong>This consultation has been marked as completed. So, you can't edit the medical investigation</strong></p>
                                                    </div>
                                                    <loading v-if="loading == true"></loading>
                                                </div>
                                                
                                            </form>
                                            <div v-else>
                                                <div class="alert alert-outline-danger alert-dismissible show flex items-center mb-2 mt-2" role="alert" > 
                                                    <i data-feather="alert-octagon" class="fa fa-exclamation-circle fa-2x mr-2"></i> <strong class="mr-2"> Whoops! </strong>  You have to provide data for Medical Diagnosis before you can add Medical Investigation.
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
            </div>
        </div>
        <!-- END: Content -->
    </div>
</div>
</template>

<script>
export default {
    name: 'medical-investigation',
    data() {
        return {
            id: null,
            token: null,
            data: {},
            key: '',
            loading: false,
            tests: [],
            form: {
                test_i: '',
                test_ii: '',
                test_iii: '',
                test_iv: '',
                token: '',
                investigation: ''
            },
            errors: {}
        }
    },
    
    created() {
        this.login()
        this.getMedicalInvestigation()
        this.getData()
        this.getLaboratoryTests()
    },
    methods: {
        login(){
            if (!User.loggedIn()) {
                this.$router.push({
                        name: 'logout'
                    })
            }else{
                this.token = User.token()
                this.form.token = User.token()
                this.key = this.$route.params.key
            }
        },
        getMedicalInvestigation(){
            axios.get('/api/v1/consultation/' + this.key, {
                headers: {
                    Authorization: 'Bearer ' + this.token,
                    Accept: 'application/json'
                }
           }).then(response => (this.form = response.data.investigation))
            .catch((error) => {
                console.log(error)
                if (error.response.status == 401) {
                    this.$router.push({
                        name: 'logout'
                    })
                }
            })
        },
        getData(){
            axios.get('/api/v1/consultation/' + this.key, {
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
        
        getLaboratoryTests(){
            axios.get('/api/laboratory-tests')
            .then(response => (this.tests = response.data))
            .catch()
        },
        submit() {
           this.loading = true
           this.form.token = User.token()
            axios.patch('/api/medical-investigation/' + this.key, this.form)
                .then(() => {
                    this.$router.push({
                        path: `/medical/consultations/medical-treatment/${this.key}`
                    })
                    Toast.fire({
                        icon: 'success',
                        title: 'Medical Investigation successfully updated'
                    })
                })
                .catch(error => this.errors = error.response.data.errors)
                .finally(() => {
                    this.loading =  false
                }) 
        }
        
        
    }
}
</script>

<style scoped>

</style>
