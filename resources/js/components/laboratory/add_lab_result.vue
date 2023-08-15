<template>
<div class="main">
    <!-- BEGIN: Mobile Menu -->
    <mobile-menu></mobile-menu>
    <!-- END: Mobile Menu -->
    <div class="flex">
        <!-- BEGIN: Side Menu -->
        <side-menu page="lab"></side-menu>
        <!-- END: Side Menu -->
        <!-- BEGIN: Content -->
        <div class="content">
            <!-- BEGIN: Top Bar -->
            <top-bar title="Customer Order of Medical Diagnostic &amp; Laboratory Tests"></top-bar>
            <!-- END: Top Bar -->
            
            
            <div class="grid grid-cols-12 gap-6 mt-4">
                <div class="intro-y col-span-12 xxl:col-span-12">
                   <div class="intro-y box">
                        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60">
                            <h2 class="font-medium text-base mr-auto">Customer Order of Medical Diagnostic &amp; Laboratory Tests</h2>
                        </div>
                        <div class=" p-5">
                            <div class="grid grid-cols-12 gap-x-5">
                                <div class="col-span-12 xl:col-span-12 mt-3">
                                    <form @submit.prevent="updateLabTest">
                                        <div class="grid grid-cols-12 gap-x-5"  :disabled="loading">
                                            <div class="col-span-12 xl:col-span-6">
                                                <label for="name" class="form-label">Customer Name</label>
                                                <input id="name" type="text" class="form-control" disabled v-model="form.name">
                                                <div class="text-danger font-medium text-xs mt-1"  v-if="errors.name">{{ errors.name[0] }}</div>
                                            </div>
                                            <div class="col-span-12 xl:col-span-6">
                                                <label for="test_name" class="form-label">Customer Test Name</label>
                                                <input id="test_name" type="text" class="form-control" disabled v-model="form.test_name">
                                                <div class="text-danger font-medium text-xs mt-1"  v-if="errors.test_name">{{ errors.test_name[0] }}</div>
                                            </div>
                                            <div class="col-span-12 xl:col-span-12 mt-3">
                                                <label for="test_result" class="form-label">Customer Test Result</label>
                                                <vue-editor v-model="test.test_result" id="test_result" :editorToolbar="customToolbar"></vue-editor>
                                                <div class="text-danger font-medium text-xs mt-1"  v-if="errors.test_result">{{ errors.test_result[0] }}</div>
                                            </div>
                                            <div class="col-span-12 xl:col-span-12 mt-3 dropzone">
                                                <div class="fallback">
                                                    <input name="file" type="file" multiple @change="handleFileScannedPassport" />
                                                </div>
                                                <div class="dz-message" data-dz-message>
                                                    <div class="text-lg font-medium">Click Choose Files to upload.</div>
                                                    <div class="text-slate-500">
                                                        Upload the images of your scanned passport 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary w-20">Save</button>
                                        <loading v-if="loading == true"></loading>
                                    </form>
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
    name: 'laboratory-medical-tests',
    delimiters: ['${', '}'],
    data() {
        return {
            id: null,
            token: '',
            form: {
                name: '',
                email: '',
                phone: '',
                test_name: '',
                test_result: ''
            },
            test: {
                test_result: '',
                images: []
            },
            errors: {},
            loading:false,
            customToolbar: [
                [{ header: [false, 1, 2, 3, 4, 5, 6] }],
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
        this.getPatientOrder()
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
       
        getPatientOrder(){
            let id = this.$route.params.id
            axios.get('/api/v1/patient-order-medical-laboratory-test/' + id, {
                headers: {
                    Authorization: 'Bearer ' + this.token,
                    Accept: 'application/json'
                }
           }).then(response => (this.form = response.data.patient))
            .catch((error) => {
                console.log(error)
                if (error.response.status == 401) {
                    this.$router.push({
                        name: 'logout'
                    })
                }
            })
        },
        handleFileScannedPassport(event) {
            let files = event.target.files;
            for (let index = 0; index < files.length; index++) {
                const file = files[index];
                let reader = new FileReader();
                reader.readAsDataURL(file);
                 let type = file.type
                let name = file.name
                reader.onload = event => {
                    this.test.images.push(event.target.result)
                };
            }  
        },
        updateLabTest() {  
            let id = this.$route.params.id
            this.loading = true
            axios.patch('/api/update-medical-laboratory-test/' + id, this.test)
                .then(res => {
                    //User.responseAfterLogin(res)
                    Toast.fire({
                        icon: 'success',
                        title: 'Medical Diagnostic &amp; Laboratory Test Successfully Added'
                    })
                    this.$router.push({
                        name: 'lab-patient-orders'
                    })
                })
                .catch(error => this.errors = error.response.data.errors)
                .finally(() => {
                    this.loading = false
                })
        },
    }
}
</script>

<style scoped>
[v-cloak] {
  display: none;
}
</style>
