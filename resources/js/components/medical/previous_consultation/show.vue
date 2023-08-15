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
            <top-bar title="Patient Visit"></top-bar>
            <!-- END: Top Bar -->
            
            <div class="grid grid-cols-12 gap-6 mt-4">
                <div class="intro-y col-span-12 xxl:col-span-12">
                   <div class="intro-y box">
                        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60">
                            <h2 class="font-medium text-base mr-auto">{{data.patient.name}}'s Visit at {{data.consultation_details.registered_facility_name}} on {{data.consultation_details.created_at | moment('dddd, MMMM Do YYYY, h:mm:ss a')}}</h2>
                            <div class="w-full sm:w-auto sm:ml-auto mt-3 sm:mt-0"> 
                                
                            </div>
                        </div>
                        <div class="p-5">
                            <div class="grid grid-cols-12 gap-x-5">
                                <div class="col-span-12 xl:col-span-12 mt-3">
                                    
                                    
                                        <div id="faq-accordion-1" class="accordion">
                                            <div class="accordion-item">
                                                <div id="faq-accordion-content-1" class="accordion-header">
                                                    <button class="accordion-button uppercase text-lg font-medium leading-none" type="button" data-tw-toggle="collapse" data-tw-target="#faq-accordion-collapse-1" aria-expanded="true" aria-controls="faq-accordion-collapse-1">
                                                        Medical History
                                                    </button>
                                                </div>
                                                <div id="faq-accordion-collapse-1" class="accordion-collapse collapse show" aria-labelledby="faq-accordion-content-1" data-tw-parent="#faq-accordion-1">
                                                    <div class="accordion-body text-slate-600 dark:text-slate-500 leading-relaxed">
                                                        <div class="overflow-x-auto">
                                                            <table class="table table-bordered">
                                                                <tr>
                                                                    <td><span>Chief Complaint</span><div v-html="data.history.chief_complaint"></div></td>
                                                                    <td><span>History of Present Illness</span><div v-html="data.history.history_of_present_illness"></div></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><span>Past Medical History</span><div v-html="data.history.past_medical_history"></div></td>
                                                                    <td><span>Family History</span><div v-html="data.history.family_history"></div></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><span>Social History</span><div v-html="data.history.social_history"></div></td>
                                                                    <td><span>Allergies</span><div v-html="data.history.allergies"></div></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><span>Review of System (RoS)</span><div v-html="data.history.review_of_system"></div></td>
                                                                    <td><span>Staff</span>{{data.history.staff_name}}</td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <div id="faq-accordion-content-2" class="accordion-header">
                                                    <button class="accordion-button collapsed uppercase text-lg font-medium leading-none" type="button" data-tw-toggle="collapse" data-tw-target="#faq-accordion-collapse-2" aria-expanded="false" aria-controls="faq-accordion-collapse-2">
                                                        Medical Examination
                                                    </button>
                                                </div>
                                                <div id="faq-accordion-collapse-2" class="accordion-collapse collapse" aria-labelledby="faq-accordion-content-2" data-tw-parent="#faq-accordion-1">
                                                    <div class="accordion-body text-slate-600 dark:text-slate-500 leading-relaxed">
                                                        <div class="overflow-x-auto">
                                                            <table class="table table-bordered">
                                                                <tbody>
                                                                    <tr>
                                                                        <td>
                                                                            <span>Physical Examination</span>
                                                                            <div v-html="data.examination.physical_examination"></div>
                                                                        </td>
                                                                        <td>
                                                                            <span>Staff</span>
                                                                            {{data.examination.staff_name}}
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <div id="faq-accordion-content-3" class="accordion-header">
                                                    <button class="accordion-button collapsed uppercase text-lg font-medium leading-none" type="button" data-tw-toggle="collapse" data-tw-target="#faq-accordion-collapse-3" aria-expanded="false" aria-controls="faq-accordion-collapse-3">
                                                        Medical Diagnostic
                                                    </button>
                                                </div>
                                                <div id="faq-accordion-collapse-3" class="accordion-collapse collapse" aria-labelledby="faq-accordion-content-3" data-tw-parent="#faq-accordion-1">
                                                    <div class="accordion-body text-slate-600 dark:text-slate-500 leading-relaxed">
                                                        <div class="overflow-x-auto">
                                                            <table class="table table-bordered">
                                                                <tbody>
                                                                    <tr>
                                                                        <td>
                                                                            <span>Diagnosis</span>
                                                                            <div v-html="data.diagnostic.diagnosis"></div>
                                                                        </td>
                                                                        <td>
                                                                            <span>Staff</span>
                                                                            {{data.diagnostic.staff_name}}
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <div id="faq-accordion-content-4" class="accordion-header">
                                                    <button class="accordion-button collapsed uppercase text-lg font-medium leading-none" type="button" data-tw-toggle="collapse" data-tw-target="#faq-accordion-collapse-4" aria-expanded="false" aria-controls="faq-accordion-collapse-4">
                                                        Medical Investigation
                                                    </button>
                                                </div>
                                                <div id="faq-accordion-collapse-4" class="accordion-collapse collapse" aria-labelledby="faq-accordion-content-4" data-tw-parent="#faq-accordion-1">
                                                    <div class="accordion-body text-slate-600 dark:text-slate-500 leading-relaxed">
                                                        <div class="overflow-x-auto">
                                                            <table class="table table-bordered">
                                                                <tbody>
                                                                    <tr>
                                                                        <td>
                                                                            <span>Investigation</span>
                                                                            <div v-html="data.investigation.investigation"></div>
                                                                        </td>
                                                                        <td>
                                                                            <span>Staff</span>
                                                                            {{data.investigation.staff_name}}
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item" v-if="tests.length != 0">
                                                <div id="faq-accordion-content-4" class="accordion-header">
                                                    <button class="accordion-button collapsed uppercase text-lg font-medium leading-none" type="button" data-tw-toggle="collapse" data-tw-target="#faq-accordion-collapse-5" aria-expanded="false" aria-controls="faq-accordion-collapse-5">
                                                        Medical Laboratory Tests
                                                    </button>
                                                </div>
                                                <div id="faq-accordion-collapse-5" class="accordion-collapse collapse" aria-labelledby="faq-accordion-content-5" data-tw-parent="#faq-accordion-1">
                                                    <div class="accordion-body text-slate-600 dark:text-slate-500 leading-relaxed">
                                                        <div class="grid grid-cols-12 gap-x-5">
                                                            <div class="col-span-12 xl:col-span-12" v-for="test in tests" :key="test.id">
                                                                <div class="overflow-x-auto">
                                                                    <table class="table table-bordered">
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
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <div id="faq-accordion-content-6" class="accordion-header">
                                                    <button class="accordion-button collapsed uppercase text-lg font-medium leading-none" type="button" data-tw-toggle="collapse" data-tw-target="#faq-accordion-collapse-6" aria-expanded="false" aria-controls="faq-accordion-collapse-6">
                                                        Medical Treatment
                                                    </button>
                                                </div>
                                                <div id="faq-accordion-collapse-6" class="accordion-collapse collapse" aria-labelledby="faq-accordion-content-6" data-tw-parent="#faq-accordion-1">
                                                    <div class="accordion-body text-slate-600 dark:text-slate-500 leading-relaxed">
                                                        <div class="overflow-x-auto">
                                                            <table class="table table-bordered">
                                                                <tbody>
                                                                    <tr>
                                                                        <td>
                                                                            <span>Treatment</span>
                                                                            <div v-html="data.treatment.treatment"></div>
                                                                        </td>
                                                                        <td>
                                                                            <span>Patient Type</span>
                                                                            {{data.treatment.patient_type}}
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <div id="faq-accordion-content-7" class="accordion-header">
                                                    <button class="accordion-button collapsed uppercase text-lg font-medium leading-none" type="button" data-tw-toggle="collapse" data-tw-target="#faq-accordion-collapse-7" aria-expanded="false" aria-controls="faq-accordion-collapse-7">
                                                        Medical Prescribe Drug
                                                    </button>
                                                </div>
                                                <div id="faq-accordion-collapse-7" class="accordion-collapse collapse" aria-labelledby="faq-accordion-content-7" data-tw-parent="#faq-accordion-1">
                                                    <div class="accordion-body text-slate-600 dark:text-slate-500 leading-relaxed">
                                                        <div class="overflow-x-auto">
                                                            <table class="table table-bordered">
                                                                <tbody>
                                                                    <tr>
                                                                        <td>
                                                                            <span>Drugs</span>
                                                                            <div v-html="data.drug.drugs"></div>
                                                                        </td>
                                                                        <td>
                                                                            <span>Staff name</span>
                                                                            {{data.drug.staff_name}}
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <div id="faq-accordion-content-8" class="accordion-header">
                                                    <button class="accordion-button collapsed uppercase text-lg font-medium leading-none" type="button" data-tw-toggle="collapse" data-tw-target="#faq-accordion-collapse-8" aria-expanded="false" aria-controls="faq-accordion-collapse-8">
                                                        Medical Treatment Plan
                                                    </button>
                                                </div>
                                                <div id="faq-accordion-collapse-8" class="accordion-collapse collapse" aria-labelledby="faq-accordion-content-8" data-tw-parent="#faq-accordion-1">
                                                    <div class="accordion-body text-slate-600 dark:text-slate-500 leading-relaxed">
                                                        <div class="overflow-x-auto">
                                                            <table class="table table-bordered table sm">
                                                                <thead>
                                                                    <tr class="uppercase">
                                                                        <th>Diagnosis</th>
                                                                        <th>Problem</th>
                                                                        <th>Long Term Goal</th>
                                                                        
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>{{data.treatment_plan.diagnosis}}</td>
                                                                        <td><span v-if="data.treatment_plan.problem">{{data.treatment_plan.problem}}</span><span v-else>-</span></td>
                                                                        <td v-html="data.treatment_plan.long_term_goal"></td>
                                                                        
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <h6 class="uppercase font-medium leading-none mt-3">Short Term Goals</h6>
                                                        <div class="grid grid-cols-12 gap-6 mt-4" v-if="plan_types.length != 0">
                                                            <div class="col-span-12 xl:col-span-6 mt-1">
                                                                <div class="overflow-x-auto">
                                                                    <table class="table table-bordered table-xs text-xs">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Date</th>
                                                                                <th>Problem</th>
                                                                                <th>Short Term Goal</th>
                                                                                <th>Approaches</th>
                                                                                
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr v-for="plan in plan_types" :key="plan.id">
                                                                                <td>{{plan.date1 | moment('DD/MM/YYYY')}}</td>
                                                                                <td>{{plan.problem}}</td>
                                                                                <td>{{plan.short_term_goal}}</td>
                                                                                <td>{{plan.approaches}}</td>
                                                                                
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="col-span-12 xl:col-span-6 mt-1">
                                                                <div class="overflow-x-auto">
                                                                    <table class="table table-bordered table-xs text-xs">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Date</th>
                                                                                <th>Evaluation</th>
                                                                                <th>Goals Met</th>
                                                                                <th>Added By</th>
                                                                                
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr v-for="plan in plan_types" :key="plan.id">
                                                                                <td> <span v-if="plan.date2">{{plan.date2 | moment('DD/MM/YYYY')}}</span><span v-else>-</span></td>
                                                                                <td><span v-if="plan.evaluation">{{plan.problem}}</span><span v-else>-</span></td>
                                                                                <td><span v-if="plan.goals_met">{{plan.goals_met}}</span><span v-else>-</span></td>
                                                                                <td>{{plan.staff_name}}</td>
                                                                                
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <div id="faq-accordion-content-9" class="accordion-header">
                                                    <button class="accordion-button collapsed uppercase text-lg font-medium leading-none" type="button" data-tw-toggle="collapse" data-tw-target="#faq-accordion-collapse-9" aria-expanded="false" aria-controls="faq-accordion-collapse-9">
                                                        Nurse Documentation
                                                    </button>
                                                </div>
                                                <div id="faq-accordion-collapse-9" class="accordion-collapse collapse" aria-labelledby="faq-accordion-content-9" data-tw-parent="#faq-accordion-1">
                                                    <div class="accordion-body text-slate-600 dark:text-slate-500 leading-relaxed">
                                                        <div class="overflow-x-auto" v-if="documentations.length != 0">
                                                            <table class="table table-bordered">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Title</th>
                                                                        <th>Content</th>
                                                                        <th>Staff Name</th> 
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr v-for="document in documentations" :key="document.id">
                                                                        <td>{{document.title}}</td>
                                                                        <td v-html="document.report"></td>
                                                                        <td>{{document.staff_name}}</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div v-else>
                                                            <div class="alert alert-outline-danger alert-dismissible show flex items-center mb-2" role="alert" > 
                                                                <i data-feather="alert-octagon" class="fa fa-exclamation-circle fa-2x mr-2"></i> <strong class="mr-2"> Whoops! </strong>  There are no nurse documentation taken yet.
                                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> <i data-feather="x" class="fa fa-times w-4 h-4"></i> </button> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <div id="faq-accordion-content-10" class="accordion-header">
                                                    <button class="accordion-button collapsed uppercase text-lg font-medium leading-none" type="button" data-tw-toggle="collapse" data-tw-target="#faq-accordion-collapse-10" aria-expanded="false" aria-controls="faq-accordion-collapse-10">
                                                        Drug Prescription Plan
                                                    </button>
                                                </div>
                                                <div id="faq-accordion-collapse-10" class="accordion-collapse collapse" aria-labelledby="faq-accordion-content-10" data-tw-parent="#faq-accordion-1">
                                                    <div class="accordion-body text-slate-600 dark:text-slate-500 leading-relaxed">
                                                        <div class="col-span-12 xl:col-span-12 mt-3">
                                                            <div class="overflow-x-auto" v-if="plans.length != 0">
                                                                <table class="table table-bordered">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Drug</th>
                                                                            <th>Quantity</th>
                                                                            <th>Usages</th>
                                                                            <th>Times</th>
                                                                            <th>Staff</th>
                                                                            <th>Date</th>
                                                                            
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr v-for="plan in plans" :key="plan.id">
                                                                            <td>{{plan.drug}}</td>
                                                                            <td>{{plan.quantity}}</td>
                                                                            <td>{{plan.usages}}</td>
                                                                            <td>{{plan.times}}</td>
                                                                            <td>{{plan.staff_name}}</td>
                                                                            <td>{{plan.created_at | moment('from', 'now')}}</td>
                                                                            
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div v-else>
                                                                <div class="alert alert-outline-danger alert-dismissible show flex items-center mb-2" role="alert" > 
                                                                    <i data-feather="alert-octagon" class="fa fa-exclamation-circle fa-2x mr-2"></i> <strong class="mr-2"> Whoops! </strong>  There are no drug prescription plan added yet!
                                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> <i data-feather="x" class="fa fa-times w-4 h-4"></i> </button> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <div id="faq-accordion-content-11" class="accordion-header">
                                                    <button class="accordion-button collapsed uppercase text-lg font-medium leading-none" type="button" data-tw-toggle="collapse" data-tw-target="#faq-accordion-collapse-11" aria-expanded="false" aria-controls="faq-accordion-collapse-11">
                                                       Outpatient Visits
                                                    </button>
                                                </div>
                                                <div id="faq-accordion-collapse-11" class="accordion-collapse collapse" aria-labelledby="faq-accordion-content-11" data-tw-parent="#faq-accordion-1">
                                                    <div class="accordion-body text-slate-600 dark:text-slate-500 leading-relaxed">
                                                        <div class="overflow-x-auto" v-if="visits.length != 0">
                                                            <table class="table table-bordered">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Date for Visits</th>
                                                                        <th>Purpose of Visit</th>
                                                                        <th>Did the Patient Visit</th>
                                                                        <th>Improvement of Patient</th>
                                                                        <th>Staff Name</th>
                                                                        
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr v-for="visit in visits" :key="visit.id">
                                                                        <td>{{visit.date_for_visit | moment('DD MMMM YYYY')}}</td>
                                                                        <td v-text="visit.purpose_of_visit"></td>
                                                                        <td>
                                                                            <span v-if="visit.patient_visit">
                                                                                <span v-if="visit.patient_visit == 1" class="green white-text padding-5 medium-small">Yes</span><span v-else class="red white-text padding-5 medium-small">No</span> </span>
                                                                            <span v-else>-</span></td>
                                                                        <td><span v-if="visit.improvement_of_patient">{{visit.improvement_of_patient}}</span><span v-else>-</span></td>
                                                                        <td v-text="visit.staff_name"></td>
                                                                        
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div v-else>
                                                            <div class="alert alert-outline-danger alert-dismissible show flex items-center mb-2" role="alert" > 
                                                                <i data-feather="alert-octagon" class="fa fa-exclamation-circle fa-2x mr-2"></i> <strong class="mr-2"> Whoops! </strong> No Outpatient Visit has been added yet!
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
            </div>
        </div>
        <!-- END: Content -->
    </div>
</div>
</template>

<script>
export default {
    name: 'consultations',
    data() {
        return {
            id: null,
            token: null,
            data: {},
            key: '',
            tests: [],
            plan_types: [],
            documentations: [],
            plans: [],
            visits: []
           
        }
    },
   
    created() {
        this.login()
        this.getData()
        this.getConductedPatientTests()
        this.getMedicalTreatmentPlanTypes()
        this.getNurseDocumentations()
        this.getDrugPrescriptionPlan()
        this.getOutpatientVisits()
    },
    methods: {
        login(){
            if (!User.loggedIn()) {
                this.$router.push({
                        name: 'logout'
                    })
            }else{
                this.key = this.$route.params.key
                this.token = User.token()
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
        },
        getOutpatientVisits(){
            axios.get('/api/v1/outpatient-visits/' + this.key, {
                headers: {
                    Authorization: 'Bearer ' + this.token,
                    Accept: 'application/json'
                }
           }).then(response => (this.visits = response.data))
            .catch((error) => {
                console.log(error)
                if (error.response.status == 401) {
                    this.$router.push({
                        name: 'logout'
                    })
                }
            })
        },
        getMedicalTreatmentPlanTypes(){
            axios.get('/api/v1/medical-treatment-plan-types/' + this.key, {
                headers: {
                    Authorization: 'Bearer ' + this.token,
                    Accept: 'application/json'
                }
           }).then(response => (this.plan_types = response.data))
            .catch((error) => {
                console.log(error)
                if (error.response.status == 401) {
                    this.$router.push({
                        name: 'logout'
                    })
                }
            })
        },
        getNurseDocumentations(){
            axios.get('/api/v1/nurse-documentations/' + this.key, {
                headers: {
                    Authorization: 'Bearer ' + this.token,
                    Accept: 'application/json'
                }
           }).then(response => (this.documentations = response.data))
            .catch((error) => {
                console.log(error)
                if (error.response.status == 401) {
                    this.$router.push({
                        name: 'logout'
                    })
                }
            })
        },
        getDrugPrescriptionPlan(){
            axios.get('/api/v1/drug-prescription-plan/' + this.key, {
                headers: {
                    Authorization: 'Bearer ' + this.token,
                    Accept: 'application/json'
                }
           }).then(response => (this.plans = response.data))
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
.table tr td span{display: block; text-transform: uppercase; font-size: 12px; font-weight: bold;}
</style>
