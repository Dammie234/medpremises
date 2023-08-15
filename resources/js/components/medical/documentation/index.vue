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
                            <h2 class="font-medium text-base mr-auto">Nurse Documentation for {{data.patient.name}}</h2>
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
            <div class="grid grid-cols-12 gap-6 mt-4">
                <div class="intro-y col-span-12 xxl:col-span-12">
                    <div class="intro-y box">
                        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60">
                            <h2 class="font-medium text-base mr-auto">Nurse Documentations for {{data.patient.name}}</h2>
                        </div>
                        <div class="p-5">
                            <div class="overflow-x-auto" v-if="documentations.length != 0">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Staff Name</th>
                                            <th></th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="document in documentations" :key="document.id">
                                            <td>{{document.title}}</td>
                                            <td>{{document.staff_name}}</td>
                                            <td>{{document.created_at | moment('from', 'now')}}</td>
                                            <td>
                                                <router-link title="Title" class="btn btn-primary" :to="{name: 'edit-nurse-documentation', params:{id: document.id, key: document.key}}"><i class="fa fa-edit"></i></router-link>
                                                <button @click="deleteDocumentation(document.id)" class="btn btn-danger">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </td>
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
            documentations: [],
            form: {
                title: '',
                report: '',
                token: '',
                key: ''
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
        this.getNurseDocumentations()
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
        submit() {
           this.loading = true
           this.form.token = User.token()
           this.form.key = this.key
            axios.post('/api/nurse-documentation/', this.form)
                .then(() => {
                    this.$router.push({
                        name: 'nurse-documentation'
                    })
                    this.form = {}
                    this.login()
                    this.getNurseDocumentations()
                    Toast.fire({
                        icon: 'success',
                        title: 'Nurse Documentation added successfully'
                    })
                })
                .catch(error => this.errors = error.response.data.errors)
                .finally(() => {
                    this.loading =  false
                }) 
        },
        deleteDocumentation(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete('/api/nurse-documentation/' + id)
                        .then(() => {
                            this.documentations = this.documentations.filter(document => {
                                return document.id != id
                            })
                        })
                        .catch(() => {
                            this.$router.push({
                                name: 'nurse-documentation'
                            })
                            this.getNurseDocumentations()
                        })
                    Swal.fire(
                        'Deleted!',
                        'A nurse documentation has been deleted.',
                        'success'
                    )
                }
            })
        }
        
        
    }
}
</script>

<style scoped>

</style>
