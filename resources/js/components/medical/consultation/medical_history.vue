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
            <top-bar title="Consultation - Medical History"></top-bar>
            <!-- END: Top Bar -->
            
            <div class="grid grid-cols-12 gap-6 mt-4">
                <div class="intro-y col-span-12 xxl:col-span-12">
                   <div class="intro-y box">
                        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60">
                            <h2 class="font-medium text-base mr-auto">Medical History for {{patient.name}}</h2>
                        </div>
                        <div class="p-5">
                            <div class="grid grid-cols-12 gap-x-5">
                                <div class="col-span-12 xl:col-span-12 mt-3">
                                    <consultation-menu :key_value="key" active="history"></consultation-menu>
                                    <div class="grid grid-cols-12 gap-x-5">
                                        <div class="col-span-12 xl:col-span-12">
                                            <form @submit.prevent="submit">
                                                <div :disabled="loading">
                                                    <div class="grid grid-cols-12 gap-x-5">
                                                        <div class="col-span-12 xl:col-span-12 mt-3">
                                                            <label for="chief_complaint" class="form-label">Chief Complaint</label>
                                                            <vue-editor id="chief_complaint" class="form-control" v-model="form.chief_complaint" :editorToolbar="customToolbar"></vue-editor>
                                                            <div class="text-danger font-medium text-xs mt-1"  v-if="errors.chief_complaint">{{ errors.chief_complaint[0] }}</div>
                                                        </div>
                                                        <div class="col-span-12 xl:col-span-12 mt-3">
                                                            <p class="font-medium">Hint: The chief complaint is the primary reason the patient is presenting for care. Often expressed using the patient's words, it includes the symptons the patient is currently experiencing.</p>
                                                        </div>
                                                        <div class="col-span-12 xl:col-span-12 mt-3">
                                                            <label for="history_of_present_illness" class="form-label">History of Present Illness</label>
                                                            <vue-editor id="history_of_present_illness" class="form-control" v-model="form.history_of_present_illness" :editorToolbar="customToolbar"></vue-editor>
                                                            <div class="text-danger font-medium text-xs mt-1"  v-if="errors.history_of_present_illness">{{ errors.history_of_present_illness[0] }}</div>
                                                        </div>
                                                        <div class="col-span-12 xl:col-span-12 mt-3">
                                                            <p class="font-medium">Hint: The history of present illness expands on the CC, filling the details regading the issue at hand. The HPI is typically documented in chronlogical order, describing the patient's symptoms in details as well as documenting related information regarding previous diagnostic test results, and pertinent family and social history.</p>
                                                        </div>
                                                        <div class="col-span-12 xl:col-span-12 mt-3">
                                                            <label for="past_medical_history" class="form-label">Past Medical History</label>
                                                            <vue-editor id="past_medical_history" class="form-control" v-model="form.past_medical_history" :editorToolbar="customToolbar"></vue-editor>
                                                            <div class="text-danger font-medium text-xs mt-1"  v-if="errors.past_medical_history">{{ errors.past_medical_history[0] }}</div>
                                                        </div>
                                                        <div class="col-span-12 xl:col-span-12 mt-3">
                                                            <p class="font-medium">Hint: The past medical history includes  a list of past and current medical conditions. Past surgical history (PSH) is often included within PMH, as are previous hospitalizations, trauma, and obstetrical history (for female patient).</p>
                                                        </div>
                                                        <div class="col-span-12 xl:col-span-12 mt-4">
                                                            <label for="family_history" class="form-label">Family History (FH)</label>
                                                            <vue-editor id="family_history" class="form-control" v-model="form.family_history" :editorToolbar="customToolbar"></vue-editor>
                                                            <div class="text-danger font-medium text-xs mt-1"  v-if="errors.family_history">{{ errors.family_history[0] }}</div>
                                                        </div>
                                                        <div class="col-span-12 xl:col-span-12 mt-2">
                                                            <p class="font-medium">Hint: The family history includes descriptions of age, status (dead or alive), and presence or absence of chronic medical conditions in the patient's parents, siblings, and children.</p>
                                                        </div>
                                                        <div class="col-span-12 xl:col-span-12 mt-4">
                                                            <label for="social_history" class="form-label">Social History (SH)</label>
                                                            <vue-editor id="social_history" class="form-control" v-model="form.social_history" :editorToolbar="customToolbar"></vue-editor>
                                                            <div class="text-danger font-medium text-xs mt-1"  v-if="errors.social_history">{{ errors.social_history[0] }}</div>
                                                        </div>
                                                        <div class="col-span-12 xl:col-span-12 mt-2">
                                                            <p class="font-medium">Hint: This section includes a large amount of information regarding the patient's lifestyle and personal characteristics, including the patient's use of alcohol, tobacco, and illict drug use, each documented as type, amount, frequency, and duration of use. The SH also includes descriptions of the patient's dietary habits, exercise routine, and use of caffeine as well as years of education, occupation, marital status, number of children, sexual practices and preferences, military history and current living conditions.</p>
                                                        </div>
                                                        <div class="col-span-12 xl:col-span-12 mt-4">
                                                            <label for="allergies" class="form-label">Allergies</label>
                                                            <vue-editor id="allergies" class="form-control" v-model="form.allergies" :editorToolbar="customToolbar"></vue-editor>
                                                            <div class="text-danger font-medium text-xs mt-1"  v-if="errors.allergies">{{ errors.allergies[0] }}</div>
                                                        </div>
                                                        <div class="col-span-12 xl:col-span-12 mt-2">
                                                            <p class="font-medium">Hint: This section include information that denote any history of allergic reactions a patient has had to medications, foods, vaccines, stings, and contrast media, as well as what type of hypersensitivity reaction occurs when a patient is exposed o the agent, including rash, hives, or anaphylaxis.</p>
                                                        </div>
                                                        <div class="col-span-12 xl:col-span-12 mt-4">
                                                            <label for="review_of_system" class="form-label">Review of System (RoS)</label>
                                                            <vue-editor id="review_of_system" class="form-control" v-model="form.review_of_system" :editorToolbar="customToolbar"></vue-editor>
                                                            <div class="text-danger font-medium text-xs mt-1"  v-if="errors.review_of_system">{{ errors.review_of_system[0] }}</div>
                                                        </div>
                                                        <div class="col-span-12 xl:col-span-12 mt-2">
                                                            <p class="font-medium">Hint: The review of systems portion provides information regarding the subjective feelings, or symptoms, the patient is experiencing. Conducted in head-to-toe order, positive findings and pertinent negative responses are documented overall and for each organ system. This information is in addition to those ROS located within the CC and the hPI. The usual order of ROS General, Skin, Head, Eyes, Ears, Nose, Moth, Throat, Neck, Respiratory system, Cardiovascular system, Gastrointestinal system, Genitourinary system, Nervous system, Musculoskeletal system, Neuropsychiatric system, Endocrine system, Peripheral vascular system. <span class="note-text">The ROS list is found on the Staff Dashboard for more explanation</span></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mt-2">
                                                    <input type="submit" value="Submit" v-if="form.completed == 0" class="w-20 btn btn-primary">
                                                    <div class="text-danger" v-else><p><strong>This consultation has been marked as completed. So, you can't edit the medical history.</strong></p></div>
                                                    <loading v-if="loading == true"></loading>
                                                </div>
                                                
                                            </form>
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
    name: 'medical-history',
    data() {
        return {
            id: null,
            token: null,
            patient: '',
            key: '',
            loading: false,
            errors: {},
            form: {
                chief_complaint: '',
                history_of_present_illness: '',
                past_medical_history: '', 
                family_history: '',
                social_history: '',
                allergies: '',
                review_of_system: '',
                token: ''
            },
            customToolbar: [
                ["bold", "italic", "underline", "strike"], 
                [
                    { align: "" },
                    { align: "center" },
                    { align: "right" },
                    { align: "justify" }
                ],
                ["blockquote", "code-block"],
                [{ list: "ordered" }, { list: "bullet" }, { list: "check" }],
                [{ indent: "-1" }, { indent: "+1" }], // outdent/indent
                ["link"],
                ["clean"]
            ],
        }
    },
    
    created() {
        this.login()
        this.getMedicalHistory()
        this.getPatient()
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
        getMedicalHistory(){
            axios.get('/api/v1/consultation/' + this.key, {
                headers: {
                    Authorization: 'Bearer ' + this.token,
                    Accept: 'application/json'
                }
           }).then(response => (this.form = response.data.history))
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
        submit() {
           this.loading = true
           this.form.token = User.token()
            axios.patch('/api/medical-history/' + this.key, this.form)
                .then(() => {
                    this.$router.push({
                        path: `/medical/consultations/medical-examination/${this.key}`
                    })
                    Toast.fire({
                        icon: 'success',
                        title: 'Medical History successfully added'
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
