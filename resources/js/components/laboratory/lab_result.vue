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
            <top-bar title="Customer Medical Diagnostic &amp; Laboratory Result"></top-bar>
            <!-- END: Top Bar -->
            
            
            <div class="grid grid-cols-12 gap-6 mt-4">
                <div class="intro-y col-span-12 xxl:col-span-12">
                   <div class="intro-y box">
                        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60">
                            <h2 class="font-medium text-base mr-auto">{{result.patient.name}} Medical Diagnostic &amp; Laboratory Result</h2>
                        </div>
                        <div class=" p-5">
                            <div class="grid grid-cols-12 gap-x-5">
                                <div class="col-span-12 xl:col-span-12 mt-3">
                                                                    
                                    <div class="overflow-x-auto">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td><span>Test Name</span>{{result.patient.test_name}}</td>
                                                </tr>
                                                <tr>
                                                    <td><span>Test Result</span><div v-html="result.patient.test_result"></div></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="grid grid-cols-12 gap-x-5" v-if="result.patient.images">
                                <div class="col-span-12 xl:col-span-4 mt-3" v-for="(image, index) in result.images" :key="index">
                                    <div class="w-full h-64 my-5 image-fit">
                                        <img :src="'../../' + image" data-action="zoom" class="w-full rounded-md">
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
            result: '',
        }
    },
    
    created() {
        this.login()
        this.getPatient()
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
       
        getPatient(){
            let id = this.$route.params.id
            axios.get('/api/v1/patient-order-medical-laboratory-test/' + id, {
                headers: {
                    Authorization: 'Bearer ' + this.token,
                    Accept: 'application/json'
                }
           }).then(response => (this.result = response.data))
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
td span{
    display: block;
    text-transform: uppercase;
}
</style>
