<template>
    <div>
        <div class="intro-y box mt-5">
            <div class="relative flex items-center p-5">
                <div class="w-12 h-12 image-fit">
                    <img  class="rounded-full" v-if="user.role == 'Facility Manager'" :src="'../../' + facility.ownership_picture">
                    <img  class="rounded-full" v-else-if="user.role == 'Non Medical Staff' || user.role == 'Medical Staff'" :src="'../../' + staff.profile_picture">
                     <img  class="rounded-full" v-else :src="'../' + profile">
                </div>
                <div class="ml-4 mr-auto">
                    <div class="font-medium text-base">{{user.name}}</div>
                    <div class="text-gray-600">{{user.role}}</div>
                </div>
            </div>
            <div class="p-5 border-t border-gray-200 dark:border-dark-5">
                <router-link v-if="user.role == 'Facility Manager'" class="flex items-center mt-5" :to="{name: 'edit-signature'}"> 
                <i data-feather="box" class="w-4 h-4 mr-2"></i> Facility Setting </router-link>
                <router-link v-if="user.role == 'Facility Manager' && facility.facility_type == 'Hospital'" class="flex items-center mt-5" :to="{name: 'edit-hospital-class'}"> 
                <i data-feather="box" class="w-4 h-4 mr-2"></i> Hospital Setting </router-link>
                <router-link v-if="user.role == 'Facility Manager' && facility.facility_type == 'Hospital'" class="flex items-center mt-5" :to="{name: 'edit-medical-services'}"> 
                <i data-feather="box" class="w-4 h-4 mr-2"></i> Medical Service Setting </router-link>
                <router-link v-if="user.role == 'Facility Manager' && (facility.facility_type == 'Laboratory' || facility.facility_type == 'Hospital')" :to="{name: 'laboratory-tests'}" class="flex items-center mt-5"> 
                <i data-feather="box" class="w-4 h-4 mr-2"></i> Add Medical Diagnostic &amp; Laboratory Tests </router-link>
                
                <router-link v-if="user.role == 'Medical Staff' || user.role == 'Non Medical Staff'" :to="{name: 'edit-profile'}" class="flex items-center mt-5" href=""> <i data-feather="settings" class="w-4 h-4 mr-2"></i> Profile Settings </router-link>
                <router-link  :to="{name: 'change-password'}" class="flex items-center mt-5" href=""> <i data-feather="settings" class="w-4 h-4 mr-2"></i> Change Password </router-link>
            </div>
            <div class="p-5 border-t border-gray-200 dark:border-dark-5">
                <router-link class="flex items-center" :to="{name: 'signature'}" v-if="user.role == 'Facility Manager'"> <i data-feather="activity" class="w-4 h-4 mr-2"></i> Facility Signature </router-link>
                <router-link v-if="user.role == 'Medical Staff' || user.role == 'Non Medical Staff'" :to="{name: 'profile'}" class="flex items-center mt-5" href=""> <i data-feather="settings" class="w-4 h-4 mr-2"></i> Profile </router-link>
                
            </div>
            
        </div>
    </div>
</template>
<script>
export default {
    name: 'setting',
    data(){
        return {
            user: '',
            facility: '',
            token: '',
            staff: '',
            profile: 'dist/images/profile-12.jpg'
        }
    },
    props: ['page'],
    created(){
        this.login()
        this.getUser()
        this.getFacilitySignature()
        this.getStaff()
    },
    methods: {
        login(){
            if (!User.loggedIn()) {
                this.$router.push({
                        name: 'logout'
                    })
            }else{
                this.token = User.token()
            }
        },
        getUser(){
            axios.get('/api/v1/user/' + this.token, {
                headers: {
                    Authorization: 'Bearer ' + this.token,
                    Accept: 'application/json'
                }
           }).then(response => (this.user = response.data))
            .catch((error) => {
                console.log(error)
                if (error.response.status == 401) {
                    this.$router.push({
                        name: 'logout'
                    })
                }
            })
        },
        getFacilitySignature(){
            axios.get('/api/v1/facility-details/' + this.token, {
                headers: {
                    Authorization: 'Bearer ' + this.token,
                    Accept: 'application/json'
                }
           }).then(response => (this.facility = response.data))
            .catch((error) => {
                console.log(error)
                if (error.response.status == 401) {
                    this.$router.push({
                        name: 'logout'
                    })
                }
            })
        },
        getStaff(){
            axios.get('/api/v1/staff/' + this.token, {
                headers: {
                    Authorization: 'Bearer ' + this.token,
                    Accept: 'application/json'
                }
           }).then(response => (this.staff = response.data.biodata))
            .catch((error) => {
                console.log(error)
                if (error.response.status == 401) {
                    this.$router.push({
                        name: 'logout'
                    })
                }
            })
        }
    }
}
</script>