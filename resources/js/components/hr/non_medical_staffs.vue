<template>
<div class="main">
    <!-- BEGIN: Mobile Menu -->
    <mobile-menu></mobile-menu>
    <!-- END: Mobile Menu -->
    <div class="flex">
        <!-- BEGIN: Side Menu -->
        <side-menu page="hr"></side-menu>
        <!-- END: Side Menu -->
        <!-- BEGIN: Content -->
        <div class="content">
            <!-- BEGIN: Top Bar -->
            <top-bar title="Non Medical Staffs"></top-bar>
            <!-- END: Top Bar -->
            
            <div class="grid grid-cols-12 gap-6">
                <div class="intro-y col-span-12 xxl:col-span-12">
                   <div class="intro-y box">
                        <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                            <h2 class="font-medium text-base mr-auto">
                                Employ Staff
                            </h2>
                        </div>
                        <form class="input p-5" @submit.prevent="store">
                            <div class="grid grid-cols-12 gap-x-5" :disabled="loading">
                                <div class="col-span-12 xl:col-span-4 md:col-span-4">
                                    <label for="name" class="form-label">Name</label>
                                    <input id="name" type="text" class="form-control" placeholder="Input  full name" v-model="form.name">
                                    <div class="text-danger font-medium text-xs mt-1"  v-if="errors.name">{{ errors.name[0] }}</div>
                                </div>
                                
                                <div class="col-span-12 xl:col-span-4 md:col-span-4">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input id="email" type="email" class="form-control" placeholder="Input email" v-model="form.email">
                                    <div class="text-danger font-medium text-xs mt-1"  v-if="errors.email">{{ errors.email[0] }}</div>
                                </div>
                                <div class="col-span-12 xl:col-span-4">
                                    <label for="job_type" class="form-label">Job Type</label>
                                   <v-select :options="jobs" label="job_type" placeholder="Select Job Type" @input="(job) => updateJob(form, job)"></v-select>
                                    <div class="text-danger font-medium text-xs mt-1"  v-if="errors.job_type">{{ errors.job_type[0] }}</div>
                                </div>
                                <div class="col-span-12 xl:col-span-3 mt-3 ">
                                    <label for="password" class="form-label">Password</label>
                                    <input id="password" type="text" class="form-control" v-model="form.password" disabled>
                                    <div class="text-danger font-medium text-xs mt-1"  v-if="errors.address">{{ errors.address[0] }}</div>
                                </div>
                                <div class="col-span-3 xl:col-span-3 mt-3 pt-3"><button class="btn btn-secondary mt-3" type="button" @click="generatePassword">Generate Password</button></div>
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary w-20">Save</button>
                                <loading v-if="loading == true"></loading>
                            </div>
                            
                        </form>
                   </div>
                </div>
            </div>
            <div class="grid grid-cols-12 gap-6 mt-4">
                <div class="intro-y col-span-12 xxl:col-span-12">
                   <div class="intro-y box">
                        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60">
                            <h2 class="font-medium text-base mr-auto">Non Medical Staff</h2>
                            <div class="w-full sm:w-auto sm:ml-auto mt-3 sm:mt-0"> 
                                <input  class="form-control mr-0 ml-3" type="text" v-model="search" placeholder="Seach Staff">
                            </div>
                        </div>
                        <div class=" p-5">
                            <div class="grid grid-cols-12 gap-x-5">
                                <div class="col-span-12 xl:col-span-12 mt-3">
                                    <div v-if="staffs.length != 0">
                                        <div class="overflow-x-auto">
                                            <table class="table table-sm table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th class="whitespace-nowrap">Name</th>
                                                        <th class="whitespace-nowrap">Role</th>
                                                        <th class="whitespace-nowrap">Email Address</th>
                                                        
                                                        <th class="whitespace-nowrap">Job Type</th>
                                                        
                                                        <th class="whitespace-nowrap">Employment Type</th>
                                                        <th class="whitespace-nowrap">Generate PIN</th>
                                                        <th class="whitespace-nowrap">PIN</th>
                                                        <th class="whitespace-nowrap">PIN Usability</th>
                                                        <th class="whitespace-nowrap">Active</th>
                                                        <th class="whitespace-nowrap">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="staff in filterSearch" :key="staff.id">
                                                        <td>{{ staff.name }}</td>
                                                        <td>{{ staff.role }}</td>
                                                        <td>{{ staff.email }}</td>
                                                        
                                                        <td>{{ staff.job_type }}</td>
                                                        
                                                        <td>{{ staff.employment_type }}</td>
                                                        <td><button @click="generatePIN(staff.id)" class="btn btn-primary btn-sm">Generate PIN</button></td>
                                                        <td><span v-if="staff.pin_usability == false">{{staff.pin}}</span><span v-else>Generate Another PIN</span></td>
                                                        <td><span v-if="staff.pin_usability == true">PIN Used</span><span v-else>PIN Unused</span></td>
                                                        <td><span v-if="staff.active == true">Online</span><span v-else>Offline</span></td>
                                                        <td class="whitespace-nowrap">
                                                            <router-link :to="{name: 'medical-staff', params:{id: staff.id}}" class="btn btn-primary mr-3">
                                                                <i class="fa fa-info pr-2"></i>
                                                            </router-link>
                                                        </td>
                                                    </tr>
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div v-else>
                                        <div class="alert alert-outline-danger alert-dismissible show flex items-center mb-2" role="alert" > 
                                            <i data-feather="alert-octagon" class="fa fa-exclamation-circle fa-2x mr-2"></i> <strong class="mr-2"> Whoops! </strong>  There are no non medical staffs
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
const string = "abcdefghijklmnopqrstuvwxyz";
const numeric = "0123456789";
const punctuation = "!@#$%^&*()_+~`|}{[]:;?><,./-=";
export default {
    name: 'non-medical-staff',
    data() {
        return {
            id: null,
            token: null,
            form: {
                name: '',
                email: '',
                job_type: '',
                password: '',
                token: ''
            },
            errors: {},
            loading:false,
            deliveries: [],
            jobs: [],
            staffs: [],
            search: '',
            length: 10
        }
    },
    computed: {
        filterSearch() {
            let str = this.search
            let string = str.charAt(0).toUpperCase() + str.slice(1)
            return this.staffs.filter(staff => {
                return staff.name.match(string)
            })
        },
        formValid() {
            const { length } = this;
            return +length > 0;
        }
    },
    created() {
        this.login()
        this.getJobs()
        this.getStaffs()
    },
    methods: {
        updateJob(form, job){
            form.job_type = job.job_type
        },
        login(){
            if (!User.loggedIn()) {
                this.$router.push({
                        name: 'logout'
                    })
            }else{
                this.token = User.token()
                this.form.token = User.token()
            }
        },
        getJobs(){
            axios.get("/api/non-medical-jobs") 
            .then(({ data }) => (this.jobs = data))
            .catch()
        },
       store() {
           this.loading = true
            axios.post('/api/employ-non-medical-staff', this.form)
                .then(() => {
                    this.$router.push({
                        name: 'non-medical-staffs'
                    })
                    this.form = {
                        name: '',
                        email: '',
                        job_type: '',
                        password: '',
                        token: ''
                    }
                    this.login()
                    this.getStaffs()
                    Toast.fire({
                        icon: 'success',
                        title: 'Non Medical Staff successfully employed'
                    })
                })
                .catch(error => this.errors = error.response.data.errors)
                .finally(() => {
                    this.loading = false
                })
        },
        getStaffs(){
            axios.get('/api/v1/non-medical-staffs/' + this.token, {
                headers: {
                    Authorization: 'Bearer ' + this.token,
                    Accept: 'application/json'
                }
           }).then(response => (this.staffs = response.data))
            .catch((error) => {
                console.log(error)
                if (error.response.status == 401) {
                    this.$router.push({
                        name: 'logout'
                    })
                }
            })
        },
         generatePassword() {
            const { length, formValid } = this;
            if (!formValid) {
                return;
            }
            let character = "";
            let password = "";
            while (password.length < length) {
                const entity1 = Math.ceil(
                string.length * Math.random() * Math.random()
                );
                const entity2 = Math.ceil(
                numeric.length * Math.random() * Math.random()
                );
                const entity3 = Math.ceil(
                punctuation.length * Math.random() * Math.random()
                );
                let hold = string.charAt(entity1);
                hold = password.length % 2 === 0 ? hold.toUpperCase() : hold;
                character += hold;
                character += numeric.charAt(entity2);
                character += punctuation.charAt(entity3);
                password = character;
            }
            password = password
                .split("")
                .sort(() => {
                return 0.5 - Math.random();
                })
                .join("");
            this.form.password = password.substr(0, length);
            },
        
        generatePIN(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "Staff will have access to login!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, generate PIN!'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.get('/api/generate-pin/' + id)
                        .then(() => {
                            this.getStaffs()
                        })
                        .catch()
                    Swal.fire(
                        'PIN Generated!',
                        'User now has access to login.',
                        'success'
                    )
                    this.getStaffs()
                }
            })
        }
    }
}
</script>

<style scoped>

</style>
