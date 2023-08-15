<template>
<div class="py-5">
	<!-- BEGIN: Mobile Menu -->
	<frontend-mobile-menu></frontend-mobile-menu>
	<!-- END: Mobile Menu -->
	<!-- BEGIN: Top Bar -->
	<frontend-top-bar page="Private Hospitals/Clinics"></frontend-top-bar>
	<!-- END: Top Bar -->
	<!-- BEGIN: Top Menu -->
	<top-nav v-if="token"></top-nav>
	<!-- END: Top Menu -->
	<!-- BEGIN: Content -->
	<div class="content">
		<div class="grid grid-cols-12 gap-6">
			<div class="col-span-12 lg:col-span-6 xl:col-span-6 mt-6 xl:border-r xl:pr-6">
				<div class="intro-y block sm:flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">Private Hospitals/Clinics in {{city}}</h2>
                </div>
                <div class="intro-y" v-if="hospitals.length != 0">
                    <div class="grid grid-cols-12 gap-6">
                        <div class="col-span-12 lg:col-span-6" v-for="hospital in hospitals" :key="hospital.id">
                            <router-link :to="{name: 'frontend-facility', params:{slug: hospital.slug}}">
                                <div class="box px-4 py-4 mb-3 flex items-center zoom-in">
                                    <div class="w-10 h-10 flex-none image-fit rounded-md overflow-hidden"> 
                                    <img  :src="'../../' + hospital.logo"> </div>
                                    <div class="ml-4 mr-auto">
                                        <div class="font-medium">{{hospital.registered_facility_name}}</div>
                                        <div class="text-slate-500 text-xs mt-0.5">{{hospital.physical_location }}<br>{{hospital.local_government_area}}, {{hospital.state}}</div>
                                        <div class="text-slate-500 text-xs mt-0.5">{{hospital.phone_number}}</div>
                                        <div class="text-slate-500 text-xs mt-0.5" v-if="hospital.website">{{hospital.website}}</div>
                                        <div class="text-slate-500 text-xs mt-0.5">Opens:{{hospital.hours_of_operation}}</div>
                                    </div>
                                </div>
                            </router-link>
                        </div>
                    </div>
                    
                </div>
			</div>
			<div class="col-span-12 lg:col-span-3 xl:col-span-3 mt-6">
                <laboratory></laboratory>
			</div>
            <div class="col-span-12 lg:col-span-3 xl:col-span-3 mt-6">
				<disease></disease>
			</div>
		</div>
	</div>
	<!-- END: Content -->
	
</div>
</template>
<script>
import pharmacy from '../widgets/pharmacy.vue'

export default {
  components: { pharmacy },
    name: 'private_hospitals',
    data() {
        return {
            token: null,
            facility: '',
            user: '',
            staff: '',
            profile: 'dist/images/profile-12.jpg',
            hospitals: [],
			city: '',
        }
    },
    created(){
        this.login()
        this.getPrivateHospitals()
		this.getLocation()
    },
    methods: {
        login(){
            if (User.loggedIn()) {
               this.token = User.token()
            }
        },
        getPrivateHospitals(){
            axios.get('/api/all-private-hospitals')
            .then(response => (this.hospitals = response.data))
            .catch()
        },
		getLocation(){
            axios.get('/api/location', )
            .then(response => (this.city = response.data))
            .catch()
        },
        
		
    }
}
</script>