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
            <top-bar title="Customer Orders of Medical Diagnostic &amp; Laboratory Tests"></top-bar>
            <!-- END: Top Bar -->
            
            
            <div class="grid grid-cols-12 gap-6 mt-4">
                <div class="intro-y col-span-12 xxl:col-span-12">
                   <div class="intro-y box">
                        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60">
                            <h2 class="font-medium text-base mr-auto">Customer Orders of Medical Diagnostic &amp; Laboratory Tests</h2>
                        </div>
                        <div class=" p-5">
                            <div class="grid grid-cols-12 gap-x-5">
                                <div class="col-span-12 xl:col-span-12">
                                    <input  class="form-control mr-0 ml-3" type="text" v-model="search" placeholder="Seach Medical Diagnostic &amp; Laboratory Tests">
                                </div>
                               
                                <div class="col-span-12 xl:col-span-12 mt-3">
                                    
                                    <div class="overflow-x-auto" v-if="patients.length != 0">
                                        <table class="table table-sm table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="whitespace-nowrap">Customer Name</th>
                                                    <th class="whitespace-nowrap">Customer Email</th>
                                                    <th class="whitespace-nowrap">Customer Phone</th>
                                                    <th class="whitespace-nowrap">Test Name</th>
                                                    <th class="whitespace-nowrap">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="patient in filterSearch" :key="patient.id">
                                                    <td>{{ patient.name }}</td>
                                                    <td>{{ patient.email }}</td>
                                                    <td>{{ patient.phone }}</td>
                                                    <td>{{ patient.test_name }}</td>
                                                    <td><router-link :to="{name: 'add-lab-result', params:{id: patient.id}}" class="btn btn-primary">Add Result</router-link></td>
                                                    
                                                </tr>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                    <div v-else>
                                        <div class="alert alert-outline-danger alert-dismissible show flex items-center mb-2" role="alert" > 
                                            <i data-feather="alert-octagon" class="fa fa-exclamation-circle fa-2x mr-2"></i> <strong class="mr-2"> Whoops! </strong>  There are no customer order of medical diagnostic and laboratory test yet. <router-link :to="{name: 'lab-pos'}">Go Back</router-link> 
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
export default {
    name: 'laboratory-medical-tests',
    data() {
        return {
            id: null,
            token: '',
            search: '',
            patients: [],
        }
    },
    computed: {
        filterSearch() {
            let str = this.search
            let string = str.charAt(0).toUpperCase() + str.slice(1)
            return this.patients.filter(patient => {
                return patient.name.match(string)
            })
        }
    },
    created() {
        this.login()
        this.getPatientOrders()
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
       
        getPatientOrders(){
            axios.get('/api/v1/patient-order-medical-laboratory-tests/' + this.token, {
                headers: {
                    Authorization: 'Bearer ' + this.token,
                    Accept: 'application/json'
                }
           }).then(response => (this.patients = response.data))
            .catch((error) => {
                console.log(error)
                if (error.response.status == 401) {
                    this.$router.push({
                        name: 'logout'
                    })
                }
            })
        },
        
    
        
        
    }
}
</script>

<style scoped>

</style>
