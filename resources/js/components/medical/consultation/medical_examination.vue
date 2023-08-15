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
            <top-bar title="Consultation - Medical Examination"></top-bar>
            <!-- END: Top Bar -->
            
            <div class="grid grid-cols-12 gap-6 mt-4">
                <div class="intro-y col-span-12 xxl:col-span-12">
                   <div class="intro-y box">
                        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60">
                            <h2 class="font-medium text-base mr-auto">Medical Examination for {{data.patient.name}}</h2>
                        </div>
                        <div class="p-5">
                            <div class="grid grid-cols-12 gap-x-5">
                                <div class="col-span-12 xl:col-span-12 mt-3">
                                    <consultation-menu :key_value="key" active="examination"></consultation-menu>
                                    <div class="grid grid-cols-12 gap-x-5">
                                        <div class="col-span-12 xl:col-span-12">
                                            
                                            <form @submit.prevent="submit" v-if="data.history.chief_complaint !== null && data.history.history_of_present_illness !== null 
                                            && data.history.past_medical_history !== null && data.history.review_of_system !== null">
                                                <div :disabled="loading">
                                                    <div class="grid grid-cols-12 gap-x-5">
                                                        <div class="col-span-12 xl:col-span-12 mt-3">
                                                            <label for="physical_examination" class="form-label">Physical Examination (PE)</label>
                                                            <vue-editor id="physical_examination" class="form-control" v-model="form.physical_examination" :editorToolbar="customToolbar"></vue-editor>
                                                            <div class="text-danger font-medium text-xs mt-1"  v-if="errors.physical_examination">{{ errors.physical_examination[0] }}</div>
                                                        </div>
                                                        <div class="col-span-12 xl:col-span-12 mt-3">
                                                            <p class="font-medium">Hint: The physical examination contains objective infomation obtained from the practitioner's examination of the patient. Subjective information is typically excluded from the PE, allowing for inclusion of information gathered by the practitioner upon observing and touching the patient. Like the ROS, the PE is documented in a head-to-toe format, permiting straightforward review of the organ system. Sequence of the PE are: Vital signs, General apperance, Head, eyes, nose, and throat (HEENT), Neck, Chest, Heart, Abdomen, Genitourinary, Rectal examination, Extremites, Lymph nodes, Neurologic examination and Skin</p>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                                <div class="mt-2">
                                                    <input type="submit" v-if="form.completed == 0" value="Submit" class="w-20 btn btn-primary">
                                                    <div class="text-danger" v-else>
                                                        <p><strong>This consultation has been marked as completed. So, you can't edit the medical examination.</strong></p>
                                                    </div>
                                                    <loading v-if="loading == true"></loading>
                                                </div>
                                                
                                            </form>
                                            <div v-else>
                                                <div class="alert alert-outline-danger alert-dismissible show flex items-center mb-2 mt-2" role="alert" > 
                                                    <i data-feather="alert-octagon" class="fa fa-exclamation-circle fa-2x mr-2"></i> <strong class="mr-2"> Whoops! </strong>  You have to provide data for Medical History before you can add Physical Examination.
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
    name: 'medical-examination',
    data() {
        return {
            id: null,
            token: null,
            key: '',
            loading: false,
            errors: {},
            data: {},
            form: {
                physical_examination: '',
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
        this.getMedicalExamination()
        this.getData()
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
        getMedicalExamination(){
            axios.get('/api/v1/consultation/' + this.key, {
                headers: {
                    Authorization: 'Bearer ' + this.token,
                    Accept: 'application/json'
                }
           }).then(response => (this.form = response.data.examination))
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
            axios.patch('/api/medical-examination/' + this.key, this.form)
                .then(() => {
                    this.$router.push({
                        path: `/medical/consultations/medical-diagnostic/${this.key}`
                    })
                    Toast.fire({
                        icon: 'success',
                        title: 'Medical Examination successfully updated'
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
