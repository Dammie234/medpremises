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
            <top-bar title="Medical Diagnostic &amp; Laboratory Tests"></top-bar>
            <!-- END: Top Bar -->
            
            
            <div class="grid grid-cols-12 gap-6 mt-4">
                <div class="intro-y col-span-12 xxl:col-span-12">
                   <div class="intro-y box">
                        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60">
                            <h2 class="font-medium text-base mr-auto">Medical Diagnostic &amp; Laboratory Tests</h2>
                        </div>
                        <div class=" p-5">
                            <div class="grid grid-cols-12 gap-x-5">
                                <div class="col-span-12 xl:col-span-12">
                                    <input  class="form-control mr-0 ml-3" type="text" v-model="search" placeholder="Seach Medical Diagnostic &amp; Laboratory Tests">
                                </div>
                               
                                <div class="col-span-12 xl:col-span-12 mt-3">
                                    
                                    <div class="overflow-x-auto">
                                        <table class="table table-sm table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="whitespace-nowrap">Name</th>
                                                    <th class="whitespace-nowrap">Price</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="test in filterSearch" :key="test.id">
                                                    <td><a  :href="test.url" target="_blank" style="color:#00f; text-decoration:underline;">{{ test.test_name }}</a></td>
                            
                                                    <td>&#8358;{{test.price}}</td>
                                                    
                                                </tr>
                                                
                                            </tbody>
                                        </table>
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
            tests: [],
        }
    },
    computed: {
        filterSearch() {
            let str = this.search
            let string = str.charAt(0).toUpperCase() + str.slice(1)
            return this.tests.filter(test => {
                return test.test_name.match(string)
            })
        }
    },
    created() {
        this.login()
        this.getMedicalLaboratoryTests()
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
       
        getMedicalLaboratoryTests(){
            axios.get('/api/v1/laboratory-medical-tests/' + this.id, {
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
        
    
        
        
    }
}
</script>

<style scoped>

</style>
