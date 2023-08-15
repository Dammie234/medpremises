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
            <top-bar title="Nurse Documentation"></top-bar>
            <!-- END: Top Bar -->
            
            <div class="grid grid-cols-12 gap-6 mt-4">
                <div class="intro-y col-span-12 xxl:col-span-12">
                   <div class="intro-y box">
                        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60">
                            <h2 class="font-medium text-base mr-auto">Edit Nurse Documentation of {{data.patient.name}}</h2>
                        </div>
                        <div class="p-5">
                            <div class="grid grid-cols-12 gap-x-5">
                                <div class="col-span-12 xl:col-span-12 mt-3">
                                    <div class="grid grid-cols-12 gap-x-5">
                                        <div class="col-span-12 xl:col-span-12">
                                            
                                            <form @submit.prevent="submit">
                                                <div :disabled="loading">
                                                    <div class="grid grid-cols-12 gap-x-5">
                                                        <div class="col-span-12 xl:col-span-12 mt-3">
                                                            <label for="title" class="form-label">Title</label>
                                                            <input id="title" class="form-control" v-model="form.title" type="text">
                                                            <div class="text-danger font-medium text-xs mt-1"  v-if="errors.title">{{ errors.title[0] }}</div>
                                                        </div>
                                                        <div class="col-span-12 xl:col-span-12 mt-3">
                                                            <label for="report" class="form-label">Report</label>
                                                            <vue-editor id="report" class="form-control" v-model="form.report" :editorToolbar="customToolbar"></vue-editor>
                                                            <div class="text-danger font-medium text-xs mt-1"  v-if="errors.report">{{ errors.report[0] }}</div>
                                                        </div> 
                                                    </div>
                                                </div>
                                                <div class="mt-2">
                                                    <input type="submit" value="Submit" class="w-20 btn btn-primary">
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
    name: 'nurse-documentation',
    data() {
        return {
            id: null,
            token: null,
            key: '',
            loading: false,
            errors: {},
            data: {},
            form: {
                title: '',
                report: '',
                token: '',
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
        this.getData()
        this.getNurseDocumentation()
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
        getNurseDocumentation(){
            let id = this.$route.params.id
            axios.get('/api/v1/nurse-documentation/' + id, {
                headers: {
                    Authorization: 'Bearer ' + this.token,
                    Accept: 'application/json'
                }
           }).then(response => (this.form = response.data))
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
           let id = this.$route.params.id
            axios.patch('/api/nurse-documentation/' + id, this.form)
                .then(() => {
                    this.$router.push({
                        name: 'nurse-documentation'
                    })
                    Toast.fire({
                        icon: 'success',
                        title: 'Nurse Documentation successfully updated'
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
