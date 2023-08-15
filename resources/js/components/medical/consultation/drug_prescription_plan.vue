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
            <top-bar title="Consultation - Drug Prescription Plan"></top-bar>
            <!-- END: Top Bar -->
            
            <div class="grid grid-cols-12 gap-6 mt-4">
                <div class="intro-y col-span-12 xxl:col-span-12">
                   <div class="intro-y box">
                        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60">
                            <h2 class="font-medium text-base mr-auto">Drug Prescription Plan for {{data.patient.name}}</h2>
                        </div>
                        <div class="p-5">
                            <div class="grid grid-cols-12 gap-x-5">
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
                                                    <th>Action</th>
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
                                                    <td>
                                                        <button class="btn btn-warning mr-2" @click="editPlan(plan.id)" title="Edit"><i class="fa fa-edit"></i></button>
                                                        <button class="btn btn-danger" @click="deleteDrugPlan(plan.id)" title="Delete"><i class="fa fa-trash"></i></button>
                                                    </td>
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
                                   <button class="btn btn-primary mt-1" v-if="plans.length == 0" @click="addPlan">Prescribe Drug</button>
                                   <button class="btn btn-primary mt-1" v-else @click="addToPlan">Add To Drug Prescription Plan</button>
                                </div>
                            </div>
                        </div>
                   </div>
                </div>
            </div>
            <div v-if="error == true" class="">
                <div class="alert alert-outline-danger alert-dismissible show flex items-center mb-2" role="alert" v-for="(error, index) in errors" :key="index"> 
                    <i data-feather="alert-octagon" class="fa fa-exclamation-circle fa-2x mr-2"></i> <strong class="mr-2">Whoops!</strong>  {{error}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> <i data-feather="x" class="fa fa-times w-4 h-4"></i> </button> 
                </div>
            </div>
            <div class="grid grid-cols-12 gap-6 mt-4" v-if="add_plan == true">
                <div class="intro-y col-span-12 xxl:col-span-12">
                   <div class="intro-y box">
                        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60">
                            <h2 class="font-medium text-base mr-auto">Prescribe Drugs for {{data.patient.name}}</h2>
                        </div>
                        <div class="p-5">
                            <div class="grid grid-cols-12 gap-x-5">
                                <div class="col-span-12 xl:col-span-12 mt-3" >
                                    <form @submit.prevent="submit">
                                        <div :disabled="loading">
                                            <div class="grid grid-cols-12 gap-x-5" v-for="(row, index) in rows" :key="index">
                                                <div class="col-span-12 xl:col-span-4 mt-3">
                                                    <label for="drug" class="form-label">Drug</label>
                                                    <input id="drug" type="text" v-model="plan.drug[index]" required class="form-control">
                                                </div>
                                                <div class="col-span-12 xl:col-span-2 mt-3">
                                                    <label for="quantity" class="form-label">Quantity</label>
                                                    <input id="quantity" type="text" required v-model="plan.quantity[index]" class="form-control">
                                                </div>
                                                <div class="col-span-12 xl:col-span-2 mt-3">
                                                    <label for="usages" class="form-label">Usages</label>
                                                    <input id="usages" type="text" required v-model="plan.usages[index]" class="form-control">
                                                </div>
                                                <div class="col-span-12 xl:col-span-2 mt-3">
                                                    <label for="times" class="form-label">Times</label>
                                                    <input id="times" type="text" required v-model="plan.times[index]" class="form-control">
                                                </div>
                                                <div class="col-span-12 xl:col-span-2 mt-5">
                                                    <button class="btn btn-primary mt-3" @click="addRow">Add Row</button>
                                                    <button v-if="rows > 1" class="btn btn-primary mt-3" @click="subtractRow(index)">Remove Row</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <input type="submit" value="Submit" class="w-20 btn btn-primary">
                                            <loading v-if="loading == true"></loading>
                                            <button class="btn btn-secondary" @click="addPlan">Close</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            
                        </div>
                   </div>
                </div>
            </div>
            <div class="grid grid-cols-12 gap-6 mt-4" v-if="add_to_plan == true">
                <div class="intro-y col-span-12 xxl:col-span-12">
                   <div class="intro-y box">
                        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60">
                            <h2 class="font-medium text-base mr-auto">Add More Drugs for {{data.patient.name}}</h2>
                        </div>
                        <div class="p-5">
                            <div class="grid grid-cols-12 gap-x-5">
                                <div class="col-span-12 xl:col-span-12 mt-3" >
                                    <form @submit.prevent="addToPlanSubmit">
                                        <div :disabled="loading">
                                            <div class="grid grid-cols-12 gap-x-5" v-for="(row, index) in rows" :key="index">
                                                <div class="col-span-12 xl:col-span-4 mt-3">
                                                    <label for="drug" class="form-label">Drug</label>
                                                    <input id="drug" type="text" v-model="plan.drug[index]" required class="form-control">
                                                </div>
                                                <div class="col-span-12 xl:col-span-2 mt-3">
                                                    <label for="quantity" class="form-label">Quantity</label>
                                                    <input id="quantity" type="text" required v-model="plan.quantity[index]" class="form-control">
                                                </div>
                                                <div class="col-span-12 xl:col-span-2 mt-3">
                                                    <label for="usages" class="form-label">Usages</label>
                                                    <input id="usages" type="text" required v-model="plan.usages[index]" class="form-control">
                                                </div>
                                                <div class="col-span-12 xl:col-span-2 mt-3">
                                                    <label for="times" class="form-label">Times</label>
                                                    <input id="times" type="text" required v-model="plan.times[index]" class="form-control">
                                                </div>
                                                <div class="col-span-12 xl:col-span-2 mt-5">
                                                    <button class="btn btn-primary mt-3" @click="addRow">Add Row</button>
                                                    <button v-if="rows > 1" class="btn btn-primary mt-3" @click="subtractRow(index)">Remove Row</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <input type="submit" value="Submit" class="w-20 btn btn-primary">
                                            <loading v-if="loading == true"></loading>
                                            <button class="btn btn-secondary" @click="addToPlan">Close</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            
                        </div>
                   </div>
                </div>
            </div>
            <div class="grid grid-cols-12 gap-6 mt-4" v-if="edit_plan == true">
                <div class="intro-y col-span-12 xxl:col-span-12">
                   <div class="intro-y box">
                        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60">
                            <h2 class="font-medium text-base mr-auto">Edit Drug Prescrition Plan for {{data.patient.name}} whose Drug is {{drug_plan.drug}}</h2>
                        </div>
                        <div class="p-5">
                            <div class="grid grid-cols-12 gap-x-5">
                                <div class="col-span-12 xl:col-span-12 mt-3" >
                                    <form @submit.prevent="updateDrugPlan">
                                        <div :disabled="loading">
                                            <div class="grid grid-cols-12 gap-x-5">
                                                <div class="col-span-12 xl:col-span-6 mt-3">
                                                    <label for="drug" class="form-label">Drug</label>
                                                    <input id="drug" type="text" v-model="drug_plan.drug" required class="form-control">
                                                </div>
                                                <div class="col-span-12 xl:col-span-2 mt-3">
                                                    <label for="quantity" class="form-label">Quantity</label>
                                                    <input id="quantity" type="text" required v-model="drug_plan.quantity" class="form-control">
                                                </div>
                                                <div class="col-span-12 xl:col-span-2 mt-3">
                                                    <label for="usages" class="form-label">Usages</label>
                                                    <input id="usages" type="text" required v-model="drug_plan.usages" class="form-control">
                                                </div>
                                                <div class="col-span-12 xl:col-span-2 mt-3">
                                                    <label for="times" class="form-label">Times</label>
                                                    <input id="times" type="text" required v-model="drug_plan.times" class="form-control">
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <input type="submit" value="Submit" class="w-20 btn btn-primary">
                                            <loading v-if="loading == true"></loading>
                                            <button class="btn btn-secondary" @click="editPlan(drug_plan.id)">Close</button>
                                        </div>
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
    name: 'drug-prescription-plan',
    data() {
        return {
            id: null,
            token: null,
            key: '',
            loading: false,
            errors: [],
            data: {},
            plans: [],
            plan: {
                drug: [],
                quantity: [],
                usages: [],
                times: [],
                key: '',
                token: ''
            },
            drug_plan: '',
            edit_plan: false,
            rows: 1,
            add_plan: false,
            error: false,
            add_to_plan: false
        }
    },
    
    created() {
        this.login()
        this.getDrugPrescriptionPlan()
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
        addPlan(){
            if (this.add_plan == false) {
                this.add_plan = true
            } else {
                this.add_plan = false                
            }
        },
        addToPlan(){
            if (this.add_to_plan == false) {
                this.add_to_plan = true
            } else {
                this.add_to_plan = false                
            }
        },
        addRow(){
            this.rows += 1
        },
        editPlan(id){
            if (this.edit_plan == false) {
                this.edit_plan = true
                axios.get('/api/v1/show-drug-prescription-plan/' + id, {
                    headers: {
                        Authorization: 'Bearer ' + this.token,
                        Accept: 'application/json'
                    }
            }).then(response => (this.drug_plan = response.data))
                .catch((error) => {
                    console.log(error)
                    if (error.response.status == 401) {
                        this.$router.push({
                            name: 'logout'
                        })
                    }
                })
            } else {
                this.edit_plan = false
            }
        },
        subtractRow(index){
            //console.log(index)
            const drug = this.plan.drug
            const qty = this.plan.quantity
            const times = this.plan.times
            const usages = this.plan.usages
            const ind = drug.indexOf(drug[index])
            console.log(ind)
            if (ind > -1) { 
                drug.splice(ind, 1);
                qty.splice(ind, 1)
                times.splice(ind, 1)
                usages.splice(ind, 1)
                this.rows -= 1 
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
        },
        submit() {
           this.loading = true
           this.plan.token = User.token()
           this.plan.key = this.key
            axios.post('/api/drug-prescription-plan', this.plan)
                .then(() => {
                    this.$router.push({
                        path: `/patient/consultations/drug-prescription-plan/${this.key}`
                    })
                    this.getDrugPrescriptionPlan()
                    this.add_plan = false
                    Toast.fire({
                        icon: 'success',
                        title: 'Drug Prescription Plan successfully added'
                    })

                })
                .catch((error) => {
                    this.error = true;
                    console.log(error)
                    if (error.response.status == 401) {
                        this.errors.push(error.response.data.error);
                    }
                })
                .finally(() => {
                    this.loading =  false
                }) 
        },
        addToPlanSubmit() {
           this.loading = true
           this.plan.token = User.token()
           this.plan.key = this.key
            axios.post('/api/add-to-plan', this.plan)
                .then(() => {
                    this.$router.push({
                        path: `/patient/consultations/drug-prescription-plan/${this.key}`
                    })
                    this.getDrugPrescriptionPlan()
                    this.add_to_plan = false
                    Toast.fire({
                        icon: 'success',
                        title: 'Drug Prescription Plan successfully added'
                    })

                })
                .catch(error => this.errors = error.response.data.errors)
                .finally(() => {
                    this.loading =  false
                }) 
        },
        updateDrugPlan() {
           this.loading = true
           this.drug_plan.token = User.token()

            axios.patch('/api/drug-prescription-plan/' + this.drug_plan.id, this.drug_plan)
                .then(() => {
                    this.$router.push({
                        path: `/patient/consultations/drug-prescription-plan/${this.key}`
                    })
                    this.getDrugPrescriptionPlan()
                    this.edit_plan = false
                    Toast.fire({
                        icon: 'success',
                        title: 'Drug Prescription Plan successfully updated'
                    })

                })
                .catch(error => this.errors = error.response.data.errors)
                .finally(() => {
                    this.loading =  false
                }) 
        },
        deleteDrugPlan(id) {
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
                    axios.delete('/api/drug-prescription-plan/' + id)
                        .then(() => {
                            this.plans = this.plans.filter(plan => {
                                return plan.id != id
                            })
                        })
                        .catch(() => {
                            this.$router.push({
                                path: `/patient/consultations/drug-prescription-plan/${this.key}`
                            })
                            this.getDrugPrescriptionPlan()
                        })
                    Swal.fire(
                        'Deleted!',
                        'A drug prescription has been deleted.',
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
