<template>
<div class="main">
    <!-- BEGIN: Mobile Menu -->
    <mobile-menu></mobile-menu>
    <!-- END: Mobile Menu -->
    <div class="flex">
        <!-- BEGIN: Side Menu -->
        <side-menu page="dashboard"></side-menu>
        <!-- END: Side Menu -->
        <!-- BEGIN: Content -->
        <div class="content">
            <!-- BEGIN: Top Bar -->
            <top-bar title="Edit Facility Signature"></top-bar>
            <!-- END: Top Bar -->
            <div class="intro-y flex items-center mt-8">
                <h2 class="text-lg font-medium mr-auto">
                    Facility Setting
                </h2>
            </div>
            <div class="grid grid-cols-12 gap-6">
                <!-- BEGIN: Profile Menu -->
                <div class="col-span-12 lg:col-span-3 xxl:col-span-3 flex lg:block flex-col-reverse">
                    <setting page="Facility Setting"></setting>
                </div>
                <!-- END: Profile Menu -->
                <div class="col-span-12 lg:col-span-9 xxl:col-span-9">
                    <!-- BEGIN: Display Information -->
                    <div class="intro-y box lg:mt-5">
                        <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                            <h2 class="font-medium text-base mr-auto">
                                Personal Information
                            </h2>
                        </div>
                        <div class="p-5">
                            <div class="flex flex-col-reverse xl:flex-row flex-col">
                                <form @submit.prevent="updatePassword" class="flex-1 mt-6 xl:mt-0">
                                    <div class="grid grid-cols-12 gap-x-5" :disabled="loading">
                                        <div class="col-span-12 xl:col-span-12">
                                            <div v-if="pswd_error == true" class="">
                                                <div class="alert alert-outline-danger alert-dismissible show flex items-center mb-2" role="alert" v-for="(error, index) in pswd_errors" :key="index"> 
                                                    <i data-feather="alert-octagon" class="fa fa-exclamation-circle fa-2x mr-2"></i> <strong class="mr-2">Whoops!</strong>  {{error}}
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> <i data-feather="x" class="fa fa-times w-4 h-4"></i> </button> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-span-12 xl:col-span-12">
                                            <label for="email" class="form-label">Email Address</label>
                                            <input id="email" type="email" class="form-control" v-model="form.email" disabled>
                                        </div>
                                        
                                        <div class="col-span-12 xl:col-span-12 mt-3">
                                            <label for="password" class="form-label">Current Password</label>
                                            <input id="password" type="password" class="form-control" v-model="form.current_password">
                                        </div>
                                        <div class="col-span-12 xl:col-span-12 mt-3" >
                                            <label for="new_password" class="form-label">New Password</label>
                                            <input id="new_password" type="password" class="form-control" v-model="form.new_password">
                                        </div>
                                        <div class="col-span-12 xl:col-span-12 mt-3" >
                                            <label for="confirm_password" class="form-label">Confirm Password</label>
                                            <input id="confirm_password" type="password" class="form-control" v-model="form.confirm_password">
                                        </div>
                                        
                                    </div>
                                    <div class="mt-3">
                                        <button type="submit" class="btn btn-primary w-20">Save</button>
                                        <loading v-if="loading == true"></loading>
                                    </div>
                                </form>
                                
                                
                            </div>
                        </div>
                    </div>
                    <!-- END: Display Information -->
                    
                   
                </div>
                
            </div>
        </div>
        <!-- END: Content -->
    </div>
</div>
</template>

<script>
export default {
    name: 'change-password',
    data() {
        return {
            id: null,
            token: null,
            form: {
                email: '',
                current_password: '',
                new_password: '',
                confirm_password: ''
            },
            loading:false,
            errors: {},
            pswd_error: false,
            pswd_errors: []
            
        }
    },
    created() {
        this.login()
        this.getUser()
        
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
        getUser(){
            axios.get('/api/v1/user/' + this.token, {
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
        updatePassword() {  
            this.loading = true
            axios.patch('/api/update-password/' + this.token, this.form)
                .then(res => {
                    //User.responseAfterLogin(res)
                    Toast.fire({
                        icon: 'success',
                        title: 'Password Updated. Login Again'
                    })
                    this.$router.push({
                        name: 'logout'
                    })

                })
                .catch((error) => {
                    this.pswd_error = true;
                    console.log(error)
                    if (error.response.status == 401) {
                        this.pswd_errors.push(error.response.data.error);
                    }
                })
                .finally(() => {
                    this.loading = false
                })
        }
    }
}
</script>

<style scoped>

</style>
