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
            <top-bar title="Consultation - Medical Diagnostic"></top-bar>
            <!-- END: Top Bar -->
            
            <div class="grid grid-cols-12 gap-6 mt-4">
                <div class="intro-y col-span-12 xxl:col-span-12">
                   <div class="intro-y box">
                        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60">
                            <h2 class="font-medium text-base mr-auto">Medical Diagnosis for {{data.patient.name}}</h2>
                        </div>
                        <div class="p-5">
                            <div class="grid grid-cols-12 gap-x-5">
                                <div class="col-span-12 xl:col-span-12 mt-3">
                                    <consultation-menu :key_value="key" active="diagnostic"></consultation-menu>
                                    <div class="grid grid-cols-12 gap-x-5">
                                        <div class="col-span-12 xl:col-span-12">
                                            <form @submit.prevent="submit" v-if="data.examination.physical_examination !== null ">
                                                <div :disabled="loading">
                                                    <div class="grid grid-cols-12 gap-x-5">
                                                        <div class="col-span-12 xl:col-span-4 mt-3">
                                                            <label for="diagnosis" class="form-label">Medical Diagnosis I</label>
                                                            <vue-single-select
                                                            name="diagnosis_i"
                                                            placeholder="search & select a disease/condition"
                                                            v-model="form.diagnosis_i"
                                                            :options="diseases"
                                                            :required="true"
                                                            option-label="name"
                                                        ></vue-single-select>
                                                            <div class="text-danger font-medium text-xs mt-1"  v-if="errors.diagnosis_i">{{ errors.diagnosis_i[0] }}</div>
                                                        </div>
                                                        <div class="col-span-12 xl:col-span-4 mt-3">
                                                            <label for="diagnosis" class="form-label">Medical Diagnosis II</label>
                                                            <vue-single-select
                                                            name="diagnosis_ii"
                                                            placeholder="search & select a disease/condition"
                                                            v-model="form.diagnosis_ii"
                                                            :options="diseases"
                                                            option-label="name"
                                                        ></vue-single-select>
                                                            <div class="text-danger font-medium text-xs mt-1"  v-if="errors.diagnosis_ii">{{ errors.diagnosis_ii[0] }}</div>
                                                        </div>
                                                        <div class="col-span-12 xl:col-span-4 mt-3">
                                                            <label for="diagnosis" class="form-label">Medical Diagnosis III</label>
                                                            <vue-single-select
                                                            name="diagnosis_iii"
                                                            placeholder="search & select a disease/condition"
                                                            v-model="form.diagnosis_iii"
                                                            :options="diseases"
                                                            option-label="name"
                                                        ></vue-single-select>
                                                            <div class="text-danger font-medium text-xs mt-1"  v-if="errors.diagnosis_iii">{{ errors.diagnosis_iii[0] }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div v-if="form.diagnosis">Selected Diagnosis are: {{form.diagnosis}}</div>
                                                <div class="mt-2">
                                                    <input type="submit" v-if="form.completed == 0" value="Submit" class="w-20 btn btn-primary">
                                                    <div class="text-danger" v-else>
                                                        <p><strong>This consultation has been marked as completed. So, you can't edit the medical diagnostic</strong></p>
                                                    </div>
                                                    <loading v-if="loading == true"></loading>
                                                </div>
                    
                                            </form>
                                            <div v-else>
                                                <div class="alert alert-outline-danger alert-dismissible show flex items-center mb-2 mt-2" role="alert" > 
                                                    <i data-feather="alert-octagon" class="fa fa-exclamation-circle fa-2x mr-2"></i> <strong class="mr-2"> Whoops! </strong>  You have to provide data for Medical Examination before you can add Medical Diagnosis.
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
    name: 'medical-diagnostic',
    data() {
        return {
            id: null,
            token: null,
            key: '',
            loading: false,
            errors: {},
            diseases: [],
            data: {},
            form: {
                diagnosis_i: '',
                diagnosis_ii: '',
                diagnosis_iii: '',
                diagnosis: '',
                token: ''
            },
            
        }
    },
    
    created() {
        this.login()
        this.getData()
        this.getMedicalDiagnostic()
        this.getDiseases()
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
        getMedicalDiagnostic(){
            axios.get('/api/v1/consultation/' + this.key, {
                headers: {
                    Authorization: 'Bearer ' + this.token,
                    Accept: 'application/json'
                }
           }).then(response => (this.form = response.data.diagnostic))
            .catch((error) => {
                console.log(error)
                if (error.response.status == 401) {
                    this.$router.push({
                        name: 'logout'
                    })
                }
            })
        },
        getDiseases(){
            axios.get('/api/diseases')
            .then(response => (this.diseases = response.data))
            .catch()
        },
        submit() {
           this.loading = true
           this.form.token = User.token()
            axios.patch('/api/medical-diagnostic/' + this.key, this.form)
                .then(() => {
                    this.$router.push({
                        path: `/medical/consultations/medical-investigation/${this.key}`
                    })
                    Toast.fire({
                        icon: 'success',
                        title: 'Medical Diagnostic successfully updated'
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
