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
            <top-bar title="Consultation - Outpatient Visits"></top-bar>
            <!-- END: Top Bar -->
            <div class="grid grid-cols-12 gap-6 mt-4" v-if="add_visit == true">
                <div class="intro-y col-span-12 xxl:col-span-12">
                   <div class="intro-y box">
                        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60">
                            <h2 class="font-medium text-base mr-auto">Add Outpatient Visit for {{data.patient.name}}</h2>
                        </div>
                        <div class="p-5">
                            <form @submit.prevent="submit">
                                <div class="grid grid-cols-12 gap-x-5">
                                   
                                    <div class="col-span-12 lg:col-span-12 xl:col-span-12 text-center"><button class="btn btn-primary mt-3" @click.prevent="addToNumberOfVisit">Add 1 More Row</button></div>
                                    
                                </div>
                                
                                <div class="grid grid-cols-12 gap-x-5 mt-2" v-for="(number, index) in form.number_of_visit" :key="index">
                                    <div class="col-span-12 xl:col-span-2 lg:col-span-2 md:col-span-2 xxl:col-span-2">
                                        <label for="date_for_visit" class="form-label">Date for Visit</label>
                                        <input id="date_for_visit" type="date" class="form-control"  v-model="form.date_for_visit[index]">
                                        <div class="text-danger font-medium text-xs mt-1"  v-if="errors.date_of_visit">{{ errors.date_of_visit[0] }}</div>
                                    </div>
                                    <div class="col-span-12 xl:col-span-8 lg:col-span-8 md:col-span-8 xxl:col-span-8">
                                        <label for="purpose_of_visit" class="form-label">Purpose of Visit</label>
                                        <input id="purpose_of_visit" type="text" class="form-control" placeholder="Enter the Purpose of Visit" v-model="form.purpose_of_visit[index]">
                                        <div class="text-danger font-medium text-xs mt-1"  v-if="errors.purpose_of_visit">{{ errors.purpose_of_visit[0] }}</div>
                                    </div>
                                    <div class="col-span-12 xl:col-span-2 mt-5">
                                        
                                        <button v-if="form.number_of_visit > 1" class="btn btn-primary mt-3" @click.prevent="subtractToNumberOfVisit(index)">Remove This Row</button>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <input type="submit" value="Submit" class="w-20 btn btn-primary">
                                    <loading v-if="loading == true"></loading>
                                    <button class="btn btn-secondary" @click.prevent="addVisit">Close</button>
                                </div>
                            </form>
                        </div>
                   </div>
                </div>
            </div>
            <div class="grid grid-cols-12 gap-6 mt-4" v-if="edit_visit == true">
                <div class="intro-y col-span-12 xxl:col-span-12">
                   <div class="intro-y box">
                        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60">
                            <h2 class="font-medium text-base mr-auto">Edit Outpatient Visit for {{data.patient.name}}</h2>
                        </div>
                        <div class="p-5">
                            <form @submit.prevent="update">
                                <div class="grid grid-cols-12 gap-x-5 mt-2">
                                    
                                    <div class="col-span-12 xl:col-span-12 lg:col-span-12 md:col-span-12 xxl:col-span-12">
                                        <label for="improvement_of_patient" class="form-label">Improvement of Patient</label>
                                        <input id="improvement_of_patient" type="text" class="form-control" placeholder="Enter the Improvement of Patient" v-model="visit.improvement_of_patient">
                                        <div class="text-danger font-medium text-xs mt-1"  v-if="errors.improvement_of_patient">{{ errors.improvement_of_patient[0] }}</div>
                                    </div>
                    
                                </div>
                                <div class="mt-2">
                                    <input type="submit" value="Submit" class="w-20 btn btn-primary">
                                    <loading v-if="loading == true"></loading>
                                    <button class="btn btn-secondary" @click.prevent="editOutpatientVisit(visit.id)">Close</button>
                                </div>
                            </form>
                        </div>
                   </div>
                </div>
            </div>
            <div class="grid grid-cols-12 gap-6 mt-4">
                <div class="intro-y col-span-12 xxl:col-span-12">
                   <div class="intro-y box">
                        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60">
                            <h2 class="font-medium text-base mr-auto">Outpatient Visits for {{data.patient.name}}</h2>
                            <button class="btn btn-primary" @click.prevent="addVisit">Add Visit</button>
                        </div>
                        <div class="p-5">
                            <div class="overflow-x-auto" v-if="visits.length != 0">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Date for Visits</th>
                                            <th>Purpose of Visit</th>
                                            <th>Did the Patient Visit</th>
                                            <th>Improvement of Patient</th>
                                            <th>Staff Name</th>
                                            <th>Action</th>
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
                                            <td><button class="btn btn-warning mr-2" v-if="visit.patient_visit == null" @click.prevent="editOutpatientVisit(visit.id)"><i class="fa fa-edit"></i></button><button class="btn btn-danger" v-if="visit.patient_visit == null" @click.prevent="deleteVisit(visit.id)"><i class="fa fa-trash"></i></button></td>
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
        <!-- END: Content -->
    </div>
</div>
</template>

<script>
export default {
    name: 'outpatient-visit',
    data() {
        return {
            id: null,
            token: null,
            key: '',
            loading: false,
            errors: {},
            data: {},
            form: {
                number_of_visit: 1,
                key: '',
                date_for_visit: [],
                purpose_of_visit: [],
                token: ''
            },
            visits: [],
            add_visit: false,
            number_of_visit: 1,
            edit_visit: false,
            visit: ''
        }
    },
    
    created() {
        this.login()
        this.getOutpatientVisits()
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
                this.form.key = this.$route.params.key
                this.form.token = User.token()
            }
        },
        addVisit(){
            if (this.add_visit ==  false) {
                this.add_visit = true
            } else {
                this.add_visit = false                
            }
        },
        editOutpatientVisit(id){
            if (this.edit_visit == false) {
                this.edit_visit = true
                axios.get('/api/v1/outpatient-visit/' + id, {
                    headers: {
                        Authorization: 'Bearer ' + this.token,
                        Accept: 'application/json'
                    }
            }).then(response => (this.visit = response.data))
                .catch((error) => {
                    console.log(error)
                    if (error.response.status == 401) {
                        this.$router.push({
                            name: 'logout'
                        })
                    }
                })
            } else {
                this.edit_visit = false
            }
        },
        addToNumberOfVisit(){
            this.form.number_of_visit += 1
        },
        subtractToNumberOfVisit(index){
            const date_for_visit = this.form.date_for_visit
            const purpose_of_visit = this.form.purpose_of_visit
            const ind = date_for_visit.indexOf(date_for_visit[index])
            if (ind > -1) { 
                date_for_visit.splice(ind, 1);
                purpose_of_visit.splice(ind, 1)
                this.form.number_of_visit -= 1
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
        submit() {
           this.loading = true
           this.form.key = this.$route.params.key
            this.form.token = User.token()
            axios.post('/api/outpatient-visit', this.form)
                .then(() => {
                    this.$router.push({
                        path: `/patient/consultations/outpatient-visit/${this.key}`
                    })
                    Toast.fire({
                        icon: 'success',
                        title: 'Outpatient Visit successfully added'
                    })
                    this.add_visit = false
                    this.getOutpatientVisits()
                })
                .catch(error => this.errors = error.response.data.errors)
                .finally(() => {
                    this.loading =  false
                }) 
        },
        update() {
           this.loading = true
            axios.patch('/api/outpatient-visit/' + this.visit.id, this.visit)
                .then(() => {
                    this.$router.push({
                        path: `/patient/consultations/outpatient-visit/${this.key}`
                    })
                    Toast.fire({
                        icon: 'success',
                        title: 'Outpatient Visit successfully updated'
                    })
                    this.add_visit = false
                    this.getOutpatientVisits()
                })
                .catch(error => this.errors = error.response.data.errors)
                .finally(() => {
                    this.loading =  false
                }) 
        },
        deleteVisit(id) {
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
                    axios.delete('/api/outpatient-visit/' + id)
                        .then(() => {
                            this.visits = this.visits.filter(visit => {
                                return visit.id != id
                            })
                        })
                        .catch(() => {
                            this.$router.push({
                                path: `/patient/consultations/outpatient-visit/${this.key}`
                            })
                            this.getNotes()
                        })
                    Swal.fire(
                        'Deleted!',
                        'A Outpatient Visit note has been deleted.',
                        'success'
                    )
                }
            })
        }
        
        
    }
}
</script>

<style scoped>
.text-center{
    text-align: center;
}
</style>
